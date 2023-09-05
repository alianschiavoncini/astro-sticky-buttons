<?php
if( ! is_admin() ) {
	return;
}

// Escape the main ASTRO_SB_PREFIX constant
$astro_sb_prefix = esc_attr(ASTRO_SB_PREFIX);

$tab = 'settings';
$option_group = $astro_sb_prefix . $tab;
?>
<div class="<?php echo $astro_sb_prefix . 'wrapper'; ?> <?php echo esc_attr( $option_group ); ?>">

    <div class="section-wrapper">
        <div class="section-wrapper-inner">
            <h2 id="settings" class="title"><?php _e('Settings', 'astro-sticky-buttons' ); ?></h2>
            <p><?php echo esc_html('Astro Sticky Buttons displays the sticky buttons using the shortcode:', 'astro-sticky-buttons'); ?> <strong>[astro-sticky-buttons]</strong><br>
                <?php echo esc_html('To display the sticky buttons on all pages of the site, it is recommended to insert the shortcode in the header or footer of the site.', 'astro-sticky-buttons'); ?><br>
                <?php echo esc_html('The shortcode can also be inserted via text widget.', 'astro-sticky-buttons'); ?></p>
        </div>
    </div>

    <form method="post" action="options.php" class="<?php echo esc_attr($option_group); ?>_form">
        <?php
        settings_fields($option_group);
        do_settings_sections($option_group);
        ?>

        <div class="section-wrapper">
            <div class="section-wrapper-inner">

                <h2 id="buttons" class="title"><?php _e('Buttons', 'astro-sticky-buttons' ); ?></h2>

                <hr>

                <h3 id="buttons-communication" class="title"><?php _e('Chat/Communication', 'astro-sticky-buttons' ); ?></h3>
                <table class="form-table">
					<?php
					$field = array(
						'label' => esc_html__( 'Email', 'astro-sticky-buttons' ),
						'description' => '',
						'name' => $astro_sb_prefix.'email',
						'value' => get_option($astro_sb_prefix.'email'),
						'placeholder' => '',
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php }?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Telephone', 'astro-sticky-buttons' ),
						'description' => __('Include the country code. Example: +39000123456', 'astro-sticky-buttons' ),
						'name' => $astro_sb_prefix.'telephone',
						'value' => get_option($astro_sb_prefix.'telephone'),
						'placeholder' => '',
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php }?>
                        </td>
                    </tr>
                    <?php
                    $field = array(
                        'label' => esc_html__( 'WhatsApp', 'astro-sticky-buttons' ),
                        'description' => __('Include the country code. Example: +39000123456', 'astro-sticky-buttons' ),
                        'name' => $astro_sb_prefix.'whatsapp',
                        'value' => get_option($astro_sb_prefix.'whatsapp'),
                        'placeholder' => '',
                    );
                    ?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
                            <?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php }?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Skype', 'astro-sticky-buttons' ),
						'description' => __('Example: name.surname', 'astro-sticky-buttons' ),
						'name' => $astro_sb_prefix.'skype',
						'value' => get_option($astro_sb_prefix.'skype'),
						'placeholder' => '',
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php }?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Facebook messenger', 'astro-sticky-buttons' ),
						'description' => __('Example: name.surname', 'astro-sticky-buttons' ),
						'name' => $astro_sb_prefix.'facebook_messenger',
						'value' => get_option($astro_sb_prefix.'facebook_messenger'),
						'placeholder' => '',
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php }?>
                        </td>
                    </tr>
                </table>

                <hr>

                <h3 id="buttons-communication" class="title"><?php _e('Social', 'astro-sticky-buttons' ); ?></h3>
                <table class="form-table">

					<?php
					$field = array(
						'label' => esc_html__( 'Facebook', 'astro-sticky-buttons' ),
						'description' => __('Example: your.username', 'astro-sticky-buttons' ),
						'name' => $astro_sb_prefix.'facebook',
						'value' => get_option($astro_sb_prefix.'facebook'),
						'placeholder' => '',
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php }?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Instagram', 'astro-sticky-buttons' ),
						'description' => __('Example: instagramusername', 'astro-sticky-buttons' ),
						'name' => $astro_sb_prefix.'instagram',
						'value' => get_option($astro_sb_prefix.'instagram'),
						'placeholder' => '',
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php }?>
                        </td>
                    </tr>
                    <?php
                    $field = array(
                        'label' => esc_html__( 'YouTube', 'astro-sticky-buttons' ),
                        'description' => __('Example: youryoutubechannel', 'astro-sticky-buttons' ),
                        'name' => $astro_sb_prefix.'youtube',
                        'value' => get_option($astro_sb_prefix.'youtube'),
                        'placeholder' => '',
                    );
                    ?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
                            <?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php }?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'TikTok', 'astro-sticky-buttons' ),
						'description' => __('Example: @tiktokname', 'astro-sticky-buttons' ),
						'name' => $astro_sb_prefix.'tiktok',
						'value' => get_option($astro_sb_prefix.'tiktok'),
						'placeholder' => '',
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php }?>
                        </td>
                    </tr>
					<?php
					$field = array(
						'label' => esc_html__( 'Twitter', 'astro-sticky-buttons' ),
						'description' => __('Example: twitterusername', 'astro-sticky-buttons' ),
						'name' => $astro_sb_prefix.'twitter',
						'value' => get_option($astro_sb_prefix.'twitter'),
						'placeholder' => '',
					);
					?>
                    <tr>
                        <th scope="row"><label for="<?php echo esc_attr($field['name']); ?>"><?php echo esc_html($field['label']); ?></label></th>
                        <td>
                            <input type="text" id="<?php echo esc_attr($field['name']); ?>" name="<?php echo esc_attr($field['name']); ?>" class="regular-text" value="<?php echo esc_attr($field['value']); ?>" placeholder="<?php echo esc_attr($field['placeholder']); ?>">
							<?php if ($field['description']) { ?><p class="description"><?php echo esc_html($field['description']); ?></p><?php }?>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <?php
        submit_button();
        ?>
    </form>

</div>

