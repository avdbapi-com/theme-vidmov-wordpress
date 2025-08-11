<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php
        wp_body_open();
        ?>

        <div class="beeteam368_color_bar beeteam368_color_loading_control"></div>

        <?php
        if (beeteam368_side_menu_control() === 'on') {
            ?>
            <div id="beeteam368-side-menu" class="beeteam368-side-menu beeteam368-side-menu-control">
                <div id="beeteam368-side-menu-body" class="beeteam368-side-menu-body">
                    <?php
                    do_action('beeteam368_side_menu_header');
                    if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('beeteam368-side-menu')) {
                        get_template_part(apply_filters('beeteam368_side_menu_template_file', 'template-parts/side-menu/side-menu'));
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>

        <div id="beeteam368-site-wrap-parent" class="beeteam368-site-wrap-parent beeteam368-site-wrap-parent-control">

            <?php
            if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('header')) {
                get_template_part(apply_filters('beeteam368_header_template_file', 'template-parts/header/header'));
            }