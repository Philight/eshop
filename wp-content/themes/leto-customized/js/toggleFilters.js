

jQuery(document).ready( function ( $ ) {
//	alert('filters toggle load');

	var selectedFilters = {};
	var isMobile = ($(window).width() < 1024) ? true : false;

	addToSelected = function($inputFilter) {
		var filterId = '';
		if ( $inputFilter.attr('type') == 'checkbox' ) {
			filterId = $inputFilter.attr('id');

		} else if ( $inputFilter.closest('.bapf_sfilter').hasClass('bapf_slidr') ) {
			filterId = $inputFilter.closest('.bapf_sfilter').attr('id');
		}

		selectedFilters[filterId] = true;
	}

	removeFromSelected = function($inputFilter) {
		var filterId = '';
		if ( $inputFilter.attr('type') == 'checkbox' ) {
			filterId = $inputFilter.attr('id');

		} else if ( $inputFilter.closest('.bapf_sfilter').hasClass('bapf_slidr') ) {
			filterId = $inputFilter.closest('.bapf_sfilter').attr('id');
		}

		delete selectedFilters[filterId];
	}

	isDefaultValue = function($inputFilter, mode) {
//		console.log('selectedFilters func');
//		console.log($inputFilter);

		if ( $inputFilter.closest(".bapf_slidr_all").length ) {
//			alert('is Slider');
			var minVal = $inputFilter.data('min');
			var maxVal = $inputFilter.data('max');

			if ( $inputFilter.val() ) {
				if ( minVal != $inputFilter.val().split(';')[0]
					|| maxVal != $inputFilter.val().split(';')[1] )	{
					return false;
				}

			} else {
				if ( minVal != $inputFilter.data('start') 
					|| maxVal != $inputFilter.data('end') ) {
					return false;
				}
			} 

		} else if ( $inputFilter.attr('type') == 'checkbox' ) {
//			alert('is checkbox');
			if ($inputFilter.is(':checked')) {
				return false;
			}
		}
		return true;
	}

	$('.berocket_single_filter_widget input').each(function() {		
		var isAnythingSelected = !isDefaultValue($(this));
//		alert( 'isAnythingSelected: '+isAnythingSelected );
		if (isAnythingSelected) {
			$('.filters-title').addClass('active-filter');
			return false;
		}
	});

	var $applyFiltersExists = $('.bapf_sfilter .bapf_button.bapf_update');
	if (isMobile) {
//		alert('applyFiltersExists');

		$(document).on('click', '.bapf_sfilter .bapf_button.bapf_update', function() {
			var isAnythingSelected = false;
			$('.berocket_single_filter_widget input').each(function() {

				isAnythingSelected = !isDefaultValue($(this));
				if (isAnythingSelected) {
					return false;
				}
			})
//			alert('isAnythingSelected after update: '+isAnythingSelected);
			isAnythingSelected ? $('.filters-title').addClass('active-filter') 
							   : $('.filters-title').removeClass('active-filter');
		})

	} else {
		//$(document).off('click', '.bapf_sfilter .bapf_button.bapf_update');
//		alert('applyFiltersExists NOT');
		$(document).on('change', '.berocket_single_filter_widget input', function() {
			isDefaultValue($(this)) ? removeFromSelected($(this)) : addToSelected($(this));
			jQuery.isEmptyObject(selectedFilters) ? $('.filters-title').removeClass('active-filter')
												  : $('.filters-title').addClass('active-filter');
		})
	}

	$(document).off('click', '.bapf_ocolaps .bapf_colaps_togl, .bapf_ccolaps .bapf_colaps_togl');
	$(document).on('click', '.filters-container .filters-toggle, .filters-modal, .filter-apply-body .bapf_update', function() {
//		alert('toggle click');
		
		if ($(this).hasClass('.bapf_update')) {
			if (!isMobile) {
				return;
			}
		}

		var $filtersContainer = $('.filters-container');
		if ($filtersContainer.hasClass('collapsed')) {
			$filtersContainer.removeClass('collapsed').addClass('open');
		} else {
			$filtersContainer.removeClass('open').addClass('collapsed');
		}	

		if (isMobile) {
			var $modal = $filtersContainer.siblings('.filters-modal');
			$modal.hasClass('collapsed') ? $modal.removeClass('collapsed').addClass('open')
										 : $modal.removeClass('open').addClass('collapsed');
		}

		$filtersContainer.find('.bapf_body').first().toggle('slow');
	})

	$(document).on('click', '.bapf_reset', function() {
		selectedFilters = {};
		$('.filters-title').removeClass('active-filter');
	})
})