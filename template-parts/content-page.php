<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php do_action('beeteam368_before_content_page');?>

    <header class="entry-header single-page-title">
        <?php the_title('<h1 class="entry-title h1-single">', '</h1>');?>
    </header>

    <div class="entry-content"><?php the_content(); wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'vidmov'), 'after' => '</div>'));?></div>

    <?php do_action('beeteam368_after_content_page');?>

</article>