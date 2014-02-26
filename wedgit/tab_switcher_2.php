<?php get_sidebar();?>

 <div class="tab">
    <div class="tab-switcher">
        <ul class="tab-swither-container">
            <li class=" tab-switcher-list">最近评论</li>
            <li class="tab-switcher-list current">友链</li>
            <li class="tab-switcher-list">评论墙</li>
        </ul>
    </div>
    <div class="tab-container">
        <ul class="tab-content">
            <li class="tab-content-list ">
                <h3 class="widget-title">最近的评论！</h3>
                <ul class="new-comments">
                    <?php simpleway_newcomments(6); ?>
                </ul>
            </li>
            <li class="tab-content-list current">
                <?php wp_list_bookmarks(array(
                    'orderby'          => 'name',
                    'order'            => 'ASC',
                    'limit'            => -1,
                    'category'         => ' ',
                    'exclude_category' => ' ',
                    // 'category_name'    => ' ',
                    'hide_invisible'   => 1,
                    'show_updated'     => 0,
                    'show_description' => 0,
                    'show_name'        => 1,
                    'echo'             => 1,
                    'categorize'       => 1,
                    // 'title_li'         => __('Bookmarks'),
                    'title_before'     => '<h3 class="widget-title">',
                    'title_after'      => '</h3>',
                    'category_orderby' => 'name',
                    'category_order'   => 'ASC',
                    'class'            => 'linkcat',
                    'category_before'  => '',
                    'category_after'   => ''
                )); ?> 
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