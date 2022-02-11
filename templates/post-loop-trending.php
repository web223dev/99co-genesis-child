<div class="<?php echo $args["class"] ? $args["class"] :'' ; ?> co99-post-loop">

<?php
$col =  $args['col'] ? 'md:w-1/'.$args['col']: '';
$numid = 01;
 
if ( have_posts() ) : 
    while ( have_posts() ) : the_post();    
        $pargs =  array('class' => "w-full ".$col." p-4 flex flex-col flex-grow flex-shrink", 'num' => $numid); 
        get_template_part( 'partials/blocks/post', 'article-trending', $pargs );   
        $numid++;
    endwhile;   
else: 
    echo "Sorry no post found";
endif; 
if($args['ad'] == true ){ 
    get_sidebar( 'square-ad' );
}

?>
</div>