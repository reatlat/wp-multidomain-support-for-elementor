<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://reatlat.net
 * @since      1.0.0
 *
 * @package    Elementor_Multidomain_Support
 * @subpackage Elementor_Multidomain_Support/admin/partials
 */

$plugin = new Elementor_Multidomain_Support_Admin($this->plugin_name, $this->version);

?>

    <!-- This file should primarily consist of HTML with a little bit of PHP. -->
    <div id="EMS-settings-page" class="wrap">
        <h1><?php _e('Elementor Multidomain Support', 'elementor-multidomain-support'); ?></h1>

        <div class="EMS__wrap">

            <div class="EMS__wrap__content">

            </div>

            <div class="EMS__wrap__sidebar">

            </div>

        </div>

    </div>


<?php

// TODO: create option to enable plugin or disable for debug
//       if plugin enabled show which ML plugin we have and prechose correct one
//       just for now set it for PolyLang and have option for WMPL, but I need to get access to WPML plugin to test it

//$array_domains = $GLOBALS['polylang']->options['domains'];
//$default_lang = $GLOBALS['polylang']->options['default_lang'];

//var_dump($array_domains);
//echo $default_lang;