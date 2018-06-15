<?php


if ( ! function_exists( 'utf8Substr' ) ) {
	function utf8Substr( $str, $from, $len ) {
		return preg_replace( '#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $from . '}' .
		                     '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,' . $len . '}).*#s',
			'$1', $str );
	}
}

/**
 * [my_avatar 将 Gavatar 的头像存储在本地，防止伟大的 GFW Fuck Gavatar，反强奸（很不幸已经被墙了）]
 *
 * @param    string $avatar []
 * @param    mixed $id_or_email [id or email]
 * @param    string $size [头像大小]
 * @param    string $default [默认头像地址]
 * @param    boolean/string $alt    [alt文本]
 *
 * @return string    [html img 字符串]
 */
function my_avatar( $avatar, $id_or_email, $size = '96', $default = '', $alt = false ) {
	$email = '';

	if ( is_numeric( $id_or_email ) ) {
		$id   = (int) $id_or_email;
		$user = get_userdata( $id );

		if ( $user ) {
			$email = $user->user_email;
		}
	} elseif ( is_object( $id_or_email ) ) {
		$allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );

		if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) ) {
			return false;
		}

		if ( ! empty( $id_or_email->user_id ) ) {
			$id   = (int) $id_or_email->user_id;
			$user = get_userdata( $id );
			if ( $user ) {
				$email = $user->user_email;
			}
		}

		if ( ! $email && ! empty( $id_or_email->comment_author_email ) ) {
			$email = $id_or_email->comment_author_email;
		}
	} else {
		$email = $id_or_email;
	}


	$FOLDER           = '/avatar/';
	$email_md5        = md5( strtolower( trim( $email ) ) );// 对email 进行 md5处理
	$avatar_file_name = $email_md5 . "_" . $size . '.jpg';
	$STORE_PATH       = ABSPATH . $FOLDER; //默认存储地址
	$alt              = ( false === $alt ) ? '' : esc_attr( $alt );
	$avatar_url       = home_url() . $FOLDER . $avatar_file_name; // 猜测在在博客的头像
	$avatar_local     = ABSPATH . $FOLDER . $avatar_file_name;// 猜测本地绝对路径
	$expire           = 604800; //设定7天, 单位:秒
	$r                = get_option( 'avatar_rating' );
	$max_size         = 10240000;
	// 默认的头像 在add_filter get_avatar 会默认传入默认的url;
	$fix_default = get_stylesheet_directory_uri() . '/assets/image/default_avatar.jpg';

	// 暂时判断目录存在，如果不存在创建，存放的文件夹
	if ( ! is_dir( $STORE_PATH ) ) {
		if ( ! ! mkdir( $STORE_PATH ) ) {
			return null;
		}
	}

	// 判断在本地的头像文件 是否存在或者已经过期
	if ( ! file_exists( $avatar_local ) || ( time() - filemtime( $avatar_local ) ) > $expire ) {

		// 如果不能存在 Gavatar 会返回你设置的地址的头像
		$gavatar_uri = "https://secure.gravatar.com/avatar/" . $email_md5 . '?s=' . $size . '&r=' . $r;

		$response_code = get_http_response_code( $gavatar_uri );

		if ( (integer) $response_code != 200 ) {
			$gavatar_uri = $fix_default;
		}

		@copy( $gavatar_uri, $avatar_local );

		// 如果头像大于 10 MB 那么还用默认头像替代
		if ( filesize( $avatar_local ) > $max_size ) {
			@copy( $fix_default, $avatar_local );
		}
	}

	// 增加时间戳 强制 CDN 正确的回源
	$file_make_time = filemtime( $avatar_local );

	$avatar = "<img title='{$alt}' 
					alt='{$alt}' src='{$avatar_url}?&t={$file_make_time}' 
					class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";

	return $avatar;
}

/**
 * @param $theURL
 *
 * @return bool|string
 */
function get_http_response_code( $theURL ) {
	$headers = get_headers( $theURL );

	return substr( $headers[0], 9, 3 );
}

// 替换原来的系统函数
add_filter( 'get_avatar', 'my_avatar', 10, 5 );

function my_wp_get_archives( $args ) {
	echo '<div class="test">';
	wp_get_archives( $args );
	echo '</div>';
}

add_filter( 'wp_get_archives', 'my_wp_get_archives', 10, 1 );


/**
 * 注册顶部菜单
 */
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus( array(
		'header_menu' => '顶部菜单',
		'footer_menu' => '底部菜单'
	) );
}

/**
 * 注册侧边栏
 */
if ( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		'name'          => __( 'Index Right Sidebar', '首页的右边栏，如果其他页面未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称
		'class'         => 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签
		'after_widget'  => '</li>', // widget 的结束标签
		'before_title'  => '<h3 class="widget-title">', // 标题的开始标签
		'after_title'   => '</h3>'// 标题的结束标签
	) );

	register_sidebar( array(
		'name'          => __( 'Post Right Sidebar', '文章页面的右边栏，如果未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称
		'class'         => 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签
		'after_widget'  => '</li>', // widget 的结束标签
		'before_title'  => '<h3 class="widget-title">', // 标题的开始标签
		'after_title'   => '</h3>'// 标题的结束标签
	) );

	register_sidebar( array(
		'name'          => __( 'Achieve Right Sidebar', '存档页页面的右边栏，如果未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称
		'class'         => 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签
		'after_widget'  => '</li>', // widget 的结束标签
		'before_title'  => '<h3 class="widget-title">', // 标题的开始标签
		'after_title'   => '</h3>'// 标题的结束标签
	) );

	register_sidebar( array(
		'name'          => __( 'Author Right Sidebar', '存档页页面的右边栏，如果未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称
		'class'         => 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签
		'after_widget'  => '</li>', // widget 的结束标签
		'before_title'  => '<h3 class="widget-title">', // 标题的开始标签
		'after_title'   => '</h3>'// 标题的结束标签
	) );


	register_sidebar( array(
		'name'          => __( 'Page Right Sidebar', '存档页页面的右边栏，如果未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称
		'class'         => 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签
		'after_widget'  => '</li>', // widget 的结束标签
		'before_title'  => '<h3 class="widget-title">', // 标题的开始标签
		'after_title'   => '</h3>'// 标题的结束标签
	) );

	register_sidebar( array(
		'name'          => __( 'Category Right Sidebar', '存档页页面的右边栏，如果未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称
		'class'         => 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签
		'after_widget'  => '</li>', // widget 的结束标签
		'before_title'  => '<h3 class="widget-title">', // 标题的开始标签
		'after_title'   => '</h3>'// 标题的结束标签
	) );

	register_sidebar( array(
		'name'          => __( 'Tag Right Sidebar', '存档页页面的右边栏，如果未定义侧边栏，则默认调用首页的侧边栏' ), // 侧边栏 1 的名称
		'class'         => 'right-sidebar',
		'before_widget' => '<li class="widgets-lists">', // widget 的开始标签
		'after_widget'  => '</li>', // widget 的结束标签
		'before_title'  => '<h3 class="widget-title">', // 标题的开始标签
		'after_title'   => '</h3>'// 标题的结束标签
	) );
}

//注册侧边栏小工具
if ( function_exists( 'wp_register_sidebar_widget' ) ) {
	wp_register_sidebar_widget( 1, '四合一小工具：日历最近文章、标签云、分类目录', 'tab_switcher_one' );
}

function tab_switcher_one() {
	include( TEMPLATEPATH . '/wedgit/tab_switcher_1.php' );
}

// 注册侧边栏小工具2
if ( function_exists( 'wp_register_sidebar_widget' ) ) {
	wp_register_sidebar_widget( 2, '三合一小工具：最近评论、友情链接、评论墙。', 'tab_switcher_two' );
}

function tab_switcher_two() {
	include( TEMPLATEPATH . '/wedgit/tab_switcher_2.php' );
}

//URL:http://www.daqianduan.com/wordpress-tools-newcomments/
register_widget( 'widget_new_comments' );

class widget_new_comments extends WP_Widget {

	function widget_new_comments() {
		$option = array(
			'classname'   => 'widget_new_comments',
			'description' => '显示网友最新评论（头像+名称+评论）'
		);
		$this->WP_Widget( false, '最新评论', $option );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		echo $before_widget;
		$title = empty( $instance['title'] ) ? '最新评论' : apply_filters( 'widget_title', $instance['title'] );
		$count = empty( $instance['count'] ) ? '5' : apply_filters( 'widget_count', $instance['count'] );

		echo $before_title . $title . $after_title;
		echo "<ul class=\"new-comments\">" . "\n";
		echo my_new_comments( $count ) . "\n";
		echo '</ul>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = strip_tags( $new_instance['count'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '' ) );
		$title    = strip_tags( $instance['title'] );
		$count    = strip_tags( $instance['count'] );

		echo '<p><label>标题：<input id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) . '" type="text" value="' . esc_attr( $title ) . '" size="24" /></label></p>';
		echo '<p><label>数目：<input id="' . $this->get_field_id( 'count' ) . '" name="' . $this->get_field_name( 'count' ) . '" type="text" value="' . esc_attr( $count ) . '" size="3" /></label></p>';
	}
}

function my_new_comments( $limit ) {
	global $wpdb;

	$output = "";
	// 读取缓存
	$comments = wp_cache_get( 'my_new_comments' );

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
	 			AND user_id	= '0'
	 		ORDER BY comment_date_gmt DESC
	 		LIMIT $limit ";

	if ( $comments === false ) {
		$comments = $wpdb->get_results( $sql );
		wp_cache_set( 'my_new_comments', $comments );
	}

	foreach ( $comments as $comment ) {
		if ( mb_strlen( $comment->comment_content, 'utf-8' ) > 37 ) {
			$comment->comment_content = mb_substr( $comment->comment_content, 0, 37, 'utf-8' ) . "......";
		}

		$output .= "<li class=\"new-comment-lists\" ><a href=\"" .
		           get_permalink( $comment->ID ) .
		           "#comment-" . $comment->comment_ID .
		           "\" title=\"" .
		           $comment->post_title .
		           "上的评论\">" .
		           get_avatar( $comment->comment_author_email, 60 ) .
		           "<strong class=\"comment-author\">" . strip_tags( $comment->comment_author ) .
		           "@" . $comment->post_title .
		           "：</strong>" .

		           strip_tags( $comment->comment_content )
		           . "</a></li>";
	}
	echo $output;
}

register_widget( 'widget_most_comments_wall' );

class widget_most_comments_wall extends WP_Widget {

	function widget_most_comments_wall() {
		$option = array(
			'classname'   => 'widget_most_comments_wall',
			'description' => '最多评论的N个读者头像'
		);

		$this->WP_Widget( false, '读者评论墙', $option );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );

		echo $before_widget;

		$title = empty( $instance['title'] ) ? '读者评论墙' : apply_filters( 'widget_title', $instance['title'] );
		$count = empty( $instance['count'] ) ? '5' : apply_filters( 'widget_count', $instance['count'] );
		$size  = empty( $instance['width'] ) ? '40' : apply_filters( 'widget_count', $instance['size'] );

		echo $before_title . $title . $after_title;

		echo get_most_comments_friends( array(
			'number' => 20,
			'size'   => 40
		) );

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		$instance['size']  = strip_tags( $new_instance['size'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title' => '',
			'count' => '',
			'size'  => ''
		) );

		$title = strip_tags( $instance['title'] );
		$count = strip_tags( $instance['count'] );
		$size  = strip_tags( $instance['size'] );

		echo '<p><label>标题：<input id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) . '" type="text" value="' . attribute_escape( $title ) . '" size="24" /></label></p>';
		echo '<p><label>数目：<input id="' . $this->get_field_id( 'count' ) . '" name="' . $this->get_field_name( 'count' ) . '" type="number" value="' . attribute_escape( $count ) . '" size="3" /></label></p>';
		echo '<p><label>大小：<input id="' . $this->get_field_id( 'size' ) . '" name="' . $this->get_field_name( 'size' ) . '" type="number" value="' . attribute_escape( $size ) . '" size="3" /></label></p>';
	}
}


// 设置元素宽度
if ( ! isset( $content_width ) ) {
	$content_width = 590;
}

add_theme_support( "content_width", 590 );

//add_theme_support( 'title-tag' );


add_filter( 'embed_oembed_discover', '__return_true' );

/**************************************************************************************
 *************************************** 缩略图相关 *************************************
 **************************************************************************************/
if ( function_exists( 'add_theme_support' ) ) {
	// 给日志启用日志缩略图
	add_theme_support( 'post-thumbnails', array( 'post' ) );
	// 给页面启用日志缩略图
	add_theme_support( 'post-thumbnails', array( 'page' ) );
	// 设置默认的缩略图大小尺寸
	set_post_thumbnail_size( 650, 250, true );
	// 增加适用于文章缩略图的尺寸
	add_image_size( "post_cover", 650, 250, true );
}

/**
 * 获取文章中的特色图像
 *
 * 如果文章设置了特色图像，那么返回设置的特色图像
 * 如果文章没有设置特色图像，但是使用自定义字段"thumb" 定义了特色图像地址，那么返回自定义字段的图片地址
 * 如果上述两者均为定义，那么获取文章中第一张图片地址
 * 如果文章中未包含图片那么返回默认图片地址
 *
 * @param    integer| null $post_ID 文章ID
 * @param    string | null $default_cover_img_url 自定义首页图像
 *
 * @return string                                                        特色图像URL
 */
function get_post_thumbnail_url( $post_ID, $default_cover_img_url = "" ) {
	// 如果没有默认主题缩略图就用主题默认自带的
	$default_cover_img_url = ( ! isset( $default_cover_img_url ) || $default_cover_img_url === "" ) ?
		get_stylesheet_directory_uri() . "/image/" . "default_thumbnail.jpg" :
		$default_cover_img_url;

	// 获取文章当前ID
	$post_ID = ( $post_ID === null ) ? get_the_ID() : $post_ID;
	// 获取缩略图ID
	$thumbnail_id = get_post_thumbnail_id( $post_ID );

	if ( $thumbnail_id ) { // 如果存在后台上传的缩略图
		// 获取缩略图属性
		$thumb_attribute    = wp_get_attachment_image_src( $thumbnail_id, 650 );
		$post_thumbnail_url = $thumb_attribute[0];
	} else {
		// 获取自定义的封面字段 sw_post_cover
		$post_custom_post_cover_value = get_post_custom_values( "sw_post_cover", $post_ID );
		$post_custom_post_cover_value = ( $post_custom_post_cover_value != null && isset( $post_custom_post_cover_value[0] ) ) ?
			$post_custom_post_cover_value[0] : null;
		// todo 验证是图片
		if ( $post_custom_post_cover_value != null ) {
			$post_thumbnail_url = $post_custom_post_cover_value;
		} else {
			// 如果实在找不到获取文章内容中第一张图像的地址
			$first_img = get_first_img_of_post();
			if ( is_null( $first_img ) ) {
				$post_thumbnail_url = $default_cover_img_url;
			} else {
				// 如果文章中也没有地址那么用第一张替代
				$post_thumbnail_url = $first_img;
			}
		}
	}

	return $post_thumbnail_url;
}

/**
 * 获取文章第一张图像地址
 * @return string | null 返回字符串
 */
function get_first_img_of_post() {
	global $post;
	$first_img = null;
	ob_start();
	$output = preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', $post->post_content, $matches );
	if ( $output ) {
		$first_img = $matches[1][0];
	}
	ob_end_clean();

	return $first_img;
}

/**
 * [get_most_comments_friends description]
 *
 * @param    [type] $config [description]
 *
 * @return [type]                 [description]
 */
function get_most_comments_friends( $config ) {

	$config['container']       = ! empty( $config['container'] ) ? $config['container'] : "";
	$config['container_class'] = ! empty( $config['container_class'] ) ? $config['container_class'] : "most-comments-friend-wall";
	$config['container_id']    = ! empty( $config['container_id'] ) ? $config['container_id'] : "MostCommentsFirendsWall";
	$config['echo']            = ! empty( $config['echo'] ) ? ! ! $config['echo'] : false;
	$config['before']          = ! empty( $config['before'] ) ? $config['before'] : "li";
	$config['number']          = ! empty( $config['number'] ) ? $config['number'] : 15;
	$config['size']            = ! empty( $config['size'] ) ? $config['size'] : 45;
	$config['time']            = ! empty( $config['time'] ) ? $config['time'] : 3;

	global $wpdb;

	$counts = wp_cache_get( 'simpleway_mostactive' );

	$query = "	SELECT
	 					COUNT(comment_author) AS cnt,
	 					comment_author,
	 					comment_author_url,
	 					comment_author_email
	 				FROM {$wpdb->prefix}comments
	 				WHERE comment_date > date_sub( NOW(), INTERVAL {$config['time']} MONTH )
				 		AND comment_approved = '1'
				 		AND comment_author_email != 'example@example.com'
				 		-- AND comment_author_url != ''
				 		AND comment_type = ''
				 		AND user_id = '0'
		 			GROUP BY comment_author_email
		 			ORDER BY cnt DESC
		 			LIMIT {$config['number']}";


	if ( false === $counts ) {
		$counts = $wpdb->get_results( $query );
		wp_cache_set( 'simpleway_mostactive', $counts );
	}

	$mostactive = '';

	if ( $counts ) {
		$mostactive .= "<ul class=\"{$config['container_class']}\" id=\"{$config['container_id']}\">";

		wp_cache_set( 'simpleway_mostactive', $counts );

		$_index = 1;

		foreach ( $counts as $count ) {
			$c_url    = $count->comment_author_url != "" ? $count->comment_author_url : get_bloginfo( 'url' );
			$c_count  = $count->cnt;
			$c_author = $count->comment_author;
			$c_email  = $count->comment_author_email;

			$mostactive .= "<li id=\"mostActivePeople-{$_index}\" class=\"most-active-people\"><a href=\"{$c_url}\" title=\"{$c_author} 发表 {$c_count} 条评论\" rel=\"nofollow\" target=\"_blank\">" .
			               get_avatar( $c_email, $config['size'] ) . "</a></li>";

			$_index ++;
		}
		$mostactive .= "</ul>";
	}

	if ( $config['echo'] ) {
		echo $mostactive;
	} else {
		return $mostactive;
	}
}

// 时间可读
add_filter( 'the_date', 'human_readable_date' );
add_filter( 'get_the_date', 'human_readable_date' );
add_filter( 'the_modified_date', 'human_readable_date' );
add_filter( 'get_the_modified_date', 'human_readable_date' );

function human_readable_date( $the_date ) {
	return human_time_diff( strtotime( $the_date ) ) . __( ' ago' );
}

/**
 * 页面分页
 *
 * @param    integer $range 分页计数
 *
 * @return string                 html字符串
 */
function page_navigation( $range = 9 ) {
	global $paged,
	       $wp_query;

	echo "<nav class=\"page-nav-wrap\">";

	if ( ! isset( $max_page ) ) {
		$max_page = $wp_query->max_num_pages;
	}


	if ( $max_page > 1 ) {
		if ( ! $paged ) {
			$paged = 1;
		}

		// 跳转到首页
		if ( $paged != 1 ) {
			echo "<a href='" . get_pagenum_link( 1 ) . "' class='extend' title='跳转到首页'><span class='icons fi-home'></span>首页</a>";
		}

		// 上一页
		previous_posts_link( '<<' );

		if ( $max_page > $range ) {
			if ( $paged < $range ) {
				for ( $i = 1; $i <= ( $range + 1 ); $i ++ ) {
					echo "<a href='" . get_pagenum_link( $i ) . "'";
					if ( $i == $paged ) {
						echo " class=\"page current\"";
					}
					echo " class=\"page\">{$i}</a>";
				}
			} elseif ( $paged >= ( $max_page - ceil( ( $range / 2 ) ) ) ) {
				for ( $i = $max_page - $range; $i <= $max_page; $i ++ ) {
					echo "<a href='" . get_pagenum_link( $i ) . "'";
					if ( $i == $paged ) {
						echo " class=\" page current\" ";
					}
					echo " class=\"page\">{$i}</a>";
				}
			} elseif ( $paged >= $range && $paged < ( $max_page - ceil( ( $range / 2 ) ) ) ) {
				for ( $i = ( $paged - ceil( $range / 2 ) ); $i <= ( $paged + ceil( ( $range / 2 ) ) ); $i ++ ) {
					echo "<a href='" . get_pagenum_link( $i ) . "'";
					if ( $i == $paged ) {
						echo " class=\" page current\"";
					}
					echo "class=\"page\">{$i}</a>";
				}
			}
		} else {
			for ( $i = 1; $i <= $max_page; $i ++ ) {
				echo "<a href='" . get_pagenum_link( $i ) . "'";
				if ( $i == $paged ) {
					echo " class='current'";
				}
				echo ">$i</a>";
			}
		}

		// 下一页
		next_posts_link( '>>' );

		if ( $paged != $max_page ) {
			echo "<a href='" . get_pagenum_link( $max_page ) . "' class='extend' title='跳转到最后一页'>最后</a>";
		}
	}
	echo "</nav>";
}

// 增加后台作者资料
add_filter( 'user_contactmethods', 'add_author_contact_fields' );

function add_author_contact_fields( $contact_methods ) {

	$contact_methods['twitter']     = 'Twitter';
	$contact_methods['google_plus'] = 'Google+';
	$contact_methods['facebook']    = 'Faceboook';
	$contact_methods['github']      = 'GitHub';

	// unset( $contactmethods['yim'] );
	// unset( $contactmethods['aim'] );
	// unset( $contactmethods['jabber'] );

	return $contact_methods;
}


// 增加主页关键字以及描述
// $new_general_setting = new new_general_setting();

// class new_general_setting {

// 	function new_general_setting( ) {
// 		add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
// 	}

// 	function register_fields() {
// 		register_setting( 'general', 'favorite_color', 'esc_attr' );
// 		add_settings_field('fav_color',
// 			'<label for="favorite_color">'.__('最喜欢的颜色' ).'</label>',
// 			array(&$this, 'fields_html') ,
// 			'general'
// 			);
// 	}

// 	function fields_html() {
// 		$value = get_option( 'favorite_color', '' );
// 		echo '<input type="text" id="favorite_color" name="favorite_color" value="' . $value . '" />';
// 	}
// }


// 给评论链接添加No-follow
add_filter( 'comment_reply_link', 'sw_add_no_follow', 420, 4 );

/**
 * @param $link
 * @param $args
 * @param $comment
 * @param $post
 *
 * @return mixed
 */
function sw_add_no_follow( $link, $args, $comment, $post ) {
	return str_replace( "href=", "rel='nofollow' href=", $link );
}

// 恢复友情链接
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

/**
 * 添加主题设置选项
 */
add_action( 'admin_menu', 'sw_setting_page' );

function sw_setting_page() {

	if ( count( $_POST ) > 0 && isset( $_POST['simple_way_theme_settings'] ) ) {

		$settings = $_POST;
		foreach ( $settings as $setting => $value ) {

			if ( $setting != 'simple_way_theme_settings' && $setting != 'Submit' ) {

				$option_key = 'simple_way_' . $setting;
				delete_option( $option_key );
				add_option( $option_key, trim( $value ) );
			}
		}
	}

	add_menu_page( __( '主题选项' ), __( '主题选项' ), 'edit_themes', basename( __FILE__ ), 'sw_theme_settings' );
}

function sw_theme_settings() {
	?>

    <div class="wrap">
        <h2>主题选项</h2>
        <form method="post" action="">
            <table class="form-table">
                <tbody>
                <tr valign="top">
                    <th scope="row">首页关键词添加</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span>首页关键词添加</span>
                            </legend>
                            <p>
                                <label for="indexKeywords" class="description">
                                    添加在首页关键词，请用<code>,</code>间隔
                                </label>
                            </p>
                            <textarea name="index_keywords" class="large-text code" id="indexKeywords" rows="3"
                                      cols="30"
                                      style="text-indent:0;padding:0"><?php echo stripslashes( trim( get_option( 'simple_way_index_keywords' ) ) ); ?></textarea>
                            <p class="description">
                                建议设置 2~3 个，最多不超过 5 个
                            </p>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">首页描述添加</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span>首页描述添加</span>
                            </legend>
                            <p>
                                <label for="indexDescription" class="description">
                                    添加首页描述
                                </label>
                            </p>
                            <textarea name="index_description" class="large-text code" id="indexDescription" rows="3"
                                      cols="30"
                                      style="text-indent:0;padding:0"><?php echo stripslashes( trim( get_option( 'simple_way_index_description' ) ) ); ?></textarea>
                            <p class="description">
                                在Google的搜索结果中，摘要信息标题长度一般在 72 字节（即 36 个中文字）左右，而百度则只有 56 字节（即 28 个中文字）左右，超出这个范围的内容将被省略。
                            </p>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">统计代码添加</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span>统计代码添加</span>
                            </legend>
                            <p>
                                <label for="analytics" class="description">
                                    在主题底部添加统计代码或者分享代码等（请包含 <code>&lt;script&gt;&lt;/script&gt;</code>标签 ）
                                </label>
                            </p>
                            <textarea name="analytics"
                                      class="large-text code"
                                      id="analytics"
                                      rows="10"
                                      cols="50"
                                      style="text-indent:0;padding:0"><?php echo stripslashes( trim( get_option( 'simple_way_analytics' ) ) ); ?></textarea>
                        </fieldset>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">文章页面的分享代码/相关文章</th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text">
                                <span>统计代码添加</span>
                            </legend>
                            <p>
                                <label for="single_script">
                                    在文章主题底部添加统计代码或者分享代码等（请包含 <code>&lt;script&gt;&lt;/script&gt;</code>标签 ）
                                </label>
                            </p>
                            <textarea name="single_script"
                                      class="large-text code"
                                      id="single_script" rows="10"
                                      cols="50"
                                      style="text-indent:0;padding:0"><?php echo stripslashes( trim( get_option( 'simple_way_single_script' ) ) ); ?></textarea>
                            <p class="description">
                                请注意该段代码只会在文章页面出现
                            </p>
                        </fieldset>
                    </td>
                </tr>
                </tbody>
            </table>
            <p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="保存设置"/>
                <input type="hidden" name="simple_way_theme_settings" value="save" style="display:none;"/>
            </p>
        </form>
    </div>
<?php }


class sw_blog_info extends WP_Widget {

}

/**
 * aside - Typically styled without a title. Similar to a Facebook note update.
 * gallery - A gallery of images. Post will likely contain a gallery shortcode and will have image attachments.
 * link - A link to another site. Themes may wish to use the first <a href=””> tag in the post content as the external link for that post. An alternative approach could be if the post consists only of a URL, then that will be the URL and the title (post_title) will be the name attached to the anchor for it.
 * image - A single image. The first <img /> tag in the post could be considered the image. Alternatively, if the post consists only of a URL, that will be the image URL and the title of the post (post_title) will be the title attribute for the image.
 * quote - A quotation. Probably will contain a blockquote holding the quote content. Alternatively, the quote may be just the content, with the source/author being the title.
 * status - A short status update, similar to a Twitter status update.
 * video - A single video or video playlist. The first <video /> tag or object/embed in the post content could be considered the video. Alternatively, if the post consists only of a URL, that will be the video URL. May also contain the video as an attachment to the post, if video support is enabled on the blog (like via a plugin).
 * audio - An audio file or playlist. Could be used for Podcasting.
 * chat - A chat transcript, like so:
 */
add_theme_support( 'post-formats', array(
	'aside',
	'gallery',
	'link',
	'image',
	'quote',
	'status',
	'video',
	'audio',
	'chart'
) );


//add_action('after_setup_theme');
//
//
//function wp_add_custom_logo () {
//    add_theme_support('custom-logo', array(
//        'height'=> 100,
//        'width' => 100,
//        'flex-height' => true,
//        'flex-width'  => true,
//        'header-text' => array( 'site-title', 'site-description' ),
//    ));
//}
?>
