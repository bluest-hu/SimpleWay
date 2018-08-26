<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>"/>
    <meta name="generator" content="WordPress"/>
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="theme-color" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit"/>
    <meta name="force-rendering" content="webkit"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="theme-color" content="#db5945">
    <link rel="stylesheet" type="text/css"
          href="<?php echo get_stylesheet_directory_uri() . "/assets/style/style.css"; ?>">
    <?php wp_enqueue_script('myjquery', get_stylesheet_directory_uri() . "/script/jquery-2.0.3.min.js", '', '', true); ?>
    <?php wp_enqueue_script('main', get_stylesheet_directory_uri() . "/script/script.min.js", 'myjquery', '', true); ?>
    <!-- Android add to home screen  -->
    <link rel="manifest" href="<?php echo get_stylesheet_directory_uri(); ?>/manifest.json">
<?php
    wp_head();
?>
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

