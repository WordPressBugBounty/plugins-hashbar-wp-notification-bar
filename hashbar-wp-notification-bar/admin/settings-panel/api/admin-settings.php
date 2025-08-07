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
        $this->is_pro = defined('HASHBAR_WPNBP_VERSION');
    }

    public function get_help_section() {
        return [
            'docLink' => 'https://hasthemes.com/docs/hashbar/',
            'supportLink' => 'https://hasthemes.com/contact-us/',
            'licenseLink' => admin_url('admin.php?page=hashbar-license'),
            'recommendedPluginsLink' => admin_url('admin.php?page=hashbar_recommendations'),
            'upgradeLink' => 'https://hasthemes.com/plugins/wordpress-notification-bar-plugin/'
        ];
    }

    public function get_menu_settings() {
        return [
            'dashboard' => [
                'label' => __('Dashboard', 'hashbar'),
                'icon' => 'Grid',
                'link' => '/',
                'order' => 1,
                'visible' => true,
                'isRouter' => true
            ],
            'notifications' => [
                'label' => __('Notifications', 'hashbar'),
                'icon' => 'Bell',
                'link' => '/notifications',
                'order' => 2,
                'visible' => true,
                'isRouter' => true
            ],
            'settings' => [
                'label' => __('Settings', 'hashbar'),
                'icon' => 'Setting',
                'link' => '/settings',
                'order' => 3,
                'visible' => true,
                'isRouter' => true
            ],
            'analytics' => [
                'label' => __('Analytics', 'hashbar'),
                'icon' => 'DataAnalysis',
                'link' => '/analytics',
                'order' => 4,
                'visible' => true,
                'isRouter' => true
            ],
            'license' => [
                'label' => __('License', 'hashbar'),
                'icon' => 'Key',
                'link' => $this->get_help_section()['licenseLink'],
                'order' => 5,
                'visible' => false,
                'target' => '_self'
            ],
            'recommended_plugins' => [
                'label' => __('Recommended Plugins', 'hashbar'),
                'icon' => 'Promotion',
                'link' => '/recommended',
                'order' => 6,
                'visible' => true,
                'isRouter' => true
            ]
            // 'license' => [
            //     'label' => __('License', 'hashbar'),
            //     'icon' => 'Key',
            //     'link' => '/license',
            //     'order' => 4,
            //     'visible' => true,
            //     'isRouter' => true
            // ],
        ];
    }

    /**
     * Get notification enable fields with options
     */
    public function get_notification_enable_fields() {
        $prefix = '_wphash_';
        $enable_ajax_select = true;
        $limit = array(
            'post' => -1,
            'page' => -1,
            'product' => -1
        );

        $fields = [
            $prefix.'notification_where_to_show' => [
                'label' => __('Where to Show: ', 'hashbar'),
                'description' => __('Choose where to show the notification.', 'hashbar'),
                'placeholder' => esc_html__('Select Where to Show', 'hashbar'),
                'type' => 'select',
                'options' => [
                    'none' => __('Don\'t show', 'hashbar'),
                    'everywhere' => __('Entire Site', 'hashbar'),
                    'homepage' => __('Homepage Only', 'hashbar'),
                    'post' => __('Posts', 'hashbar'),
                    'post_cat' => __('Post Categories', 'hashbar'),
                    'post_tags' => __('Post Tags', 'hashbar'),
                    'page' => __('Pages', 'hashbar'),
                    'specific_ids' => __('Any Post/Page/Custom Post IDs', 'hashbar'),
                    'url_param' => __('URL Parameter', 'hashbar'),
                    'custom' => __('Custom', 'hashbar')
                ],
                'default' => 'everywhere',
                'pro' => ['post_cat', 'post_tags','woo_catagories'],
                'proBadge' => false
            ],
            $prefix.'exclusion_page_for_notification' => [
                'label' => __('Exclude pages for notification', 'hashbar'),
                'description' => __('Write any Page/Post/Custom Post ids here separated by comma. Example: 4,32,17.', 'hashbar'),
                'type' => 'text',
                'placeholder' => esc_html__('4,32,17', 'hashbar'),
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
                'label' => __('Choose Posts', 'hashbar'),
                'description' => __('Select specific posts where this notification will appear', 'hashbar'),
                'type' => 'select',
                'placeholder' => esc_html__('Select Posts', 'hashbar'),
                'options' => hashbar_post_list(),
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
                'label' => __('Choose Categories', 'hashbar'),
                'description' => __('Select specific categories where this notification will appear', 'hashbar'),
                'type' => 'select',
                'placeholder' => esc_html__('Select Categories', 'hashbar'),
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
                'label' => __('Choose Tags', 'hashbar'),
                'description' => __('Select specific tags where this notification will appear', 'hashbar'),
                'type' => 'select',
                'placeholder' => esc_html__('Select Tags', 'hashbar'),
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
                'label' => __('Choose Pages', 'hashbar'),
                'description' => __('Select specific pages where this notification will appear', 'hashbar'),
                'type' => 'select',
                'placeholder' => esc_html__('Select Pages', 'hashbar'),
                'options' => hashbar_post_list('page'),
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
                'label' => __('Post/Page/Custom Post IDs', 'hashbar'),
                'description' => __('Put the post/page/custom post ids here separated by a comma. Example: 50,60,54', 'hashbar'),
                'type' => 'text',
                'placeholder' => esc_html__('50,60,54', 'hashbar'),
                'condition' => [
                    'key' => $prefix.'notification_where_to_show',
                    'operator' => '==',
                    'value' => 'specific_ids'
                ],
                'default' => ''
            ],

            // URL Parameter field - shown when where_to_show is 'url_param'
            $prefix.'url_param' => [
                'label' => __('URL Parameter Value', 'hashbar'),
                'description' => __('Input URL parameter value, Example: discount_50. Your URL should look like: example.com/?param=discount_50', 'hashbar'),
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
                'label' => __('Custom Options Where to Show', 'hashbar'),
                'description' => __('Select specific locations where this notification will appear', 'hashbar'),
                'type' => 'checkbox',
                'options' => [
                    'home' => __('Homepage', 'hashbar'),
                    'posts' => __('All Posts', 'hashbar'),
                    'page' => __('All Pages', 'hashbar')
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
            $fields[$prefix.'notification_where_to_show']['options']['product'] = __('Products', 'hashbar');
            $fields[$prefix.'notification_where_to_show']['options']['woo_catagories'] = __('Products Of Selected Categories', 'hashbar');

            // Add products selection field
            $fields[$prefix.'notification_where_to_show_Product'] = [
                'label' => __('Choose Products', 'hashbar'),
                'description' => __('Select specific products where this notification will appear', 'hashbar'),
                'type' => 'select',
                'placeholder' => esc_html__('Select Products', 'hashbar'),
                'options' => hashbar_post_list('product'),
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
                'label' => __('Product Categories', 'hashbar'),
                'description' => __('This notification will appear in all product details/archive pages of selected categories', 'hashbar'),
                'type' => 'select',
                'placeholder' => esc_html__('Select Categories', 'hashbar'),
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
            $fields[$prefix.'notification_where_to_show_custom']['options']['product'] = __('All Products', 'hashbar');
        }

        return $fields;
    }

    public function get_dashboard_settings(){
        return [
            'manage_notifications' => [
                'plugin_filter_options' => [
                    'label' => __('Filter Nofitications', 'hashbar'),
                    'options'=>[
                        'all' => __('All Notifications', 'hashbar'),
                        'active_notifications' => __('Active Notifications', 'hashbar'),
                        'inactive_notifications' => __('Inactive Notifications', 'hashbar'),
                        'draft' => __('Draft Notifications', 'hashbar'),
                    ],
                    'isPro' => ['backend_optimized'],
                    'proBadge' => false,
                    'type' => 'select',
                ]
            ],
            'general_settings' => [
                'dont_show_bar_after_close' => [
                    'label' => __('Don\'t Show Again', 'hashbar'),
                    'type' => 'checkbox',
                    'default' => false,
                    'desc' => __('If check this option. The notification will not appear again on a page, after closing the notification.', 'hashbar'),
                ],
                'keep_closed_bar' => [
                    'label' => __('Keep Notification Bar Closed', 'hashbar'),
                    'type' => 'checkbox',
                    'default' => false,
                    'desc' => __('When you close the notification bar once then it will always keep closed in all pages of your site. This option will be effective for the notifications which have set "Load as minimized = No" from the notification metabox options', 'hashbar'),
                ],
                'cookies_expire_time' => [
                    'label' => __('Cookies expire time', 'hashbar'),
                    'type' => 'number',
                    'default' => 7,
                    'min' => 1,
                    'max' => 365,
                    'step' => 1,
                    'desc' => __('Specify the duration of the expiration time for the cookie when a user closes the notification bar. After the expiration time has passed, the notification will reappear for that user. (Default: 7 Days).', 'hashbar'),
                ],
                'cookies_expire_type' => [
                    'label' => __('Cookies expire time unit', 'hashbar'),
                    'type' => 'select',
                    'default' => 'days',
                    'options' => [
                        'days' => __('Days', 'hashbar'),
                        'hours' => __('Hours', 'hashbar'),
                        'minutes' => __('Minutes', 'hashbar'),
                    ],
                    'desc' => __('Set the unit of time for cookies expiration.', 'hashbar'),
                ],
                'enable_analytics' => [
                    'label' => __('Enable Analytics', 'hashbar'),
                    'type' => 'checkbox',
                    'default' => false,
                    'desc' => __('Enable Analytics to get the analytical report about your notifications.', 'hashbar'),
                ],
                'count_onece_byip' => [
                    'label' => __('Count Only 1 From Each IP', 'hashbar'),
                    'type' => 'checkbox',
                    'default' => false,
                    'desc' => __('Enable to count the views and clicks only once from each IP-address.', 'hashbar'),
                ],
                'analytics_from' => [
                    'label' => __('User Tracking Options', 'hashbar'),
                    'type' => 'select',
                    'options' => [
                        'everyone' => __('Everyone', 'hashbar'),
                        'guests' => __('Guest Users Only', 'hashbar'),
                        'registered_users' => __('Rigestered Users Only', 'hashbar'),
                    ],
                    'default' => 'everyone',
                    'desc' => __('Select which users to track for analytics.', 'hashbar'),
                ],
                'mobile_device_breakpoint' => [
                    'label' => __('Mobile device breakpoint (px)', 'hashbar'),
                    'type' => 'number',
                    'default' => 991,
                    'min' => 320,
                    'max' => 1200,
                    'step' => 1,
                    'desc' => __('Set the breakpoint for mobile devices in pixels.', 'hashbar'),
                ],
                'items_per_page' => [
                    'label' => __('Items per Page', 'hashbar'),
                    'default' => 10,
                    'desc' => __('Default: 10 items per page. Adjust if you have more notifications to manage.', 'hashbar'),
                    'type' => 'number',
                    'min' => 1,
                    'max' => 100,
                    'step' => 1,
                    'isPro' => false,
                    'proBadge' => false,
                ],
            ],
        ];
    }

    public function get_labels_texts() {
        return [
            'upgrade_to_pro' => __('Upgrade to Pro', 'hashbar'),
            'select_pages' => __('Select Pages:', 'hashbar'),
            'select_posts' => __('Select Posts:', 'hashbar'),
            'page_types' => __('Page Type', 'hashbar'),
            'select' => __('Select', 'hashbar'),
            'uri_conditions' => __('URI Conditions:', 'hashbar'),
            'add_condition' => __('Add Condition:', 'hashbar'),
            'field_desc_uri' => __('E.g. You can use \'contact-us\' on URLs like https://example.com/contact-us or leave it blank for the homepage.', 'hashbar'),
            'save_enable' => __('Save & Enable', 'hashbar'),
            'cancel' => __('Cancel', 'hashbar'),
            'post_types_settings' => __('Post Types Settings', 'hashbar'),
            'display_settings' => __('Display Settings', 'hashbar'),
            'show_thumbnails' => __('Show Plugin Thumbnails', 'hashbar'),
            'show_thumbnails_desc' => __('Enable this option to display plugin thumbnails in the plugin list. (After enabling, you need to refresh the page to see the changes.)', 'hashbar'),
            'items_per_page' => __('Items Per Page in Plugin List', 'hashbar'),
            'items_per_page_desc' => __('Select how many plugins to display per page in the manage plugin list.', 'hashbar'),
            'items' => __('items', 'hashbar'),
            'save_settings' => __('Save Settings', 'hashbar'),
            'select_post_types_desc' => __('Select the custom post types where you want to disable plugins.', 'hashbar'),
            'add_post_type' => __('Add post type...', 'hashbar'),
            'number_of_posts' => __('Number of Posts to Load', 'hashbar'),
            'number_of_posts_desc' => __('Default: 150 posts. Adjust if you have more posts to manage.', 'hashbar'),
            'save_settings_note' => '',
            // Backend specific labels
            'backend_page_selection' => __('Backend Page Selection', 'hashbar'),
            'select_admin_pages' => __('Select Admin Pages:', 'hashbar'),
            'backend_conditions' => __('Backend Conditions:', 'hashbar'),
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
            'title'  => esc_html__( 'Recommended', 'hashbar' ),
            'active' => true,
            'plugins' => array(
                array(
                    'slug'        => 'woolentor-addons',
                    'location'    => 'woolentor_addons_elementor.php',
                    'name'        => esc_html__( 'WooLentor', 'hashbar' ),
                    'description' => esc_html__( 'If you own a WooCommerce website, you ll almost certainly want to use these capabilities: Woo Builder (Elementor WooCommerce Builder), WooCommerce Templates, WooCommerce Widgets,...', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null,
                    'recommend' => is_plugin_active('woocommerce/woocommerce.php') ? true : false,

                ),
                array(
                    'slug'        => 'ht-mega-for-elementor',
                    'location'    => 'htmega_addons_elementor.php',
                    'name'        => esc_html__( 'HT Mega', 'hashbar' ),
                    'description' => esc_html__( 'HTMega is an absolute addon for elementor that includes 80+ elements', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null,
                    'recommend' => is_plugin_active('elementor/elementor.php') ? true : false,
                ),
                array(
                    'slug'        => 'support-genix-lite',
                    'location'    => 'support-genix-lite.php',
                    'name'        => esc_html__( 'Support Genix Lite – Support Tickets Managing System', 'hashbar' ),
                    'description' => esc_html__( 'Support Genix is a support ticket system for WordPress and WooCommerce.', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'whols',
                    'location'    => 'whols.php',
                    'name'        => esc_html__( 'Whols – Wholesale Prices and B2B Store', 'hashbar' ),
                    'description' => esc_html__( 'WooCommerce Wholesale plugin for B2B store management.', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null,
                    'recommend' => is_plugin_active('woocommerce/woocommerce.php') ? true : false,
                ),
                array(
                    'slug'        => 'wp-plugin-manager',
                    'location'    => 'init.php',
                    'name'        => esc_html__( 'WP Plugin Manager', 'hashbar' ),
                    'description' => esc_html__( 'Deactivate plugins per page', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'pixelavo',
                    'location'    => 'pixelavo.php',
                    'name'        => esc_html__( 'Pixelavo – Facebook Pixel Conversion API', 'hashbar' ),
                    'description' => esc_html__( 'Easy connection of Facebook pixel to your online store.', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'ht-contactform',
                    'location'    => 'contact-form-widget-elementor.php',
                    'name'        => esc_html__( 'HT Contact Form Widget For Elementor Page Builder & Gutenberg Blocks & Form Builder.', 'hashbar' ),
                    'description' => esc_html__( 'HT Contact Form Widget For Elementor Page Builder & Gutenberg Blocks & Form Builder.', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'extensions-for-cf7',
                    'location'    => 'extensions-for-cf7.php',
                    'name'        => esc_html__( 'Extensions For CF7', 'hashbar' ),
                    'description' => esc_html__( 'Additional features for Contact Form 7', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null,
                    'recommend' => is_plugin_active('contact-form-7/wp-contact-form-7.php') ? true : false,
                ),
            )
        );
    
        // You May Also Like Tab
        $recommendations_plugins[] = [
            'title' => esc_html__( 'WooCommerce', 'hashbar' ),
            'plugins' => [
                array(
                    'slug'        => 'whols',
                    'location'    => 'whols.php',
                    'name'        => esc_html__( 'Whols – Wholesale Prices and B2B Store', 'hashbar' ),
                    'description' => esc_html__( 'WooCommerce Wholesale plugin for B2B store management.', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'woolentor-addons',
                    'location'    => 'woolentor_addons_elementor.php',
                    'name'        => esc_html__( 'WooLentor', 'hashbar' ),
                    'description' => esc_html__( 'If you own a WooCommerce website, you’ll almost certainly want to use these capabilities: Woo Builder (Elementor WooCommerce Builder), WooCommerce Templates, WooCommerce Widgets,...', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'swatchly',
                    'location'    => 'swatchly.php',
                    'name'        => esc_html__( 'Swatchly', 'hashbar' ),
                    'description' => esc_html__( 'Swatchly – WooCommerce Variation Swatches for Products (product attributes: Image swatch, Color swatches, Label swatches...)', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'just-tables',
                    'location'    => 'just-tables.php',
                    'name'        => esc_html__( 'JustTables – WooCommerce Product Table', 'hashbar' ),
                    'description' => esc_html__( 'JustTables is an incredible WordPress plugin that lets you showcase all your WooCommerce products in a sortable and filterable table view. It allows your customers to easily navigate through different attributes of the products and compare them on a single page...', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
            ]
        ];
    
        // Others Tab
        $recommendations_plugins[] = [
            'title' => esc_html__( 'Others', 'hashbar' ),
            'plugins' => [
                array(
                    'slug'        => 'support-genix-lite',
                    'location'    => 'support-genix-lite.php',
                    'name'        => esc_html__( 'Support Genix Lite – Support Tickets Managing System', 'hashbar' ),
                    'description' => esc_html__( 'Support Genix is a support ticket system for WordPress and WooCommerce.', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'ht-mega-for-elementor',
                    'location'    => 'htmega_addons_elementor.php',
                    'name'        => esc_html__( 'HT Mega', 'hashbar' ),
                    'description' => esc_html__( 'HTMega is an absolute addon for elementor that includes 80+ elements', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'pixelavo',
                    'location'    => 'pixelavo.php',
                    'name'        => esc_html__( 'Pixelavo – Facebook Pixel Conversion API', 'hashbar' ),
                    'description' => esc_html__( 'Easy connection of Facebook pixel to your online store.', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'insert-headers-and-footers-script',
                    'location'    => 'init.php',
                    'name'        => esc_html__( 'Insert Headers and Footers Code – HT Script', 'hashbar' ),
                    'description' => esc_html__( 'Insert Headers and Footers Code allows you to insert Google Analytics, Facebook Pixel, custom CSS, custom HTML, JavaScript code to your website header and footer without modifying your theme code', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug'        => 'ht-slider-for-elementor',
                    'location'    => 'ht-slider-for-elementor.php',
                    'name'        => esc_html__( 'HT Slider For Elementor', 'hashbar' ),
                    'description' => esc_html__( 'Create beautiful sliders for your website using Elementor', 'hashbar' ),
                    'status'     => 'inactive',
                    'isLoading'  => false,
                    'icon'       => null
                ),
                array(
                    'slug' => 'ht-google-place-review',
                    'location' => 'ht-google-place-review.php',
                    'name' => esc_html__('Google Place Review', 'hashbar'),
                    'link' => 'https://hasthemes.com/plugins/google-place-review-plugin-for-wordpress/',
                    'author_link' => 'https://hasthemes.com/',
                    'description' => esc_html__('Display Google Reviews on your site.', 'hashbar'),
                    'pro' => true
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