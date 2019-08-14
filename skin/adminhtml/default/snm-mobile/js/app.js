;(function($, window, document, undefined) {
	$( ":jqmData(role='page')" ).live( "pageshow", function() {
		$('.ui-page-active form :input:first:visible').focus().select();


	});
})(jQuery, window, document);
