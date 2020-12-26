<?php
	include_once( get_stylesheet_directory() .'/inc/custom-main-navigation.php');
	include_once( get_stylesheet_directory() .'/inc/ajax-add-to-cart-extended.php');

	add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
	function enqueue_parent_styles() {
	   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
	}

	add_action('wp_enqueue_scripts', 'enqueue_childtheme_js');
	function enqueue_childtheme_js() {
	    wp_enqueue_script( 'showYourCart.js', get_stylesheet_directory_uri().'/js/showYourCart.js', array( 'jquery' ), filemtime(get_stylesheet_directory().'/js/showYourCart.js'), true );

	    wp_deregister_script('wc-add-to-cart');
    	wp_register_script( 'wc-add-to-cart', get_stylesheet_directory_uri().'/js/add_to_cart.js', array( 'jquery' ), filemtime(get_stylesheet_directory().'/js/add_to_cart.js'), true );
    	wp_enqueue_script('wc-add-to-cart');	

    	$vars = array( 'ajax_url' => admin_url( 'admin-ajax.php' ) );
		wp_localize_script( 'wc-add-to-cart', 'WC_VARIATION_ADD_TO_CART', $vars );    
	}

	add_action( 'wp', 'custom_woocommerce_actions' );
	function custom_woocommerce_actions() {
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
		    //echo '</div>';
		}

	}
	
?>