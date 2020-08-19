
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
    let changeHref  = new(dropdownChangeHref);
    let breakpoint  = 1201;

	jQuery("a.dropdown-toggle").each( function(e){			
		let a = jQuery(this);
		changeHref.ChangeHref(breakpoint,a);	
	});
	

	
    /* Resize Event*/
    jQuery(window).resize(function(){

    	jQuery("a.dropdown-toggle").each( function(e){
    		let a = jQuery(this);
	        if (jQuery(window).width() != windowWidth) {
	                 
								
				changeHref.ChangeHrefPhone(breakpoint,a);

	        } 
        	// do nothing
        });	
        // Update the window width for next time
	    windowWidth = jQuery(window).width(); 			
				
	});
	
});	

class dropdownChangeHref {

		

	ChangeHref(breakpoint,element) {
		
		this.breakpoint     = breakpoint;
		this.element        = element;					
		this.StoreUrl(this.element);

	 	if ( jQuery(window).width() < this.breakpoint ) {

				this.element.attr("data-toggle", "dropdown");
				this.element.attr("href","#");
			
			} else {

				let result = this.element.attr("href").search('#');				
				if (result != 1) { // an erster Stelle keine # in der url					
					this.element.attr("data-toggle", "dropdown href");	
				} else {
					this.element.attr("data-toggle", "dropdown");
				}
			}
	}

	ChangeHrefPhone(breakpoint,element) {
		
		this.breakpoint     = breakpoint;
		this.element        = element;	
	    let id              = 0;	
	    let StoreHref       = "";	

	 	if ( jQuery(window).width() < this.breakpoint ) {
				
				this.element.attr("data-toggle", "dropdown");
				this.element.attr("href","#");

			} else {
				/* setzt die gesicherte url wieder an die Stelle der # */
				let clone  = this.element.find('.Clonedropdown');
				console.log(clone.attr("href"));
				StoreHref = clone.attr("href");
				this.element.attr("href", StoreHref);	
				/* End  */	

				let result = this.element.attr("href").search('#');
				
				if (result != 1) { // an erster Stelle keine # in der url
					this.element.attr("data-toggle", "dropdown href");
				} else {
					this.element.attr("data-toggle", "dropdown");
				}
			}
	}

	StoreUrl(element) {
		/* dupliziert den Dropdownlink, 
		zur späteren Verwendung der URL bei Resize*/

		this.element = element;
		let clone = this.element.clone(true);
		clone.removeAttr("data-toggle");
		clone.removeClass("dropdown dropdown-toggle");
		clone.addClass('Clonedropdown d-none').appendTo(this.element);
		//console.log(clone);
	}

}