<div class="<?php echo $args["class"] ? $args["class"] :'' ; ?> co99-post-loop">
<?php
$col =  $args['col'] ? 'md:w-1/'.$args['col']: '';
$pargs =  array('class' => "py-4 md:py-0 col-span-12 md:col-span-4 md:border-b-0 border-b border-[#DDDEE6] last:border-b-0"); 

if ( have_posts() ) : 
    while ( have_posts() ) : the_post();    
        get_template_part( 'partials/blocks/post', 'article', $pargs );   
    endwhile;   
else: 
    echo "Sorry no post found";
endif; 
if($args['ad'] == true ){  
    echo  '<div class="hidden sm:block">';
    get_sidebar( 'square-ad' );
    echo '</div>';
}

?>
</div>