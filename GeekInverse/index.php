<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="main-content" class="main-content">



	<div id="primary" class="container-fluid">
		<div id="content" class="container-fluid role="main">
		<div  class="row">
		<?php query_posts('posts_per_page=2'); ?>
		
		<?php $ids = array(); ?>
<?php $post_counter = 0;
while ( have_posts() ) : the_post() ?>
	<?php $post_counter++; $ids[] = $post->ID;  ?>
	<div class="col-md-6">
	<div class="post"> 
	
	<div class="post-thumbnail-img">
    <?php the_post_thumbnail("post-Image");?>
    </div>
	<div class="post-contents">
	<div class="post-title"><?php the_title();?> </div>
	<div class="post-text"><p>
	<?php the_excerpt(); ?></p></div>
	</div>
	<div class="col-md-3 col-md-offset-9 read-more">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><button type="button" class="btn btn-primary read-more">Read More</button></a>
	</div>
	
	</div>
	</div>
	<?php endwhile; ?>
	</div>
	<div class="row">
	<div class="col-md-8">
	<?php wp_reset_query();
		$args = array(
			'post_type' => 'daily-video',
				'showposts'=>'1'
		);
		$video = new WP_Query( $args );
		if($video->have_posts() ) {
			while($video->have_posts() ) {
				$video->the_post();
				?>
					
					<div class="video-player">
					
						<?php the_content();
							
							$the_video_output = getFeaturedVideo($post->ID);
							echo $the_video_output;
							
							?>
					</div>
				<?php
			}
		}
		else {
			echo 'Oh ohm no products!';
		}
	?>
	</div>
	<div  class="col-md-4 img-slider">
	<div id="img-slider">
	<?php echo wptuts_slider_template(); ?>
   </div>
	</div>
	</div>
	
	<div  class="row">
	    
		<?php echo wp_reset_query();query_posts(array('post__not_in' => $ids,'posts_per_page'=>2)); ?>
		

<?php $post_counter = 0;
while ( have_posts() ) : the_post() ?>
	<?php $post_counter++;  ?>
	<div class="col-md-6">
	<div class="post"> 
	
	<div class="post-thumbnail-img">
    <?php the_post_thumbnail("post-Image");?>
    </div>
	<div class="post-contents">
	<div class="post-title"><?php the_title();?> </div>
	<div class="post-text"><p>
	<?php the_excerpt(); ?></p></div>
	</div>
	<div class="col-md-3 col-md-offset-9 read-more">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><button type="button" class="btn btn-primary read-more">Read More</button></a>
	</div>
	
	</div>
	</div>
	<?php endwhile; ?>
	</div>
		</div><!-- #content -->
	</div><!-- #primary -->
	
</div><!-- #main-content -->

<?php

get_footer();
