<?php
$post_id = get_the_ID();
?>
<article <?php do_action('beeteam368_article_element_id', $post_id)?> <?php post_class('post-item site__col flex-row-control'); ?>>
    <div class="post-item-wrap">

        <?php beeteam368_post_thumbnail($post_id, apply_filters('beeteam368_post_thumbnail_params', array('size' => 'beeteam368_thumb_2x3_0x', 'ratio' => 'img-2x3', 'position' => 'archive-layout-rose', 'html' => 'full'), $post_id));?>
        <?php do_action('beeteam368_post_listing_top_meta', $post_id, apply_filters('beeteam368_post_listing_top_meta_params', array('style' => 'rose', 'position' => 'archive-layout-rose', 'show_author' => false, 'show_categories' => false,), $post_id)); ?>

    </div>
</article>