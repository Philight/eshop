( function ( $ ) {
	alert('CheckoutPage scripts');
	class CheckoutPage {

		constructor( $page ) {
			this.$page = $page;
			//this.notice = new Notice(this.$page);

			this.billingSameAsShipping = true;
			this.enableRegister = false;
			this.rememberMe = false;

			this.init();
			this.eventHandlers();
		}

		init() {

		}

		eventHandlers() {
			this.$page.on( 'click', '.country-code-wrapper', this.toggleCountryCodeDropdown.bind(this));
			this.$page.on( 'click', '.country-code-dropdown .country-code-item', this.setCountryCode.bind(this));
			this.$page.on( 'keyup', '#PhoneCode', this.filterCountryCodeDropdown.bind(this) );
			$(document).mouseup( this.collapseDropdown.bind(this) );	
			this.$page.on( 'change', '#BillingOption, #ShippingOption', this.toggleBillingShipping.bind(this) );
			this.$page.on( 'change', '#RegisterOption', this.toggleRegister.bind(this) );
			this.$page.on( 'click', '#TogglePassword, #ToggleConfirmPassword', this.togglePassword.bind(this) );
			this.$page.on( 'click', '.already-registered a', this.loginModal.bind(this) );
			this.$page.on( 'click', '.black-bkg', this.closeModal.bind(this) );

			this.$page.on( 'change', '#rememberme', this.toggleRememberMe.bind(this) );

			//this.$page.find('.woocommerce-form-login__submit').unbind();			
			this.$page.on( 'click', '.woocommerce-form-login__submit', this.login.bind(this) );

		}
//---  COUNTRY CODE
		toggleCountryCodeDropdown(e) {
			var $dropdown = $(e.currentTarget).siblings('.country-code-dropdown');
			$dropdown.hasClass('open') ? $dropdown.removeClass('open').addClass('collapsed')
									   : $dropdown.removeClass('collapsed').addClass('open');
		}

		collapseDropdown(e) {
			var $dropdown = this.$page.find(".country-code-dropdown");
	 		var $countryCodeWrapper = this.$page.find('.country-code-wrapper');

		    // If the target of the click isn't the container
		    if( !$dropdown.is(e.target) 
		    	&& $dropdown.has(e.target).length === 0
		    	&& ( $(e.target).closest($countryCodeWrapper).length === 0 ) ) { 
		    		
		        $dropdown.removeClass('open').addClass('collapsed');
		    }
		}

		setCountryCode(e) {
			alert('set country code');
			var chosenCountryCode = $(e.currentTarget).data('country-code');
			$('#PhoneCode').val(chosenCountryCode);

			$(e.currentTarget).parent().removeClass('open').addClass('collapsed');
		}

		filterCountryCodeDropdown(e) {
			var value = $(e.currentTarget).val().toLowerCase();

			this.$page.find(".country-code-dropdown li").filter(function() {
		    	$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
		}
//---END COUNTRY CODE

		toggleBillingShipping(e) {
			if ( $(e.target).is(':checked') ) {
				var $labels = $(e.currentTarget).closest('legend').siblings('label').slideUp(500);

				this.billingSameAsShipping = true;
			} else {
				//alert('unchecked');
				var $labels = $(e.currentTarget).closest('legend').siblings('label').slideDown(400);

				this.billingSameAsShipping = false;
			}
		}

		toggleRegister(e) {
			if ( $(e.target).is(':checked') ) {
				var $labels = $(e.currentTarget).closest('legend').siblings('label').slideDown(500);
				this.enableRegister = true;

			} else {
				var $labels = $(e.currentTarget).closest('legend').siblings('label').slideUp(500);
				this.enableRegister = false;
			}
		}
		
		togglePassword(e) {
			var $inputField = $(e.currentTarget).siblings('input');
			$inputField.attr('type') === 'password' ? $inputField.attr('type', 'text') : $inputField.attr('type', 'password');
		}

		loginModal(e) {
			//alert('login');
			this.$page.find('.black-bkg').show();
			this.$page.find('.login-modal').fadeIn(400);

			//wp_redirect( wp_validate_redirect( apply_filters( 'woocommerce_login_redirect', remove_query_arg( 'wc_error', $redirect ), $user ), wc_get_page_permalink( 'myaccount' ) ) ); // phpcs:ignore
		}

		closeModal(e) {
			this.$page.find('.black-bkg').fadeOut(600);
			this.$page.find('.login-modal').fadeOut(600);
		}

		toggleRememberMe(e) {
			this.rememberMe = $(e.target).is(':checked') ? true : false;
		}

		login(e) {
			//e.stopPropagation();
			//e.stopImmediatePropagation();
			e.preventDefault();
			alert('login');

			var formData = this.$page.find('.login-modal').find('select, textarea, input').serialize();
			var formDataArr = formData.split("&_wp_http_referer");
			formData = formDataArr[0];

			formData += '&action=custom_process_login';
			console.log('-----  FORM serialize');
			console.log(formData);
			console.log(formDataArr);

			$.ajax({
	            type: 'POST',
	            url: custom_checkout_params.ajax_url,
	            data: formData,
	            success: function (response) {
	            	alert('success');
	           	},
	           	error: function (jqXHR, exception) {

	           	}
	        })

		}
		
	}

	var page = new CheckoutPage( $('.woocommerce-checkout.checkout') );  
})(jQuery);