<?php the_post_thumbnail(); ?>
<h3><a class="block mt-2" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
<span class="block flex-grow"><?php the_content(); ?></span>
<div class="post-meta-wrapper mt-3">
    <small>Posted on: <?php echo date('m-d-Y'); ?>&nbsp;<?php the_time('g:i a'); ?> by: <?php the_author(); ?></small><br>
    <small class="category-span">Category(s): <?php the_category(' ') ?></small>
</div>
