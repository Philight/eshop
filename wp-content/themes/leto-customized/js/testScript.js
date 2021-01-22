( function( $ ) {
	$(window).load(function() {
		//alert('loaded');
/*
		console.log($('.xoo-wsc-modal'));
		setTimeout(function() {
			console.log('delay 5s');
			console.log($('.xoo-wsc-modal'));
		}, 5000);
*/
		var selectedElem = $('.xoo-wsc-products [data-key="d8edb955470ec5310a990ef002bd6bc5"] .variations_form');

		$.fn.rtWpvsVariationSwatchesForm2 = function () {
			//alert('Form init');
			//.on('change', '.xoo-wsc-products [data-key="d8edb955470ec5310a990ef002bd6bc5"] input[type="number"]')
			;
			this._variation_form = $(this);
/*
			this._wsc_modal = $(this)
			this._wsc_modal.on( 'click', this._variation_form+' .rtwpvs-terms-wrapper', function () {
				alert('wrapper click');

				var attribute = $(this);
				attribute.css('background-color', 'olive');
			});
*/
/*
			this._wsc_modal.find('.variations_form .rtwpvs-terms-wrapper').on( 'click', function () {
				alert('wrapper click');
			});
*/
/*
			this._wsc_modal.find('.rtwpvs-terms-wrapper').each(function () {
				alert('wrapper found');
				var attribute = $(this);
				attribute.css('background-color', 'olive');
				attribute.on( 'click', function() {
					alert('wrapper click');
				});
			})
*/
/*
			this._variation_form.on( 'click', function () {
				alert('form click');
			});

			this._variation_form.on( 'click', '.rtwpvs-terms-wrapper', function () {
				alert('wrapper click');
			});
*/

/*
			this._variation_form.find('.rtwpvs-terms-wrapper').each(function () {
				alert('wrapper found');

				var attribute = $(this);
				attribute.on( 'click', function() {
					alert('wrapper click');
				});
			})
*/			
		}

		if (selectedElem.length) {
			//alert('found');
			$(".variations_form").css("background-color", "green"); 
			//console.log($('.xoo-wsc-products [data-key="a5bfc9e07964f8dddeb95fc584cd965d"]'));
			//console.log($('.xoo-wsc-products [data-key="d8edb955470ec5310a990ef002bd6bc5"] input[type="number"]'));

			$(document).on('change', '.xoo-wsc-products input[type="number"]', function() {
				alert("input change");
				console.log("VALUE: "+$(this).val());
			})
/*
			$(document).on('click', '.variations_form .rtwpvs-terms-wrapper', function() {
				alert("wrapper click");
			});
*/
			//let timerID = setInterval(() => alert('tick'), 2000);


		}

		$(".variations_form").css("background-color", "green");
		

		var toggledBasket = false;
		$(document).on('click', '.xoo-wsc-basket', function() {
			if (true) {};

			$( this ).addClass('testing-class');

			$(".xoo-wsc-header").css("background-color", "red");
			//$(".variations_form").css("background-color", "red");

			setTimeout(function() { 
				$(".xoo-wsc-header").addClass('testing-class');       
		    }, 5000);

		})

	$('#page').on('wc_variation_form', '.variations_form', function () {
	    $(this).rtWpvsVariationSwatchesForm2();
	  }); // Support for Jetpack's Infinite Scroll,

	$('.xoo-wsc-modal').on('wc_variation_form', function () {
	  	//var todd = this;
	  	//setTimeout(function() {
	  		//$(todd).rtWpvsVariationSwatchesForm();
	  	//}, 4000);
	    $(this).rtWpvsVariationSwatchesForm2();
	  }); // Support for Jetpack's Infinite Scroll,


	})
})(jQuery);