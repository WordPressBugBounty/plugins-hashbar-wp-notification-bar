<?php
// Get hashbar option value
function hashbar_wpnb_get_opt($opt_key){
  $options = get_option( 'hashbar_wpnb_opt' );
  if(isset($options[$opt_key])){
      return $options[$opt_key];
  }else{
      return '';
  }
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
if ( !function_exists( 'hashbar_post_list' ) ){
  function hashbar_post_list( $post_type = 'post', $limit = -1 ){
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
          return $options;
      }
    }
    $all_post = array( 'posts_per_page' => $limit, 'post_type'=> $post_type, 'post_status' => 'publish' );
    $post_terms = get_posts( $all_post );
    if ( ! empty( $post_terms ) && ! is_wp_error( $post_terms ) ){
        foreach ( $post_terms as $term ) {
            $options[ $term->ID ] = $term->post_title;
        }
        return $options;
    }
  }
}