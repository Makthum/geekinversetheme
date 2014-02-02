<?php
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyfourteen' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

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
			
		</div><!-- #content -->
		</div><!-- #content -->
	</section><!-- #primary -->

<?php

get_footer();
