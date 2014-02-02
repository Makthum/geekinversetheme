<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

		</div>
		
		<div class="container-fluid">
		
		
		<div class="row site-footer">
		<footer id="colophon" >
		
	<div class="col-md-8">
		<div class="row">
		<div class="col-md-4 recent-post">
		Recent Posts
		<?php wp_get_archives( array( 'type' => 'postbypost', 'limit' => 5, 'format' => 'html' ) ); ?>
		</div>
		<div class="col-md-4">
		Featured Open Source
		</div>
		
		<div class="col-md-4">
		Featured Videos
		<?php
		$args = array(
			'post_type' => 'daily-video',
				'showposts'=>'1'
		);
$catquery =  new WP_Query( $args );
while($catquery->have_posts()) : $catquery->the_post();
?>

<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a>
</li>
<?php endwhile; ?>

		</div>
		</div>
		</div>
		<div class="col-md-4 about">
		<div class="row">
		
		<div class="col-md-7">
		<h1> GeekInverse</h1>
		Mohamed Makthum<br>

		Site Owner/ Designer/Gamer and Technology enthusiast.<br>
		
		<p><br>
		Started GeekInverse as a side project . GeekInverse would be an attempt in taking geek stuff to daily users.
		</p>
	
		</div>
		
		<div class="col-md-5 footer-logo">
		<img class="img-responsive img-circle" src=" http://localhost/wp-content/uploads/2014/01/cropped-33849605aba749efb3bef9cad833c03051f9c6e3c7f3ac80-stocklarge3.jpg">
		</img>
		
		</div>
		</div>
		
		<div class="row social-icon">
		<div class="col-md-12">
		<a href="./About"><div class="col-md-3">
		<img src="http://localhost/wp-content/uploads/2014/01/email-e1390779382585.png" class="img-responsive"></img>
		</div></a>
		
		<a href="./About"><div class="col-md-3">
		<img src="http://localhost/wp-content/uploads/2014/01/facebook500-e1390779189734.png" class="img-responsive"></img>
		</div></a>
		
		
		<a href="./About"><div class="col-md-3">
		<img src="http://localhost/wp-content/uploads/2014/01/twitter-e1390779164688.png" class="img-responsive"></img>
		</div></a>
		
		<a href="./About"><div class="col-md-3">
		<img src="http://localhost/wp-content/uploads/2014/01/googleplus-revised-e1390779217235.png" class="img-responsive"></img>
		</div></a>
		</div>
		</div>
		
		
		
		</footer><!-- #colophon -->
	</div>
	</div>
	</div><!-- #page -->


	<?php wp_footer(); ?>
</body>
</html>