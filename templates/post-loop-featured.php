<div class="<?php echo $args["class"] ? $args["class"] :'' ; ?> co99-post-loop">
<?php
if ( have_posts() ) : 
    $count = 1;
    while ( have_posts() ) : the_post();    
        if ($count == 1 ){
            $pargs =  array('class' => "w-full md:w-1/1 p-4 flex flex-col flex-grow flex-shrink"  , 'excerpt' => true); 
            get_template_part( 'partials/blocks/post', 'article-featured',$pargs );   
        }else{
            $pargs =  array('class' => "w-full md:w-1/3 p-4 flex flex-col flex-grow flex-shrink",  'excerpt' => false ); 
            get_template_part( 'partials/blocks/post', 'article', $pargs );   
        }
    $count++;
    endwhile;   
else: 
    get_template_part( 'templates/archive', 'none' );
endif; 

?>
</div>