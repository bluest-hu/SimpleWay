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
									<?php echo get_avatar( get_the_author_email(), 50 ); ?>
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

					<div class="author-info">
						<div class="top-column clear">
							<div class="author-avatar left-column">
								<?php echo get_avatar( get_the_author_email(), 80 ); ?>
							</div>
					
							<div class="author-descrption right-column">
								<p class="author-name">
									<?php the_author_posts_link(); ?>
								</p>
								<p class="author-summery">
									<?php the_author_description(); ?>
								</p>
							</div><!-- Author Description Ends -->
						</div>
						<div class="author-contact">
							<ul>

							<?php if (get_the_author_meta('user_url')) { ?> 
								<li class="website">
									<a href="<?php the_author_meta('user_url'); ?>" alt="主页" title="主页" rel="nofollow">主页</a>
								</li><!-- Post Author Website -->
							<?php } ?>

							<?php if (get_the_author_meta('user_email')) { ?>
								<li class="email">
									<a href="mailto:<?php the_author_email(); ?>" alt="e-mail" title="e-mail" rel="nofollow" >邮箱</a>
								</li><!-- Post Author E-mail -->
							<?php } ?>	
							
							<?php if (get_the_author_meta('twitter')) { ?>
								<li class="twitter">
									<a href="<?php the_author_meta('twitter'); ?>" alt="Twitter" rel="nofollow" title="Twitter">Twitter</a>
								</li><!-- Post Author Twitter -->
							<?php } ?>

							<?php if (get_the_author_meta()) { ?>
								<li class="facebook">
									<a href="<?php the_author_meta('facebook'); ?>" alt="FaceBook" title="Facebook" rel="nofollow">Facebook</a>
								</li><!-- Post Author Facebook -->
							<?php } ?>
							
							<?php if (get_the_author_meta('google_plus')) { ?> 
								<li class="google-plus">
									<a href="<?php the_author_meta('google_plus'); ?>?rel=author" alt="Google+" title="Google Plus" rel="nofollow">Google+</a>
								</li><!-- Post Auhtor Google Plus -->
							<?php } ?>	

							<?php if (get_the_author_meta('github')) { ?>
								<li class="github">
									<a href="<?php the_author_meta('github'); ?>" alt="Github" title="Github" rel="nofollow">Github</a>
								</li><!-- Post Author Github -->
							<?php } ?>	

							</ul>
						</div><!-- Author Contact Info Ends -->
					</div>

					<nav class="post-navigation clear">
					
						<div class="left-column previous-post">
							<?php previous_post_link(); ?>
						</div>
					
						<div class="right-column next-post">
							<?php next_post_link(); ?>
						</div>
					
					</nav> <!-- Article Navigation Ends-->
					
					<div class="article-comments-container">
						<ul>
							<?php comments_template(); ?>
						</ul>
						<div class="comment-form-container">
							<?php comment_form(); ?>
						</div><!-- Comment Form Ends -->
					</div><!-- Single Article Comment Ends -->

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
		<!-- Footer Ends -->
	</div><!-- Wrap Ends -->
	<a href="#" id="backToTopBtn"></a>
</body>
</html>
