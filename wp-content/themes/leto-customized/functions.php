<?php
	include_once( get_stylesheet_directory() .'/inc/custom-main-navigation.php');

	add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
	function enqueue_parent_styles() {
	   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
	}

	add_action('wp_enqueue_scripts', 'enque_childtheme_js');
	function enque_childtheme_js() {
	    wp_enqueue_script( 'showYourCart.js', get_stylesheet_directory_uri().'/js/showYourCart.js', array( 'jquery' ), filemtime(get_stylesheet_directory_uri().'/js/showYourCart.js'), true );
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
		function custom_loop_add_to_cart( $args = array() ) {
			global $product; 
		// Original action, removed "Read more" label
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
			echo '<div class="button-wrapper">';
			echo '<div class="button-container">';
			echo '<button type="submit" name="add-to-cart" value="'.esc_attr( $product->get_id() ).'" class="single_add_to_cart_button button alt">'.esc_html( $product->single_add_to_cart_text() ).'</button>';
		
		    echo '<a class="viewcart" href="'.wc_get_cart_url().'">View cart</a>';    
		    echo '</div>';
		    echo '</div>';
		}

	}
	
?>