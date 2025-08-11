<?php
$post_id = get_the_ID();
?>
<article <?php do_action('beeteam368_article_element_id', $post_id)?> <?php post_class('post-item site__col flex-row-control'); ?>>
    <div class="post-item-wrap flex-column-control">

        <?php do_action('beeteam368_post_listing_header', $post_id, apply_filters('beeteam368_post_listing_header_params', array('style' => 'alyssa', 'position' => 'archive-layout-alyssa'), $post_id)); ?>

        <?php beeteam368_post_thumbnail($post_id, apply_filters('beeteam368_post_thumbnail_params', array('size' => 'beeteam368_thumb_16x9_1x', 'ratio' => 'img-16x9', 'position' => 'archive-layout-alyssa', 'html' => 'full'), $post_id));?>

        <?php do_action('beeteam368_post_listing_top_meta', $post_id, apply_filters('beeteam368_post_listing_top_meta_params', array('style' => 'alyssa', 'position' => 'archive-layout-alyssa', 'show_author' => false,), $post_id)); ?>

        <?php do_action('beeteam368_post_listing_title', $post_id, apply_filters('beeteam368_post_listing_title_params', array('style' => 'alyssa', 'heading' => 'h3', 'heading_class' => 'h4-mobile', 'position' => 'archive-layout-alyssa'), $post_id)); ?>

        <?php do_action('beeteam368_post_listing_excerpt', $post_id, apply_filters('beeteam368_post_listing_excerpt_params', array('style' => 'alyssa', 'position' => 'archive-layout-alyssa'), $post_id)); ?>

        <?php do_action('beeteam368_post_listing_footer', $post_id, apply_filters('beeteam368_post_listing_footer_params', array('style' => 'alyssa', 'position' => 'archive-layout-alyssa', 'class' => 'tiny-icons flex-row-control', 'reaction_count' => 3, 'show_view_details' => false), $post_id)); ?>

    </div>
</article>