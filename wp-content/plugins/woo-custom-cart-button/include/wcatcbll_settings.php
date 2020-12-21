<?php
/*
**Start Setting Section
*/
/**
 *Cart setting in setting menu
 */
add_action('admin_menu', 'wcatcbll_cart_setting_menu');
function wcatcbll_cart_setting_menu() {
	add_options_page(
    'Cart Setting Page', //page title
    __('Custom Cart Button', 'catcbll'), //menu title
    'manage_options', //roles and capabiliyt needed
    'hwx-wccb',//call by custom post type function
    'wcatcbll_wccb_options_page'//replace with your own function
);
}

/**
 * Save cart button setting in option.php
 */
function wcatcbll_wccb_options_page() {

	include(WCATCBLL_CART_INC .'wcatcbll_icons.php');
	include(WCATCBLL_CART_INC .'wcatcbll_btn_2dhvr.php');

	$catcbll_settings = get_option('_woo_catcbll_all_settings');
	extract($catcbll_settings);
	
	//button display setting
	if(isset($catcbll_both_btn)){$both  = $catcbll_both_btn;}else{$both = '';}
	if(isset($catcbll_add2_cart)){$add2cart = $catcbll_add2_cart;}else{$add2cart= '';}
	if(isset($catcbll_custom)){$custom = $catcbll_custom;}else{$custom  = '';}		
	//display button setting
	if(isset($catcbll_cart_global)){$global = $catcbll_cart_global;}else{$global = '';}
	if(isset($catcbll_cart_shop)){$shop = $catcbll_cart_shop;}else{$shop = '';}
	if(isset($catcbll_cart_single_product)){$single  = $catcbll_cart_single_product;}else{$single = '';}	
	if(isset($catcbll_btn_open_new_tab)){$btn_opnt  = $catcbll_btn_open_new_tab;}else{$btn_opnt = '';}		

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page' ) );
	}

	$page = $_GET['page'];
	$tab = (isset($_GET['tab'])) ? $_GET['tab'] : '';
	if (empty($tab)) {
		$tab = 'catcbll_general';
	}
	$menus = array();
	$menus['catcbll_general'] = __('General', 'catcbll');
	$menus['catcbll_shortcode'] = __('Shortcode', 'catcbll');
	$menus['catcbll_support'] = __('Support', 'catcbll');
	$menus = apply_filters('wcatcbll_ex_imp_new_menus', $menus);
	?>

	<div class="container-fluid pt-3" id="wcatcbll_stng">
		<div class="row">
			<div class="col-md-12">
				<div class='wrap'>
					<div class="catcbll_stng_sidebar">
						<div class="row mb-3">											
							<div class="col-lg-12 col-12">	
								<ul class="nav catcbll_stng_nav mb-3"><?php
								foreach ($menus as $key => $menu) {
									$tab_url = add_query_arg(array(
										'page' => $page,
										'tab' => $key,
									), admin_url('admin.php'));
									?>
									<li>
										<a class="<?php if ($tab == $key) echo 'active'; ?>" href="<?php echo $tab_url; ?>"><?php echo $menu; ?></a>
									</li>
									<?php }?>
								</ul>	
							</div>
						</div>	
						<div class="row mb-3">											
							<div class="col-lg-12 col-12">
								<div class="col-lg-12 col-12 p-0">	
									<h6>Watch Plugin Video</h6>									
								</div>	
								<div class="col-lg-12 col-12 p-0">
									<div class="side_review">	
										<iframe src="https://www.youtube.com/embed/QC1CQ4XIH5Y" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
										<p class="mb-0 mt-1 p-1 vido"><a href="https://wordpress.org/support/plugin/woo-custom-cart-button/reviews/" target="_blank">Please Review <i class="fa fa-thumbs-up"></i></a></p>
										<p class="mb-0 mt-1 p-1 vido text-right"><a href="https://www.youtube.com/channel/UClog8CJFaMUqll0X5zknEEQ" class="sub_btn" target="_blank">SUBSCRIBE</a></p>
										<div class="clear"></div>
									</div>
								</div>	
							</div>
						</div>
						<div class="row">											
							<div class="col-lg-12 col-12">	
								<h6>Try Our Other Plugins</h6>								
							</div>
						</div>
						<div class="col-lg-12 col-12 side_col_scroll">
							<div class="row mb-3">
								<div class="col-lg-12 col-12 p-0 pr-1">	
									<div class="side_review">
										<a href="https://wordpress.org/plugins/text-case-converter/" target="_blank"><img src="<?php echo WCATCBLL_CART_IMG.'text-convertor.jpg'?>"/></a>
										<p class="mb-0 mt-1 p-1"><a href="https://wordpress.org/plugins/text-case-converter/" target="_blank">Text Case Converter</a></p>									
									</div>
								</div>
							</div>		
							<div class="row mb-3">											
								<div class="col-lg-12 col-12 p-0 pr-1">
									<div class="side_review">	
										<a href="https://wordpress.org/plugins/awesome-checkout-templates/" target="_blank"><img src="<?php echo WCATCBLL_CART_IMG.'awesome-checkout.jpg'?>"/></a>
										<p class="mb-0 mt-1 p-1"><a href="https://wordpress.org/plugins/awesome-checkout-templates/" target="_blank">Awesome Checkout Templates</a></p>
									</div>
								</div>							
							</div>	
							<div class="row mb-3">											
								<div class="col-lg-12 col-12 p-0 pr-1">	
									<div class="side_review">
										<a href="https://wordpress.org/plugins/passwords-manager/" target="_blank"><img src="<?php echo WCATCBLL_CART_IMG.'pasword-manager.jpg'?>"/></a>
										<p class="mb-0 mt-1 p-1"><a href="https://wordpress.org/plugins/passwords-manager/" target="_blank">Passwords Manager</a></p>
									</div>
								</div>
							</div>
						</div>					
					</div><!-- close sidemenu-->
					<div id="catcbll_stng_wrap">
						<div id="catcbll_stng_body">
							<?php
							if($tab == 'catcbll_shortcode'){
								include(WCATCBLL_CART_INC .'wcatcbll_setting_shortcode.php');
							}elseif($tab == 'catcbll_support'){
								include(WCATCBLL_CART_INC .'wcatcbll_setting_support.php');
							}elseif($tab == 'catcbll_general'){
								include(WCATCBLL_CART_INC .'wcatcbll_general_settings.php');
						 	}else{
								do_action('catcbll_add_addon_setting');
							}?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="wcbnl_overlay">
		<div class="cv-spinner">
			<img src="<?php echo WCATCBLL_CART_IMG.'spinner.svg'?>">
		</div>
	</div>
<?php }

/* 
** Insert all setting in option table
** @use insert key is _woo_cstmbtn_all_settings
**/
add_action( 'wp_ajax_catcbll_save_option', 'catcbll_save_option' );
function catcbll_save_option(){ 
   $final_data = array();
  parse_str( $_POST['form_data'], $final_data); 
  $btn_action =	sanitize_text_field($_POST['action']);  

  if(isset($btn_action) && $btn_action == "catcbll_save_option" && isset($_POST['security_nonce']) && wp_verify_nonce( $_POST['security_nonce'], 'ajax_public_nonce' )){   
    foreach($final_data as $final_data_key => $final_data_val){     
      $btn_clr_key = array('catcbll_btn_bg','catcbll_btn_fclr','catcbll_btn_border','catcbll_btn_hvrclr');
      if(in_array($final_data_key,$btn_clr_key,true)){
        $cbtn_setting = sanitize_hex_color($final_data_val);
      }else{
        $cbtn_setting  = sanitize_text_field($final_data_val);
      }
      $save_data[sanitize_key($final_data_key)] = $cbtn_setting;
    }  
	update_option('_woo_catcbll_all_settings',$save_data);
	echo json_encode("Success");
    die;
  }
  
}

/*
**Send support email
*/
add_action('wp_ajax_catcbll_send_email_help','catcbll_send_email_help');
function catcbll_send_email_help(){
	$fdbk_trm 		= sanitize_text_field($_POST['fdbk_trm']);
	$btn_action		= sanitize_text_field($_POST['btn_action']);	
		if(isset($btn_action) && $btn_action == 'catcbll_send_email' && isset($fdbk_trm) && $fdbk_trm == 'on' && isset($_POST['security_nonce']) && wp_verify_nonce( $_POST['security_nonce'], 'ajax_public_nonce' ) ){
			$subject = sanitize_text_field(str_replace('-',' ',$_POST['form_type']));
			$subject = ucfirst($subject);
			date_default_timezone_set('Asia/Kolkata');
			$date = date('d-M-Y H:i');
			$subjects = 'Custom cart button and link -'.$subject.' - '.$date;
			$email_from = sanitize_email($_POST['fdbk_email']);
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			// More headers
			$headers .= 'From:'.$email_from. "\r\n";		
			$body = nl2br($_POST['fdbk_msg']);
			$sent = wp_mail( "coder426@gmail.com", $subjects, $body, $headers );
			if($sent)
			{
				echo json_encode("Success");
			}
		}	
	die;
}


?>
