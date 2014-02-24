<!doctype html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<title>404</title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style/style.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style/error.min.css">
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name');?>&raquo;Feed" href="<?php bloginfo('rss2_url');?>" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name');?>&raquo;评论&raquo;Feed" href="<?php bloginfo('comments_rss2_url'); ?>comments/feed" />
    <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/script/jquery-2.0.3.min.js"></script>
</head>
<body>
	<div class="wrap"><!-- Blog Wrap Begain -->
		<div class="main">
			<div class="content">
				<div class="error"><!-- Error begain -->
					<h1 class="title">
						404 Not Find!!!
					</h1>

					<p class="notice-text">
						额，糟糕...网站貌似发生了一点小意外，您要找的内容已经丢失或者不存在。
					</p>

					<div class="suggestion">
						<h3 class="title">您可以选择：</h3>	
						<div class="suggestion-content">
							<a href="<?php bloginfo('url');?>" title="返回首页" class="back-to-home btn">返回首页</a>
							 OR 
							<a href="mailto:ihuguowei@gmail.com" class="send-email btn">提交错误</a>
						</div>
					</div>

					<div class="not-found-image">
						<span class="not-find-img-1">
							<img src="<?php echo get_stylesheet_directory_uri()?>/image/not_found.png" alt="">
						</span>

						<span class="not-find-img-2">
							<img src="<?php echo get_stylesheet_directory_uri()?>/image/not_found_2.png" alt="">
						</span>
					</div>
				</div><!-- Error ends -->
			</div><!--Content Ends -->
		</div><!-- mian Ends -->

		<!-- Footer Begain -->
		<?php get_footer(  ); ?>
		<!-- Footer Ends -->
	</div><!-- Blog Wrap Ends -->
</body>
</html>