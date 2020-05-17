<div class="categories mt-5">
	<!-- <div class="js-filter-item text-xl"><a href="<//?php echo home_url(); ?>">All</a></div> -->
			<?php
				$cat_args = array(
					'exclude' => array(1),
					'option_all' => 'All'
				);

				$categories = get_categories($cat_args); ?>

			<div class="flex">
				<?php foreach ($categories as $cat) : ?>

				<h3 class="js-filter-item mr-5">
					<a data-category="<?php echo $cat->term_id ?>" href="<?php echo get_category_link( $cat->term_id ); ?>"><?php echo $cat->name; ?></a>
				</h3>
				<?php endforeach; ?>
			</div>
	</div>

	<div class="js-filter">
		<div class="grid-cols-1 lg:grid lg:grid-cols-4 gap-4 h-100 mt-5">
			<?php
				$args = array(
					'post_type' => 'book',
					'posts_per_page' => 4
				);

				$aj_query = new WP_Query($args);

				if($aj_query->have_posts()) :

					while($aj_query->have_posts()) : $aj_query->the_post(); ?>

						<div class="book-wrapper flex flex-col py-3 lg:p-0">
							<?php the_post_thumbnail(); ?>
							<?php the_title('<h3>', '</h3>'); ?>
							<?php the_content(); ?>
						</div>

				<?php
				endwhile;
				endif;
				wp_reset_postdata();
			?>
		</div>
	</div>

</div>




