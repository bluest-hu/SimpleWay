<?php get_sidebar();?>

 <div class="tab">
    <div class="tab-switcher">
        <ul class="tab-swither-container">
            <li class="current tab-switcher-list">最近评论</li>
            <li class="tab-switcher-list">友链</li>
            <li class="tab-switcher-list">评论墙</li>
        </ul>
    </div>
    <div class="tab-container">
        <ul class="tab-content">
            <li class="tab-content-list current">
                <ul class="new-comments">
                    <h3 class="widget-title">最近的评论！</h3>
                    <?php simpleway_newcomments(6); ?>
                </ul>
            </li>
            <li class="tab-content-list">
                <ul class="blog roll">
                    <h3 class="widget-title">有情才链接！</h3>
            	   <?php wp_list_bookmarks(array(
                        'orderby'          => 'count', // 排序方式'name' - Default、'id'、'slug'、'count'
                        'order'            => 'ASC',
                        'limit'            => -1,  // 显示的数目
                        'category'         => ' ', // 是否以分类形式显示
                        'exclude_category' => ' ', // 排除的分类
                        'category_name'    => ' ',  
                        'hide_invisible'   => 1,
                        'show_updated'     => 0,
                        'show_images'      => 1,
                        'echo'             => true,
                        'categorize'       => 1,
                        'title_li'         => __('Bookmarks'),
                        'title_before'     => '<h2>',
                        'title_after'      => '</h2>',
                        'category_orderby' => 'name',
                        'category_order'   => 'ASC',
                        'class'            => 'linkcat',
                        'category_before'  => '<li id=%id class=%class>',
                        'category_after'   => '</li>'
                   )); ?>
                </ul>
            </li>
            <li class="tab-content-list">
                <h3 class="widget-title">本月灌水王！</h3>
            	<?php echo get_most_comments_friends( array(
                    'number' => 20,
                    'size' => 40
                )); ?>
            </li>
        </ul>
    </div>
</div><!-- Tab Switcher Ends -->  