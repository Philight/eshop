jQuery(document).ready(function($) {
	jQuery('.ewd-uwcf-main-dashboard-review-ask').css('display', 'block');

	jQuery('.ewd-uwcf-main-dashboard-review-ask .notice-dismiss').on('click', function(event) {
		var data = 'Ask_Review_Date=7&action=ewd_uwcf_hide_review_ask';
		jQuery.post(ajaxurl, data, function() {});
	});

	jQuery('.ewd-uwcf-review-ask-yes').on('click', function() {
		jQuery('.ewd-uwcf-review-ask-feedback-text').removeClass('uwcf-hidden');
		jQuery('.ewd-uwcf-review-ask-starting-text').addClass('uwcf-hidden');

		jQuery('.ewd-uwcf-review-ask-no-thanks').removeClass('uwcf-hidden');
		jQuery('.ewd-uwcf-review-ask-review').removeClass('uwcf-hidden');

		jQuery('.ewd-uwcf-review-ask-not-really').addClass('uwcf-hidden');
		jQuery('.ewd-uwcf-review-ask-yes').addClass('uwcf-hidden');

		var data = 'Ask_Review_Date=7&action=ewd_uwcf_hide_review_ask';
        jQuery.post(ajaxurl, data, function() {});
	});

	jQuery('.ewd-uwcf-review-ask-not-really').on('click', function() {
		jQuery('.ewd-uwcf-review-ask-review-text').removeClass('uwcf-hidden');
		jQuery('.ewd-uwcf-review-ask-starting-text').addClass('uwcf-hidden');

		jQuery('.ewd-uwcf-review-ask-feedback-form').removeClass('uwcf-hidden');
		jQuery('.ewd-uwcf-review-ask-actions').addClass('uwcf-hidden');

		var data = 'Ask_Review_Date=1000&action=ewd_uwcf_hide_review_ask';
        jQuery.post(ajaxurl, data, function() {});
	});

	jQuery('.ewd-uwcf-review-ask-no-thanks').on('click', function() {
		var data = 'Ask_Review_Date=1000&action=ewd_uwcf_hide_review_ask';
        jQuery.post(ajaxurl, data, function() {});

        jQuery('.ewd-uwcf-main-dashboard-review-ask').css('display', 'none');
	});

	jQuery('.ewd-uwcf-review-ask-review').on('click', function() {
		jQuery('.ewd-uwcf-review-ask-feedback-text').addClass('uwcf-hidden');
		jQuery('.ewd-uwcf-review-ask-thank-you-text').removeClass('uwcf-hidden');

		var data = 'Ask_Review_Date=1000&action=ewd_uwcf_hide_review_ask';
        jQuery.post(ajaxurl, data, function() {});
	});

	jQuery('.ewd-uwcf-review-ask-send-feedback').on('click', function() {
		var Feedback = jQuery('.ewd-uwcf-review-ask-feedback-explanation textarea').val();
		var EmailAddress = jQuery('.ewd-uwcf-review-ask-feedback-explanation input[name="feedback_email_address"]').val();
		var data = 'Feedback=' + Feedback + '&EmailAddress=' + EmailAddress + '&action=ewd_uwcf_send_feedback';
        jQuery.post(ajaxurl, data, function() {});

        var data = 'Ask_Review_Date=1000&action=ewd_uwcf_hide_review_ask';
        jQuery.post(ajaxurl, data, function() {});

        jQuery('.ewd-uwcf-review-ask-feedback-form').addClass('uwcf-hidden');
        jQuery('.ewd-uwcf-review-ask-review-text').addClass('uwcf-hidden');
        jQuery('.ewd-uwcf-review-ask-thank-you-text').removeClass('uwcf-hidden');
	});
});