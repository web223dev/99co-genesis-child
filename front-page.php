<?php
/**
 * Home Page
 *
 * @package      EAGenesisChild
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/*
 * Home Slider.
 */
add_action( 'cb_content_area', 'cb_home_slider' );
function cb_home_slider() { ?>
    <?php echo cb_property_news_insider(); ?>
    <div class="home-section slider">
        <div class="lists-wrapper swiper text-center w-full max-h-[630px] rounded mainSwiper">
			<div class="swiper-wrapper">
			<?php
			$args  = array(
				'post_type'      => 'post',
				'posts_per_page' => '6',
				'post_status'    => 'publish',
				'category_name'  => '99dotco-picks'
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					global $post;

					// load all 'category' terms for the post
					$terms = get_the_terms( get_the_ID(), 'category' );
					// we will use the first term to load ACF data from
					if ( !empty( $terms ) ) {
						$term           = array_pop( $terms );
						$categorycolour = get_field( '_99co_category_colour', $term );
					}

					?>
                    <div class="inner swiper-slide">
						<?php if ( get_field( '_99co_featured_video' ) ) {
							$class = 'image overlay-video';
						} else {
							$class = 'image';
						} ?>
                        <div class="<?php echo $class; ?>">
                            <a href="<?php the_permalink(); echo '?utm_source=blog&utm_medium=spotlight_carousel' ?>">
								<?php the_post_thumbnail( 'slider-size', array('class' => 'min-h-[300px] object-cover swiper-lazy') ); ?>
                            </a>
                        </div>
                        <div class="overlay">
                            <header class="entry-header">
                                <?php
                                $categories = get_the_category();
                                if ( !empty( $categories ) ) {
                                    foreach ($categories as $category) {
                                        if ($category->slug != 'featured-posts' && $category->slug != '99dotco-picks') {
                                            echo '<div class="entry-category" style="background-color:' . $categorycolour . '"><a href="' . esc_url(get_category_link($category->term_id)) . '" style="color: ' . $categorycolour . '">' . esc_html($category->name) . '</a> </div>';
                                        }
                                    }
                                }
                                ?>
                                <h3 class="entry-title" itemprop="name">
                                    <a href="<?php the_permalink(); echo '?utm_source=blog&utm_medium=spotlight_carousel' ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="more-link">
                                    <a href="<?php the_permalink(); echo '?utm_source=blog&utm_medium=spotlight_carousel' ?>">Read more</a>
                                </div>
                            </header>
                        </div>
                    </div>
				<?php }
			}
			wp_reset_postdata();
			?>
        	</div>
			<!-- If we need pagination -->
			<div class="swiper-pagination"></div>
	
			<!-- If we need navigation buttons -->
			<div class="cb-button-prev left-[12.52px] sm:left-[35.52px] right-auto absolute top-1/2 z-10 cursor-pointer flex items-center justify-center">
				<svg width="17" height="28" viewBox="0 0 17 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.32 27.33c.36.34.8.53 1.3.53 1.04 0 1.85-.81 1.85-1.85 0-.51-.2-.98-.56-1.34L4.97 13.98 15.91 3.33c.36-.36.56-.85.56-1.35 0-1.03-.8-1.84-1.86-1.84-.5 0-.93.19-1.28.53L1.18 12.55c-.44.4-.66.9-.66 1.45 0 .55.22 1.01.64 1.44l12.16 11.89z" fill="#fff"></path></svg>
			</div>
			<div class="cb-button-next right-[12.52px] sm:right-[35.52px] left-auto absolute top-1/2 z-10 cursor-pointer flex items-center justify-center">
				<svg width="17" height="28" viewBox="0 0 17 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.36 27.86c.52 0 .94-.19 1.3-.53L15.8 15.45a2 2 0 00.64-1.45c0-.55-.2-1.03-.64-1.44L3.66.67a1.8 1.8 0 00-1.3-.53C1.3.14.5.95.5 1.98c0 .5.22.99.56 1.35l10.96 10.69L1.06 24.66a1.9 1.9 0 00-.56 1.34c0 1.04.81 1.85 1.86 1.85z" fill="#fff"></path></svg>
			</div>
        </div>
    </div>

<?php }

/**
 * Property News Insider section
 *
 */
function cb_property_news_insider() {
	$output ='<div class="mx-auto py-6 md:py-12 md:max-w-7xl">';
		$output .='<div class="md:flex md:flex-row lg:space-x-[145px]">';
			$output .='<div class="md:basis-2/5 lg:basis-1/4 flex items-center justify-center md:justify-start lg:justify-center font-avenirnext-bold">';
				$output .='<h1 class="static inset-0 text-cbspacecadet-300">';
					$output .='<p class="not-italic font-bold text-[16.3px] leading-[23px] md:text-[25.9px] md:leading-[36px] text-center tracking-[2px] uppercase">Property News</p>';
					$output .='<p class="not-italic font-bold text-[44.56px] leading-[43.93px] md:text-[69px] md:leading-[70px] text-center tracking-[2.7px] flex-none order-none grow-0 m-0">Insider</p>';
				$output .= '</h1>';
			$output .= '</div>';
			$output .='<div class="md:basis-3/5 lg:basis-3/4 flex flex-col items-start justify-end text-center md:text-left mt-4">';
				$output .='<div class="w-full font-avenirnext-demi">';
					$output .='<h1 class="text-sm font-semibold tracking-tight text-cbspacecadet-300 sm:text-base">Get access to the latest property news and articles</h1>';
				$output .= '</div>';

				$output .='<p class="text-cbspacecadet-300 mt-2 text-xs sm:text-base font-avenirnext-regular">No matter what stage of the journey you???re at, we???re here to help you get the property answers you need to make the best decision for you and your family</p>';
			$output .= '</div>';
		$output .= '</div>';
	$output .= '</div>';
	return $output;
}

/**
 * Add attributes for site-inner element, since we're removing 'content'.
 *
 * @param array $attributes existing attributes
 *
 * @return array amended attributes
 */
function cb_site_inner_attr( $attributes ) {

	// Add a class of 'full' for styling this .site-inner differently
	$attributes[ 'class' ] .= ' max-w-[70rem] mx-auto px-4';

	// Add the attributes from .entry, since this replaces the main entry
	$attributes = wp_parse_args( $attributes, genesis_attributes_entry( array() ) );

	return $attributes;
}

add_filter( 'genesis_attr_site-inner', 'cb_site_inner_attr' );

get_header();
do_action( 'cb_content_area' );
get_footer();