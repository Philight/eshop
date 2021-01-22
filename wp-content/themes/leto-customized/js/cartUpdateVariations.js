jQuery(document).ready(function($){
	//alert('cartUpdateVariation loaded');

	class Cart {
		constructor( $cartForm ) {
			this.$cartForm = $cartForm;
			this.variationFormData = {};

			this.baseQty = 1;
			this.qtyUpdateDelay = null;

			this.disableUpdateButton();
			this.eventHandlers();
			this.checkVariations('onPageLoad');
		}

		disableUpdateButton() {
			this.$cartForm.find('button[name="update_cart"]').prop('disabled', true);
		}

		eventHandlers() {
			this.$cartForm.on( 'click', '.rtwpvs-term', this.optionSelect.bind(this) );		

			this.$cartForm.on( 'click', '.custom-qty-btn', this.qtyButton.bind(this) );
			this.$cartForm.on( 'change', '.qty', this.qtyInputChange.bind(this) );

			$(document.body).on( 'wc_fragments_refreshed', this.validateAllOptions.bind(this) );

		}

		block() {
			var loader = this.$cartForm.find('.cart-form-loader').addClass('cart-form-loading');
			console.log('LOADING');
			console.log(loader);
		}

		unblock() {
			var loader = this.$cartForm.find('.cart-form-loader').removeClass('cart-form-loading');
			console.log('UNLOADING');
			console.log(loader);
		}

		checkVariations(variationsForm) {
			console.log('VARIATIONSFORMS');

			if ( variationsForm === 'onPageLoad' ) {
				var $variationsForm = this.$cartForm.find('.woocommerce-cart-form .variations_form');
				console.log('variationsForm === onPageLoad');
				console.log($variationsForm);	

			} else if ( variationsForm === 'addedToCart' ) {
				
				var $products = this.$cartForm.find('.cart_item');
				var $variationsForm = $products.last().find('.variations_form');
				console.log('variationsForm === addedToCart');
				console.log($variationsForm);

			} else { // change variation
				console.log('variationsForm === changeVariations');
				var $variationsForm = variationsForm;
				console.log($variationsForm);
			}

			if ($variationsForm.length == 0)
				return false;

			console.log('Variationforms selectors');
			console.log($variationsForm);

			var _this = this;
			$variationsForm.each( function () {
				var productVariations = $(this).data('product_variations');
				console.log('Product variations');
				console.log(productVariations);

				var $cart_item = $(this).closest('.cart_item');
				var cart_key = _this.getCartKey($cart_item);

				console.log('cart key');
				console.log(cart_key);

				_this.parseFormData(productVariations, cart_key);

				console.log('variationFormData');
				console.log(_this.variationFormData);
				_this.validateOptions($(this), cart_key);
			})

			console.log('VARIATIONFORMDATA');
			console.log(this.variationFormData);
		}

		parseFormData(productVariations, cart_key) {
			var availableVariations = {};
			var _this = this;
			$.each(productVariations, function (index, variation) {
				if (variation.is_in_stock) {

					var attributesArr = Object.keys(variation.attributes);
					var variationObj = {
						attributes: variation.attributes,
						variation_id: variation.variation_id
					}
					_this.traverseObj(availableVariations, attributesArr, variationObj);

					_this.variationFormData[cart_key] = availableVariations;
					console.log(availableVariations);
				}
			});
		}

		traverseObj(newObject, attributesArr, variationObj) {
			if (attributesArr.length > 0) {
				var attributeName = attributesArr.shift();
				var attributeValue = variationObj.attributes[attributeName];

				if (!newObject[attributeName+'-all']) {
			// First traverse
					newObject[attributeName+'-all'] = [attributeValue];				
				} else if (newObject[attributeName+'-all'].indexOf(attributeValue) == -1) {
					newObject[attributeName+'-all'].push(attributeValue);
				}

				if (!newObject[attributeName+'-'+attributeValue]) {
					if (attributesArr.length == 0) { 
						newObject[attributeName+'-'+attributeValue] = { variation_id: variationObj.variation_id };
					} else {
						newObject[attributeName+'-'+attributeValue] = {};
						this.traverseObj(newObject[attributeName+'-'+attributeValue], attributesArr, variationObj);		
					}
				} else {
					this.traverseObj(newObject[attributeName+'-'+attributeValue], attributesArr, variationObj);		
				}
			}
		}

		getCartKey($cart_item) {
			var $qtyInput = $cart_item.find('input.qty');
			var cart_key = $qtyInput.attr('name').split('cart[').pop().split(']')[0];
			return cart_key;
		}

		optionSelect(e) {
			if ( e ) {
				e.preventDefault();
			}
			alert('term click');
			console.log('------------- optionSelect --------');
			console.log('variationFormData');
			console.log(this.variationFormData);
			console.log(e.target);
	
			var $selectedOption = $(e.target).closest('.rtwpvs-term');
			if ($selectedOption.hasClass('selected')) {
				console.log('already selected');
				return;
			} else {
				$selectedOption.siblings('.selected').removeClass('selected');
				$selectedOption.addClass('selected');
			}

			var $variationsForm = $(e.target).parents('.variations_form');
			console.log($variationsForm);

			var $cart_item = $variationsForm.closest('.cart_item');
			console.log($cart_item);

			var cart_key = this.getCartKey($cart_item);

			var cartPosition = 0;
			var _this = this;
			this.$cartForm.find('tbody').children().each( function(index) {
				cartPosition = index;
				if ( _this.getCartKey($(this)) === cart_key ) {
					return false;
				}
			})
			console.log('cartPosition: '+cartPosition);

			this.validateOptions($variationsForm, cart_key);

			var quantity = $cart_item.find('input.qty').val();

			var product_id = $variationsForm.data('product_id');

			var selectedAttributes = [];
			$variationsForm.find('.rtwpvs-terms-wrapper').each(function () {
				var attributeName = $(this).data('attribute_name');
				var attributeValue = $(this).find('.rtwpvs-term').filter('.selected').data('term');

				selectedAttributes.push(attributeName+'-'+attributeValue);
			});

			console.log('SELECTED ATTRIBUTES');
			console.log(selectedAttributes);
			console.log(this.variationFormData[cart_key]);
			var variation_id = this.getVariationId(selectedAttributes, this.variationFormData[cart_key]);
			console.log('var id: '+variation_id);

			console.log('Delete formdata: '+cart_key);
			delete this.variationFormData[cart_key];


			this.addVariationToCart(product_id, variation_id, quantity, cart_key, cartPosition);


			console.log('optionSelect finish');		
			console.log(this.variationFormData);
		}

		getVariationId(selectedAttributes, variationsObj) {
			if (!selectedAttributes.length) {
				return 0;
			} else if (selectedAttributes.length == 1) {
				var attribute = selectedAttributes.shift();
				var foundId = variationsObj[attribute] ? variationsObj[attribute]['variation_id'] : 0;
				return foundId;
			} else {
				var attribute = selectedAttributes.shift();	
				return this.getVariationId(selectedAttributes, variationsObj[attribute]);
			}
		}

		validateAllOptions() {
			console.log('validateAllOptions');
			var _this = this;
			this.$cartForm.find('.woocommerce-cart-form .variations_form').each( function() {
				var $cart_item = $(this).closest('.cart_item');
				var cart_key = _this.getCartKey($cart_item);
				console.log('cart key');
				console.log(cart_key);

				_this.validateOptions($(this), cart_key);
			})
		}

		addVariationToCart(product_id, variation_id, quantity, cart_key, cartPosition) {
			var data = {};
			data['product_id'] = product_id;
			data['quantity'] = quantity;
			data['variation_id'] = variation_id;
			data['cart_key'] = cart_key;
			console.log('Add Variation');
			console.log(product_id);
			console.log(variation_id);
			console.log(quantity);
			console.log(cartPosition);
			data["action"] = "custom_change_variation_in_cart";

			this.block();
			$.ajax({
				url: custom_cart_update_params.ajax_url,
				type: 'POST',
				context: this,
				data: data,
				success: function(response){
					console.log('refreshed fragments CART');
					console.log(response);

					if(response.fragments){
						this.updateFragments( response, cartPosition );
					} else {
						window.location.reload();
					}
				
			    },
			    complete: function() {
			    	this.unblock();
			    }

			})
		}

		isOptionAvailable(availableVariations, parentAttributes, attribute) {
			var localAttributes = parentAttributes.slice();

			if (localAttributes.length) {
				var parentNode = localAttributes.shift();
				
				if (parentNode.split('-')[0] != attribute.split('-')[0]) {
				// dont traverse if it is the selected element OR first attribute row after selected option
					return this.isOptionAvailable(availableVariations[parentNode], localAttributes, attribute);
				} 
			} 
			
			return availableVariations[attribute] ? true : false;
		}

		validateOptions($form, cart_key) {
			console.log('validateOptions');
			var _this = this;
			$form.each( function() {
				var $options = $(this).find('.rtwpvs-term');
				console.log($options);

				var availableVariations = _this.variationFormData[cart_key];;
				console.log(_this.variationFormData[cart_key]);

				var __this = _this;
				var parentAttributes = [];
				var $reselectOptions = [];
				$options.each( function() {
					//$(this).addClass('disabled');
					var attributeValue = $(this).attr('data-term');
					var attributeName = $(this).parent().attr('data-attribute_name');
					var attribute = attributeName+'-'+attributeValue;
					var isSelected = $(this).hasClass('selected');

					if (isSelected) { parentAttributes.push(attribute); }
				
					console.log(attribute);
					console.log(parentAttributes);
					var validOption = __this.isOptionAvailable(availableVariations, parentAttributes, attribute);

					validOption ? console.log('available') : console.log('unavailable');

					if (validOption) {
						$(this).removeClass('disabled');
					} else {
						$(this).addClass('disabled');
						if (isSelected) {
							$(this).removeClass('selected');
							$reselectOptions.push($(this).parent());
							parentAttributes[parentAttributes.length - 1] += ' disabled'; 
						}
					}
				});

				console.log('RESELECT');
				console.log($reselectOptions);
				$.each($reselectOptions, function (index, $attributeWrapper) {
					var foundOption = $attributeWrapper.children().not('.disabled').first();
					console.log($attributeWrapper.children().not('.disabled').first());
					if (foundOption.length) { 
						foundOption.addClass('selected'); 
						var attributeName = $attributeWrapper.data('attribute_name');
						var attributeValue = foundOption.data('term');
						var attributesLength = parentAttributes.length;
						for (var i = 0; i < parentAttributes.length; i++) {
							if ( parentAttributes[i].includes('disabled') && parentAttributes[i].includes(attributeName) ) {
								parentAttributes[i] = attributeName+'-'+attributeValue;
								break;	
							}
						}
					}
				});
			})	
		}

		updateFragments( response, addFormData ){

			console.log('cart fragments updating');
			console.log('addFormData: '+addFormData);

			if( response.fragments ){

				//$( document.body ).trigger( 'xoo_wsc_before_loading_fragments', [ response ] );

				//this.block();

				//Set fragments
		   		$.each( response.fragments, function( key, value ) {
					$( key ).replaceWith( value );
				});

		   		if( typeof wc_cart_fragments_params !== 'undefined' && ( 'sessionStorage' in window && window.sessionStorage !== null ) ){

		   			sessionStorage.setItem( wc_cart_fragments_params.fragment_name, JSON.stringify( response.fragments ) );
					localStorage.setItem( wc_cart_fragments_params.cart_hash_key, response.cart_hash );
					sessionStorage.setItem( wc_cart_fragments_params.cart_hash_key, response.cart_hash );

					if ( response.cart_hash ) {
						sessionStorage.setItem( 'wc_cart_created', ( new Date() ).getTime() );
					}

				}				

				if (addFormData || addFormData === 0) {
					console.log('addFormData: '+addFormData);
					switch (true) {
						case (addFormData === 'onPageLoad'):
							console.log('addFormData: '+addFormData);
							this.checkVariations('onPageLoad');
							break;
						case (addFormData >= 0):
							var cartPosition = addFormData;
					    	var $newVariationsForm = this.$cartForm.find('.cart_item:eq('+cartPosition+')').find('.variations_form');
							console.log('NEW variationsForm');
							console.log($newVariationsForm);
							this.checkVariations($newVariationsForm);
							break;
						case (addFormData === 'addedToCart'):
							this.checkVariations('addedToCart');
							break;
						default:

					}
				}

				$( document.body ).trigger( 'wc_fragments_refreshed' );

				//this.unblock();

				console.log('wc_fragments_refreshed');
			}

		}

		qtyButton(e) {
			if (e) {
				e.preventDefault();
			}
			//alert('qtyBtn click');

			var $qtyBtn = $(e.currentTarget);

			var $input 	= $qtyBtn.siblings('.qty');
			if( !$input.length ) return;

			var qtyVal = this.baseQty = parseFloat( $input.val() ),
				step 	= parseFloat( $input.attr('step') ),
				action 	= $qtyBtn.hasClass( 'custom-btn-plus' ) ? 'plus' : 'minus',
				newQty 	= action === 'plus' ? qtyVal + step : qtyVal - step;

			$input.val(newQty).trigger('change');
		}

		qtyInputChange(e) {
			var $input 	= $(e.currentTarget),
				cart_key = $input.attr('name').split('cart[').pop().split(']')[0],
				newQty 	= parseFloat( $input.val() ),
				step 	= parseFloat( $input.attr('step') ),
				min 	= parseFloat( $input.attr('min') ),
				max 	= parseFloat( $input.attr('max') ),
				invalid = false,
				message = false;

			//Validation
			
			if( isNaN( newQty )  || newQty < 0 || newQty < min  ){
				invalid = true;
			}
			else if( newQty > max ){
				invalid = true;
				//message = xoo_wsc_params.strings.maxQtyError.replace( '%s%', max );
			}
			else if( ( newQty % step ) !== 0 ){
				invalid = true;
				//message = xoo_wsc_params.strings.stepQtyError.replace( '%s%', step );
			}
			
			//Set back to default quantity
			if( invalid ){
				$input.val( this.baseQty );
				if( message ){
					//this.notice.add( message, 'error' );
					//this.notice.showNotification();
				}
				return;
			}

			$input.val( newQty );

			clearTimeout( this.qtyUpdateDelay );

			var _this = this;
			this.qtyUpdateDelay = setTimeout(function(){
				_this.updateItemQty( cart_key, newQty )
			}, 500 );
		}

		updateItemQty( cart_key, quantity ) {

			if( !cart_key || quantity === undefined ) return;

			var data = {};
			data['cart_key'] = cart_key;
			data['quantity'] = quantity;
			console.log('Update quantity');
			console.log(cart_key);
			console.log(quantity);
			data["action"] = "custom_change_quantity_in_cart";

			this.block();
			$.ajax({
				url: custom_cart_update_params.ajax_url,
				type: 'POST',
				context: this,
				data: data,
				success: function(response){
					console.log('refreshed fragments CART');
					console.log(response);

					if(response.fragments){
						this.updateFragments( response );
					} else {
						window.location.reload();
					}
			    },
			    complete: function() {
			    	this.unblock();
			    }
			})
		}

	}

	var cart = new Cart( $('.woocommerce') );

})