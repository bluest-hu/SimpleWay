<!DOCTYPE html>
<html>
  <head>
    <!-- Meta Tags -->
      <?php if ( is_home() ) { ?><title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title><?php } ?>
      <?php if ( is_search() ) { ?><title>搜索结果 | <?php bloginfo('name'); ?></title><?php } ?>
      <?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?> | <?php bloginfo('name'); ?></title><?php } ?>
      <?php if ( is_page() ) { ?><title><?php echo trim(wp_title('',0)); ?> | <?php bloginfo('name'); ?></title><?php } ?>
      <?php if ( is_category() ) { ?><title><?php single_cat_title(); ?> | <?php bloginfo('name'); ?></title><?php } ?>
      <?php if ( is_month() ) { ?><title><?php the_time('F'); ?> | <?php bloginfo('name'); ?></title><?php } ?>
      <?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><title><?php  single_tag_title("", true); ?> | <?php bloginfo('name'); ?></title><?php } ?> <?php } ?>
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
              if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
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
    <?php if (is_home()) { ?>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <?php }; ?>
    <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo('charset'); ?>" />
    <meta name="generator" content="WordPress" />
    <!--END meta--> 
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style/style.min.css">
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name');?>&raquo;Feed" href="<?php bloginfo('rss2_url');?>" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name');?>&raquo;评论&raquo;Feed" href="<?php bloginfo('comments_rss2_url'); ?>comments/feed" />
    <script type="text/javascript" src="http://cdn.staticfile.org/jquery/2.1.0/jquery.min.js"></script>
    <!-- <?php comments_popup_script(); ?> -->
  </head>
    