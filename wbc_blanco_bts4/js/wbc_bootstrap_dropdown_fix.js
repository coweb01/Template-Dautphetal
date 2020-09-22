"use strict";

/* Bootstrap 4 Dropdown Menue
/* 
/* entfernt data-toggle href wenn vorhanden bei der mobilen Variante.
/* Der Link wird bei im Dropdown an erster Stelle eingefügt.
/* Über die Klasse .ClonedropdownItem könnte der Link bei Bedarf auch ausgeblendet werden.
/* Haengt den Link wieder an, bei Desktop
/* Author: c.oerter / das-webconcept 
/* Variable Breakpoint muss an das Projekt angepasst werden.
/* Stand: 09-2020
/***/

jQuery(document).ready(function($) {
    /* nach dem Laden des Documents */
    let windowWidth = 0;
    let b  = new dropdownChangeHref();
    let breakpoint  = 3000;

	jQuery("li.level1 a.dropdown-toggle").each( function(e){			
		let a = jQuery(this);
		b.ChangeHref(breakpoint,a);	
	});
	

	
    /* Resize Event*/
    jQuery(window).resize(function(){

    	jQuery("li.level1 a.dropdown-toggle").each( function(e){
    		let a = jQuery(this);
	        if (jQuery(window).width() != windowWidth) {
	                 
								
				b.ChangeHref(breakpoint,a);

	        } 
        	// do nothing
        });	
        // Update the window width for next time
	    windowWidth = jQuery(window).width(); 			
				
	});
	
});	



function dropdownChangeHref() {

}		

dropdownChangeHref.prototype.ChangeHref = function(breakpoint,element){

	this.breakpoint     = breakpoint;
	this.element        = element;					

 	if ( jQuery(window).width() < this.breakpoint ) {

			this.StoreUrl(this.element);
			this.element.attr("data-toggle", "dropdown");
			this.element.attr("href","#");
		
		} else {
			this.RemoveUrl(this.element);
			let result = this.element.attr("href").search('#');				
			if (result != 1) { // an erster Stelle keine # in der url					
				this.element.attr("data-toggle", "dropdown href");	
			} else {
				this.element.attr("data-toggle", "dropdown");
			}
		}


};

dropdownChangeHref.prototype.RemoveUrl = function(element){

	this.element          = element;
	let dropdown          = this.element.parent().find('.dropdown-level1');
	let cloneItem         = dropdown.find('.ClonedropdownItem');
	let clone             = cloneItem.find('.Clonedropdown');
	//let clone  = this.element.find('.Clonedropdown');
	let StoreHref         = clone.attr("href");
	this.element.attr("href", StoreHref);	
	cloneItem.remove();
};

dropdownChangeHref.prototype.StoreUrl = function(element){
	/* dupliziert den Dropdownlink (Level1), und hängt einen Knoten unterhalb der Überschrift im Dropdown Menue an. */
	
	this.element = element;
	let clone    = this.element.clone(true);
	let dropdown = this.element.parent().find('.dropdown-level1');
	let ClonedropdownItem = dropdown.find('.ClonedropdownItem');


	if ( ClonedropdownItem.length == 0  ){

		this.element.parent().find('.dropdown-level1 .menutitle').after('<li class="nav-item level2 ClonedropdownItem"></li>')

		let dropdownItem = dropdown.find('.ClonedropdownItem'); 
		clone.removeAttr("data-toggle");
		clone.removeClass("dropdown dropdown-toggle");
		clone.addClass('Clonedropdown').appendTo(dropdownItem);
		
	} 
};



