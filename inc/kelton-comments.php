<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Remove comments frontend. Useful if replacing WP commenting with Disqus.
 *
 * @since 2.0.10
 */
// remove_action( 'genesis_comments', 'genesis_do_comments' );
// remove_action( 'genesis_comment_form', 'genesis_do_comment_form' );

/*
 * Remove pings frontend.
 *
 * @since 2.0.16
 */
// remove_action( 'genesis_pings', 'genesis_do_pings' );

/*
 * Remove the entire comments area frontend, including comments, reply form, and pings.
 *
 * @since 2.0.16
 */
// remove_action( 'genesis_after_entry', 'genesis_get_comments_template' );

add_filter( 'comment_form_defaults', 'sp_comment_form_defaults' );
function sp_comment_form_defaults( $defaults ) {
	$defaults['title_reply'] = __( 'Leave a comment' );

	return $defaults;
}

//* Modify comments title text in comments
add_filter( 'genesis_title_comments', 'sp_genesis_title_comments' );
function sp_genesis_title_comments() {
	global $post;
	$title = '<h1 class="font-bold text-cbspacecadet-300 text-[23px] leading-[31px] md:text-[32px] md:leading-[46px]">Comments</h1>';

	return $title;
}

add_filter( 'genesis_show_comment_date', 'jmw_show_comment_date_only' );
/**
 * Show date on comments without time or link.
 *
 * Stop the output of the Genesis core comment dates and outputs comments with date only
 * The genesis_show_comment_date filter was introduced in Genesis 2.2 (will not work with older versions)
 *
 * @author Jo Waltham
 *
 * @see http://www.jowaltham.com/customising-comment-date-genesis/
 *
 * @param bool $comment_date Whether to print the comment date or not
 *
 * @return bool Whether to print the comment date or not
 */
function jmw_show_comment_date_only( $comment_date ) {
	printf('<p %s><time %s>%s</time></p>',
		genesis_attr( 'comment-meta' ),
		genesis_attr( 'comment-time' ),
		esc_html( get_comment_date() )
	);
	// Return false so that the parent function doesn't output the comment date, time and link
	return false;
}

// First remove the genesis_default_list_comments function
remove_action( 'genesis_list_comments', 'genesis_default_list_comments' );
// Now add our own and specify our custom callback
add_action( 'genesis_list_comments', 'nnco_default_list_comments' );
function nnco_default_list_comments () {

    $args = array(
        'style'      => 'ul',
        'type'        => 'comment',
        'avatar_size' => 48, 
        'callback' => 'nnco_comment_callback',
        'walker' => new CB_Walker_Comment,
    );

    $args = apply_filters( 'genesis_comment_list_args', $args );

    echo '<ul class="divide-y divide-[#DDDEE6]">';
        wp_list_comments( $args );
    echo '</ul>';

}

class CB_Walker_Comment extends Walker_Comment {
    /**
     * @see Walker::start_lvl()
     * @since 2.1.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of comment. Used for padding.
     * @param array $args
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "\n<ul class='children col-start-2 border-t border-[#DDDEE6]'>\n"; // MAKE SURE TO CHANGE CLASSES HERE
    }
}

/**
 * Comment callback for {@link genesis_default_list_comments()} if HTML5 is not active.
 *
 * Does `genesis_before_comment` and `genesis_after_comment` actions.
 *
 * Applies `comment_author_says_text` and `genesis_comment_awaiting_moderation` filters.
 *
 * @since 1.0.0
 *
 * @param stdClass $comment comment object
 * @param array    $args    comment args
 * @param int      $depth   depth of current comment
 */
function nnco_comment_callback ( $comment, array $args, $depth ) {

	$GLOBALS['comment'] = $comment; ?>
    
    <li <?php comment_class('group grid grid-cols-[48px_minmax(0,1fr)] gap-x-4 py-6'); ?> id="comment-<?php comment_ID(); ?>">
	
        <?php do_action( 'genesis_before_comment' ); ?>
        
        <div class="comment-header">
            <?php if ( 0 !== $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>
        </div>
        
        <div class="comment-content pb-6">
            <div class="flex items-center justify-between">
                <div class="flex">
                    <div class="comment-author vcard font-semibold text-base leading-[22px]">
                        <?php printf( __( '<cite class="fn">%s</cite>', 'genesis' ), get_comment_author_link() ); ?>
                    </div>
                    <div class="comment-meta commentmetadata text-base leading-[22px] text-[#787D9C] ml-4">
                        <?php printf( __( '%1$s at %2$s', 'genesis' ), get_comment_date(), get_comment_time() ); ?>
                        <?php edit_comment_link( __( '(Edit)', 'genesis' ), '' ); ?>
                    </div>
                </div>
                <!-- Delete, Edit, Reply -->
                <div class="flex space-x-6 font-semibold text-sm leading-[19px] text-[#216BFF]">
                    <a class="flex items-center" href="#"><svg class="mr-[6px]" width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.81152 14.6634C10.6969 14.6634 11.2178 14.1947 11.2568 13.3092L11.654 4.49414H12.5459C12.8779 4.49414 13.1383 4.24023 13.1383 3.9082C13.1383 3.57617 12.8779 3.32227 12.5459 3.32227H9.85059V2.52799C9.85059 1.55143 9.16699 0.919922 8.07324 0.919922H5.9248C4.83105 0.919922 4.15397 1.55143 4.15397 2.52799V3.32227H1.45866C1.12663 3.32227 0.866211 3.57617 0.866211 3.9082C0.866211 4.24023 1.12663 4.49414 1.45866 4.49414H2.3571L2.74772 13.3092C2.79329 14.1947 3.30762 14.6634 4.19303 14.6634H9.81152ZM8.62012 3.32227H5.38444L5.39095 2.58008C5.39095 2.24805 5.63835 2.01367 5.99642 2.01367H8.00814C8.36621 2.01367 8.61361 2.24805 8.62012 2.58008V3.32227ZM4.84408 12.9186C4.60319 12.9186 4.4209 12.7103 4.41439 12.4238L4.16699 5.80925C4.16048 5.5293 4.35579 5.32096 4.59668 5.32096C4.83757 5.32096 5.03939 5.54232 5.0459 5.80925L5.28027 12.4173C5.28678 12.6973 5.09798 12.9186 4.84408 12.9186ZM6.99902 12.9186C6.76465 12.9186 6.55632 12.6973 6.55632 12.4238V5.80925C6.55632 5.54232 6.76465 5.32096 6.99902 5.32096C7.23991 5.32096 7.45475 5.54232 7.45475 5.80925L7.44824 12.4238C7.44824 12.6973 7.23991 12.9186 6.99902 12.9186ZM9.16048 12.9186C8.90658 12.9186 8.72428 12.6973 8.73079 12.4173L8.95866 5.80925C8.97168 5.54232 9.16699 5.32096 9.40788 5.32096C9.65527 5.32096 9.85059 5.53581 9.84408 5.80925L9.59668 12.4238C9.58366 12.7103 9.40788 12.9186 9.16048 12.9186Z" fill="#216BFF"/>
                        </svg>Delete</a>
                    <a class="flex items-center" href="#"><svg class="mr-[6px]" width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M-0.000976562 9.64061V11.6673C-0.000976562 11.8539 0.14569 12.0006 0.332357 12.0006H2.35902C2.44569 12.0006 2.53236 11.9673 2.59236 11.9006L9.87236 4.62728L7.37236 2.12728L0.0990234 9.40061C0.0323568 9.46728 -0.000976562 9.54728 -0.000976562 9.64061ZM11.8057 2.69402C12.0657 2.43402 12.0657 2.01402 11.8057 1.75402L10.2457 0.194023C9.98569 -0.0659766 9.56569 -0.0659766 9.30569 0.194023L8.08569 1.41402L10.5857 3.91402L11.8057 2.69402Z" fill="#216BFF"/>
                        </svg>Edit</a>
                    <?php comment_reply_link( array_merge( $args, array('reply_text' => __('<svg class="mr-[6px]" width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.66667 2.99967V0.333008L0 4.99967L4.66667 9.66634V6.93301C8 6.93301 10.3333 7.99967 12 10.333C11.3333 6.99967 9.33333 3.66634 4.66667 2.99967Z" fill="#216BFF"/></svg>Reply', 'reply'), 'depth' => $depth, 'max_depth' => $args['max_depth']) ) ); ?>
                    <a class="flex items-center" href="#"></a>
                </div>
            </div>
            
            <div class="mt-4 prose prose-sm max-w-none">
                <?php if ( !$comment->comment_approved ) : ?>
                    <p class="alert"><?php echo apply_filters( 'genesis_comment_awaiting_moderation', __( 'Your comment is awaiting moderation.', 'genesis' ) ); ?></p>
                <?php endif; ?>

                <?php comment_text(); ?>
            </div>
            <!-- Hide Show child reply comment -->
            <p class="font-semibold text-sm leading-[19px] text-[#216BFF] flex items-center mt-3">Hide 1 reply <svg class="ml-[6px]" width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.954102 5.19336C0.801758 5.3457 0.719727 5.53906 0.719727 5.76172C0.719727 6.21289 1.08301 6.58203 1.53418 6.58203C1.7627 6.58203 1.96777 6.48828 2.13184 6.32422L6.00488 2.33984L9.87207 6.32422C10.0303 6.49414 10.2471 6.58203 10.4697 6.58203C10.9209 6.58203 11.2842 6.21289 11.2842 5.76172C11.2842 5.5332 11.2021 5.3457 11.0498 5.19336L6.66113 0.699219C6.46777 0.5 6.25098 0.400391 5.99902 0.400391C5.75293 0.400391 5.54199 0.494141 5.34277 0.693359L0.954102 5.19336Z" fill="#216BFF"/>
                </svg></p>
        </div>
        
        <?php do_action( 'genesis_after_comment' );

	// No ending </li> tag because of comment threading.
}

// Replace comment reply link class
function cb_comment_reply_link_class( $class ) {
    $class = str_replace( "class='comment-reply-link", "class='comment-reply-link flex items-center", $class );
    return $class;
}
 
add_filter( 'comment_reply_link', 'cb_comment_reply_link_class' );

// Move comment field to bottom
function cb_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}
     
add_filter( 'comment_form_fields', 'cb_move_comment_field_to_bottom' );

/**
 * Change comment form textarea to use placeholder.
 *
 * @since  1.0.0
 * @param array $args
 * @return array
 */
function ea_comment_textarea_placeholder( $args ) {
    $args['class_container']      .= ' mt-10';
    $args['class_form']           .= ' mt-6 grid grid-cols-2 gap-6';
    $args['class_submit']         .= ' py-[13px] px-6 text-base leading-[22px] bg-[#EAEBF0] text-[#B5B8C9] font-semibold rounded';
    $args['title_reply_before']   = str_replace( 'comment-reply-title', 'comment-reply-title comment-reply-title font-semibold text-[19px] leading-[26px]', $args['title_reply_before'] );
	$args['comment_field']        = str_replace( 'textarea', 'textarea class="w-full border border-[#DDDEE6] p-3 rounded" placeholder="Leave a comment..."', $args['comment_field'] );
	$args['comment_field']        = str_replace( '<label for="comment">Comment <span class="required" aria-hidden="true">*</span></label>', '', $args['comment_field'] );
	$args['comment_field']        = str_replace( 'comment-form-comment', 'comment-form-comment col-span-2', $args['comment_field'] );
	$args['comment_field']        = str_replace( '</p>', '</p><p class="italic text-xs leading-[16.39px] col-span-2">Your email address will not be published. Required fields are marked *</p>', $args['comment_field'] );
    $args['submit_field']         = str_replace( 'form-submit', 'form-submit col-span-2', $args['submit_field'] );

	return $args;
}
add_filter( 'comment_form_defaults', 'ea_comment_textarea_placeholder' );

/**
 * Comment Form Fields Placeholder. Remove labels and checkbox for saving name, email
 */
function be_comment_form_fields( $fields ) {
    unset( $fields['cookies'] );
	foreach( $fields as &$field ) {
		$field = str_replace( 'id="author"', 'id="author" placeholder="Name *"', $field );
		$field = str_replace( '<label for="author">Name <span class="required" aria-hidden="true">*</span></label>', '', $field );
		$field = str_replace( 'comment-form-author', 'comment-form-author col-span-1', $field );
        
		$field = str_replace( 'id="email"', 'id="email" placeholder="E-mail address *"', $field );
		$field = str_replace( '<label for="email">Email <span class="required" aria-hidden="true">*</span></label>', '', $field );
		$field = str_replace( 'comment-form-email', 'comment-form-email col-span-1', $field );

		$field = str_replace( 'size="30"', 'size=""', $field );
		$field = str_replace( '<input', '<input class="w-full border border-[#DDDEE6] p-3 rounded"', $field );
	}

	return $fields;
}
add_filter( 'comment_form_default_fields', 'be_comment_form_fields' );
