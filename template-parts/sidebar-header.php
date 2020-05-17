<div id="sidebar-footer" class="sidebar w-full text-white">
    <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar-3' ); ?>
    <?php else : ?>
        <p>Header Widget Area</p>
    <?php endif; ?>
</div>
