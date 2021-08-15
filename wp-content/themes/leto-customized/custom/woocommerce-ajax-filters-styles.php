<?php

add_action( 'bapf_include_all_tempate_styles', 'custom_function_include_tempate_styles' );
function custom_function_include_tempate_styles() {
	include_once( get_stylesheet_directory().'woocommerce-ajax_filters/template_styles/color.php' );
}