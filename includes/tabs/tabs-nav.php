<?php
if( ! is_admin() ) {
	return;
}

function astro_sb_tabs_nav($panel) {

	// active tab class
	$active_class = 'nav-tab-active';

	echo '<nav class="nav-tab-wrapper">';

	echo '<a href="?page='.ASTRO_SB_TEXTDOMAIN.'&amp;tab=settings" class="nav-tab ';
	if ($panel == 'settings') { echo $active_class; }
	echo '">' . esc_html__('Settings', 'astro-sticky-buttons' ) . '</a>';

	echo '<a href="?page='.ASTRO_SB_TEXTDOMAIN.'&amp;tab=layout" class="nav-tab ';
	if ($panel == 'layout') { echo $active_class; }
	echo '">' . esc_html__('Layout', 'astro-sticky-buttons' ) . '</a>';

	echo '<a href="?page='.ASTRO_SB_TEXTDOMAIN.'&amp;tab=support" class="nav-tab ';
	if ($panel == 'support') { echo $active_class; }
	echo '">' . esc_html__('Support', 'astro-sticky-buttons' ) . '</a>';

	echo '</nav>';

}