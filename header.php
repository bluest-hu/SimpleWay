<!DOCTYPE html>
<html lang="en">
  <head>
  <?php if ( is_home() ) { ?>
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
  <?php if ( get_option('simple_way_index_keywords' ) != '' ) { ?>
    <meta name="keywords" content="<?php echo trim(get_option('simple_way_index_keywords')); ?>" />
  <?php } ?>
  <?php if ( get_option('simple_way_index_description') != '' ) { ?>
    <meta name="description" content="<?php echo trim(get_option('simple_way_index_description')); ?>" />
  <?php } ?>
  <?php } ?>
  <?php if ( is_search() ) { ?>
    <title>搜索结果 | <?php bloginfo('name'); ?></title>
  <?php } ?>
<?php if ( is_single() ) { ?>
    <title><?php echo trim(wp_title('', 0)); ?> | <?php bloginfo('name'); ?></title>
<?php } ?>
  <?php if ( is_page() ) { ?>
    <title><?php echo trim(wp_title('', 0)); ?> | <?php bloginfo('name'); ?></title>
  <?php } ?>
  <?php if ( is_category() ) { ?>
    <title><?php single_cat_title(); ?> | <?php bloginfo('name'); ?></title>
  <?php } ?>
  <?php if ( is_month() ) { ?>
    <title><?php the_time('F'); ?> | <?php bloginfo('name'); ?></title>
  <?php } ?>
  <?php if ( is_tag() ) { ?>
    <title><?php  single_tag_title("", true); ?> | <?php bloginfo('name'); ?></title>
    <meta name="keywords" content="<?php single_tag_title("", true); ?>" />
    <meta name="description" content="<?php echo mb_substr(tag_description(), 36); ?>" />
  <?php } ?>
    <?php
      if (!function_exists('utf8Substr')) {
        function utf8Substr($str, $from, $len) {
          return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
              '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
              '$1',$str);
        }
      }
      if ( is_single() ){
          if ($post->post_excerpt) {
            $description  = $post->post_excerpt;
          } else {
            if ( preg_match('/<p>(.*)<\/p>/iU', trim(strip_tags($post->post_content,"<p>")), $result)) {
              $post_content = $result['1'];
            } else {
              $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
              $post_content = $post_content_r['0'];
            }
            $description = utf8Substr($post_content,0,200);
          }

          $keywords = "";
          $tags = wp_get_post_tags($post->ID);

          foreach ($tags as $tag ) {
            $keywords = $keywords . $tag->name . ",";
          }
        }
    ?>
  <?php echo "\n"; ?>
  <?php if ( is_single() ) { ?>
    <meta name="description" content="<?php echo trim($description); ?>" />
    <meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
  <?php } ?>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="generator" content="WordPress" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--360 6.X 以上可识别-->
    <meta name="renderer" content="webkit" />
    <!--其他双核可识别-->
    <meta name="force-rendering" content="webkit" />
    <!-- IE 使用 最新版 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style/style.min.css">
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name');?>&raquo;Feed" href="<?php bloginfo('rss2_url');?>" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name');?>&raquo;评论&raquo;Feed" href="<?php bloginfo('comments_rss2_url'); ?>comments/feed" />
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/script/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/script/script.js"></script>
  </head>
  <body>
    <div class="main-wrap" id="mainWrap">
      <header class="main-header">
        <div class="header-content">
          <div class="header-top-column">
            <h1 class="blog-title">
              <a class="link" href="<?php bloginfo('url');?>"> <?php bloginfo('name'); ?> </a>
            </h1><span class="blog-description"><?php echo bloginfo('description') ?></span>
          </div>
          <div class="header-bottom-column clear">
            <?php get_template_part('nav'); ?>
            <div class="search-form top-search-form right-column">
              <?php get_search_form(); ?>
            </div>
          </div>
        </div>
      </header>