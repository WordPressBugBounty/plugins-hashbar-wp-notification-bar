<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Get hashbar option value
function hashbar_wpnb_get_opt($opt_key){
  $options = get_option( 'hashbar_wpnb_opt' );
  if(isset($options[$opt_key])){
      return $options[$opt_key];
  }else{
      return '';
  }
}

/**
 * Public custom post types that can be offered in the targeting dropdowns.
 * Core types (pages, posts, attachments) and HashBar's own CPTs are left out.
 *
 * @return array slug => label
 */
function hashbar_get_targetable_post_types() {
	$excluded = array( 'post', 'page', 'attachment', 'wphash_ntf_bar', 'wphash_popup', 'wphash_announcement' );
	$types    = array();

	foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $slug => $type_obj ) {
		// Builder/template types (not shown in nav menus) cannot be targeted as pages
		if ( in_array( $slug, $excluded, true ) || ! $type_obj->show_in_nav_menus ) {
			continue;
		}
		$types[ $slug ] = $type_obj->labels->singular_name;
	}

	return apply_filters( 'hashbar_targetable_post_types', $types );
}

/**
 * Font families available for announcement bars and popups.
 *
 * System / web-safe fonts only (nothing is downloaded). Key = stored value,
 * value = CSS font stack with generic fallbacks for platforms missing the font.
 * Keep in sync with FONT_STACKS in admin/settings-panel/src/utils/helpers.js.
 *
 * @return array<string,string>
 */
function hashbar_wpnb_font_stacks() {
	return array(
		'system-ui'       => "system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif",
		'Arial'           => "Arial, 'Helvetica Neue', Helvetica, sans-serif",
		'Helvetica'       => "'Helvetica Neue', Helvetica, Arial, sans-serif",
		'Verdana'         => 'Verdana, Geneva, sans-serif',
		'Tahoma'          => 'Tahoma, Verdana, Geneva, sans-serif',
		'Segoe UI'        => "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif",
		'Calibri'         => "Calibri, Candara, 'Segoe UI', Optima, Arial, sans-serif",
		'Trebuchet MS'    => "'Trebuchet MS', 'Lucida Grande', 'Lucida Sans Unicode', Tahoma, sans-serif",
		'Lucida Sans'     => "'Lucida Sans', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif",
		'Impact'          => "Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif",
		'Georgia'         => "Georgia, 'Times New Roman', Times, serif",
		'Times New Roman' => "'Times New Roman', Times, Georgia, serif",
		'Palatino'        => "'Palatino Linotype', Palatino, 'Book Antiqua', Georgia, serif",
		'Book Antiqua'    => "'Book Antiqua', Palatino, 'Palatino Linotype', Georgia, serif",
		'Garamond'        => "Garamond, 'Times New Roman', Times, serif",
		'Courier New'     => "'Courier New', Courier, monospace",
		'Consolas'        => "Consolas, 'Lucida Console', Monaco, 'Courier New', monospace",
		'Monaco'          => "Monaco, Consolas, 'Lucida Console', 'Courier New', monospace",
	);
}

/**
 * Font family options for the editor dropdowns (value => label).
 *
 * @return array<string,string>
 */
function hashbar_wpnb_font_family_options() {
	$options = array();
	foreach ( array_keys( hashbar_wpnb_font_stacks() ) as $key ) {
		$options[ $key ] = ( 'system-ui' === $key ) ? 'System UI' : $key;
	}
	return $options;
}

/**
 * Resolve a stored font family value to a CSS font stack.
 *
 * Unknown values (older or custom data) are passed through with everything
 * except font-name characters stripped, so output stays safe inside CSS.
 *
 * @param string $value Stored font family.
 * @return string
 */
function hashbar_wpnb_get_font_stack( $value ) {
	$stacks = hashbar_wpnb_font_stacks();
	$value  = is_string( $value ) ? trim( $value ) : '';
	if ( isset( $stacks[ $value ] ) ) {
		return $stacks[ $value ];
	}
	$value = preg_replace( "/[^A-Za-z0-9 ,'\"_-]/", '', $value );
	return '' !== $value ? $value : $stacks['system-ui'];
}

/**
 * Sanitize callback for the font family post meta: only known fonts are stored.
 *
 * @param mixed $value Submitted value.
 * @return string
 */
function hashbar_wpnb_sanitize_font_family( $value ) {
	$value = is_string( $value ) ? trim( $value ) : '';
	return isset( hashbar_wpnb_font_stacks()[ $value ] ) ? $value : 'system-ui';
}

function hashbar_wpnb_allporduct_by_cat( $terms = array(), $field = 'slug' ){
  $get_products = get_posts( array(
    'post_type'   => 'product',
    'numberposts' => -1,
    'post_status' => 'publish',
    'tax_query'   => array(
      array(
          'taxonomy' => 'product_cat',
          'field'    => $field,
          'terms'    => $terms,
          'operator' => 'IN',
      )
    ),
  ) );

  $all_product_list = array();
  foreach ($get_products as $porduct) {
      array_push($all_product_list,$porduct->ID);
  }

  return $all_product_list;
}

function hashbar_wpnb_check_pro_post(){
  $get_custom_post_type = isset($_GET['post']) ? get_post($_GET['post'])->post_type : '';  // phpcs:ignore

  if((isset($_GET['post_type']) && $_GET['post_type'] == 'wphash_ntf_bar') || ( $get_custom_post_type && $get_custom_post_type == 'wphash_ntf_bar' )){ // phpcs:ignore
    return true;
  }
  return false;
}

function hashbar_wpnb_porduct_by_cat($cat_name){
  $get_products = get_posts( array(
    'post_type'   => 'product',
    'numberposts' => -1,
    'post_status' => 'publish',
    'tax_query'   => array(
      array(
          'taxonomy' => 'product_cat',
          'field'    => 'slug',
          'terms'    => $cat_name,
          'operator' => 'IN',
      )
    ),
  ) );

  $category_product_list = array();
  foreach ($get_products as $porduct) {
      $category_product_list[$porduct->ID] = $porduct->post_title;
  }
  return $category_product_list;
}

if ( !function_exists( 'hashbar_wpnb_render_html_attr' ) ){
  function hashbar_wpnb_render_html_attr($attr_name, $var){
    if( $var ){
      printf( '%s="%s"', esc_attr($attr_name), esc_attr($var));
    }
  }
}

if ( !function_exists( 'hashbar_do_shortcode' ) ){
  function hashbar_do_shortcode( $tag, array $atts = array(), $content = null ) {
    global $shortcode_tags;

    if ( ! isset( $shortcode_tags[ $tag ] ) ) {
      return false;
    }

    return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
  }
}

if ( !function_exists( 'hashbar_generate_css' ) ){
  function hashbar_generate_css($value, $selector, $css_attr, $important=''){
    if(!empty( $value ) && 'NaN' !== $value && 'px' !== $value ){
      if(is_array($value)){

        if('border' == $css_attr && 'none' !== $value['style'] && $value['color']){
          return "{$selector}{{$css_attr}:{$value['all']}px {$value['style']} {$value['color']} {$important};}";
        }

        if('padding' == $css_attr){
          if( !empty($value['width']) || !empty($value['height']) ){
            $top_bottom = empty($value['width']) ? '0' : $value['width'];
            $left_right = empty($value['height']) ? '0' : $value['height'];
            return "{$selector}{{$css_attr}:{$top_bottom}px {$left_right}px {$important};}";
          }
        }

        if('typography' == $css_attr){
          $typography = '';
          foreach ($value as $key => $typo_item) {

            if( 'type' == $key || 'unit' == $key || empty($typo_item)) continue;

            if('font-size' != $key && 'line-height' != $key && 'letter-spacing' != $key){
              $typography .= "{$key}:{$typo_item};";
            }else{
              $typography .= "{$key}:{$typo_item}px;";
            }

          }
          return "{$selector}{".$typography."}";
        }

        return;
      }
      return "{$selector}{{$css_attr}:{$value} {$important};}";
    }
  }
}

function hashbar_wpnb_is_classic_editor_plugin_active() {
  if ( ! function_exists( 'is_plugin_active' ) ) {
    include_once ABSPATH . 'wp-admin/includes/plugin.php';
  }

  if ( is_plugin_active( 'classic-editor/classic-editor.php' ) ) {
    return true;
  }

  return false;
}

function hashbar_wpnb_check_post(){
  $get_custom_post_type = isset($_GET['post']) ? get_post($_GET['post'])->post_type : ''; // phpcs:ignore

  if((isset($_GET['post_type']) && $_GET['post_type'] == 'wphash_ntf_bar') || ($get_custom_post_type !== '' && $get_custom_post_type == 'wphash_ntf_bar')){ // phpcs:ignore

    return true;
  }
  return false;
}

/**
 * Get Post List
 * return array
 * @param string $post_type
 * @return array
 * since 1.7.0
 */
/**
 * Get supported countries list for geographic targeting
 *
 * @param bool $include_all Whether to include "All Countries" option
 * @return array Country code => Country name
 * @since 2.0.0
 */
if ( ! function_exists( 'hashbar_get_countries_list' ) ) {
  function hashbar_get_countries_list( $include_all = false ) {
    $countries = array(
      'US' => esc_html__( 'United States', 'hashbar-wp-notification-bar' ),
      'GB' => esc_html__( 'United Kingdom', 'hashbar-wp-notification-bar' ),
      'CA' => esc_html__( 'Canada', 'hashbar-wp-notification-bar' ),
      'AU' => esc_html__( 'Australia', 'hashbar-wp-notification-bar' ),
      'DE' => esc_html__( 'Germany', 'hashbar-wp-notification-bar' ),
      'FR' => esc_html__( 'France', 'hashbar-wp-notification-bar' ),
      'ES' => esc_html__( 'Spain', 'hashbar-wp-notification-bar' ),
      'IT' => esc_html__( 'Italy', 'hashbar-wp-notification-bar' ),
      'NL' => esc_html__( 'Netherlands', 'hashbar-wp-notification-bar' ),
      'BE' => esc_html__( 'Belgium', 'hashbar-wp-notification-bar' ),
      'CH' => esc_html__( 'Switzerland', 'hashbar-wp-notification-bar' ),
      'AT' => esc_html__( 'Austria', 'hashbar-wp-notification-bar' ),
      'SE' => esc_html__( 'Sweden', 'hashbar-wp-notification-bar' ),
      'NO' => esc_html__( 'Norway', 'hashbar-wp-notification-bar' ),
      'DK' => esc_html__( 'Denmark', 'hashbar-wp-notification-bar' ),
      'FI' => esc_html__( 'Finland', 'hashbar-wp-notification-bar' ),
      'PL' => esc_html__( 'Poland', 'hashbar-wp-notification-bar' ),
      'CZ' => esc_html__( 'Czech Republic', 'hashbar-wp-notification-bar' ),
      'IE' => esc_html__( 'Ireland', 'hashbar-wp-notification-bar' ),
      'JP' => esc_html__( 'Japan', 'hashbar-wp-notification-bar' ),
      'CN' => esc_html__( 'China', 'hashbar-wp-notification-bar' ),
      'IN' => esc_html__( 'India', 'hashbar-wp-notification-bar' ),
      'BR' => esc_html__( 'Brazil', 'hashbar-wp-notification-bar' ),
      'MX' => esc_html__( 'Mexico', 'hashbar-wp-notification-bar' ),
      'KR' => esc_html__( 'South Korea', 'hashbar-wp-notification-bar' ),
      'SG' => esc_html__( 'Singapore', 'hashbar-wp-notification-bar' ),
      'HK' => esc_html__( 'Hong Kong', 'hashbar-wp-notification-bar' ),
      'TH' => esc_html__( 'Thailand', 'hashbar-wp-notification-bar' ),
      'MY' => esc_html__( 'Malaysia', 'hashbar-wp-notification-bar' ),
      'ID' => esc_html__( 'Indonesia', 'hashbar-wp-notification-bar' ),
      'PH' => esc_html__( 'Philippines', 'hashbar-wp-notification-bar' ),
      'VN' => esc_html__( 'Vietnam', 'hashbar-wp-notification-bar' ),
      'NZ' => esc_html__( 'New Zealand', 'hashbar-wp-notification-bar' ),
      'ZA' => esc_html__( 'South Africa', 'hashbar-wp-notification-bar' ),
      'RU' => esc_html__( 'Russia', 'hashbar-wp-notification-bar' ),
      'UA' => esc_html__( 'Ukraine', 'hashbar-wp-notification-bar' ),
      'GR' => esc_html__( 'Greece', 'hashbar-wp-notification-bar' ),
      'PT' => esc_html__( 'Portugal', 'hashbar-wp-notification-bar' ),
      'AR' => esc_html__( 'Argentina', 'hashbar-wp-notification-bar' ),
      'CL' => esc_html__( 'Chile', 'hashbar-wp-notification-bar' ),
      'CO' => esc_html__( 'Colombia', 'hashbar-wp-notification-bar' ),
      'PE' => esc_html__( 'Peru', 'hashbar-wp-notification-bar' ),
      'TR' => esc_html__( 'Turkey', 'hashbar-wp-notification-bar' ),
      'AE' => esc_html__( 'United Arab Emirates', 'hashbar-wp-notification-bar' ),
      'SA' => esc_html__( 'Saudi Arabia', 'hashbar-wp-notification-bar' ),
      'IL' => esc_html__( 'Israel', 'hashbar-wp-notification-bar' ),
      'BD' => esc_html__( 'Bangladesh', 'hashbar-wp-notification-bar' ),
      'PK' => esc_html__( 'Pakistan', 'hashbar-wp-notification-bar' ),
      'LK' => esc_html__( 'Sri Lanka', 'hashbar-wp-notification-bar' ),
      'EG' => esc_html__( 'Egypt', 'hashbar-wp-notification-bar' ),
      'NG' => esc_html__( 'Nigeria', 'hashbar-wp-notification-bar' ),
      'KE' => esc_html__( 'Kenya', 'hashbar-wp-notification-bar' ),
    );

    if ( $include_all ) {
      return array_merge(
        array( 'all' => esc_html__( 'All Countries (Worldwide)', 'hashbar-wp-notification-bar' ) ),
        $countries
      );
    }

    return $countries;
  }
}

/**
 * Get Pro countries list (country codes that require Pro)
 *
 * @return array Country codes
 * @since 2.0.0
 */
if ( ! function_exists( 'hashbar_get_pro_countries' ) ) {
  function hashbar_get_pro_countries() {
    return array_keys( hashbar_get_countries_list( false ) );
  }
}

if ( !function_exists( 'hashbar_post_list' ) ){
  function hashbar_post_list( $post_type = 'post', $limit = 20 ){
    static $cache = array();
    $cache_key = $post_type . '_' . $limit;
    if ( isset( $cache[$cache_key] ) ) {
        return $cache[$cache_key];
    }

    $options = array();
    if ( 'product_cat' == $post_type ){

      $categories = get_terms( array(
          'taxonomy' => 'product_cat',
          'hide_empty' => false,
      ) );
      if ( ! empty( $categories ) && ! is_wp_error( $categories ) ){
          foreach ( $categories as $term ) {
              $options[ $term->term_id ] = $term->name;
          }
          $cache[$cache_key] = $options;
          return $options;
      }
    }
    $all_post = array( 'posts_per_page' => $limit, 'post_type'=> $post_type, 'post_status' => 'publish' );
    $post_terms = get_posts( $all_post );
    if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ){
        foreach ( $post_terms as $term ) {
            $options[ $term->ID ] = $term->post_title;
        }
        $cache[$cache_key] = $options;
        return $options;
    }
  }
}

if ( ! function_exists( 'hashbar_get_target_post_types' ) ) {
	/**
	 * Post types saved as "all posts of this type" for a targeting rule.
	 *
	 * @param int    $post_id  Announcement bar / popup ID.
	 * @param string $meta_key Meta key holding the post type slugs (JSON array).
	 * @return string[] Post type slugs.
	 */
	function hashbar_get_target_post_types( $post_id, $meta_key ) {
		$types = get_post_meta( $post_id, $meta_key, true );

		if ( is_string( $types ) ) {
			$types = json_decode( $types, true );
		}
		if ( empty( $types ) || ! is_array( $types ) ) {
			return array();
		}

		return array_values( array_unique( array_filter( array_map( 'sanitize_key', $types ) ) ) );
	}
}

if ( ! function_exists( 'hashbar_current_post_type_in' ) ) {
	/**
	 * Whether the current singular page belongs to one of the given post types.
	 *
	 * @param string[] $types Post type slugs.
	 * @return bool
	 */
	function hashbar_current_post_type_in( $types ) {
		if ( empty( $types ) || ! is_singular() ) {
			return false;
		}

		return in_array( get_post_type( get_queried_object_id() ), $types, true );
	}
}
