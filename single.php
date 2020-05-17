<?php
/**
 * The template for displaying all single posts and attachments
 *
 */

get_header(); ?>

    <div id="primary" class="content-area container mx-auto px-2 pb-10">
        <main id="main" class="site-main" role="main">

        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */

			//get_template_part( 'template-parts/content', get_post_format() );
			?>

			<?php get_template_part( 'template-parts/content', get_post_format() ) ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
				comments_template( '/custom-comments.php' );
			?>

			<?php endif; ?>

			<?php
            // Previous/next post navigation.
            the_post_navigation( array(
                'next_text' => '<span class="post-title">%title <i class="fas fa-angle-right"></i></span>',
				'prev_text' => '<span class="post-title"><i class="fas fa-angle-left"></i> %title</span>',
				'screen_reader_text' => __( 'Continue Reading' ),
			));

			// End the loop.
			endwhile;
        ?>
        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php get_footer(); ?>
