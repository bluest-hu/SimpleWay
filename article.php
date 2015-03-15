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
    <article <?php echo is_single()? post_class("single-post") : post_class() ;?> id="post-<?php the_ID();?>">
        <div class="post-top-column post-meta-wrap clear">
            <div class="left-column author-avatar-wrap">
                <a class="author-avatar" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" title="文章作者：<?php the_author(); ?>" alt="文章作者：<?php the_author(); ?>" ><!-- Article Author Begain -->
                    <?php echo get_avatar( get_the_author_meta('email'), 50, ""); ?>
                    <span class="author-name"><?php the_author(); ?></span>
                </a>
            </div>
            <div class="left-column fix-width">
                <h1 class="post-title top-column">
                    <a class="post-url" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title(); ?></a>
                </h1>
                <div class="bottom-column post-meta clear">
                    <div class="left-column post-category clear">
                        <span class="icon ion-ios-folder-outline"></span>
                        <?php the_category(' / ') ?>
                    </div>
                    <div class="right-column post-time"><span class="icon ion-ios-clock-outline"></span><time class="post-time-date"><?php the_time('Y-m-d') ?></time></div><!--post Time End-->
                </div>
            </div>
        </div>
        <div class="entry clear">
            <?php the_content("继续阅读 >>"); ?>
        </div>
        <div class="post-column-bottom post-meta clear">
            <div class="post-tags left-column clear">
                <span class="icon ion-ios-pricetags-outline"></span>
                <div class="tag-list clear">
                    <?php the_tags("", " "); ?>
                </div>
            </div>
            <div class="post-comment right-column">
                <span class="icon ion-ios-chatboxes-outline"></span><?php comments_popup_link('木有评论', '1 条评论', '% 条评论'); ?>
            </div>
        </div>
    </article>
</div>
