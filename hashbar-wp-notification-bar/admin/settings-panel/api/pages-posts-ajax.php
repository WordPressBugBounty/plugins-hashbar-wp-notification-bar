<?php
namespace HashbarFree\API;

use WP_Query;
use Exception;

/**
 * AJAX handler for fetching pages and posts
 */
class PagesPostsAJAX {

    /**
     * Handler for gathering pages and posts
     */
    public static function get_pages_posts() {
        // Check permissions
        if (!current_user_can('manage_options')) {
            wp_send_json_error(['message' => 'Insufficient permissions']);
            wp_die();
        }

        $pages_args = [
            'post_type'      => 'page',
            'posts_per_page' => 100,
            'post_status'    => 'publish',
            'orderby'        => 'title',
            'order'          => 'ASC',
        ];

        $posts_args = [
            'post_type'      => 'post',
            'posts_per_page' => 100,
            'post_status'    => 'publish',
            'orderby'        => 'title',
            'order'          => 'ASC',
        ];

        try {
            $pages_query = new WP_Query($pages_args);
            $posts_query = new WP_Query($posts_args);

            $items = [];

            // Add pages
            if ($pages_query->have_posts()) {
                foreach ($pages_query->posts as $post) {
                    $items[] = [
                        'value' => (int)$post->ID,
                        'label' => '[Page] ' . sanitize_text_field($post->post_title),
                    ];
                }
            }

            // Add posts
            if ($posts_query->have_posts()) {
                foreach ($posts_query->posts as $post) {
                    $items[] = [
                        'value' => (int)$post->ID,
                        'label' => '[Post] ' . sanitize_text_field($post->post_title),
                    ];
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
