<!DOCTYPE html>
<html lang="en">
<head>

    <?php
    //// 页面标题
    //$page_title = '';
    //// 页面描述
    //$page_description = '';
    //// 页面关键词
    //$page_key_words = '';
    //
    ///**
    // * SEO
    // * for  home page
    // *
    // *      single page
    // *      author page
    // *
    // */
    //
    //// 从主题参数中提取的关键词
    //$sw_index_keywords = trim(get_option('simple_way_index_keywords')) || null;
    //// 从主题中提取的描述
    //
    //
    //// 首页的优化
    //if ( is_home() ) {
    //    $page_title =  bloginfo('name') . '-' .   bloginfo('description');
    //    $page_description = '';
    //}
    //
    //
    //?>
    <?php if (is_home()) { ?>
    <title><?php bloginfo('name'); ?> - <?php bloginfo('description'); ?></title>
        <?php if (trim(get_option('simple_way_index_keywords')) != '') { ?>
    <meta name="keywords" content="<?php echo trim(get_option('simple_way_index_keywords')); ?>"/>
        <?php } ?>
        <?php if (trim(get_option('simple_way_index_description')) != '') { ?>
    <meta name="description" content="<?php echo trim(get_option('simple_way_index_description')); ?>"/>
        <?php } ?>
    <?php } ?>
    <?php if (is_search()) { ?>
    <title>搜索结果 | <?php echo trim(get_option('simple_way_index_keywords')) ?></title>
    <meta name="keywords" content="<?php echo trim(get_option('simple_way_index_keywords')); ?>"/>
    <?php } ?>
    <?php if (is_single()) { ?>
        <title><?php echo trim(wp_title('', 0)); ?> | <?php bloginfo('name'); ?></title>
    <?php } ?>
    <?php if (is_page()) { ?>
        <title><?php echo trim(wp_title('', 0)); ?> | <?php bloginfo('name'); ?></title>
<!--        <meta name="keywords" content="--><?php //single_tag_title("", true); ?><!--"/>-->
<!--        <meta name="description" content="--><?php //echo mb_substr(tag_description(), 36); ?><!--"/>-->
    <?php } ?>
    <?php if (is_category()) { ?>
        <title><?php single_cat_title(); ?> | <?php bloginfo('name'); ?></title>
<!--        <meta name="keywords" content="--><?php //single_tag_title("", true); ?><!--"/>-->
<!--        <meta name="description" content="--><?php //echo mb_substr(tag_description(), 36); ?><!--"/>-->
    <?php } ?>
    <?php if (is_month()) { ?>
        <title><?php the_time('F'); ?> | <?php bloginfo('name'); ?></title>
<!--        <meta name="keywords" content="--><?php //single_tag_title("", true); ?><!--"/>-->
<!--        <meta name="description" content="--><?php //echo mb_substr(tag_description(), 36); ?><!--"/>-->
    <?php } ?>
    <?php if (is_tag()) { ?>
        <title><?php single_tag_title("", true); ?> | <?php bloginfo('name'); ?></title>
        <meta name="keywords" content="<?php single_tag_title("", true); ?>"/>
        <meta name="description" content="<?php echo mb_substr(tag_description(), 36); ?>"/>
    <?php } ?>
    <?php
    if (is_single()) {
        if ($post->post_excerpt) {
            $description = $post->post_excerpt;
        } else {
            if (preg_match('/<p>(.*)<\/p>/iU', trim(strip_tags($post->post_content, "<p>")), $result)) {
                $post_content = $result['1'];
            } else {
                $post_content_r = explode("\n", trim(strip_tags($post->post_content)));
                $post_content = $post_content_r['0'];
            }
            $description = utf8Substr($post_content, 0, 200);
        }

        $keywords = "";
        $tags = wp_get_post_tags($post->ID);

        foreach ($tags as $tag) {
            $keywords = $keywords . $tag->name . ",";
        }
    }
    ?>
    <?php echo "\n"; ?>
    <?php if (is_single()) { ?>
        <meta name="description" content="<?php echo trim($description); ?>"/>
        <meta name="keywords" content="<?php echo rtrim($keywords, ','); ?>"/>
    <?php } ?>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <meta name="generator" content="WordPress"/>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php //  ?>
    <meta name="renderer" content="webkit"/>
    <?php //其他双核可识别 ?>
    <meta name="force-rendering" content="webkit"/>
    <?php //IE 使用 最新版 ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="theme-color" content="#db5945">
    <link rel="icon" href="favicon.ico" type="image/x-icon"/>
    <link rel="icon" sizes="192x192" href="nice-highres.png">

    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . "/style/style.css"; ?>">
    <link rel="alternate" type="application/rss+xml"
          title="<?php bloginfo('name');?>&raquo;Feed"
          href="<?php bloginfo('rss2_url'); ?>"/>
    <link rel="alternate" type="application/rss+xml"
          title="<?php bloginfo('name');?>&raquo;评论&raquo;Feed"
          href="<?php bloginfo('comments_rss2_url'); ?>comments/feed"/>

    <?php wp_enqueue_script('myjquery', get_stylesheet_directory_uri() . "/script/jquery-2.0.3.min.js", '', '', true); ?>
    <?php wp_enqueue_script('main', get_stylesheet_directory_uri() . "/script/script.min.js", 'myjquery', '', true); ?>
    <!-- Android add to home screen  -->
    <link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/manifest.json">

    <link rel="icon" sizes="192x192" href="nice-highres.png">
    <link rel="icon" sizes="128x128" href="niceicon.png">
    <link rel="apple-touch-icon" sizes="128x128" href="niceicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="128x128" href="niceicon.png">

    <link rel='dns-prefetch' href='//' />
</head>

<body <?php body_class('');?>>
<div class="main-wrap" id="mainWrap">
    <header class="main-header">
        <div class="header-content">
            <div class="header-top-column">
                <h1 class="blog-title">
                    <a class="link" href="<?php bloginfo('url'); ?>"> <?php bloginfo('name'); ?> </a>
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

