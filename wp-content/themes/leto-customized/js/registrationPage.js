jQuery(document).ready( function ( $ ) {


	class Notice {

		constructor( $page ){
			this.$page = $page;
			this.htmlWrapper = {
// ion-android-checkmark-circle, ion-android-done
				success: '<li class="success"><i class="ion-android-checkmark-circle"></i><span>%s%</span></li>',
				error: '<li><i class="ion-android-alert"></i><span>%s%</span></li>',
			};

			this.messages = {
				success: {
					ACC_CREATED 	: 'Account was successfuly created.', 
				},
				error: {
					NOT_FILLED		: 'needs to be filled. Please fill in this field.',
					USER_EXISTS 	: 'The <strong>username</strong> is already used. Please choose another one.', 
					USER_INVALID 	: '<strong>Username</strong> has to have atleast 5 characters, can contain characters a-Z, numbers 0-9 or underscore "_".',
					DISP_INVALID 	: '<strong>Display name</strong> can contain characters a-Z, numbers 0-9 or underscore "_". ',
					ICO_INVALID		: 'Please check your <strong>ICO number</strong>.',
					DIC_INVALID		: 'Please check your <strong>DIC number</strong>.',
					ICDPH_INVALID	: 'Please check your <strong>VAT number</strong>.',
					PASS_INVALID 	: '<strong>Password</strong> has to have atleast 6 characters.',
					PASS_NOMATCH	: 'Please check if passwords match.',
					EMAIL_EXISTS	: 'The <strong>email</strong> is already used. Have you forgotten your <em>login</em> or <em>password?</em>',
					EMAIL_INVALID	: 'Please enter a valid <strong>email address</strong> (example@gmail.com)',
					PCODE_INVALID	: 'Please enter a valid <strong>phone code</strong>. Starting with + or 00. ',
					PNUM_INVALID	: '<strong>Phone number</strong> has some invalid characters.',
					WEB_INVALID		: 'URL to your <strong>website</strong> is in wrong format. Please type it in as: "www.example.com", "http://example.com" or "https://example.com".',
					POST_INVALID	: 'Please enter a valid <strong>postal code</strong>.',
					DATE_INVALID	: 'Please check if <strong>date of birth</strong> is in correct format "28.01.2000", or you can select it from the datepicker.',
					INT_ADDUSERMETA : 'An internal error occurred. Please try again.',
					INT_UNCAUGHT    : 'An internal error occurred. Please try again.',
				}
			};
		}

		add( type = 'success', messageCode, fieldName = ''){

			var $noticeContainer = this.$page.find('.notice-container');

			var message = type === 'success' ? this.messages.success[messageCode] : this.messages.error[messageCode];
			if ( fieldName.length ) {
				message = fieldName + message;
			}

			var notice = this.htmlWrapper[type].replace( '%s%', message);

			$noticeContainer.append( notice );
		}

		clearAll() {
			this.$page.find('.notice-container').html('');
		}

		showNotifications(){

			var $noticeCont = this.$page.find('.notice-container');

			if( !$noticeCont.length || $noticeCont.children().length === 0 ) return;

			$noticeCont.slideDown();

		}

		hideNotifications(){
			this.$page.find('.notice-container').hide();
		}
	}
	


	class RegistrationPage {

		constructor( $page ) {
			this.$page = $page;
			this.notice = new Notice(this.$page);

			this.formType = this.$page.find('.register-user-form').length ? 'user' : 'wholesale';
			this.billingSameAsShipping = true;

			this.init();
			this.eventHandlers();
		}

		init() {
			$('#DateOfBirth').datepicker({ 
				dateFormat : 'dd.mm.yy',
				changeMonth: true,
				changeYear: true,
				yearRange : '-111:+0',
			});
		}
	
		eventHandlers() {
			this.$page.on( 'click', '#TogglePassword, #ToggleConfirmPassword', this.togglePassword.bind(this) );
			this.$page.on( 'click', '.country-code-wrapper', this.toggleCountryCodeDropdown.bind(this));
			this.$page.on( 'click', '.country-code-dropdown .country-code-item', this.setCountryCode.bind(this));
			this.$page.on( 'keyup', '#PhoneCode', this.filterCountryCodeDropdown.bind(this) );
			this.$page.on( 'change', '#BillingOption, #ShippingOption', this.toggleBillingShipping.bind(this) );
			this.$page.on( 'change', '#Gender, #HearAboutUs', this.showOtherInput.bind(this) );
			//this.$page.on( 'change', '#HearAboutUs', this.selectHearAboutUsOther.bind(this) );

			this.$page.on( 'click submit', '.submit-btn', this.submitFormData.bind(this) );

			$(document).mouseup( this.collapseDropdown.bind(this) );	
		}

		togglePassword(e) {
			var $inputField = $(e.currentTarget).siblings('input');
			$inputField.attr('type') === 'password' ? $inputField.attr('type', 'text') : $inputField.attr('type', 'password');
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

		toggleBillingShipping(e) {
			if ( $(e.target).is(':checked') ) {
				//alert('checked');
				var $labels = $(e.currentTarget).parent().siblings('label').slideUp(500);

				this.billingSameAsShipping = true;
				this.$page.find('.register-optional .optional-title').addClass('move-up');
			} else {
				//alert('unchecked');
				var $labels = $(e.currentTarget).parent().siblings('label').slideDown(400);

				this.billingSameAsShipping = false;
				this.$page.find('.register-optional .optional-title').removeClass('move-up');
			}
		}

		showOtherInput(e) {
			var $select = $(e.currentTarget);
			if ( $select.val() === 'other' ) {

				$select.parent().addClass('other');
				$select.siblings('span').addClass('other');
				$select.addClass('other');
				$select.siblings('input').show();

			} else {
				$select.parent().removeClass('other');
				$select.siblings('span').removeClass('other');
				$select.removeClass('other');
				$select.siblings('input').hide();
			}
		}


//---  VALIDATION
		trimSpaces() {
			var $inputs = this.$page.find('input').not('#Password, #ConfirmPassword, #PhoneCode' ); //Country, if change to input
			$inputs.each(function() {
				if ($(this).val()) {
					$(this).val().trim();
				}
			});

			var $selects = this.$page.find('select');
			$selects.each(function() {
				if ($(this).val()) {
					$(this).val().trim();
				}
			});
		}

		isFieldValid($field) {

			var isValid = true;

			$field.val( $field.val().replace(/[^\S\r\n]{2,}/, ' ') ); //remove tabs, double spaces inside string
			switch ( $field.attr('id') ) {

				case 'ICO':
					var numberFormat = /^[0-9]{8}$/;
					if ( !$field.val().match(numberFormat) ) {
						this.notice.add( 'error', 'ICO_INVALID' );
						isValid = false;
					}
					break;
				
				case 'DIC':
					var numberFormat = /^[1-2]{1}[0-9]{9}$/;
					if ( !$field.val().match(numberFormat) ) {
						this.notice.add( 'error', 'DIC_INVALID' );
						isValid = false;
					}
					break;
				
				case 'ICDPH': // VAT number
					var numberFormat = /^[a-z]{2}[1-2]{1}[0-9]{9}$/i;
					if ( !$field.val().match(numberFormat) ) {
						this.notice.add( 'error', 'ICDPH_INVALID' );
						isValid = false;
					}
					break;
						
				case 'Username':
					var illegalChars = /\W/;

					if ( $field.val().length < 5 || $field.val().length > 50
												  || illegalChars.test($field.val()) ) {
						this.notice.add( 'error', 'USER_INVALID' );
						isValid = false;
					} 
					break;
/*
				case 'DisplayName':
					var illegalChars = /\W/;

					if ( illegalChars.test($field.val()) ) {
						this.notice.add( 'error', 'DISP_INVALID' );
						isValid = false;
					}
					break;
*/
				case 'Password':
					if ( ($field.val().length < 6) ) {
						this.notice.add( 'error', 'PASS_INVALID' );
						isValid = false;
					}
					break;
				
				case 'ConfirmPassword':
					var $input = this.$page.find('#Password');
					if ( $field.val() !== $input.val() ) { 
						this.notice.add( 'error', 'PASS_NOMATCH' );
						isValid = false;
					}

					break;

				case 'Email':
					var mailFormat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
					if ( !$field.val().match(mailFormat) ) {
						this.notice.add( 'error', 'EMAIL_INVALID' );
						isValid = false;
					}
					break;

				case 'Website':
					var webFormat = /((https?|ftp):\/\/|www\.)(-\.)?([^\s/?\.#-]+(\.|-)?)+(\/[^\s]*)?$/i;
					if ( !$field.val().match(webFormat) ) {
						this.notice.add( 'error', 'WEB_INVALID' );
						isValid = false;
					}
					break;

				case 'PhoneCode':
					var codeFormat = /^(\+[0-9]{1,4}|0{2}[0-9]{1,4})$/;
					if ( !$field.val().match(codeFormat) ) {
						this.notice.add( 'error', 'PCODE_INVALID' );
						isValid = false;
					}
					break;

				case 'PhoneNumber':
					var specialChars = /\(|\)|\-|\/|\.|\s/g;
					var phoneFormat = /^[0-9]{3,17}$/;

					var phoneNumber = $field.val();
					phoneNumber = ( phoneNumber.replace(specialChars, '') );

					if ( !(phoneNumber.match(phoneFormat)) ) {
						this.notice.add( 'error', 'PNUM_INVALID' );
						isValid = false;
					}
					$field.val(phoneNumber);
					
					break;

				case 'ShippingPostalCode':
				case 'BillingPostalCode':
					var postalFormat = /^[a-z0-9][a-z0-9\- ]{0,10}[a-z0-9]$/i;
					if ( !$field.val().match(postalFormat) ) {
						this.notice.add( 'error', 'POST_INVALID' );
						isValid = false;
					}
					break;

				case 'DateOfBirth':
					var dateFormat = /([0-2]?[0-9]|3?[0-1])[\.\/\-](0?[1-9]|1[0-2])[\.\/\-][1-2][0-9]{3}/;
					if ( !$field.val().match(dateFormat) ) {
						this.notice.add( 'error', 'DATE_INVALID' );
						isValid = false;
					}
				default:
					break;
			}

			return isValid;
		}

		validateAllFields() {
			var anyInvalidField = false;

			// REQUIRED FIELDS
			//var $profileInputs = null;
			//var $contactInputs = null;
			var $profileOrContactInputs = this.formType === 'user' ? this.$page.find('.register-profile input[required]') 
																   : this.$page.find('.register-contact input[required]');
/*		
			if ( this.formType === 'user' ) {
				$profileInputs = 

			} else if ( this.formType === 'wholesale' ) {
				
			}
*/
			var $shippingInputs = this.formType === 'user' ? this.$page.find('.register-shipping input[required]') : null;
			var $billingInputs = this.formType === 'wholesale' ? this.$page.find('.register-billing input[required]') : null;

			if (!this.billingSameAsShipping) {
				if ( this.formType === 'user' ) {
					$billingInputs = this.$page.find('.register-billing input[required]');

				} else if ( this.formType === 'wholesale' ) {
					$shippingInputs = this.$page.find('.register-shipping input[required]');				
				}
			}
			
			var $allInputs = $profileOrContactInputs.add($shippingInputs).add($billingInputs);
			console.log('required input fields');
			console.log($allInputs);		

			var _this = this;
			$allInputs.each( function() {

				if ( $(this).val() === null ) {
					return;
				}
				else if ( !$(this).val().length ) {
					var $span = $(this).closest('label').find('span');
					if ( !$span.length ) {
						console.log('Error: Validation - no span found');
						return false;
					}

					var fieldName = $span.text().split('*')[0];
					fieldName = '<strong>'+fieldName+'</strong>';
					_this.notice.add( 'error', 'NOT_FILLED', fieldName );
					anyInvalidField = true;
					$(this).addClass('invalid');

				} else if ( !_this.isFieldValid($(this)) ) {
					//alert('field filled');
					anyInvalidField = true;
					$(this).addClass('invalid');
					
				} else {
				// Valid field
					$(this).removeClass('invalid');
				}
			})

			// OPTIONAL FIELDS
			if ( this.formType === 'user' ) {
				$profileOrContactInputs = this.$page.find('.register-profile input:not(:required)');
	
			} else if ( this.formType === 'wholesale' ) {
				$profileOrContactInputs = this.$page.find('.register-contact input:not(:required)');
			}
			
			$shippingInputs = this.formType === 'user' ? this.$page.find('.register-shipping input:not(:required)') : null;
			$billingInputs = this.formType === 'wholesale' ? this.$page.find('.register-billing input:not(:required)') : null;

			if (!this.billingSameAsShipping) {
				if ( this.formType === 'user' ) {
					$billingInputs = this.$page.find('.register-billing input:not(:required)');

				} else if ( this.formType === 'wholesale' ) {
					$shippingInputs = this.$page.find('.register-shipping input:not(:required)');				
				}
			}
			var $optionalInputs = this.$page.find('.register-optional input:not(:required)');

			$allInputs = $profileOrContactInputs.add($shippingInputs).add($billingInputs).add($optionalInputs);
	
			var $optionalSelects =  this.$page.find('.register-optional select');
			var $allOptionalFields = $allInputs.add($optionalSelects);
			
			console.log('all optional fields');
			console.log($allOptionalFields);

			_this = this;
			$allOptionalFields.each( function() {
				if ( $(this).val() && !_this.isFieldValid($(this)) ) {
					anyInvalidField = true;
					$(this).addClass('invalid');
				} else {
					$(this).removeClass('invalid');
				}
			})

			return anyInvalidField;
		}
//---END VALIDATION

		submitFormData(e) {

			alert('submit');
			e.preventDefault();

			this.notice.clearAll();
			var anyInvalidField = this.validateAllFields();

			if ( anyInvalidField ) {
				alert('error while validating');

				$("html, body").animate({ scrollTop: 0}, 'slow');
				return;

			} else {
				alert('success validation');
				
			}

			//var formData = this.$page.children('.register-user-form').serialize();
			//var formData = this.$page.children('.register-wholesale-form').serialize();


			var formData = this.$page.children('.register-user-form, .register-wholesale-form').serialize();

			this.billingSameAsShipping ? formData += '&billing_same_as_shipping=true' : formData += '&billing_same_as_shipping=false';

			formData += '&action=custom_submit_user_registration_form';
			console.log('-----  FORM serialize');
			console.log(formData);

			$(e.currentTarget).html('').addClass('loading');
			var _this = this;
			$.ajax({
	            type: 'POST',
	            url: custom_registration_params.ajax_url,
	            data: formData,
	            success: function (response) {
	            	console.log('form submit response');
	            	console.log(response);
	            	if ( response.success == false ) {
	            		switch( response.data[0].code ) {
	            			case 'existing_user_login':
	            				_this.notice.add( 'error', 'USER_EXISTS' );
	            				break;
	            			case 'existing_user_email':
	            				_this.notice.add( 'error', 'EMAIL_EXISTS' );
	            				break;
	            			case 'Error: add_user_meta()':
	            				_this.notice.add( 'error', 'INT_ADDUSERMETA' );
	            				console.log('Registration error: add_user_meta');
	            				break;
	            			default:
	            				_this.notice.add( 'error', 'INT_UNCAUGHT');
	            				console.log('Registration error: Unhandled exception');
	            				break;
	            		}
	   
	            	} else if ( response.success == true ) {
	            		alert('form was submitted');
	            		_this.notice.add( 'success', 'ACC_CREATED' );
	            	}

					$(e.currentTarget).removeClass('loading').html('REGISTER');
	            	$("html, body").animate({ scrollTop: 0}, 'slow');
	            },
	            error: function (jqXHR, exception) {
			        var msg = '';
			        if (jqXHR.status === 0) {
			            msg = 'Not connect.\n Verify Network.';
			        } else if (jqXHR.status == 404) {
			            msg = 'Requested page not found. [404]';
			        } else if (jqXHR.status == 500) {
			            msg = 'Internal Server Error [500].';
			        } else if (exception === 'parsererror') {
			            msg = 'Requested JSON parse failed.';
			        } else if (exception === 'timeout') {
			            msg = 'Time out error.';
			        } else if (exception === 'abort') {
			            msg = 'Ajax request aborted.';
			        } else {
			            msg = 'Uncaught Error.\n' + jqXHR.responseText;
			        }
			        alert(msg);
			    },
          	});



		}
	}



/////////////////   UR-FORM  /////
/*
	var $billingAddressField = $('#billing_address_field').addClass('validate-required');
	$billingAddressField.find('#billing_address').prop('required', 'required');
	$billingAddressField.find('.ur-label').append('<abbr class="required" title="required"> *</abbr>');

	var $billingCityField = $('#billing_city_field').addClass('validate-required');
	$billingCityField.find('#billing_city').prop('required', 'required');
	$billingCityField.find('.ur-label').append('<abbr class="required" title="required"> *</abbr>');

	var $billingPostalCodeField = $('#billing_postal_code_field').addClass('validate-required');
	$billingPostalCodeField.find('#billing_postal_code').prop('required', 'required');
	$billingPostalCodeField.find('.ur-label').append('<abbr class="required" title="required"> *</abbr>');

	$(document).on('click', '.ur-submit-button', function () {
		if ( !billingSameAsShipping ) {
						
		}
	})

	var billingSameAsShipping = true;
	$('#billing_option').change( function() {
		if ($(this).is(':checked')) {
			$('.billing-wrapper').removeClass('open').addClass('collapsed').hide(500);
			billingSameAsShipping = true;
		} else {
			$('.billing-wrapper').removeClass('collapsed').addClass('open').show(500);
			billingSameAsShipping = false;
		}
	})

	$('#country_code').change( function() {
		alert('select change');
		if ($(this).prop('selectedIndex') == 2) {
			$('#phone_number').attr("placeholder", "e.g. +421947050523");
		} else {
			$('#phone_number').attr("placeholder", "e.g. 947050523");
		}
	})

	$(window).on('load',function() {

		var $countryCode = $('.field-country_code');
		var $phoneNumber = $('.field-phone_number').detach();

		var $formRow = $countryCode.closest('.ur-form-row');

		$countryCode = $countryCode.detach();
		$formRow.remove();

		var $emptyGrid = $('.field-user_email').parent().siblings('.ur-grid-1').addClass('phone-number-wrapper');

		$emptyGrid.append($countryCode).append($phoneNumber);
	});
*/


	var page = new RegistrationPage( $('.register-page') );  
})