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
				<div class="author left-column">
					<div class="author-info">
						<?php echo get_avatar( get_the_author_email(), 200 ); ?>
					</div>
				</div><!-- Post Ends -->

				<aside class="aside right-column"><!-- Right Aside Begain -->
					<?php get_sidebar();?>
				</aside><!-- Right Aside Ends -->
			</div><!-- Content Ends -->
		</div><!-- Main Ends -->
		<!-- Footer Begain -->
		<?php get_footer(  ); ?>
		<!-- Footer Ends -->
	</div><!-- Wrap Ends -->
	<a href="#" id="backToTopBtn"></a>
</body>
</html>
