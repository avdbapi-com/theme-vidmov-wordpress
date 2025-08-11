<?php
/*
Template Name: Blank Embed Template
Template Post Type: vidmov_video, vidmov_audio
*/
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">
        <?php wp_head(); ?>
        
        <style>
			#beeteam368-site-wrap-parent,
			#beeteam368-site-wrap-parent .is-single-post-main-player{
				margin:0 !important;
				padding:0 !important;
				width:100% !important;
				max-width:none !important;
			}
		</style>
    </head>

    <body <?php body_class(); ?>>
    
        <?php wp_body_open();?>

        <div id="beeteam368-site-wrap-parent" class="beeteam368-site-wrap-parent beeteam368-site-wrap-parent-control">
			<?php
			do_action('beeteam368_before_single_primary_cw');
			do_action('beeteam368_before_single');
			?>
        </div>

    	<?php wp_footer(); ?>

    </body>
</html>