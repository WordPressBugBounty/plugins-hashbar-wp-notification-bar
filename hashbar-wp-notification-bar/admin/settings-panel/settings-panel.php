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

    /**
     * Check if Vite dev server is running
     */
    private function is_dev_server_running() {
        $dev_server_url = 'http://localhost:5173/@vite/client';
        $context = stream_context_create([
            'http' => [
                'timeout' => 0.5,
                'ignore_errors' => true
            ]
        ]);
        $response = @file_get_contents($dev_server_url, false, $context);
        return $response !== false;
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
            $submenu[ $slug ][] = array( esc_html__( 'Dashboard', 'hashbar' ), $capability, 'admin.php?page=' . $slug . $default_hash );
            $submenu[ $slug ][] = array( esc_html__( 'Announcement Bar', 'hashbar' ), $capability, 'admin.php?page=' . $slug .'#/announcement-bar' );
            $submenu[ $slug ][] = array( esc_html__( 'Popup Campaign', 'hashbar' ), $capability, 'admin.php?page=' . $slug .'#/popup-campaign' );
            $submenu[ $slug ][] = array( esc_html__( 'Notification Bar', 'hashbar' ), $capability, 'admin.php?page=' . $slug .'#/notifications' );
            $submenu[ $slug ][] = array( esc_html__( 'Settings', 'hashbar' ), $capability, 'admin.php?page=' . $slug .'#/settings' );
            $submenu[ $slug ][] = array( esc_html__( 'Analytics', 'hashbar' ), $capability, 'admin.php?page=' . $slug . '#/analytics' );
            $submenu[ $slug ][] = array( esc_html__( 'Recommended', 'hashbar' ), $capability, 'admin.php?page=' . $slug . '#/recommended' );
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

        // Enqueue WordPress media library for image uploads
        wp_enqueue_media();

        // Enqueue WordPress editor scripts for TinyMCE
        wp_enqueue_editor();

        // Check if we should use dev server (SCRIPT_DEBUG enabled and dev server running)
        $use_dev_server = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG && $this->is_dev_server_running();

        if ($use_dev_server) {
            // Development mode: Load from Vite dev server with HMR
            // Add React Refresh preamble in head
            add_action('admin_head', function() {
                echo '<script type="module">
                    import RefreshRuntime from "http://localhost:5173/@react-refresh"
                    RefreshRuntime.injectIntoGlobalHook(window)
                    window.$RefreshReg$ = () => {}
                    window.$RefreshSig$ = () => (type) => type
                    window.__vite_plugin_react_preamble_installed__ = true
                </script>';
            });

            wp_enqueue_script(
                'hashbar-vite-client',
                'http://localhost:5173/@vite/client',
                array(),
                null,
                false // Load in head
            );
            wp_enqueue_script(
                'hashbar-settings-panel',
                'http://localhost:5173/src/main.jsx',
                array('hashbar-vite-client'),
                null,
                true
            );
        } else {
            // Production mode: Load built assets
            wp_enqueue_style(
                'hashbar-settings-panel',
                HASHBAR_WPNB_URI . '/admin/settings-panel/assets/dist/css/style.css',
                array(),
                HASHBAR_WPNB_VERSION
            );
            wp_enqueue_script(
                'hashbar-settings-panel',
                HASHBAR_WPNB_URI . '/admin/settings-panel/assets/dist/js/main.js',
                array(),
                HASHBAR_WPNB_VERSION,
                true
            );
        }

        // Localize script with nonces and other data
        wp_localize_script('hashbar-settings-panel', 'hashbarOptions', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'licenseNonce' => wp_create_nonce('hashbar_license_nonce'),
            'restNonce' => wp_create_nonce('wp_rest')
        ));

        add_filter('script_loader_tag', function($tag, $handle, $src) {
            if ($handle === 'hashbar-settings-panel' || $handle === 'hashbar-vite-client') {
                return '<script type="module" src="' . esc_url($src) . '"></script>';
            }
            return $tag;
        }, 10, 3);

        $admin_settings = Hashbar_Settings_Panel_Settings::get_instance();

        // Load announcement bar settings
        require_once dirname( __FILE__ ) . '/api/announcement-bar-settings.php';
        $ab_settings = new Hashbar_Announcement_Bar_Settings();

        // Load popup campaign settings
        require_once dirname( __FILE__ ) . '/api/popup-campaign-settings.php';
        $popup_settings = new Hashbar_Popup_Campaign_Settings();

        // Calculate site timezone offset for JavaScript
        $site_timezone = wp_timezone();
        $now = new DateTime( 'now', $site_timezone );
        $site_timezone_offset = $now->getOffset() / 3600; // Convert seconds to hours

        $localize_data = [
            'ajaxurl'          => admin_url( 'admin-ajax.php' ),
            'adminURL'         => admin_url(),
            'pluginURL'        => plugin_dir_url( __FILE__ ),
            'assetsURL'        => plugin_dir_url( __FILE__ ) . 'assets/',
            'restUrl' => rest_url(),  // This will include the wp-json prefix
            'nonce' => wp_create_nonce('wp_rest'),
            'siteTimezoneOffset' => $site_timezone_offset,
            'licenseNonce'  => wp_create_nonce( 'el-license' ),
            'licenseEmail'  => get_option( 'HashbarPro_lic_email', get_bloginfo( 'admin_email' ) ),
            'message'          =>[
                'packagedesc'=> esc_html__( 'in this package', 'hashbar' ),
                'allload'    => esc_html__( 'All Items have been Loaded', 'hashbar' ),
                'notfound'   => esc_html__( 'Nothing Found', 'hashbar' ),
                'errorLoadingStats' => esc_html__( 'Error Loading Statistics', 'hashbar' ),
                'noStatsAvailable' => esc_html__( 'No Statistics Available', 'hashbar' ),
                'startAbTest' => esc_html__( 'Start your A/B test to see statistics here.', 'hashbar' ),
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
                'refresh'    => esc_html__( 'Refresh', 'hashbar' ),
                'retry'      => esc_html__( 'Retry', 'hashbar' ),
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
                'videoLink' => 'https://www.youtube.com/watch?v=9VUc5Is-9Uw',
                'supportLink' => 'https://hasthemes.com/contact-us/',
                'upgradeLink' => 'https://hasthemes.com/plugins/wordpress-notification-bar-plugin/?utm_source=admin&utm_medium=mainmenu&utm_campaign=free#pricing',
                'licenseLink' => 'https://hasthemes.com/plugins/wordpress-notification-bar-plugin/?utm_source=admin&utm_medium=mainmenu&utm_campaign=free#pricing',
                'recommendedPluginsLink' => 'https://hasthemes.com/plugins/',
            ],
            'adminSettings' => [
                'modal_settings_fields' => $admin_settings->get_modal_settings_fields(),
                'is_pro' => Hashbar_Popup_Campaign_Settings::is_pro(),
                'labels_texts' => $admin_settings->get_labels_texts(),
                'dashboard_settings' => $admin_settings->get_dashboard_settings(),
                'menu_settings' => $admin_settings->get_menu_settings(),
                'recommendations_plugins' => $admin_settings->get_recommendations_plugins(),
                'notification_enable_fields' => $admin_settings->get_notification_enable_fields(),
                'hashbar_wpnb_opt' => get_option('hashbar_wpnb_opt') ? get_option('hashbar_wpnb_opt') : [],
            ],
            'announcementBarSettings' => [
                'tabs' => $ab_settings->get_editor_tabs(),
                'fields' => [
                    'content' => $ab_settings->get_content_fields(),
                    'design' => $ab_settings->get_design_fields(),
                    'position' => $ab_settings->get_position_fields(),
                    'targeting' => $ab_settings->get_targeting_fields(),
                    'countdown' => $ab_settings->get_countdown_fields(),
                    'coupon' => $ab_settings->get_coupon_fields(),
                    'schedule' => $ab_settings->get_schedule_fields(),
                    'animation' => $ab_settings->get_animation_fields(),
                    'ab-test' => $ab_settings->get_abtest_fields(),
                ],
                'templates' => $ab_settings->get_templates(),
                'labels' => $ab_settings->get_labels(),
                'is_pro' => Hashbar_Announcement_Bar_Settings::is_pro(),
            ],
            'popupCampaignSettings' => [
                'tabs' => Hashbar_Popup_Campaign_Settings::get_editor_tabs(),
                'fields' => $popup_settings->get_all_fields(),
                'templates' => $popup_settings->get_templates(),
                'labels' => $popup_settings->get_labels(),
                'formPluginInfo' => Hashbar_Popup_Campaign_Settings::get_form_plugin_info(),
                'is_pro' => Hashbar_Popup_Campaign_Settings::is_pro(),
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