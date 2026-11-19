<?php
/**
 * Uninstall Astro Sticky Buttons: delete all the plugin options.
 *
 * WordPress runs this file when the plugin is deleted from the Plugins screen. On a multisite
 * network the options of every site are deleted.
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

/**
 * Delete the options of the current site that start with the plugin prefix: the names of the
 * enable_* options depend on the post types and taxonomies registered when they were saved.
 */
function astro_sb_uninstall_delete_options() {
	global $wpdb;

	// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- one-time lookup on uninstall, the options are deleted with delete_option().
	$option_names = $wpdb->get_col(
		$wpdb->prepare( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE %s", $wpdb->esc_like( 'astro_sb_' ) . '%' )
	);

	foreach ( $option_names as $option_name ) {
		delete_option( $option_name );
	}

	// The versions before 1.4.3 registered an uninstall callback from astro-sticky-buttons-common.php:
	// WordPress saved it under that file, so it never ran and its entry was never removed.
	$uninstallable_plugins = get_option( 'uninstall_plugins' );
	$legacy_file           = 'astro-sticky-buttons/astro-sticky-buttons-common.php';
	if ( is_array( $uninstallable_plugins ) && isset( $uninstallable_plugins[ $legacy_file ] ) ) {
		unset( $uninstallable_plugins[ $legacy_file ] );
		update_option( 'uninstall_plugins', $uninstallable_plugins );
	}
}

if ( is_multisite() ) {
	$astro_sb_site_ids = get_sites(
		array(
			'fields' => 'ids',
			'number' => 0,
		)
	);
	foreach ( $astro_sb_site_ids as $astro_sb_site_id ) {
		switch_to_blog( $astro_sb_site_id );
		astro_sb_uninstall_delete_options();
		restore_current_blog();
	}
} else {
	astro_sb_uninstall_delete_options();
}
