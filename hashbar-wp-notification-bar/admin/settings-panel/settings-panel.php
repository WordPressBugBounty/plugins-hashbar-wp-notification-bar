<?php

// If this file is accessed directly, exit.
if (!defined('ABSPATH')) {
    exit;
}

class Hashbar_Settiigs_Panel {
    
    private static $_instance = null;
    
    public static function get_instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    private function __construct() {
        add_action('admin_menu', array($this, 'add_vue_builder_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_vue_builder_assets'));
        add_action('admin_footer', array($this, 'hashbar_wpnb_enqueue_admin_head_scripts'));


        // dismiss the admin notice for user
        $user_id = get_current_user_id();
        if ( isset( $_GET['hthb-notice-dismissed'] ) ){ // phpcs:ignore
            add_user_meta( $user_id, 'hthb_notice_dismissed', 'true', true );
        }
    }
    
    public function add_vue_builder_menu() {

        global $submenu;

        $slug        = 'hashbar';
        $capability  = 'manage_options';

        $hook = add_menu_page(
            esc_html__( 'HashBars', 'hashbar' ),
            esc_html__( 'HashBar', 'hashbar' ),
            $capability,
            $slug,
            [ $this, 'settings_page_render' ],
            'dashicons-format-status',
            5
        );

        if ( current_user_can( $capability ) ) {
            $default_hash = '#/';
            $submenu[ $slug ][] = array( esc_html__( 'Dashboard', 'htmega-addons' ), $capability, 'admin.php?page=' . $slug . $default_hash );
            $submenu[ $slug ][] = array( esc_html__( 'All Notifications', 'htmega-addons' ), $capability, 'admin.php?page=' . $slug .'#/notifications' );
            $submenu[ $slug ][] = array( esc_html__( 'Settings', 'htmega-addons' ), $capability, 'admin.php?page=' . $slug .'#/settings' );
            $submenu[ $slug ][] = array( esc_html__( 'Analytics', 'htmega-addons' ), $capability, 'admin.php?page=' . $slug . '#/analytics' );
            $submenu[ $slug ][] = array( esc_html__( ' Recommended', 'htmega-addons' ), $capability, 'admin.php?page=' . $slug . '#/recommended' );
        }

        if( !is_plugin_active('hashbar-pro/init.php') ){
            add_submenu_page(
                'hashbar', 
                __('Upgrade to Pro', 'hashbar'),
                __('Upgrade to Pro', 'hashbar'), 
                'manage_options', 
                'https://hasthemes.com/wordpress-notification-bar-plugin/?utm_source=admin&utm_medium=mainmenu&utm_campaign=free#hasbar-price'
            );
        }
    }

    public  function hashbar_wpnb_enqueue_admin_head_scripts() {
        printf( '<style>%s</style>', '#adminmenu #toplevel_page_hashbar a.hashbar-upgrade-pro { font-weight: 600; background-color: #ff6e30; color: #ffffff; text-align: left; margin-top: 3px; }' );
        printf( '<script>%s</script>', '(function ($) {
            $("#toplevel_page_hashbar .wp-submenu a").each(function() {
                if($(this)[0].href === "https://hasthemes.com/wordpress-notification-bar-plugin/?utm_source=admin&utm_medium=mainmenu&utm_campaign=free#hasbar-price") {
                    $(this).addClass("hashbar-upgrade-pro").attr("target", "_blank");
                }
            })
        })(jQuery);' );
    }
    
    public function enqueue_vue_builder_assets($hook) {
        if ($hook !== 'toplevel_page_hashbar') {
            return;
        }
        
        // Vue Builder CSS
        wp_enqueue_style(
            'hashbar-settings-panel',
            HASHBAR_WPNB_URI . '/admin/settings-panel/assets/dist/css/style.css',
            array(),
            HASHBAR_WPNB_VERSION
        );
        
        // Vue Builder JavaScript - Load after Vue and Fabric
        wp_enqueue_script(
            'hashbar-settings-panel',
            HASHBAR_WPNB_URI . '/admin/settings-panel/assets/dist/js/main.js',
            array(),
            HASHBAR_WPNB_VERSION,
            true // Load in footer
        );

        // Localize script with nonces and other data
        wp_localize_script('hashbar-settings-panel', 'hashbarOptions', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'licenseNonce' => wp_create_nonce('hashbar_license_nonce'),
            'restNonce' => wp_create_nonce('wp_rest')
        ));

        add_filter('script_loader_tag', function($tag, $handle, $src) {
            if ($handle === 'hashbar-settings-panel') {
                return '<script type="module" src="' . esc_url($src) . '"></script>';
            }
            return $tag;
        }, 10, 3);

        $admin_settings = Hashbar_Settings_Panel_Settings::get_instance();
        $localize_data = [
            'ajaxurl'          => admin_url( 'admin-ajax.php' ),
            'adminURL'         => admin_url(),
            'pluginURL'        => plugin_dir_url( __FILE__ ),
            'assetsURL'        => plugin_dir_url( __FILE__ ) . 'assets/',
            'restUrl' => rest_url(),  // This will include the wp-json prefix
            'nonce' => wp_create_nonce('wp_rest'),
            'licenseNonce'  => wp_create_nonce( 'el-license' ),
            'licenseEmail'  => get_option( 'HashbarPro_lic_email', get_bloginfo( 'admin_email' ) ),
            'message'          =>[
                'packagedesc'=> esc_html__( 'in this package', 'hashbar' ),
                'allload'    => esc_html__( 'All Items have been Loaded', 'hashbar' ),
                'notfound'   => esc_html__( 'Nothing Found', 'hashbar' ),
            ],
            'buttontxt'      =>[
                'tmplibrary' => esc_html__( 'Import to Library', 'hashbar' ),
                'tmppage'    => esc_html__( 'Import to Page', 'hashbar' ),
                'import'     => esc_html__( 'Import', 'hashbar' ),
                'buynow'     => esc_html__( 'Buy Now', 'hashbar' ),
                'buynow_link' => 'https://hasthemes.com/plugins/hashbar-pro/?utm_source=admin&utm_medium=mainmenu&utm_campaign=free#pricing',
                'preview'    => esc_html__( 'Preview', 'hashbar' ),
                'installing' => esc_html__( 'Installing..', 'hashbar' ),
                'activating' => esc_html__( 'Activating..', 'hashbar' ),
                'active'     => esc_html__( 'Active', 'hashbar' ),
                'pro' => __( 'Pro', 'hashbar' ),
                'modal' => [
                    'title' => __( 'BUY PRO', 'hashbar' ),
                    'desc' => __( 'Our free version is great, but it doesn\'t have all our advanced features. The best way to unlock all of the features in our plugin is by purchasing the pro version.', 'hashbar' )
                ],
            ],
            'existingData' => get_option('hashbar_options'),
            'helpSection' => [
                'title' => esc_html__('Need Help with Hashbar?', 'hashbar'),
                'description' => esc_html__('Our comprehensive documentation provides detailed information on how to use Hashbar effectively to improve your websites performance.', 'hashbar'),
                'documentation' => esc_html__('Documentation', 'hashbar'),
                'videoTutorial' => esc_html__('Video Tutorial', 'hashbar'),
                'support' => esc_html__('Support', 'hashbar'),
                'docLink' => 'https://hasthemes.com/docs/hashbar/',
                'videoLink' => 'https://www.youtube.com/watch?v=sBmDMjYshpc',
                'supportLink' => 'https://hasthemes.com/contact-us/',
                'upgradeLink' => 'https://hasthemes.com/plugins/wordpress-notification-bar-plugin/?utm_source=admin&utm_medium=mainmenu&utm_campaign=free#pricing',
                'licenseLink' => 'https://hasthemes.com/plugins/wordpress-notification-bar-plugin/?utm_source=admin&utm_medium=mainmenu&utm_campaign=free#pricing',
                'recommendedPluginsLink' => 'https://hasthemes.com/plugins/',
            ],
            'adminSettings' => [
                'modal_settings_fields' => $admin_settings->get_modal_settings_fields(),
                'is_pro' => $admin_settings->is_pro(),
                'labels_texts' => $admin_settings->get_labels_texts(),
                'dashboard_settings' => $admin_settings->get_dashboard_settings(),
                'menu_settings' => $admin_settings->get_menu_settings(),
                'recommendations_plugins' => $admin_settings->get_recommendations_plugins(),
                'notification_enable_fields' => $admin_settings->get_notification_enable_fields(),
                'hashbar_wpnb_opt' => get_option('hashbar_wpnb_opt') ? get_option('hashbar_wpnb_opt') : [],
            ],
        ];
        wp_localize_script( 'hashbar-settings-panel', 'HashbarSettingsLocalize', $localize_data );
    }
    


	/**
	 * Page Render Contents
	 * @return void
	 */
	public function settings_page_render () {
		// check user capabilities
		if ( !current_user_can( 'manage_options' ) ) {
			return;
		}?>
        <?php do_action('hashbar_admin_notices') ?>
        <!-- // Render Vue app container -->
        <div id="hashbar-app"></div>
        <?php
        
	}    
}

// Initialize Vue Builder
add_action('init', function() {
    if (is_admin()) {
        Hashbar_Settiigs_Panel::get_instance();
    }
});