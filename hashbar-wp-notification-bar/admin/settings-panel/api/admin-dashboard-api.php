<?php

if (!class_exists('WP_REST_Response')) {
    require_once ABSPATH . 'wp-includes/rest-api/class-wp-rest-response.php';
    require_once ABSPATH . 'wp-includes/rest-api.php';
}
if ( ! class_exists('Hashbar_Settings_Panel_Settings')){
    require_once HASHBAR_WPNB_DIR . '/admin/settings-panel/api/admin-settings.php';
}
/**
 * Register custom REST API endpoints for plugin management
 */
function hashbar_register_rest_routes() {
    // Get sidebar content endpoint
    register_rest_route('hashbar/v1', '/sidebar-content', [
        'methods' => 'GET',
        'callback' => 'hashbar_get_sidebar_content',
        'permission_callback' => function() {
            return current_user_can('manage_options');
        }
    ]);

    // Get all Notifications endpoint
    register_rest_route('hashbar/v1', '/notifications', [
        'methods' => 'GET',
        'callback' => 'hashbar_get_notifications',
        'permission_callback' => function() {
            return current_user_can('manage_options');
        }
    ]);
    
    // Delete notification endpoint
    register_rest_route('hashbar/v1', '/notifications/(?P<id>\d+)', [
        'methods' => 'DELETE',
        'callback' => 'hashbar_delete_notification',
        'permission_callback' => function() {
            return current_user_can('manage_options');
        }
    ]);
    // Update notification endpoint
    register_rest_route('hashbar/v1', '/notifications/(?P<id>\d+)', [
        'methods' => 'PUT',
        'callback' => 'hashbar_update_notification',
        'permission_callback' => function() {
            return current_user_can('manage_options');
        }
    ]);

    // Get pages endpoint
    register_rest_route('hashbar/v1', '/pages', [
        'methods' => 'GET',
        'callback' => 'hashbar_get_pages',
        'permission_callback' => function() {
            return current_user_can('edit_pages');
        }
    ]);
    
    // Get posts endpoint
    register_rest_route('hashbar/v1', '/posts', [
        'methods' => 'GET',
        'callback' => 'hashbar_get_posts',
        'permission_callback' => function() {
            return current_user_can('edit_posts');
        }
    ]);
    
    // Update dashboard  Settings endpoint
    register_rest_route('hashbar/v1', '/update-dashboard-settings', [
        'methods' => 'POST',
        'callback' => 'hashbar_update_dashboard_settings',
        'permission_callback' => function() {
            return current_user_can('manage_options');
        }
    ]);
    
    // Get analytics data endpoint
    register_rest_route('hashbar/v1', '/analytics', [
        'methods' => 'GET',
        'callback' => 'hashbar_get_analytics_data',
        'permission_callback' => function() {
            return current_user_can('manage_options');
        }
    ]);

    // Reset settings endpoint
    register_rest_route('hashbar/v1', '/reset-settings', [
        'methods' => 'POST',
        'callback' => 'hashbar_reset_settings',
        'permission_callback' => function() {
            return current_user_can('manage_options');
        }
    ]);

    // Duplicate post endpoint
    register_rest_route('hashbar/v1', '/duplicate-post', [
        'methods' => 'POST',
        'callback' => 'hashbar_duplicate_post',
        'permission_callback' => function() {
            return current_user_can('manage_options');
        }
    ]);
}

add_action('rest_api_init', 'hashbar_register_rest_routes');

/**
 * Duplicate a post
 *
 * @param WP_REST_Request $request Request object
 * @return WP_REST_Response Response object
 */
function hashbar_duplicate_post($request) {
    try {
        global $wpdb;
        $post_id = absint($request->get_param('post_id'));

        if (!$post_id) {
            return new WP_REST_Response([
                'success' => false,
                'message' => esc_html__('No post ID provided', 'hashbar')
            ], 400);
        }

        $post = get_post($post_id);
        if (!$post) {
            return new WP_REST_Response([
                'success' => false,
                'message' => esc_html__('Post not found', 'hashbar')
            ], 404);
        }

        // Get current user as post author
        $current_user = wp_get_current_user();
        $new_post_author = $current_user->ID;

        // Create the post duplicate
        $args = array(
            'comment_status' => $post->comment_status,
            'ping_status'    => $post->ping_status,
            'post_author'    => $new_post_author,
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
            'post_name'      => $post->post_name,
            'post_parent'    => $post->post_parent,
            'post_password'  => $post->post_password,
            'post_status'    => 'draft',
            'post_title'     => $post->post_title.' (Copy)',
            'post_type'      => $post->post_type,
            'to_ping'        => $post->to_ping,
            'menu_order'     => $post->menu_order
        );

        $new_post_id = wp_insert_post($args);
        if (is_wp_error($new_post_id)) {
            return new WP_REST_Response([
                'success' => false,
                'message' => esc_html__('Failed to create post duplicate', 'hashbar')
            ], 500);
        }

        // Copy post taxonomies
        $taxonomies = get_object_taxonomies($post->post_type);
        foreach ($taxonomies as $taxonomy) {
            $post_terms = wp_get_object_terms($post_id, $taxonomy, ['fields' => 'slugs']);
            wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
        }

        // Copy post meta
        $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
        if (count($post_meta_infos) > 0) {
            $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
            $sql_query_sel = [];
            
            foreach ($post_meta_infos as $meta_info) {
                $meta_key = $meta_info->meta_key;
                if ($meta_key === '_wp_old_slug') continue;
                $meta_value = addslashes($meta_info->meta_value);
                $sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
            }
            
            if (!empty($sql_query_sel)) {
                $sql_query .= implode(" UNION ALL ", $sql_query_sel);
                $wpdb->query($sql_query);
            }
        }
        update_post_meta($new_post_id, '_wphash_notification_where_to_show', 'none');
        return new WP_REST_Response([
            'success' => true,
            'data' => [
                'id' => $new_post_id,
                'title' => get_the_title($new_post_id),
                'edit_url' => admin_url('post.php?action=edit&post=' . $new_post_id)
            ],
            'message' => esc_html__('Post duplicated successfully', 'hashbar')
        ], 200);

    } catch (Throwable $e) {
        return new WP_REST_Response([
            'success' => false,
            'message' => esc_html__('An error occurred while duplicating the post', 'hashbar')
        ], 500);
    }
}


/**
 * Update Notification
 */
function hashbar_update_notification($request) {
    $notification_id = $request->get_param('id');
    $params = $request->get_params();
    $post_status = get_post_status($notification_id);

    // Update notification options
    if (isset($params['notification_enable_options'])) {
        $notification_enable_options = $params['notification_enable_options'];
        // Sanitize each option
        $sanitized_options = array();
        foreach ($notification_enable_options as $key => $value) {
            if (is_array($value)) {
                $sanitized_options[$key] = array_map('sanitize_text_field', $value);
            } else {
                $sanitized_options[$key] = sanitize_text_field($value);
            }
            update_post_meta($notification_id, $key, $sanitized_options[$key]);
        }
    }
    if($post_status != 'publish'){
        wp_update_post(array(
            'ID' => $notification_id,
            'post_status' => 'publish'
        ));
    }
    // Get updated data
    $updated_data = array(
        'notification_enable_options' => $sanitized_options,
        'settings' => []
    );

    return new WP_REST_Response([
        'success' => true,
        'data' => $updated_data,
        'message' => esc_html__('Notification updated successfully', 'hashbar')
    ], 200);
}


/**
 * Delete notification
 */
function hashbar_delete_notification($request) {
    $notification_id = $request->get_param('id');

    wp_trash_post($notification_id);

    return new WP_REST_Response([
        'success' => true,
        'message' =>  esc_html__('Notification deleted successfully', 'hashbar')
    ], 200);
}
/**
 * Get sidebar content from the template
 * @return WP_REST_Response|WP_Error
 */
function hashbar_get_sidebar_content() {
    try {
        $template_path = HASHBAR_WPNB_DIR . '/admin/settings-panel/templates/sidebar-banner.php';
        
        if (!file_exists($template_path)) {
            error_log('Hashbar - Template not found: ' . $template_path);
            return new WP_Error(
                'template_not_found',
                esc_html__('Sidebar template file not found.', 'hashbar'),
                ['status' => 404]
            );
        }

        ob_start();
        include $template_path;
        $content = ob_get_clean();

        if ($content === false) {
            throw new Exception('Failed to capture output buffer');
        }

        return new WP_REST_Response([
            'success' => true,
            'content' => $content
        ], 200);

    } catch (Exception $e) {
        error_log('Hashbar - Sidebar Content Error: ' . $e->getMessage());
        return new WP_Error(
            'template_error',
            $e->getMessage(),
            ['status' => 500]
        );
    }
}

/**
 * Update dashboard  Settings
 */
function hashbar_update_dashboard_settings($request) {
    try {

        // Get and decode JSON data
        $settings = json_decode($request->get_body(), true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return new WP_REST_Response([
                'success' => false,
                'message' => 'Invalid JSON data'
            ], 400);
        }
        // Update options
        $update_result = update_option('hashbar_wpnb_opt', $settings);
        
        if ($update_result === false && $settings !== get_option('hashbar_wpnb_opt')) {
            return new WP_REST_Response([
                'success' => false,
                'message' => 'Failed to update settings in database'
            ], 500);
        }
        
        return new WP_REST_Response([
            'success' => true,
            'data' => $settings,
            'message' =>  esc_html__( 'Settings updated successfully', 'hashbar' ),
        ], 200);
        
    } catch (Throwable $e) {
        return new WP_REST_Response([
            'success' => false,
            'message' =>esc_html__( 'An error occurred while updating settings', 'hashbar' ),
        ], 500);
    }
}


/**
 * Get all notifications
 *
 * @return WP_REST_Response Response object with notifications data
 */
function hashbar_get_notifications($request) {
    $args = array(
        'post_type'      => 'wphash_ntf_bar',
        'posts_per_page' => -1,
        'post_status'    => ['publish', 'draft', 'future']
    );

   $admin_settings = Hashbar_Settings_Panel_Settings::get_instance();
   $notification_enable_fields = $admin_settings->get_notification_enable_fields();
   $notification_keys = array_keys($notification_enable_fields);

    $notifications = get_posts($args);
    $notification_data = array();

    foreach ($notifications as $notification) {
        $enable_options = array();
        foreach ($notification_keys as $key) {
            $enable_options[$key] = get_post_meta($notification->ID, $key, true);
        };
        $notification_data[] = array(
            'id'      => $notification->ID,
            'title'   => $notification->post_title,
            'content' => $notification->post_content,
            'created_at' => $notification->post_date,
            'status'  => $notification->post_status == 'draft' ? 'none' : get_post_meta($notification->ID, '_wphash_notification_where_to_show', true),
            'settings' => [],
            'notification_enable_options' => $enable_options,
            'post_status' => $notification->post_status,
            'permalink' => get_post_permalink($notification->ID),
            'post_date' => $notification->post_date
        );
    }
    $response_data = array(
        'success' => true,
        'data'    => $notification_data
    );

    return new WP_REST_Response($response_data, 200);
}

/**
 * Get pages for settings selector
 */
function hashbar_get_pages() {
    $pages = get_pages([
        'post_status' => 'publish',
        'numberposts' => 150
    ]);
    
    $result = [];
    
    foreach ($pages as $page) {
        $result[] = [
            'id' => $page->ID,
            'title' => $page->post_title,
            'url' => get_permalink($page->ID)
        ];
    }
    
    return new WP_REST_Response($result, 200);
}

/**
 * Get posts for settings selector
 */
function hashbar_get_posts() {
    $posts = get_posts([
        'post_status' => 'publish',
        'numberposts' => 150
    ]);
    
    $result = [];
    
    foreach ($posts as $post) {
        $result[] = [
            'id' => $post->ID,
            'title' => $post->post_title,
            'url' =>get_permalink($post->ID)
        ];
    }
    
    return new WP_REST_Response($result, 200);
}

/**
 * Get analytics data including total views, clicks, and tracking information
 * 
 * @return WP_REST_Response Response object with analytics data
 */
function hashbar_get_analytics_data() {
    $total_tracking = get_transient('total_ht_traking_count') ?: array();
    $postwise_tracking = get_transient('postwise_ht_traking_count') ?: array();
    $country_tracking = get_transient('countrywise_ht_traking_count') ?: array();

    $trk_length = count($total_tracking);
    $total_clicks = $trk_length > 0 ? $total_tracking[0]['totalclicks'] : 0;
    $total_views = $trk_length > 0 ? $total_tracking[0]['totalviews'] : 0;
    $total_click_through_rate = $trk_length > 0 ? round(($total_tracking[0]['totalclicks']/$total_tracking[0]['totalviews'])*100, 2) : 0;

    // Format postwise tracking data
    $notification_stats = array();
    foreach ($postwise_tracking as $tracking) {
        if ('publish' === get_post_status($tracking['post_id'])) {
            $notification_stats[] = array(
                'title' => get_the_title($tracking['post_id']),
                'views' => $tracking['totalviews'],
                'clicks' => $tracking['totalclicks'],
                'through_rate' => round(($tracking['totalclicks']/$tracking['totalviews'])*100, 2)
            );
        }
    }

    // Format country tracking data
    $top_countries = array_map(function($country) {
        return array(
            'name' => $country['country']
        );
    }, $country_tracking);

    $response_data = array(
        'overview' => array(
            'total_clicks' => $total_clicks,
            'total_views' => $total_views,
            'click_through_rate' => $total_click_through_rate
        ),
        'notification_stats' => $notification_stats,
        'top_countries' => $top_countries
    );

    return new WP_REST_Response($response_data, 200);
}

// Reset settings to default values
function hashbar_reset_settings() {
    
    update_option('hashbar_wpnb_opt', null);
    return new WP_REST_Response([
        'success' => true,
        'message' => 'Settings reset successfully',
        'settings' => null
    ], 200);
}