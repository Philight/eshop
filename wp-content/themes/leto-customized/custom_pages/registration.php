<?php
/*
Template Name: Registration
extended: leto/page-templates/template_fullwidth
*/

get_header(); ?>
<div id="primary" class="content-area fullwidth">
	<main id="main" class="site-main" role="main">
		<?php //echo do_shortcode('[user_registration_form id="128"]'); 
		$form = do_shortcode('[user_registration_form id="128"]'); 
		$form = str_replace('  ', ' ', $form);

		// Add User Profile title
		$find = "<div class='ur-form-row'>";
		$first_pos = strpos($form, $find);
		$replace ='<div class="ur-form-row">
   <div class="ur-form-grid ur-grid-1" style="width:99%">
        <legend class="title profile">'.'USER PROFILE'.'</legend>
   </div>
</div>'.$find;
		
		if ($first_pos !== false) {
		    $form = substr_replace($form, $replace, $first_pos, strlen($find));
		}

		$pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
		$pieces = explode(" ", $pizza, -4);
		error_log('explode test');
		error_log('0: '.$pieces[0]);
		error_log('1: '.$pieces[1]);
		error_log('2: '.$pieces[2]);

		// Add Shipping Address title
		$slice_on = '<div data-field-id="shipping_address"';
		$form_parts = explode($slice_on, $form, 2);

		//error_log($form_parts[0]);
		
		$find = "<div class='ur-form-row'>";
		$last_pos = strrpos($form_parts[0], $find);
		error_log('strpos');
		error_log($last_pos);
		$replace ='<div class="ur-form-row">
   <div class="ur-form-grid ur-grid-1" style="width:99%">
        <legend class="title shipping">SHIPPING ADDRESS</legend>
   </div>
</div>'.$find;

		if ($last_pos !== false) {
			$form_parts[0] = substr_replace($form_parts[0], $replace, $last_pos, strlen($find));

			$form = $form_parts[0].$slice_on.$form_parts[1];
		}

		// Add Billing Address title
		$slice_on = '<div data-field-id="billing_address"';
		$form_parts = explode($slice_on, $form, 2);
		
		$find = "<div class='ur-form-row'>";
		$last_pos = strrpos($form_parts[0], $find);

		$replace =
'<div class="ur-form-row">
   <div class="ur-form-grid ur-grid-1" style="width:99%">
        <legend class="title billing">BILLING ADDRESS</legend>
        <label for="billing_option" class="ur-label billing_option">
        	<input type="checkbox" id="billing_option" name="billing_option" checked>
        	Same As Shipping Address
        </label>
   </div>
</div>'.$find;

		if ($last_pos !== false) {
			$form_parts[0] = substr_replace($form_parts[0], $replace, $last_pos, strlen($find));

			$form = $form_parts[0].$slice_on.$form_parts[1];
		}		

		// BILLING address fields wrapper
		$find = "<div class='ur-form-row'>";
		$replace = '<div class="billing-wrapper collapsed">'.$find;

		$last = strrpos($form, $find);
		if ($last !== false) {

			$next_to_last = strrpos($form, $find, $last - strlen($form) - 1);
			if ($next_to_last !== false) {

				$form = substr_replace($form, $replace, $next_to_last, strlen($find));
			}
		}
		

		$find = '<div class="ur-button-container " >';
		$replace = '</div>'.$find;

		$first_pos = strpos($form, $find);
		if ($first_pos !== false) {
			$form = substr_replace($form, $replace, $first_pos, strlen($find));
		}

		echo $form;

		?>

	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
