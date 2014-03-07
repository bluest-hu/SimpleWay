<?php get_header();?>
		<div class="main">
			<div class="content clear">
				<div class="author left-column">
					<div class="author-info card">
						<?php echo get_avatar( get_the_author_email(), 200 ); ?>
						<?php get_most_comments_friends(array(
							'number' => 30
						)) ?>
					</div>
				</div><!-- Post Ends -->

				<aside class="aside right-column"><!-- Right Aside Begain -->
					<?php get_sidebar();?>
				</aside><!-- Right Aside Ends -->
			</div><!-- Content Ends -->
		</div><!-- Main Ends -->
		<!-- Footer Begain -->
		<?php get_footer(); ?>
