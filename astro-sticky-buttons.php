<?php
/*
 * Plugin Name:       Astro Sticky Buttons
 * Plugin URI:        https://wordpress.org/plugins/astro-sticky-buttons
 * Description:       Display your favourite sticky buttons to get in touch with your visitors and share your social channels.
 * Version:           1.4.3
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Alian Schiavoncini
 * Author URI:        https://www.alian.it
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       astro-sticky-buttons
 * Domain Path:       /languages
 */

if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class file inclusions.
 */
require_once(dirname(__FILE__) . '/includes/classes/class-astro-plugin-panel.php');

/**
 * File inclusions.
 */
require_once(dirname(__FILE__) . '/astro-sticky-buttons-common.php');

if ( is_admin() ) {
	require_once(dirname(__FILE__) . '/astro-sticky-buttons-admin.php');
}

/**
 * Plugin constants.
 */
define('ASTRO_SB_VERSION', '1.4.3');
define('ASTRO_SB_PREFIX', 'astro_sb_');
define('ASTRO_SB_TEXTDOMAIN', 'astro-sticky-buttons');

/**
 * Loading Text Domain.F
 */
add_action( 'init', 'astro_sb_load_textdomain' );
function astro_sb_load_textdomain() {
	load_plugin_textdomain( 'astro-sticky-buttons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 * Enqueue the front-end files, only on the pages that display the sticky buttons.
 * The [astro-sticky-buttons] shortcode enqueues them too, wherever it is used.
 */
add_action('wp_enqueue_scripts', 'astro_sb_enqueue_files');
function astro_sb_enqueue_files() {
	if ( astro_sb_buttons_enabled() ) {
		astro_sb_enqueue_assets();
	}
}

/**
 * Enqueue Font Awesome and the plugin styles, with the custom layout CSS.
 * When called after wp_head (shortcode in the content, buttons in the footer) WordPress prints
 * the styles in the footer.
 */
function astro_sb_enqueue_assets() {

	// Already enqueued: the inline CSS must not be added twice.
	if ( wp_style_is( 'astro-sticky-buttons', 'enqueued' ) ) {
		return;
	}

	$plugin_version = ASTRO_SB_VERSION;

	// Enqueue Font Awesome
	$fontawesome_css_url = plugin_dir_url( __FILE__ ) . 'vendors/fontawesome/css/fontawesome.min.css';
	wp_enqueue_style('astro-fontawesome', $fontawesome_css_url, array(), '6.4.0');
	$fontawesome_css_url = plugin_dir_url( __FILE__ ) . 'vendors/fontawesome/css/brands.css';
	wp_enqueue_style('astro-fontawesome-brands', $fontawesome_css_url, array(), '6.4.0');
	$fontawesome_css_url = plugin_dir_url( __FILE__ ) . 'vendors/fontawesome/css/solid.css';
	wp_enqueue_style('astro-fontawesome-solid', $fontawesome_css_url, array(), '6.4.0');

	// Enqueue main files
	wp_register_style( 'astro-sticky-buttons', plugin_dir_url( __FILE__ ) . 'css/astro-sticky-buttons.css', array(), $plugin_version );
	wp_enqueue_style( 'astro-sticky-buttons' );

	// Add custom CSS
	$custom_css = astro_sb_get_custom_layout();
	if (!empty($custom_css)) {
		wp_add_inline_style('astro-sticky-buttons', $custom_css);
	}

}

/**
 * Add Settings Link.
 */
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'astro_sb_add_plugin_page_settings_link');
function astro_sb_add_plugin_page_settings_link( $links ) {
	array_unshift(
		$links,
		'<a href="' .
		admin_url('admin.php?page=' . ASTRO_SB_TEXTDOMAIN ) .
		'">' . __('Settings', 'astro-sticky-buttons' ) . '</a>'
	);
	return $links;
}

/**
 * Activation check of the versions before 1.0.2: it no longer runs, since the version compared
 * is the current one.
 *
 * @deprecated 1.4.3 No replacement.
 */
function astro_sb_check_plugin_version() {
	_deprecated_function( __FUNCTION__, '1.4.3' );
}