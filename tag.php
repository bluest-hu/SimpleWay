<?php get_header();?>
		<div class="main">
			<div class="content clear">
				<div class="post left-column">
					<div class="card tag description">
						<div class="description-content clear">
							<img class="description-image left-column" src="<?php echo get_stylesheet_directory_uri(); ?>/image/logo.png" alt="标签 <?php single_tag_title("", true); ?> 下的文章" title="标签 <?php single_tag_title("", true); ?> 下的文章">
							<div class="descripton-text-content">
								<h2 class="description-title ion-ios7-pricetags-outline">
									标签 <q><?php single_tag_title("", true); ?></q> 下的文章						
								</h2>
								<div class="description-text">
									<?php 
									if (tag_description() != '') {
										echo tag_description();
									} else {
										echo "<p>暂时还没有关于 <q>" . single_tag_title("", false) . "</q> 的文字介绍，博主太懒啦，要打小 PP 哦!</p>";
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
		<?php get_footer(); ?>