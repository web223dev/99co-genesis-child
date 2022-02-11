<?php
/**
 * Functions
 *
 * @package      EAGenesisChild
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/*
BEFORE MODIFYING THIS THEME:
Please read the instructions here (private repo): https://github.com/billerickson/EA-Starter/wiki
Devs, contact me if you need access
*/

/**
 * Set up the content width value based on the theme's design.
 *
 */
if ( ! isset( $content_width ) )
    $content_width = 768;

/**
 * Global enqueues
 *
 * @since  1.0.0
 * @global array $wp_styles
 */
function ea_global_enqueues() {

	// javascript
	if( ! ea_is_amp() ) { 
		wp_enqueue_script( 'ea-global', get_stylesheet_directory_uri() . '/assets/js/global-min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/assets/js/global-min.js' ), true );
		// AlpineJS CDN
		wp_enqueue_script( 'cb-alpinejs', get_stylesheet_directory_uri() . '/assets/js/alpine.min.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/assets/js/alpine.min.js' ), false );
		// TailwindCSS CDN
		wp_enqueue_script( 'cb-script', get_stylesheet_directory_uri() . '/assets/js/tailwindcss.js', array( 'jquery' ), filemtime( get_stylesheet_directory() . '/assets/js/tailwindcss.js' ), false );

		// Move jQuery to footer
		if( ! is_admin() ) {
			wp_deregister_script( 'jquery' );
			wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
			wp_enqueue_script( 'jquery' );
		}
	}

	// css
	wp_dequeue_style( 'child-theme' );
	wp_enqueue_style( 'ea-fonts', ea_theme_fonts_url() );
	// wp_enqueue_style( 'ea-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );
	wp_enqueue_style( 'cb-style', get_stylesheet_directory_uri() . '/assets/css/cb-style.css', array(), filemtime( get_stylesheet_directory() . '/assets/css/cb-style.css' ) );
	// Swiper Slider
	wp_enqueue_style( 'cb-swiper', '//unpkg.com/swiper@8/swiper-bundle.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'ea_global_enqueues' );

/**
 * Add a defer attribute to the designated <script> tags.
 *
 * See: http://calendar.perfplanet.com/2016/prefer-defer-over-async/
 *
 * @since 1.0.0
 */
function cb_script_loader_tags( $tag, $handle ) {

	switch( $handle ) {
		// case 'jquery':
		case 'cb-alpinejs':
			return str_replace( ' src', ' defer src', $tag );
	}

	return $tag;

}
add_filter('script_loader_tag', 'cb_script_loader_tags', 10, 2);

/**
 * Gutenberg scripts and styles
 *
 */
function ea_gutenberg_scripts() {
	wp_enqueue_style( 'ea-fonts', ea_theme_fonts_url() );
	wp_enqueue_script( 'ea-editor', get_stylesheet_directory_uri() . '/assets/js/editor.js', array( 'wp-blocks', 'wp-dom' ), filemtime( get_stylesheet_directory() . '/assets/js/editor.js' ), true );
}
add_action( 'enqueue_block_editor_assets', 'ea_gutenberg_scripts' );

/**
 * Theme Fonts URL
 *
 */
function ea_theme_fonts_url() {
	return false;
}

/**
 * Theme setup.
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below this setup function.
 *
 * @since 1.0.0
 */
function ea_child_theme_setup() {

	// define( 'CHILD_THEME_VERSION', filemtime( get_stylesheet_directory() . '/assets/css/main.css' ) );

	// General cleanup
	include_once( get_stylesheet_directory() . '/inc/wordpress-cleanup.php' );
	include_once( get_stylesheet_directory() . '/inc/genesis-changes.php' );

	// Theme
	include_once( get_stylesheet_directory() . '/inc/markup.php' );
	include_once( get_stylesheet_directory() . '/inc/helper-functions.php' );
	include_once( get_stylesheet_directory() . '/inc/layouts.php' );
	include_once( get_stylesheet_directory() . '/inc/navigation.php' );
	include_once( get_stylesheet_directory() . '/inc/loop.php' );
	include_once( get_stylesheet_directory() . '/inc/author-box.php' );
	include_once( get_stylesheet_directory() . '/inc/template-tags.php' );
	include_once( get_stylesheet_directory() . '/inc/site-footer.php' );
	include_once( get_stylesheet_directory() . '/inc/kelton-comments.php' );

	// Editor
	include_once( get_stylesheet_directory() . '/inc/disable-editor.php' );
	include_once( get_stylesheet_directory() . '/inc/tinymce.php' );

	// Functionality
	include_once( get_stylesheet_directory() . '/inc/login-logo.php' );
	include_once( get_stylesheet_directory() . '/inc/block-area.php' );
	include_once( get_stylesheet_directory() . '/inc/social-links.php' );

	// Plugin Support
	include_once( get_stylesheet_directory() . '/inc/acf.php' );
	include_once( get_stylesheet_directory() . '/inc/amp.php' );
	include_once( get_stylesheet_directory() . '/inc/shared-counts.php' );
	include_once( get_stylesheet_directory() . '/inc/wpforms.php' );
		
	// Kelton Work
	include_once( get_stylesheet_directory() . '/kelton-functions.php' );

	// Editor Styles
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );

	// Image Sizes
	// add_image_size( 'ea_featured', 400, 100, true );

	// Gutenberg

	// -- Responsive embeds
	add_theme_support( 'responsive-embeds' );

	// -- Wide Images
	add_theme_support( 'align-wide' );

	// -- Disable custom font sizes
	add_theme_support( 'disable-custom-font-sizes' );

	// -- Editor Font Styles
	add_theme_support( 'editor-font-sizes', array(
		array(
			'name'      => __( 'Small', 'ea_genesis_child' ),
			'shortName' => __( 'S', 'ea_genesis_child' ),
			'size'      => 14,
			'slug'      => 'small'
		),
		array(
			'name'      => __( 'Normal', 'ea_genesis_child' ),
			'shortName' => __( 'M', 'ea_genesis_child' ),
			'size'      => 20,
			'slug'      => 'normal'
		),
		array(
			'name'      => __( 'Large', 'ea_genesis_child' ),
			'shortName' => __( 'L', 'ea_genesis_child' ),
			'size'      => 24,
			'slug'      => 'large'
		),
	) );

	// -- Disable Custom Colors
	add_theme_support( 'disable-custom-colors' );

	// -- Editor Color Palette
	add_theme_support( 'editor-color-palette', array(
		array(
			'name'  => __( 'Blue', 'ea_genesis_child' ),
			'slug'  => 'blue',
			'color'	=> '#05306F',
		),
		array(
			'name'  => __( 'Grey', 'ea_genesis_child' ),
			'slug'  => 'grey',
			'color' => '#FAFAFA',
		),
	) );

}
add_action( 'genesis_setup', 'ea_child_theme_setup', 15 );

/**
 * Change the comment area text
 *
 * @since  1.0.0
 * @param  array $args
 * @return array
 */
function ea_comment_text( $args ) {
	$args['title_reply']          = __( 'Leave A Reply', 'ea_genesis_child' );
	$args['label_submit']         = __( 'Post Comment',  'ea_genesis_child' );
	$args['comment_notes_before'] = '';
	$args['comment_notes_after']  = '';
	return $args;
}
add_filter( 'comment_form_defaults', 'ea_comment_text' );


/**
 * Template Hierarchy
 *
 */
function ea_template_hierarchy( $template ) {
	if( is_home() )
		$template = get_query_template( 'archive' );
	return $template;
}
add_filter( 'template_include', 'ea_template_hierarchy' );

// add_filter('genesis_breadcrumb_args', 'modify_separator_breadcrumbs');
function modify_separator_breadcrumbs($args) {
    $args['sep'] = ' <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1.23047 11.2842C1.45898 11.2842 1.64062 11.2021 1.79883 11.0498L6.29297 6.66113C6.49219 6.46191 6.58594 6.25684 6.5918 6.00488C6.5918 5.75293 6.49805 5.54199 6.29297 5.34863L1.79883 0.954102C1.64062 0.801758 1.45312 0.719727 1.23047 0.719727C0.773438 0.719727 0.410156 1.08301 0.410156 1.53418C0.410156 1.75684 0.503906 1.96777 0.667969 2.13184L4.65234 6.00488L0.667969 9.87207C0.503906 10.0361 0.410156 10.2471 0.410156 10.4697C0.410156 10.9209 0.773438 11.2842 1.23047 11.2842Z"
                                    fill="#9A9EB5"
                                ></path>
                            </svg> ';
    return $args;
}

// function be_add_blog_crumb( $crumb, $args ) {
// 	if ( is_singular( 'post' ) || is_category() )
// 		return '<a href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . get_the_title( get_option( 'page_for_posts' ) ) .'</a> ' . $args['sep'] . ' ' . $crumb;
// 	else
// 		return $crumb;
// }
// add_filter( 'genesis_single_crumb', 'be_add_blog_crumb', 10, 2 );
// add_filter( 'genesis_archive_crumb', 'be_add_blog_crumb', 10, 2 );
