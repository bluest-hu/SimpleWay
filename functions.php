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

/**
 * 注册侧边栏
 */ 
if ( function_exists('register_sidebar')) { 
	register_sidebar(array( 
		'name' 			=> __( 'Index Right Sidebar', '首页的右边栏，如果其他页面未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称 
		'class'			=> 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签 
		'after_widget' 	=> '</li>', // widget 的结束标签 
		'before_title' 	=> '<h3 class="widget-title">', // 标题的开始标签 
		'after_title' 	=> '</h3>'// 标题的结束标签
	));
	
	register_sidebar(array( 
		'name' 			=> __( 'Post Right Sidebar', '文章页面的右边栏，如果未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称 
		'class'			=> 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签 
		'after_widget' 	=> '</li>', // widget 的结束标签 
		'before_title' 	=> '<h3 class="widget-title">', // 标题的开始标签 
		'after_title' 	=> '</h3>'// 标题的结束标签
	));

	register_sidebar(array( 
		'name' 			=> __( 'Achieve Right Sidebar', '存档页页面的右边栏，如果未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称 
		'class'			=> 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签 
		'after_widget' 	=> '</li>', // widget 的结束标签 
		'before_title' 	=> '<h3 class="widget-title">', // 标题的开始标签 
		'after_title' 	=> '</h3>'// 标题的结束标签
	));

	register_sidebar(array( 
		'name' 			=> __( 'Author Right Sidebar', '存档页页面的右边栏，如果未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称 
		'class'			=> 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签 
		'after_widget' 	=> '</li>', // widget 的结束标签 
		'before_title' 	=> '<h3 class="widget-title">', // 标题的开始标签 
		'after_title' 	=> '</h3>'// 标题的结束标签
	));


	register_sidebar(array( 
		'name' 			=> __( 'Page Right Sidebar', '存档页页面的右边栏，如果未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称 
		'class'			=> 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签 
		'after_widget' 	=> '</li>', // widget 的结束标签 
		'before_title' 	=> '<h3 class="widget-title">', // 标题的开始标签 
		'after_title' 	=> '</h3>'// 标题的结束标签
	));

	register_sidebar(array( 
		'name' 			=> __( 'Category Right Sidebar', '存档页页面的右边栏，如果未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称 
		'class'			=> 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签 
		'after_widget' 	=> '</li>', // widget 的结束标签 
		'before_title' 	=> '<h3 class="widget-title">', // 标题的开始标签 
		'after_title' 	=> '</h3>'// 标题的结束标签
	));

	register_sidebar(array( 
		'name' 			=> __( 'Tag Right Sidebar', '存档页页面的右边栏，如果未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称 
		'class'			=> 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签 
		'after_widget' 	=> '</li>', // widget 的结束标签 
		'before_title' 	=> '<h3 class="widget-title">', // 标题的开始标签 
		'after_title' 	=> '</h3>'// 标题的结束标签
	));
} 

//注册侧边栏小工具
if ( function_exists('wp_register_sidebar_widget' ) ) {   
    wp_register_sidebar_widget(1, '四合一小工具：日历最近文章、标签云、分类目录', 'tab_switcher_one');
}  


function tab_switcher_one () {
    include(TEMPLATEPATH . '/wedgit/tab_switcher_1.php');
}

// 注册侧边栏小工具2
if ( function_exists('wp_register_sidebar_widget' ) ) {   
    wp_register_sidebar_widget(2, '三合一小工具：最近评论、友情链接、评论墙。', 'tab_switcher_two');
}

function tab_switcher_two () {
    include(TEMPLATEPATH . '/wedgit/tab_switcher_2.php');
}

//URL:http://www.daqianduan.com/wordpress-tools-newcomments/
register_widget('widget_newcomments');

class widget_newcomments extends WP_Widget {

	function widget_newcomments() {
		$option = array(
			'classname' => 'widget_newcomments', 
			'description' => '显示网友最新评论（头像+名称+评论）' 
		);
		$this->WP_Widget(false, '最新评论', $option);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '最新评论' : apply_filters('widget_title', $instance['title']);
		$count = empty($instance['count']) ? '5' : apply_filters('widget_count', $instance['count']);

		echo $before_title . $title . $after_title;
		echo '<ul class="new-comments">';
		echo simpleway_newcomments( $count );
		echo '</ul>';
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '' ) );
		$title = strip_tags($instance['title']);
		$count = strip_tags($instance['count']);

		echo '<p><label>标题：<input id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.attribute_escape($title).'" size="24" /></label></p>';
		echo '<p><label>数目：<input id="'.$this->get_field_id('count').'" name="'.$this->get_field_name('count').'" type="text" value="'.attribute_escape($count).'" size="3" /></label></p>';
	}
}

function simpleway_newcomments( $limit ){
	global $wpdb;

	$comments = wp_cache_get( 'simpleway_newcomments' );

	$sql = "SELECT DISTINCT 
		ID,
		post_title,
		post_password,
		comment_ID, 
		comment_post_ID,
		comment_author,
		comment_date_gmt,
		comment_approved, 
		comment_author_email,
		comment_type,
		comment_author_url,
		comment_content
	FROM $wpdb->comments 
		LEFT OUTER JOIN $wpdb->posts 
		ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) 
		WHERE comment_approved = '1'
	AND comment_type = ''
	AND post_password = ''
	AND user_id  = '0'
	ORDER BY comment_date_gmt DESC LIMIT $limit ";
	
	if ($comments === false) {
		$comments = $wpdb->get_results($sql);
		wp_cache_set( 'simpleway_mostactive', $comments );
	}

	foreach ( $comments as $comment ) {
		if ( mb_strlen($comment->comment_content, 'utf-8') > 35 ) {
			$comment->comment_content = mb_substr($comment->comment_content, 0, 35, 'utf-8') . "......";
		}

		$output .= "<li class=\"new-comment-lists\" ><a href=\"" . 
						get_permalink($comment->ID) . 
						"#comment-" . $comment->comment_ID . 
						"\" title=\"" . 
						$comment->post_title .
						"上的评论\">" .
						get_avatar( $comment->comment_author_email, 40) . 
						"<strong class=\"comment-author\">". strip_tags($comment->comment_author) . 
						"：</strong>" .
						strip_tags($comment->comment_content) 
						."</a></li>";
	}
	echo $output;
};


//时间可读
add_filter( 'the_date', 'human_readable_date');
add_filter( 'get_the_date', 'human_readable_date');
add_filter( 'the_modified_date', 'human_readable_date' );
add_filter( 'get_the_modified_date', 'human_readable_date' );

function human_readable_date( $the_date ){
    return human_time_diff( strtotime($the_date) ) .  __(' ago');
}

/**
 * 页面分页
 * @param  integer $range 分页计数
 * @return string         html字符串
 */
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
	$contactmethods['facebook'] 	= 'Faceboook';
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


register_widget('widget_most_comments_wall');

class widget_most_comments_wall extends WP_Widget {

	function widget_most_comments_wall() {
		$option = array(
			'classname' => 'widget_most_comments_wall',
			'description' => '最多评论的N个读者头像'
		);

		$this->WP_Widget(false, '读者评论墙', $option);
	}

	function widget($args, $instance) {

		extract($args, EXTR_SKIP);
		
		echo $before_widget;
		
		$title = empty($instance['title']) ? '读者评论墙' : apply_filters('widget_title', $instance['title']);
		$count = empty($instance['count']) ? '5' : apply_filters('widget_count', $instance['count']);
		$size = empty($instance['width']) ? '40' : apply_filters('widget_count', $instance['size']);

		echo $before_title . $title . $after_title;

		echo '<ul class="new-comments">';
		
		echo get_most_comments_friends( array(
			'number' => $count,
			'size' => $size
			) );
		echo '</ul>';

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['size'] = strip_tags($new_instance['size']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '','size' => '' ) );

		$title = strip_tags($instance['title']);
		$count = strip_tags($instance['count']);
		$size = strip_tags($instance['size']);

		echo '<p><label>标题：<input id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.attribute_escape($title).'" size="24" /></label></p>';
		echo '<p><label>数目：<input id="'.$this->get_field_id('count').'" name="'.$this->get_field_name('count').'" type="number" value="'.attribute_escape($count).'" size="3" /></label></p>';
		echo '<p><label>大小：<input id="'.$this->get_field_id('size').'" name="'.$this->get_field_name('size').'" type="number" value="'.attribute_escape($size).'" size="3" /></label></p>';
	}
}

/**
 * 获取评论
 */
function get_most_comments_friends($config) {

	$config['container'] 		= !empty($config['container']) ? $config['container'] : "";
	$config['container_class'] 	= !empty($config['container_class']) ? $config['container_class'] : "most-comments-friend-wall";
	$config['container_id']		= !empty($config['container_id']) ? $config['container_id'] : "MostCommentsFirendsWall";
	$config['echo']				= !empty($config['echo']) ? !!$config['echo'] : false;
	$config['before']			= !empty($config['before']) ? $config['before'] : "li";
	$config['number'] 			= !empty($config['number']) ? $config['number'] : 15;
	$config['size'] 			= !empty($config['size']) ? $config['size'] : 45;
	$config['time']				= !empty($config['time']) ? $config['time'] : 1;

	global $wpdb;
  	
  	$counts = wp_cache_get( 'simpleway_mostactive' );

  	$query = "SELECT COUNT(comment_author) AS cnt, comment_author, comment_author_url, comment_author_email
	  	FROM {$wpdb->prefix}comments
	  	WHERE comment_date > date_sub( NOW(), INTERVAL {$config['time']} MONTH )
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
  		$mostactive .= "<ul class=\"{$config['container_class']}\" id=\"{$config['container_id']}\">";

  		wp_cache_set( 'simpleway_mostactive', $counts );
  		
  		$_index = 1;
  		
    	foreach ($counts as $count) {
      		$c_url 		= $count->comment_author_url;
      		$c_count	= $count->cnt;
      		$c_author 	= $count->comment_author;
      		$c_email 	= $count->comment_author_email;

     		$mostactive .= "<li id=\"mostActivePeople-{$_index}\" class=\"most-active-people\"><a href=\"{$c_url}\" title=\"{$c_author} 发表 {$c_count} 条评论\" rel=\"nofollow\" target=\"_blank\">" . 
	     		get_avatar($c_email, $config['size']) . 
	     		"</a></li>";
   			$_index++;
   		}
 	}

	$mostactive .= " </ul>";

	if ( $config['echo'] ) {
		echo $mostactive;
	} else {
		return $mostactive;
	}
}

// 给评论链接添加No-follw
add_filter('comment_reply_link', 'add_nofollow', 420, 4);

function add_nofollow($link, $args, $comment, $post){
  return str_replace("href=", "rel='nofollow' href=", $link);
}


// 恢复友情链接
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

?> 

