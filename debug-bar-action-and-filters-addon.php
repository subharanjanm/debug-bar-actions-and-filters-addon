<?php
/**
 * Plugin Name: Debug Bar Actions and Filters Addon
 * Plugin URI: http://wordpress.org/extend/plugins/debug-bar-actions-and-filters-addon/
 * Description: This plugin add two more tabs in the Debug Bar to display hooks(Actions and Filters) attached to the current request. Actions tab displays the actions hooked to current request. Filters tab displays the filter tags along with the functions attached to it with priority.
 * Version: 1.3
 * Author: Subharanjan
 * Author Email: subharanjanmantri@gmail.com
 * Author URI: http://www.subharanjan.in/
 * License: GPLv2
 *  
 * @author  subharanjan
 * @package debug-bar-actions-and-filters-addon
 * @version 1.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
 
/**
 * Function to hook with debug_bar_panels filter.
 *
 * @param array $panels list of all the panels in debug bar.
 *
 * @return array $panels modified panels list
 */
if ( !function_exists( 'debug_bar_action_and_filters_addon_panel' ) ) {
    function debug_bar_action_and_filters_addon_panel( $panels ) {
        require_once( plugin_dir_path( __FILE__ ) . 'class-debug-bar-action-and-filters-addon.php' );
        $wp_actions = new Debug_Bar_Actions_Addon_Panel();
        $wp_actions->set_tab( 'Action Hooks', 'debug_bar_action_and_filters_addon_display_actions' );
        $panels[] = $wp_actions;
        $wp_filters = new Debug_Bar_Filters_Addon_Panel();
        $wp_filters->set_tab( 'Filter Hooks', 'debug_bar_action_and_filters_addon_display_filters' );
        $panels[] = $wp_filters;
        return $panels;
    }
}
add_filter( 'debug_bar_panels', 'debug_bar_action_and_filters_addon_panel' );

/**
 * Function to display the Actions attached to current request.
 *
 * @return string $output display output for the actions panel
 */
function debug_bar_action_and_filters_addon_display_actions() {
    global $wp_actions;
    $output = '';
    $output .= '<div class="hooks_listing_container">' . "\n";
    $output .= '<h2>List of Action Hooks</h2><br />' . "\n";
    $output .= "<ul>\n";
    foreach ( $wp_actions as $action_key => $action_val ) {
        $output .= '<li>' . $action_key . "</li>\n";
    }
    $output .= '<li><strong>Total Count: </strong>' . count( $wp_actions ) . "</li>\n";
    $output .= "</ul>\n";
    $output .= "</div>\n";
    return $output;
}

/**
 * Function to to check for closures
 *
 * @param   mixed $arg function name
 *
 * @return  boolean $closurecheck return whether or not a closure
 */
function isClosure( $arg ) {
    $test = function () {
    };
    $closurecheck = ( $arg instanceof $test );
    return $closurecheck;
}

/**
 * Function to display the Filters applied to current request.
 *
 * @return string $output display output for the filters panel
 */
function debug_bar_action_and_filters_addon_display_filters() {
    global $wp_filter;
    $output = '';
    $output .= '<div class="hooks_listing_container">' . "\n";
    $output .= '<h2>List of Filter Hooks (with functions)</h2><br />' . "\n";
    $output .= "<ul>\n";
    foreach ( $wp_filter as $filter_key => $filter_val ) {
        $output .= '<li>';
        $output .= '<strong>' . $filter_key . "</strong><br />\n";
        $output .= "<ul>\n";
        ksort( $filter_val );
        foreach ( $filter_val as $priority => $functions ) {
            $output .= '<li>';
            $output .= 'Priority: ' . $priority . "<br />\n";
            $output .= "<ul>\n";
            foreach ( $functions as $single_function ) {
                if ( !is_string( $single_function['function'] ) && ( !is_object( $single_function['function'] ) ) )
                    continue;
                elseif ( ( isClosure( $single_function['function'] ) ) )
                    continue;
                elseif ( ( isClosure( $single_function['function'][0] ) ) )
                    continue;
                elseif ( is_string( $single_function['function'] ) )
                    $output .= '<li>' . sanitize_text_field( $single_function['function'] ) . '</li>';
                elseif ( is_array( $single_function['function'] ) && is_string( $single_function['function'][0] ) )
                    $output .= '<li>' . sanitize_text_field( $single_function['function'][0] ) . ' -> ' . sanitize_text_field( $single_function['function'][1] ) . '</li>';
                elseif ( is_array( $single_function['function'] ) && is_object( $single_function['function'][0] ) )
                    $output .= '<li>(object) ' . get_class( $single_function['function'][0] ) . ' -> ' . sanitize_text_field( $single_function['function'][1] ) . '</li>';
                else
                    $output .= '<li><pre>' . var_export( $single_function ) . '</pre></li>';
            }
            $output .= "</ul>\n";
            $output .= "</li>\n";
        }
        $output .= "</ul>\n";
        $output .= "</li>\n";
    }
    $output .= "</ul>\n";
    $output .= "</div>\n";
    return $output;
}