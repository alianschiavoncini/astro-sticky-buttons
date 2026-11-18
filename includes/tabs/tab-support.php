<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! is_admin() ) {
	return;
}

// La cancellazione la esegue astro_sb_delete_options_action() (admin-post.php, con nonce e
// capability); qui si mostra solo l'esito, letto dal redirect che la segue.
// phpcs:ignore WordPress.Security.NonceVerification.Recommended
$delete_options = ( isset( $_GET['astro_sb_reset'] ) && 'done' === $_GET['astro_sb_reset'] )
	? __( 'All the plugin options have deleted.', 'astro-sticky-buttons' )
	: false;

$astro_sb_prefix = ASTRO_SB_PREFIX;

$tab = 'support';
$option_group = $astro_sb_prefix . $tab;

?>
<div class="<?php echo esc_attr( $astro_sb_prefix . 'wrapper' ); ?> <?php echo esc_attr( $option_group ); ?>">

    <div class="section-wrapper">
        <div class="section-wrapper-inner">

            <h2 id="support" class="title"><?php esc_html_e('Support', 'astro-sticky-buttons' ); ?></h2>

            <h3 id="support-faqs" class="title"><?php esc_html_e( 'FAQs', 'astro-sticky-buttons' ); ?></h3>
            <p><span class="support-faq-question"><?php esc_html_e( 'Do you need support?', 'astro-sticky-buttons' ); ?></span><br>
                <span class="support-faq-answer"><?php esc_html_e( 'Request support at the ', 'astro-sticky-buttons' ); ?> <a href="https://wordpress.org/support/plugin/astro-sticky-buttons/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'plugin support page', 'astro-sticky-buttons' ); ?></a> <?php esc_html_e( 'or write me an email to', 'astro-sticky-buttons' ); ?> <a href="mailto:alian@alian.it">alian@alian.it</a>.</span></p>

            <hr />

            <h3 id="support-data-reset" class="title"><?php esc_html_e( 'Plugin data reset', 'astro-sticky-buttons' ); ?></h3>
            <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" onsubmit="return window.confirm('<?php echo esc_js( __( 'All the plugin settings will be deleted. Continue?', 'astro-sticky-buttons' ) ); ?>');">
                <input type="hidden" name="action" value="astro_sb_delete_options" />
                <?php wp_nonce_field( 'astro_sb_delete_options' ); ?>
                <p><button type="submit" class="button button-primary"><?php esc_html_e( 'Remove all plugin settings', 'astro-sticky-buttons' ); ?></button></p>
            </form>
            <?php if ( $delete_options ) { ?><p class="color-red"><?php echo esc_html( $delete_options ); ?></p><?php } ?>

        </div>
    </div>

</div>
