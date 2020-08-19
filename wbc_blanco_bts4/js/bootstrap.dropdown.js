// JavaScript Document
(function($){
		$(document).ready(function(){
			// dropdown
			$('nav .menu > .deeper').addClass('dropdown');
			$('nav .menu > .deeper > a').addClass('dropdown-toggle');
			$('nav .menu > .deeper > a').addClass('dropdown-toggle disabled');
			$('nav .menu > .deeper > a').attr('data-toggle', 'dropdown');
			$('nav .menu > .deeper > a').attr('href', '#');
			$('nav .menu > .deeper > a').append('<span  class="caret"></span>');
			$('nav .menu > .deeper > ul').addClass('dropdown-menu');
			$('nav .menu > .deeper > ul').attr('role', 'menu');
		});
 })(jQuery);
