<?php get_header();?>
		<div class="main">
			<div class="content clear">
				<div class="post left-column">
			<?php if( have_posts()) :?>
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
		<?php get_footer(  ); ?>
