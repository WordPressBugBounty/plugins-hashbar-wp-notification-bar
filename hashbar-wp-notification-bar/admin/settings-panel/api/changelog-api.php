<?php
namespace hashbarOptions\Api;

use WP_REST_Controller;
use WP_Error;

/**
 * Changelog Handler
 */
class ChangeLog extends WP_REST_Controller {

    /**
     * Instance
     */
    private static $_instance = null;

    /**
     * Get instance
     */
    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->namespace = 'hashbar/v1';
        $this->rest_base = 'changelog';

        // Register routes on REST API init
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    /**
     * Register Routes
     */
    public function register_routes() {
        // Get changelog data
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base,
            [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [$this, 'get_changelog'],
                    'permission_callback' => [$this, 'permissions_check'],
                ]
            ]
        );

        // Mark as read
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/mark-read',
            [
                [
                    'methods'             => \WP_REST_Server::CREATABLE,
                    'callback'            => [$this, 'mark_as_read'],
                    'permission_callback' => [$this, 'permissions_check'],
                ]
            ]
        );

        // Get notification status
        register_rest_route(
            $this->namespace,
            '/' . $this->rest_base . '/status',
            [
                [
                    'methods'             => \WP_REST_Server::READABLE,
                    'callback'            => [$this, 'get_status'],
                    'permission_callback' => [$this, 'permissions_check'],
                ]
            ]
        );
    }

    /**
     * Permission Check
     */
    public function permissions_check($request) {
        if (!current_user_can('manage_options')) {
            return new WP_Error(
                'rest_forbidden',
                esc_html__('You do not have permissions to manage this resource.', 'hashbar'),
                ['status' => 401]
            );
        }
        return true;
    }

    /**
     * Get Changelog Data
     */
    public function get_changelog($request) {
        try {
            // Get changelog data from your source
            $changelog = $this->get_changelog_data();
            
            return rest_ensure_response([
                'success' => true,
                'data'    => $changelog
            ]);

        } catch (\Exception $e) {
            return new WP_Error(
                'changelog_error',
                $e->getMessage(),
                ['status' => 500]
            );
        }
    }

    /**
     * Mark Changelog as Read
     */
    public function mark_as_read($request) {
        try {
            $user_id = get_current_user_id();
            $last_version = $this->get_latest_version();
            
            update_user_meta($user_id, 'hashbar_changelog_read', $last_version);
            
            return rest_ensure_response([
                'success' => true,
                'message' => __('Marked as read successfully', 'hashbar')
            ]);

        } catch (\Exception $e) {
            return new WP_Error(
                'mark_read_error',
                $e->getMessage(),
                ['status' => 500]
            );
        }
    }

    /**
     * Get Notification Status
     */
    public function get_status($request) {
        try {
            $user_id = get_current_user_id();
            $last_read = get_user_meta($user_id, 'hashbar_changelog_read', true);
            $latest_version = $this->get_latest_version();
            
            $has_unread = version_compare($last_read, $latest_version, '<');
            
            return rest_ensure_response([
                'success' => true,
                'data'    => [
                    'has_unread' => $has_unread,
                    'last_read'  => $last_read,
                    'latest'     => $latest_version
                ]
            ]);

        } catch (\Exception $e) {
            return new WP_Error(
                'status_error',
                $e->getMessage(),
                ['status' => 500]
            );
        }
    }

    /**
     * Get Latest Version
     */
    private function get_latest_version() {
        $changelog = $this->get_changelog_data();
        return !empty($changelog[0]['version']) ? $changelog[0]['version'] : '1.0.0';
    }

    /**
     * Get Changelog Data
     */
    private function get_changelog_data() {
        return [
            [
                'version' => '1.9.0',
                'date'    => '2026-01-28',
                'changes' => [
                    'Added' => [
                        'Popup Campaign with templates, 8 campaign types, 7 positions, and 8 smart triggers.',
                        'Form Builder with 11 field types and Mailchimp integration.',
                        'Popup Countdown Timer, Coupon Display, and 15 Animations.',
                        'Popup Analytics Dashboard and A/B Testing (Pro).',
                        'Default CTA button text and sticky live preview in Announcement Bar Editor.',
                    ],
                    'Improved' => [
                        'Page targeting and typography sections in Announcement Bar Editor.',
                        'Timezone select option with Site and visitor Timezone in Announcement Bar.',
                    ],
                ],
            ],
            [
                'version' => '1.8.0',
                'date'    => '2026-01-06',
                'changes' => [
                    'Added' => [
                        'Modern Announcement Bar with Templates, Countdown timer, Targeting, Position, Animation, and Scheduling options.',
                        'Announcement Bar Analytics for tracking impressions, clicks, and CTR.',
                        'Coupon code display with copy functionality for Announcement Bars.',
                    ],
                    'Improved' => [
                        'UI/UX for a better user experience.',
                    ],
                ],
            ],
            [
                'version' => '1.7.5',
                'date'    => '2025-11-13',
                'changes' => [
                    'Fixed' => [
                        'Admin notice display issue.',
                    ],
                ],
            ],
            [
                'version' => '1.7.4',
                'date'    => '2025-10-23',
                'changes' => [
                    'Improved' => [
                        'Minor UI update and optimizations.',
                    ],
                ],
            ],
            [
                'version' => '1.7.3',
                'date'    => '2025-10-13',
                'changes' => [
                    'Added' => [
                        'Added: Scheduled Notifications filter option in notification list.',
                    ],
                    'Improved' => [
                        'Improved: Filter logic to show only active scheduled notifications.',
                    ],
                    'Fixed' => [
                        'Fixed: Pagination reset issue when changing filters or search query.',
                    ],
                ],
            ],
            [
                'version' => '1.7.2',
                'date'    => '2025-09-22',
                'changes' => [
                    'Fixed' => [
                        'Fixed: Schedule Notification Display issue.',
                        'Fixed: Draft Notification Switcher Enable/Disable issue.',
                        'Fixed: A few minor issues.'
                    ],
                ],
            ],
            [
                'version' => '1.7.1',
                'date'    => '2025-08-06',
                'changes' => [
                    'Fixed' => [
                        'Fixed: Analytics Enable/Disable issue.'
                    ],
                ],
            ],
            [
                'version' => '1.7.0',
                'date'    => '2025-08-06',
                'changes' => [
                    'Improved' => [
                        'UI/UX for a better user experience.'
                    ],
                    'Fixed' => [
                        'Analytics report display issue.'
                    ],
                ],
            ],
            [
                'version' => '1.6.1',
                'date'    => '2025-06-17',
                'changes' => [
                    'Fixed' => [
                        'Notification position value change issue on reload.'
                    ],
                ],
            ],
            [
                'version' => '1.6.0',
                'date'    => '2025-04-16',
                'changes' => [
                    'Added' => [
                        'Compatibility with the latest WordPress version.'
                    ],
                ],
            ],
            [
                'version' => '1.5.9',
                'date'    => '2025-03-05',
                'changes' => [
                    'Fixed' => [
                        'Notice dismiss issue.'
                    ],
                ],
            ],
            [
                'version' => '1.5.8',
                'date'    => '2025-02-04',
                'changes' => [
                    'Added' => [
                        'Option to enable/disable sticky notification bar on top.'
                    ],
                ],
            ]
        ];
    }
    
}

// Initialize the changelog
\hashbarOptions\Api\ChangeLog::instance();