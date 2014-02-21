 <div class="tab">
    <div class="tab-switcher">
        <ul class="tab-swither-container">
            <li class="current tab-switcher-list">日历</li>
            <li class="tab-switcher-list">近期文章</li>
            <li class="tab-switcher-list">标签云</li>
        </ul>
    </div>
    <div class="tab-container">
        <ul class="tab-content">
            <li class="tab-content-list current">
                <ul>
                    <?php get_calendar();?>                                     
                </ul>
            </li>
            <li class="tab-content-list">
            	<?php get_archives_link(); ?>
            </li>
            <li class="tab-content-list">
            	<?php wp_tag_cloud(); ?>
            </li>
        </ul>
    </div>
</div><!-- Tab Switcher Ends -->  
<?php



?>
