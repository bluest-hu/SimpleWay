<?php 
/*
 * Template Name: Simple Way Archive
 * @author: Bluest  
 * @Blog  : http://bluest.me
 */
?>
<?php get_header();?>
		<div class="main-content clear" id="mainContent">
            <div class="main-left-part left-column">
                <div class="archive card">
                    <div class="archives-content">
                        <div class="title">
                            <h1>文章归档</h1>
                            <span class="bg"></span>
                        </div>
                        <div class="archive-time-line">
                            <?php
                            $previous_year 	= $year = 0;
                            $previous_month = $month = 0;
                            $ul_open 		= false;

                            $all_post = get_posts('numberposts=-1&orderby=post_date&order=DESC');

                            var_dump($all_post);

                            foreach ($all_post as $pos => $value) {
                                $year 	= mysql2date('Y', $post->post_date);
                                $month 	= mysql2date('n', $post->post_date);
                                $day 	= mysql2date('j', $post->post_date);
                            }

                            foreach($all_post as $post) {

                                $year 	= mysql2date('Y', $post->post_date);
                                $month 	= mysql2date('n', $post->post_date);
                                $day 	= mysql2date('j', $post->post_date);

                                if ( $year != $previous_year ) {
                                    echo "<div class=\"year\"><h2>"; the_time('Y'); echo "</h2></div>";
                                }

                                if ( $month != $previous_month ) {
                                    echo "<div class=\"month\"><h3>"; the_time('m'); echo "月</h3></div>";
                                }

                                $previous_month = $month;
                                $previous_year = $year;
                            ?>
                                <div class="article-lists">
                                    <span class="day"><?php the_time('d'); ?></span>
                                    <a class="article-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    <a class="comments" href="<?php comments_link(); ?>" title="查看 <?php the_title(); ?> 的评论"><?php echo get_comments_number(); ?></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div><!-- Post Ends -->
				
            <aside class="main-right-aside right-column" id="mainRightAside">
                <?php get_sidebar();?>
            </aside><!-- Right Aside Ends -->
        </div>
		</div>
		    <?php get_footer(); ?>
	    </div>
</body>
</html>