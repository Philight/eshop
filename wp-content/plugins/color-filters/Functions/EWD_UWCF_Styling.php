<?php
function EWD_UWCF_Add_Modified_Styles() {
	$StylesString = "<style>";

	$StylesString .="#ewd-uwcf-filtering-form .ewd-uwcf-color-preview { ";
		if (get_option("EWD_UWCF_Color_Icon_Size") != "") {$StylesString .= "width:" .  EWD_UWCF_Check_Font_Size(get_option("EWD_UWCF_Color_Icon_Size")) . " !important; height:" .  EWD_UWCF_Check_Font_Size(get_option("EWD_UWCF_Color_Icon_Size")) . " !important;";}
	$StylesString .="}\n";

	$StylesString .="#ewd-uwcf-filtering-form { ";
		if (get_option("EWD_UWCF_Widget_Font_Color") != "") {$StylesString .= "color:" .  get_option("EWD_UWCF_Widget_Font_Color") . " !important;";}
		if (get_option("EWD_UWCF_Widget_Font_Size") != "") {$StylesString .= "font-size:" .  EWD_UWCF_Check_Font_Size(get_option("EWD_UWCF_Widget_Font_Size")) . " !important;";}
	$StylesString .="}\n";

	$StylesString .="#ewd-uwcf-ratings-slider, #ewd-uwcf-price-slider { ";
		if (get_option("EWD_UWCF_Ratings_Bar_Empty_Color") != "") {$StylesString .= "background-color:" .  get_option("EWD_UWCF_Ratings_Bar_Empty_Color") . " !important;";}
	$StylesString .="}\n";
	$StylesString .="#ewd-uwcf-ratings-slider .ui-widget-header, #ewd-uwcf-price-slider .ui-widget-header { ";
		if (get_option("EWD_UWCF_Ratings_Bar_Fill_Color") != "") {$StylesString .= "background-color:" .  get_option("EWD_UWCF_Ratings_Bar_Fill_Color") . " !important;";}
	$StylesString .="}\n";
	$StylesString .="#ewd-uwcf-ratings-slider .ui-slider-handle, #ewd-uwcf-price-slider .ui-slider-handle { ";
		if (get_option("EWD_UWCF_Ratings_Bar_Handle_Color") != "") {$StylesString .= "background-color:" .  get_option("EWD_UWCF_Ratings_Bar_Handle_Color") . " !important;";}
	$StylesString .="}\n";
	$StylesString .=".ewd-uwcf-ratings-slider-min, .ewd-uwcf-ratings-slider-max, .ewd-uwcf-price-slider-min, .ewd-uwcf-price-slider-max { ";
		if (get_option("EWD_UWCF_Ratings_Bar_Text_Color") != "") {$StylesString .= "color:" .  get_option("EWD_UWCF_Ratings_Bar_Text_Color") . " !important;";}
		if (get_option("EWD_UWCF_Ratings_Bar_Font_Size") != "") {$StylesString .= "font-size:" .  EWD_UWCF_Check_Font_Size(get_option("EWD_UWCF_Ratings_Bar_Font_Size")) . " !important;";}
	$StylesString .="}\n";

	$StylesString .=".ewd-uwcf-reset-all { ";
		if (get_option("EWD_UWCF_Reset_All_Button_Background_Color") != "") {$StylesString .= "background-color:" .  get_option("EWD_UWCF_Reset_All_Button_Background_Color") . " !important;";}
		if (get_option("EWD_UWCF_Reset_All_Button_Text_Color") != "") {$StylesString .= "color:" .  get_option("EWD_UWCF_Reset_All_Button_Text_Color") . " !important;";}
		if (get_option("EWD_UWCF_Reset_All_Button_Font_Size") != "") {$StylesString .= "font-size:" .  EWD_UWCF_Check_Font_Size(get_option("EWD_UWCF_Reset_All_Button_Font_Size")) . " !important;";}
	$StylesString .="}\n";
	$StylesString .=".ewd-uwcf-reset-all:hover { ";
		if (get_option("EWD_UWCF_Reset_All_Button_Hover_Background_Color") != "") {$StylesString .= "background-color:" .  get_option("EWD_UWCF_Reset_All_Button_Hover_Background_Color") . " !important;";}
		if (get_option("EWD_UWCF_Reset_All_Button_Hover_Text_Color") != "") {$StylesString .= "color:" .  get_option("EWD_UWCF_Reset_All_Button_Hover_Text_Color") . " !important;";}
	$StylesString .="}\n";

	$StylesString .=".ewd-uwcf-thumbnail-links, .ewd-uwcf-thumbnail-links a { ";
		if (get_option("EWD_UWCF_Shop_Thumbnails_Font_Color") != "") {$StylesString .= "color:" .  get_option("EWD_UWCF_Shop_Thumbnails_Font_Color") . " !important;";}
		if (get_option("EWD_UWCF_Shop_Thumbnails_Font_Size") != "") {$StylesString .= "font-size:" .  EWD_UWCF_Check_Font_Size(get_option("EWD_UWCF_Shop_Thumbnails_Font_Size")) . " !important;";}
	$StylesString .="}\n";
	
	$StylesString .=".ewd-uwcf-shop-product-colors-container .ewd-uwcf-color-preview { ";
		if (get_option("EWD_UWCF_Shop_Thumbnails_Color_Icon_Size") != "") {$StylesString .= "width:" .  EWD_UWCF_Check_Font_Size(get_option("EWD_UWCF_Shop_Thumbnails_Color_Icon_Size")) . " !important; height:" .  EWD_UWCF_Check_Font_Size(get_option("EWD_UWCF_Shop_Thumbnails_Color_Icon_Size")) . " !important;";}
	$StylesString .="}\n";

	$StylesString .= "</style>";

	return $StylesString;
}

function EWD_UWCF_Check_Font_Size($Font_Size) {
	if (is_numeric($Font_Size)) {$Font_Size .= 'px';}
	return $Font_Size;
}


