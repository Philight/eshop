/*check for button show*/
jQuery('input[class^="button"]').click(function () {
	"use strict";
	var jQuerythis = jQuery(this);
	if (jQuerythis.is(".button1")) {
		if (jQuery(this).prop("checked") === true) {
			jQuery(".button2").prop({ disabled: false, checked: true });
			jQuery(".button3").prop({ disabled: false, checked: true });
		}
		else if (jQuery(this).prop("checked") === false) {
			jQuery(".button2").prop({ disabled: false, checked: false });
			jQuery(".button3").prop({ disabled: false, checked: false });
		}
	} else if (jQuerythis.is(".button2") || jQuerythis.is(".button3")) {

		if (jQuery('#wcatcbll_add2_cart').prop("checked") === true && jQuery('#wcatcbll_custom').prop("checked") === true) {

			jQuery(".button1").prop({ disabled: false, checked: true });

		} else if (jQuery('#wcatcbll_add2_cart').prop("checked") === false && jQuery('#wcatcbll_custom').prop("checked") === false) {

			jQuery(".button1").prop({ disabled: false, checked: false });

		} else {
			jQuery(".button1").prop({ disabled: false, checked: false });
		}
	}
});

/*Check for global setting*/
jQuery('input[class^="class"]').click(function () {
	"use strict";
	var jQuerythis = jQuery(this);
	if (jQuerythis.is(".class1")) {
		if (jQuery(this).prop("checked") === true) {
			jQuery(".class2").prop({ disabled: false, checked: true });
			jQuery(".class3").prop({ disabled: false, checked: true });
		}
		else if (jQuery(this).prop("checked") === false) {
			jQuery(".class2").prop({ disabled: false, checked: false });
			jQuery(".class3").prop({ disabled: false, checked: false });
		}
	} else if (jQuerythis.is(".class2") || jQuerythis.is(".class3")) {

		if (jQuery('#wcatcbll_cart_shop').prop("checked") === true && jQuery('#wcatcbll_cart_single_product').prop("checked") === true) {

			jQuery(".class1").prop({ disabled: false, checked: true });

		} else if (jQuery('#wcatcbll_cart_shop').prop("checked") === false && jQuery('#wcatcbll_cart_single_product').prop("checked") === false) {

			jQuery(".class1").prop({ disabled: false, checked: false });

		} else {
			jQuery(".class1").prop({ disabled: false, checked: false });
		}
	}
});

//change instant button style
jQuery(document).ready(function () {
	'use strict';

	jQuery('.catcbll_fdtype').attr('checked', false);

	// Review
	jQuery('.catcbll_fdtypes').click(function (e) {
		var radio = jQuery(this).val();
		jQuery('#catcbll_form_type').val(radio);
		if (radio == 'suggestions') {
			// Hide other options
			jQuery('#catcbll_fdtype_1, #catcbll_fdtype_3').closest('li').hide();
			// change placeholder message
			jQuery('.catcbll_fdback_form').find('.catcbll-feedback-message').attr('placeholder', 'Leave plugin developers any feedback here');
			// Show feedback form
			jQuery('.catcbll_fdback_form').fadeIn();
			jQuery('#catcbll-feedback-message,#catcbll-feedback-email').removeAttr('style');
			jQuery('.export_error').remove();
		}
		else if (radio == 'help-needed') {
			// Hide other options
			jQuery('#catcbll_fdtype_1, #catcbll_fdtype_2').closest('li').hide();
			// change placeholder message
			jQuery('.catcbll_fdback_form').find('.catcbll-feedback-message').attr('placeholder', 'Leave plugin developers any feedback here');
			// Show feedback form
			jQuery('.catcbll_fdback_form').fadeIn();
			jQuery('#catcbll-feedback-message,#catcbll-feedback-email').removeAttr('style');
			jQuery('.export_error').remove();
		}
		else if (radio == 'review') {
			var rev_url = jQuery('#catcbll_fdtype_lnk1').attr("href");
			//window.location.href = rev_url;
			window.open(rev_url, '_blank');
		}
	});

	jQuery('#catcbll_fdb_terms').click(function () {
		if (jQuery(this).prop("checked") == true) {
			jQuery('.export_error').remove();
		}
	});


	jQuery("#wcatcbll_sprt_form #catcbll-feedback-email,#wcatcbll_sprt_form #catcbll-feedback-message").keyup(function () {
		jQuery('.email_response_pass').remove();
		if (jQuery(this).val().length === 0) {
			jQuery(this).css('border-left', '3px solid red');
			return false;
		} else {
			jQuery(this).css('border-left', '3px solid green');
			return true;
		}
	});

	jQuery(document).on('submit', '#wcatcbll_sprt_form', function (e) {
		e.preventDefault();
		var wccb_fdbk_email = jQuery.trim(jQuery('#catcbll-feedback-email').val());
		var wccb_fdbk_msg = jQuery.trim(jQuery('#catcbll-feedback-message').val());

		if (jQuery('#catcbll_fdb_terms').is(':checked') == true && wccb_fdbk_email.length > 1 && wccb_fdbk_msg.length > 1) {

			jQuery('.export_error').remove();
			jQuery('#catcbll_sms_loading').show();
			jQuery('#catcbll-feedback-email,#catcbll-feedback-message').css('border-left', '3px solid green');
			var form_type = jQuery('#catcbll_form_type').val();
			var fdbk_trm = jQuery('#catcbll_fdb_terms').val();
			var security_nonce = catcbll_vars.ajax_public_nonce;
			jQuery.ajax({
				url: catcbll_vars.ajaxurl,
				method: "POST",
				data: { form_type: form_type, fdbk_email: wccb_fdbk_email, fdbk_msg: wccb_fdbk_msg, fdbk_trm: fdbk_trm, btn_action: 'catcbll_send_email', action: 'catcbll_send_email_help',security_nonce:security_nonce }, //form_data,
				success: function (data) {
					if (!data) {
						jQuery('#catcbll_sms_loading').hide();
						jQuery('.email_response_fail').remove();
						jQuery('.catcbll_sbmt_buttons').after('<div class="mt-2"><p class="email_response_fail">Failed to send an e-mail. Please contact us directly on hirewebxperts.com.</p></div>');
					} else {
						jQuery('#catcbll_sms_loading').hide();
						jQuery('.email_response_pass').remove();
						jQuery('.email_response_fail').remove();
						jQuery('#catcbll-feedback-email,#catcbll-feedback-message').val('');
						jQuery('#catcbll_fdb_terms').prop("checked", false);
						jQuery('#catcbll-feedback-message,#catcbll-feedback-email').css('border-left', '3px solid red');
						jQuery('#catcbll-feedback-message,#catcbll-feedback-email').removeAttr('style');
						jQuery('.catcbll_sbmt_buttons').after('<div class="mt-2"><p class="email_response_pass">Email sent successfully.</p></div>');
					}
				},
			});
			return false;
		}
		else {
			jQuery('.export_error').remove();
			if (wccb_fdbk_email.length == 0) {
				jQuery('#catcbll-feedback-email').css('border-left', '3px solid red');
			} if (wccb_fdbk_msg.length == 0) {
				jQuery('#catcbll-feedback-message').css('border-left', '3px solid red');
			}
			jQuery('.catcbll_fdb_terms_s').after('<div class="export_error"><p>Please fill all field properly.</p></div>');
			return false;
		}
	});

	// Cancel feedback form
	jQuery('#catcbll_fd_cancel').click(function (e) {
		e.preventDefault();
		jQuery('.catcbll_fdback_form').fadeOut(function () {
			jQuery('.catcbll_fdtypes').attr('checked', false).closest('li').show();
		});
		jQuery('.email_response_fail').remove();
		jQuery('.email_response_pass').remove();
		jQuery("#wcatcbll_sprt_form")[0].reset();
	});
	//end support form

	
	/* On page load add button css */
	var btn_fsize = jQuery('#catcbll_btn_fsize').val();
	var btn_brd_size = jQuery('#catcbll_border_size').val();
	var btn_brdr_rds = jQuery('#catcbll_btn_radius').val();
	jQuery("#btn_prvw").css({"font-size": btn_fsize,"border": btn_brd_size+"px solid","border-radius":btn_brdr_rds,});
	/* Save option data using ajax */
	jQuery('#submit_settings').click(function(e){
		jQuery("#wcbnl_overlay").fadeIn(300);　
		//jQuery("#wcbnl_overlay").fadeIn(300);　
		e.preventDefault();
		var security_nonce = catcbll_vars.ajax_public_nonce;
		var form = jQuery("#wcatbltn_option_save").serialize(); // this will resolve to the form submitted		
		  jQuery.ajax({
			type:"POST",
			global: false,
			dataType: "json",		
            url:catcbll_vars.ajaxurl,
            data:{form_data:form,security_nonce:security_nonce,action:'catcbll_save_option'},//only input
            success: function(response){
				if(response){
					/* Swal.fire({
						position: 'center',
						icon: 'success',
						title: 'Your work has been saved',
						showConfirmButton: false,
						timer: 3000
					}); */
				}
            }
		}).done(function() {
			setTimeout(function(){
				jQuery("#wcbnl_overlay").fadeOut(300);
			},500);
		});	
	});

	//use for select button 2dTransitions
	jQuery("#wcatcbll_btn_2Dhvr").change(function () {
		var btn_2danmtn = jQuery(this).children('option:selected').val();
		var hdn_cls_pre = jQuery('#hide_2d_trans').val();
		jQuery("#btn_prvw").removeClass(hdn_cls_pre).addClass(btn_2danmtn);
		jQuery('#hide_2d_trans').val(btn_2danmtn);

	});
	//use for select button bg Transitions
	jQuery("#wcatcbll_btn_bghvr").change(function () {
		var brdr_radius_all = jQuery('#brdr_rds').html();
		var btn_hvrclr = jQuery('#catcbll_btn_hvrclr').val();
		var btn_bghvr = jQuery(this).children('option:selected').val();
		var hdn_cls_pre = jQuery('#hide_btn_bghvr').val();
		var btn_brdr_size= jQuery('#ccbtn_border_size').html();
		var btn_brdrclr = jQuery('#catcbll_btn_border_clr').val();
	if(btn_brdrclr){var font_clr = '#fff';}else{var font_clr = '#000';}
	if(hdn_cls_pre){
		jQuery( "#btn_prvw" ).find( "style" ).remove();
		jQuery('.btn_preview_div style').remove();
		jQuery('<style>.' + btn_bghvr + ':before{border-radius:' + brdr_radius_all + '!important;background:' + btn_hvrclr + '!important} .wccbtn{border:'+btn_brdr_size +' solid #000;background:#fff;}</style>').insertBefore('#btn_prvw');
	}else{
		jQuery( "#btn_prvw" ).find( "style" ).remove();
		jQuery( "#btn_prvw" ).append( jQuery( "<style>.wccbtn:hover{background:"+btn_hvrclr+"!important;color:"+font_clr+" !important;border:"+btn_brdr_size +" solid "+btn_brdrclr+";}</style>" ) );
	}
		jQuery("#btn_prvw").removeClass(hdn_cls_pre).addClass(btn_bghvr);
		jQuery('#hide_btn_bghvr').val(btn_bghvr);
		

	});
	//use for select button radius
	jQuery("#wcatcll_font_icon").change(function () {
		var btn_icon = jQuery(this).children('option:selected').val();
		var btn_iconpsn = jQuery('#wcatcbll_btn_icon_psn').children('option:selected').val();
		if (btn_iconpsn === 'right') {
			jQuery("#btn_prvw").html('Add to Cart <i class="fa ' + btn_icon + '"></i>');
		}
		else {
			jQuery("#btn_prvw").html('<i class="fa ' + btn_icon + '"></i> Add to Cart');
		}

	});
	//use for select button radius
	jQuery("#wcatcbll_btn_icon_psn").change(function () {
		var btn_iconpsn = jQuery(this).children('option:selected').val();
		var btn_icon = jQuery('#wcatcll_font_icon').children('option:selected').val();
		if (btn_iconpsn === 'right') {
			jQuery("#btn_prvw").html('Add to Cart <i class="fa ' + btn_icon + '"></i>');
		}
		else {
			jQuery("#btn_prvw").html('<i class="fa ' + btn_icon + '"></i> Add to Cart');
		}

	});
	//use for button padding
	jQuery(".btnpd_st input[type=number]").change(function () {
		var btn_p = jQuery(this).attr('class');
		
		var btn_pval = jQuery(this).val();
		jQuery(this).attr('value',btn_pval);
		if( btn_p == 'btn_pv' ){
			 jQuery("#btn_prvw").css({"padding-top": btn_pval +'px',"padding-bottom": btn_pval +'px'} );
		 }
		 else if( btn_p == 'btn_ph' ){
 			 jQuery("#btn_prvw").css({"padding-left": btn_pval +'px',"padding-right": btn_pval +'px'}  );
 		 }
	});

});
jQuery( document ).ready( function(jQuery ) {
	var btn_brdr_size= jQuery('#ccbtn_border_size').html();
	var brdr_radius_all = jQuery('#brdr_rds').html();
	var bg_clr = jQuery('#catcbll_btn_bg').val();
	jQuery('#btn_prvw').css("background", bg_clr);
	var btn_fclr = jQuery('#catcbll_btn_fclr').val();
	jQuery('#btn_prvw').css("color", btn_fclr);
	var btn_hvrclr = jQuery('#catcbll_btn_hvrclr').val();
	var btn_brdrclr = jQuery('#catcbll_btn_border_clr').val();
	
	var bg_transition = jQuery('#hide_btn_bghvr').val();
	if(btn_brdrclr){var font_clr = '#fff';}else{var font_clr = '#000';}
	if(bg_transition){
		jQuery( "#btn_prvw" ).find( "style" ).remove();
		jQuery('.btn_preview_div style').remove();
		jQuery('<style>.' + bg_transition + ':before{border-radius:' + brdr_radius_all + '!important;background:' + btn_hvrclr + '!important} .wccbtn{border:'+btn_brdr_size +' solid #000;background:#fff;}</style>').insertBefore('#btn_prvw');
	}else{
		jQuery( "#btn_prvw" ).find( "style" ).remove();
		jQuery( "#btn_prvw" ).append( jQuery( "<style>.wccbtn:hover{background:"+btn_hvrclr+"!important;color:"+font_clr+" !important;border:"+btn_brdr_size +" solid "+btn_brdrclr+";}</style>" ) );
	}
	
	jQuery( '.color-picker' ).wpColorPicker({
		change: function (event, ui) {
			/* Button styling */
			var ranger_color = ui.color.toString();	
			/*Check selected color picker id*/
			if(event.target.id == 'catcbll_btn_bg'){
				jQuery('#btn_prvw').css("background", ranger_color);	
			}else if(event.target.id == 'catcbll_btn_fclr'){
				jQuery('#btn_prvw').css("color", ranger_color);
			}else if(event.target.id == 'catcbll_btn_border_clr'){
				jQuery('#btn_prvw').css("border-color", ranger_color);
			}else if((event.target.id == 'catcbll_btn_hvrclr')){
				var bg_transition = jQuery('#hide_btn_bghvr').val();
				if(ranger_color){var font_clr = '#fff';}else{var font_clr = '#000';}
				if(bg_transition){
					jQuery( "#btn_prvw" ).find( "style" ).remove();
					jQuery('.btn_preview_div style').remove();
					jQuery('<style>.' + bg_transition + ':before{border-radius:' + brdr_radius_all + '!important;background:' + ranger_color + '!important} .wccbtn{border:'+btn_brdr_size +' solid #000;background:#fff;}</style>').insertBefore('#btn_prvw');
				}else{
					jQuery( "#btn_prvw" ).find( "style" ).remove();
					jQuery( "#btn_prvw" ).append( jQuery( "<style>.wccbtn:hover{background:"+ranger_color+"!important;color:"+font_clr+" !important;border:"+btn_brdr_size +" solid "+ranger_color+";}</style>" ) );
				}

			}
		},
		 clear: function (event) {
			//var element = jQuery(event.target).siblings('.wp-color-picker')[0];
			 	var element = jQuery(event.target);
			var id = element[0].previousSibling.lastChild.id;
			var btn_brdr_size= jQuery('#ccbtn_border_size').html();
				var brdr_radius_all = jQuery('#brdr_rds').html();
				jQuery('.wp-color-result').removeAttr( 'style' );
				/*Check selected color picker id*/
				if(id == 'catcbll_btn_bg'){
					jQuery('#btn_prvw').css("background", '');	
				}else if(id == 'catcbll_btn_fclr'){
					jQuery('#btn_prvw').css("color", "");
				}else if(id == 'catcbll_btn_border_clr'){
					jQuery('#btn_prvw').css("border-color", "");
				}else if((id == 'catcbll_btn_hvrclr')){
					var bg_transition = jQuery('#hide_btn_bghvr').val();
					if(bg_transition){
						jQuery( "#btn_prvw" ).find( "style" ).remove();
						jQuery('.btn_prvw style').remove();
						jQuery('<style>.' + bg_transition + ':before{border-radius:' + brdr_radius_all + '!important;background:' + "" + '!important} .wccbtn{border:'+btn_brdr_size +' solid #000;background:#fff;}</style>').insertBefore('#btn_prvw');
					}else{
						jQuery( "#btn_prvw" ).find( "style" ).remove();
						jQuery( "#btn_prvw" ).append( jQuery( "<style>.wccbtn:hover{background:"+""+";color:#fff !important}</style>" ) );
					}
					 
				}
		}
	});
} );
