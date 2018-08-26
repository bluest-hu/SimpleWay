<?php get_header();?>
	<div class="main-content clear" id="mainContent">
		<div class="main-left-part main-content left-column">
	<?php if( have_posts()) :?>
		<?php while (have_posts()):the_post();?>
			<?php include( TEMPLATEPATH . '/article.php'); ?>
		<?php endwhile;?>
		<nav class="post-page-nav">
			<?php page_navigation(8); ?>
		</nav>
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
	<?php get_footer(); ?>
