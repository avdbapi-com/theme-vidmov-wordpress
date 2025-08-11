<?php
do_action('beeteam368_before_side_menu_sidebar');
if ( is_active_sidebar( 'sidemenu-sidebar' ) ) : ?>
    <div class="sidemenu-sidebar side-row">
        <?php dynamic_sidebar( 'sidemenu-sidebar' ); ?>
    </div>
<?php
endif;
do_action('beeteam368_after_side_menu_sidebar');
?>