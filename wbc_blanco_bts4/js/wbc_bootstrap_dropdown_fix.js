"use strict";

/* Bootstrap 4 Dropdown Menue
/* 
/* entfernt data-toggle href wenn vorhanden bei der mobilen Variante. 
/* Haengt den Link wieder an, bei Desktop
/* Author: c.oerter / das-webconcept 
/* Variable Breakpoint muss an das Projekt angepasst werden.
/* 
/***/

jQuery(document).ready(function($) {
    /* nach dem Laden des Documents */
    let windowWidth = 0;
    //let changeHref  = new(dropdownChangeHref);
    let breakpoint  = 3000;

	jQuery("a.dropdown-toggle").each( function(e){			
		let a = jQuery(this);
		ChangeHref(breakpoint,a);	
	});
	

	
    /* Resize Event*/
    jQuery(window).resize(function(){

    	jQuery("a.dropdown-toggle").each( function(e){
    		let a = jQuery(this);
	        if (jQuery(window).width() != windowWidth) {
	                 
								
				ChangeHrefPhone(breakpoint,a);

	        } 
        	// do nothing
        });	
        // Update the window width for next time
	    windowWidth = jQuery(window).width(); 			
				
	});
	
});	


		

let ChangeHref = function	(breakpoint,element) {
		
		//this.breakpoint     = breakpoint;
		//this.element        = element;					
		StoreUrl(element);

	 	if ( jQuery(window).width() < breakpoint ) {

				element.attr("data-toggle", "dropdown");
				element.attr("href","#");
			
			} else {

				let result = element.attr("href").search('#');				
				if (result != 1) { // an erster Stelle keine # in der url					
					element.attr("data-toggle", "dropdown href");	
				} else {
					element.attr("data-toggle", "dropdown");
				}
			}
	}

let ChangeHrefPhone = function(breakpoint,element) {
		
		//this.breakpoint     = breakpoint;
		//this.element        = element;	
	    let id              = 0;	
	    let StoreHref       = "";	

	 	if ( jQuery(window).width() < breakpoint ) {
				
				element.attr("data-toggle", "dropdown");
				element.attr("href","#");

			} else {
				/* setzt die gesicherte url wieder an die Stelle der # */
				let clone  = element.find('.Clonedropdown');
				console.log(clone.attr("href"));
				StoreHref = clone.attr("href");
				element.attr("href", StoreHref);	
				/* End  */	

				let result = element.attr("href").search('#');
				
				if (result != 1) { // an erster Stelle keine # in der url
					element.attr("data-toggle", "dropdown href");
				} else {
					element.attr("data-toggle", "dropdown");
				}
			}
	}

let	StoreUrl = function (element) {
		/* dupliziert den Dropdownlink, 
		zur späteren Verwendung der URL bei Resize*/

		//this.element = element;
		let clone = element.clone(true);
		clone.removeAttr("data-toggle");
		clone.removeClass("dropdown dropdown-toggle");
		clone.addClass('Clonedropdown d-none').appendTo(element);
		//console.log(clone);
	}

