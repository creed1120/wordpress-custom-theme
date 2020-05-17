<?php get_header(); ?>

	<div class="container mx-auto px-2 flex flex-wrap">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
			$thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ) );
			$thumbnail_url = $thumbnail_data;
		?>

		<div class="w-full lg:w-1/2 h-100 px-2 mb-4">
			<div class="w-full h-full lg:max-w-full lg:flex mb-5">
				<div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('<?php echo $thumbnail_url[0] ?>')" title="Woman holding a mug">
				</div>
				<div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal w-full">
					<div class="mb-8">
						<div class="text-gray-900 font-bold text-xl mb-2 uppercase"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
						<p class="text-gray-700 text-base"><?php $permalink_url = get_the_permalink(); echo wp_trim_words( get_the_content(), 12, ' <a href="'. $permalink_url .'"><small>Read More</small></a>'); ?></p>
					</div>
					<div class="flex items-center">
					<!--img class="w-10 h-10 rounded-full mr-4" src="/img/jonathan.jpg" alt="Avatar of Jonathan Reinink"-->
					<div class="text-sm">
						<p class="text-gray-900 leading-none"><?php the_author(); ?></p>
						<p class="text-gray-600">Posted on: <?php echo date('m-d-Y'); ?>&nbsp;<?php the_time('g:i a'); ?></p><br>

						<span class="category-span"><?php the_category(' ') ?></span>

					</div>
					</div>
				</div>
			</div>
		</div>

			<?php endwhile; ?>

			<?php endif; ?>
	</div>

	<div class="container mx-auto px-5">
		<?php echo paginate_links(array(
			'prev_text' => '<i class="fas fa-angle-left"></i>',
			'next_text' => '<i class="fas fa-angle-right"></i>'
		)); ?>
	</div>

<?php get_footer(); ?>
