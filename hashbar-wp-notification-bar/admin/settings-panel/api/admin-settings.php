<?php
if (!defined('ABSPATH')) exit;

class Hashbar_Settings_Panel_Settings {
    private static $instance = null;
    private $is_pro = false;
    private $prefix = '_wphash_';

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        // Temporarily set to true for A/B testing development in free version
        $this->is_pro = defined('HASHBAR_WPNBP_VERSION');
    }

    public function get_help_section() {
        return [
            'docLink' => 'https://wphashbar.com/docs/',
            'supportLink' => 'https://wphashbar.com/contact/',
            'licenseLink' => admin_url('admin.php?page=hashbar-license'),
            'recommendedPluginsLink' => admin_url('admin.php?page=hashbar_recommendations'),
            'upgradeLink' => 'https://wphashbar.com/pricing/'
        ];
    }

    public function get_menu_settings() {
        return [
            'dashboard' => [
                'label' => __('Dashboard', 'hashbar-wp-notification-bar'),
                'icon' => 'Grid',
                'link' => '/',
                'order' => 1,
                'visible' => true,
                'isRouter' => true
            ],
            'announcement_bar' => [
                'label' => __('Announcement Bar', 'hashbar-wp-notification-bar'),
                'icon' => 'MessageCircle',
                'link' => '/announcement-bar',
                'order' => 2,
                'visible' => true,
                'isRouter' => true
            ],
            'popup_campaign' => [
                'label' => __('Popup Campaign', 'hashbar-wp-notification-bar'),
                'icon' => 'Popup',
                'link' => '/popup-campaign',
                'order' => 3,
                'visible' => true,
                'isRouter' => true,
                'proBadge' => false
            ],
            'notifications' => [
                'label' => __('Notification Bar', 'hashbar-wp-notification-bar'),
                'icon' => 'Bell',
                'link' => '/notifications',
                'order' => 4,
                'visible' => true,
                'isRouter' => true
            ],
            'settings' => [
                'label' => __('Settings', 'hashbar-wp-notification-bar'),
                'icon' => 'Setting',
                'link' => '/settings',
                'order' => 5,
                'visible' => true,
                'isRouter' => true
            ],
            'analytics' => [
                'label' => __('Analytics', 'hashbar-wp-notification-bar'),
                'icon' => 'DataAnalysis',
                'link' => '/analytics',
                'order' => 6,
                'visible' => true,
                'isRouter' => true
            ],
            'ab_testing' => [
                'label' => __('A/B Testing', 'hashbar-wp-notification-bar'),
                'icon' => 'Trophy',
                'link' => '/ab-testing',
                'order' => 7,
                'visible' => true,
                'isRouter' => true,
                'isPro' => true,
                'proBadge' => true
            ],
            'license' => [
                'label' => __('License', 'hashbar-wp-notification-bar'),
                'icon' => 'Key',
                'link' => $this->get_help_section()['licenseLink'],
                'order' => 8,
                'visible' => false,
                'target' => '_self'
            ],
            'recommended_plugins' => [
                'label' => __('Recommended Plugins', 'hashbar-wp-notification-bar'),
                'icon' => 'Promotion',
                'link' => '/recommended',
                'order' => 9,
                'visible' => true,
                'isRouter' => true
            ]
        ];
    }

    /**
     * Get notification enable fields with options
     */
    public function get_notification_enable_fields() {
        $prefix = '_wphash_';
        $enable_ajax_select = true;
        $hashbar_options = get_option('hashbar_wpnb_opt', array());
        $limit = array(
            'post'    => isset($hashbar_options['posts_limit']) && $hashbar_options['posts_limit'] !== '' ? intval($hashbar_options['posts_limit']) : 20,
            'page'    => isset($hashbar_options['pages_limit']) && $hashbar_options['pages_limit'] !== '' ? intval($hashbar_options['pages_limit']) : 20,
            'product' => isset($hashbar_options['product_limit']) && $hashbar_options['product_limit'] !== '' ? intval($hashbar_options['product_limit']) : 20,
        );

        $fields = [
            $prefix.'notification_where_to_show' => [
                'label' => __('Where to Show: ', 'hashbar-wp-notification-bar'),
                'description' => __('Choose where to show the notification.', 'hashbar-wp-notification-bar'),
                'placeholder' => esc_html__('Select Where to Show', 'hashbar-wp-notification-bar'),
                'type' => 'select',
                'options' => [
                    'none' => __('Don\'t show', 'hashbar-wp-notification-bar'),
                    'everywhere' => __('Entire Site', 'hashbar-wp-notification-bar'),
                    'homepage' => __('Homepage Only', 'hashbar-wp-notification-bar'),
                    'post' => __('Posts', 'hashbar-wp-notification-bar'),
                    'post_cat' => __('Post Categories', 'hashbar-wp-notification-bar'),
                    'post_tags' => __('Post Tags', 'hashbar-wp-notification-bar'),
                    'page' => __('Pages', 'hashbar-wp-notification-bar'),
                    'specific_ids' => __('Any Post/Page/Custom Post IDs', 'hashbar-wp-notification-bar'),
                    'url_param' => __('URL Parameter', 'hashbar-wp-notification-bar'),
                    'custom' => __('Custom', 'hashbar-wp-notification-bar')
                ],
                'default' => 'everywhere',
                'pro' => ['post_cat', 'post_tags','woo_catagories'],
                'proBadge' => false
            ],
            $prefix.'exclusion_page_for_notification' => [
                'label' => __('Exclude pages for notification', 'hashbar-wp-notification-bar'),
                'description' => __('Write any Page/Post/Custom Post ids here separated by comma. Example: 4,32,17.', 'hashbar-wp-notification-bar'),
                'type' => 'text',
                'placeholder' => esc_html__('4,32,17', 'hashbar-wp-notification-bar'),
                'condition' => [
                    'key' => $prefix.'notification_where_to_show',
                    'operator' => '==',
                    'value' => 'everywhere'
                ],
                'default' => '',
                'proBadge' => true
            ],
            // Posts selection field - shown when where_to_show is 'posts'
            $prefix.'notification_where_to_show_Post' => [
                'label' => __('Choose Posts', 'hashbar-wp-notification-bar'),
                'description' => __('Select specific posts where this notification will appear', 'hashbar-wp-notification-bar'),
                'type' => 'select',
                'placeholder' => esc_html__('Select Posts', 'hashbar-wp-notification-bar'),
                'options' => hashbar_post_list('post', $limit['post']),
                'multiple' => true,
                'condition' => [
                    'key' => $prefix.'notification_where_to_show',
                    'operator' => '==',
                    'value' => 'post'
                ],
                'default' => []
            ],
            // post categories filed 
            $prefix.'notification_where_to_show_Categories' => [
                'label' => __('Choose Categories', 'hashbar-wp-notification-bar'),
                'description' => __('Select specific categories where this notification will appear', 'hashbar-wp-notification-bar'),
                'type' => 'select',
                'placeholder' => esc_html__('Select Categories', 'hashbar-wp-notification-bar'),
                'options' => 'categories',
                'multiple' => true,
                'condition' => [
                    'key' => $prefix.'notification_where_to_show',
                    'operator' => '==',
                    'value' => 'post_cat'
                ],
                'default' => [],
                'proBadge' => true
            ],
            // post tags filed 
            $prefix.'notification_where_to_show_Tags' => [
                'label' => __('Choose Tags', 'hashbar-wp-notification-bar'),
                'description' => __('Select specific tags where this notification will appear', 'hashbar-wp-notification-bar'),
                'type' => 'select',
                'placeholder' => esc_html__('Select Tags', 'hashbar-wp-notification-bar'),
                'options' => 'tags',
                'multiple' => true,
                'condition' => [
                    'key' => $prefix.'notification_where_to_show',
                    'operator' => '==',
                    'value' => 'post_tags'
                ],
                'default' => [],
                'proBadge' => true
            ],
            // Pages selection field - shown when where_to_show is 'pages'
            $prefix.'notification_where_to_show_Page' => [
                'label' => __('Choose Pages', 'hashbar-wp-notification-bar'),
                'description' => __('Select specific pages where this notification will appear', 'hashbar-wp-notification-bar'),
                'type' => 'select',
                'placeholder' => esc_html__('Select Pages', 'hashbar-wp-notification-bar'),
                'options' => hashbar_post_list('page', $limit['page']),
                'multiple' => true,
                'condition' => [
                    'key' => $prefix.'notification_where_to_show',
                    'operator' => '==',
                    'value' => 'page'
                ],
                'default' => []
            ],

            // Custom IDs field - shown when where_to_show is 'custom_ids'
            $prefix.'specific_post_ids' => [
                'label' => __('Post/Page/Custom Post IDs', 'hashbar-wp-notification-bar'),
                'description' => __('Put the post/page/custom post ids here separated by a comma. Example: 50,60,54', 'hashbar-wp-notification-bar'),
                'type' => 'text',
                'placeholder' => esc_html__('50,60,54', 'hashbar-wp-notification-bar'),
                'condition' => [
                    'key' => $prefix.'notification_where_to_show',
                    'operator' => '==',
                    'value' => 'specific_ids'
                ],
                'default' => ''
            ],

            // URL Parameter field - shown when where_to_show is 'url_param'
            $prefix.'url_param' => [
                'label' => __('URL Parameter Value', 'hashbar-wp-notification-bar'),
                'description' => __('Input URL parameter value, Example: discount_50. Your URL should look like: example.com/?param=discount_50', 'hashbar-wp-notification-bar'),
                'type' => 'text',
                'condition' => [
                    'key' => $prefix.'notification_where_to_show',
                    'operator' => '==',
                    'value' => 'url_param'
                ],
                'default' => ''
            ],

            // Custom options - shown when where_to_show is 'custom'
            $prefix.'notification_where_to_show_custom' => [
                'label' => __('Custom Options Where to Show', 'hashbar-wp-notification-bar'),
                'description' => __('Select specific locations where this notification will appear', 'hashbar-wp-notification-bar'),
                'type' => 'checkbox',
                'options' => [
                    'home' => __('Homepage', 'hashbar-wp-notification-bar'),
                    'posts' => __('All Posts', 'hashbar-wp-notification-bar'),
                    'page' => __('All Pages', 'hashbar-wp-notification-bar')
                ],
                'condition' => [
                    'key' => $prefix.'notification_where_to_show',
                    'operator' => '==',
                    'value' => 'custom'
                ],
                'default' => []
            ]
        ];

        // Add WooCommerce specific fields if WooCommerce is active
        if (is_plugin_active('woocommerce/woocommerce.php')) {
            // Add products option to where_to_show
            $fields[$prefix.'notification_where_to_show']['options']['product'] = __('Products', 'hashbar-wp-notification-bar');
            $fields[$prefix.'notification_where_to_show']['options']['woo_catagories'] = __('Products Of Selected Categories', 'hashbar-wp-notification-bar');

            // Add products selection field
            $fields[$prefix.'notification_where_to_show_Product'] = [
                'label' => __('Choose Products', 'hashbar-wp-notification-bar'),
                'description' => __('Select specific products where this notification will appear', 'hashbar-wp-notification-bar'),
                'type' => 'select',
                'placeholder' => esc_html__('Select Products', 'hashbar-wp-notification-bar'),
                'options' => hashbar_post_list('product', $limit['product']),
                'multiple' => true,
                'condition' => [
                    'key' => $prefix.'notification_where_to_show',
                    'operator' => '==',
                    'value' => 'product'
                ],
                'default' => []
            ];

            // Add WooCommerce categories field
            $fields[$prefix.'woocommerce_categories'] = [
                'label' => __('Product Categories', 'hashbar-wp-notification-bar'),
                'description' => __('This notification will appear in all product details/archive pages of selected categories', 'hashbar-wp-notification-bar'),
                'type' => 'select',
                'placeholder' => esc_html__('Select Categories', 'hashbar-wp-notification-bar'),
                'options' => hashbar_post_list('product_cat'),
                'multiple' => true,
                'condition' => [
                    'key' => $prefix.'notification_where_to_show',
                    'operator' => '==',
                    'value' => 'woo_catagories'
                ],
                'default' => [],
                'proBadge' => true
            ];
            // Add custom options for WooCommerce
            $fields[$prefix.'notification_where_to_show_custom']['options']['product'] = __('All Products', 'hashbar-wp-notification-bar');
        }

        return $fields;
    }

    public function get_dashboard_settings(){
        $dashboard_settings = [
            'manage_notifications' => [
                'plugin_filter_options' => [
                    'label' => __('Filter Nofitications', 'hashbar-wp-notification-bar'),
                    'options'=>[
                        'all' => __('All Notifications', 'hashbar-wp-notification-bar'),
                        'active_notifications' => __('Active Notifications', 'hashbar-wp-notification-bar'),
                        'inactive_notifications' => __('Inactive Notifications', 'hashbar-wp-notification-bar'),
                        'draft' => __('Draft Notifications', 'hashbar-wp-notification-bar'),
                        'scheduled_notifications' => __('Scheduled Notifications', 'hashbar-wp-notification-bar'),
                    ],
                    'proBadge' => false,
                    'type' => 'select',
                ]
            ],
            'general_settings' => [
                'items_per_page' => [
                    'label' => __('Items per Page', 'hashbar-wp-notification-bar'),
                    'default' => 10,
                    'desc' => __('Default: 10 items per page. Adjust if you have more notifications to manage.', 'hashbar-wp-notification-bar'),
                    'type' => 'number',
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                    'isPro' => false,
                    'proBadge' => false,
                ],
                'posts_limit' => [
                    'label' => __('Limit Posts List', 'hashbar-wp-notification-bar'),
                    'default' => 20,
                    'desc' => __('Leave it empty for default. Default = 20. Use -1 to load all posts into the dropdown options', 'hashbar-wp-notification-bar'),
                    'type' => 'number',
                    'min' => -1,
                    'max' => 100000,
                    'step' => 1,
                    'isPro' => false,
                    'proBadge' => false,
                ],
                'pages_limit' => [
                    'label' => __('Limit Pages List', 'hashbar-wp-notification-bar'),
                    'default' => 20,
                    'desc' => __('Leave it empty for default. Default = 20. Use -1 to load all posts into the dropdown options.', 'hashbar-wp-notification-bar'),
                    'type' => 'number',
                    'min' => -1,
                    'max' => 100000,
                    'step' => 1,
                    'isPro' => false,
                    'proBadge' => false,
                ],
            ],
        ];
        if (is_plugin_active('woocommerce/woocommerce.php')) {
            $dashboard_settings['general_settings']['product_limit'] = [
                'label' => __('Limit Products List', 'hashbar-wp-notification-bar'),
                'default' => 20,
                'desc' => __('Leave it empty for default. Default = 20. Use -1 to load all products into the dropdown options.', 'hashbar-wp-notification-bar'),
                'type' => 'number',
                'min' => -1,
                'max' => 100000,
                'step' => 1,
                'isPro' => false,
                'proBadge' => false,
            ];
        }
        return $dashboard_settings;
    }

    public function get_notification_bar_settings(){
        return [
            'dont_show_bar_after_close' => [
                'label' => __('Don\'t Show Again', 'hashbar-wp-notification-bar'),
                'type' => 'checkbox',
                'default' => false,
                'desc' => __('If check this option. The notification will not appear again on a page, after closing the notification.', 'hashbar-wp-notification-bar'),
            ],
            'keep_closed_bar' => [
                'label' => __('Keep Notification Bar Closed', 'hashbar-wp-notification-bar'),
                'type' => 'checkbox',
                'default' => false,
                'desc' => __('When you close the notification bar once then it will always keep closed in all pages of your site. This option will be effective for the notifications which have set "Load as minimized = No" from the notification metabox options', 'hashbar-wp-notification-bar'),
            ],
            'cookies_expire_time' => [
                'label' => __('Cookies expire time', 'hashbar-wp-notification-bar'),
                'type' => 'number',
                'default' => 7,
                'min' => 1,
                'max' => 365,
                'step' => 1,
                'desc' => __('Specify the duration of the expiration time for the cookie when a user closes the notification bar. After the expiration time has passed, the notification will reappear for that user. (Default: 7 Days).', 'hashbar-wp-notification-bar'),
            ],
            'cookies_expire_type' => [
                'label' => __('Cookies expire time unit', 'hashbar-wp-notification-bar'),
                'type' => 'select',
                'default' => 'days',
                'options' => [
                    'days' => __('Days', 'hashbar-wp-notification-bar'),
                    'hours' => __('Hours', 'hashbar-wp-notification-bar'),
                    'minutes' => __('Minutes', 'hashbar-wp-notification-bar'),
                ],
                'desc' => __('Set the unit of time for cookies expiration.', 'hashbar-wp-notification-bar'),
            ],
            'enable_analytics' => [
                'label' => __('Enable Analytics', 'hashbar-wp-notification-bar'),
                'type' => 'checkbox',
                'default' => false,
                'desc' => __('Enable Analytics to get the analytical report about your notifications.', 'hashbar-wp-notification-bar'),
            ],
            'count_onece_byip' => [
                'label' => __('Count Only 1 From Each IP', 'hashbar-wp-notification-bar'),
                'type' => 'checkbox',
                'default' => false,
                'desc' => __('Enable to count the views and clicks only once from each IP-address.', 'hashbar-wp-notification-bar'),
            ],
            'analytics_from' => [
                'label' => __('User Tracking Options', 'hashbar-wp-notification-bar'),
                'type' => 'select',
                'options' => [
                    'everyone' => __('Everyone', 'hashbar-wp-notification-bar'),
                    'guests' => __('Guest Users Only', 'hashbar-wp-notification-bar'),
                    'registered_users' => __('Rigestered Users Only', 'hashbar-wp-notification-bar'),
                ],
                'default' => 'everyone',
                'desc' => __('Select which users to track for analytics.', 'hashbar-wp-notification-bar'),
            ],
            'mobile_device_breakpoint' => [
                'label' => __('Mobile device breakpoint (px)', 'hashbar-wp-notification-bar'),
                'type' => 'number',
                'default' => 991,
                'min' => 320,
                'max' => 1200,
                'step' => 1,
                'desc' => __('Set the breakpoint for mobile devices in pixels.', 'hashbar-wp-notification-bar'),
            ],
        ];
    }

    public function get_labels_texts() {
        return [
            // Existing strings
            'upgrade_to_pro' => __('Upgrade to Pro', 'hashbar-wp-notification-bar'),

            // Settings Page
            'settings_page' => [
                'title' => __('HashBar Settings', 'hashbar-wp-notification-bar'),
                'description' => __('Configure HashBar settings to manage notifications', 'hashbar-wp-notification-bar'),
                'reset_settings' => __('Reset All Settings', 'hashbar-wp-notification-bar'),
                'save_settings' => __('Save Settings', 'hashbar-wp-notification-bar'),
                'reset_confirm_title' => __('Reset Settings', 'hashbar-wp-notification-bar'),
                'reset_confirm_message' => __('Are you sure you want to reset all settings to default values?', 'hashbar-wp-notification-bar'),
                'reset_confirm_button' => __('Reset', 'hashbar-wp-notification-bar'),
                'reset_cancel_button' => __('Cancel', 'hashbar-wp-notification-bar'),
                'reset_success_message' => __('Settings have been reset successfully', 'hashbar-wp-notification-bar'),
                'reset_error_message' => __('Failed to reset settings', 'hashbar-wp-notification-bar'),
            ],

            // Notification Bar Settings Drawer
            'notification_bar_settings' => [
                'title' => __('Notification Bar Settings', 'hashbar-wp-notification-bar'),
                'description' => __('These settings apply only to the Notification Bar — Announcement Bar and Popup Campaign have their own separate settings.', 'hashbar-wp-notification-bar'),
                'button_label' => __('Global Settings', 'hashbar-wp-notification-bar'),
            ],

            // Notifications Page
            'notifications_page' => [
                'title' => __('Manage Notifications', 'hashbar-wp-notification-bar'),
                'filter_placeholder' => __('Filter by status', 'hashbar-wp-notification-bar'),
                'search_placeholder' => __('Search Notifications...', 'hashbar-wp-notification-bar'),
                'add_new_button' => __('Add New', 'hashbar-wp-notification-bar'),
                'show_in_label' => __('Show in:', 'hashbar-wp-notification-bar'),
                'draft_status' => __('Draft', 'hashbar-wp-notification-bar'),
                'scheduled_at_label' => __('Scheduled At:', 'hashbar-wp-notification-bar'),
                'inactive_status' => __('Inactive', 'hashbar-wp-notification-bar'),
                'view_notification' => __('View Notification', 'hashbar-wp-notification-bar'),
                'duplicate_action' => __('Duplicate', 'hashbar-wp-notification-bar'),
                'delete_action' => __('Delete', 'hashbar-wp-notification-bar'),
                'delete_confirm' => __('Are you sure you want to delete this notification?', 'hashbar-wp-notification-bar'),
                'no_notifications_title' => __('No Notifications Found', 'hashbar-wp-notification-bar'),
                'no_notifications_search' => __('Try adjusting your search or filter criteria', 'hashbar-wp-notification-bar'),
                'no_notifications_empty' => __('No notifications are available at the moment', 'hashbar-wp-notification-bar'),
                'disable_notification_error' => __('Failed to disable notification', 'hashbar-wp-notification-bar'),
                'load_notifications_error' => __('Failed to load notifications', 'hashbar-wp-notification-bar'),
                'recommendation_note' => __('<strong>Recommended:</strong> We highly recommend using our <a class="announcement-link">Announcement Bar</a> and <a class="popup-link">Popup Campaign</a> features for better visitor engagement. These features come with predefined templates and advanced options, making it easy to set up and customize.', 'hashbar-wp-notification-bar'),
            ],

            // Welcome Section
            'welcome_section' => [
                'title' => __('Welcome to Hashbar Notification!', 'hashbar-wp-notification-bar'),
                'subtitle' => __('Thank you for choosing Hashbar Notification Bar! 🚀', 'hashbar-wp-notification-bar'),
                'description' => __('Create engaging notification bars to boost conversions, grow your audience, and inform visitors easily.', 'hashbar-wp-notification-bar'),
                'video_title' => __('Welcome to Hashbar Notification', 'hashbar-wp-notification-bar'),
            ],

            // Analytics Section
            'analytics_section' => [
                'title' => __('Analytics Overview', 'hashbar-wp-notification-bar'),
                'total_clicks' => __('Total Clicks', 'hashbar-wp-notification-bar'),
                'total_views' => __('Total Views', 'hashbar-wp-notification-bar'),
                'click_through_rate' => __('Click Through Rate', 'hashbar-wp-notification-bar'),
                'tracking_title' => __('Tracking By Notification Bars', 'hashbar-wp-notification-bar'),
                'table_name' => __('Name', 'hashbar-wp-notification-bar'),
                'table_views' => __('Total Views', 'hashbar-wp-notification-bar'),
                'table_clicks' => __('Total Clicks', 'hashbar-wp-notification-bar'),
                'table_rate' => __('Through Rate', 'hashbar-wp-notification-bar'),
                'top_countries' => __('Top Countries', 'hashbar-wp-notification-bar'),
                'no_notification_data' => __('No notification data available', 'hashbar-wp-notification-bar'),
                'no_country_data' => __('No country data available', 'hashbar-wp-notification-bar'),
                'upgrade_message' => __('Unlock this feature and more by upgrading to HashBar Pro', 'hashbar-wp-notification-bar'),
            ],

            // Notification Modal
            'notification_modal' => [
                'title' => __('Notification Enable/Disable Settings', 'hashbar-wp-notification-bar'),
                'go_to_settings' => __('Go to Other Settings', 'hashbar-wp-notification-bar'),
                'cancel_button' => __('Cancel', 'hashbar-wp-notification-bar'),
                'save_button' => __('Save', 'hashbar-wp-notification-bar'),
                'update_settings_error' => __('Failed to update notification settings', 'hashbar-wp-notification-bar'),
            ],

            // Dashboard Cards Section
            'dashboard_cards' => [
                'support_title' => __('Support & Feedback', 'hashbar-wp-notification-bar'),
                'support_description' => __('Need help or want a free store set-up? We will get back to you within 12-24 hours after receiving your inquiry.', 'hashbar-wp-notification-bar'),
                'support_button' => __('Get Support', 'hashbar-wp-notification-bar'),
                'community_title' => __('Join Our Community', 'hashbar-wp-notification-bar'),
                'community_description' => __('Engage with our community to connect & share your ideas. Join a network where collaboration and growth thrive!', 'hashbar-wp-notification-bar'),
                'community_button' => __('Join Now', 'hashbar-wp-notification-bar'),
                'documentation_title' => __('Documentation', 'hashbar-wp-notification-bar'),
                'documentation_description' => __('We\'ve regularly updated the documentation to help you use the plugin effectively.', 'hashbar-wp-notification-bar'),
                'documentation_button' => __('Documentation', 'hashbar-wp-notification-bar'),
            ],

            // Newsletter Section
            'newsletter_section' => [
                'badge_text' => __('Subscribe Our Newsletter', 'hashbar-wp-notification-bar'),
                'title' => __('Subscribe to receive discount, offer, plugin updates and news in your inbox.', 'hashbar-wp-notification-bar'),
                'subscribe_button' => __('Subscribe Now', 'hashbar-wp-notification-bar'),
            ],

            // Missing Features Section
            'missing_features' => [
                'title' => __('Missing Any Feature?', 'hashbar-wp-notification-bar'),
                'description' => __('Have you ever noticed any missing features? Please notify us if you do. As soon as possible, our staff will add any necessary features based on your requests. Our commitment to our clients is second to none.', 'hashbar-wp-notification-bar'),
                'request_button' => __('Request Feature', 'hashbar-wp-notification-bar'),
            ],

            // Plugin Grid Section
            'plugin_grid' => [
                'active_installations' => __('Active Installations', 'hashbar-wp-notification-bar'),
                'more_details' => __('More Details', 'hashbar-wp-notification-bar'),
            ],

            // Common Messages
            'common' => [
                'success' => __('Success', 'hashbar-wp-notification-bar'),
                'error' => __('Error', 'hashbar-wp-notification-bar'),
                'loading' => __('Loading...', 'hashbar-wp-notification-bar'),
                'save_failed' => __('Failed to save settings. Please try again.', 'hashbar-wp-notification-bar'),
                'load_failed' => __('Failed to load settings. Please try again.', 'hashbar-wp-notification-bar'),
                'pro_suffix' => __(' (Pro)', 'hashbar-wp-notification-bar'),
            ],
        ];
    }

    public function get_modal_settings_fields() {
        $notification_enable_settings = $this->get_notification_enable_fields();
        return $notification_enable_settings;
        // Merge frontend and backend settings
       // return array_merge($feature_settings, $notification_enable_settings );
    }

    public function get_modal_settings_field($field) {
        $settings = $this->get_modal_settings_fields();
        return isset($settings[$field]) ? $settings[$field] : null;
    }

    public function is_pro() {
        return $this->is_pro;
    }

    public function get_recommendations_plugins() {
        $recommendations_plugins = array();
        // Recommended Tab
        $recommendations_plugins[] = array(
            'title'  => esc_html__( 'Recommended', 'hashbar-wp-notification-bar' ),
            'active' => true,
            'plugins' => array(
                array(
                    'slug'        => 'woolentor-addons',
                    'location'    => 'woolentor_addons_elementor.php',
                    'name'        => esc_html__( 'WooLentor', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'If you own a WooCommerce website, you ll almost certainly want to use these capabilities: Woo Builder (Elementor WooCommerce Builder), WooCommerce Templates, WooCommerce Widgets,...', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null,
                    'recommend' => is_plugin_active('woocommerce/woocommerce.php') ? true : false,

                ),
                array(
                    'slug'        => 'ht-mega-for-elementor',
                    'location'    => 'htmega_addons_elementor.php',
                    'name'        => esc_html__( 'HT Mega', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'HTMega is an absolute addon for elementor that includes 80+ elements', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null,
                    'recommend' => is_plugin_active('elementor/elementor.php') ? true : false,
                ),
                array(
                    'slug'        => 'support-genix-lite',
                    'location'    => 'support-genix-lite.php',
                    'name'        => esc_html__( 'Support Genix Lite – Support Tickets Managing System', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Support Genix is a support ticket system for WordPress and WooCommerce.', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'whols',
                    'location'    => 'whols.php',
                    'name'        => esc_html__( 'Whols – Wholesale Prices and B2B Store', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'WooCommerce Wholesale plugin for B2B store management.', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null,
                    'recommend' => is_plugin_active('woocommerce/woocommerce.php') ? true : false,
                ),
                array(
                    'slug'        => 'wp-plugin-manager',
                    'location'    => 'init.php',
                    'name'        => esc_html__( 'WP Plugin Manager', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Deactivate plugins per page', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'pixelavo',
                    'location'    => 'pixelavo.php',
                    'name'        => esc_html__( 'Pixelavo – Facebook Pixel Conversion API', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Easy connection of Facebook pixel to your online store.', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'ht-contactform',
                    'location'    => 'contact-form-widget-elementor.php',
                    'name'        => esc_html__( 'HT Contact Form Widget For Elementor Page Builder & Gutenberg Blocks & Form Builder.', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'HT Contact Form Widget For Elementor Page Builder & Gutenberg Blocks & Form Builder.', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'extensions-for-cf7',
                    'location'    => 'extensions-for-cf7.php',
                    'name'        => esc_html__( 'Extensions For CF7', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Additional features for Contact Form 7', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null,
                    'recommend' => is_plugin_active('contact-form-7/wp-contact-form-7.php') ? true : false,
                ),
            )
        );
    
        // You May Also Like Tab
        $recommendations_plugins[] = [
            'title' => esc_html__( 'WooCommerce', 'hashbar-wp-notification-bar' ),
            'plugins' => [
                array(
                    'slug'        => 'whols',
                    'location'    => 'whols.php',
                    'name'        => esc_html__( 'Whols – Wholesale Prices and B2B Store', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'WooCommerce Wholesale plugin for B2B store management.', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'woolentor-addons',
                    'location'    => 'woolentor_addons_elementor.php',
                    'name'        => esc_html__( 'WooLentor', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'If you own a WooCommerce website, you’ll almost certainly want to use these capabilities: Woo Builder (Elementor WooCommerce Builder), WooCommerce Templates, WooCommerce Widgets,...', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'swatchly',
                    'location'    => 'swatchly.php',
                    'name'        => esc_html__( 'Swatchly', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Swatchly – WooCommerce Variation Swatches for Products (product attributes: Image swatch, Color swatches, Label swatches...)', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'recurio',
                    'location'    => 'recurio.php',
                    'name'        => esc_html__( 'Recurio – Ultimate Subscription for WooCommerce', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Ultimate subscription plugin for WooCommerce recurring payments and memberships.', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null,
                    'recommend' => is_plugin_active('woocommerce/woocommerce.php') ? true : false,
                ),
            ]
        ];
    
        // Others Tab
        $recommendations_plugins[] = [
            'title' => esc_html__( 'Others', 'hashbar-wp-notification-bar' ),
            'plugins' => [
                array(
                    'slug'        => 'support-genix-lite',
                    'location'    => 'support-genix-lite.php',
                    'name'        => esc_html__( 'Support Genix Lite – Support Tickets Managing System', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Support Genix is a support ticket system for WordPress and WooCommerce.', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'ht-mega-for-elementor',
                    'location'    => 'htmega_addons_elementor.php',
                    'name'        => esc_html__( 'HT Mega', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'HTMega is an absolute addon for elementor that includes 80+ elements', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'pixelavo',
                    'location'    => 'pixelavo.php',
                    'name'        => esc_html__( 'Pixelavo – Facebook Pixel Conversion API', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Easy connection of Facebook pixel to your online store.', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'insert-headers-and-footers-script',
                    'location'    => 'init.php',
                    'name'        => esc_html__( 'Insert Headers and Footers Code – HT Script', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Insert Headers and Footers Code allows you to insert Google Analytics, Facebook Pixel, custom CSS, custom HTML, JavaScript code to your website header and footer without modifying your theme code', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'ht-slider-for-elementor',
                    'location'    => 'ht-slider-for-elementor.php',
                    'name'        => esc_html__( 'HT Slider For Elementor', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Create beautiful sliders for your website using Elementor', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'cookieray',
                    'location'    => 'cookieray.php',
                    'name'        => esc_html__( 'CookieRay – Cookie Banner for Cookie Consent (GDPR/CCPA Compliant)', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Cookie banner plugin for GDPR/CCPA compliant cookie consent management.', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'kelune-crm',
                    'location'    => 'kelune-crm.php',
                    'name'        => esc_html__( 'Kelune CRM – Contact Management, Email Marketing, Newsletter & Marketing Automation', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Contact management, email marketing, newsletter & marketing automation CRM.', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'courseglade-lms',
                    'location'    => 'courseglade-lms.php',
                    'name'        => esc_html__( 'CourseGlade LMS – Online Course & eLearning Platform', 'hashbar-wp-notification-bar' ),
                    'description' => esc_html__( 'Complete online course & eLearning platform for WordPress.', 'hashbar-wp-notification-bar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
            ]
        ];
    
        $recommendations_plugins[0]['plugins'] = array_values(array_filter(
            $recommendations_plugins[0]['plugins'],
            function($plugin) {
                return !isset($plugin['recommend']) || $plugin['recommend'] !== false;
            }
        ));
        return $recommendations_plugins;
    }
}