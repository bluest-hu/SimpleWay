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
			<?php if(have_posts()):?>
				<?php while (have_posts()):the_post();?>
					<article class="article" id="post-<?php the_ID();?>"><!-- Article Begain -->
						<div class="article-top-column post-meta-container clear">
							<div class="left-column author-avatar-container"><!-- Author Avastar Container Begain -->
								<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" alt="文章作者：<?php the_author(); ?>" title="文章作者：<?php the_author(); ?>" class="author-avatar"><!-- Article Author Begain -->
									<?php echo my_avatar( get_the_author_email(), 50 ); ?>
								</a><!-- Article Author Ends -->
							</div><!-- Author Avastar Container Ends -->

							<diiv class="left-column">
								<h1 class="article-title top-column"><!-- Article Title Begain -->
									<a href="<?php the_permalink();?>" title="<?php the_title();?>">
										<?php the_title(); ?>
									</a>
								</h1><!-- Article Title End -->
								<div class="bottom-column post-meta clear">
									<div class="article-category left-column">
										<?php the_category(' / ') ?>
									</div><!--Category End -->
									<time class="article-time right-column">
										<?php the_time('Y-m-d') ?>
									</time><!--Article End-->
								</div><!-- Left Column Begain -->
							</diiv><!-- Left Column Ends -->
						</div><!-- Article Top Column Ends -->	
							
						<div class="entry">
							<?php the_content("继续阅读 >>"); ?>
						</div><!-- End Blog Entry -->

						<div class="article-column-bottom post-meta clear">
							<div class="article-tags left-column">
								<?php the_tags("", " "); ?>
							</div><!-- Article Tags End -->
							<div class="article-comment right-column">
								<?php comments_popup_link('木有评论', '1 条评论', '% 条评论'); ?>
							</div><!-- Comments End -->
						</div><!-- Article Bottom Column Ends -->
					</article><!-- Article Ends -->
				<?php endwhile;?>
				<nav class="page-navigation">
					<?php par_pagenavi(8); ?><!-- Article Navigation Ends-->
				</nav> <!-- Article Navigation Ends-->
			<?php else:?>
				<article class="article" id="post-<?php the_ID();?>"><!-- Article Begain -->
					<div>
						<h2><?php _e("Not Found");?></h2> 
					</div>
				</article><!-- Article Ends -->
			<?php endif;?>
				</div><!-- Post Ends -->
				
				<aside class="aside right-column"><!-- Right Aside Begain -->
					<?php get_sidebar();?>
				</aside><!-- Right Aside Ends -->

			</div><!-- Content Ends -->
		</div><!-- Main Ends -->
		<!-- Footer Begain -->
		<?php get_footer(  ); ?>
