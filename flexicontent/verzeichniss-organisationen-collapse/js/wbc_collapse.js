"use strict";
( function($) {
 $(document).ready(function(){
 	$("#wbcAccordion .collapse").each( function(e){	

 		$(this).on('show.bs.collapse', function () {
  			$(this).parent().addClass('activeItem');
		});

 		$(this).on('hide.bs.collapse', function () {
  			$(this).parent().removeClass('activeItem');
		});

 	});
 });

 })(jQuery); 	