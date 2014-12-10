<article class="article card" id="post-<?php the_ID();?>"><!-- Article Begain -->
    <div class="article-top-column post-meta-container clear">
        <div class="left-column author-avatar-container"><!-- Author Avastar Container Begain -->
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="文章作者：<?php the_author(); ?>" class="author-avatar"><!-- Article Author Begain -->
                <?php echo my_avatar( get_the_author_email(), 50 ); ?>
            </a><!-- Article Author Ends -->
        </div><!-- Author Avastar Container Ends -->

        <div class="left-column fix-width">
            <h1 class="article-title top-column"><!-- Article Title Begain -->
                <a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title(); ?></a>
            </h1><!-- Article Title End -->
            <div class="bottom-column post-meta clear">
                <div class="left-column article-category">
                    <span class="icons ion-ios7-folder-outline"></span>
                    <div class="clear left-column article-category-list">
                        <?php the_category(' / ') ?>
                    </div>
                </div><!--Category End -->
                <div class="right-column article-time"><span class="icons ion-ios7-clock-outline"></span><time class="article-time"><?php the_time('Y-m-d') ?></time></div><!--Article Time End-->
            </div><!-- Left Column Begain -->
        </div><!-- Left Column Ends -->
    </div><!-- Article Top Column Ends -->

    <div class="entry clear">
        <?php the_content("继续阅读 >>"); ?>
    </div><!-- End Blog Entry -->

    <div class="article-column-bottom post-meta clear">
        <div class="article-tags left-column">
            <span class="icons ion-ios7-pricetags-outline"></span>
            <div class="tag-list left-column clear">
                <?php the_tags("", " "); ?>
            </div>
        </div><!-- Article Tags End -->
        <div class="article-comment right-column">
            <span class="icons ion-ios7-chatboxes-outline"></span><?php comments_popup_link('木有评论', '1 条评论', '% 条评论'); ?>
        </div><!-- Comments End -->
    </div><!-- Article Bottom Column Ends -->
</article><!-- Article Ends -->