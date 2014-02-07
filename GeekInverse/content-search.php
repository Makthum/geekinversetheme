
<div class="search-entry" >
<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

<?php if ( has_post_thumbnail() ) : ?>

    <div class="search-thumbnail">

        <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('post-Image'); ?></a>

    </div><!--.search-thumbnail-->

<?php endif; ?>

    <div class="search-details">

        <h5><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><span class="search-post-title"> <?php the_title(); ?></span></a></h5>

        <div class="search-post-excerpt">

            <?php the_excerpt(); ?>

        </div><!--.search-post-excerpt-->

    </div><!--/.search-entry-details --> 

</article><!--/.search-entry-->
</div>
