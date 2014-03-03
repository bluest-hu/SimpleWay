		<footer class="footer">
			<div class="content">
				<nav class="navigation">
					<?php
					wp_nav_menu( array(
						'theme_location'  => 'footer_menu',
						'menu'            => '',
						'container'       => 'div',
						'container_class' => 'navigation-container',
						'container_id'    => 'footerNavigationContainer',
						'menu_class'      => 'menu',
						'menu_id'         => 'topMenu',
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
				</nav>
				<div class="column clear">
					<p class="copy-right left-column"><!-- Copy Right Begain -->
						Copyright 
						© <a href="" alt="链递阁" >链递阁</a>
					</p><!-- Copy Right Ends -->
					<p class="designer right-column"><!-- Blog Designer Begain -->
						<a href="<?php echo wp_get_theme()->display('ThemeURI');?>" alt="访问主题页面" title="访问主题页面"><?php echo wp_get_theme()->display('Name');?></a>
						V<?php echo wp_get_theme()->display('Version');?>
						&nbsp;|&nbsp;
						Designed By 
						<span class="heart">❤</span>&nbsp;<?php echo wp_get_theme()->display('Author'); ?>
					</p><!-- Blog Designer Ends -->
				</div>
				<p class="powered-by"><!-- Blog Powered By Begain -->
					Powered By 
					<a href="http://www.wordpress.org"><span class="wordpress-logo"></span>WordPress</a>
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
<!-- Google Analytics Begain -->
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-22609002-1', 'linkdigger.org');
	ga('send', 'pageview');
</script>
<!-- Google Analytics Ends -->
<!-- Baidu TONGJI Begain -->
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F4496a45676f90fa733814a1e011e657a' type='text/javascript'%3E%3C/script%3E"));
</script>
<!-- Baidu TONGJI Ends -->

<?php if ( is_single() ) { ?>
<script>
document.write(unescape('%3Cdiv id="hm_t_23962"%3E%3C/div%3E%3Cscript charset="utf-8" src="http://crs.baidu.com/t.js?siteId=4496a45676f90fa733814a1e011e657a&planId=23962&async=0&referer=') + encodeURIComponent(document.referrer) + '&title=' + encodeURIComponent(document.title) + '&rnd=' + (+new Date) + unescape('"%3E%3C/script%3E'));
</script>
<script>
window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"slide":{"type":"slide","bdImg":"0","bdPos":"left","bdTop":"100"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
</script>
<?php } ?>
</html>