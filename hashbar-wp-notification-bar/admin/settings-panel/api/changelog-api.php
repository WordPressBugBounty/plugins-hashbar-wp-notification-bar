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
                'version' => '2.0.0',
                'date'    => '2026-07-22',
                'changes' => [
                    'Added' => [
                        'Content Container option in Announcement Bar Design tab — full width by default, or a custom boxed/centered width.',
                        'Close Button position options "Top Left" and "Top Right" for Announcement Bar.',
                    ],
                    'Improved' => [
                        'Announcement Bar Design tab reorganized into collapsible "Bar Style" and "Content Style" sections.',
                    ],
                    'Fixed' => [
                        'Countdown "Text Before Timer" showing default text when left empty.',
                        'Announcement Bar Content tab sometimes showing empty for older bars.',
                        'Duplicating an Announcement Bar sometimes not copying settings correctly.',
                    ],
                ],
            ],
            [
                'version' => '1.9.9',
                'date'    => '2026-07-02',
                'changes' => [
                    'Fixed' => [
                        'Countdown timer not initializing on the frontend (missing script dependency).',
                        'Countdown Block editor preview stuck at 00 (iframe editor canvas compatibility).',
                        'Countdown Block editor preview not updating when the date is changed.',
                    ],
                ],
            ],
            [
                'version' => '1.9.8',
                'date'    => '2026-06-16',
                'changes' => [
                    'Fixed' => [
                        'Conflict with The Events Calendar plugin.',
                        'Keyboard tab order for Notification Bar close button.',
                    ],
                ],
            ],
            [
                'version' => '1.9.7',
                'date'    => '2026-06-09',
                'changes' => [
                    'Added' => [
                        'Countdown timer custom labels (days/hours/minutes/seconds) in Announcement Bar.',
                        'Countdown timer style options for announcement bar.',
                        'Countdown expiry action option "Hide Bar/Show Message".',
                    ],
                    'Fixed' => [
                        'Countdown date picker issue.',
                    ],
                ],
            ],
            [
                'version' => '1.9.6',
                'date'    => '2026-05-23',
                'changes' => [
                    'Fixed' => [
                        'Close button keyboard accessibility for Notification Bar.',
                    ],
                    'Improved' => [
                        'Compatibility with the latest version of WordPress.',
                    ],
                ],
            ],
            [
                'version' => '1.9.5',
                'date'    => '2026-05-06',
                'changes' => [
                    'Fixed' => [
                        'Announcement Bar page targeting ("Specific pages/posts" and "All except") on the frontend.',
                        'Announcement Bar fixed-date countdown closing too soon in the last minute (frontend + Live Preview).',
                        'Notification Bar accessibility (region, keyboard, close markup).',
                        'Announcement message keeps Design typography when themes style paragraphs or links.',
                    ],
                    'Improved' => [
                        'Frontend accessibility for Announcement Bars and Popup Campaigns (landmarks, dialog labeling, focus).',
                    ],
                ],
            ],
            [
                'version' => '1.9.4',
                'date'    => '2026-04-07',
                'changes' => [
                    'Added' => [
                        'Reopen Button Styling section in Design tab with color, font, and border radius controls (Pro).',
                    ],
                    'Improved' => [
                        'Smooth height transition when Announcement Bar opens and closes (no more content jumping).',
                        'Cookie duration changes now take effect immediately without needing to clear browser cookies.',
                    ],
                    'Fixed' => [
                        'Reopen button not appearing when "Show on each page reload" cookie option is selected.',
                    ],
                ],
            ],
            [
                'version' => '1.9.3',
                'date'    => '2026-03-09',
                'changes' => [
                    'Added' => [
                        'Configurable limits for Posts, Pages, and Products list loading in Settings.',
                        'Server-side search for page/post selection in Announcement Bar, Popup Campaign, and Notification targeting.',
                    ],
                    'Improved' => [
                        'Eliminated duplicate database queries on admin settings page load.',
                        'Popup Campaign targeting tab no longer re-fetches data when switching tabs.',
                    ],
                    'Fixed' => [
                        'Admin settings page timeout on WooCommerce sites with large product catalogs.',
                    ],
                ],
            ],
            [
                'version' => '1.9.2',
                'date'    => '2026-02-25',
                'changes' => [
                    'Added' => [
                        'Content element drag-and-drop ordering in Design tab for Popup Campaigns.',
                        'Image Width control with px/% unit toggle for Popup Campaigns.',
                        'Image Alignment option based on image position for Popup Campaigns.',
                        'Image Border Radius control with individual corner inputs for Popup Campaigns.',
                        'Flash Sale, Cyber Monday, and Split E-commerce templates for Popup Campaigns (Pro).',
                        'Content Wrapper Styles section for Popup Campaigns.',
                    ],
                    'Improved' => [
                        'Popup Campaign editor tabs now use responsive overflow menu instead of horizontal scroll.',
                        'Collapsible sections in Popup Campaign Design tab for better navigation.',
                        'Announcement Bar editor header restyled with inline title input.',
                    ],
                    'Fixed' => [
                        'Cookie interfering with server-side caching.',
                        'User Targeting "Show To" option not working for Popup Campaigns (Guests Only setting was ignored).',
                        'HTML rendering in heading, subheading, and description fields for Popup Campaigns.',
                        'CTA Button Styling section not showing intermittently in Announcement Bar Design tab.',
                        'Publish/Update button text now correctly shows "Update" when editing existing items.',
                    ],
                ],
            ],
            [
                'version' => '1.9.1',
                'date'    => '2026-02-08',
                'changes' => [
                    'Added' => [
                        'Delay After Click option for On Element Click popup trigger (Pro).',
                    ],
                    'Improved' => [
                        '2-column layout for Exit Intent and On Element Click trigger settings.',
                    ],
                    'Fixed' => [
                        'Close Button Reopen issue in Notification bar.',
                    ],
                ],
            ],
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