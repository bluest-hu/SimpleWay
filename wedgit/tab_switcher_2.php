<?php get_sidebar();?>
 <div class="tab">
    <div class="tab-switcher">
        <ul class="tab-swither-container">
            <li class="current tab-switcher-list">日历</li>
            <li class="tab-switcher-list">近期文章</li>
            <li class="tab-switcher-list">标签云</li>
            <li class="tab-switcher-list">评论墙</li>
        </ul>
    </div>
    <div class="tab-container">
        <ul class="tab-content">
            <li class="tab-content-list current">
                     
                </ul>
            </li>
            <li class="tab-content-list">
            	<ul>
            		<?php get_archives('postbypost','10','custom','<li>','</li>'); ?>
            	</ul>
            </li>
            <li class="tab-content-list">
            	<?php wp_tag_cloud(); ?>
            </li>
            <li class="tab-content-list">
            	<?php echo get_most_comments_friends(array()); ?>
            </li>
        </ul>
    </div>
</div><!-- Tab Switcher Ends -->  