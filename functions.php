<?php 

// require_once(TEMPLATEPATH . '/control.php');
// remove_action('init', 'kses_init');   
// remove_action('set_current_user', 'kses_init');


/**
 * 注册顶部菜单
 */

if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus( array(
		'header_menu' => '顶部菜单',
	) );
}

// 注册侧边栏
if ( function_exists('register_sidebar')) { 
	register_sidebar(array( 
		'name' 			=> __( 'Right Sidebar', '首页的右边栏，如果其他页面未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称 
		'class'			=> 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签 
		'after_widget' 	=> '</li>', // widget 的结束标签 
		'before_title' 	=> '<h3 class="widget-title">', // 标题的开始标签 
		'after_title' 	=> '</h3>'// 标题的结束标签
	));
} 

//注册侧边栏小工具
if ( function_exists('wp_register_sidebar_widget' ) ) {   
    wp_register_sidebar_widget(1, '四合一小工具', 'tab_switcher_one');
}  


function tab_switcher_one () {
    include(TEMPLATEPATH . '/wedgit/tab_switcher_1.php');
}


// 时间可读
// add_filter( 'the_date', 'human_readable_date');
// add_filter( 'get_the_date', 'human_readable_date');
// add_filter( 'the_modified_date', 'human_readable_date' );
// add_filter( 'get_the_modified_date', 'human_readable_date' );

// function human_readable_date( $the_date ){
//     return human_time_diff( strtotime($the_date) ) .  __(' ago');
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

/**
 * 
 */
function get_most_comments_friends($config) {
	$config['container'] 		= array_key_exists('container', $config) ? $config['container'] : "";
	$config['container_class'] 	= array_key_exists('container_class', $config) ? $config['container_class'] : "most-comments-friend-wall";
	$config['container_id']		= array_key_exists('container_id', $config) ? $config['container_id'] : "MostCommentsFirendsWall";
	$config['echo']				= array_key_exists('echo', $config) ? ($config['echo']) : false;
	// $config['before']
	$config['number'] 			= array_key_exists('number', $config) ? $config['number'] : 15;

	global $wpdb;
  	
  	$counts = wp_cache_get( 'simpleway_mostactive' );

  	$query = "SELECT COUNT(comment_author) AS cnt, comment_author, comment_author_url, comment_author_email
	  	FROM {$wpdb->prefix}comments
	  	WHERE comment_date > date_sub( NOW(), INTERVAL 1 MONTH )
	        AND comment_approved = '1'
	        AND comment_author_email != 'example@example.com'
	        AND comment_author_url != ''
	        AND comment_type = ''
	        AND user_id = '0'
	    GROUP BY comment_author_email
	    ORDER BY cnt DESC
	    LIMIT {$config['number']}";


  if ( false === $counts ) {
    $counts = $wpdb->get_results($query);
  }

  $mostactive = '';

  if ( $counts ) {
  	$mostactive .= '<ul class="' . $config['container_class'] . '"' . ' id="' . $config['container_id'].'">';
    wp_cache_set( 'simpleway_mostactive', $counts );

    foreach ($counts as $count) {
      $c_url = $count->comment_author_url;
      $mostactive .= '<li>' . '<a href="'. $c_url . '" title="' . $count->comment_author .' 发表 '. $count->cnt . ' 条评论" target="_blank">' . get_avatar($count->comment_author_email, 55, '', $count->comment_author . ' 发表 ' . $count->cnt . ' 条评论') . '</a></li>';
    }

  	return $mostactive .= " </ul>";
  }
}
  
?> 

