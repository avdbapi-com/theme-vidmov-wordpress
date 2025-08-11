            <?php
            if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('footer')) {
                get_template_part(apply_filters('beeteam368_footer_template_file', 'template-parts/footer/footer'));
            } ?>
        </div>

    <?php wp_footer(); ?>

    </body>
</html>