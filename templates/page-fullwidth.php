<?php
/**
 *  Template Name: Fullwidth Template
 */

get_header(); ?>

	<section class="w-100 px-2 py-5 sm:flex-col lg:flex lg:flex-row">
		<div class="post-content-wrapper">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h1><?php echo the_title(); ?></h1>
				<?php get_template_part( 'template-parts/content' ); ?><br>
			<?php endwhile; endif ?>
		</div>
	</section>

<?php get_footer(); ?>
