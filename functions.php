<?php
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

if ( ! function_exists( 'beeteam368_register_required_plugins' ) ) :
	function beeteam368_register_required_plugins() {
		
		$template_directory = get_template_directory();
		
		$plugins = array(
		
			array(
				'name'               => esc_html__( 'BeeTeam368 Extensions', 'vidmov'), 
				'slug'               => 'beeteam368-extensions',
				'source'             => $template_directory . '/inc/plugins/beeteam368-extensions-2.3.0.zip',
				'required'           => true,
				'version'            => '2.3.0',
			),
			
			array(
				'name'               => esc_html__( 'BeeTeam368 Extensions Pro', 'vidmov'), 
				'slug'               => 'beeteam368-extensions-pro',
				'source'             => $template_directory . '/inc/plugins/beeteam368-extensions-pro-2.3.0.zip',
				'required'           => true,
				'version'            => '2.3.0',
			),
			
			array(
				  'name'     => esc_html__('CMB2', 'vidmov'),
				  'slug'     => 'cmb2',
				  'required' => true
			),
			
			array(
				  'name'     => esc_html__('Redux Framework', 'vidmov'),
				  'slug'     => 'redux-framework',
				  'required' => true
			),
			
			array(
				  'name'     => esc_html__('Elementor', 'vidmov'),
				  'slug'     => 'elementor',
				  'required' => true
			),			
			
			array(
				  'name'     => esc_html__('WP PageNavi', 'vidmov'),
				  'slug'     => 'wp-pagenavi',
				  'required' => true
			),
			
			array(
				  'name'     => esc_html__('myCred', 'vidmov'),
				  'slug'     => 'mycred',
				  'required' => true
			),
			
			array(
				  'name'     => esc_html__('Theme My Login', 'vidmov'),
				  'slug'     => 'theme-my-login',
				  'required' => true
			),
			
			array(
				  'name'     => esc_html__('Sassy Social Share', 'vidmov'),
				  'slug'     => 'sassy-social-share',
				  'required' => true
			),
			
			array(
				  'name'     => esc_html__('One Click Demo Import', 'vidmov'),
				  'slug'     => 'one-click-demo-import',
				  'required' => true
			),
		);
	
		$config = array(
			'id'           => 'vidmov',             
			'default_path' => '',                      
			'menu'         => 'tgmpa-install-plugins', 
			'has_notices'  => true,                   
			'dismissable'  => true,                   
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',			
		);
	
		tgmpa( $plugins, $config );
	}
endif;
add_action( 'tgmpa_register', 'beeteam368_register_required_plugins' );

require get_template_directory() . '/inc/theme-options/theme-options.php';

/*get option fnc*/
if (!function_exists('beeteam368_get_option')):
    function beeteam368_get_option($option, $section, $default = '')
    {

        if (!defined('BEETEAM368_PREFIX')) {
            define('BEETEAM368_PREFIX', 'beeteam368');
        }

        $options = get_option(BEETEAM368_PREFIX . $section);

        if (isset($options[BEETEAM368_PREFIX . $option])) {
            return $options[BEETEAM368_PREFIX . $option];
        }

        return $default;
    }
endif;/*get option fnc*/

/*get redux option fnc*/
if (!function_exists('beeteam368_get_redux_option')):
    function beeteam368_get_redux_option($id, $default_value = '', $type = NULL)
    {

        if (!defined('BEETEAM368_PREFIX')) {
            define('BEETEAM368_PREFIX', 'beeteam368');
        }

        global $beeteam368_theme_options;

        if (isset($beeteam368_theme_options) && is_array($beeteam368_theme_options) && isset($beeteam368_theme_options[BEETEAM368_PREFIX . $id]) && $beeteam368_theme_options[BEETEAM368_PREFIX . $id] != '') {

            switch ($type) {
                case 'switch':
                    if ($beeteam368_theme_options[BEETEAM368_PREFIX . $id] == 1) {
                        return 'on';
                    } else {
                        return 'off';
                    }
                    break;

                case 'media_get_src':
                    if (is_array($beeteam368_theme_options[BEETEAM368_PREFIX . $id]) && isset($beeteam368_theme_options[BEETEAM368_PREFIX . $id]['url']) && $beeteam368_theme_options[BEETEAM368_PREFIX . $id]['url'] != '') {
                        return trim($beeteam368_theme_options[BEETEAM368_PREFIX . $id]['url']);
                    } else {
                        return $default_value;
                    }
                    break;

                case 'media_get_id':
                    if (is_array($beeteam368_theme_options[BEETEAM368_PREFIX . $id]) && isset($beeteam368_theme_options[BEETEAM368_PREFIX . $id]['id']) && $beeteam368_theme_options[BEETEAM368_PREFIX . $id]['id'] != '') {
                        return trim($beeteam368_theme_options[BEETEAM368_PREFIX . $id]['id']);
                    } else {
                        return $default_value;
                    }
                    break;
            }

            return $beeteam368_theme_options[BEETEAM368_PREFIX . $id];

        }

        return $default_value;
    }
endif;/*get redux option fnc*/

if (!function_exists('beeteam368_ajax_verify_nonce')) :
    function beeteam368_ajax_verify_nonce($nonce, $login = true)
    {

        if (beeteam368_get_option('_wp_nonces', '_theme_settings', 'on') == 'off') {
            return true;
        }

        if (!defined('BEETEAM368_PREFIX')) {
            define('BEETEAM368_PREFIX', 'beeteam368');
        }

        $beeteam368_theme = wp_get_theme();
        $beeteam368_theme_version = $beeteam368_theme->get('Version');
        $beeteam368_theme_name = $beeteam368_theme->get('Name');

        $require_login = $login ? 'true' : var_export(is_user_logged_in(), true);
        if (!wp_verify_nonce(trim($nonce), BEETEAM368_PREFIX . $beeteam368_theme_version . $beeteam368_theme_name . $require_login)) {
            return false;
        }

        return true;
    }
endif;

if (!function_exists('beeteam368_setup')) :
    function beeteam368_setup()
    {
        load_theme_textdomain('vidmov', get_template_directory() . '/languages');

        add_theme_support('automatic-feed-links');

        add_theme_support('title-tag');

        add_theme_support('post-formats', array('video', 'audio', 'gallery', 'quote'));

        add_theme_support('post-thumbnails');

        add_theme_support('custom-header', array());
        
        add_theme_support('buddypress-use-legacy');

        register_nav_menus(array(
            'beeteam368-MainMenu' => esc_html__('Main Menu', 'vidmov'),
            'beeteam368-SideMenu' => esc_html__('Side Menu', 'vidmov'),
            'beeteam368-DropDownLoginTop' => esc_html__('[Top] Dropdown after Logged in', 'vidmov'),
            'beeteam368-DropDownLoginBottom' => esc_html__('[Bottom] Dropdown after Logged in', 'vidmov'),
        ));

        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
			'script',
			'style'
        ));

        add_theme_support('custom-background', apply_filters('beeteam368_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        add_theme_support('customize-selective-refresh-widgets');

        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));
		
		remove_theme_support( 'widgets-block-editor' );
    }
endif;
add_action('after_setup_theme', 'beeteam368_setup');

if (!function_exists('beeteam368_content_width')) :
    function beeteam368_content_width()
    {
        $GLOBALS['content_width'] = apply_filters('beeteam368_content_width', 640);
    }
endif;
add_action('after_setup_theme', 'beeteam368_content_width', 0);

if (!function_exists('beeteam368_widgets_init')) :
    function beeteam368_widgets_init()
    {
        register_sidebar(array(
            'name' => esc_html__('Main Sidebar', 'vidmov'),
            'id' => 'main-sidebar',
            'description' => esc_html__('Add widgets here.', 'vidmov'),
            'before_widget' => '<div id="%1$s" class="widget r-widget-control %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="h3 widget-title flex-row-control flex-vertical-middle"><span class="beeteam368-icon-item"><i class="fas fa-heart"></i></span><span class="widget-title-wrap max-1line">',
            'after_title' => '<span class="wg-line"></span></span></h2>',
        ));

        register_sidebar(array(
            'name' => esc_html__('Footer Sidebar', 'vidmov'),
            'id' => 'footer-sidebar',
            'description' => esc_html__('Add widgets here.', 'vidmov'),
            'before_widget' => '<div id="%1$s" class="site__col widget r-widget-control %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="h3 widget-title flex-row-control flex-vertical-middle"><span class="beeteam368-icon-item"><i class="fas fa-feather-alt"></i></span><span class="widget-title-wrap">',
            'after_title' => '<span class="wg-line"></span></span></h2>',
        ));

        register_sidebar(array(
            'name' => esc_html__('Side Menu - Sidebar', 'vidmov'),
            'id' => 'sidemenu-sidebar',
            'description' => esc_html__('Add widgets here.', 'vidmov'),
            'before_widget' => '<div id="%1$s" class="widget r-widget-control %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="h5 widget-title flex-row-control flex-vertical-middle"><span class="beeteam368-icon-item"><i class="fas fa-cogs"></i></span><span class="widget-title-wrap">',
            'after_title' => '<span class="wg-line"></span></span></h2>',
        ));
		
		register_sidebar(array(
            'name' => esc_html__('Ads - Above Single Post Content', 'vidmov'),
            'id' => 'ads-above-single-post-content-sidebar',
            'description' => esc_html__('Add widgets here.', 'vidmov'),
            'before_widget' => '<div id="%1$s" class="widget r-widget-control %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="h5 widget-title flex-row-control flex-vertical-middle"><span class="beeteam368-icon-item"><i class="fas fa-cogs"></i></span><span class="widget-title-wrap">',
            'after_title' => '<span class="wg-line"></span></span></h2>',
        ));
		
		register_sidebar(array(
            'name' => esc_html__('Ads - Below Single Post Content', 'vidmov'),
            'id' => 'ads-below-single-post-content-sidebar',
            'description' => esc_html__('Add widgets here.', 'vidmov'),
            'before_widget' => '<div id="%1$s" class="widget r-widget-control %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="h5 widget-title flex-row-control flex-vertical-middle"><span class="beeteam368-icon-item"><i class="fas fa-cogs"></i></span><span class="widget-title-wrap">',
            'after_title' => '<span class="wg-line"></span></span></h2>',
        ));
        
        register_sidebar(array(
            'name' => esc_html__('BuddyPress Sidebar', 'vidmov'),
            'id' => 'buddypress-sidebar',
            'description' => esc_html__('Add widgets here.', 'vidmov'),
            'before_widget' => '<div id="%1$s" class="widget r-widget-control %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="h3 widget-title flex-row-control flex-vertical-middle"><span class="beeteam368-icon-item"><i class="fas fa-heart"></i></span><span class="widget-title-wrap max-1line">',
            'after_title' => '<span class="wg-line"></span></span></h2>',
        ));
    }
endif;
add_action('widgets_init', 'beeteam368_widgets_init');

if (!function_exists('beeteam368_fontawesome')) :
    function beeteam368_fontawesome()
    {
        wp_register_style(
            'font-awesome-5-all',
            get_template_directory_uri() . '/css/font-awesome/css/all.min.css',
            array(),
            '5.15.4'
        );
    }
endif;
add_action('wp_enqueue_scripts', 'beeteam368_fontawesome', 1);

if (!function_exists('beeteam368_scripts')) :
    function beeteam368_scripts()
    {

        if (!defined('BEETEAM368_PREFIX')) {
            define('BEETEAM368_PREFIX', 'beeteam368');
        }

        global $wp_query, $wp;
        $define_js_object = array();

        $template_directory_uri = get_template_directory_uri();
        $beeteam368_header_style = beeteam368_header_style();
        $beeteam368_theme = wp_get_theme();
        $beeteam368_theme_version = $beeteam368_theme->get('Version');
        $beeteam368_theme_name = $beeteam368_theme->get('Name');
		
		$swiper_libraries = is_single() && get_post_type() === 'post' && get_post_format() === 'gallery';

        $_disable_google_fonts = beeteam368_get_redux_option('_disable_google_fonts', 'off', 'switch');
        if($_disable_google_fonts === 'off'){

            $google_fonts = array('Play:wght@400;700');
            $google_fonts_string = '';

            $font_properties_name = array(
                'main', 'heading', 'navigation', 'meta', 'button', 'input_field'
            );

            foreach ($font_properties_name as $name){
                $font_properties = beeteam368_get_redux_option('_'.$name.'_font_properties', array());

                if(isset($font_properties['google']) && $font_properties['google'] && isset($font_properties['font-family']) && $font_properties['font-family']!=''){

                    $google_fonts_params = array();
                    $google_fonts_value = array();

                    if(isset($font_properties['font-style']) && $font_properties['font-style'] == 'italic'){
                        $google_fonts_params[] = 'ital';
                        $google_fonts_value [] = 1;
                    }

                    if(isset($font_properties['font-weight']) && $font_properties['font-weight'] != 400){
                        $google_fonts_params[] = 'wght';
                        $google_fonts_value [] = $font_properties['font-weight'];
                    }

                    if(count($google_fonts_params) > 0){
                        $google_fonts[] = trim($font_properties['font-family']) . ':' . implode(',', $google_fonts_params) . '@' . implode(',', $google_fonts_value);
                    }else{
                        $google_fonts[] = trim($font_properties['font-family']);
                    }

                }
            }

            if (count($google_fonts) > 0) {
                $google_fonts_string = implode('&family=', $google_fonts);
            }
            if ($google_fonts_string != '') {
                wp_enqueue_style('beeteam368-google-font', esc_url('https://fonts.googleapis.com/css2?family=' . $google_fonts_string . '&display=swap'), [], $beeteam368_theme_version);
            }
        }

        wp_enqueue_script('beeteam368_obj_wes', $template_directory_uri . '/js/btwes.js', ['jquery'], $beeteam368_theme_version, false);

        if (!wp_script_is('font-awesome-pro')) {
            wp_enqueue_style('font-awesome-5-all');
        }

        wp_enqueue_style('jquery-overlay-scrollbars', $template_directory_uri . '/js/overlay-scrollbars/OverlayScrollbars.min.css', [], $beeteam368_theme_version);
		
		if (class_exists('myCRED_Core')){
			wp_deregister_style('mycred-front');
			wp_enqueue_style( 'mycred-front', WP_PLUGIN_URL . '/mycred/assets/css/mycred-front.css', [], $beeteam368_theme_version);
		}

        wp_enqueue_style('beeteam368-style', get_stylesheet_uri());

        wp_enqueue_style('beeteam368-header-' . $beeteam368_header_style, $template_directory_uri . '/css/header/h-' . $beeteam368_header_style . '.css', [], $beeteam368_theme_version);

        if (beeteam368_side_menu_control() === 'on') {
            wp_enqueue_style('beeteam368-side-menu', $template_directory_uri . '/css/side-menu/side-menu.css', [], $beeteam368_theme_version);
        }
		
		$_sticky_menu = beeteam368_get_redux_option('_sticky_menu', 'on', 'switch');		
		if ($_sticky_menu === 'on') {
			 wp_enqueue_style('beeteam368-sticky-menu', $template_directory_uri . '/css/header/sticky-menu/sticky-menu.css', [], $beeteam368_theme_version);
		}
		

        $arr_css_party_files = apply_filters('beeteam368_css_party_files', array(), $beeteam368_header_style, $template_directory_uri, $beeteam368_theme_version);
        if (count($arr_css_party_files) > 0) {
            foreach ($arr_css_party_files as $css_party_file) {
                if (is_array($css_party_file) & count($css_party_file) >= 3) {
                    wp_enqueue_style($css_party_file[0], $css_party_file[1], $css_party_file[2], $beeteam368_theme_version);
                }
            }
        }
        
        if(class_exists('BuddyPress')){
            wp_enqueue_style('vidmov-buddypress', $template_directory_uri . '/css/buddypress/buddypress.css', [], $beeteam368_theme_version);
        }
		
		wp_enqueue_style( 'beeteam368_obj_wes_style', $template_directory_uri . '/css/btwes.css', array(), $beeteam368_theme_version );		
		wp_add_inline_style('beeteam368_obj_wes_style', beeteam368_custom_css());
		if(beeteam368_get_redux_option('_rtl', 'off', 'switch') === 'on' || is_rtl()){
			wp_enqueue_style( 'right_to_left', $template_directory_uri . '/rtl.css', array(), $beeteam368_theme_version );
		}

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        $_lazyload = beeteam368_get_redux_option('_lazyload', 'off', 'switch');
        if ($_lazyload === 'on') {
            wp_enqueue_script('lazysizes', $template_directory_uri . '/js/lazysizes.min.js', [], $beeteam368_theme_version, false);
        }
        wp_enqueue_script('overlay-scrollbars', $template_directory_uri . '/js/overlay-scrollbars/OverlayScrollbars.min.js', [], $beeteam368_theme_version, true);
		
		$_light_dark_btn = beeteam368_get_redux_option('_light_dark_btn', 'on', 'switch');
		if($_light_dark_btn === 'on'){
			wp_enqueue_script('js-cookie', $template_directory_uri . '/js/js.cookie.min.js', [], $beeteam368_theme_version, true);
		}

        wp_enqueue_script('vidmov-javascript', $template_directory_uri . '/js/main.js', [], $beeteam368_theme_version, true);

        $arr_js_party_files = apply_filters('beeteam368_js_party_files', array(), $beeteam368_header_style, $template_directory_uri, $beeteam368_theme_version);
        if (count($arr_js_party_files) > 0) {
            foreach ($arr_js_party_files as $js_party_file) {
                if (is_array($js_party_file) & count($js_party_file) >= 4) {
                    wp_enqueue_script($js_party_file[0], $js_party_file[1], $js_party_file[2], $beeteam368_theme_version, $js_party_file[3]);
                }
            }
        }

        $define_js_object['admin_ajax'] = esc_url(admin_url('admin-ajax.php'));
        $define_js_object['query_vars'] = $wp_query->query_vars;
        $define_js_object['security'] = esc_attr(wp_create_nonce(BEETEAM368_PREFIX . $beeteam368_theme_version . $beeteam368_theme_name . var_export(is_user_logged_in(), true)));
		$define_js_object['no_more_posts_to_load_text'] = esc_html__('No More Posts To Load...', 'vidmov');
		$define_js_object['want_to_exit_text'] = esc_html__('Are you sure you want to exit?', 'vidmov');
		$define_js_object['processing_data_do_not_close_text'] = esc_html__('Processing data... Please do not close the browser and this popup.', 'vidmov');
		$define_js_object['stay_text'] = esc_html__('Stay...', 'vidmov');
		$define_js_object['exit_text'] = esc_html__('Exit', 'vidmov');
        $define_js_object['side_menu'] = esc_attr(beeteam368_side_menu_control());
		$define_js_object['sticky_menu'] = $_sticky_menu;
		$define_js_object['cache_version'] = $beeteam368_theme_version;
		
		if($swiper_libraries){
			$define_js_object['js_library'] = array(
				'swiper_css' => esc_url($template_directory_uri . '/js/swiper-slider/swiper-bundle.min.css'),
				'swiper_js' => esc_url($template_directory_uri . '/js/swiper-slider/swiper-bundle.min.js'),
			);
		}

        $define_js_object = apply_filters('beeteam368_define_js_object', $define_js_object);

        wp_localize_script('beeteam368_obj_wes', 'vidmov_jav_js_object', $define_js_object);
    }
endif;
add_action('wp_enqueue_scripts', 'beeteam368_scripts');

if (!function_exists('beeteam368_add_footer_styles')) :
	function beeteam368_add_footer_styles() {
		$template_directory_uri = get_template_directory_uri();
        $beeteam368_header_style = beeteam368_header_style();
        $beeteam368_theme = wp_get_theme();
        $beeteam368_theme_version = $beeteam368_theme->get('Version');
        $beeteam368_theme_name = $beeteam368_theme->get('Name');
		
		$arr_css_party_files = apply_filters('beeteam368_css_footer_party_files', array(), $beeteam368_header_style, $template_directory_uri, $beeteam368_theme_version);
        if (count($arr_css_party_files) > 0) {
            foreach ($arr_css_party_files as $css_party_file) {
                if (is_array($css_party_file) & count($css_party_file) >= 3) {
                    wp_enqueue_style($css_party_file[0], $css_party_file[1], $css_party_file[2], $beeteam368_theme_version);
                }
            }
        }
		
		wp_enqueue_style('beeteam368-footer-styles', $template_directory_uri . '/footer.css', [], $beeteam368_theme_version);
	}
endif;
add_action( 'get_footer', 'beeteam368_add_footer_styles' );

if(!function_exists('beeteam368_image_sizes') ) :
    function beeteam368_image_sizes(){
		add_image_size('beeteam368_thumb_16x9_0x', 300, 169, true);
        add_image_size('beeteam368_thumb_16x9_1x', 420, 237, true);
        add_image_size('beeteam368_thumb_16x9_2x', 800, 450, true);        
		
		add_image_size('beeteam368_thumb_4x3_0x', 300, 225, true);
        add_image_size('beeteam368_thumb_4x3_1x', 420, 315, true);
        add_image_size('beeteam368_thumb_4x3_2x', 800, 600, true);
        
		add_image_size('beeteam368_thumb_2x3_0x', 234, 351, true);
        add_image_size('beeteam368_thumb_2x3_1x', 420, 630, true);
		add_image_size('beeteam368_thumb_2x3_2x', 800, 1200, true);
    }
endif;
add_action('after_setup_theme', 'beeteam368_image_sizes');

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';

if (!function_exists('beeteam368_dark_version')) {
    function beeteam368_dark_version(){
        $template_directory_uri = get_template_directory_uri();
        $beeteam368_theme = wp_get_theme();
        $beeteam368_theme_version = $beeteam368_theme->get('Version');
        wp_enqueue_style('beeteam368-dark-version', $template_directory_uri . '/dark-version.css', [], $beeteam368_theme_version);
    }
}

add_action('wp_enqueue_scripts', 'beeteam368_dark_version');

if (!function_exists('beeteam368_register_elementor_locations')) {
    function beeteam368_register_elementor_locations($elementor_theme_manager)
    {
        $elementor_theme_manager->register_all_core_location();
    }
}
add_action('elementor/theme/register_locations', 'beeteam368_register_elementor_locations');

if (!function_exists('beeteam368_register_elementor_new_locations')) {
    function beeteam368_register_elementor_new_locations($elementor_theme_manager)
    {
        $elementor_theme_manager->register_location(
            'beeteam368-side-menu',
            [
                'label' => esc_html__('BeeTeam368 Side Menu', 'vidmov'),
                'multiple' => true,
                'edit_in_content' => true,
            ]
        );
    }
}
add_action('elementor/theme/register_locations', 'beeteam368_register_elementor_new_locations');

if(!function_exists('beeteam368_tag_archive_page_display')){
	function beeteam368_tag_archive_page_display($query){
		if($query->is_main_query() && !is_admin() && $query->is_tag) {
			
			$post_types = apply_filters('beeteam368_tag_archive_page_post_types', array('post'));
			
			$query->set('post_type', $post_types);
	
	   }
	}
}
add_action('pre_get_posts', 'beeteam368_tag_archive_page_display', 99);

if(!function_exists('beeteam368_remove_pages_in_search_results')){
	function beeteam368_remove_pages_in_search_results(){
		if(beeteam368_get_redux_option('_exclude_page_in_search', 'on', 'switch') === 'on'){
			global $wp_post_types;
			$wp_post_types['page']->exclude_from_search = true;
		}
	}
}
add_action('init', 'beeteam368_remove_pages_in_search_results');

if(!function_exists('beeteam368_quick_logout')){
	function beeteam368_quick_logout($url, $name, $scheme, $network){
        if($name == 'logout'){
            return home_url('/wp-login.php?action=logout&redirect_to='.esc_url(home_url()).'&_wpnonce='.wp_create_nonce('log-out'));
        }
        
        return $url;
    }
}
add_filter('tml_get_action_url', 'beeteam368_quick_logout', 10, 4);