<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get the Plugin Data.
 */
function astro_sb_plugin_data($var = false) {
	$plugin_file = plugin_dir_path(__FILE__) . 'astro-sticky-buttons.php';
	if( !function_exists('get_plugin_data') ){
		require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	}
	$get_plugin_data = get_plugin_data( $plugin_file );
	if ($var) { $get_plugin_data = $get_plugin_data[$var]; }
	return $get_plugin_data;
}

/**
 * Set the plugin options names.
 */
function astro_sb_option_names($tab = false) {

	$option_names = false;

	switch ($tab) {
		case 'settings' :
			$option_names_enable = array();

			$args = array( 'public' => true );
			$post_types = get_post_types( $args );
			foreach ($post_types as $post_type) {
				$option_names_enable[ASTRO_SB_PREFIX . 'enable_' . $post_type] = ASTRO_SB_PREFIX . 'enable_' . $post_type;
			}

			$args = array( 'public' => true );
			$taxonomies = get_taxonomies( $args );
			foreach ($taxonomies as $taxonomy) {
				$option_names_enable[ASTRO_SB_PREFIX . 'enable_' . $taxonomy] = ASTRO_SB_PREFIX . 'enable_' . $taxonomy;
			}

			$option_names = array(
				ASTRO_SB_PREFIX . 'email' => ASTRO_SB_PREFIX . 'email',
				ASTRO_SB_PREFIX . 'telephone' => ASTRO_SB_PREFIX . 'telephone',
				ASTRO_SB_PREFIX . 'whatsapp' => ASTRO_SB_PREFIX . 'whatsapp',
				ASTRO_SB_PREFIX . 'facebook_messenger' => ASTRO_SB_PREFIX . 'facebook_messenger',
				ASTRO_SB_PREFIX . 'skype' => ASTRO_SB_PREFIX . 'skype',
				ASTRO_SB_PREFIX . 'twitter' => ASTRO_SB_PREFIX . 'twitter',
				ASTRO_SB_PREFIX . 'instagram' => ASTRO_SB_PREFIX . 'instagram',
				ASTRO_SB_PREFIX . 'facebook' => ASTRO_SB_PREFIX . 'facebook',
				ASTRO_SB_PREFIX . 'youtube' => ASTRO_SB_PREFIX . 'youtube',
				ASTRO_SB_PREFIX . 'tiktok' => ASTRO_SB_PREFIX . 'tiktok',
				ASTRO_SB_PREFIX . 'vimeo' => ASTRO_SB_PREFIX . 'vimeo',
				ASTRO_SB_PREFIX . 'pinterest' => ASTRO_SB_PREFIX . 'pinterest',
			);

			$option_names = array_merge($option_names_enable, $option_names);
			break;

		case 'layout' :
			$option_names = array(
				ASTRO_SB_PREFIX . 'position' => ASTRO_SB_PREFIX . 'position',
				ASTRO_SB_PREFIX . 'icon-margin-top' => ASTRO_SB_PREFIX . 'icon-margin-top',
				ASTRO_SB_PREFIX . 'icon-margin-right' => ASTRO_SB_PREFIX . 'icon-margin-right',
				ASTRO_SB_PREFIX . 'icon-margin-bottom' => ASTRO_SB_PREFIX . 'icon-margin-bottom',
				ASTRO_SB_PREFIX . 'icon-margin-left' => ASTRO_SB_PREFIX . 'icon-margin-left',
				ASTRO_SB_PREFIX . 'icon-padding' => ASTRO_SB_PREFIX . 'icon-padding',
				ASTRO_SB_PREFIX . 'icon-width' => ASTRO_SB_PREFIX . 'icon-width',
				ASTRO_SB_PREFIX . 'icon-font-size' => ASTRO_SB_PREFIX . 'icon-font-size',
				ASTRO_SB_PREFIX . 'icon-border-width' => ASTRO_SB_PREFIX . 'icon-border-width',
				ASTRO_SB_PREFIX . 'icon-border-style' => ASTRO_SB_PREFIX . 'icon-border-style',
				ASTRO_SB_PREFIX . 'icon-border-radius' => ASTRO_SB_PREFIX . 'icon-border-radius',
				ASTRO_SB_PREFIX . 'icon-box-shadow' => ASTRO_SB_PREFIX . 'icon-box-shadow',
				ASTRO_SB_PREFIX . 'custom-css' => ASTRO_SB_PREFIX . 'custom-css',
			);
			break;
	}

	return $option_names;
}

/**
 * Allowed values of the layout options shown as select boxes.
 */
function astro_sb_layout_choices( $option ) {
	switch ( $option ) {
		case 'position':
			return array( 'align-right', 'align-right-bottom', 'align-bottom', 'align-left-bottom', 'align-left' );
		case 'icon-border-style':
			return array( 'none', 'dashed', 'dotted', 'double', 'groove', 'hidden', 'inset', 'outset', 'ridge', 'solid' );
		case 'icon-box-shadow':
			return array( 'no', 'yes' );
	}
	return array();
}

/**
 * Return the sanitize callback of an option, from its name.
 */
function astro_sb_get_option_sanitize_callback( $option_name ) {
	$name = substr( $option_name, strlen( ASTRO_SB_PREFIX ) );

	if ( 0 === strpos( $name, 'enable_' ) ) {
		return 'astro_sb_sanitize_checkbox';
	}

	switch ( $name ) {
		case 'email':
			return 'sanitize_email';
		case 'position':
		case 'icon-border-style':
		case 'icon-box-shadow':
			return 'astro_sb_sanitize_layout_choice_' . str_replace( '-', '_', $name );
		case 'icon-margin-top':
		case 'icon-margin-right':
		case 'icon-margin-bottom':
		case 'icon-margin-left':
		case 'icon-padding':
		case 'icon-width':
		case 'icon-font-size':
		case 'icon-border-width':
		case 'icon-border-radius':
			return 'astro_sb_sanitize_pixels';
		case 'custom-css':
			return 'astro_sb_sanitize_custom_css';
	}

	// Telephone, WhatsApp, Skype and the social account names.
	return 'sanitize_text_field';
}

/**
 * Checkbox: 1 when checked, empty otherwise.
 */
function astro_sb_sanitize_checkbox( $value ) {
	return ( is_scalar( $value ) && '1' === (string) $value ) ? '1' : '';
}

/**
 * Size in pixels: a non-negative integer, or empty to use the default value.
 */
function astro_sb_sanitize_pixels( $value ) {
	if ( ! is_scalar( $value ) || ! is_numeric( $value ) ) {
		return '';
	}
	return (string) absint( $value );
}

/**
 * Select boxes of the layout: one of the values offered by the form, or empty.
 */
function astro_sb_sanitize_layout_choice( $option, $value ) {
	return ( is_string( $value ) && in_array( $value, astro_sb_layout_choices( $option ), true ) ) ? $value : '';
}

function astro_sb_sanitize_layout_choice_position( $value ) {
	return astro_sb_sanitize_layout_choice( 'position', $value );
}

function astro_sb_sanitize_layout_choice_icon_border_style( $value ) {
	return astro_sb_sanitize_layout_choice( 'icon-border-style', $value );
}

function astro_sb_sanitize_layout_choice_icon_box_shadow( $value ) {
	return astro_sb_sanitize_layout_choice( 'icon-box-shadow', $value );
}

/**
 * Custom CSS: printed inside a <style> element, so HTML tags (such as </style>) are removed.
 */
function astro_sb_sanitize_custom_css( $value ) {
	return is_string( $value ) ? wp_strip_all_tags( $value ) : '';
}

/**
 * Custom CSS, when the settings are saved: only users allowed to edit the CSS of the site (the
 * edit_css capability of the core Additional CSS) can change it. The others, such as the site
 * administrators of a multisite network, keep the value already saved.
 */
function astro_sb_sanitize_custom_css_on_save( $value ) {
	if ( ! current_user_can( 'edit_css' ) ) {
		return astro_sb_sanitize_custom_css( get_option( ASTRO_SB_PREFIX . 'custom-css', '' ) );
	}
	return astro_sb_sanitize_custom_css( $value );
}

/**
 * Read an option through its sanitize callback, so that values saved by the previous versions
 * are checked too.
 */
function astro_sb_get_option( $option_name ) {
	return call_user_func( astro_sb_get_option_sanitize_callback( $option_name ), get_option( $option_name ) );
}

/**
 * Register the settings of a tab, each one with its sanitize callback.
 */
function astro_sb_register_tab_settings( $option_group, $tab ) {
	$option_names = astro_sb_option_names( $tab );
	if ( empty( $option_names ) ) {
		return;
	}

	foreach ( $option_names as $option_name ) {
		$sanitize_callback = astro_sb_get_option_sanitize_callback( $option_name );

		// The custom CSS is checked against the capability of the user who saves it.
		if ( 'astro_sb_sanitize_custom_css' === $sanitize_callback ) {
			$sanitize_callback = 'astro_sb_sanitize_custom_css_on_save';
		}

		register_setting( $option_group, $option_name, array(
			'type'              => 'string',
			'sanitize_callback' => $sanitize_callback,
		) );
	}
}

/**
 * Former uninstall callback: it did not delete the options, and it was registered from this file
 * instead of the main plugin file, so WordPress never ran it. The plugin now uses uninstall.php.
 *
 * @deprecated 1.4.3 No replacement: uninstall.php deletes the options.
 */
function astro_sb_unregister_option_names() {
	_deprecated_function( __FUNCTION__, '1.4.3' );
}

/**
 * Return the Astro Sticky Buttons shortcode.
 */
function astro_sb_shortcode_output() {

	// The front-end files are enqueued only where the buttons are displayed.
	astro_sb_enqueue_assets();

	// Get the Template
	$template_file = plugin_dir_path(__FILE__) . 'templates/astro-sticky-buttons.php';
	if (file_exists($template_file)) { // Check if the template file exists.
		ob_start();
		include($template_file);
		$content = ob_get_clean();
		return $content;
	}
}
add_shortcode('astro-sticky-buttons', 'astro_sb_shortcode_output');

/**
 * Return the custom Layout CSS classes.
 */
function astro_sb_get_custom_layout() {

	$arr = array();

	//Position
	$position = array();
	$position_element = astro_sb_get_option(ASTRO_SB_PREFIX.'position');
	if (!empty($position_element)) {
		$position[] = 'color:'.$position_element;
	}
	if (!empty($position)) {
		$position = implode(';', $position);
		$arr[] = array('class' => '.astro_sb', 'prop' => $position);
	}

	//Icon
	$icon = array();
	$icon_margin_top = astro_sb_get_option(ASTRO_SB_PREFIX.'icon-margin-top');
	if ($icon_margin_top != '') {
		$icon[] = 'margin-top:'.$icon_margin_top.'px';
	}
	$icon_margin_right = astro_sb_get_option(ASTRO_SB_PREFIX.'icon-margin-right');
	if ($icon_margin_right != '') {
		$icon[] = 'margin-right:'.$icon_margin_right.'px';
	}
	$icon_margin_bottom = astro_sb_get_option(ASTRO_SB_PREFIX.'icon-margin-bottom');
	if ($icon_margin_bottom != '') {
		$icon[] = 'margin-bottom:'.$icon_margin_bottom.'px';
	}
	$icon_margin_left = astro_sb_get_option(ASTRO_SB_PREFIX.'icon-margin-left');
	if ($icon_margin_left != '') {
		$icon[] = 'margin-left:'.$icon_margin_left.'px';
	}
	$icon_padding = astro_sb_get_option(ASTRO_SB_PREFIX.'icon-padding');
	if ($icon_padding != '') {
		$icon[] = 'padding:'.$icon_padding.'px';
	}
	$icon_width = astro_sb_get_option(ASTRO_SB_PREFIX.'icon-width');
	if ($icon_width != '') {
		$icon[] = 'width:'.$icon_width.'px';
		$icon[] = 'height:'.$icon_width.'px';
	}
	$icon_font_size = astro_sb_get_option(ASTRO_SB_PREFIX.'icon-font-size');
	if ($icon_font_size != '') {
		$icon[] = 'font-size:'.$icon_font_size.'px';
	}
	$icon_border_width = astro_sb_get_option(ASTRO_SB_PREFIX.'icon-border-width');
	if ($icon_border_width != '') {
		$icon[] = 'border-width:'.$icon_border_width.'px';
	}
	$icon_border_style = astro_sb_get_option(ASTRO_SB_PREFIX.'icon-border-style');
	if ($icon_border_style != '') {
		$icon[] = 'border-style:'.$icon_border_style;
	}
	$icon_border_radius = astro_sb_get_option(ASTRO_SB_PREFIX.'icon-border-radius');
	if ($icon_border_radius != '') {
		$icon[] = 'border-radius:'.$icon_border_radius.'px';
	}
	$icon_box_shadow = astro_sb_get_option(ASTRO_SB_PREFIX.'icon-box-shadow');
	if ($icon_box_shadow == 'no') {
		$icon[] = 'box-shadow:none';
	}
	if (!empty($icon)) {
		$icon = implode(';', $icon);
		$arr[] = array('class' => '.astro_sb a', 'prop' => $icon);
	}

	$custom_css = astro_sb_get_option(ASTRO_SB_PREFIX.'custom-css');

	$str = false;
	if (!empty($arr) || !empty($custom_css)) {
		foreach ($arr as $item) {
			$str .= $item['class'].'{'.$item['prop'].';}';
		}
		$str .= $custom_css;
	}

	return $str;
}

/**
 * Whether the sticky buttons are displayed on the current page.
 */
function astro_sb_buttons_enabled() {

	//Default value
	$enable = false;

	if ( is_singular() || is_single() || is_page() ) {
		$post_type = get_post_type();
		if ( $post_type ) {
			$option_value = get_option('astro_sb_enable_' . $post_type);
			if ($option_value == 1) {
				$enable = true;
			}
		}
	}

	if ( is_category() || is_tax() || is_tag() ) {
		$obj = get_queried_object();
		if ($obj) {
			$term_taxonomy = $obj->taxonomy;
			$option_value = get_option('astro_sb_enable_' . $term_taxonomy);
			if ($option_value == 1) {
				$enable = true;
			}
		}
	}

	if ( is_archive() ) {
		$enable = true;
	}

	return $enable;
}

/**
 * Display the sticky buttons in the footer of the pages where they are enabled.
 */
function astro_sb_get_current_post_type() {
	if ( astro_sb_buttons_enabled() ) {
		// The template escapes every value it prints.
		echo astro_sb_shortcode_output(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}else{
		return false;
	}
}
add_action('wp_footer', 'astro_sb_get_current_post_type');
