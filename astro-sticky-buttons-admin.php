<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! is_admin() ) {
	return;
}

/**
 * Load Admin files.
 */
function astro_sb_load_admin_files() {
    if(!is_admin_bar_showing()) return;

	/**
	 * Main admin styles and scripts
	 */
	wp_enqueue_style ( 'astro-sticky-buttons-admin-styles', plugins_url('/css/astro-sticky-buttons-admin.css', __FILE__), array(), astro_sb_plugin_data('Version') );

	wp_register_script( 'astro-sticky-buttons-admin-scripts', plugins_url('/js/astro-sticky-buttons-admin.js', __FILE__), array( 'jquery', 'wp-color-picker' ), astro_sb_plugin_data('Version'), true );
	wp_enqueue_script( 'astro-sticky-buttons-admin-scripts' );

	/**
	 * WP color picker: the scripts registered by the core (with Iris and their translations).
	 */
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );

	/**
     * Include the plugin navigation.
     */
    include(plugin_dir_path(__FILE__) . 'includes/tabs/tabs-nav.php');
}
add_action( 'admin_enqueue_scripts', 'astro_sb_load_admin_files' );

/**
 * Remove all the plugin settings (Support tab). The request is a POST to admin-post.php with a
 * nonce and the manage_options capability, followed by a redirect: reloading the page or opening
 * it again from the history does not delete the settings a second time.
 */
function astro_sb_delete_options_prefixed( $prefix ) {
	global $wpdb;

	// esc_like() neutralizza _ e % nel prefisso; prepare() si occupa del resto.
	$like = $wpdb->esc_like( $prefix ) . '%';

	$option_names = $wpdb->get_col(
		$wpdb->prepare( "SELECT option_name FROM {$wpdb->options} WHERE option_name LIKE %s", $like )
	);

	// delete_option() e non una DELETE diretta: aggiorna anche la cache degli oggetti, altrimenti
	// con una cache persistente le opzioni cancellate continuerebbero a essere lette.
	$deleted = 0;
	foreach ( $option_names as $option_name ) {
		if ( delete_option( $option_name ) ) {
			$deleted++;
		}
	}

	return $deleted;
}

add_action( 'admin_post_astro_sb_delete_options', 'astro_sb_delete_options_action' );
function astro_sb_delete_options_action() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'astro-sticky-buttons' ) );
	}
	check_admin_referer( 'astro_sb_delete_options' );

	astro_sb_delete_options_prefixed( ASTRO_SB_PREFIX );

	wp_safe_redirect( add_query_arg( array( 'page' => ASTRO_SB_TEXTDOMAIN, 'tab' => 'support', 'astro_sb_reset' => 'done' ), admin_url( 'admin.php' ) ) );
	exit;
}

/**
 * Tabs of the settings page.
 */
function astro_sb_tabs() {
	return array( 'settings', 'layout', 'support' );
}

/**
 * Register options settings.
 */
function astro_sb_register_settings() {

	// Only chooses which settings to register: options.php verifies the nonce before saving.
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$option_page = isset( $_REQUEST['option_page'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['option_page'] ) ) : '';

	if ( $option_page !== '' ) {

		if ( strpos( $option_page, ASTRO_SB_PREFIX ) === 0 ) {
			$tab = explode( '_', $option_page );
			astro_sb_register_tab_settings( $option_page, end( $tab ) );
		}

	} else {
		foreach ( array( 'settings', 'layout' ) as $tab ) {
			astro_sb_register_tab_settings( ASTRO_SB_PREFIX . $tab, $tab );
		}
	}

}
add_action( 'admin_init', 'astro_sb_register_settings' );

/**
 * Display the plugin pages in menu.
 */
if (class_exists('Astro_Plugin_Panel')) {

	add_action('astro_plugin_panel_pages', 'astro_sb_plugin_panel_submenu');

	function astro_sb_plugin_panel_submenu() {
		add_submenu_page(
			'astro-plugin-panel',
			__('Sticky buttons', 'astro-sticky-buttons'),
			__('Sticky buttons', 'astro-sticky-buttons'),
			'manage_options',
			'astro-sticky-buttons',
			'astro_sb_options'
		);
	}

}

/**
 * Display the plugin panel to do define the settings.
 */
function astro_sb_options() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'astro-sticky-buttons' ) );
    }

    ?>
    <div class="wrap">
        <h1><?php echo esc_html(astro_sb_plugin_data('Name')); ?></h1>
        <?php

        // Only the tabs of the plugin: the value is used to build the path of the included file.
        // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- only chooses the tab to display.
        $tab = isset( $_REQUEST['tab'] ) ? sanitize_key( wp_unslash( $_REQUEST['tab'] ) ) : '';
        if ( ! in_array( $tab, astro_sb_tabs(), true ) ) {
            $tab = 'settings'; // default panel
        }

		astro_sb_tabs_nav($tab);

        $tab_file = plugin_dir_path( __FILE__ ) . 'includes/tabs/tab-' . $tab . '.php';
        if ( file_exists( $tab_file ) ) {
			include $tab_file;
		}

        ?>
    </div>
    <?php
}