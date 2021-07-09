/*
 * Off Canvas
 * Author: C.oerter / Das webconcept
 * Stand: 05/2020
 * Offcanvas auch bei Desktopansicht.
 * Blendet die Offcanvas Bar ein und aus. Bei Desktop
 * wird die Bar nicht komplett eingefahren. Bei Klick
 * auf ein bestimmtes Icon wird automatisch das Dropdown 
 * beim Aufklappen der Bar angezeigt.
 * --------------------------------------------------------
 */

( function($) {
 $(document).ready(function(){

	  $('[data-toggle="offcanvas"]' ).click(function (e) {
	  	
	    $('.navbar-toggler-close').toggleClass('d-none');
	    $('.navbar-toggler-icon').toggleClass('d-none');
	  	$('.offcanvas').toggleClass('active');
  
	    if ( $('.offcanvas').is(':hidden') ) {			
  				$('.offcanvas').find('.dropdown-toggle').dropdown('hide');
  				//console.log($(this));
			};
	   
	  });

 	   
	  $('.sidebar-offcanvas .level1.dropdown').click(function(e) {
	  	     
		//e.preventDefault();
		e.stopPropagation();
		$('.sidebar-offcanvas .level1.dropdown').each(function(i) {					
				$(this).find('.dropdown-toggle').dropdown('hide');
		});

		if ($('.offcanvas').is('.active')) {
	  	    if ( $(this).find('.dropdown-menu').is(':hidden') ) {
					$(this).find('.dropdown-toggle').dropdown('toggle');
	  	    }
	  	} 
	  	    
	  	//console.log($(this));
	 	});
  });
})(jQuery);

( function($) {

	  $(document).click(function (e) {

            //console.log(e.target);
            if ( e.target == $('.offcanvas.active')[0]) {
            	 //console.log('klick offcanvas')	;
            	 $('.offcanvas').toggleClass('active');	
            	 $('.navbar-toggler-close').toggleClass('d-none');
	         	 $('.navbar-toggler-icon').toggleClass('d-none');
	  		
	         }	 


			 if ( $('.offcanvas').hasClass('active') ) {

			 	$('input#hamburg').prop('checked', true);

			 } else {

				$('input#hamburg').prop('checked', false);

			}

		 
	  });

})(jQuery);

