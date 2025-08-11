<?php
$post_id = get_the_ID();
?>
<article <?php do_action('beeteam368_article_element_id', $post_id)?> <?php post_class('post-item site__col'); ?> <?php echo apply_filters('beeteam368_post_id_article_control_data', '', $post_id, array('style' => 'default', 'position' => 'archive-layout-default') );?>>
    <div class="post-item-wrap">

        <?php do_action('beeteam368_post_listing_header', $post_id, apply_filters('beeteam368_post_listing_header_params', array('style' => 'default', 'position' => 'archive-layout-default'), $post_id)); ?>

        <?php beeteam368_post_thumbnail($post_id, apply_filters('beeteam368_post_thumbnail_params', array('size' => 'beeteam368_thumb_16x9_2x', 'ratio' => 'img-16x9', 'position' => 'archive-layout-default', 'html' => 'full'), $post_id));?>

        <?php do_action('beeteam368_post_listing_top_meta', $post_id, apply_filters('beeteam368_post_listing_top_meta_params', array('style' => 'default', 'position' => 'archive-layout-default', 'show_author' => false,), $post_id)); ?>

        <?php do_action('beeteam368_post_listing_title', $post_id, apply_filters('beeteam368_post_listing_title_params', array('style' => 'default', 'heading' => 'h3', 'heading_class' => 'h1 h4-mobile', 'position' => 'archive-layout-default'), $post_id)); ?>

        <?php do_action('beeteam368_post_listing_excerpt', $post_id, apply_filters('beeteam368_post_listing_excerpt_params', array('style' => 'default', 'position' => 'archive-layout-default'), $post_id)); ?>

        <?php do_action('beeteam368_post_listing_footer', $post_id, apply_filters('beeteam368_post_listing_footer_params', array('style' => 'default', 'position' => 'archive-layout-default', 'class' => '', 'reaction_count' => 3), $post_id)); ?>

    </div>
</article>
<div class="break-line"></div>