<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://reatlat.net
 * @since      1.0.0
 *
 * @package    Elementor_Multidomain_Support
 * @subpackage Elementor_Multidomain_Support/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Elementor_Multidomain_Support
 * @subpackage Elementor_Multidomain_Support/admin
 * @author     Alex Zappa <reatlat@gmail.com>
 */
class Elementor_Multidomain_Support_Admin
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
            'elementor-multidomain-support-settings',
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
        require_once plugin_dir_path(__FILE__) . 'partials/elementor-multidomain-support-admin-display.php';
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
        switch ($this->get_wpml_plugin_name()) {
            case 'polylang':
                $lang_content = pll_get_post_language(get_the_ID());
                $lang_default = $GLOBALS['polylang']->options['default_lang'];
                $arr_domains = $GLOBALS['polylang']->options['domains'];

                if ( $lang_content !== $lang_default ) {
                    $url = str_replace( $arr_domains[$lang_default], $arr_domains[$lang_content], $url);
                }

                break;

            case 'wpml':
                // TODO: I need the WPML plugin to solve issue
                
                break;

            default:
                break;
        }

        return $url;
    }

    /**
     * Get WP Multi Language plugin name
     * @return string
     * @since 1.0.0
     */
    private function get_wpml_plugin_name()
    {
        if (defined('POLYLANG') && !empty(POLYLANG))
            return 'polylang';

        if (defined('WPML_PLUGIN_BASENAME') && !empty(WPML_PLUGIN_BASENAME))
            return 'wpml';

        return 'not-founded';
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
         * defined in Elementor_Multidomain_Support_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Elementor_Multidomain_Support_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/elementor-multidomain-support-admin.css', array(), $this->version, 'all');

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
         * defined in Elementor_Multidomain_Support_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Elementor_Multidomain_Support_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/elementor-multidomain-support-admin.min.js', array('jquery'), $this->version, false);

    }

}
