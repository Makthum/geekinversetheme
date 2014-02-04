<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>
	<div class="container-fluid">
	
	<section id="primary">
		<div id="content" class="site-content" role="main">
		
			<?php if ( have_posts() ) : ?>

			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Category Archives: %s', 'twentyfourteen' ), single_cat_title( '', false ) ); ?></h1>

				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .archive-header -->
			<div id="masonry-wrapper">
	<div id="masonry-loop">
			<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();?>
					<!--div class="col-md-3 cat-post"-->
					
					<?php get_template_part( 'content', 'masonary');?>
					<!--/div-->
					<?php endwhile;
					// Previous/next page navigation.
					twentyfourteen_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>
			</div>
		</div><!-- #content -->
	</section><!-- #primary -->
	</div>
	</div>
<?php

get_footer();
