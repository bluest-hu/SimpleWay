<?php get_header();?>
        <div class="main-content clear" id="mainContent">
            <div class="main-left-part post-list left-column">
				<div class="author left-column">
					<div class="author-info card">
						<?php echo get_avatar( get_the_author_email(), 200 ); ?>
					</div>
					<div class="other-authors card">
						<?php echo the_author_posts(); ?>
					</div>
				</div><!-- Post Ends -->
            </div>
				
            <aside class="main-right-aside right-column" id="mainRightAside">
                <?php get_sidebar();?>
            </aside>
		</div>
		<?php get_footer(); ?>
