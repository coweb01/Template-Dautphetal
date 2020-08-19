// script: https://www.jqueryscript.net/form/jQuery-Floating-Placeholder-Text-Plugin-Placeholder-Label.html */

(function ($) {
    $.fn.placeholderLabel = function(options) {
                
        var settings = $.extend({
            // These are the defaults.
            placeholderColor: "#DDDDDD",
            labelColor: "#DDDDDD",
            labelSize: this.css('font-size'),
            fontStyle: "normal",
            useBorderColor: false,
            inInput: true,
            timeMove: 200
        }, options); 

        var BindOnData = function (label, input, pt){
            var lh = label.height();
            var mtm = Number(pt.replace('px','')) + (lh/2);
            
            if(!settings.inInput){
                mtm += lh/2;
                label.css('background-color','');
                label.css('color',settings.labelColor);
            }

            label.animate({
                marginTop: "-="+mtm,
                //fontSize: settings.labelSize,
                fontSize: '14px',
            }, settings.timeMove);
            input.keyup();
        }

        //Work
        $(this).each(function (i,e){
            var self = $(e);
            if(self.attr('bind-placeholder-label') != undefined){
                var pt = self.css('padding-top');
                BindOnData(self.prev(), self, pt);
            }
            var currentBorderColor = self.css('border-color');
            var currentPlaceholderSize = self.css('font-size');
            if(self.attr('placeholder')){
            
                var label = $('<label></label>');
                label.addClass('float-placeholder');
                label.css('position','absolute');
                label.css('cursor','initial');
                label.css('font-style',settings.fontStyle);
                label.css('color',settings.labelColor);
                label.css('font-size',currentPlaceholderSize);

                var text = self.attr('placeholder');
                self.removeAttr('placeholder');
                label.text(text);
                var ep = self.position().left;
                var pt = self.css('padding-top');
                var pl = self.css('padding-left');
                var mt = self.css('margin-top');
                var ml = self.css('margin-left');

                label.css('margin-top', (Number(pt.replace('px',''))) + Number(mt.replace('px','')));
                label.css('margin-left', (Number(pl.replace('px','')) - 5) + Number(ml.replace('px','')));
                label.css('padding-left','5px');
                label.css('padding-right','5px');
                label.css('background-color',self.css('background-color'));
                //Event
                var self = self;
                label.click(function (){
                    self.focus();
                });
                
                self.focus(function(){
                    self.addClass('changed');
                    //if ( !self.hasClass('changed') ) {
                        if(settings.useBorderColor){
                            self.css('border-color',settings.labelColor);
                        }
                        //label.css('color',settings.labelColor);
                        label.css('color','#333333');

                        if(!self.val().length){
                            
                            var lh = label.height();
                            var mtm = Number(pt.replace('px','')) + (lh/2);
                            if(!settings.inInput){
                                mtm += lh/2;
                                label.css('background-color','');
                            }
                           
                            label.animate({
                                marginTop: "-="+mtm,
                                //fontSize: settings.labelSize,
                                fontSize: '14px',
                                color: "#333333",
                            }, settings.timeMove);
                            
                       }
                   //}
                });

                // fix IE und Edge autofill funktion
                // Klasse changed 
                
               self.change(function(){
                    if ( !self.hasClass('changed') ) {
                   
                            if(settings.useBorderColor){
                                self.css('border-color',settings.labelColor);
                            }
                            //label.css('color',settings.labelColor);
                            label.css('color','#333333');
                            if(self.val().length ){
                                self.addClass('changed');
                                var lh = label.height();
                                var mtm = Number(pt.replace('px','')) + (lh/2);
                                if(!settings.inInput){
                                    mtm += lh/2;
                                    label.css('background-color','');
                                }
                                
                                label.animate({
                                    marginTop: "-="+mtm,
                                    //fontSize: settings.labelSize,                                    
                                    fontSize: '14px',
                                    
                                }, settings.timeMove);
                                
                            }   
                    }        
                });

                self.blur(function(){
                 
                     
                        if(settings.useBorderColor){
                            self.css('border-color',currentBorderColor);
                        }
                        label.css('color',settings.placeholderColor);

                        if(!self.val().length){
                            var lh = label.height();
                            var mtm = Number(pt.replace('px','')) + (lh/2);
                            if(!settings.inInput){
                                mtm += lh/2;
                                label.css('background-color','');
                            }
                            //console.log(mtm);
                            label.animate({
                                marginTop: "+="+mtm,
                                fontSize: currentPlaceholderSize,
                                //fontSize: '14px',
                                
                            }, settings.timeMove);
                        }

                   
                });
                if(self.attr('alt')){
                    var textLabel = self.attr('alt');
                    var textLabelOld = label.text();
                    self.removeAttr('alt');
                    self.keyup(function (){
                        if(self.val().length){
                            label.text(textLabel);
                        } else {
                            label.text(textLabelOld);
                        }
                    });
                }
                 self.before(label);
                 if(self.val().length){
                    BindOnData(label, self, pt);
                }
                return self.attr('bind-placeholder-label','true');
            } else {
                return null;
            }
        });
    };
}(jQuery));
