<?php
// AJAX render page layout
// This file is Included in the 'functions.php' file

add_action('wp_ajax_nopriv_filter', 'filter_ajax');
add_action('wp_ajax_filter', 'filter_ajax');

function filter_ajax() {

	$category = $_POST['category'];

	$args = array(
		'post_type' 	 => 'book',
		'posts_per_page' => -1
	);

	if(isset($category)) {
		$args['category__in'] = array($category);
	}

	$aj_query = new WP_Query($args); ?>

<div class="grid-cols-1 lg:grid lg:grid-cols-4 gap-4 h-100 mt-4">
	<?php
	if($aj_query->have_posts()) :

		while($aj_query->have_posts()) : $aj_query->the_post(); ?>

			<div class="book-wrapper flex flex-col py-3 lg:p-0">
				<?php the_post_thumbnail(); ?>
				<h3><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php the_content(); ?>
			</div>

	<?php
	endwhile;
	endif;
	wp_reset_postdata();

	die(); ?>
	</div>
<?php } ?>
