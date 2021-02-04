<?php

add_action( 'bapf_include_all_template_styles', 'custom_function_include_tempate_styles' );
function custom_function_include_tempate_styles() {
	include_once( get_stylesheet_directory().'template_styles/color.php' );
}