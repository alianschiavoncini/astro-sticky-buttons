=== Astro Sticky Buttons ===
Contributors: alian
Tags: floating buttons, sticky buttons, email button, telephone button, whatsapp button
Requires at least: 5.2
Tested up to: 7.0
Stable tag: 1.4.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add sticky buttons for easy contact and social sharing on your site. Supports email, phone, WhatsApp, Skype, Facebook, Instagram, and more.

== Description ==
Display your favourite sticky buttons to get in touch with your visitors and share your social channels.

<strong>Chat/Communication buttons:</strong>
<ul>
<li>Email</li>
<li>Telephone</li>
<li>WhatsApp</li>
<li>Skype</li>
<li>Facebook Messenger</li>
</ul>

<strong>Social buttons:</strong>
<ul>
<li>Facebook</li>
<li>Instagram</li>
<li>Pinterest</li>
<li>YouTube</li>
<li>TikTok</li>
<li>Twitter</li>
<li>Vimeo</li>
</ul>

<strong>Layout:</strong>
<ul>
<li>Position: it is possible to choose the position where to display the floating buttons bar: right, bottom-right, bottom, bottom-left, left</li>
<li>Icons: choose the distance beetween the icons, dimension, border and shape (squared and rounded) and box shadow</li>
</ul>

== Installation ==
1. Upload the entire `astro-sticky-buttons` folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the **Plugins** screen (**Plugins > Installed Plugins**).

== Wordefence vendor verification key ==
gsphudo7by90lzwdlihyerqxbzj6jiln

== Changelog ==
= 1.4.0 =
* Accessibility: added accessible names (aria-label) to all sticky buttons and marked the decorative icons as aria-hidden. Fixes WCAG 2.4.4 / 4.1.2 (link-name). Thanks to Antonio Trifirò (@conlaccento).
* Added: languages/astro-sticky-buttons.pot, so the plugin strings can be translated.
* Fixed: replaced str_contains() with strpos() in the settings screen. str_contains() is only available from WordPress 5.9 (or PHP 8.0), while this plugin supports WordPress 5.2 with PHP 7.4: on older installations opening a settings tab raised a fatal error.
* Changed: the plugin author is now Alian Schiavoncini (https://www.alian.it) and the support address is alian@alian.it. The previous AstroThemes website and email address are no longer active.
* Changed: the admin menu is now named "Astro Plugins" instead of "AstroThemes".
* Changed: the plugin version is now stored in the ASTRO_SB_VERSION constant instead of being read at runtime with get_plugin_data().
* Compatibility: tested with WordPress 7.0.

= 1.3.0 =
* Checked full compatibility with WordPress version 6.8.3
* Added Wordefence vendor verification key

= 1.2.0 =
* Added full compatibility with WordPress version 6.6.1.
* Added security checks to the code

= 1.1.0 =
* Added new settings: it is possible to choose which post type or taxonomy as well as custom post type and custom taxonomy to display the sticky buttons bar (recommended method). Don't need to use the shortcode [astro-sticky-buttons] to display the sticky buttons bar.

= 1.0.1 =
* Fix TikTok
* Added Pinterest
* Added Vimeo

= 1.0.0 =
* Initial version
