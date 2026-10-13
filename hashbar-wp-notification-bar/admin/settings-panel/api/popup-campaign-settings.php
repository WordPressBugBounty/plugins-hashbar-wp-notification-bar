<?php
/**
 * Popup Campaign Settings Localization
 *
 * Provides all field definitions, labels, options, and configurations
 * for the popup campaign editor in a centralized localization file.
 *
 * @package HashBar
 * @since 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Popup Campaign Settings Localization Class
 *
 * Handles all localized strings and field definitions for the popup campaign editor.
 */
class Hashbar_Popup_Campaign_Settings {

	/**
	 * Check if Pro version is active
	 *
	 * @return bool
	 */
	public static function is_pro() {
		return defined( 'HASHBAR_WPNBP_VERSION' );
	}

	/**
	 * Get template preview image URL
	 *
	 * @param string $filename The image filename (e.g., 'discount-coupon.png')
	 * @return string Full URL to the template preview image
	 */
	public static function get_template_preview_url( $filename ) {
		if ( empty( $filename ) ) {
			return '';
		}
		if ( defined( 'HASHBAR_TEMPLATE_IMG_SOURCE' ) && 'external' === HASHBAR_TEMPLATE_IMG_SOURCE ) {
			$base = defined( 'HASHBAR_TEMPLATE_IMG_URL' ) ? HASHBAR_TEMPLATE_IMG_URL : '';
			return trailingslashit( $base ) . 'popup/preview/' . $filename;
		}
		return plugins_url( 'hashbar-templates-library-src/popup/preview/' . $filename, dirname( dirname( dirname( __FILE__ ) ) ) );
	}

	/**
	 * Get full URL for a template content image (e.g., product images used in template configs)
	 *
	 * @param string $filename The image filename
	 * @return string Full URL to the template image
	 */
	public static function get_template_image_url( $filename ) {
		if ( empty( $filename ) ) {
			return '';
		}
		if ( defined( 'HASHBAR_TEMPLATE_IMG_SOURCE' ) && 'external' === HASHBAR_TEMPLATE_IMG_SOURCE ) {
			$base = defined( 'HASHBAR_TEMPLATE_IMG_URL' ) ? HASHBAR_TEMPLATE_IMG_URL : '';
			return trailingslashit( $base ) . 'popup/images/' . $filename;
		}
		return plugins_url( 'hashbar-templates-library-src/popup/images/' . $filename, dirname( dirname( dirname( __FILE__ ) ) ) );
	}

	/**
	 * Get editor tab definitions
	 *
	 * @return array
	 */
	public static function get_editor_tabs() {
		return array(
			array(
				'key'   => 'templates',
				'icon'  => 'AppstoreOutlined',
				'label' => esc_html__( 'Templates', 'hashbar-wp-notification-bar' ),
			),
			array(
				'key'   => 'basic',
				'icon'  => 'SettingOutlined',
				'label' => esc_html__( 'Basic', 'hashbar-wp-notification-bar' ),
			),
			array(
				'key'   => 'content',
				'icon'  => 'FormOutlined',
				'label' => esc_html__( 'Content', 'hashbar-wp-notification-bar' ),
			),
			array(
				'key'   => 'form',
				'icon'  => 'FileTextOutlined',
				'label' => esc_html__( 'Form', 'hashbar-wp-notification-bar' ),
				'isPro' => false,
			),
			array(
				'key'   => 'countdown',
				'icon'  => 'FieldTimeOutlined',
				'label' => esc_html__( 'Countdown', 'hashbar-wp-notification-bar' ),
				'isPro' => false,
			),
			array(
				'key'   => 'coupon',
				'icon'  => 'GiftOutlined',
				'label' => esc_html__( 'Coupon', 'hashbar-wp-notification-bar' ),
				'isPro' => false,
			),
			array(
				'key'   => 'design',
				'icon'  => 'BgColorsOutlined',
				'label' => esc_html__( 'Design', 'hashbar-wp-notification-bar' ),
			),
			array(
				'key'   => 'triggers',
				'icon'  => 'ThunderboltOutlined',
				'label' => esc_html__( 'Triggers', 'hashbar-wp-notification-bar' ),
			),
			array(
				'key'   => 'targeting',
				'icon'  => 'AimOutlined',
				'label' => esc_html__( 'Targeting', 'hashbar-wp-notification-bar' ),
			),
			array(
				'key'   => 'frequency',
				'icon'  => 'ClockCircleOutlined',
				'label' => esc_html__( 'Frequency', 'hashbar-wp-notification-bar' ),
				'isPro' => false,
			),
			array(
				'key'   => 'schedule',
				'icon'  => 'CalendarOutlined',
				'label' => esc_html__( 'Schedule', 'hashbar-wp-notification-bar' ),
				'isPro' => false,
			),
			array(
				'key'   => 'animation',
				'icon'  => 'PlayCircleOutlined',
				'label' => esc_html__( 'Animation', 'hashbar-wp-notification-bar' ),
				'isPro' => false,
			),
		);
	}

	/**
	 * Get Basic Tab field definitions
	 *
	 * @return array
	 */
	public static function get_basic_fields() {
		return array(
			'section_popup_type' => array(
				'type'        => 'section',
				'label'       => esc_html__( 'Popup Position', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Choose the position and display style of your popup', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_position' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Popup Position', 'hashbar-wp-notification-bar' ),
				'default' => 'center',
				'options' => array(
					'center'       => esc_html__( 'Center Modal', 'hashbar-wp-notification-bar' ),
					'bottom_right' => esc_html__( 'Bottom Right Slide-in', 'hashbar-wp-notification-bar' ),
					'bottom_left'  => esc_html__( 'Bottom Left Slide-in', 'hashbar-wp-notification-bar' ),
					'fullscreen'   => esc_html__( 'Fullscreen Overlay', 'hashbar-wp-notification-bar' ),
					'side_left'    => esc_html__( 'Left Side Panel', 'hashbar-wp-notification-bar' ),
					'side_right'   => esc_html__( 'Right Side Panel', 'hashbar-wp-notification-bar' ),
					'floating'     => esc_html__( 'Floating Box', 'hashbar-wp-notification-bar' ),
				),
				'isPro' => array( 'fullscreen', 'side_left', 'side_right' ),
			),
			'_wphash_popup_campaign_type' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Campaign Type', 'hashbar-wp-notification-bar' ),
				'default' => 'lead_capture',
				'options' => array(
					'lead_capture'   => esc_html__( 'Lead Capture (Email Collection)', 'hashbar-wp-notification-bar' ),
					'announcement'   => esc_html__( 'Announcement', 'hashbar-wp-notification-bar' ),
					'promotion'      => esc_html__( 'Promotion / Discount', 'hashbar-wp-notification-bar' ),
					'survey'         => esc_html__( 'Survey / Feedback', 'hashbar-wp-notification-bar' ),
					'exit_intent'    => esc_html__( 'Exit Intent Offer', 'hashbar-wp-notification-bar' ),
					'welcome'        => esc_html__( 'Welcome Message', 'hashbar-wp-notification-bar' ),
					'age_verify'     => esc_html__( 'Age Verification', 'hashbar-wp-notification-bar' ),
					'cookie_consent' => esc_html__( 'Cookie Consent', 'hashbar-wp-notification-bar' ),
				),
				'isPro' => array( 'survey', 'age_verify', 'cookie_consent' ),
			),
			'section_popup_settings' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Popup Settings', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_overlay_enabled' => array(
				'type'    => 'switch',
				'label'   => esc_html__( 'Show Background Overlay', 'hashbar-wp-notification-bar' ),
				'default' => true,
			),
			'_wphash_popup_overlay_close' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Close on Overlay Click', 'hashbar-wp-notification-bar' ),
				'default'   => true,
				'condition' => array(
					'key'      => '_wphash_popup_overlay_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_close_enabled' => array(
				'type'    => 'switch',
				'label'   => esc_html__( 'Show Close Button', 'hashbar-wp-notification-bar' ),
				'default' => true,
			),
			'_wphash_popup_close_position' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Close Button Position', 'hashbar-wp-notification-bar' ),
				'default'   => 'top_right',
				'options'   => array(
					'top_right' => esc_html__( 'Top Right', 'hashbar-wp-notification-bar' ),
					'top_left'  => esc_html__( 'Top Left', 'hashbar-wp-notification-bar' ),
					'outside'   => esc_html__( 'Outside Popup', 'hashbar-wp-notification-bar' ),
				),
				'isPro' => array( 'outside' ),
				'condition' => array(
					'key'      => '_wphash_popup_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_esc_close' => array(
				'type'    => 'switch',
				'label'   => esc_html__( 'Close on ESC Key', 'hashbar-wp-notification-bar' ),
				'default' => true,
			),
		);
	}

	/**
	 * Get Content Tab field definitions
	 *
	 * @return array
	 */
	public static function get_content_fields() {
		return array(
			'section_content_type' => array(
				'type'        => 'section',
				'label'       => esc_html__( 'Content Source', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Choose how to populate your popup content', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_content_type' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Content Type', 'hashbar-wp-notification-bar' ),
				'default' => 'custom',
				'options' => array(
					'custom'        => esc_html__( 'Custom Content (Built-in Editor)', 'hashbar-wp-notification-bar' ),
					'custom_html'   => esc_html__( 'Visual Editor', 'hashbar-wp-notification-bar' ),
					'ht_form'       => esc_html__( 'HT Contact Form', 'hashbar-wp-notification-bar' ),
					'cf7'           => esc_html__( 'Contact Form 7', 'hashbar-wp-notification-bar' ),
					'wpforms'       => esc_html__( 'WPForms', 'hashbar-wp-notification-bar' ),
					'ninja_forms'   => esc_html__( 'Ninja Forms', 'hashbar-wp-notification-bar' ),
					'gravity_forms' => esc_html__( 'Gravity Forms', 'hashbar-wp-notification-bar' ),
					'fluent_forms'  => esc_html__( 'Fluent Forms', 'hashbar-wp-notification-bar' ),
					'shortcode'     => esc_html__( 'Any Shortcode', 'hashbar-wp-notification-bar' ),
				),
				'isPro' => array( 'cf7','gravity_forms','shortcode','wpforms','ninja_forms','fluent_forms','custom_html' ),
			),
			'_wphash_popup_cf7_form_id' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Select Contact Form 7 Form', 'hashbar-wp-notification-bar' ),
				'options'   => 'dynamic',
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'cf7',
				),
			),
			'_wphash_popup_wpforms_form_id' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Select WPForms Form', 'hashbar-wp-notification-bar' ),
				'options'   => 'dynamic',
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'wpforms',
				),
			),
			'_wphash_popup_ninja_form_id' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Select Ninja Forms Form', 'hashbar-wp-notification-bar' ),
				'options'   => 'dynamic',
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'ninja_forms',
				),
			),
			'_wphash_popup_gravity_form_id' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Select Gravity Forms Form', 'hashbar-wp-notification-bar' ),
				'options'   => 'dynamic',
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'gravity_forms',
				),
			),
			'_wphash_popup_fluent_form_id' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Select Fluent Forms Form', 'hashbar-wp-notification-bar' ),
				'options'   => 'dynamic',
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'fluent_forms',
				),
			),
			'_wphash_popup_ht_form_id' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Select HT Contact Form', 'hashbar-wp-notification-bar' ),
				'options'   => 'dynamic',
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'ht_form',
				),
			),
			'_wphash_popup_shortcode' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Shortcode', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( '[your_shortcode]', 'hashbar-wp-notification-bar' ),
				'condition'   => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'shortcode',
				),
			),
			'_wphash_popup_custom_html' => array(
				'type'        => 'wp_editor',
				'label'       => esc_html__( 'Custom Content', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Create your custom popup content using the visual editor. Supports text formatting, images, embeds, and shortcodes.', 'hashbar-wp-notification-bar' ),
				'default'     => '',
				'settings'    => array(
					'media_buttons' => true,
					'textarea_rows' => 10,
					'teeny'         => false,
					'quicktags'     => true,
				),
				'condition'   => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom_html',
				),
			),
			'section_popup_content' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'Popup Content', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_image' => array(
				'type'      => 'image',
				'label'     => esc_html__( 'Popup Image', 'hashbar-wp-notification-bar' ),
				'default'   => array(
					'url' => '',
					'id'  => 0,
				),
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_image_position' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Image Position', 'hashbar-wp-notification-bar' ),
				'default'   => 'top',
				'options'   => array(
					'top'        => esc_html__( 'Top', 'hashbar-wp-notification-bar' ),
					'left'       => esc_html__( 'Left Side', 'hashbar-wp-notification-bar' ),
					'right'      => esc_html__( 'Right Side', 'hashbar-wp-notification-bar' ),
					'bottom'     => esc_html__( 'Bottom', 'hashbar-wp-notification-bar' ),
					'background' => esc_html__( 'Background', 'hashbar-wp-notification-bar' ),
				),
				'isPro'     => array( 'left', 'right', 'background' ),
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_image_width' => array(
				'type'    => 'number',
				'label'   => esc_html__( 'Image Width', 'hashbar-wp-notification-bar' ),
				'default' => 100,
				'min'     => 10,
				'max'     => 1000,
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_image_width_unit' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Image Width Unit', 'hashbar-wp-notification-bar' ),
				'default' => '%',
				'options' => array(
					'%'  => '%',
					'px' => 'px',
				),
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_image_alignment' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Image Alignment', 'hashbar-wp-notification-bar' ),
				'default' => 'center',
				'options' => array(
					'left'   => esc_html__( 'Left', 'hashbar-wp-notification-bar' ),
					'center' => esc_html__( 'Center', 'hashbar-wp-notification-bar' ),
					'right'  => esc_html__( 'Right', 'hashbar-wp-notification-bar' ),
					'top'    => esc_html__( 'Top', 'hashbar-wp-notification-bar' ),
					'bottom' => esc_html__( 'Bottom', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_image_border_radius' => array(
				'type'    => 'spacing',
				'label'   => esc_html__( 'Image Border Radius', 'hashbar-wp-notification-bar' ),
				'default' => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
				'unit'    => 'px',
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_heading' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Heading', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'Enter your heading here', 'hashbar-wp-notification-bar' ),
				'default'     => esc_html__( 'Subscribe to our Newsletter', 'hashbar-wp-notification-bar' ),
				'maxLength'   => 100,
				'condition'   => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_subheading' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Subheading', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'Enter your subheading here', 'hashbar-wp-notification-bar' ),
				'default'     => '',
				'maxLength'   => 150,
				'condition'   => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_description' => array(
				'type'        => 'textarea',
				'label'       => esc_html__( 'Description', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'Enter your message here (max 500 characters)', 'hashbar-wp-notification-bar' ),
				'default'     => esc_html__( 'Get exclusive updates and offers delivered straight to your inbox.', 'hashbar-wp-notification-bar' ),
				'maxLength'   => 500,
				'rows'        => 4,
				'condition'   => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'section_cta_button' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'Call-to-Action Button', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_cta_enabled' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Show CTA Button', 'hashbar-wp-notification-bar' ),
				'default'   => true,
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_cta_text' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Button Text', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'e.g., Shop Now, Learn More', 'hashbar-wp-notification-bar' ),
				'default'     => esc_html__( 'Get Started', 'hashbar-wp-notification-bar' ),
				'condition'   => array(
					'key'      => '_wphash_popup_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_cta_url' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Button URL', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'https://example.com', 'hashbar-wp-notification-bar' ),
				'default'     => '#',
				'condition'   => array(
					'key'      => '_wphash_popup_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_cta_target' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Link Target', 'hashbar-wp-notification-bar' ),
				'default'   => '_self',
				'options'   => array(
					'_self'  => esc_html__( 'Open in Same Window', 'hashbar-wp-notification-bar' ),
					'_blank' => esc_html__( 'Open in New Tab', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_popup_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_cta_close_on_click' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Close Popup on Click', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'condition' => array(
					'key'      => '_wphash_popup_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_confirmation_page_id' => array(
				'type'        => 'page-select',
				'label'       => esc_html__( 'Confirmation Page', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Select your order confirmation / thank-you page to automatically track purchases as conversions', 'hashbar-wp-notification-bar' ),
				'default'     => 0,
				'condition'   => array(
					'key'      => '_wphash_popup_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_secondary_button' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'Secondary Button', 'hashbar-wp-notification-bar' ),
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_secondary_enabled' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Show Secondary Button', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_content_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			'_wphash_popup_secondary_text' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Secondary Button Text', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'e.g., No Thanks', 'hashbar-wp-notification-bar' ),
				'default'     => esc_html__( 'No Thanks', 'hashbar-wp-notification-bar' ),
				'isPro'       => true,
				'condition'   => array(
					'key'      => '_wphash_popup_secondary_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_secondary_action' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Secondary Button Action', 'hashbar-wp-notification-bar' ),
				'default'   => 'close',
				'options'   => array(
					'close'   => esc_html__( 'Close Popup', 'hashbar-wp-notification-bar' ),
					'url'     => esc_html__( 'Go to URL', 'hashbar-wp-notification-bar' ),
					'dismiss' => esc_html__( 'Dismiss Forever', 'hashbar-wp-notification-bar' ),
				),
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_secondary_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
		);
	}

	/**
	 * Get Form Tab field definitions
	 *
	 * @return array
	 */
	public static function get_form_fields() {
		return array(
			'section_form_builder' => array(
				'type'        => 'section',
				'label'       => esc_html__( 'Form Builder', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Build your popup form with custom fields', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_form_enabled' => array(
				'type'    => 'switch',
				'label'   => esc_html__( 'Enable Built-in Form', 'hashbar-wp-notification-bar' ),
				'default' => true,
			),
			'_wphash_popup_form_fields' => array(
				'type'       => 'form-builder',
				'label'      => esc_html__( 'Form Fields', 'hashbar-wp-notification-bar' ),
				'default'    => array(
					array(
						'id'          => 'field_email',
						'type'        => 'email',
						'label'       => esc_html__( 'Email Address', 'hashbar-wp-notification-bar' ),
						'placeholder' => esc_html__( 'Enter your email', 'hashbar-wp-notification-bar' ),
						'required'    => true,
						'width'       => 'full',
					),
				),
				'fieldTypes' => array(
					'email'    => array(
						'label' => esc_html__( 'Email', 'hashbar-wp-notification-bar' ),
						'icon'  => 'MailOutlined',
						'isPro' => false,
					),
					'name'     => array(
						'label' => esc_html__( 'Name', 'hashbar-wp-notification-bar' ),
						'icon'  => 'UserOutlined',
						'isPro' => false,
					),
					'checkbox' => array(
						'label' => esc_html__( 'Checkbox', 'hashbar-wp-notification-bar' ),
						'icon'  => 'CheckSquareOutlined',
						'isPro' => false,
					),
					'text'     => array(
						'label' => esc_html__( 'Text', 'hashbar-wp-notification-bar' ),
						'icon'  => 'FontSizeOutlined',
						'isPro' => true,
					),
					'textarea' => array(
						'label' => esc_html__( 'Textarea', 'hashbar-wp-notification-bar' ),
						'icon'  => 'AlignLeftOutlined',
						'isPro' => true,
					),
					'phone'    => array(
						'label' => esc_html__( 'Phone', 'hashbar-wp-notification-bar' ),
						'icon'  => 'PhoneOutlined',
						'isPro' => true,
					),
					'dropdown' => array(
						'label' => esc_html__( 'Dropdown', 'hashbar-wp-notification-bar' ),
						'icon'  => 'DownOutlined',
						'isPro' => true,
					),
					'radio'    => array(
						'label' => esc_html__( 'Radio Buttons', 'hashbar-wp-notification-bar' ),
						'icon'  => 'CheckCircleOutlined',
						'isPro' => true,
					),
					'date'     => array(
						'label' => esc_html__( 'Date Picker', 'hashbar-wp-notification-bar' ),
						'icon'  => 'CalendarOutlined',
						'isPro' => true,
					),
					'hidden'   => array(
						'label' => esc_html__( 'Hidden Field', 'hashbar-wp-notification-bar' ),
						'icon'  => 'EyeInvisibleOutlined',
						'isPro' => true,
					),
					'consent'  => array(
						'label' => esc_html__( 'GDPR Consent', 'hashbar-wp-notification-bar' ),
						'icon'  => 'SafetyOutlined',
						'isPro' => true,
					),
				),
				'condition'  => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_form_submit' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'Submit Button', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_submit_text' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Submit Button Text', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'e.g., Subscribe, Submit', 'hashbar-wp-notification-bar' ),
				'default'     => esc_html__( 'Subscribe', 'hashbar-wp-notification-bar' ),
				'condition'   => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_submitting_text' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Submitting Text', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'e.g., Submitting...', 'hashbar-wp-notification-bar' ),
				'default'     => esc_html__( 'Submitting...', 'hashbar-wp-notification-bar' ),
				'condition'   => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_form_success' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'Success Behavior', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_success_action' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'After Submission', 'hashbar-wp-notification-bar' ),
				'default'   => 'message',
				'options'   => array(
					'message'  => esc_html__( 'Show Success Message', 'hashbar-wp-notification-bar' ),
					'redirect' => esc_html__( 'Redirect to URL', 'hashbar-wp-notification-bar' ),
					'close'    => esc_html__( 'Close Popup', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_success_message' => array(
				'type'        => 'textarea',
				'label'       => esc_html__( 'Success Message', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'Thank you for subscribing!', 'hashbar-wp-notification-bar' ),
				'default'     => esc_html__( 'Thank you! You have successfully subscribed.', 'hashbar-wp-notification-bar' ),
				'rows'        => 3,
				'condition'   => array(
					'key'      => '_wphash_popup_form_success_action',
					'operator' => '==',
					'value'    => 'message',
				),
			),
			'_wphash_popup_form_success_redirect_url' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Redirect URL', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'https://example.com/thank-you', 'hashbar-wp-notification-bar' ),
				'condition'   => array(
					'key'      => '_wphash_popup_form_success_action',
					'operator' => '==',
					'value'    => 'redirect',
				),
			),
			'_wphash_popup_form_close_delay' => array(
				'type'      => 'number',
				'label'     => esc_html__( 'Close Delay (seconds)', 'hashbar-wp-notification-bar' ),
				'default'   => 3,
				'min'       => 1,
				'max'       => 30,
				'condition' => array(
					'key'      => '_wphash_popup_form_success_action',
					'operator' => '==',
					'value'    => 'close',
				),
			),
			'section_email_integrations' => array(
				'type'        => 'section',
				'label'       => esc_html__( 'Email Marketing Integrations', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Connect your popup form to email marketing services', 'hashbar-wp-notification-bar' ),
				'condition'   => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_mailchimp_enabled' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Enable Mailchimp Integration', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_mailchimp_api_key' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Mailchimp API Key', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'Enter your Mailchimp API key', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Find your API key in Mailchimp > Account > Extras > API keys', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
				'condition'   => array(
					'key'      => '_wphash_popup_mailchimp_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_mailchimp_list_id' => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Mailchimp Audience/List', 'hashbar-wp-notification-bar' ),
				'options'     => 'dynamic',
				'description' => esc_html__( 'Select the audience to add subscribers to', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
				'condition'   => array(
					'key'      => '_wphash_popup_mailchimp_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_mailchimp_double_optin' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Enable Double Opt-in', 'hashbar-wp-notification-bar' ),
				'desc'      => esc_html__( 'Subscribers will receive a confirmation email before being added', 'hashbar-wp-notification-bar' ),
				'default'   => true,
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_popup_mailchimp_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_mailchimp_tags' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Subscriber Tags', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'tag1, tag2, tag3', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Comma-separated tags to apply to new subscribers', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
				'condition'   => array(
					'key'      => '_wphash_popup_mailchimp_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
		);
	}

	/**
	 * Get Design Tab field definitions
	 *
	 * @return array
	 */
	public static function get_design_fields() {
		return array(
			'section_popup_size' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Popup Size', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_width' => array(
				'type'    => 'slider',
				'label'   => esc_html__( 'Width', 'hashbar-wp-notification-bar' ),
				'default' => 500,
				'min'     => 300,
				'max'     => 900,
				'unit'    => 'px',
			),
			'_wphash_popup_max_width' => array(
				'type'    => 'slider',
				'label'   => esc_html__( 'Max Width', 'hashbar-wp-notification-bar' ),
				'default' => 98,
				'min'     => 50,
				'max'     => 100,
				'unit'    => '%',
			),
			'_wphash_popup_padding' => array(
				'type'    => 'padding',
				'label'   => esc_html__( 'Padding', 'hashbar-wp-notification-bar' ),
				'default' => array(
					'top'    => 30,
					'right'  => 30,
					'bottom' => 30,
					'left'   => 30,
				),
				'unit'    => 'px',
			),
			'section_content_wrapper' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Content Wrapper', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_content_padding' => array(
				'type'    => 'padding',
				'label'   => esc_html__( 'Inner Spacing', 'hashbar-wp-notification-bar' ),
				'default' => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
				'unit'    => 'px',
			),
			'_wphash_popup_content_border_radius' => array(
				'type'    => 'padding',
				'label'   => esc_html__( 'Rounded Corners', 'hashbar-wp-notification-bar' ),
				'default' => array(
					'top'    => 0,
					'right'  => 0,
					'bottom' => 0,
					'left'   => 0,
				),
				'unit'    => 'px',
			),
			'_wphash_popup_content_bg_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Background', 'hashbar-wp-notification-bar' ),
				'default' => 'transparent',
				'presets' => array( 'transparent', '#ffffff', '#f8f9fa', '#f0f0f0', '#1a1a1a', '#000000' ),
			),
			'_wphash_popup_content_valign' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Vertical Align', 'hashbar-wp-notification-bar' ),
				'default' => 'middle',
				'options' => array(
					'top'    => esc_html__( 'Top', 'hashbar-wp-notification-bar' ),
					'middle' => esc_html__( 'Middle', 'hashbar-wp-notification-bar' ),
					'bottom' => esc_html__( 'Bottom', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_popup_content_gap' => array(
				'type'    => 'number',
				'label'   => esc_html__( 'Image Spacing', 'hashbar-wp-notification-bar' ),
				'default' => 0,
				'unit'    => 'px',
			),
			'section_colors' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Colors', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_bg_type' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Background Type', 'hashbar-wp-notification-bar' ),
				'default' => 'solid',
				'options' => array(
					'solid'    => esc_html__( 'Solid Color', 'hashbar-wp-notification-bar' ),
					'gradient' => esc_html__( 'Gradient', 'hashbar-wp-notification-bar' ),
					'image'    => esc_html__( 'Image', 'hashbar-wp-notification-bar' ),
				),
				'isPro'   => array( 'gradient', 'image' ),
			),
			'_wphash_popup_bg_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Background Color', 'hashbar-wp-notification-bar' ),
				'default' => '#ffffff',
				'presets' => array( '#ffffff', '#f8f9fa', '#1a1a1a', '#1890ff', '#52c41a', '#722ed1' ),
			),
			'_wphash_popup_gradient_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Gradient Second Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#f0f0f0',
				'presets'   => array( '#f0f0f0', '#1890ff', '#52c41a', '#faad14', '#f5222d', '#722ed1' ),
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_popup_bg_type',
					'operator' => '==',
					'value'    => 'gradient',
				),
			),
			'_wphash_popup_gradient_direction' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Gradient Direction', 'hashbar-wp-notification-bar' ),
				'default'   => 'to_bottom',
				'options'   => array(
					'to_bottom'       => esc_html__( 'Top to Bottom', 'hashbar-wp-notification-bar' ),
					'to_right'        => esc_html__( 'Left to Right', 'hashbar-wp-notification-bar' ),
					'to_bottom_right' => esc_html__( 'Top-Left to Bottom-Right', 'hashbar-wp-notification-bar' ),
					'to_bottom_left'  => esc_html__( 'Top-Right to Bottom-Left', 'hashbar-wp-notification-bar' ),
				),
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_popup_bg_type',
					'operator' => '==',
					'value'    => 'gradient',
				),
			),
			'_wphash_popup_bg_image' => array(
				'type'      => 'image',
				'label'     => esc_html__( 'Background Image', 'hashbar-wp-notification-bar' ),
				'default'   => array( 'id' => 0, 'url' => '' ),
				'condition' => array(
					'key'      => '_wphash_popup_bg_type',
					'operator' => '==',
					'value'    => 'image',
				),
			),
			'_wphash_popup_bg_image_size' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Background Size', 'hashbar-wp-notification-bar' ),
				'default'   => 'cover',
				'options'   => array(
					'cover'   => esc_html__( 'Cover', 'hashbar-wp-notification-bar' ),
					'contain' => esc_html__( 'Contain', 'hashbar-wp-notification-bar' ),
					'auto'    => esc_html__( 'Auto', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_popup_bg_type',
					'operator' => '==',
					'value'    => 'image',
				),
			),
			'_wphash_popup_bg_image_position' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Background Position', 'hashbar-wp-notification-bar' ),
				'default'   => 'center',
				'options'   => array(
					'center'       => esc_html__( 'Center', 'hashbar-wp-notification-bar' ),
					'top'          => esc_html__( 'Top', 'hashbar-wp-notification-bar' ),
					'bottom'       => esc_html__( 'Bottom', 'hashbar-wp-notification-bar' ),
					'left'         => esc_html__( 'Left', 'hashbar-wp-notification-bar' ),
					'right'        => esc_html__( 'Right', 'hashbar-wp-notification-bar' ),
					'top left'     => esc_html__( 'Top Left', 'hashbar-wp-notification-bar' ),
					'top right'    => esc_html__( 'Top Right', 'hashbar-wp-notification-bar' ),
					'bottom left'  => esc_html__( 'Bottom Left', 'hashbar-wp-notification-bar' ),
					'bottom right' => esc_html__( 'Bottom Right', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_popup_bg_type',
					'operator' => '==',
					'value'    => 'image',
				),
			),
			'_wphash_popup_text_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Text Color', 'hashbar-wp-notification-bar' ),
				'default' => '#1a1a1a',
				'presets' => array( '#1a1a1a', '#333333', '#ffffff', '#666666' ),
			),
			'_wphash_popup_heading_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Heading Color', 'hashbar-wp-notification-bar' ),
				'default' => '#1a1a1a',
				'presets' => array( '#1a1a1a', '#333333', '#ffffff', '#1890ff' ),
			),
			'_wphash_popup_subheading_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Subheading Color', 'hashbar-wp-notification-bar' ),
				'default' => '#333333',
				'presets' => array( '#333333', '#1a1a1a', '#666666', '#ffffff' ),
			),
			'_wphash_popup_overlay_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Overlay Color', 'hashbar-wp-notification-bar' ),
				'default'   => 'rgba(0, 0, 0, 0.5)',
				'presets'   => array( 'rgba(0,0,0,0.5)', 'rgba(0,0,0,0.7)', 'rgba(255,255,255,0.8)' ),
				'condition' => array(
					'key'      => '_wphash_popup_overlay_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_typography' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Typography', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_font_family' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Font Family', 'hashbar-wp-notification-bar' ),
				'default' => 'system-ui',
				'options' => hashbar_wpnb_font_family_options(),
			),
			'_wphash_popup_heading_size' => array(
				'type'    => 'slider',
				'label'   => esc_html__( 'Heading Size', 'hashbar-wp-notification-bar' ),
				'default' => 24,
				'min'     => 16,
				'max'     => 48,
				'unit'    => 'px',
			),
			'_wphash_popup_text_size' => array(
				'type'    => 'slider',
				'label'   => esc_html__( 'Text Size', 'hashbar-wp-notification-bar' ),
				'default' => 16,
				'min'     => 12,
				'max'     => 24,
				'unit'    => 'px',
			),
			'_wphash_popup_text_align' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Text Alignment', 'hashbar-wp-notification-bar' ),
				'default' => 'center',
				'options' => array(
					'left'   => esc_html__( 'Left', 'hashbar-wp-notification-bar' ),
					'center' => esc_html__( 'Center', 'hashbar-wp-notification-bar' ),
					'right'  => esc_html__( 'Right', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_popup_subheading_size' => array(
				'type'    => 'slider',
				'label'   => esc_html__( 'Subheading Size', 'hashbar-wp-notification-bar' ),
				'default' => 16,
				'min'     => 12,
				'max'     => 32,
				'unit'    => 'px',
			),
			'_wphash_popup_heading_weight' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Heading Font Weight', 'hashbar-wp-notification-bar' ),
				'default' => '600',
				'options' => array(
					'400' => esc_html__( 'Normal (400)', 'hashbar-wp-notification-bar' ),
					'500' => esc_html__( 'Medium (500)', 'hashbar-wp-notification-bar' ),
					'600' => esc_html__( 'Semi Bold (600)', 'hashbar-wp-notification-bar' ),
					'700' => esc_html__( 'Bold (700)', 'hashbar-wp-notification-bar' ),
					'800' => esc_html__( 'Extra Bold (800)', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_popup_subheading_weight' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Subheading Font Weight', 'hashbar-wp-notification-bar' ),
				'default' => '500',
				'options' => array(
					'400' => esc_html__( 'Normal (400)', 'hashbar-wp-notification-bar' ),
					'500' => esc_html__( 'Medium (500)', 'hashbar-wp-notification-bar' ),
					'600' => esc_html__( 'Semi Bold (600)', 'hashbar-wp-notification-bar' ),
					'700' => esc_html__( 'Bold (700)', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_popup_text_transform' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Text Transform', 'hashbar-wp-notification-bar' ),
				'default' => 'none',
				'options' => array(
					'none'       => esc_html__( 'None', 'hashbar-wp-notification-bar' ),
					'uppercase'  => esc_html__( 'UPPERCASE', 'hashbar-wp-notification-bar' ),
					'lowercase'  => esc_html__( 'lowercase', 'hashbar-wp-notification-bar' ),
					'capitalize' => esc_html__( 'Capitalize', 'hashbar-wp-notification-bar' ),
				),
			),
			'section_border' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Border & Shadow', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_border_radius' => array(
				'type'    => 'slider',
				'label'   => esc_html__( 'Border Radius', 'hashbar-wp-notification-bar' ),
				'default' => 12,
				'min'     => 0,
				'max'     => 50,
				'unit'    => 'px',
			),
			'_wphash_popup_border_width' => array(
				'type'    => 'slider',
				'label'   => esc_html__( 'Border Width', 'hashbar-wp-notification-bar' ),
				'default' => 0,
				'min'     => 0,
				'max'     => 10,
				'unit'    => 'px',
			),
			'_wphash_popup_border_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Border Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#e8e8e8',
				'presets'   => array( '#e8e8e8', '#d9d9d9', '#1890ff', '#52c41a' ),
				'condition' => array(
					'key'      => '_wphash_popup_border_width',
					'operator' => '>',
					'value'    => 0,
				),
			),
			'_wphash_popup_shadow' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Box Shadow', 'hashbar-wp-notification-bar' ),
				'default' => 'large',
				'options' => array(
					'none'   => esc_html__( 'None', 'hashbar-wp-notification-bar' ),
					'small'  => esc_html__( 'Small', 'hashbar-wp-notification-bar' ),
					'medium' => esc_html__( 'Medium', 'hashbar-wp-notification-bar' ),
					'large'  => esc_html__( 'Large', 'hashbar-wp-notification-bar' ),
				),
			),
			'section_button_styling' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Button Styling', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_btn_bg_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Button Background', 'hashbar-wp-notification-bar' ),
				'default' => '#1890ff',
				'presets' => array( '#1890ff', '#52c41a', '#faad14', '#f5222d', '#722ed1', '#1a1a1a' ),
			),
			'_wphash_popup_btn_text_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Button Text Color', 'hashbar-wp-notification-bar' ),
				'default' => '#ffffff',
				'presets' => array( '#ffffff', '#000000' ),
			),
			'_wphash_popup_btn_hover_bg_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Button Hover Background', 'hashbar-wp-notification-bar' ),
				'default' => '#40a9ff',
				'presets' => array( '#40a9ff', '#73d13d', '#ffc53d', '#ff4d4f', '#9254de' ),
			),
			'_wphash_popup_btn_hover_text_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Button Hover Text', 'hashbar-wp-notification-bar' ),
				'default' => '#ffffff',
				'presets' => array( '#ffffff', '#000000' ),
			),
			'_wphash_popup_btn_border_radius' => array(
				'type'    => 'slider',
				'label'   => esc_html__( 'Button Border Radius', 'hashbar-wp-notification-bar' ),
				'default' => 6,
				'min'     => 0,
				'max'     => 30,
				'unit'    => 'px',
			),
			'_wphash_popup_btn_font_size' => array(
				'type'    => 'slider',
				'label'   => esc_html__( 'Button Font Size', 'hashbar-wp-notification-bar' ),
				'default' => 16,
				'min'     => 12,
				'max'     => 24,
				'unit'    => 'px',
			),
			'_wphash_popup_btn_width_type' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Button Width', 'hashbar-wp-notification-bar' ),
				'default' => 'auto',
				'options' => array(
					'auto'       => esc_html__( 'Auto (Fit Content)', 'hashbar-wp-notification-bar' ),
					'full_width' => esc_html__( 'Full Width', 'hashbar-wp-notification-bar' ),
					'custom'     => esc_html__( 'Custom', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_popup_btn_custom_width' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Custom Button Width', 'hashbar-wp-notification-bar' ),
				'default'   => 200,
				'min'       => 100,
				'max'       => 500,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_popup_btn_width_type',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
			// Form Input Styling Section
			'section_form_input_styling' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'Form Input Styling', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_input_bg_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Input Background', 'hashbar-wp-notification-bar' ),
				'default'   => '#ffffff',
				'presets'   => array( '#ffffff', '#f5f5f5', '#fafafa', 'transparent' ),
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_input_text_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Input Text Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#333333',
				'presets'   => array( '#333333', '#1a1a1a', '#666666', '#000000' ),
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_input_placeholder_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Placeholder Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#999999',
				'presets'   => array( '#999999', '#bfbfbf', '#cccccc', '#666666' ),
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_input_border_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Input Border Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#d9d9d9',
				'presets'   => array( '#d9d9d9', '#e8e8e8', '#bfbfbf', '#cccccc' ),
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_input_focus_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Input Focus Border', 'hashbar-wp-notification-bar' ),
				'default'   => '#1890ff',
				'presets'   => array( '#1890ff', '#52c41a', '#722ed1', '#fa8c16' ),
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_input_border_radius' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Input Border Radius', 'hashbar-wp-notification-bar' ),
				'default'   => 6,
				'min'       => 0,
				'max'       => 20,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_input_font_size' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Input Font Size', 'hashbar-wp-notification-bar' ),
				'default'   => 14,
				'min'       => 12,
				'max'       => 18,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_input_height' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Input Height', 'hashbar-wp-notification-bar' ),
				'default'   => 40,
				'min'       => 32,
				'max'       => 56,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_label_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Label/Text Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#333333',
				'presets'   => array( '#333333', '#666666', '#1a1a1a', '#ffffff' ),
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_label_font_size' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Label Font Size', 'hashbar-wp-notification-bar' ),
				'default'   => 12,
				'min'       => 10,
				'max'       => 16,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_checkbox_accent_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Checkbox/Radio Accent', 'hashbar-wp-notification-bar' ),
				'default'   => '#1890ff',
				'presets'   => array( '#1890ff', '#52c41a', '#722ed1', '#fa8c16' ),
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_form_alignment' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Form Alignment', 'hashbar-wp-notification-bar' ),
				'default'   => 'left',
				'options'   => array(
					'left'   => esc_html__( 'Left', 'hashbar-wp-notification-bar' ),
					'center' => esc_html__( 'Center', 'hashbar-wp-notification-bar' ),
					'right'  => esc_html__( 'Right', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_popup_form_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_close_styling' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'Close Button Styling', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_close_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Close Button Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#8c8c8c',
				'presets'   => array( '#8c8c8c', '#595959', '#ffffff', '#1890ff' ),
				'condition' => array(
					'key'      => '_wphash_popup_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_close_bg_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Close Button Background', 'hashbar-wp-notification-bar' ),
				'default'   => 'rgba(0, 0, 0, 0.08)',
				'presets'   => array( 'rgba(0,0,0,0.08)', 'rgba(0,0,0,0.2)', '#ffffff', '#f5f5f5', 'transparent' ),
				'condition' => array(
					'key'      => '_wphash_popup_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_close_hover_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Close Button Hover', 'hashbar-wp-notification-bar' ),
				'default'   => '#1a1a1a',
				'presets'   => array( '#1a1a1a', '#f5222d', '#ffffff' ),
				'condition' => array(
					'key'      => '_wphash_popup_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_close_size' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Close Button Size', 'hashbar-wp-notification-bar' ),
				'default'   => 24,
				'min'       => 16,
				'max'       => 40,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_popup_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_close_border_radius' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Close Button Border Radius', 'hashbar-wp-notification-bar' ),
				'default'   => 50,
				'min'       => 0,
				'max'       => 50,
				'unit'      => '%',
				'condition' => array(
					'key'      => '_wphash_popup_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_content_order' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Content Order', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_content_order' => array(
				'type'    => 'content_order',
				'label'   => esc_html__( 'Content Order', 'hashbar-wp-notification-bar' ),
				'default' => array( 'heading', 'subheading', 'description', 'countdown', 'coupon', 'form_or_buttons' ),
				'element_labels' => array(
					'heading'         => esc_html__( 'Heading', 'hashbar-wp-notification-bar' ),
					'subheading'      => esc_html__( 'Subheading', 'hashbar-wp-notification-bar' ),
					'description'     => esc_html__( 'Description', 'hashbar-wp-notification-bar' ),
					'countdown'       => esc_html__( 'Countdown Timer', 'hashbar-wp-notification-bar' ),
					'coupon'          => esc_html__( 'Coupon Code', 'hashbar-wp-notification-bar' ),
					'form_or_buttons' => esc_html__( 'Form / Buttons', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_popup_element_spacing' => array(
				'type'    => 'element_spacing',
				'label'   => esc_html__( 'Element Spacing', 'hashbar-wp-notification-bar' ),
				'default' => array(
					'heading'         => 6,
					'subheading'      => 8,
					'description'     => 16,
					'countdown'       => 16,
					'coupon'          => 16,
					'form_or_buttons' => 0,
				),
			),
			'section_custom_css' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Custom CSS', 'hashbar-wp-notification-bar' ),
				'isPro' => true,
			),
			'_wphash_popup_custom_css' => array(
				'type'        => 'textarea',
				'label'       => esc_html__( 'Custom CSS', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Add custom CSS to style your popup. CSS is automatically scoped to this campaign. Available selectors: .hashbar-popup-campaign, .hashbar-popup-container, .hashbar-popup-body, .hashbar-popup-heading, .hashbar-popup-subheading, .hashbar-popup-description, .hashbar-popup-image, .hashbar-popup-close, .hashbar-popup-countdown, .hashbar-popup-coupon, .hashbar-popup-coupon-code, .hashbar-popup-coupon-copy, .hashbar-popup-form, .hashbar-popup-submit, .hashbar-popup-buttons, .hashbar-popup-cta, .hashbar-popup-overlay', 'hashbar-wp-notification-bar' ),
				'default'     => '',
				'rows'        => 6,
				'placeholder' => ".hashbar-popup-campaign { }\n.hashbar-popup-container { }\n.hashbar-popup-body { }\n.hashbar-popup-heading { }\n.hashbar-popup-subheading { }\n.hashbar-popup-description { }\n.hashbar-popup-image { }\n.hashbar-popup-countdown { }\n.hashbar-popup-coupon { }\n.hashbar-popup-coupon-code { }\n.hashbar-popup-form { }\n.hashbar-popup-buttons { }\n.hashbar-popup-close { }",
				'isPro'       => true,
			),
		);
	}

	/**
	 * Get Triggers Tab field definitions
	 *
	 * @return array
	 */
	public static function get_triggers_fields() {
		return array(
			'section_trigger_type' => array(
				'type'        => 'section',
				'label'       => esc_html__( 'Trigger Type', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Choose when your popup should appear', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_trigger_type' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Trigger Type', 'hashbar-wp-notification-bar' ),
				'default' => 'time_delay',
				'options' => array(
					'immediate'       => array(
						'label'       => esc_html__( 'Immediate (On Page Load)', 'hashbar-wp-notification-bar' ),
						'description' => esc_html__( 'Show popup immediately when page loads', 'hashbar-wp-notification-bar' ),
						'icon'        => 'ClockCircleOutlined',
					),
					'time_delay'      => array(
						'label'       => esc_html__( 'Time Delay', 'hashbar-wp-notification-bar' ),
						'description' => esc_html__( 'Show popup after a specified delay', 'hashbar-wp-notification-bar' ),
						'icon'        => 'FieldTimeOutlined',
					),
					'exit_intent'     => array(
						'label'       => esc_html__( 'Exit Intent', 'hashbar-wp-notification-bar' ),
						'description' => esc_html__( 'Show popup when user tries to leave the page', 'hashbar-wp-notification-bar' ),
						'icon'        => 'LogoutOutlined',
					),
					'scroll_depth'    => array(
						'label'       => esc_html__( 'Scroll Depth', 'hashbar-wp-notification-bar' ),
						'description' => esc_html__( 'Show popup when user scrolls to a certain point', 'hashbar-wp-notification-bar' ),
						'icon'        => 'VerticalAlignBottomOutlined',
					),
					'click'           => array(
						'label'       => esc_html__( 'On Element Click', 'hashbar-wp-notification-bar' ),
						'description' => esc_html__( 'Show popup when user clicks a specific element', 'hashbar-wp-notification-bar' ),
						'icon'        => 'AimOutlined',
					),
					'inactivity'      => array(
						'label'       => esc_html__( 'User Inactivity', 'hashbar-wp-notification-bar' ),
						'description' => esc_html__( 'Show popup after user becomes inactive', 'hashbar-wp-notification-bar' ),
						'icon'        => 'CoffeeOutlined',
					),
					'element_visible' => array(
						'label'       => esc_html__( 'Element Becomes Visible', 'hashbar-wp-notification-bar' ),
						'description' => esc_html__( 'Show popup when an element becomes visible', 'hashbar-wp-notification-bar' ),
						'icon'        => 'EyeOutlined',
					),
					'page_views'      => array(
						'label'       => esc_html__( 'After X Page Views', 'hashbar-wp-notification-bar' ),
						'description' => esc_html__( 'Show popup after user visits multiple pages', 'hashbar-wp-notification-bar' ),
						'icon'        => 'FileSearchOutlined',
					),
				),
				'isPro'   => array( 'scroll_depth', 'click', 'inactivity', 'element_visible', 'page_views' ),
			),
			'_wphash_popup_trigger_delay' => array(
				'type'      => 'number',
				'label'     => esc_html__( 'Delay (seconds)', 'hashbar-wp-notification-bar' ),
				'default'   => 5,
				'min'       => 0,
				'max'       => 300,
				'condition' => array(
					'key'      => '_wphash_popup_trigger_type',
					'operator' => '==',
					'value'    => 'time_delay',
				),
			),
			'_wphash_popup_trigger_scroll_percent' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Scroll Percentage', 'hashbar-wp-notification-bar' ),
				'default'   => 50,
				'min'       => 10,
				'max'       => 100,
				'unit'      => '%',
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_trigger_type',
					'operator' => '==',
					'value'    => 'scroll_depth',
				),
			),
			'_wphash_popup_trigger_click_selector' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'CSS Selector', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'e.g., #my-button, .trigger-popup', 'hashbar-wp-notification-bar' ),
				'isPro'       => true,
				'condition'   => array(
					'key'      => '_wphash_popup_trigger_type',
					'operator' => '==',
					'value'    => 'click',
				),
			),
			'_wphash_popup_trigger_click_delay' => array(
				'type'      => 'number',
				'label'     => esc_html__( 'Delay After Click (seconds)', 'hashbar-wp-notification-bar' ),
				'default'   => 0,
				'min'       => 0,
				'max'       => 300,
				'isPro'     => ! self::is_pro(),
				'condition' => array(
					'key'      => '_wphash_popup_trigger_type',
					'operator' => '==',
					'value'    => 'click',
				),
			),
			'_wphash_popup_trigger_inactivity_time' => array(
				'type'      => 'number',
				'label'     => esc_html__( 'Inactivity Time (seconds)', 'hashbar-wp-notification-bar' ),
				'default'   => 30,
				'min'       => 5,
				'max'       => 300,
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_trigger_type',
					'operator' => '==',
					'value'    => 'inactivity',
				),
			),
			'_wphash_popup_trigger_element_selector' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Element Selector', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'e.g., #footer, .product-section', 'hashbar-wp-notification-bar' ),
				'isPro'       => true,
				'condition'   => array(
					'key'      => '_wphash_popup_trigger_type',
					'operator' => '==',
					'value'    => 'element_visible',
				),
			),
			'_wphash_popup_trigger_page_views_count' => array(
				'type'      => 'number',
				'label'     => esc_html__( 'Number of Page Views', 'hashbar-wp-notification-bar' ),
				'default'   => 3,
				'min'       => 2,
				'max'       => 20,
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_trigger_type',
					'operator' => '==',
					'value'    => 'page_views',
				),
			),
			'section_exit_intent' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'Exit Intent Options', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_trigger_type',
					'operator' => '==',
					'value'    => 'exit_intent',
				),
			),
			'_wphash_popup_exit_sensitivity' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Sensitivity', 'hashbar-wp-notification-bar' ),
				'default'   => 'medium',
				'options'   => array(
					'low'    => esc_html__( 'Low (Less Triggers)', 'hashbar-wp-notification-bar' ),
					'medium' => esc_html__( 'Medium', 'hashbar-wp-notification-bar' ),
					'high'   => esc_html__( 'High (More Triggers)', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_popup_trigger_type',
					'operator' => '==',
					'value'    => 'exit_intent',
				),
			),
			'_wphash_popup_exit_mobile_enabled' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Enable on Mobile', 'hashbar-wp-notification-bar' ),
				'desc'      => esc_html__( 'Use alternative triggers for mobile (back button, fast scroll up)', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_popup_trigger_type',
					'operator' => '==',
					'value'    => 'exit_intent',
				),
			),
		);
	}

	/**
	 * Get Targeting Tab field definitions
	 *
	 * @return array
	 */
	public static function get_targeting_fields() {
		return array(
			'section_page_targeting' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Page Targeting', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_target_pages' => array(
				'type'        => 'radio',
				'label'       => esc_html__( 'Show On', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Choose where your popup will be displayed', 'hashbar-wp-notification-bar' ),
				'default'     => 'all',
				'options'     => array(
					'all'      => esc_html__( 'All Pages', 'hashbar-wp-notification-bar' ),
					'homepage' => esc_html__( 'Homepage Only', 'hashbar-wp-notification-bar' ),
					'specific' => esc_html__( 'Specific Pages/Posts', 'hashbar-wp-notification-bar' ),
					'exclude'  => esc_html__( 'All Except Excluded', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_popup_target_page_ids' => array(
				'type'        => 'multi-select',
				'label'       => esc_html__( 'Select Pages/Posts', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'Search and select pages or posts...', 'hashbar-wp-notification-bar' ),
				'default'     => array(),
				'condition'   => array(
					'key'      => '_wphash_popup_target_pages',
					'operator' => '==',
					'value'    => 'specific',
				),
			),
			'_wphash_popup_exclude_page_ids' => array(
				'type'        => 'multi-select',
				'label'       => esc_html__( 'Exclude Pages/Posts', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'Search and select pages or posts to exclude...', 'hashbar-wp-notification-bar' ),
				'default'     => array(),
				'condition'   => array(
					'key'      => '_wphash_popup_target_pages',
					'operator' => '==',
					'value'    => 'exclude',
				),
			),
			'section_device_targeting' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Device Targeting', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_target_devices' => array(
				'type'    => 'checkbox-group',
				'label'   => esc_html__( 'Show On Devices', 'hashbar-wp-notification-bar' ),
				'default' => array( 'desktop', 'tablet', 'mobile' ),
				'options' => array(
					'desktop' => esc_html__( 'Desktop', 'hashbar-wp-notification-bar' ),
					'tablet'  => esc_html__( 'Tablet', 'hashbar-wp-notification-bar' ),
					'mobile'  => esc_html__( 'Mobile', 'hashbar-wp-notification-bar' ),
				),
			),
			'section_user_targeting' => array(
				'type'  => 'section',
				'label' => esc_html__( 'User Targeting', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_target_user_status' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Show To', 'hashbar-wp-notification-bar' ),
				'default' => 'all',
				'options' => array(
					'all'       => esc_html__( 'All Visitors', 'hashbar-wp-notification-bar' ),
					'logged_in' => esc_html__( 'Logged In Users Only', 'hashbar-wp-notification-bar' ),
					'guests'    => esc_html__( 'Guests Only', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_popup_target_new_visitors' => array(
				'type'    => 'switch',
				'label'   => esc_html__( 'Only Show to New Visitors', 'hashbar-wp-notification-bar' ),
				'default' => false,
				'isPro'   => true,
			),
			'_wphash_popup_target_returning_visitors' => array(
				'type'    => 'switch',
				'label'   => esc_html__( 'Only Show to Returning Visitors', 'hashbar-wp-notification-bar' ),
				'default' => false,
				'isPro'   => true,
			),
			'section_geographic_targeting' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Geographic Targeting', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_target_countries' => array(
				'type'               => 'multi-select',
				'label'              => esc_html__( 'Target Countries', 'hashbar-wp-notification-bar' ),
				'description'        => esc_html__( 'Select "All Countries" (Free) or choose specific countries to target (PRO).', 'hashbar-wp-notification-bar' ),
				'placeholder'        => esc_html__( 'Select countries...', 'hashbar-wp-notification-bar' ),
				'notFoundContent'    => esc_html__( 'No countries found', 'hashbar-wp-notification-bar' ),
				'worldwideMessage'   => esc_html__( 'Worldwide - No restrictions, popup displays in all countries', 'hashbar-wp-notification-bar' ),
				// Uses named tokens (not sprintf) since this string is interpolated client-side in TargetingTab.jsx; order can vary per translation without breaking the JS replace().
				'targetingMessage'   => esc_html__( 'Targeting {count} specific {noun}', 'hashbar-wp-notification-bar' ),
				'countryLabel'       => esc_html__( 'country', 'hashbar-wp-notification-bar' ),
				'countriesLabel'     => esc_html__( 'countries', 'hashbar-wp-notification-bar' ),
				'default'            => array( 'all' ),
				'isPro'              => hashbar_get_pro_countries(),
				'options'            => hashbar_get_countries_list( true ),
			),
			'section_referrer_targeting' => array(
				'type'           => 'section',
				'label'          => esc_html__( 'Referrer Targeting', 'hashbar-wp-notification-bar' ),
				'isPro'          => true,
				'proLockedMessage' => esc_html__( 'Referrer targeting is a Pro feature', 'hashbar-wp-notification-bar' ),
				'upgradeLink'    => esc_html__( 'Upgrade to unlock', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_target_referrer_enabled' => array(
				'type'    => 'switch',
				'label'   => esc_html__( 'Enable Referrer Targeting', 'hashbar-wp-notification-bar' ),
				'default' => false,
				'isPro'   => true,
			),
			'_wphash_popup_target_referrer_type' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Referrer Match Type', 'hashbar-wp-notification-bar' ),
				'default'   => 'include',
				'options'   => array(
					'include' => esc_html__( 'Show Only From These Sources', 'hashbar-wp-notification-bar' ),
					'exclude' => esc_html__( 'Hide From These Sources', 'hashbar-wp-notification-bar' ),
				),
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_target_referrer_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_target_referrer_sources' => array(
				'type'        => 'textarea',
				'label'       => esc_html__( 'Referrer URLs', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Enter one URL per line', 'hashbar-wp-notification-bar' ),
				'placeholder' => "google.com\nfacebook.com\ntwitter.com",
				'rows'        => 4,
				'isPro'       => true,
				'condition'   => array(
					'key'      => '_wphash_popup_target_referrer_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
		);
	}

	/**
	 * Get Frequency Tab field definitions
	 *
	 * @return array
	 */
	public static function get_frequency_fields() {
		return array(
			'section_frequency' => array(
				'type'        => 'section',
				'label'       => esc_html__( 'Display Frequency', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Control how often the popup appears to visitors', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_frequency_type' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Frequency', 'hashbar-wp-notification-bar' ),
				'default' => 'always',
				'options' => array(
					'always'           => esc_html__( 'Every Page Load', 'hashbar-wp-notification-bar' ),
					'once_per_session' => esc_html__( 'Once Per Session', 'hashbar-wp-notification-bar' ),
					'once_per_day'     => esc_html__( 'Once Per Day', 'hashbar-wp-notification-bar' ),
					'once_per_x_days'  => esc_html__( 'Once Every X Days', 'hashbar-wp-notification-bar' ),
					'once_ever'        => esc_html__( 'Once Ever (Until Cookies Clear)', 'hashbar-wp-notification-bar' ),
					'x_times_total'    => esc_html__( 'X Times Total', 'hashbar-wp-notification-bar' ),
				),
				'isPro'   => array( 'once_per_x_days', 'once_ever', 'x_times_total' ),
			),
			'_wphash_popup_frequency_days' => array(
				'type'      => 'number',
				'label'     => esc_html__( 'Number of Days', 'hashbar-wp-notification-bar' ),
				'default'   => 7,
				'min'       => 1,
				'max'       => 365,
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_frequency_type',
					'operator' => '==',
					'value'    => 'once_per_x_days',
				),
			),
			'_wphash_popup_frequency_times' => array(
				'type'      => 'number',
				'label'     => esc_html__( 'Maximum Times to Show', 'hashbar-wp-notification-bar' ),
				'default'   => 3,
				'min'       => 1,
				'max'       => 100,
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_frequency_type',
					'operator' => '==',
					'value'    => 'x_times_total',
				),
			),
			'section_after_close' => array(
				'type'  => 'section',
				'label' => esc_html__( 'After Close Behavior', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_after_close' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'After User Closes Popup', 'hashbar-wp-notification-bar' ),
				'default' => 'respect_frequency',
				'options' => array(
					'respect_frequency' => esc_html__( 'Respect Frequency Setting', 'hashbar-wp-notification-bar' ),
					'dont_show_session' => esc_html__( 'Don\'t Show Again This Session', 'hashbar-wp-notification-bar' ),
					'dont_show_x_days'  => esc_html__( 'Don\'t Show for X Days', 'hashbar-wp-notification-bar' ),
					'dont_show_ever'    => esc_html__( 'Never Show Again', 'hashbar-wp-notification-bar' ),
				),
				'isPro'   => array( 'dont_show_x_days', 'dont_show_ever' ),
			),
			'_wphash_popup_after_close_days' => array(
				'type'      => 'number',
				'label'     => esc_html__( 'Days to Hide After Close', 'hashbar-wp-notification-bar' ),
				'default'   => 7,
				'min'       => 1,
				'max'       => 365,
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_after_close',
					'operator' => '==',
					'value'    => 'dont_show_x_days',
				),
			),
			'section_after_convert' => array(
				'type'  => 'section',
				'label' => esc_html__( 'After Conversion Behavior', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_after_convert' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'After User Submits Form', 'hashbar-wp-notification-bar' ),
				'default' => 'never_show',
				'options' => array(
					'never_show'      => esc_html__( 'Never Show Again', 'hashbar-wp-notification-bar' ),
					'show_after_days' => esc_html__( 'Show Again After X Days', 'hashbar-wp-notification-bar' ),
					'always_show'     => esc_html__( 'Continue Showing Normally', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_popup_after_convert_days' => array(
				'type'      => 'number',
				'label'     => esc_html__( 'Days to Hide After Conversion', 'hashbar-wp-notification-bar' ),
				'default'   => 30,
				'min'       => 1,
				'max'       => 365,
				'condition' => array(
					'key'      => '_wphash_popup_after_convert',
					'operator' => '==',
					'value'    => 'show_after_days',
				),
			),
		);
	}

	/**
	 * Get Animation Tab field definitions
	 *
	 * @return array
	 */
	public static function get_animation_fields() {
		return array(
			'section_animation' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Animation', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_animation_entry' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Entry Animation', 'hashbar-wp-notification-bar' ),
				'default' => 'fadeIn',
				'options' => array(
					'fadeIn'       => esc_html__( 'Fade In', 'hashbar-wp-notification-bar' ),
					'slideInDown'  => esc_html__( 'Slide Down', 'hashbar-wp-notification-bar' ),
					'slideInUp'    => esc_html__( 'Slide Up', 'hashbar-wp-notification-bar' ),
					'slideInLeft'  => esc_html__( 'Slide Left', 'hashbar-wp-notification-bar' ),
					'slideInRight' => esc_html__( 'Slide Right', 'hashbar-wp-notification-bar' ),
					'zoomIn'       => esc_html__( 'Zoom In', 'hashbar-wp-notification-bar' ),
					'bounceIn'     => esc_html__( 'Bounce In', 'hashbar-wp-notification-bar' ),
					'flipIn'       => esc_html__( 'Flip In', 'hashbar-wp-notification-bar' ),
				),
				'isPro'   => array( 'slideInLeft', 'slideInRight', 'zoomIn', 'bounceIn', 'flipIn' ),
			),
			'_wphash_popup_animation_exit' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Exit Animation', 'hashbar-wp-notification-bar' ),
				'default' => 'fadeOut',
				'options' => array(
					'fadeOut'       => esc_html__( 'Fade Out', 'hashbar-wp-notification-bar' ),
					'slideOutUp'    => esc_html__( 'Slide Up', 'hashbar-wp-notification-bar' ),
					'slideOutDown'  => esc_html__( 'Slide Down', 'hashbar-wp-notification-bar' ),
					'slideOutLeft'  => esc_html__( 'Slide Left', 'hashbar-wp-notification-bar' ),
					'slideOutRight' => esc_html__( 'Slide Right', 'hashbar-wp-notification-bar' ),
					'zoomOut'       => esc_html__( 'Zoom Out', 'hashbar-wp-notification-bar' ),
					'bounceOut'     => esc_html__( 'Bounce Out', 'hashbar-wp-notification-bar' ),
				),
				'isPro'   => array( 'slideOutLeft', 'slideOutRight', 'zoomOut', 'bounceOut' ),
			),
			'_wphash_popup_animation_duration' => array(
				'type'    => 'slider',
				'label'   => esc_html__( 'Animation Duration', 'hashbar-wp-notification-bar' ),
				'default' => 300,
				'min'     => 100,
				'max'     => 1000,
				'step'    => 50,
				'unit'    => 'ms',
			),
			'_wphash_popup_animation_delay' => array(
				'type'    => 'slider',
				'label'   => esc_html__( 'Animation Delay', 'hashbar-wp-notification-bar' ),
				'default' => 0,
				'min'     => 0,
				'max'     => 2000,
				'step'    => 100,
				'unit'    => 'ms',
			),
		);
	}

	/**
	 * Get Countdown Tab field definitions
	 *
	 * @return array
	 */
	public static function get_countdown_fields() {
		return array(
			'section_countdown' => array(
				'type'        => 'section',
				'label'       => esc_html__( 'Countdown Timer', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Add urgency with a countdown timer', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_countdown_enabled' => array(
				'type'    => 'switch',
				'label'   => esc_html__( 'Enable Countdown', 'hashbar-wp-notification-bar' ),
				'default' => false,
			),
			'_wphash_popup_countdown_type' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Countdown Type', 'hashbar-wp-notification-bar' ),
				'default'   => 'fixed_date',
				'options'   => array(
					'fixed_date'      => esc_html__( 'Fixed Date', 'hashbar-wp-notification-bar' ),
					'evergreen'       => esc_html__( 'Evergreen (Per Visitor)', 'hashbar-wp-notification-bar' ),
					'daily_recurring' => esc_html__( 'Daily Recurring', 'hashbar-wp-notification-bar' ),
				),
				'isPro'     => array( 'evergreen', 'daily_recurring' ),
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_end_date' => array(
				'type'      => 'datetime',
				'label'     => esc_html__( 'End Date & Time', 'hashbar-wp-notification-bar' ),
				'default'   => '',
				'condition' => array(
					'key'      => '_wphash_popup_countdown_type',
					'operator' => '==',
					'value'    => 'fixed_date',
				),
			),
			'_wphash_popup_countdown_duration' => array(
				'type'      => 'number',
				'label'     => esc_html__( 'Duration (hours)', 'hashbar-wp-notification-bar' ),
				'default'   => 24,
				'min'       => 1,
				'max'       => 8760,
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_popup_countdown_type',
					'operator' => '==',
					'value'    => 'evergreen',
				),
			),
			'_wphash_popup_countdown_daily_time' => array(
				'type'      => 'time',
				'label'     => esc_html__( 'Reset Time', 'hashbar-wp-notification-bar' ),
				'default'   => '23:59',
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_popup_countdown_type',
					'operator' => '==',
					'value'    => 'daily_recurring',
				),
			),
			'_wphash_popup_countdown_recurring_days' => array(
				'type'      => 'checkbox_group',
				'label'     => esc_html__( 'Reset on these days', 'hashbar-wp-notification-bar' ),
				'default'   => array( 'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat' ),
				'options'   => array(
					'sun' => esc_html__( 'Sun', 'hashbar-wp-notification-bar' ),
					'mon' => esc_html__( 'Mon', 'hashbar-wp-notification-bar' ),
					'tue' => esc_html__( 'Tue', 'hashbar-wp-notification-bar' ),
					'wed' => esc_html__( 'Wed', 'hashbar-wp-notification-bar' ),
					'thu' => esc_html__( 'Thu', 'hashbar-wp-notification-bar' ),
					'fri' => esc_html__( 'Fri', 'hashbar-wp-notification-bar' ),
					'sat' => esc_html__( 'Sat', 'hashbar-wp-notification-bar' ),
				),
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_popup_countdown_type',
					'operator' => '==',
					'value'    => 'daily_recurring',
				),
			),
			'_wphash_popup_countdown_timezone' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Timezone', 'hashbar-wp-notification-bar' ),
				'default'   => 'site',
				'options'   => array(
					'site'    => esc_html__( 'Site Timezone', 'hashbar-wp-notification-bar' ),
					'visitor' => esc_html__( 'Visitor Timezone', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_countdown_display' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'Display Options', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => false,
				),
			),
			'_wphash_popup_countdown_show_days' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Show Days', 'hashbar-wp-notification-bar' ),
				'default'   => true,
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_show_hours' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Show Hours', 'hashbar-wp-notification-bar' ),
				'default'   => true,
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_show_minutes' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Show Minutes', 'hashbar-wp-notification-bar' ),
				'default'   => true,
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_show_seconds' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Show Seconds', 'hashbar-wp-notification-bar' ),
				'default'   => true,
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_label_days' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Days Label', 'hashbar-wp-notification-bar' ),
				'default'   => esc_html__( 'Days', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_countdown_show_days',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_label_hours' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Hours Label', 'hashbar-wp-notification-bar' ),
				'default'   => esc_html__( 'Hours', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_countdown_show_hours',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_label_minutes' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Minutes Label', 'hashbar-wp-notification-bar' ),
				'default'   => esc_html__( 'Minutes', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_countdown_show_minutes',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_label_seconds' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Seconds Label', 'hashbar-wp-notification-bar' ),
				'default'   => esc_html__( 'Seconds', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_countdown_show_seconds',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_countdown_style' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'Style', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_style' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Countdown Style', 'hashbar-wp-notification-bar' ),
				'default'   => 'boxes',
				'options'   => array(
					'inline'  => esc_html__( 'Inline', 'hashbar-wp-notification-bar' ),
					'boxes'   => esc_html__( 'Boxes', 'hashbar-wp-notification-bar' ),
					'circles' => esc_html__( 'Circles', 'hashbar-wp-notification-bar' ),
					'digital' => esc_html__( 'Digital', 'hashbar-wp-notification-bar' ),
				),
				'isPro'     => array( 'circles', 'flip' ),
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_size' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Size', 'hashbar-wp-notification-bar' ),
				'default'   => 'medium',
				'options'   => array(
					'small'  => esc_html__( 'Small', 'hashbar-wp-notification-bar' ),
					'medium' => esc_html__( 'Medium', 'hashbar-wp-notification-bar' ),
					'large'  => esc_html__( 'Large', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_bg_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Background Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#1890ff',
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_text_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Number Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#ffffff',
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_label_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Label Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#666666',
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_countdown_expiry' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'When Countdown Expires', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_expired_action' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Expiry Action', 'hashbar-wp-notification-bar' ),
				'default'   => 'hide_popup',
				'options'   => array(
					'hide_popup'   => esc_html__( 'Hide Popup', 'hashbar-wp-notification-bar' ),
					'show_message' => esc_html__( 'Show Message', 'hashbar-wp-notification-bar' ),
					'redirect'     => esc_html__( 'Redirect to URL', 'hashbar-wp-notification-bar' ),
				),
				'isPro'     => array( 'show_message', 'redirect' ),
				'condition' => array(
					'key'      => '_wphash_popup_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_countdown_expired_message' => array(
				'type'      => 'textarea',
				'label'     => esc_html__( 'Expired Message', 'hashbar-wp-notification-bar' ),
				'default'   => esc_html__( 'This offer has expired!', 'hashbar-wp-notification-bar' ),
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_popup_countdown_expired_action',
					'operator' => '==',
					'value'    => 'show_message',
				),
			),
			'_wphash_popup_countdown_expired_redirect' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Redirect URL', 'hashbar-wp-notification-bar' ),
				'default'   => '',
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_popup_countdown_expired_action',
					'operator' => '==',
					'value'    => 'redirect',
				),
			),
		);
	}

	/**
	 * Get Coupon Tab field definitions
	 *
	 * @return array
	 */
	public static function get_coupon_fields() {
		return array(
			'section_coupon' => array(
				'type'        => 'section',
				'label'       => esc_html__( 'Coupon Code', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Display a coupon code with copy functionality', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_coupon_enabled' => array(
				'type'    => 'switch',
				'label'   => esc_html__( 'Enable Coupon', 'hashbar-wp-notification-bar' ),
				'default' => false,
			),
			'_wphash_popup_coupon_code' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Coupon Code', 'hashbar-wp-notification-bar' ),
				'default'   => 'SAVE20',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_label' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Label Above Code', 'hashbar-wp-notification-bar' ),
				'default'   => esc_html__( 'Use code:', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_description' => array(
				'type'      => 'textarea',
				'label'     => esc_html__( 'Description', 'hashbar-wp-notification-bar' ),
				'default'   => '',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_coupon_copy' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'Copy Button', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_copy_button' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Show Copy Button', 'hashbar-wp-notification-bar' ),
				'default'   => true,
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_copy_text' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Copy Button Text', 'hashbar-wp-notification-bar' ),
				'default'   => esc_html__( 'Copy', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_coupon_copy_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_copied_text' => array(
				'type'      => 'text',
				'label'     => esc_html__( 'Copied Text', 'hashbar-wp-notification-bar' ),
				'default'   => esc_html__( 'Copied!', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_coupon_copy_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_copied_bg_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Copied Background Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#52c41a',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_copy_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_autocopy_on_click' => array(
				'type'        => 'switch',
				'label'       => esc_html__( 'Automatically copy the code', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Automatically copy the code when users click on it', 'hashbar-wp-notification-bar' ),
				'default'     => false,
				'isPro'       => true,
				'condition'   => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_click_to_copy_text' => array(
				'type'        => 'text',
				'label'       => esc_html__( 'Click to Copy Text', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'e.g., Click to copy', 'hashbar-wp-notification-bar' ),
				'default'     => esc_html__( 'Click to copy', 'hashbar-wp-notification-bar' ),
				'isPro'       => true,
				'condition'   => array(
					'key'      => '_wphash_popup_coupon_autocopy_on_click',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_coupon_style' => array(
				'type'      => 'section',
				'label'     => esc_html__( 'Style', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_style' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Coupon Style', 'hashbar-wp-notification-bar' ),
				'default'   => 'dashed',
				'options'   => array(
					'simple'   => esc_html__( 'Simple', 'hashbar-wp-notification-bar' ),
					'dashed'   => esc_html__( 'Dashed Border', 'hashbar-wp-notification-bar' ),
					'ticket'   => esc_html__( 'Ticket', 'hashbar-wp-notification-bar' ),
					'gradient' => esc_html__( 'Gradient', 'hashbar-wp-notification-bar' ),
				),
				'isPro'     => array( 'ticket', 'gradient' ),
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_bg_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Background Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#f5f5f5',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_text_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Code Text Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#1890ff',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_border_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Border Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#1890ff',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_font_size' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Code Font Size', 'hashbar-wp-notification-bar' ),
				'default'   => 18,
				'min'       => 12,
				'max'       => 60,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_label_font_size' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Label Font Size', 'hashbar-wp-notification-bar' ),
				'default'   => 14,
				'min'       => 10,
				'max'       => 40,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_button_font_size' => array(
				'type'      => 'slider',
				'label'     => esc_html__( 'Button Font Size', 'hashbar-wp-notification-bar' ),
				'default'   => 14,
				'min'       => 10,
				'max'       => 30,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_copy_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_gradient_start' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Gradient Start', 'hashbar-wp-notification-bar' ),
				'default'   => '#667eea',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_style',
					'operator' => '==',
					'value'    => 'gradient',
				),
			),
			'_wphash_popup_coupon_gradient_end' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Gradient End', 'hashbar-wp-notification-bar' ),
				'default'   => '#764ba2',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_style',
					'operator' => '==',
					'value'    => 'gradient',
				),
			),
			'_wphash_popup_coupon_label_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Label Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#666666',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_description_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Description Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#888888',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_button_bg_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Button Background', 'hashbar-wp-notification-bar' ),
				'default'   => '#1890ff',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_copy_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_button_text_color' => array(
				'type'      => 'color',
				'label'     => esc_html__( 'Button Text Color', 'hashbar-wp-notification-bar' ),
				'default'   => '#ffffff',
				'condition' => array(
					'key'      => '_wphash_popup_coupon_copy_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_coupon_woo' => array(
				'type'        => 'section',
				'label'       => esc_html__( 'WooCommerce Integration', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Link to WooCommerce coupons', 'hashbar-wp-notification-bar' ),
				'isPro'       => true,
				'condition'   => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_woo_integration' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Link to WooCommerce Coupon', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_coupon_woo_coupon_id' => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Select WooCommerce Coupon', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Select a coupon from WooCommerce to use', 'hashbar-wp-notification-bar' ),
				'default'     => '',
				'options'     => array(), // Options loaded dynamically
				'condition'   => array(
					'key'      => '_wphash_popup_coupon_woo_integration',
					'operator' => '==',
					'value'    => true,
				),
			),
		);
	}

	/**
	 * Get Schedule Tab field definitions
	 *
	 * @return array
	 */
	public static function get_schedule_fields() {
		return array(
			'section_schedule' => array(
				'type'        => 'section',
				'label'       => esc_html__( 'Schedule', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Control when your popup is active', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_popup_schedule_enabled' => array(
				'type'    => 'switch',
				'label'   => esc_html__( 'Enable Schedule', 'hashbar-wp-notification-bar' ),
				'default' => false,
			),
			'_wphash_popup_schedule_start_date' => array(
				'type'      => 'datetime',
				'label'     => esc_html__( 'Start Date & Time', 'hashbar-wp-notification-bar' ),
				'default'   => '',
				'condition' => array(
					'key'      => '_wphash_popup_schedule_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_schedule_end_date' => array(
				'type'      => 'datetime',
				'label'     => esc_html__( 'End Date & Time', 'hashbar-wp-notification-bar' ),
				'default'   => '',
				'condition' => array(
					'key'      => '_wphash_popup_schedule_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_schedule_timezone' => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Timezone', 'hashbar-wp-notification-bar' ),
				'default'   => 'site',
				'options'   => array(
					'site'    => esc_html__( 'Site Timezone', 'hashbar-wp-notification-bar' ),
					'visitor' => esc_html__( 'Visitor Timezone', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_popup_schedule_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_schedule_days' => array(
				'type'            => 'section',
				'label'           => esc_html__( 'Day & Time Restrictions', 'hashbar-wp-notification-bar' ),
				'isPro'           => true,
				'proLockedMessage' => esc_html__( 'Upgrade to Pro to unlock day & time restrictions', 'hashbar-wp-notification-bar' ),
				'condition'       => array(
					'key'      => '_wphash_popup_schedule_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_schedule_days_enabled' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Show Only on Specific Days', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_schedule_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_schedule_days' => array(
				'type'      => 'checkbox_group',
				'label'     => esc_html__( 'Days of Week', 'hashbar-wp-notification-bar' ),
				'default'   => array( 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday' ),
				'options'   => array(
					'monday'    => esc_html__( 'Monday', 'hashbar-wp-notification-bar' ),
					'tuesday'   => esc_html__( 'Tuesday', 'hashbar-wp-notification-bar' ),
					'wednesday' => esc_html__( 'Wednesday', 'hashbar-wp-notification-bar' ),
					'thursday'  => esc_html__( 'Thursday', 'hashbar-wp-notification-bar' ),
					'friday'    => esc_html__( 'Friday', 'hashbar-wp-notification-bar' ),
					'saturday'  => esc_html__( 'Saturday', 'hashbar-wp-notification-bar' ),
					'sunday'    => esc_html__( 'Sunday', 'hashbar-wp-notification-bar' ),
				),
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_schedule_days_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_schedule_time_enabled' => array(
				'type'      => 'switch',
				'label'     => esc_html__( 'Show Only During Specific Hours', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_schedule_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_schedule_time_start' => array(
				'type'      => 'time',
				'label'     => esc_html__( 'Start Time', 'hashbar-wp-notification-bar' ),
				'default'   => '09:00',
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_schedule_time_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_popup_schedule_time_end' => array(
				'type'      => 'time',
				'label'     => esc_html__( 'End Time', 'hashbar-wp-notification-bar' ),
				'default'   => '21:00',
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_popup_schedule_time_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
		);
	}

	/**
	 * Get form plugin info for dynamic form selectors
	 *
	 * @return array
	 */
	public static function get_form_plugin_info() {
		return array(
			'cf7' => array(
				'name'       => esc_html__( 'Contact Form 7', 'hashbar-wp-notification-bar' ),
				'fieldKey'   => '_wphash_popup_cf7_form_id',
				'pluginSlug' => 'contact-form-7',
			),
			'wpforms' => array(
				'name'       => esc_html__( 'WPForms', 'hashbar-wp-notification-bar' ),
				'fieldKey'   => '_wphash_popup_wpforms_form_id',
				'pluginSlug' => 'wpforms-lite',
			),
			'ninja_forms' => array(
				'name'       => esc_html__( 'Ninja Forms', 'hashbar-wp-notification-bar' ),
				'fieldKey'   => '_wphash_popup_ninja_form_id',
				'pluginSlug' => 'ninja-forms',
			),
			'gravity_forms' => array(
				'name'       => esc_html__( 'Gravity Forms', 'hashbar-wp-notification-bar' ),
				'fieldKey'   => '_wphash_popup_gravity_form_id',
				'pluginSlug' => 'gravityforms',
			),
			'fluent_forms' => array(
				'name'       => esc_html__( 'Fluent Forms', 'hashbar-wp-notification-bar' ),
				'fieldKey'   => '_wphash_popup_fluent_form_id',
				'pluginSlug' => 'fluentform',
			),
			'ht_form' => array(
				'name'       => esc_html__( 'HT Contact Form', 'hashbar-wp-notification-bar' ),
				'fieldKey'   => '_wphash_popup_ht_form_id',
				'pluginSlug' => 'ht-contactform',
			),
		);
	}

	/**
	 * Get all labels and UI text
	 *
	 * @return array
	 */
	public static function get_labels() {
		return array(
			// Editor UI
			'editor_title'              => esc_html__( 'Edit Popup Campaign', 'hashbar-wp-notification-bar' ),
			'create_new'                => esc_html__( 'Create New Popup Campaign', 'hashbar-wp-notification-bar' ),
			'save'                      => esc_html__( 'Save', 'hashbar-wp-notification-bar' ),
			'cancel'                    => esc_html__( 'Cancel', 'hashbar-wp-notification-bar' ),
			'back'                      => esc_html__( 'Back', 'hashbar-wp-notification-bar' ),
			'delete'                    => esc_html__( 'Delete', 'hashbar-wp-notification-bar' ),
			'pro_feature'               => esc_html__( 'Pro Feature', 'hashbar-wp-notification-bar' ),
			'pro_badge'                 => esc_html__( 'PRO', 'hashbar-wp-notification-bar' ),

			// List page UI
			'list_all_popups'           => esc_html__( 'Popup Campaigns', 'hashbar-wp-notification-bar' ),
			'list_create_new'           => esc_html__( 'Create New', 'hashbar-wp-notification-bar' ),
			'list_search_placeholder'   => esc_html__( 'Search popup campaigns...', 'hashbar-wp-notification-bar' ),
			'list_no_popups_found'      => esc_html__( 'No popup campaigns found', 'hashbar-wp-notification-bar' ),
			'list_create_first'         => esc_html__( 'No popup campaigns yet', 'hashbar-wp-notification-bar' ),
			'list_duplicate'            => esc_html__( 'Duplicate', 'hashbar-wp-notification-bar' ),
			'list_delete_title'         => esc_html__( 'Delete Popup Campaign', 'hashbar-wp-notification-bar' ),
			'list_delete_confirm'       => esc_html__( 'Are you sure you want to delete this popup campaign?', 'hashbar-wp-notification-bar' ),
			'list_untitled'             => esc_html__( 'Untitled', 'hashbar-wp-notification-bar' ),
			'list_published'            => esc_html__( 'Published', 'hashbar-wp-notification-bar' ),
			'list_draft'                => esc_html__( 'Draft', 'hashbar-wp-notification-bar' ),
			'list_save_as_draft'        => esc_html__( 'Save as Draft', 'hashbar-wp-notification-bar' ),
			'list_publish'              => esc_html__( 'Publish', 'hashbar-wp-notification-bar' ),

			// Live Preview UI
			'preview_mode'              => esc_html__( 'Preview Mode', 'hashbar-wp-notification-bar' ),
			'preview_exit'              => esc_html__( 'Exit Preview', 'hashbar-wp-notification-bar' ),
			'preview_mobile'            => esc_html__( 'Mobile Preview', 'hashbar-wp-notification-bar' ),
			'preview_desktop'           => esc_html__( 'Desktop Preview', 'hashbar-wp-notification-bar' ),
			'preview_tablet'            => esc_html__( 'Tablet Preview', 'hashbar-wp-notification-bar' ),

			// Form UI
			'form_field_label'          => esc_html__( 'Field Label', 'hashbar-wp-notification-bar' ),
			'form_field_placeholder'    => esc_html__( 'Placeholder', 'hashbar-wp-notification-bar' ),
			'form_field_required'       => esc_html__( 'Required', 'hashbar-wp-notification-bar' ),
			'form_field_width'          => esc_html__( 'Field Width', 'hashbar-wp-notification-bar' ),
			'form_add_field'            => esc_html__( 'Add Field', 'hashbar-wp-notification-bar' ),
			'form_remove_field'         => esc_html__( 'Remove', 'hashbar-wp-notification-bar' ),

			// Analytics UI
			'analytics_impressions'          => esc_html__( 'Impressions', 'hashbar-wp-notification-bar' ),
			'analytics_views'                => esc_html__( 'Views', 'hashbar-wp-notification-bar' ),
			'analytics_submissions'          => esc_html__( 'Submissions', 'hashbar-wp-notification-bar' ),
			'analytics_conversion_rate'      => esc_html__( 'Conversion Rate', 'hashbar-wp-notification-bar' ),
			'analytics_closes'               => esc_html__( 'Closes', 'hashbar-wp-notification-bar' ),
			'analytics_clicks'               => esc_html__( 'Clicks', 'hashbar-wp-notification-bar' ),
			'analytics_ctr'                  => esc_html__( 'Click-Through Rate', 'hashbar-wp-notification-bar' ),
			'analytics_conversions'          => esc_html__( 'Conversions', 'hashbar-wp-notification-bar' ),
			'analytics_data'                 => esc_html__( 'Analytics Data', 'hashbar-wp-notification-bar' ),
			'analytics_data_description'     => esc_html__( 'Real-time analytics for your popup campaigns. Data is collected from impressions, button clicks, form submissions, and user interactions.', 'hashbar-wp-notification-bar' ),
			'analytics_popup_campaign'       => esc_html__( 'Popup Campaign', 'hashbar-wp-notification-bar' ),
			'analytics_date_range'           => esc_html__( 'Date Range', 'hashbar-wp-notification-bar' ),
			'analytics_granularity'          => esc_html__( 'Granularity', 'hashbar-wp-notification-bar' ),
			'analytics_daily'                => esc_html__( 'Daily', 'hashbar-wp-notification-bar' ),
			'analytics_weekly'               => esc_html__( 'Weekly', 'hashbar-wp-notification-bar' ),
			'analytics_monthly'              => esc_html__( 'Monthly', 'hashbar-wp-notification-bar' ),
			'analytics_refresh'              => esc_html__( 'Refresh', 'hashbar-wp-notification-bar' ),
			'analytics_export'               => esc_html__( 'Export', 'hashbar-wp-notification-bar' ),
			'analytics_performance_over_time' => esc_html__( 'Performance Over Time', 'hashbar-wp-notification-bar' ),
			'analytics_device_distribution'  => esc_html__( 'Device Distribution', 'hashbar-wp-notification-bar' ),
			'analytics_top_countries'        => esc_html__( 'Top Countries', 'hashbar-wp-notification-bar' ),
			'analytics_page_performance'     => esc_html__( 'Page Performance', 'hashbar-wp-notification-bar' ),
			'analytics_no_data'              => esc_html__( 'No analytics data available yet. Views and clicks will appear here as visitors interact with your popup campaigns.', 'hashbar-wp-notification-bar' ),
			'analytics_date'                 => esc_html__( 'Date', 'hashbar-wp-notification-bar' ),
			'analytics_device'               => esc_html__( 'Device', 'hashbar-wp-notification-bar' ),
			'analytics_country'              => esc_html__( 'Country', 'hashbar-wp-notification-bar' ),
			'analytics_page_url'             => esc_html__( 'Page URL', 'hashbar-wp-notification-bar' ),
			'analytics_page_type'            => esc_html__( 'Type', 'hashbar-wp-notification-bar' ),
			'analytics_start_date'           => esc_html__( 'Start date', 'hashbar-wp-notification-bar' ),
			'analytics_end_date'             => esc_html__( 'End date', 'hashbar-wp-notification-bar' ),
			'analytics_all_popups'           => esc_html__( 'All Popup Campaigns', 'hashbar-wp-notification-bar' ),
			'analytics_select_popup'         => esc_html__( 'Select popup campaign', 'hashbar-wp-notification-bar' ),

			// Analytics Tab Labels
			'analytics_tab_announcement'     => esc_html__( 'Announcement', 'hashbar-wp-notification-bar' ),
			'analytics_tab_popup'            => esc_html__( 'Popup Campaign', 'hashbar-wp-notification-bar' ),
			'analytics_tab_notification'     => esc_html__( 'Notification', 'hashbar-wp-notification-bar' ),

			// A/B Testing UI
			'ab_testing'                     => esc_html__( 'A/B Testing', 'hashbar-wp-notification-bar' ),
			'ab_testing_description'         => esc_html__( 'Test different variations of your popup campaigns to optimize performance.', 'hashbar-wp-notification-bar' ),
			'ab_testing_announcement'        => esc_html__( 'Announcement Bar', 'hashbar-wp-notification-bar' ),
			'ab_testing_popup'               => esc_html__( 'Popup Campaign', 'hashbar-wp-notification-bar' ),
			'ab_testing_enable'              => esc_html__( 'Enable A/B Testing', 'hashbar-wp-notification-bar' ),
			'ab_testing_enable_description'  => esc_html__( 'Enable A/B testing for this popup campaign', 'hashbar-wp-notification-bar' ),
			'ab_testing_control_variant'     => esc_html__( 'Control Variant (Original)', 'hashbar-wp-notification-bar' ),
			'ab_testing_control_description' => esc_html__( 'The original popup settings. Visitors not assigned to test variants will see this.', 'hashbar-wp-notification-bar' ),
			'ab_testing_test_variants'       => esc_html__( 'Test Variants', 'hashbar-wp-notification-bar' ),
			'ab_testing_no_variants'         => esc_html__( 'No variants yet', 'hashbar-wp-notification-bar' ),
			'ab_testing_add_variant_hint'    => esc_html__( 'Add a variant to start testing different versions of your popup.', 'hashbar-wp-notification-bar' ),
			'ab_testing_variant_name'        => esc_html__( 'Variant Name', 'hashbar-wp-notification-bar' ),
			'ab_testing_traffic_split'       => esc_html__( 'Traffic Split', 'hashbar-wp-notification-bar' ),
			'ab_testing_quick_settings'      => esc_html__( 'Quick Settings', 'hashbar-wp-notification-bar' ),
			'ab_testing_button_text'         => esc_html__( 'Button Text', 'hashbar-wp-notification-bar' ),
			'ab_testing_title_text'          => esc_html__( 'Title Text', 'hashbar-wp-notification-bar' ),
			'ab_testing_fields_customized'   => esc_html__( 'fields customized', 'hashbar-wp-notification-bar' ),
			'ab_testing_field_customized'    => esc_html__( 'field customized', 'hashbar-wp-notification-bar' ),
			'ab_testing_add_variant'         => esc_html__( 'Add Variant', 'hashbar-wp-notification-bar' ),
			'ab_testing_add_variant_hint2'   => esc_html__( 'Create a new variant to test different configurations', 'hashbar-wp-notification-bar' ),
			'ab_testing_setup'               => esc_html__( 'Setup', 'hashbar-wp-notification-bar' ),
			'ab_testing_statistics'          => esc_html__( 'Statistics', 'hashbar-wp-notification-bar' ),
			'ab_testing_stats_title'         => esc_html__( 'A/B Test Statistics', 'hashbar-wp-notification-bar' ),
			'ab_testing_total_visitors'      => esc_html__( 'Total Visitors', 'hashbar-wp-notification-bar' ),
			'ab_testing_variant'             => esc_html__( 'Variant', 'hashbar-wp-notification-bar' ),
			'ab_testing_control'             => esc_html__( 'Control', 'hashbar-wp-notification-bar' ),
			'ab_testing_winner'              => esc_html__( 'Winner', 'hashbar-wp-notification-bar' ),
			'ab_testing_conv_rate'           => esc_html__( 'Conv. Rate', 'hashbar-wp-notification-bar' ),
			'ab_testing_no_stats'            => esc_html__( 'No statistics available yet. Statistics will appear as visitors interact with your popup.', 'hashbar-wp-notification-bar' ),
			'ab_testing_save_first'          => esc_html__( 'Save the popup campaign to view statistics', 'hashbar-wp-notification-bar' ),
			'ab_testing_pro_feature'         => esc_html__( 'A/B Testing is available exclusively for HashBar Pro users. Make sure HashBar Pro plugin is installed and activated. Upgrade now to unlock this powerful feature and maximize your popup campaign performance.', 'hashbar-wp-notification-bar' ),
			'ab_testing_select_popup'        => esc_html__( 'Select Popup Campaign', 'hashbar-wp-notification-bar' ),
			'ab_testing_select_bar'          => esc_html__( 'Select Announcement Bar', 'hashbar-wp-notification-bar' ),
			'ab_testing_create_new_popup'    => esc_html__( 'Create New Popup', 'hashbar-wp-notification-bar' ),
			'ab_testing_create_new_bar'      => esc_html__( 'Create New Bar', 'hashbar-wp-notification-bar' ),
			'ab_testing_edit_popup'          => esc_html__( 'Edit Popup', 'hashbar-wp-notification-bar' ),
			'ab_testing_edit_bar'            => esc_html__( 'Edit Bar', 'hashbar-wp-notification-bar' ),
			'ab_testing_save_changes'        => esc_html__( 'Save Changes', 'hashbar-wp-notification-bar' ),
			'ab_testing_saved_success'       => esc_html__( 'A/B test configuration saved successfully', 'hashbar-wp-notification-bar' ),
			'ab_testing_saved_error'         => esc_html__( 'Failed to save A/B test configuration', 'hashbar-wp-notification-bar' ),
			'ab_testing_no_popups'           => esc_html__( 'No popup campaigns found', 'hashbar-wp-notification-bar' ),
			'ab_testing_no_bars'             => esc_html__( 'No announcement bars found', 'hashbar-wp-notification-bar' ),
			'ab_testing_create_first_popup'  => esc_html__( 'Create a popup campaign first to set up A/B tests.', 'hashbar-wp-notification-bar' ),
			'ab_testing_create_first_bar'    => esc_html__( 'Create an announcement bar first to set up A/B tests.', 'hashbar-wp-notification-bar' ),
			'ab_testing_select_to_configure' => esc_html__( 'Please select a popup campaign to configure A/B testing', 'hashbar-wp-notification-bar' ),

			// Common actions
			'edit'                      => esc_html__( 'Edit', 'hashbar-wp-notification-bar' ),
			'duplicate'                 => esc_html__( 'Duplicate', 'hashbar-wp-notification-bar' ),
			'close'                     => esc_html__( 'Close', 'hashbar-wp-notification-bar' ),
			'loading'                   => esc_html__( 'Loading...', 'hashbar-wp-notification-bar' ),
			'success'                   => esc_html__( 'Success', 'hashbar-wp-notification-bar' ),
			'error'                     => esc_html__( 'Error', 'hashbar-wp-notification-bar' ),
			'confirm'                   => esc_html__( 'Confirm', 'hashbar-wp-notification-bar' ),
			'yes'                       => esc_html__( 'Yes', 'hashbar-wp-notification-bar' ),
			'no'                        => esc_html__( 'No', 'hashbar-wp-notification-bar' ),
		);
	}

	/**
	 * Get all settings for localization
	 *
	 * @return array
	 */
	/**
	 * Get video guide config for popup campaigns
	 *
	 * @return array
	 */
	public static function get_video_guide() {
		return array(
			'label' => esc_html__( 'Video Guide', 'hashbar-wp-notification-bar' ),
			'url'   => 'https://www.youtube.com/watch?v=2sfpzqQ7OUU',
		);
	}

	public static function get_all_settings() {
		return array(
			'isPro'      => self::is_pro(),
			'tabs'       => self::get_editor_tabs(),
			'fields'     => array(
				'basic'     => self::get_basic_fields(),
				'content'   => self::get_content_fields(),
				'form'      => self::get_form_fields(),
				'design'    => self::get_design_fields(),
				'countdown' => self::get_countdown_fields(),
				'coupon'    => self::get_coupon_fields(),
				'triggers'  => self::get_triggers_fields(),
				'targeting' => self::get_targeting_fields(),
				'schedule'  => self::get_schedule_fields(),
				'frequency' => self::get_frequency_fields(),
				'animation' => self::get_animation_fields(),
			),
			'labels'     => self::get_labels(),
		);
	}

	/**
	 * Get all fields for localization (alias for get_all_settings fields)
	 *
	 * @return array
	 */
	public function get_all_fields() {
		return array(
			'basic'     => self::get_basic_fields(),
			'content'   => self::get_content_fields(),
			'form'      => self::get_form_fields(),
			'design'    => self::get_design_fields(),
			'countdown' => self::get_countdown_fields(),
			'coupon'    => self::get_coupon_fields(),
			'triggers'  => self::get_triggers_fields(),
			'targeting' => self::get_targeting_fields(),
			'schedule'  => self::get_schedule_fields(),
			'frequency' => self::get_frequency_fields(),
			'animation' => self::get_animation_fields(),
		);
	}

	/**
	 * Get templates for localization
	 *
	 * @return array
	 */
	public function get_templates() {
		return array(
			array(
				'id'          => 'blank',
				'name'        => esc_html__( 'Blank', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Start from scratch with a blank canvas', 'hashbar-wp-notification-bar' ),
				'category'    => 'free',
				'tags'        => array( 'Starter', 'Center' ),
				'preview'     => '',
				'config'      => array(),
			),
			array(
				'id'          => 'newsletter_classic',
				'name'        => __( 'Newsletter Classic', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Simple and effective newsletter signup popup', 'hashbar-wp-notification-bar' ),
				'category'    => 'free',
				'tags'        => array( 'Lead Capture', 'Center' ),
				'preview'     => '',
				'config'      => array(
					'_wphash_popup_position'         => 'center',
					'_wphash_popup_campaign_type'    => 'lead_capture',
					'_wphash_popup_heading'          => __( 'Join Our Newsletter', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'      => __( 'Subscribe to get special offers, free giveaways, and updates', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_form_submit_text' => __( 'Subscribe', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_form_enabled'     => true,
					'_wphash_popup_text_align'       => 'center',
					'_wphash_popup_form_alignment'   => 'left',
					'_wphash_popup_bg_color'         => '#ffffff',
					'_wphash_popup_btn_bg_color'     => '#1a1a1a',
					'_wphash_popup_btn_text_color'   => '#ffffff',
					'_wphash_popup_btn_width_type'   => 'full_width',
				),
			),
			// Split E-commerce Template
			array(
				'id'          => 'split_ecommerce',
				'name'        => __( 'Split E-commerce', 'hashbar-wp-notification-bar' ),
				'description' => __( 'E-commerce popup with split image layout and newsletter signup', 'hashbar-wp-notification-bar' ),
				'category'    => 'pro',
				'tags'        => array( 'E-commerce', 'Lead Capture', 'Center' ),
				'preview'     => self::get_template_preview_url( 'split-e-commerce.png' ),
				'config'      => array(
					// Position & Type
					'_wphash_popup_position'              => 'center',
					'_wphash_popup_campaign_type'         => 'welcome',
					// Content
					'_wphash_popup_heading'               => 'Unlock <br><span style="color:#ff4757">20% OFF</span>',
					'_wphash_popup_description'           => __( 'Sign up to our newsletter and get a discount code instantly in your inbox.', 'hashbar-wp-notification-bar' ),
					// Image
					'_wphash_popup_image'                 => array(
						'url' => self::get_template_image_url( 'split-ecommerce-left-side.png' ),
						'id'  => 0,
					),
					'_wphash_popup_image_position'        => 'left',
					'_wphash_popup_image_width'           => 40,
					'_wphash_popup_image_width_unit'      => '%',
					'_wphash_popup_image_alignment'       => 'center',
					// Form
					'_wphash_popup_form_enabled'          => true,
					'_wphash_popup_form_submit_text'      => __( 'Subscribe', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_form_alignment'        => 'left',
					'_wphash_popup_form_fields'           => array(
						array(
							'id'          => 'email_1',
							'type'        => 'email',
							'label'       => '',
							'placeholder' => __( 'Email Address', 'hashbar-wp-notification-bar' ),
							'required'    => true,
						),
					),
					// Design
					'_wphash_popup_width'                 => 763,
					'_wphash_popup_padding'               => array( 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0 ),
					'_wphash_popup_bg_color'              => '#ffffff',
					'_wphash_popup_text_color'            => 'rgb(0,0,0)',
					'_wphash_popup_heading_color'         => 'rgb(0,0,0)',
					'_wphash_popup_subheading_color'      => 'rgb(255,71,87)',
					'_wphash_popup_btn_bg_color'          => 'rgb(255,71,87)',
					'_wphash_popup_btn_text_color'        => '#ffffff',
					'_wphash_popup_btn_width_type'        => 'full_width',
					'_wphash_popup_border_radius'         => 20,
					'_wphash_popup_shadow'                => 'large',
					'_wphash_popup_heading_size'          => 48,
					'_wphash_popup_heading_weight'        => '800',
					'_wphash_popup_text_size'             => 16,
					'_wphash_popup_text_align'            => 'left',
					'_wphash_popup_font_family'           => 'Arial',
					// Content Wrapper
					'_wphash_popup_content_bg_color'      => 'rgb(255,255,255)',
					'_wphash_popup_content_padding'       => array( 'top' => 30, 'right' => 30, 'bottom' => 30, 'left' => 30 ),
					'_wphash_popup_content_valign'        => 'middle',
					'_wphash_popup_content_gap'           => 5,
					// Animation
					'_wphash_popup_animation_entry'       => 'fadeIn',
					// CTA disabled
					'_wphash_popup_cta_enabled'           => false,
				),
			),
			array(
				'id'          => 'discount_offer',
				'name'        => __( 'Discount Offer', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Eye-catching discount popup to boost conversions', 'hashbar-wp-notification-bar' ),
				'category'    => 'free',
				'tags'        => array( 'Promotional', 'Center' ),
				'preview'     => '',
				'config'      => array(
					'_wphash_popup_position'         => 'center',
					'_wphash_popup_campaign_type'    => 'promotion',
					'_wphash_popup_heading'          => __( 'Get 15% OFF Your First Order!', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'      => __( 'Join our mailing list and unlock your exclusive discount code', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_form_submit_text' => __( 'Get My Discount', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_form_enabled'     => true,
					'_wphash_popup_text_align'       => 'center',
					'_wphash_popup_form_alignment'   => 'left',
					'_wphash_popup_bg_color'         => '#fff5f5',
					'_wphash_popup_heading_color'    => '#ff4d4f',
					'_wphash_popup_btn_bg_color'     => '#ff4d4f',
					'_wphash_popup_btn_text_color'   => '#ffffff',
					'_wphash_popup_btn_width_type'   => 'full_width',
				),
			),
			// Discount Coupon Template
			array(
				'id'          => 'discount_coupon',
				'name'        => __( 'Discount Coupon', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Eye-catching coupon design with bold discount display', 'hashbar-wp-notification-bar' ),
				'category'    => 'pro',
				'tags'        => array( 'Coupon', 'Discount', 'E-commerce' ),
				'preview'     => self::get_template_preview_url( 'discount-coupon.png' ),
				'config'      => array(
					'_wphash_popup_position'            => 'center',
					'_wphash_popup_content_type'        => 'custom',
					'_wphash_popup_campaign_type'       => 'promotion',
					'_wphash_popup_heading'             => __( "Don't miss out on savings!", 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'         => __( "Grab this coupon before it's gone.", 'hashbar-wp-notification-bar' ),
					// Coupon settings
					'_wphash_popup_coupon_enabled'      => true,
					'_wphash_popup_coupon_code'         => 'SAVE50',
					'_wphash_popup_coupon_style'        => 'dashed',
					'_wphash_popup_coupon_bg_color'     => '#3d3d3d',
					'_wphash_popup_coupon_text_color'   => '#ffffff',
					'_wphash_popup_coupon_border_color' => '#555555',
					'_wphash_popup_coupon_copy_button'  => true,
					'_wphash_popup_coupon_copy_text'    => __( 'Copy', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_coupon_button_bg_color'   => '#ff4444',
					'_wphash_popup_coupon_button_text_color' => '#ffffff',
					// CTA Button
					'_wphash_popup_cta_enabled'         => true,
					'_wphash_popup_cta_text'            => __( 'CLAIM MY DISCOUNT', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_close_text'          => __( "No thanks, I don't want a discount", 'hashbar-wp-notification-bar' ),
					// Colors - dark theme
					'_wphash_popup_bg_color'            => '#2d2d2d',
					'_wphash_popup_heading_color'       => '#ff4444',
					'_wphash_popup_text_color'          => '#cccccc',
					'_wphash_popup_btn_bg_color'        => '#ff4444',
					'_wphash_popup_btn_text_color'      => '#ffffff',
					'_wphash_popup_btn_border_radius'   => 4,
					// Design
					'_wphash_popup_border_radius'       => 12,
					'_wphash_popup_shadow'              => 'large',
					'_wphash_popup_padding'             => array( 'top' => 24, 'right' => 24, 'bottom' => 24, 'left' => 24 ),
					'_wphash_popup_animation_entry'     => 'zoomIn',
					'_wphash_popup_form_enabled'        => false,
					'_wphash_popup_btn_width_type'      => 'full_width',
				),
			),
			array(
				'id'          => 'welcome_popup',
				'name'        => __( 'Welcome Popup', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Warm welcome message for first-time visitors', 'hashbar-wp-notification-bar' ),
				'category'    => 'free',
				'tags'        => array( 'Welcome', 'Center' ),
				'preview'     => '',
				'config'      => array(
					'_wphash_popup_position'       => 'center',
					'_wphash_popup_campaign_type'  => 'welcome',
					'_wphash_popup_heading'        => __( 'Welcome to Our Store!', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'    => __( 'Discover our curated collection of premium products', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_cta_text'       => __( 'Start Shopping', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_cta_enabled'    => true,
					'_wphash_popup_form_enabled'   => false,
					'_wphash_popup_bg_color'       => '#f0f5ff',
					'_wphash_popup_heading_color'  => '#597ef7',
					'_wphash_popup_btn_bg_color'   => '#597ef7',
					'_wphash_popup_btn_text_color' => '#ffffff',
					'_wphash_popup_btn_width_type' => 'full_width',
				),
			),
			// Flash Sale Template
			array(
				'id'          => 'flash_sale',
				'name'        => __( 'Flash Sale', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Urgent flash sale popup with countdown timer and coupon code', 'hashbar-wp-notification-bar' ),
				'category'    => 'pro',
				'tags'        => array( 'Countdown', 'Coupon', 'Promotional' ),
				'preview'     => self::get_template_preview_url( 'flash-sale.png' ),
				'config'      => array(
					// Position & Type
					'_wphash_popup_position'              => 'center',
					'_wphash_popup_campaign_type'         => 'promotion',
					// Content
					'_wphash_popup_subheading'            => __( 'LIMITED TIME OFFER', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_heading'               => __( 'FLASH SALE', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'           => __( 'Get an extra 10% off using the code below', 'hashbar-wp-notification-bar' ),
					// Countdown Timer
					'_wphash_popup_countdown_enabled'     => true,
					'_wphash_popup_countdown_type'        => 'evergreen',
					'_wphash_popup_countdown_show_days'   => false,
					'_wphash_popup_countdown_hours'       => 2,
					'_wphash_popup_countdown_minutes'     => 45,
					'_wphash_popup_countdown_seconds'     => 12,
					'_wphash_popup_countdown_style'       => 'boxes',
					'_wphash_popup_countdown_bg_color'    => 'rgba(0,0,0,0.2)',
					'_wphash_popup_countdown_text_color'  => '#ffffff',
					'_wphash_popup_countdown_label_color' => '#ffffff',
					// Coupon
					'_wphash_popup_coupon_enabled'        => true,
					'_wphash_popup_coupon_code'           => 'SUMMER24',
					'_wphash_popup_coupon_style'          => 'dashed',
					'_wphash_popup_coupon_bg_color'       => '#ffffff',
					'_wphash_popup_coupon_text_color'     => '#4a1d8e',
					'_wphash_popup_coupon_border_color'   => '#6c5ce7',
					'_wphash_popup_coupon_copy_button'    => false,
					'_wphash_popup_coupon_autocopy_on_click' => true,
					'_wphash_popup_coupon_label'          => '',
					'_wphash_popup_coupon_font_size'      => 20,
					// Design
					'_wphash_popup_bg_type'               => 'gradient',
					'_wphash_popup_bg_color'              => '#6c5ce7',
					'_wphash_popup_gradient_color'        => '#a29bfe',
					'_wphash_popup_gradient_direction'    => 'to_bottom_right',
					'_wphash_popup_heading_color'         => '#ffffff',
					'_wphash_popup_subheading_color'      => '#ffffff',
					'_wphash_popup_text_color'            => '#ffffff',
					'_wphash_popup_text_align'            => 'center',
					'_wphash_popup_heading_size'          => 42,
					'_wphash_popup_heading_weight'        => '900',
					'_wphash_popup_width'                 => 550,
					'_wphash_popup_max_width'             => 98,
					'_wphash_popup_border_radius'         => 16,
					'_wphash_popup_shadow'                => 'large',
					'_wphash_popup_padding'               => array( 'top' => 30, 'right' => 30, 'bottom' => 30, 'left' => 30 ),
					'_wphash_popup_animation_entry'       => 'zoomIn',
					// Close button
					'_wphash_popup_close_color'           => '#ffffff',
					'_wphash_popup_close_bg_color'        => 'rgba(255,255,255,0.2)',
					'_wphash_popup_close_hover_color'     => '#ffffff',
					// Form & CTA disabled
					'_wphash_popup_form_enabled'          => false,
					'_wphash_popup_cta_enabled'           => false,
					// Content order
					'_wphash_popup_content_order'         => array( 'subheading', 'heading', 'countdown', 'description', 'coupon', 'form_or_buttons' ),
					// Custom CSS for styling
					'_wphash_popup_custom_css'            => '.hashbar-popup-body { display: flex; flex-direction: column; gap: 0; }
.hashbar-popup-body .hashbar-popup-subheading { display: inline-block; background: rgba(255,255,255,0.2); padding: 6px 20px; border-radius: 20px; font-size: 12px; letter-spacing: 2px; margin: 0 auto 16px; width: auto; align-self: center; }
.hashbar-popup-body .hashbar-popup-heading { margin-bottom: 20px; }
.hashbar-popup-body .hashbar-popup-countdown { margin-bottom: 20px; }
.hashbar-popup-body .hashbar-popup-description { margin-bottom: 24px; }
.hashbar-popup-body .hashbar-popup-coupon { width: 100%; }
.hashbar-popup-body .hashbar-popup-coupon-code { display: flex; width: 100%; box-sizing: border-box; font-weight: 700; }',
				),
			),
			// Cyber Monday Template
			array(
				'id'          => 'cyber_monday',
				'name'        => __( 'Cyber Monday', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Cyber Monday deal popup with side image and coupon code', 'hashbar-wp-notification-bar' ),
				'category'    => 'pro',
				'tags'        => array( 'Coupon', 'Promotional', 'Center' ),
				'preview'     => self::get_template_preview_url( 'cyber-moday.png' ),
				'config'      => array(
					// Position & Type
					'_wphash_popup_position'              => 'center',
					'_wphash_popup_campaign_type'         => 'promotion',
					// Content
					'_wphash_popup_heading'               => 'CYBER <br>MONDAY',
					'_wphash_popup_subheading'            => __( '*Valid for the next 24 hours only.', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'           => __( 'Upgrade your tech game with exclusive deals on all electronics.', 'hashbar-wp-notification-bar' ),
					// Image
					'_wphash_popup_image'                 => array(
						'url' => self::get_template_image_url( 'cyber-monday-lef-side.png' ),
						'id'  => 0,
					),
					'_wphash_popup_image_position'        => 'left',
					'_wphash_popup_image_width'           => 300,
					'_wphash_popup_image_width_unit'      => 'px',
					'_wphash_popup_image_alignment'       => 'center',
					// Coupon
					'_wphash_popup_coupon_enabled'            => true,
					'_wphash_popup_coupon_code'               => 'CYBER24',
					'_wphash_popup_coupon_style'              => 'dashed',
					'_wphash_popup_coupon_bg_color'           => 'rgba(0,242,255,0.05)',
					'_wphash_popup_coupon_text_color'         => '#ffffff',
					'_wphash_popup_coupon_border_color'       => '#00f2ff',
					'_wphash_popup_coupon_copy_button'        => true,
					'_wphash_popup_coupon_autocopy_on_click'  => true,
					'_wphash_popup_coupon_label'              => '',
					'_wphash_popup_coupon_font_size'          => 24,
					'_wphash_popup_coupon_copy_text'          => __( 'COPY', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_coupon_button_bg_color'    => '#00f2ff',
					'_wphash_popup_coupon_button_text_color'  => '#000000',
					// Design
					'_wphash_popup_width'                 => 820,
					'_wphash_popup_max_width'             => 98,
					'_wphash_popup_padding'               => array( 'top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0 ),
					'_wphash_popup_bg_color'              => '#000000',
					'_wphash_popup_heading_color'         => '#00f2ff',
					'_wphash_popup_subheading_color'      => 'rgba(255,255,255,0.5)',
					'_wphash_popup_text_color'            => '#ffffff',
					'_wphash_popup_text_align'            => 'left',
					'_wphash_popup_heading_size'          => 42,
					'_wphash_popup_heading_weight'        => '900',
					'_wphash_popup_text_size'             => 14,
					'_wphash_popup_border_radius'         => 24,
					'_wphash_popup_shadow'                => 'large',
					'_wphash_popup_font_family'           => 'Arial',
					// Content Wrapper
					'_wphash_popup_content_bg_color'      => '#000000',
					'_wphash_popup_content_padding'       => array( 'top' => 40, 'right' => 40, 'bottom' => 40, 'left' => 40 ),
					'_wphash_popup_content_valign'        => 'middle',
					'_wphash_popup_content_gap'           => 5,
					// Animation
					'_wphash_popup_animation_entry'       => 'fadeIn',
					// Close button
					'_wphash_popup_close_color'           => '#ffffff',
					'_wphash_popup_close_bg_color'        => 'rgba(255,255,255,0.1)',
					'_wphash_popup_close_hover_color'     => '#00f2ff',
					// Form & CTA disabled
					'_wphash_popup_form_enabled'          => false,
					'_wphash_popup_cta_enabled'           => false,
					// Content order
					'_wphash_popup_content_order'         => array( 'heading', 'description', 'coupon', 'subheading', 'form_or_buttons' ),
					// Custom CSS for neon glow and styling
					'_wphash_popup_custom_css'            => '.hashbar-popup-heading { text-shadow: 0 0 10px rgba(0,242,255,0.5); margin-bottom: 16px; }
.hashbar-popup-body { display: flex; flex-direction: column; }
.hashbar-popup-body .hashbar-popup-description { margin-bottom: 24px; }
.hashbar-popup-body .hashbar-popup-coupon { width: 100%; }
.hashbar-popup-body .hashbar-popup-coupon-code { display: flex; width: 100%; box-sizing: border-box; justify-content: space-between; align-items: center; font-weight: 900; }
.hashbar-popup-body .hashbar-popup-subheading { font-size: 13px; font-style: italic; margin-top: 20px; opacity: 0.6; }',
				),
			),
			// Countdown Promotion Template
			array(
				'id'          => 'countdown_promo',
				'name'        => __( 'Countdown Promotion', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Create urgency with a countdown timer and promotional offer', 'hashbar-wp-notification-bar' ),
				'category'    => 'free',
				'tags'        => array( 'Countdown', 'Promotional', 'Center' ),
				'preview'     => '',
				'config'      => array(
					// Position & Type
					'_wphash_popup_position'           => 'center',
					'_wphash_popup_campaign_type'      => 'promotion',
					// Content
					'_wphash_popup_heading'            => __( 'Limited Time Offer!', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'        => __( 'Subscribe below to unlock your exclusive discount code', 'hashbar-wp-notification-bar' ),
					// Countdown Timer
					'_wphash_popup_countdown_enabled'     => true,
					'_wphash_popup_countdown_type'        => 'evergreen',
					'_wphash_popup_countdown_days'        => 0,
					'_wphash_popup_countdown_hours'       => 24,
					'_wphash_popup_countdown_minutes'     => 0,
					'_wphash_popup_countdown_seconds'     => 0,
					'_wphash_popup_countdown_style'       => 'boxes',
					'_wphash_popup_countdown_bg_color'    => '#3d4f61',
					'_wphash_popup_countdown_text_color'  => '#ffffff',
					'_wphash_popup_countdown_label_color' => '#b0b0b0',
					// CTA Button
					'_wphash_popup_cta_enabled'        => true,
					'_wphash_popup_cta_text'           => __( 'Yes, I Want to Save!', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_cta_url'            => '#',
					// Close/Decline Link
					'_wphash_popup_close_text'         => __( 'No thanks, I don\'t want to save', 'hashbar-wp-notification-bar' ),
					// Colors - Dark theme
					'_wphash_popup_bg_color'           => '#2d3e50',
					'_wphash_popup_heading_color'      => '#ffffff',
					'_wphash_popup_text_color'         => '#e0e0e0',
					'_wphash_popup_btn_bg_color'       => '#e67e22',
					'_wphash_popup_btn_text_color'     => '#ffffff',
					'_wphash_popup_btn_width_type'     => 'full_width',
					// Animation
					'_wphash_popup_animation_entry'    => 'fadeIn',
					// Form disabled for this template (CTA only)
					'_wphash_popup_form_enabled'       => false,
				),
			),
			// Spooky Savings Template
			array(
				'id'          => 'spooky_savings',
				'name'        => __( 'Spooky Savings', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Halloween-themed countdown promotion', 'hashbar-wp-notification-bar' ),
				'category'    => 'pro',
				'tags'        => array( 'Halloween', 'Countdown', 'Promotional' ),
				'preview'     => '',
				'config'      => array(
					'_wphash_popup_position'              => 'center',
					'_wphash_popup_campaign_type'         => 'promotion',
					'_wphash_popup_heading'               => __( 'Spooky Savings!', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'           => __( 'Subscribe below to unearth our limited time offer.', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_countdown_enabled'     => true,
					'_wphash_popup_countdown_type'        => 'evergreen',
					'_wphash_popup_countdown_hours'       => 48,
					'_wphash_popup_countdown_style'       => 'boxes',
					'_wphash_popup_countdown_bg_color'    => '#3d4f61',
					'_wphash_popup_countdown_text_color'  => '#ffffff',
					'_wphash_popup_countdown_label_color' => '#b0b0b0',
					'_wphash_popup_cta_enabled'           => true,
					'_wphash_popup_cta_text'              => __( 'Yes, I Want to Save!', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_close_text'            => __( 'No thanks, I don\'t want to save', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_bg_color'              => '#2d3e50',
					'_wphash_popup_heading_color'         => '#ffffff',
					'_wphash_popup_text_color'            => '#e0e0e0',
					'_wphash_popup_btn_bg_color'          => '#e67e22',
					'_wphash_popup_btn_text_color'        => '#ffffff',
					'_wphash_popup_animation_entry'       => 'fadeIn',
					'_wphash_popup_form_enabled'          => false,
					'_wphash_popup_btn_width_type'        => 'full_width',
				),
			),
			// Free Shipping Template
			array(
				'id'          => 'free_shipping',
				'name'        => __( 'Free Shipping', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Promote free shipping offers', 'hashbar-wp-notification-bar' ),
				'category'    => 'free',
				'tags'        => array( 'Shipping', 'E-commerce', 'Promotional' ),
				'preview'     => '',
				'config'      => array(
					'_wphash_popup_position'           => 'center',
					'_wphash_popup_content_type'       => 'custom',
					'_wphash_popup_campaign_type'      => 'promotion',
					'_wphash_popup_heading'            => __( 'Free Shipping!', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_subheading'         => __( 'On orders over $75', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'        => __( 'Code will be applied automatically at checkout.', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_cta_enabled'        => true,
					'_wphash_popup_cta_text'           => __( 'Continue Shopping', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_close_text'         => __( "No thanks, I'll pay for shipping", 'hashbar-wp-notification-bar' ),
					'_wphash_popup_bg_color'           => '#ffffff',
					'_wphash_popup_heading_color'      => '#2d3a4b',
					'_wphash_popup_text_color'         => '#666666',
					'_wphash_popup_btn_bg_color'       => '#e67e22',
					'_wphash_popup_btn_text_color'     => '#ffffff',
					'_wphash_popup_animation_entry'    => 'fadeIn',
					'_wphash_popup_form_enabled'       => false,
					'_wphash_popup_btn_width_type'     => 'full_width',
				),
			),
			// Newsletter Signup Template
			array(
				'id'          => 'newsletter_signup',
				'name'        => __( 'Newsletter Signup', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Clean newsletter signup popup', 'hashbar-wp-notification-bar' ),
				'category'    => 'free',
				'tags'        => array( 'Newsletter', 'Email', 'Subscription' ),
				'preview'     => '',
				'config'      => array(
					'_wphash_popup_position'           => 'center',
					'_wphash_popup_content_type'       => 'custom',
					'_wphash_popup_campaign_type'      => 'newsletter',
					'_wphash_popup_heading'            => __( "Don't miss our latest news!", 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'        => __( 'Sign up today for our free newsletter and stay updated.', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_cta_enabled'        => true,
					'_wphash_popup_cta_text'           => __( "YES, I'M INTERESTED!", 'hashbar-wp-notification-bar' ),
					'_wphash_popup_close_text'         => __( 'No thanks', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_bg_color'           => '#ffffff',
					'_wphash_popup_heading_color'      => '#e65100',
					'_wphash_popup_text_color'         => '#666666',
					'_wphash_popup_btn_bg_color'       => '#e65100',
					'_wphash_popup_btn_text_color'     => '#ffffff',
					'_wphash_popup_animation_entry'    => 'fadeIn',
					'_wphash_popup_form_enabled'       => false,
					'_wphash_popup_btn_width_type'     => 'full_width',
				),
			),
			array(
				'id'          => 'exit_intent',
				'name'        => __( 'Exit Intent', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Catch visitors before they leave with a compelling offer', 'hashbar-wp-notification-bar' ),
				'category'    => 'free',
				'tags'        => array( 'Exit Intent', 'Center' ),
				'preview'     => '',
				'config'      => array(
					'_wphash_popup_position'         => 'center',
					'_wphash_popup_campaign_type'    => 'exit_intent',
					'_wphash_popup_heading'          => __( "Wait! Don't Go Yet!", 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'      => __( 'Get 20% off your first order. Limited time offer!', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_form_submit_text' => __( 'Claim My Offer', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_form_enabled'     => true,
					'_wphash_popup_text_align'       => 'center',
					'_wphash_popup_form_alignment'   => 'left',
					'_wphash_popup_trigger_type'     => 'exit_intent',
					'_wphash_popup_bg_color'         => '#fff7e6',
					'_wphash_popup_btn_bg_color'     => '#fa8c16',
					'_wphash_popup_btn_text_color'   => '#ffffff',
					'_wphash_popup_btn_width_type'   => 'full_width',
				),
			),
			array(
				'id'          => 'slide_in_right',
				'name'        => __( 'Slide-In Right', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Non-intrusive slide-in popup from the bottom right', 'hashbar-wp-notification-bar' ),
				'category'    => 'pro',
				'tags'        => array( 'Slide-In', 'Bottom Right' ),
				'preview'     => '',
				'config'      => array(
					'_wphash_popup_position'        => 'bottom_right',
					'_wphash_popup_campaign_type'   => 'announcement',
					'_wphash_popup_heading'         => __( 'Special Offer', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'     => __( "Limited time deal - don't miss out!", 'hashbar-wp-notification-bar' ),
					'_wphash_popup_cta_text'        => __( 'Shop Now', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_cta_enabled'     => true,
					'_wphash_popup_bg_color'        => '#ffffff',
					'_wphash_popup_heading_color'   => '#1a1a1a',
					'_wphash_popup_text_color'      => '#666666',
					'_wphash_popup_btn_bg_color'    => '#1890ff',
					'_wphash_popup_btn_text_color'  => '#ffffff',
					'_wphash_popup_animation_entry' => 'slideInRight',
					'_wphash_popup_btn_width_type'  => 'full_width',
				),
			),
			array(
				'id'          => 'fullscreen_takeover',
				'name'        => __( 'Fullscreen Takeover', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Bold fullscreen popup for maximum impact', 'hashbar-wp-notification-bar' ),
				'category'    => 'pro',
				'tags'        => array( 'Fullscreen', 'Promotional' ),
				'preview'     => '',
				'config'      => array(
					'_wphash_popup_position'       => 'fullscreen',
					'_wphash_popup_campaign_type'  => 'promotion',
					'_wphash_popup_heading'        => __( 'Black Friday Sale', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'    => __( 'Up to 70% off everything! Limited time only.', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_cta_text'       => __( 'Shop the Sale', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_cta_enabled'    => true,
					'_wphash_popup_bg_color'       => '#1a1a2e',
					'_wphash_popup_heading_color'  => '#ffffff',
					'_wphash_popup_text_color'     => '#ffffff',
					'_wphash_popup_btn_bg_color'   => '#e67e22',
					'_wphash_popup_btn_text_color' => '#ffffff',
					'_wphash_popup_btn_width_type' => 'full_width',
				),
			),
			array(
				'id'          => 'side_panel',
				'name'        => __( 'Side Panel', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Elegant side panel popup for detailed content', 'hashbar-wp-notification-bar' ),
				'category'    => 'pro',
				'tags'        => array( 'Side Panel', 'Right' ),
				'preview'     => '',
				'config'      => array(
					'_wphash_popup_position'        => 'side_right',
					'_wphash_popup_campaign_type'   => 'announcement',
					'_wphash_popup_heading'         => __( 'Quick View', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'     => __( 'Check out our latest products and offers', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_cta_text'        => __( 'View All', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_cta_enabled'     => true,
					'_wphash_popup_bg_color'        => '#ffffff',
					'_wphash_popup_heading_color'   => '#1a1a1a',
					'_wphash_popup_text_color'      => '#666666',
					'_wphash_popup_btn_bg_color'    => '#1890ff',
					'_wphash_popup_btn_text_color'  => '#ffffff',
					'_wphash_popup_animation_entry' => 'slideInRight',
					'_wphash_popup_btn_width_type'  => 'full_width',
				),
			),
			// Exit Survey Template
			array(
				'id'          => 'exit_survey',
				'name'        => __( 'Exit Survey', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Collect feedback when visitors are leaving your site', 'hashbar-wp-notification-bar' ),
				'category'    => 'free',
				'tags'        => array( 'Survey', 'Feedback', 'Exit Intent' ),
				'preview'     => '',
				'config'      => array(
					'_wphash_popup_position'           => 'center',
					'_wphash_popup_campaign_type'      => 'feedback',
					'_wphash_popup_heading'            => __( "We're sorry to see you go. What's your reason for leaving?", 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'        => __( 'Your feedback helps us improve.', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_form_enabled'       => true,
					'_wphash_popup_form_submit_text'   => __( 'Send Your Thoughts', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_form_alignment'     => 'left',
					'_wphash_popup_bg_color'           => '#ffffff',
					'_wphash_popup_heading_color'      => '#1a1a1a',
					'_wphash_popup_text_color'         => '#666666',
					'_wphash_popup_btn_bg_color'       => '#1a9e7a',
					'_wphash_popup_btn_text_color'     => '#ffffff',
					'_wphash_popup_btn_width_type'     => 'full_width',
					'_wphash_popup_animation_entry'    => 'fadeIn',
					'_wphash_popup_cta_enabled'        => false,
				),
			),
			// Feedback Form Template
			array(
				'id'          => 'feedback_form',
				'name'        => __( 'Feedback Form', 'hashbar-wp-notification-bar' ),
				'description' => __( 'Gather user feedback with a friendly form', 'hashbar-wp-notification-bar' ),
				'category'    => 'free',
				'tags'        => array( 'Feedback', 'Form', 'Center' ),
				'preview'     => '',
				'config'      => array(
					'_wphash_popup_position'           => 'center',
					'_wphash_popup_campaign_type'      => 'feedback',
					'_wphash_popup_heading'            => __( 'What could we do to improve?', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_description'        => __( 'We value your opinion and would love to hear your thoughts.', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_form_enabled'       => true,
					'_wphash_popup_form_submit_text'   => __( 'Submit Feedback', 'hashbar-wp-notification-bar' ),
					'_wphash_popup_form_alignment'     => 'left',
					'_wphash_popup_bg_color'           => '#fffbeb',
					'_wphash_popup_heading_color'      => '#1a1a1a',
					'_wphash_popup_text_color'         => '#666666',
					'_wphash_popup_btn_bg_color'       => '#f59e0b',
					'_wphash_popup_btn_text_color'     => '#ffffff',
					'_wphash_popup_btn_width_type'     => 'full_width',
					'_wphash_popup_animation_entry'    => 'fadeIn',
					'_wphash_popup_cta_enabled'        => false,
				),
			),
		);
	}
}
