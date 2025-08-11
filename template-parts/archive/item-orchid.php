<?php
$post_id = get_the_ID();
?>
<article <?php do_action('beeteam368_article_element_id', $post_id)?> <?php post_class('post-item site__col flex-row-control'); ?>>
    <div class="post-item-wrap flex-column-control">

        <?php beeteam368_post_thumbnail($post_id, apply_filters('beeteam368_post_thumbnail_params', array('size' => 'beeteam368_thumb_2x3_0x', 'ratio' => 'img-2x3', 'position' => 'archive-layout-orchid', 'html' => 'full'), $post_id));?>        
        <?php do_action('beeteam368_post_listing_top_meta', $post_id, apply_filters('beeteam368_post_listing_top_meta_params', array('style' => 'orchid', 'position' => 'archive-layout-orchid', 'show_author' => false, 'show_categories' => true, 'show_published_date' => false), $post_id)); ?>
        <?php do_action('beeteam368_post_listing_title', $post_id, apply_filters('beeteam368_post_listing_title_params', array('style' => 'orchid', 'heading' => 'h3', 'heading_class' => 'h5 h6-mobile', 'position' => 'archive-layout-orchid'), $post_id)); ?>
        <?php do_action('beeteam368_post_listing_top_meta', $post_id, apply_filters('beeteam368_post_listing_top_meta_params', array('style' => 'orchid', 'position' => 'archive-layout-orchid', 'show_author' => false, 'show_categories' => false,), $post_id)); ?>
		<?php do_action('beeteam368_post_listing_footer', $post_id, apply_filters('beeteam368_post_listing_footer_params', array('style' => 'orchid', 'position' => 'archive-layout-orchid', 'class' => 'tiny-icons flex-row-control', 'reaction_count' => 1, 'show_comments' => false, 'show_view_details' => false, 'show_views_counter' => true), $post_id)); ?>
        
    </div>
</article>