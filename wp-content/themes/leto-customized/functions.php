<?php
	include_once( get_stylesheet_directory() .'/inc/custom-main-navigation.php');
	include_once( get_stylesheet_directory() .'/inc/ajax-add-to-cart-extended.php');
	include_once( get_stylesheet_directory() .'/custom/custom-sidecart-variations-form.php');
	include_once( get_stylesheet_directory() .'/inc/custom-ajax-update-cart.php');
	include_once( get_stylesheet_directory() .'/custom/custom-quantity-buttons.php');
	include_once( get_stylesheet_directory() .'/custom/woocommerce-ajax-filters-styles.php');
	include_once( get_stylesheet_directory() .'/custom/custom-page-links.php');
	include_once( get_stylesheet_directory() .'/custom/custom-save-registration-form.php');


	add_action( 'yith_wcwl_init', 'yith_custom' );
	function yith_custom() {
		include_once( get_stylesheet_directory() .'/inc/class.yith-wcwl-shortcode-custom.php');
	}

	add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
	function enqueue_parent_styles() {
	   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
	}

   	add_action('wp_print_scripts', 'dequeue_deregister_scripts', 20);
    function dequeue_deregister_scripts() {

    /* rtwpvs */
		wp_dequeue_script('rtwpvs');	
			wp_deregister_script('rtwpvs');

	/* Sidecart plugin / xoo-wsc */
		wp_dequeue_script('xoo-wsc-main-js');
			wp_deregister_script('xoo-wsc-main-js');
    }

    add_action('wp_enqueue_scripts', 'enqueue_register_scripts', 20);
    function enqueue_register_scripts() {
		
    /* rtwpvs */
    	if ( !is_cart() ) {
	    	wp_register_script('rtwpvs1', get_stylesheet_directory_uri().'/js/rtwpvs1.js', array('jquery', 'wp-util'), filemtime(get_stylesheet_directory().'/js/rtwpvs1.js'), true);
			wp_enqueue_script('rtwpvs1');

			wp_localize_script('rtwpvs1', 'rtwpvs_params', apply_filters('rtwpvs_js_object', array(
	            'is_product_page' => is_product(),
	            'reselect_clear'  => rtwpvs()->get_option('clear_on_reselect')
	        )));	
    	}	

    /* Sidecart plugin / xoo-wsc */
		include_once( get_stylesheet_directory() .'/inc/enqueue-xoo-wsc-sidecart.php');

	/* jQuery UI Datepicker */
		wp_enqueue_style( 'jquery-ui-datepicker-style' , '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css');
		wp_enqueue_script( 'jquery-ui-datepicker' );
    }

	add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
	function enqueue_custom_scripts() {
		wp_enqueue_script( 'testScript.js', get_stylesheet_directory_uri().'/js/testScript.js', array( 'jquery' ), filemtime(get_stylesheet_directory().'/js/testScript.js'), true );

		if ( custom_is_page('registrationuser') ) {
			wp_enqueue_script( 'registrationPage.js', get_stylesheet_directory_uri().'/js/registrationPage.js', array( 'jquery' ), filemtime(get_stylesheet_directory().'/js/registrationPage.js'), true );	

			$ajax_vars = array( 
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				
			);
			wp_localize_script( 'registrationPage.js', 'custom_registration_params', $ajax_vars );
		}

/*
		if ( custom_is_page('registrationentry') ) {
			wp_enqueue_script( 'registrationEntryPage.js', get_stylesheet_directory_uri().'/js/registrationEntryPage.js', array( 'jquery' ), filemtime(get_stylesheet_directory().'/js/registrationEntryPage.js'), true );	
		}
*/
		if ( is_archive() ) {
			wp_enqueue_script( 'toggleFilters.js', get_stylesheet_directory_uri().'/js/toggleFilters.js', array( 'jquery' ), filemtime(get_stylesheet_directory().'/js/toggleFilters.js'), true );	
		}
		if ( is_single() ) {
	    	wp_enqueue_script( 'showYourCart.js', get_stylesheet_directory_uri().'/js/showYourCart.js', array( 'jquery' ), filemtime(get_stylesheet_directory().'/js/showYourCart.js'), true );	
		}

	// replace script with local script
	    wp_deregister_script('wc-add-to-cart');
    	wp_register_script( 'wc-add-to-cart', get_stylesheet_directory_uri().'/js/add_to_cart.js', array( 'jquery' ), filemtime(get_stylesheet_directory().'/js/add_to_cart.js'), true );
    	wp_enqueue_script('wc-add-to-cart');	

    	$vars = array( 'ajax_url' => admin_url( 'admin-ajax.php' ) );
		wp_localize_script( 'wc-add-to-cart', 'WC_VARIATION_ADD_TO_CART', $vars );  

		if( is_cart() ) {
			wp_enqueue_script( 'side-bar-cart-append', get_stylesheet_directory_uri().'/js/sideBarCart.js', array( 'jquery' ), filemtime(get_stylesheet_directory().'/js/sideBarCart.js'), true );
			
			wp_enqueue_script( 'cartUpdateVariations.js', get_stylesheet_directory_uri().'/js/cartUpdateVariations.js', array( 'jquery' ), filemtime(get_stylesheet_directory().'/js/cartUpdateVariations.js'), true );
			
			wp_localize_script( 'cartUpdateVariations.js', 'custom_cart_update_params', $vars );
		}  

		if( !is_checkout() ) {
			wp_enqueue_script( 'wc-add-to-cart-variation' );
		}


	}

	add_action('wp_enqueue_scripts', 'enqueue_pluginscripts_specificpage');
	function enqueue_pluginscripts_specificpage() {
		wp_dequeue_script( 'wooajaxcart' );
		remove_action('woocommerce_before_cart_table', 'wac_enqueue_scripts');
   		remove_action('wp_enqueue_scripts', 'wac_enqueue_scripts');

		if( is_cart() ) {
			add_action('woocommerce_before_cart_table', 'wac_enqueue_scripts');
   			add_action('wp_enqueue_scripts', 'wac_enqueue_scripts');
		}

	}


	add_action( 'wp_head', 'remove_actions_leto_actions' );
	function remove_actions_leto_actions() {
		remove_action('woocommerce_before_main_content', 'leto_wc_wrapper_start', 10);

		remove_action( 'woocommerce_before_single_product_summary', 'leto_wrap_single_product_gallery_after', 999 );
	}

		
	add_action( 'wp', 'custom_woocommerce_actions' );
	function custom_woocommerce_actions() {

		add_action( 'woocommerce_before_single_product_summary', 'override_leto_wrap_single_product_gallery_after', 999 );
		function override_leto_wrap_single_product_gallery_after() {
			echo '</div>';
			//Spacer
			echo '<div class="col-xs-12 col-sm-12 col-md-1"></div>';
			//Open product details wrapper
			$product_layout = get_theme_mod( 'leto_product_layout', 'product-layout-1');

			if ( $product_layout == 'product-layout-2' ) {
				echo '<div class="col-xs-12 col-sm-12 col-md-6 product-detail-summary sticky-element">';	
			} else {
				echo '<div class="col-xs-12 col-sm-12 col-md-5 product-detail-summary">';		
			}

		}

		add_action('woocommerce_before_main_content', 'override_leto_wc_wrapper_start', 11);
		function override_leto_wc_wrapper_start() {

			$fullwidth_archives = get_theme_mod( 'leto_fullwidth_shop_archives', 0 );

			if ( is_archive() && $fullwidth_archives ) {
				$cols = 'col-md-12';
			} else {
				$cols = 'col-xs-12 col-md-9';
			}

		    echo '<div id="primary" class="content-area ' . $cols . '">';
		        echo '<main id="main" class="site-main" role="main">';
		}
		

		add_action( 'woocommerce_before_shop_loop', 'category_slider_shortcode2', 0 );
		function category_slider_shortcode2() {   
			echo do_shortcode('[ultimate-woocommerce-filters]');
			global $wp_query;
			switch ($wp_query->get_queried_object()->term_id) {
				case 21: // Pani subcategories
					echo do_shortcode('[woo_category_slider id="141"]');
					break;
				
				default:
					echo do_shortcode('[woo_category_slider id="138"]');
					break;
			}

		    echo do_shortcode('[woocatslider id="92"]');

		    $prefix = '
		    <div class="berocket_single_filter_widget " style="">
		    	<div class="filters-modal collapsed"></div>
   				<div class="bapf_sfilter bapf_ccolaps filters-container collapsed">
      				<div class="bapf_head bapf_colaps_togl filters-toggle">
         				<h3 class="bapf_hascolarr filters-title">FILTERS</h3>
      				</div>
      				<div class="bapf_body filters-body" style="display: none;">
      		';

      		$all_filters = do_shortcode('[br_filters_group group_id=101]');
      		$apply_filter = do_shortcode('[br_filter_single filter_id=108]');
      		$search = array('bapf_sfilter', 'bapf_body');
      		$replace = array('bapf_sfilter filter-apply-container', 'bapf_body filter-apply-body');
			$apply_filter = str_replace($search, $replace, $apply_filter);
      		$suffix = '</div></div></div>';

		    $filters_wrapper = $prefix.$all_filters.$apply_filter.$suffix;
		    echo $filters_wrapper;
		    
		    echo do_shortcode('[br_filter_single filter_id=104]');
		    echo do_shortcode('[br_filter_single filter_id=103]');
		}

		add_action( 'woocommerce_after_shop_loop_item', 'custom_loop_add_to_cart', 0 );
		// Original action in woocommerce/includes/wc-template-functions.php 
			// function woocommerce_template_loop_add_to_cart
		function custom_loop_add_to_cart( $args = array() ) {
			global $product; 
			// removed "Read more" label
 			if (!$product->is_purchasable()) {
				return;
			}

			if ( $product ) {
				$defaults = array(
					'quantity'   => 1,
					'class'      => implode(
						' ',
						array_filter(
							array(
								'button',
								'product_type_' . $product->get_type(),
								$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',								
								$product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
								($product->get_type() === 'variable') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',

							)
						)
					),
					'attributes' => array(
						'data-product_id'  => $product->get_id(),
						'data-product_sku' => $product->get_sku(),
						'aria-label'       => $product->add_to_cart_description(),
						'rel'              => 'nofollow',
					),
				);

				$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

				if ( isset( $args['attributes']['aria-label'] ) ) {
					$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
				}

				wc_get_template( 'loop/add-to-cart.php', $args );
			}
		}

		add_action('woocommerce_after_add_to_cart_button','custom_single_add_to_cart_button');
		function custom_single_add_to_cart_button() {
			global $product;
			//echo '<div class="button-wrapper">';
			echo '<div class="button-container">';
				echo '<button type="submit" name="add-to-cart" value="'.esc_attr( $product->get_id() ).'" class="single_add_to_cart_button button alt">'.esc_html( $product->single_add_to_cart_text() ).'</button>';
			    echo '<a class="viewcart" href="'.wc_get_cart_url().'">View cart</a>';    
		    echo '</div>';
		    echo do_shortcode('[ti_wishlists_addtowishlist]');
		    //echo '</div>';
		}

		//remove_filter('woocommerce_cart_item_quantity', 'wac_filter_woocommerce_cart_item_quantity', 10, 3);

  		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
		add_action( 'custom_sidebar_cart_collaterals', 'woocommerce_cart_totals', 10 );



	}

	add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment'); 
	function woocommerce_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce; 
		ob_start(); 

		include_once( get_stylesheet_directory() .'/woocommerce/cart/cart.php');

		$cart_template = ob_get_clean();
		$fragments['form.woocommerce-cart-form'] = extract_html_element($cart_template, '<form', '</form>');
	  
		return $fragments; 
	}// end ajax cart update


	function extract_html_element($content, $start, $end){
	    $r = explode($start, $content);
/*	    error_log('first part');
	    error_log($r[0]);
	    error_log('2nd part');
	    error_log($r[1]);
*/
	    if ( isset($r[1]) ){
	    	$r[1] = $start . $r[1];

	        $r = explode($end, $r[1]);
/*
	        error_log('2nd half first part');
	    	error_log($r[0]);
	    	error_log('2nd half 2nd part');
	    	error_log($r[1]);
*/
	        $r[0] .= $end;
	        return $r[0];
	    }
	    return '';
	}




	
?>