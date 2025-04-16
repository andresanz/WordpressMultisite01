<aside id="sidebar" class="sidebar">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php else : ?>
        <!-- Optional: Add a message or default content when no widgets are added -->
        <p>No widgets added yet. Go to <strong>Appearance > Widgets</strong> to add some!</p>
    <?php endif; ?>
</aside>