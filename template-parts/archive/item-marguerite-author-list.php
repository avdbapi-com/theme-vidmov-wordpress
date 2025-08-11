<?php
global $beeteam368_author_looping_id;
$author_id = $beeteam368_author_looping_id;
$avatar = beeteam368_get_author_avatar($author_id, array('size' => 122));
$author_display_name = get_the_author_meta('display_name', $author_id);

$biography = trim(get_user_meta($author_id, BEETEAM368_PREFIX . '_introduce_yourself', true));

if($biography == ''){
    $biography = get_the_author_meta('description', $author_id);
}

$ext_ml_class = 'flex-vertical-top cast-variant-item';
if($biography!=''){
	$ext_ml_class = 'flex-vertical-top cast-variant-item full-item';
}
?>
<div <?php do_action('beeteam368_author_element_id', $author_id)?> class="<?php echo esc_attr($ext_ml_class);?>">
    
    <div class="blog-img-wrapper flex-row-control flex-vertical-middle flex-row-center">
        <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" class="author-avatar-wrap" title="<?php echo esc_attr($author_display_name);?>">
            <?php echo apply_filters('beeteam368_avatar_in_marguerite_author_list_loop_item', $avatar);?>
        </a>
    </div>
    <div class="cast-variant-content">
        <h3 class="entry-title post-title max-2lines h5">
            <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" class="author-avatar-name-link" title="<?php echo esc_attr($author_display_name);?>">
                <?php echo apply_filters('beeteam368_member_verification_icon', '<i class="far fa-user-circle author-verified"></i>', $author_id);?><span><?php echo esc_html($author_display_name)?></span>
            </a>
        </h3>
        <?php 
        
        if($biography!=''){
        ?>
            <div class="entry-content post-excerpt">
                <?php echo wp_kses_post($biography);?>
            </div>
        <?php	
        }        
        ?>
        <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" class="btnn-default btnn-primary small-style reverse">
            <?php echo esc_html__('Learn More', 'vidmov');?>
        </a>
    </div>
    
</div>