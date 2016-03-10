<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/menu-walkers.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/**
* pad+ : loads script-styles file for making on the file script styles
*/
require get_template_directory() . '/pad/script-styles.php';

/**
* pad+ : loads script-styles file for making on the file script styles
*/
require get_template_directory() . '/pad/cpt.php';

require get_template_directory() . '/pad/image-sizes.php';

/**
* Enqueue the plugins JS and CSS files
*/
add_action( 'init', 'pad_foundation_load_scripts' );

/**
* pad_+ : enqueues foundation scripts
*/
function pad_foundation_load_scripts() {
	//wp_register_script( 'foundation_app_js', get_template_directory().'/foundation/js/app.js', array('jquery'));
	//wp_register_script( 'foundation_js', get_template_directory().'/foundation/js/foundation.js', array('jquery'));
	//wp_register_script( 'foundation_min_js', get_template_directory().'/foundation/js/foundation.min.js', array('jquery'));
	//wp_register_script( 'foundation_min_vendor', get_template_directory().'/foundation/js/vendor/what-input.min.js', array('jquery'));
	wp_register_script( 'pad_foundation_js', get_template_directory_uri().'/pad/pad.js', array('jquery'));
	wp_register_script( 'pad_flexslider_js', get_template_directory_uri().'/assets/components/flexslider/jquery.flexslider.js', array('jquery'));
	//wp_register_script( 'pad_flexslider_min', get_template_directory_uri().'/assets/components/flexslider/jquery.flexslider-min.js', array('jquery'));

	//wp_register_style( 'foundation_app_css', get_template_directory().'/foundation/css/app.css');
	//wp_register_style( 'foundation_css', get_template_directory().'/foundation/css/foundation.css');
	//wp_register_style( 'foundation_flex_css', get_template_directory().'/foundation/css/foundation-flex.css');
	//wp_register_style( 'foundation_min_css', get_template_directory().'/foundation/css/foundation.min.css');
	wp_register_style( 'pad_foundation_style_css', get_template_directory_uri().'/style.css');
	wp_register_style( 'pad_foundation_css', get_template_directory_uri().'/pad/pad.css');
	wp_register_style( 'pad_flexslider_css', get_template_directory_uri().'/assets/components/flexslider/flexslider.css');


	//wp_enqueue_script( 'foundation_js' );
	//wp_enqueue_script( 'foundation_app_js' );
	//wp_enqueue_script( 'foundation_min_js' );
	//wp_enqueue_script( 'foundation_min_vendor' );
	wp_enqueue_script( 'pad_foundation_js' );

	wp_enqueue_script( 'pad_flexslider_js' );

	//wp_enqueue_script( 'pad_flexslider_min' );


	//wp_enqueue_style( 'foundation_css' );
	//wp_enqueue_style( 'foundation_app_css' );
	//wp_enqueue_style( 'foundation_flex_css' );
	//wp_enqueue_style( 'foundation_min_css' );
	wp_enqueue_style( 'pad_foundation_style_css' );
	wp_enqueue_style( 'pad_foundation_css' );
	wp_enqueue_style( 'pad_flexslider_css' );


}
/**
* pad : adds ACF options pages in dashboard
*/
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
		'icon_url'		=> 'dashicons-admin-tools'
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));

}

add_filter('acf/settings/show_admin', 'hide_acf_menu');

function hide_acf_menu( $show ) {
	
	global $user;
	$user = wp_get_current_user();

	$curr = (array) $user->roles;
	$roles = array('root','administrator');
	

	$roles_found = array_intersect($curr, $roles);
	
	if ( count( $roles_found ) > 0 ) {
		$show = true;
	} else {
		$show = false;
	}

    return $show;
    
}
/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/protocol-relative-theme-assets.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/protocol-relative-theme-assets.php' );
