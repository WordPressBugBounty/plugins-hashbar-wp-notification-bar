<?php
/**
 * Announcement Bar - WooCommerce purchase conversion tracking
 *
 * Reads the short-lived attribution cookie set on CTA click
 * (see assets/js/announcement-analytics.js) and logs a 'conversion'
 * analytics event when the visitor completes a WooCommerce order
 * within the attribution window.
 *
 * No-op entirely when WooCommerce is not active.
 *
 * Every function below is wrapped in a `function_exists()` guard: the Free
 * and Pro plugins are meant to be mutually exclusive, but WordPress
 * `include`s a plugin's files during activation even if the other plugin
 * is still (momentarily) active — deactivation only happens afterward, via
 * `register_activation_hook`. If both files load in that same request,
 * unguarded identically-named functions fatal with "Cannot redeclare".
 *
 * @package HashBar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Hook is always registered (not gated behind class_exists('WooCommerce') at file-load
// time) because plugin load order is not guaranteed — if HashBar loads before WooCommerce,
// a load-time class_exists() check would silently skip add_action() and the hook would
// never fire again for the whole request. WooCommerce availability is checked instead
// inside the callback, which runs later at actual request time after all plugins are loaded.
add_action( 'woocommerce_thankyou', 'hashbar_track_woocommerce_conversion', 10, 1 );

if ( ! function_exists( 'hashbar_track_woocommerce_conversion' ) ) {
	/**
	 * Log a conversion event for the announcement bar that drove this order,
	 * if the attribution cookie is present and points to a valid bar.
	 *
	 * Inserted directly into the analytics table (same table the REST batch
	 * endpoint writes to) rather than via a loopback HTTP request, since
	 * `wp_remote_post()` with a non-blocking request can silently fail on
	 * environments where loopback requests are slow/blocked (common on local
	 * dev setups) with no way to surface the failure.
	 *
	 * @param int $order_id WooCommerce order ID.
	 */
	function hashbar_track_woocommerce_conversion( $order_id ) {
		if ( ! class_exists( 'WooCommerce' ) || ! function_exists( 'wc_get_order' ) ) {
			return;
		}

		if ( empty( $_COOKIE['hashbar_conv_ref'] ) ) {
			return;
		}

		$bar_id = absint( $_COOKIE['hashbar_conv_ref'] );

		if ( ! $bar_id || get_post_type( $bar_id ) !== 'wphash_announcement' || get_post_status( $bar_id ) !== 'publish' ) {
			return;
		}

		$order = wc_get_order( $order_id );

		if ( ! $order ) {
			return;
		}

		global $wpdb;

		$table = $wpdb->prefix . 'hashbar_announcement_analytics';

		// Make sure the table exists (mirrors the same fallback the REST batch endpoint uses).
		if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $table ) ) !== $table ) {
			if ( class_exists( '\HashbarFree\DatabaseInstaller\Database_Installer' ) ) {
				delete_option( 'hthb_announcement_analyticstbl_exist' );
				\HashbarFree\DatabaseInstaller\Database_Installer::create_announcement_analytics_table();
			}

			if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $table ) ) !== $table ) {
				return;
			}
		}

		$wpdb->insert(
			$table,
			array(
				'campaign_id'      => $bar_id,
				'campaign_type'    => 'announcement',
				'event_type'       => 'conversion',
				'event_timestamp'  => current_time( 'mysql' ),
				'session_id'       => 'wc_order_' . $order_id,
				'ip_address'       => isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '',
				'device_type'      => 'unknown',
				'page_url'         => esc_url_raw( $order->get_checkout_order_received_url() ),
				'conversion_value' => $order->get_total(),
				'user_id'          => get_current_user_id() ?: null,
				'created_at'       => current_time( 'mysql' ),
			)
		);

		// Prevent double-counting on page refresh or a later unrelated order.
		setcookie( 'hashbar_conv_ref', '', time() - 3600, '/' );
		unset( $_COOKIE['hashbar_conv_ref'] );
	}
}

/**
 * Auto-inject the conversion tracking snippet on whichever page a bar has
 * picked as its "Confirmation Page" (see the Content tab page-picker in
 * ContentTab.jsx), instead of requiring the user to paste it manually.
 *
 * Only ever echoes into wp_footer, never touches the page's saved content.
 */
add_action( 'wp', 'hashbar_maybe_output_conversion_snippet' );

if ( ! function_exists( 'hashbar_maybe_output_conversion_snippet' ) ) {
	function hashbar_maybe_output_conversion_snippet() {
		if ( is_admin() ) {
			return;
		}

		$current_page_id = absint( get_queried_object_id() );

		if ( ! $current_page_id ) {
			return;
		}

		$bars = get_posts( array(
			'post_type'      => 'wphash_announcement',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_query'     => array(
				array(
					'key'   => '_wphash_ab_confirmation_page_id',
					'value' => $current_page_id,
				),
			),
		) );

		if ( empty( $bars ) ) {
			return;
		}

		$bar_id = absint( $bars[0] );

		add_action( 'wp_footer', function() use ( $bar_id ) {
			hashbar_render_conversion_snippet( $bar_id );
		}, 999 );
	}
}

if ( ! function_exists( 'hashbar_render_conversion_snippet' ) ) {
	/**
	 * PHP twin of the JS `getConversionSnippet()` in ContentTab.jsx (used for the
	 * copy-paste snippet) — keep both in sync if the tracking logic changes.
	 *
	 * @param int $bar_id Announcement bar ID.
	 */
	function hashbar_render_conversion_snippet( $bar_id ) {
		?>
		<script>
		(function() {
			function trackHashbarConversion(attempt) {
				if (!document.cookie.includes('hashbar_conv_ref=')) return;
				var barId = document.cookie.split('hashbar_conv_ref=')[1].split(';')[0];
				if (barId !== '<?php echo esc_js( $bar_id ); ?>') return;
				if (window.HashbarAnalytics) {
					window.HashbarAnalytics.trackConversion(barId);
					document.cookie = 'hashbar_conv_ref=; max-age=0; path=/';
				} else if (attempt < 10) {
					setTimeout(function() { trackHashbarConversion(attempt + 1); }, 300);
				}
			}
			trackHashbarConversion(0);
		})();
		</script>
		<?php
	}
}
