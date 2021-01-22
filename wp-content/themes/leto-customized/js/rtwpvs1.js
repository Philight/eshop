/*   
 * Overriden plugin original script
 * plugins/woo-product-variation-swatches/assets/js/rtwpvs.min.js
 */
(function ($) {
  'use strict';

  $.fn.rtWpvsVariationSwatchesForm = function (location, eventListener) {
  	this._variation_form = $(this);

    if (location === 'sidecart') {
      this._eventListener = $('.xoo-wsc-modal');
    } else {
      this._eventListener = $(this);
    }

    this.product_variations = this._variation_form.data('product_variations');
    this._is_ajax = !!this.product_variations;
    this._is_mobile = $('body').hasClass('rtwpvs-is-mobile');


    this.start = function () {
      var that = this;

  //    this._variation_form.find('.rtwpvs-terms-wrapper').each(function () {
  //      var attribute = $(this);
  //          wc_select = attribute.parent().find('select.rtwpvs-wc-select');

        that._eventListener.on('touchstart click', '.rtwpvs-term:not(.rtwpvs-radio-term)', function (e) {
        //attribute.on('touchstart click', '.rtwpvs-term:not(.rtwpvs-radio-term)', function (e) {
          
          e.preventDefault();
          e.stopPropagation();
        
/*    alert('term click');
    console.log('term clicked:');
    console.log(this);
*/
          var self = $(this),
              is_selected = self.hasClass('selected'),
              term = self.data('term');

          if (is_selected && rtwpvs_params.reselect_clear) {
            term = '';
            console.log('selected');
          }
//      console.log(self.parent().siblings('select.rtwpvs-wc-select'));
          var wc_select = self.parent().siblings('select.rtwpvs-wc-select');
//      console.log('before select triggered');  
          wc_select.val(term).trigger('change').trigger('click').trigger('focusin');
//      console.log('wc_select triggered');
          if (that._is_mobile) {
            wc_select.trigger('touchstart');
          }

          self.trigger('focus');
/*
          if (is_selected) {
            self.trigger('rtwpvs-unselected-term', [term, wc_select, this._variation_form]);
          } else {
            self.trigger('rtwpvs-selected-term', [term, wc_select, this._variation_form]);
          }
          */
        }); // Radio attributes trigger
/*
        that._variation_form.on('change', 'input.rtwpvs-radio-button-term:radio', function (e) {
        //attribute.on('change', 'input.rtwpvs-radio-button-term:radio', function (e) {
          e.preventDefault();
          e.stopPropagation();
          var radioTerm = $(this),
              term = radioTerm.val(),
              termWrapper = radioTerm.parent('.rtwpvs-term.rtwpvs-radio-term'),
              is_selected = termWrapper.hasClass('selected');

          if (is_selected && rtwpvs_params.reselect_clear) {
            term = '';
          }

          wc_select.val(term).trigger('change').trigger('click').trigger('focusin');

          if (that._is_mobile) {
            wc_select.trigger('touchstart');
          }

          if (rtwpvs_params.reselect_clear) {
            if (is_selected) {
              _.delay(function () {
                radioTerm.prop('checked', false);
                termWrapper.trigger('rtwpvs-unselected-term', [term, wc_select, this._variation_form]);
              }, 1);
            } else {
              termWrapper.trigger('rtwpvs-selected-term', [term, wc_select, this._variation_form]);
            }
          } else {
            if (!rtwpvs_params.reselect_clear) {
              radioTerm.parent('.rtwpvs-term.rtwpvs-radio-term').removeClass('selected disabled').addClass('selected').trigger('rtwpvs-selected-term', [term, wc_select, this._variation_form]);
            }
          }
        });
*/

/*
        if (rtwpvs_params.reselect_clear) {
          // Radio attributes
          attribute.on('touchstart click', 'input.rtwpvs-radio-button-term:radio', function (e) {
            e.preventDefault();
            e.stopPropagation();
            $(this).trigger('change');
          });
        } */
//      });

      setTimeout(function () {
        that._eventListener.trigger('reload_product_variations');

        that._eventListener.trigger('rtwpvs_loaded', [that]);
      }, 1);
    };

    this.update_trigger = function () {
      this._eventListener.on('rtwpvs_loaded', {
        that: this
      }, this.loaded_triggered); // will trigger


      this._eventListener.on('woocommerce_update_variation_values', this.update_variation_triggered); // Will first run


      this._eventListener.on('reset_data', {
        that: this
      }, this.reset_triggered); // will trigger after woocommerce_update_variation_values


      this._eventListener.on('woocommerce_variation_has_changed', {
        that: this
      }, this.variation_has_changed_triggered); // Will run after reset_data

    };

    this.update_variation_triggered = function (e) {
      //alert('WOOCOMMERCE_UPDATE_VARIATION_VALUES');
      console.log('WOOCOMMERCE_UPDATE_VARIATION_VALUES');
      console.log($(this));
      $(this).find('.rtwpvs-terms-wrapper').each(function () {
        var attribute = $(this),
            wc_select = attribute.parent().find('select.rtwpvs-wc-select'),
            selected = wc_select.find('option:selected').val() || '',
            current = wc_select.find('option:selected'),
            itemIndex = wc_select.find('option').eq(1),
            wc_terms = [];
        wc_select.find('option').each(function () {
          if ($(this).val() !== '') {
            wc_terms.push($(this).val());
            selected = current ? current.val() : itemIndex.val();
          }
        });
        setTimeout(function () {
          attribute.find('.rtwpvs-term').each(function () {
            var item = $(this),
                term = item.attr('data-term');
            item.removeClass('selected disabled').addClass('disabled');

            if (wc_terms.indexOf(term) !== -1) {
              item.removeClass('disabled').find('input.rtwpvs-radio-button-term:radio').prop('disabled', false);

              if (term === selected) {
                item.addClass('selected').find('input.rtwpvs-radio-button-term:radio').prop('checked', true);
              }
            } else {
              item.find('input.rtwpvs-radio-button-term:radio').prop('disabled', true).prop('checked', false);
            }

            if (term === selected) {
              item.addClass('selected').find('input.rtwpvs-radio-button-term:radio').prop('disabled', false).prop('checked', true);
            }
          });
          attribute.trigger('rtwpvs-terms-updated');
        }, 1);
      });
    };

    this.variation_has_changed_triggered = function (e) {
      alert('WOOCOMMERCE_VARIATION_HAS_CHANGED');
      console.log('WOOCOMMERCE_VARIATION_HAS_CHANGED');
      var that = e.data.that;

      if (!that._is_ajax) {
        $(this).find('.rtwpvs-terms-wrapper').each(function () {
          var attribute = $(this),
              wc_select = attribute.parent().find('select.rtwpvs-wc-select'),
              selected = wc_select.find('option:selected').val() || '',
              current = wc_select.find('option:selected'),
              itemIndex = wc_select.find('option').eq(1),
              wc_terms = [];
          wc_select.find('option').each(function () {
            if ($(this).val() !== '') {
              wc_terms.push($(this).val());
              selected = current ? current.val() : itemIndex.val();
            }
          });
          setTimeout(function () {
            attribute.find('.rtwpvs-term').each(function () {
              var item = $(this),
                  term = item.attr('data-term');
              item.removeClass('selected disabled');

              if (term === selected) {
                item.addClass('selected').find('input.rtwpvs-radio-button-term:radio').prop('disabled', false).prop('checked', true);
              }
            });
            attribute.trigger('rtwpvs-terms-updated');
          }, 1);
        });
      }
    };

    this.reset_triggered = function (e) {
      console.log('RESET_TRIGGERED');
      if (e.data.that._is_ajax) {
        $(this).find('.rtwpvs-terms-wrapper').each(function () {
          var attribute = $(this);
          attribute.find('.rtwpvs-term').removeClass('selected disabled').find('input.rtwpvs-radio-button-term:radio').prop('disabled', false).prop('checked', false);
        });
      }
    };

    this.loaded_triggered = function (e) {
//      alert('RTWPVS_LOADED / LOADED_TRIGGERED');
      console.log('RTWPVS_LOADED / LOADED_TRIGGERED');
      var that = e.data.that;
      console.log(that);
      console.log(that.product_variations);

      if (that._is_ajax) {
        var attributes = {};
        that.product_variations.map(function (variation) {
          Object.keys(variation.attributes).map(function (attribute) {
            if (!attributes[attribute]) {
              attributes[attribute] = [];
            }

            //console.log(attributes);

            //console.log('About to push: '+variation.attributes[attribute]+', arr: '+attributes[attribute]);
            if (variation.attributes[attribute] && attributes[attribute].indexOf(variation.attributes[attribute]) === -1) {
              attributes[attribute].push(variation.attributes[attribute]);
            }
          });
        });

//      $(e.target).find('.rtwpvs-terms-wrapper').each(function () {
        $(that._variation_form).find('.rtwpvs-terms-wrapper').each(function () {
          var attribute_name = $(this).data('attribute_name');
          $(this).find('.rtwpvs-term').each(function () {
            var self = $(this),
                term = self.attr('data-term');

            if (!$.isEmptyObject(attributes) && attributes[attribute_name].indexOf(term) === -1) {
              self.removeClass('selected').addClass('disabled').find('input.rtwpvs-radio-button-term:radio').prop('disabled', true).prop('checked', false);
            }
          });
        });
      }
    };

    this.start();
    this.update_trigger();
    //return this;
  };

    $(document).on('wc_variation_form', '.variations_form', function () {
	  //$('#page').on('wc_variation_form', '.variations_form', function () {
//console.log('WC_VARIATION_FORM trigger');
//console.log(this);
//console.log($(this));
	    $(this).rtWpvsVariationSwatchesForm('default', '');
	  }); // Support for Jetpack's Infinite Scroll,

/*
	  $('.xoo-wsc-modal').on('wc_variation_form', '.variations_form', function () {
	    $(this).rtWpvsVariationSwatchesForm('sidecart', $('.xoo-wsc-modal'));
	  }); // Support for Jetpack's Infinite Scroll,
*/

  $(document.body).on('post-load', function () {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // Support for Yith Infinite Scroll

  $(document).on('yith_infs_added_elem', function () {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // Support for Yith Ajax Filter

  $(document).on('yith-wcan-ajax-filtered', function () {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // Support for Woodmart theme

  $(document).on('wood-images-loaded', function () {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // Support for berocket ajax filters

  $(document).on('berocket_ajax_products_loaded', function () {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // Flatsome Infinite Scroll Support

  $('.shop-container .products').on('append.infiniteScroll', function (event, response, path) {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // FacetWP Load More

  $(document).on('facetwp-loaded', function () {
    $('.variations_form').each(function () {
      $(this).wc_variation_form();
    });
  }); // WooCommerce Filter Nav

  $('body').on('aln_reloaded', function () {
    setTimeout(function () {
      $('.variations_form').each(function () {
        $(this).wc_variation_form();
      });
    }, 100);
  });

})(jQuery);
