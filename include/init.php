<?php

// Block direct access to file
defined( 'ABSPATH' ) or die( 'Not Authorized!' );

class Stratos_Core {

    public function __construct() {

        // Plugin uninstall hook
        register_uninstall_hook( SC_FILE, array('Stratos_Core', 'plugin_uninstall') );

        // Plugin activation/deactivation hooks
        register_activation_hook( SC_FILE, array($this, 'plugin_activate') );
        register_deactivation_hook( SC_FILE, array($this, 'plugin_deactivate') );

        // Plugin Actions
        add_action( 'wp_enqueue_scripts', array($this, 'plugin_enqueue_scripts') );
        // add_action( 'admin_enqueue_scripts', array($this, 'plugin_enqueue_admin_scripts') );
    }


    public static function plugin_uninstall() { }

    /**
     * Plugin activation function
     * called when the plugin is activated
     * @method plugin_activate
     */
    public function plugin_activate() { }

    /**
     * Plugin deactivate function
     * is called during plugin deactivation
     * @method plugin_deactivate
     */
    public function plugin_deactivate() { }


    /**
     * Enqueue the main Plugin admin scripts and styles
     * @method plugin_enqueue_scripts
     */
    function plugin_enqueue_admin_scripts() {
        wp_register_style( 'SC-admin-style', SC_DIRECTORY_URL . '/assets/css/admin-style.css', array(), null );
        wp_register_script( 'SC-admin-script', SC_DIRECTORY_URL . '/assets/js/admin-script.min.js', array(), null, true );
        wp_enqueue_style('SC-admin-style');
        wp_enqueue_script('SC-admin-script');
    }

    /**
     * Enqueue the main Plugin user scripts and styles
     * @method plugin_enqueue_scripts
     */
    function plugin_enqueue_scripts() {
        wp_register_style( 'SC-user-style', SC_DIRECTORY_URL . '/assets/css/user-style.css', array(), null );
        wp_register_script( 'SC-user-script', SC_DIRECTORY_URL . '/assets/js/user-script.min.js', array(), null, true );
        wp_enqueue_style('SC-user-style');
        wp_enqueue_script('SC-user-script');
    }
}

new Stratos_Core;
