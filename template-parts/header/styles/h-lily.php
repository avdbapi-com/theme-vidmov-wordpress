<?php
$beeteam368_header_style = beeteam368_header_style();
do_action('beeteam368_before_header_style', $beeteam368_header_style);
?>
    <div class="beeteam368-main-menu beeteam368-main-menu-control">
        <div class="<?php echo esc_attr(beeteam368_container_classes_control('h-lily')); ?> beeteam368-menu-container-mobile">
            <div class="site__row flex-row-control flex-vertical-middle beeteam368-main-menu-row">

                <div class="site__col auto-width beeteam368-mobile-menu-btn">
                    <?php do_action('beeteam368_mobile_main_menu_btn', 'navigation', $beeteam368_header_style, '') ?>
                </div>

                <div class="site__col auto-width beeteam368-logo">
                    <?php do_action('beeteam368_logo', $beeteam368_header_style); ?>
                </div>

                <div class="site__col auto-width beeteam368-logo-mobile">
                    <?php do_action('beeteam368_logo_mobile', $beeteam368_header_style); ?>
                </div>

                <?php do_action('beeteam368_main_nav', $beeteam368_header_style, 'site__col auto-width'); ?>

                <?php do_action('beeteam368_social_account_sub_nav', 'navigation', $beeteam368_header_style, 'site__col auto-width'); ?>

            </div>
        </div>
    </div>

    <div class="beeteam368-top-menu beeteam368-top-menu-control">
        <div class="<?php echo esc_attr(beeteam368_container_classes_control('h-lily')); ?>">
            <div class="site__row flex-row-control flex-vertical-middle flex-row-center beeteam368-top-menu-row">

                <?php do_action('beeteam368_oc_side_menu_btn', 'navigation', $beeteam368_header_style, 'site__col auto-width') ?>

                <div class="site__col auto-width beeteam368-searchbox">
                    <?php do_action('beeteam368_searchbox', 'navigation', $beeteam368_header_style, 'flex-row-center'); ?>
                </div>

                <?php do_action('beeteam368_social_account', 'navigation', $beeteam368_header_style, 'site__col auto-width'); ?>

                <?php do_action('beeteam368_social_account_sub_login_nav', 'navigation', $beeteam368_header_style, 'site__col auto-width') ?>

            </div>
        </div>
    </div>
<?php
do_action('beeteam368_after_header_style', $beeteam368_header_style);
?>