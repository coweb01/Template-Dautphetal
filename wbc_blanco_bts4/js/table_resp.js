"use strict"; 
/**
 *	Script to make all Tables Responsive
 *
 *	@author: Dan Kring (wbc)
 *	@version: v1.0 15.06.2015
 *	@requires: jQuery
 */
( function($) {
 $(document).ready(function(){

let table = $('table');

		if(table.length){
			table.each(function(e){

				if ( !$(this).hasClass('table') || !$(this).hasClass('table-condensed')) {

					$(this).removeClass('table table-condensed');
					$(this).addClass('table table-condensed');
					$(this).wrap('<div class="table-responsive"></div>');
					
				}
				
			});
			
		}

	});
})(jQuery);