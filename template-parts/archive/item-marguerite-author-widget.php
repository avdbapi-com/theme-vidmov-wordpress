<?php
global $beeteam368_author_looping_id;
$author_id = $beeteam368_author_looping_id;
$avatar = beeteam368_get_author_avatar($author_id, array('size' => 61));
$author_display_name = get_the_author_meta('display_name', $author_id);

global $beeteam368_author_query_order_id;
?>
<article <?php do_action('beeteam368_author_element_id', $author_id)?> class="post-item site__col flex-row-control">
    <div class="post-item-wrap">                            
        
        <div class="author-wrapper flex-row-control flex-vertical-middle">

            <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" class="author-avatar-wrap" title="<?php echo esc_attr($author_display_name);?>">
                <?php echo apply_filters('beeteam368_avatar_in_marguerite_widget_loop_item', $avatar);?>
            </a>

            <div class="author-avatar-name-wrap">
                <h4 class="h5 author-avatar-name max-1line">
                    <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" class="author-avatar-name-link" title="<?php echo esc_attr($author_display_name);?>">
                        <?php echo apply_filters('beeteam368_member_verification_icon', '<i class="far fa-user-circle author-verified"></i>', $author_id);?><span><?php echo esc_html($author_display_name)?></span>
                    </a>
                </h4>
				
                
                <?php 
				if($beeteam368_author_query_order_id == 'most_subscriptions'){
					do_action('beeteam368_subscribers_count', $author_id);
					do_action('beeteam368_joind_date_element', $author_id);
				}
				
				if($beeteam368_author_query_order_id == 'highest_reaction_score'){
					do_action('beeteam368_reaction_score_listing', $author_id);
				}
				?>
                 
            </div>
              
        </div>
       
    </div>
</article>