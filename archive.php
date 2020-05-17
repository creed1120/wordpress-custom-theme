<?php get_header(); ?>

    <div class="archive-page-wrapper container mx-auto pb-10">
        <header class="page-header mb-5">
            <?php
                the_archive_title(
                    '<h2 class="page-title text-xl">', '</h2>'
                );
                the_archive_description(
                    '<small class="taxonomy-description">', '</small>'
                );
            ?>
        </header>

        <?php
		if ( have_posts() ) :
			?>
			<?php
			// Start the Loop.
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that
				 * will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_pagination(
				array(
					'prev_text'          => '<span class="screen-reader-text">' . __( 'Previous page', 'nwps' ) . '</span>',
					'next_text'          => '<span class="screen-reader-text">' . __( 'Next page', 'nwps' ) . '</span>',
				)
			);

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

    </div>

<?php get_footer(); ?>
