<?php
/**
 * Popup Campaign - WooCommerce purchase conversion tracking
 *
 * Reads the short-lived attribution cookie set on CTA click
 * (see assets/js/popup-campaign-frontend.js) and logs a 'conversion'
 * analytics event when the visitor completes a WooCommerce order
 * within the attribution window.
 *
 * Mirrors inc/announcement-conversion-tracking.php — kept in a separate
 * file with distinctly-named functions (both files load into the same
 * global PHP namespace) since Popup Campaign is a separate CPT
 * (`wphash_popup`) with its own analytics table.
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
// time) because plugin load order is not guaranteed. WooCommerce availability is
// checked instead inside the callback, which runs later at actual request time.
add_action( 'woocommerce_thankyou', 'hashbar_track_popup_woocommerce_conversion', 10, 1 );

if ( ! function_exists( 'hashbar_track_popup_woocommerce_conversion' ) ) {
	/**
	 * Log a conversion event for the popup campaign that drove this order,
	 * if the attribution cookie is present and points to a valid popup.
	 *
	 * Same cookie name (`hashbar_conv_ref`) as the announcement bar's version —
	 * intentional, not a collision: post IDs are globally unique across post
	 * types, so the `get_post_type()` check below safely disambiguates which
	 * feature a given cookie value belongs to. This also gives "last click wins"
	 * attribution across both an announcement bar and a popup on the same site,
	 * matching the standard last-click attribution model.
	 *
	 * @param int $order_id WooCommerce order ID.
	 */
	function hashbar_track_popup_woocommerce_conversion( $order_id ) {
		if ( ! class_exists( 'WooCommerce' ) || ! function_exists( 'wc_get_order' ) ) {
			return;
		}

		if ( empty( $_COOKIE['hashbar_conv_ref'] ) ) {
			return;
		}

		$popup_id = absint( $_COOKIE['hashbar_conv_ref'] );

		if ( ! $popup_id || get_post_type( $popup_id ) !== 'wphash_popup' || get_post_status( $popup_id ) !== 'publish' ) {
			return;
		}

		$order = wc_get_order( $order_id );

		if ( ! $order ) {
			return;
		}

		global $wpdb;

		$table = $wpdb->prefix . 'hashbar_popup_analytics';

		if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $table ) ) !== $table ) {
			return;
		}

		$wpdb->insert(
			$table,
			array(
				'campaign_id'      => $popup_id,
				'campaign_type'    => 'popup',
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
 * Auto-inject the conversion tracking snippet on whichever page a popup has
 * picked as its "Confirmation Page", instead of requiring the user to paste
 * it manually.
 *
 * Only ever echoes into wp_footer, never touches the page's saved content.
 */
add_action( 'wp', 'hashbar_maybe_output_popup_conversion_snippet' );

if ( ! function_exists( 'hashbar_maybe_output_popup_conversion_snippet' ) ) {
	function hashbar_maybe_output_popup_conversion_snippet() {
		if ( is_admin() ) {
			return;
		}

		$current_page_id = absint( get_queried_object_id() );

		if ( ! $current_page_id ) {
			return;
		}

		$popups = get_posts( array(
			'post_type'      => 'wphash_popup',
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
			'meta_query'     => array(
				array(
					'key'   => '_wphash_popup_confirmation_page_id',
					'value' => $current_page_id,
				),
			),
		) );

		if ( empty( $popups ) ) {
			return;
		}

		$popup_id = absint( $popups[0] );

		add_action( 'wp_footer', function() use ( $popup_id ) {
			hashbar_render_popup_conversion_snippet( $popup_id );
		}, 999 );
	}
}

if ( ! function_exists( 'hashbar_render_popup_conversion_snippet' ) ) {
	/**
	 * PHP twin of the JS `getPopupConversionSnippet()` in the Popup Campaign
	 * Content tab (used for the copy-paste snippet) — keep both in sync if the
	 * tracking logic changes.
	 *
	 * Unlike the announcement bar's snippet, this does NOT depend on
	 * `window.HashbarAnalytics` (that script is only enqueued when an
	 * announcement bar is active, and may not exist at all on a popup-only
	 * site) — it POSTs directly to the popup analytics batch endpoint instead,
	 * which is self-contained and always available.
	 *
	 * @param int $popup_id Popup campaign ID.
	 */
	function hashbar_render_popup_conversion_snippet( $popup_id ) {
		?>
		<script>
		(function() {
			if (!document.cookie.includes('hashbar_conv_ref=')) return;
			var popupId = document.cookie.split('hashbar_conv_ref=')[1].split(';')[0];
			if (popupId !== '<?php echo esc_js( $popup_id ); ?>') return;

			fetch(window.location.origin + '/wp-json/hashbar/v1/popup-analytics/batch', {
				method: 'POST',
				headers: { 'Content-Type': 'application/json' },
				body: JSON.stringify({
					events: [{
						campaign_id: popupId,
						campaign_type: 'popup',
						event_type: 'conversion',
						session_id: 'manual_' + Date.now()
					}]
				})
			}).then(function() {
				document.cookie = 'hashbar_conv_ref=; max-age=0; path=/';
			}).catch(function() {});
		})();
		</script>
		<?php
	}
}
