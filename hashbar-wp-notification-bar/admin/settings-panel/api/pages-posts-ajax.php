<?php
namespace HashbarFree\API;

use WP_Query;
use Exception;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * AJAX handler for fetching pages and posts
 */
class PagesPostsAJAX {

    /**
     * Handler for gathering pages and posts
     * Supports optional 'search' and 'post_type' parameters for server-side search
     */
    public static function get_pages_posts() {
        // Check permissions
        if (!current_user_can('manage_options')) {
            wp_send_json_error(['message' => 'Insufficient permissions']);
            wp_die();
        }

        // Verify nonce (the settings panel localizes the same 'wp_rest' nonce used for its REST calls)
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['_wpnonce'])), 'wp_rest')) {
            wp_send_json_error(['message' => 'Invalid nonce']);
            wp_die();
        }

        $search = isset($_POST['search']) ? sanitize_text_field(wp_unslash($_POST['search'])) : '';
        $post_type = isset($_POST['post_type']) ? sanitize_text_field(wp_unslash($_POST['post_type'])) : '';

        // Read saved limits from settings
        $hashbar_options = get_option('hashbar_wpnb_opt', array());
        $limits = array(
            'post'    => isset($hashbar_options['posts_limit']) && $hashbar_options['posts_limit'] !== '' ? intval($hashbar_options['posts_limit']) : 20,
            'page'    => isset($hashbar_options['pages_limit']) && $hashbar_options['pages_limit'] !== '' ? intval($hashbar_options['pages_limit']) : 20,
            'product' => isset($hashbar_options['product_limit']) && $hashbar_options['product_limit'] !== '' ? intval($hashbar_options['product_limit']) : 20,
        );

        // When searching, use a higher limit to find matches beyond the initial load
        $is_searching = !empty($search);

        // Pages, posts and every targetable custom post type (names only, no queries)
        $custom_types  = function_exists('hashbar_get_targetable_post_types') ? hashbar_get_targetable_post_types() : [];
        $post_type_map = ['page' => __('Pages', 'hashbar-wp-notification-bar'), 'post' => __('Posts', 'hashbar-wp-notification-bar')] + $custom_types;

        // Determine which post types to query: a single requested type, else pages + posts
        // Pages, posts and products are free; other post types are Pro-only
        $allowed_types = ['post', 'page', 'product'];
        if (defined('HASHBAR_WPNBP_VERSION')) {
            $allowed_types = array_values(array_unique(array_merge($allowed_types, array_keys($custom_types))));
        }
        if ($post_type && in_array($post_type, $allowed_types, true)) {
            $types_to_query = [$post_type];
        } else {
            $types_to_query = ['page', 'post'];
        }

        // Resolve specific post IDs (already-selected items) to labels and types
        $ids = isset($_POST['ids']) ? array_filter(array_map('absint', explode(',', sanitize_text_field(wp_unslash($_POST['ids']))))) : [];
        if ($ids) {
            $resolved = [];
            $id_query = new WP_Query([
                'post_type'      => $allowed_types,
                'post__in'       => $ids,
                'posts_per_page' => count($ids),
                'post_status'    => 'publish',
                'orderby'        => 'post__in',
                'no_found_rows'          => true,
                'update_post_meta_cache' => false,
                'update_post_term_cache' => false,
            ]);
            foreach ($id_query->posts as $post) {
                $type_obj   = get_post_type_object($post->post_type);
                $type_label = $type_obj ? $type_obj->labels->singular_name : ucfirst($post->post_type);
                $resolved[] = [
                    'value' => (string)$post->ID,
                    'label' => '[' . $type_label . '] ' . sanitize_text_field($post->post_title),
                    'title' => sanitize_text_field($post->post_title),
                    'type'  => $post->post_type,
                ];
            }
            echo json_encode(['success' => true, 'data' => $resolved, 'total' => count($resolved), 'post_types' => $post_type_map]);
            wp_die();
        }

        try {
            $items = [];
            $show_type_prefix = count($types_to_query) > 1;

            foreach ($types_to_query as $type) {
                // Use saved limit for initial load, 100 for search
                $per_page = $is_searching ? 100 : ($limits[$type] ?? 20);

                $args = [
                    'post_type'      => $type,
                    'posts_per_page' => $per_page,
                    'post_status'    => 'publish',
                    'orderby'        => 'title',
                    'order'          => 'ASC',
                    'no_found_rows'          => true,
                    'update_post_meta_cache' => false,
                    'update_post_term_cache' => false,
                ];

                if ($search) {
                    $args['s'] = $search;
                }

                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    foreach ($query->posts as $post) {
                        $type_obj   = get_post_type_object($type);
                        $type_label = $type_obj ? $type_obj->labels->singular_name : ucfirst($type);
                        $label = $show_type_prefix
                            ? '[' . $type_label . '] ' . sanitize_text_field($post->post_title)
                            : sanitize_text_field($post->post_title);

                        $items[] = [
                            'value' => (string)$post->ID,
                            'label' => $label,
                            'title' => sanitize_text_field($post->post_title),
                            'type'  => $type,
                        ];
                    }
                }
            }

            // Sort alphabetically
            usort($items, function($a, $b) {
                return strcmp($a['label'], $b['label']);
            });

            // Return response
            echo json_encode([
                'success' => true,
                'data'    => $items,
                'total'   => count($items),
                'post_types' => $post_type_map,
            ]);
            wp_die();

        } catch (Exception $e) {
            wp_send_json_error(['message' => $e->getMessage()]);
            wp_die();
        }
    }
}

// Register AJAX handlers
add_action('wp_ajax_hashbar_get_pages_posts', [ PagesPostsAJAX::class, 'get_pages_posts' ], 10);
add_action('wp_ajax_nopriv_hashbar_get_pages_posts', [ PagesPostsAJAX::class, 'get_pages_posts' ], 10);
