<?php do_action('beeteam368_before_article_post');?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php
	$beeteam36_show_post_content_wrapper = trim(get_the_content())!=''?true:false;
	
	do_action('beeteam368_before_content_post');
	
	global $beetam368_not_show_default_title;
	if($beetam368_not_show_default_title !== 'off'){
		$beeteam368_description_type_in_single = 1;
	?>
    	<?php do_action('beeteam368_before_title_content_post');?>
    	
        <header class="entry-header single-post-title">
            <?php do_action('beeteam368_before_inner_title_content_post');?>
            <?php the_title('<h1 class="entry-title h1-single">', '</h1>');?>
            <?php do_action('beeteam368_after_inner_title_content_post');?>
        </header>
        
        <?php do_action('beeteam368_after_title_content_post');?>
        
	<?php
	}else{
		do_action('beeteam368_before_description_content_post');		
		if($beeteam36_show_post_content_wrapper){			
		?>
    		<h2 class="post-description-title"><?php echo esc_html__('Descriptions:', 'vidmov');?></h2>
    	<?php
		}
		do_action('beeteam368_after_description_content_post'); 
	}
	
	if($beeteam36_show_post_content_wrapper || isset($beeteam368_description_type_in_single)){
		?>
    	<div class="entry-content entry-content-in-single <?php echo apply_filters('beeteam368_extra_entry_content_class', '');?>"><?php the_content(); wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'vidmov'), 'after' => '</div>'));?></div>        
    	<?php 
	}
	
	do_action('beeteam368_after_content_post');
	?>

</article>

<?php do_action('beeteam368_after_article_post');?>