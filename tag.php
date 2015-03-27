<?php get_header();?>
		<div class="main-content clear" id="mainContent">
			<div class="main-left-part post-list left-column">
				<div class="post-list left-column">
					<!-- tag 描述 -->
					<div class="description-card card">
						<div class="desc-content tag-desc-content clear">
							<img class="desc-image left-column" src="<?php echo get_stylesheet_directory_uri(); ?>/image/logo.png" alt="标签 <?php single_tag_title("", true); ?> 下的文章" title="标签 <?php single_tag_title("", true); ?> 下的文章">
							<div class="desc-text-wrap">
								<h2 class="desc-title ion-ios-pricetags-outline">
									标签 <q><?php single_tag_title("", true); ?></q> 下的文章						
								</h2>
								<div class="desc-text">
									<?php 
									if (tag_description() != '') {
										echo tag_description();
									} else {
										echo "<p>暂时还没有关于 <q><b>" . single_tag_title("", false) . "</b></q> 的文字介绍，博主太懒啦，要打小 PP 哦!</p>";
									}
									?>
								</div>
							</div>
						</div>	
					</div>

			<?php if(have_posts()):?>
				<?php while (have_posts()):the_post();?>
					<?php include( TEMPLATEPATH . '/article.php'); ?>
				<?php endwhile;?>
				<nav class="post-page-nav">
					<?php page_navigation(8); ?>
				</nav> 
			</div>	
			<?php else:?>
				<article class="article" id="post-<?php the_ID();?>">
					<div>
						<h2><?php _e("Not Found");?></h2> 
					</div>
				</article>
			<?php endif;?>
				</div>
				
				<aside class="main-right-aside right-column" id="mainRightAside">
					<?php get_sidebar();?>
				</aside>

			</div>
		</div>

		<?php get_footer(); ?>
	</div><!-- Wrap Ends -->
	<a href="#" id="backToTopBtn"></a>
</body>
</html>