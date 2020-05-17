<?php get_header(); ?>

    <span class="block mb-4 flex items-center text-center">
        <?php get_template_part('template-parts/sidebar', 'header'); ?>
    </span>

    <div class="container mx-auto px-2">
		<h1 class="mt-10">Featured Items</h1>
		<hr>

		<div class="grid-cols-1 lg:grid lg:grid-cols-3 gap-4 h-100 mt-4">
			<?php
				$args = array(
					'post_type'		 => 'post',
					'posts_per_page' => 3,
					'category__in'	=> array( 4, 5, 6 ),
					'category__not_in' => array( 1 )
					// 'category_name'	 => 'marketing',
				);
			$lastBlog = new WP_Query($args);
			if ( $lastBlog->have_posts() ) : while ( $lastBlog->have_posts() ) : $lastBlog->the_post(); ?>

                    <div class="book-wrapper flex flex-col py-3 lg:p-0">
                        <?php get_template_part( 'template-parts/content', 'featured' ) ?>
                    </div>

             <?php endwhile; ?>
				<!-- End of the main loop -->
				<?php wp_reset_postdata(); ?>
            <?php else : ?>
                <?php _e('Sorry, no posts matched your criteria.'); ?>
			<?php endif; ?>
		</div>

		<br>

		<h1 class="mt-10">CPT Books</h1>
		<hr>
		<?php get_template_part( 'template-parts/content', 'ajax' ) ?>

		<nav class="pag-links my-5 text-xl">
			<?php
				echo paginate_links( array(
					'current'	=> max( 1, get_query_var('page') ),
					'total' 	=> $books->max_num_pages,
					'prev_text' => '<i class="fas fa-angle-left"></i>',
					'next_text' => '<i class="fas fa-angle-right"></i>'
				));
			?>
		</nav>

    </div>

<?php get_footer(); ?>
