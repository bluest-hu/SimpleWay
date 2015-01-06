<nav class="top-navigation left-column">
	<?php
	wp_nav_menu( array(
		'theme_location'  => 'header_menu',
		'menu'            => 'header-nemu',
		'container'       => 'div',
		'container_class' => 'top-nav-container',
		'container_id'    => 'topNavgationContainer',
		'menu_class'      => 'top-menu',
		'menu_id'         => 'topMenu',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 1,
		'walker'          => ''
	));
	?>
</nav><!-- Blog Header Navigation Ends -->