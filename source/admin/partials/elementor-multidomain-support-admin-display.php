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

            <div id="elementor-settings-tabs-wrapper" class="nav-tab-wrapper EMS__wrap__navigation-tabs">
                <?php if ($plugin->get_wpml_plugin_name() !== 'not-founded') : ?>
                     <a id="elementor-settings-tab-general" class="nav-tab nav-tab-active" href="#tab-general">
                        <?php _e('General', 'elementor-multidomain-support'); ?></a>
                    <a id="elementor-settings-tab-server" class="nav-tab" href="#tab-server">
                        <?php _e('Server settings', 'elementor-multidomain-support'); ?></a>
                <?php endif; ?>
            </div>

            <div class="EMS__wrap__content">

                <div id="elementor-settings-form" class="content__main">

                    <?php if ($plugin->get_wpml_plugin_name() !== 'not-founded') : ?>

                        <div id="tab-general" class="elementor-settings-form-page elementor-active">
                            AAA
                        </div>

                        <div id="tab-server" class="elementor-settings-form-page">
                            BBB
                        </div>

                    <?php else : ?>

                        <div class="content__main__not-founded">
                            <h2><?php _e("We don't recognize your multi language plugin on your WP", 'elementor-multidomain-support'); ?></h2>
                            <h3><?php _e('We support next plugins:', 'elementor-settings-form'); ?></h3>
                            <ul>
                                <li>
                                    <a href="https://wpml.org/" target="_blank">
                                        <?php _e('WPML - The WordPress Multilingual Plugin', 'elementor-settings-form'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://polylang.pro/" target="_blank">
                                        <?php _e('Polylang – Making WordPress multilingual', 'elementor-settings-form'); ?>
                                    </a>
                                </li>
                            </ul>

                            <p><?php printf(
                                    __("Use another plugin? Open issue %shere%s.", 'elementor-settings-form'),
                                    '<a href="https://github.com/reatlat/wp-elementor-multidomain-support/issues" target="_blank">',
                                    '</a>'); ?></p>
                        </div>

                    <?php endif; ?>

                </div>

                <div class="content__sidebar">
                    <div class="ems-banner ems-banner--rate-it">
                        <a target="_blank"
                           href="https://wordpress.org/support/view/plugin-reviews/<?php echo esc_attr($plugin->plugin_name); ?>?rate=5#postform">
                            <span class="reatlat_promote_title"><?php _e('Rate it to show your support!', 'elementor-multidomain-support'); ?></span>
                            <img src="<?php echo str_replace('/admin', '', plugin_dir_url(dirname(__DIR__))); ?>admin/imgs/rateus.png"
                                 alt="<?php _e('Rate us', 'elementor-multidomain-support'); ?>">
                        </a>
                    </div>
                    <div class="ems-banner ems-banner--utm-builder">
                        <a href="https://wordpress.org/plugins/campaign-url-builder/" target="_blank">
                            <img src="<?php echo str_replace('/admin', '', plugin_dir_url(dirname(__DIR__))); ?>admin/imgs/banner--utm.png"
                                 alt="">
                        </a>
                    </div>
                    <div class="ems-banner ems-banner--langflag">
                        <a href="https://wordpress.org/plugins/html-global-lang-attribute/" target="_blank">
                            <img src="<?php echo str_replace('/admin', '', plugin_dir_url(dirname(__DIR__))); ?>admin/imgs/banner--global-lang.png"
                                 alt="">
                        </a>
                    </div>
                    <!-- TODO: add some promo banner from my API endpoint
                    <div class="ems-banner ems-banner--promo">

                    </div>
                    -->
                    <div class="ems-banner ems-banner--buy-me-coffee">
                        <a href="https://www.paypal.me/reatlat/<?php echo rand(3, 10); ?>usd" target="_blank"
                           title="<?php _e('Buy me a coffee', 'elementor-multidomain-support'); ?>">
                            <img src="<?php echo str_replace('/admin', '', plugin_dir_url(dirname(__DIR__))); ?>admin/imgs/buymeacoffee.png"
                                 alt="<?php _e('Buy me a coffee', 'elementor-multidomain-support'); ?>">
                        </a>
                    </div>
                    <div class="ems-banner ems-banner--author">
                        <div class="reatlat_promote_title"><?php _e('Developed by', 'elementor-multidomain-support'); ?></div>
                        <div class="author-card">
                            <a target="_blank"
                               href="https://reatlat.net/?utm_source=wp_plugin&utm_medium=authorcard_sidebar&utm_campaign=<?php echo esc_attr($plugin->plugin_name); ?>">
                                <img src="<?php echo get_avatar_url('reatlat@gmail.com', array("size" => 160)); ?>"
                                     alt="Alex Zappa a.k.a. re[at]lat">
                            </a>
                            <h3>Alex Zappa
                                <small>a.k.a. re[at]lat</small>
                            </h3>
                            <h4><?php _e('Software Engineer', 'elementor-multidomain-support'); ?></h4>
                            <p><a target="_blank"
                                  href="https://reatlat.net/?utm_source=wp_plugin&utm_medium=logo_sidebar&utm_campaign=<?php echo esc_attr($plugin->plugin_name); ?>"><?php _e('Homepage', 'elementor-multidomain-support'); ?></a>
                                | <a target="_blank" href="https://github.com/reatlat">GitHub</a></p>

                        </div>
                    </div>
                    <div class="ems-banner ems-banner--techstack">
                        <a href="https://github.com/reatlat/wp-elementor-multidomain-support" target="_blank">
                            <img src="<?php echo str_replace('/admin', '', plugin_dir_url(dirname(__DIR__))); ?>admin/imgs/github-octcat.png"
                                 alt="">
                        </a>
                        <a href="https://www.gnu.org/licenses/quick-guide-gplv3.en.html" target="_blank">
                            <img src="<?php echo str_replace('/admin', '', plugin_dir_url(dirname(__DIR__))); ?>admin/imgs/gplv3.png"
                                 alt="">
                        </a>
                        <a href="https://opensource.org/" target="_blank">
                            <img src="<?php echo str_replace('/admin', '', plugin_dir_url(dirname(__DIR__))); ?>admin/imgs/opensource.png"
                                 alt="">
                        </a>
                    </div>
                </div>

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