(function( $ ) {
	'use strict';

	// Calendar
  var clndr_calendar_element = $('#tmsm-woocommerce-booking-thalasso-calendar');
  if(clndr_calendar_element.length > 0){
    var clndr_calendar = clndr_calendar_element.clndr({
      template: $('#tmsm-woocommerce-booking-thalasso-calendar-template').html(),

    });

    // Button Start Booking
    $(document).on('click', '.button-booking', function (e) {
      console.log('click button');
      var productid = $(this).data('productid');
      var accommodationid = $(this).data('accommodationid');
      var packageid = $(this).data('packageid');
      var page = $('#tmsm-woocommerce-booking-thalasso-modalform-page').val();
      var post = $('#tmsm-woocommerce-booking-thalasso-modalform-post').val();

      e.preventDefault();
      $('#tmsm-woocommerce-booking-thalasso-modalform').addClass('loading');

      var modal = $(this).attr('href');
      var modalinner = $(modal).find('.omw-modal-inner');
      modalinner.html('Produit choisi: '.productid);

      $.ajax({
        url: tmsm_woocommerce_booking_thalasso_params.ajax_url,
        type: 'post',
        data: {
          action: 'booking_start',
          nonce: tmsm_woocommerce_booking_thalasso_params.security,
          productid: productid,
          accommodationid: accommodationid,
          packageid: packageid,
          page: page,
          post: post,
        },
        success: function (response) {

          var output = '';
          var step = response.step;
          var pages = response.pages;
          var posts = response.posts;
          var bookinghasaccommodation = response.bookinghasaccommodation;


          output += '<form action="" id="tmsm-woocommerce-booking-thalasso-modalform" class="loading">';

          if (typeof step !== undefined) {
            step = (bookinghasaccommodation ? 'accommodation' : 'package');
            output += '<input type="text" id="step" value="' + step + '">';
          }


          if (typeof pages !== undefined) {
            output += '<select id="tmsm-woocommerce-booking-thalasso-modalform-page" class="form-control" name="page">';
            $.each(pages, function (key, value) {
              output += '<option value="' + key + '" ' + (page == key ? ' selected="selected"' : '') + '>' + value + '</option>';
            });
            output += '</select>';
          }

          if (page) {
            output += 'Selected page:' + page;


            if (typeof posts !== undefined) {
              output += '<select id="tmsm-woocommerce-booking-thalasso-modalform-post" class="form-control" name="post">';
              $.each(posts, function (key, value) {
                output += '<option value="' + key + '" ' + (post == key ? ' selected="selected"' : '') + '>' + value + '</option>';
              });
              output += '</select>';
            }
            if (post) {
              output += 'Selected post:' + post;
            }


          }

          output += '<p><a class="button button-booking" data-productid="' + productid + '" data-accommodationid="' + accommodationid + '"  data-packageid="' + packageid + '" id="booking-' + productid + '" href="#omw-2263">' + tmsm_woocommerce_booking_thalasso_params.i18n.button_continue + '</a></p>';


          output += '</form>';

          modalinner.html(output);
          console.log('ajax success');
          console.log(response);

          $('#tmsm-woocommerce-booking-thalasso-modalform').removeClass('loading');
          //bindButtonBooking();
        },
        error: function (response) {
          console.warn('ajax error');
          console.warn('Error retrieving the information: ' + response.status + ' ' + response.statusText);
          console.warn(response);

          $('#tmsm-woocommerce-booking-thalasso-modalform').removeClass('loading');
        }
      });
    });
  }


})(jQuery);