<?php
/*
Template Name: Blank Template
Template Post Type: post, page, vidmov_video, vidmov_audio
*/

get_header();

do_action('beeteam368_before_page');

    while (have_posts()):

        the_post();

        get_template_part( 'template-parts/content', 'page' );

        if ( (comments_open() || get_comments_number()!=0 ) && beeteam368_get_redux_option('single_page_comment', 'on', 'switch')=='on') :
            comments_template();
        endif;

    endwhile;

do_action('beeteam368_after_page');

get_footer();