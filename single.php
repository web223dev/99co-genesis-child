<?php
/**
 * Single Post
 *
 * @package      EAGenesisChild
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/

function cb_site_inner_attr( $attributes ) {

	// Add a class of 'full' for styling this .site-inner differently
	$attributes[ 'class' ] .= ' max-w-[72rem] mx-auto';

	// Add the attributes from .entry, since this replaces the main entry
	$attributes = wp_parse_args( $attributes, genesis_attributes_entry( array() ) );

	return $attributes;
}
add_filter( 'genesis_attr_site-inner', 'cb_site_inner_attr' );

// Entry category in header
// add_action( 'genesis_entry_header', 'ea_entry_category', 8 );
add_action( 'genesis_entry_header', 'cb_entry_header_share', 13 );

/**
 * Entry header share
 *
 */
function cb_entry_header_share() {
	do_action( 'cb_entry_header_share' );
}

/**
 * Breadcrumb
*/
	add_action( 'genesis_before_content', 'crunchify_reposition_breadcrumbs' );
	function crunchify_reposition_breadcrumbs() {
		if ( is_singular() ) {
			remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
			add_action( 'genesis_entry_header', 'genesis_do_breadcrumbs', 9 );
		}
	}
	// add the filter
	// add_filter('wpseo_breadcrumb_separator', 'filter_wpseo_breadcrumb_separator', 10, 1);
	function filter_wpseo_breadcrumb_separator($this_options_breadcrumbs_sep) {
		return '<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.23047 11.2842C1.45898 11.2842 1.64062 11.2021 1.79883 11.0498L6.29297 6.66113C6.49219 6.46191 6.58594 6.25684 6.5918 6.00488C6.5918 5.75293 6.49805 5.54199 6.29297 5.34863L1.79883 0.954102C1.64062 0.801758 1.45312 0.719727 1.23047 0.719727C0.773438 0.719727 0.410156 1.08301 0.410156 1.53418C0.410156 1.75684 0.503906 1.96777 0.667969 2.13184L4.65234 6.00488L0.667969 9.87207C0.503906 10.0361 0.410156 10.2471 0.410156 10.4697C0.410156 10.9209 0.773438 11.2842 1.23047 11.2842Z" fill="#9A9EB5"/></svg>';
	};

	// add_filter( 'wpseo_breadcrumb_single_link', 'change_breadcrumb_link_class'); 
	function change_breadcrumb_link_class($link) {  
		return str_replace('<a', '<a class="my-class"', $link); 
	}

	// add_filter( 'wpseo_breadcrumb_single_link', 'wpseo_change_last_breadcrumb', 10, 2 );

	function wpseo_change_last_breadcrumb( $link_output, $link ) {

		if ( strpos( $link_output, 'breadcrumb_last' ) !== false ) {
			$link_output = '<h1><span class="breadcrumb_last" aria-current="page">' . $link['text'] . '</span></h1>';
		}

		return $link_output;
	}
/*** End Breadcrumb ***/

// Entry Header Class
add_filter( 'genesis_attr_entry-header', 'cb_entry_header_class' );
function cb_entry_header_class( $attributes ) { 
	$attributes['class'] .= ' mx-4 mt-2 md:mt-4';
	return $attributes;
}

// Entry Title Class
add_filter( 'genesis_attr_entry-title', 'cb_entry_title_class' );
function cb_entry_title_class( $attributes ) { 
	$attributes['class'] .= ' mt-3 md:mt-4 font-bold text-cbspacecadet-300 text-[23px] leading-[31px] md:text-[32px] md:leading-[46px]';
	return $attributes;
}

// Entry Author
add_action( 'genesis_entry_header', 'cb_entry_author', 12 );
function cb_entry_author() {
	$id = get_the_author_meta( 'ID' );
	echo '<div class="mt-1 flex space-x-1 text-xs lg:text-sm text-[#787D9C]"><span>' . do_shortcode('[post_modified_date]') . '</span><span aria-hidden="true">&middot;</span><span>' . nnco_reading_time() . '</span><span aria-hidden="true">&middot;</span><span aria-hidden="true">by ' . do_shortcode('[post_author_posts_link]') . '</span></div>';
}
// Entry Author link
add_filter( 'genesis_attr_entry-author-link', 'cb_entry_author_link_class' );
function cb_entry_author_link_class( $attributes ) { 
	$attributes['class'] .= ' hover:underline text-[#216BFF]';
	return $attributes;
}

function nnco_reading_time () {
	global $post;
	$content     = get_post_field( 'post_content', $post->ID );
	$word_count  = str_word_count( strip_tags( $content ) );
	$readingtime = ceil( $word_count / 200 );

	if ( $readingtime === 1 ) {
		$timer = ' min read';
	}
	else {
		$timer = ' min read';
	}
	$totalreadingtime = $readingtime . $timer;

	return $totalreadingtime;
}

// Post Image
add_action( 'genesis_before_entry_content', 'custom_display_featured_image' );
function custom_display_featured_image() {
	if ( ! is_singular( array( 'post', 'page' ) ) ) {//Post Types:- add one of your CPT.
		return;
	}
	if ( ! has_post_thumbnail() ) {
		return;
	}
	// Display featured image above content.
	echo '<div class="singular-featured-image mx-4 xl:-mx-6 mt-6 md:mt-8">';
		// $image = genesis_get_image( array( 'format' => 'url', 'size' => 'genesis_get_option( 'image_size' )' ) );
		$image = genesis_get_image( array( 'format' => 'url', 'size' => 'full' ) );// find more -> genesis/lib/functions/image.php
		printf( '<img class="rounded w-full h-full lg:h-[37.5rem] object-cover" src="%s" alt="%s" />', $image, the_title_attribute( 'echo=0' ) );
    echo '</div>';
}

// Add custom opening div for post title
add_action( 'genesis_before_entry_content', 'cb_entry_content_wrap_before',);
function cb_entry_content_wrap_before() {
	echo '<div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-8 mt-6 md:mt-8 mx-4">';
}
	// Entry content class
	add_filter( 'genesis_attr_entry-content', 'cb_entry_content_class' );
	function cb_entry_content_class( $attributes ) { 
		$attributes['class'] .= ' col-span-2';
		return $attributes;
	}
	// Categories
	add_action( 'genesis_entry_content', 'cb_single_post_categories');
	function cb_single_post_categories() {
		$output = '<ul class="flex text-[#216BFF] text-sm gap-4 my-8 flex-wrap">';
			$output .= '<li class="px-4 py-2 border border-[#216BFF] rounded-full">BTO 2022</li>';
			$output .= '<li class="px-4 py-2 border border-[#216BFF] rounded-full">Home & Living</li>';
			$output .= '<li class="px-4 py-2 border border-[#216BFF] rounded-full">Architecture</li>';
			$output .= '<li class="px-4 py-2 border border-[#216BFF] rounded-full">Resale & New Launch</li>';
			$output .= '<li class="px-4 py-2 border border-[#216BFF] rounded-full">5-room flat</li>';
			$output .= '<li class="px-4 py-2 border border-[#216BFF] rounded-full">Covid-19</li>';
			$output .= '<li class="px-4 py-2 border border-[#216BFF] rounded-full">HDB</li>';
		$output .= '</ul>';
		echo $output;
	}
	// Looking for property
	add_action( 'genesis_entry_content', 'cb_single_post_cta');
	function cb_single_post_cta() {
		$output = '<div class="flex border border-[#DDDEE6] p-6 rounded">';
		$output .= '<img src="' . get_stylesheet_directory_uri() . '/assets/images/looking_property.svg" alt="">';
			$output .= '<div class="pl-6">';
				$output .= '<h3 class="font-semibold text-base leading-[22px]">Looking for a property?</h3>';
				$output .= '<p class="text-xs leading-5 mt-2">Find the home of your dreams today on Singapore’s largest property portal <a href="#" class="font-semibold text-[#216BFF]">99.co</a>! You can also access a wide range of tools to <a href="#" class="font-semibold text-[#216BFF]">calculate</a> your down payments and loan repayments, to make an informed purchase.</p>';
			$output .= '</div>';
		$output .= '</div>';
		echo $output;
	}
	// Move Sidebar
	remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
	remove_action( 'genesis_sidebar_alt', 'genesis_do_sidebar_alt' );
	add_action( 'genesis_after_entry_content', function() { dynamic_sidebar( 'sidebar' ); });

// Add custom closing div for post title
add_action( 'genesis_after_entry_content', 'cb_entry_content_wrap_after' );
function cb_entry_content_wrap_after() {
	echo '</div>';
}

/**
 * Comments area
 */
// Remove website field from comment area
add_filter('comment_form_default_fields', 'unset_url_field');
function unset_url_field($fields){
    if(isset($fields['url']))
		unset($fields['url']);
		return $fields;
}
// Add After Entry wrap
add_action( 'genesis_after_entry', 'ea_single_after_entry', 8 );
remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );
function ea_single_after_entry() {
	echo '<div class="after-entry grid grid-cols-1 md:grid-cols-3 mt-12 md:mt-16 mx-4 pb-28">';
		echo '<div class="md:col-span-2">';
			// Sharing
			do_action( 'ea_entry_footer_share' );
}

/**
 * Related Post
 */
// After content
function cb_single_related_articles() {
    echo '<div class="custom-content border-t border-[#DDDEE6] pt-8 mx-4">';
	global $post; 
	$related = get_field( '_99co_recommended_articles', $post->ID );
        // if (!related) {
        //     $related = get_field('_99co_agents_editors_picks', 'option');
        // }
        if( $related ) { ?>
        <div class="widget widget_editors-picks">
            <h4 class="font-bold text-cbspacecadet-300 text-[23px] leading-[31px] sm:text-[32px] sm:leading-[46px]">Related articles</h4>
                <div class="recommended-articles grid grid-cols-12 md:gap-8 md:pt-6 pb-12 md:pb-8 divide-y divide-[#DDDEE6]">
                    <?php foreach( $related as $relate) {
                        // load all 'category' terms for the post
                        $terms = get_the_terms( get_the_ID(), 'category');
                        // we will use the first term to load ACF data from
                        if( !empty($terms) ) {
                            $term           = array_pop($terms);
                            $categorycolour = get_field('_99co_category_colour', $term );
                        }
                        ?>
                        <article class="entry entry-post py-4 md:py-0 col-span-12 md:col-span-6 lg:col-span-3">
                            <div class="inner flex flex-row md:flex-col overflow-hidden">
                                <div class="entry-image shrink-0 hidden sm:block">
                                    <?php echo get_the_post_thumbnail( $relate->ID, 'thumbnail-size', array( 'class' => 'sm:h-[144px] md:h-[240px] lg:h-[144px] w-full object-cover rounded' ) ); ?>
                                </div>
                                <header class="entry-header flex-1 bg-white sm:pl-3 md:pl-0 md:pt-4 flex flex-col justify-between">
                                    <h4 class="entry-title text-[.875rem] sm:text-[19px] leading-[19px] sm:leading-[26px] font-semibold text-cbspacecadet-300">
                                        <a href="<?php echo get_the_permalink($relate->ID); ?>"><?php echo cb_shorten_title(get_the_title($relate->ID)); ?></a>
                                    </h4>
									<div class="mt-1 flex items-center">
										<div class="flex space-x-1 text-xs sm:text-sm text-[#787D9C]">
											<span aria-hidden="true">
												<?php echo date("j M, Y", strtotime($relate->post_modified)); ?>
											</span>
											<span aria-hidden="true">
												&middot;
											</span>
											<span aria-hidden="true">
												by
												<a href="<?php echo get_author_posts_url($relate->post_author); ?>" class="hover:underline text-[#216BFF]">
													<?php echo get_the_author_meta('display_name', $relate->post_author); ?>
												</a>
											</span>
										</div>
									</div>
                                    <!-- <div class="more-link">
                                        <a href="<?php echo get_the_permalink($relate->ID); ?>">Read full story</a>
                                    </div> -->
                                </header>
                            </div>
                        </article>
                    <?php } ?>
                </div>
                <?php wp_reset_postdata(); ?>
            </div>
        <?php }
	echo '</div>';
}
add_action( 'genesis_after_content', 'cb_single_related_articles', 15 );

// Make shorten title
function cb_shorten_title( $title ) {
    $newTitle = substr( $title, 0, 45 ); // Only take the first 20 characters
    
    return $newTitle . " &hellip;"; // Append the elipsis to the text (...) 
}

// Single Subscribe
function cb_single_subscribe() {
?>
	<div class="single-subscribe max-w-[70rem] mx-auto">
		<div class="grid grid-cols-2 bg-[#F0F6FF] pt-[9.5px] md:pt-0 pb-[25.5px] md:pb-0 md:mb-16 lg:rounded text-cbspacecadet-300 pl-4">
			<div class="col-start-1 row-start-1 flex items-center">
				<div class="md:pt-[107px] md:pl-20">
					<h1 class="text-[19px] sm:text-[28px] leading-[26px] sm:leading-[38px] font-bold">Lorem ipsum dolor sit amet</h1>
					<p class="text-[16px] leading-[28px] font-semibold mt-2 hidden md:block">Lorem ipsum dolor sit amet</p>
				</div>
			</div>    
			<div class="col-start-1 col-end-3 row-start-2 md:col-end-2">
				<div class="md:pb-[107px] md:pl-20">
					<div class="md:pr-[43px] mt-2 md:mt-6">
						<label for="email" class="block text-sm font-medium text-gray-700"></label>
						<div class="relative mt-1 rounded-md">
							<input type="email" name="email" id="email" class="h-[52px] lg:h-[60px] focus:ring-indigo-500 focus:border-indigo-500 rounded block w-full pl-4 text-base leading-[22px] border-gray-300" placeholder="Enter your email" />
							<button
								type="button"
								class="absolute top-[6px] right-[6px] w-[104px] lg:w-[138px] h-10 lg:h-12 border hover:border-[#216BFF] text-sm lg:text-base leading-[19px] lg:leading-[22px] rounded text-white hover:text-[#216BFF] bg-[#216BFF] hover:bg-white focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 font-semibold"
							>
								<span>CTA</span>
							</button>
						</div>
					</div>
				</div>    
			</div>    
			<div class="col-start-2 row-start-1 md:row-end-3 flex items-center">
				<div class="sb-image p-2">
					<img class="" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/single_subscribe.png" alt="">
				</div>
			</div>
		</div>
	</div>
<?php
}
add_action( 'genesis_after_content', 'cb_single_subscribe', 20 );

genesis();