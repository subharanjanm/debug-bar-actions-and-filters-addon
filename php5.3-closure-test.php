<?php

if( ! function_exists( 'debug_bar_action_and_filters_addon_is_closure' ) ) {
	/**
	 * Function to check for closures
	 *
	 * @param   mixed $arg function name
	 *
	 * @return  boolean $closurecheck return whether or not a closure
	 */
	function debug_bar_action_and_filters_addon_is_closure( $arg ) {
	    $test = function() {
	    };
	    $closurecheck = ( $arg instanceof $test );
	    return $closurecheck;
	}
}