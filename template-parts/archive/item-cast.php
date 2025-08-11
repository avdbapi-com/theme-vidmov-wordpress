<?php
$post_id = get_the_ID();

$biography = trim(get_post_meta($post_id, BEETEAM368_PREFIX . '_biography', true));
$post_class = 'flex-vertical-middle cast-variant-item';
if($biography!=''){
	$post_class = 'flex-vertical-middle cast-variant-item full-item';
}
?>
<div <?php post_class($post_class); ?>>
	<div class="blog-img-wrapper">
    	<?php beeteam368_post_thumbnail(get_the_ID(), apply_filters('beeteam368_post_thumbnail_params', array('size' => 'beeteam368_thumb_2x3_0dot5x', 'ratio' => 'img-2x3', 'position' => 'archive-cast-and-variant-rose', 'html' => 'no-wrap'), $post_id));?>
    </div>
    <div class="cast-variant-content">
        <?php do_action('beeteam368_post_listing_title', $post_id, apply_filters('beeteam368_post_listing_title_params', array('style' => 'cast', 'heading' => 'h3', 'heading_class' => 'h6', 'position' => 'archive-cast-and-variant-rose'), $post_id)); ?>
        <?php 
		
		if($biography!=''){
		?>
        	<div class="entry-content post-excerpt">
            	<?php echo wp_kses_post($biography);?>
            </div>
        <?php	
		}else{
			do_action('beeteam368_post_listing_footer', $post_id, apply_filters('beeteam368_post_listing_footer_params', array('style' => 'cast', 'position' => 'archive-cast-and-variant-rose', 'class' => 'tiny-icons flex-row-control', 'reaction_count' => 2, 'show_comments' => false, 'show_view_details' => false, 'show_views_counter' => false), $post_id));
		}
		
		?>
    </div>
</div>