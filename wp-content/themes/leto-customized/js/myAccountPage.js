jQuery(document).ready( function ( $ ) {
	alert('script ready');

	class Notice {
		constructor( $noticeContainer ) {
			this.$noticeContainer = $noticeContainer;
			this.htmlWrapper = {
	// ion-android-checkmark-circle, ion-android-done
				success: '<li class="success"><i class="ion-android-checkmark-circle"></i><span>%s%</span></li>',
				error: '<li class="error"><i class="ion-android-alert"></i><span>%s%</span></li>',
			};
			this.messages = {
				success : {

				},
				error: {
					NOT_FILLED		: 'needs to be filled. Please fill in this field.',
					POST_INVALID	: 'Please enter a valid <strong>postal code</strong>.',				
				},
			};
			this.timeout = null;
		}

		add( type = 'success', messageCode, fieldName = ''){

			//var $noticeContainer = this.$page.find('.modal-edit-container .notice-container');

			var message = type === 'success' ? this.messages.success[messageCode] : this.messages.error[messageCode];
			if ( fieldName.length ) {
				message = fieldName + message;
			}

			var notice = this.htmlWrapper[type].replace( '%s%', message);

			console.log('noticeContainer');
			console.log(this.$noticeContainer);
			this.$noticeContainer.append( notice );
		}

		showNotifications(){

			if( !this.$noticeContainer.length || this.$noticeContainer.children().length === 0 ) return;

			this.$noticeContainer.slideDown();

			clearTimeout(this.timeout);
			var _this = this;
			this.timeout = setTimeout(function(){
				_this.$noticeContainer.slideUp( 'slow' );
			}, 5000 )

		}

		hideNotifications(){
			this.$noticeContainer.hide();
		}

		clearAll() {
			this.$noticeContainer.html('');
		}

	}

	class MyAccountPage {
		constructor($page) {
			this.$page = $page;
			this.editAddressNotices = new Notice( $('.modal-edit-container .notice-container') );
			this.defaultFormValues = {};
			this.fieldsToUpdate = $();
			this.page = $('.woocommerce-MyAccount-content .address-card').length ? 'addressPage' : 'accountPage';

			this.eventHandlers();
			this.setDefaultFormValues();
		}

		eventHandlers() {
			$(document).on( 'click', '.woocommerce-MyAccount-content .address-card .edit-shipping, .woocommerce-MyAccount-content .address-card.shipping', this.editShippingAddress.bind(this) );
			$(document).on( 'click', '.woocommerce-MyAccount-content .address-card .edit-billing, .woocommerce-MyAccount-content .address-card.billing', this.editBillingAddress.bind(this) );
			$(document).on( 'click', '.woocommerce-MyAccount-content .modal-background, .woocommerce-MyAccount-content .modal-edit-form .cancel-btn', this.closeModal.bind(this) );
	
			$(document).on( 'resetAddressForm', '.woocommerce-MyAccount-content .modal-edit-form', this.resetAddressForm.bind(this) );					
			$(document).on( 'change', '.woocommerce-MyAccount-content .modal-edit-form input, .woocommerce-MyAccount-content .modal-edit-form select', this.fieldChanged.bind(this) );
			$(document).on( 'click submit', '.woocommerce-MyAccount-content .modal-edit-form .submit-btn', this.submitFormData.bind(this) );
			
			$(document).on( 'click', '.woocommerce-MyAccount-content .info-card .edit-shipping, .woocommerce-MyAccount-content .info-card.personal', this.editPersonalInfo.bind(this) );
			$(document).on( 'click', '.woocommerce-MyAccount-content .info-card .edit-billing, .woocommerce-MyAccount-content .info-card.contact', this.editContactInfo.bind(this) );
			
			$(document).on( 'click', '.country-code-wrapper', this.toggleCountryCodeDropdown.bind(this));
			$(document).on( 'click', '.country-code-dropdown .country-code-item', this.setCountryCode.bind(this));
			$(document).on( 'keyup', '#PhoneCode', this.filterCountryCodeDropdown.bind(this) );
			$(document).on( 'change', '#Gender, #HearAboutUs', this.showOtherInput.bind(this) );
		
			$(document).mouseup( this.collapseDropdown.bind(this) );			
		}

		setDefaultFormValues() {
			var _this = this;
			$('.woocommerce-MyAccount-content .modal-edit-form input')
			.add($('.woocommerce-MyAccount-content .modal-edit-form select'))
			.each(function() {
				_this.defaultFormValues[$(this).attr('name')] = $(this).val();
			})
		}

		resetAddressForm() {
			var _this = this;
			$('.woocommerce-MyAccount-content .modal-edit-form input')
			.add($('.woocommerce-MyAccount-content .modal-edit-form select'))
			.each(function() {
				$(this).val(_this.defaultFormValues[$(this).attr('name')]);
			})
		}

		editShippingAddress() {
			$('.woocommerce-MyAccount-content .modal-edit-container').show();
			$('.woocommerce-MyAccount-content .modal-edit-form .shipping-info').fadeIn(400);
		}

		editBillingAddress() {
			$('.woocommerce-MyAccount-content .modal-edit-container').show();
			$('.woocommerce-MyAccount-content .modal-edit-form .billing-info').fadeIn(400);
		}

		showLoader() {
			$('.woocommerce-MyAccount-content .modal-edit-container .loading').show();
		}

		hideLoader() {
			$('.woocommerce-MyAccount-content .modal-edit-container .loading').hide();
		}

		closeModal(e) {
			if (e) {
				e.preventDefault();
			}
		
			$('.woocommerce-MyAccount-content .modal-edit-form .shipping-info').fadeOut(600);
			$('.woocommerce-MyAccount-content .modal-edit-form .billing-info').fadeOut(600);
			$('.woocommerce-MyAccount-content .modal-edit-form .personal-info').fadeOut(600);
			$('.woocommerce-MyAccount-content .modal-edit-form .contact-info').fadeOut(600);
			$('.woocommerce-MyAccount-content .modal-edit-container').fadeOut(600);
			$('.woocommerce-MyAccount-content .modal-edit-form').trigger('resetAddressForm');
		}

		fieldChanged(e) {
			this.fieldsToUpdate = this.fieldsToUpdate.add( $(e.currentTarget) );
		}

		isFieldValid($field) {
			var isValid = true;

			$field.val( $field.val().replace(/[^\S\r\n]{2,}/, ' ') ); //remove tabs, double spaces inside string
			switch ( $field.attr('id') ) {

				case 'ShippingPostalCode':
				case 'BillingPostalCode':
					var postalFormat = /^[a-z0-9][a-z0-9\- ]{0,10}[a-z0-9]$/i;
					if ( !$field.val().match(postalFormat) ) {
						this.editAddressNotices.add( 'error', 'POST_INVALID' );
						isValid = false;
					}
					break;

				default:
					break;
			}

			return isValid;
		}


		submitFormData(e) {
			alert('submit update');
			e.preventDefault();

			if ( this.fieldsToUpdate.length == 0 ) {
				$('.woocommerce-MyAccount-content .modal-edit-form .cancel-btn').trigger("click");
				return;
			}

			this.editAddressNotices.clearAll();

			var anyInvalidField = false;
			var _this = this;
			this.fieldsToUpdate.each( function() {

				// trim spaces
				if ($(this).val()) {
					$(this).val( $(this).val().trim() );
				}

				// required field is empty
				var attr = $(this).attr('required');
				if (typeof attr !== typeof undefined && attr !== false) {
			    	if ( !$(this).val().length ) {
			   
			    		var $span = $(this).closest('label').find('span');
						if ( !$span.length ) {
							console.log('Error: Validation - no span found');
							return false;
						}

						var fieldName = $span.text().split('*')[0];
						fieldName = '<strong>'+fieldName+'</strong>';
						_this.editAddressNotices.add( 'error', 'NOT_FILLED', fieldName );
						$(this).addClass('invalid');
						anyInvalidField = true;
						return true; // continue next iteration
			    	}
				}

				if ( _this.isFieldValid($(this)) ) {
					$(this).removeClass('invalid');
				} else {
					$(this).addClass('invalid');
					anyInvalidField = true;
				}
			})

			if ( anyInvalidField ) {
				this.editAddressNotices.showNotifications();
				return;
			}

			this.showLoader();
			var formData = {};
			formData['action'] = 'custom_update_user_shipping_data';

			this.fieldsToUpdate.each( function() {
				var fieldName = $(this).attr('name');
				formData[fieldName] = $(this).val();
			})

			$.ajax({
				type: 'POST',
		        url: custom_myaccount_params.ajax_url,
		        context: this,
	            data: formData,
	            success: function (response) {
	            	alert('ajax response');
	            	if ( response.success ) {
	            		this.updateFields();
	            		this.hideLoader();
	            		this.closeModal();
	            	}
	            }
			})
		}

		updateFields() {
			alert('updateFields');

			var _this = this;
			this.fieldsToUpdate.each( function() {
				var fieldName = $(this).attr('name');
				var updatedValue = $(this).val();
				_this.defaultFormValues[fieldName] = updatedValue;


				if (_this.page == 'addressPage') {
					alert('addressPage clause');
					$('.woocommerce-MyAccount-content .address-card .'+fieldName).html(updatedValue);
				} else {
					$('.woocommerce-MyAccount-content .info-card .'+fieldName).html(updatedValue);
				}
			});
		}

		editPersonalInfo() {
			$('.woocommerce-MyAccount-content .modal-edit-container').show();
			$('.woocommerce-MyAccount-content .modal-edit-form .personal-info').fadeIn(400);
		}

		editContactInfo() {
			$('.woocommerce-MyAccount-content .modal-edit-container').show();
			$('.woocommerce-MyAccount-content .modal-edit-form .contact-info').fadeIn(400);
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

		showOtherInput(e) {
			var $select = $(e.currentTarget);
			if ( $select.val() === 'other' ) {

				$select.parent().addClass('other');
				$select.siblings('span').addClass('other');
				$select.addClass('other');
				$select.siblings('input').removeClass('hidden');

			} else {
				$select.parent().removeClass('other');
				$select.siblings('span').removeClass('other');
				$select.removeClass('other');
				$select.siblings('input').addClass('hidden');
			}
		}
	}

	var page = new MyAccountPage( $('#main') );
});