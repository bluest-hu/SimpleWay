<div class="post-wrap <?php echo is_single()? "single-post-wrap": "";?> card"  <?php echo is_single()? 'id="singlePostWrap"': "";?>>
    <?php 
    if ( is_single() ) {
    ?> 
    <div class="post-thumbnail-wrap">
        <img class="thumbnail" src="<?php echo get_post_thumbnail_url($post_id, ''); ?>"> 
        <span class="thumbnail-cover"></span>
    </div>
    <?php
    }
    ?>
    <article class="post <?php echo is_single()? "single-post": "";?>" id="post-<?php the_ID();?>"><!-- Post Begin -->
        <div class="post-top-column post-meta-wrap clear">
            <div class="left-column author-avatar-wrap"><!-- Author Avastar Wrap Begin -->
                <a class="author-avatar" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="文章作者：<?php the_author(); ?>" alt="文章作者：<?php the_author(); ?>" ><!-- Article Author Begain -->
                    <?php echo my_avatar( get_the_author_email(), 50, ""); ?>
                </a><!-- Article Author Ends -->
            </div><!-- Author Avastar Wrap Ends -->
            <div class="left-column fix-width">
                <h1 class="post-title top-column"><!-- post Title Begain -->
                    <a class="post-url" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title(); ?></a>
                </h1><!-- post Title End -->
                <div class="bottom-column post-meta clear">
                    <div class="left-column post-category clear">
                        <span class="icons ion-ios7-folder-outline"></span>
                        <?php the_category(' / ') ?>
                    </div><!--Category End -->
                    <div class="right-column post-time"><span class="icons ion-ios7-clock-outline"></span><time class="post-time-date"><?php the_time('Y-m-d') ?></time></div><!--post Time End-->
                </div><!-- Left Column Begin -->
            </div><!-- Left Column Ends -->
        </div><!-- post Top Column Ends -->

        <div class="entry clear">
            <?php the_content("继续阅读 >>"); ?>
        </div><!-- End Blog Entry -->

        <div class="post-column-bottom post-meta clear">
            <div class="post-tags left-column clear">
                <span class="icons ion-ios7-pricetags-outline"></span>
                <div class="tag-list clear">
                    <?php the_tags("", " "); ?>
                </div>
            </div><!-- post Tags End -->
            <div class="post-comment right-column">
                <span class="icons ion-ios7-chatboxes-outline"></span><?php comments_popup_link('木有评论', '1 条评论', '% 条评论'); ?>
            </div><!-- Comments End -->
        </div><!-- post Bottom Column Ends -->
    </article><!-- post Ends -->
</div>
