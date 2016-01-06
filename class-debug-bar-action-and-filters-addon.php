<?php
/**
 * This file contains the classes those create two new tabs in the debug panel provided by Debug Bar plugin.
 * It extends the functionality provided by the parent plugin "Debug Bar".
 *
 * @author  subharanjan
 * @package debug-bar-actions-and-filters-addon
 * @version 1.5
 */ 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
 
class Debug_Bar_Actions_Filters_Addon extends Debug_Bar_Panel {
    private $tab;
    private $callback;
    public function init() {
        $this->title( $this->tab );
        load_plugin_textdomain( 'debug-bar-actions-filters', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }
    public function enqueue_scripts() {
        wp_enqueue_style( 'debug-bar-actions-filters', plugins_url( 'css/debug-bar-actions-filters.css', __FILE__ ), array( 'debug-bar' ), '1.5'. 'all' );
    }
    public function set_tab( $name, $callback ) {
        $this->tab = $name;
        $this->callback = $callback;
    }
    public function prerender() {
        $this->set_visible( true );
    }
    public function render() {
        echo call_user_func( $this->callback );
    }
}
class Debug_Bar_Actions_Addon_Panel extends Debug_Bar_Actions_Filters_Addon {
}
class Debug_Bar_Filters_Addon_Panel extends Debug_Bar_Actions_Filters_Addon {
}