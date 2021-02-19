<?php 

/* Template Name: RegisterUserPage
 extended page.php 
extended: leto/page-templates/template_fullwidth 
*/

function html_builder() {
	return '';
}


$str = file_get_contents(get_stylesheet_directory()."/data/countries/countriesData.json");
$json = json_decode( $str, true );

//error_log('JSON');
//			error_log( print_r($json, true) );
get_header(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

	<div id="primary" class="content-area fullWidth">
		<main id="main" class="site-main">
			
			<div class="register-page">
				<ul class="notice-container">
<!--					
						<li><i class="ion-android-alert"></i><span>Full Name field needs to be filled</span></li>

						<li><i class="ion-android-alert"></i><span>Username is already taken. Please choose another one.</span></li>
						
						<li><i class="ion-android-alert"></i><span>Username has to have atleast 6 characters, can contain characters a-Z, numbers 0-9, dash '-' or underscore '_'</span></li>
						<li class="success"><i class="ion-android-checkmark-circle"></i><span>Account was added</span></li>
-->
				</ul>

				<?php echo html_builder(); ?>
				<form class="register-form" method="post">
					<fieldset class="register-profile">
						<legend class="profile-title">PROFILE</legend>

						<label for="FullName" class="full-name-field required">
							<span>Full Name <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
							<input id="FullName" name="full_name" type="text" maxlength="100" required>
						</label>

						<label for="Username" class="user-name-field required">
							<span>Username <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
							<input id="Username" name="user_name" type="text" maxlength="50" required>
						</label>
						<label for="DisplayName" class="display-name-field">
							<span>Display Name <em>(How should we address you?) - <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
							<input id="DisplayName" name="display_name" type="text" maxlength="50">
						</label>
<!--				    		
						<label for="FirstName" class="first-name-field required">
							<span >First Name</span>
							<input id="FirstName" type="text" maxlength="50" required>	
						</label>			
				    	<label for="LastName" class="last-name-field required">
				    		<span>Last Name</span>
					    	<input id="LastName" type="text" maxlength="50" required>
				    	</label>
-->
				    	<label for="Password" class="password-field required">
							<span >Password <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
							<div class="password-wrapper">
								<input type="password" id="Password" name="user_password" maxlength="128" required>	
								<i class="ion-eye-disabled" id="TogglePassword"></i>
							</div>
						</label>
				    	<label for="ConfirmPassword" class="confirm-password-field required">
				    		<span>Confirm Password <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
				    		<div class="password-wrapper">
						    	<input type="password" id="ConfirmPassword" name="user_confirm_password" maxlength="128" required>
						    	<i class="ion-eye-disabled" id="ToggleConfirmPassword"></i>
							</div>
				    	</label>				    	

				    	<label for="Email" class="email-field required">
				    		<span>Email <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
					    	<input id="Email" name="user_email" type="text" maxlength="100" placeholder="e.g. example@gmail.com" required>
				    	</label>					    	
				    	<label for="PhoneNumber" class="phone-number-field required">
				    		<span>Phone <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>

				    		<div class="flex-wrapper">
					    		<div class="country-code-wrapper">
					    			<input type="text" name="phone_code" id="PhoneCode" value="+421" required>
					    			<i class="ion-ios-arrow-down"></i>
					    		</div>
						    	<input id="PhoneNumber" name="phone_number" type="text" maxlength="15" required>
							</div>

				    		<ul class="country-code-dropdown collapsed">

	    			<?php   foreach ($json as $key => $value) { ?>
			    				<li class="country-code-item" value="<?php echo $key;?>" data-country-code="<?php echo '+'.$value['countryCallingCode']?>">
			    					<?php $country_code = strtolower($value['countryCode']); ?>
			    					<div class="country-flag" style="background-image: url(<?php echo get_stylesheet_directory_uri().'/data/countries/country-4x3/'.$country_code.'.svg'?>);">
			    					</div>
			    					<span class="country-name"><?php echo $value['countryNameEn'].' +'.$value['countryCallingCode']?></span>
			    				</li>
	    			<?php 	} ?> 

				    		</ul>

				    	</label>

						<label for="Company" class="company-field">
				    		<span>Company <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
					    	<input id="Company" name="company" type="text" maxlength="100">
				    	</label>	
				    	<label for="Website" class="website-field">
				    		<span>Website <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
					    	<input id="Website" name="website" type="text" maxlength="100">
				    	</label>

					</fieldset>

				 	<fieldset class="register-shipping">
				 		<legend class="shipping-title">SHIPPING ADDRESS</legend>

				    	<label for="ShippingAddressLine1" class="shipping-address-line-1-field required">
				    		<span>Address Line 1 <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
				    		<input id="ShippingAddressLine1" name="shipping_address_line_1" type="text" maxlength="100" required>
				    	</label>
				    	<label for="ShippingAddressLine2" class="shipping-address-line-2-field">
				    		<span>Address Line 2 <em>(Apartment, Suite, Building, etc.) - <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
				    		<input id="ShippingAddressLine2" name="shipping_address_line_2" type="text" maxlength="100">
				    	</label>

				    	<label for="ShippingCity" class="shipping-city-field required">
				    		<span>City <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
				    		<input id="ShippingCity" name="shipping_city" type="text" maxlength="50" required>
				    	</label>				    	
				    	<label for="ShippingStateRegionProvince" class="shipping-state-region-province-field">
				    		<span>State / Region / Province <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
				    		<input id="ShippingStateRegionProvince" name="shipping_state_region_province" type="text" maxlength="50"> 
				    	</label>

				    	<label for="ShippingCountry" class="shipping-country-field required">
				    		<span>Country <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
				    		<select id="ShippingCountry" name="shipping_country" required>
				    			<option value="Slovakia" selected>Slovakia</option>
		    		
		    		<?php 	foreach ($json as $key => $value) { ?>
			    				<option value="<?php echo $value['countryNameEn']; ?>" data-list-order="<?php echo $key ?>"><?php echo $value['countryNameEn']; ?></option>
				    <?php	} ?>
				    		
				    		</select>
				    	</label>
				    	<label for="ShippingPostalCode" class="shipping-postal-code-field required">
				    		<span>Postal Code <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
				    		<input id="ShippingPostalCode" name="shipping_postal_code" type="text" maxlength="10" required>
				    	</label>				    	
					</fieldset>  

					<fieldset class="register-billing">
				 		<legend class="billing-title">BILLING ADDRESS</legend>
				 		<label for="BillingOption" class="billing-option">
				        	<input type="checkbox" id="BillingOption" checked>
				        	Same As Shipping Address
				        </label>

				        
					 		<label for="BillingAddressLine1" class="address-line-1-field required">
					    		<span>Address Line 1 <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
					    		<input id="BillingAddressLine1" name="billing_address_line_1" type="text" maxlength="100" required>
					    	</label>
					    	<label for="BillingAddressLine2" class="address-line-2-field">
					    		<span>Address Line 2 <em>(Apartment, Suite, Building, etc.) - <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
					    		<input id="BillingAddressLine2" name="billing_address_line_2" type="text" maxlength="100">
					    	</label>

					    	<label for="BillingCity" class="city-field required">
					    		<span>City <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
					    		<input id="BillingCity" name="billing_city" type="text" maxlength="50" required>
					    	</label>				    	
					    	<label for="BillingStateRegionProvince" class="state-region-province-field">
					    		<span>State / Region / Province <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
					    		<input id="BillingStateRegionProvince" name="billing_state_region_province" type="text" maxlength="50"> 
					    	</label>

					    	<label for="BillingCountry" class="country-field required">
					    		<span>Country <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
					    		<select id="BillingCountry" name="billing_country" required>
					    			<option value="Slovakia" selected>Slovakia</option>
			    		
			    		<?php 	foreach ($json as $key => $value) { ?>
				    				<option value="<?php echo $value['countryNameEn']; ?>" data-list-order="<?php echo $key ?>"><?php echo $value['countryNameEn']; ?></option>
					    <?php	} ?>
					    		
					    		</select>
					    	</label>
					    	<label for="BillingPostalCode" class="postal-code-field required">
					    		<span>Postal Code <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
					    		<input id="BillingPostalCode" name="billing_postal_code" type="text" maxlength="10" required>
					    	</label>
					    		
				 	</fieldset>

					<fieldset class="register-optional">
				 		<legend class="optional-title move-up">OPTIONAL QUESTIONS<span class="next-line"><em> (Help us to improve your experience by answering to a few questions)</em></span></legend>

				 		<label for="DateOfBirth" class="date-of-birth-field">
				    		<span>Date Of Birth <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
					    	<input id="DateOfBirth" name="date_of_birth" type="text" placeholder="e.g. 21.02.2020">
				    	</label>
				    	<label for="Gender" class="gender-field">
				    		<span>Gender <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>

				    		<select id="Gender" name="gender">
								<option disabled selected value style="display: none">-- select an option --</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
								<option value="other">Other</option>
							</select>
							<input type="text" name="gender_other" placeholder="You can specify your gender if you want to">
				    	</label>	

				    	<label for="HearAboutUs" class="hear-about-us-field">
				    		<span>How did you hear about us? <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>

				    		<select id="HearAboutUs">
				    			<option disabled selected value style="display: none">-- select an option --</option>
				    			<option value="internet">Internet</option>
				    			<option value="leaflet">Leaflet</option>
				    			<option value="friend">From a friend</option>
				    			<option value="other">Other:</option>
				    		</select>
				    		<input type="text" name="hear_about_us_other" placeholder="Where did you hear about us from?">
				    	</label>
				 	</fieldset>

					<div class="btn-wrapper">
						<button class="btn submit-btn" type="submit">REGISTER</button>  
					</div>
				</form>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();