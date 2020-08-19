/*
 * Off Canvas
 * --------------------------------------------------
 */

( function($) {
 $(document).ready(function(){
	  $('[data-toggle="offcanvas"]').click(function () {
	    $('.offcanvas').toggleClass('active');
	    $('.navbar-toggler-close').toggleClass('d-none');
	    $('.navbar-toggler-icon').toggleClass('d-none');
	  });

	})
})(jQuery);
