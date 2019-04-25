<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://reatlat.net
 * @since      1.0.0
 *
 * @package    Multidomain_Support_For_Elementor
 * @subpackage Multidomain_Support_For_Elementor/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Multidomain_Support_For_Elementor
 * @subpackage Multidomain_Support_For_Elementor/admin
 * @author     Alex Zappa <reatlat@gmail.com>
 */
class Multidomain_Support_For_Elementor_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Create an admin menu.
     *
     * @since 1.0.0
     */
    public function admin_menu()
    {
        add_submenu_page(
            'elementor',
            'Multidomain Support',
            'Multidomain Support',
            'manage_options',
            'multidomain-support-for-elementor-settings',
            array($this, 'admin_settings_page')
        );
    }


    /**
     * Create settings page.
     * @param
     * @return void
     * @since 1.0.0
     */
    public function admin_settings_page()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/admin--display.php';
    }


    /**
     * Update Elementor links for posts/pages listing
     *
     * @param $actions
     * @param $post
     * @return mixed
     * @since 1.0.0
     */
    public function update_row_actions_link($actions, $post)
    {
        if (!empty($actions['edit'])) {
            $actions['edit'] = $this->str_replace_domain_name($actions['edit']);
        }

        if (!empty($actions['edit_with_elementor'])) {
            $actions['edit_with_elementor'] = $this->str_replace_domain_name($actions['edit_with_elementor']);
        }

        return $actions;
    }

    public function update_admin_bar_menu($wp_admin_bar)
    {
        //Get a reference to the elementor_edit_page node to modify.
        $new_content_node = $wp_admin_bar->get_node('elementor_edit_page');

        if (!empty($new_content_node)) {
            //Change href
            $new_content_node->href = $this->str_replace_domain_name($new_content_node->href);

            //Update Node.
            $wp_admin_bar->add_node($new_content_node);
        }
    }


    private function str_replace_domain_name($url)
    {
        if ($this->get_wpml_plugin_name() !== 'not-founded') {
            $lang_content = $this->get_content_lang();
            $lang_default = $this->get_default_lang();
            $domains = $this->get_domains('domain');

            if ($lang_content !== $lang_default) {
                $url = str_replace($domains[$lang_default], $domains[$lang_content], $url);
            }
        }

        return $url;
    }

    /**
     * Get WP Multi Language plugin name
     * @return string
     * @since 1.0.0
     */
    public function get_wpml_plugin_name()
    {
        if (defined('POLYLANG') && !empty(POLYLANG))
            return 'polylang';

        if (defined('WPML_PLUGIN_BASENAME') && !empty(WPML_PLUGIN_BASENAME))
            return 'wpml';

        return 'not-founded';
    }

    /**
     * Get Server name
     * @return array
     * @since 1.0.0
     */
    public function get_server_name()
    {
        $server_info = explode('/', $_SERVER["SERVER_SOFTWARE"]);
        return $server_info;
    }


    public function get_languages()
    {
        $languages = array();

        if (function_exists('icl_get_languages')) {
            $languages = icl_get_languages();
        }

        if (!is_array($languages))
            return array();

        return $languages;
    }


    private function get_current_language()
    {
        switch ($this->get_wpml_plugin_name()) {
            case 'polylang';
                return pll_current_language();
                break;

            case 'wpml':
                return apply_filters('wpml_current_language', null);
                break;

            default:
                return 'en';
                break;
        }
    }


    /**
     * Get domains array
     * @param string $attr
     * @return array
     * @since 1.0.0
     */
    public function get_domains($attr = 'all')
    {
        if (!isset($domains))
            $domains = array();

        if (!empty($this->get_languages())) {

            foreach ($this->get_languages() as $lang_key => $item) {
                $url = substr($item['url'], -1) === '/' ? substr($item['url'], 0, -1) : $item['url'];

                switch ($attr) {
                    case 'url':
                        $domains[$lang_key] = $url;
                        break;

                    case 'domain':
                        $domains[$lang_key] = explode('://', $url)[1];
                        break;

                    default:
                        $domains[$lang_key] = array(
                            'url' => $url,
                            'domain' => explode('://', $url)[1]
                        );
                        break;
                }
            }
        }

        return $domains;
    }


    /**
     * Get content language key
     * @return string
     * @since 1.0.0
     */
    private function get_content_lang()
    {
        //TODO: improve this part
        $postID = get_the_ID() ? get_the_ID() : $_GET['post'];

        switch ($this->get_wpml_plugin_name()) {
            case 'polylang':
                $lang_key = pll_get_post_language($postID);
                break;

            case 'wpml':
                $lang_key = wpml_get_language_information($postID)['language_code'];
                break;

            default:
                $lang_key = 'en';
                break;
        }

        return $lang_key;
    }


    /**
     * Get default language key
     * @return string
     * @since 1.0.0
     */
    private function get_default_lang()
    {
        switch ($this->get_wpml_plugin_name()) {
            case 'polylang':
                $lang_key = apply_filters('wpml_default_language', null); // ppl_default_language()
                break;

            case 'wpml':
                $lang_key = apply_filters('wpml_default_language', null);
                break;

            default:
                $lang_key = !empty(apply_filters('wpml_default_language', null)) ? apply_filters('wpml_default_language', null) : 'en';
                break;
        }

        return $lang_key;
    }


    public function override_elementor_config($settings)
    {
        $settings['home_url'] = $this->get_domains('url')[$this->get_current_language()];

        return $settings;
    }


    /**
     * Add danoate and rateit links to plugin meta
     * @param $actions
     * @param $plugin_file
     * @return array
     * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_row_meta
     */
    public function plugin_row_meta($actions, $plugin_file)
    {
        if (strpos($plugin_file, $this->plugin_name . '.php') !== false) {
            $new_links = array(
                'donate' => '<a href="https://www.paypal.me/reatlat/' . rand(3, 10) . 'usd" target="_blank"><span class="dashicons dashicons-heart"></span> ' . __('Donate', 'multidomain-support-for-elementor') . '</a>',
                'rateit' => '<a href="https://wordpress.org/support/view/plugin-reviews/' . $this->plugin_name . '?rate=5#postform" target="_blank"><span class="dashicons dashicons-star-filled"></span> ' . __('Rate it', 'multidomain-support-for-elementor') . '</a>'
            );
            $actions = array_merge($actions, $new_links);
        }
        return $actions;
    }


    /**
     * Add Settings page link to plugin actions
     * @param $actions
     * @param $plugin_file
     * @return array
     * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
     */
    public function plugin_action_links($actions, $plugin_file)
    {
        if (strpos($plugin_file, $this->plugin_name . '.php') !== false) {
            $settings_link = '<a href="admin.php?page=' . $this->plugin_name . '-settings">' . __('Settings', 'campaign-url-builder') . '</a>';
            array_unshift($actions, $settings_link);
        }
        return $actions;
    }


    public function get_server_origin()
    {
        if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
            $origin = $_SERVER['HTTP_ORIGIN'];
        } else {
            $origin = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; // in theory should be IP $_SERVER['REMOTE_ADDR'];
        }
        return $origin;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Multidomain_Support_For_Elementor_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Multidomain_Support_For_Elementor_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/multidomain-support-for-elementor-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Multidomain_Support_For_Elementor_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Multidomain_Support_For_Elementor_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/multidomain-support-for-elementor-admin.min.js', array('jquery'), $this->version, true);

        wp_localize_script(
            $this->plugin_name,
            'MULTIDOMAIN_SUPPORT_FOR_ELEMENTOR_CONFIG',
            array(
                "debug" => MULTIDOMAIN_SUPPORT_FOR_ELEMENTOR_DEBUG,
                "wpml_plugin_name" => $this->get_wpml_plugin_name(),
                "default_lang" => $this->get_default_lang(),
                "current_lang" => $this->get_current_language(),
                "domains" => $this->get_domains('domain'),
                "urls" => $this->get_domains('url'),
                "admin_url" => admin_url()
            )
        );

    }

}
