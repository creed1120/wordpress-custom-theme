
		<footer id="site-footer" class="w-full flex flex-col justify-center">

			<div class="container mx-auto px-2 mt-4">
				<?php get_template_part('template-parts/sidebar', 'footer'); ?>
			</div>

			<!--?php
				wp_nav_menu( array(
					'theme_location' => 'footer'
					) );
			?-->

			<span class="w-full h-20 mt-5 block flex items-center justify-center bg-gray-200">
				<p>Copyright &copy; <?php echo date('Y'); ?> All Rights Reserved</p>
			</span>

		</footer><!-- #site-footer -->

		<?php wp_footer(); ?>
	</body>
</html>
