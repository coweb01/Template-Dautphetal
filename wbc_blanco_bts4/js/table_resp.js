/**
 *	Script to make all Tables Responsive
 *
 *	@author: Dan Kring (wbc)
 *	@version: v1.0 15.06.2015
 *	@requires: jQuery
 */
(function($){

	if($('table').length){
		for (var i = $('table').length - 1; i >= 0; i--) {
			$($('table')[i]).replaceWith('<div class="table-responsive">'+$('table')[i].outerHTML+'</div>');
				$($('table')[i]).removeClass('table table-condensed');
				$($('table')[i]).addClass('table table-condensed');
		
		
		};
	}

})(jQuery);