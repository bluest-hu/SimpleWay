	<h3 class="comment-title">给文章 “<?php the_title()?>” 的评论</h3>
	<?php wp_list_comments( array(
		'walker'            => null,
		'max_depth'         => '',
		'style'             => 'ul',
		'callback'          => null,
		'end-callback'      => null,
		'type'              => 'all',
		'reply_text'        => 'Reply ↓',
		'page'              => '',
		'per_page'          => '',
		'avatar_size'       => 45,
		'reverse_top_level' => null,
		'reverse_children'  => '',
		'format'            => 'html5', //or xhtml if no HTML5 theme support
		'short_ping'        => false // @since 3.6
	)); 
	?> 

	
	
	