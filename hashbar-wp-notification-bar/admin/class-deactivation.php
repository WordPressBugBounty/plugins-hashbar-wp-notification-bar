<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Hashbar_Plugin_Deactivation_Feedback {

    public $PROJECT_NAME = 'Hashbar';
    public $PROJECT_TYPE = 'wordpress-plugin';
    public $PROJECT_VERSION = HASHBAR_WPNB_VERSION;
    public $PROJECT_SLUG = 'hashbar-wp-notification-bar'; // Without plugin main file.
    public $PROJECT_PRO_SLUG = 'hashbar-pro/init.php';
    public $PROJECT_PRO_ACTIVE;
    public $PROJECT_PRO_INSTALL;
    public $PROJECT_PRO_VERSION;
    public $DATA_CENTER = 'https://exit-feedback.hasthemes.com/w/f1d55c05-342f-4de2-a552-52990e2d1455';
    public $WEBHOOK_SECRET = 'c7b7355679cbdbe1c86174c9422ff44ce6f0524f86c01a59a251529404d56190';

    private static $_instance = null;

    public static function instance(){
        if( is_null( self::$_instance ) ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        $this->PROJECT_PRO_ACTIVE = $this->is_pro_plugin_active();
        $this->PROJECT_PRO_INSTALL = $this->is_pro_plugin_installed();
        $this->PROJECT_PRO_VERSION = $this->get_pro_version();
        add_action('admin_footer', [ $this, 'deactivation_feedback' ]);
        add_action('wp_ajax_hashbar_plugin_deactivation_feedback', [ $this, 'handle_feedback' ]);
    }

    /**
     * Handle AJAX feedback submission
     */
    public function handle_feedback() {
        if ( !check_ajax_referer('hashbar_deactivation', 'nonce', false) ) {
            wp_send_json_error('Invalid nonce');
            return;
        }

        if(!current_user_can( 'administrator' )) {
            wp_send_json_error('Permission denied');
            return;
        }

        $reason = sanitize_text_field($_POST['reason']);
        $message = sanitize_textarea_field($_POST['message']);

        $data = array_merge(
            [
                'deactivate_reason' => $reason,
                'deactivate_message' => $message,
            ],
            $this->get_data(),
        );

        $body = wp_json_encode( $data );

        $site_url = wp_parse_url( home_url(), PHP_URL_HOST );
        $headers = [
            'user-agent'   => $this->PROJECT_NAME . '/' . md5( $site_url ) . ';',
            'Content-Type' => 'application/json',
        ];

        $signature = $this->generate_signature( $body );
        if ( ! empty( $signature ) ) {
            $headers['X-Webhook-Signature'] = $signature;
        }

        $response = wp_remote_post($this->DATA_CENTER, [
            'method'      => 'POST',
            'timeout'     => 30,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => false,
            'sslverify'   => false,
            'headers'     => $headers,
            'body'        => $body,
            'cookies'     => []
        ]);

        if (!is_wp_error($response)) {
            wp_send_json_success('Feedback submitted successfully');
        } else {
            wp_send_json_error('Failed to submit feedback: ' . $response->get_error_message());
        }
    }

    public function get_data() {
        $hash = md5( current_time( 'U', true ) );

        // Get plugin specific information
        $project = [
            'name'          => $this->PROJECT_NAME,
            'type'          => $this->PROJECT_TYPE,
            'version'       => $this->PROJECT_VERSION,
            'pro_active'    => $this->PROJECT_PRO_ACTIVE,
            'pro_installed' => $this->PROJECT_PRO_INSTALL,
            'pro_version'   => $this->PROJECT_PRO_VERSION,
        ];

        $site_title = get_bloginfo( 'name' );
        $site_description = get_bloginfo( 'description' );
        $site_url = wp_parse_url( home_url(), PHP_URL_HOST );
        $admin_email = get_option( 'admin_email' );

        $admin_first_name = '';
        $admin_last_name = '';
        $admin_display_name = '';

        $users = get_users( array(
            'role'    => 'administrator',
            'orderby' => 'ID',
            'order'   => 'ASC',
            'number'  => 1,
            'paged'   => 1,
        ) );

        $admin_user = ( is_array ( $users ) && isset ( $users[0] ) && is_object ( $users[0] ) ) ? $users[0] : null;

        if ( ! empty( $admin_user ) ) {
            $admin_first_name = ( isset( $admin_user->first_name ) ? $admin_user->first_name : '' );
            $admin_last_name = ( isset( $admin_user->last_name ) ? $admin_user->last_name : '' );
            $admin_display_name = ( isset( $admin_user->display_name ) ? $admin_user->display_name : '' );
        }

        $ip_address = $this->get_ip_address();

        $data = [
            'hash'    => $hash,
            'project' => $project,
            'site_title'         => $site_title,
            'site_description'   => $site_description,
            'site_address'       => $site_url,
            'site_url'           => $site_url,
            'admin_email'        => $admin_email,
            'admin_first_name'   => $admin_first_name,
            'admin_last_name'    => $admin_last_name,
            'admin_display_name' => $admin_display_name,
            'server_info'        => $this->get_server_info(),
            'wordpress_info'     => $this->get_wordpress_info(),
            'users_count'        => $this->get_users_count(),
            'plugins_count'      => $this->get_plugins_count(),
            'ip_address'         => $ip_address,
            'country_name'       => $this->get_country_from_ip( $ip_address ),
            'plugin_list'        => $this->get_active_plugins(),
            'install_time'       => get_option( 'hashbar_installed', '' ),
        ];

        return $data;
    }

    /**
     * Get server info.
     */
    private function get_server_info() {
        global $wpdb;

        $software = ( isset ( $_SERVER['SERVER_SOFTWARE'] ) && !empty ( $_SERVER['SERVER_SOFTWARE'] ) ) ? $_SERVER['SERVER_SOFTWARE'] : '';
        $php_version = function_exists ( 'phpversion' ) ? phpversion () : '';
        $mysql_version = method_exists ( $wpdb, 'db_version' ) ? $wpdb->db_version () : '';
        $php_max_upload_size = size_format( wp_max_upload_size() );
        $php_default_timezone = date_default_timezone_get();
        $php_soap = class_exists ( 'SoapClient' ) ? 'yes' : 'no';
        $php_fsockopen = function_exists ( 'fsockopen' ) ? 'yes' : 'no';
        $php_curl = function_exists ( 'curl_init' ) ? 'yes' : 'no';

        $server_info = array(
            'software'             => $software,
            'php_version'          => $php_version,
            'mysql_version'        => $mysql_version,
            'php_max_upload_size'  => $php_max_upload_size,
            'php_default_timezone' => $php_default_timezone,
            'php_soap'             => $php_soap,
            'php_fsockopen'        => $php_fsockopen,
            'php_curl'             => $php_curl,
        );

        return $server_info;
    }

    /**
     * Get wordpress info.
     */
    private function get_wordpress_info() {
        $wordpress_info = [];

        $memory_limit = defined ( 'WP_MEMORY_LIMIT' ) ? WP_MEMORY_LIMIT : '';
        $debug_mode = ( defined ( 'WP_DEBUG' ) && WP_DEBUG ) ? 'yes' : 'no';
        $locale = get_locale();
        $version = get_bloginfo( 'version' );
        $multisite = is_multisite () ? 'yes' : 'no';
        $theme_slug = get_stylesheet();

        $wordpress_info = [
            'memory_limit' => $memory_limit,
            'debug_mode'   => $debug_mode,
            'locale'       => $locale,
            'version'      => $version,
            'multisite'    => $multisite,
            'theme_slug'   => $theme_slug,
        ];

        $theme = wp_get_theme( $wordpress_info['theme_slug'] );

        if ( is_object( $theme ) && ! empty( $theme ) && method_exists( $theme, 'get' ) ) {
            $theme_name    = $theme->get( 'Name' );
            $theme_version = $theme->get( 'Version' );
            $theme_uri     = $theme->get( 'ThemeURI' );
            $theme_author  = $theme->get( 'Author' );

            $wordpress_info = array_merge( $wordpress_info, [
                'theme_name'    => $theme_name,
                'theme_version' => $theme_version,
                'theme_uri'     => $theme_uri,
                'theme_author'  => $theme_author,
            ] );
        }

        return $wordpress_info;
    }

    /**
     * Get users count.
     */
    private function get_users_count() {
        $users_count = [];

        $users_count_data = count_users();

        $total_users = isset ( $users_count_data['total_users'] ) ? $users_count_data['total_users'] : 0;
        $avail_roles = isset ( $users_count_data['avail_roles'] ) ? $users_count_data['avail_roles'] : [];

        $users_count['total'] = $total_users;

        if ( is_array( $avail_roles ) && ! empty( $avail_roles ) ) {
            foreach ( $avail_roles as $role => $count ) {
                $users_count[ $role ] = $count;
            }
        }

        return $users_count;
    }

    /**
     * Get plugins count.
     */
    private function get_plugins_count() {
        $total_plugins_count = 0;
        $active_plugins_count = 0;
        $inactive_plugins_count = 0;

        $plugins = get_plugins();
        $plugins = is_array ( $plugins ) ? $plugins : [];

        $active_plugins = get_option( 'active_plugins', [] );
        $active_plugins = is_array ( $active_plugins ) ? $active_plugins : [];

        if ( ! empty( $plugins ) ) {
            foreach ( $plugins as $key => $data ) {
                if ( in_array( $key, $active_plugins, true ) ) {
                    $active_plugins_count++;
                } else {
                    $inactive_plugins_count++;
                }

                $total_plugins_count++;
            }
        }

        $plugins_count = [
            'total'    => $total_plugins_count,
            'active'   => $active_plugins_count,
            'inactive' => $inactive_plugins_count,
        ];

        return $plugins_count;
    }

    /**
     * Get active plugins.
     */
    private function get_active_plugins() {
        $active_plugins = get_option('active_plugins');
        $all_plugins = get_plugins();
        $active_plugin_string = '';
        foreach($all_plugins as $plugin_path => $plugin) {
            if ( ! in_array($plugin_path, $active_plugins) ) {
                continue;
            }
            $active_plugin_string .= sprintf(
                "%s (v%s) - %s | ",
                $plugin['Name'],
                $plugin['Version'],
                'Active'
            );
        }
        $active_plugin_string = rtrim($active_plugin_string, ' | ');
        return $active_plugin_string;
    }

    /**
     * Get IP Address
     */
    private function get_ip_address() {
        $response = wp_remote_get( 'https://icanhazip.com/' );

        if ( is_wp_error( $response ) ) {
            return '';
        }

        $ip_address = wp_remote_retrieve_body( $response );
        $ip_address = trim( $ip_address );

        if ( ! filter_var( $ip_address, FILTER_VALIDATE_IP ) ) {
            return '';
        }

        return $ip_address;
    }

    /**
     * Get Country From IP Address
     */
    private function get_country_from_ip( $ip_address ) {
        $api_url = 'http://ip-api.com/json/' . $ip_address;

        $response = wp_remote_get( $api_url );

        if ( is_wp_error( $response ) ) {
            return 'Error';
        }

        $data = json_decode( wp_remote_retrieve_body($response) );

        if ($data && $data->status === 'success') {
            return $data->country;
        } else {
            return 'Unknown';
        }
    }

    /**
     * Generate HMAC-SHA256 signature for webhook payload.
     */
    private function generate_signature( $payload ) {
        if ( empty( $this->WEBHOOK_SECRET ) ) {
            return '';
        }
        return 'sha256=' . hash_hmac( 'sha256', $payload, $this->WEBHOOK_SECRET );
    }

    /**
     * Is pro active.
     */
    private function is_pro_plugin_active() {
        $result = is_plugin_active( $this->PROJECT_PRO_SLUG );
        $result = ( true === $result ) ? 'yes' : 'no';
        return $result;
    }

    /**
     * Is pro installed.
     */
    private function is_pro_plugin_installed() {
        $plugins = get_plugins();
        $result = isset ( $plugins[$this->PROJECT_PRO_SLUG] ) ? 'yes' : 'no';
        return $result;
    }

    /**
     * Get pro version.
     */
    private function get_pro_version() {
        $plugins = get_plugins();
        $data = ( isset ( $plugins[$this->PROJECT_PRO_SLUG] ) && is_array ( $plugins[$this->PROJECT_PRO_SLUG] ) ) ? $plugins[$this->PROJECT_PRO_SLUG] : [];
        $version = isset ( $data['Version'] ) ? sanitize_text_field ( $data['Version'] ) : '';
        return $version;
    }

    public function deactivation_feedback() {
        // Only show on plugins page
        $screen = get_current_screen();
        if ($screen->id !== 'plugins') {
            return;
        }

        $this->deactivation_form_html();
    }

    /**
     * Deactivation form html.
     */
    public function deactivation_form_html() {
        $ajaxurl = admin_url('admin-ajax.php');
        $nonce = wp_create_nonce('hashbar_deactivation');
    ?>

<div id="hashbar-deactivation-dialog" class="hashbar-deactivate-overlay" style="display: none;">
    <div class="hashbar-deactivate-modal">
        <!-- Header -->
        <div class="hashbar-deactivate-header">
            <button type="button" class="hashbar-close-btn hashbar-close-dialog" aria-label="Close">
                <svg viewBox="0 0 24 24" fill="none">
                    <path d="M18 6L6 18M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <div class="hashbar-header-content">
                <div class="hashbar-header-text">
                    <h3><?php esc_html_e("Before You Go, Can We Have a Moment?", 'hashbar') ?></h3>
                    <p><?php esc_html_e('We built HashBar with love. A small feedback from you means the world to us.', 'hashbar') ?></p>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="hashbar-deactivate-body">
            <p class="hashbar-body-title"><?php esc_html_e('Please share why you\'re deactivating HashBar:', 'hashbar') ?></p>

            <form id="hashbar-deactivation-feedback-form">
                <div class="hashbar-reasons-list">
                    <!-- Reason 1: Temporary -->
                    <div class="hashbar-reason-item">
                        <input type="radio" name="reason" id="hashbar_reason_temporary" data-id="" value="<?php esc_attr_e("It's a temporary deactivation", 'hashbar') ?>">
                        <label for="hashbar_reason_temporary" class="hashbar-reason-label">
                            <span class="hashbar-reason-radio"></span>
                            <span class="hashbar-reason-icon">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                            </span>
                            <span class="hashbar-reason-text">
                                <span><?php esc_html_e("It's a temporary deactivation", 'hashbar') ?></span>
                            </span>
                        </label>
                    </div>

                    <!-- Reason 2: No longer need -->
                    <div class="hashbar-reason-item">
                        <input type="radio" name="reason" id="hashbar_reason_no_need" data-id="" value="<?php esc_attr_e('I no longer need the plugin', 'hashbar') ?>">
                        <label for="hashbar_reason_no_need" class="hashbar-reason-label">
                            <span class="hashbar-reason-radio"></span>
                            <span class="hashbar-reason-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M18 6L6 18M6 6l12 12"/>
                                </svg>
                            </span>
                            <span class="hashbar-reason-text">
                                <span><?php esc_html_e('I no longer need the plugin', 'hashbar') ?></span>
                            </span>
                        </label>
                    </div>

                    <!-- Reason 3: Found better -->
                    <div class="hashbar-reason-item">
                        <input type="radio" name="reason" id="hashbar_reason_better" data-id="found_better" value="<?php esc_attr_e('I found a better plugin', 'hashbar') ?>">
                        <label for="hashbar_reason_better" class="hashbar-reason-label">
                            <span class="hashbar-reason-radio"></span>
                            <span class="hashbar-reason-icon">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="11" cy="11" r="8"/>
                                    <path d="M21 21l-4.35-4.35"/>
                                </svg>
                            </span>
                            <span class="hashbar-reason-text">
                                <span><?php esc_html_e('I found a better plugin', 'hashbar') ?></span>
                            </span>
                        </label>
                    </div>
                    <div id="hashbar-found_better-reason-text" class="hashbar-additional-input hashbar-deactivation-reason-input">
                        <textarea name="found_better_reason" placeholder="<?php esc_attr_e('Which plugin are you switching to? We\'d love to know...', 'hashbar') ?>"></textarea>
                    </div>

                    <!-- Reason 4: Not working -->
                    <div class="hashbar-reason-item">
                        <input type="radio" name="reason" id="hashbar_reason_not_working" data-id="stopped_working" value="<?php esc_attr_e('The plugin suddenly stopped working', 'hashbar') ?>">
                        <label for="hashbar_reason_not_working" class="hashbar-reason-label">
                            <span class="hashbar-reason-radio"></span>
                            <span class="hashbar-reason-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                                    <line x1="12" y1="9" x2="12" y2="13"/>
                                    <line x1="12" y1="17" x2="12.01" y2="17"/>
                                </svg>
                            </span>
                            <span class="hashbar-reason-text">
                                <span><?php esc_html_e('The plugin suddenly stopped working', 'hashbar') ?></span>
                            </span>
                        </label>
                    </div>
                    <div id="hashbar-stopped_working-reason-text" class="hashbar-additional-input hashbar-deactivation-reason-input">
                        <textarea name="stopped_working_reason" placeholder="<?php esc_attr_e('Please describe the issue you\'re experiencing...', 'hashbar') ?>"></textarea>
                    </div>

                    <!-- Reason 5: Bug -->
                    <div class="hashbar-reason-item">
                        <input type="radio" name="reason" id="hashbar_reason_bug" data-id="found_bug" value="<?php esc_attr_e('I encountered an error or bug', 'hashbar') ?>">
                        <label for="hashbar_reason_bug" class="hashbar-reason-label">
                            <span class="hashbar-reason-radio"></span>
                            <span class="hashbar-reason-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M14.7 6.3a1 1 0 000 1.4l1.6 1.6a1 1 0 001.4 0l3.77-3.77a6 6 0 01-7.94 7.94l-6.91 6.91a2.12 2.12 0 01-3-3l6.91-6.91a6 6 0 017.94-7.94l-3.76 3.76z"/>
                                </svg>
                            </span>
                            <span class="hashbar-reason-text">
                                <span><?php esc_html_e('I encountered an error or bug', 'hashbar') ?></span>
                            </span>
                        </label>
                    </div>
                    <div id="hashbar-found_bug-reason-text" class="hashbar-additional-input hashbar-deactivation-reason-input">
                        <textarea name="found_bug_reason" placeholder="<?php esc_attr_e('Please describe the error/bug. This will help us fix it...', 'hashbar') ?>"></textarea>
                    </div>

                    <!-- Reason 6: Other -->
                    <div class="hashbar-reason-item">
                        <input type="radio" name="reason" id="hashbar_reason_other" data-id="other" value="<?php esc_attr_e('Other', 'hashbar') ?>">
                        <label for="hashbar_reason_other" class="hashbar-reason-label">
                            <span class="hashbar-reason-radio"></span>
                            <span class="hashbar-reason-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/>
                                </svg>
                            </span>
                            <span class="hashbar-reason-text">
                                <span><?php esc_html_e('Other', 'hashbar') ?></span>
                            </span>
                        </label>
                    </div>
                    <div id="hashbar-other-reason-text" class="hashbar-additional-input hashbar-deactivation-reason-input">
                        <textarea name="other_reason" placeholder="<?php esc_attr_e('Please share the reason...', 'hashbar') ?>"></textarea>
                    </div>
                </div>

                <!-- Footer -->
                <div class="hashbar-deactivate-footer">
                    <a href="#" class="hashbar-btn hashbar-btn-skip hashbar-skip-feedback"><?php esc_html_e('Skip & Deactivate', 'hashbar') ?></a>
                    <button type="submit" class="hashbar-btn hashbar-btn-submit">
                        <span><?php esc_html_e('Submit & Deactivate', 'hashbar') ?></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    ;jQuery(document).ready(function($) {
        let pluginToDeactivate = '';

        function closeDialog() {
            $('#hashbar-deactivation-dialog').animate({
                opacity: 0
            }, 'slow', function() {
                $(this).css('display', 'none');
            });
            pluginToDeactivate = '';
        }

        // Open dialog when deactivate is clicked
        $('[data-slug="<?php echo esc_attr($this->PROJECT_SLUG); ?>"] .deactivate a').on('click', function(e) {
            e.preventDefault();
            pluginToDeactivate = $(this).attr('href');
            $('#hashbar-deactivation-dialog').css({'display': 'flex', 'opacity': '1'});
        });

        // Close dialog on X button click
        $('.hashbar-close-dialog').on('click', closeDialog);

        // Close dialog on overlay click
        $('#hashbar-deactivation-dialog').on('click', function(e) {
            if (e.target === this) {
                closeDialog();
            }
        });

        // Prevent close when clicking modal content
        $('.hashbar-deactivate-modal').on('click', function(e) {
            e.stopPropagation();
        });

        // Handle radio button change - show/hide textarea
        $('input[name="reason"]').on('change', function() {
            $('.hashbar-deactivation-reason-input').removeClass('active').hide();

            const id = $(this).data('id');
            if (['other', 'found_better', 'stopped_working', 'found_bug'].includes(id)) {
                $(`#hashbar-${id}-reason-text`).addClass('active').show();
                $(`#hashbar-${id}-reason-text textarea`).focus();
            }
        });

        // Handle form submission
        $('#hashbar-deactivation-feedback-form').on('submit', function(e) {
            e.preventDefault();

            const $submitButton = $(this).find('button[type="submit"]');
            const $buttonText = $submitButton.find('span');
            const originalText = $buttonText.text();

            $buttonText.text('<?php esc_html_e('Submitting...', 'hashbar') ?>');
            $submitButton.prop('disabled', true);

            const reason = $('input[name="reason"]:checked').val() || 'No reason selected';
            const message = $('.hashbar-deactivation-reason-input.active textarea').val() || '';

            const data = {
                action: 'hashbar_plugin_deactivation_feedback',
                reason: reason,
                message: message,
                nonce: '<?php echo esc_js($nonce); ?>'
            };

            $.post('<?php echo esc_url_raw($ajaxurl); ?>', data)
                .done(function(response) {
                    if (response.success) {
                        window.location.href = pluginToDeactivate;
                    } else {
                        console.error('Feedback submission failed:', response.data);
                        $buttonText.text(originalText);
                        $submitButton.prop('disabled', false);
                    }
                })
                .fail(function(xhr) {
                    console.error('Feedback submission failed:', xhr.responseText);
                    $buttonText.text(originalText);
                    $submitButton.prop('disabled', false);
                });
        });

        // Skip feedback and deactivate
        $('.hashbar-skip-feedback').on('click', function(e) {
            e.preventDefault();
            window.location.href = pluginToDeactivate;
        });
    });
</script>

<style>
    /* Overlay */
    #hashbar-deactivation-dialog.hashbar-deactivate-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 999999;
        animation: hashbarFadeIn 0.3s ease;
    }

    @keyframes hashbarFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes hashbarFadeOut {
        from { opacity: 1; }
        to { opacity: 0; }
    }

    @keyframes hashbarSlideUp {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    @keyframes hashbarSlideDown {
        from {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        to {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
    }

    /* Closing animation classes */
    #hashbar-deactivation-dialog.hashbar-deactivate-overlay.hashbar-closing {
        animation: hashbarFadeOut 0.25s ease forwards;
    }

    #hashbar-deactivation-dialog.hashbar-closing .hashbar-deactivate-modal {
        animation: hashbarSlideDown 0.25s ease forwards;
    }

    /* Modal Container */
    .hashbar-deactivate-modal {
        background: #ffffff;
        border-radius: 8px;
        width: 480px;
        max-width: 95%;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        animation: hashbarSlideUp 0.4s ease;
    }

    /* Header */
    .hashbar-deactivate-header {
        background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 50%, #3b82f6 100%);
        padding: 20px 28px;
        position: relative;
        overflow: hidden;
    }

    .hashbar-deactivate-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .hashbar-deactivate-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: 10%;
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .hashbar-header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .hashbar-header-text h3 {
        color: #ffffff;
        font-size: 16px;
        font-weight: 600;
        margin: 0 0 2px 0;
    }

    .hashbar-header-text p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 12px;
        font-weight: 400;
        margin: 0;
    }

    /* Close Button */
    .hashbar-close-btn {
        position: absolute;
        top: 16px;
        right: 16px;
        width: 28px;
        height: 28px;
        background: rgba(255, 255, 255, 0.15);
        border: none;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        z-index: 2;
        padding: 0;
    }

    .hashbar-close-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: rotate(90deg);
    }

    .hashbar-close-btn svg {
        width: 16px;
        height: 16px;
        stroke: #ffffff;
        stroke-width: 2;
    }

    /* Body Content */
    .hashbar-body-title {
        font-size: 14px;
        color: #374151;
        font-weight: 500;
        margin: 20px 0 0 0;
        padding: 0 25px;
    }

    /* Reason Options */
    .hashbar-reasons-list {
        display: flex;
        flex-direction: column;
        gap: 6px;
        padding: 20px 25px;
    }

    .hashbar-reason-item {
        position: relative;
    }

    .hashbar-reason-item input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .hashbar-reason-label {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        background: #ffffff;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.25s ease;
    }

    .hashbar-reason-label:hover {
        border-color: #8b5cf6;
        background: #f5f3ff;
    }

    .hashbar-reason-item input[type="radio"]:checked + .hashbar-reason-label {
        border-color: #8b5cf6;
        background: #f5f3ff;
        box-shadow: 0 2px 8px rgba(139, 92, 246, 0.15);
    }

    .hashbar-reason-radio {
        width: 14px;
        height: 14px;
        min-width: 14px;
        border: 2px solid #d1d5db;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
    }

    .hashbar-reason-item input[type="radio"]:checked + .hashbar-reason-label .hashbar-reason-radio {
        border-color: #8b5cf6;
        background: #8b5cf6;
    }

    .hashbar-reason-radio::after {
        content: '';
        width: 6px;
        height: 6px;
        background: #ffffff;
        border-radius: 50%;
        transform: scale(0);
        transition: transform 0.2s ease;
    }

    .hashbar-reason-item input[type="radio"]:checked + .hashbar-reason-label .hashbar-reason-radio::after {
        transform: scale(1);
    }

    .hashbar-reason-icon {
        width: 30px;
        height: 30px;
        min-width: 30px;
        background: #ede9fe;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
    }

    .hashbar-reason-item input[type="radio"]:checked + .hashbar-reason-label .hashbar-reason-icon {
        background: #8b5cf6;
    }

    .hashbar-reason-icon svg {
        width: 15px;
        height: 15px;
        stroke: #8b5cf6;
        stroke-width: 2;
        fill: none;
        transition: all 0.25s ease;
    }

    .hashbar-reason-item input[type="radio"]:checked + .hashbar-reason-label .hashbar-reason-icon svg {
        stroke: #ffffff;
    }

    .hashbar-reason-text {
        flex: 1;
    }

    .hashbar-reason-text span {
        font-size: 13px;
        font-weight: 500;
        color: #374151;
        display: block;
        line-height: 1.3;
    }

    /* Additional Input Field */
    .hashbar-additional-input.hashbar-deactivation-reason-input {
        margin-top: 6px;
        margin-bottom: 6px;
        display: none;
        animation: hashbarInputSlideDown 0.3s ease;
    }

    .hashbar-additional-input.hashbar-deactivation-reason-input.active {
        display: block;
    }

    @keyframes hashbarInputSlideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .hashbar-additional-input textarea {
        width: 100%;
        min-height: 70px;
        padding: 12px 14px;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        font-size: 13px;
        font-family: inherit;
        resize: vertical;
        transition: all 0.25s ease;
        background: #ffffff;
        box-sizing: border-box;
    }

    .hashbar-additional-input textarea:focus {
        outline: none;
        border-color: #8b5cf6;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .hashbar-additional-input textarea::placeholder {
        color: #94a3b8;
    }

    /* Footer */
    .hashbar-deactivate-footer {
        padding: 16px 28px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        border-top: 1px solid #e5e5e5;
        margin-top: 10px;
    }

    .hashbar-btn {
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .hashbar-btn-skip {
        background: transparent;
        color: #6B7280;
        padding: 10px 0;
    }

    .hashbar-btn-skip:hover {
        color: #8b5cf6;
    }

    .hashbar-btn-submit {
        background: #8b5cf6;
        border: 1px solid #8b5cf6;
        color: #ffffff;
    }

    .hashbar-btn-submit:hover {
        background: #7c3aed;
        border-color: #7c3aed;
        color: #ffffff;
    }

    .hashbar-btn-submit:active {
        background: #6d28d9;
    }

    .hashbar-btn-submit:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    .hashbar-btn-submit svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        stroke-width: 2;
        fill: none;
    }

    /* Responsive */
    @media (max-width: 600px) {
        .hashbar-deactivate-modal {
            margin: 16px;
        }

        .hashbar-deactivate-header {
            padding: 16px 20px;
        }

        .hashbar-deactivate-body {
            padding: 16px 20px;
        }

        .hashbar-deactivate-footer {
            padding: 14px 20px 18px;
            flex-direction: column;
        }

        .hashbar-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

    <?php }
}

// Initialize the class
Hashbar_Plugin_Deactivation_Feedback::instance();