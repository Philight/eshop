<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

$str = file_get_contents(get_stylesheet_directory()."/data/countries/countriesData.json");
$json = json_decode( $str, true );
?>

<p>
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</p>


<?php
$user_meta = get_userdata($customer_id);
$user_roles = $user_meta->roles; //array of roles the user is part of.

error_log('this user roles');
error_log(print_r($user_roles, true));

if (in_array('wholesale_customer', $user_roles)) {	?>
	<h3>Billing address</h3>
	<h3>Shipping address</h3>

<?php } else if (in_array('customer', $user_roles)) { 
	$user_data['shipping_address_line_1'] = get_user_meta($customer_id, 'shipping_address_line_1', true);
	$user_data['shipping_address_line_2'] = get_user_meta($customer_id, 'shipping_address_line_2', true);
	$user_data['shipping_postal_code'] = get_user_meta($customer_id, 'shipping_postal_code', true);
	$user_data['shipping_city'] = get_user_meta($customer_id, 'shipping_city', true);
	$user_data['shipping_state_region_province'] = get_user_meta($customer_id, 'shipping_state_region_province', true);
	$user_data['shipping_country'] = get_user_meta($customer_id, 'shipping_country', true);

	$user_data['billing_address_line_1'] = get_user_meta($customer_id, 'billing_address_line_1', true);
	$user_data['billing_address_line_2'] = get_user_meta($customer_id, 'billing_address_line_2', true);
	$user_data['billing_postal_code'] = get_user_meta($customer_id, 'billing_postal_code', true);
	$user_data['billing_city'] = get_user_meta($customer_id, 'billing_city', true);
	$user_data['billing_state_region_province'] = get_user_meta($customer_id, 'billing_state_region_province', true);
	$user_data['billing_country'] = get_user_meta($customer_id, 'billing_country', true);
?>
	
	<h3>Shipping address</h3>
	<div class="address-card shipping">
		<address>
			<span class="shipping_address_line_1"><?php echo $user_data['shipping_address_line_1'].',';?></span>
			<?php  
				if ( $user_data['shipping_address_line_2'] ) { ?>
					<span class="shipping_address_line_2">
					<?php echo $user_data['shipping_address_line_2']; ?>
					</span>
			<?php } ?>
			<br>

			<span class="shipping_postal_code"><?php echo $user_data['shipping_postal_code']; ?></span>
			<span class="shipping_city"><?php echo ' '.$user_data['shipping_city']; ?></span>
			<br>

			<span class="shipping_state_region_province">
			<?php
				if ( $user_data['shipping_state_region_province'] ) {
					echo $user_data['shipping_state_region_province']; 
				} ?>
			</span>
			<br>

			<span class="shipping_country">
			<?php echo $user_data['shipping_country'] ?>
			</span>
		</address>
		<i class="ion-edit"></i>
		<div class="address-edit-overlay">
			<button class="edit-shipping">Edit</button>			
		</div>
	</div>

	<h3>Billing address</h3>
	<div class="address-card billing">
		<address>
			<span class="billing_address_line_1"><?php echo $user_data['billing_address_line_1'].','; ?></span>
			<?php  
				if ( $user_data['billing_address_line_2'] ) { ?>
					<span class="billing_address_line_2">
					<?php echo $user_data['billing_address_line_2']; ?>
					</span>
			<?php } ?>
			<br>

			<span class="billing_postal_code"><?php echo $user_data['billing_postal_code']; ?></span>
			<span class="billing_city"><?php echo ' '.$user_data['billing_city']; ?></span>
			<br>

			<span class="billing_state_region_province">
			<?php
				if ( $user_data['billing_state_region_province'] ) {
					echo $user_data['billing_state_region_province']; 
				} ?>
			</span>
			<br>

			<span class="billing_country">
			<?php echo $user_data['billing_country'] ?>
			</span>
		</address>
		<i class="ion-edit"></i>
		<div class="address-edit-overlay">
			<button class="edit-billing">Edit</button>			
		</div>
	</div>

	<div class="modal-edit-container">
		<div class="loading"></div>
		<div class="modal-background"></div>
		<ul class="notice-container"></ul>
		<form class="modal-edit-form" method="post">		
			<fieldset class="shipping-info">
		 		<legend class="shipping-title">SHIPPING ADDRESS</legend>

		    	<label for="ShippingAddressLine1" class="shipping-address-line-1-field required">
		    		<span>Address Line 1 <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
		    		<input id="ShippingAddressLine1" name="shipping_address_line_1" type="text" maxlength="100" required value="<?php esc_attr_e($user_data['shipping_address_line_1']); ?>">
		    	</label>
		    	<label for="ShippingAddressLine2" class="shipping-address-line-2-field">
		    		<span>Address Line 2 <em>(Apartment, Suite, Building, etc.) - <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
		    		<input id="ShippingAddressLine2" name="shipping_address_line_2" type="text" maxlength="100" value="<?php esc_attr_e($user_data['shipping_address_line_2']); ?>">
		    	</label>

		    	<label for="ShippingCity" class="shipping-city-field required">
		    		<span>City <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
		    		<input id="ShippingCity" name="shipping_city" type="text" maxlength="50" required value="<?php esc_attr_e($user_data['shipping_city']); ?>">
		    	</label>				    	
		    	<label for="ShippingStateRegionProvince" class="shipping-state-region-province-field">
		    		<span>State / Region / Province <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
		    		<input id="ShippingStateRegionProvince" name="shipping_state_region_province" type="text" maxlength="50" value="<?php esc_attr_e($user_data['shipping_state_region_province']); ?>"> 
		    	</label>

		    	<label for="ShippingCountry" class="shipping-country-field required">
		    		<span>Country <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
		    		<select id="ShippingCountry" name="shipping_country" required>
		    			
    		<?php 	foreach ($json as $key => $value) { ?>
	    				<option value="<?php echo $value['countryNameEn']; ?>" data-list-order="<?php echo $key ?>" <?php echo ($user_data['shipping_country'] == $value['countryNameEn']) ? 'selected' : '' ?>><?php echo $value['countryNameEn']; ?></option>
		    <?php	} ?>
		    		
		    		</select>
		    	</label>
		    	<label for="ShippingPostalCode" class="shipping-postal-code-field required">
		    		<span>Postal Code <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
		    		<input id="ShippingPostalCode" name="shipping_postal_code" type="text" maxlength="10" required value="<?php esc_attr_e($user_data['shipping_postal_code']); ?>">
		    	</label>				    	
			</fieldset>

			<fieldset class="billing-info">
		 		<legend class="billing-title">BILLING ADDRESS</legend>
		        
		 		<label for="BillingAddressLine1" class="address-line-1-field required">
		    		<span>Address Line 1 <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
		    		<input id="BillingAddressLine1" name="billing_address_line_1" type="text" maxlength="100" required value="<?php esc_attr_e($user_data['billing_address_line_1']); ?>">
		    	</label>
		    	<label for="BillingAddressLine2" class="address-line-2-field">
		    		<span>Address Line 2 <em>(Apartment, Suite, Building, etc.) - <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
		    		<input id="BillingAddressLine2" name="billing_address_line_2" type="text" maxlength="100" value="<?php esc_attr_e($user_data['billing_address_line_2']); ?>">
		    	</label>

		    	<label for="BillingCity" class="city-field required">
		    		<span>City <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
		    		<input id="BillingCity" name="billing_city" type="text" maxlength="50" required value="<?php esc_attr_e($user_data['billing_city']); ?>">
		    	</label>				    	
		    	<label for="BillingStateRegionProvince" class="state-region-province-field">
		    		<span>State / Region / Province <em>- <?php esc_html_e('Optional', 'custom_registration_text'); ?></em></span>
		    		<input id="BillingStateRegionProvince" name="billing_state_region_province" type="text" maxlength="50" value="<?php esc_attr_e($user_data['billing_state_region_province']); ?>"> 
		    	</label>

		    	<label for="BillingCountry" class="country-field required">
		    		<span>Country <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
		    		<select id="BillingCountry" name="billing_country" required>

    		<?php 	foreach ($json as $key => $value) { ?>
	    				<option value="<?php echo $value['countryNameEn']; ?>" data-list-order="<?php echo $key ?>" <?php echo ($user_data['billing_country'] == $value['countryNameEn']) ? 'selected' : '' ?>><?php echo $value['countryNameEn']; ?></option>
		    <?php	} ?>
		    		</select>
		    	</label>
		    	<label for="BillingPostalCode" class="postal-code-field required">
		    		<span>Postal Code <abbr title="<?php esc_attr_e('Required field', 'custom_registration_text');?>">*</abbr></span>
		    		<input id="BillingPostalCode" name="billing_postal_code" type="text" maxlength="10" required value="<?php esc_attr_e($user_data['billing_postal_code']); ?>">
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
	

<?php }


