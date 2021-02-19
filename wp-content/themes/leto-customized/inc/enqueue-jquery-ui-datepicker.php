<?php

add_action('wp_enqueue_scripts', 'jquery_ui_datepicker_admin_styles');
function jquery_ui_datepicker_admin_styles() {
	wp_enqueue_style( 'jquery-ui-datepicker-style' , '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css');
}

add_action('wp_enqueue_scripts', 'jquery_ui_datepicker_admin_scripts');
function jquery_ui_datepicker_admin_scripts() {
	wp_enqueue_script( 'jquery-ui-datepicker' );
}