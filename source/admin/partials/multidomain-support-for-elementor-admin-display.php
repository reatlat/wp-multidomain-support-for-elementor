<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://reatlat.net
 * @since      1.0.0
 *
 * @package    Multidomain_Support_For_Elementor
 * @subpackage Multidomain_Support_For_Elementor/admin/partials
 */

$plugin = new Multidomain_Support_For_Elementor_Admin($this->plugin_name, $this->version);

$domains = $plugin->get_domains('domain');
$esc_domains = str_replace('.', '\.', implode('|', $domains));
?>

    <!-- This file should primarily consist of HTML with a little bit of PHP. -->
    <div id="EMS-settings-page" class="wrap">
        <h1><?php _e('Multidomain Support for Elementor', 'multidomain-support-for-elementor'); ?></h1>

        <div class="EMS__wrap">

            <div id="elementor-settings-tabs-wrapper" class="nav-tab-wrapper EMS__wrap__navigation-tabs">
                <a id="elementor-settings-tab-general" class="nav-tab nav-tab-active" href="#tab-general">
                    <?php _e('General', 'multidomain-support-for-elementor'); ?></a>
                <a id="elementor-settings-tab-server" class="nav-tab" href="#tab-server">
                    <?php _e('Server settings', 'multidomain-support-for-elementor'); ?></a>
            </div>

            <div class="EMS__wrap__content">

                <div id="elementor-settings-form" class="content__main">


                        <div id="tab-general" class="elementor-settings-form-page elementor-active">

                            <?php if ($plugin->get_wpml_plugin_name() === 'not-founded') : ?>
                                <div class="content__main__notice updated error inline">
                                    <p><?php _e('Plugin work in universal mode, perhaps some functions will work incorrectly', 'multidomain-support-for-elementor'); ?></p>
                                </div>
                                <div class="content__main__not-founded notice notice-alt notice-error error inline">
                                    <h2><?php _e("We don't recognize your multilingual plugin on your WP", 'multidomain-support-for-elementor'); ?></h2>
                                    <h3><?php _e('We support next plugins:', 'multidomain-support-for-elementor'); ?></h3>
                                    <ul>
                                        <li>
                                            <a href="https://polylang.pro/" target="_blank">
                                                <?php _e('Polylang – Making WordPress multilingual', 'multidomain-support-for-elementor'); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://wpml.org/" target="_blank">
                                                <?php _e('WPML - The WordPress Multilingual Plugin', 'multidomain-support-for-elementor'); ?>
                                            </a>
                                        </li>
                                    </ul>

                                    <p><?php printf(
                                            __("Use another plugin? Open issue %shere%s.", 'multidomain-support-for-elementor'),
                                            '<a href="https://github.com/reatlat/wp-multidomain-support-for-elementor/issues" target="_blank">',
                                            '</a>'); ?></p>
                                </div>
                            <?php else: ?>
                            <h2><?php _e('Good news! We support your multilingual plugin', 'multidomain-support-for-elementor'); ?></h2>
                            <h4><?php printf(__('Your multilingual plugin is: %s', 'multidomain-support-for-elementor'), '<span class="green">'.strtoupper($plugin->get_wpml_plugin_name()).'</span>'); ?></h4>
                            <?php endif; ?>

                            <h4><?php printf(__('The Elementor Multidomain Support - %sACTIVATED%s', 'multidomain-support-for-elementor'), '<span class="green">','</span>'); ?></h4>

                            <h2><?php _e('Instalation proces', 'multidomain-support-for-elementor'); ?></h2>
                            <ol>
                                <li><?php _e('Activate multilingual plugin','multidomain-support-for-elementor'); ?></li>
                                <li><?php _e('Install server-side code','multidomain-support-for-elementor'); ?></li>
                                <li><a target="_blank" href="https://wordpress.org/support/view/plugin-reviews/<?php echo esc_attr($plugin->plugin_name); ?>?rate=5#postform"><?php _e('Rate plugin', 'multidomain-support-for-elementor'); ?></a></li>
                                <li><a href="https://www.paypal.me/reatlat/<?php echo rand(3, 10); ?>usd" target="_blank"><?php _e('Buy me coffee', 'multidomain-support-for-elementor'); ?></a></li>
                                <li><?php _e('Enjoy your Multidomain website based on Elementor Page Builder','multidomain-support-for-elementor'); ?></li>
                            </ol>

                            <h2><?php _e('Need help with your WordPress?', 'multidomain-support-for-elementor'); ?></h2>
                            <p><?php printf(__('Contact me by %semail%s', 'multidomain-support-for-elementor'),
                                    '<a target="_blank" href="https://reatlat.net/contact/?utm_source=wp_plugin&utm_medium=help_link&utm_campaign='.esc_attr($plugin->plugin_name).'">',
                                    '</a>'); ?></p>
                        </div>

                        <div id="tab-server" class="elementor-settings-form-page">

                            <div class="server-info">
                                <h2><?php printf(
                                        __('Your server runs on %s', 'multidomain-support-for-elementor'),
                                        '<span class="green">' . $plugin->get_server_name()[0] . '</span>'); ?></h2>
                            </div>

                            <div class="content__main__warning notice notice-alt notice-error error inline">
                                <h1>!!! <?php _e('WARNING', 'multidomain-support-for-elementor'); ?> !!!</h1>
                                <h3><?php _e('It is very important to be extremely attentive when making changes to .htaccess file or nginx.vhost. If after making changes your site stops functioning the plugin author not responsible for your changes in server configuration.', ''); ?></h3>
                            </div>

                            <hr>

                            <h2><?php _e('Server settings', 'multidomain-support-for-elementor'); ?>:</h2>
                            <h3><?php _e('Advanced solution', 'multidomain-support-for-elementor'); ?></h3>
                            <h4><?php _e('Apache .htaccess file configuration', 'multidomain-support-for-elementor'); ?></h4>
                            <div class="server-config server-config--apache">
<pre><code>
# ----------------------------------------------------------------------
# Allow Cross-Origin Resource Sharing (CORS)
# ----------------------------------------------------------------------
&lt;FilesMatch &quot;\.(css|js|ttf|ttc|eot|woff|woff2|otf|svg|gif|ico|webp|png|jpe?g)$&quot;&gt;
&lt;IfModule mod_headers.c&gt;
    SetEnvIf Origin &quot;http(s)?://(www\.)?(<?php echo $esc_domains; ?>)$&quot; AccessControlAllowOrigin=$0
    Header add Access-Control-Allow-Origin %{AccessControlAllowOrigin}e env=AccessControlAllowOrigin
    Header merge Vary Origin
&lt;/IfModule&gt;
&lt;/FilesMatch&gt;

</code></pre>
                            </div>

                            <h4><?php _e('Configuration for NGINX server', 'multidomain-support-for-elementor'); ?></h4>
                            <div class="server-config server-config--nginx">
<pre><code>
# ----------------------------------------------------------------------
# Allow Cross-Origin Resource Sharing (CORS)
# ----------------------------------------------------------------------
location ~* \.(?:css|js|ttf|ttc|eot|woff|woff2|otf|svg|gif|ico|webp|png|jpe?g)$ {
   if ( $http_origin ~* (https?://(.+\.)?(<?php echo $esc_domains; ?>)$) ) {
      add_header &quot;Access-Control-Allow-Origin&quot; &quot;$http_origin&quot;;
      add_header &quot;Vary&quot; &quot;Origin&quot;;
   }
}

</code></pre>
                            </div>

                            <hr>

                            <h3><?php _e('Easy solution, but also will work (NOT RECOMMENDED)', 'multidomain-support-for-elementor'); ?></h3>
                            <h4><?php _e('For Apache add headers to .htaccess file', 'multidomain-support-for-elementor'); ?></h4>
                            <div class="server-config server-config--apache">
<pre><code>
# ----------------------------------------------------------------------
# Allow Cross-Origin Resource Sharing (CORS)
# ----------------------------------------------------------------------
&lt;IfModule mod_headers.c&gt;
    Header add Access-Control-Allow-Origin &quot;*&quot;
    Header merge Vary Origin
&lt;/IfModule&gt;

</code></pre>
                            </div>

                            <h4><?php _e('For NGINX add headers to .vhost file in any section', 'multidomain-support-for-elementor'); ?></h4>
                            <div class="server-config server-config--nginx">
<pre><code>
# ----------------------------------------------------------------------
# Allow Cross-Origin Resource Sharing (CORS)
# ----------------------------------------------------------------------
add_header &quot;Access-Control-Allow-Origin&quot; &quot;*&quot;;
add_header &quot;Vary&quot; &quot;Origin&quot;;

</code></pre>
                            </div>

                        </div>

                </div>

                <div class="content__sidebar">
                    <div class="ems-banner ems-banner--rate-it">
                        <a target="_blank"
                           href="https://wordpress.org/support/view/plugin-reviews/<?php echo esc_attr($plugin->plugin_name); ?>?rate=5#postform">
                            <span class="reatlat_promote_title"><?php _e('Rate it to show your support!', 'multidomain-support-for-elementor'); ?></span>
                            <img src="<?php echo str_replace('/admin', '', plugin_dir_url(dirname(__DIR__))); ?>admin/imgs/rateus.png"
                                 alt="<?php _e('Rate us', 'multidomain-support-for-elementor'); ?>">
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
                           title="<?php _e('Buy me a coffee', 'multidomain-support-for-elementor'); ?>">
                            <img src="<?php echo str_replace('/admin', '', plugin_dir_url(dirname(__DIR__))); ?>admin/imgs/buymeacoffee.png"
                                 alt="<?php _e('Buy me a coffee', 'multidomain-support-for-elementor'); ?>">
                        </a>
                    </div>
                    <div class="ems-banner ems-banner--author">
                        <div class="reatlat_promote_title"><?php _e('Developed by', 'multidomain-support-for-elementor'); ?></div>
                        <div class="author-card">
                            <a target="_blank"
                               href="https://reatlat.net/?utm_source=wp_plugin&utm_medium=authorcard_sidebar&utm_campaign=<?php echo esc_attr($plugin->plugin_name); ?>">
                                <img src="<?php echo get_avatar_url('reatlat@gmail.com', array("size" => 160)); ?>"
                                     alt="Alex Zappa a.k.a. re[at]lat">
                            </a>
                            <h3>Alex Zappa
                                <small>a.k.a. re[at]lat</small>
                            </h3>
                            <h4><?php _e('Software Engineer', 'multidomain-support-for-elementor'); ?></h4>
                            <p><a target="_blank"
                                  href="https://reatlat.net/?utm_source=wp_plugin&utm_medium=logo_sidebar&utm_campaign=<?php echo esc_attr($plugin->plugin_name); ?>"><?php _e('Homepage', 'multidomain-support-for-elementor'); ?></a>
                                | <a target="_blank" href="https://github.com/reatlat">GitHub</a></p>

                        </div>
                    </div>
                    <div class="ems-banner ems-banner--techstack">
                        <a href="https://github.com/reatlat/wp-multidomain-support-for-elementor" target="_blank">
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