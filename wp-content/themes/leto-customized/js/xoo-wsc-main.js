/*
	Overriden plugin script for side cart
	Original script: 'side-cart-woocommerce/assets/js/xoo-wsc-main.js'

	added a.viewcart on click listener
	$(document.body).on( 'click',
		to eventHandlers() function
$(document.body).on( 'click', 'a.added_to_cart, .viewcart, .xoo-wsc-cart-trigger', this.openCart.bind(this) );
*/

jQuery(document).ready(function($){

	var isCartPage 		= xoo_wsc_params.isCart == '1',
		isCheckoutPage 	= xoo_wsc_params.isCheckout == '1';

	var get_wcurl = function( endpoint ) {
		return xoo_wsc_params.wc_ajax_url.toString().replace(
			'%%endpoint%%',
			endpoint
		);
	};


	class Notice{

		constructor( $modal ){
			this.$modal = $modal;
			this.timeout = null;
		}

		add( notice, type = 'success', clearPrevious = true ){

			var $noticeCont = this.$modal.find('.xoo-wsc-notice-container');

			if( clearPrevious ){
				$noticeCont.html('');
			}

			var noticeHTML = type === 'success' ? xoo_wsc_params.html.successNotice.toString().replace( '%s%', notice ) : xoo_wsc_params.html.errorNotice.toString().replace( '%s%', notice );

			$noticeCont.html( noticeHTML );

		}

		showNotification(){

			var $noticeCont = this.$modal.find('.xoo-wsc-notice-container');

			if( !$noticeCont.length || $noticeCont.children().length === 0 ) return;

			$noticeCont.slideDown();
			
			clearTimeout(this.timeout);

			this.timeout = setTimeout(function(){
				$noticeCont.slideUp('slow',function(){
					//$noticeCont.html('');
				});
			},xoo_wsc_params.notificationTime )

		}

		hideNotification(){
			this.$modal.find('.xoo-wsc-notice-container').hide();
		}
	}


	class Container{

		constructor( $modal, container ){
			this.$modal 	= $modal;
			this.container 	= container || 'cart';
			this.notice 	= new Notice( this.$modal );

		}

		eventHandlers(){
			$(document.body).on( 'wc_fragments_refreshed updated_checkout', this.onCartUpdate.bind(this) );
		}

		onCartUpdate(){
			this.unblock();
			this.notice.showNotification();
		}

		setAjaxData( data, noticeSection ){

			var ajaxData = {
				container: this.container,
				noticeSection: noticeSection || this.noticeSection || this.container,
				isCheckout: isCheckoutPage,
				isCart: isCartPage
			}


			if( typeof data === 'object' ){

				$.extend( ajaxData, data );

			}
			else{

				var serializedData = data;

				$.each( ajaxData, function( key, value ){
					serializedData += ( '&'+key+'='+value );
				} )
		
				ajaxData = serializedData;

			}

			return ajaxData;
		}


		toggle( type ){

			var $activeEls 	= this.$modal.add( 'body' ),
				activeClass = 'xoo-wsc-'+ this.container +'-active';

			if( type === 'show' ){
				$activeEls.addClass(activeClass);
			}
			else if( type === 'hide' ){
				$activeEls.removeClass(activeClass);
			}
			else{
				$activeEls.toggleClass(activeClass);
			}

			$(document.body).trigger( 'xoo_wsc_' + this.container + '_toggled', [ type ] );

			this.notice.hideNotification();

		}


		block(){
			this.$modal.addClass('xoo-wsc-loading');
		}

		unblock(){
			this.$modal.removeClass('xoo-wsc-loading');
		}


		refreshMyFragments(){

			if( xoo_wsc_params.refreshCart === "yes" && typeof wc_cart_fragments_params !== 'undefined' ){
				$( document.body ).trigger( 'wc_fragment_refresh' );
				return;
			}

			this.block();

			$.ajax({
				url: xoo_wsc_params.adminurl,
				type: 'POST',
				context: this,
				data: {
					action: 'xoo_wsc_refresh_fragments',
				},
				success: function( response ){
					this.updateFragments(response, 'onPageLoad');
				},
				complete: function(){
					this.unblock();
				}
			})

		}


		updateCartCheckoutPage(){

			//Refresh checkout page
			if( isCheckoutPage ){
				if( $( 'form.checkout' ).length === 0 ){
					location.reload();
					return;
				}
				$(document.body).trigger("update_checkout");
			}

			//Refresh Cart page
			if( isCartPage ){
				$(document.body).trigger("wc_update_cart");
			}

		}

		updateFragments( response, addFormData ){

			console.log('xoo-wsc fragments updated');

			if( response.fragments ){

				$( document.body ).trigger( 'xoo_wsc_before_loading_fragments', [ response ] );

				this.block();

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
					    	var $newVariationsForm = this.$modal.find('.xoo-wsc-product:eq('+cartPosition+')').find('.variations_form');
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

				this.unblock();

				console.log('wc_fragments_refreshed');

			}
			
/*
			if( xoo_wsc_params.refreshCart === "yes" && typeof wc_cart_fragments_params !== 'undefined' ){
				this.block();
				$( document.body ).trigger( 'wc_fragment_refresh' );
				return;
			}
*/
		}

	}


	class Cart extends Container{

		constructor( $modal ){

			super( $modal, 'cart' );

			this.baseQty 		= 1;
			this.qtyUpdateDelay = null;
			this.variationFormData = {};

			this.refreshFragmentsOnPageLoad();
			this.eventHandlers();
			this.initSlider();

			var _this = this;


		}


		refreshFragmentsOnPageLoad(){
			setTimeout(function(){
				this.refreshMyFragments();
			}.bind(this), xoo_wsc_params.fetchDelay )
		}

		eventHandlers(){
			super.eventHandlers();

			this.$modal.on( 'click', '.xoo-wsc-chng, .custom-qty-btn', this.toggleQty.bind(this) );
			this.$modal.on( 'change', '.xoo-wsc-qty ', this.changeInputQty.bind(this) );
			this.$modal.on( 'click', '.xoo-wsc-undo-item', this.undoItem.bind(this) );
			this.$modal.on( 'focusin', '.xoo-wsc-qty', this.saveQtyFocus.bind(this) );
			this.$modal.on( 'click', '.xoo-wsc-smr-del', this.deleteIconClick.bind(this) );
			this.$modal.on( 'click', '.xoo-wsch-close, .xoo-wsc-opac, .xoo-wsc-ft-btn-continue', this.closeCartOnClick.bind(this) );
			this.$modal.on( 'click', '.xoo-wsc-basket', this.toggle.bind(this) );

			//this.$modal.off( 'click', '.rtwpvs-term' );
			this.$modal.on( 'click', '.rtwpvs-term', this.optionSelect.bind(this) );
			$(document.body).on( 'wc_fragments_refreshed', this.validateAllOptions.bind(this) );

			$(document.body).on( 'xoo_wsc_cart_updated', this.updateCartCheckoutPage.bind(this) );
			$(document.body).on( 'click', 'a.added_to_cart, a.viewcart, .xoo-wsc-cart-trigger', this.openCart.bind(this) );
			$(document.body).on( 'added_to_cart', this.addedToCart.bind(this) );

			if( xoo_wsc_params.autoOpenCart === 'yes' && xoo_wsc_params.addedToCart === 'yes'){
				this.openCart();
			}

			if( xoo_wsc_params.ajaxAddToCart === 'yes' ){
				$(document.body).on( 'submit', 'form.cart', this.addToCartFormSubmit.bind(this) );
			}

			if( typeof wc_cart_fragments_params === 'undefined' ){
				$( window ).on( 'pageshow' , this.onPageShow );
			}


			if( isCheckoutPage || isCartPage ){
				$(document.body).on( 'updated_shipping_method', this.refreshMyFragments.bind(this) );
			}

			//Animate shipping bar
			$(document.body).on( 'xoo_wsc_before_loading_fragments', this.storeShippingBarWidth.bind(this) );

		}

		checkVariations(variationsForm) {
			console.log('VARIATIONSFORMS');

			if ( variationsForm === 'onPageLoad' ) {
				var $variationsForm = this.$modal.find('.variations_form');
				console.log('variationsForm === onPageLoad');
				console.log($variationsForm);	

			} else if ( variationsForm === 'addedToCart' ) {
				
				var $products = this.$modal.find('.xoo-wsc-product');
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
/*
			
*/
			var _this = this;
			$variationsForm.each( function () {
				var productVariations = $(this).data('product_variations');
				console.log('Product variations');
				console.log(productVariations);

				var cart_key = $(this).closest('.xoo-wsc-product').data('key');
				console.log('cart key');
				console.log(cart_key);

				_this.parseFormData(productVariations, cart_key);

				_this.validateOptions($(this), cart_key);
			})
/*
			this.$modal.find('.variations_form').each( function() {
				var cart_key = $(this).closest('.xoo-wsc-product').data('key');
				console.log('cart key');
				console.log(cart_key);

				_this.validateOptions($(this), cart_key);
			})
*/
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

		validateAllOptions() {
			console.log('validateAllOptions');
			var _this = this;
			this.$modal.find('.variations_form').each( function() {
				var cart_key = $(this).closest('.xoo-wsc-product').data('key');
				console.log('cart key');
				console.log(cart_key);

				_this.validateOptions($(this), cart_key);
			})
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

			var cart_key = $variationsForm.closest('.xoo-wsc-product').data('key');
			console.log('cart key');
			console.log(cart_key);

			var cartPosition = 0;
			this.$modal.find('.xoo-wsc-products').children().each( function(index) {
				cartPosition = index;
				if ( $(this).data('key') === cart_key ) {
					return false;
				}
			})
			console.log('cartPosition: '+cartPosition);

			this.validateOptions($variationsForm, cart_key);

			var quantity = $variationsForm.siblings('.xoo-wsc-qty-price').find('input').val();
			console.log('SIBLINGS');
			console.log($variationsForm.siblings('.quantity'));

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
			//console.log('variation cart key: '+variationCartKey);
			//this.refreshMyFragments();

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
			data["action"] = "custom_change_variation_in_cart";

			this.block();
			$.ajax({
				url: xoo_wsc_params.adminurl,
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
			    	this.updateCartCheckoutPage();
			    }
			})
		}


		openCart(e){
			if( e ){
				e.preventDefault();
			}
			this.toggle('show');
		}

		addToCartFormSubmit(e){

			var $form = $(e.currentTarget);

			if( $form.closest('.product').hasClass('product-type-external') ) return;

			e.preventDefault();

			var $button  		= $form.find( 'button[type="submit"]'),
				productData 	= $form.serializeArray(),
				hasProductId 	= false;

			//Check for woocommerce custom quantity code 
			//https://docs.woocommerce.com/document/override-loop-template-and-show-quantities-next-to-add-to-cart-buttons/
			$.each( productData, function( key, form_item ){
				if( form_item.name === 'productID' || form_item.name === 'add-to-cart' ){
					if( form_item.value ){
						hasProductId = true;
						return false;
					}
				}
			})

			//If no product id found , look for the form action URL
			if( !hasProductId ){
				var is_url = $form.attr('action').match(/add-to-cart=([0-9]+)/),
					productID = is_url ? is_url[1] : false; 
			}

			// if button as name add-to-cart get it and add to form
	        if( $button.attr('name') && $button.attr('name') == 'add-to-cart' && $button.attr('value') ){
	            var productID = $button.attr('value');
	        }

	        if( productID ){
	        	productData.push({name: 'add-to-cart', value: productID});
	        }

	        productData.push({name: 'action', value: 'xoo_wsc_add_to_cart'});

			this.addToCartAjax( $button, productData );//Ajax add to cart
		}


		addToCartAjax( $button, productData ){

			this.block();

			$button.addClass('loading');

			// Trigger event.
			$( document.body ).trigger( 'adding_to_cart', [ $button, productData ] );

			$.ajax({
				url: xoo_wsc_params.adminurl,
				type: 'POST',
				context: this,
				data: $.param(productData),
			    success: function(response){

					if(response.fragments){
						// Trigger event so themes can refresh other areas.
						$( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $button ] );
					}else{
						window.location.reload();
					}

			    },
			    complete: function(){
			    	this.unblock();
			    	$button
			    		.removeClass('loading')
			    		.addClass('added');
			    }
			})
		}

		addedToCart( e, response, hash, $button ){

			console.log('addedToCart button');

			this.updateFragments( { fragments: response }, 'addedToCart' );

//			console.log('after updateFragments');

			//this.onCartUpdate();
	
			var _this = this;

			this.flyToCart( $button, function(){
				if( xoo_wsc_params.autoOpenCart === "yes" ){
					setTimeout(function(){
						_this.openCart();	
					},20 )
				}
			} );
		}


		flyToCart( $atcEL, callback ){

			var $basket = this.$modal.find('.xoo-wsc-basket').length ? this.$modal.find('.xoo-wsc-basket') : $(document.body).find('.xoo-wsc-sc-cont');

			if( !$basket.length || xoo_wsc_params.flyToCart !== 'yes' ){
				callback();
				return;
			}

			var customDragImgClass 	= '',
				$dragIMG 			= null,
				$product 			= $atcEL.parents('.product');


			//If has product container
			if( $product.length ){

				var $productGallery = $product.find('.woocommerce-product-gallery');

				if( customDragImgClass && $product.find( customDragImgClass ).length ){
					$dragIMG = $product.find( customDragImgClass );
				}
				else if( $product.find( 'img[data-xooWscFly="fly"]' ).length ){
					if( $productGallery.length ){
						$dragIMG = $productGallery.find( '.flex-active-slide img[data-xooWscFly="fly"]' ).length ? $productGallery.find( '.flex-active-slide img[data-xooWscFly="fly"]' ) : $productGallery.find( 'img[data-xooWscFly="fly"]' )
					}
					else{
						$dragIMG = $product.find( 'img[data-xooWscFly="fly"]' );
					}
				}
				else if( $productGallery.length ){
					$dragIMG = $productGallery;
				}
				else{
					$dragIMG = $product;
				}

			}
			else if( customDragImgClass ){
				var moveUp = 4;
				for ( var i = moveUp; i >= 0; i-- ) {
					var $foundImg = $atcEL.parent().find( customDragImgClass );
					if( $foundImg.length ){
						$dragIMG = $foundImg;
						return false;
					}
				}
			}


			if( !$dragIMG || !$dragIMG.length ){
				callback();
				return;
			}

			var $imgclone = $dragIMG
				.clone()
	    		.offset({
		            top: $dragIMG.offset().top,
		            left: $dragIMG.offset().left
		        })
	        	.addClass( 'xoo-wsc-fly-animating' )
	            .appendTo( $('body') )
	            .animate({
	            	'top': $basket.offset().top - 10,
		            'left': $basket.offset().left - 10,
		            'width': 75,
		            'height': 75
		        }, 1000, 'easeInOutExpo' );
	        
	        setTimeout(function () {
	        	callback()
	        }, 1500 );

	        $imgclone.animate({
	        	'width': 0,
	        	'height': 0
	        }, function () {
	        	$(this).detach();
	        });

		}


		toggleQty(e){

			var $toggler 	= $(e.currentTarget),
				$input 		= $toggler.siblings('.xoo-wsc-qty');

			if( !$input.length ) return;

			var baseQty = this.baseQty = parseFloat( $input.val() ),
				step 	= parseFloat( $input.attr('step') ),
				action 	= $toggler.hasClass( 'custom-btn-plus' ) ? 'add' : 'less',
				newQty 	= action === 'add' ? baseQty + step : baseQty - step;

			
			$input.val(newQty).trigger('change');

		}

		changeInputQty(e){

			this.notice.hideNotification();

			var $_this	= this,
 				$input 	= $(e.currentTarget),
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
				message = xoo_wsc_params.strings.maxQtyError.replace( '%s%', max );
			}
			else if( ( newQty % step ) !== 0 ){
				invalid = true;
				message = xoo_wsc_params.strings.stepQtyError.replace( '%s%', step );
			}
			
			//Set back to default quantity
			if( invalid ){
				$input.val( this.baseQty );
				if( message ){
					this.notice.add( message, 'error' );
					this.notice.showNotification();
				}
				return;
			}

			//Update
			$input.val( newQty );

			clearTimeout( this.qtyUpdateDelay );

			this.qtyUpdateDelay = setTimeout(function(){
				$_this.updateItemQty( $input.parents('.xoo-wsc-product').data('key'), newQty )
			}, xoo_wsc_params.qtyUpdateDelay );
			
			
		}

		updateItemQty( cart_key, qty ){

			if( !cart_key || qty === undefined ) return;

			this.block();

			var formData = {
				action: 'xoo_wsc_update_item_quantity',
				cart_key: cart_key,
				qty: qty
			}

			$.ajax({
				url: xoo_wsc_params.adminurl,
				type: 'POST',
				context: this,
				data: this.setAjaxData(formData),
				success: function(response){
					this.updateFragments( response );
					$(document.body).trigger( 'xoo_wsc_quantity_updated', [response] );
					$(document.body).trigger( 'xoo_wsc_cart_updated', [response] );
					this.unblock();
				}

			})
		}


		closeCartOnClick(e){
			e.preventDefault();
			this.toggle( 'hide' );
		}


		saveQtyFocus(e){
			this.baseQty = $(e.currentTarget).val();
		}


		onPageShow(e){
			if ( e.originalEvent.persisted ) {
				this.refreshMyFragments();
				$( document.body ).trigger( 'wc_fragment_refresh' );
			}
		}

		deleteIconClick(e){
			this.updateItemQty( $( e.currentTarget ).parents('.xoo-wsc-product').data('key'), 0 );
		}

		undoItem(e){

			var $undo 		= $(e.currentTarget),
				formData 	= {
					action: 'xoo_wsc_undo_item',
					cart_key: $undo.data('key')
				}

			this.block();

			$.ajax({
				url: xoo_wsc_params.adminurl,
				type: 'POST',
				context: this,
				data: this.setAjaxData(formData),
				success: function(response){
					this.updateFragments( response );
					$(document.body).trigger( 'xoo_wsc_item_restored', [response] );
					$(document.body).trigger( 'xoo_wsc_cart_updated', [response] );
					this.unblock();
				}

			})
		}

		storeShippingBarWidth( e ){
			var $bar = $(document.body).find( '.xoo-wsc-sb-bar > span' );
			if( !$bar.length ) return;
			this.shippingBarWidth = $bar.prop('style').width;
		}

		onCartUpdate(){
			super.onCartUpdate();
			this.animateShippingBar();
			this.initSlider();
			this.showBasket();
		}

		showBasket(){

			var $basket = $('.xoo-wsc-basket'),
				show 	= xoo_wsc_params.showBasket;

			if( show === "always_show" ){
				$basket.show();	
			}
			else if( show === "hide_empty" ){
				if( this.$modal.find('.xoo-wsc-product').length ){
					$basket.show();
				}
				else{
					$basket.hide();
				}
			}
			else{
				$basket.hide();
			}
		}

		animateShippingBar(){
			if( isCartPage || isCheckoutPage ) return;
			var $bar = $(document.body).find( '.xoo-wsc-sb-bar > span' );
			if( !$bar.length || !this.shippingBarWidth ) return;
			var newWidth = $bar.prop('style').width;
			$bar
				.width( this.shippingBarWidth )
				.animate({ width: newWidth }, 400, 'linear')
		}


		initSlider(){

			if( !$.isFunction( $.fn.lightSlider ) ) return;

			$('ul.xoo-wsc-sp-slider').lightSlider({
				item: 1,
			});
			
		}

	}

	

	class Slider extends Container{

		constructor( $modal ){

			super( $modal, 'slider' );

			if( xoo_wsc_params.sliderAutoClose ) this.noticeSection = 'cart';

			this.eventHandlers();

			this.shipping = xoo_wsc_params.shippingEnabled ? Shipping.init( this ) : null;
		}

		eventHandlers(){

			super.eventHandlers();


			$( document.body ).on( 'click', '.xoo-wsc-toggle-slider', this.triggerSlider.bind(this) );
			$( document.body ).on( 'xoo_wsc_cart_toggled', this.closeSliderOnCartClose.bind(this) );

			if( xoo_wsc_params.sliderAutoClose ){
				$( document.body ).on( 'xoo_wsc_coupon_applied xoo_wsc_shipping_calculated updated_shipping_method xoo_wsc_coupon_removed', this.closeSlider.bind(this) );
			}

			this.$modal.on( 'submit', 'form.xoo-wsc-sl-apply-coupon', this.submitCouponForm.bind(this) );
			this.$modal.on( 'click', '.xoo-wsc-coupon-apply-btn', this.applyCouponFromBtn.bind(this) );
			$(document.body).on( 'click', '.xoo-wsc-remove-coupon', this.removeCoupon.bind(this) );
		}


		removeCoupon(e){

			e.preventDefault();

			var $removeEl 	= $(e.currentTarget),
				coupon 		= $removeEl.data('code'),
				formData 	= {
					coupon: coupon,
					action: 'xoo_wsc_remove_coupon'
				};

			this.block();	

			$.ajax( {
				url: xoo_wsc_params.adminurl,
				type: 'POST',
				context: this,
				data: this.setAjaxData( formData, cart.$modal.find( $removeEl ).length ? 'cart' : 'slider' ),
				success: function( response ) {
					this.updateFragments(response);
				},
				complete: function() {
					this.unblock();
					this.updateCartCheckoutPage();
					$( document.body ).trigger( 'xoo_wsc_coupon_removed' );
				}
			} );
		}

		onCartUpdate(){
			super.onCartUpdate();
			this.toggleContent();
		}

		closeSlider(){
			this.toggle('hide');
		}


		applyCouponFromBtn(e){
			this.applyCoupon( $(e.currentTarget).val() );
		}

		submitCouponForm(e){

			e.preventDefault();

			var $form = $(e.currentTarget);

			this.applyCoupon( $form.find('input[name="xoo-wsc-slcf-input"]').val() );

		}


		closeSliderOnCartClose(e){

			var $this = $(e.currentTarget); 

			if( !cart.$modal.hasClass('xoo-wsc-cart-active') ){
				this.toggle('hide');
			}

		}


		triggerSlider(e){

			var $toggler 	= $(e.currentTarget),
 				slider 		= $toggler.data('slider');

			if( slider === 'shipping' && isCheckoutPage ){
				this.notice.add( xoo_wsc_params.strings.calculateCheckout, 'error' );
				this.notice.showNotification();
				return;
			}


			this.$modal.attr( 'data-slider', slider );
			
			this.toggle();

			this.toggleContent();
		}


		toggleContent(){

			var activeSlider = '';

			$('.xoo-wsc-sl-content').hide();
			
			var activeSlider 	= this.$modal.attr('data-slider'),
				$toggleEl 		= $('.xoo-wsc-sl-content[data-slider="'+activeSlider+'"]');
	
			if( $toggleEl.length ) $toggleEl.show();

			$( document.body ).trigger( 'xoo_wsc_slider_data_toggled', [activeSlider] );
		}


		applyCoupon( coupon ){

			if( !coupon ){
				this.notice.add( xoo_wsc_params.strings.couponEmpty, 'error' );
				this.notice.showNotification();
				return;
			}

			this.block();

			var formData = {
				'coupon': coupon,
				'action': 'xoo_wsc_apply_coupon'
			}

			$.ajax( {
				url: xoo_wsc_params.adminurl,
				type: 'POST',
				context: this,
				data: this.setAjaxData( formData ),
				success: function( response ) {
					this.updateFragments(response);
				},
				complete: function() {
					this.unblock();
					this.updateCartCheckoutPage();
					$( document.body ).trigger( 'xoo_wsc_coupon_applied' );
				}
			} );

		}

	}

	

	var Shipping = {

		init: function( slider ){
			slider.$modal.on( 'change', 'input.xoo-wsc-shipping-method', this.shippingMethodChange );
			slider.$modal.on( 'submit', 'form.woocommerce-shipping-calculator', this.shippingCalculatorSubmit );
			slider.$modal.on( 'click', '.shipping-calculator-button', this.toggleCalculator );
			$(document.body).on( 'wc_fragments_refreshed wc_fragments_loaded xoo_wsc_slider_data_toggled', this.initSelect2 );
		},

		toggleCalculator: function(e){

			e.preventDefault();
			e.stopImmediatePropagation();

			$(this).siblings('.shipping-calculator-form').slideToggle();
			$( document.body ).trigger( 'country_to_state_changed' );
		},

		shippingCalculatorSubmit: function(e){

			e.preventDefault();
			e.stopImmediatePropagation();

			var $form = $(this);

			slider.block();

			// Provide the submit button value because wc-form-handler expects it.
			$( '<input />' )
				.attr( 'type', 'hidden' )
				.attr( 'name', 'calc_shipping' )
				.attr( 'value', 'x' )
				.appendTo( $form );

			var formData = $form.serialize() + '&action=xoo_wsc_calculate_shipping';

			// Make call to actual form post URL.
			$.ajax( {
				url: xoo_wsc_params.adminurl,
				type: 'POST',
				context: this,
				data: slider.setAjaxData(formData),
				success: function( response ) {
					slider.updateFragments(response);
				},
				complete: function() {
					slider.unblock();
					slider.updateCartCheckoutPage();
					$( document.body ).trigger( 'xoo_wsc_shipping_calculated' );
				}
			} );

		},

		shippingMethodChange: function(e){

			e.preventDefault();
			e.stopImmediatePropagation();

			var shipping_methods = {};

			slider.block();

			$( 'select.shipping_method, :input[name^=xoo-wsc-shipping_method][type=radio]:checked, :input[name^=shipping_method][type=hidden]' ).each( function() {
				shipping_methods[ $( this ).data( 'index' ) ] = $( this ).val();
			} );

			var formData = {
				shipping_method: shipping_methods,
				action: 'xoo_wsc_update_shipping_method',
			}

			$.ajax( {
				type:     'POST',
				url:      xoo_wsc_params.adminurl,
				data:     slider.setAjaxData( formData ),
				success:  function( response ) {
					slider.updateFragments(response);
				},
				complete: function() {
					slider.unblock();
					slider.updateCartCheckoutPage();
					$( document.body ).trigger( 'updated_shipping_method' );
				}
			} );

		},

		initSelect2: function(e){
			$( document.body ).trigger( 'country_to_state_changed' );
		},
	}


	var cart 	= new Cart( $('.xoo-wsc-modal') ),
		slider 	= new Slider( $('.xoo-wsc-slider-modal') );

})