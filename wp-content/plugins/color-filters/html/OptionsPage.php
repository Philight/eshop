<?php
	$Enable_Table_Format = get_option("EWD_UWCF_Table_Format");
	$Allow_Sorting = get_option("EWD_UWCF_Allow_Sorting");
	$Fields_Array = get_option("EWD_UWCF_Fields_Array");
	if (!is_array($Fields_Array)) {$Fields_Array = array('name', 'image', 'price', 'rating', 'add_to_cart', 'colors', 'sizes');}

	$Enable_Colors = get_option("EWD_UWCF_Enable_Colors");
	$Color_Filters_Display = get_option("EWD_UWCF_Color_Filters_Display");
	$Color_Filters_Show_Text = get_option("EWD_UWCF_Color_Filters_Show_Text");
	$Color_Filters_Show_Color = get_option("EWD_UWCF_Color_Filters_Show_Color");
	$Color_Filters_Hide_Empty = get_option("EWD_UWCF_Color_Filters_Hide_Empty");
	$Color_Filters_Show_Product_Count = get_option("EWD_UWCF_Color_Filters_Show_Product_Count");
	$Display_Thumbnail_Colors = get_option("EWD_UWCF_Display_Thumbnail_Colors");
	$Colors_Product_Page_Display = get_option("EWD_UWCF_Colors_Product_Page_Display");
	$Colors_Used_For_Variations = get_option("EWD_UWCF_Colors_Used_For_Variations");

	$Enable_Sizes = get_option("EWD_UWCF_Enable_Sizes");
	$Size_Filters_Display = get_option("EWD_UWCF_Size_Filters_Display");
	if($Size_Filters_Display == 'Tiles'){ update_option("EWD_UWCF_Size_Filters_Display", "List"); }
	$Size_Filters_Show_Text = get_option("EWD_UWCF_Size_Filters_Show_Text");
	$Size_Filters_Hide_Empty = get_option("EWD_UWCF_Size_Filters_Hide_Empty");
	$Size_Filters_Show_Product_Count = get_option("EWD_UWCF_Size_Filters_Show_Product_Count");
	$Display_Thumbnail_Sizes = get_option("EWD_UWCF_Display_Thumbnail_Sizes");
	$Sizes_Product_Page_Display = get_option("EWD_UWCF_Sizes_Product_Page_Display");
	$Sizes_Used_For_Variations = get_option("EWD_UWCF_Sizes_Used_For_Variations");

	$Enable_Categories = get_option("EWD_UWCF_Enable_Categories");
	$Category_Filters_Display = get_option("EWD_UWCF_Category_Filters_Display");
	$Category_Filters_Show_Text = get_option("EWD_UWCF_Category_Filters_Show_Text");
	$Category_Filters_Hide_Empty = get_option("EWD_UWCF_Category_Filters_Hide_Empty");
	$Category_Filters_Show_Product_Count = get_option("EWD_UWCF_Category_Filters_Show_Product_Count");
	$Display_Thumbnail_Categories = get_option("EWD_UWCF_Display_Thumbnail_Categories");

	$Enable_Tags = get_option("EWD_UWCF_Enable_Tags");
	$Tag_Filters_Display = get_option("EWD_UWCF_Tag_Filters_Display");
	$Tag_Filters_Show_Text = get_option("EWD_UWCF_Tag_Filters_Show_Text");
	$Tag_Filters_Hide_Empty = get_option("EWD_UWCF_Tag_Filters_Hide_Empty");
	$Tag_Filters_Show_Product_Count = get_option("EWD_UWCF_Tag_Filters_Show_Product_Count");
	$Display_Thumbnail_Tags = get_option("EWD_UWCF_Display_Thumbnail_Tags");

	$Enable_Text_Search = get_option("EWD_UWCF_Enable_Text_Search");
	$Enable_Autocomplete = get_option("EWD_UWCF_Enable_Autocomplete");

	$Price_Enable = get_option("EWD_UWCF_Product_Price_Enable");
	$Price_Display = get_option("EWD_UWCF_Product_Price_Display");

	$Enable_Ratings_Filtering = get_option("EWD_UWCF_Enable_Ratings_Filtering");
	$Ratings_Type = get_option("EWD_UWCF_Ratings_Type");

	$Enable_InStock_Filtering = get_option("EWD_UWCF_Enable_InStock_Filtering");

	$Enable_OnSale_Filtering = get_option("EWD_UWCF_Enable_OnSale_Filtering");

	$wc_attribute_table_name = $wpdb->prefix . "woocommerce_attribute_taxonomies";
    $attribute_taxonomies = $wpdb->get_results( "SELECT * FROM $wc_attribute_table_name order by attribute_name ASC;" );

    global $Attribute_Options;
    foreach ($attribute_taxonomies as $attribute_taxonomy) {
    	if ($attribute_taxonomy->attribute_name == "ewd_uwcf_colors" or $attribute_taxonomy->attribute_name == "ewd_uwcf_sizes") {continue;}
    	$Attribute_Options[$attribute_taxonomy->attribute_name]['Label'] = $attribute_taxonomy->attribute_label;
    	$Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] = get_option("EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Enabled");
    	$Attribute_Options[$attribute_taxonomy->attribute_name]['Display'] = get_option("EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Display");
    	$Attribute_Options[$attribute_taxonomy->attribute_name]['Show_Text'] = get_option("EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Show_Text");
    	$Attribute_Options[$attribute_taxonomy->attribute_name]['Hide_Empty'] = get_option("EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Hide_Empty");
    	$Attribute_Options[$attribute_taxonomy->attribute_name]['Product_Count'] = get_option("EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Product_Count");
    	$Attribute_Options[$attribute_taxonomy->attribute_name]['Thumbnail_Tags'] = get_option("EWD_UWCF_" . $attribute_taxonomy->attribute_name . "_Thumbnail_Tags");

    	if (!in_array($attribute_taxonomy->attribute_name, $Fields_Array)) {
    		$Fields_Array[] = $attribute_taxonomy->attribute_name;
    	}
    }

	$Access_Role = get_option("EWD_UWCF_Access_Role");
	$Reset_All_Button = get_option("EWD_UWCF_Reset_All_Button");

	$Show_All_Colors_Label = get_option("EWD_UWCF_Show_All_Colors_Label");
	$Show_All_Sizes_Label = get_option("EWD_UWCF_Show_All_Sizes_Label");
	$Show_All_Categories_Label = get_option("EWD_UWCF_Show_All_Categories_Label");
	$Show_All_Tags_Label = get_option("EWD_UWCF_Show_All_Tags_Label");
	$Show_All_Attributes_Label = get_option("EWD_UWCF_Show_All_Attributes_Label");
	$Rating_Label = get_option("EWD_UWCF_Rating_Label");
	$Thumbnail_Colors_Label = get_option("EWD_UWCF_Thumbnail_Colors_Label");
	$Thumbnail_Sizes_Label = get_option("EWD_UWCF_Thumbnail_Sizes_Label");
	$Thumbnail_Categories_Label = get_option("EWD_UWCF_Thumbnail_Categories_Label");
	$Thumbnail_Tags_Label = get_option("EWD_UWCF_Thumbnail_Tags_Label");
	$Product_Page_Colors_Label = get_option("EWD_UWCF_Product_Page_Colors_Label");
	$Product_Page_Sizes_Label = get_option("EWD_UWCF_Product_Page_Sizes_Label");
	
	$Custom_CSS = get_option("EWD_UWCF_Custom_CSS");
	$Color_Filters_Color_Shape = get_option("EWD_UWCF_Color_Filters_Color_Shape");
	$Color_Icon_Size = get_option("EWD_UWCF_Color_Icon_Size");
	$Widget_Font_Color = get_option("EWD_UWCF_Widget_Font_Color");
	$Widget_Font_Size = get_option("EWD_UWCF_Widget_Font_Size");
	$Ratings_Bar_Fill_Color = get_option("EWD_UWCF_Ratings_Bar_Fill_Color");
	$Ratings_Bar_Empty_Color = get_option("EWD_UWCF_Ratings_Bar_Empty_Color");
	$Ratings_Bar_Handle_Color = get_option("EWD_UWCF_Ratings_Bar_Handle_Color");
	$Ratings_Bar_Text_Color = get_option("EWD_UWCF_Ratings_Bar_Text_Color");
	$Ratings_Bar_Font_Size = get_option("EWD_UWCF_Ratings_Bar_Font_Size");
	$Reset_All_Button_Background_Color = get_option("EWD_UWCF_Reset_All_Button_Background_Color");
	$Reset_All_Button_Text_Color = get_option("EWD_UWCF_Reset_All_Button_Text_Color");
	$Reset_All_Button_Hover_Background_Color = get_option("EWD_UWCF_Reset_All_Button_Hover_Background_Color");
	$Reset_All_Button_Hover_Text_Color = get_option("EWD_UWCF_Reset_All_Button_Hover_Text_Color");
	$Reset_All_Button_Font_Size = get_option("EWD_UWCF_Reset_All_Button_Font_Size");
	$Shop_Thumbnails_Font_Color = get_option("EWD_UWCF_Shop_Thumbnails_Font_Color");
	$Shop_Thumbnails_Font_Size = get_option("EWD_UWCF_Shop_Thumbnails_Font_Size");
	$Shop_Thumbnails_Color_Icon_Size = get_option("EWD_UWCF_Shop_Thumbnails_Color_Icon_Size");

	if (isset($_POST['Display_Tab'])) {$Display_Tab = $_POST['Display_Tab'];}
	else {$Display_Tab = "";}
?>

<div class="wrap uwcf-options-page-tabbed">
<div class="uwcf-options-submenu-div">
	<ul class="uwcf-options-submenu uwcf-options-page-tabbed-nav">
		<li><a id="Basic_Menu" class="MenuTab options-subnav-tab <?php if ($Display_Tab == '' or $Display_Tab == 'Basic') {echo 'options-subnav-tab-active';}?>" onclick="ShowOptionTab('Basic');">Filtering</a></li>
		<!-- <li><a id="Premium_Menu" class="MenuTab options-subnav-tab <?php if ($Display_Tab == 'Premium') {echo 'options-subnav-tab-active';}?>" onclick="ShowOptionTab('Premium');">Premium</a></li> -->
		<li><a id="Other_Menu" class="MenuTab options-subnav-tab <?php if ($Display_Tab == 'Other') {echo 'options-subnav-tab-active';}?>" onclick="ShowOptionTab('Other');">General</a></li>
		<li><a id="Labelling_Menu" class="MenuTab options-subnav-tab <?php if ($Display_Tab == 'Labelling') {echo 'options-subnav-tab-active';}?>" onclick="ShowOptionTab('Labelling');">Labelling</a></li>
		<li><a id="Styling_Menu" class="MenuTab options-subnav-tab <?php if ($Display_Tab == 'Styling') {echo 'options-subnav-tab-active';}?>" onclick="ShowOptionTab('Styling');">Styling</a></li>
	</ul>
</div>

<div class="uwcf-options-page-tabbed-content">

<form method="post" action="admin.php?page=EWD-UWCF-options&DisplayPage=Options&UWCF_Action=EWD_UWCF_Update_Options">
<?php wp_nonce_field('EWD_UWCF_Nonce_Field', 'EWD_UWCF_Nonce_Field'); ?>

<input type='hidden' name='Display_Tab' value='<?php echo esc_attr( $Display_Tab ); ?>' />





<div id='Basic' class='uwcf-option-set<?php echo ( ($Display_Tab == '' or $Display_Tab == 'Basic') ? '' : ' uwcf-hidden' ); ?>'>
<h2 id="basic-order-options" class="uwcf-options-tab-title">Filtering Options</h2>
<br />

<div class="ewd-uwcf-shortcode-reminder">
	<?php _e('To display the filters, either add the widget to the appropriate sidebar or use the <strong>[ultimate-woocommerce-filters]</strong> shortcode', 'color-filters'); ?>
</div>

<br />

<div class="ewd-uwcf-admin-section-heading"><?php _e('Table Format', 'color-filters'); ?></div>

<div class="form-table ewd-uwcf-table-format">
	<table class="form-table noSubSections ewd-uwcf-table-format">
	<tr>
	<th scope="row"><?php _e("Enable Table Format", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Enable Table Format", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' class='ewd-uwcf-toggle' data-filtertype='Table_Format' name='enable_table_format' value='Yes' <?php if($Enable_Table_Format == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' class='ewd-uwcf-toggle' data-filtertype='Table_Format'  name='enable_table_format' value='No' <?php if($Enable_Table_Format == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="enable_table_format" <?php if($Enable_Table_Format == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Table Format lets you display your products in a table rather than a grid format, and adds the requested sorting and filtering options to the table.", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Table_Format' class='<?php echo ($Enable_Table_Format != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Allow Sorting", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Allow Sorting", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='allow_sorting' value='Yes' <?php if($Allow_Sorting == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='allow_sorting' value='No' <?php if($Allow_Sorting == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="allow_sorting" <?php if($Allow_Sorting == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should table headers be clickable to for sorting purposes?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Table_Format' class='<?php echo ($Enable_Table_Format != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Fields", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Fields", 'color-filters'); ?></span></legend>
			<input type='hidden' name='fields_array' value='<?php echo implode(",", $Fields_Array); ?>' /> 

			<table class='ewd-uwcf-wc-table-format <?php echo ($EWD_UWCF_Full_Version == "Yes" ? "premium" : ""); ?>'>
				<thead>
					<tr>
						<th><?php _e("Field Name", 'color-filters'); ?></th>
						<th><?php _e("Display", 'color-filters'); ?></th>
						<th><?php _e("Enable Filtering", 'color-filters'); ?></th>
						<th><?php _e("Filter Type", 'color-filters'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($Fields_Array as $Field) {
						$Field_Name 		= EWD_UWCF_Get_Field_Name( $Field );
						$Field_Displayed 	= EWD_UWCF_Get_Field_Displayed( $Field );
						$Field_Filtering	= EWD_UWCF_Get_Field_Filtering( $Field );
						$Field_Filter_Type	= EWD_UWCF_Get_Field_Filter_Type( $Field );

						$Field_Filter_Type_Options = EWD_UWCF_Get_Field_Filtering_Type_Options( $Field );
							?>
							<tr data-field="<?php echo $Field; ?>">
								<td><?php echo $Field_Name; ?></td>
								<td>
									<div class="ewd-uwcf-admin-hide-radios">
										<label title='Yes'><input type='radio' class='ewd-uwcf-wc-format-field-displayed' name='<?php echo $Field; ?>_displayed' value='Yes' <?php if($Field_Displayed == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
										<label title='No'><input type='radio' class='ewd-uwcf-wc-format-field-displayed' name='<?php echo $Field; ?>_displayed' value='No' <?php if($Field_Displayed == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
									</div>
									<label class="ewd-uwcf-admin-switch">
										<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="<?php echo $Field; ?>_displayed" <?php if($Field_Displayed == "Yes") {echo "checked='checked'";} ?>>
										<span class="ewd-uwcf-admin-switch-slider round"></span>
									</label>
								</td>
								<td>
									<?php if ($Field_Filtering != 'N/A') { ?>
										<div class="ewd-uwcf-admin-hide-radios">
											<label title='Yes'><input type='radio' class='ewd-uwcf-wc-format-field-filtering' name='<?php echo $Field; ?>_enable_filtering' value='Yes' <?php if($Field_Filtering == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
											<label title='No'><input type='radio' class='ewd-uwcf-wc-format-field-filtering' name='<?php echo $Field; ?>_enable_filtering' value='No' <?php if($Field_Filtering == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
										</div>
										<label class="ewd-uwcf-admin-switch">
											<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="<?php echo $Field; ?>_enable_filtering" <?php if($Field_Filtering == "Yes") {echo "checked='checked'";} ?>>
											<span class="ewd-uwcf-admin-switch-slider round"></span>
										</label>
									<?php } ?>
								</td>
								<td>
									<?php if ($Field_Filtering != 'N/A') { ?>
										<select name='<?php echo $Field; ?>_filter_type' class='ewd-uwcf-wc-format-filter-type'>
											<?php foreach ($Field_Filter_Type_Options as $Filtering_Option) { ?>
												<option value='<?php echo $Filtering_Option; ?>' <?php echo ($Field_Filter_Type == $Filtering_Option ? 'selected' : ''); ?>><?php echo $Filtering_Option ?></option>
											<?php } ?>
										</select>
									<?php } ?>
								</td>
							</tr>

							<?php if ($EWD_UWCF_Full_Version != 'Yes' and $Field == 'sizes') { ?>
								</tbody></table>
								<!-- split into a second table with just the attributes -->
								<table class='ewd-uwcf-premium-table-format ewd-uwcf-premium-options-table ewd-uwcf-wc-table-format'>
									<thead>
										<tr>
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>
							<?php } ?>
						<?php } ?>
						<?php if ($EWD_UWCF_Full_Version != 'Yes') { ?>
							<tr  class='ewd-uwcf-premium-options-table-overlay'>
								<th colspan="2">
									<div class="ewd-uwcf-unlock-premium">
										<img src="<?php echo plugins_url( '../images/options-asset-lock.png', __FILE__ ); ?>" alt="Upgrade to Ultimate WooCommerce Filters Premium">
										<p>Access this section by by upgrading to premium</p>
										<a href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" class="ewd-uwcf-dashboard-get-premium-widget-button" target="_blank">UPGRADE NOW</a>
									</div>
								</th>
							</tr>
						<?php } ?>
					</tbody>
				</table>

		</fieldset>
	</td>
	</tr>
	</table>

</div> <!--form-table-->

<div class="ewd-uwcf-admin-section-heading ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>"><?php _e('Color Filtering', 'color-filters'); ?></div>

<div class="form-table ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
	<table class="form-table noSubSections ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
	<tr>
	<th scope="row"><?php _e("Enable Color Filtering", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Enable Color Filtering", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' class='ewd-uwcf-toggle' data-filtertype='Colors' name='enable_colors' value='Yes' <?php if($Enable_Colors == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' class='ewd-uwcf-toggle' data-filtertype='Colors'  name='enable_colors' value='No' <?php if($Enable_Colors == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="enable_colors" <?php if($Enable_Colors == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should the color filters be displayed when the plugin's widget or shortcode is used?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Colors' class='<?php echo ($Enable_Colors != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Show Text", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Color Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='color_filters_show_text' value='Yes' <?php if($Color_Filters_Show_Text == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='color_filters_show_text' value='No' <?php if($Color_Filters_Show_Text == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="color_filters_show_text" <?php if($Color_Filters_Show_Text == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a color's name be displayed in the filtering box?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Colors' class='<?php echo ($Enable_Colors != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Show Color", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Color Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='color_filters_show_color' value='Yes' <?php if($Color_Filters_Show_Color == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='color_filters_show_color' value='No' <?php if($Color_Filters_Show_Color == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="color_filters_show_color" <?php if($Color_Filters_Show_Color == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a color's color swatch be displayed in the filtering box?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Colors' class='<?php echo ($Enable_Colors != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Hide Empty", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Color Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='color_filters_hide_empty' value='Yes' <?php if($Color_Filters_Hide_Empty == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='color_filters_hide_empty' value='No' <?php if($Color_Filters_Hide_Empty == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="color_filters_hide_empty" <?php if($Color_Filters_Hide_Empty == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Which colors with no associated products be hidden?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Colors' class='<?php echo ($Enable_Colors != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Show Product Count", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Show Product Count", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='color_filters_show_product_count' value='Yes' <?php if($Color_Filters_Show_Product_Count == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='color_filters_show_product_count' value='No' <?php if($Color_Filters_Show_Product_Count == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="color_filters_show_product_count" <?php if($Color_Filters_Show_Product_Count == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should the number of products for each color be displayed?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	</table>

	<table class="form-table noSubSections ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?> <?php echo ( ( $EWD_UWCF_Full_Version != 'Yes' or get_option('EWD_UWCF_Trial_Happening') == 'Yes' ) ? ' ewd-uwcf-premium-options-table' : '' ); ?><?php echo ($Enable_Colors != 'Yes' ? ' no-min' : ''); ?>" data-filtertype="Colors">
	<tr data-filtertype='Colors' class='<?php echo ($Enable_Colors != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Color Filter Layout", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Color Filter Layout", 'color-filters'); ?></span></legend>
			<label title='List' class='ewd-uwcf-admin-input-container'><input type='radio' name='color_filters_display' value='List' <?php if($Color_Filters_Display == "List") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("List", 'color-filters')?></span></label><br />
			<label title='Tiles' class='ewd-uwcf-admin-input-container'><input type='radio' name='color_filters_display' value='Tiles' <?php if($Color_Filters_Display == "Tiles") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Tiles", 'color-filters')?></span></label><br />
			<label title='Swatch' class='ewd-uwcf-admin-input-container'><input type='radio' name='color_filters_display' value='Swatch' <?php if($Color_Filters_Display == "Swatch") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Swatch", 'color-filters')?></span></label><br />
			<label title='Checklist' class='ewd-uwcf-admin-input-container'><input type='radio' name='color_filters_display' value='Checklist' <?php if($Color_Filters_Display == "Checklist") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Checklist", 'color-filters')?></span></label><br />
			<label title='Dropdown' class='ewd-uwcf-admin-input-container'><input type='radio' name='color_filters_display' value='Dropdown' <?php if($Color_Filters_Display == "Dropdown") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Dropdown", 'color-filters')?></span></label><br />
			<p><?php _e("Which type of display should be used for filter colors?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Colors' class='<?php echo ($Enable_Colors != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Display Thumbnail Colors", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Color Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='display_thumbnail_colors' value='Yes' <?php if($Display_Thumbnail_Colors == "Yes") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='display_thumbnail_colors' value='No' <?php if($Display_Thumbnail_Colors == "No") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="display_thumbnail_colors" <?php if($Display_Thumbnail_Colors == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a list of available colors be shown under each product thumbnail on the shop page?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Colors' class='<?php echo ($Enable_Colors != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Display on Product Page", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Display on Product Page", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='colors_product_page_display' value='Yes' <?php if($Colors_Product_Page_Display == "Yes") {echo "checked='checked'";} ?> <?php if($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='colors_product_page_display' value='No' <?php if($Colors_Product_Page_Display == "No") {echo "checked='checked'";} ?> <?php if($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="colors_product_page_display" <?php if($Colors_Product_Page_Display == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a product's color, if any, be displayed on the product page?", 'color-filters')?></p>
		</fieldset>
	</tr>
	<tr data-filtertype='Colors' class='<?php echo ($Enable_Colors != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Use Color for Variations", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Use Color for Variations", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='colors_used_for_variations' value='Yes' <?php if($Colors_Used_For_Variations == "Yes") {echo "checked='checked'";} ?> <?php if($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='colors_used_for_variations' value='No' <?php if($Colors_Used_For_Variations == "No") {echo "checked='checked'";} ?> <?php if($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="colors_used_for_variations" <?php if($Colors_Used_For_Variations == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should it be possible to use colors for variations? Save the product for new colors to be shown as options for variations.", 'color-filters')?></p>
		</fieldset>
	</tr>
	<?php if ($EWD_UWCF_Full_Version != "Yes") { ?>
		<tr data-filtertype='Colors' class='ewd-uwcf-premium-options-table-overlay<?php echo ($Enable_Colors != "Yes" ? " ewd-uwcf-hidden" : ""); ?>'>
			<th colspan="2">
				<div class="ewd-uwcf-unlock-premium">
					<img src="<?php echo plugins_url( '../images/options-asset-lock.png', __FILE__ ); ?>" alt="Upgrade to Ultimate WooCommerce Filters Premium">
					<p>Access this section by by upgrading to premium</p>
					<a href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" class="ewd-uwcf-dashboard-get-premium-widget-button" target="_blank">UPGRADE NOW</a>
				</div>
			</th>
		</tr>
	<?php } ?>
	</table>
</div> <!--form-table-->


<br />

<div class="ewd-uwcf-admin-section-heading ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>"><?php _e('Size Filtering', 'color-filters'); ?></div>

<div class="form-table ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
	<table class="form-table noSubSections ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
	<tr>
	<th scope="row"><?php _e("Enable Size Filtering", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Enable Size Filtering", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' class='ewd-uwcf-toggle' data-filtertype='Sizes' name='enable_sizes' value='Yes' <?php if($Enable_Sizes == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' class='ewd-uwcf-toggle' data-filtertype='Sizes' name='enable_sizes' value='No' <?php if($Enable_Sizes == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="enable_sizes" <?php if($Enable_Sizes == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should the size filters be displayed when the plugin's widget or shortcode is used?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Sizes' class='<?php echo ($Enable_Sizes != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Show Text", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Size Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='size_filters_show_text' value='Yes' <?php if($Size_Filters_Show_Text == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='size_filters_show_text' value='No' <?php if($Size_Filters_Show_Text == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="size_filters_show_text" <?php if($Size_Filters_Show_Text == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a size's name be displayed in the filtering box?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Sizes' class='<?php echo ($Enable_Sizes != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Hide Empty", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Size Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='size_filters_hide_empty' value='Yes' <?php if($Size_Filters_Hide_Empty == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='size_filters_hide_empty' value='No' <?php if($Size_Filters_Hide_Empty == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="size_filters_hide_empty" <?php if($Size_Filters_Hide_Empty == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Which sizes with no associated products be hidden?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Sizes' class='<?php echo ($Enable_Sizes != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Show Product Count", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Show Product Count", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='size_filters_show_product_count' value='Yes' <?php if($Size_Filters_Show_Product_Count == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='size_filters_show_product_count' value='No' <?php if($Size_Filters_Show_Product_Count == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="size_filters_show_product_count" <?php if($Size_Filters_Show_Product_Count == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should the number of products for each size be displayed?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	</table>

	<table class="form-table noSubSections ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?><?php echo ( ( $EWD_UWCF_Full_Version != 'Yes' or get_option('EWD_UWCF_Trial_Happening') == 'Yes' ) ? ' ewd-uwcf-premium-options-table' : '' ); ?><?php echo ($Enable_Sizes != 'Yes' ? ' no-min' : ''); ?>" data-filtertype="Sizes">
	<tr data-filtertype='Sizes' class='<?php echo ($Enable_Sizes != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Size Filter Layout", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Size Filter Layout", 'color-filters'); ?></span></legend>
			<label title='List' class='ewd-uwcf-admin-input-container'><input type='radio' name='size_filters_display' value='List' <?php if($Size_Filters_Display == "List") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("List", 'color-filters')?></span></label><br />
			<label title='Checklist' class='ewd-uwcf-admin-input-container'><input type='radio' name='size_filters_display' value='Checklist' <?php if($Size_Filters_Display == "Checklist") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Checklist", 'color-filters')?></span></label><br />
			<label title='Dropdown' class='ewd-uwcf-admin-input-container'><input type='radio' name='size_filters_display' value='Dropdown' <?php if($Size_Filters_Display == "Dropdown") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Dropdown", 'color-filters')?></span></label><br />
			<p><?php _e("Which type of display should be used for size filters?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Sizes' class='<?php echo ($Enable_Sizes != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Display Thumbnail Sizes", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Size Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='display_thumbnail_sizes' value='Yes' <?php if($Display_Thumbnail_Sizes == "Yes") {echo "checked='checked'";} ?> <?php if($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='display_thumbnail_sizes' value='No' <?php if($Display_Thumbnail_Sizes == "No") {echo "checked='checked'";} ?> <?php if($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="display_thumbnail_sizes" <?php if($Display_Thumbnail_Sizes == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a list of available sizes be shown under each product thumbnail on the shop page?", 'color-filters')?></p>
		</fieldset>
	</tr>
	<tr data-filtertype='Sizes' class='<?php echo ($Enable_Sizes != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Display on Product Page", 'size-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Display on Product Page", 'size-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='sizes_product_page_display' value='Yes' <?php if($Sizes_Product_Page_Display == "Yes") {echo "checked='checked'";} ?> <?php if($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("Yes", 'size-filters')?></span></label><br />
				<label title='No'><input type='radio' name='sizes_product_page_display' value='No' <?php if($Sizes_Product_Page_Display == "No") {echo "checked='checked'";} ?> <?php if($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("No", 'size-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="sizes_product_page_display" <?php if($Sizes_Product_Page_Display == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a product's size, if any, be displayed on the product page?", 'size-filters')?></p>
		</fieldset>
	</tr>
	<tr data-filtertype='Sizes' class='<?php echo ($Enable_Sizes != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Use Sizes for Variations", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Use Sizes for Variations", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='sizes_used_for_variations' value='Yes' <?php if($Sizes_Used_For_Variations == "Yes") {echo "checked='checked'";} ?> <?php if($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='sizes_used_for_variations' value='No' <?php if($Sizes_Used_For_Variations == "No") {echo "checked='checked'";} ?> <?php if($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="sizes_used_for_variations" <?php if($Sizes_Used_For_Variations == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should it be possible to use sizes for variations? Save the product for new sizes to be shown as options for variations.", 'color-filters')?></p>
		</fieldset>
	</tr>
	<?php if ($EWD_UWCF_Full_Version != "Yes") { ?>
		<tr data-filtertype='Sizes' class='ewd-uwcf-premium-options-table-overlay<?php echo ($Enable_Sizes != "Yes" ? " ewd-uwcf-hidden" : ""); ?>'>
			<th colspan="2">
				<div class="ewd-uwcf-unlock-premium">
					<img src="<?php echo plugins_url( '../images/options-asset-lock.png', __FILE__ ); ?>" alt="Upgrade to Ultimate WooCommerce Filters Premium">
					<p>Access this section by by upgrading to premium</p>
					<a href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" class="ewd-uwcf-dashboard-get-premium-widget-button" target="_blank">UPGRADE NOW</a>
				</div>
			</th>
		</tr>
	<?php } ?>
	</table>
</div>


<br />

<div class="ewd-uwcf-admin-section-heading ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>"><?php _e('Category Filtering', 'color-filters'); ?></div>

<div class="form-table ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
	<table class="form-table noSubSections ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
	<tr>
	<th scope="row"><?php _e("Enable Category Filtering", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Enable Category Filtering", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' class='ewd-uwcf-toggle' data-filtertype='Categories' name='enable_categories' value='Yes' <?php if($Enable_Categories == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' class='ewd-uwcf-toggle' data-filtertype='Categories' name='enable_categories' value='No' <?php if($Enable_Categories == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="enable_categories" <?php if($Enable_Categories == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should the category filters be displayed when the plugin's widget or shortcode is used?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Categories' class='<?php echo ($Enable_Categories != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Show Text", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Category Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='category_filters_show_text' value='Yes' <?php if($Category_Filters_Show_Text == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='category_filters_show_text' value='No' <?php if($Category_Filters_Show_Text == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="category_filters_show_text" <?php if($Category_Filters_Show_Text == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a category's name be displayed in the filtering box?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Categories' class='<?php echo ($Enable_Categories != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Hide Empty", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Category Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='category_filters_hide_empty' value='Yes' <?php if($Category_Filters_Hide_Empty == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='category_filters_hide_empty' value='No' <?php if($Category_Filters_Hide_Empty == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="category_filters_hide_empty" <?php if($Category_Filters_Hide_Empty == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Which categories with no associated products be hidden?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Categories' class='<?php echo ($Enable_Categories != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Show Product Count", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Show Product Count", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='category_filters_show_product_count' value='Yes' <?php if($Category_Filters_Show_Product_Count == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='category_filters_show_product_count' value='No' <?php if($Category_Filters_Show_Product_Count == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="category_filters_show_product_count" <?php if($Category_Filters_Show_Product_Count == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should the number of products for each category be displayed?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	</table>

	<table class="form-table noSubSections ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?><?php echo ( ( $EWD_UWCF_Full_Version != 'Yes' or get_option('EWD_UWCF_Trial_Happening') == 'Yes' ) ? ' ewd-uwcf-premium-options-table' : '' ); ?><?php echo ($Enable_Categories != 'Yes' ? ' no-min' : ''); ?>" data-filtertype="Categories">
	<tr data-filtertype='Categories' class='<?php echo ($Enable_Categories != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Category Filter Layout", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Category Filter Layout", 'color-filters'); ?></span></legend>
			<label title='List' class='ewd-uwcf-admin-input-container'><input type='radio' name='category_filters_display' value='List' <?php if($Category_Filters_Display == "List") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("List", 'color-filters')?></span></label><br />
			<label title='Checklist' class='ewd-uwcf-admin-input-container'><input type='radio' name='category_filters_display' value='Checklist' <?php if($Category_Filters_Display == "Checklist") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Checklist", 'color-filters')?></span></label><br />
			<label title='Dropdown' class='ewd-uwcf-admin-input-container'><input type='radio' name='category_filters_display' value='Dropdown' <?php if($Category_Filters_Display == "Dropdown") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Dropdown", 'color-filters')?></span></label><br />
			<p><?php _e("Which type of display should be used for filter categories?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Categories' class='<?php echo ($Enable_Categories != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Display Thumbnail Categories", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Category Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='display_thumbnail_categories' value='Yes' <?php if($Display_Thumbnail_Categories == "Yes") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='display_thumbnail_categories' value='No' <?php if($Display_Thumbnail_Categories == "No") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="display_thumbnail_categories" <?php if($Display_Thumbnail_Categories == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a list of available categories be shown under each product thumbnail on the shop page?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<?php if ($EWD_UWCF_Full_Version != "Yes") { ?>
		<tr data-filtertype='Categories' class='ewd-uwcf-premium-options-table-overlay<?php echo ($Enable_Categories != "Yes" ? " ewd-uwcf-hidden" : ""); ?>'>
			<th colspan="2">
				<div class="ewd-uwcf-unlock-premium">
					<img src="<?php echo plugins_url( '../images/options-asset-lock.png', __FILE__ ); ?>" alt="Upgrade to Ultimate WooCommerce Filters Premium">
					<p>Access this section by by upgrading to premium</p>
					<a href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" class="ewd-uwcf-dashboard-get-premium-widget-button" target="_blank">UPGRADE NOW</a>
				</div>
			</th>
		</tr>
	<?php } ?>
	</table>
</div>


<br />

<div class="ewd-uwcf-admin-section-heading ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>"><?php _e('Tag Filtering', 'color-filters'); ?></div>

<div class="form-table ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
	<table class="form-table noSubSections ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
	<tr>
	<th scope="row"><?php _e("Enable Tag Filtering", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Enable Tag Filtering", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' class='ewd-uwcf-toggle' data-filtertype='Tags' name='enable_tags' value='Yes' <?php if($Enable_Tags == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' class='ewd-uwcf-toggle' data-filtertype='Tags' name='enable_tags' value='No' <?php if($Enable_Tags == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="enable_tags" <?php if($Enable_Tags == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should the tag filters be displayed when the plugin's widget or shortcode is used?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Tags' class='<?php echo ($Enable_Tags != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Show Text", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Tag Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='tag_filters_show_text' value='Yes' <?php if($Tag_Filters_Show_Text == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='tag_filters_show_text' value='No' <?php if($Tag_Filters_Show_Text == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="tag_filters_show_text" <?php if($Tag_Filters_Show_Text == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a tag's name be displayed in the filtering box?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Tags' class='<?php echo ($Enable_Tags != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Hide Empty", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Tag Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='tag_filters_hide_empty' value='Yes' <?php if($Tag_Filters_Hide_Empty == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='tag_filters_hide_empty' value='No' <?php if($Tag_Filters_Hide_Empty == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="tag_filters_hide_empty" <?php if($Tag_Filters_Hide_Empty == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Which tags with no associated products be hidden?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Tags' class='<?php echo ($Enable_Tags != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Show Product Count", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Show Product Count", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='tag_filters_show_product_count' value='Yes' <?php if($Tag_Filters_Show_Product_Count == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='tag_filters_show_product_count' value='No' <?php if($Tag_Filters_Show_Product_Count == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="tag_filters_show_product_count" <?php if($Tag_Filters_Show_Product_Count == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should the number of products for each tag be displayed?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	</table>

	<table class="form-table noSubSections ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?><?php echo ( ( $EWD_UWCF_Full_Version != 'Yes' or get_option('EWD_UWCF_Trial_Happening') == 'Yes' ) ? ' ewd-uwcf-premium-options-table' : '' ); ?><?php echo ($Enable_Tags != 'Yes' ? ' no-min' : ''); ?>" data-filtertype="Tags">
	<tr data-filtertype='Tags' class='<?php echo ($Enable_Tags != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Tag Filter Layout", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Tag Filter Layout", 'color-filters'); ?></span></legend>
			<label title='List' class='ewd-uwcf-admin-input-container'><input type='radio' name='tag_filters_display' value='List' <?php if($Tag_Filters_Display == "List") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("List", 'color-filters')?></span></label><br />
			<label title='Checklist' class='ewd-uwcf-admin-input-container'><input type='radio' name='tag_filters_display' value='Checklist' <?php if($Tag_Filters_Display == "Checklist") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Checklist", 'color-filters')?></span></label><br />
			<label title='Dropdown' class='ewd-uwcf-admin-input-container'><input type='radio' name='tag_filters_display' value='Dropdown' <?php if($Tag_Filters_Display == "Dropdown") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Dropdown", 'color-filters')?></span></label><br />
			<p><?php _e("Which type of display should be used for filter tags?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='Tags' class='<?php echo ($Enable_Tags != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Display Thumbnail Tags", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Tag Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='display_thumbnail_tags' value='Yes' <?php if($Display_Thumbnail_Tags == "Yes") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='display_thumbnail_tags' value='No' <?php if($Display_Thumbnail_Tags == "No") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="display_thumbnail_tags" <?php if($Display_Thumbnail_Tags == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a list of available tags be shown under each product thumbnail on the shop page?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<?php if ($EWD_UWCF_Full_Version != "Yes") { ?>
		<tr data-filtertype='Tags' class='ewd-uwcf-premium-options-table-overlay<?php echo ($Enable_Tags != "Yes" ? " ewd-uwcf-hidden" : ""); ?>'>
			<th colspan="2">
				<div class="ewd-uwcf-unlock-premium">
					<img src="<?php echo plugins_url( '../images/options-asset-lock.png', __FILE__ ); ?>" alt="Upgrade to Ultimate WooCommerce Filters Premium">
					<p>Access this section by by upgrading to premium</p>
					<a href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" class="ewd-uwcf-dashboard-get-premium-widget-button" target="_blank">UPGRADE NOW</a>
				</div>
			</th>
		</tr>
	<?php } ?>
	</table>
</div>


<br />

<div class="ewd-uwcf-admin-section-heading ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>"><?php _e("Text Search Options", 'color-filters'); ?></div>

<table class="form-table ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
<tr>
<th scope="row"><?php _e("Enable Text Search", 'color-filters'); ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><?php _e("Enable Text Search", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='enable_text_search' value='Yes' <?php if($Enable_Text_Search == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='enable_text_search' value='No' <?php if($Enable_Text_Search == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="enable_text_search" <?php if($Enable_Text_Search == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a text search box be displayed when the plugin's widget or shortcode is used?", 'color-filters')?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e("Enable Product Title Autocomplete", 'color-filters'); ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><?php _e("Enable Product Title Autocomplete", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='enable_autocomplete' value='Yes' <?php if($Enable_Autocomplete == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='enable_autocomplete' value='No' <?php if($Enable_Autocomplete == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="enable_autocomplete" <?php if($Enable_Autocomplete == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("If text search is enabled, should a list of matching products be displayed when a user starts typing?", 'color-filters')?></p>
	</fieldset>
</td>
</tr>
</table>

<div class="ewd-uwcf-admin-section-heading ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>"><?php _e("Price Filtering", 'color-filters'); ?></div>

<table class="form-table ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
<tr>
<th scope="row"><?php _e("Price Filtering", 'color-filters'); ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><?php _e("Price Filtering", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='price_enable' value='Yes' <?php if($Price_Enable == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='price_enable' value='No' <?php if($Price_Enable == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="price_enable" <?php if($Price_Enable == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should visitors be able to filter products based on price?", 'color-filters')?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e("Price Filter Control", 'color-filters'); ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><?php _e("Price Filter Control", 'color-filters'); ?></span></legend>
		<label title='List' class='ewd-uwcf-admin-input-container'><input type='radio' name='price_display' value='Text' <?php if($Price_Display == "Text") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Text", 'color-filters')?></span></label><br />
		<label title='Checklist' class='ewd-uwcf-admin-input-container'><input type='radio' name='price_display' value='Slider' <?php if($Price_Display == "Slider") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Slider", 'color-filters')?></span></label><br />
		<p><?php _e("Which type of control should be used for filtering products based on price?", 'color-filters')?></p>
	</fieldset>
</td>
</tr>
</table>

<br />

<div class="ewd-uwcf-admin-section-heading ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>"><?php _e("Ratings Filtering", 'color-filters'); ?></div>

<table class="form-table ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
<tr>
<th scope="row"><?php _e("Enable Ratings Filtering", 'color-filters'); ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><?php _e("Enable Ratings Filtering", 'color-filters'); ?></span></legend>
		<div class="ewd-uwcf-admin-hide-radios">
			<label title='Yes'><input type='radio' name='enable_ratings_filtering' value='Yes' <?php if($Enable_Ratings_Filtering == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
			<label title='No'><input type='radio' name='enable_ratings_filtering' value='No' <?php if($Enable_Ratings_Filtering == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
		</div>
		<label class="ewd-uwcf-admin-switch">
			<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="enable_ratings_filtering" <?php if($Enable_Ratings_Filtering == "Yes") {echo "checked='checked'";} ?>>
			<span class="ewd-uwcf-admin-switch-slider round"></span>
		</label>		
		<p><?php _e("Should a slider be added to filter products by rating?", 'color-filters')?></p>
	</fieldset>
</td>
</tr>
<tr>
<th scope="row"><?php _e("Reviews to Use", 'color-filters'); ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><?php _e("Reviews to Use", 'color-filters'); ?></span></legend>
		<label title='WooCommerce' class='ewd-uwcf-admin-input-container'><input type='radio' name='ratings_type' value='WooCommerce' <?php if($Ratings_Type == "WooCommerce") {echo "checked='checked'";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("WooCommerce", 'color-filters')?></span></label><br />
		<label title='Ultimate_Reviews' class='ewd-uwcf-admin-input-container'><input type='radio' name='ratings_type' value='Ultimate_Reviews' <?php if($Ratings_Type == "Ultimate_Reviews") {echo "checked='checked'";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Ultimate Reviews", 'color-filters')?></span></label><br />
		<p><?php _e("If reviews filtering is enabled, which type of reviews should products be filtered by?", 'color-filters')?></p>
	</fieldset>
</td>
</tr>
</table>

<div class="ewd-uwcf-admin-section-heading ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>"><?php _e("In-Stock Filtering", 'color-filters'); ?></div>

<table class="form-table ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
<tr>
<th scope="row"><?php _e("Enable In-Stock Filtering", 'color-filters'); ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><?php _e("Enable In-Stock Filtering", 'color-filters'); ?></span></legend>
		<div class="ewd-uwcf-admin-hide-radios">
			<label title='Yes'><input type='radio' name='enable_instock_filtering' value='Yes' <?php if($Enable_InStock_Filtering == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
			<label title='No'><input type='radio' name='enable_instock_filtering' value='No' <?php if($Enable_InStock_Filtering == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
		</div>
		<label class="ewd-uwcf-admin-switch">
			<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="enable_instock_filtering" <?php if($Enable_InStock_Filtering == "Yes") {echo "checked='checked'";} ?>>
			<span class="ewd-uwcf-admin-switch-slider round"></span>
		</label>		
		<p><?php _e("Should an in-stock toggle be added to the filtering widget?", 'color-filters')?></p>
	</fieldset>
</td>
</tr>
</table>

<div class="ewd-uwcf-admin-section-heading ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>"><?php _e("On-Sale Filtering", 'color-filters'); ?></div>

<table class="form-table ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
<tr>
<th scope="row"><?php _e("Enable On-Sale Filtering", 'color-filters'); ?></th>
<td>
	<fieldset><legend class="screen-reader-text"><span><?php _e("Enable On-Sale Filtering", 'color-filters'); ?></span></legend>
		<div class="ewd-uwcf-admin-hide-radios">
			<label title='Yes'><input type='radio' name='enable_onsale_filtering' value='Yes' <?php if($Enable_OnSale_Filtering == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
			<label title='No'><input type='radio' name='enable_onsale_filtering' value='No' <?php if($Enable_OnSale_Filtering == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
		</div>
		<label class="ewd-uwcf-admin-switch">
			<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="enable_onsale_filtering" <?php if($Enable_OnSale_Filtering == "Yes") {echo "checked='checked'";} ?>>
			<span class="ewd-uwcf-admin-switch-slider round"></span>
		</label>		
		<p><?php _e("Should an on-sale toggle be added to the filtering widget?", 'color-filters')?></p>
	</fieldset>
</td>
</tr>
</table>

<?php 
	foreach ($attribute_taxonomies as $attribute_taxonomy) {
    	if ($attribute_taxonomy->attribute_name == "ewd_uwcf_colors" or $attribute_taxonomy->attribute_name == "ewd_uwcf_sizes") {continue;}

    	if ($Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] == "") {$Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] = "No";}
    	if ($Attribute_Options[$attribute_taxonomy->attribute_name]['Display'] == "") {$Attribute_Options[$attribute_taxonomy->attribute_name]['Display'] = "List";}
    	if ($Attribute_Options[$attribute_taxonomy->attribute_name]['Show_Text'] == "") {$Attribute_Options[$attribute_taxonomy->attribute_name]['Show_Text'] = "Yes";}
    	if ($Attribute_Options[$attribute_taxonomy->attribute_name]['Hide_Empty'] == "") {$Attribute_Options[$attribute_taxonomy->attribute_name]['Hide_Empty'] = "No";}
    	if ($Attribute_Options[$attribute_taxonomy->attribute_name]['Product_Count'] == "") {$Attribute_Options[$attribute_taxonomy->attribute_name]['Product_Count'] = "No";}
    	if ($Attribute_Options[$attribute_taxonomy->attribute_name]['Thumbnail_Tags'] == "") {$Attribute_Options[$attribute_taxonomy->attribute_name]['Thumbnail_Tags'] = "No";}
?>
<br />

<div class="ewd-uwcf-admin-section-heading ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>"><?php echo $attribute_taxonomy->attribute_label . __(" Attribute Filtering", 'color-filters'); ?></div>

<div class="form-table ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
	<table class="form-table noSubSections ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?>">
	<tr>
	<th scope="row"><?php printf(__("Enable %s Filtering", 'color-filters'), $attribute_taxonomy->attribute_label); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Enable Tag Filtering", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' class='ewd-uwcf-toggle' data-filtertype='attribute_<?php echo $attribute_taxonomy->attribute_name; ?>' name='<?php echo $attribute_taxonomy->attribute_name; ?>_enable' value='Yes' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' class='ewd-uwcf-toggle' data-filtertype='attribute_<?php echo $attribute_taxonomy->attribute_name; ?>' name='<?php echo $attribute_taxonomy->attribute_name; ?>_enable' value='No' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="<?php echo $attribute_taxonomy->attribute_name; ?>_enable" <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should the $attribute_taxonomy->attribute_label filters be displayed when the plugin's widget or shortcode is used?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='attribute_<?php echo $attribute_taxonomy->attribute_name; ?>' class='<?php echo ($Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Show Text", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Tag Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='<?php echo $attribute_taxonomy->attribute_name; ?>_show_text' value='Yes' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Show_Text'] == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='<?php echo $attribute_taxonomy->attribute_name; ?>_show_text' value='No' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Show_Text'] == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="<?php echo $attribute_taxonomy->attribute_name; ?>_show_text" <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Show_Text'] == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should the attribute's name be displayed in the filtering box?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='attribute_<?php echo $attribute_taxonomy->attribute_name; ?>' class='<?php echo ($Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Hide Empty", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Tag Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='<?php echo $attribute_taxonomy->attribute_name; ?>_hide_empty' value='Yes' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Hide_Empty'] == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='<?php echo $attribute_taxonomy->attribute_name; ?>_hide_empty' value='No' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Hide_Empty'] == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="<?php echo $attribute_taxonomy->attribute_name; ?>_hide_empty" <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Hide_Empty'] == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should attributes with no associated products be hidden?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='attribute_<?php echo $attribute_taxonomy->attribute_name; ?>' class='<?php echo ($Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php _e("Show Product Count", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Show Product Count", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='<?php echo $attribute_taxonomy->attribute_name; ?>_product_count' value='Yes' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Product_Count'] == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='<?php echo $attribute_taxonomy->attribute_name; ?>_product_count' value='No' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Product_Count'] == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="<?php echo $attribute_taxonomy->attribute_name; ?>_product_count" <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Product_Count'] == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should the number of products for each attribute be displayed?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	</table>

	<table class="form-table noSubSections ewd-uwcf-non-table-format <?php echo ($Enable_Table_Format == 'Yes' ? 'ewd-uwcf-hidden' : ''); ?><?php echo ( ( $EWD_UWCF_Full_Version != 'Yes' or get_option('EWD_UWCF_Trial_Happening') == 'Yes' ) ? ' ewd-uwcf-premium-options-table' : '' ); ?><?php echo ($Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] != 'Yes' ? ' no-min' : ''); ?>" data-filtertype="attribute_<?php echo $attribute_taxonomy->attribute_name; ?>">
	<tr data-filtertype='attribute_<?php echo $attribute_taxonomy->attribute_name; ?>' class='<?php echo ($Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php echo $attribute_taxonomy->attribute_label . __(" Filter Layout", 'color-filters'); ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Tag Filter Layout", 'color-filters'); ?></span></legend>
			<label title='List' class='ewd-uwcf-admin-input-container'><input type='radio' name='<?php echo $attribute_taxonomy->attribute_name; ?>_display' value='List' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Display'] == "List") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("List", 'color-filters')?></span></label><br />
			<label title='Checklist' class='ewd-uwcf-admin-input-container'><input type='radio' name='<?php echo $attribute_taxonomy->attribute_name; ?>_display' value='Checklist' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Display'] == "Checklist") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Checklist", 'color-filters')?></span></label><br />
			<label title='Dropdown' class='ewd-uwcf-admin-input-container'><input type='radio' name='<?php echo $attribute_taxonomy->attribute_name; ?>_display' value='Dropdown' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Display'] == "Dropdown") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Dropdown", 'color-filters')?></span></label><br />
			<p><?php _e("Which type of display should be used for filter attributes?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<tr data-filtertype='attribute_<?php echo $attribute_taxonomy->attribute_name; ?>' class='<?php echo ($Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] != "Yes" ? "ewd-uwcf-hidden" : ""); ?>'>
	<th scope="row"><?php echo __("Display Thumbnail ", 'color-filters') . $attribute_taxonomy->attribute_label; ?></th>
	<td>
		<fieldset><legend class="screen-reader-text"><span><?php _e("Tag Filter Layout", 'color-filters'); ?></span></legend>
			<div class="ewd-uwcf-admin-hide-radios">
				<label title='Yes'><input type='radio' name='<?php echo $attribute_taxonomy->attribute_name; ?>_thumbnail_tags' value='Yes' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Thumbnail_Tags'] == "Yes") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
				<label title='No'><input type='radio' name='<?php echo $attribute_taxonomy->attribute_name; ?>_thumbnail_tags' value='No' <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Thumbnail_Tags'] == "No") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
			</div>
			<label class="ewd-uwcf-admin-switch">
				<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="<?php echo $attribute_taxonomy->attribute_name; ?>_thumbnail_tags" <?php if($Attribute_Options[$attribute_taxonomy->attribute_name]['Thumbnail_Tags'] == "Yes") {echo "checked='checked'";} ?>>
				<span class="ewd-uwcf-admin-switch-slider round"></span>
			</label>		
			<p><?php _e("Should a list of available attributes be shown under each product thumbnail on the shop page?", 'color-filters')?></p>
		</fieldset>
	</td>
	</tr>
	<?php if ($EWD_UWCF_Full_Version != "Yes") { ?>
		<tr data-filtertype='attribute_<?php echo $attribute_taxonomy->attribute_name; ?>' class='ewd-uwcf-premium-options-table-overlay<?php echo ($Attribute_Options[$attribute_taxonomy->attribute_name]['Enabled'] != "Yes" ? " ewd-uwcf-hidden" : ""); ?>'>
			<th colspan="2">
				<div class="ewd-uwcf-unlock-premium">
					<img src="<?php echo plugins_url( '../images/options-asset-lock.png', __FILE__ ); ?>" alt="Upgrade to Ultimate WooCommerce Filters Premium">
					<p>Access this section by by upgrading to premium</p>
					<a href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" class="ewd-uwcf-dashboard-get-premium-widget-button" target="_blank">UPGRADE NOW</a>
				</div>
			</th>
		</tr>
	<?php } ?>
	</table>
</div>
<?php }	 ?>

</div>

<div id='Other' class='uwcf-option-set<?php echo ( $Display_Tab == 'Other' ? '' : ' uwcf-hidden' ); ?>'>

	<br />

	<div class="ewd-uwcf-admin-section-heading"><?php _e("General Options", 'color-filters'); ?></div>

	<table class="form-table">
		<tr>
			<th scope="row">Set Access Role</th>
			<td>
				<fieldset><legend class="screen-reader-text"><span>Set Access Role</span></legend>
					<label title='Access Role'></label>
					<select name='access_role'>
						<option value="administrator"<?php if($Access_Role == "administrator") {echo " selected=selected";} ?>>Administrator</option>
						<option value="delete_others_pages"<?php if($Access_Role == "delete_others_pages") {echo " selected=selected";} ?>>Editor</option>
						<option value="delete_published_posts"<?php if($Access_Role == "delete_published_posts") {echo " selected=selected";} ?>>Author</option>
						<option value="delete_posts"<?php if($Access_Role == "delete_posts") {echo " selected=selected";} ?>>Contributor</option>
						<option value="read"<?php if($Access_Role == "read") {echo " selected=selected";} ?>>Subscriber</option>
					</select>
					<p>Who should have access to the "WC Filters" admin menu?</p>
				</fieldset>
			</td>
		</tr>
		<tr>
			<th scope="row"><?php _e("Add 'Reset All' Button", 'color-filters'); ?></th>
			<td>
				<fieldset><legend class="screen-reader-text"><span><?php _e("Add 'Reset All' Button", 'color-filters'); ?></span></legend>
					<div class="ewd-uwcf-admin-hide-radios">
						<label title='Yes'><input type='radio' class='ewd-uwcf-toggle' name='reset_all_button' value='Yes' <?php if($Reset_All_Button == "Yes") {echo "checked='checked'";} ?> /> <span><?php _e("Yes", 'color-filters')?></span></label><br />
						<label title='No'><input type='radio' class='ewd-uwcf-toggle' name='reset_all_button' value='No' <?php if($Reset_All_Button == "No") {echo "checked='checked'";} ?> /> <span><?php _e("No", 'color-filters')?></span></label><br />
					</div>
					<label class="ewd-uwcf-admin-switch">
						<input type="checkbox" class="ewd-uwcf-admin-option-toggle" data-inputname="reset_all_button" <?php if($Reset_All_Button == "Yes") {echo "checked='checked'";} ?>>
						<span class="ewd-uwcf-admin-switch-slider round"></span>
					</label>		
					<p><?php _e("Should a 'Reset All' button be added to the filters section?", 'color-filters')?></p>
				</fieldset>
			</td>
		</tr>
	</table>
</div>

<div id='Labelling' class='uwcf-option-set<?php echo ( $Display_Tab == 'Labelling' ? '' : ' uwcf-hidden' ); ?>'>
	<h2 id="label-order-options" class="uwcf-options-tab-title">Labelling Options</h2>

	<br />

	<div class="ewd-uwcf-admin-section-heading"><?php _e('Widget &amp; Shortcode', 'color-filters'); ?></div>

	<div class="ewd-uwcf-admin-styling-section <?php echo $EWD_UWCF_Full_Version; ?>">
		<div class="ewd-uwcf-admin-styling-subsection">
			<p>Replace the default text in the widget and shortcode</p>
			<div class="ewd-admin-labelling-section">
				<label>
					<p><?php _e("Show All Colors", 'color-filters')?></p>
					<input type='text' name='show_all_colors_label' value='<?php echo $Show_All_Colors_Label; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
				</label>
				<label>
					<p><?php _e("Show All Sizes", 'color-filters')?></p>
					<input type='text' name='show_all_sizes_label' value='<?php echo $Show_All_Sizes_Label; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
				</label>
				<label>
					<p><?php _e("Show All Categories", 'color-filters')?></p>
					<input type='text' name='show_all_categories_label' value='<?php echo $Show_All_Categories_Label; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
				</label>
				<label>
					<p><?php _e("Show All Tags", 'color-filters')?></p>
					<input type='text' name='show_all_tags_label' value='<?php echo $Show_All_Tags_Label; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
				</label>
				<label>
					<p><?php _e("'Show All' for attributes", 'color-filters')?></p>
					<input type='text' name='show_all_attributes_label' value='<?php echo $Show_All_Attributes_Label; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
				</label>
				<label>
					<p><?php _e("Rating", 'color-filters')?></p>
					<input type='text' name='rating_label' value='<?php echo $Rating_Label; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
				</label>
			</div>
		</div>
		<?php if ($EWD_UWCF_Full_Version != "Yes") { ?>
			<div class="ewd-uwcf-premium-options-table-overlay">
				<div class="ewd-uwcf-unlock-premium">
					<img src="<?php echo plugins_url( '../images/options-asset-lock.png', __FILE__ ); ?>" alt="Upgrade to Ultimate WooCommerce Filters Premium">
					<p>Access this section by by upgrading to premium</p>
					<a href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" class="ewd-uwcf-dashboard-get-premium-widget-button" target="_blank">UPGRADE NOW</a>
				</div>
			</div>
		<?php } ?>
	</div>

	<br />

	<div class="ewd-uwcf-admin-section-heading"><?php _e('Product Thumbnail', 'color-filters'); ?></div>

	<div class="ewd-uwcf-admin-styling-section <?php echo $EWD_UWCF_Full_Version; ?>">
		<div class="ewd-uwcf-admin-styling-subsection">
			<p>Replace the default text in the product thumbnail on the shop and archive pages</p>
			<div class="ewd-admin-labelling-section">
				<label>
					<p><?php _e("Colors", 'color-filters')?></p>
					<input type='text' name='thumbnail_colors_label' value='<?php echo $Thumbnail_Colors_Label; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
				</label>
				<label>
					<p><?php _e("Sizes", 'color-filters')?></p>
					<input type='text' name='thumbnail_sizes_label' value='<?php echo $Thumbnail_Sizes_Label; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
				</label>
				<label>
					<p><?php _e("Categories", 'color-filters')?></p>
					<input type='text' name='thumbnail_categories_label' value='<?php echo $Thumbnail_Categories_Label; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
				</label>
				<label>
					<p><?php _e("Tags", 'color-filters')?></p>
					<input type='text' name='thumbnail_tags_label' value='<?php echo $Thumbnail_Tags_Label; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
				</label>
			</div>
		</div>
		<?php if ($EWD_UWCF_Full_Version != "Yes") { ?>
			<div class="ewd-uwcf-premium-options-table-overlay">
				<div class="ewd-uwcf-unlock-premium">
					<img src="<?php echo plugins_url( '../images/options-asset-lock.png', __FILE__ ); ?>" alt="Upgrade to Ultimate WooCommerce Filters Premium">
					<p>Access this section by by upgrading to premium</p>
					<a href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" class="ewd-uwcf-dashboard-get-premium-widget-button" target="_blank">UPGRADE NOW</a>
				</div>
			</div>
		<?php } ?>
	</div>

	<br />

	<div class="ewd-uwcf-admin-section-heading"><?php _e('Product Page', 'color-filters'); ?></div>

	<div class="ewd-uwcf-admin-styling-section <?php echo $EWD_UWCF_Full_Version; ?>">
		<div class="ewd-uwcf-admin-styling-subsection">
			<p>Replace the default text on the product page</p>
			<div class="ewd-admin-labelling-section">
				<label>
					<p><?php _e("Colors", 'color-filters')?></p>
					<input type='text' name='product_page_colors_label' value='<?php echo $Product_Page_Colors_Label; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
				</label>
				<label>
					<p><?php _e("Sizes", 'color-filters')?></p>
					<input type='text' name='product_page_sizes_label' value='<?php echo $Product_Page_Sizes_Label; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
				</label>
			</div>
		</div>
		<?php if ($EWD_UWCF_Full_Version != "Yes") { ?>
			<div class="ewd-uwcf-premium-options-table-overlay">
				<div class="ewd-uwcf-unlock-premium">
					<img src="<?php echo plugins_url( '../images/options-asset-lock.png', __FILE__ ); ?>" alt="Upgrade to Ultimate WooCommerce Filters Premium">
					<p>Access this section by by upgrading to premium</p>
					<a href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" class="ewd-uwcf-dashboard-get-premium-widget-button" target="_blank">UPGRADE NOW</a>
				</div>
			</div>
		<?php } ?>
	</div>

</div>

<div id='Styling' class='uwcf-option-set<?php echo ( $Display_Tab == 'Styling' ? '' : ' uwcf-hidden' ); ?>'>
	<h2 id="styling-order-options" class="uwcf-options-tab-title">Styling Options</h2>

	<br />

	<div class="ewd-uwcf-admin-section-heading"><?php _e('Custom CSS', 'color-filters'); ?></div>

	<div class="ewd-uwcf-admin-styling-section <?php echo $EWD_UWCF_Full_Version; ?>">
		<div class="ewd-uwcf-admin-styling-subsection">
			<div class="ewd-uwcf-admin-styling-subsection-label"><?php _e('Custom CSS', 'color-filters'); ?></div>
			<div class="ewd-uwcf-admin-styling-subsection-content">
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<fieldset>
						<label>
							<textarea name='custom_css'><?php echo $Custom_CSS; ?></textarea>
						</label>
					</fieldset>
				</div>
			</div>
		</div>
	</div>

	<br />

	<div class="ewd-uwcf-admin-section-heading"><?php _e('Widget &amp; Shortcode', 'color-filters'); ?></div>

	<div class="ewd-uwcf-admin-styling-section <?php echo $EWD_UWCF_Full_Version; ?>">
		<div class="ewd-uwcf-admin-styling-subsection">
			<div class="ewd-uwcf-admin-styling-subsection-label"><?php _e('Color Shape', 'color-filters'); ?></div>
			<div class="ewd-uwcf-admin-styling-subsection-content">
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<fieldset>
						<label title='Circle' class='ewd-uwcf-admin-input-container'><input type='radio' name='color_filters_color_shape' value='Circle' <?php if($Color_Filters_Color_Shape == "Circle") {echo "checked='checked'";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Circle", 'color-filters')?></span></label><br />
						<label title='Square' class='ewd-uwcf-admin-input-container'><input type='radio' name='color_filters_color_shape' value='Square' <?php if($Color_Filters_Color_Shape == "Square") {echo "checked='checked'";} ?> <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> /><span class='ewd-uwcf-admin-radio-button'></span> <span><?php _e("Square", 'color-filters')?></span></label><br />
					</fieldset>
				</div>
			</div>
		</div>
		<div class="ewd-uwcf-admin-styling-subsection">
			<div class="ewd-uwcf-admin-styling-subsection-label"><?php _e('Color Icons<br><span style="font-weight:400">(Squares or Circles)</span>', 'color-filters'); ?></div>
			<div class="ewd-uwcf-admin-styling-subsection-content">
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<div class="ewd-uwcf-admin-styling-subsection-content-label"><?php _e('Width', 'color-filters'); ?></div>
					<div class="ewd-uwcf-admin-styling-subsection-content-right">
						<input type='text' name='color_icon_size' class='ewd-uwcf-admin-font-size' value='<?php echo $Color_Icon_Size; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
					</div>
				</div>
			</div>
		</div>
		<div class="ewd-uwcf-admin-styling-subsection">
			<div class="ewd-uwcf-admin-styling-subsection-label"><?php _e('Font Options', 'color-filters'); ?></div>
			<div class="ewd-uwcf-admin-styling-subsection-content">
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<div class="ewd-uwcf-admin-styling-subsection-content-label"><?php _e('Color', 'color-filters'); ?></div>
					<div class="ewd-uwcf-admin-styling-subsection-content-right">
						<div class="ewd-uwcf-admin-styling-subsection-content-color-picker">
							<div class="ewd-uwcf-admin-styling-subsection-content-color-picker-label"></div>
							<input type='text' class='ewd-uwcf-spectrum' name='widget_font_color' value='<?php echo $Widget_Font_Color; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
						</div>
					</div>
				</div>
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<div class="ewd-uwcf-admin-styling-subsection-content-label"><?php _e('Font Size', 'color-filters'); ?></div>
					<div class="ewd-uwcf-admin-styling-subsection-content-right">
						<input type='text' name='widget_font_size' class='ewd-uwcf-admin-font-size' value='<?php echo $Widget_Font_Size; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
					</div>
				</div>
			</div>
		</div>
		<div class="ewd-uwcf-admin-styling-subsection">
			<div class="ewd-uwcf-admin-styling-subsection-label"><?php _e('Ratings Bar &amp; Price Slider', 'color-filters'); ?></div>
			<div class="ewd-uwcf-admin-styling-subsection-content">
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<div class="ewd-uwcf-admin-styling-subsection-content-label"><?php _e('Colors', 'color-filters'); ?></div>
					<div class="ewd-uwcf-admin-styling-subsection-content-right">
						<div class="ewd-uwcf-admin-styling-subsection-content-color-picker">
							<div class="ewd-uwcf-admin-styling-subsection-content-color-picker-label"><?php _e('Fill', 'color-filters'); ?></div>
							<input type='text' class='ewd-uwcf-spectrum' name='ratings_bar_fill_color' value='<?php echo $Ratings_Bar_Fill_Color; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
						</div>
						<div class="ewd-uwcf-admin-styling-subsection-content-color-picker">
							<div class="ewd-uwcf-admin-styling-subsection-content-color-picker-label"><?php _e('Empty', 'color-filters'); ?></div>
							<input type='text' class='ewd-uwcf-spectrum' name='ratings_bar_empty_color' value='<?php echo $Ratings_Bar_Empty_Color; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
						</div>
						<div class="ewd-uwcf-admin-styling-subsection-content-color-picker">
							<div class="ewd-uwcf-admin-styling-subsection-content-color-picker-label"><?php _e('Handles', 'color-filters'); ?></div>
							<input type='text' class='ewd-uwcf-spectrum' name='ratings_bar_handle_color' value='<?php echo $Ratings_Bar_Handle_Color; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
						</div>
						<div class="ewd-uwcf-admin-styling-subsection-content-color-picker">
							<div class="ewd-uwcf-admin-styling-subsection-content-color-picker-label"><?php _e('Text', 'color-filters'); ?></div>
							<input type='text' class='ewd-uwcf-spectrum' name='ratings_bar_text_color' value='<?php echo $Ratings_Bar_Text_Color; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
						</div>
					</div>
				</div>
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<div class="ewd-uwcf-admin-styling-subsection-content-label"><?php _e('Font Size', 'color-filters'); ?></div>
					<div class="ewd-uwcf-admin-styling-subsection-content-right">
						<input type='text' name='ratings_bar_font_size' class='ewd-uwcf-admin-font-size' value='<?php echo $Ratings_Bar_Font_Size; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
					</div>
				</div>
			</div>
		</div>
		<div class="ewd-uwcf-admin-styling-subsection">
			<div class="ewd-uwcf-admin-styling-subsection-label"><?php _e('Reset All Button', 'color-filters'); ?></div>
			<div class="ewd-uwcf-admin-styling-subsection-content">
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<div class="ewd-uwcf-admin-styling-subsection-content-label"><?php _e('Colors', 'color-filters'); ?></div>
					<div class="ewd-uwcf-admin-styling-subsection-content-right">
						<div class="ewd-uwcf-admin-styling-subsection-content-color-picker">
							<div class="ewd-uwcf-admin-styling-subsection-content-color-picker-label"><?php _e('Background', 'color-filters'); ?></div>
							<input type='text' class='ewd-uwcf-spectrum' name='reset_all_button_background_color' value='<?php echo $Reset_All_Button_Background_Color; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
						</div>
						<div class="ewd-uwcf-admin-styling-subsection-content-color-picker">
							<div class="ewd-uwcf-admin-styling-subsection-content-color-picker-label"><?php _e('Text', 'color-filters'); ?></div>
							<input type='text' class='ewd-uwcf-spectrum' name='reset_all_button_text_color' value='<?php echo $Reset_All_Button_Text_Color; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
						</div>
					</div>
				</div>
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<div class="ewd-uwcf-admin-styling-subsection-content-label"><?php _e('Hover Colors', 'color-filters'); ?></div>
					<div class="ewd-uwcf-admin-styling-subsection-content-right">
						<div class="ewd-uwcf-admin-styling-subsection-content-color-picker">
							<div class="ewd-uwcf-admin-styling-subsection-content-color-picker-label"><?php _e('Background', 'color-filters'); ?></div>
							<input type='text' class='ewd-uwcf-spectrum' name='reset_all_button_hover_background_color' value='<?php echo $Reset_All_Button_Hover_Background_Color; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
						</div>
						<div class="ewd-uwcf-admin-styling-subsection-content-color-picker">
							<div class="ewd-uwcf-admin-styling-subsection-content-color-picker-label"><?php _e('Text', 'color-filters'); ?></div>
							<input type='text' class='ewd-uwcf-spectrum' name='reset_all_button_hover_text_color' value='<?php echo $Reset_All_Button_Hover_Text_Color; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
						</div>
					</div>
				</div>
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<div class="ewd-uwcf-admin-styling-subsection-content-label"><?php _e('Font Size', 'color-filters'); ?></div>
					<div class="ewd-uwcf-admin-styling-subsection-content-right">
						<input type='text' name='reset_all_button_font_size' class='ewd-uwcf-admin-font-size' value='<?php echo $Reset_All_Button_Font_Size; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
					</div>
				</div>
			</div>
		</div>
		<?php if ($EWD_UWCF_Full_Version != "Yes") { ?>
			<div class="ewd-uwcf-premium-options-table-overlay">
				<div class="ewd-uwcf-unlock-premium">
					<img src="<?php echo plugins_url( '../images/options-asset-lock.png', __FILE__ ); ?>" alt="Upgrade to Ultimate WooCommerce Filters Premium">
					<p>Access this section by by upgrading to premium</p>
					<a href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" class="ewd-uwcf-dashboard-get-premium-widget-button" target="_blank">UPGRADE NOW</a>
				</div>
			</div>
		<?php } ?>
	</div>

	<br />

	<div class="ewd-uwcf-admin-section-heading"><?php _e('Shop Thumbnails', 'color-filters'); ?></div>

	<div class="ewd-uwcf-admin-styling-section <?php echo $EWD_UWCF_Full_Version; ?>">
		<div class="ewd-uwcf-admin-styling-subsection">
			<div class="ewd-uwcf-admin-styling-subsection-label"><?php _e('Font Options', 'color-filters'); ?></div>
			<div class="ewd-uwcf-admin-styling-subsection-content">
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<div class="ewd-uwcf-admin-styling-subsection-content-label"><?php _e('Color', 'color-filters'); ?></div>
					<div class="ewd-uwcf-admin-styling-subsection-content-right">
						<div class="ewd-uwcf-admin-styling-subsection-content-color-picker">
							<div class="ewd-uwcf-admin-styling-subsection-content-color-picker-label"></div>
							<input type='text' class='ewd-uwcf-spectrum' name='shop_thumbnails_font_color' value='<?php echo $Shop_Thumbnails_Font_Color; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
						</div>
					</div>
				</div>
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<div class="ewd-uwcf-admin-styling-subsection-content-label"><?php _e('Font Size', 'color-filters'); ?></div>
					<div class="ewd-uwcf-admin-styling-subsection-content-right">
						<input type='text' name='shop_thumbnails_font_size' class='ewd-uwcf-admin-font-size' value='<?php echo $Shop_Thumbnails_Font_Size; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
					</div>
				</div>
			</div>
		</div>
		<div class="ewd-uwcf-admin-styling-subsection">
			<div class="ewd-uwcf-admin-styling-subsection-label"><?php _e('Color Icons<br><span style="font-weight:400">(Squares or Circles)</span>', 'color-filters'); ?></div>
			<div class="ewd-uwcf-admin-styling-subsection-content">
				<div class="ewd-uwcf-admin-styling-subsection-content-each">
					<div class="ewd-uwcf-admin-styling-subsection-content-label"><?php _e('Width', 'color-filters'); ?></div>
					<div class="ewd-uwcf-admin-styling-subsection-content-right">
						<input type='text' name='shop_thumbnails_color_icon_size' class='ewd-uwcf-admin-font-size' value='<?php echo $Shop_Thumbnails_Color_Icon_Size; ?>' <?php if ($EWD_UWCF_Full_Version != "Yes") {echo "disabled";} ?> />
					</div>
				</div>
			</div>
		</div>
		<?php if ($EWD_UWCF_Full_Version != "Yes") { ?>
			<div class="ewd-uwcf-premium-options-table-overlay">
				<div class="ewd-uwcf-unlock-premium">
					<img src="<?php echo plugins_url( '../images/options-asset-lock.png', __FILE__ ); ?>" alt="Upgrade to Ultimate WooCommerce Filters Premium">
					<p>Access this section by by upgrading to premium</p>
					<a href="https://www.etoilewebdesign.com/plugins/woocommerce-filters/#buy" class="ewd-uwcf-dashboard-get-premium-widget-button" target="_blank">UPGRADE NOW</a>
				</div>
			</div>
		<?php } ?>
	</div>

</div>

<p class="submit"><input type="submit" name="Options_Submit" id="submit" class="button button-primary" value="Save Changes"  /></p></form>

</div>
</div>
