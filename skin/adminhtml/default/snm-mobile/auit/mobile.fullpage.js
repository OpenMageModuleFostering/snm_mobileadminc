(function($,window){
	$.widget("mobile.auitfullpage",$.mobile.widget,{
		wallpaper: undefined,
		content: undefined,
		fixedHeightSelector: ":jqmData(role='header'), :jqmData(role='footer'), :jqmData(role='contentinfo')",
		_init: function() {
			var self = this;
			$(window).bind("resize orientationchange", function(event) {
				self.resizePane();
        	});
			$( document ).ready( function(  ){
				self.resizePane();
			});
		},
		calculateBarsHeight:function(page) {
		    var barsHeight = 0,
		        $barsInPage = page.find(this.fixedHeightSelector);

			    $barsInPage.each(function() {
			        barsHeight += $(this).outerHeight(true);
		        });
			    return barsHeight;
		},
		resizePane: function() {
			var page  = this.element.parents(':jqmData(role="page")');
			var newWrapperHeight,viewportHeight,barsHeight;
		    page.trigger("updatelayout");
		    viewportHeight = $(window).height();
		    barsHeight = this.calculateBarsHeight(page);
		    newWrapperHeight =
		      viewportHeight -
		      barsHeight                              // Height of fixed bars or "other stuff" outside of the wrapper
//		      (IsMobileSafari && !IsIPad ? 60 : 0) +  // Add 60px for space recovered from Mobile Safari address bar
		      ;                // User-supplied fudge-factor if needed
/**
		    this.element.css({
		    	"padding": "0px",
		    	"height": newWrapperHeight,
		    	"overflow": 'hidden'
		    });
**/
		    this.element.css({
		    	"height": newWrapperHeight,
		    });
		    this.element.addClass('auit-fullpage');

		}
	});

	$( ":jqmData(role='page')" ).live( "pagecreate", function() {
		$( ":jqmData(auit-fullpage)", this ).each(function() {
			$(this).auitfullpage();
		});
	});


	 $.mobile.page.prototype.options.addBackBtn = true;
}) (jQuery,this);