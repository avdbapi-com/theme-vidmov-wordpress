<footer id="site-footer" class="site-footer">
    <?php if ( is_active_sidebar( 'footer-sidebar' ) ) : ?>
        <div class="footer-sidebar">
            <div class="<?php echo esc_attr(beeteam368_container_classes_control('footer_sidebar')); ?>">
                <div class="site__row flex-row-control footer-sidebar-row">
                    <?php dynamic_sidebar( 'footer-sidebar' ); ?>
                </div>
            </div>
        </div>
    <?php
    endif;

    $_footer_copyright = trim(beeteam368_get_redux_option('_footer_copyright', ''));
    ?>
    <div class="footer-copyright">
        <div class="<?php echo esc_attr(beeteam368_container_classes_control('footer_copyright')); ?>">
            <div class="site__row">
                <div class="site__col">
                    <?php
                    if ($_footer_copyright != '') {
                        echo wp_kses_post($_footer_copyright);
                    } else {
						$year = date('Y');
                        echo sprintf(esc_html__('Copyright &copy; %d. Created by BeeTeam368. Powered by WordPress.', 'vidmov'), $year);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>