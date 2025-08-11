<?php
get_header();
$beeteam368_st_custom_class = apply_filters('beeteam368_st_custom_class_404', '');
?>
    <div id="beeteam368-primary-cw" class="beeteam368-primary-cw<?php echo esc_attr($beeteam368_st_custom_class); ?>">
        <div class="<?php echo esc_attr(beeteam368_container_classes_control('404')); ?>">
            <div id="sidebar-direction" class="site__row flex-row-control sidebar-direction">
                <main id="main-content" class="site__col main-content">
                
                	<div class="page-404-wrapper">
						<div class="img-404">
							<?php
							$img_404 = trim(beeteam368_get_redux_option('_img_404', '', 'media_get_src'));
							if($img_404 != ''){ 
								$img = $img_404;
							}else{ 
								$img = get_template_directory_uri().'/img/404.png';
							}
							?>
							<img src="<?php echo esc_url($img);?>" alt="<?php echo esc_attr__('404', 'vidmov');?>">
						</div>
						<div class="content-404">
							<h1>
								<?php
								$content_404 = trim(beeteam368_get_redux_option('_content_404', ''));
								if($content_404 != ''){ 
									echo esc_html($content_404);
								}else{ 
									echo esc_html__('Ooops... Error', 'vidmov');
								}
								?>
							</h1>
						</div>
						<div class="button-404">
							<a href="<?php echo esc_url(home_url('/'));?>" class="btnn-default btnn-primary">
								<?php
								$button_404 = trim(beeteam368_get_redux_option('_button_404', ''));
								if($button_404 != ''){ 
									echo esc_html($button_404);
								}else{ 
									echo esc_html__('Back to homepage', 'vidmov');
								}
								?>								
							</a>
						</div>
					</div>
                    
                </main>
            </div>
        </div>
    </div>
<?php
get_footer();