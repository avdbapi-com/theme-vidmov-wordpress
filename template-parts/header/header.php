<?php
$beeteam368_header_style = beeteam368_header_style();
do_action('beeteam368_before_header', $beeteam368_header_style);
$extra_class = apply_filters('beeteam368_extra_header_style_class', '', $beeteam368_header_style);
?>
    <header id="beeteam368-site-header" class="beeteam368-site-header beeteam368-site-header-control flex-row-control <?php echo esc_attr('beeteam368-h-' . $beeteam368_header_style . $extra_class) ?>">
        <?php get_template_part('template-parts/header/styles/h', $beeteam368_header_style); ?>
    </header>
<?php
do_action('beeteam368_after_header', $beeteam368_header_style);
?>