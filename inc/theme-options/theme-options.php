<?php
if (!function_exists('beeteam368_add_pagination_types')):
	function beeteam368_add_pagination_types($pagination){
		if(class_exists('PageNavi_Core')){
			$pagination['pagenavi_plugin'] = esc_html__('WP PageNavi (Plugin)', 'vidmov');
		}
		return $pagination;
	}
endif;
add_filter('beeteam368_register_pagination_theme_settings', 'beeteam368_add_pagination_types', 10, 1);
add_filter('beeteam368_register_pagination_plugin_settings', 'beeteam368_add_pagination_types', 10, 1);

if (!class_exists('Redux')) {
    return;
}

if (!defined('BEETEAM368_PREFIX')) {
    define('BEETEAM368_PREFIX', 'beeteam368');
}

load_theme_textdomain('vidmov', get_template_directory() . '/languages');

$beeteam368_opt_name = apply_filters(BEETEAM368_PREFIX . '_theme_options/opt_name', BEETEAM368_PREFIX . '_theme_options');
$beeteam368_theme = wp_get_theme();

$beeteam368_opts_args = array(
    'opt_name' => $beeteam368_opt_name,
    'display_name' => $beeteam368_theme->get('Name'),
    'display_version' => $beeteam368_theme->get('Version'),
    'menu_type' => 'menu',
    'allow_sub_menu' => true,
    'menu_title' => esc_html__('Theme Options', 'vidmov'),
    'page_title' => esc_html__('Theme Options', 'vidmov'),
    'google_api_key' => '',
    'google_update_weekly' => false,
    'async_typography' => true,
    'admin_bar' => true,
    'admin_bar_icon' => 'dashicons-portfolio',
    'admin_bar_priority' => 50,
    'global_variable' => BEETEAM368_PREFIX . '_theme_options',
    'dev_mode' => false,
    'update_notice' => false,
    'customizer' => true,
    'page_priority' => 3,
    'page_parent' => '',
    'page_permissions' => BEETEAM368_PREFIX . '_theme_options',
    'menu_icon' => '',
    'last_tab' => '',
    'page_icon' => 'icon-themes',
    'page_slug' => BEETEAM368_PREFIX . '_theme_options',
    'save_defaults' => true,
    'default_show' => false,
    'default_mark' => '',
    'show_import_export' => true,
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    'output_tag' => true,

    'database' => '',
    'use_cdn' => true,

    'intro_text' => wp_kses(
        __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'vidmov'),
        array(
            'p' => array(),
        )
    ),

    'footer_text' => wp_kses(
        __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'vidmov'),
        array(
            'p' => array(),
        )
    )
);

Redux::setArgs($beeteam368_opt_name, $beeteam368_opts_args);

/*global*/
$beeteam368_to_global = apply_filters('beeteam368_to_global', array(
    array(
        'id' => BEETEAM368_PREFIX . '_rtl',
        'type' => 'switch',
        'title' => esc_html__('RTL Mode', 'vidmov'),
        'desc' => esc_html__('Enable/Disable Right-to-Left language', 'vidmov'),
        'default' => false,
    ),
    array(
        'id' => BEETEAM368_PREFIX . '_lazyload',
        'type' => 'switch',
        'title' => esc_html__('Lazyload Images', 'vidmov'),
        'desc' => esc_html__('Enable/Disable Lazyload Images', 'vidmov'),
        'default' => false,
    ),
    array(
        'id' => BEETEAM368_PREFIX . '_number_format',
        'type' => 'select',
        'title' => esc_html__('Number Format', 'vidmov'),
        'desc' => esc_html__('Converts a number into a short version, eg: 1000 -> 1k', 'vidmov'),
        'default' => 'short',
        'options' => array(
            'short' => esc_html__('Shorten long numbers to K/M/B/T', 'vidmov'),
            'full' => esc_html__('Number Format Default', 'vidmov'),
        ),
        'select2' => array(
            'allowClear' => false
        ),
    ),
    array(
        'id' => BEETEAM368_PREFIX . '_datetime_format',
        'type' => 'select',
        'title' => esc_html__('DateTime Format', 'vidmov'),
        'default' => 'default',
        'options' => array(
            'default' => esc_html__('Default', 'vidmov'),
            'ago' => esc_html__('Time Ago', 'vidmov'),
        ),
        'select2' => array(
            'allowClear' => false
        ),
    ),
	array(
        'id' => BEETEAM368_PREFIX . '_nav_breadcrumbs',
        'type' => 'switch',
        'title' => esc_html__('Breadcrumbs', 'vidmov'),
        'desc' => esc_html__('Enable/Disable Breadcrumbs.', 'vidmov'),
        'default' => false,
    ),
	
	array(
		'id' 		=> BEETEAM368_PREFIX . '_exclude_page_in_search',
		'type'	 	=> 'switch',
		'title' 	=> esc_html__('Exclude Pages from Search Results', 'vidmov'),		
		'default' 	=> true,
	),
));
Redux::setSection($beeteam368_opt_name, array(
    'title' => esc_html__('Global Settings', 'vidmov'),
    'id' => BEETEAM368_PREFIX . '_global',
    'icon' => 'el el-globe-alt',
    'fields' => $beeteam368_to_global,
));
/*global*/

/*Styling*/
global $beeteam368_all_sidebar_positions;
$beeteam368_all_sidebar_positions = array(
    'right' 	=> array(
		'alt'   => esc_html__('Right', 'vidmov'),
		'img'   => ReduxFramework::$_url.'assets/img/2cr.png'
	),
	'left'	 	=> array(
		'alt'   => esc_html__('Left', 'vidmov'),
		'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
	),
	'hidden'	=> array(
		'alt'   => esc_html__('Hidden', 'vidmov'),
		'img'   => ReduxFramework::$_url.'assets/img/1col.png'
	),
);

if (!function_exists('beeteam368_all_sidebar_positions')) :
    function beeteam368_all_sidebar_positions($positions){

        global $beeteam368_all_sidebar_positions;

        foreach($beeteam368_all_sidebar_positions as $key => $beeteam368_sidebar_position){
            $positions[$key] = $beeteam368_sidebar_position['alt'];
        }
        return $positions;
    }
endif;
add_filter('beeteam368_register_sidebar_plugin_settings', 'beeteam368_all_sidebar_positions');

$beeteam368_to_styling = apply_filters('beeteam368_to_styling', array(
    array(
        'id' => BEETEAM368_PREFIX . '_full_width_mode',
        'type' => 'switch',
        'title' => esc_html__('Full-Width Mode', 'vidmov'),
        'desc' => esc_html__('Enable/Disable Full-Width Mode.', 'vidmov'),
        'default' => false,
    ),
    array(
        'id' => BEETEAM368_PREFIX . '_theme_sidebar',
        'type' => 'image_select',
        'title' => esc_html__('Sidebar', 'vidmov'),
        'desc' => esc_html__('Select Sidebar Appearance.', 'vidmov'),
        'default' => 'right',
        'options' => $beeteam368_all_sidebar_positions,
    ),
    array(
        'id' => BEETEAM368_PREFIX . '_light_dark_mode',
        'type' => 'select',
        'title' => esc_html__('Color Mode', 'vidmov'),
        'desc' => esc_html__('Choose a default color mode.', 'vidmov'),
        'default' => 'light',
        'options' => array(
            'light' => esc_html__('Light', 'vidmov'),
            'dark' => esc_html__('Dark', 'vidmov'),
        ),
        'select2' => array(
            'allowClear' => false
        ),
    ),
	array(
		'id' => BEETEAM368_PREFIX . '_main_color',
		'type' => 'color',
		'title' => esc_html__('Main Skin Color', 'vidmov'),
		'desc' => esc_html__('Choose main skin color', 'vidmov'),
		'transparent' => false
	),			
	array(
		'id' => BEETEAM368_PREFIX . '_sub_color',
		'type' => 'color',
		'title' => esc_html__('Sub Skin Color', 'vidmov'),
		'desc' => esc_html__('Choose sub skin color', 'vidmov'),
		'transparent' => false
	),
	array(
		'id' => BEETEAM368_PREFIX . '_main_color_dark',
		'type' => 'color',
		'title' => esc_html__('[Dark Mode] Main Skin Color', 'vidmov'),
		'desc' => esc_html__('Choose main skin color', 'vidmov'),
		'transparent' => false
	),			
	array(
		'id' => BEETEAM368_PREFIX . '_sub_color_dark',
		'type' => 'color',
		'title' => esc_html__('[Dark Mode] Sub Skin Color', 'vidmov'),
		'desc' => esc_html__('Choose sub skin color', 'vidmov'),
		'transparent' => false
	),
    array(
        'id' => BEETEAM368_PREFIX . '_light_dark_btn',
        'type' => 'switch',
        'title' => esc_html__('Light/Dark Mode Button', 'vidmov'),
        'desc' => esc_html__('Enable/Disable Light/Dark Mode Button.', 'vidmov'),
        'default' => true,
    ),
));
Redux::setSection($beeteam368_opt_name, array(
    'title' => esc_html__('Styling', 'vidmov'),
    'id' => BEETEAM368_PREFIX . '_styling',
    'icon' => 'el el-brush',
    'fields' => $beeteam368_to_styling,
));
/*Styling*/

/*header*/
$beeteam368_to_header_settings = apply_filters('beeteam368_to_header_settings', array(
    array(
        'id' => BEETEAM368_PREFIX . '_nav_layout',
        'type' => 'image_select',
        'title' => esc_html__('Main Navigation Style', 'vidmov'),
        'desc' => esc_html__('Choose a style for the main navigation bar.', 'vidmov'),
        'default' => 'poppy',
        'options' => array(
			'poppy' => array(
                'alt' => esc_html__('Poppy', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-poppy.png'
            ),
            'default' => array(
                'alt' => esc_html__('Default', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-default.png'
            ),
            'alyssa' => array(
                'alt' => esc_html__('Alyssa', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-alyssa.png'
            ),
            'leilani' => array(
                'alt' => esc_html__('Leilani', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-leilani.png'
            ),
            /*
			'lily' => array(
                'alt' => esc_html__('Lily', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-lily.png'
            ),
			*/
            'marguerite' => array(
                'alt' => esc_html__('Marguerite', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-marguerite.png'
            ),
            'rose' => array(
                'alt' => esc_html__('Rose', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-rose.png'
            ),			
        ),
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_sticky_menu',
        'type' => 'switch',
        'title' => esc_html__('Sticky Menu', 'vidmov'),
        'desc' => esc_html__('Enable/Disable Sticky Menu.', 'vidmov'),
        'default' => true,
    ),
	
	array(
		'id' => BEETEAM368_PREFIX . '_header_banner',
		'type' => 'media',
		'title' => esc_html__('Header Banner', 'vidmov'),
		'desc' => esc_html__('Use only with Marguerite Header layout.', 'vidmov'),
		'placeholder' => esc_html__('No image selected', 'vidmov'),
		'readonly' => false,
		'url' => true,
	),
	array(
        'id' => BEETEAM368_PREFIX . '_header_banner_url',
        'type' => 'text',
        'title' => esc_html__('[Header Banner] - Link Target', 'vidmov'),
		'validate' => 'url'
    ),
	array(
		'id' 		=> BEETEAM368_PREFIX . '_header_background',
		'type'	 	=> 'background',
		'title' 	=> esc_html__('Header Background', 'vidmov'),
		'desc' 		=> esc_html__('Use only with Leilani Header layout.', 'vidmov'),
	),
    array(
        'id' => BEETEAM368_PREFIX . '_text_logo',
        'type' => 'text',
        'title' => esc_html__('Text Logo', 'vidmov'),
        'desc' => esc_html__('If you don\'t have a logo yet, this text will be used instead.', 'vidmov'),
        'default' => esc_html__('Logo', 'vidmov'),
    ),

    array(
        'id' 			=> BEETEAM368_PREFIX . '_main_light_logo_section',
        'type'	 		=> 'section',
        'title' 		=> esc_html__('Light Mode - Logo Settings', 'vidmov'),
        'indent'        => true
    ),
        array(
            'id' => BEETEAM368_PREFIX . '_main_logo',
            'type' => 'media',
            'title' => esc_html__('Logo', 'vidmov'),
            'desc' => esc_html__('Upload your logo image', 'vidmov'),
            'placeholder' => esc_html__('No image selected', 'vidmov'),
            'readonly' => false,
            'url' => true,
        ),
        array(
            'id' => BEETEAM368_PREFIX . '_main_logo_retina',
            'type' => 'media',
            'title' => esc_html__('Logo (Retina)', 'vidmov'),
            'desc' => esc_html__('Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices', 'vidmov'),
            'placeholder' => esc_html__('No image selected', 'vidmov'),
            'readonly' => false,
            'url' => true,
        ),

        array(
            'id' => BEETEAM368_PREFIX . '_main_logo_mobile',
            'type' => 'media',
            'title' => esc_html__('Logo on mobile devices', 'vidmov'),
            'desc' => esc_html__('Upload your logo image for mobile devices', 'vidmov'),
            'placeholder' => esc_html__('No image selected', 'vidmov'),
            'readonly' => false,
            'url' => true,
        ),
        array(
            'id' => BEETEAM368_PREFIX . '_main_logo_mobile_retina',
            'type' => 'media',
            'title' => esc_html__('Logo on mobile devices (Retina)', 'vidmov'),
            'desc' => esc_html__('Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices', 'vidmov'),
            'placeholder' => esc_html__('No image selected', 'vidmov'),
            'readonly' => false,
            'url' => true,
        ),

        array(
            'id' => BEETEAM368_PREFIX . '_side_logo',
            'type' => 'media',
            'title' => esc_html__('Side Menu Logo', 'vidmov'),
            'desc' => esc_html__('Upload your logo image for Side Menu', 'vidmov'),
            'placeholder' => esc_html__('No image selected', 'vidmov'),
            'readonly' => false,
            'url' => true,
        ),
        array(
            'id' => BEETEAM368_PREFIX . '_side_logo_retina',
            'type' => 'media',
            'title' => esc_html__('Side Menu Logo (Retina)', 'vidmov'),
            'desc' => esc_html__('Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices', 'vidmov'),
            'placeholder' => esc_html__('No image selected', 'vidmov'),
            'readonly' => false,
            'url' => true,
        ),
    array(
        'id' 			=> BEETEAM368_PREFIX . '_main_light_logo_section_end',
        'type'	 		=> 'section',
        'indent'        => false
    ),

    array(
        'id' 			=> BEETEAM368_PREFIX . '_main_dark_logo_section',
        'type'	 		=> 'section',
        'title' 		=> esc_html__('Dark Mode - Logo Settings', 'vidmov'),
        'indent'        => true
    ),
        array(
            'id' => BEETEAM368_PREFIX . '_main_logo_dark',
            'type' => 'media',
            'title' => esc_html__('Logo', 'vidmov'),
            'desc' => esc_html__('Upload your logo image', 'vidmov'),
            'placeholder' => esc_html__('No image selected', 'vidmov'),
            'readonly' => false,
            'url' => true,
        ),
        array(
            'id' => BEETEAM368_PREFIX . '_main_logo_retina_dark',
            'type' => 'media',
            'title' => esc_html__('Logo (Retina)', 'vidmov'),
            'desc' => esc_html__('Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices', 'vidmov'),
            'placeholder' => esc_html__('No image selected', 'vidmov'),
            'readonly' => false,
            'url' => true,
        ),

        array(
            'id' => BEETEAM368_PREFIX . '_main_logo_mobile_dark',
            'type' => 'media',
            'title' => esc_html__('Logo on mobile devices', 'vidmov'),
            'desc' => esc_html__('Upload your logo image for mobile devices', 'vidmov'),
            'placeholder' => esc_html__('No image selected', 'vidmov'),
            'readonly' => false,
            'url' => true,
        ),
        array(
            'id' => BEETEAM368_PREFIX . '_main_logo_mobile_retina_dark',
            'type' => 'media',
            'title' => esc_html__('Logo on mobile devices (Retina)', 'vidmov'),
            'desc' => esc_html__('Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices', 'vidmov'),
            'placeholder' => esc_html__('No image selected', 'vidmov'),
            'readonly' => false,
            'url' => true,
        ),

        array(
            'id' => BEETEAM368_PREFIX . '_side_logo_dark',
            'type' => 'media',
            'title' => esc_html__('Side Menu Logo', 'vidmov'),
            'desc' => esc_html__('Upload your logo image for Side Menu', 'vidmov'),
            'placeholder' => esc_html__('No image selected', 'vidmov'),
            'readonly' => false,
            'url' => true,
        ),
        array(
            'id' => BEETEAM368_PREFIX . '_side_logo_retina_dark',
            'type' => 'media',
            'title' => esc_html__('Side Menu Logo (Retina)', 'vidmov'),
            'desc' => esc_html__('Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices', 'vidmov'),
            'placeholder' => esc_html__('No image selected', 'vidmov'),
            'readonly' => false,
            'url' => true,
        ),
    array(
        'id' 			=> BEETEAM368_PREFIX . '_main_dark_logo_section_end',
        'type'	 		=> 'section',
        'indent'        => false
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_side_menu',
        'type' => 'switch',
        'title' => esc_html__('Side Menu', 'vidmov'),
        'desc' => esc_html__('Enable/Disable Side Menu.', 'vidmov'),
        'default' => true,
    ),
    array(
        'id' => BEETEAM368_PREFIX . '_side_menu_status',
        'type' => 'select',
        'title' => esc_html__('Default Status for Side Menu', 'vidmov'),
        'desc' => esc_html__('Choose a default status for the side menu. Applicable to minimum width screens: 1366px', 'vidmov'),
        'default' => 'close',
        'options' => array(
            'close' => esc_html__('Close', 'vidmov'),
            'open' => esc_html__('Open', 'vidmov'),
        ),
        'select2' => array(
            'allowClear' => false
        ),
        'required' => array(BEETEAM368_PREFIX . '_side_menu', '=', '1'),
    ),
    array(
        'id' => BEETEAM368_PREFIX . '_side_menu_position',
        'type' => 'select',
        'title' => esc_html__('Default Position for Side Menu', 'vidmov'),
        'desc' => esc_html__('Choose a default position for the side menu.', 'vidmov'),
        'default' => 'left',
        'options' => array(
            'left' => esc_html__('Left', 'vidmov'),
            'right' => esc_html__('Right', 'vidmov'),
        ),
        'select2' => array(
            'allowClear' => false
        ),
        'required' => array(BEETEAM368_PREFIX . '_side_menu', '=', '1'),
    ),
    array(
        'id' => BEETEAM368_PREFIX . '_side_menu_nav',
        'type' => 'switch',
        'title' => esc_html__('Side Menu Navigation', 'vidmov'),
        'desc' => esc_html__('Enable/Disable Side Menu Navigation.', 'vidmov'),
        'default' => true,
        'required' => array(BEETEAM368_PREFIX . '_side_menu', '=', '1'),
    ),
));
Redux::setSection($beeteam368_opt_name, array(
    'title' => esc_html__('Header', 'vidmov'),
    'id' => BEETEAM368_PREFIX . '_header_settings',
    'icon' => 'el el-cog-alt',
    'fields' => $beeteam368_to_header_settings,
));
/*header*/

/*footer*/
$beeteam368_to_footer_settings = apply_filters('beeteam368_to_footer_settings', array(
    array(
        'id' 		=> BEETEAM368_PREFIX . '_footer_copyright',
        'type'	 	=> 'editor',
        'title' 	=> esc_html__('Fotter Copyright Text', 'vidmov'),
    ),
));
Redux::setSection($beeteam368_opt_name, array(
    'title' => esc_html__('Footer Settings', 'vidmov'),
    'id' => BEETEAM368_PREFIX . '_footer_settings',
    'icon' => 'el el-cog-alt',
    'fields' => $beeteam368_to_footer_settings,
));
/*footer*/

global $beeteam368_all_blog_layouts;
$beeteam368_all_blog_layouts = array(
    'default' => array(
        'alt' => esc_html__('Default', 'vidmov'),
        'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-default.png'
    ),
    'alyssa' => array(
        'alt' => esc_html__('Alyssa', 'vidmov'),
        'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-alyssa.png'
    ),
    'leilani' => array(
        'alt' => esc_html__('Leilani', 'vidmov'),
        'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-leilani.png'
    ),
    'lily' => array(
        'alt' => esc_html__('Lily', 'vidmov'),
        'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-lily.png'
    ),
    'marguerite' => array(
        'alt' => esc_html__('Marguerite', 'vidmov'),
        'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-marguerite.png'
    ),
    'rose' => array(
        'alt' => esc_html__('Rose', 'vidmov'),
        'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-rose.png'
    ),
	'orchid' => array(
        'alt' => esc_html__('Orchid', 'vidmov'),
        'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-orchid.png'
    ),
);

if (!function_exists('beeteam368_all_blog_layouts_name')) :
    function beeteam368_all_blog_layouts_name($name){

        global $beeteam368_all_blog_layouts;

        foreach($beeteam368_all_blog_layouts as $key => $beeteam368_all_blog_layout){
            $name[$key] = $beeteam368_all_blog_layout['alt'];
        }
        return $name;
    }
endif;
add_filter('beeteam368_register_layouts_plugin_settings_name', 'beeteam368_all_blog_layouts_name');

if (!function_exists('beeteam368_all_blog_layouts_image')) :
    function beeteam368_all_blog_layouts_image($image){

        global $beeteam368_all_blog_layouts;

        $replace_get_template_directory_uri = trailingslashit(get_template_directory_uri());

        foreach($beeteam368_all_blog_layouts as $key => $beeteam368_all_blog_layout){
            $image[$key] = str_replace($replace_get_template_directory_uri, '', $beeteam368_all_blog_layout['img']);
        }
        return $image;
    }
endif;
add_filter('beeteam368_register_layouts_plugin_settings_image', 'beeteam368_all_blog_layouts_image');

if (!function_exists('beeteam368_elementor_block_layouts')) :
    function beeteam368_elementor_block_layouts($layouts){

        global $beeteam368_all_blog_layouts;

        foreach($beeteam368_all_blog_layouts as $key => $beeteam368_all_blog_layout){
            $layouts[$key] = $beeteam368_all_blog_layout['alt'];
        }
        return $layouts;
    }
endif;
add_filter('beeteam368_elementor_block_layouts', 'beeteam368_elementor_block_layouts');

if (!function_exists('beeteam368_elementor_block_layouts_file')) :
    function beeteam368_elementor_block_layouts_file($files){

        global $beeteam368_all_blog_layouts;

        foreach($beeteam368_all_blog_layouts as $key => $beeteam368_all_blog_layout){
            $files[$key] = get_template_directory() . '/template-parts/archive/item-' . $key . '.php';
        }
        return $files;
    }
endif;
add_filter('beeteam368_elementor_block_layouts_file', 'beeteam368_elementor_block_layouts_file');

global $beeteam368_all_slider_layouts;
$beeteam368_all_slider_layouts = array(
    'lily' => array(
        'alt' => esc_html__('Lily', 'vidmov'),
        'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-lily.png'
    ),
	'alyssa' => array(
        'alt' => esc_html__('Alyssa', 'vidmov'),
        'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-alyssa.png'
    ),
    'rose' => array(
        'alt' => esc_html__('Rose', 'vidmov'),
        'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-rose.png'
    ),
	'orchid' => array(
        'alt' => esc_html__('Orchid', 'vidmov'),
        'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-orchid.png'
    ),
);

if (!function_exists('beeteam368_elementor_slider_layouts')) :
    function beeteam368_elementor_slider_layouts($layouts){

        global $beeteam368_all_slider_layouts;

        foreach($beeteam368_all_slider_layouts as $key => $beeteam368_all_slider_layout){
            $layouts[$key] = $beeteam368_all_slider_layout['alt'];
        }
        return $layouts;
    }
endif;
add_filter('beeteam368_elementor_slider_layouts', 'beeteam368_elementor_slider_layouts');

if (!function_exists('beeteam368_elementor_slider_layouts_file')) :
    function beeteam368_elementor_slider_layouts_file($files){

        global $beeteam368_all_slider_layouts;

        foreach($beeteam368_all_slider_layouts as $key => $beeteam368_all_slider_layout){
            $files[$key] = get_template_directory() . '/template-parts/archive/item-' . $key . '.php';
        }
        return $files;
    }
endif;
add_filter('beeteam368_elementor_slider_layouts_file', 'beeteam368_elementor_slider_layouts_file');

/*Blog Settings*/
$beeteam368_to_blog_settings = apply_filters('beeteam368_to_blog_settings', array(
	array(
		'id' 			=> BEETEAM368_PREFIX . '_blog_full_width_mode',
		'type'	 		=> 'select',
		'title' 		=> esc_html__('Full-Width Mode', 'vidmov'),	
		'desc' 			=> esc_html__('Change Full-Width Mode. Select "Default" to use settings in Theme Options > Styling.', 'vidmov'),				
		'default' 		=> '',
		'options'  		=> array(
			''	 		=> esc_html__('Default', 'vidmov'),
			'on' 		=> esc_html__('ON', 'vidmov'),
			'off'	 	=> esc_html__('OFF', 'vidmov'),
		),		
	),
    array(
        'id' => BEETEAM368_PREFIX . '_archive_loop_style',
        'type' => 'image_select',
        'title' => esc_html__('Archive Loop Style', 'vidmov'),
        'desc' => esc_html__('Choose a style for archive pages.', 'vidmov'),
        'default' => 'default',
        'options' => $beeteam368_all_blog_layouts,
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_archive_sidebar',
        'type' => 'image_select',
        'title' => esc_html__('Sidebar', 'vidmov'),
        'desc' => esc_html__('Select Sidebar Appearance.', 'vidmov'),
        'default' => 'right',
        'options' => $beeteam368_all_sidebar_positions,
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_nav_layout_in_archive',
        'type' => 'image_select',
        'title' => esc_html__('Main Navigation Style', 'vidmov'),
        'desc' => esc_html__('Change header style for archive pages. Select "Default" to use settings in Theme Options > Header.', 'vidmov'),
        'default' => '',
        'options' => array(
			'' => array(
                'alt' => esc_html__('Default', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-to-hz.png'
            ),
			'poppy' => array(
                'alt' => esc_html__('Poppy', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-poppy.png'
            ),
            'default' => array(
                'alt' => esc_html__('Default', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-default.png'
            ),
            'alyssa' => array(
                'alt' => esc_html__('Alyssa', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-alyssa.png'
            ),
            'leilani' => array(
                'alt' => esc_html__('Leilani', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-leilani.png'
            ),
            /*
			'lily' => array(
                'alt' => esc_html__('Lily', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-lily.png'
            ),
			*/
            'marguerite' => array(
                'alt' => esc_html__('Marguerite', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-marguerite.png'
            ),
            'rose' => array(
                'alt' => esc_html__('Rose', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-rose.png'
            ),			
        ),
    ),
	
    array(
        'id' => BEETEAM368_PREFIX . '_display_author',
        'type' => 'switch',
        'title' => esc_html__('Display Post Author', 'vidmov'),
        'default' => true,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_excerpt',
        'type' => 'switch',
        'title' => esc_html__('Display Post Excerpt', 'vidmov'),
        'default' => true,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_post_categories',
        'type' => 'switch',
        'title' => esc_html__('Display Post Categories', 'vidmov'),
        'default' => true,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_post_published_date',
        'type' => 'switch',
        'title' => esc_html__('Display Post Published Date', 'vidmov'),
        'default' => true,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_post_updated_date',
        'type' => 'switch',
        'title' => esc_html__('Display Post Last Updated', 'vidmov'),
        'default' => false,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_post_reactions',
        'type' => 'switch',
        'title' => esc_html__('Display Post Reactions', 'vidmov'),
        'default' => true,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_post_comments',
        'type' => 'switch',
        'title' => esc_html__('Display Post Comments Count', 'vidmov'),
        'default' => true,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_post_views',
        'type' => 'switch',
        'title' => esc_html__('Display Post Views Count', 'vidmov'),
        'default' => true,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_post_read_more',
        'type' => 'switch',
        'title' => esc_html__('Display Post Read More ( or: Share)', 'vidmov'),
        'default' => true,
        'desc' => esc_html__('When enabled sharing option from "BeeTeam368 Extensions" plugin. The "Read More" button will be replaced with a "Share" Button.', 'vidmov'),
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_archive_order',
        'type' => 'select',
        'title' => esc_html__('Default Ordering', 'vidmov'),
        'desc' => esc_html__('Arrange display for posts in Archive Page.', 'vidmov'),
        'default' => 'new',
        'options' => apply_filters('beeteam368_ordering_options', array(			
			'new' => esc_html__('Newest Items', 'vidmov'),
			'old' => esc_html__('Oldest Items', 'vidmov'),
			'title_a_z' => esc_html__('Alphabetical (A-Z)', 'vidmov'),
			'title_z_a' => esc_html__('Alphabetical (Z-A)', 'vidmov'),
		)),
        'select2' => array(
            'allowClear' => false
        ),
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_pagination',
        'type' => 'select',
        'title' => esc_html__('Pagination', 'vidmov'),
        'desc' => esc_html__('Choose type of navigation. For WP PageNavi, you will need to install WP PageNavi plugin.', 'vidmov'),
        'default' => 'wp-default',
        'options' => apply_filters('beeteam368_register_pagination_theme_settings', array(
        	'wp-default' => esc_html__('WordPress Default', 'vidmov'),
			'loadmore-btn' => esc_html__('Load More Button (Ajax)', 'vidmov'),
			'infinite-scroll' => esc_html__('Infinite Scroll (Ajax)', 'vidmov'),
        )),
        'select2' => array(
            'allowClear' => false
        ),
    ),
));

Redux::setSection($beeteam368_opt_name, array(
    'title' => esc_html__('Blog Settings', 'vidmov'),
    'id' => BEETEAM368_PREFIX . '_blog_settings',
    'icon' => 'el el-rss',
    'fields' => $beeteam368_to_blog_settings,
));/*Blog Settings*/

/*Single Post Settings*/
$beeteam368_to_single_post_settings = apply_filters('beeteam368_to_single_post_settings', array(
	array(
		'id' 			=> BEETEAM368_PREFIX . '_single_full_width_mode',
		'type'	 		=> 'select',
		'title' 		=> esc_html__('Full-Width Mode', 'vidmov'),	
		'desc' 			=> esc_html__('Change Full-Width Mode. Select "Default" to use settings in Theme Options > Styling.', 'vidmov'),				
		'default' 		=> '',
		'options'  		=> array(
			''	 		=> esc_html__('Default', 'vidmov'),
			'on' 		=> esc_html__('ON', 'vidmov'),
			'off'	 	=> esc_html__('OFF', 'vidmov'),
		),		
	),	
	array(
        'id' => BEETEAM368_PREFIX . '_single_sidebar',
        'type' => 'image_select',
        'title' => esc_html__('Sidebar', 'vidmov'),
        'desc' => esc_html__('Select Sidebar Appearance.', 'vidmov'),
        'default' => 'right',
        'options' => $beeteam368_all_sidebar_positions,
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_nav_layout_in_single',
        'type' => 'image_select',
        'title' => esc_html__('Main Navigation Style', 'vidmov'),
        'desc' => esc_html__('Change header style for single posts (& single post of any post type). Select "Default" to use settings in Theme Options > Header.', 'vidmov'),
        'default' => '',
        'options' => array(
			'' => array(
                'alt' => esc_html__('Default', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-to-hz.png'
            ),
			'poppy' => array(
                'alt' => esc_html__('Poppy', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-poppy.png'
            ),
            'default' => array(
                'alt' => esc_html__('Default', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-default.png'
            ),
            'alyssa' => array(
                'alt' => esc_html__('Alyssa', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-alyssa.png'
            ),
            'leilani' => array(
                'alt' => esc_html__('Leilani', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-leilani.png'
            ),
			/*
            'lily' => array(
                'alt' => esc_html__('Lily', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-lily.png'
            ),
			*/
            'marguerite' => array(
                'alt' => esc_html__('Marguerite', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-marguerite.png'
            ),
            'rose' => array(
                'alt' => esc_html__('Rose', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-rose.png'
            ),			
        ),
    ),
	
    array(
        'id' => BEETEAM368_PREFIX . '_display_single_post_author',
        'type' => 'switch',
        'title' => esc_html__('Display Post Author', 'vidmov'),
        'default' => true,
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_display_single_post_categories',
        'type' => 'switch',
        'title' => esc_html__('Display Post Categories', 'vidmov'),
        'default' => true,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_single_post_published_date',
        'type' => 'switch',
        'title' => esc_html__('Display Post Published Date', 'vidmov'),
        'default' => true,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_single_post_updated_date',
        'type' => 'switch',
        'title' => esc_html__('Display Post Last Updated', 'vidmov'),
        'default' => false,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_single_post_reactions',
        'type' => 'switch',
        'title' => esc_html__('Display Post Reactions', 'vidmov'),
        'default' => true,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_single_post_comments',
        'type' => 'switch',
        'title' => esc_html__('Display Post Comments Count', 'vidmov'),
        'default' => true,
    ),

    array(
        'id' => BEETEAM368_PREFIX . '_display_single_post_views',
        'type' => 'switch',
        'title' => esc_html__('Display Post Views Count', 'vidmov'),
        'default' => true,
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_display_single_post_tags',
        'type' => 'switch',
        'title' => esc_html__('Display Post Tags', 'vidmov'),
        'default' => true,
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_display_single_post_prev_next',
        'type' => 'switch',
        'title' => esc_html__('Display Prev/Next Posts', 'vidmov'),
        'default' => true,
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_display_single_related_posts',
        'type' => 'switch',
        'title' => esc_html__('Display Related Posts', 'vidmov'),
        'default' => true,
    ),
		array(
			'id' 		=> BEETEAM368_PREFIX . '_single_post_related_title',
			'type'	 	=> 'text',
			'title' 	=> esc_html__('Related Posts - Header Title', 'vidmov'),
			'desc' 		=> esc_html__('Enter Title for Related Posts section', 'vidmov'),
			'required' 	=> array( BEETEAM368_PREFIX . '_display_single_related_posts', '=', '1' ),
			'default'	=> esc_html__('Related Posts', 'vidmov'),
		),
		array(
			'id' 			=> BEETEAM368_PREFIX . '_single_post_related_query',
			'type'	 		=> 'select',
			'title' 		=> esc_html__('Related Posts - Query', 'vidmov'),					
			'default' 		=> 'cats',
			'options'  		=> array(
				'cats' 		=> esc_html__('Querying posts from same Categories', 'vidmov'),
				'tags'	 	=> esc_html__('Querying posts from same Tags', 'vidmov'),
			),
			'required' 		=> array( BEETEAM368_PREFIX . '_display_single_related_posts', '=', '1' ),
		),		
		array(
			'id' 			=> BEETEAM368_PREFIX . '_single_post_related_order',
			'type'	 		=> 'select',
			'title' 		=> esc_html__('Related Posts - Order By', 'vidmov'),					
			'default' 		=> 'date',
			'options' 		=> apply_filters('beeteam368_order_by_custom_query', [
									'date' 			=> esc_html__('Date', 'vidmov'),																		
									'ID' 			=> esc_html__('Order by post ID', 'vidmov'),
									'author' 		=> esc_html__('Author', 'vidmov'),
									'title' 		=> esc_html__('Title', 'vidmov'),
									'modified' 		=> esc_html__('Last modified date', 'vidmov'),
									'parent' 		=> esc_html__('Post/page parent ID', 'vidmov'),
									'comment_count' => esc_html__('Number of comments', 'vidmov'),
									'menu_order' 	=> esc_html__('Menu order/Page Order', 'vidmov'),
									'rand' 			=> esc_html__('Random order', 'vidmov'),																				
									'post__in' 		=> esc_html__('Preserve post ID order', 'vidmov'),										
								]),
			'required' 		=> array( BEETEAM368_PREFIX . '_display_single_related_posts', '=', '1' ),
		),
		array(
			'id' 			=> BEETEAM368_PREFIX . '_single_post_related_sort',
			'type'	 		=> 'select',
			'title' 		=> esc_html__('Related Posts - Sort Order', 'vidmov'),					
			'default' 		=> 'DESC',
			'options' 		=> array(			
				'DESC' 		=> esc_html__('Descending', 'vidmov'),																		
				'ASC' 		=> esc_html__('Ascending', 'vidmov'),
			),
			'required' 		=> array( BEETEAM368_PREFIX . '_display_single_related_posts', '=', '1' ),
		),
		array(
			'id' 			=> BEETEAM368_PREFIX . '_single_post_related_count',
			'type'	 		=> 'text',
			'title' 		=> esc_html__('Related Posts - Count', 'vidmov'),
			'desc' 			=> esc_html__('Number of related posts', 'vidmov'),
			'default'		=> 10,
			'required' 		=> array( BEETEAM368_PREFIX . '_display_single_related_posts', '=', '1' ),			
		),
		array(
			'id' 			=> BEETEAM368_PREFIX . '_single_post_related_loop_style',
			'type' 			=> 'image_select',
			'title' 		=> esc_html__('Related Posts - Loop Style', 'vidmov'),
			'desc' 			=> esc_html__('Choose a style for related posts.', 'vidmov'),
			'default' 		=> 'marguerite',
			'options' 		=> $beeteam368_all_blog_layouts,
			'required' 		=> array( BEETEAM368_PREFIX . '_display_single_related_posts', '=', '1' ),
		),
));
Redux::setSection($beeteam368_opt_name, array(
    'title' => esc_html__('Single Post Settings', 'vidmov'),
    'id' => BEETEAM368_PREFIX . '_single_post_settings',
    'icon' => 'el el-quote-right',
    'fields' => $beeteam368_to_single_post_settings,
));
/*Single Post Settings*/

/*Search Settings*/
$beeteam368_to_search_settings = apply_filters('beeteam368_to_search_settings', array(
	array(
		'id' 			=> BEETEAM368_PREFIX . '_search_full_width_mode',
		'type'	 		=> 'select',
		'title' 		=> esc_html__('Full-Width Mode', 'vidmov'),	
		'desc' 			=> esc_html__('Change Full-Width Mode. Select "Default" to use settings in Theme Options > Styling.', 'vidmov'),				
		'default' 		=> '',
		'options'  		=> array(
			''	 		=> esc_html__('Default', 'vidmov'),
			'on' 		=> esc_html__('ON', 'vidmov'),
			'off'	 	=> esc_html__('OFF', 'vidmov'),
		),		
	),
    array(
        'id' => BEETEAM368_PREFIX . '_search_loop_style',
        'type' => 'image_select',
        'title' => esc_html__('Search Loop Style', 'vidmov'),
        'desc' => esc_html__('Choose a style for search page.', 'vidmov'),
        'default' => 'alyssa',
        'options' => $beeteam368_all_blog_layouts,
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_search_sidebar',
        'type' => 'image_select',
        'title' => esc_html__('Sidebar', 'vidmov'),
        'desc' => esc_html__('Select Sidebar Appearance.', 'vidmov'),
        'default' => 'right',
        'options' => $beeteam368_all_sidebar_positions,
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_nav_layout_in_search',
        'type' => 'image_select',
        'title' => esc_html__('Main Navigation Style', 'vidmov'),
        'desc' => esc_html__('Change header style for search page. Select "Default" to use settings in Theme Options > Header.', 'vidmov'),
        'default' => '',
        'options' => array(
			'' => array(
                'alt' => esc_html__('Default', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-to-hz.png'
            ),
			'poppy' => array(
                'alt' => esc_html__('Poppy', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-poppy.png'
            ),
            'default' => array(
                'alt' => esc_html__('Default', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-default.png'
            ),
            'alyssa' => array(
                'alt' => esc_html__('Alyssa', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-alyssa.png'
            ),
            'leilani' => array(
                'alt' => esc_html__('Leilani', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-leilani.png'
            ),
            /*
			'lily' => array(
                'alt' => esc_html__('Lily', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-lily.png'
            ),
			*/
            'marguerite' => array(
                'alt' => esc_html__('Marguerite', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-marguerite.png'
            ),
            'rose' => array(
                'alt' => esc_html__('Rose', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-rose.png'
            ),			
        ),
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_search_order',
        'type' => 'select',
        'title' => esc_html__('Default Ordering', 'vidmov'),
        'desc' => esc_html__('Arrange display for posts in Search Page.', 'vidmov'),
        'default' => 'new',
        'options' => apply_filters('beeteam368_ordering_options', array(			
			'new' => esc_html__('Newest Items', 'vidmov'),
			'old' => esc_html__('Oldest Items', 'vidmov'),
			'title_a_z' => esc_html__('Alphabetical (A-Z)', 'vidmov'),
			'title_z_a' => esc_html__('Alphabetical (Z-A)', 'vidmov'),
		)),
        'select2' => array(
            'allowClear' => false
        ),
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_search_pagination',
        'type' => 'select',
        'title' => esc_html__('Pagination', 'vidmov'),
        'desc' => esc_html__('Choose type of navigation. For WP PageNavi, you will need to install WP PageNavi plugin. Select "Blank" to use settings in Theme Options > Blog Settings.', 'vidmov'),
        'default' => '',
        'options' => apply_filters('beeteam368_register_pagination_theme_settings', array(
			'' => esc_html__('Default', 'vidmov'),
        	'wp-default' => esc_html__('WordPress Default', 'vidmov'),
			'loadmore-btn' => esc_html__('Load More Button (Ajax)', 'vidmov'),
			'infinite-scroll' => esc_html__('Infinite Scroll (Ajax)', 'vidmov'),
        )),
        'select2' => array(
            'allowClear' => true
        ),
    ),
));

Redux::setSection($beeteam368_opt_name, array(
    'title' => esc_html__('Search Settings', 'vidmov'),
    'id' => BEETEAM368_PREFIX . '_search_settings',
    'icon' => 'el el-search',
    'fields' => $beeteam368_to_search_settings,
));/*Search Settings*/

/*Author Settings*/
$beeteam368_to_author_settings = apply_filters('beeteam368_to_author_settings', array(
	array(
		'id' 			=> BEETEAM368_PREFIX . '_author_full_width_mode',
		'type'	 		=> 'select',
		'title' 		=> esc_html__('Full-Width Mode', 'vidmov'),	
		'desc' 			=> esc_html__('Change Full-Width Mode. Select "Default" to use settings in Theme Options > Styling.', 'vidmov'),				
		'default' 		=> '',
		'options'  		=> array(
			''	 		=> esc_html__('Default', 'vidmov'),
			'on' 		=> esc_html__('ON', 'vidmov'),
			'off'	 	=> esc_html__('OFF', 'vidmov'),
		),		
	),
    array(
        'id' => BEETEAM368_PREFIX . '_author_loop_style',
        'type' => 'image_select',
        'title' => esc_html__('Loop Style', 'vidmov'),
        'desc' => esc_html__('Choose a style for author page.', 'vidmov'),
        'default' => 'alyssa',
        'options' => $beeteam368_all_blog_layouts,
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_author_sidebar',
        'type' => 'image_select',
        'title' => esc_html__('Sidebar', 'vidmov'),
        'desc' => esc_html__('Select Sidebar Appearance.', 'vidmov'),
        'default' => 'right',
        'options' => $beeteam368_all_sidebar_positions,
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_nav_layout_in_author',
        'type' => 'image_select',
        'title' => esc_html__('Main Navigation Style', 'vidmov'),
        'desc' => esc_html__('Change header style for author page. Select "Default" to use settings in Theme Options > Blog Settings.', 'vidmov'),
        'default' => '',
        'options' => array(
			'' => array(
                'alt' => esc_html__('Default', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/archive-to-hz.png'
            ),
			'poppy' => array(
                'alt' => esc_html__('Poppy', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-poppy.png'
            ),
            'default' => array(
                'alt' => esc_html__('Default', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-default.png'
            ),
            'alyssa' => array(
                'alt' => esc_html__('Alyssa', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-alyssa.png'
            ),
            'leilani' => array(
                'alt' => esc_html__('Leilani', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-leilani.png'
            ),
            /*
			'lily' => array(
                'alt' => esc_html__('Lily', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-lily.png'
            ),
			*/
            'marguerite' => array(
                'alt' => esc_html__('Marguerite', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-marguerite.png'
            ),
            'rose' => array(
                'alt' => esc_html__('Rose', 'vidmov'),
                'img' => get_template_directory_uri() . '/inc/theme-options/images/header-rose.png'
            ),			
        ),
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_author_order',
        'type' => 'select',
        'title' => esc_html__('Default Ordering', 'vidmov'),
        'desc' => esc_html__('Arrange display for posts in author page.', 'vidmov'),
        'default' => 'new',
        'options' => apply_filters('beeteam368_ordering_options', array(			
			'new' => esc_html__('Newest Items', 'vidmov'),
			'old' => esc_html__('Oldest Items', 'vidmov'),
			'title_a_z' => esc_html__('Alphabetical (A-Z)', 'vidmov'),
			'title_z_a' => esc_html__('Alphabetical (Z-A)', 'vidmov'),
		)),
        'select2' => array(
            'allowClear' => false
        ),
    ),
	
	array(
        'id' => BEETEAM368_PREFIX . '_author_pagination',
        'type' => 'select',
        'title' => esc_html__('Pagination', 'vidmov'),
        'desc' => esc_html__('Choose type of navigation. For WP PageNavi, you will need to install WP PageNavi plugin. Select "Blank" to use settings in Theme Options > Blog Settings.', 'vidmov'),
        'default' => '',
        'options' => apply_filters('beeteam368_register_pagination_theme_settings', array(
			'' => esc_html__('Default', 'vidmov'),
        	'wp-default' => esc_html__('WordPress Default', 'vidmov'),
			'loadmore-btn' => esc_html__('Load More Button (Ajax)', 'vidmov'),
			'infinite-scroll' => esc_html__('Infinite Scroll (Ajax)', 'vidmov'),
        )),
        'select2' => array(
            'allowClear' => true
        ),
    ),
));

Redux::setSection($beeteam368_opt_name, array(
    'title' => esc_html__('Author Settings', 'vidmov'),
    'id' => BEETEAM368_PREFIX . '_author_settings',
    'icon' => 'el el-adult',
    'fields' => $beeteam368_to_author_settings,
));/*Author Settings*/

/*pagenotfound_settings*/	
	Redux::setSection( $beeteam368_opt_name, array(
		'title' 	=> esc_html__( '404 Page Not Found', 'vidmov'),
		'id'    	=> 'pagenotfound_settings',
		'icon'  	=> 'el el-error-alt',
		'fields'	=>	array(
			array(
				'id' 			=> BEETEAM368_PREFIX . '_img_404',
				'type'	 		=> 'media',				
				'title' 		=> esc_html__('404 Image', 'vidmov'),
				'desc' 			=> esc_html__('Upload your image for 404 Page', 'vidmov'),
				'placeholder'	=> esc_html__('No image selected', 'vidmov'),
				'readonly'		=> false,
				'url'			=> true,
			),
			array(
				'id' 		=> BEETEAM368_PREFIX . '_content_404',
				'type'	 	=> 'text',
				'title' 	=> esc_html__('404 Content', 'vidmov'),
				'desc' 		=> esc_html__('Content of Page Not Found', 'vidmov'),
			),
			array(
				'id' 		=> BEETEAM368_PREFIX . '_button_404',
				'type'	 	=> 'text',
				'title' 	=> esc_html__('Back Button Text', 'vidmov'),
				'desc' 		=> esc_html__('Text for "Back to homepage" button', 'vidmov'),
			),
		)
	));
/*pagenotfound_settings*/

/*Typo*/
$beeteam368_to_typography_settings = apply_filters('beeteam368_to_typography_settings', array(
    /*main font*/
    apply_filters('beeteam368_to_typography_custom_font_before', array()),

    array(
        'id' 			=> 'main-font-section-start',
        'type'	 		=> 'section',
        'title' 		=> esc_html__('Main Font Settings', 'vidmov'),
        'indent' => true
    ),
        apply_filters('beeteam368_to_typography_custom_font_family', array(), 'main'),

        array(
            'id' 				=> BEETEAM368_PREFIX . '_main_font_properties',
            'type'	 			=> 'typography',
            'units'				=> 'em',
            'title' 			=> esc_html__('Font Properties', 'vidmov'),
            'text-align'		=> false,
            'text-transform'	=> true,
            'color'				=> false,
            'letter-spacing'	=> true,
            'font-size'			=> false,
            'subsets'           => false,
        ),
        array(
            'id' 			=> BEETEAM368_PREFIX . '_main_font_scale',
            'type'	 		=> 'slider',
            'title' 		=> esc_html__('Font Scale', 'vidmov'),
            'desc' 			=> esc_html__('Default: 1.00', 'vidmov'),
            'min'			=> 0.5,
            'max'			=> 3,
            'step'			=> 0.01,
            'default'		=> 1,
            'resolution'	=> 0.01,
        ),
    array(
        'id' 			=> 'main-font-section-end',
        'type'	 		=> 'section',
        'indent' => false
    ),/*main font*/

    /*heading font*/
    array(
        'id' 			=> 'heading-font-section-start',
        'type'	 		=> 'section',
        'title' 		=> esc_html__('Heading Font Settings', 'vidmov'),
        'indent' => true
    ),
        apply_filters('beeteam368_to_typography_custom_font_family', array(), 'heading'),

        array(
            'id' 				=> BEETEAM368_PREFIX . '_heading_font_properties',
            'type'	 			=> 'typography',
            'units'				=> 'em',
            'title' 			=> esc_html__('Font Properties', 'vidmov'),
            'text-align'		=> false,
            'text-transform'	=> true,
            'color'				=> false,
            'letter-spacing'	=> true,
            'font-size'			=> false,
            'subsets'           => false,
        ),
        array(
            'id' 			=> BEETEAM368_PREFIX . '_heading_font_scale',
            'type'	 		=> 'slider',
            'title' 		=> esc_html__('Font Scale', 'vidmov'),
            'desc' 			=> esc_html__('Default: 1.00', 'vidmov'),
            'min'			=> 0.5,
            'max'			=> 3,
            'step'			=> 0.01,
            'default'		=> 1,
            'resolution'	=> 0.01,
        ),
    array(
        'id' 			=> 'heading-font-section-end',
        'type'	 		=> 'section',
        'indent' => false
    ),/*heading font*/

    /*navigation font*/
    array(
        'id' 			=> 'navigation-font-section-start',
        'type'	 		=> 'section',
        'title' 		=> esc_html__('Navigation Font Settings', 'vidmov'),
        'indent' => true
    ),
        apply_filters('beeteam368_to_typography_custom_font_family', array(), 'navigation'),

        array(
            'id' 				=> BEETEAM368_PREFIX . '_navigation_font_properties',
            'type'	 			=> 'typography',
            'units'				=> 'em',
            'title' 			=> esc_html__('Font Properties', 'vidmov'),
            'text-align'		=> false,
            'text-transform'	=> true,
            'color'				=> false,
            'letter-spacing'	=> true,
            'font-size'			=> false,
            'subsets'           => false,
        ),
        array(
            'id' 			=> BEETEAM368_PREFIX . '_navigation_font_scale',
            'type'	 		=> 'slider',
            'title' 		=> esc_html__('Font Scale', 'vidmov'),
            'desc' 			=> esc_html__('Default: 1.00', 'vidmov'),
            'min'			=> 0.5,
            'max'			=> 3,
            'step'			=> 0.01,
            'default'		=> 1,
            'resolution'	=> 0.01,
        ),
    array(
        'id' 			=> 'navigation-font-section-end',
        'type'	 		=> 'section',
        'indent' => false
    ),/*navigation font*/

    /*meta font*/
    array(
        'id' 			=> 'meta-font-section-start',
        'type'	 		=> 'section',
        'title' 		=> esc_html__('Post Meta Font Settings', 'vidmov'),
        'indent' => true
    ),
        apply_filters('beeteam368_to_typography_custom_font_family', array(), 'meta'),

        array(
            'id' 				=> BEETEAM368_PREFIX . '_meta_font_properties',
            'type'	 			=> 'typography',
            'units'				=> 'em',
            'title' 			=> esc_html__('Font Properties', 'vidmov'),
            'text-align'		=> false,
            'text-transform'	=> true,
            'color'				=> false,
            'letter-spacing'	=> true,
            'font-size'			=> false,
            'subsets'           => false,
        ),
        array(
            'id' 			=> BEETEAM368_PREFIX . '_meta_font_scale',
            'type'	 		=> 'slider',
            'title' 		=> esc_html__('Font Scale', 'vidmov'),
            'desc' 			=> esc_html__('Default: 1.00', 'vidmov'),
            'min'			=> 0.5,
            'max'			=> 3,
            'step'			=> 0.01,
            'default'		=> 1,
            'resolution'	=> 0.01,
        ),
    array(
        'id' 			=> 'meta-font-section-end',
        'type'	 		=> 'section',
        'indent' => false
    ),/*meta font*/

    /*button font*/
    array(
        'id' 			=> 'button-font-section-start',
        'type'	 		=> 'section',
        'title' 		=> esc_html__('Button Font Settings', 'vidmov'),
        'indent' => true
    ),
        apply_filters('beeteam368_to_typography_custom_font_family', array(), 'button'),

        array(
            'id' 				=> BEETEAM368_PREFIX . '_button_font_properties',
            'type'	 			=> 'typography',
            'units'				=> 'em',
            'title' 			=> esc_html__('Font Properties', 'vidmov'),
            'text-align'		=> false,
            'text-transform'	=> true,
            'color'				=> false,
            'letter-spacing'	=> true,
            'font-size'			=> false,
            'subsets'           => false,
        ),
        array(
            'id' 			=> BEETEAM368_PREFIX . '_button_font_scale',
            'type'	 		=> 'slider',
            'title' 		=> esc_html__('Font Scale', 'vidmov'),
            'desc' 			=> esc_html__('Default: 1.00', 'vidmov'),
            'min'			=> 0.5,
            'max'			=> 3,
            'step'			=> 0.01,
            'default'		=> 1,
            'resolution'	=> 0.01,
        ),
    array(
        'id' 			=> 'button-font-section-end',
        'type'	 		=> 'section',
        'indent' => false
    ),/*button font*/

    /*input font*/
    array(
        'id' 			=> 'input-field-font-section-start',
        'type'	 		=> 'section',
        'title' 		=> esc_html__('Input Field Font Settings', 'vidmov'),
        'indent' => true
    ),
        apply_filters('beeteam368_to_typography_custom_font_family', array(), 'input_field'),

        array(
            'id' 				=> BEETEAM368_PREFIX . '_input_field_font_properties',
            'type'	 			=> 'typography',
            'units'				=> 'em',
            'title' 			=> esc_html__('Font Properties', 'vidmov'),
            'text-align'		=> false,
            'text-transform'	=> true,
            'color'				=> false,
            'letter-spacing'	=> true,
            'font-size'			=> false,
            'subsets'           => false,
        ),
        array(
            'id' 			=> BEETEAM368_PREFIX . '_input_field_font_scale',
            'type'	 		=> 'slider',
            'title' 		=> esc_html__('Font Scale', 'vidmov'),
            'desc' 			=> esc_html__('Default: 1.00', 'vidmov'),
            'min'			=> 0.5,
            'max'			=> 3,
            'step'			=> 0.01,
            'default'		=> 1,
            'resolution'	=> 0.01,
        ),
    array(
        'id' 			=> 'input_field-font-section-end',
        'type'	 		=> 'section',
        'indent' => false
    ),/*input font*/

    apply_filters('beeteam368_to_typography_custom_font_after', array()),
));

Redux::setSection($beeteam368_opt_name, array(
    'title' => esc_html__('Typography', 'vidmov'),
    'id' => BEETEAM368_PREFIX . '_typography',
    'icon' => 'el el-fontsize',
    'fields' => $beeteam368_to_typography_settings,
));
/*Typo*/