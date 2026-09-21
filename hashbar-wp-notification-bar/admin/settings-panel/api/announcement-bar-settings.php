<?php
/**
 * Announcement Bar Settings Localization
 *
 * Provides all field definitions, labels, options, and configurations
 * for the announcement bar editor in a centralized localization file.
 *
 * @package HashBar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Announcement Bar Settings Localization Class
 *
 * Handles all localized strings and field definitions for the announcement bar editor.
 */
class Hashbar_Announcement_Bar_Settings {

	/**
	 * Check if Pro version is active
	 *
	 * @return bool
	 */
	public static function is_pro() {
		// Temporarily return true for A/B testing development in free version
		return true; // defined( 'HASHBAR_WPNBP_VERSION' );
	}

	/**
	 * Get full URL for a template preview image
	 *
	 * @param string $filename The image filename
	 * @return string Full URL to the template preview image
	 */
	public static function get_template_preview_url( $filename ) {
		if ( empty( $filename ) ) {
			return '';
		}
		if ( defined( 'HASHBAR_TEMPLATE_IMG_SOURCE' ) && 'external' === HASHBAR_TEMPLATE_IMG_SOURCE ) {
			$base = defined( 'HASHBAR_TEMPLATE_IMG_URL' ) ? HASHBAR_TEMPLATE_IMG_URL : '';
			return trailingslashit( $base ) . 'announcement/preview/' . $filename;
		}
		return plugins_url( 'hashbar-templates-library-src/announcement/preview/' . $filename, dirname( dirname( dirname( __FILE__ ) ) ) );
	}

	/**
	 * Get full URL for a template content image
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
			return trailingslashit( $base ) . 'announcement/images/' . $filename;
		}
		return plugins_url( 'hashbar-templates-library-src/announcement/images/' . $filename, dirname( dirname( dirname( __FILE__ ) ) ) );
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
				'icon'  => 'ThunderboltOutlined',
				'label' => esc_html__( 'Templates', 'hashbar-wp-notification-bar' ),
			),
			array(
				'key'   => 'content',
				'icon'  => 'FormOutlined',
				'label' => esc_html__( 'Content', 'hashbar-wp-notification-bar' ),
			),
			array(
				'key'   => 'position',
				'icon'  => 'LayoutOutlined',
				'label' => esc_html__( 'Position', 'hashbar-wp-notification-bar' ),
			),
			array(
				'key'   => 'targeting',
				'icon'  => 'AimOutlined',
				'label' => esc_html__( 'Targeting', 'hashbar-wp-notification-bar' ),
			),
			array(
				'key'   => 'countdown',
				'icon'  => 'HourglassOutlined',
				'label' => esc_html__( 'Countdown', 'hashbar-wp-notification-bar' ),
			),
			array(
				'key'   => 'coupon',
				'icon'  => 'GiftOutlined',
				'label' => esc_html__( 'Coupon', 'hashbar-wp-notification-bar' ),
				'isPro' => false,
			),
			array(
				'key'   => 'schedule',
				'icon'  => 'CalendarOutlined',
				'label' => esc_html__( 'Schedule', 'hashbar-wp-notification-bar' ),
				'isPro' => false,
			),
			array(
				'key'   => 'design',
				'icon'  => 'BgColorsOutlined',
				'label' => esc_html__( 'Design', 'hashbar-wp-notification-bar' ),
			),
			array(
				'key'   => 'animation',
				'icon'  => 'ThunderboltOutlined',
				'label' => esc_html__( 'Animation', 'hashbar-wp-notification-bar' ),
				'isPro' => false, // Partially free
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
			'section_bar_content' => array(
				'type'        => 'section',
				'label' => esc_html__( 'Bar Content', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Configure the messages and call-to-action for your announcement bar', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_messages' => array(
				'type'       => 'messages_array',
				'label' => esc_html__( 'Messages', 'hashbar-wp-notification-bar' ),
				'default'    => array(
					array(
						'text'           => '',
						'cta_enabled'    => true,
						'cta_text' => esc_html__( 'Learn More', 'hashbar-wp-notification-bar' ),
						'cta_url'        => '#',
						'cta_target'     => '_self',
					),
				),
				'subfields'  => array(
					'text' => array(
						'type'        => 'textarea',
						'label' => esc_html__( 'Message Text', 'hashbar-wp-notification-bar' ),
						'placeholder' => esc_html__( 'Enter your announcement message (max 500 characters)', 'hashbar-wp-notification-bar' ),
						'maxLength'   => 500,
						'rows'        => 3,
					),
					'cta_enabled' => array(
						'type'  => 'switch',
						'label' => esc_html__( 'Call-to-Action Button', 'hashbar-wp-notification-bar' ),
					),
					'cta_text' => array(
						'type'        => 'text',
						'label' => esc_html__( 'Button Text', 'hashbar-wp-notification-bar' ),
						'placeholder' => esc_html__( 'e.g., Shop Now, Learn More', 'hashbar-wp-notification-bar' ),
					),
					'cta_url' => array(
						'type'        => 'text',
						'label' => esc_html__( 'Button URL', 'hashbar-wp-notification-bar' ),
						'placeholder' => esc_html__( 'https://example.com', 'hashbar-wp-notification-bar' ),
					),
					'cta_target' => array(
						'type'    => 'select',
						'label' => esc_html__( 'Link Target', 'hashbar-wp-notification-bar' ),
						'options' => array(
							'_self' => esc_html__( 'Open in Same Window', 'hashbar-wp-notification-bar' ),
							'_blank' => esc_html__( 'Open in New Tab', 'hashbar-wp-notification-bar' ),
						),
					),
				),
			),
			'_wphash_ab_confirmation_page_id' => array(
				'type'        => 'page-select',
				'label'       => esc_html__( 'Confirmation Page', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Select your order confirmation / thank-you page to automatically track purchases as conversions', 'hashbar-wp-notification-bar' ),
				'default'     => 0,
			),
			'section_message_rotation' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Message Rotation', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_message_rotation_enabled' => array(
				'type'  => 'switch',
				'label' => esc_html__( 'Enable Message Rotation', 'hashbar-wp-notification-bar' ),
				'desc' => esc_html__( 'Automatically rotate between multiple messages', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_message_rotation_interval' => array(
				'type'      => 'number',
				'label' => esc_html__( 'Time Between Messages', 'hashbar-wp-notification-bar' ),
				'desc' => esc_html__( 'Time between each message when rotating (5-60 seconds)', 'hashbar-wp-notification-bar' ),
				'default'   => 5,
				'min'       => 5,
				'max'       => 60,
				'condition' => array(
					'key'      => '_wphash_ab_message_rotation_enabled',
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
			'section_colors' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Colors', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_bg_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Background Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#000000',
				'presets'  => array( '#000000', '#ffffff', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
			),
			'_wphash_ab_text_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Text Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#ffffff',
				'presets'  => array( '#ffffff', '#000000', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
			),
			'_wphash_ab_bg_type' => array(
				'type'    => 'select',
				'label' => esc_html__( 'Background Type', 'hashbar-wp-notification-bar' ),
				'default' => 'solid',
				'options' => array(
					'solid'    => esc_html__( 'Solid Color', 'hashbar-wp-notification-bar' ),
					'gradient' => esc_html__( 'Gradient', 'hashbar-wp-notification-bar' ),
					'image'    => esc_html__( 'Image', 'hashbar-wp-notification-bar' ),
				),
				'isPro'       => array( 'gradient', 'image' ),
			),
			'_wphash_ab_gradient_direction' => array(
				'type'    => 'select',
				'label' => esc_html__( 'Gradient Direction', 'hashbar-wp-notification-bar' ),
				'default' => 'to_bottom',
				'options' => array(
					'to_bottom'       => esc_html__( 'Top to Bottom', 'hashbar-wp-notification-bar' ),
					'to_right'        => esc_html__( 'Left to Right', 'hashbar-wp-notification-bar' ),
					'to_bottom_right' => esc_html__( 'Top-Left to Bottom-Right', 'hashbar-wp-notification-bar' ),
					'to_bottom_left'  => esc_html__( 'Top-Right to Bottom-Left', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_ab_bg_type',
					'operator' => '==',
					'value'    => 'gradient',
				),
			),
			'_wphash_ab_gradient_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Gradient Second Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#ffffff',
				'presets'  => array( '#ffffff', '#000000', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_bg_type',
					'operator' => '==',
					'value'    => 'gradient',
				),
			),
			'_wphash_ab_bg_image' => array(
				'type'    => 'image',
				'label' => esc_html__( 'Background Image', 'hashbar-wp-notification-bar' ),
				'default' => array(
					'url'  => '',
					'id'   => 0,
					'size' => 'cover',
				),
				'condition' => array(
					'key'      => '_wphash_ab_bg_type',
					'operator' => '==',
					'value'    => 'image',
				),
			),
			'_wphash_ab_bg_image_size' => array(
				'type'    => 'select',
				'label' => esc_html__( 'Image Size', 'hashbar-wp-notification-bar' ),
				'default' => 'cover',
				'options' => array(
					'cover'   => esc_html__( 'Cover', 'hashbar-wp-notification-bar' ),
					'contain' => esc_html__( 'Contain', 'hashbar-wp-notification-bar' ),
					'auto'    => esc_html__( 'Auto', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_ab_bg_type',
					'operator' => '==',
					'value'    => 'image',
				),
			),
			'section_typography' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Typography', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_font_family' => array(
				'type'    => 'select',
				'label' => esc_html__( 'Font Family', 'hashbar-wp-notification-bar' ),
				'default' => 'system-ui',
				'options' => array(
					'system-ui'      => 'System UI',
					'Arial'          => 'Arial',
					'Georgia'        => 'Georgia',
					'Courier New'    => 'Courier New',
					'Trebuchet MS'   => 'Trebuchet MS',
					'Times New Roman' => 'Times New Roman',
				),
			),
			'_wphash_ab_font_weight' => array(
				'type'    => 'select',
				'label' => esc_html__( 'Font Weight', 'hashbar-wp-notification-bar' ),
				'default' => 400,
				'options' => array(
					300 => esc_html__( 'Light (300)', 'hashbar-wp-notification-bar' ),
					400 => esc_html__( 'Normal (400)', 'hashbar-wp-notification-bar' ),
					600 => esc_html__( 'Semibold (600)', 'hashbar-wp-notification-bar' ),
					700 => esc_html__( 'Bold (700)', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_ab_font_size' => array(
				'type'    => 'slider',
				'label' => esc_html__( 'Font Size', 'hashbar-wp-notification-bar' ),
				'default' => 16,
				'min'     => 12,
				'max'     => 32,
				'unit'    => 'px',
			),
			'_wphash_ab_text_align' => array(
				'type'    => 'select',
				'label' => esc_html__( 'Text Alignment', 'hashbar-wp-notification-bar' ),
				'default' => 'center',
				'options' => array(
					'left' => esc_html__( 'Left', 'hashbar-wp-notification-bar' ),
					'center' => esc_html__( 'Center', 'hashbar-wp-notification-bar' ),
					'right' => esc_html__( 'Right', 'hashbar-wp-notification-bar' ),
				),
			),
			'section_spacing' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Spacing', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_height' => array(
				'type'    => 'slider',
				'label' => esc_html__( 'Bar Height', 'hashbar-wp-notification-bar' ),
				'default' => 60,
				'min'     => 40,
				'max'     => 200,
				'unit'    => 'px',
			),
			'_wphash_ab_padding' => array(
				'type'    => 'padding',
				'label' => esc_html__( 'Padding', 'hashbar-wp-notification-bar' ),
				'default' => array(
					'top'    => 10,
					'right'  => 20,
					'bottom' => 10,
					'left'   => 20,
				),
				'unit'    => 'px',
			),
			'_wphash_ab_container_width_type' => array(
				'type'    => 'select',
				'label' => esc_html__( 'Content Container', 'hashbar-wp-notification-bar' ),
				'default' => 'full',
				'options' => array(
					'full'   => esc_html__( 'Full Width', 'hashbar-wp-notification-bar' ),
					'custom' => esc_html__( 'Custom Width', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_ab_container_width' => array(
				'type'    => 'slider',
				'label' => esc_html__( 'Container Width', 'hashbar-wp-notification-bar' ),
				'default' => 800,
				'min'     => 300,
				'max'     => 1920,
				'unit'    => 'px',
			),
			'section_cta_styling' => array(
				'type'      => 'section',
				'label' => esc_html__( 'CTA Button Styling', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_ab_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_cta_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Button Text Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#000000',
				'presets'  => array( '#000000', '#ffffff', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_cta_bg_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Button Background Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#ffffff',
				'presets'  => array( '#ffffff', '#000000', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_cta_hover_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Hover Text Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#000000',
				'presets'  => array( '#000000', '#ffffff', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_cta_hover_bg_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Hover Background Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#f0f0f0',
				'presets'  => array( '#f0f0f0', '#ffffff', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_cta_font_size' => array(
				'type'      => 'slider',
				'label' => esc_html__( 'CTA Font Size', 'hashbar-wp-notification-bar' ),
				'default'   => 14,
				'min'       => 12,
				'max'       => 32,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_ab_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_cta_font_weight' => array(
				'type'      => 'select',
				'label' => esc_html__( 'CTA Font Weight', 'hashbar-wp-notification-bar' ),
				'default'   => 500,
				'options'   => array(
					300 => esc_html__( 'Light (300)', 'hashbar-wp-notification-bar' ),
					400 => esc_html__( 'Normal (400)', 'hashbar-wp-notification-bar' ),
					600 => esc_html__( 'Semibold (600)', 'hashbar-wp-notification-bar' ),
					700 => esc_html__( 'Bold (700)', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_ab_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_cta_border_radius' => array(
				'type'      => 'slider',
				'label' => esc_html__( 'CTA Border Radius', 'hashbar-wp-notification-bar' ),
				'default'   => 4,
				'min'       => 0,
				'max'       => 20,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_ab_cta_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_close_styling' => array(
				'type'      => 'section',
				'label' => esc_html__( 'Close Button Styling', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_ab_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_close_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Button Text Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#000000',
				'presets'  => array( '#000000', '#ffffff', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_close_bg_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Button Background Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#ffffff',
				'presets'  => array( '#ffffff', '#000000', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_close_hover_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Hover Text Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#000000',
				'presets'  => array( '#000000', '#ffffff', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_close_hover_bg_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Hover Background Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#f0f0f0',
				'presets'  => array( '#f0f0f0', '#ffffff', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_close_font_size' => array(
				'type'      => 'slider',
				'label' => esc_html__( 'Close Font Size', 'hashbar-wp-notification-bar' ),
				'default'   => 14,
				'min'       => 12,
				'max'       => 32,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_ab_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_close_font_weight' => array(
				'type'      => 'select',
				'label' => esc_html__( 'Close Font Weight', 'hashbar-wp-notification-bar' ),
				'default'   => 500,
				'options'   => array(
					300 => esc_html__( 'Light (300)', 'hashbar-wp-notification-bar' ),
					400 => esc_html__( 'Normal (400)', 'hashbar-wp-notification-bar' ),
					600 => esc_html__( 'Semibold (600)', 'hashbar-wp-notification-bar' ),
					700 => esc_html__( 'Bold (700)', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_ab_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_close_border_radius' => array(
				'type'      => 'slider',
				'label' => esc_html__( 'Close Border Radius', 'hashbar-wp-notification-bar' ),
				'default'   => 4,
				'min'       => 0,
				'max'       => 20,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_ab_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_reopen_styling' => array(
				'type'      => 'section',
				'label' => esc_html__( 'Reopen Button Styling', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_ab_reopen_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_reopen_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Button Text Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#ffffff',
				'presets'  => array( '#ffffff', '#000000', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_reopen_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_reopen_bg_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Button Background Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#667eea',
				'presets'  => array( '#667eea', '#764ba2', '#000000', '#1890ff', '#52c41a', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_reopen_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_reopen_hover_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Hover Text Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#ffffff',
				'presets'  => array( '#ffffff', '#000000', '#1890ff', '#52c41a', '#faad14', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_reopen_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_reopen_hover_bg_color' => array(
				'type'     => 'color',
				'label' => esc_html__( 'Hover Background Color', 'hashbar-wp-notification-bar' ),
				'default'  => '#764ba2',
				'presets'  => array( '#764ba2', '#667eea', '#000000', '#1890ff', '#52c41a', '#f5222d' ),
				'condition' => array(
					'key'      => '_wphash_ab_reopen_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_reopen_font_size' => array(
				'type'      => 'slider',
				'label' => esc_html__( 'Font Size', 'hashbar-wp-notification-bar' ),
				'default'   => 14,
				'min'       => 12,
				'max'       => 32,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_ab_reopen_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_reopen_font_weight' => array(
				'type'      => 'select',
				'label' => esc_html__( 'Font Weight', 'hashbar-wp-notification-bar' ),
				'default'   => 500,
				'options'   => array(
					300 => esc_html__( 'Light (300)', 'hashbar-wp-notification-bar' ),
					400 => esc_html__( 'Normal (400)', 'hashbar-wp-notification-bar' ),
					600 => esc_html__( 'Semibold (600)', 'hashbar-wp-notification-bar' ),
					700 => esc_html__( 'Bold (700)', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_ab_reopen_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_reopen_border_radius' => array(
				'type'      => 'slider',
				'label' => esc_html__( 'Border Radius', 'hashbar-wp-notification-bar' ),
				'default'   => 4,
				'min'       => 0,
				'max'       => 20,
				'unit'      => 'px',
				'condition' => array(
					'key'      => '_wphash_ab_reopen_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_custom_css' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Custom CSS', 'hashbar-wp-notification-bar' ),
				'isPro' => true,
			),
			'_wphash_ab_custom_css' => array(
				'type'        => 'textarea',
				'label'       => esc_html__( 'Enter your custom CSS here', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Add custom CSS to style your announcement bar. Use .hashbar-announcement-bar, .hashbar-announcement-cta, .hashbar-coupon-display, or .hashbar-announcement-close as selectors.', 'hashbar-wp-notification-bar' ),
				'default'     => '',
				'rows'        => 6,
				'placeholder' => ".hashbar-announcement-bar { border-bottom: 2px solid red; }\n.hashbar-announcement-cta { }\n.hashbar-coupon-display {}\n.hashbar-announcement-close { }",
				'isPro'       => true,
			),
		);
	}

	/**
	 * Get Position Tab field definitions
	 *
	 * @return array
	 */
	public static function get_position_fields() {
		return array(
			'section_bar_position' => array(
				'type'        => 'section',
				'label' => esc_html__( 'Bar Position & Display', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Control where and how your announcement bar appears', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_position' => array(
				'type'        => 'radio',
				'label' => esc_html__( 'Bar Position', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Choose the position where your bar will be displayed', 'hashbar-wp-notification-bar' ),
				'default'     => 'top',
				'options'     => array(
					'top' => esc_html__( 'Top of page', 'hashbar-wp-notification-bar' ),
					'bottom' => esc_html__( 'Bottom of page', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_ab_sticky' => array(
				'type'        => 'switch',
				'label' => esc_html__( 'Make bar sticky (stays visible when scrolling)', 'hashbar-wp-notification-bar' ),
				'default'     => true,
			),
			'_wphash_ab_z_index' => array(
				'type'        => 'number',
				'label' => esc_html__( 'Z-Index', 'hashbar-wp-notification-bar' ),
				'default'     => 100001,
				'min'         => 1,
				'max'         => 999999,
				'description' => esc_html__( 'Controls stacking order (higher values appear on top)', 'hashbar-wp-notification-bar' ),
			),
			'section_close_button' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Close Button', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_close_enabled' => array(
				'type'    => 'switch',
				'label' => esc_html__( 'Show close button', 'hashbar-wp-notification-bar' ),
				'default' => true,
			),
			'_wphash_ab_close_text' => array(
				'type'        => 'text',
				'label' => esc_html__( 'Close Button Text', 'hashbar-wp-notification-bar' ),
				'default'     => '✕',
				'placeholder' => '✕',
				'maxLength'   => 50,
				'condition'   => array(
					'key'      => '_wphash_ab_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_close_position' => array(
				'type'      => 'select',
				'label' => esc_html__( 'Close Button Position', 'hashbar-wp-notification-bar' ),
				'default'   => 'right',
				'options'   => array(
					'left'      => esc_html__( 'Center Left', 'hashbar-wp-notification-bar' ),
					'right'     => esc_html__( 'Center Right', 'hashbar-wp-notification-bar' ),
					'top_left'  => esc_html__( 'Top Left', 'hashbar-wp-notification-bar' ),
					'top_right' => esc_html__( 'Top Right', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_ab_close_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_reopen_button' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Reopen Button', 'hashbar-wp-notification-bar' ),
				'isPro' => false,
			),
			'_wphash_ab_reopen_enabled' => array(
				'type'    => 'switch',
				'label' => esc_html__( 'Enable reopen button', 'hashbar-wp-notification-bar' ),
				'default' => false,
				'isPro'   => false,
			),
			'_wphash_ab_reopen_text' => array(
				'type'        => 'text',
				'label' => esc_html__( 'Reopen Button Text', 'hashbar-wp-notification-bar' ),
				'default' => esc_html__( 'Show', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
				'condition'   => array(
					'key'      => '_wphash_ab_reopen_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_cookie_duration' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Cookie Duration', 'hashbar-wp-notification-bar' ),
				'isPro' => false,
			),
			'_wphash_ab_cookie_expire_after_close' => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Expire After Close', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Set when this announcement bar should reappear after being closed', 'hashbar-wp-notification-bar' ),
				'default'     => 'show_on_reload',
				'options'     => array(
					'show_on_reload' => esc_html__( 'Show on each page reload (no cookie)', 'hashbar-wp-notification-bar' ),
					'session_only' => esc_html__( 'Session only (closes when browser closes)', 'hashbar-wp-notification-bar' ),
					'1_hour'       => esc_html__( '1 Hour', 'hashbar-wp-notification-bar' ),
					'6_hours'      => esc_html__( '6 Hours', 'hashbar-wp-notification-bar' ),
					'1_day'        => esc_html__( '1 Day', 'hashbar-wp-notification-bar' ),
					'7_days'       => esc_html__( '7 Days', 'hashbar-wp-notification-bar' ),
					'2_weeks'      => esc_html__( '2 Weeks', 'hashbar-wp-notification-bar' ),
					'1_month'      => esc_html__( '1 Month', 'hashbar-wp-notification-bar' ),
					'never'        => esc_html__( 'Never (persistent)', 'hashbar-wp-notification-bar' ),
				),
				'isPro'       => false,
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
			'_wphash_ab_target_pages' => array(
				'type'        => 'radio',
				'label' => esc_html__( 'Show On', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Choose where your announcement bar will be displayed', 'hashbar-wp-notification-bar' ),
				'default'     => 'all',
				'options'     => array(
					'all' => esc_html__( 'All Pages', 'hashbar-wp-notification-bar' ),
					'homepage' => esc_html__( 'Homepage Only', 'hashbar-wp-notification-bar' ),
					'specific' => esc_html__( 'Specific Pages/Posts', 'hashbar-wp-notification-bar' ),
					'exclude' => esc_html__( 'All Except Excluded', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_ab_target_page_ids' => array(
				'type'      => 'multi-select',
				'label' => esc_html__( 'Select Pages/Posts', 'hashbar-wp-notification-bar' ),
				'default'   => array(),
				'condition' => array(
					'key'      => '_wphash_ab_target_pages',
					'operator' => '==',
					'value'    => 'specific',
				),
			),
			'_wphash_ab_exclude_page_ids' => array(
				'type'      => 'multi-select',
				'label' => esc_html__( 'Exclude Pages/Posts', 'hashbar-wp-notification-bar' ),
				'default'   => array(),
				'condition' => array(
					'key'      => '_wphash_ab_target_pages',
					'operator' => '==',
					'value'    => 'exclude',
				),
			),
			'section_device_targeting' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Device Targeting', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_target_devices' => array(
				'type'    => 'checkbox-group',
				'label' => esc_html__( 'Show On Devices', 'hashbar-wp-notification-bar' ),
				'default' => array( 'desktop', 'tablet', 'mobile' ),
				'options' => array(
					'desktop' => esc_html__( 'Desktop', 'hashbar-wp-notification-bar' ),
					'tablet' => esc_html__( 'Tablet', 'hashbar-wp-notification-bar' ),
					'mobile' => esc_html__( 'Mobile', 'hashbar-wp-notification-bar' ),
				),
			),
			'section_geographic_targeting' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Geographic Targeting', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_target_countries' => array(
				'type'        => 'multi-select',
				'label'       => esc_html__( 'Target Countries', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Select specific countries to target (PRO) or leave empty to display worldwide (Free).', 'hashbar-wp-notification-bar' ),
				'default'     => array(),
				'isPro'       => hashbar_get_pro_countries(),
				'options'     => hashbar_get_countries_list( false ),
			),
			'section_customer_segmentation' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Customer Segmentation', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_enable_customer_segmentation' => array(
				'type'    => 'switch',
				'label' => esc_html__( 'Enable Customer Segmentation', 'hashbar-wp-notification-bar' ),
				'default' => false,
			),
			'_wphash_ab_target_logged_in_customers' => array(
				'type'      => 'switch',
				'label' => esc_html__( 'Show to Logged In Customers', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'condition' => array(
					'key'      => '_wphash_ab_enable_customer_segmentation',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_target_guest_visitors' => array(
				'type'      => 'switch',
				'label' => esc_html__( 'Show to Guest Visitors', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'condition' => array(
					'key'      => '_wphash_ab_enable_customer_segmentation',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_behavioral_targeting' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Behavioral Targeting', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_show_after_time_on_site' => array(
				'type'    => 'switch',
				'label' => esc_html__( 'Show after time on site', 'hashbar-wp-notification-bar' ),
				'default' => false,
			),
			'_wphash_ab_minimum_time_on_site' => array(
				'type'      => 'number',
				'label' => esc_html__( 'Minimum Time on Site', 'hashbar-wp-notification-bar' ),
				'default'   => 0,
				'min'       => 0,
				'max'       => 3600,
				'unit'      => 'seconds',
				'condition' => array(
					'key'      => '_wphash_ab_show_after_time_on_site',
					'operator' => '==',
					'value'    => true,
				),
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
				'description' => esc_html__( 'Set up a countdown timer for your announcement', 'hashbar-wp-notification-bar' ),
			),
			'_wphash_ab_countdown_enabled' => array(
				'type'    => 'switch',
				'label' => esc_html__( 'Enable Countdown Timer', 'hashbar-wp-notification-bar' ),
				'default' => false,
			),
			'_wphash_ab_countdown_type' => array(
				'type'      => 'select',
				'label' => esc_html__( 'Countdown Type', 'hashbar-wp-notification-bar' ),
				'default'   => 'fixed',
				'options'   => array(
					'fixed' => esc_html__( 'Fixed End Date', 'hashbar-wp-notification-bar' ),
					'recurring' => esc_html__( 'Recurring', 'hashbar-wp-notification-bar' ),
					'evergreen' => esc_html__( 'Evergreen', 'hashbar-wp-notification-bar' ),
				),
				'isPro'     => ['recurring', 'evergreen'],
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
		'_wphash_ab_countdown_reset_time' => array(
			'type'      => 'time',
			'label' => esc_html__( 'Reset Time', 'hashbar-wp-notification-bar' ),
			'default'   => '00:00',
			'isPro'     => true,
			'condition' => array(
				'key'      => '_wphash_ab_countdown_type',
				'operator' => '==',
				'value'    => 'recurring',
			),
		),
		'_wphash_ab_countdown_reset_days' => array(
			'type'      => 'array',
			'label' => esc_html__( 'Reset Days', 'hashbar-wp-notification-bar' ),
			'default'   => array(),
			'isPro'     => true,
			'condition' => array(
				'key'      => '_wphash_ab_countdown_type',
				'operator' => '==',
				'value'    => 'recurring',
			),
		),
		'_wphash_ab_countdown_duration' => array(
			'type'      => 'number',
			'label' => esc_html__( 'Duration (hours)', 'hashbar-wp-notification-bar' ),
			'default'   => 24,
			'min'       => 1,
			'max'       => 720,
			'isPro'     => true,
			'condition' => array(
				'key'      => '_wphash_ab_countdown_type',
				'operator' => '==',
				'value'    => 'evergreen',
			),
		),
		'_wphash_ab_countdown_date' => array(
				'type'      => 'datetime-local',
				'label' => esc_html__( 'End Date & Time', 'hashbar-wp-notification-bar' ),
				'default'   => '',
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_style' => array(
				'type'      => 'select',
				'label' => esc_html__( 'Timer Style', 'hashbar-wp-notification-bar' ),
				'default'   => 'simple',
				'options'   => array(
					'simple' => esc_html__( 'Simple', 'hashbar-wp-notification-bar' ),
					'digital' => esc_html__( 'Digital', 'hashbar-wp-notification-bar' ),
					'box' => esc_html__( 'Box', 'hashbar-wp-notification-bar' ),
					'circular' => esc_html__( 'Circular', 'hashbar-wp-notification-bar' ),
				),
			'isPro'     => array('digital', 'box', 'circular'),
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_position' => array(
				'type'      => 'select',
				'label' => esc_html__( 'Timer Position', 'hashbar-wp-notification-bar' ),
				'default'   => 'right',
				'options'   => array(
					'top' => esc_html__( 'Top (Above Message)', 'hashbar-wp-notification-bar' ),
					'left' => esc_html__( 'Left (Left of Message)', 'hashbar-wp-notification-bar' ),
					'right' => esc_html__( 'Right (Right of Message)', 'hashbar-wp-notification-bar' ),
					'below' => esc_html__( 'Below (Underneath Message)', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_text_before' => array(
				'type'        => 'text',
				'label' => esc_html__( 'Text Before Timer', 'hashbar-wp-notification-bar' ),
				'default' => esc_html__( 'Offer ends in:', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'Offer ends in:', 'hashbar-wp-notification-bar' ),
				'condition'   => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_text_after' => array(
				'type'      => 'text',
				'label' => esc_html__( 'Text After Timer', 'hashbar-wp-notification-bar' ),
				'default'   => '',
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_countdown_display' => array(
				'type'      => 'section',
				'label' => esc_html__( 'Display Options', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_show_days' => array(
				'type'      => 'switch',
				'label' => esc_html__( 'Show Days', 'hashbar-wp-notification-bar' ),
				'default'   => true,
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_show_hours' => array(
				'type'      => 'switch',
				'label' => esc_html__( 'Show Hours', 'hashbar-wp-notification-bar' ),
				'default'   => true,
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_show_minutes' => array(
				'type'      => 'switch',
				'label' => esc_html__( 'Show Minutes', 'hashbar-wp-notification-bar' ),
				'default'   => true,
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_show_seconds' => array(
				'type'      => 'switch',
				'label' => esc_html__( 'Show Seconds', 'hashbar-wp-notification-bar' ),
				'default'   => true,
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_timezone' => array(
				'type'      => 'select',
				'label' => esc_html__( 'Timezone', 'hashbar-wp-notification-bar' ),
				'default'   => 'site',
				'isPro'     => false,
				'options'   => array(
					'site'    => esc_html__( 'Site Timezone', 'hashbar-wp-notification-bar' ),
					'visitor' => esc_html__( 'Visitor Timezone', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_label_days' => array(
				'type'    => 'text',
				'label'   => esc_html__( 'Days Label', 'hashbar-wp-notification-bar' ),
				'default' => esc_html__( 'Days', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_label_hours' => array(
				'type'    => 'text',
				'label'   => esc_html__( 'Hours Label', 'hashbar-wp-notification-bar' ),
				'default' => esc_html__( 'Hours', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_label_minutes' => array(
				'type'    => 'text',
				'label'   => esc_html__( 'Minutes Label', 'hashbar-wp-notification-bar' ),
				'default' => esc_html__( 'Minutes', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_label_seconds' => array(
				'type'    => 'text',
				'label'   => esc_html__( 'Seconds Label', 'hashbar-wp-notification-bar' ),
				'default' => esc_html__( 'Seconds', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_countdown_style' => array(
				'type'  => 'section',
				'label' => esc_html__( 'Style', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_bg_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Background Color', 'hashbar-wp-notification-bar' ),
				'default' => '#1890ff',
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_text_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Number Color', 'hashbar-wp-notification-bar' ),
				'default' => '#ffffff',
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_label_color' => array(
				'type'    => 'color',
				'label'   => esc_html__( 'Label Color', 'hashbar-wp-notification-bar' ),
				'default' => '#666666',
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'section_countdown_expiry' => array(
				'type'  => 'section',
				'label' => esc_html__( 'When Countdown Expires', 'hashbar-wp-notification-bar' ),
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_expired_action' => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Expiry Action', 'hashbar-wp-notification-bar' ),
				'default' => 'show_message',
				'options' => array(
					'hide_bar'     => esc_html__( 'Hide Bar', 'hashbar-wp-notification-bar' ),
					'show_message' => esc_html__( 'Show Message', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_countdown_expired_message' => array(
				'type'        => 'textarea',
				'label'       => esc_html__( 'Expired Message', 'hashbar-wp-notification-bar' ),
				'default'     => esc_html__( 'This offer has expired!', 'hashbar-wp-notification-bar' ),
				'condition'   => array(
					'key'      => '_wphash_ab_countdown_enabled',
					'operator' => '==',
					'value'    => true,
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
				'description' => esc_html__( 'Display a coupon code for your visitors', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
			),
			'_wphash_ab_coupon_enabled' => array(
				'type'    => 'switch',
				'label' => esc_html__( 'Enable Coupon Display', 'hashbar-wp-notification-bar' ),
				'default' => false,
				'isPro'   => false,
			),
			'_wphash_ab_coupon_code' => array(
				'type'        => 'text',
				'label' => esc_html__( 'Coupon Code', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'Enter coupon code (e.g., SAVE20)', 'hashbar-wp-notification-bar' ),
				'default'     => 'SAVE20',
				'isPro'       => false,
				'condition'   => array(
					'key'      => '_wphash_ab_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_coupon_show_copy_button' => array(
				'type'      => 'switch',
				'label' => esc_html__( 'Show Copy Button', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_ab_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_coupon_copy_button_text' => array(
				'type'        => 'text',
				'label' => esc_html__( 'Copy Button Text', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'e.g., Copy', 'hashbar-wp-notification-bar' ),
				'default' => esc_html__( 'Copy', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
				'condition'   => array(
					'key'      => '_wphash_ab_coupon_show_copy_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_coupon_copied_button_text' => array(
				'type'        => 'text',
				'label' => esc_html__( 'Copied Button Text', 'hashbar-wp-notification-bar' ),
				'placeholder' => esc_html__( 'e.g., Copied!', 'hashbar-wp-notification-bar' ),
				'default' => esc_html__( 'Copied!', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
				'condition'   => array(
					'key'      => '_wphash_ab_coupon_show_copy_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_coupon_autocopy_on_click' => array(
				'type'      => 'switch',
				'label' => esc_html__( 'Auto-copy on click', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_ab_coupon_show_copy_button',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_coupon_autoapply' => array(
				'type'      => 'switch',
				'label' => esc_html__( 'Auto-apply to Cart', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_ab_coupon_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
		'section_coupon_advanced' => array(
			'type'        => 'section',
			'label'       => esc_html__( 'Advanced Coupon Options', 'hashbar-wp-notification-bar' ),
			'description' => esc_html__( 'Configure advanced coupon features including auto-copy and auto-apply functionality', 'hashbar-wp-notification-bar' ),
			'isPro'       => false,
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
				'description' => esc_html__( 'Set a simple date range for your announcement', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
			),
			'_wphash_ab_schedule_enabled' => array(
				'type'    => 'switch',
				'label' => esc_html__( 'Enable Schedule', 'hashbar-wp-notification-bar' ),
				'default' => false,
				'isPro'   => false,
			),
			'_wphash_ab_schedule_start' => array(
				'type'      => 'datetime-local',
				'label' => esc_html__( 'Start Date & Time', 'hashbar-wp-notification-bar' ),
				'default'   => '',
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_ab_schedule_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_schedule_end' => array(
				'type'      => 'datetime-local',
				'label' => esc_html__( 'End Date & Time', 'hashbar-wp-notification-bar' ),
				'default'   => '',
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_ab_schedule_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_schedule_timezone' => array(
				'type'    => 'select',
				'label' => esc_html__( 'Timezone', 'hashbar-wp-notification-bar' ),
				'default' => 'site',
				'isPro'   => false,
				'options' => array(
					'site'    => esc_html__( 'Site Timezone', 'hashbar-wp-notification-bar' ),
					'visitor' => esc_html__( 'Visitor Timezone', 'hashbar-wp-notification-bar' ),
				),
			),
			'_wphash_ab_schedule_recurring' => array(
				'type'      => 'switch',
				'label' => esc_html__( 'Enable Recurring Schedule', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_ab_schedule_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_schedule_recurring_days' => array(
				'type'      => 'checkbox-group',
				'label' => esc_html__( 'Active Days', 'hashbar-wp-notification-bar' ),
				'default'   => array(),
				'isPro'     => false,
				'options'   => array(
					'monday' => esc_html__( 'Monday', 'hashbar-wp-notification-bar' ),
					'tuesday' => esc_html__( 'Tuesday', 'hashbar-wp-notification-bar' ),
					'wednesday' => esc_html__( 'Wednesday', 'hashbar-wp-notification-bar' ),
					'thursday' => esc_html__( 'Thursday', 'hashbar-wp-notification-bar' ),
					'friday' => esc_html__( 'Friday', 'hashbar-wp-notification-bar' ),
					'saturday' => esc_html__( 'Saturday', 'hashbar-wp-notification-bar' ),
					'sunday' => esc_html__( 'Sunday', 'hashbar-wp-notification-bar' ),
				),
				'condition' => array(
					'key'      => '_wphash_ab_schedule_recurring',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_schedule_time_targeting' => array(
				'type'      => 'switch',
				'label' => esc_html__( 'Enable Time Targeting', 'hashbar-wp-notification-bar' ),
				'default'   => false,
				'isPro'     => true,
				'condition' => array(
					'key'      => '_wphash_ab_schedule_enabled',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_schedule_time_start' => array(
				'type'      => 'time',
				'label' => esc_html__( 'Start Time', 'hashbar-wp-notification-bar' ),
				'default'   => '00:00',
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_ab_schedule_time_targeting',
					'operator' => '==',
					'value'    => true,
				),
			),
			'_wphash_ab_schedule_time_end' => array(
				'type'      => 'time',
				'label' => esc_html__( 'End Time', 'hashbar-wp-notification-bar' ),
				'default'   => '23:59',
				'isPro'     => false,
				'condition' => array(
					'key'      => '_wphash_ab_schedule_time_targeting',
					'operator' => '==',
					'value'    => true,
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
			'_wphash_ab_animation_entry' => array(
				'type'    => 'select',
				'label' => esc_html__( 'Entry Animation', 'hashbar-wp-notification-bar' ),
				'default' => 'slideInDown',
				'options' => array(
					'fadeIn' => esc_html__( 'Fade In', 'hashbar-wp-notification-bar' ),
					'slideInDown' => esc_html__( 'Slide Down', 'hashbar-wp-notification-bar' ),
					'slideInUp' => esc_html__( 'Slide Up', 'hashbar-wp-notification-bar' ),
					'bounceIn' => esc_html__( 'Bounce In', 'hashbar-wp-notification-bar' ),
					'zoomIn' => esc_html__( 'Zoom In', 'hashbar-wp-notification-bar' ),
				),
				'isPro'   => array( 'fadeIn', 'slideInUp', 'bounceIn', 'zoomIn', 'rotateIn', 'elasticIn', 'backInDown', 'backInUp' ),
			),
			'_wphash_ab_animation_exit' => array(
				'type'    => 'select',
				'label' => esc_html__( 'Exit Animation', 'hashbar-wp-notification-bar' ),
				'default' => 'slideOutUp',
				'options' => array(
					'slideOutUp' => esc_html__( 'Slide Out Up', 'hashbar-wp-notification-bar' ),
					'fadeOut' => esc_html__( 'Fade Out', 'hashbar-wp-notification-bar' ),
					'slideOutDown' => esc_html__( 'Slide Out Down', 'hashbar-wp-notification-bar' ),
					'bounceOut' => esc_html__( 'Bounce Out', 'hashbar-wp-notification-bar' ),
					'zoomOut' => esc_html__( 'Zoom Out', 'hashbar-wp-notification-bar' ),
				),
				'isPro'   => array( 'fadeOut', 'slideOutDown', 'bounceOut', 'zoomOut' ),
			),
			'_wphash_ab_animation_duration' => array(
				'type'    => 'slider',
				'label' => esc_html__( 'Animation Duration', 'hashbar-wp-notification-bar' ),
				'default' => 500,
				'min'     => 200,
				'max'     => 2000,
				'step'    => 100,
				'unit'    => 'ms',
			),
		);
	}

	/**
	 * Get A/B Test Tab field definitions
	 *
	 * @return array
	 */
	public static function get_abtest_fields() {
		return array(
			'section_abtest' => array(
				'type'  => 'section',
				'label' => esc_html__( 'A/B Testing', 'hashbar-wp-notification-bar' ),
				'isPro' => true,
			),
			'_wphash_ab_test_enabled' => array(
				'type'    => 'switch',
				'label' => esc_html__( 'Enable A/B Testing', 'hashbar-wp-notification-bar' ),
				'default' => false,
				'isPro'   => true,
			),
			'_wphash_ab_test_variants' => array(
				'type'    => 'variants-array',
				'label' => esc_html__( 'Test Variants', 'hashbar-wp-notification-bar' ),
				'default' => array(),
				'isPro'   => true,
			),
		);
	}

	/**
	 * Get template definitions
	 *
	 * @return array
	 */
	public static function get_templates() {
		return array(
			'classic' => array(
				'id'          => 'classic',
				'name' => esc_html__( 'Classic', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'A simple and clean notification banner', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
				'preview'     => 'classic.jpg',
				'color'       => '#000000',
				'textColor'   => '#ffffff',
			),
			'sale_alert' => array(
				'id'          => 'sale_alert',
				'name' => esc_html__( 'Sale Alert', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Perfect for promoting limited-time sales', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
				'preview'     => 'sale-alert.jpg',
				'color'       => '#f5222d',
				'textColor'   => '#ffffff',
			),
			'free_shipping' => array(
				'id'          => 'free_shipping',
				'name' => esc_html__( 'Free Shipping', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Announce free shipping offers', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
				'preview'     => 'free-shipping.jpg',
				'color'       => '#52c41a',
				'textColor'   => '#ffffff',
			),
			'info_banner' => array(
				'id'          => 'info_banner',
				'name' => esc_html__( 'Info Banner', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Display important information or updates', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
				'preview'     => 'info-banner.jpg',
				'color'       => '#1890ff',
				'textColor'   => '#ffffff',
			),
			'countdown_sale' => array(
				'id'          => 'countdown_sale',
				'name' => esc_html__( 'Countdown Sale', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Create urgency with countdown timer', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
				'preview'     => 'countdown-sale.jpg',
				'color'       => '#faad14',
				'textColor'   => '#ffffff',
			),
			'coupon_display' => array(
				'id'          => 'coupon_display',
				'name' => esc_html__( 'Coupon Display', 'hashbar-wp-notification-bar' ),
				'description' => esc_html__( 'Showcase and distribute coupon codes', 'hashbar-wp-notification-bar' ),
				'isPro'       => false,
				'preview'     => 'coupon-display.jpg',
				'color'       => '#722ed1',
				'textColor'   => '#ffffff',
			),
		'minimal_elegant' => array(
			'id'          => 'minimal_elegant',
			'name' => esc_html__( 'Minimal Elegant', 'hashbar-wp-notification-bar' ),
			'description' => wp_kses_post( __( '✨ Quality products, exceptional service. Shop now.', 'hashbar-wp-notification-bar' ) ),
			'isPro'       => false,
			'preview'     => 'minimal-elegant.jpg',
			'color'       => '#f5f5f5',
			'textColor'   => '#262626',
		),
		'urgent_alert' => array(
			'id'          => 'urgent_alert',
			'name' => esc_html__( 'Urgent Alert', 'hashbar-wp-notification-bar' ),
			'description' => wp_kses_post( __( '🔥 HURRY! Sale ends in 2 hours - Don\'t miss out!', 'hashbar-wp-notification-bar' ) ),
			'isPro'       => false,
			'preview'     => 'urgent-alert.jpg',
			'color'       => '#ff6b00',
			'textColor'   => '#ffffff',
		),
		'trust_builder' => array(
			'id'          => 'trust_builder',
			'name' => esc_html__( 'Trust Builder', 'hashbar-wp-notification-bar' ),
			'description' => wp_kses_post( __( '🔒 Secure Checkout | 30-Day Returns | Free Shipping Over $50', 'hashbar-wp-notification-bar' ) ),
			'isPro'       => true,
			'preview'     => 'trust-builder.jpg',
			'bgType'      => 'gradient',
			'color'       => '#0ea5e9',
			'gradientColor' => '#06b6d4',
			'gradientDirection' => 'to_right',
			'textColor'   => '#ffffff',
		),
		'new_launch' => array(
			'id'          => 'new_launch',
			'name' => esc_html__( 'New Launch', 'hashbar-wp-notification-bar' ),
			'description' => wp_kses_post( __( '🚀 NEW ARRIVALS: Check out our latest collection!', 'hashbar-wp-notification-bar' ) ),
			'isPro'       => true,
			'preview'     => 'new-launch.jpg',
			'bgType'      => 'gradient',
			'color'       => '#1e293b',
			'gradientColor' => '#10b981',
			'gradientDirection' => 'to_bottom',
			'textColor'   => '#ffffff',
		),
		'premium_gold' => array(
			'id'          => 'premium_gold',
			'name' => esc_html__( 'Premium Gold', 'hashbar-wp-notification-bar' ),
			'description' => wp_kses_post( __( '⭐ VIP Members: Exclusive 40% Off Luxury Collection', 'hashbar-wp-notification-bar' ) ),
			'isPro'       => true,
			'preview'     => 'premium-gold.jpg',
			'bgType'      => 'gradient',
			'color'       => '#1f2937',
			'gradientColor' => '#0a0a0a',
			'gradientDirection' => 'to_right',
			'textColor'   => '#fbbf24',
		),
		'holiday_special' => array(
			'id'          => 'holiday_special',
			'name' => esc_html__( 'Holiday Special', 'hashbar-wp-notification-bar' ),
			'description' => wp_kses_post( __( '🎄 Holiday Sale: Up to 70% Off + Free Gift Wrapping!', 'hashbar-wp-notification-bar' ) ),
			'isPro'       => false,
			'preview'     => 'holiday-special.jpg',
			'color'       => '#1e3a8a',
			'textColor'   => '#fde047',
		),
		'summer_vibes' => array(
			'id'          => 'summer_vibes',
			'name' => esc_html__( 'Summer Vibes', 'hashbar-wp-notification-bar' ),
			'description' => wp_kses_post( __( '☀️ SUMMER SALE: Up to 60% Off Everything!', 'hashbar-wp-notification-bar' ) ),
			'isPro'       => true,
			'preview'     => 'summer-vibes.jpg',
			'bgType'      => 'gradient',
			'color'       => '#f97316',
			'gradientColor' => '#ea580c',
			'gradientDirection' => 'to_bottom_right',
			'textColor'   => '#ffffff',
		),
		'social_media' => array(
			'id'          => 'social_media',
			'name' => esc_html__( 'Social Media', 'hashbar-wp-notification-bar' ),
			'description' => html_entity_decode( wp_kses_post( __( '📱 Follow us on social media for exclusive updates & special offers!', 'hashbar-wp-notification-bar' ) ) ),
			'isPro'       => true,
			'preview'     => 'social-media.jpg',
			'bgType'      => 'gradient',
			'color'       => '#9333ea',
			'gradientColor' => '#7c3aed',
			'gradientDirection' => 'to_bottom',
			'textColor'   => '#ffffff',
		),
		'bundle_deal' => array(
			'id'          => 'bundle_deal',
			'name' => esc_html__( 'Bundle Deal', 'hashbar-wp-notification-bar' ),
			'description' => wp_kses_post( __( '🎁 Buy 2 Get 1 Free on All Items - Limited Time!', 'hashbar-wp-notification-bar' ) ),
			'isPro'       => true,
			'preview'     => 'bundle-deal.jpg',
			'bgType'      => 'gradient',
			'color'       => '#059669',
			'gradientColor' => '#047857',
			'gradientDirection' => 'to_right',
			'textColor'   => '#ffffff',
		),
		'vip_exclusive' => array(
			'id'          => 'vip_exclusive',
			'name' => esc_html__( 'VIP Exclusive', 'hashbar-wp-notification-bar' ),
			'description' => wp_kses_post( __( '👑 Members Only: Early Access to New Collection + Extra 25% Off', 'hashbar-wp-notification-bar' ) ),
			'isPro'       => true,
			'preview'     => 'vip-exclusive.jpg',
			'bgType'      => 'gradient',
			'color'       => '#4f46e5',
			'gradientColor' => '#6366f1',
			'gradientDirection' => 'to_bottom_right',
			'textColor'   => '#ffffff',
		),
		'limited_stock' => array(
			'id'          => 'limited_stock',
			'name' => esc_html__( 'Limited Stock', 'hashbar-wp-notification-bar' ),
			'description' => wp_kses_post( __( '⚠️ ALMOST GONE! Only few items left - Order before they\'re gone!', 'hashbar-wp-notification-bar' ) ),
			'isPro'       => false,
			'preview'     => 'limited-stock.jpg',
			'color'       => '#dc2626',
			'textColor'   => '#ffffff',
		),
		'early_bird' => array(
			'id'          => 'early_bird',
			'name' => esc_html__( 'Early Bird', 'hashbar-wp-notification-bar' ),
			'description' => wp_kses_post( __( '🌅 Early Bird Special: Get First Access + Extra 15% Off Pre-Orders!', 'hashbar-wp-notification-bar' ) ),
			'isPro'       => true,
			'preview'     => 'early-bird.jpg',
			'bgType'      => 'gradient',
			'color'       => '#ea580c',
			'gradientColor' => '#f97316',
			'gradientDirection' => 'to_bottom',
			'textColor'   => '#ffffff',
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
			'editor_title'             => esc_html__( 'Edit Announcement Bar', 'hashbar-wp-notification-bar' ),
			'create_new'               => esc_html__( 'Create New Announcement Bar', 'hashbar-wp-notification-bar' ),
			'save'                     => esc_html__( 'Save', 'hashbar-wp-notification-bar' ),
			'cancel'                   => esc_html__( 'Cancel', 'hashbar-wp-notification-bar' ),
			'back'                     => esc_html__( 'Back', 'hashbar-wp-notification-bar' ),
			'delete'                   => esc_html__( 'Delete', 'hashbar-wp-notification-bar' ),
			'remove'                   => esc_html__( 'Remove', 'hashbar-wp-notification-bar' ),
			'add_message'              => esc_html__( 'Add Another Message', 'hashbar-wp-notification-bar' ),
			'add_variant'              => esc_html__( 'Add Variant', 'hashbar-wp-notification-bar' ),
			'pro_feature'              => esc_html__( 'Pro Feature', 'hashbar-wp-notification-bar' ),
			'pro_badge'                => esc_html__( 'PRO', 'hashbar-wp-notification-bar' ),
			'reopen_pro_message'       => esc_html__( 'Enable reopen button is a Pro feature', 'hashbar-wp-notification-bar' ),
			'color_presets'            => esc_html__( 'Recommended', 'hashbar-wp-notification-bar' ),
			'message_count'            => esc_html__( 'Message #{count}', 'hashbar-wp-notification-bar' ),
			'control_variant'          => esc_html__( 'Control Variant (Original)', 'hashbar-wp-notification-bar' ),
			'traffic_split'            => esc_html__( 'Traffic Split: {value}%', 'hashbar-wp-notification-bar' ),
			'no_variants'              => esc_html__( 'No variants yet', 'hashbar-wp-notification-bar' ),
			'date_time_required'       => esc_html__( 'Date and time are required', 'hashbar-wp-notification-bar' ),
			'end_after_start'          => esc_html__( 'End date must be after start date', 'hashbar-wp-notification-bar' ),

			// List page UI
			'list_all_bars'            => esc_html__( 'Announcement Bars', 'hashbar-wp-notification-bar' ),
			'list_create_new'          => esc_html__( 'Create New', 'hashbar-wp-notification-bar' ),
			'list_search_placeholder'  => esc_html__( 'Search announcement bars...', 'hashbar-wp-notification-bar' ),
			'list_no_bars_found'       => esc_html__( 'No announcement bars found', 'hashbar-wp-notification-bar' ),
			'list_create_first'        => esc_html__( 'No announcement bars yet', 'hashbar-wp-notification-bar' ),
			'list_duplicate'           => esc_html__( 'Duplicate', 'hashbar-wp-notification-bar' ),
			'list_delete_title'        => esc_html__( 'Delete Announcement Bar', 'hashbar-wp-notification-bar' ),
			'list_delete_confirm'      => esc_html__( 'Are you sure you want to delete this announcement bar?', 'hashbar-wp-notification-bar' ),
			'list_untitled'            => esc_html__( 'Untitled', 'hashbar-wp-notification-bar' ),
			'list_published'           => esc_html__( 'Published', 'hashbar-wp-notification-bar' ),
			'list_draft'               => esc_html__( 'Draft', 'hashbar-wp-notification-bar' ),
			'list_save_as_draft'       => esc_html__( 'Save as Draft', 'hashbar-wp-notification-bar' ),
			'list_publish'             => esc_html__( 'Publish', 'hashbar-wp-notification-bar' ),
			'list_all_status'          => esc_html__( 'All Bars', 'hashbar-wp-notification-bar' ),
			'list_total_label'         => esc_html__( 'Total', 'hashbar-wp-notification-bar' ),
			'list_bars_label'          => esc_html__( 'bars', 'hashbar-wp-notification-bar' ),

			// Live Preview UI
			'preview_mode'             => esc_html__( 'Preview Mode', 'hashbar-wp-notification-bar' ),
			'preview_exit'             => esc_html__( 'Exit Preview', 'hashbar-wp-notification-bar' ),
			'preview_mobile'           => esc_html__( 'Mobile Preview', 'hashbar-wp-notification-bar' ),
			'preview_desktop'          => esc_html__( 'Desktop Preview', 'hashbar-wp-notification-bar' ),
			'preview_tablet'           => esc_html__( 'Tablet Preview', 'hashbar-wp-notification-bar' ),
			'preview_countdown_ends'   => esc_html__( 'Countdown Ends', 'hashbar-wp-notification-bar' ),
			'preview_copy_coupon'      => esc_html__( 'Copy Coupon Code', 'hashbar-wp-notification-bar' ),
			'preview_coupon_copied'    => esc_html__( 'Coupon Copied!', 'hashbar-wp-notification-bar' ),
			'preview_days'             => esc_html__( 'Days', 'hashbar-wp-notification-bar' ),
			'preview_hours'            => esc_html__( 'Hours', 'hashbar-wp-notification-bar' ),
			'preview_minutes'          => esc_html__( 'Minutes', 'hashbar-wp-notification-bar' ),
			'preview_seconds'          => esc_html__( 'Seconds', 'hashbar-wp-notification-bar' ),
			'preview_hidden'           => esc_html__( 'Hidden', 'hashbar-wp-notification-bar' ),
			'preview_visible'          => esc_html__( 'Visible', 'hashbar-wp-notification-bar' ),

			// Analytics UI (non-AB test analytics)
			'analytics_impressions_over_time' => esc_html__( 'Impressions Over Time', 'hashbar-wp-notification-bar' ),
			'analytics_clicks_over_time'      => esc_html__( 'Clicks Over Time', 'hashbar-wp-notification-bar' ),
			'analytics_conversion_rate'       => esc_html__( 'Conversion Rate Over Time', 'hashbar-wp-notification-bar' ),
			'analytics_top_performing'        => esc_html__( 'Top Performing Bars', 'hashbar-wp-notification-bar' ),
			'analytics_performance_comparison' => esc_html__( 'Performance Comparison', 'hashbar-wp-notification-bar' ),
			'analytics_date_range'            => esc_html__( 'Date Range', 'hashbar-wp-notification-bar' ),
			'analytics_last_7_days'           => esc_html__( 'Last 7 Days', 'hashbar-wp-notification-bar' ),
			'analytics_last_30_days'          => esc_html__( 'Last 30 Days', 'hashbar-wp-notification-bar' ),
			'analytics_last_90_days'          => esc_html__( 'Last 90 Days', 'hashbar-wp-notification-bar' ),
			'analytics_custom_range'          => esc_html__( 'Custom Range', 'hashbar-wp-notification-bar' ),
			'analytics_compare_with'          => esc_html__( 'Compare with', 'hashbar-wp-notification-bar' ),
			'analytics_select_bar'            => esc_html__( 'Select Bar', 'hashbar-wp-notification-bar' ),
			'analytics_total_impressions'     => esc_html__( 'Total Impressions', 'hashbar-wp-notification-bar' ),
			'analytics_total_clicks'          => esc_html__( 'Total Clicks', 'hashbar-wp-notification-bar' ),
			'analytics_average_ctr'           => esc_html__( 'Average CTR', 'hashbar-wp-notification-bar' ),
			'analytics_unique_visitors'       => esc_html__( 'Unique Visitors', 'hashbar-wp-notification-bar' ),
			'analytics_total_conversions'     => esc_html__( 'Total Conversions', 'hashbar-wp-notification-bar' ),
			'analytics_average_position'      => esc_html__( 'Average Position', 'hashbar-wp-notification-bar' ),

			// Editor UI
			'editor_save_changes'      => esc_html__( 'Save Changes', 'hashbar-wp-notification-bar' ),
			'editor_discard_changes'   => esc_html__( 'Discard Changes', 'hashbar-wp-notification-bar' ),
			'editor_preview'           => esc_html__( 'Preview', 'hashbar-wp-notification-bar' ),
			'editor_live_preview'      => esc_html__( 'Live Preview', 'hashbar-wp-notification-bar' ),
			'editor_back_to_list'      => esc_html__( 'Back to List', 'hashbar-wp-notification-bar' ),

			// Common actions
			'edit'                     => esc_html__( 'Edit', 'hashbar-wp-notification-bar' ),
			'duplicate'                => esc_html__( 'Duplicate', 'hashbar-wp-notification-bar' ),
			'clone'                    => esc_html__( 'Clone', 'hashbar-wp-notification-bar' ),
			'close'                    => esc_html__( 'Close', 'hashbar-wp-notification-bar' ),
			'loading'                  => esc_html__( 'Loading...', 'hashbar-wp-notification-bar' ),
			'success'                  => esc_html__( 'Success', 'hashbar-wp-notification-bar' ),
			'error'                    => esc_html__( 'Error', 'hashbar-wp-notification-bar' ),
			'warning'                  => esc_html__( 'Warning', 'hashbar-wp-notification-bar' ),
			'confirm'                  => esc_html__( 'Confirm', 'hashbar-wp-notification-bar' ),
			'yes'                      => esc_html__( 'Yes', 'hashbar-wp-notification-bar' ),
			'no'                       => esc_html__( 'No', 'hashbar-wp-notification-bar' ),
			'select_option'            => esc_html__( 'Select an option', 'hashbar-wp-notification-bar' ),
			'search'                   => esc_html__( 'Search', 'hashbar-wp-notification-bar' ),
			'filter'                   => esc_html__( 'Filter', 'hashbar-wp-notification-bar' ),
			'refresh'                  => esc_html__( 'Refresh', 'hashbar-wp-notification-bar' ),
			'retry'                    => esc_html__( 'Retry', 'hashbar-wp-notification-bar' ),
			'no_results'               => esc_html__( 'No results found', 'hashbar-wp-notification-bar' ),
			'view_details'             => esc_html__( 'View Details', 'hashbar-wp-notification-bar' ),
			'select_all'               => esc_html__( 'Select All', 'hashbar-wp-notification-bar' ),
			'bulk_delete'              => esc_html__( 'Bulk Delete', 'hashbar-wp-notification-bar' ),
			'list_bar_name'            => esc_html__( 'Title', 'hashbar-wp-notification-bar' ),
			'list_status'              => esc_html__( 'Status', 'hashbar-wp-notification-bar' ),
			'list_date_created'        => esc_html__( 'Created', 'hashbar-wp-notification-bar' ),
			'list_actions'             => esc_html__( 'Actions', 'hashbar-wp-notification-bar' ),

			// Analytics Page UI
			'analytics_data'           => esc_html__( 'Analytics Data', 'hashbar-wp-notification-bar' ),
			'analytics_description'    => esc_html__( 'Real-time analytics for this announcement bar. Data is collected from page views, button clicks, and user interactions.', 'hashbar-wp-notification-bar' ),
			'analytics_announcement_bar' => esc_html__( 'Announcement Bar', 'hashbar-wp-notification-bar' ),
			'analytics_date_range_label' => esc_html__( 'Date Range', 'hashbar-wp-notification-bar' ),
			'analytics_granularity_label' => esc_html__( 'Granularity', 'hashbar-wp-notification-bar' ),
			'analytics_daily'          => esc_html__( 'Daily', 'hashbar-wp-notification-bar' ),
			'analytics_weekly'         => esc_html__( 'Weekly', 'hashbar-wp-notification-bar' ),
			'analytics_monthly'        => esc_html__( 'Monthly', 'hashbar-wp-notification-bar' ),
			'analytics_refresh'        => esc_html__( 'Refresh', 'hashbar-wp-notification-bar' ),
			'analytics_export'         => esc_html__( 'Export', 'hashbar-wp-notification-bar' ),
			'analytics_impressions'    => esc_html__( 'Impressions', 'hashbar-wp-notification-bar' ),
			'analytics_clicks'         => esc_html__( 'Clicks', 'hashbar-wp-notification-bar' ),
			'analytics_ctr_label'      => esc_html__( 'Click-Through Rate', 'hashbar-wp-notification-bar' ),
			'analytics_conversions'    => esc_html__( 'Conversions', 'hashbar-wp-notification-bar' ),
			'analytics_performance_over_time' => esc_html__( 'Performance Over Time', 'hashbar-wp-notification-bar' ),
			'analytics_table_date'     => esc_html__( 'Date', 'hashbar-wp-notification-bar' ),
			'analytics_table_views'    => esc_html__( 'Views', 'hashbar-wp-notification-bar' ),
			'analytics_table_clicks'   => esc_html__( 'Clicks', 'hashbar-wp-notification-bar' ),
			'analytics_table_ctr'      => esc_html__( 'CTR', 'hashbar-wp-notification-bar' ),
			'analytics_table_conversions' => esc_html__( 'Conversions', 'hashbar-wp-notification-bar' ),
			'analytics_device_distribution' => esc_html__( 'Device Distribution', 'hashbar-wp-notification-bar' ),
			'analytics_table_device'   => esc_html__( 'Device', 'hashbar-wp-notification-bar' ),
			'analytics_top_countries'  => esc_html__( 'Top Countries', 'hashbar-wp-notification-bar' ),
			'analytics_page_performance' => esc_html__( 'Page Performance', 'hashbar-wp-notification-bar' ),
			'analytics_table_page_url' => esc_html__( 'Page URL', 'hashbar-wp-notification-bar' ),
			'analytics_table_type'     => esc_html__( 'Type', 'hashbar-wp-notification-bar' ),
			'analytics_no_data'        => esc_html__( 'No analytics data available yet. Views and clicks will appear here as visitors interact with your announcement bars.', 'hashbar-wp-notification-bar' ),

		// A/B Test Statistics UI
		'abtest_variant_performance'  => esc_html__( 'Variant Performance', 'hashbar-wp-notification-bar' ),
		'abtest_ab_testing_results'   => esc_html__( 'AB Testing Results', 'hashbar-wp-notification-bar' ),
		'abtest_variant'              => esc_html__( 'Variant', 'hashbar-wp-notification-bar' ),
		'abtest_impressions'          => esc_html__( 'Impressions', 'hashbar-wp-notification-bar' ),
		'abtest_clicks'               => esc_html__( 'Clicks', 'hashbar-wp-notification-bar' ),
		'abtest_conversions'          => esc_html__( 'Conversions', 'hashbar-wp-notification-bar' ),
		'abtest_ctr'                  => esc_html__( 'CTR', 'hashbar-wp-notification-bar' ),
		'abtest_conversion_rate'      => esc_html__( 'Conversion Rate', 'hashbar-wp-notification-bar' ),
		'abtest_control'              => esc_html__( 'Control', 'hashbar-wp-notification-bar' ),
		'abtest_winner'               => esc_html__( 'Winner', 'hashbar-wp-notification-bar' ),
		'abtest_total_visitors'       => esc_html__( 'Total Visitors', 'hashbar-wp-notification-bar' ),
		'abtest_total_impressions'    => esc_html__( 'Total Impressions', 'hashbar-wp-notification-bar' ),
		'abtest_total_clicks'         => esc_html__( 'Total Clicks', 'hashbar-wp-notification-bar' ),
		'abtest_total_conversions'    => esc_html__( 'Total Conversions', 'hashbar-wp-notification-bar' ),

		// A/B Test Editor UI
		'abtest_message_text'         => esc_html__( 'Message Text', 'hashbar-wp-notification-bar' ),
		'abtest_enable_cta_button'    => esc_html__( 'Enable CTA Button', 'hashbar-wp-notification-bar' ),
		'abtest_cta_button_text'      => esc_html__( 'CTA Button Text', 'hashbar-wp-notification-bar' ),
		'abtest_cta_url'              => esc_html__( 'CTA URL', 'hashbar-wp-notification-bar' ),
		'abtest_cta_target'           => esc_html__( 'CTA Target', 'hashbar-wp-notification-bar' ),
		'abtest_same_window'          => esc_html__( 'Same Window', 'hashbar-wp-notification-bar' ),
		'abtest_new_tab'              => esc_html__( 'New Tab', 'hashbar-wp-notification-bar' ),
		'abtest_messages_cta'         => esc_html__( 'Messages & CTA', 'hashbar-wp-notification-bar' ),
		'abtest_no_messages_configured' => esc_html__( 'No messages configured', 'hashbar-wp-notification-bar' ),
		'abtest_add_another_message'  => esc_html__( '+ Add Another Message', 'hashbar-wp-notification-bar' ),

		// A/B Test Design UI
		'abtest_colors'               => esc_html__( 'Colors', 'hashbar-wp-notification-bar' ),
		'abtest_background_color'     => esc_html__( 'Background Color', 'hashbar-wp-notification-bar' ),
		'abtest_text_color'           => esc_html__( 'Text Color', 'hashbar-wp-notification-bar' ),

		// A/B Test Feature UI
		'abtest_countdown_timer'      => esc_html__( 'Countdown Timer', 'hashbar-wp-notification-bar' ),
		'abtest_enable_countdown'     => esc_html__( 'Enable Countdown', 'hashbar-wp-notification-bar' ),
		'abtest_countdown_style'      => esc_html__( 'Countdown Style', 'hashbar-wp-notification-bar' ),
		'abtest_reset_countdown_settings' => esc_html__( 'Reset Countdown Settings', 'hashbar-wp-notification-bar' ),
		'abtest_coupon_code'          => esc_html__( 'Coupon Code', 'hashbar-wp-notification-bar' ),
		'abtest_enable_coupon'        => esc_html__( 'Enable Coupon', 'hashbar-wp-notification-bar' ),
		'abtest_reset_coupon_settings' => esc_html__( 'Reset Coupon Settings', 'hashbar-wp-notification-bar' ),
		'abtest_content'              => esc_html__( 'Content', 'hashbar-wp-notification-bar' ),
		'abtest_design'               => esc_html__( 'Design', 'hashbar-wp-notification-bar' ),
		'abtest_inherited'            => esc_html__( 'Inherited', 'hashbar-wp-notification-bar' ),
		'abtest_reset'                => esc_html__( 'Reset', 'hashbar-wp-notification-bar' ),
		'abtest_enabled'              => esc_html__( 'Enabled', 'hashbar-wp-notification-bar' ),
		'abtest_disabled'             => esc_html__( 'Disabled', 'hashbar-wp-notification-bar' ),
		);
	}

	/**
	 * Get timezone options for selects
	 *
	 * @return array
	 */
	/**
	 * Get video guide config for announcement bars
	 *
	 * @return array
	 */
	public static function get_video_guide() {
		return array(
			'label' => esc_html__( 'Video Guide', 'hashbar-wp-notification-bar' ),
			'url'   => 'https://www.youtube.com/watch?v=9VUc5Is-9Uw',
		);
	}

	public static function get_timezone_options() {
		return array(
			'UTC'      => 'UTC (Coordinated Universal Time)',
			'EST'      => 'EST (UTC-5)',
			'CST'      => 'CST (UTC-6)',
			'MST'      => 'MST (UTC-7)',
			'PST'      => 'PST (UTC-8)',
			'GMT'      => 'GMT (UTC+0)',
			'CET'      => 'CET (UTC+1)',
			'EET'      => 'EET (UTC+2)',
			'IST'      => 'IST (UTC+5:30)',
			'JST'      => 'JST (UTC+9)',
			'AEST'     => 'AEST (UTC+10)',
		);
	}
}
