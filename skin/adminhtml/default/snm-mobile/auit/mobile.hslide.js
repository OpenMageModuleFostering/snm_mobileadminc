(function($,window){
	$.widget("mobile.auitswipe",$.mobile.widget,{
		curPage: 0,
		_init: function() {
			var self = this;
			//var THIS = $(this),page = THIS.parents(":jqmData(role='page')");
			this.element.bind('swiperight', function (e) {

				self.scrollTo(self.curPage-1);
		        e.stopImmediatePropagation();
		        return false;
		    });
			this.element.bind('swipeleft', function (e) {
				self.scrollTo(self.curPage+1);
				e.stopImmediatePropagation();
		        return false;
		    });
			$(window).bind("resize orientationchange", function(event) {
				self.resizePane();
        	});
			$( document ).ready( function(  ){
				self.resizePane();
			});
		},
		scrollTo:function(curPage)
		{
			var wrapper = this.element.children(":first");
			if ( curPage < 0 ) curPage = 0;
			var w = this.element.width();
			var w2 = wrapper.width();
			var p = curPage*w;
			if ( p >= w2 ) {
				p=0;
				curPage=0;
			}
			this.curPage=curPage;
			wrapper.stop().animate({'left':'-'+p+'px'});
			return curPage;
		},
		resizePane: function() {
			var w = this.element.width();
			var wrapper = this.element.children(":first");
			wrapper.children().css('width',w+'px');
		}
	});

	$( ":jqmData(role='page')" ).live( "pagecreate", function() {
		$( ":jqmData(auit-swipe)", this ).each(function() {
			$(this).auitswipe();
		});
	});

}) (jQuery,this);