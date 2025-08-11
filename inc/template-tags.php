<?php
if (!function_exists('wp_body_open')) :
    function wp_body_open()
    {
        do_action('wp_body_open');
    }
endif;

if (!function_exists('beeteam368_main_nav')):
    function beeteam368_main_nav($beeteam368_header_style, $extra_class)
    {
        ?>
        <div class="beeteam368-main-nav <?php echo esc_attr($extra_class) ?>">
            <?php

            $row_css = '';
            switch ($beeteam368_header_style) {
                case 'default':
                    $row_css = ' flex-row-end';
                    break;

                case 'leilani':
                    $row_css = ' flex-row-end';
                    break;

                case 'lily':
                    $row_css = ' flex-row-end';
                    break;

                case 'poppy':
                    $row_css = ' flex-row-center';
                    break;
            }

            $row_css = apply_filters('beeteam368_nav_row_extra_class', $row_css, $beeteam368_header_style);

            if (has_nav_menu('beeteam368-MainMenu')) {
                ?>
                <ul class="flex-row-control nav-font menu-items-lyt menu-items-lyt-control<?php echo esc_attr($row_css) ?>">
                    <?php
                    $nav_menu_otps = array(
                        'theme_location' => 'beeteam368-MainMenu',
                        'container' => false,
                        'items_wrap' => '%3$s'
                    );

                    if (class_exists('beeteam368_walkernav', false)) {
                        $nav_menu_otps['walker'] = new beeteam368_walkernav();
                    }

                    wp_nav_menu($nav_menu_otps);
                    ?>
                </ul>
                <?php
            } else {
                ?>
                <ul class="flex-row-control nav-font menu-items-lyt menu-items-lyt-control<?php echo esc_attr($row_css) ?>">
                    <li>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php esc_html_e('Home', 'vidmov'); ?>
                        </a>
                    </li>
                    <?php wp_list_pages('depth=1&number=3&title_li='); ?>
                </ul>
                <?php
            }
            ?>
        </div>
        <?php
    }
endif;
add_action('beeteam368_main_nav', 'beeteam368_main_nav', 10, 2);

if (!function_exists('beeteam368_side_menu_nav')):
    function beeteam368_side_menu_nav($beeteam368_header_style)
    {
        if (beeteam368_side_menu_navigation() === 'on') {
            if (has_nav_menu('beeteam368-SideMenu')) {
                ?>
                <ul id="side-menu-navigation" class="side-row side-menu-navigation nav-font nav-font-size-13">
                    <?php
                    $nav_menu_otps = array(
                        'theme_location' => 'beeteam368-SideMenu',
                        'container' => false,
                        'items_wrap' => '%3$s'
                    );
                    wp_nav_menu($nav_menu_otps);
                    ?>
                </ul>
                <?php
            }else{
				?>
                <ul id="side-menu-navigation" class="side-row side-menu-navigation nav-font nav-font-size-13">
                    <?php wp_list_pages('depth=1&number=5&title_li='); ?>
                </ul>
                <?php
			}
        }
    }
endif;
add_action('beeteam368_side_menu_nav', 'beeteam368_side_menu_nav', 10, 1);

if (!function_exists('beeteam368_DropDownMenuLoginTop')):
    function beeteam368_DropDownMenuLoginTop($beeteam368_header_style)
    {

        if (has_nav_menu('beeteam368-DropDownLoginTop')) {
            ?>
            <ul id="login-top-menu-navigation" class="login-top-menu-navigation nav-font nav-font-size-13">
                <?php
                $nav_menu_otps = array(
                    'theme_location' => 'beeteam368-DropDownLoginTop',
                    'container' => false,
                    'items_wrap' => '%3$s'
                );
                wp_nav_menu($nav_menu_otps);
                ?>
            </ul>
            <?php
        }

    }
endif;
add_action('beeteam368_DropDownMenuLoginTop', 'beeteam368_DropDownMenuLoginTop', 10, 1);

if (!function_exists('beeteam368_DropDownMenuLoginBottom')):
    function beeteam368_DropDownMenuLoginBottom($beeteam368_header_style)
    {

        if (has_nav_menu('beeteam368-DropDownLoginBottom')) {
            ?>
            <ul id="login-bottom-menu-navigation" class="login-bottom-menu-navigation nav-font nav-font-size-13">
                <?php
                $nav_menu_otps = array(
                    'theme_location' => 'beeteam368-DropDownLoginBottom',
                    'container' => false,
                    'items_wrap' => '%3$s'
                );
                wp_nav_menu($nav_menu_otps);
                ?>
            </ul>
            <?php
        }

    }
endif;
add_action('beeteam368_DropDownMenuLoginBottom', 'beeteam368_DropDownMenuLoginBottom', 10, 1);

if (!function_exists('beeteam368_create_retina_img')) :
    function beeteam368_create_retina_img($hook_params = array()){

        $df_params = array('alt' => '', 'class' => '', 'echo' => true);
        $params = array_replace_recursive($df_params, $hook_params); //array('retina_1x' => array(), 'retina_2x' => array(), 'alt' => '', 'class' => '');

        $echo = $params['echo'];
        $class = $params['class'];

        if(!isset($params['retina_1x'])){
            return;
        }

        $src = $params['retina_1x']['src'];
        $width = $params['retina_1x']['width'];
        $height = $params['retina_1x']['height'];

        $img_src = 'src="' . esc_url($src) . '"';
        $sizes = '';
        $srcset = '';

        if(isset($params['retina_2x'])){
            $sizes = 'sizes="(max-width: ' . esc_attr($width) . 'px) 100vw, ' . esc_attr($width) . 'px"';
            $srcset = 'srcset="' . esc_url($src) . ' ' . esc_attr($width) . 'w, ' . esc_url($params['retina_2x']['src']) . ' ' . esc_attr($params['retina_2x']['width']) . 'w"';
        }

        $_lazyload = beeteam368_get_redux_option('_lazyload', 'off', 'switch');
        if($_lazyload === 'on'){
            $class .= ' lonely-lazy lazyload lazyload-effect';
            $img_src = 'src="' . esc_url(get_template_directory_uri() . '/css/images/placeholder.png') . '" data-src="' . esc_url($src) . '"';
            if(isset($params['retina_2x'])) {
                $sizes = 'data-sizes="(max-width: ' . esc_attr($width) . 'px) 100vw, ' . esc_attr($width) . 'px"';
                $srcset = 'data-srcset="' . esc_url($src) . ' ' . esc_attr($width) . 'w, ' . esc_url($params['retina_2x']['src']) . ' ' . esc_attr($params['retina_2x']['width']) . 'w"';
            }
        }

        $img_retina_html = '<img width="' .esc_attr($width). '" height="' .esc_attr($height). '" alt="' .esc_attr($params['alt']). '" ' .$img_src. ' '.$sizes.' '.$srcset.' class="' .esc_attr($class). '">';

        if($echo){
            echo apply_filters('beeteam368_retina_img', $img_retina_html, $params);
        }else{
            return apply_filters('beeteam368_retina_img', $img_retina_html, $params);
        }
    }
endif;

if (!function_exists('beeteam368_dark_mode_opt')):
	function beeteam368_dark_mode_opt(){
		$opt_dark = '';
		if(isset($_COOKIE['beeteam368_dark_mode'])){
			$beeteam368_dark_mode = $_COOKIE['beeteam368_dark_mode'] == 'true'?true:false;
			if($beeteam368_dark_mode){
				$opt_dark = '_dark';
			}
		}else{
			$_light_dark_mode = beeteam368_get_redux_option('_light_dark_mode', 'light');
			if ($_light_dark_mode === 'dark') {
				$opt_dark = '_dark';
			}	
		}
		
		return $opt_dark;
	}		
endif;

if (!function_exists('beeteam368_logo')) :
    function beeteam368_logo($beeteam368_header_style)
    {
        $logo_alt = get_bloginfo('name');
        $site_name = get_bloginfo('name');

        $_text_logo = beeteam368_get_redux_option('_text_logo', esc_html__('Logo', 'vidmov'));

        $opt_dark = beeteam368_dark_mode_opt();

        $_main_logo_id = beeteam368_get_redux_option('_main_logo'.$opt_dark, '', 'media_get_id');
        $_main_logo_retina_id = beeteam368_get_redux_option('_main_logo_retina'.$opt_dark, '', 'media_get_id');
        ?>
        <div class="beeteam368-logo-wrap">
            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($site_name); ?>"
               class="beeteam368-logo-link h1 main-logo-control">
                <?php
                if (!is_numeric($_main_logo_id) || $_main_logo_id <= 0) {
                    echo esc_html($_text_logo);
                } else {
                    $_main_logo = wp_get_attachment_image_src($_main_logo_id, 'full');
                    if ($_main_logo) {

                        $params = array('retina_1x' => array('src' => $_main_logo[0], 'width' => $_main_logo[1], 'height' => $_main_logo[2]), 'alt' => $logo_alt, 'class' => 'beeteam368-logo-img');

                        if (is_numeric($_main_logo_retina_id) && $_main_logo_retina_id > 0) {
                            $_main_logo_retina = wp_get_attachment_image_src($_main_logo_retina_id, 'full');
                            if ($_main_logo_retina) {
                                $params['retina_2x'] = array('src' => $_main_logo_retina[0], 'width' => $_main_logo_retina[1], 'height' => $_main_logo_retina[2]);
                            }
                        }

                        beeteam368_create_retina_img($params);

                    } else {
                        echo esc_html($_text_logo);
                    }
                } ?>
            </a>
        </div>
        <?php
    }
endif;
add_action('beeteam368_logo', 'beeteam368_logo', 10, 1);

if (!function_exists('beeteam368_logo_mobile')) :
    function beeteam368_logo_mobile($beeteam368_header_style)
    {
        $logo_alt = get_bloginfo('name');
        $site_name = get_bloginfo('name');

        $_text_logo = beeteam368_get_redux_option('_text_logo', esc_html__('Logo', 'vidmov'));

        $opt_dark = beeteam368_dark_mode_opt();

        $_main_logo_id = beeteam368_get_redux_option('_main_logo_mobile'.$opt_dark, '', 'media_get_id');
        $_main_logo_retina_id = beeteam368_get_redux_option('_main_logo_mobile_retina'.$opt_dark, '', 'media_get_id');
        ?>
        <div class="beeteam368-logo-wrap elm-logo-mobile">
            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($site_name); ?>"
               class="beeteam368-logo-link h1 mobile-logo-control">
                <?php
                if (!is_numeric($_main_logo_id) || $_main_logo_id <= 0) {
                    echo esc_html($_text_logo);
                } else {
                    $_main_logo = wp_get_attachment_image_src($_main_logo_id, 'full');
                    if ($_main_logo) {

                        $params = array('retina_1x' => array('src' => $_main_logo[0], 'width' => $_main_logo[1], 'height' => $_main_logo[2]), 'alt' => $logo_alt, 'class' => 'beeteam368-logo-img');

                        if (is_numeric($_main_logo_retina_id) && $_main_logo_retina_id > 0) {
                            $_main_logo_retina = wp_get_attachment_image_src($_main_logo_retina_id, 'full');
                            if ($_main_logo_retina) {
                                $params['retina_2x'] = array('src' => $_main_logo_retina[0], 'width' => $_main_logo_retina[1], 'height' => $_main_logo_retina[2]);
                            }
                        }

                        beeteam368_create_retina_img($params);

                    } else {
                        echo esc_html($_text_logo);
                    }
                } ?>
            </a>
        </div>
        <?php
    }
endif;
add_action('beeteam368_logo_mobile', 'beeteam368_logo_mobile', 10, 1);

if (!function_exists('beeteam368_logo_side')) :
    function beeteam368_logo_side($beeteam368_header_style)
    {
        $logo_alt = get_bloginfo('name');
        $site_name = get_bloginfo('name');

        $_text_logo = beeteam368_get_redux_option('_text_logo', esc_html__('Logo', 'vidmov'));

        $opt_dark = beeteam368_dark_mode_opt();

        $_main_logo_id = beeteam368_get_redux_option('_side_logo'.$opt_dark, '', 'media_get_id');
        $_main_logo_retina_id = beeteam368_get_redux_option('_side_logo_retina'.$opt_dark, '', 'media_get_id');
        ?>
        <div class="beeteam368-logo-wrap elm-logo-side">
            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($site_name); ?>"
               class="beeteam368-logo-link h6 side-logo-control">
                <?php
                if (!is_numeric($_main_logo_id) || $_main_logo_id <= 0) {
                    echo '<span class="side-top-heading">' . esc_html($_text_logo) . '</span>';
                } else {
                    $_main_logo = wp_get_attachment_image_src($_main_logo_id, 'full');
                    if ($_main_logo) {

                        $params = array('retina_1x' => array('src' => $_main_logo[0], 'width' => $_main_logo[1], 'height' => $_main_logo[2]), 'alt' => $logo_alt, 'class' => 'beeteam368-logo-img');

                        if (is_numeric($_main_logo_retina_id) && $_main_logo_retina_id > 0) {
                            $_main_logo_retina = wp_get_attachment_image_src($_main_logo_retina_id, 'full');
                            if ($_main_logo_retina) {
                                $params['retina_2x'] = array('src' => $_main_logo_retina[0], 'width' => $_main_logo_retina[1], 'height' => $_main_logo_retina[2]);
                            }
                        }

                        beeteam368_create_retina_img($params);

                    } else {
                        echo '<span class="side-top-heading">' . esc_html($_text_logo) . '</span>';
                    }
                } ?>
            </a>
        </div>
        <?php
    }
endif;
add_action('beeteam368_logo_side', 'beeteam368_logo_side', 10, 1);

if (!function_exists('beeteam368_logo_switch')) :
    function beeteam368_logo_switch($define_js_object){

        $define_js_object['logo_switch']=array();

        $logo_alt = get_bloginfo('name');
        $_text_logo = beeteam368_get_redux_option('_text_logo', esc_html__('Logo', 'vidmov'));

        $_main_logo_id = beeteam368_get_redux_option('_main_logo', '', 'media_get_id');
        $_main_logo_retina_id = beeteam368_get_redux_option('_main_logo_retina', '', 'media_get_id');
        if (is_numeric($_main_logo_id) && $_main_logo_id > 0) {
            $_main_logo = wp_get_attachment_image_src($_main_logo_id, 'full');
            if ($_main_logo) {
                $params = array('echo'=>false, 'retina_1x' => array('src' => $_main_logo[0], 'width' => $_main_logo[1], 'height' => $_main_logo[2]), 'alt' => $logo_alt, 'class' => 'beeteam368-logo-img');

                if (is_numeric($_main_logo_retina_id) && $_main_logo_retina_id > 0) {
                    $_main_logo_retina = wp_get_attachment_image_src($_main_logo_retina_id, 'full');
                    if ($_main_logo_retina) {
                        $params['retina_2x'] = array('src' => $_main_logo_retina[0], 'width' => $_main_logo_retina[1], 'height' => $_main_logo_retina[2]);
                    }
                }
                $define_js_object['logo_switch']['main_light'] = beeteam368_create_retina_img($params);
            }else{
                $define_js_object['logo_switch']['main_light'] = esc_html($_text_logo);
            }
        }else{
            $define_js_object['logo_switch']['main_light'] = esc_html($_text_logo);
        }

        $_main_logo_dark_id = beeteam368_get_redux_option('_main_logo_dark', '', 'media_get_id');
        $_main_logo_retina_dark_id = beeteam368_get_redux_option('_main_logo_retina_dark', '', 'media_get_id');
        if (is_numeric($_main_logo_dark_id) && $_main_logo_dark_id > 0) {
            $_main_logo = wp_get_attachment_image_src($_main_logo_dark_id, 'full');
            if ($_main_logo) {
                $params = array('echo'=>false, 'retina_1x' => array('src' => $_main_logo[0], 'width' => $_main_logo[1], 'height' => $_main_logo[2]), 'alt' => $logo_alt, 'class' => 'beeteam368-logo-img');

                if (is_numeric($_main_logo_retina_dark_id) && $_main_logo_retina_dark_id > 0) {
                    $_main_logo_retina = wp_get_attachment_image_src($_main_logo_retina_dark_id, 'full');
                    if ($_main_logo_retina) {
                        $params['retina_2x'] = array('src' => $_main_logo_retina[0], 'width' => $_main_logo_retina[1], 'height' => $_main_logo_retina[2]);
                    }
                }
                $define_js_object['logo_switch']['main_dark'] = beeteam368_create_retina_img($params);
            }else{
                $define_js_object['logo_switch']['main_dark'] = esc_html($_text_logo);
            }
        }else{
            $define_js_object['logo_switch']['main_dark'] = esc_html($_text_logo);
        }

        $_main_logo_id = beeteam368_get_redux_option('_main_logo_mobile', '', 'media_get_id');
        $_main_logo_retina_id = beeteam368_get_redux_option('_main_logo_mobile_retina', '', 'media_get_id');
        if (is_numeric($_main_logo_id) && $_main_logo_id > 0) {
            $_main_logo = wp_get_attachment_image_src($_main_logo_id, 'full');
            if ($_main_logo) {
                $params = array('echo'=>false, 'retina_1x' => array('src' => $_main_logo[0], 'width' => $_main_logo[1], 'height' => $_main_logo[2]), 'alt' => $logo_alt, 'class' => 'beeteam368-logo-img');

                if (is_numeric($_main_logo_retina_id) && $_main_logo_retina_id > 0) {
                    $_main_logo_retina = wp_get_attachment_image_src($_main_logo_retina_id, 'full');
                    if ($_main_logo_retina) {
                        $params['retina_2x'] = array('src' => $_main_logo_retina[0], 'width' => $_main_logo_retina[1], 'height' => $_main_logo_retina[2]);
                    }
                }
                $define_js_object['logo_switch']['mobile_light'] = beeteam368_create_retina_img($params);
            }else{
                $define_js_object['logo_switch']['mobile_light'] = esc_html($_text_logo);
            }
        }else{
            $define_js_object['logo_switch']['mobile_light'] = esc_html($_text_logo);
        }

        $_main_logo_dark_id = beeteam368_get_redux_option('_main_logo_mobile_dark', '', 'media_get_id');
        $_main_logo_retina_dark_id = beeteam368_get_redux_option('_main_logo_mobile_retina_dark', '', 'media_get_id');
        if (is_numeric($_main_logo_dark_id) && $_main_logo_dark_id > 0) {
            $_main_logo = wp_get_attachment_image_src($_main_logo_dark_id, 'full');
            if ($_main_logo) {
                $params = array('echo'=>false, 'retina_1x' => array('src' => $_main_logo[0], 'width' => $_main_logo[1], 'height' => $_main_logo[2]), 'alt' => $logo_alt, 'class' => 'beeteam368-logo-img');

                if (is_numeric($_main_logo_retina_dark_id) && $_main_logo_retina_dark_id > 0) {
                    $_main_logo_retina = wp_get_attachment_image_src($_main_logo_retina_dark_id, 'full');
                    if ($_main_logo_retina) {
                        $params['retina_2x'] = array('src' => $_main_logo_retina[0], 'width' => $_main_logo_retina[1], 'height' => $_main_logo_retina[2]);
                    }
                }
                $define_js_object['logo_switch']['mobile_dark'] = beeteam368_create_retina_img($params);
            }else{
                $define_js_object['logo_switch']['mobile_dark'] = esc_html($_text_logo);
            }
        }else{
            $define_js_object['logo_switch']['mobile_dark'] = esc_html($_text_logo);
        }

        $_main_logo_id = beeteam368_get_redux_option('_side_logo', '', 'media_get_id');
        $_main_logo_retina_id = beeteam368_get_redux_option('_side_logo_retina', '', 'media_get_id');
        if (is_numeric($_main_logo_id) && $_main_logo_id > 0) {
            $_main_logo = wp_get_attachment_image_src($_main_logo_id, 'full');
            if ($_main_logo) {
                $params = array('echo'=>false, 'retina_1x' => array('src' => $_main_logo[0], 'width' => $_main_logo[1], 'height' => $_main_logo[2]), 'alt' => $logo_alt, 'class' => 'beeteam368-logo-img');

                if (is_numeric($_main_logo_retina_id) && $_main_logo_retina_id > 0) {
                    $_main_logo_retina = wp_get_attachment_image_src($_main_logo_retina_id, 'full');
                    if ($_main_logo_retina) {
                        $params['retina_2x'] = array('src' => $_main_logo_retina[0], 'width' => $_main_logo_retina[1], 'height' => $_main_logo_retina[2]);
                    }
                }
                $define_js_object['logo_switch']['side_light'] = beeteam368_create_retina_img($params);
            }else{
                $define_js_object['logo_switch']['side_light'] = '<span class="side-top-heading">' . esc_html($_text_logo) . '</span>';
            }
        }else{
            $define_js_object['logo_switch']['side_light'] = '<span class="side-top-heading">' . esc_html($_text_logo) . '</span>';
        }

        $_main_logo_dark_id = beeteam368_get_redux_option('_side_logo_dark', '', 'media_get_id');
        $_main_logo_retina_dark_id = beeteam368_get_redux_option('_side_logo_retina_dark', '', 'media_get_id');
        if (is_numeric($_main_logo_dark_id) && $_main_logo_dark_id > 0) {
            $_main_logo = wp_get_attachment_image_src($_main_logo_dark_id, 'full');
            if ($_main_logo) {
                $params = array('echo'=>false, 'retina_1x' => array('src' => $_main_logo[0], 'width' => $_main_logo[1], 'height' => $_main_logo[2]), 'alt' => $logo_alt, 'class' => 'beeteam368-logo-img');

                if (is_numeric($_main_logo_retina_dark_id) && $_main_logo_retina_dark_id > 0) {
                    $_main_logo_retina = wp_get_attachment_image_src($_main_logo_retina_dark_id, 'full');
                    if ($_main_logo_retina) {
                        $params['retina_2x'] = array('src' => $_main_logo_retina[0], 'width' => $_main_logo_retina[1], 'height' => $_main_logo_retina[2]);
                    }
                }
                $define_js_object['logo_switch']['side_dark'] = beeteam368_create_retina_img($params);
            }else{
                $define_js_object['logo_switch']['side_dark'] = '<span class="side-top-heading">' . esc_html($_text_logo) . '</span>';
            }
        }else{
            $define_js_object['logo_switch']['side_dark'] = '<span class="side-top-heading">' . esc_html($_text_logo) . '</span>';
        }

        return $define_js_object;
    }
endif;
add_filter('beeteam368_define_js_object', 'beeteam368_logo_switch', 10, 1);

if (!function_exists('beeteam368_searchbox_default')) :
    function beeteam368_searchbox_default($position, $beeteam368_header_style, $extra_class)
    {
        ?>
        <div class="beeteam368-searchbox-wrap beeteam368-searchbox-wrap-control flex-row-control flex-vertical-middle <?php echo esc_attr($extra_class) ?>">
            <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="beeteam368-searchform">
                <input id="beeteam368-searchtext" class="beeteam368-searchtext beeteam368-searchtext-control"
                       autocomplete="off" type="text"
                       placeholder="<?php echo esc_attr__('Type and hit enter ...', 'vidmov'); ?>" name="s"
                       value="<?php echo esc_attr(get_search_query()); ?>">
                <span class="beetam368-back-focus beetam368-back-focus-control flex-row-control flex-vertical-middle flex-row-center"><i class="fas fa-arrow-left"></i></span>

                <div class="beeteam368-search-process floatingBarsG">
                    <div class="blockG rotateG_01"></div>
                    <div class="blockG rotateG_02"></div>
                    <div class="blockG rotateG_03"></div>
                    <div class="blockG rotateG_04"></div>
                    <div class="blockG rotateG_05"></div>
                    <div class="blockG rotateG_06"></div>
                    <div class="blockG rotateG_07"></div>
                    <div class="blockG rotateG_08"></div>
                </div>

                <div class="beeteam368-search-suggestions">

                    <a data-href="<?php echo esc_url(home_url('/')); ?>" href="<?php echo esc_url(add_query_arg(array('s' => get_search_query()), home_url('/'))); ?>" class="beeteam368-suggestion-item flex-row-control flex-vertical-middle beeteam368-suggestion-item-keyword-block beeteam368-suggestion-item-keyword-block-control show-block">
                        <span class="beeteam368-icon-item small-item primary-color"><i class="fas fa-search"></i></span>

                        <span class="beeteam368-suggestion-item-content search-with-keyword">
                            <span class="beeteam368-suggestion-item-title h6 h-light"><?php echo esc_html__('Search For:', 'vidmov'); ?> <span class="beeteam368-sg-keyword beeteam368-sg-keyword-control font-weight-bold">Movie should be distinctly</span></span>
                        </span>

                        <span class="beeteam368-suggestion-item-content search-with-default">
                            <span class="beeteam368-suggestion-item-title h6 font-weight-bold"><?php echo esc_html__('Please enter a search term in the search box.', 'vidmov'); ?></span>
                        </span>
                    </a>

                    <div class="beeteam368-sg-new-posts beeteam368-live-search-control">

                        <h5 class="beeteam368-sg-new-posts-heading sg-heading-default"><?php echo esc_html__('Do Not Miss', 'vidmov'); ?></h5>
                        <h5 class="beeteam368-sg-new-posts-heading sg-heading-dynamic"><?php echo esc_html__('Search Suggestions', 'vidmov'); ?></h5>

                        <?php
                        $args_query = array(
                            'post_type'				=> apply_filters('beeteam368_sg_post_type', array('post'), $position, $beeteam368_header_style),
                            'posts_per_page' 		=> apply_filters('beeteam368_sg_posts_per_page', 5, $position, $beeteam368_header_style),
                            'post_status' 			=> 'publish',
                            'ignore_sticky_posts' 	=> 1,
                            'orderby'               => 'rand',
                        );

                        $posts = get_posts($args_query);
                        if($posts) {
                            foreach ($posts as $post){
                                $post_id = $post->ID;
                                $thumb = trim(beeteam368_post_thumbnail($post_id, apply_filters('beeteam368_post_thumbnail_params', array('size' => 'thumbnail', 'ratio' => 'img-1x1', 'position' => 'search_box_suggestion', 'html' => 'img-only', 'echo' => false), $post_id)));
								
								$post_type = get_post_type_object(get_post_type($post_id));
                            ?>
                                <a href="<?php echo esc_url(beeteam368_get_post_url($post_id))?>" class="beeteam368-suggestion-item beeteam368-suggestion-item-default flex-row-control flex-vertical-middle">
                                    <span class="beeteam368-icon-item small-item"><i class="fas fa-quote-left"></i></span>
                                    <span class="beeteam368-suggestion-item-content">
                                        <span class="beeteam368-suggestion-item-title h6 h-light"><?php echo get_the_title($post_id);?></span>
                                        <span class="beeteam368-suggestion-item-tax font-size-10"><?php echo esc_html($post_type->labels->singular_name)?></span>
                                    </span>
                                    <?php
                                    if($thumb != ''){
                                    ?>
                                        <span class="beeteam368-suggestion-item-image"><?php echo apply_filters('beeteam368_thumb_in_live_search', $thumb);?></span>
                                    <?php
                                    }
                                    ?>
                                </a>
                            <?php
                            }
                        }
                        ?>

                    </div>

                </div>
            </form>
        </div>
        <?php
    }
endif;
add_action('beeteam368_searchbox', 'beeteam368_searchbox_default', 10, 3);

if (!function_exists('beeteam368_social_account')) :
    function beeteam368_social_account($position, $beeteam368_header_style, $extra_class)
    {
        ob_start();

            do_action('beeteam368_submit_icon', 'navigation', $beeteam368_header_style);            
            do_action('beeteam368_notification_icon', 'navigation', $beeteam368_header_style);
            do_action('beeteam368_watch_later_icon', 'navigation', $beeteam368_header_style);
			do_action('beeteam368_woocommerce_icon', 'navigation', $beeteam368_header_style);
			do_action('beeteam368_buyCred_nav_icon', 'navigation', $beeteam368_header_style);			
			do_action('beeteam368_membership_nav_icon', 'navigation', $beeteam368_header_style);
            do_action('beeteam368_dark_light_btn', 'navigation', $beeteam368_header_style);
            $output_string = ob_get_contents();

        ob_end_clean();

        if (trim($output_string) != '') {
            ?>
            <div class="beeteam368-social-account <?php echo esc_attr($extra_class) ?>">
                <div class="beeteam368-social-account-wrap flex-row-control flex-vertical-middle flex-row-center">
                    <?php echo apply_filters('beeteam368_social_account_template_tags', $output_string, $position, $beeteam368_header_style); ?>
                </div>
            </div>
            <?php
        }
    }
endif;
add_action('beeteam368_social_account', 'beeteam368_social_account', 10, 3);

if (!function_exists('beeteam368_social_account_sub_login_nav')) :
    function beeteam368_social_account_sub_login_nav($position, $beeteam368_header_style, $extra_class)
    {
        ob_start();

            do_action('beeteam368_login_register_icon', 'navigation', $beeteam368_header_style);
            $output_string = ob_get_contents();

        ob_end_clean();

        if (trim($output_string) != '') {
            ?>
            <div class="beeteam368-social-account-sub-login-nav <?php echo esc_attr($extra_class) ?>">
                <div class="beeteam368-social-account-wrap flex-row-control">
                    <?php echo apply_filters('beeteam368_social_account_sub_login_nav_template_tags', $output_string, $position, $beeteam368_header_style); ?>
                </div>
            </div>
            <?php
        }
    }
endif;
add_action('beeteam368_social_account_sub_login_nav', 'beeteam368_social_account_sub_login_nav', 10, 3);

if (!function_exists('beeteam368_social_account_sub_total_posts')) :
	function beeteam368_social_account_sub_total_posts($position, $beeteam368_header_style){
	?>
    	<div class="beeteam368-icon-item beeteam368-i-total-posts tooltip-style left-item">
            <i class="fas fa-chart-bar"></i>
            <span class="tooltip-text"><?php echo esc_html__('Total Posts: ', 'vidmov').apply_filters('beeteam368_number_format', wp_count_posts()->publish)?></span>
        </div>
    <?php	
	}
endif;

add_action('beeteam368_login_register_icon', 'beeteam368_social_account_sub_total_posts', 9, 2);

if (!function_exists('beeteam368_social_account_sub_nav')) :
    function beeteam368_social_account_sub_nav($position, $beeteam368_header_style, $extra_class)
    {
        ob_start();

            do_action('beeteam368_dark_light_btn', 'navigation', $beeteam368_header_style);
            $output_string = ob_get_contents();

        ob_end_clean();

        if (trim($output_string) != '') {
            ?>
            <div class="beeteam368-social-account-sub-nav <?php echo esc_attr($extra_class) ?>">
                <div class="beeteam368-social-account-wrap flex-row-control">
                    <?php echo apply_filters('beeteam368_social_account_sub_nav_template_tags', $output_string, $position, $beeteam368_header_style); ?>
                </div>
            </div>
            <?php
        }
    }
endif;
add_action('beeteam368_social_account_sub_nav', 'beeteam368_social_account_sub_nav', 10, 3);

if (!function_exists('beeteam368_dark_light_btn')) :
    function beeteam368_dark_light_btn($position, $beeteam368_header_style)
    {
        $_light_dark_btn = beeteam368_get_redux_option('_light_dark_btn', 'on', 'switch');
        if ($_light_dark_btn == 'on') {
            ?>
            <div class="beeteam368-icon-item beeteam368-dark-light-btn beeteam368-i-dark-light-btn-control">
                <span class="light-bg-layer"></span>
                <span class="dark-bg-layer"></span>
                <span class="light-layer"><i class="fas fa-sun"></i></span>
                <span class="dark-layer"><i class="far fa-sun"></i></span>
            </div>
            <?php
        }
    }
endif;
add_action('beeteam368_dark_light_btn', 'beeteam368_dark_light_btn', 10, 2);

if (!function_exists('beeteam368_oc_side_menu_btn')) :
    function beeteam368_oc_side_menu_btn($position, $beeteam368_header_style, $extra_class)
    {
        if (beeteam368_side_menu_control() === 'on') {
            ?>
            <div class="beeteam368-sidemenu-btn <?php echo esc_attr($extra_class) ?>">
                <div class="oc-btn oc-btn-control">
                    <div class="bar top"></div>
                    <div class="bar middle"></div>
                    <div class="bar bottom"></div>
                </div>
            </div>
            <?php
        }
    }
endif;
add_action('beeteam368_oc_side_menu_btn', 'beeteam368_oc_side_menu_btn', 10, 3);

if (!function_exists('beeteam368_mobile_main_menu_btn')) :
    function beeteam368_mobile_main_menu_btn($position, $beeteam368_header_style, $extra_class)
    {
        ?>
        <div class="oc-mb-mn-btn oc-mb-mn-btn-control <?php echo esc_attr($extra_class) ?>">
            <div class="bar top"></div>
            <div class="bar middle"></div>
            <div class="bar bottom"></div>
        </div>
        <?php
    }
endif;
add_action('beeteam368_mobile_main_menu_btn', 'beeteam368_mobile_main_menu_btn', 10, 3);

if (!function_exists('beeteam368_top_middle_content')):
    function beeteam368_top_middle_content($beeteam368_header_style)
    {
		$_header_banner_id = beeteam368_get_redux_option('_header_banner', '', 'media_get_id');       
        if (is_numeric($_header_banner_id) && $_header_banner_id > 0) {
            $_header_banner = wp_get_attachment_image_src($_header_banner_id, 'full');			
            if($_header_banner){
				$_header_banner_url = trim(beeteam368_get_redux_option('_header_banner_url', ''));
				$logo_alt = get_bloginfo('name');
				?>
                <div class="flex-row-control flex-row-end">
					<?php
                    if($_header_banner_url!=''){
                    ?>
                    	<a href="<?php echo esc_url($_header_banner_url);?>" target="_blank" title="<?php echo esc_attr($logo_alt);?>">
                        	<img src="<?php echo esc_url($_header_banner[0]);?>" alt="<?php echo esc_attr($logo_alt);?>" width="728" height="90">
                        </a>
                    <?php
                    }else{
                    ?>
                        <img src="<?php echo esc_url($_header_banner[0]);?>" alt="<?php echo esc_attr($logo_alt);?>" width="728" height="90">
                    <?php	
                    }
                    ?>
                </div>
				<?php
				
            }
        }
    }
endif;
add_action('beeteam368_top_middle_content', 'beeteam368_top_middle_content', 10, 1);

if (!function_exists('beeteam368_top_middle_posts')):
    function beeteam368_top_middle_posts($beeteam368_header_style)
    {
		$recent_posts = wp_get_recent_posts(array(
			'numberposts' => 1,
			'post_status' => 'publish'
		));
		if($recent_posts){			
        ?>
            <div class="flex-row-control flex-row-end">
            	<?php foreach( $recent_posts as $post_item ) :?>
                    <h3 class="h6 h-light max-1line">
                        <a href="<?php echo esc_url(beeteam368_get_post_url($post_item['ID']));?>" title="<?php echo esc_attr(get_the_title($post_item['ID']));?>" target="_blank" class="recent-post-link"><?php echo esc_html__('Recent Post:', 'vidmov')?> <?php echo get_the_title($post_item['ID']);?></a>
                    </h3>
                <?php endforeach;?>
            </div>
        <?php			
		}
    }
endif;
add_action('beeteam368_top_middle_posts', 'beeteam368_top_middle_posts', 10, 1);

if (!function_exists('beeteam368_side_menu_header')):
    function beeteam368_side_menu_header($beeteam368_header_style)
    {
        ?>
        <div class="side-close-btn ctrl-show-hidden-elm flex-row-control flex-vertical-middle">

            <div class="layer-hidden">
                <?php do_action('beeteam368_logo_side', $beeteam368_header_style) ?>
            </div>

            <div class="layer-show ">
                <div class="beeteam368-icon-item svg-side-btn oc-btn-control">
                    <svg width="100%" height="100%" version="1.1" viewBox="0 0 20 20" x="0px" y="0px"
                         class="side-menu-close">
                        <g>
                            <path d="M4 16V4H2v12h2zM13 15l-1.5-1.5L14 11H6V9h8l-2.5-2.5L13 5l5 5-5 5z"></path>
                        </g>
                    </svg>
                    <svg width="100%" height="100%" version="1.1" viewBox="0 0 20 20" x="0px" y="0px"
                         class="side-menu-open">
                        <g>
                            <path d="M16 16V4h2v12h-2zM6 9l2.501-2.5-1.5-1.5-5 5 5 5 1.5-1.5-2.5-2.5h8V9H6z"></path>
                        </g>
                    </svg>
                </div>
            </div>

        </div>

        <div class="side-nav-default">

            <a href="<?php echo esc_url(home_url('/')); ?>"
               class="ctrl-show-hidden-elm home-items flex-row-control flex-vertical-middle <?php if (is_front_page()) {
                   echo esc_attr('side-active');
               } ?>">
                <span class="layer-show">
                    <span class="beeteam368-icon-item">
                        <i class="fas fa-home"></i>
                    </span>
                </span>

                <span class="layer-hidden">
                    <span class="nav-font category-menu"><?php echo esc_html__('Home', 'vidmov'); ?></span>
                </span>
            </a>

            <?php
			
			$item_order_default = array('subscriptions', 'history', 'watch_later', 'reacted', 'rated',  'videos', 'audios', 'playlists', 'posts', 'transfer_history');
			$channel_order_side_menu_item = beeteam368_get_option('_channel_order_side_menu_item', '_channel_settings', '');
			
			if(!is_array($channel_order_side_menu_item)){
				$channel_order_side_menu_item = array();
			}
			
			foreach($channel_order_side_menu_item as $key => $value){
				if(($found_key = array_search($value, $item_order_default)) !== FALSE){
                     unset($item_order_default[$found_key]);
                }
			}
			
			$side_menu_order = array_merge($channel_order_side_menu_item, $item_order_default);            
            $side_menu_order = apply_filters('beeteam368_side_menu_order', $side_menu_order, $item_order_default);
						
            do_action('beeteam368_side_menu_nav', $beeteam368_header_style);
            do_action('beeteam368_side_menu_trending', $beeteam368_header_style);
			
           	foreach($side_menu_order as $key=>$value){
				do_action('beeteam368_side_menu_'.$value, $beeteam368_header_style);
			}
            ?>

        </div>
        <?php
    }
endif;
add_action('beeteam368_side_menu_header', 'beeteam368_side_menu_header', 10, 1);

if (!function_exists('beeteam368_post_thumbnail')) :
    function beeteam368_post_thumbnail($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        $post_type = get_post_type($post_id);
        $post_format = get_post_format($post_id);

        $df_params = array('size' => 'thumbnail', 'echo' => true, 'post_type' => $post_type, 'post_format' => $post_format);
        $params = array_replace_recursive($df_params, $hook_params);

        if($post_type == 'attachment'){
            $attachment_id = $post_id;
        }else{
            if(!has_post_thumbnail($post_id)){
                $no_images = apply_filters('beeteam368_no_images', '', $post_id, $params);
            }else{
                $attachment_id = get_post_thumbnail_id($post_id);
            }
        }

        $size = $params['size'];
        if(!defined('BEETEAM368_EXTENSIONS')){
            $size = 'full';
        }
        $echo = $params['echo'];
        $ratio = $params['ratio'];
        $position = $params['position'];
        $html = $params['html'];

        $thumb_url = '';
        $thumb_img_only = '';
        $thumb_class = 'blog-img';
        $thumb_html = '';
        $lazySizesClass = '';
        $lazySizesRatio = '';
		
		$no_image_class = '';

        if(isset($no_images)){
            $thumb_html = trim($no_images);
			$no_image_class = ' is-no-ft-image';
        }else{

            $thumb_meta = wp_get_attachment_image_src($attachment_id, $size);
            if(!$thumb_meta){
                $no_images = apply_filters('beeteam368_no_images', '', $post_id, $params);
            }else{
                $thumb_url = $thumb_meta[0];
                $thumb_width = $thumb_meta[1];
                $thumb_height = $thumb_meta[2];
            }

            if(!isset($no_images)){
                if(function_exists('wp_get_attachment_image_srcset')){
                    $_lazyload = beeteam368_get_redux_option('_lazyload', 'off', 'switch');

                    if($_lazyload === 'on' && $html!='no-link' && $html!='img-only'){
                        $placeholder_img = get_template_directory_uri() . '/css/images/placeholder.png';
                        $lazySizesClass = ' lazy-mode';
                        $lazySizesRatio = ' '.$ratio;

                        $image_srcset 			= wp_get_attachment_image_srcset($attachment_id, $size);
                        $image_sizes 			= wp_get_attachment_image_sizes($attachment_id, $size);

                        $img_attr = ' src="'.esc_url($placeholder_img).'" data-src="'.esc_url($thumb_url).'" width="'.esc_attr($thumb_width).'"  height="'.esc_attr($thumb_height).'"';
                        $img_attr_retina = ($image_srcset != '' && $image_sizes != '')?' data-srcset="'.esc_attr($image_srcset).'" data-sizes="'.esc_attr($image_sizes).'"':'';

                        $lazyload_icon = apply_filters('beeteam368_lazyload_icon', '<div class="loading-hls"><span></span></div>', $post_id, $params);

                        $thumb_html = '<img class="' . esc_attr($thumb_class) . ' lazyload lazyload-effect"' . $img_attr.$img_attr_retina . ' alt="' . esc_attr(get_the_title($attachment_id)) . '" />'.$lazyload_icon;
                    }else{
                        $thumb_html = wp_get_attachment_image($attachment_id, $size, false, array('class' => $thumb_class));
                    }
                }else {
                    $thumb_html = wp_get_attachment_image($attachment_id, $size, false, array('class' => $thumb_class));
                }

                $thumb_img_only = $thumb_html;
            }
        }

        if($thumb_html == ''){
            return;
        }

        $before_thumb = '<div class="post-featured-image'.$no_image_class.esc_attr(apply_filters('beeteam368_post_thumb_control_class', '', $post_id, $params )).'" '.apply_filters('beeteam368_post_id_control_data', '', $post_id, $params ).'>';
        $before_url = '<a data-post-id="'.esc_attr($post_id).'" data-post-type="'.esc_attr($post_type).'" href="'.esc_url(beeteam368_get_post_url($post_id)).'" title="'.esc_attr(the_title_attribute(array('echo' => 0, 'post' => $post_id))).'" class="blog-img-link blog-img-link-control'.esc_attr($lazySizesClass.$lazySizesRatio).'">';

        $after_url = '</a>';
        $after_thumb = 	'</div>';

        $before_thumb = apply_filters('beeteam368_before_thumb', $before_thumb, $post_id, $params) . apply_filters('beeteam368_before_thumb_elm', '', $post_id, $params);
        $before_url = apply_filters('beeteam368_before_url', $before_url, $post_id, $params) . apply_filters('beeteam368_before_url_elm', '', $post_id, $params);

        $thumb_html = apply_filters('beeteam368_before_thumb_html_elm', '', $post_id, $params).apply_filters('beeteam368_thumb_html', $thumb_html, $post_id, $params).apply_filters('beeteam368_after_thumb_html_elm', '', $post_id, $params);

        $after_url = apply_filters('beeteam368_after_url_elm', '', $post_id, $params) . apply_filters('beeteam368_after_url', $after_url, $post_id, $params);
        $after_thumb = apply_filters('beeteam368_after_thumb_elm', '', $post_id, $params) . apply_filters('beeteam368_after_thumb', $after_thumb, $post_id, $params);

        switch($html){
            case 'full':
                $rt_thumb = $before_thumb.$before_url.$thumb_html.$after_url.$after_thumb;
                break;

            case 'no-wrap':
                $rt_thumb = $before_url.$thumb_html.$after_url;
                break;

            case 'no-link':
                $rt_thumb = $before_thumb.$thumb_html.$after_thumb;
                break;

            case 'img-only':
                $rt_thumb = $thumb_img_only;
                break;

            case 'url-only':
                $rt_thumb = $thumb_url;
                break;

            default:
                $rt_thumb = $before_thumb.$before_url.$thumb_html.$after_url.$after_thumb;
        }

        if($echo){
            echo apply_filters('beeteam368_rt_thumb', $rt_thumb, $post_id, $params);
        }else{
            return apply_filters('beeteam368_rt_thumb', $rt_thumb, $post_id, $params);
        }
    }
endif;
add_filter('wp_lazy_loading_enabled', '__return_false');

if (!function_exists('beeteam368_bottom_featured_img')) :
	function beeteam368_bottom_featured_img($html, $post_id, $params){
		
		ob_start();
			
			do_action('beeteam368_show_watch_later_on_featured_img', $post_id, $params);
			do_action('beeteam368_show_reactions_on_featured_img', $post_id, $params);
			$output_string = trim(ob_get_contents());
			
		ob_end_clean();
		
		if($output_string != ''){
			$html.= '<div class="beeteam368-bt-ft-img second-show flex-row-control flex-vertical-middle tiny-icons dark-mode">'.apply_filters( 'beeteam368_bottom_featured_img_second', $output_string, $post_id, $params).'</div>';
		}
		
		ob_start();			
			
            do_action('beeteam368_show_score_on_featured_img', $post_id, $params);			
            //do_action('beeteam368_show_duration_on_featured_img', $post_id, $params);
			do_action('beeteam368_show_sales_count_on_featured_img', $post_id, $params);
			do_action('beeteam368_show_title_on_featured_img', $post_id, $params);
			
            $output_string = trim(ob_get_contents());

        ob_end_clean();

        if($output_string != ''){
			$html.= '<div class="beeteam368-bt-ft-img first-show flex-row-control flex-vertical-middle">'.apply_filters( 'beeteam368_bottom_featured_img_first', $output_string, $post_id, $params).'</div>';
        }
		
		return $html;
	}
endif;
add_filter('beeteam368_after_thumb_elm', 'beeteam368_bottom_featured_img', 10, 3);

if (!function_exists('beeteam368_show_reactions_on_featured_img')) :
	function beeteam368_show_reactions_on_featured_img($post_id, $params){
		
		if (!defined('BEETEAM368_POST_TYPE_PREFIX')) {
            define('BEETEAM368_POST_TYPE_PREFIX', 'vidmov');
        }
		
		if(	isset($params['position']) && ($params['position'] === 'archive-layout-lily' || $params['position'] === 'archive-layout-rose' || $params['position'] === 'slider-sunflower' || $params['position'] === 'slider-cyclamen' || $params['position'] === 'mega-menu') 
			&& isset($params['post_type']) && ($params['post_type'] == BEETEAM368_POST_TYPE_PREFIX . '_video' || $params['post_type'] == BEETEAM368_POST_TYPE_PREFIX . '_audio')){
			$beeteam368_display_post_meta = beeteam368_display_post_meta();			
			if($beeteam368_display_post_meta['level_2_show_reactions'] === 'on'){
				$params['reaction_count'] = 3;
				if($params['position'] === 'archive-layout-rose' || $params['position'] === 'slider-sunflower' || $params['position'] === 'slider-cyclamen' || $params['position'] === 'mega-menu'){
					$params['reaction_count'] = 2;
				}
				do_action('beeteam368_post_listing_likes_dislikes', $post_id, $params);
			}
		}
	}
endif;
add_action('beeteam368_show_reactions_on_featured_img', 'beeteam368_show_reactions_on_featured_img', 10, 2);

if (!function_exists('beeteam368_title_element_for_inline_on_featured_img')) :
	function beeteam368_title_element_for_inline_on_featured_img($post_id, $params){
		if($params['position'] === 'archive-layout-lily'){
			do_action('beeteam368_post_listing_title', $post_id, apply_filters('beeteam368_post_listing_title_params', array('style' => 'lily', 'heading' => 'h3', 'heading_class' => 'h4 h5-mobile', 'position' => 'archive-layout-lily'), $post_id));
		}elseif($params['position'] === 'archive-layout-rose'){
			do_action('beeteam368_post_listing_title', $post_id, apply_filters('beeteam368_post_listing_title_params', array('style' => 'rose', 'heading' => 'h3', 'heading_class' => 'h5 h6-mobile', 'position' => 'archive-layout-rose'), $post_id));
		}elseif($params['position'] === 'widget-layout-special'){
			do_action('beeteam368_post_listing_title', $post_id, apply_filters('beeteam368_post_listing_title_params', array('style' => 'rose', 'heading' => 'h4', 'heading_class' => 'h5 h6-mobile', 'position' => 'archive-layout-rose'), $post_id));
		}
	}
endif;
add_action('beeteam368_show_title_on_featured_img', 'beeteam368_title_element_for_inline_on_featured_img', 10, 2);

if (!function_exists('beeteam368_top_featured_img')) :
	function beeteam368_top_featured_img($html, $post_id, $params){
		
		ob_start();
			
			do_action('beeteam368_show_live_on_featured_img', $post_id, $params);
			do_action('beeteam368_show_trending_on_featured_img', $post_id, $params);
			do_action('beeteam368_show_duration_on_featured_img', $post_id, $params);
			do_action('beeteam368_show_membership_on_featured_img', $post_id, $params);
			$output_string = trim(ob_get_contents());
			
		ob_end_clean();
		
		if($output_string != ''){
			$html.= '<div class="beeteam368-bt-to-img flex-row-control flex-vertical-middle dark-mode first-show">'.apply_filters( 'beeteam368_top_featured_img', $output_string, $post_id, $params).'</div>';
		}
		
		return $html;
	}
endif;
add_filter('beeteam368_before_thumb_elm', 'beeteam368_top_featured_img', 10, 3);

if (!function_exists('beeteam368_post_listing_categories')) :
    function beeteam368_post_listing_categories($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $df_params = array('style' => 'default');
        $params = array_replace_recursive($df_params, $hook_params);

        $beeteam368_display_post_meta = beeteam368_display_post_meta();

        if($beeteam368_display_post_meta['level_2_show_categories'] === 'on'){

            $cats_html = '';

            $post_type = get_post_type($post_id);

            $terms = get_the_terms($post_id, $post_type.'_category');
            if($terms && !is_wp_error($terms)){
                foreach($terms as $term){
                    $cats_html.= '<a data-tax-id="tax_'.esc_attr($term->term_id).'" data-tax="'.esc_attr($term->taxonomy).'" data-post-type="'.esc_attr($post_type).'" href="'.esc_url(get_term_link($term->term_id)).'" title="'.esc_attr($term->name).'" class="category-item" ' . apply_filters('beeteam368_taxonomy_style', '', $term->term_id) . '>'.esc_html($term->name).'</a><span class="seperate"></span>';
                }
            }

            $categories = get_the_category($post_id);
            if($categories){
                foreach($categories as $category) {
                    $cat_id 	= $category->term_id;
                    $cat_name 	= $category->name;
                    $cats_html	.= '<a data-cat-id="cat_'.esc_attr($cat_id).'" data-post-type="'.esc_attr($post_type).'" href="'.esc_url(get_category_link($cat_id)).'" title="'.esc_attr($cat_name).'" class="category-item" ' . apply_filters('beeteam368_taxonomy_style', '', $category->term_id) . '>'.esc_html($cat_name).'</a><span class="seperate"></span>';
                }
            }

            echo apply_filters( 'beeteam368_taxonomy_html', $cats_html, $post_id, $hook_params);
        }
    }
endif;
add_action('beeteam368_post_listing_categories', 'beeteam368_post_listing_categories', 10, 2);

if (!function_exists('beeteam368_post_listing_published_date')) :
    function beeteam368_post_listing_published_date($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $df_params = array('style' => 'default');
        $params = array_replace_recursive($df_params, $hook_params);

        $beeteam368_display_post_meta = beeteam368_display_post_meta();

        if($beeteam368_display_post_meta['level_2_show_published_date'] === 'on' || $beeteam368_display_post_meta['level_2_show_updated_date'] === 'on'){

            $show_updated_time = ' published';
            $show_updated_time_text = esc_html__('Last Updated: ', 'vidmov');

            $time_string = '';

            if($beeteam368_display_post_meta['level_2_show_published_date'] === 'on'){
                $time_string .= '<time class="entry-date published" datetime="%1$s">%2$s</time>';
            }

            if ($beeteam368_display_post_meta['level_2_show_updated_date'] === 'on' && get_the_time('U', $post_id) !== get_the_modified_time('U', $post_id)){
                $time_string .= '<span class="seperate updated%5$s"></span><span class="updated%5$s">%6$s</span>&nbsp;<time class="updated%5$s" datetime="%3$s">%4$s</time>';
            }

            $_datetime_format = beeteam368_get_redux_option('_datetime_format', 'default');

            if($_datetime_format === 'ago'){
                $time_string = sprintf( $time_string,
                    esc_attr( get_the_date(DATE_W3C, $post_id)),
                    esc_html( human_time_diff(get_the_time('U', $post_id), current_time('timestamp')) ).' '.esc_html__('ago', 'vidmov'),
                    esc_attr( get_the_modified_date(DATE_W3C, $post_id)),
                    esc_html( human_time_diff(get_the_modified_time('U', $post_id), current_time('timestamp')) ).' '.esc_html__('ago', 'vidmov'),
                    $show_updated_time,
                    $show_updated_time_text
                );
            }else{
                $time_string = sprintf( $time_string,
                    esc_attr( get_the_date(DATE_W3C, $post_id)),
                    esc_html( get_the_date('', $post_id) ),
                    esc_attr( get_the_modified_date(DATE_W3C, $post_id)),
                    esc_html( get_the_modified_date('', $post_id) ),
                    $show_updated_time,
                    $show_updated_time_text
                );
            }

            echo apply_filters( 'beeteam368__post_time_html', $time_string, $post_id, $hook_params);
        }
    }
endif;
add_action('beeteam368_post_listing_published_date', 'beeteam368_post_listing_published_date', 10, 2);

if (!function_exists('beeteam368_post_listing_top_meta')) :
    function beeteam368_post_listing_top_meta($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $df_params = array('style' => 'default', 'show_author' => true, 'show_categories' => true, 'show_published_date' => true);
        $params = array_replace_recursive($df_params, $hook_params);

        ob_start();

            if($params['show_author']){

                $beeteam368_display_post_meta = beeteam368_display_post_meta();

                if($beeteam368_display_post_meta['level_2_show_author'] === 'on'){
                    $author_id = get_post_field('post_author', $post_id);                   

                    if(!empty($author_id) && $author_id != '' && is_numeric($author_id)){
                        $avatar = beeteam368_get_author_avatar($author_id);
                        $author_display_name = get_the_author_meta('display_name', $author_id);                        
                        ?>

                        <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" title="<?php echo esc_attr($author_display_name);?>" class="author-item"><?php echo apply_filters('beeteam368_member_verification_icon', '<i class="far fa-user-circle author-verified"></i>', $author_id);?><span><?php echo esc_html($author_display_name)?></span></a><span class="seperate"></span>

                        <?php
                    }
                }
            }

            if($params['show_categories']){
                do_action('beeteam368_post_listing_categories', $post_id, $hook_params);
            }

            if($params['show_published_date']){
                do_action('beeteam368_post_listing_published_date', $post_id, $hook_params);
            }

            $output_string = trim(ob_get_contents());

        ob_end_clean();

        if($output_string != ''){
        ?>
        <div class="posted-on top-post-meta font-meta">
            <?php echo apply_filters( 'beeteam368_posted_on_html', $output_string, $post_id, $hook_params);?>
        </div>
        <?php
        }
    }
endif;
add_action('beeteam368_post_listing_top_meta', 'beeteam368_post_listing_top_meta', 10, 2);

if (!function_exists('beeteam368_post_listing_title')) :
    function beeteam368_post_listing_title($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $df_params = array('style' => 'default', 'heading' => 'h3', 'heading_class' => 'h4');
        $params = array_replace_recursive($df_params, $hook_params);
    ?>
        <<?php echo esc_attr($params['heading'])?> class="entry-title post-title max-2lines <?php echo esc_attr($params['heading_class'])?>">
            <a class="post-listing-title" href="<?php echo esc_url(beeteam368_get_post_url($post_id)); ?>" title="<?php echo esc_attr(get_the_title($post_id));?>"><?php echo get_the_title($post_id); ?></a>
        </<?php echo esc_attr($params['heading'])?>>
    <?php
    }
endif;
add_action('beeteam368_post_listing_title', 'beeteam368_post_listing_title', 10, 2);

if (!function_exists('beeteam368_post_listing_excerpt')) :
    function beeteam368_post_listing_excerpt($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $df_params = array('style' => 'default');
        $params = array_replace_recursive($df_params, $hook_params);

        $beeteam368_display_post_meta = beeteam368_display_post_meta();

        if($beeteam368_display_post_meta['level_2_show_excerpt'] === 'on'){
            $excerpt_length = apply_filters('beeteam368_excerpt_length', 133);
            $excerpt = trim(strip_shortcodes(strip_tags(get_the_excerpt($post_id))));

            if($excerpt != '' && strlen($excerpt) > $excerpt_length ){
                $excerpt = mb_substr($excerpt, 0, $excerpt_length, 'UTF-8');
                $excerpt = trim(preg_replace('/\s+/', ' ', $excerpt)).'...';
            }

            if($excerpt !== ''){
                ?>
                <div class="entry-content post-excerpt">
                    <?php echo apply_filters('beeteam368_excerpt_in_post_listing', $excerpt);?>
                </div>
                <?php
            }
        }
    }
endif;
add_action('beeteam368_post_listing_excerpt', 'beeteam368_post_listing_excerpt', 10, 2);

if (!function_exists('beeteam368_excerpt_more')) :
    function beeteam368_excerpt_more()
    {
        return esc_html__('...', 'vidmov');
    }
endif;
add_filter('excerpt_more', 'beeteam368_excerpt_more');

if (!function_exists('beeteam368_get_author_avatar')) :
    function beeteam368_get_author_avatar($author_id = NULL, $hook_params = array()){

        $df_params = array('size' => 50, 'html' => 'img-tag', 'echo' => true);
        $params = array_replace_recursive($df_params, $hook_params);

        $retina_size = $params['size'] * 2;

        $url1x = get_avatar_url($author_id, array('size' => $params['size']));
        $url2x = get_avatar_url($author_id, array('size' => $retina_size));
        $ava_data = get_avatar_data($author_id, array('size' => $params['size']));

        return beeteam368_create_retina_img(array('retina_1x' => array('src' => $url1x, 'width' => $params['size'], 'height' => $params['size']), 'retina_2x' => array('src' => $url2x, 'width' => $retina_size, 'height' => $retina_size), 'alt' => esc_attr__('Author Avatar', 'vidmov'), 'class' => 'author-avatar', 'echo' => false));
    }
endif;

if (!function_exists('beeteam368_post_listing_header')) :
    function beeteam368_post_listing_header($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $df_params = array('style' => 'default', 'class' => '', 'show_author' => true);
        $params = array_replace_recursive($df_params, $hook_params);

        if($params['show_author']){

            $beeteam368_display_post_meta = beeteam368_display_post_meta();

            if($beeteam368_display_post_meta['level_2_show_author'] === 'on'){
                $author_id = get_post_field('post_author', $post_id);

                if(!empty($author_id) && $author_id != '' && is_numeric($author_id)){
                    $avatar = beeteam368_get_author_avatar($author_id);
                    $author_display_name = get_the_author_meta('display_name', $author_id);
                    ?>
                    <div class="blog-author-element flex-row-control flex-vertical-middle">
                        <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" class="author-avatar-wrap" title="<?php echo esc_attr($author_display_name);?>">
                            <?php echo apply_filters('beeteam368_avatar_in_post_listing_header', $avatar);?>
                        </a>
                        <div class="author-avatar-name-wrap">
                            <h5 class="author-avatar-name max-1line">
                                <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" class="author-avatar-name-link" title="<?php echo esc_attr($author_display_name);?>">
                                    <?php echo apply_filters('beeteam368_member_verification_icon', '<i class="far fa-user-circle author-verified"></i>', $author_id);?><span><?php echo esc_html($author_display_name)?></span>
                                </a>
                            </h5>

                            <?php do_action('beeteam368_subscribers_count', $author_id);?>
                            <?php do_action('beeteam368_joind_date_element', $author_id);?>

                        </div>

                        <div class="beeteam368-icon-item author-expand beeteam368-dropdown-items beeteam368-dropdown-items-control">
                            <span class="dot-icon"></span>
                            <div class="beeteam368-icon-dropdown beeteam368-icon-dropdown-control">
                                
                                <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" class="flex-row-control flex-vertical-middle icon-drop-down-url">                            
                                    <span class="beeteam368-icon-item">
                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </span>
                                    <span class="nav-font"><?php echo esc_html__('View Profile', 'vidmov')?></span>                                    
                                </a>
                                
                                <?php do_action('beeteam368_about_discussion_score_in_pp_dd', $author_id);?>
                                
                                <?php do_action('beeteam368_reaction_score_in_pp_dd', $author_id);?>
                                
                                <?php do_action('beeteam368_subscribe_button', $author_id, -1);?>
                            </div>
                        </div>

                    </div>
                    <?php
                }
            }
        }
    }
endif;
add_action('beeteam368_post_listing_header', 'beeteam368_post_listing_header', 10, 2);

if (!function_exists('beeteam368_post_listing_footer')) :
    function beeteam368_post_listing_footer($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $df_params = array('style' => 'default', 'class' => '');
        $params = array_replace_recursive($df_params, $hook_params);

        $class = $params['class'];

        ob_start();

            do_action('beeteam368_post_listing_footer_left', $post_id, $hook_params);
            do_action('beeteam368_post_listing_footer_right', $post_id, $hook_params);
            $output_string = trim(ob_get_contents());

        ob_end_clean();

        if($output_string != ''){
            ?>
            <div class="posted-on ft-post-meta font-meta font-meta-size-12 <?php echo esc_attr($class)?>">
                <?php echo apply_filters( 'beeteam368_posted_on_ft_html', $output_string, $post_id, $hook_params);?>
            </div>
            <?php
        }
    }
endif;
add_action('beeteam368_post_listing_footer', 'beeteam368_post_listing_footer', 10, 2);

if (!function_exists('beeteam368_post_listing_comments')) :
    function beeteam368_post_listing_comments($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $df_params = array();
        $params = array_replace_recursive($df_params, $hook_params);

        $beeteam368_display_post_meta = beeteam368_display_post_meta();

        if($beeteam368_display_post_meta['level_2_show_comments'] === 'on'){
            $comment_text = esc_html__('comments', 'vidmov');
            $comments_number = get_comments_number($post_id);
            if($comments_number === 1){
                $comment_text = esc_html__('comment', 'vidmov');
            }
            ?>
            <a href="<?php echo esc_url(beeteam368_get_post_url($post_id));?>#comments" class="post-footer-item post-lt-comments post-lt-comment-control">
                <span class="beeteam368-icon-item small-item"><i class="fas fa-comment-dots"></i></span><span class="item-number"><?php echo apply_filters('beeteam368_number_format', $comments_number);?></span>
                <span class="item-text"><?php echo esc_html($comment_text);?></span>
            </a>
            <?php
        }
    }
endif;
add_action('beeteam368_post_listing_comments', 'beeteam368_post_listing_comments', 10, 2);

if (!function_exists('beeteam368_post_listing_view_details')) :
    function beeteam368_post_listing_view_details($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $df_params = array();
        $params = array_replace_recursive($df_params, $hook_params);

        $beeteam368_display_post_meta = beeteam368_display_post_meta();

        if($beeteam368_display_post_meta['level_2_show_view_details'] === 'on'){
            ?>
            <a href="<?php echo esc_url(beeteam368_get_post_url($post_id));?>" class="post-footer-item view-more-ct-item">
                <span class="beeteam368-icon-item small-item"><i class="fas fa-info"></i></span><span class="item-text"><?php echo esc_html__('view more', 'vidmov');?></span>
                <span class="item-number"><i class="fas fa-angle-double-right"></i></span>
            </a>
            <?php
        }
    }
endif;
add_action('beeteam368_post_listing_view_details', 'beeteam368_post_listing_view_details', 10, 2);

if (!function_exists('beeteam368_post_listing_footer_left')) :
    function beeteam368_post_listing_footer_left($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $df_params = array('show_reactions' => true, 'show_comments' => true, 'show_views_counter' => true, 'show_view_details' => true);
        $params = array_replace_recursive($df_params, $hook_params);

        $beeteam368_display_post_meta = beeteam368_display_post_meta();

        ob_start();

            if($params['show_reactions'] && $beeteam368_display_post_meta['level_2_show_reactions'] === 'on'){
                do_action('beeteam368_post_listing_likes_dislikes', $post_id, $hook_params);
            }

            if($params['show_comments']){
                do_action('beeteam368_post_listing_comments', $post_id, $hook_params);
            }

            if($params['show_views_counter'] && $beeteam368_display_post_meta['level_2_show_views_counter'] === 'on'){
                do_action('beeteam368_post_listing_views_counter', $post_id, $hook_params);
            }

            if($params['show_view_details']){
                do_action('beeteam368_post_listing_view_details', $post_id, $hook_params);
            }

            $output_string = trim(ob_get_contents());

        ob_end_clean();

        if($output_string != ''){
            ?>
            <div class="post-lt-ft-left flex-row-control flex-vertical-middle">
                <?php echo apply_filters( 'beeteam368_post_lt_ft_left_html', $output_string, $post_id, $hook_params);?>
            </div>
            <?php
        }
    }
endif;
add_action('beeteam368_post_listing_footer_left', 'beeteam368_post_listing_footer_left', 10, 2);

if (!function_exists('beeteam368_post_listing_footer_right')) :
    function beeteam368_post_listing_footer_right($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $df_params = array();
        $params = array_replace_recursive($df_params, $hook_params);

        ob_start();

            /*do_action('beeteam368_post_listing_sharing', $post_id, $hook_params);*/

        $output_string = trim(ob_get_contents());
        ob_end_clean();

        if($output_string != ''){
            ?>
            <div class="post-lt-ft-right">
                <?php echo apply_filters( 'beeteam368_post_lt_ft_right_html', $output_string, $post_id, $hook_params);?>
            </div>
            <?php
        }
    }
endif;
add_action('beeteam368_post_listing_footer_right', 'beeteam368_post_listing_footer_right', 10, 2);

if ( !function_exists('beeteam368_author_single_element' ) ):
    function beeteam368_author_single_element($post_id = NULL, $pos_style = 'small') {
		
		global $beeteam368_clear_single_author_element;
		if(isset($beeteam368_clear_single_author_element) && $beeteam368_clear_single_author_element === 'on'){
			return;
		}

        $display_single_post_author = beeteam368_get_redux_option('_display_single_post_author', 'on', 'switch');

        if($display_single_post_author !== 'on'){
            return;
        }

        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $author_id = get_post_field('post_author', $post_id);

        if(!empty($author_id) && $author_id != '' && is_numeric($author_id)){
            $avatar = beeteam368_get_author_avatar($author_id, array('size' => 61));
            $author_display_name = get_the_author_meta('display_name', $author_id);
        }else{
            return;
        }
        ?>
        <div class="beeteam368-single-author flex-row-control flex-vertical-middle">

            <div class="author-wrapper flex-row-control flex-vertical-middle">

                <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" class="author-avatar-wrap" title="<?php echo esc_attr($author_display_name);?>">
                    <?php echo apply_filters('beeteam368_avatar_in_single_element', $avatar);?>
                </a>

                <div class="author-avatar-name-wrap">
                    <h4 class="author-avatar-name max-1line">
                        <a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" class="author-avatar-name-link" title="<?php echo esc_attr($author_display_name);?>">
                            <?php echo apply_filters('beeteam368_member_verification_icon', '<i class="far fa-user-circle author-verified"></i>', $author_id);?><span><?php echo esc_html($author_display_name)?></span>
                        </a>
                    </h4>

                    <?php do_action('beeteam368_subscribers_count', $author_id);?>
                    <?php do_action('beeteam368_joind_date_element', $author_id);?>

                </div>
            </div>

            <?php
            do_action('beeteam368_subscribe_button', $author_id, $post_id);

            do_action('beeteam368_virtual_gifts_button', $author_id, $post_id);
			
			do_action('beeteam368_author_sub_meta_for_post', $author_id, $post_id);
            ?>

        </div>
    <?php
    }
endif;
add_action( 'beeteam368_after_player_in_single_video', 'beeteam368_author_single_element', 20, 2 );
add_action( 'beeteam368_after_player_in_single_audio', 'beeteam368_author_single_element', 20, 2 );

add_action( 'beeteam368_after_video_player_in_single_playlist', 'beeteam368_author_single_element', 20, 2 );
add_action( 'beeteam368_after_audio_player_in_single_playlist', 'beeteam368_author_single_element', 20, 2 );

add_action( 'beeteam368_after_video_player_in_single_series', 'beeteam368_author_single_element', 20, 2 );
add_action( 'beeteam368_after_audio_player_in_single_series', 'beeteam368_author_single_element', 20, 2 );

add_action( 'beeteam368_after_title_content_post', 'beeteam368_author_single_element', 20, 1 );

if ( !function_exists('beeteam368_author_join_date_element' ) ):
	function beeteam368_author_join_date_element($author_id){
		$author_data = get_userdata($author_id);
		
		if($author_data){
			$joined = $author_data->user_registered;
			$author_joined = date("M Y", strtotime($joined));
		?>
            <span class="author-meta font-meta">
                <i class="icon fas fa-user-clock"></i><span class="joined-date"><?php echo esc_html__('Joined:', 'vidmov').' '.esc_html($author_joined);?></span>
            </span>
        <?php
		}		
        
	}
endif;
add_action( 'beeteam368_joind_date_element', 'beeteam368_author_join_date_element', 10, 1 );

if ( !function_exists('beeteam368_meta_single_av_element' ) ):
    function beeteam368_meta_single_av_element($post_id = NULL, $pos_style = 'small') {
		
		if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }
		
		$beeteam368_display_post_meta = beeteam368_display_post_meta();
		
		ob_start();
		
			$hook_params = array();
            
            do_action('beeteam368_post_listing_categories', $post_id, $hook_params);
            do_action('beeteam368_post_listing_published_date', $post_id, $hook_params);            

            $meta_one = trim(ob_get_contents());

        ob_end_clean();
		
		global $beetam368_show_post_meta_action;
		if($beetam368_show_post_meta_action === 'on'){
			ob_start();
				
				$hook_params = array();
				
				if($beeteam368_display_post_meta['level_2_show_reactions'] === 'on'){
					do_action('beeteam368_post_listing_likes_dislikes', $post_id, $hook_params);
				}
				
				do_action('beeteam368_post_listing_original_post', $post_id, $hook_params);
				
				global $beeteam368_hide_comment_post_meta;
				if($beeteam368_hide_comment_post_meta!=='off'){
					do_action('beeteam368_post_listing_comments', $post_id, $hook_params);	
				}
				$beeteam368_hide_comment_post_meta = NULL;
				
				if($beeteam368_display_post_meta['level_2_show_views_counter'] === 'on'){
					do_action('beeteam368_post_listing_views_counter', $post_id, $hook_params);
				}
				
				do_action('beeteam368_show_sales_count_on_single_media', $post_id, $hook_params);
					
				$meta_two = trim(ob_get_contents());
	
			ob_end_clean();
		}else{
			$meta_two = '';
		}
		?>
        <div class="beeteam368-single-meta flex-row-control flex-vertical-middle">
            <div class="main-block-wrapper">
                <?php 
				global $beetam368_player_custom_single_title;
				if($beetam368_player_custom_single_title !== 'off'){
				
					if($meta_one!=''){
						?>
						<div class="special-style posted-on top-post-meta font-meta flex-row-control flex-vertical-middle">
							<?php echo apply_filters('beeteam368_single_meta_one', $meta_one); ?>
						</div>
						<?php 
					}
					?>
					
					<header class="entry-header single-post-title flex-row-control flex-vertical-middle">
						<?php
						$extra_title = '';
						if($pos_style === 'small'){
							$extra_title = 'h2';
						}
						echo '<h1 class="entry-title h4-mobile '.esc_attr($extra_title).'">'.get_the_title($post_id).'</h1>';
						global $beetam368_not_show_default_title;
						$beetam368_not_show_default_title = 'off';
						?>
					</header>
						
					<?php
				}
				
                if($meta_two!=''){
					$extra_class_icon = '';
					if($pos_style === 'small'){
						$extra_class_icon = 'tiny-icons';
					}
                ?>
                    <div class="posted-on top-post-meta font-meta flex-row-control flex-vertical-middle">
                        <div class="post-lt-ft-left flex-row-control flex-vertical-middle flex-row-center <?php echo esc_attr($extra_class_icon);?>">
                            <?php echo apply_filters('beeteam368_single_meta_two', $meta_two); ?>
                        </div>
                    </div>
                <?php }?>
            </div>
            
            <?php do_action('beeteam368_single_av_main_toolbar', $post_id, $pos_style);?>       
            
        </div>
        <?php		
	}
endif;
add_action( 'beeteam368_after_player_in_single_video', 'beeteam368_meta_single_av_element', 10, 2 );
add_action( 'beeteam368_after_player_in_single_audio', 'beeteam368_meta_single_av_element', 10, 2 );

add_action( 'beeteam368_after_video_player_in_single_playlist', 'beeteam368_meta_single_av_element', 10, 2 );
add_action( 'beeteam368_after_audio_player_in_single_playlist', 'beeteam368_meta_single_av_element', 10, 2 );

add_action( 'beeteam368_after_video_player_in_single_series', 'beeteam368_meta_single_av_element', 10, 2 );
add_action( 'beeteam368_after_audio_player_in_single_series', 'beeteam368_meta_single_av_element', 10, 2 );

if ( !function_exists('beeteam368_author_sub_meta_for_post' ) ):
	function beeteam368_author_sub_meta_for_post($author_id, $post_id){
		
		$beeteam368_display_post_meta = beeteam368_display_post_meta();
		
		ob_start();
			
			$hook_params = array();
            
			if($beeteam368_display_post_meta['level_2_show_reactions'] === 'on'){
            	do_action('beeteam368_post_listing_likes_dislikes', $post_id, $hook_params);
			}
			
            do_action('beeteam368_post_listing_comments', $post_id, $hook_params);
			
			if($beeteam368_display_post_meta['level_2_show_views_counter'] === 'on'){
            	do_action('beeteam368_post_listing_views_counter', $post_id, $hook_params);
			}

            $meta_two = trim(ob_get_contents());

        ob_end_clean();		
		
		if($meta_two!=''){
		?>            
                   
            <div class="posted-on top-post-meta font-meta flex-row-control flex-vertical-middle">
                <div class="post-lt-ft-left flex-row-control flex-vertical-middle tiny-icons">
                    <?php echo apply_filters('beeteam368_single_meta_two', $meta_two); ?>
                </div>
            </div>
            
        <?php
		}
	}
endif;
add_action( 'beeteam368_author_sub_meta_for_post', 'beeteam368_author_sub_meta_for_post', 10, 2 );

if ( !function_exists('beeteam368_meta_single_post_element_top' ) ):
    function beeteam368_meta_single_post_element_top($post_id = NULL) {
		
		if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }
		
		ob_start();
		
			$hook_params = array();
            
            do_action('beeteam368_post_listing_categories', $post_id, $hook_params);
            do_action('beeteam368_post_listing_published_date', $post_id, $hook_params);            

            $meta_one = trim(ob_get_contents());

        ob_end_clean();
		
		if($meta_one!=''){
		?>            
            <div class="special-style posted-on top-post-meta font-meta flex-row-control flex-vertical-middle">
                <?php echo apply_filters('beeteam368_single_meta_one', $meta_one); ?>
            </div>                
        <?php
		}		
	}
endif;
add_action( 'beeteam368_before_title_content_post', 'beeteam368_meta_single_post_element_top', 10, 1 );

if ( !function_exists('beeteam368_meta_single_post_element_bottom' ) ):
    function beeteam368_meta_single_post_element_bottom($post_id = NULL) {
		
		global $beetam368_show_post_meta_action;
		if($beetam368_show_post_meta_action !== 'on'){
			return;
		}
		
		if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }
		
		$beeteam368_display_post_meta = beeteam368_display_post_meta();
		
		ob_start();
			
			$hook_params = array();
			
			global $beeteam368_clear_single_author_element;
			if($beeteam368_display_post_meta['level_2_show_author'] === 'on' && $beeteam368_clear_single_author_element === 'on'){
				$author_id = get_post_field('post_author', $post_id);                   

				if(!empty($author_id) && $author_id != '' && is_numeric($author_id)){
					$avatar = beeteam368_get_author_avatar($author_id);
					$author_display_name = get_the_author_meta('display_name', $author_id);                        
					?>
					<a href="<?php echo apply_filters('beeteam368_author_url', esc_url(get_author_posts_url($author_id)), $author_id); ?>" title="<?php echo esc_attr($author_display_name);?>" class="post-footer-item">
                        <span class="beeteam368-icon-item small-item"><?php echo apply_filters('beeteam368_member_verification_icon_in_single', '<i class="far fa-user"></i>', $author_id);?></span>
                        <span class="item-text"><?php echo esc_html($author_display_name)?></span>
                    </a>
					<?php
				}
			}
            
			if($beeteam368_display_post_meta['level_2_show_reactions'] === 'on'){
            	do_action('beeteam368_post_listing_likes_dislikes', $post_id, $hook_params);
			}
			
            do_action('beeteam368_post_listing_comments', $post_id, $hook_params);
			
			if($beeteam368_display_post_meta['level_2_show_views_counter'] === 'on'){
            	do_action('beeteam368_post_listing_views_counter', $post_id, $hook_params);
			}

            $meta_two = trim(ob_get_contents());

        ob_end_clean();
		
				
		if($meta_two!=''){
		?>
            <div class="posted-on top-post-meta font-meta flex-row-control flex-vertical-middle">
                <div class="post-lt-ft-left flex-row-control flex-vertical-middle">
                    <?php echo apply_filters('beeteam368_single_meta_two', $meta_two); ?>
                </div>
            </div>
        <?php
		}
	}
endif;
add_action( 'beeteam368_after_title_content_post', 'beeteam368_meta_single_post_element_bottom', 10, 1 );

if (!function_exists('beeteam368_pagination_default_class')) :
    function beeteam368_pagination_default_class($attr){
        $attr = ' class="btnn-default btnn-primary" ';
        return $attr;
    }
endif;
add_filter('previous_posts_link_attributes', 'beeteam368_pagination_default_class',10, 1);
add_filter('next_posts_link_attributes', 'beeteam368_pagination_default_class',10, 1);

if (!function_exists('beeteam368_pagination')) :
    function beeteam368_pagination($template = 'template-parts/archive/item', $style = 'default', $overwrite = NULL, $custom_query = NULL, $control = NULL){
		
		$data_total_pages = '';		
		if(is_array($control) && isset($control['total_pages']) && is_numeric($control['total_pages'])){
			$max_pages = $control['total_pages'];
		}else{
			$max_pages = $GLOBALS['wp_query']->max_num_pages;
		}
		
		$data_total_pages = 'data-total-pages="'.esc_attr($max_pages).'"';
		
        if($max_pages < 2){
            return;
        }
		
		$data_append_id = '';
		if(is_array($control) && isset($control['append_id']) && trim($control['append_id'])!=''){
			$data_append_id = 'data-append-id="'.esc_attr(trim($control['append_id'])).'"';
		}
		
		$data_query_id = '';
		if(is_array($control) && isset($control['query_id']) && trim($control['query_id'])!=''){
			$data_query_id = 'data-query-id="'.esc_attr(trim($control['query_id'])).'"';
		}
		
		$data_percent_items = '';
		if(is_array($control) && isset($control['percent_items']) && trim($control['percent_items'])!=''){
			$data_percent_items = 'data-percent-items="'.esc_attr(trim($control['percent_items'])).'"';
		}		
		
		$pag_type = apply_filters('beeteam368_default_pagination_type', beeteam368_get_redux_option('_pagination', 'wp-default'));
		
		if(isset($overwrite) && $overwrite!=NULL && $overwrite !=''){
			$pag_type = $overwrite;
		}	
		
		$pag_type = apply_filters('beeteam368_default_pagination_type', $pag_type);
		
		global $beeteam368_pag_type_stand_alone;
		if($beeteam368_pag_type_stand_alone !== NULL && $beeteam368_pag_type_stand_alone!=''){
			$pag_type = $beeteam368_pag_type_stand_alone;
		}
		
		switch($pag_type){
			case 'wp-default':
			?>
            	<nav class="beeteam368-pagination pagination-default beeteam368-pagination site__row flex-row-control flex-row-space-between flex-vertical-middle" data-paged="1" data-template="<?php echo esc_attr($template);?>" data-style="<?php echo esc_attr($style);?>" <?php echo apply_filters('beeteam368_data_append_id_in_pag_default', $data_append_id)?> <?php echo apply_filters('beeteam368_data_query_id_in_pag_default', $data_query_id)?> <?php echo apply_filters('beeteam368_data_total_pages_in_pag_default', $data_total_pages)?> <?php echo apply_filters('beeteam368_data_percent_items_in_pag_default', $data_percent_items)?>>

                    <div class="prev-content site__col">
                        <?php if(get_next_posts_link()):
                            next_posts_link('<i class="fas fa-angle-double-left"></i>'.esc_html__(' Previous', 'vidmov'));
                        endif;?>
                    </div>
        
                    <div class="next-content site__col">
                        <?php if(get_previous_posts_link()):
                            previous_posts_link(esc_html__('Next ', 'vidmov').'<i class="fas fa-angle-double-right"></i>');
                        endif;?>
                    </div>
        
                </nav>
            <?php
				break;
				
			case 'loadmore-btn':
				$class_custom_btn = isset($control['custom_class_btn'])?$control['custom_class_btn']:'';
				$custom_text_btn = isset($control['custom_text_btn'])?$control['custom_text_btn']:esc_html__('Load More', 'vidmov');
			?>
            	<nav class="beeteam368-pagination pagination-loadmore beeteam368-pagination flex-row-control flex-row-center flex-vertical-middle" data-paged="1" data-template="<?php echo esc_attr($template);?>" data-style="<?php echo esc_attr($style);?>" <?php echo apply_filters('beeteam368_data_append_id_in_pag_loadmore', $data_append_id)?> <?php echo apply_filters('beeteam368_data_query_id_in_pag_loadmore', $data_query_id)?> <?php echo apply_filters('beeteam368_data_total_pages_in_pag_loadmore', $data_total_pages)?> <?php echo apply_filters('beeteam368_data_percent_items_in_pag_loadmore', $data_percent_items)?>>  
                	<button class="loadmore-btn loadmore-btn-control <?php echo esc_attr($class_custom_btn);?>">
                        <span class="loadmore-text loadmore-text-control"><?php echo wp_kses($custom_text_btn, array( 'i'=>array('class'=>array()), 'span'=>array('class'=>array()) ));?></span>
                        <span class="loadmore-loading">
                        	<span class="loadmore-indicator">
								<svg><polyline class="lm-back" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline> <polyline class="lm-front" points="1 6 4 6 6 11 10 1 12 6 15 6"></polyline></svg>
                            </span>
                        </span>
                    </button>        	
            	</nav>		
			<?php
				break;
				
			case 'infinite-scroll':
			?>
            	<nav class="beeteam368-pagination pagination-infinite beeteam368-pagination flex-row-control flex-row-center flex-vertical-middle" data-paged="1" data-template="<?php echo esc_attr($template);?>" data-style="<?php echo esc_attr($style);?>" <?php echo apply_filters('beeteam368_data_append_id_in_pag_infinite', $data_append_id)?> <?php echo apply_filters('beeteam368_data_query_id_in_pag_infinite', $data_query_id)?> <?php echo apply_filters('beeteam368_data_total_pages_in_pag_infinite', $data_total_pages)?> <?php echo apply_filters('beeteam368_data_percent_items_in_pag_infinite', $data_percent_items)?>>    
                	<div class="infinite-la-fire infinite-control"><div></div><div></div><div></div></div>        	
            	</nav>		
			<?php
				break;
				
			case 'pagenavi_plugin':
			?>
            	<nav class="beeteam368-pagination pagination-pagenavi beeteam368-pagination flex-row-control flex-row-center flex-vertical-middle" data-paged="1" data-template="<?php echo esc_attr($template);?>" data-style="<?php echo esc_attr($style);?>" <?php echo apply_filters('beeteam368_data_append_id_in_pag_pagenavi', $data_append_id)?> <?php echo apply_filters('beeteam368_data_query_id_in_pag_pagenavi', $data_query_id)?> <?php echo apply_filters('beeteam368_data_total_pages_in_pag_pagenavi', $data_total_pages)?> <?php echo apply_filters('beeteam368_data_percent_items_in_pag_pagenavi', $data_percent_items)?>>
            	<?php
					if(class_exists('PageNavi_Core')){
						if(isset($custom_query) && $custom_query!=NULL){
							wp_pagenavi(array('query' => $custom_query));
						}else{
							wp_pagenavi();
						}
					}
				?>
            	</nav>		
			<?php					
				break;			
		}
    }
endif;
add_action( 'beeteam368_pagination', 'beeteam368_pagination', 10, 5 );

if ( !function_exists('beeteam368_loadmore_posts' ) ):
	function beeteam368_loadmore_posts(){
		
		$security = isset($_POST['security'])?sanitize_text_field($_POST['security']):'';
		if (!beeteam368_ajax_verify_nonce($security, false)){			
			return;
			die();
		}
		
		$template 		= trim(sanitize_text_field($_POST['template']));
		$style			= trim(sanitize_text_field($_POST['style']));
		
		$query_vars = sanitize_text_field(json_encode($_POST['query_vars']));		
		$query_vars	= json_decode($query_vars, true);
		
		foreach($query_vars as $key=>$value){
			if(is_numeric($value)) $query_vars[$key] = intval($value);
			if($value == 'false') $query_vars[$key] = false;
			if($value == 'true') $query_vars[$key] = true;
		}
		
		$paged = intval(sanitize_text_field($_POST['paged']));
		if($paged == 0){
			$paged = 1;
		}		
		
		$query_vars = apply_filters('beeteam368_custom_query_vars_loadmore_posts', $query_vars);
		
		if(isset($query_vars['nicename'])){
			$posts_per_page = intval(isset($query_vars['number']) ? $query_vars['number'] : intval(sanitize_text_field(beeteam368_get_option('_channel_subscriptions_tab_items_per_page', '_channel_settings', 10))));
			$query_offset = ($paged - 1) * $posts_per_page;
			
			if(isset($_POST['percent_items']) && is_numeric($_POST['percent_items']) && $_POST['percent_items'] > 0){
				$query_vars['number'] = $_POST['percent_items'];
			}else{
				$query_vars['number']	= $posts_per_page;
			}

			$query_vars['offset']	= $query_offset;
			
			unset($query_vars['paged']);
			unset($query_vars['p']);
			unset($query_vars['page']);
			unset($query_vars['pagename']);
			
			$wp_user_query = new WP_User_Query($query_vars);			
			$authors = $wp_user_query->get_results();
			
			if(isset($_POST['params'])){
				$params = $_POST['params'];
				if(isset($params['beeteam368_author_query_order_id'])){
					global $beeteam368_author_query_order_id;
					$beeteam368_author_query_order_id = $params['beeteam368_author_query_order_id'];
				}
			}
			
			if (!empty($authors)){
				foreach ($authors as $author){
						
					global $beeteam368_author_looping_id;
					$beeteam368_author_looping_id = $author->ID;						
					
					get_template_part( $template, $style );
					
					$beeteam368_author_looping_id = NULL;
				}
			}
			
			if(isset($beeteam368_author_query_order_id)){
				$beeteam368_author_query_order_id = NULL;
			}
			
		}else{
			
			$posts_per_page = intval(isset($query_vars['posts_per_page']) ? $query_vars['posts_per_page'] : intval(sanitize_text_field(get_option('posts_per_page'))));
			$query_offset = ($paged - 1) * $posts_per_page;

			if(isset($_POST['percent_items']) && is_numeric($_POST['percent_items']) && $_POST['percent_items'] > 0){
				$query_vars['posts_per_page']= $_POST['percent_items'];
			}else{
				$query_vars['posts_per_page']	= $posts_per_page;
			}			
			
			$query_vars['post_status']		= 'publish';
			$query_vars['offset']			= $query_offset;
			
			unset($query_vars['paged']);
			unset($query_vars['p']);
			unset($query_vars['page']);
			unset($query_vars['pagename']);
			
			$posts = new WP_Query($query_vars);
			
			if(isset($_POST['params'])){
				
				$params = $_POST['params'];
				
				$block_layout = (isset($params['block_layout']) && trim($params['block_layout']) != '') ? trim($params['block_layout']) : 'default';
                
                $scroll_to_play	= (isset($params['scroll_to_play']) && trim($params['scroll_to_play']) !='') ? trim($params['scroll_to_play']) : '';
				
				$display_author	= (isset($params['display_author']) && trim($params['display_author']) !='') ? trim($params['display_author']) : '';
				$display_excerpt = (isset($params['display_excerpt']) && trim($params['display_excerpt']) !='') ?trim($params['display_excerpt']) : '';
				$display_post_categories = (isset($params['display_post_categories']) && trim($params['display_post_categories']) !='') ? trim($params['display_post_categories']) : '';
				$display_post_published_date = (isset($params['display_post_published_date']) && trim($params['display_post_published_date']) != '') ? trim($params['display_post_published_date']) : '';
				$display_post_updated_date = (isset($params['display_post_updated_date']) && trim($params['display_post_updated_date']) !='') ? trim($params['display_post_updated_date']) : '';
				$display_post_reactions = (isset($params['display_post_reactions']) && trim($params['display_post_reactions']) !='') ? trim($params['display_post_reactions']) : '';
				$display_post_comments = (isset($params['display_post_comments']) && trim($params['display_post_comments']) !='') ? trim($params['display_post_comments']) : '';
				$display_post_views = (isset($params['display_post_views']) && trim($params['display_post_views']) !='') ? trim($params['display_post_views']) : '';
				$display_duration = (isset($params['display_duration']) && trim($params['display_duration']) !='') ? trim($params['display_duration']) : '';
				$display_tag_label = (isset($params['display_tag_label']) && trim($params['display_tag_label']) !='') ? trim($params['display_tag_label']) : '';
				$display_post_read_more = (isset($params['display_post_read_more']) && trim($params['display_post_read_more']) !='') ? trim($params['display_post_read_more']) : '';
				$image_ratio = (isset($params['image_ratio']) && trim($params['image_ratio']) !='') ? trim($params['image_ratio']) : '';
				
				global $beeteam368_display_post_meta_override;
				$beeteam368_display_post_meta_override = array(
                    'level_2_scroll_to_play' => ($scroll_to_play === 'yes' ? 'on' : 'off'),
					'level_2_show_author' => ($display_author === 'yes' ? 'on' : 'off'),
					'level_2_show_excerpt' => ($display_excerpt === 'yes' ? 'on' : 'off'),
					'level_2_show_categories' => ($display_post_categories === 'yes' ? 'on' : 'off'),
					'level_2_show_published_date' => ($display_post_published_date === 'yes' ? 'on' : 'off'),
					'level_2_show_updated_date' => ($display_post_updated_date === 'yes' ? 'on' : 'off'),
					'level_2_show_reactions' => ($display_post_reactions === 'yes' ? 'on' : 'off'),
					'level_2_show_comments' => ($display_post_comments === 'yes' ? 'on' : 'off'),
					'level_2_show_views_counter' => ($display_post_views === 'yes' ? 'on' : 'off'),
					'level_2_show_duration' => ($display_duration === 'yes' ? 'on' : 'off'),
					'level_2_show_tag_label' => ($display_tag_label === 'yes' ? 'on' : 'off'),
					'level_2_show_view_details' => ($display_post_read_more === 'yes' ? 'on' : 'off'),
				);
				
				global $beeteam368_hide_element_id_tag;
				$beeteam368_hide_element_id_tag = 'hide';
				
				/*check in Beeteam368_Elementor_Addons_Elements::beeteam368_get_elements_block() if update*/
				global $beeteam368_img_size_ratio_overwrite;
				switch($image_ratio){
					case '16:9':
						switch($block_layout){
							case 'default':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_16x9_2x';
								break;
								
							case 'alyssa':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_16x9_1x';
								break;
								
							case 'leilani':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_16x9_1x';
								break;
								
							case 'lily':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_16x9_1x';
								break;
								
							case 'marguerite':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_16x9_0x';
								break;
								
							case 'rose':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_16x9_0x';
								break;
								
							case 'orchid':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_16x9_0x';
								break;
								
							case 'widget-classic':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_16x9_0x';
								break;
								
							case 'widget-special':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_16x9_0x';
								break;								
						}
						break;
					case '4:3':
						switch($block_layout){
							case 'default':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_4x3_2x';
								break;
								
							case 'alyssa':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_4x3_1x';
								break;
								
							case 'leilani':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_4x3_1x';
								break;
								
							case 'lily':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_4x3_1x';
								break;
								
							case 'marguerite':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_4x3_0x';
								break;
								
							case 'rose':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_4x3_0x';
								break;
								
							case 'orchid':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_4x3_0x';
								break;
								
							case 'widget-classic':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_4x3_0x';
								break;
								
							case 'widget-special':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_4x3_0x';
								break;						
						}
						break;
					case '1:1':
						switch($block_layout){
							case 'default':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_1x1_2x';
								break;
								
							case 'alyssa':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_1x1_1x';
								break;
								
							case 'leilani':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_1x1_1x';
								break;
								
							case 'lily':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_1x1_1x';
								break;
								
							case 'marguerite':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_1x1_0x';
								break;
								
							case 'rose':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_1x1_0x';
								break;
								
							case 'orchid':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_1x1_0x';
								break;
								
							case 'widget-classic':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_1x1_0x';
								break;
								
							case 'widget-special':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_1x1_0x';
								break;						
						}
						break;
					case '2:3':
						switch($block_layout){
							case 'default':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_2x3_2x';
								break;

								
							case 'alyssa':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_2x3_1x';
								break;
								
							case 'leilani':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_2x3_1x';
								break;
								
							case 'lily':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_2x3_1x';
								break;
								
							case 'marguerite':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_2x3_0x';
								break;
								
							case 'rose':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_2x3_0x';
								break;
								
							case 'orchid':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_2x3_0x';
								break;
								
							case 'widget-classic':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_2x3_1x';
								break;
								
							case 'widget-special':
								$beeteam368_img_size_ratio_overwrite = 'beeteam368_thumb_2x3_1x';
								break;						
						}
						break;			
				}
			}/*check in Beeteam368_Elementor_Addons_Elements::beeteam368_get_elements_block() if update*/
			
			
			
				if($posts->have_posts()){
					while ( $posts->have_posts() ) { 
						$posts->the_post();
						get_template_part( $template, $style );				
					}
				}
				
			$beeteam368_hide_element_id_tag = NULL;	
						
			if(isset($_POST['params'])){
				$beeteam368_img_size_ratio_overwrite = NULL;
				$beeteam368_display_post_meta_override = array();
			}			
			
			wp_reset_postdata();
				
		}
		die();
	}
endif;	
add_action( 'wp_ajax_beeteam368_loadmore_posts', 'beeteam368_loadmore_posts' );
add_action( 'wp_ajax_nopriv_beeteam368_loadmore_posts', 'beeteam368_loadmore_posts' );

if ( !function_exists('beeteam368_search_default_pagination' ) ):
	function beeteam368_search_default_pagination($pagination_type){
		if(is_search()){
			$pagination = beeteam368_get_redux_option('_search_pagination', '');
			if($pagination!=''){
				return $pagination;
			}
		}
		
		return $pagination_type;
	}
endif;
add_filter('beeteam368_default_pagination_type', 'beeteam368_search_default_pagination', 10, 1);

if ( !function_exists('beeteam368_search_default_ordering' ) ):
	function beeteam368_search_default_ordering($opt){
		if(is_search()){
			$_search_order = beeteam368_get_redux_option('_search_order', 'new');
			if($_search_order!=''){
				return $_search_order;
			}
		}
		
		return $opt;
	}
endif;
add_filter('beeteam368_archive_default_ordering', 'beeteam368_search_default_ordering', 10, 1);

if ( !function_exists('beeteam368_author_default_pagination' ) ):
	function beeteam368_author_default_pagination($pagination_type){
		if(is_author()){
			$pagination = beeteam368_get_redux_option('_author_pagination', '');
			if($pagination!=''){
				return $pagination;
			}
		}
		
		return $pagination_type;
	}
endif;
add_filter('beeteam368_default_pagination_type', 'beeteam368_author_default_pagination', 10, 1);

if ( !function_exists('beeteam368_author_default_ordering' ) ):
	function beeteam368_author_default_ordering($opt){
		if(is_author()){
			$_author_order = beeteam368_get_redux_option('_author_order', 'new');
			if($_author_order!=''){
				return $_author_order;
			}
		}
		
		return $opt;
	}
endif;
add_filter('beeteam368_archive_default_ordering', 'beeteam368_author_default_ordering', 10, 1);

if ( !function_exists('beeteam368_oembed_wrapper' ) ):
	function beeteam368_oembed_wrapper( $cache, $url, $attr, $post_ID ) {
		$classes = array();
	
		$classes_all = array(
			'whatever-embed-responsive',
		);
		
		$find = array('data-width="550"', 'data-width="640"');
		$rep = array('data-width="2560"', 'data-width="2560"');
		
		$add_wrapper = false;
	
		if ( false !== strpos( $url, 'vimeo.com' ) || false !== strpos( $url, 'youtube.com' ) || false !== strpos( $url, 'dailymotion.com') || false !== strpos( $url, 'wordpress.tv') ) {
			$classes[] = 'video-ratio-16-9';
			$add_wrapper = true;
		}
		
		if ( false !== strpos( $url, 'twitter.com' ) ) {
			$classes[] = 'twitter-ratio';
			
			$cache = str_replace($find, $rep, $cache);
			$add_wrapper = true;
		}
		
		if ( false !== strpos( $url, 'facebook.com' ) ) {
			$classes[] = 'facebook-ratio';
			
			$cache = str_replace($find, $rep, $cache);
			$add_wrapper = true;
		}
	
		$classes = array_merge( $classes, $classes_all );
	
		if($add_wrapper){
			return '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">' . $cache . '</div>';
		}else{
			return $cache;
		}
	}
endif;
add_filter( 'embed_oembed_html', 'beeteam368_oembed_wrapper', 99, 4 );

if ( !function_exists('beeteam368_blog_filter' ) ):
	function beeteam368_blog_filter($beeteam368_archive_style){
		
		global $wp_query;
		
		$archive_order = apply_filters('beeteam368_archive_default_ordering', beeteam368_get_redux_option('_archive_order', 'new'));		
		$query_order = $archive_order;		
			
		if(isset($_GET['sort_by']) && $_GET['sort_by']!=''){
			$query_order = $_GET['sort_by'];
		}
		
		$all_sort = apply_filters('beeteam368_all_sort_query', array(
			'new' => esc_html__('Newest Items', 'vidmov'),
			'old' => esc_html__('Oldest Items', 'vidmov'),
			'title_a_z' => esc_html__('Alphabetical (A-Z)', 'vidmov'),
			'title_z_a' => esc_html__('Alphabetical (Z-A)', 'vidmov'),							
		), 'default-archive-page');
		
		?>
		
		<div class="blog-info-filter site__row flex-row-control flex-row-space-between flex-vertical-middle filter-blog-style-<?php echo esc_attr($beeteam368_archive_style); ?>">               	
	
			<div class="posts-filter site__col">
				<div class="filter-block filter-block-control">
					<span class="default-item default-item-control">
						<i class="fas fa-sort-numeric-up-alt"></i>
						<span>
							<?php 
							$text_sort = esc_html__('Sort by: %s', 'vidmov');
							if(isset($all_sort[$query_order])){
								echo sprintf($text_sort, $all_sort[$query_order]);
							}?>
						</span>
						<i class="arr-icon fas fa-chevron-down"></i>
					</span>
					<div class="drop-down-sort drop-down-sort-control">
						<?php 
						$curr_URL = add_query_arg( array('paged' => '1'), beeteam368_get_nopaging_url());
						foreach($all_sort as $key => $value){
						?>
							<a href="<?php echo esc_url(add_query_arg(array('sort_by' => $key), $curr_URL));?>" title="<?php echo esc_attr($value)?>"><i class="fil-icon far fa-arrow-alt-circle-right"></i> <span><?php echo esc_html($value)?></span></a>
						<?php	
						}
						?>
					</div>
				</div>
			</div>
			
			<div class="total-posts site__col">
				<div class="total-posts-content">
					<i class="far fa-chart-bar"></i>
					<span>
						<?php 
						$text = esc_html__('There are %s items in this page', 'vidmov');
						echo sprintf($text, $wp_query->found_posts);
						?>
					</span>  
				</div>                    	                      
			</div>
			
		</div>
	<?php	
	}
endif;
add_action('beeteam368_before_archive_have_posts', 'beeteam368_blog_filter', 10, 1);
add_action('beeteam368_before_index_have_posts', 'beeteam368_blog_filter', 10, 1);
add_action('beeteam368_before_search_have_posts', 'beeteam368_blog_filter', 10, 1);
add_action('beeteam368_before_author_have_posts', 'beeteam368_blog_filter', 10, 1);

if ( !function_exists('beeteam368_article_element_id' ) ):
	function beeteam368_article_element_id($post_id){
		global $beeteam368_hide_element_id_tag;
		if(isset($beeteam368_hide_element_id_tag) && $beeteam368_hide_element_id_tag === 'hide'){
			return;
		}
		echo apply_filters('beeteam368_control_element_id_in_loop', 'id="post-'.esc_attr($post_id).'"', $post_id);
	}
endif;
add_action('beeteam368_article_element_id', 'beeteam368_article_element_id', 10, 1);

if ( !function_exists('beeteam368_author_element_id' ) ):
	function beeteam368_author_element_id($author_id){
		global $beeteam368_hide_element_id_tag;
		if(isset($beeteam368_hide_element_id_tag) && $beeteam368_hide_element_id_tag === 'hide'){
			return;
		}
		echo apply_filters('beeteam368_control_author_element_id_in_loop', 'id="author-'.esc_attr($author_id).'"', $author_id);
	}
endif;
add_action('beeteam368_author_element_id', 'beeteam368_author_element_id', 10, 1);

if(!function_exists('beeteam368_custom_comment_form')):
	function beeteam368_custom_comment_form($fields){
		
		$commenter 		= wp_get_current_commenter();
		$user 			= wp_get_current_user();
		$user_identity 	= $user->exists()?$user->display_name:'';
		
		$req 			= get_option('require_name_email');
		$aria_req 		= ($req ? ' required aria-required="true"':'');
		
		$fields['author'] 	= '<p class="comment-form-author"><input id="author" name="author" type="text" placeholder="'.esc_attr__('Your Name', 'vidmov').($req?' *':'').'" value="'.esc_attr($commenter['comment_author']).'"'.$aria_req.'></p>';
		$fields['email'] 	= '<p class="comment-form-email"><input id="email" placeholder="'.esc_attr__('Your Email', 'vidmov').($req?' *':'').'" name="email" type="email" value="'.esc_attr($commenter['comment_author_email']).'"'.$aria_req.'></p>';
		$fields['url'] 		= '<p class="comment-form-url"><input id="url" placeholder="' . esc_attr__('Your Website', 'vidmov').'" name="url" type="text" value="'.esc_attr($commenter['comment_author_url']).'"></p>';
		
		return $fields;
	}
endif;
add_filter('comment_form_default_fields', 'beeteam368_custom_comment_form');

if(!function_exists('beeteam368_tag_in_single')):
	function beeteam368_tag_in_single(){
		
		if(beeteam368_get_redux_option('_display_single_post_tags', 'on', 'switch') === 'off'){
			return;
		}
		
		$post_tags = get_the_tags();	
		if($post_tags){	
		?>
        	<h2 class="post-tags-title"><?php echo esc_html__('Tags', 'vidmov');?></h2>
            <div class="beeteam368-tags-in-single flex-row-control flex-vertical-middle">                
                
				<?php
                foreach($post_tags as $tag) {
                    echo '<a href="'.esc_url(get_tag_link($tag->term_id)).'" title="'.esc_attr($tag->name).'" class="tag-item font-size-12">'.esc_html($tag->name).'</a>'; 
                }		
                ?>
                    
            </div>
        <?php
		}
	}
endif;
add_action('beeteam368_after_content_post', 'beeteam368_tag_in_single', 20, 1);

if(!function_exists('beeteam368_prev_next_post_in_single')):
	function beeteam368_prev_next_post_in_single(){
		
		if(beeteam368_get_redux_option('_display_single_post_prev_next', 'on', 'switch') === 'off'){
			return;
		}
		
		if(class_exists('beeteam368_general')){
			$prev = beeteam368_general::get_adjacent_post_by_id(0, 'prev', '', '');
			$next = beeteam368_general::get_adjacent_post_by_id(0, 'next', '', '');			
		}else{
			$prev = beeteam368_get_adjacent_post_by_id(0, 'prev', '', '');
			$next = beeteam368_get_adjacent_post_by_id(0, 'next', '', '');
		}
		
		if($prev == 0 && $next == 0){
			return;
		}
	?>
    	<div class="prev-next-posts-container flex-vertical-middle">
        	<?php
            if($prev > 0){
				$thumb = trim(beeteam368_post_thumbnail($prev, apply_filters('beeteam368_post_thumbnail_params', array('size' => 'thumbnail', 'ratio' => 'img-1x1', 'position' => 'prev_next_post_in_single', 'html' => 'img-only', 'echo' => false), $prev)));
				?>
                <div class="nav-post-in-single nav-post-prev">
                	<a class="prev-next-title h5 flex-vertical-middle" href="<?php echo esc_url(beeteam368_get_post_url($prev));?>" title="<?php echo esc_attr(get_the_title($prev));?>"><i class="fas fa-long-arrow-alt-left"></i><span><?php echo esc_html__('Prev', 'vidmov');?></span></a>
                    <div class="flex-vertical-middle">
                    	<div class="nav-post-thumb"><?php echo apply_filters('beeteam368_thum_img_in_single_prev_post', $thumb, $prev);?></div>
                        <h3 class="h4 h5-mobile post-title"> 
                            <a href="<?php echo esc_url(beeteam368_get_post_url($prev));?>" title="<?php echo esc_attr(get_the_title($prev));?>"><?php echo esc_html(get_the_title($prev));?></a> 
                        </h3>
                    </div>
                </div>
                <?php
			}	
			?>
            
            <?php
            if($next > 0){
				$thumb = trim(beeteam368_post_thumbnail($next, apply_filters('beeteam368_post_thumbnail_params', array('size' => 'thumbnail', 'ratio' => 'img-1x1', 'position' => 'prev_next_post_in_single', 'html' => 'img-only', 'echo' => false), $next)));
				?>
                <div class="nav-post-in-single nav-post-next">
                	<a class="prev-next-title h5 flex-vertical-middle" href="<?php echo esc_url(beeteam368_get_post_url($next));?>" title="<?php echo esc_attr(get_the_title($next));?>"><span><?php echo esc_html__('Next', 'vidmov');?></span><i class="fas fa-long-arrow-alt-right"></i></a>
                    <div class="flex-vertical-middle">     
                    	<div class="nav-post-thumb"><?php echo apply_filters('beeteam368_thum_img_in_single_next_post', $thumb, $next);?></div>               	
                        <h3 class="h4 h5-mobile post-title"> 
                            <a href="<?php echo esc_url(beeteam368_get_post_url($next));?>" title="<?php echo esc_attr(get_the_title($next));?>"><?php echo esc_html(get_the_title($next));?></a> 
                        </h3>                        
                    </div>
                </div>
                <?php
			}	
			?>
        </div>
    <?php	
	}
endif;
add_action('beeteam368_after_article_post', 'beeteam368_prev_next_post_in_single', 10, 1);

if(!function_exists('beeteam368_related_post_in_single')):
	function beeteam368_related_post_in_single(){
		if(beeteam368_get_redux_option('_display_single_related_posts', 'on', 'switch') === 'off'){
			return;
		}
		
		if (!defined('BEETEAM368_PREFIX')) {
			define('BEETEAM368_PREFIX', 'beeteam368');
		}
		
		$post_id = get_the_ID();
		$post_type = get_post_type($post_id);
		$rnd_id = 'beeteam368_related_' . rand(1, 99999) . time();
		
		$_single_post_related_title = beeteam368_get_redux_option('_single_post_related_title', esc_html__('Related Posts', 'vidmov'));
		$_single_post_related_query = beeteam368_get_redux_option('_single_post_related_query', 'cats');
		$_single_post_related_order = beeteam368_get_redux_option('_single_post_related_order', 'new');
		$_single_post_related_sort = beeteam368_get_redux_option('_single_post_related_sort', 'DESC');		
		
		$_single_post_related_count = beeteam368_get_redux_option('_single_post_related_count', '10');
		$items_per_page = is_numeric($_single_post_related_count) ? (float)$_single_post_related_count : 10;
		$post_count = apply_filters('beeteam368_max_related_posts', $items_per_page * 3);
		
		$_single_post_related_loop_style = beeteam368_get_redux_option('_single_post_related_loop_style', 'marguerite');	
		
		$args_query = array(
			'post_type'             => $post_type,
			'post_status'           => 'publish',
			'posts_per_page'        => $_single_post_related_count,			
			'post__not_in'          => array($post_id),
			'ignore_sticky_posts'   => 1,
		);
		
		switch($_single_post_related_order){
			case 'date':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['orderby'] = 'date';
				break;
				
			case 'ID':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['orderby'] = 'ID';
				break;	
				
			case 'author':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['orderby'] = 'author';
				break;	
				
			case 'title':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['orderby'] = 'title';
				break;	
				
			case 'modified':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['orderby'] = 'modified';
				break;	
				
			case 'parent':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['orderby'] = 'parent';
				break;	
				
			case 'comment_count':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['orderby'] = 'comment_count';
				break;						
				
			case 'menu_order':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['orderby'] = 'menu_order';	
				break;
				
			case 'rand':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['orderby'] = 'rand';	
				break;
				
			case 'post__in':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['orderby'] = 'post__in';
				break;
				
			case 'rating':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['meta_key'] = BEETEAM368_PREFIX . '_reviews_data_percent';
				$args_query['orderby'] = 'meta_value_num';
				break;
					
			case 'like':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['meta_key'] = BEETEAM368_PREFIX . '_reactions_like';
				$args_query['orderby'] = 'meta_value_num';
				break;
				
			case 'dislike':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['meta_key'] = BEETEAM368_PREFIX . '_reactions_dislike';
				$args_query['orderby'] = 'meta_value_num';
				break;
				
			case 'squint_tears':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['meta_key'] = BEETEAM368_PREFIX . '_reactions_squint_tears';
				$args_query['orderby'] = 'meta_value_num';
				break;
				
			case 'cry':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['meta_key'] = BEETEAM368_PREFIX . '_reactions_cry';
				$args_query['orderby'] = 'meta_value_num';
				break;
				
			case 'reactions':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['meta_key'] = BEETEAM368_PREFIX . '_reactions_total';
				$args_query['orderby'] = 'meta_value_num';
				break;	
				
			case 'most_viewed':
				$args_query['order'] = $_single_post_related_sort;
				$args_query['meta_key'] = BEETEAM368_PREFIX . '_views_counter_totals';
				$args_query['orderby'] = 'meta_value_num';
				break;
				
			case 'most_viewed_week':
				
				$current_day        = current_time('Y_m_d');
				$current_week       = current_time('W');
				$current_month      = current_time('m');
				$current_year       = current_time('Y');
				
				$meta_current_week  = BEETEAM368_PREFIX . '_views_counter_week_'.$current_week.'_'.$current_year;
				
				$args_query['order'] = $_single_post_related_sort;
				$args_query['meta_key'] = $meta_current_week;
				$args_query['orderby'] = 'meta_value_num';
				break;
				
			case 'most_viewed_month':
				
				$current_day        = current_time('Y_m_d');
				$current_week       = current_time('W');
				$current_month      = current_time('m');
				$current_year       = current_time('Y');
				
				$meta_current_month = BEETEAM368_PREFIX . '_views_counter_month_'.$current_month.'_'.$current_year;
				
				$args_query['order'] = $_single_post_related_sort;
				$args_query['meta_key'] = $meta_current_month;
				$args_query['orderby'] = 'meta_value_num';
				break;
				
			case 'most_viewed_year':
				
				$current_day        = current_time('Y_m_d');
				$current_week       = current_time('W');
				$current_month      = current_time('m');
				$current_year       = current_time('Y');
				
				$meta_current_year  = BEETEAM368_PREFIX . '_views_counter_year_'.$current_year;
			
				$args_query['order'] = $_single_post_related_sort;
				$args_query['meta_key'] = $meta_current_year;
				$args_query['orderby'] = 'meta_value_num';
				break;					
		}
		
		switch($_single_post_related_query){
			case 'cats':
				$cats = array();
				
				$tax = 'category';
				if($post_type != 'post'){
					$tax = $post_type.'_category';
				}
				
				$terms = get_the_terms($post_id, $tax);
				if($terms && !is_wp_error($terms) && count($terms) > 0){
					foreach($terms as $term){
						array_push($cats, $term->term_id);
					}
					
					$args_query['tax_query'] = array(
						array(
							'taxonomy'  => $tax,
							'field'    	=> 'id',
							'terms'     => $cats,
							'operator'  => 'IN',
						)
					);
				}		
				break;
				
			case 'tags':
				
				$tags = array();
				$post_tags = wp_get_post_tags( $post_id );
				
				if ( ! empty( $post_tags ) && count($post_tags) > 0) {
					foreach( $post_tags as $tag ) {						
						array_push($tags, $tag->term_id);
					}
					
					$args_query['tag__in'] =  $tags;
					
				}	
				break;
		}
		
		$args_query = apply_filters('beeteam368_related_posts_query', $args_query);				
        $query = new WP_Query($args_query);
		
		if($query->have_posts()):
			$query_vars = $query->query_vars;
			
			if(isset($query_vars['cat'])){
				$query_vars['cat'] = '';
			}
			
			if(isset($query_vars['tag_id'])){
				$query_vars['tag_id'] = '';
			}
		
			/*page calculator*/
			$total_posts = $post_count;
			$found_posts = $query->found_posts;
			
			if(is_numeric($total_posts) && $total_posts != -1 && $found_posts > $total_posts){						
				$found_posts = $total_posts;						
			}
			
			if($items_per_page > $total_posts && $total_posts != -1){
				$items_per_page = $total_posts;
			}
			
			if($items_per_page > $found_posts){
				$items_per_page = $found_posts;
			}
			
			$paged_calculator	= 1;
			$percentItems		= 0;
			
			if($found_posts > $items_per_page) {
				$percentItems = $found_posts % $items_per_page;	
					
				if($percentItems != 0){
					$paged_calculator = ceil($found_posts / $items_per_page);
				}else{
					$paged_calculator = $found_posts / $items_per_page;
				}
				
			}
			
			$max_num_pages = $paged_calculator;
			/*page calculator*/
			?>
            
            <div class="beeteam368-related-posts">
            	
                <div class="top-section-title has-icon">
                    <span class="beeteam368-icon-item"><i class="far fa-newspaper"></i></span>
                    <span class="sub-title font-main"><?php echo apply_filters('beeteam368_related_posts_heading_sub_title', esc_html($found_posts).' '.esc_html__('Related Posts', 'vidmov'), $found_posts, $post_id, $post_type);?></span>
                    <h2 class="h2 h3-mobile main-title-heading">                            
                        <span class="main-title"><?php echo apply_filters('beeteam368_related_posts_heading_title', esc_html($_single_post_related_title), $post_id, $post_type);?></span> <span class="hd-line"></span>
                    </h2>
                </div>
                
                <div id="<?php echo esc_attr($rnd_id);?>" class="blog-wrapper global-blog-wrapper blog-wrapper-control flex-row-control site__row blog-style-<?php echo esc_attr($_single_post_related_loop_style); ?>">
                    <?php			
                    while($query->have_posts()):
                        $query->the_post();
						get_template_part('template-parts/archive/item', $_single_post_related_loop_style);
                    endwhile;
                    ?>
                </div>
                    
                <?php
				if(class_exists('beeteam368_general')){    
                	do_action('beeteam368_dynamic_query', $rnd_id, $query_vars);
                	do_action('beeteam368_pagination', 'template-parts/archive/item', $_single_post_related_loop_style, 'loadmore-btn', NULL, array('append_id' => '#'.$rnd_id, 'total_pages' => $max_num_pages, 'query_id' => $rnd_id, 'percent_items' => $percentItems));
				}
                ?>
                
            </div>
            <?php
		endif;
        wp_reset_postdata();
	}
endif;	
add_action('beeteam368_after_article_post', 'beeteam368_related_post_in_single', 10, 1);

if(!function_exists('beeteam368_nav_breadcrumbs')):
	function beeteam368_nav_breadcrumbs($beeteam368_header_style){
		
		global $beeteam368_breadcrumbs_displayed;
		
		if($beeteam368_breadcrumbs_displayed === 1){
			return;
		}
		
		if(beeteam368_get_redux_option('_nav_breadcrumbs', 'off', 'switch') === 'off' || is_page_template('elementor_canvas') || is_page_template('elementor_header_footer') || is_page_template('page-templates/blank-page-template-with-sidebar.php') || is_page_template('page-templates/blank-page-template.php') || is_page_template('redux-templates_contained') || is_page_template('redux-templates_full_width') || is_page_template('redux-templates_canvas')){
			return;
		}
		
		$accept_html = array( 
			'div' => array('class' => array()), 
			'i' => array('class' => array()), 
			'span' => array('class' => array()), 
			'a' => array('class' => array(), 'href' => array()) 
		);
		
		$output_string = '';
		
		ob_start();
		
			$text['home']     = esc_html__('Home', 'vidmov');
			$text['category'] = esc_html__('%s', 'vidmov');
			$text['search']   = esc_html__('Search Results for "%s" Query', 'vidmov');
			$text['tag']      = esc_html__('Posts Tagged "%s"', 'vidmov');
			$text['author']   = esc_html__('Articles Posted by %s', 'vidmov');
			$text['404']      = esc_html__('Error 404', 'vidmov');
		
			$show_current   = 1;
			$show_home_link = 1;
			$show_title     = 1;
			$delimiter      = ' <i class="fas fa-angle-double-right"></i> ';
			$before         = '<span class="current">';
			$after          = '</span>';
		
			global $post;
			
			$home_link    = home_url('/');
			$link_before  = '<span>';
			$link_after   = '</span>';
			$link_attr    = 'class="neutral"';
			$link         = $link_before . '<a ' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
			
			$post == is_singular() ? get_queried_object() : false;
				
			if( $post ){
				$parent_id    = $parent_id_2 = $post->post_parent;
			} else {
				$parent_id    = $parent_id_2 = 0;
			}
			
			$frontpage_id = get_option('page_on_front');
		
			if (!is_home() && !is_front_page()) {
		
				echo '<div class="nav-breadcrumbs nav-font nav-font-size-13 '. esc_attr(beeteam368_container_classes_control('nav_breadcrumbs')) .'"><div class="site__row flex-row-control"><div class="site__col"><div class="nav-breadcrumbs-wrap">';
				
				if ($show_home_link == 1) {
					echo '<a '.$link_attr.' href="' . esc_url($home_link) . '"><i class="fas fa-home"></i>&nbsp;&nbsp;' . esc_html($text['home']) . '</a>';
					if ($frontpage_id == 0 || $parent_id != $frontpage_id) {
						echo wp_kses($delimiter, $accept_html);
					}
				}
		
				if ( is_category() ) {
					$this_cat = get_category(get_query_var('cat'), false);
					if ($this_cat->parent != 0) {
						$cats = get_category_parents($this_cat->parent, TRUE, $delimiter);
						if ($show_current == 0) {
							$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
						}
						$cats = str_replace('<a', $link_before . '<a ' . $link_attr, $cats);
						$cats = str_replace('</a>', '</a>' . $link_after, $cats);
						if ($show_title == 0) {
							$cats = preg_replace('/ title="(.*?)"/', '', $cats);
						}
						echo wp_kses($cats, $accept_html);
					}
					if ($show_current == 1) {
						echo wp_kses($before . sprintf($text['category'], single_cat_title('', false)) . $after, $accept_html);
					}
		
				} elseif ( is_search() ) {
					echo wp_kses($before . sprintf($text['search'], get_search_query()) . $after, $accept_html);
		
				} elseif ( is_day() ) {
					echo wp_kses(sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter, $accept_html);
					echo wp_kses(sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter, $accept_html);
					echo wp_kses($before . get_the_time('d') . $after, $accept_html);
		
				} elseif ( is_month() ) {
					echo wp_kses(sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter, $accept_html);
					echo wp_kses($before . get_the_time('F') . $after, $accept_html);
		
				} elseif ( is_year() ) {
					echo wp_kses($before . get_the_time('Y') . $after, $accept_html);
		
				} elseif ( is_single() && !is_attachment() ) {
					if ( get_post_type() != 'post' ) {
						$post_type = get_post_type_object(get_post_type());					
						$slug = $post_type->rewrite;
						if(is_array($slug) && isset($slug['slug'])){
							printf($link, $home_link . $slug['slug'] . '/', $post_type->labels->singular_name);
						}else{
							echo esc_html($post_type->labels->singular_name);
						}
						if ($show_current == 1) {
							echo wp_kses($delimiter . $before . get_the_title() . $after, $accept_html);
						}
					} else {
						$cat = get_the_category(); $cat = $cat[0];
						$cats = get_category_parents($cat, TRUE, $delimiter);
						if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
						$cats = str_replace('<a', $link_before . '<a ' . $link_attr, $cats);
						$cats = str_replace('</a>', '</a>' . $link_after, $cats);
						if ($show_title == 0) {
							$cats = preg_replace('/ title="(.*?)"/', '', $cats);
						}
						echo wp_kses($cats, $accept_html);
						if ($show_current == 1) {
							echo wp_kses($before . get_the_title() . $after, $accept_html);
						}
					}
		
				} elseif ( is_attachment() ) {
					$parent = get_post($parent_id);
					$cat = get_the_category($parent->ID);
					if( isset($cat[0]) ){ 
						$cat = $cat[0];
					}
					if ($cat) {
						$cats = get_category_parents($cat, TRUE, $delimiter);
						$cats = str_replace('<a', $link_before . '<a' . $link_attr, $cats);
						$cats = str_replace('</a>', '</a>' . $link_after, $cats);
						if ($show_title == 0) {
							$cats = preg_replace('/ title="(.*?)"/', '', $cats);
						}
						echo wp_kses($cats, $accept_html);
					}
					printf($link, get_permalink($parent), $parent->post_title);
					if ($show_current == 1) {
						echo wp_kses($delimiter . $before . get_the_title() . $after, $accept_html);
					}
		
				} elseif ( is_page() && !$parent_id ) {
					if ($show_current == 1) {
						echo wp_kses($before . get_the_title() . $after, $accept_html);
					}
		
				} elseif ( is_page() && $parent_id ) {
					if ($parent_id != $frontpage_id) {
						$breadcrumbs = array();
						while ($parent_id) {
							$page = get_page($parent_id);
							if ($parent_id != $frontpage_id) {
								$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
							}
							$parent_id = $page->post_parent;
						}
						$breadcrumbs = array_reverse($breadcrumbs);
						for ($i = 0; $i < count($breadcrumbs); $i++) {
							echo wp_kses($breadcrumbs[$i], $accept_html);
							if ($i != count($breadcrumbs)-1) {
								echo wp_kses($delimiter, $accept_html);
							}
						}
					}
					if ($show_current == 1) {
						if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) {
							echo wp_kses($delimiter, $accept_html);
						}
						echo wp_kses($before . get_the_title() . $after, $accept_html);
					}
		
				} elseif ( is_tag() ) {
					echo wp_kses($before . sprintf($text['tag'], single_tag_title('', false)) . $after, $accept_html);
		
				} elseif ( is_author() ) {
					global $author;
					$userdata = get_userdata($author);
					echo wp_kses($before . sprintf($text['author'], $userdata->display_name) . $after, $accept_html);
		
				} elseif ( is_404() ) {
					echo wp_kses($before . $text['404'] . $after, $accept_html);
		
				} elseif ( has_post_format() && !is_singular() ) {
					echo get_post_format_string( get_post_format() );
					
				} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
					if(is_archive()){
						echo wp_kses($before . get_the_archive_title() . $after, $accept_html);
					}else{
						$post_type = get_post_type_object(get_post_type());
						echo wp_kses($before . $post_type->labels->singular_name . $after, $accept_html);
					}				
		
				}
		
				if ( get_query_var('paged') ) {
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_single() ) echo ' (';
					echo esc_html__('Page', 'vidmov') . ' ' . get_query_var('paged');
					if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_single() ) echo ')';
				}
		
				echo '</div></div></div></div>';
		
			}
		
		$output_string = ob_get_contents();
		ob_end_clean();
		
		$return = false;
		
		if(!$return){
			echo wp_kses($output_string, $accept_html);
			return;
		}else{
			return wp_kses($output_string, $accept_html);
		}
	}
endif;
add_action( 'beeteam368_after_header', 'beeteam368_nav_breadcrumbs', 10 );

if(!function_exists('beeteam368_standard_post_featured_image')){
	function beeteam368_standard_post_featured_image(){
		$post_id = get_the_ID();
		
		$post_type = get_post_type($post_id);
		$post_format = get_post_format($post_id);
		
		if($post_type == 'post' && $post_format != 'gallery'){
			$beeteam368_post_thumbnail = trim(beeteam368_post_thumbnail($post_id, apply_filters('beeteam368_single_featured_image', array('echo' => false, 'size' => 'full', 'ratio' => 'img-16x9', 'position' => 'single_featured_image', 'html' => 'img-only'), $post_id)));
			if($beeteam368_post_thumbnail!=''){
		?>
        		<div class="single-featured-image">
            		<?php echo apply_filters('beeteam368_featured_image_in_standard_post', $beeteam368_post_thumbnail);?>
            	</div>
        <?php	
			}
		}elseif($post_type == 'post' && $post_format == 'gallery'){
			
			$html = '';				
			$imgs = get_children( array( 
				'post_parent' => $post_id, 
				'post_type' => 'attachment', 
				'post_mime_type' => 'image', 
				'numberposts' => 333,
			) );
			
			if( count($imgs) > 0 ){
				$html .= '<div class="single-featured-image single-image-gallery is-single-slider swiper"><div class="swiper-wrapper">';
				foreach($imgs as $attachment_id => $attachment){
					$image = wp_get_attachment_image_src( $attachment_id ,'full');
					$html .= '<div class="swiper-slide"><img src="'.esc_url($image[0]).'" alt="'.esc_attr($attachment->post_title).'" width="'.esc_attr($image[1]).'" height="'.esc_attr($image[2]).'" class="img-gallery-silder"></div>';
				}
				$html .= '</div><div class="swiper-button-next"></div><div class="swiper-button-prev"></div><div class="swiper-pagination"></div></div>';
				
				echo apply_filters('beeteam368_gallery_image_in_gallery_post', $html);
			}
		}
		
	}
}

add_action( 'beeteam368_before_content_post', 'beeteam368_standard_post_featured_image', 10 );

if(!function_exists('beeteam368_widget_ads_above_content')){
	function beeteam368_widget_ads_above_content(){
		if (is_active_sidebar('ads-above-single-post-content-sidebar')) {
		?>
        	<div class="above-content-sidebar general-custom-postion-sidebar">
            	<div class="sidebar-content">
            		<?php dynamic_sidebar('ads-above-single-post-content-sidebar');?>
                </div>
            </div>				
        <?php    
		}
	}
}

add_action( 'beeteam368_after_title_content_post', 'beeteam368_widget_ads_above_content', 10 );
add_action( 'beeteam368_after_player_in_single_video', 'beeteam368_widget_ads_above_content', 10 );
add_action( 'beeteam368_after_player_in_single_audio', 'beeteam368_widget_ads_above_content', 10 );

if(!function_exists('beeteam368_widget_ads_bellow_content')){
	function beeteam368_widget_ads_bellow_content(){
		if (is_active_sidebar('ads-below-single-post-content-sidebar')) {
		?>
        	<div class="above-content-sidebar general-custom-postion-sidebar is-bellow-single-post">
            	<div class="sidebar-content">
            		<?php dynamic_sidebar('ads-below-single-post-content-sidebar');?>
                </div>
            </div>				
        <?php    
		}
	}
}

add_action( 'beeteam368_after_content_post', 'beeteam368_widget_ads_bellow_content', 90 );

if(!function_exists('beeteam368_single_sub_title')){
	function beeteam368_single_sub_title(){
		global $beeteam368_single_subtitle_sp;
        if($beeteam368_single_subtitle_sp != NULL && $beeteam368_single_subtitle_sp != ''){
        ?>
            <h2 class="h5 single-sub-title"><?php echo esc_html($beeteam368_single_subtitle_sp);?></h2>
        <?php
            $beeteam368_single_subtitle_sp = NULL;
        }
	}
}

add_action( 'beeteam368_after_inner_title_content_post', 'beeteam368_single_sub_title' );