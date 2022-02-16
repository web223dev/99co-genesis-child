<?php
/**
 * Site Header
 *
 * @package      CBGenesisChild
 * @author       Chillybin - Kelton 
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Add attribute and classnames in <header> tag
 */
// add_filter( 'genesis_attr_site-header', 'cb_add_attrs_site_header' );
function cb_add_attrs_site_header( $attributes ) {
 
    $attributes['class'] = ' bg-white shadow';
    $attributes['x-data'] = '{mobileMenuOpen: false}';
    $attributes['@click.outside'] = 'mobileMenuOpen = false';
    return $attributes;
}
/**
 * Add attribute and classnames in <footer> tag
 */
add_filter( 'genesis_attr_site-footer', 'cb_add_attrs_site_footer' );
function cb_add_attrs_site_footer( $attributes ) {
 
    $attributes['class'] .= ' bg-[#0E1545]';
    return $attributes;
}

/**
 * Tailwindcss configuration
 */
add_action( 'wp_head', 'cb_tailwind_config' );
function cb_tailwind_config(){
?>
	<script>
        tailwind.config = {
            theme: {
                extend: {
                    // fontFamily: {
                    //     'avenirnext-bold': "'Avenir Next Bold'",
                    //     'avenirnext-demi': "'Avenir Next Demi'",
                    //     'avenirnext-medium': "'Avenir Next Medium'",
                    //     'avenirnext-regular': "'Avenir Next Regular'",
                    // },
                    fontSize: {
                        sm: ['.875rem', '1rem'],
                    },
                    colors: {
                        'cbspacecadet-300': '#1A2258',
                        'cbblue-100': '#F0F6FF',
                        'cblavender-100': '#faf6ff',
                        'cblavender-300': '#844be3'
                    },
                    boxShadow: {        
                        'sidebar': '0 4px 16px rgb(11 17 52 / 20%);',
                    },
                }                
            }
        }
    </script>
<?php
}

/**
 * Add Custom Font to Tailwindcss
 */
function cb_add_custom_font() {
	?>
    <style type="text/tailwindcss">
			@layer base {
                @font-face {
                    font-family: 'Avenir Next';
                    src: url("<?php echo get_stylesheet_directory_uri(); ?>/fonts/AvenirNextLTPro-Bold.woff2") format("woff2"), url("<?php echo get_stylesheet_directory_uri(); ?>/fonts/AvenirNextLTPro-Bold.woff") format("woff");
                    font-weight: 700;
                }
                @font-face {
                    font-family: 'Avenir Next';
                    src: url("<?php echo get_stylesheet_directory_uri(); ?>/fonts/AvenirNextLTPro-Demi.woff2") format("woff2"), url("<?php echo get_stylesheet_directory_uri(); ?>/fonts/AvenirNextLTPro-Demi.woff") format("woff");
                    font-weight: 600;
                }
                @font-face {
                    font-family: 'Avenir Next';
                    src: url("<?php echo get_stylesheet_directory_uri(); ?>/fonts/AvenirNextLTPro-Medium.woff2") format("woff2"), url("<?php echo get_stylesheet_directory_uri(); ?>/fonts/AvenirNextLTPro-Medium.woff") format("woff");
                    font-weight: 500;
                }
                @font-face {
                    font-family: 'Avenir Next';
                    src: url("<?php echo get_stylesheet_directory_uri(); ?>/fonts/AvenirNextLTPro-Regular.woff2") format("woff2"), url("<?php echo get_stylesheet_directory_uri(); ?>/fonts/AvenirNextLTPro-Regular.woff") format("woff");
                    font-weight: 400;
                }
                html,body{
                    font-family: 'Avenir Next'; 
                    font-weight: 400;
                    color: #1A2258;
                }
                h1{
                    font-size: 34px;
                }
                h2{
                    font-size: 28px;
                }
                h3{
                    font-size: 19px;
                }
                h3,h4,h5,h6{
                    font-weight: 600;
                }
                strong{ 
                    font-weight: 700;
                }
                /* Navigation */
                /* #nav-menu-item-34 .sub-sub-menu-item .sub-menu-link,
                #nav-menu-item-35 .sub-sub-menu-item .sub-menu-link {
                    padding: 16px;
                }
                #nav-menu-item-64 ul.sub-menu,
                #nav-menu-item-67 ul.sub-menu  {
                    flex-direction: column;
                    width: 337px;
                    align-items: baseline;
                }
                #nav-menu-item-64 ul.sub-menu .sub-menu-item,
                #nav-menu-item-67 ul.sub-menu .sub-menu-item {
                    min-width: 100%;
                    border-radius: 4px;
                }
                #nav-menu-item-64 ul.sub-menu .sub-menu-link,
                #nav-menu-item-67 ul.sub-menu .sub-menu-link {
                    padding: 16px 16px 40px 55px;
                    width: 100%;
                    color: inherit;
                    display: flex;
                    align-items: center;
                    text-transform: none;
                    font-size: .875rem;
                    line-height: 19px;
                }
                #nav-menu-item-64 ul.sub-menu .sub-menu-item:hover,
                #nav-menu-item-67 ul.sub-menu .sub-menu-item:hover {
                    --tw-text-opacity: 1;
                    --tw-bg-opacity: 1;
                    color: rgb(37 99 235 / var(--tw-text-opacity));
                    background-color: rgb(240 246 255 / var(--tw-bg-opacity));
                } */
			}
		</style>
    <?php
}
add_action('wp_head', 'cb_add_custom_font');

/**
 * Add Avenirnext font in body class
 *
 */
function cb_avenirnext_font_body_class( $classes ) {
	if( is_singular() )
		$classes[] = 'font-avenirnext-regular';
	return $classes;
}
add_filter( 'body_class', 'cb_avenirnext_font_body_class' );


/**
 * Footer Widget 
 * 
 * will move to site-footer.php
 */

// Register Widget
genesis_register_widget_area( array( 'id' => 'footer-section-1', 'name' => 'Footer Section 1' ) );
genesis_register_widget_area( array( 'id' => 'footer-section-2', 'name' => 'Footer Section 2' ) );
genesis_register_widget_area( array( 'id' => 'footer-section-3', 'name' => 'Footer Section 3' ) );

// // Display Footer Widget before footer
add_action( 'genesis_before_footer', 'cb_footer_widget' );
function cb_footer_widget() {
    genesis_widget_area( 'footer-section-1', array(
        'before' => '<div class="flexible-widgets widget-area">',
        'after'  => '</div>',
    ) );

    // $menu = get_term( $locations[$theme_location], 'nav_menu' );
    // $menu_items = wp_get_nav_menu_items($menu->term_id);
    // print_r($menu_items)
    
}
