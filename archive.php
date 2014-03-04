<?php 
/*
 * Template Name: Archive
 * @author: Bluest  
 * @Blog  : http://bluest.me
 */
?>

<?php get_header();?>
		<div class="main">
			<div class="content clear">
				<div class="post left-column">
					<div class="myArchive">
						<ul>
						<?php
						/**
						 * WordPress分类存档页面
						 * 作者：露兜
						 * 博客：http://www.ludou.org/
						 * 最后修改：2012年8月27日
						 */
						$query = "SELECT 
							post_title, 
							ID, 
							post_name,
							slug, 
							wp_terms.term_id AS catID, 
							wp_terms.name AS categoryname
						FROM 
							wp_posts,
							wp_term_relationships, 
							wp_term_taxonomy, 
							wp_terms
						WHERE wp_posts.ID = wp_term_relationships.object_id
						AND wp_terms.term_id = wp_term_taxonomy.term_id
						AND wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
						AND wp_term_taxonomy.taxonomy = 'category'
						AND wp_posts.post_status = 'publish'
						AND wp_posts.post_type = 'post'
						ORDER BY wp_terms.term_id, wp_posts.post_date DESC";
						$categoryPosts = $wpdb->get_results();
						    $postID = 0;
						    if ( $categoryPosts ) :
						        $category = $categoryPosts[0]->catID;
						        foreach ($categoryPosts as $key => $mypost) :
						            if($postID == 0) {
						                echo '<li><strong>分类:</strong> <a title="'.$mypost->categoryname.'" href="'.get_category_link($mypost->catID).'">'.$mypost->categoryname."</a>\n";
						                echo '<ul>';
						            }
						           
						            if($category == $mypost->catID) {          
						?>
						    <li><a title="<?php echo $mypost->post_title; ?>" href="<?php echo get_permalink( $mypost->ID ); ?>"><?php echo $mypost->post_title; ?></a></li>
						<?php
						                $category = $mypost->catID;
						                $postID++;
						            }
						            else {
						                echo "</ul>\n</li>";
						                echo '<li><strong>分类:</strong> <a title="'.$mypost->categoryname.'" href="'.get_category_link($mypost->catID).'">'.$mypost->categoryname."</a>\n";
						                echo '<ul>';
						?>
						    <li><a title="<?php echo $mypost->post_title; ?>" href="<?php echo get_permalink( $mypost->ID ); ?>"><?php echo $mypost->post_title; ?></a></li>
						<?php
						                $category = $mypost->catID;
						                $postID = 1;
						            }
						        endforeach;
						    endif;
						    echo "</ul>\n</li>";
						?>
						<li><strong>页面</strong>
						<ul>
						<?php
						    // 读取所有页面
						    $mypages = $wpdb->get_results("
						        SELECT post_title, post_name, ID
						        FROM {$wpdb->prefix}posts
						        WHERE post_status = 'publish'
						        AND post_type = 'page'");
						    if ( $mypages ) :
						        foreach ($mypages as $mypage) :
						?>
						    <li><a title="<?php echo $mypage->post_title; ?>" href="<?php echo get_permalink( $mypage->ID ); ?>"><?php echo $mypage->post_title; ?></a></li>
						    <?php endforeach; echo "</ul>\n</li>"; endif; ?>
						</ul>
						<p><a href="http://www.ludou.org/sitemap.xml">查看 sitemap.xml</a></p>
						</div>
				</div><!-- Post Ends -->
				
				<aside class="aside right-column"><!-- Right Aside Begain -->
					<?php get_sidebar();?>
				</aside><!-- Right Aside Ends -->
			</div><!-- Content Ends -->
		</div><!-- Main Ends -->
		<!-- Footer Begain -->
		<?php get_footer(); ?>
		<!-- Footer Ends -->
	</div><!-- Wrap Ends -->
</body>
</html>