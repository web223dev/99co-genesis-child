<?php
/**
 * Site Footer
 *
 * @package      EAGenesisChild
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * Site Footer
 *
 */
// function ea_site_footer() {
// 	echo '<div class="footer-left">';
// 		echo '<p class="copyright">Copyright &copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '®. All Rights Reserved.</p>';
// 		echo '<p class="footer-links"><a href="' . home_url( 'privacy-policy' ) . '">Privacy Policy</a> <a href="' . home_url( 'terms' ) . '">Terms</a></p>';
// 		echo '<p class="cafemedia">An Elite Cafemedia Food Publisher</p>';
// 	echo '</div>';
// 	echo '<a class="backtotop" href="#main-content">Back to top' . ea_icon( array( 'icon' => 'arrow-up' ) ) . '</a>';
// }
function cb_site_footer() {
	echo '<footer class="bg-[#0E1545]" aria-labelledby="footer-heading">';
        echo '<div class="max-w-[72rem] mx-auto py-6 px-4 lg:py-12">';
			echo '<div class="pb-8 grid grid-cols-4">';
				if( has_nav_menu( 'footer_section_1_1' ) ) {
					wp_nav_menu( array( 
						'theme_location'  => 'footer_section_1_1', 'menu_class'	  => 'grid grid-cols-2 gap-4', 'container_class' => 'col-span-4 md:col-span-2', 'walker' => new Footer_Walker_Nav_Menu() 
					));
				}
				if( has_nav_menu( 'footer_section_1_2' ) ) {
					wp_nav_menu( array( 
						'theme_location'  => 'footer_section_1_2', 'menu_class'	  => 'grid grid-cols-2 gap-4', 'container_class' => 'col-span-4 md:col-span-2', 'walker' => new Footer_Walker_Nav_Menu() 
					));
				}
			echo '</div>';
			echo '<div class="border-t border-[#DDDEE6] py-8 grid grid-cols-4 gap-4">';
				echo '<div class="grid grid-cols-1 col-span-4 md:col-span-2">';
					echo '<div class="md:max-w-md">';
						echo '<div>';
							echo '<h3 class="text-base leading-7 font-avenirnext-demi text-white">Welcome to 99.co!</h3>';
							echo '<p class="text-sm leading-6 text-white">99.co is Singapore’s fastest growing property portal. With us, you’ll feel right at home when searching for houses, condominiums, apartments and HDBs for sales & rent in Singapore.</p>';
						echo '</div>';
						echo '<div class="mt-6">';
							echo '<h3 class="text-base leading-7 font-avenirnext-demi text-white mb-1">Contact</h3>';
							echo '<div class="grid grid-flow-col grid-cols-[max-content] gap-x-4 items-center text-sm leading-6">';
								echo '<img class="w-4 h-4" src="images/mail.svg" alt="">';
								echo '<a href="#" class="text-white col-start-2">Enquiries</a>';
								echo '<a href="#" class="text-white col-start-2">General: hello@99.co</a>';
								echo '<a href="#" class="text-white col-start-2">Marketing: marketing@99.co</a>';
								echo '<a href="#" class="text-white col-start-2">Media: pr@99.co</a>';
								echo '<a href="#" class="text-white col-start-2">Advertising: advertise@99.co</a>';
								echo '<a href="#" class="text-white col-start-2"></a>';
								echo '<a href="#" class="text-white col-start-2"></a>';
							echo '</div>';
							echo '<div class="grid grid-flow-col grid-cols-[max-content] gap-x-4 items-center text-sm leading-6">';
								echo '<img class="w-4 h-4" src="images/phone.svg" alt="">';
								echo '<a href="#" class="text-white col-start-2 col-span-2">+65 6464 0552 (10am-6pm, Mon-Fri)</a>';
							echo '</div>';
							echo '<div class="grid grid-flow-col grid-cols-[max-content] gap-x-4 items-center text-sm leading-6">';
								echo '<img class="w-4 h-4" src="images/facebook_icon.svg" alt="">';
								echo '<a href="#" class="text-white col-start-2 col-span-2">99.co Agents Facebook Group</a>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
				echo '<div class="grid grid-cols-2 col-span-4 md:col-span-2 gap-4">';
					echo '<div class="grid grid-cols-1 col-span-1 gap-6">';
					if( has_nav_menu( 'footer_section_2_1' ) ) {
						wp_nav_menu( array( 
							'theme_location'  => 'footer_section_2_1', 'walker' => new Footer_Walker_Nav_Menu() 
						));
					}
					echo '</div>';
					echo '<div class="grid grid-cols-1 col-span-1 gap-6">';
						if( has_nav_menu( 'footer_section_2_2' ) ) {
							wp_nav_menu( array( 
								'theme_location'  => 'footer_section_2_2', 'walker' => new Footer_Walker_Nav_Menu() 
							));
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="border-t border-[#DDDEE6] pt-8">';
				echo '<div class="flex justify-between items-center">';
					echo '<div class="flex gap-4 md:gap-8 items-center">';
						echo '<a href="#" class="text-white hover:text-gray-300">';
							echo '<span class="sr-only">Facebook</span>';
							echo '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.6287 19.6004V12.17H16.1172L16.4895 9.28146H13.6287V7.43826C13.6287 6.60199 13.8612 6.03132 15.0602 6.03132H16.5898V3.44786C15.8493 3.36929 15.1051 3.33119 14.3604 3.33372C12.1556 3.33372 10.6463 4.67986 10.6463 7.15239V9.28146H8.15244V12.17H10.6463V19.6004H1.46657C0.877465 19.6004 0.399902 19.1228 0.399902 18.5337V1.46706C0.399902 0.877954 0.877465 0.400391 1.46657 0.400391H18.5332C19.1223 0.400391 19.5999 0.877954 19.5999 1.46706V18.5337C19.5999 19.1228 19.1223 19.6004 18.5332 19.6004H13.6287Z" fill="white"/></svg>';
						echo '</a>';
						echo '<a href="#" class="text-white hover:text-gray-300">';
							echo '<span class="sr-only">Instagram</span>';
							echo '<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M10 0.0400391C12.7062 0.0400391 13.0438 0.0499991 14.1056 0.0997991C15.1663 0.149599 15.8884 0.315931 16.5238 0.562939C17.1812 0.815923 17.735 1.15855 18.2888 1.71133C18.7952 2.20922 19.1871 2.8115 19.4371 3.47624C19.6832 4.11069 19.8505 4.83379 19.9003 5.89453C19.9471 6.95626 19.96 7.29391 19.96 10C19.96 12.7062 19.9501 13.0438 19.9003 14.1056C19.8505 15.1663 19.6832 15.8884 19.4371 16.5238C19.1878 17.1889 18.7958 17.7914 18.2888 18.2888C17.7907 18.795 17.1885 19.1869 16.5238 19.4371C15.8894 19.6832 15.1663 19.8505 14.1056 19.9003C13.0438 19.9471 12.7062 19.96 10 19.96C7.29391 19.96 6.95626 19.9501 5.89453 19.9003C4.83379 19.8505 4.11169 19.6832 3.47624 19.4371C2.81124 19.1876 2.20886 18.7957 1.71133 18.2888C1.20477 17.7909 0.812867 17.1886 0.562939 16.5238C0.315931 15.8894 0.149599 15.1663 0.0997991 14.1056C0.0529871 13.0438 0.0400391 12.7062 0.0400391 10C0.0400391 7.29391 0.0499991 6.95626 0.0997991 5.89453C0.149599 4.83279 0.315931 4.11169 0.562939 3.47624C0.812174 2.81109 1.20417 2.20865 1.71133 1.71133C2.209 1.20459 2.81134 0.812665 3.47624 0.562939C4.11169 0.315931 4.83279 0.149599 5.89453 0.0997991C6.95626 0.0529871 7.29391 0.0400391 10 0.0400391ZM10 5.02004C7.24966 5.02004 5.02004 7.24966 5.02004 10C5.02004 12.7504 7.24966 14.98 10 14.98C12.7504 14.98 14.98 12.7504 14.98 10C14.98 7.24966 12.7504 5.02004 10 5.02004ZM16.474 4.77104C16.474 4.08344 15.9166 3.52604 15.229 3.52604C14.5414 3.52604 13.984 4.08344 13.984 4.77104C13.984 5.45863 14.5414 6.01604 15.229 6.01604C15.9166 6.01604 16.474 5.45863 16.474 4.77104ZM10 7.01204C11.6503 7.01204 12.988 8.34981 12.988 10C12.988 11.6503 11.6503 12.988 10 12.988C8.34981 12.988 7.01204 11.6503 7.01204 10C7.01204 8.34981 8.34981 7.01204 10 7.01204Z" fill="white"/></svg>';
						echo '</a>';
						echo '<a href="#" class="text-white hover:text-gray-300">';
							echo '<span class="sr-only">Youtube</span>';
							echo '<svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.5049 2.52023C19.96 4.29511 19.96 8.00023 19.96 8.00023C19.96 8.00023 19.96 11.7053 19.5049 13.4802C19.2519 14.4613 18.5119 15.2332 17.5746 15.4941C15.8725 15.9682 10 15.9682 10 15.9682C10 15.9682 4.13061 15.9682 2.42546 15.4941C1.48424 15.2292 0.745207 14.4583 0.495211 13.4802C0.0400391 11.7053 0.0400391 8.00023 0.0400391 8.00023C0.0400391 8.00023 0.0400391 4.29511 0.495211 2.52023C0.748195 1.53917 1.48822 0.767275 2.42546 0.506323C4.13061 0.0322266 10 0.0322266 10 0.0322266C10 0.0322266 15.8725 0.0322266 17.5746 0.506323C18.5158 0.771259 19.2549 1.54216 19.5049 2.52023ZM8.00804 11.4862L13.984 8.00023L8.00804 4.51423V11.4862Z" fill="white"/></svg>';
						echo '</a>';
						echo '<a href="#" class="text-white hover:text-gray-300">';
							echo '<span class="sr-only">Tictok</span>';
							echo '<svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 13.3236C0.0658858 12.8917 0.11713 12.4597 0.256223 12.0425C1.03221 9.70718 2.62811 8.27965 5.02196 7.7306C5.68082 7.57687 6.347 7.56955 7.0205 7.64275C7.17423 7.65739 7.2328 7.71596 7.2328 7.86969C7.22548 8.85066 7.22548 9.83162 7.2328 10.8199C7.2328 10.9883 7.17423 11.0102 7.0205 10.9736C5.32943 10.549 3.72621 11.5739 3.38946 13.2796C3.06003 14.9414 4.34846 16.5886 6.03221 16.713C7.56955 16.8302 9.00439 15.7394 9.18741 14.1142C9.20937 13.9531 9.20205 13.7921 9.20205 13.6237C9.20205 9.20937 9.20205 4.80234 9.20205 0.387994C9.20205 0.314788 9.20205 0.241581 9.20205 0.175695C9.19473 0.0512445 9.26062 0 9.39239 0C9.70718 0.00732064 10.0146 0 10.3294 0C10.981 0 11.6325 0.00732064 12.284 0C12.4597 0 12.5256 0.0585652 12.5329 0.234261C12.5842 1.50073 13.0674 2.58419 13.9458 3.48463C14.7657 4.3265 15.7613 4.81698 16.9253 4.9634C17.0864 4.98536 17.2474 4.99268 17.4085 5C17.5256 5 17.5695 5.05124 17.5695 5.16838C17.5695 6.15666 17.5695 7.14495 17.5695 8.13324C17.5695 8.30161 17.4524 8.29429 17.3426 8.29429C16.5593 8.26501 15.7906 8.14788 15.0439 7.9063C14.2094 7.64275 13.4334 7.25476 12.716 6.74231C12.672 6.71303 12.6281 6.63982 12.5695 6.66911C12.4963 6.70571 12.5329 6.78624 12.5329 6.8448C12.5329 9.15081 12.5403 11.4641 12.5403 13.7701C12.5403 16.6618 10.5637 19.1581 7.75256 19.8316C7.42313 19.9122 7.08638 19.9414 6.75695 20C6.43485 20 6.10542 20 5.78331 20C5.64422 19.978 5.50513 19.9634 5.35871 19.9341C2.92826 19.5168 1.25915 18.1625 0.358712 15.8712C0.146413 15.3514 0.0658858 14.8097 0 14.2606C0 13.9458 0 13.6384 0 13.3236Z" fill="white"/></svg>';
						echo '</a>';
					echo '</div>';
					echo '<a class="flex justify-center items-center text-white font-avenirnext-demi text-sm leading-6 gap-3">Back to top<img src="images/back_to_top.svg" alt=""></a>';
				echo '</div>';
				echo '<p class="mt-2 md:mt-4 text-xs leading-5 sm:text-sm sm:leading-6 text-white">&copy; 99.co 2014 — 2022</p>';
			echo '</div>';
		echo '</div>';
	echo '</footer>';
}
add_action( 'genesis_footer', 'cb_site_footer' );
remove_action( 'genesis_footer', 'genesis_do_footer' );

/**
 * Custom walker class.
 */
class Footer_Walker_Nav_Menu extends Walker_Nav_Menu {
 
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
            ( $display_depth == 1  ? 'mt-1' : '' ),
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
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
 
        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'relative main-menu-item py-[13px]' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
 
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// Add AlpineJS attributes
        $aj_attr_x_data = ( $depth == 0 ? 'x-data="{ cbCollapseOpen' . $item->ID . ': true }"' : '' );
 
        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '" ' . $aj_attr_x_data . '>';
		
		// Depth-link classes a&&b <a>
        $depth_link_classes = array(
			( $depth == 0 ? 'main-menu-link text-base leading-7 font-avenirnext-demi text-white' : 'sub-menu-link' ),
			( $depth == 1 ? 'text-sm leading-6 text-white hover:text-gray-300' : ''),
		);

		$depth_link_class_names = esc_attr( implode( ' ', $depth_link_classes ) );

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
            $item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><button class="block md:hidden bg-[url(\'' . get_stylesheet_directory_uri() . '/assets/images/nav_mobile_down.svg\')] bg-no-repeat bg-[50%] absolute right-0 top-0 w-4 h-4 translate-x-[calc(10vw - 11px)] brightness-0 invert-[1] mt-[19px]" @click="cbCollapseOpen' . $item->ID . ' = !cbCollapseOpen' . $item->ID . '" :class="cbCollapseOpen' . $item->ID . ' ? \'rotate-180\': \'\'"></button>', $item_output );
        }

        $args->cb_nav_item_ID = $item->ID;
        $args->cb_menu_item_parent = $item->menu_item_parent;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}
/**
 * Tailwindcss configuration
 */
add_action( 'wp_footer', 'cb_swiper_slide_config' );
function cb_swiper_slide_config(){
?>
	<script type="module">
		import Swiper from 'https://unpkg.com/swiper@8/swiper-bundle.esm.browser.min.js'
		
		var swiper = new Swiper('.mainSwiper', {
			// Optional parameters
			direction: 'horizontal',
			loop: true,

			// If we need pagination
			pagination: {
				el: ".swiper-pagination",
				dynamicBullets: true,
				dynamicMainBullets: 4
			},

			// Navigation arrows
			navigation: {
				nextEl: '.cb-button-next',
				prevEl: '.cb-button-prev',
			},
			lazy: true,
		});

		var swiper2 = new Swiper(".latestVideoSwiper", {
			slidesPerView: 3,
			spaceBetween: 32,
			pagination: {
				el: ".swiper-pagination",
				clickable: true,
				dynamicBullets: true,
				dynamicMainBullets: 2
			},
			// Navigation arrows
			navigation: {
				nextEl: '.cb-button-next',
				prevEl: '.cb-button-prev',
			},
			lazy: true,
		});
	</script>
<?php
}