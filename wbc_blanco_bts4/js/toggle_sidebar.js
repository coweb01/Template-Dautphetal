/**
 *	Script to enable the toggle sidebar button for mobile devices
 *	Hides/Shows the #sidebar-left
 *
 *	@author: Dan Kring (wbc)
 *	@version: v1.0 15.06.2015
 *	@requires: jQuery
 */
(function($){
	var counter = 0;
	if($('#sidebar-left').length==0){
		$('#toggle-sidebar-btn').hide();
	}
	$('#toggle-sidebar-btn').click(function(){
		if ($(this).width() < 975){
			if(counter == 0){
		        jQuery('#toggle-sidebar-btn').html('<i class="fa fa-angle-double-left"></i>');
		        $('#sidebar-left').fadeIn(500);
		        counter++;
		    }else{
		        jQuery('#toggle-sidebar-btn').html('<i class="fa fa-angle-double-right"></i>');
		        $('#sidebar-left').fadeOut(500);
		        counter--;
		    }
		}
	});

	// linkes Menu auf den Unterseiten zum ein- ausklappen
	$( ".ext-header" ).click(function() {
	  $( ".nav-toggle" ).toggle( "fast" );	   
	});

})(jQuery);