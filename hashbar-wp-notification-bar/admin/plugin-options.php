<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'admin_menu', 'hashbar_wpnb_add_admin_menu' );
add_action( 'admin_menu', 'hashbar_wpnb_upgrade_menu_tweaks', 101 );
add_action( 'admin_init', 'hashbar_wpnb_settings_init' );


function hashbar_wpnb_add_admin_menu() { 

	add_submenu_page( 'edit.php?post_type=wphash_ntf_bar', __('Settings', 'hashbar-wp-notification-bar'), __('Settings', 'hashbar-wp-notification-bar'), 'manage_options', 'hashbar_options_page', 'hashbar_wpnb_options_page' );
	if(hashbar_wpnb_get_opt('enable_analytics')){
		add_submenu_page( 'edit.php?post_type=wphash_ntf_bar', __('HashBar Analytics', 'hashbar-wp-notification-bar'), __('Analytics', 'hashbar-wp-notification-bar'), 'manage_options', 'hashbar_analytics_page', 'hashbar_wpnb_analytics_page' );
	}

}
function hashbar_wpnb_upgrade_menu_tweaks() { 
	if( !is_plugin_active('hashbar-pro/init.php') ){
		add_submenu_page(
            'edit.php?post_type=wphash_ntf_bar', 
            __('Upgrade to Pro', 'hashbar-wp-notification-bar'),
            __('Upgrade to Pro', 'hashbar-wp-notification-bar'), 
            'manage_options', 
            'https://wphashbar.com/pricing/?utm_source=admin&utm_medium=mainmenu&utm_campaign=free'
        );
	}
}

add_action( 'admin_footer', 'hashbar_wpnb_enqueue_admin_head_scripts', );
function hashbar_wpnb_enqueue_admin_head_scripts() {
	printf( '<style>%s</style>', '#adminmenu #menu-posts-wphash_ntf_bar a.hashbar-upgrade-pro { font-weight: 600; background-color: #ff6e30; color: #ffffff; text-align: center; margin-top: 3px; }' );
	printf( '<script>%s</script>', '(function ($) {
		$("#menu-posts-wphash_ntf_bar .wp-submenu a").each(function() {
			if($(this)[0].href === "https://wphashbar.com/pricing/?utm_source=admin&utm_medium=mainmenu&utm_campaign=free") {
				$(this).addClass("hashbar-upgrade-pro").attr("target", "_blank");
			}
		})
	})(jQuery);' );
}


function hashbar_wpnb_sanitize_opt( $input ) {
	$input = is_array( $input ) ? $input : array();

	// Merge onto the existing stored option instead of rebuilding it from
	// scratch, so keys written by another surface sharing this same option
	// (e.g. HashBar Pro syncs its own settings into 'hashbar_wpnb_opt' for
	// cross-version compatibility) are never wiped out by saving this form.
	$existing = get_option( 'hashbar_wpnb_opt', array() );
	$output   = is_array( $existing ) ? $existing : array();

	$checkbox_keys = array( 'dont_show_bar_after_close', 'keep_closed_bar', 'enable_analytics', 'count_onece_byip' );
	foreach ( $checkbox_keys as $key ) {
		$output[ $key ] = ! empty( $input[ $key ] ) ? '1' : '';
	}

	$analytics_from = isset( $input['analytics_from'] ) ? $input['analytics_from'] : 'everyone';
	$output['analytics_from'] = in_array( $analytics_from, array( 'everyone', 'guests', 'registered_users' ), true ) ? $analytics_from : 'everyone';

	$output['mobile_device_breakpoint'] = isset( $input['mobile_device_breakpoint'] ) ? absint( $input['mobile_device_breakpoint'] ) : 767;

	$output['cookies_expire_time'] = isset( $input['cookies_expire_time'] ) ? absint( $input['cookies_expire_time'] ) : 7;

	$cookies_expire_type = isset( $input['cookies_expire_type'] ) ? $input['cookies_expire_type'] : 'days';
	$output['cookies_expire_type'] = in_array( $cookies_expire_type, array( 'days', 'hours', 'minutes' ), true ) ? $cookies_expire_type : 'days';

	return $output;
}

function hashbar_wpnb_settings_init(  ) {

	register_setting( 'options_group_1', 'hashbar_wpnb_opt', array(
		'type'              => 'array',
		'sanitize_callback' => 'hashbar_wpnb_sanitize_opt',
		'default'           => array(),
	) );

	add_settings_section(
		'hashbar_wpnb_options_group_1_section', 
		'', 
		null, 
		'options_group_1'
	);

	add_settings_field( 
		'dont_show_bar_after_close', 
		__( 'Don\'t Show Again', 'hashbar-wp-notification-bar' ), 
		'hashbar_wpnb_checkbox_render', 
		'options_group_1', 
		'hashbar_wpnb_options_group_1_section' 
	);

	add_settings_field( 
		'keep_closed_bar', 
		__( 'Keep Notification Bar Closed', 'hashbar-wp-notification-bar' ), 
		'hashbar_wpnb_bar_closed_checkbox_render', 
		'options_group_1', 
		'hashbar_wpnb_options_group_1_section' 
	);

	add_settings_field( 
		'cookies_expire_time', 
		__( 'Cookies expire time.', 'hashbar-wp-notification-bar' ), 
		'hashbar_cookies_expire_time_render', 
		'options_group_1', 
		'hashbar_wpnb_options_group_1_section'
	);

	add_settings_field( 
		'enable_analytics', 
		__( 'Enable Analytics', 'hashbar-wp-notification-bar' ), 
		'hashbar_wpnb_analytics_checkbox_render', 
		'options_group_1', 
		'hashbar_wpnb_options_group_1_section' 
	);

	add_settings_field( 
		'count_onece_byip', 
		__( 'Count Only 1 From Each IP', 'hashbar-wp-notification-bar' ), 
		'hashbar_wpnb_count_onece_byip_checkbox_render', 
		'options_group_1', 
		'hashbar_wpnb_options_group_1_section' 
	);

	add_settings_field(
		'analytics_from', 
		__( 'User Tracking Options', 'hashbar-wp-notification-bar' ), 
		'hashbar_wpnb_analytics_from_options_render', 
		'options_group_1', 
		'hashbar_wpnb_options_group_1_section' 
	);

	add_settings_field(
		'mobile_device_breakpoint',
		__( 'Mobile device breakpoint (px)', 'hashbar-wp-notification-bar' ),
		'hashbar_wpnb_text_render',
		'options_group_1',
		'hashbar_wpnb_options_group_1_section'
	);

	// dismiss the admin notice for user
	$user_id = get_current_user_id();
    if ( isset( $_GET['hthb-notice-dismissed'] ) ){ // phpcs:ignore
        add_user_meta( $user_id, 'hthb_notice_dismissed', 'true', true );
    }

}


function hashbar_wpnb_checkbox_render(  ) { 

	$options = get_option( 'hashbar_wpnb_opt' );
	$checkbox_val = isset($options['dont_show_bar_after_close']) ? $options['dont_show_bar_after_close'] : '';
	?>
	<input class="pro" type='checkbox' name='hashbar_wpnb_opt[dont_show_bar_after_close]'  <?php checked($checkbox_val, 1) ?> value='1'>
	<p class="description"><?php echo esc_html__('If check this option. The notification will not appear again on a page, after closing the notification.', 'hashbar-wp-notification-bar');?></p>
	<?php

}

function hashbar_wpnb_bar_closed_checkbox_render(){
	$options = get_option( 'hashbar_wpnb_opt' );
	$checkbox_val = isset($options['keep_closed_bar']) ? $options['keep_closed_bar'] : '';
	?>
	<input type='checkbox' name='hashbar_wpnb_opt[keep_closed_bar]'  <?php checked($checkbox_val, 1) ?> value='1'>
	<p class="description"><?php echo esc_html__( 'When you close the notification bar once then it will always keep closed in all pages of your site.<br>This option will be effective for the notifications which have set "Load as minimized = No" from the notification metabox options.','hashbar-wp-notification-bar' ); ?></p>
	<?php
}

function hashbar_wpnb_analytics_checkbox_render(){
	$options = get_option( 'hashbar_wpnb_opt' );
	$checkbox_val = isset($options['enable_analytics']) ? $options['enable_analytics'] : '';
	?>
	<input type='checkbox' name='hashbar_wpnb_opt[enable_analytics]'  <?php checked($checkbox_val, 1) ?> value='1'>
	<p class="description"><?php echo esc_html__('Enable Analytics to get the analytical report about your notifications.', 'hashbar-wp-notification-bar');?></p>
	<?php
}

function hashbar_wpnb_count_onece_byip_checkbox_render(){
	$options = get_option( 'hashbar_wpnb_opt' );
	$checkbox_val = isset($options['count_onece_byip']) ? $options['count_onece_byip'] : '';
	?>
	<input type='checkbox' name='hashbar_wpnb_opt[count_onece_byip]'  <?php checked($checkbox_val, 1) ?> value='1'>
	<p class="description"><?php echo esc_html__('Enable to count the views and clicks only once from each IP-address.', 'hashbar-wp-notification-bar');?></p>
	<?php
}

function hashbar_wpnb_analytics_from_options_render(){
	$options = get_option( 'hashbar_wpnb_opt' );
	$checkbox_val = isset($options['analytics_from']) ? $options['analytics_from'] : '';
	?>
	<select name="hashbar_wpnb_opt[analytics_from]">
	  <option value="everyone" <?php echo $checkbox_val == 'everyone' ? 'selected' : ''; ?>><?php echo esc_html__('Everyone', 'hashbar-wp-notification-bar') ?></option>
	  <option value="guests" <?php echo $checkbox_val == 'guests' ? 'selected' : ''; ?>><?php echo esc_html__('Guest Users Only', 'hashbar-wp-notification-bar') ?></option>
	  <option value="registered_users" <?php echo $checkbox_val == 'registered_users' ? 'selected' : ''; ?>><?php echo esc_html__('Rigestered Users Only', 'hashbar-wp-notification-bar') ?></option>
	</select>
	<?php
}

function hashbar_wpnb_text_render(  ) {

	$options = get_option( 'hashbar_wpnb_opt' );
	$text_val = isset($options['mobile_device_breakpoint']) ? $options['mobile_device_breakpoint'] : '';
	?>
	<input type='text' name='hashbar_wpnb_opt[mobile_device_breakpoint]' value="<?php echo esc_attr($text_val); ?>">
	<p class="description">Sets the breakpoint between mobile and desktop devices. Below this breakpoint mobile layout will appear (Default: 767).</p>
	<?php

}

function hashbar_cookies_expire_time_render(  ) {
	$options = get_option( 'hashbar_wpnb_opt' );
	$cookies_expire_time = isset($options['cookies_expire_time']) ? $options['cookies_expire_time'] : 7;
	$cookies_expire_type = isset($options['cookies_expire_type']) ? $options['cookies_expire_type'] : 'days';
	?>
	<input type='number' name='hashbar_wpnb_opt[cookies_expire_time]' value="<?php echo esc_attr($cookies_expire_time); ?>" min="0" style="width: 87px;">
	<select name="hashbar_wpnb_opt[cookies_expire_type]">
		<option value="days" <?php echo $cookies_expire_type == 'days' ? 'selected' : ''; ?>>Days</option>
		<option value="hours" <?php echo $cookies_expire_type == 'hours' ? 'selected' : ''; ?>>Hours</option>
		<option value="minutes" <?php echo $cookies_expire_type == 'minutes' ? 'selected' : ''; ?>>Minutes</option>
	</select>
	<p class="description">Specify the duration of the expiration time for the cookie when a user closes the notification bar. <br> After the expiration time has passed, the notification will reappear for that user. (Default: 7 Days).</p>
	<?php
}

function hashbar_wpnb_options_page(  ) { 

	?>
	<div class="wrap">
		<?php do_action('hashbar_admin_notices') ?>
		<form id="hashbar" action='options.php' method='post'>

			<h2><?php echo esc_html__( 'HashBar Global Options', 'hashbar-wp-notification-bar' ) ?></h2>

			<?php
			settings_fields( 'options_group_1' );
			do_settings_sections( 'options_group_1' );
			submit_button();
			?>
		</form>
	</div>
	<?php

}
function hashbar_wpnb_analytics_page(){
	$total_traking 		= false != get_transient( 'total_ht_traking_count' ) ? get_transient( 'total_ht_traking_count' ) : array();
	$postwise_traking   = false != get_transient( 'postwise_ht_traking_count' ) ? get_transient( 'postwise_ht_traking_count' ) : array(); 
	$country_traking    = false != get_transient( 'countrywise_ht_traking_count' ) ? get_transient( 'countrywise_ht_traking_count' ) : array();

	$trk_lenght   = count($total_traking);
	$total_clicks = $trk_lenght > 0 ? $total_traking[0]['totalclicks'] : 0;
	$total_views  = $trk_lenght > 0 ? $total_traking[0]['totalviews'] : 0;
	$total_clthrt = ( $trk_lenght > 0 && $total_traking[0]['totalviews'] > 0 ) ? round(($total_traking[0]['totalclicks']/$total_traking[0]['totalviews'])*100, 2) : 0;

	?>
	<div class="hthb--site-wrapper-reveal">
	    <div class="hthb--container">
	    	<div class="hthb-analytics-title">
    			<h2><?php echo esc_html__( 'Analytics Overview','hashbar-wp-notification-bar'); ?></h2>
    		</div>
	        <div class="hthb--row">
	            <div class="hthb--col-lg-4 hthb--col-md-4 hthb--col-sm-6 ">
	                <div class="hthb-card__box">
	                    <div class="hthb-card__icon">
	                        <img src="<?php echo esc_url( HASHBAR_WPNB_URI . '/admin/img/click-icons.png')?>" alt="Click">
	                    </div>
	                    <div class="hthb-card__content">
	                        <h6 class="hthb-card__title"><?php echo esc_html__( 'Total Clicks','hashbar-wp-notification-bar') ?></h6>
	                        <h4 class="hthb-card__nubmer"><?php echo esc_html( $total_clicks ); ?></h4>
	                    </div>
	                    <div class="hthb-card__inner-image">
	                        <img src="<?php echo esc_url( HASHBAR_WPNB_URI . '/admin/img/views-icons-bg.png')?>" alt="icon">
	                    </div>
	                </div>
	            </div>
	            <div class="hthb--col-lg-4 hthb--col-md-4 hthb--col-sm-6 ">
	                <div class="hthb-card__box hthb-card__box--two">
	                    <div class="hthb-card__icon hthb-card__icon--two">
	                        <img src="<?php echo esc_url( HASHBAR_WPNB_URI . '/admin/img/views-icons.png')?>" alt="icon">
	                    </div>
	                    <div class="hthb-card__content">
	                        <h6 class="hthb-card__title"><?php echo esc_html__( 'Total Views','hashbar-wp-notification-bar') ?></h6>
	                        <h4 class="hthb-card__nubmer hthb-card__nubmer--two"><?php echo esc_html( $total_views ); ?></h4>
	                    </div>
	                    <div class="hthb-card__inner-image">
	                        <img src="<?php echo esc_url( HASHBAR_WPNB_URI . '/admin/img/click-icons-bg.png')?>" alt="icon">

	                    </div>
	                </div>
	            </div>
	            <div class="hthb--col-lg-4 hthb--col-md-4 hthb--col-sm-6 ">
	                <div class="hthb-card__box hthb-card__box--three">
	                    <div class="hthb-card__icon hthb-card__icon--three">
	                        <img src="<?php echo esc_url( HASHBAR_WPNB_URI . '/admin/img/rate-icons.png')?>" alt="icon">
	                    </div>
	                    <div class="hthb-card__content">
	                        <h6 class="hthb-card__title"><?php echo esc_html__( 'Click Through Rate','hashbar-wp-notification-bar') ?></h6>
	                        <h4 class="hthb-card__nubmer hthb-card__nubmer--three"><?php echo esc_html( $total_clthrt ); ?>%</h4>
	                    </div>
	                    <div class="hthb-card__inner-image">
	                        <img src="<?php echo esc_url( HASHBAR_WPNB_URI . '/admin/img/rate-icons-bg.png')?>" alt="icon">
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

	<div class="hthb-traking-by-notification-area">
	    <div class="hthb--container">
	        <div class="hthb--row">
	            <div class="hthb--col-lg-8">
	                <div class="hthb-traking">
	                    <h6 class="hthb-traking__heading"><?php echo esc_html__( 'Traking By Notification Bars','hashbar-wp-notification-bar') ?></h6>

	                    <div class="hthb-traking__wrap">
	                        <div class="hthb-traking__header">
	                            <div class="hthb-traking__header-item hthb-traking__header-item--name">
	                                <?php echo esc_html__( 'Name','hashbar-wp-notification-bar'); ?>
	                            </div>
	                            <div class="hthb-traking__header-item hthb-traking__header-item--views">
	                                <?php echo esc_html__( 'Total Views','hashbar-wp-notification-bar'); ?>
	                            </div>
	                            <div class="hthb-traking__header-item hthb-traking__header-item--clicks">
	                                <?php echo esc_html__( 'Total Clicks','hashbar-wp-notification-bar'); ?>
	                            </div>
	                            <div class="hthb-traking__header-item hthb-traking__header-item--through-rate">
	                                <?php echo esc_html__( 'Through Rate','hashbar-wp-notification-bar'); ?>
	                            </div>
	                        </div>
	                        <div class="hthb-traking__body">
	                        	<?php foreach ($postwise_traking as $postwise_count):?>
	                        		<?php if('publish' == get_post_status($postwise_count['post_id'])): ?>
			                            <div class="hthb-traking__items">
			                                <div class="hthb-traking__item hthb-traking__item--title">
			                                    <?php echo esc_html( get_the_title($postwise_count['post_id']) ); ?>
			                                </div>
			                                <div class="hthb-traking__item hthb-traking__item--total-views-number">
			                                    <?php echo esc_html( $postwise_count['totalviews'] ); ?>
			                                </div>
			                                <div class="hthb-traking__item hthb-traking__item--total-clicks-number">
			                                    <?php echo esc_html( $postwise_count['totalclicks'] ); ?>
			                                </div>
			                                <div class="hthb-traking__item hthb-traking__item--through-rate-numbmer">
			                                    <?php echo esc_html( $postwise_count['totalviews'] > 0 ? round(($postwise_count['totalclicks']/$postwise_count['totalviews'])*100, 2) : 0 ); ?> %
			                                </div>
			                            </div>
			                        <?php endif; ?>
		                        <?php endforeach; ?>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="hthb--col-lg-4 ">
	                <div class="hthb-top-countries">
	                    <h6 class="hthb-top-countries__heading"><?php echo esc_html__( 'Top 10 Countries','hashbar-wp-notification-bar') ?></h6>
	                    <?php foreach ($country_traking as $countrywise_count):?>
		                    <div class="hthb-top-countries__list-wrap">
		                        <div class="hthb-top-countries__item">
		                            <div class="hthb-top-countries__name"><?php echo esc_html( $countrywise_count['country'] ); ?></div>
		                        </div>
		                    </div>
		                <?php endforeach; ?>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<?php
}

?>