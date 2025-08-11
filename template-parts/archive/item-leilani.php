<?php
$post_id = get_the_ID();
?>
<article <?php do_action('beeteam368_article_element_id', $post_id)?> <?php post_class('post-item site__col'); ?> <?php echo apply_filters('beeteam368_post_id_article_control_data', '', $post_id, array('style' => 'leilani', 'position' => 'archive-layout-leilani') );?>>
    <div class="post-item-wrap flex-row-control flex-vertical-middle">

        <?php beeteam368_post_thumbnail($post_id, apply_filters('beeteam368_post_thumbnail_params', array('size' => 'beeteam368_thumb_4x3_1x', 'ratio' => 'img-4x3', 'position' => 'archive-layout-leilani', 'html' => 'full'), $post_id));?>

        <div class="post-content-wrap">
            <?php do_action('beeteam368_post_listing_header', $post_id, apply_filters('beeteam368_post_listing_header_params', array('style' => 'leilani', 'position' => 'archive-layout-leilani'), $post_id)); ?>

            <?php do_action('beeteam368_post_listing_top_meta', $post_id, apply_filters('beeteam368_post_listing_top_meta_params', array('style' => 'leilani', 'position' => 'archive-layout-leilani', 'show_author' => false,), $post_id)); ?>

            <?php do_action('beeteam368_post_listing_title', $post_id, apply_filters('beeteam368_post_listing_title_params', array('style' => 'leilani', 'heading' => 'h3', 'heading_class' => 'h4', 'position' => 'archive-layout-leilani'), $post_id)); ?>

            <?php do_action('beeteam368_post_listing_excerpt', $post_id, apply_filters('beeteam368_post_listing_excerpt_params', array('style' => 'leilani', 'position' => 'archive-layout-leilani'), $post_id)); ?>
        </div>

        <?php do_action('beeteam368_post_listing_footer', $post_id, apply_filters('beeteam368_post_listing_footer_params', array('style' => 'leilani', 'position' => 'archive-layout-leilani', 'class' => '', 'reaction_count' => 3), $post_id)); ?>

    </div>
</article>
<div class="break-line"></div>