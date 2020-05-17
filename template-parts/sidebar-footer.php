<div id="sidebar-footer" class="sidebar h-20 flex flex-col justify-center items-center w-full bg-gray-200">
    <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-2' ); ?>
    <?php else : ?>
        <p>Secondary Widget Area</p>
    <?php endif; ?>
</div>
