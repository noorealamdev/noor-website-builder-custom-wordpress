<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Noor
 */

/** Add body class by filter **/
add_filter( 'body_class', 'noor_body_class_names', 999 );
function noor_body_class_names( $classes ) {
	
	$theme = wp_get_theme();
	if( is_child_theme() ) { $theme = wp_get_theme()->parent(); }

  	$classes[] = 'noor-theme-ver-'.$theme->version;

  	$classes[] = 'wordpress-version-'.get_bloginfo( 'version' );

  	return $classes;
}

/**
 *  Add specific CSS class to header
 */
function noor_header_class() {

	$header_classes  = '';

	if ( noor_get_option('header_fixed') != false ){
		$header_classes  = 'header-overlay';
	}
	if ( function_exists('rwmb_meta') ) {
		if( rwmb_meta('is_trans') == 'yes'){
			$header_classes  = 'header-overlay';
		}elseif( rwmb_meta('is_trans') == 'no'){
			$header_classes = '';
		}
		if( is_singular('noor_portfolio') ){
            $pheader_trans = rwmb_meta('pheader_is_trans');
            if( !empty( $pheader_trans ) ){
            	$header_classes  = 'header-overlay';
            }else{
            	$header_classes = '';
            }
        }
	}
	
    echo $header_classes;
}

function noor_post_header_class() {

	$p_header_classes = '';

	if ( noor_get_option('sheader_fixed') != false ){
		$p_header_classes = 'header-overlay';
	}
	
    echo $p_header_classes;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function noor_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'noor_pingback_header' );

//Get layout post & page.
if ( ! function_exists( 'noor_get_layout' ) ) :
	function noor_get_layout() {
		// Get layout.
		if( is_page() && !is_home() && function_exists( 'rwmb_meta' ) ) {
			$page_layout = rwmb_meta('page_layout');
		}elseif( is_single() ){
			$page_layout = noor_get_option( 'single_post_layout' );
		}else{
			$page_layout = noor_get_option( 'blog_layout' );
		}

		return $page_layout;
	}
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'noor_content_columns' ) ) :
	function noor_content_columns() {

		$blog_content_width = array();

		// Check if layout is one column.
		if ( 'content-sidebar' === noor_get_layout() && is_active_sidebar( 'primary' ) ) {
			$blog_content_width[] = 'col-lg-8 col-md-8 col-sm-12 col-xs-12';
		}elseif ('sidebar-content' === noor_get_layout() && is_active_sidebar( 'primary' ) ) {
			$blog_content_width[] = 'col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right';
		}else{
			$blog_content_width[] = 'col-lg-10 col-lg-offset-1';
		}

		// return the $classes array
    	echo implode( ' ', $blog_content_width );
	}
endif;

/**
 * Back-To-Top on Footer
 */
if( !function_exists('noor_custom_back_to_top') ) {
    function noor_custom_back_to_top() {     
	    if( noor_get_option('backtotop') != false ){
	    	echo '<div class="progress-wrap">
				    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
				      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
				    </svg>
			  	</div>';
	    }
    }
}
add_action('wp_footer', 'noor_custom_back_to_top');

/**
 * Google Analytics
 */
if ( ! function_exists( 'noor_hook_javascript' ) ) {
	function noor_hook_javascript() {
		if ( noor_get_option('js_code') != '' ) { echo noor_get_option('js_code'); }
	}
}
add_action('wp_head', 'noor_hook_javascript');

/**
 * Preload
 */
if ( ! function_exists( 'noor_preload' ) ) {
	function noor_preload() {
		if ( noor_get_option('preload') != false ) { echo '<div class="page-loader"></div>'; }
	}
}
/**
 * Shortcode Copyright
 * output: [oceanthemes_date time_custom="F j, Y"]
 */
function oceanthemes_date_func( $atts ) {
    $date_format = shortcode_atts( array(
        'time_custom' => 'Y',        
    ), $atts );

    $dt = new DateTime("now");
    $gmt_timestamp = $dt->format("{$date_format['time_custom']}");

    return $gmt_timestamp;
}
add_shortcode( 'oceanthemes_date', 'oceanthemes_date_func' );

/**
 * Contact form 7 remove span
 */
add_filter('wpcf7_form_elements', function($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
    $content = str_replace('<br />', '', $content);      
    return $content;
});