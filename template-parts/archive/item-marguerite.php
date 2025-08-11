<?php
$post_id = get_the_ID();
?>
<article <?php do_action('beeteam368_article_element_id', $post_id)?> <?php post_class('post-item site__col flex-row-control'); ?>>
    <div class="post-item-wrap flex-column-control">
        <?php beeteam368_post_thumbnail($post_id, apply_filters('beeteam368_post_thumbnail_params', array('size' => 'beeteam368_thumb_16x9_0x', 'ratio' => 'img-16x9', 'position' => 'archive-layout-marguerite', 'html' => 'full'), $post_id));?>

        <?php do_action('beeteam368_post_listing_top_meta', $post_id, apply_filters('beeteam368_post_listing_top_meta_params', array('style' => 'marguerite', 'position' => 'archive-layout-marguerite', 'show_published_date' => false, 'show_author' => false,), $post_id)); ?>

        <?php do_action('beeteam368_post_listing_title', $post_id, apply_filters('beeteam368_post_listing_title_params', array('style' => 'marguerite', 'heading' => 'h3', 'heading_class' => 'h5 h6-mobile', 'position' => 'archive-layout-marguerite'), $post_id)); ?>

        <?php do_action('beeteam368_post_listing_top_meta', $post_id, apply_filters('beeteam368_post_listing_top_meta_params', array('style' => 'marguerite', 'position' => 'archive-layout-marguerite', 'show_categories' => false), $post_id)); ?>

        <?php do_action('beeteam368_post_listing_footer', $post_id, apply_filters('beeteam368_post_listing_footer_params', array('style' => 'marguerite', 'position' => 'archive-layout-marguerite', 'class' => 'tiny-icons flex-row-control flex-row-center', 'reaction_count' => 1, 'show_comments' => false, 'show_view_details' => false), $post_id)); ?>
    </div>
</article>