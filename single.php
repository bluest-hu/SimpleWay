<?php get_header();?>
		<div class="main">
			<div class="content clear">
				<div class="post left-column">
			<?php if(have_posts()):?>
				<?php while (have_posts()):the_post();?>
					<?php include( TEMPLATEPATH . '/article.php'); ?>
				<?php endwhile;?>
					<div class="author-info card">
						<div class="top-column clear">
							<div class="author-avatar left-column">
								<?php echo my_avatar( get_the_author_email(), 80 ); ?>
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
									<a href="<?php the_author_meta('user_url'); ?>" title="主页" rel="nofollow">主页</a>
								</li><!-- Post Author Website -->
							<?php } ?>

							<?php if (get_the_author_meta('user_email')) { ?>
								<li class="email">
									<a href="mailto:<?php the_author_email(); ?>" title="e-mail" rel="nofollow" >邮箱</a>
								</li><!-- Post Author E-mail -->
							<?php } ?>	
							
							<?php if (get_the_author_meta('twitter')) { ?>
								<li class="twitter">
									<a href="<?php the_author_meta('twitter'); ?>"" rel="nofollow" title="Twitter">Twitter</a>
								</li><!-- Post Author Twitter -->
							<?php } ?>

							<?php if (get_the_author_meta('facebook')) { ?>
								<li class="facebook">
									<a href="<?php the_author_meta('facebook'); ?>"k" title="Facebook" rel="nofollow">Facebook</a>
								</li><!-- Post Author Facebook -->
							<?php } ?>
							
							<?php if (get_the_author_meta('google_plus')) { ?> 
								<li class="google-plus">
									<a href="<?php the_author_meta('google_plus'); ?>?rel=author" title="Google Plus" rel="nofollow">Google+</a>
								</li><!-- Post Auhtor Google Plus -->
							<?php } ?>	

							<?php if (get_the_author_meta('github')) { ?>
								<li class="github">
									<a href="<?php the_author_meta('github'); ?>" title="Github" rel="nofollow">Github</a>
								</li><!-- Post Author Github -->
							<?php } ?>	

							</ul>
						</div><!-- Author Contact Info Ends -->
					</div>

					<div  class="related-post card">
						<div id="hm_t_23962"></div>
					</div>

					<nav class="post-navigation clear">
						<div class="left-column previous-post-wrap" >
							<div class="previous-post ion-chevron-left">
								<?php previous_post_link(" %link"); ?>
							</div>
						</div><!-- previous post -->
						<div class="right-column next-post-wrap">
							<div class="next-post ion-chevron-left-after">
								<?php next_post_link(" %link"); ?>
							</div>
						</div><!-- next post -->
					</nav> <!-- Article Navigation Ends-->
					
					<div class="article-comments-container card">
						<ul>
							<?php comments_template(); ?>
						</ul>
						
						<div class="comment-form-container">
							<?php comment_form(); ?>  
						 </div><!--Comment Form Ends -->
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
		<?php get_footer(); ?>