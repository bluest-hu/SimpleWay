<?php get_header();?>
<body>
	<div class="wrap"><!-- Blog Wrap Begain -->
		<header class="header"><!-- Bolg Header Begain -->
			<div class="content"><!-- Blog Header Content Begain -->
				<div class="header-top-column"><!--Header Top Column Begain -->
					<h1 class="title"><!-- Blog Title Begain -->
						<a href="<?php bloginfo('url');?>"> <?php bloginfo('name'); ?> </a>
					</h1><!-- Blog Header Title Ends -->
					<span class="blog-desciption"></span>
				</div><!--Header Top Column End -->

				<div class="header-bottom-column clear"><!-- Header Bottom  Begain -->
					<?php get_template_part('nav'); ?>
					<div class="search-form right-column">
						<?php get_search_form(); ?>
					</div>
				</div><!-- Header Bottom Ends -->
				
			</div><!-- Blog Header Content Ends -->
		</header><!-- Bolg Header Ends -->

		<div class="main">
			<div class="content clear">
				<div class="post left-column">
					<div class="article-comments-container">
						<ul>
							<?php comments_template(); ?>
						</ul>
						
						<div class="comment-form-container">
							<?php comment_form(); ?>
						</div><!--Comment Form Ends -->
					</div><!-- Single Article Comment Ends -->
				<aside class="aside right-column"><!-- Right Aside Begain -->
					<?php get_sidebar();?>
				</aside><!-- Right Aside Ends -->
			</div><!-- Content Ends -->
		</div><!-- Main Ends -->
		<!-- Footer Begain -->
		<?php get_footer(); ?>