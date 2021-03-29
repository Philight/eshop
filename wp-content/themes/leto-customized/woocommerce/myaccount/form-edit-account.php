<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
	$str = file_get_contents(get_stylesheet_directory()."/data/countries/countriesData.json");
	$json = json_decode( $str, true );

	$user_id = get_current_user_id();
	$user_data = get_userdata($user_id);
	$user_meta['full_name'] = get_user_meta($user_id, 'full_name', true);
	$user_meta['date_of_birth'] = get_user_meta($user_id, 'date_of_birth', true);
	$user_meta['gender'] = get_user_meta($user_id, 'gender', true);
	$user_meta['gender_other'] = get_user_meta($user_id, 'gender_other', true);
	$user_meta['phone_code'] = get_user_meta($user_id, 'phone_code', true);
	$user_meta['phone_number'] = get_user_meta($user_id, 'phone_number', true);
	$user_meta['company'] = get_user_meta($user_id, 'company', true);
	$user_meta['website'] = get_user_meta($user_id, 'website', true);
?>

<div class="info-card personal">
	<h3 class="info-card-title">PERSONAL INFO <i class="ion-android-create"></i></h3>
	<table>
		<tr>
			<td>	
				<div class="ellipse">Username</div>
			</td>
			<td class="user_name"><?php echo $user_data->user_login; ?></td>
		</tr>
		<tr>
			<td><div class="ellipse">Full name</div></td>
			<td class="full_name"><?php echo $user_meta['full_name'] ?></td>

		</tr>
		<tr>
			<td><div class="ellipse">Display name</div></td>
			<td class="display_name"><?php echo $user_data->display_name; ?></td>
		<tr>
			<td><div class="ellipse">Date of birth</div></td>
			<td class="date_of_birth"><?php echo $user_meta['date_of_birth'] ?></td>
		</tr>
		<tr>
			<td><div class="ellipse">Gender</div></td>
			<td class="gender"><?php echo $user_meta['gender']; ?></td>
		</tr>
	</table>
</div>

<div class="info-card contact">
	<h3 class="info-card-title">CONTACT INFO <i class="ion-edit"></i></h3>
	<table>
		<tr>
			<td><i class="ion-ios-email"></i></td>
			<td>Email</td>
			<td class="user_email"><?php echo $user_data->user_email; ?></td>
		</tr>
		<tr>
			<td><i class="ion-ios-telephone"></i></td>
			<td>Phone number</td>
			<td><span class="phone_code"><?php echo $user_meta['phone_code']; ?></span><span class="phone_number"><?php echo $user_meta['phone_number']; ?></span></td>
		</tr>
		<tr>
			<td><i class="ion-ios-briefcase"></i></td>
			<td>Company</td>
			<td class="company"><?php echo $user_meta['company'] ?></td>
		<tr>
			<td><i class="ion-ios-world"></i></td>
			<td>Website</td>
			<td class="website"><?php echo $user_data->user_url; ?></td>
		</tr>
	</table>
</div>

<div class="modal-edit-container">
	<div class="loading"></div>
	<div class="modal-background"></div>
	<ul class="notice-container"></ul>
	<form class="modal-edit-form" method="post">		
		<fieldset class="personal-info">
			<legend class="personal-title">PERSONAL INFO</legend>

			<label for="FullName" class="full-name-field required">
				<span>Full Name <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
				<input id="FullName" name="full_name" type="text" maxlength="100" required value="<?php esc_attr_e($user_meta['full_name']); ?>">
			</label>	
			<label for="DisplayName" class="display-name-field">
				<span>Display Name <em>(How should we address you?) - <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
				<input id="DisplayName" name="display_name" type="text" maxlength="50" value="<?php esc_attr_e($user_data->display_name); ?>">
			</label>

			<label for="DateOfBirth" class="date-of-birth-field">
	    		<span>Date Of Birth <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
		    	<input id="DateOfBirth" name="date_of_birth" type="text" placeholder="e.g. 21.02.2020" value="<?php esc_attr_e($user_meta['date_of_birth']); ?>">
	    	</label>
	    	<label for="Gender" class="gender-field <?php echo $user_meta['gender'] == 'other' ? 'other' : '' ?>">
	    		<span class="<?php echo $user_meta['gender'] == 'other' ? 'other' : ''; ?>">Gender <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>

	    		<select id="Gender" name="gender">
					<option value="male" <?php echo $user_meta['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
					<option value="female" <?php echo $user_meta['gender'] == 'female' ? 'selected' : '' ?>>Female</option>
					<option value="other"  <?php echo $user_meta['gender'] == 'other' ? 'selected' : '' ?>>Other</option>
				</select>	
				<input type="text" name="gender_other" placeholder="You can specify if you want to" value="<?php esc_attr_e($user_meta['gender_other']); ?>" class="<?php echo $user_meta['gender'] == 'other' ? 'visible' : 'hidden' ?>">
	    	</label>


		</fieldset>
		<fieldset class="contact-info">
			<legend class="contact-title">CONTACT INFO</legend>

			<label for="Email" class="email-field required">
	    		<span>Email <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
		    	<input id="Email" name="user_email" type="text" maxlength="100" placeholder="e.g. example@gmail.com" required value="<?php esc_attr_e($user_data->user_email); ?>">
	    	</label>
			<label for="PhoneNumber" class="phone-number-field required">
	    		<span>Phone <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
	    		
	    		<div class="country-code-wrapper">
	    			<input type="text" name="phone_code" id="PhoneCode" value="<?php esc_attr_e($user_meta['phone_code']); ?>" required>
	    			<i class="ion-ios-arrow-down"></i>
	    		</div>
		    	<input id="PhoneNumber" name="phone_number" type="text" maxlength="15" required value="<?php esc_attr_e($user_meta['phone_number']); ?>">

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
		    	<input id="Company" name="company" type="text" maxlength="100" value="<?php esc_attr_e($user_meta['company']); ?>">
	    	</label>	
	    	<label for="Website" class="website-field">
	    		<span>Website <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
		    	<input id="Website" name="website" type="text" maxlength="100" value="<?php esc_attr_e($user_data->user_url); ?>">
	    	</label>
		</fieldset>

			<button class="btn submit-btn" type="submit">
				SAVE
			</button>  
			<button class="cancel-btn">
				CANCEL
			</button>
	</form>
</div>