<?php
get_header();
global $wp_query;
$beeteam368_st_custom_class = apply_filters('beeteam368_st_custom_class_index', '');
?>
    <div id="beeteam368-primary-cw" class="beeteam368-primary-cw<?php echo esc_attr($beeteam368_st_custom_class); ?>">
        <div class="<?php echo esc_attr(beeteam368_container_classes_control('index')); ?>">
            <div id="sidebar-direction" class="site__row flex-row-control sidebar-direction">
                <main id="main-content" class="site__col main-content">

                    <?php
                    $beeteam368_archive_style = beeteam368_archive_style();
                    do_action('beeteam368_before_index', $beeteam368_archive_style);
                    if (have_posts()):
						do_action('beeteam368_before_index_have_posts', $beeteam368_archive_style);
                        ?>
                        <div id="beeteam368_main-index-page" class="blog-wrapper global-blog-wrapper blog-wrapper-control flex-row-control site__row blog-style-<?php echo esc_attr($beeteam368_archive_style); ?>">
                            <?php
                            while (have_posts()) :
                                the_post();
                                get_template_part('template-parts/archive/item', $beeteam368_archive_style);
                            endwhile;
                            ?>
                        </div>

                        <?php do_action('beeteam368_pagination', 'template-parts/archive/item', $beeteam368_archive_style, NULL, NULL, array('append_id'=>'#beeteam368_main-index-page', 'total_pages' => $wp_query->max_num_pages, 'query_id' => '')); ?>

                    <?php
						do_action('beeteam368_after_index_have_posts', $beeteam368_archive_style);
                    else :
                        get_template_part('template-parts/archive/item', 'none');
                    endif;
                    do_action('beeteam368_after_index', $beeteam368_archive_style);
                    ?>

                </main>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php
get_footer();