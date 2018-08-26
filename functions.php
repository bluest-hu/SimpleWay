<?php


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

// add theme support
add_action( 'after_setup_theme', function () {

	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	// 自定义 header
	add_theme_support( 'custom-header', array(
		'default-image'          => get_template_directory_uri() . '/assets/images/header_default.png',
		// Display the header text along with the image
		'header-text'            => false,
		// Header text color default
		'default-text-color'     => '000',
		// Header image width (in pixels)
		'width'                  => 1000,
		// Header image height (in pixels)
		'height'                 => 400,
		'flex-width'             => true,
		'flex-height'            => true,
		// Header image random rotation default
		'random-default'         => false,
		// Enable upload of image file in admin
		'uploads'                => true,
		// function to be called in theme head section
		'wp-head-callback'       => '',
		//  function to be called in preview page head section
		'admin-head-callback'    => 'adminhead_cb',
		// function to produce preview markup in the admin screen
		'admin-preview-callback' => 'adminpreview_cb',
	) );

	// 自定义 logo
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );

	// 自定义背景图片
	add_theme_support( 'custom-background', array(
		'default-color'          => '000',
		'default-image'          => '',
		'default-repeat'         => 'no-repeat',
		'default-position-x'     => 'left',
		'default-position-y'     => 'top',
		'default-size'           => 'auto',
		'default-attachment'     => 'fixed',
		'wp-head-callback'       => '_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => ''
	) );

	// 自定义文章类型
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

	// 支持 html 5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption'
	) );

	// 缩略图
	add_theme_support( 'post-thumbnails' );

	// title tag
	add_theme_support( 'title-tag' );

	add_theme_support( 'customize-selective-refresh-widgets' );

	// 给日志启用日志缩略图
	add_theme_support( 'post-thumbnails', array( 'post' ) );
	// 给页面启用日志缩略图
	add_theme_support( 'post-thumbnails', array( 'page' ) );
	// 设置默认的缩略图大小尺寸
	set_post_thumbnail_size( 650, 250, true );
	// 增加适用于文章缩略图的尺寸
	add_image_size( "post_cover", 650, 250, true );
});


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
}

//注册侧边栏小工具
if ( function_exists( 'wp_register_sidebar_widget' ) ) {
	wp_register_sidebar_widget( 1, '四合一小工具：日历最近文章、标签云、分类目录', 'tab_switcher_one' );
}

function tab_switcher_one() {
	include( TEMPLATEPATH . '/widget/tab_switcher_1.php' );
}

// 注册侧边栏小工具2
if ( function_exists( 'wp_register_sidebar_widget' ) ) {
	wp_register_sidebar_widget( 2, '三合一小工具：最近评论、友情链接、评论墙。', 'tab_switcher_two' );
}

function tab_switcher_two() {
	include( TEMPLATEPATH . '/widget/tab_switcher_2.php' );
}

// 设置元素宽度
if ( ! isset( $content_width ) ) {
	$content_width = 590;
}

add_theme_support( "content_width", 590 );

//add_theme_support( 'title-tag' );


add_filter( 'embed_oembed_discover', '__return_true' );

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
    public function __construct( $id_base, $name, array $widget_options = array(), array $control_options = array() ) {
	    parent::__construct( $id_base, $name, $widget_options, $control_options );
    }
}
?>
