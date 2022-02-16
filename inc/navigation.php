<?php
/**
 * Navigation
 *
 * @package      EAGenesisChild
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

// Don't let Genesis load menus
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

/**
 * Mobile Menu
 *
 */
function ea_site_header() {
	// echo ea_mobile_menu_toggle();
	// echo ea_search_toggle();
    
    // 99 desktop menu
	echo '<nav' . ea_amp_class( 'nav-menu bg-white border-b border-[#EAEBF0] font-avenirnext-demi', 'active', 'menuActive' ) . ' x-data="{mobileMenuOpen: { ninenine: false, insider: false, search:false }}" @click.outside="mobileMenuOpen = { ninenine: false, insider: false, search: false}" x-cloak role="navigation">';
		echo '<div class="mx-auto px-4 sm:px-6 lg:px-8">';
            echo '<div class="flex h-16">';
                echo '<div class="grow flex items-center justify-start lg:hidden">';
                    echo cb_mobile_menu_toggle();   
                echo '</div>';
                echo '<div class="flex px-2 lg:px-0">';

                    do_action( 'cb_genesis_site_title' );

                    if( has_nav_menu( 'primary' ) ) {
                        wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'primary_menu hidden lg:ml-6 lg:flex', 'container_class' => 'nav-primary flex', 'walker' => new Primary_Walker_Nav_Menu() ) );
                    }

                echo '</div>';

                echo cb_register_menu();
                echo '<div class="grow flex items-center justify-end lg:hidden">';
                    echo cb_mobile_search_btn();
                echo '</div>';
            echo '</div>';
		echo '</div>';

        // 99 mobile menu
        cb_mobile_menu_block('primary');
        
        // Inside mobile menu
        cb_mobile_menu_block('secondary');

        // Search menu
        cb_mobile_menu_block('search');

	echo '</nav>';

    echo '<nav' . ea_amp_class( 'hidden lg:block nav-menu bg-white border-b border-[#EAEBF0] font-avenirnext-medium', 'active', 'menuActive' ) . ' x-data="{mobileMenuOpen: false}" @click.outside="mobileMenuOpen = false" x-cloak role="navigation">';
		echo '<div class="mx-auto px-4 sm:px-6 lg:px-8">';
            echo '<div class="flex h-16">';
                echo '<div class="flex px-2 justify-between lg:px-0">';
                    echo '<div class="site-title flex-shrink-0 flex items-center w-[82.9833px] justify-center">';
                        echo '<a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '<img class="block h-4 w-auto" src="' . get_stylesheet_directory_uri() . '/assets/images/insider_logo.svg" alt="Insider Logo"></a>';
                    echo '</div>';

                    if( has_nav_menu( 'secondary' ) ) {
                        wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'menu_class' => 'secondary_menu hidden lg:ml-6 lg:flex lg:space-x-8', 'container_class' => 'nav-secondary flex', 'walker' => new Secondary_Walker_Nav_Menu() ) );
                    }

                echo '</div>';
                // Search bar
                echo '<div' . ea_amp_class( 'header-search flex-1 flex items-center justify-center px-2 lg:ml-6 lg:justify-end', 'active', 'searchActive' ) . '>' . get_search_form( array( 'echo' => false ) ) . '</div>';
            echo '</div>';
		echo '</div>';
	echo '</nav>';
}
add_action( 'genesis_header', 'ea_site_header', 11 );

/**
 * Mobile Menu block
 * 
 */
function cb_mobile_menu_block($menu_location = '') {

        $mobile_menu_select = '';
        if ($menu_location == 'primary') {
            $mobile_menu_select = 'ninenine';
            $mobile_divide = ' divide-y divide-[#EAEBF0]';
        } else if ($menu_location == 'secondary') {
            $mobile_menu_select = 'insider';
            $mobile_divide = ' divide-y divide-[#EAEBF0]';
        } else {
            $mobile_menu_select = 'search';
        }

        echo '<div :class="mobileMenuOpen. ' . $mobile_menu_select . ' ? \'\' : \'-translate-x-full\'" class="absolute z-30 top-0 inset-x-0 transition transform duration-200 origin-top-right lg:hidden">';
            echo '<div class="h-screen bg-white">';
                echo '<div class="pt-3 pb-6 px-6' . $mobile_divide . '">';
                    echo '<!-- Mobile Header -->';
                    echo '<div class="flex items-center justify-between pb-3">';
                        if ($menu_location == 'primary') {
                            echo '<div>';
                                echo '<img class="h-[27.22px] w-auto" src="http://wwp.99.local/wp-content/themes/99co-genesis-child/assets/images/logo.png" alt="Workflow">';
                            echo '</div>';
                            echo '<button @click="mobileMenuOpen.insider = true" type="button" class="bg-white rounded-md inline-flex items-center justify-center text-gray-400 hover:text-gray-500">';
                                echo '<span class="sr-only">Go to Insider menu</span>';
                                echo '<!-- Heroicon name: outline/x -->';
                                echo '<svg class="h-[19.39px] w-[11px]" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.61328 19.6943C0.980469 19.6943 0.5 19.2139 0.5 18.5811C0.5 18.2764 0.628906 17.9951 0.828125 17.7842L8.79688 10.0029L0.828125 2.20996C0.628906 1.99902 0.5 1.71777 0.5 1.41309C0.5 0.791992 0.980469 0.299805 1.61328 0.299805C1.92969 0.299805 2.1875 0.416992 2.39844 0.62793L11.1289 9.15918C11.375 9.38184 11.5039 9.68652 11.5039 10.0029C11.5039 10.3193 11.375 10.6006 11.1289 10.835L2.39844 19.3662C2.1875 19.5771 1.92969 19.6943 1.61328 19.6943Z" fill="#1A2258"/></svg>';
                            echo '</button>';
                        } else if($menu_location == 'secondary') {
                                echo '<button @click="mobileMenuOpen.insider = false" type="button" class="bg-white rounded-md inline-flex items-center justify-center text-[#787D9C] hover:text-gray-500">';
                                    echo '<span class="sr-only">go to 99co menu</span>';
                                    echo '<svg class="h-[9.93px] w-[5.77px] rotate-180" viewBox="0 0 12 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.61328 19.6943C0.980469 19.6943 0.5 19.2139 0.5 18.5811C0.5 18.2764 0.628906 17.9951 0.828125 17.7842L8.79688 10.0029L0.828125 2.20996C0.628906 1.99902 0.5 1.71777 0.5 1.41309C0.5 0.791992 0.980469 0.299805 1.61328 0.299805C1.92969 0.299805 2.1875 0.416992 2.39844 0.62793L11.1289 9.15918C11.375 9.38184 11.5039 9.68652 11.5039 10.0029C11.5039 10.3193 11.375 10.6006 11.1289 10.835L2.39844 19.3662C2.1875 19.5771 1.92969 19.6943 1.61328 19.6943Z" fill="#1A2258"/></svg>';
                                    echo '<p class="ml-2 text-sm leading-[19px] text-[#787D9C]">Back to 99.co menu</p>';
                                echo '</button>';
                            echo '<div class="flex items-center">';
                                echo '<button @click="mobileMenuOpen = { ninenine: false, insider: false, search: false}" type="button" class="bg-white rounded-md inline-flex items-center justify-center text-gray-400 hover:text-gray-500">';
                                    echo '<span class="sr-only">Close menu</span>';
                                    echo '<!-- Heroicon name: outline/x -->';
                                    echo '<svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.5542 18.5542C17.9597 19.1486 16.9995 19.1486 16.405 18.5542L12 14.1492L7.59499 18.5542C7.00054 19.1486 6.04028 19.1486 5.44584 18.5542C4.85139 17.9597 4.85139 16.9995 5.44584 16.405L9.85084 12L5.44584 7.59499C4.85139 7.00054 4.85139 6.04028 5.44584 5.44584C6.04028 4.85139 7.00054 4.85139 7.59499 5.44584L12 9.85084L16.405 5.44584C16.9995 4.85139 17.9597 4.85139 18.5542 5.44584C19.1486 6.04028 19.1486 7.00054 18.5542 7.59499L14.1492 12L18.5542 16.405C19.1334 16.9842 19.1334 17.9597 18.5542 18.5542Z" fill="#1A2258"/></svg>';
                                echo '</button>';
                            echo '</div>';
                        } else {
                            echo '<div class="ml-auto">';
                                echo '<button @click="mobileMenuOpen.search = false" type="button" class="bg-white rounded-md inline-flex items-center justify-center text-gray-400 hover:text-gray-500">';
                                    echo '<span class="sr-only">Close menu</span>';
                                    echo '<!-- Heroicon name: outline/x -->';
                                    echo '<svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.5542 18.5542C17.9597 19.1486 16.9995 19.1486 16.405 18.5542L12 14.1492L7.59499 18.5542C7.00054 19.1486 6.04028 19.1486 5.44584 18.5542C4.85139 17.9597 4.85139 16.9995 5.44584 16.405L9.85084 12L5.44584 7.59499C4.85139 7.00054 4.85139 6.04028 5.44584 5.44584C6.04028 4.85139 7.00054 4.85139 7.59499 5.44584L12 9.85084L16.405 5.44584C16.9995 4.85139 17.9597 4.85139 18.5542 5.44584C19.1486 6.04028 19.1486 7.00054 18.5542 7.59499L14.1492 12L18.5542 16.405C19.1334 16.9842 19.1334 17.9597 18.5542 18.5542Z" fill="#1A2258"/></svg>';
                                echo '</button>';
                            echo '</div>';
                        }
                    echo '</div>';
                    
                    if($menu_location == 'primary') {
                        echo '<div class="py-4 space-x-4 font-semibold text-[#216bff] text-base leading-[22px]">';
                            echo '<a href="#">Sign up</a>';
                            echo '<span>/</span> ';
                            echo '<a href="#">Log in</a>';
                        echo '</div>';
                    } else if($menu_location == 'secondary') {
                        echo '<div class="text-left">';
                            echo '<h1 class="py-4 static inset-0 text-cbspacecadet-300 text-center max-w-[113px]">';
                                echo '<p class="not-italic font-bold text-[9.46599px] leading-[12px] tracking-[2.2px] uppercase">Property News</p>';
                                echo '<p class="not-italic font-bold text-[28px] leading-[27.61px] tracking-[2.7px] flex-none order-none grow-0 m-0">Insider</p>';
                            echo  '</h1>';
                        echo '</div>';
                    }

                    if ($menu_location == 'primary') {
                        if( has_nav_menu( 'primary' ) ) {
                            wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'primary_menu space-y-7', 'container_class' => 'nav-primary pt-4 pb-6', 'walker' => new Primary_Walker_Mobile_Nav_Menu() ) );
                        }
                    } else if($menu_location == 'secondary') {
                        if( has_nav_menu( 'secondary' ) ) {
                            wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'menu_class' => 'secondary_menu space-y-7', 'container_class' => 'nav-secondary pt-4 pb-6', 'walker' => new Secondary_Walker_Mobile_Nav_Menu() ) );
                        }
                    } 
                    if($menu_location == 'primary') {
                        echo '<div class="pt-6">';
                            echo '<a href="https://ninetynine.page.link/?apn=co.ninetynine.android&ibi=co.99.ios.NinetyNine&isi=935675660&link=https%3A%2F%2Fwww.99.co%2Fsingapore%2Frent%3Fsource%3Dtopnav%26" class="font-semibold text-base leading-[22px] text-[#216bff] border border-[#216bff] rounded py-[13px] w-full flex items-center justify-center hover:bg-cbblue-100"><svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M16.59 9.5H15V4.5C15 3.95 14.55 3.5 14 3.5H10C9.45 3.5 9 3.95 9 4.5V9.5H7.41C6.52 9.5 6.07 10.58 6.7 11.21L11.29 15.8C11.68 16.19 12.31 16.19 12.7 15.8L17.29 11.21C17.92 10.58 17.48 9.5 16.59 9.5ZM5 19.5C5 20.05 5.45 20.5 6 20.5H18C18.55 20.5 19 20.05 19 19.5C19 18.95 18.55 18.5 18 18.5H6C5.45 18.5 5 18.95 5 19.5Z" fill="#216BFF"/></svg>Download 99.co app</a>';
                        echo '</div>';
                    } else if($menu_location == 'search'){
                        echo '<div class="mt-8">';
                            echo get_search_form( false );
                            echo '<div class="home-recommended-topics mx-4">';
                                echo '<div class="text-center mt-8">';
                                    echo '<h3 class="font-avenirnext-demi text-cbspacecadet-300 text-[19px] leading-[26px]">Recommended topics</h3>';
                                echo '</div>';
                                echo '<ul class="flex text-[#216BFF] text-sm gap-4 justify-center mt-6 mb-20 flex-wrap">';
                                    echo '<li class="px-4 py-2 border border-[#216BFF] rounded-full">BTO 2022</li>';
                                    echo '<li class="px-4 py-2 border border-[#216BFF] rounded-full">Home & Living</li>';
                                    echo '<li class="px-4 py-2 border border-[#216BFF] rounded-full">Architecture</li>';
                                    echo '<li class="px-4 py-2 border border-[#216BFF] rounded-full">Resale & New Launch</li>';
                                    echo '<li class="px-4 py-2 border border-[#216BFF] rounded-full">5-room flat</li>';
                                    echo '<li class="px-4 py-2 border border-[#216BFF] rounded-full">Covid-19</li>';
                                    echo '<li class="px-4 py-2 border border-[#216BFF] rounded-full">HDB</li>';
                                echo '</ul>';
                            echo '</div>';
                        echo '</div>';
                    }
                echo '</div>';
                if ( is_user_logged_in() ) {
                    echo '<div class="font-semibold text-base leading-[22px] text-[#9a9eb5] text-center">';
                        echo '<a href="' . wp_logout_url( home_url() ) . '" class="hover:text-[#216bff]">Log out from 99.co</a>';
                    echo '</div>';
                }
            echo '</div>';
        echo '</div>';
}

/**
 * Primary Menu Custom walker class.
 * 
 */
class Primary_Walker_Nav_Menu extends Walker_Nav_Menu {
 
    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array( // <ul>
            'sub-menu',
            ( $display_depth % 2  ? ' menu-odd' : ' menu-even' ),
            ( $display_depth >=2 ? ' sub-sub-menu' : '' ),
            ( $display_depth == 1 ? ' flex absolute h-auto top-full flex-row -left-3 shadow-sidebar p-2 font-medium rounded bg-white': ''),
            ( $display_depth == 1 && !( $args->cb_nav_item_ID == 64 || $args->cb_nav_item_ID == 67) ? ' flex-row' : '' ),
            ( $display_depth == 1 && ( $args->cb_nav_item_ID == 64 || $args->cb_nav_item_ID == 67) ? ' flex-col' : '' ),
            'menu-depth-' . $display_depth,
        );
        $class_names = implode( ' ', $classes );

        $wrapper_class_1 = 'absolute z-10 left-0 transform -translate-x-8 mt-16 px-2 w-screen max-w-max sm:px-0';
        $wrapper_class_2 = 'rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden';
 
        // Build HTML for output.
        $output .= ( $depth == 0 ? "\n" . $indent . '<div class="' . $wrapper_class_1 . '" x-show="flyoutMenuOpen" @mouseover.outside="flyoutMenuOpen = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"><div class="' . $wrapper_class_2 . '"><ul class="' . $class_names . '">' . "\n"  : "\n" . $indent . '<ul class="' . $class_names . '">' . "\n");
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= ($depth == 0 ? "$indent</ul></div></div>\n" : "$indent</ul>\n");
    }
 
    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        // Depth-dependent classes. <li>
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item relative flex items-center flex-col flex-nowrap'. blue_underline_class('hover') : 'sub-menu-item' ),
            ( $depth >= 2 ? 'sub-sub-menu-item' : '' ),
            ( $depth %  2 ? 'menu-item-odd' : 'menu-item-even' ),
            ( $depth >= 1 ? 'flex items-baseline flex-col flex-nowrap w-auto min-w-[264px]' : ''),
            // ( $depth == 1 && !( $item->menu_item_parent == 64 || $item->menu_item_parent == 67 ) ? 'group' : ''),
            ( $depth == 2 && !( $item->menu_item_parent == 44 || $item->menu_item_parent == 92 ) || $depth == 1 && ( $item->menu_item_parent == 64 || $item->menu_item_parent == 67 ) ? 'group rounded cursor-pointer text-cbspacecadet-300 hover:bg-cbblue-100 hover:text-blue-600' : ''),
            ( $depth == 2 && ( $item->menu_item_parent == 44 || $item->menu_item_parent == 92 ) ? 'hover:bg-cblavender-100 hover:text-cblavender-300' : '' ),
            // Add border to last item in Buy, Rent 
            ( $depth == 2 && ($item->ID == 76 || $item->ID == 50 || $item->ID == 91 || $item->ID == 98) ? 'mt-[17px] before:content before:block before:h-[1px] before:w-[calc(90%-32px)] before:bg-[#eaebf0] before:mx-4 before:-mt-2 before:mb-2' : '' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );    
 
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // Add AlpineJS attributes
        $aj_attr_x_data = ( $depth == 0 ? '{ flyoutMenuOpen: false }' : '' );
        $aj_attr_mouseover = ( $depth == 0 ? 'flyoutMenuOpen = false' : '' );
        $aj_attr_class = ( $depth == 0 ? ':class="flyoutMenuOpen ? \' ' . blue_underline_class() . ' \': \'\'"' : '' );
 
        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '" x-data="' . $aj_attr_x_data . '" @mouseover.outside="' . $aj_attr_mouseover . '"' . $aj_attr_class . '>';
 
        // Depth-link classes a&&b <a>
        $depth_link_classes = array(
            ( $depth == 0 ? 'main-menu-link flex items-center cursor-pointer h-full font-semibold text-sm leading-6 px-3' : 'sub-menu-link' ),
            ( $depth == 1 && !( $item->menu_item_parent == 64 || $item->menu_item_parent == 67 ) ? '-ml-0.5 -mr-0.5 pt-2 pb-2 pl-4 pr-4 text-xs leading-[14.06px] font-semibold uppercase text-[#787D9C] tracking-[.4px]' : ''),
            // ( $depth == 1 && ( $item->post_name == 'residential-for-sale' || $item->post_name == 'residential-for-rent' ) ? ' text-blue-600' : '' ),
            // ( $depth == 1 && ( $item->post_name == 'commercial-for-sale' || $item->post_name == 'commercial-for-rent' ) ? ' text-cblavender-300' : '' ),
            ( $depth == 2 || $depth == 1 && ( $item->menu_item_parent == 64 || $item->menu_item_parent == 67 ) ? '-m-0.5 block text-sm leading-[19px] font-semibold rounded': ''),
            ( $depth == 2 && ( $item->menu_item_parent == 37 || $item->menu_item_parent == 44 || $item->menu_item_parent == 85 || $item->menu_item_parent == 92 ) ? 'p-4' : ''),
            ( $depth == 2 && !( $item->menu_item_parent == 37 || $item->menu_item_parent == 44 || $item->menu_item_parent == 85 || $item->menu_item_parent == 92 ) || $depth == 1 && ( $item->menu_item_parent == 64 || $item->menu_item_parent == 67 ) ? 'pt-4 pb-10 pr-4 pl-[55px] w-full before:content before:absolute before:bg-contain before:m-0 before:w-6 before:h-6 before:translate-x-[-39px] before:translate-y-[9px] before:hue-rotate-[-12.3deg] before:saturate-[83.4%] before:brightness-[34.5%] group-hover:before:filter-none before:bg-no-repeat before:bg-center' : '' ),
            // Add 'news' icon
            ( $item->ID == 111 ? 'after:content-[\'NEW\'] after:rounded-sm after:px-1 after:py-0.5 after:bg-[#FF72B6] after:text-[10px] after:leading-3 after:ml-[10px] after:text-white' : '' ),
            // Add icons to menu
            cb_menu_icons($item->ID),

        );
        $depth_link_class_names = esc_attr( implode( ' ', $depth_link_classes ) );
        
        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . $depth_link_class_names . '"';
        $attributes .= ( $depth == 0 ? ' @mouseover="flyoutMenuOpen = !flyoutMenuOpen" :class="flyoutMenuOpen ? \'border-blue-600 text-blue-600\' : \'border-transparent text-cbspacecadet-300 hover:border-blue-600 hover:text-blue-600\'"' : '');
 
        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );

        // Add menu description in menu item
        if ( !empty( $item->description ) ) {
            $item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><span class="menu-item-description block -mx-0.5 pl-[55px] pr-4 pb-4 text-xs -mt-9 font-thin whitespace-nowrap cursor-pointer">' . $item->description . '</span>', $item_output );
        }

        $args->cb_nav_item_ID = $item->ID;
        $args->cb_menu_item_parent = $item->menu_item_parent;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
   
/**
 * Secondary Menu Custom walker class.
 * 
 */
class Secondary_Walker_Nav_Menu extends Walker_Nav_Menu {
 
    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth == 1 ? 'relative grid gap-6 bg-white px-5 py-6 sm:gap-1 sm:p-2' : '' ),
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth,
        );
        $class_names = implode( ' ', $classes );

        $wrapper_class_1 = 'absolute z-10 left-4 transform -translate-x-8 mt-16 px-2 w-screen max-w-max sm:px-0';
        $wrapper_class_2 = 'rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden';
 
        // Build HTML for output.
        $output .= ( $depth == 0 ? "\n" . $indent . '<div class="' . $wrapper_class_1 . '" x-show="flyoutMenuOpen" @mouseover.outside="flyoutMenuOpen = false" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"><div class="' . $wrapper_class_2 . '"><ul class="' . $class_names . '">' . "\n"  : "\n" . $indent . '<ul class="' . $class_names . '">' . "\n");
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= ($depth == 0 ? "$indent</ul></div></div>\n" : "$indent</ul>\n");
    }
 
    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
 
        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item relative inline-flex' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );    
 
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // Add AlpineJS attributes
        $aj_attr_x_data = ( $depth == 0 ? '{ flyoutMenuOpen: false }' : '' );
        $aj_attr_mouseover = ( $depth == 0 ? 'flyoutMenuOpen = false' : '' );
 
        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '" x-data="' . $aj_attr_x_data . '" @mouseover.outside="' . $aj_attr_mouseover . '">';
 
        // Depth-link classes a&&b
        $depth_link_classes = array(
            ( $depth == 0 ? 'main-menu-link inline-flex items-center px-1 pt-1 border-b-4 text-sm' : 'sub-menu-link -m-0.5 p-4 block rounded hover:bg-cbblue-100 text-cbspacecadet-300 hover:text-blue-600 text-sm' ),
            ( $depth == 1 && $item->post_name == 'residential-for-sale' ? '-ml-0.5 -mr-0.5 pt-2 pb-2 pl-4 pr-4 text-xs text-blue-600 leading-9' : '' ),
            ( $depth == 1 && $item->post_name == 'commercial-for-sale' ? '-ml-0.5 -mr-0.5 pt-2 pb-2 pl-4 pr-4 text-xs text-cblavender-300 leading-9' : '' ),
            ( $depth == 2 && $item->menu_item_parent == 37 ? '-m-0.5 p-4 block rounded hover:bg-cbblue-100 text-cbspacecadet-300 hover:text-blue-600 text-sm' : '' ),
            ( $depth == 2 && $item->menu_item_parent == 44 ? '-m-0.5 p-4 block rounded hover:bg-cblavender-100 text-cbspacecadet-300 hover:text-cblavender-300 text-sm' : '' ),
        );
        $depth_link_class_names = esc_attr( implode( ' ', $depth_link_classes ) );
        
        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . $depth_link_class_names . '"';
        $attributes .= ( $depth == 0 ? ' @mouseover="flyoutMenuOpen = !flyoutMenuOpen" :class="flyoutMenuOpen ? \'border-blue-600 text-blue-600\' : \'border-transparent text-cbspacecadet-300 hover:border-blue-600 hover:text-blue-600\'"' : '');
 
        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Primary Mobile Menu Custom walker class.
 * 
 */
class Primary_Walker_Mobile_Nav_Menu extends Walker_Nav_Menu {
 
    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array( // <ul>
            'sub-menu',
            ( $display_depth == 2 || $display_depth == 1 && ( $args->cb_nav_item_ID == 64 || $args->cb_nav_item_ID == 67) ? 'space-y-4' : '' ),
            ( $display_depth %  2 ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >= 2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );

        // alpineJS attrs 
        $aj__attr_x_show = $display_depth == 1 ? 'x-show="cbCollapseOpen' . $args->cb_nav_item_ID . '"' : '';
 
        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '" ' . $aj__attr_x_show . '>' . "\n";
    }
 
    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
 
        // Depth-dependent classes. <li>
        $depth_classes = array(
            ( $depth == 0 ? 'relative main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
 
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // Add AlpineJS attributes
        $aj_attr_x_data = ( $depth == 0 ? 'x-data="{ cbCollapseOpen' . $item->ID . ': false }"' : '' );
 
        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '" ' . $aj_attr_x_data . '>';
        
        // Depth-link classes a&&b <a>
        $depth_link_classes = array(
            ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link ' ),
            ( $depth == 0 ? ' font-semibold text-base leading-[22px] flex items-center justify-between hover:text-[#216BFF]' : ''),
            ( $depth == 0 && ( $item-> ID == 64 || $item-> ID == 67 ) ? ' mb-4': ''),
            ( $depth == 1 && !( $item->menu_item_parent == 64 || $item->menu_item_parent == 67 ) ? ' block pt-3 pb-4 mt-4 font-semibold text-xs leading-4 tracking-[0.4px] text-[#9A9EB5] uppercase': ''),
            ( $depth == 2 || $depth == 1 && ( $item->menu_item_parent == 64 || $item->menu_item_parent == 67 ) ? ' font-semibold text-sm leading-[19px]' : ''), 
            ( $depth == 2 && !( $item->menu_item_parent == 44 || $item->menu_item_parent == 92 ) || $depth == 1 && ( $item->menu_item_parent == 64 || $item->menu_item_parent == 67 ) ? ' text-[#216BFF]' : ''), 
            ( $depth == 2 && ( $item->menu_item_parent == 44 || $item->menu_item_parent == 92 ) ? ' text-[#844BE3]' : ''),
            ( $depth == 2 && !( $item->menu_item_parent == 37 || $item->menu_item_parent == 44 || $item->menu_item_parent == 85 || $item->menu_item_parent == 92 ) || $depth == 1 && ( $item->menu_item_parent == 64 || $item->menu_item_parent == 67 ) ? ' relative py-[6.5px] pl-9 before:content before:absolute before:h-[21px] before:w-[21px] before:mt-[4px] before:-ml-[33px] before:bg-contain before:bg-no-repeat before:bg-center' : ''),
            cb_menu_icons($item->ID)
        );

        $depth_link_class_names = esc_attr( implode( '', $depth_link_classes ) );

        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . $depth_link_class_names . '"';
 
        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
        
        // Add collapse button  echo get_stylesheet_directory_uri();
        if ( ( $depth == 0 && !($item->ID == 63 || $item->ID == 66 || $item->ID == 68) ) ) {
            $item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><button class="bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/nav_mobile_down.svg\')] bg-no-repeat bg-[50%] absolute right-0 top-0 w-4 h-4 translate-x-[calc(10vw - 11px)]" @click="cbCollapseOpen' . $item->ID . ' = !cbCollapseOpen' . $item->ID . '" :class="cbCollapseOpen' . $item->ID . ' ? \'rotate-180\': \'\'"></button>', $item_output );
        }

        $args->cb_nav_item_ID = $item->ID;
        $args->cb_menu_item_parent = $item->menu_item_parent;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

/**
 * Secondary Mobile Menu Custom walker class.
 * 
 */
class Secondary_Walker_Mobile_Nav_Menu extends Walker_Nav_Menu {
 
    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array( // <ul>
            'sub-menu',
            ( $display_depth == 1 ? 'space-y-6' : '' ),
            ( $display_depth %  2 ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >= 2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );

        // alpineJS attrs 
        $aj__attr_x_show = $display_depth == 1 ? 'x-show="cbCollapseOpen' . $args->cb_nav_item_ID . '"' : '';
 
        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '" ' . $aj__attr_x_show . '>' . "\n";
    }
 
    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
 
        // Depth-dependent classes. <li>
        $depth_classes = array(
            ( $depth == 0 ? 'relative main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
 
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // Add AlpineJS attributes
        $aj_attr_x_data = ( $depth == 0 ? 'x-data="{ cbCollapseOpen' . $item->ID . ': false }"' : '' );
 
        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '" ' . $aj_attr_x_data . '>';
        
        // Depth-link classes a&&b <a>
        $depth_link_classes = array(
            ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link ' ),
            ( $depth == 0 ? ' font-semibold text-base leading-[22px] flex items-center justify-between hover:text-[#216BFF]' : ''),
            ( $depth == 0 ? ' mb-6': ''),
            ( $depth == 1 ? ' font-medium text-sm leading-[19px] hover:text-[#216BFF]' : ''), 
        );

        $depth_link_class_names = esc_attr( implode( '', $depth_link_classes ) );

        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . $depth_link_class_names . '"';
 
        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
        
        // Add collapse button  echo get_stylesheet_directory_uri();
        if ( ( $depth == 0 && !($item->ID == 10 || $item->ID == 13 || $item->ID == 14) ) ) {
            $item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><button class="bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/nav_mobile_down.svg\')] bg-no-repeat bg-[50%] absolute right-0 top-0 w-4 h-4 translate-x-[calc(10vw - 11px)]" @click="cbCollapseOpen' . $item->ID . ' = !cbCollapseOpen' . $item->ID . '" :class="cbCollapseOpen' . $item->ID . ' ? \'rotate-180\': \'\'"></button>', $item_output );
        }

        $args->cb_nav_item_ID = $item->ID;
        $args->cb_menu_item_parent = $item->menu_item_parent;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

// Menu hover blue underline
function blue_underline_class($hover = "") {
    if($hover == 'hover') $hover = " hover:"; else $hover = " ";
    return $hover . 'before:content' . $hover . 'before:w-[calc(100%-24px)]' . $hover . 'before:h-1' . $hover . 'before:rounded' . $hover . 'before:bg-[#216bff]' . $hover . 'before:block' . $hover . 'before:absolute' . $hover . 'before:bottom-0';
}

// Menu Icons
function cb_menu_icons( $id ) {
    $menu_icons = ( $id == 99 ? ' before:bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/99_property_value.svg\')]' : '' );
    $menu_icons .= ( $id == 100 ? ' before:bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/list_prop_owner.svg\')]' : '' );
    $menu_icons .= ( $id == 3184 ? ' before:bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/ad_99_group.svg\')]' : '' );
    // Explore
    $menu_icons .= ( $id == 101 ? ' before:bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/HDB_sg.svg\')]' : '' );
    $menu_icons .= ( $id == 102 ? ' before:bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/condos_sg.svg\')]' : '' );
    $menu_icons .= ( $id == 103 ? ' before:bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/area_sg.svg\')]' : '' );
    $menu_icons .= ( $id == 104 ? ' before:bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/MRT_sg.svg\')]' : '' );
    // Mortgage
    $menu_icons .= ( $id == 106 ? ' before:bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/find_mortage.svg\')]' : '' );
    $menu_icons .= ( $id == 108 ? ' before:bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/calculator.svg\')]' : '' );
    $menu_icons .= ( $id == 109 ? ' before:bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/payment_calc.svg\')]' : '' );
    $menu_icons .= ( $id == 110 ? ' before:bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/mortgage_calc.svg\')]' : '' );
    // News
    $menu_icons .= ( $id == 111 ? ' before:bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/News_Insider.svg\')]' : '' );
    return $menu_icons;
}
/**
 * Nav Extras
 *
 */
function ea_nav_extras( $menu, $args ) {

	if( 'primary' === $args->theme_location ) {
		$menu .= '<li class="menu-item search">' . ea_search_toggle() . '</li>';
	}

	if( 'secondary' === $args->theme_location ) {
		$menu .= '<li class="menu-item search">' . get_search_form( false ) . '</li>';
	}

	return $menu;
}
// add_filter( 'wp_nav_menu_items', 'ea_nav_extras', 10, 2 );

/**
 * Search toggle
 *
 */
function ea_search_toggle() {
	$output = '<button' . ea_amp_class( 'search-toggle', 'active', 'searchActive' ) . ea_amp_toggle( 'searchActive', array( 'menuActive', 'mobileFollow' ) ) . '>';
		$output .= ea_icon( array( 'icon' => 'search', 'size' => 24, 'class' => 'open' ) );
		$output .= ea_icon( array( 'icon' => 'close', 'size' => 24, 'class' => 'close' ) );
		$output .= '<span class="screen-reader-text">Search</span>';
	$output .= '</button>';
	return $output;
}

/**
 * Mobile menu toggle
 *
 */
function cb_mobile_menu_toggle() {
    // Hamburger Menu
    $output .= '<button @click="mobileMenuOpen.ninenine = !mobileMenuOpen.ninenine" type="button" class="inline-flex items-center justify-center p-2 rounded text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">';
        $output .= '<span class="sr-only">Open main menu</span>';
        // Mobile menu icon
        $output .= '<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>';
    $output .= '</button>';
	return $output;
}

/**
 * Signup Login Menu
 * 
 */
function cb_register_menu(){
    $output = '<div class="hidden flex-1 lg:flex items-center justify-end lg:ml-6">';
        $output .= '<a href="#" class="whitespace-nowrap font-semibold text-sm text-cbspacecadet-300 hover:text-blue-600">Sign up</a>';
        $output .= '<a href="#" class="ml-2 whitespace-nowrap font-semibold inline-flex items-center justify-center px-4 py-2 text-sm text-cbspacecadet-300 hover:text-blue-600">Log in</a>';
    $output .= '</div>';
    return $output;
}

/**
 * Mobile Search Button
 * 
 */
function cb_mobile_search_btn(){
    $output = '<button @click="mobileMenuOpen.search = !mobileMenuOpen.search;" type="button" class="inline-flex items-center justify-center p-2 rounded text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">';
        $output .= '<span class="sr-only">Search Icon</span>';
        $output .= '<svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10.1104 18.6055C11.9268 18.6055 13.6143 18.0312 15.0088 17.0586L20.1299 22.1914C20.3994 22.4492 20.751 22.5781 21.126 22.5781C21.9111 22.5781 22.4736 21.9805 22.4736 21.207C22.4736 20.8438 22.3564 20.4922 22.0869 20.2227L17.001 15.125C18.0674 13.6953 18.7002 11.9258 18.7002 10.0156C18.7002 5.29297 14.833 1.42578 10.1104 1.42578C5.37598 1.42578 1.52051 5.29297 1.52051 10.0156C1.52051 14.7383 5.37598 18.6055 10.1104 18.6055ZM10.1104 16.6016C6.48926 16.6016 3.5127 13.625 3.5127 10.0156C3.5127 6.40625 6.48926 3.42969 10.1104 3.42969C13.7197 3.42969 16.6963 6.40625 16.6963 10.0156C16.6963 13.625 13.7197 16.6016 10.1104 16.6016Z" fill="#1A2258"/></svg>';
    $output .= '</button>';
    return $output;
}

// Move site title in nav-menu
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
add_action( 'cb_genesis_site_title', 'genesis_seo_site_title' );

/**
 * Add Site Logo in site-title
 *
 */
function cb_logo_in_title( $title, $inside, $wrap ) {

    $wrap   = 'div';
	$inside = '<a href="' . home_url() . '">' . get_bloginfo( 'name' ) . ' <img class="block h-[31.11px] w-auto" src="' . get_stylesheet_directory_uri() . '/assets/images/logo.png" alt="99.co property website singapore"></img></a>';
	
	//* Build the title
	$title  = genesis_html5() ? sprintf( "<{$wrap} %s>", genesis_attr( 'site-title', ['class' => 'site-title flex-shrink-0 flex items-center'] ) ) : sprintf( '<%s id="title">%s</%s>', $wrap, $inside, $wrap );
	$title .= genesis_html5() ? "{$inside}</{$wrap}>" : '';
	return $title;	
}
add_filter( 'genesis_seo_title', 'cb_logo_in_title', 10, 3 );