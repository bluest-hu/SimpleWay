
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
                <h3 class="widget-title">看这个月我又在偷懒了！</h3>
                <ul class="category-list">
                <?php wp_list_categories( array(
                    'show_option_all'    => '',
                    'orderby'            => 'name',
                    'order'              => 'ASC',
                    'style'              => 'list',
                    'show_count'         => 1,
                    'hide_empty'         => 1,
                    'use_desc_for_title' => 1,
                    'child_of'           => 0,
                    'feed'               => '',
                    'feed_type'          => '',
                    'feed_image'         => '',
                    'exclude'            => '',
                    'exclude_tree'       => '',
                    'include'            => '',
                    'hierarchical'       => TRUE, //是否显示缩进
                    'title_li'           => '',
                    'show_option_none'   => __('没有目录'),
                    'number'             => null,
                    'echo'               => 1,
                    'depth'              => 0,
                    'current_category'   => 0,
                    'pad_counts'         => 0,
                    'taxonomy'           => 'category',
                    'walker'             => null
                ) ); ?>                                 
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