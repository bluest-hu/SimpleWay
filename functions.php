<?php 

// require_once(TEMPLATEPATH . '/control.php');
// remove_action('init', 'kses_init');   
// remove_action('set_current_user', 'kses_init');
/**
 * 注册顶部菜单
 */
register_nav_menus( array(
	'header_menu' => '顶部菜单',
) );

if (function_exists('register_sidebar')) { 
	register_sidebar(array( 
		'name' => 'right sidebar', // 侧边栏 1 的名称 
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签 
		'after_widget' => '</li>', // widget 的结束标签 
		'before_title' => '<h3 class="widget-title">', // 标题的开始标签 
		'after_title' => '</h3>'// 标题的结束标签
	));
} 


// class index_right_column_siderbar extends WP_Widget {
// 	public function _construct() {

// 	}
// }

function par_pagenavi($range = 9) {
	global	$paged, 
			$wp_query;
			
	if ( !$max_page ) {
		$max_page = $wp_query->max_num_pages;
	}

	if ($max_page > 1) {
		if (!$paged) {
			$paged = 1;
		}

		if ($paged != 1) {
			echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'>首页</a>";
		}

		echo "<span class='page-next'>";
		previous_posts_link('<<');
		echo "</span>";

    	if ($max_page > $range) {
			if ($paged < $range) {
				for ($i = 1; $i <= ($range + 1); $i++) {
					echo "<a href='" . get_pagenum_link($i) ."'";
					if ( $i==$paged ) {
						echo " class='current'";
					}
					echo ">$i</a>";
				}
			} elseif ($paged >= ($max_page - ceil(($range/2)))) {
				for ($i = $max_page - $range; $i <= $max_page; $i++) {
					echo "<a href='" . get_pagenum_link($i) ."'";
					if ($i==$paged) {
						echo " class='current'";
					}
					echo ">$i</a>";
				}
			} elseif ($paged >= $range && $paged < ($max_page - ceil(($range/2)))) {
				for ($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++) {
					echo "<a href='" . get_pagenum_link($i) ."'";
					if ($i==$paged) {
						echo " class='current'";
					}
					echo ">$i</a>";
				}
			}
		} else {
			for ($i = 1; $i <= $max_page; $i++) {
				echo "<a href='" . get_pagenum_link($i) ."'";
			    if ($i==$paged) {
			    	echo " class='current'";
			    }
			    echo ">$i</a>";
			}
		}

		echo "<span class='page-next'>";
			next_posts_link('>>');
		echo "</span>";

    	if ($paged != $max_page) {
    		echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'>最后</a>";
    	}
    }
}


// 增加后台作者资料
add_filter( 'user_contactmethods', 'add_author_contact_fields' );

function add_author_contact_fields( $contactmethods ) {

	$contactmethods['twitter'] 		= 'Twitter';
	$contactmethods['google_plus'] 	= 'Google+';
	$contactmethods['faceboook'] 	= 'Faceboook';
	$contactmethods['github'] 		= 'GitHub';
	
	// unset( $contactmethods['yim'] );
	// unset( $contactmethods['aim'] );
	// unset( $contactmethods['jabber'] );

	return $contactmethods;
}


// 增加主页关键字以及描述

$new_general_setting = new new_general_setting();

class new_general_setting {
	function new_general_setting( ) {
		add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
	}

	function register_fields() {
		register_setting( 'general', 'favorite_color', 'esc_attr' );
		add_settings_field('fav_color', 
			'<label for="favorite_color">'.__('最喜欢的颜色' ).'</label>',
			array(&$this, 'fields_html') ,
			'general' 
			);
	}

	function fields_html() {
		$value = get_option( 'favorite_color', '' );
		echo '<input type="text" id="favorite_color" name="favorite_color" value="' . $value . '" />';
	}
}


?> 

