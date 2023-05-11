<?php
if( ! is_admin() ) {
	return;
}

function astro_sb_delete_options_prefixed( $prefix ) {
	global $wpdb;
	$wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '{$prefix}%'" );
}

$delete_options = false;
if (isset($_GET['delete_options']) && ($_GET['delete_options'] == 1)) {
	astro_sb_delete_options_prefixed( ASTRO_SB_PREFIX );
	$delete_options = __( 'All the plugin options have deleted.', 'astro-sticky-buttons' );
}

$tab = 'support';
$option_group = ASTRO_SB_PREFIX . $tab;

settings_fields($option_group);
do_settings_sections($option_group);
?>
<div class="<?php echo ASTRO_SB_PREFIX . 'wrapper'; ?> <?php echo esc_attr( $option_group ); ?>">

    <div class="section-wrapper">
        <div class="section-wrapper-inner">

            <h2 id="support" class="title"><?php _e('Support', 'astro-sticky-buttons' ); ?></h2>

            <h3 id="support-faqs" class="title"><?php _e( 'FAQs', 'astro-sticky-buttons' ); ?></h3>
            <p><span class="support-faq-question"><?php _e( 'Do you need support?', 'astro-sticky-buttons' ); ?></span><br>
                <span class="support-faq-answer"><?php _e( 'Request support at the ', 'astro-sticky-buttons' ); ?> <a href="https://wordpress.org/support/plugin/astro-sticky-buttons/" target="_blank"><?php _e( 'plugin support page', 'astro-sticky-buttons' ); ?></a> <?php _e( 'or write me an email to', 'astro-sticky-buttons' ); ?> <a href="mailto:info@astrothemes.com">info@astrothemes.com</a>.</span></p>

            <hr />

            <h3 id="support-data-reset" class="title"><?php _e( 'Plugin data reset', 'astro-sticky-buttons' ); ?></h3>
            <p><a class="button button-primary" href="?page=<?php echo ASTRO_SB_TEXTDOMAIN; ?>&amp;tab=support&amp;delete_options=1"><?php _e( 'Remove all plugin settings', 'astro-sticky-buttons' ); ?></a></p>
            <p class="color-red"><?php echo esc_html($delete_options); ?></p>

        </div>
    </div>

</div>
