<?php get_header();?>
    <div class="main-content clear" id="mainContent">
        <div class="main-left-part left-column">
            <div class="page card">
			<?php if(have_posts()):?>
				<?php while (have_posts()):the_post();?>
					<?php include( TEMPLATEPATH . '/article.php'); ?>
				<?php endwhile;?>

					<div class="author-info card">
						<div class="top-column clear">
							<div class="author-avatar left-column">
								<?php echo my_avatar( get_the_author_email(), 80 ); ?>
							</div>
					
							<div class="author-description right-column">
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

							<?php if (get_the_author_meta('facebook')) { ?>
								<li class="facebook">
									<a href="<?php the_author_meta('facebook'); ?>" alt="FaceBook" title="Facebook" rel="nofollow">Facebook</a>
								</li><!-- Post Author Facebook -->
							<?php } ?>
							
							<?php if (get_the_author_meta('google_plus')) { ?> 
								<li class="google-plus">
									<a href="<?php the_author_meta('google_plus'); ?>?rel=author" alt="Google+" title="Google Plus" rel="nofollow">Google+</a>
								</li><!-- Post Author Google Plus -->
							<?php } ?>	

							<?php if (get_the_author_meta('github')) { ?>
								<li class="github">
									<a href="<?php the_author_meta('github'); ?>" alt="Github" title="Github" rel="nofollow">Github</a>
								</li><!-- Post Author GitHub -->
							<?php } ?>	

							</ul>
						</div><!-- Author Contact Info Ends -->
					</div>

					<div  class="related-post">
						<div id="hm_t_23962"></div>
					</div>
					
					<div class="article-comments-container card">
						<ul>
							<?php comments_template(); ?>
						</ul>
						
						<div class="comment-form-container">
							<?php //comment_form(); ?>  
						 </div><!--Comment Form Ends -->
					</div><!-- Single Article Comment Ends -->

			<?php else:?>
					<article class="article" id="post-<?php the_ID();?>"><!-- Article Begin -->
						<div>
							<h2><?php _e("Not Found");?></h2> 
						</div>
					</article><!-- Article Ends -->
			<?php endif;?>
				</div><!-- Post Ends -->

                <aside class="main-right-aside right-column" id="mainRightAside">
					<?php get_sidebar();?>
				</aside><!-- Right Aside Ends -->
			</div><!-- Content Ends -->
		</div><!-- Main Ends -->
		<!-- Footer Begain -->
		<?php get_footer(); ?>