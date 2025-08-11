<?php
get_header();
	$beeteam368_st_custom_class = apply_filters('beeteam368_st_custom_class_page', '');
	do_action('beeteam368_before_page_primary_cw');
?>
    <div id="beeteam368-primary-cw" class="beeteam368-primary-cw<?php echo esc_attr($beeteam368_st_custom_class); ?>">
        <div class="<?php echo esc_attr(beeteam368_container_classes_control('page')); ?>">
            <div id="sidebar-direction" class="site__row flex-row-control sidebar-direction">
                <main id="main-content" class="site__col main-content global-post-page-content">
                    <?php 
					do_action('beeteam368_before_page');
					
					global $beetam368_not_show_default_page_content;
					if($beetam368_not_show_default_page_content !== 'off'){
						while (have_posts()):
	
							the_post();
	
							get_template_part( 'template-parts/content', 'page' );
	
							if ( (comments_open() || get_comments_number()!=0 ) && beeteam368_get_redux_option('single_page_comment', 'on', 'switch')=='on') :
								comments_template();
							endif;
	
						endwhile;
					}
                    
					do_action('beeteam368_after_page');
					?>
                </main>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php
	do_action('beeteam368_after_page_primary_cw');
get_footer();