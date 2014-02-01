<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
	<div class="container-fluid">
	<div class="row page-content">
	<div class="col-md-9 post-content">
	
		
			<?php
				// Start the Loop.
				while ( have_posts() ) : the_post();?>

					
					<div class="single-post-title"><?php the_title();?> </div>
	<div class="single-post-text"><p>
	<?php the_content(); ?></p></div>
	
	
			
			
				<?php	
				endwhile;
			?>
			
		</div>
		<div class="col-md-3">
		
	<aside>

<div class="row social-share">
	<div class="col-md-4 social-icons">
<a href="javascript:;" onclick="window.open('http://www.facebook.com/share.php?u=<?php the_permalink(); ?>','facebook share','resizable=yes,width=700,height=500,scrollbars=yes,status=yes')"><img alt="facebook" src="http://localhost/wp-content/uploads/2014/01/facebook500-e1391138818728.png"></a>
</div>
<div class="col-md-4 social-icons">
  <a href="javascript:;" onclick="window.open('https://plus.google.com/share?url=<?php the_permalink(); ?>','GooglePlus share','resizable=yes,width=700,height=500,scrollbars=yes,status=yes')"><img alt="twitter" src="http://localhost/wp-content/uploads/2014/01/googleplus-revised-e1391138857754.png"/></a>
  
  </div>
  <div class="col-md-4 social-icons">
            <a href="javascript:;" onclick="window.open('http://twitter.com/home?status=<?php the_permalink(); ?>','twitter share','resizable=yes,width=700,height=500,scrollbars=yes,status=yes')"><img alt="twitter" src="http://localhost/wp-content/uploads/2014/01/twitter-e1391138737778.png"/></a>
	<!-- Facebook -->
	</div>
	</div>
	<div class="row">
	<?php

	$tags = wp_get_post_tags($post->ID);  
      
    if ($tags) {  
    $tag_ids = array();  
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
    $args=array(  
    'tag__in' => $tag_ids,  
    'post__not_in' => array($post->ID),  
    'posts_per_page'=>4, // Number of related posts to display.  
    'caller_get_posts'=>1  
    );  
      
   $the_query  = new wp_query( $args );  
	

while ( $the_query->have_posts() ) : $the_query->the_post();?>
	<?php $post_counter++; ?>
	<div id="related-post"> 
	 <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
	<div class="related-post-thumbnail">
    <?php the_post_thumbnail( 'post-Image',array('class' => 'post-thumbnail-img' )) ;?>
    </div>
	</a>
	<div> <p class="related-post-title"><?php the_title();?></p> </div>
	
	</div>
	<?php endwhile; } ?>

	</aside>
	</div>
	</div>
	</div>
	</div>
<?php

get_footer();
