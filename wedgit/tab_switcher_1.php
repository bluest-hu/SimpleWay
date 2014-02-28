 <li class="tab">
    <div class="tab-switcher">
        <ul class="tab-swither-container">
            <li class="current tab-switcher-list">近期评论</li>
            <li class="tab-switcher-list">近期文章</li>
            <li class="tab-switcher-list">标签云</li>
            <li class="tab-switcher-list">分类</li>
        </ul>
    </div>
    <div class="tab-container">
        <ul class="tab-content">
            <li class="tab-content-list current">
                <h3 class="widget-title">看这个月我又在偷懒了！</h3>
                <?php get_calendar();?>                                     
            </li>
            <li class="tab-content-list">
            	<h3 class="widget-title">排排队啦！</h3>
            	<ul class="article-cata">
            		<?php wp_get_archives( array(
                        'type'            => 'postbypost', //yearly、monthly - Default、daily、weekly、postbypost (posts ordered by post date)、alpha (same as postbypost but posts are ordered by post title)
                        'limit'           => 10,
                        'format'          => 'html', 
                        'before'          => '',
                        'after'           => '',
                        'show_post_count' => true,
                        'echo'            => 1,
                        'order'           => 'DESC'
                    ) ); ?>
            	</ul>
            </li>
            <li class="tab-content-list">
                <h3 class="widget-title">它们像云一样~~</h3>
            	<?php wp_tag_cloud(); ?>
            </li>
            <li class="tab-content-list">
            	<h3 class="widget-title">分分类啦！</h3>
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
            </li>
        </ul>
    </div>
</li><!-- Tab Switcher Ends -->  