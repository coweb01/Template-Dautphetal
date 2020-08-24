"use strict";
/*! appendAround markup pattern. [c]2012, @scottjehl, Filament Group, Inc. MIT/GPL 
how-to:
	1. Insert potential element containers throughout the DOM
	2. give each container a data-set attribute with a value that matches all other containers' values
	3. Place your appendAround content in one of the potential containers
	4. Call appendAround() on that element when the DOM is ready
*/
(function( $ ){
	$.fn.appendAround = function(){
	  return this.each(function(){
      
	    var $self = $( this ),
	        att = "data-set",
	        $parent = $self.parent(), 
	        parent = $parent[ 0 ],
	        attval = $parent.attr( att ),
	        $set = $( "["+ att +"='" + attval + "']" );

		function isHidden( elem ){
			return $(elem).css( "display" ) === "none";
		}

		function appendToVisibleContainer(){
			if( isHidden( parent ) ){
				var found = 0;
				$set.each(function(){
					if( !isHidden( this ) && !found ){
						$self.appendTo( this );
						found++;
						parent = this;
					}
				});
	      	}
	    }
      
	    appendToVisibleContainer();
      
	    $(window).bind( "resize", appendToVisibleContainer );
      
	  });
	};
}( jQuery ));



// This is based on MooTools/More Refactor plugin



if(typeof Element.prototype.hide != 'undefined' || typeof Element.prototype.show != 'undefined')  {
	// mootools ist aktiv
	
	// Fix Mootools and Bootstrap3 conflict
	
	var mHide = Element.prototype.hide;
	var mShow = Element.prototype.show;
	
	// Override them
	Element.implement({
	hide: function() {
	if (this.hasClass('mootools-noconflict'))
	return this;
	
	mHide.apply(this, arguments);
	
	},
	show: function(v) {
	if (this.hasClass('mootools-noconflict'))
	return this;
	
	mShow.apply(this, v);
	}
	});
}




//  JQuery Scroll to Top of page 
( function($) {
 $(document).ready(function(){

 	// Fix Tooltip Bootstrap conflict	 
    $('.hasTooltip').addClass('mootools-noconflict');
    $('.hasPopover').addClass('mootools-noconflict');

    // Remove Boostrap 2 klassen
    $('.control-group').removeClass('control-group').addClass('form-group');
	$('.control-label').removeClass('control-label');
	$('.controls').removeClass('controls');
	$('.label-fcinner').removeClass('label-fcinner');
	
	// hide #back-top 
    $("#gototop").hide();
    
     // fade in #back-top
     $(function () { 
        $(window).scroll(function () {
             if ($(this).scrollTop() > 200) {
                 $('#gototop').fadeIn();
             } else {
                 $('#gototop').fadeOut();
             }
         });
 
         /* scroll body to 0px 
         $('#gototop').click(function () {
             $('body,html').animate({
                 scrollTop: 0
             }, 800);
             return false;
         }); */
     });


 })

 })(jQuery);



// Scroll to ID onepage 

( function($) {
 $(window).load(function(){
 
 		$("#navigation-main a.nav-link,a[href='#top'], a[rel='m_PageScroll2id']").mPageScroll2id({
			scrollSpeed:800,
			offset: -50
			 		
		 });
		 
		 $("a[rel='next']").click(function(e){
		 e.preventDefault();
		 var to=$(this).parent().parent("section").next().attr("id");
		 $.mPageScroll2id("scrollTo",to);
		 });


 		 // scroll to Joomla Message 	
	     $.mPageScroll2id("scrollTo","#system-message",{
	     	
			offset: 80

	     });
 		

 
 });
})(jQuery);
