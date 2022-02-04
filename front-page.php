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
        <div class="lists-wrapper">
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
                    <div class="inner">
						<?php if ( get_field( '_99co_featured_video' ) ) {
							$class = 'image overlay-video';
						} else {
							$class = 'image';
						} ?>
                        <div class="<?php echo $class; ?>">
                            <a href="<?php the_permalink(); echo '?utm_source=blog&utm_medium=spotlight_carousel' ?>">
								<?php the_post_thumbnail( 'slider-size' ); ?>
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

				$output .='<p class="text-cbspacecadet-300 mt-2 text-xs sm:text-base font-avenirnext-regular">No matter what stage of the journey you’re at, we’re here to help you get the property answers you need to make the best decision for you and your family</p>';
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