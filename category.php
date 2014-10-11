<?php get_header();?>
		<div class="main">
			<div class="content clear">
				<div class="post left-column">
					<div class="card tag description">
						<div class="description-content clear">
							<img class="description-image left-column" src="<?php echo get_stylesheet_directory_uri(); ?>/image/logo.png" alt="分类 <?php single_cat_title('', true); ?> 下的文章" title="分类 <?php single_cat_title('', true); ?> 下的文章">
							<div class="descripton-text-content">
								<h2 class="description-title">
									<span class="icons fi-book-bookmark"></span><q><?php single_cat_title('', true); ?></q> 下的文章						
								</h2>
								<div class="description-text">
									<?php 
									if (category_description()) {
										echo category_description();
									} else {
										echo "<p>暂时还没有关于分类 <q>" . single_cat_title("", false) . "</q> 的文字介绍，博主太懒啦，要打小 PP 哦!</P>";
									}
									?>
								</div>
							</div>
						</div><!-- Description Content Ends -->
					</div><!-- Tag Card Ends -->

			<?php if(have_posts()):?>
				<?php while (have_posts()):the_post();?>
					<article class="article card" id="post-<?php the_ID();?>"><!-- Article Begain -->
						<div class="article-top-column post-meta-container clear">
							<div class="left-column author-avatar-container"><!-- Author Avastar Container Begain -->
								<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="文章作者：<?php the_author(); ?>" class="author-avatar"><!-- Article Author Begain -->
									<?php echo my_avatar( get_the_author_email(), 50 ); ?>
								</a><!-- Article Author Ends -->
							</div><!-- Author Avastar Container Ends -->

							<div class="left-column fix-width">
								<h1 class="article-title top-column"><!-- Article Title Begain -->
									<a href="<?php the_permalink();?>" title="<?php the_title();?>">
										<?php the_title(); ?>
									</a>
								</h1><!-- Article Title End -->
								<div class="bottom-column post-meta clear">
									<div class="article-category left-column">
										<span class="icons fi-folder"></span><?php the_category(' / ') ?>
									</div><!--Category End -->
									<div class="right-column article-time">
										<span class="icons fi-clock"></span><time class="article-time"><?php the_time('Y-m-d') ?></time>
									</div><!--Article Time End-->
								</div><!-- Left Column Begain -->
							</div><!-- Left Column Ends -->
						</div><!-- Article Top Column Ends -->	
							
						<div class="entry clear">
							<?php the_content("继续阅读 >>"); ?>
						</div><!-- End Blog Entry -->

						<div class="article-column-bottom post-meta clear">
							<div class="article-tags left-column">
								<span class="icons fi-bookmark left-column"></span>
								<div class="tag-list left-column">
									<?php the_tags("", " "); ?>
								</div>	
							</div><!-- Article Tags End -->
							<div class="article-comment right-column">
								<span class="icons fi-comments"></span><?php comments_popup_link('木有评论', '1 条评论', '% 条评论'); ?>
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
		<!-- Footer Ends -->
	</div><!-- Wrap Ends -->
	<a href="#" id="backToTopBtn"></a>
</body>
</html>