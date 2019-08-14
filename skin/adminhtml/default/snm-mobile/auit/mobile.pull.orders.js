(function pullPagePullImplementation($) {
  "use strict";
  var currentPage = 1,
      listSelector = "div.pull-orders-page ul.ui-listview",
      lastItemSelector = listSelector + " > li:last-child";

  function onPullUp (event, data) {
	  var url = $(this).attr('data-auit-url');
	  var iscrollview = data.iscrollview;
      jQuery.ajax({
          type: "GET",
          url: url+'?p='+(++currentPage),
          cache: false,
          //data: formData,
          success: function(data, status){
        	  $(listSelector).append(data).listview("refresh");
        	  /*
        	  iscrollview.refresh(null, null,
        		      $.proxy(function afterRefreshCallback(iscrollview) {
        		        this.scrollToElement(lastItemSelector, 400);
        		        }, iscrollview) );
*/
        	  iscrollview.refresh();
          },
          error: function(data, status)
          {
          	alert ( "fail:"+status);

          }
      });
    }

  // Set-up jQuery event callbacks
  $(document).delegate("#auit_madmin_orders_index", "pageinit",
    function bindPullPagePullCallbacks(event) {
      $(".iscroll-wrapper", this).bind( {
     // iscroll_onpulldown : onPullDown,
      iscroll_onpullup   : onPullUp
      } );
    } );

  }(jQuery));
