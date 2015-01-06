		<footer class="main-footer">
			<div class="main-footer-content">
				<?php
				wp_nav_menu( array(
					'theme_location'  => 'footer_menu',
					'menu'            => 'footer-menu',
					'container'       => 'nav',
					'container_class' => 'footer-nav-wrap',
					'container_id'    => 'footerNavWrap',
					'menu_class'      => 'menu-wrap',
					'menu_id'         => 'bottomMenu',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 1,
					'walker'          => ''
				));
				?>
				<div class="column clear">
					<p class="copy-right left-column"><!-- Copy Right Begin -->
						Copyright © <a class="blog-link" href="" title="链递阁" >链递阁</a>
					</p><!-- Copy Right Ends -->
					<p class="designer right-column"><!-- Blog Designer Begin -->
						<a href="<?php echo wp_get_theme()->display('ThemeURI');?>" title="访问主题页面"><?php echo wp_get_theme()->display('Name');?></a><!--
					 --> V <?php echo wp_get_theme()->display('Version');?><!--
					 -->&nbsp;|&nbsp;<!--
					 -->Designed By <!-- 
					 --><span class="heart">❤</span>&nbsp;<?php echo wp_get_theme()->display('Author'); ?>
					</p><!-- Blog Designer Ends -->
				</div>
				<p class="powered-by"><!-- Blog Powered By Begin -->
					Powered By <a class="wordpress" href="http://www.wordpress.org" title="wordpress"><span class="wordpress-logo"></span>WordPress</a>
				</p><!-- Blog Powered By Ends -->
			</div>
			<a href="#" id="backToTopBtn" class="back-to-top-btn"></a>
			<?php wp_footer(); ?>
		</footer><!-- Footer Ends -->
	</div><!-- Wrap Ends -->
</body>
<!-- jQuery -->
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/script/jquery-2.0.3.min.js"></script>
<!-- 博客所用 JavaScript 文件 -->
<script type="text/javascript" async="async" src="<?php echo get_stylesheet_directory_uri(); ?>/script/script.min.js"></script>
<?php if (get_option('simple_way_analytics')!="") {
	echo trim(stripslashes(get_option('simple_way_analytics')));
}?>
<?php if ( is_single() ) { 
	if (get_option('simple_way_single_script') != '') {
		echo trim(stripslashes(get_option('simple_way_single_script')));
	}
} ?>
</html>