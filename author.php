<?php get_header();?>

		<div class="main-content clear" id="mainContent">
			<div class="main-left-part left-column">
				<div class="author-page" id="authorPage">
					<div class="card ">
						<div class="author-avatar-wrap radius-round overflow-hidden">
							<?php echo get_avatar(get_the_author_meta('email'), 200 ); ?>
						</div>
					</div>

					<div class="card">
						<dl>
							<dd>文章数目</dd>
							<dt><?php echo the_author_posts(); ?></dt>
						</dl>

						<dl>
							<dd>发表评论数目</dd>
							<dt><?php echo '' ?></dt>
						</dl>
					</div>

					<div class="card">
						<?php
						//
						//	["comment_ID"]=>
						//  string(5) "15321"
						//	["comment_post_ID"]=>
						//  string(4) "3196"
						//	["comment_author"]=>
						//  string(6) "深蓝"
						//	["comment_author_email"]=>
						//  string(19) "ihuguowei@gmail.com"
						//	["comment_author_url"]=>
						//  string(25) "http://www.linkdigger.org"
						//	["comment_author_IP"]=>
						//  string(3) "::1"
						//	["comment_date"]=>
						//  string(19) "2016-10-06 05:09:25"
						//	["comment_date_gmt"]=>
						//  string(19) "2016-10-05 21:09:25"
						//	["comment_content"]=>
						//  string(12) "DASD SADA SA"
						//	["comment_karma"]=>
						//  string(1) "0"
						//	["comment_approved"]=>
						//  string(1) "1"
						//	["comment_agent"]=>
						//  string(110) "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/53.0.2785.116 Safari/537.36"
						//	["comment_type"]=>
						//  string(0) ""
						//	["comment_parent"]=>
						//  string(1) "0"
						//	["user_id"]=>
						//  string(1) "1"
						//	["children":protected]=>
						//  NUL
						$comments = get_comments(array(
							'author_email'=> get_the_author_meta('email')
						));

						?>
						<ul>
							<?php
							foreach ($comments as $index => $comment ) {
								?>
								<li>
									<a href=""><?php echo $comment->comment_author; ?></a>
									<div><?php echo $comment->comment_content; ?></div>
								</li>

								<?php
							}
							?>
						</ul>

					</div>
				</div><!-- Author Page Ends -->
            </div>

            <aside class="main-right-aside right-column" id="mainRightAside">
                <?php get_sidebar();?>
            </aside>
		</div>
		<?php get_footer(); ?>

	</div>
<body>
