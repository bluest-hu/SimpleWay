<?php get_header();?>
		<div class="main-content clear" id="mainContent">
			<div class="main-left-part post-list left-column" id="mainLeftPart">
				<div class="post-list left-column">
					<div class="card tag description">
						<div class="description-content clear">
							<img class="description-image left-column" src="<?php echo get_stylesheet_directory_uri(); ?>/image/logo.png" alt="分类 <?php single_cat_title('', true); ?> 下的文章" title="分类 <?php single_cat_title('', true); ?> 下的文章">
							<div class="description-text-content">
								<h2 class="description-title ion-ios7-albums-outline-after">
									分类 <q><?php single_cat_title('', true); ?></q> 下的文章						
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
					<?php include( TEMPLATEPATH . '/article.php'); ?>
				<?php endwhile;?>
				<nav class="page-navigation">
					<?php page_navigation(8); ?><!-- Article Navigation Ends-->
				</nav> <!-- Article Navigation Ends-->
			</div>
			<?php else:?>
				<article class="article" id="post-<?php the_ID();?>"><!-- Article Begain -->
					<div>
						<h2><?php _e("Not Found");?></h2> 
					</div>
				</article><!-- Article Ends -->
			<?php endif;?>
				</div><!-- Post Ends -->
				
				<aside class="main-right-aside right-column" id="mainRightAside"><!-- Right Aside Begain -->
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