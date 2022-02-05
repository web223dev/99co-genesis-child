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
function ea_site_footer() {
	echo '<div class="footer-left">';
		echo '<p class="copyright">Copyright &copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '®. All Rights Reserved.</p>';
		echo '<p class="footer-links"><a href="' . home_url( 'privacy-policy' ) . '">Privacy Policy</a> <a href="' . home_url( 'terms' ) . '">Terms</a></p>';
		echo '<p class="cafemedia">An Elite Cafemedia Food Publisher</p>';
	echo '</div>';
	echo '<a class="backtotop" href="#main-content">Back to top' . ea_icon( array( 'icon' => 'arrow-up' ) ) . '</a>';
}
add_action( 'genesis_footer', 'ea_site_footer' );
remove_action( 'genesis_footer', 'genesis_do_footer' );

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