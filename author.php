<?php
get_header();
global $wp_query;

$beeteam368_st_custom_class = apply_filters('beeteam368_st_custom_class_author', '');

$author_id = isset($wp_query->query_vars['author']) ? $wp_query->query_vars['author']:-1;
$avatar = beeteam368_get_author_avatar($author_id, array('size' => 61));
$author_display_name = get_the_author_meta('display_name', $author_id);
$author_description = trim(get_the_author_meta('description', $author_id));
	do_action('beeteam368_before_author_primary_cw');
?>
	
    <div class="<?php echo esc_attr(beeteam368_container_classes_control('author-header-element')); ?> author-header-element">
        <div class="site__row flex-row-control">
            <div class="site__col">
            
               <div class="beeteam368-single-author mobile-center flex-row-control flex-vertical-middle">

                    <div class="author-wrapper flex-row-control flex-vertical-middle">
        
                        <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" class="author-avatar-wrap" title="<?php echo esc_attr($author_display_name);?>">
                            <?php echo apply_filters('beeteam368_avatar_in_author_page', $avatar);?>
                        </a>
        
                        <div class="author-avatar-name-wrap">
                            <h4 class="author-avatar-name max-1line">
                                <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" class="author-avatar-name-link" title="<?php echo esc_attr($author_display_name);?>">
                                    <?php echo apply_filters('beeteam368_member_verification_icon', '<i class="far fa-user-circle author-verified"></i>', $author_id);?><span><?php echo esc_html($author_display_name)?></span>
                                </a>
                            </h4>
        
                            <?php do_action('beeteam368_subscribers_count', $author_id);?>
                            <?php do_action('beeteam368_joind_date_element', $author_id);?>
        
                        </div>
                    </div>
                    
                    <?php
					$html = '';
					ob_start();
						do_action('beeteam368_subscribe_button', $author_id, -1);
						do_action('beeteam368_virtual_gifts_button', $author_id, -1);
						$html = trim(ob_get_contents());
					ob_end_clean();
					
					echo apply_filters('beeteam368_author_right_in_channel', $html, $author_id);

                    global $beetam368_show_author_description;
                    if(($author_description!='' && $beetam368_show_author_description!=='off') || $html == ''){
                    ?>
                        <div class="author-description">
                            <?php echo apply_filters('beeteam368_author_description', esc_html($author_description), $author_id);?>
                        </div>
                    <?php
                    }
                    ?>
                        
                </div>
                
            </div>
        </div>
    </div>
    
    <div id="beeteam368-primary-cw" class="beeteam368-primary-cw<?php echo esc_attr($beeteam368_st_custom_class); ?>">
        <div class="<?php echo esc_attr(beeteam368_container_classes_control('author')); ?>">
            <div id="sidebar-direction" class="site__row flex-row-control sidebar-direction">
                <main id="main-content" class="site__col main-content">
                
                	<?php
                    $beeteam368_archive_style = beeteam368_archive_style();
                    do_action('beeteam368_before_author', $beeteam368_archive_style);
					
					global $beetam368_not_show_default_author_loop;
					if($beetam368_not_show_default_author_loop !== 'off'){
					
						if (have_posts()):	
						
							do_action('beeteam368_before_author_have_posts', $beeteam368_archive_style);
						?>
							<div id="beeteam368_main-author-page" class="blog-wrapper global-blog-wrapper blog-wrapper-control flex-row-control site__row blog-style-<?php echo esc_attr($beeteam368_archive_style); ?>">
								<?php
								while (have_posts()) :
									the_post();
									get_template_part('template-parts/archive/item', $beeteam368_archive_style);
								endwhile;
								?>
							</div>
	
							<?php 
							do_action('beeteam368_pagination', 'template-parts/archive/item', $beeteam368_archive_style, NULL, NULL, array('append_id'=>'#beeteam368_main-author-page', 'total_pages' => $wp_query->max_num_pages, 'query_id' => '')); 
							
							do_action('beeteam368_after_author_have_posts', $beeteam368_archive_style);
							?>
	
						<?php
						else :
							get_template_part('template-parts/archive/item', 'none');
						endif;
					}
					
                    do_action('beeteam368_after_author', $beeteam368_archive_style);
                    ?>
                
                </main>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
<?php
	do_action('beeteam368_after_author_primary_cw');
get_footer();