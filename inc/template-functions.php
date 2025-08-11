<?php
if (!function_exists('beeteam368_body_classes')):
    function beeteam368_body_classes($classes)
    {
		$_light_dark_btn = beeteam368_get_redux_option('_light_dark_btn', 'on', 'switch');
		if($_light_dark_btn === 'on'){
			if(isset($_COOKIE['beeteam368_dark_mode'])){
				$beeteam368_dark_mode = $_COOKIE['beeteam368_dark_mode'] == 'true'?true:false;
			}			
		}else{
			if(isset($_COOKIE['beeteam368_dark_mode'])){
				unset($_COOKIE['beeteam368_dark_mode']); 
    			setcookie('beeteam368_dark_mode', NULL, -1, '/'); 
			}			
		}		
		if(isset($beeteam368_dark_mode)){
			if($beeteam368_dark_mode){
				$classes[] = 'dark-mode';
			}
		}else{
			$_light_dark_mode = beeteam368_get_redux_option('_light_dark_mode', 'light');
			if ($_light_dark_mode === 'dark') {
				$classes[] = 'dark-mode';
			}
		}

        $_full_width_mode = beeteam368_full_width_mode_control();
        if ($_full_width_mode === 'on') {
            $classes[] = 'full-width-mode';
        }

        if (beeteam368_side_menu_control() === 'on') {
            $classes[] = 'side-menu-mode';

            if (beeteam368_side_menu_status() === 'open') {
                $classes[] = 'sidemenu-active';
            }

            if(beeteam368_side_menu_position() === 'right') {
                $classes[] = 'sidemenu-right';
            }
        }

        $beeteam368_sidebar_control = beeteam368_sidebar_control();
        if($beeteam368_sidebar_control != 'hidden'){
            $classes[] = 'is-sidebar sidebar-' . $beeteam368_sidebar_control;
        }
		
		$classes[] = 'beeteam368-body-control-class';

        return $classes;
    }
endif;
add_filter('body_class', 'beeteam368_body_classes');

if (!function_exists('beeteam368_container_classes')):
    function beeteam368_container_classes($classes)
    {
        $_full_width_mode = beeteam368_full_width_mode_control();
        if ($_full_width_mode == 'on') {
            $classes = $classes . ' site__container-fluid';
            return $classes;
        }
        return $classes;
    }
endif;
add_filter('beeteam368_st_container_class_control', 'beeteam368_container_classes', 10, 1);

if (!function_exists('beeteam368_full_width_mode_control')):
    function beeteam368_full_width_mode_control()
    {
        global $beeteam368_full_width_mode_control;

        if (isset($beeteam368_full_width_mode_control) && $beeteam368_full_width_mode_control != '') {
            return $beeteam368_full_width_mode_control;
        }

        $beeteam368_full_width_mode_control = '';

        if (!defined('BEETEAM368_PREFIX')) {
            define('BEETEAM368_PREFIX', 'beeteam368');
        }

        if (is_page() || is_single()) {
            $beeteam368_full_width_mode_control = get_post_meta(get_the_ID(), BEETEAM368_PREFIX . '_full_width_mode', true);
			
			if(is_single() && $beeteam368_full_width_mode_control == ''){
				$beeteam368_full_width_mode_control = apply_filters('beeteam368_custom_single_full_width_mode', '');
				if($beeteam368_full_width_mode_control == ''){
					$beeteam368_full_width_mode_control = beeteam368_get_redux_option('_single_full_width_mode', '');
				}
			}
        }elseif(is_archive()){
            if(is_tax() || is_category()){
                $beeteam368_full_width_mode_control = get_term_meta(get_queried_object()->term_id, BEETEAM368_PREFIX . '_full_width_mode', true);
            }elseif(is_author()){
				$beeteam368_full_width_mode_control = beeteam368_get_redux_option('_author_full_width_mode', '');
			}
			
			if($beeteam368_full_width_mode_control == ''){				
				$beeteam368_full_width_mode_control = apply_filters('beeteam368_custom_archive_full_width_mode', '');				
				if($beeteam368_full_width_mode_control == ''){
					$beeteam368_full_width_mode_control = beeteam368_get_redux_option('_blog_full_width_mode', '');
				}
			}
        }elseif(is_search()){
			$beeteam368_full_width_mode_control = beeteam368_get_redux_option('_search_full_width_mode', '');
		}

        if ($beeteam368_full_width_mode_control == '') {
            $beeteam368_full_width_mode_control = beeteam368_get_redux_option('_full_width_mode', 'off', 'switch');
        }
		
		$beeteam368_full_width_mode_control = apply_filters('beeteam368_custom_value_full_width_mode', $beeteam368_full_width_mode_control);

        return $beeteam368_full_width_mode_control;
    }
endif;

if (!function_exists('beeteam368_container_classes_control')):
    function beeteam368_container_classes_control($position = '')
    {
        return apply_filters('beeteam368_st_container_class_control', 'site__container main__container-control', $position);
    }
endif;

if (!function_exists('beeteam368_header_style')) :
    function beeteam368_header_style()
    {
        global $beeteam368_header_style;

        if (isset($beeteam368_header_style) && $beeteam368_header_style != '') {
            return $beeteam368_header_style;
        }

        $beeteam368_header_style = '';

        if (!defined('BEETEAM368_PREFIX')) {
            define('BEETEAM368_PREFIX', 'beeteam368');
        }

        if (is_page() || is_single()) {
            $beeteam368_header_style = get_post_meta(get_the_ID(), BEETEAM368_PREFIX . '_nav_layout', true);
			
			if($beeteam368_header_style == ''){
				$beeteam368_header_style = beeteam368_get_redux_option('_nav_layout_in_single', '');
			}
        }elseif(is_archive()){
			if(is_author()){
				$beeteam368_header_style = beeteam368_get_redux_option('_nav_layout_in_author', '');
			}
			
			if($beeteam368_header_style == ''){
				$beeteam368_header_style = beeteam368_get_redux_option('_nav_layout_in_archive', '');
			}
			
		}elseif(is_search()){
			$beeteam368_header_style = beeteam368_get_redux_option('_nav_layout_in_search', '');
		}

        if ($beeteam368_header_style == '') {
            $beeteam368_header_style = beeteam368_get_redux_option('_nav_layout', 'poppy');
        }

        if(isset($_GET['beeteam368_header_style']) && trim($_GET['beeteam368_header_style']) !== ''){
            $beeteam368_header_style = trim($_GET['beeteam368_header_style']);
        }

        return $beeteam368_header_style;
    }
endif;

if (!function_exists('beeteam368_side_menu_control')) :
    function beeteam368_side_menu_control()
    {
        global $beeteam368_side_menu_control;

        if (isset($beeteam368_side_menu_control) && $beeteam368_side_menu_control != '') {
            return $beeteam368_side_menu_control;
        }

        $beeteam368_side_menu_control = '';

        if (!defined('BEETEAM368_PREFIX')) {
            define('BEETEAM368_PREFIX', 'beeteam368');
        }

        if (is_page() || is_single()) {
            $beeteam368_side_menu_control = get_post_meta(get_the_ID(), BEETEAM368_PREFIX . '_side_menu', true);
            if(is_page_template( array('elementor_canvas', 'redux-templates_canvas') )){
                $beeteam368_side_menu_control = 'off';
            }
        }

        if($beeteam368_side_menu_control == '') {
            $beeteam368_side_menu_control = beeteam368_get_redux_option('_side_menu', 'on', 'switch');
        }
		
		$beeteam368_side_menu_control = apply_filters('beeteam368_custom_value_side_menu_mode', $beeteam368_side_menu_control);

        return $beeteam368_side_menu_control;
    }
endif;

if (!function_exists('beeteam368_side_menu_status')) :
    function beeteam368_side_menu_status()
    {
        global $beeteam368_side_menu_status;

        if (isset($beeteam368_side_menu_status) && $beeteam368_side_menu_status != '') {
            return $beeteam368_side_menu_status;
        }

        $beeteam368_side_menu_status = '';

        if (!defined('BEETEAM368_PREFIX')) {
            define('BEETEAM368_PREFIX', 'beeteam368');
        }

        if (is_page() || is_single()) {
            $beeteam368_side_menu_control = get_post_meta(get_the_ID(), BEETEAM368_PREFIX . '_side_menu', true);
            if($beeteam368_side_menu_control === 'on'){
                $beeteam368_side_menu_status = get_post_meta(get_the_ID(), BEETEAM368_PREFIX . '_side_menu_status', true);
            }
        }

        if($beeteam368_side_menu_status == '') {
            $beeteam368_side_menu_status = beeteam368_get_redux_option('_side_menu_status', 'close');
        }

        return $beeteam368_side_menu_status;
    }
endif;

if (!function_exists('beeteam368_side_menu_position')) :
    function beeteam368_side_menu_position()
    {
        global $beeteam368_side_menu_position;

        if (isset($beeteam368_side_menu_position) && $beeteam368_side_menu_position != '') {
            return $beeteam368_side_menu_position;
        }

        $beeteam368_side_menu_position = '';

        if (!defined('BEETEAM368_PREFIX')) {
            define('BEETEAM368_PREFIX', 'beeteam368');
        }

        if (is_page() || is_single()) {
            $beeteam368_side_menu_control = get_post_meta(get_the_ID(), BEETEAM368_PREFIX . '_side_menu', true);
            if($beeteam368_side_menu_control === 'on'){
                $beeteam368_side_menu_position = get_post_meta(get_the_ID(), BEETEAM368_PREFIX . '_side_menu_position', true);
            }
        }

        if($beeteam368_side_menu_position == '') {
            $beeteam368_side_menu_position = beeteam368_get_redux_option('_side_menu_position', 'left');
        }

        return $beeteam368_side_menu_position;
    }
endif;

if (!function_exists('beeteam368_side_menu_navigation')) :
    function beeteam368_side_menu_navigation()
    {
        global $beeteam368_side_menu_navigation;

        if (isset($beeteam368_side_menu_navigation) && $beeteam368_side_menu_navigation != '') {
            return $beeteam368_side_menu_navigation;
        }

        $beeteam368_side_menu_navigation = '';

        if (!defined('BEETEAM368_PREFIX')) {
            define('BEETEAM368_PREFIX', 'beeteam368');
        }

        if (is_page() || is_single()) {
            $beeteam368_side_menu_control = get_post_meta(get_the_ID(), BEETEAM368_PREFIX . '_side_menu', true);
            if($beeteam368_side_menu_control === 'on'){
                $beeteam368_side_menu_navigation = get_post_meta(get_the_ID(), BEETEAM368_PREFIX . '_side_menu_nav', true);
            }
        }

        if($beeteam368_side_menu_navigation == '') {
            $beeteam368_side_menu_navigation = beeteam368_get_redux_option('_side_menu_nav', 'on', 'switch');
        }

        return $beeteam368_side_menu_navigation;
    }
endif;

if (!function_exists('beeteam368_sidebar_control')) :
    function beeteam368_sidebar_control()
    {
        global $beeteam368_sidebar_control;

        if (isset($beeteam368_sidebar_control) && $beeteam368_sidebar_control != '') {
            return $beeteam368_sidebar_control;
        }

        $beeteam368_sidebar_control = '';

        if (!defined('BEETEAM368_PREFIX')) {
            define('BEETEAM368_PREFIX', 'beeteam368');
        }
		
		if(function_exists('is_account_page') && is_account_page()){
			$beeteam368_sidebar_control = 'hidden';	
			return $beeteam368_sidebar_control;		
		}
		
		if(function_exists('is_cart') && is_cart()){
			$beeteam368_sidebar_control = 'hidden';	
			return $beeteam368_sidebar_control;		
		}
		
		if(function_exists('is_checkout') && is_checkout()){
			$beeteam368_sidebar_control = 'hidden';	
			return $beeteam368_sidebar_control;		
		}
		
		if(function_exists('is_woocommerce') && is_woocommerce()){
			$woo_sidebar = beeteam368_get_option('_woocommerce_sidebar', '_woocommerce_settings', 'right');
			if(!is_active_sidebar('woocommerce-sidebar')){
				$beeteam368_sidebar_control = 'hidden';	
				return $beeteam368_sidebar_control;			
			}
			
			$beeteam368_sidebar_control = apply_filters('beeteam368_woocommerce_sidebar_control', $woo_sidebar);			
			return $beeteam368_sidebar_control;
		}
        
        if(function_exists('is_buddypress') && is_buddypress()){
            if(!is_active_sidebar('buddypress-sidebar')){
                $beeteam368_sidebar_control = 'hidden';	
                return $beeteam368_sidebar_control;			
            }
        }
		
		if(!is_active_sidebar('main-sidebar')){
			$beeteam368_sidebar_control = 'hidden';
			return $beeteam368_sidebar_control;
		}

        if (is_page() || is_single()) {
            $beeteam368_sidebar_control = get_post_meta(get_the_ID(), BEETEAM368_PREFIX . '_theme_sidebar', true);
			
			$post_page_id = get_the_ID();
			
			$channel = beeteam368_get_option('_channel', '_theme_settings', 'on');
			$channel_page = beeteam368_get_option('_channel_page', '_channel_settings', '');
			$member_page = beeteam368_get_option('_member_page', '_channel_settings', '');			
			if($channel === 'on' && ($post_page_id == $channel_page || $post_page_id == $member_page)){
				$beeteam368_sidebar_control = 'hidden';
			}
			
			$buyCred = beeteam368_get_option('_buycred', '_theme_settings', 'on');
			$buyCred_page = beeteam368_get_option('_buycred_page', '_theme_settings', '');			
			if($buyCred === 'on' && $post_page_id == $buyCred_page){
				$beeteam368_sidebar_control = 'hidden';
			}
			
			$_membership = beeteam368_get_option('_membership', '_theme_settings', 'on');
			$_membership_plans_page = beeteam368_get_option('_membership_plans_page', '_theme_settings', '');
			$_membership_transactions_page = beeteam368_get_option('_membership_transactions_page', '_theme_settings', '');			
			if($_membership === 'on' && ($post_page_id == $_membership_plans_page || $post_page_id == $_membership_transactions_page)){
				$beeteam368_sidebar_control = 'hidden';
			}
			
			if(function_exists('tml_get_action') && $action = tml_get_action()){				
				$beeteam368_sidebar_control = 'hidden';				
			}
			
            if(is_page_template( array('page-templates/blank-page-template.php', 'elementor_canvas', 'elementor_header_footer', 'redux-templates_contained', 'redux-templates_full_width', 'redux-templates_canvas') )){
                $beeteam368_sidebar_control = 'hidden';
            }
			
			if($beeteam368_sidebar_control == ''){
				$beeteam368_sidebar_control = apply_filters('beeteam368_default_sidebar_control', beeteam368_get_redux_option('_single_sidebar', 'right'));
			}
			
        }elseif(is_archive()){
            if(is_tax() || is_category()){
                $beeteam368_sidebar_control = get_term_meta(get_queried_object()->term_id, BEETEAM368_PREFIX . '_theme_sidebar', true);
            }elseif(is_author()){
				$beeteam368_sidebar_control = beeteam368_get_redux_option('_author_sidebar', 'right');
			}
			
			if($beeteam368_sidebar_control == ''){
				$beeteam368_sidebar_control = apply_filters('beeteam368_default_sidebar_control', beeteam368_get_redux_option('_archive_sidebar', 'right'));
			}
        }elseif(is_search()){
			$beeteam368_sidebar_control = beeteam368_get_redux_option('_search_sidebar', 'right');
		}elseif(is_404()){
			$beeteam368_sidebar_control = 'hidden';
		}

        if($beeteam368_sidebar_control == '') {
            $beeteam368_sidebar_control = apply_filters('beeteam368_default_sidebar_control', beeteam368_get_redux_option('_theme_sidebar', 'right'));
        }

        return $beeteam368_sidebar_control;
    }
endif;

if (!function_exists('beeteam368_archive_style')) :
    function beeteam368_archive_style()
    {
        global $beeteam368_archive_style;

        if (isset($beeteam368_archive_style) && $beeteam368_archive_style != '') {
            return $beeteam368_archive_style;
        }

        $beeteam368_archive_style = '';

        if (!defined('BEETEAM368_PREFIX')) {
            define('BEETEAM368_PREFIX', 'beeteam368');
        }

        if(is_archive()){
            if(is_tax() || is_category()){
                $beeteam368_archive_style = get_term_meta(get_queried_object()->term_id, BEETEAM368_PREFIX . '_archive_loop_style', true);
            }elseif(is_author()){
				$beeteam368_archive_style = beeteam368_get_redux_option('_author_loop_style', 'alyssa');
			}
        }elseif(is_search()){
			$beeteam368_archive_style = beeteam368_get_redux_option('_search_loop_style', 'alyssa');
		}

        if($beeteam368_archive_style == '') {
            $beeteam368_archive_style = apply_filters('beeteam368_default_archive_loop_style', beeteam368_get_redux_option('_archive_loop_style', 'default'));
        }

        if(isset($_GET['beeteam368_archive_style']) && trim($_GET['beeteam368_archive_style']) !== ''){
            $beeteam368_archive_style = trim($_GET['beeteam368_archive_style']);
        }

        return $beeteam368_archive_style;
    }
endif;

if (!function_exists('beeteam368_display_post_meta')) :
    function beeteam368_display_post_meta()
    {
        global $beeteam368_display_post_meta_override;

        if (!isset($beeteam368_display_post_meta_override) || !is_array($beeteam368_display_post_meta_override)){
            $beeteam368_display_post_meta_override = array();
        }

        $df_params = array(
            'level_2_show_author' => apply_filters('beeteam368_default_archive_display_author', beeteam368_get_redux_option('_display_author', 'on', 'switch')),
            'level_2_show_excerpt' => apply_filters('beeteam368_default_archive_display_excerpt', beeteam368_get_redux_option('_display_excerpt', 'on', 'switch')),
            'level_2_show_categories' => apply_filters('beeteam368_default_archive_display_post_categories', beeteam368_get_redux_option('_display_post_categories', 'on', 'switch')),
            'level_2_show_published_date' => apply_filters('beeteam368_default_archive_display_post_published_date', beeteam368_get_redux_option('_display_post_published_date', 'on', 'switch')),
            'level_2_show_updated_date' => apply_filters('beeteam368_default_archive_display_post_updated_date', beeteam368_get_redux_option('_display_post_updated_date', 'off', 'switch')),
            'level_2_show_reactions' => apply_filters('beeteam368_default_archive_display_post_reactions', beeteam368_get_redux_option('_display_post_reactions', 'on', 'switch')),
            'level_2_show_comments' => apply_filters('beeteam368_default_archive_display_post_comments', beeteam368_get_redux_option('_display_post_comments', 'on', 'switch')),
            'level_2_show_views_counter' => apply_filters('beeteam368_default_archive_display_post_views', beeteam368_get_redux_option('_display_post_views', 'on', 'switch')),
            'level_2_show_view_details' => apply_filters('beeteam368_default_archive_display_post_read_more', beeteam368_get_redux_option('_display_post_read_more', 'on', 'switch')),
        );

        if(is_archive()){
            if(is_author()){

            }elseif(is_category()){

            }
        }elseif(is_search()){

        }elseif(is_single()){			
			$df_params['level_2_show_author'] = apply_filters('beeteam368_default_display_single_post_author', beeteam368_get_redux_option('_display_single_post_author', 'on', 'switch'));
			$df_params['level_2_show_categories'] = apply_filters('beeteam368_default_display_single_post_categories', beeteam368_get_redux_option('_display_single_post_categories', 'on', 'switch'));
			$df_params['level_2_show_published_date'] = apply_filters('beeteam368_default_display_single_post_published_date', beeteam368_get_redux_option('_display_single_post_published_date', 'on', 'switch'));
			$df_params['level_2_show_updated_date'] = apply_filters('beeteam368_default_display_single_post_updated_date', beeteam368_get_redux_option('_display_single_post_updated_date', 'off', 'switch'));
			$df_params['level_2_show_reactions'] = apply_filters('beeteam368_default_display_single_post_reactions', beeteam368_get_redux_option('_display_single_post_reactions', 'on', 'switch'));
			$df_params['level_2_show_comments'] = apply_filters('beeteam368_default_display_single_post_comments', beeteam368_get_redux_option('_display_single_post_comments', 'on', 'switch'));
			$df_params['level_2_show_views_counter'] = apply_filters('beeteam368_default_display_single_post_views', beeteam368_get_redux_option('_display_single_post_views', 'on', 'switch'));			
		}

        $params = array_replace_recursive($df_params, $beeteam368_display_post_meta_override);

        return apply_filters('beeteam368_display_post_meta', $params);
    }
endif;

if (!function_exists('beeteam368_get_post_url')) :
    function beeteam368_get_post_url($post_id = NULL, $hook_params = array())
    {
        if($post_id == NULL){
            $post_id = get_the_ID();
        }

        if(!$post_id){
            return;
        }

        $df_params = array();
        $params = array_replace_recursive($df_params, $hook_params);
		
		$fn_url = apply_filters('beeteam368_get_post_url_rep', get_permalink($post_id), $post_id);
		
		global $beeteam368_get_post_url_rep_new;
		if(isset($beeteam368_get_post_url_rep_new) && $beeteam368_get_post_url_rep_new !== NULL && $beeteam368_get_post_url_rep_new!=''){
			$fn_url = apply_filters('beeteam368_get_post_url_rep_new', $beeteam368_get_post_url_rep_new, $post_id);
		}
		
        return $fn_url;
    }
endif;

if(!function_exists('beeteam368_number_format')) :
    function beeteam368_number_format($n = 0, $precision = 1, $format_type = 'short'){
        $new_number = 0;

        $format_type = beeteam368_get_redux_option('_number_format', 'short');

        if(isset($n) && is_numeric($n) && $n > 0){
            switch($format_type){
                case 'full':
                    $new_number = number_format_i18n($n);
                    break;
                case 'short':
                    if ($n < 900) {
                        $n_format = number_format($n, $precision);
                        $suffix = '';
                    } else if ($n < 900000) {
                        $n_format = number_format($n / 1000, $precision);
                        $suffix = 'K';
                    } else if ($n < 900000000) {
                        $n_format = number_format($n / 1000000, $precision);
                        $suffix = 'M';
                    } else if ($n < 900000000000) {
                        $n_format = number_format($n / 1000000000, $precision);
                        $suffix = 'B';
                    } else {
                        $n_format = number_format($n / 1000000000000, $precision);
                        $suffix = 'T';
                    }

                    if ( $precision > 0 ) {
                        $dotzero = '.' . str_repeat( '0', $precision );
                        $n_format = str_replace( $dotzero, '', $n_format );
                    }

                    return $n_format . $suffix;
                    break;
            }
        }
        return $new_number;
    }
endif;
add_filter('beeteam368_number_format', 'beeteam368_number_format', 10, 3);

if (!function_exists('beeteam368_pingback_header')):
    function beeteam368_pingback_header()
    {
        if (is_singular() && pings_open()) {
            printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
        }
    }
endif;
add_action('wp_head', 'beeteam368_pingback_header');

if (!function_exists('beeteam368_get_nopaging_url')):
	function beeteam368_get_nopaging_url() {
		global $wp;
		$current_url = home_url( $wp->request );
		$position = strpos( $current_url , '/page' );
		$nopaging_url = ( $position ) ? substr( $current_url, 0, $position ) : $current_url;
		return add_query_arg( $wp->query_string, '', trailingslashit( $nopaging_url ));
	}
endif;

if (!function_exists('beeteam368_blog_query_filter')):
	function beeteam368_blog_query_filter($query) {
		
		$archive_order = apply_filters('beeteam368_archive_default_ordering', beeteam368_get_redux_option('_archive_order', 'new'));
		if($archive_order!='new' && !isset($_GET['sort_by'])){
			$_GET['sort_by'] = $archive_order;
		}
		
		if(isset($_GET['sort_by']) && trim($_GET['sort_by'])!='' && $query->is_main_query() && ($query->is_archive() || $query->is_home() || $query->is_search() || $query->is_author())){
			$swi_query = sanitize_text_field(trim($_GET['sort_by']));
			
			switch($swi_query){
				case 'new':
					$query->set('orderby', 'date');
					$query->set('order', 'DESC');
					break;
					
				case 'old':
					$query->set('orderby', 'date');
					$query->set('order', 'ASC');
					break;
					
				case 'title_a_z':
					$query->set('orderby', 'title');
					$query->set('order', 'ASC');
					break;
				
				case 'title_z_a':
					$query->set('orderby', 'title');
					$query->set('order', 'DESC');
					break;	
					
				case 'most_viewed':
					do_action('beeteam368_most_viewed_query_blog', $query);
					break;
					
				case 'highest_rating':
					do_action('beeteam368_highest_rating_query_blog', $query);
					break;
					
				case 'lowest_rating':
					do_action('beeteam368_lowest_rating_query_blog', $query);
					break;
					
				case 'most_liked':
					do_action('beeteam368_most_liked_query_blog', $query);
					break;
				
				case 'most_disliked':
					do_action('beeteam368_most_disliked_query_blog', $query);
					break;
					
				case 'most_laughed':
					do_action('beeteam368_most_laughed_query_blog', $query);
					break;
					
				case 'most_cried':
					do_action('beeteam368_most_cried_query_blog', $query);
					break;									
			}
		}
	}
endif;
if(!is_admin()){
   add_filter('pre_get_posts', 'beeteam368_blog_query_filter');
}

if (!function_exists('beeteam368_get_adjacent_post_by_id')):
	function beeteam368_get_adjacent_post_by_id( $post_id = 0, $type = 'next', $post_type = '', $condition = '' ){
			
		if($post_id == 0){
			$post_id = get_the_ID();
		}
		
		if($post_type == ''){
			$post_type = get_post_type($post_id);
		}
		
		$post_date = get_the_date('Y/m/d H:i:s', $post_id);				
		$args_query = array(
			'post_type'				=> $post_type,
			'posts_per_page' 		=> 1,
			'post_status' 			=> 'publish',
			'ignore_sticky_posts' 	=> 1,
			'post__not_in'			=> array($post_id),
			'orderby'				=> 'date ID',																
		);
		
		if($type === 'next'){
			$args_query['order'] = 'ASC';
			$args_query['date_query'] = array(
				array(
					'after' => $post_date,
				),				
			);
		}
		
		if($type === 'prev'){
			$args_query['order'] = 'DESC';
			$args_query['date_query'] = array(
				array(
					'before' => $post_date,
				),				
			);
		}
				
		$adjacents = get_posts( apply_filters('beeteam368_get_adjacent_post_by_id', $args_query, $post_id, $type, $post_type, $condition) );
		
		if( $adjacents ) {
			foreach ( $adjacents as $adjacent):
				return $adjacent->ID;
				break;
			endforeach;
		}
		
		return 0;
	}
endif;

if(!function_exists('beeteam368_custom_css')){
	function beeteam368_custom_css(){
		
		$css_snippet = '';
		
		$main_color = beeteam368_get_redux_option('_main_color', '');	
		if(isset($main_color) && $main_color!='' && $main_color!='#'){
			$css_snippet.='body, body *{
				--color__channel-tab-active-text:'.esc_attr($main_color).';
				--color__channel-tab-active-icon-background:'.esc_attr($main_color).';
				--color__tab-myCred-background-active:'.esc_attr($main_color).';
				--color__tab-myCred-border-active:'.esc_attr($main_color).';
				--color__video-icon-background:'.esc_attr($main_color).';
				--color__playlist-active-1:'.esc_attr($main_color).';
				--color__review-rated-background:'.esc_attr($main_color).';
				--color__series-active-1:'.esc_attr($main_color).';
				--color__post-meta-hover:'.esc_attr($main_color).';
				--color__post-meta-icon-hover-background:'.esc_attr($main_color).';
				--color__post-category:'.esc_attr($main_color).';
				--color__post-author:'.esc_attr($main_color).';
				--color__block-icon-background:'.esc_attr($main_color).';
				--color__block-line:'.esc_attr($main_color).';
				--color__pagination-background-hover:'.esc_attr($main_color).';
				--color__infinite-button-icon:'.esc_attr($main_color).';
				--color__single-author-avatar-border:'.esc_attr($main_color).';
				--color__sunflower-border-item-1:'.esc_attr($main_color).';
				--color__cyclamen-border-item-1:'.esc_attr($main_color).';
				--color__prev-next-slider-background-hover:'.esc_attr($main_color).';
				--color__prev-next-slider-boder-hover:'.esc_attr($main_color).';
				--color__slider-pagination-active:'.esc_attr($main_color).';
				--color__widget-line:'.esc_attr($main_color).';
				--color__widget-title-icon-background:'.esc_attr($main_color).';
				--color__blockquote-cite:'.esc_attr($main_color).';
				--color__main:'.esc_attr($main_color).';
				--color__site-logo:'.esc_attr($main_color).';
				--color__link:'.esc_attr($main_color).';
				--color__link-visited:'.esc_attr($main_color).';
				--color__link-hover:'.esc_attr($main_color).';
				--color__title-link-hover:'.esc_attr($main_color).';
				--color__button-background:'.esc_attr($main_color).';
				--color__button-border:'.esc_attr($main_color).';
				--color__input-border-focus:'.esc_attr($main_color).';
				--color__searchbox-hover:'.esc_attr($main_color).';
				--color__searchbox-placeholder-hover:'.esc_attr($main_color).';
				--color__searchbox-border-hover:'.esc_attr($main_color).';
				--color__suggestion-item-highlighted:'.esc_attr($main_color).';
				--color__icon-primary-background:'.esc_attr($main_color).';
				--color__nav-level1-text-hover:'.esc_attr($main_color).';
				--color__nav-level1-text-active:'.esc_attr($main_color).';
				--color__nav-level-x-text-hover:'.esc_attr($main_color).';
				--color__nav-level-x-text-active:'.esc_attr($main_color).';
				--color__nav-line-hover:'.esc_attr($main_color).';
				--color__nav-line-active:'.esc_attr($main_color).';
				--color__nav-arrow-hover:'.esc_attr($main_color).';
				--color__nav-arrow-active:'.esc_attr($main_color).';
				--color__megamenu-nav-background-hover:'.esc_attr($main_color).';
				--color__loading-3:'.esc_attr($main_color).';
				--color__prev-next-slider-background-hover:#1A1A1A;
				--color__prev-next-slider-boder-hover:rgba(255,255,255,0.88);
			}';
		}
		
		$sub_color = beeteam368_get_redux_option('_sub_color', '');	
		if(isset($sub_color) && $sub_color!='' && $sub_color!='#'){
			$css_snippet.='body, body *{
				--color__sunflower-border-item-2:'.esc_attr($sub_color).';
				--color__cyclamen-border-item-2:'.esc_attr($sub_color).';
				--color__sub:'.esc_attr($sub_color).';
			}';
		}
		
		$main_color_dark = beeteam368_get_redux_option('_main_color_dark', '');	
		if(isset($main_color_dark) && $main_color_dark!='' && $main_color_dark!='#'){
			$css_snippet.='.dark-mode, .dark-mode *{
				--color__main:'.esc_attr($main_color_dark).';
				--color__link: #FFFFFF;
    			--color__link-visited: #FFFFFF;
				--color__link-hover:'.esc_attr($main_color_dark).';
				--color__title-link: #FFFFFF;
				--color__title-link-hover:'.esc_attr($main_color_dark).';
				--color__button-background:'.esc_attr($main_color_dark).';
				--color__button-border:'.esc_attr($main_color_dark).';
				--color__input-border-focus:'.esc_attr($main_color_dark).';
				--color__ins-background:'.esc_attr($main_color_dark).';
				--color__suggestion-item-highlighted:'.esc_attr($main_color_dark).';
				--color__icon-primary-background:'.esc_attr($main_color_dark).';
				--color__nav-level1-text-hover:'.esc_attr($main_color_dark).';
				--color__nav-level1-text-active:'.esc_attr($main_color_dark).';
				--color__nav-level-x-text-hover:'.esc_attr($main_color_dark).';
				--color__nav-level-x-text-active:'.esc_attr($main_color_dark).';
				--color__nav-line-hover:'.esc_attr($main_color_dark).';
				--color__nav-arrow-hover: #FFFFFF;
				--color__nav-line-active:'.esc_attr($main_color_dark).';
				--color__nav-arrow-active:'.esc_attr($main_color_dark).';
				--color__megamenu-nav-background-hover:'.esc_attr($main_color_dark).';
				--color__loading-3:'.esc_attr($main_color_dark).';
				--color__blockquote-cite:'.esc_attr($main_color_dark).';
				--color__video-icon-background:'.esc_attr($main_color_dark).';
				--color__review-rated-background:'.esc_attr($main_color_dark).';
				--color__channel-tab-active-text:'.esc_attr($main_color_dark).';
				--color__channel-tab-active-icon-background:'.esc_attr($main_color_dark).';
				--color__playlist-active-1:'.esc_attr($main_color_dark).';
				--color__post-meta-hover:'.esc_attr($main_color_dark).';
				--color__post-meta-icon-hover-background:'.esc_attr($main_color_dark).';
				--color__post-category:'.esc_attr($main_color_dark).';
				--color__block-icon-background:'.esc_attr($main_color_dark).';
				--color__block-line:'.esc_attr($main_color_dark).';
				--color__pagination-background-hover:'.esc_attr($main_color_dark).';
				--color__infinite-button-icon:'.esc_attr($main_color_dark).';
				--color__single-author-avatar-border:'.esc_attr($main_color_dark).';
				--color__sunflower-border-item-1:'.esc_attr($main_color_dark).';
				--color__cyclamen-border-item-1:'.esc_attr($main_color_dark).';
				--color__slider-pagination-active:'.esc_attr($main_color_dark).';
				--color__widget-line:'.esc_attr($main_color_dark).';
				--color__widget-title-icon-background:'.esc_attr($main_color_dark).';
				--color__site-logo: #FFFFFF;
				--color__searchbox-hover: #FFFFFF;
				--color__searchbox-placeholder-hover: #DDDDDD;
				--color__searchbox-border-hover:#3C3F46;
				--color__series-active-1:'.esc_attr($main_color_dark).'; 
				--color__post-author: #DDDDDD;
			}';
		}
		
		$sub_color_dark = beeteam368_get_redux_option('_sub_color_dark', '');	
		if(isset($sub_color_dark) && $sub_color_dark!='' && $sub_color_dark!='#'){
			$css_snippet.='.dark-mode, .dark-mode *{
				--color__sunflower-border-item-2:'.esc_attr($sub_color_dark).';
				--color__cyclamen-border-item-2:'.esc_attr($sub_color_dark).';
				--color__sub:'.esc_attr($sub_color_dark).';
			}';
		}
		
		$_main_font_properties = beeteam368_get_redux_option('_main_font_properties', array());
		$_main_font_scale = beeteam368_get_redux_option('_main_font_scale', 1);
		
		$_heading_font_properties = beeteam368_get_redux_option('_heading_font_properties', array());
		$_heading_font_scale = beeteam368_get_redux_option('_heading_font_scale', 1);
		
		$_navigation_font_properties = beeteam368_get_redux_option('_navigation_font_properties', array());
		$_navigation_font_scale = beeteam368_get_redux_option('_navigation_font_scale', 1);
		
		$_meta_font_properties = beeteam368_get_redux_option('_meta_font_properties', array());
		$_meta_font_scale = beeteam368_get_redux_option('_meta_font_scale', 1);
		
		$_button_font_properties = beeteam368_get_redux_option('_button_font_properties', array());
		$_button_font_scale = beeteam368_get_redux_option('_button_font_scale', 1);
		
		$_input_field_font_properties = beeteam368_get_redux_option('_input_field_font_properties', array());
		$_input_field_font_scale = beeteam368_get_redux_option('_input_field_font_scale', 1);
		
		$_main_font_self_hosted = trim(beeteam368_get_redux_option('_main_font_self_hosted', ''));
		$_heading_font_self_hosted = trim(beeteam368_get_redux_option('_heading_font_self_hosted', ''));
		$_navigation_font_self_hosted = trim(beeteam368_get_redux_option('_navigation_font_self_hosted', ''));
		$_meta_font_self_hosted = trim(beeteam368_get_redux_option('_meta_font_self_hosted', ''));
		$_button_font_self_hosted = trim(beeteam368_get_redux_option('_button_font_self_hosted', ''));
		$_input_field_font_self_hosted = trim(beeteam368_get_redux_option('_input_field_font_self_hosted', ''));
		
		$main_font_css = '';
		$main_font_size_css = '';
		if(isset($_main_font_properties['font-family']) && $_main_font_properties['font-family']!='' && $_main_font_self_hosted == ''){
			$main_font_css.='--font__main:'.esc_attr($_main_font_properties['font-family']).';';
		}
		if($_main_font_self_hosted!=''){
			$main_font_css.='--font__main:'.esc_attr($_main_font_self_hosted).';';
		}
		if(isset($_main_font_properties['font-weight']) && $_main_font_properties['font-weight']!=''){
			$main_font_css.='--font__main-weight:'.esc_attr($_main_font_properties['font-weight']).';';
		}
		if(isset($_main_font_properties['letter-spacing']) && $_main_font_properties['letter-spacing']!=''){
			$main_font_css.='--font__main-letter-spacing:'.esc_attr($_main_font_properties['letter-spacing']).';';
		}
		if(isset($_main_font_properties['text-transform']) && $_main_font_properties['text-transform']!=''){
			$main_font_css.='--font__main-text-transform:'.esc_attr($_main_font_properties['text-transform']).';';
		}
		if(isset($_main_font_properties['font-style']) && $_main_font_properties['font-style']!=''){
			$main_font_css.='--font__main-style:'.esc_attr($_main_font_properties['font-style']).';';
		}
		if(isset($_main_font_properties['line-height']) && $_main_font_properties['line-height']!=''){
			$main_font_css.='--font__main-line-height:'.esc_attr($_main_font_properties['line-height']).';';
		}
		
		if($main_font_css!=''){
			$css_snippet.='body, body *{
				'.$main_font_css.'
			}';
		}
		
		if($_main_font_scale!=1){
			$css_snippet.='body, body *{
				--font__main-size-px:'.round(16 * 0.875 * $_main_font_scale).'px;
				--font__main-size-rem:'.round(1 * 0.875 * $_main_font_scale, 2).'rem;
				
				--font__main-size-8-px:'.round(16 * 0.5 * $_main_font_scale).'px;
				--font__main-size-8-rem:'.round(1 * 0.5 * $_main_font_scale, 2).'rem;
				
				--font__main-size-10-px:'.round(16 * 0.625 * $_main_font_scale).'px;
				--font__main-size-10-rem:'.round(1 * 0.625 * $_main_font_scale, 2).'rem;
				
				--font__main-size-12-px:'.round(16 * 0.75 * $_main_font_scale).'px;
				--font__main-size-12-rem:'.round(1 * 0.75 * $_main_font_scale, 2).'rem;
				
				--font__main-size-16-px:'.round(16 * 1 * $_main_font_scale).'px;
				--font__main-size-16-rem:'.round(1 * 1 * $_main_font_scale, 2).'rem;
				
				--font__main-size-20-px:'.round(16 * 1.25 * $_main_font_scale).'px;
				--font__main-size-20-rem:'.round(1 * 1.25 * $_main_font_scale, 2).'rem;
			}';
		}
		
		$heading_font_css = '';
		$heading_font_size_css = '';
		if(isset($_heading_font_properties['font-family']) && $_heading_font_properties['font-family']!='' && $_heading_font_self_hosted == ''){
			$heading_font_css.='--font__heading:'.esc_attr($_heading_font_properties['font-family']).';';
		}
		if($_heading_font_self_hosted!=''){
			$heading_font_css.='--font__heading:'.esc_attr($_heading_font_self_hosted).';';
		}	
		if(isset($_heading_font_properties['font-weight']) && $_heading_font_properties['font-weight']!=''){
			$heading_font_css.='--font__heading-weight:'.esc_attr($_heading_font_properties['font-weight']).';';
		}
		if(isset($_heading_font_properties['letter-spacing']) && $_heading_font_properties['letter-spacing']!=''){
			$heading_font_css.='--font__heading-letter-spacing:'.esc_attr($_heading_font_properties['letter-spacing']).';';
		}
		if(isset($_heading_font_properties['text-transform']) && $_heading_font_properties['text-transform']!=''){
			$heading_font_css.='--font__heading-text-transform:'.esc_attr($_heading_font_properties['text-transform']).';';
		}
		if(isset($_heading_font_properties['font-style']) && $_heading_font_properties['font-style']!=''){
			$heading_font_css.='--font__heading-style:'.esc_attr($_heading_font_properties['font-style']).';';
		}
		if(isset($_heading_font_properties['line-height']) && $_heading_font_properties['line-height']!=''){
			$heading_font_css.='--font__heading-line-height:'.esc_attr($_heading_font_properties['line-height']).';';
		}
		
		if($heading_font_css!=''){
			$css_snippet.='body, body *{
				'.$heading_font_css.'
			}';
		}
		
		if($_heading_font_scale!=1){
			$css_snippet.='body, body *{
				--font__heading-size-px:'.round(16 * 1 * $_heading_font_scale).'px;
				--font__heading-size-rem:'.round(1 * 1 * $_heading_font_scale, 2).'rem;
				
				--font__h1-font-size-px:'.round(16 * 1.602 * $_heading_font_scale).'px;
				--font__h2-font-size-px:'.round(16 * 1.424 * $_heading_font_scale).'px;
				--font__h3-font-size-px:'.round(16 * 1.266 * $_heading_font_scale).'px;
				--font__h4-font-size-px:'.round(16 * 1.125 * $_heading_font_scale).'px;
				--font__h5-font-size-px:'.round(16 * 1 * $_heading_font_scale).'px;
				--font__h6-font-size-px:'.round(16 * 0.889 * $_heading_font_scale).'px;
				
				--font__h1-font-size-rem:'.round(1 * 1.602 * $_heading_font_scale, 2).'rem;
				--font__h2-font-size-rem:'.round(1 * 1.424 * $_heading_font_scale, 2).'rem;
				--font__h3-font-size-rem:'.round(1 * 1.266 * $_heading_font_scale, 2).'rem;
				--font__h4-font-size-rem:'.round(1 * 1.125 * $_heading_font_scale, 2).'rem;
				--font__h5-font-size-rem:'.round(1 * 1 * $_heading_font_scale, 2).'rem;
				--font__h6-font-size-rem:'.round(1 * 0.889 * $_heading_font_scale, 2).'rem;
				
				--font__h7-font-size-px:'.round(16 * 0.75 * $_heading_font_scale).'px;
				--font__h7-font-size-rem:'.round(1 * 0.75 * $_heading_font_scale, 2).'rem;
				
				--font__h1-single-size-px:'.round(16 * 2.375 * $_heading_font_scale).'px;
				--font__h1-single-size-rem:'.round(1 * 2.375 * $_heading_font_scale, 2).'rem;
			}';
		}
		
		$navigation_font_css = '';
		$navigation_font_size_css = '';
		if(isset($_navigation_font_properties['font-family']) && $_navigation_font_properties['font-family']!='' && $_navigation_font_self_hosted == ''){
			$navigation_font_css.='--font__nav:'.esc_attr($_navigation_font_properties['font-family']).';';
		}	
		if($_navigation_font_self_hosted!=''){
			$navigation_font_css.='--font__nav:'.esc_attr($_navigation_font_self_hosted).';';
		}
		if(isset($_navigation_font_properties['font-weight']) && $_navigation_font_properties['font-weight']!=''){
			$navigation_font_css.='--font__nav-weight:'.esc_attr($_navigation_font_properties['font-weight']).';';
		}
		if(isset($_navigation_font_properties['letter-spacing']) && $_navigation_font_properties['letter-spacing']!=''){
			$navigation_font_css.='--font__nav-letter-spacing:'.esc_attr($_navigation_font_properties['letter-spacing']).';';
		}
		if(isset($_navigation_font_properties['text-transform']) && $_navigation_font_properties['text-transform']!=''){
			$navigation_font_css.='--font__nav-text-transform:'.esc_attr($_navigation_font_properties['text-transform']).';';
		}
		if(isset($_navigation_font_properties['font-style']) && $_navigation_font_properties['font-style']!=''){
			$navigation_font_css.='--font__nav-style:'.esc_attr($_navigation_font_properties['font-style']).';';
		}
		if(isset($_navigation_font_properties['line-height']) && $_navigation_font_properties['line-height']!=''){
			$navigation_font_css.='--font__nav-line-height:'.esc_attr($_navigation_font_properties['line-height']).';';
		}
		
		if($navigation_font_css!=''){
			$css_snippet.='body, body *{
				'.$navigation_font_css.'
			}';
		}
		
		if($_navigation_font_scale!=1){
			$css_snippet.='body, body *{
				--font__nav-size-px:'.round(16 * 0.9375 * $_navigation_font_scale).'px;
				--font__nav-size-rem:'.round(1 * 0.9375 * $_navigation_font_scale, 2).'rem;
				
				--font__nav-size-18-px:'.round(16 * 1.125 * $_navigation_font_scale).'px;
				--font__nav-size-18-rem:'.round(1 * 1.125 * $_navigation_font_scale, 2).'rem;
				
				--font__nav-size-14-px:'.round(16 * 0.875 * $_navigation_font_scale).'px;
				--font__nav-size-14-rem:'.round(1 * 0.875 * $_navigation_font_scale, 2).'rem;
				
				--font__nav-size-13-px:'.round(16 * 0.8125 * $_navigation_font_scale).'px;
				--font__nav-size-13-rem:'.round(1 * 0.8125 * $_navigation_font_scale, 2).'rem;
				
				--font__nav-size-12-px:'.round(16 * 0.75 * $_navigation_font_scale).'px;
				--font__nav-size-12-rem:'.round(1 * 0.75 * $_navigation_font_scale, 2).'rem;
			}';
		}
		
		$meta_font_css = '';
		$meta_font_size_css = '';
		if(isset($_meta_font_properties['font-family']) && $_meta_font_properties['font-family']!='' && $_meta_font_self_hosted == ''){
			$meta_font_css.='--font__meta:'.esc_attr($_meta_font_properties['font-family']).';';
		}
		if($_meta_font_self_hosted!=''){
			$meta_font_css.='--font__meta:'.esc_attr($_meta_font_self_hosted).';';
		}	
		if(isset($_meta_font_properties['font-weight']) && $_meta_font_properties['font-weight']!=''){
			$meta_font_css.='--font__meta-weight:'.esc_attr($_meta_font_properties['font-weight']).';';
		}
		if(isset($_meta_font_properties['letter-spacing']) && $_meta_font_properties['letter-spacing']!=''){
			$meta_font_css.='--font__meta-letter-spacing:'.esc_attr($_meta_font_properties['letter-spacing']).';';
		}
		if(isset($_meta_font_properties['text-transform']) && $_meta_font_properties['text-transform']!=''){
			$meta_font_css.='--font__meta-text-transform:'.esc_attr($_meta_font_properties['text-transform']).';';
		}
		if(isset($_meta_font_properties['font-style']) && $_meta_font_properties['font-style']!=''){
			$meta_font_css.='--font__meta-style:'.esc_attr($_meta_font_properties['font-style']).';';
		}
		if(isset($_meta_font_properties['line-height']) && $_meta_font_properties['line-height']!=''){
			$meta_font_css.='--font__meta-line-height:'.esc_attr($_meta_font_properties['line-height']).';';
		}
		
		if($meta_font_css!=''){
			$css_snippet.='body, body *{
				'.$meta_font_css.'
			}';
		}
		
		if($_meta_font_scale!=1){
			$css_snippet.='body, body *{
				--font__meta-size-px:'.round(16 * 0.875 * $_meta_font_scale).'px;
				--font__meta-size-rem:'.round(1 * 0.875 * $_meta_font_scale, 2).'rem;
				
				--font__meta-size-12-px:'.round(16 * 0.75 * $_meta_font_scale).'px;
				--font__meta-size-12-rem:'.round(1 * 0.75 * $_meta_font_scale, 2).'rem;
				
				--font__meta-size-10-px:'.round(16 * 0.625 * $_meta_font_scale).'px;
				--font__meta-size-10-rem:'.round(1 * 0.625 * $_meta_font_scale, 2).'rem;
			}';
		}
		
		$button_font_css = '';
		$button_font_size_css = '';
		if(isset($_button_font_properties['font-family']) && $_button_font_properties['font-family']!='' && $_button_font_self_hosted == ''){
			$button_font_css.='--font__button:'.esc_attr($_button_font_properties['font-family']).';';
		}
		if($_button_font_self_hosted!=''){
			$button_font_css.='--font__button:'.esc_attr($_button_font_self_hosted).';';
		}
		if(isset($_button_font_properties['font-weight']) && $_button_font_properties['font-weight']!=''){
			$button_font_css.='--font__button-weight:'.esc_attr($_button_font_properties['font-weight']).';';
		}
		if(isset($_button_font_properties['letter-spacing']) && $_button_font_properties['letter-spacing']!=''){
			$button_font_css.='--font__button-letter-spacing:'.esc_attr($_button_font_properties['letter-spacing']).';';
		}
		if(isset($_button_font_properties['text-transform']) && $_button_font_properties['text-transform']!=''){
			$button_font_css.='--font__button-text-transform:'.esc_attr($_button_font_properties['text-transform']).';';
		}
		if(isset($_button_font_properties['font-style']) && $_button_font_properties['font-style']!=''){
			$button_font_css.='--font__button-style:'.esc_attr($_button_font_properties['font-style']).';';
		}
		if(isset($_button_font_properties['line-height']) && $_button_font_properties['line-height']!=''){
			$button_font_css.='--font__button-line-height:'.esc_attr($_button_font_properties['line-height']).';';
		}
		
		if($button_font_css!=''){
			$css_snippet.='body, body *{
				'.$button_font_css.'
			}';
		}
		
		if($_button_font_scale!=1){
			$css_snippet.='body, body *{
				--font__button-size-px:'.round(16 * 0.875 * $_button_font_scale).'px;
				--font__button-size-rem:'.round(1 * 0.875 * $_button_font_scale, 2).'rem;
				
				--font__button-size-12-px:'.round(16 * 0.75 * $_button_font_scale).'px;
				--font__button-size-12-rem:'.round(1 * 0.75 * $_button_font_scale, 2).'rem;
			}';
		}
		
		$input_field_css = '';
		$input_field_size_css = '';
		if(isset($_input_field_font_properties['font-family']) && $_input_field_font_properties['font-family']!='' && $_input_field_font_self_hosted == ''){
			$input_field_css.='--font__field:'.esc_attr($_input_field_font_properties['font-family']).';';
		}
		if($_input_field_font_self_hosted!=''){
			$input_field_css.='--font__field:'.esc_attr($_input_field_font_self_hosted).';';
		}	
		if(isset($_input_field_font_properties['font-weight']) && $_input_field_font_properties['font-weight']!=''){
			$input_field_css.='--font__field-weight:'.esc_attr($_input_field_font_properties['font-weight']).';';
		}
		if(isset($_input_field_font_properties['letter-spacing']) && $_input_field_font_properties['letter-spacing']!=''){
			$input_field_css.='--font__field-letter-spacing:'.esc_attr($_input_field_font_properties['letter-spacing']).';';
		}
		if(isset($_input_field_font_properties['text-transform']) && $_input_field_font_properties['text-transform']!=''){
			$input_field_css.='--font__field-text-transform:'.esc_attr($_input_field_font_properties['text-transform']).';';
		}
		if(isset($_input_field_font_properties['font-style']) && $_input_field_font_properties['font-style']!=''){
			$input_field_css.='--font__field-style:'.esc_attr($_input_field_font_properties['font-style']).';';
		}
		if(isset($_input_field_font_properties['line-height']) && $_input_field_font_properties['line-height']!=''){
			$input_field_css.='--font__field-line-height:'.esc_attr($_input_field_font_properties['line-height']).';';
		}
		
		if($input_field_css!=''){
			$css_snippet.='body, body *{
				'.$input_field_css.'
			}';
		}
		
		if($_input_field_font_scale!=1){
			$css_snippet.='body, body *{
				--font__field-size-px:'.round(16 * 0.875 * $_button_font_scale).'px;
				--font__field-size-rem:'.round(1 * 0.875 * $_button_font_scale, 2).'rem;
			}';
		}
		
		$header_bg = beeteam368_get_redux_option('_header_background', array());
		$header_bg_css = '';		
		if(is_array($header_bg)){
			
			if(isset($header_bg['background-color']) && $header_bg['background-color']!=''){
				$header_bg_css.='background-color:'.esc_attr($header_bg['background-color']).';';
			}
			
			if(isset($header_bg['background-repeat']) && $header_bg['background-repeat']!=''){
				$header_bg_css.='background-repeat:'.esc_attr($header_bg['background-repeat']).';';
			}
			
			if(isset($header_bg['background-attachment']) && $header_bg['background-attachment']!=''){
				$header_bg_css.='background-attachment:'.esc_attr($header_bg['background-attachment']).';';
			}
			
			if(isset($header_bg['background-position']) && $header_bg['background-position']!=''){
				$header_bg_css.='background-position:'.esc_attr($header_bg['background-position']).';';
			}
			
			if(isset($header_bg['background-size']) && $header_bg['background-size']!=''){
				$header_bg_css.='background-size:'.esc_attr($header_bg['background-size']).';';
			}
			
			if(isset($header_bg['background-image']) && $header_bg['background-image']!=''){
				$header_bg_css.='background-image:url("'.esc_url($header_bg['background-image']).'");';
			}
		}
		
		if($header_bg_css!=''){
			$css_snippet.='@media(min-width:992px){.beeteam368-h-leilani .beeteam368-top-menu:before{'.$header_bg_css.'}}';
		}
		
		return $css_snippet;
	}
}	