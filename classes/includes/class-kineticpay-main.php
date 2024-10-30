<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 * @since      2.0.0
 */
class KineticPay_Features_Woocommerce
{
    /**
     * The loader that's responsible for maintaining and registering hooks that power
     * the plugin.
     *
     * @since    2.0.0
     * @access   protected
     * @var      kineticpay_loader $loader Maintains and registers hooks for the plugin.
     */
    protected  $loader;
    /**
     * The unique identifier of this plugin.
     *
     * @since    2.0.0
     * @access   protected
     * @var      string $features_name The string used to uniquely identify the features.
     */
    protected  $features_name;
    /**
     * The unique identifier of this plugin.
     *
     * @since    2.0.0
     * @access   protected
     * @var      string $plugin_name The string used to uniquely identify the plugin name.
     */
    protected  $plugin_name;
    /**
     * The current version of the plugin.
     *
     * @since    2.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected  $version;
    /**
     * Define the core functionality of the plugin.
     *
     * Set the features name.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    2.0.0
     */
    public function __construct()
    {
        $this->features_name = 'kineticpaywc';
        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies()
    {
        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/kineticpay-admin-loader.php';
		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class.kineticpay-admin-settings.php';
        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class.kineticpay-public.php';
		$this->loader = new kineticpay_loader();
    }
    
    /**
     * Define the locale for this plugin for internationalization.
     *
     * @since    2.0.0
     * @access   private
     */
    private function set_locale()
    {
        
    }
    
    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    2.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new Kineticpay_Admin();
        $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
        $this->loader->add_action( 'admin_post_submit_form_rltknp', $plugin_admin, 'rltknp_add_update_options' );
		$this->loader->add_action( 'admin_post_rltknp_submit_knsettings', $plugin_admin, 'rltknp_add_update_options' );
        $this->loader->add_action( 'wp_ajax_rltknp_reset_settings', $plugin_admin, 'rltknp_reset_settings' );
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'banlist_pages' );
    }
    
    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    2.0.0
     * @access   private
     */
    private function define_public_hooks()
    {
        $plugin_public = new kineticpay_public();
        $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
        $this->loader->add_action( 'woocommerce_checkout_process', $plugin_public, 'wc_rltknp_validation', 999 );
    }
    
    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    2.0.0
     */
    public function run()
    {
        $this->loader->run();
    }
    
    /**
     * @return    string  The name of the features.
     * @since     2.0.0
     */
    public function get_features_name()
    {
        return $this->features_name;
    }
    
    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @return    kineticpay_loader Orchestrates the hooks of the plugin.
     * @since     2.0.0
     */
    public function get_loader()
    {
        return $this->loader;
    }

}