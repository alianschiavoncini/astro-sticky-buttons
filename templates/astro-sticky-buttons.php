<?php
$position = get_option(ASTRO_SB_PREFIX . 'position');
if ($position == '') {
    $position = 'align-right';
}

$icon_box_shadow = get_option(ASTRO_SB_PREFIX.'icon-box-shadow');
if ($icon_box_shadow == 'yes' || !$icon_box_shadow) {
	$position .= ' ' . $position . '-with-shadow';
}
?>
<div class="astro_sb <?php echo esc_attr($position); ?>">
    <div class="astro_sb_inner">
    <?php

	$twitter = get_option(ASTRO_SB_PREFIX . 'twitter');
	if (!empty($twitter)) {
		?>
        <a href="https://twitter.com/<?php echo esc_attr($twitter); ?>" class="twitter-icon" target="_blank" aria-label="<?php esc_attr_e('X (Twitter)', 'astro-sticky-buttons'); ?>"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
		<?php
	}

	$facebook = get_option(ASTRO_SB_PREFIX . 'facebook');
	if (!empty($facebook)) {
		?>
        <a href="https://www.facebook.com/<?php echo esc_attr($facebook); ?>/" class="facebook-icon" target="_blank" aria-label="<?php esc_attr_e('Facebook', 'astro-sticky-buttons'); ?>"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a>
		<?php
	}

	$instagram = get_option(ASTRO_SB_PREFIX . 'instagram');
    if (!empty($instagram)) {
    ?>
    <a href="https://www.instagram.com/<?php echo esc_attr($instagram); ?>/" class="instagram-icon" target="_blank" aria-label="<?php esc_attr_e('Instagram', 'astro-sticky-buttons'); ?>"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
    <?php
    }

	$pinterest = get_option(ASTRO_SB_PREFIX . 'pinterest');
    if (!empty($pinterest)) {
    ?>
    <a href="https://www.pinterest.com/<?php echo esc_attr($pinterest); ?>/" class="pinterest-icon" target="_blank" aria-label="<?php esc_attr_e('Pinterest', 'astro-sticky-buttons'); ?>"><i class="fa-brands fa-pinterest" aria-hidden="true"></i></a>
    <?php
    }

	$youtube = get_option(ASTRO_SB_PREFIX . 'youtube');
    if (!empty($youtube)) {
    ?>
    <a href="https://www.youtube.com/<?php echo esc_attr($youtube); ?>" class="youtube-icon" target="_blank" aria-label="<?php esc_attr_e('YouTube', 'astro-sticky-buttons'); ?>"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a>
    <?php
    }

	$tiktok = get_option(ASTRO_SB_PREFIX . 'tiktok');
    if (!empty($tiktok)) {
    ?>
    <a href="https://www.tiktok.com/<?php echo esc_attr($tiktok); ?>" class="tiktok-icon" target="_blank" aria-label="<?php esc_attr_e('TikTok', 'astro-sticky-buttons'); ?>"><i class="fa-brands fa-tiktok" aria-hidden="true"></i></a>
    <?php
    }

	$vimeo = get_option(ASTRO_SB_PREFIX . 'vimeo');
    if (!empty($vimeo)) {
    ?>
    <a href="https://vimeo.com/<?php echo esc_attr($vimeo); ?>" class="vimeo-icon" target="_blank" aria-label="<?php esc_attr_e('Vimeo', 'astro-sticky-buttons'); ?>"><i class="fa-brands fa-vimeo" aria-hidden="true"></i></a>
    <?php
    }

	$whatsapp = get_option(ASTRO_SB_PREFIX . 'whatsapp');
	if (!empty($whatsapp)) {
		?>
        <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>" class="whatsapp-icon" target="_blank" aria-label="<?php esc_attr_e('WhatsApp', 'astro-sticky-buttons'); ?>"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
		<?php
	}

	$facebook_messenger = get_option(ASTRO_SB_PREFIX . 'facebook_messenger');
    if (!empty($facebook_messenger)) {
    ?>
    <a href="https://m.me/<?php echo esc_attr($facebook_messenger); ?>" class="facebook_messenger-icon" target="_blank" aria-label="<?php esc_attr_e('Facebook Messenger', 'astro-sticky-buttons'); ?>"><i class="fa-brands fa-facebook-messenger" aria-hidden="true"></i></a>
    <?php
    }

    $skype = get_option(ASTRO_SB_PREFIX . 'skype');
    if (!empty($skype)) {
    ?>
    <a href="skype:<?php echo esc_attr($skype); ?>?chat" class="skype-icon" target="_blank" aria-label="<?php esc_attr_e('Skype', 'astro-sticky-buttons'); ?>"><i class="fa-brands fa-skype" aria-hidden="true"></i></a>
    <?php
    }

    $telephone = get_option(ASTRO_SB_PREFIX . 'telephone');
    if (!empty($telephone)) {
    ?>
    <a href="tel:<?php echo esc_attr($telephone); ?>" class="phone-icon" target="_blank" aria-label="<?php esc_attr_e('Call us', 'astro-sticky-buttons'); ?>"><i class="fa fa-phone" aria-hidden="true"></i></a>
    <?php
    }

    $email = get_option(ASTRO_SB_PREFIX . 'email');
    if (is_email($email)) {
    ?>
    <a href="mailto:<?php echo esc_attr($email)?>" class="envelope-icon" target="_blank" aria-label="<?php esc_attr_e('Email us', 'astro-sticky-buttons'); ?>"><i class="fa fa-envelope" aria-hidden="true"></i></a>
    <?php
    }

    ?>
    </div>
</div>
