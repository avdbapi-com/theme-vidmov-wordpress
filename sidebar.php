<?php
$beeteam368_sidebar_control = beeteam368_sidebar_control();
if ($beeteam368_sidebar_control == 'hidden') {
    return;
}
do_action('beeteam368_before_main_sidebar');
if(function_exists('is_woocommerce') && is_woocommerce()){
	if(is_active_sidebar('woocommerce-sidebar')){
	?>
        <aside id="main-sidebar" class="site__col main-sidebar woo-sidebar">
            <div class="sidebar-content">
                <?php dynamic_sidebar('woocommerce-sidebar'); ?>
            </div>
        </aside>
    <?php
	}
}elseif(function_exists('is_buddypress') && is_buddypress()){
    if(is_active_sidebar('buddypress-sidebar')){
	?>
        <aside id="main-sidebar" class="site__col main-sidebar buddypress-sidebar">
            <div class="sidebar-content">
                <?php dynamic_sidebar('buddypress-sidebar'); ?>
            </div>
        </aside>
    <?php
	}
}elseif(is_active_sidebar('main-sidebar')) {
    ?>
    <aside id="main-sidebar" class="site__col main-sidebar">
        <div class="sidebar-content">
            <?php dynamic_sidebar('main-sidebar'); ?>
        </div>
    </aside>
    <?php
}
do_action('beeteam368_after_main_sidebar');