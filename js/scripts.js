$(document).ready( function() {
    $.scrollify({
        section : "section",
    });
   
    
});
/*
jQuery( document ).ready(function() {
    var height= jQuery('.parallax').height();
	var opacity = 0;
	var hOpacity = 1;
	var headerTop = jQuery('.parallax-background').height();
	var startParallax = jQuery('.text-parallax').offset().top - jQuery('.parallax').offset().top
	
	jQuery( window ).scroll(function() {
	
		var thisTop = jQuery('.text-parallax').offset().top - jQuery(window).scrollTop();
		console.log('thisTop: ' + thisTop);
		if(thisTop <= startParallax){	
            
            headerTop -= 10;
			jQuery('.parallax').height(height);
			jQuery('.parallax').addClass('fixed');
			jQuery('.text-parallax').css('top', headerTop);
			//opacity = opacity+.1;
			//jQuery('.parallax-background').css('opacity', opacity);		
			
		}else{
			//jQuery('.parallax').removeClass('fixed');
			//jQuery('.text-parallax').removeAttr('style');
			//jQuery('.parallax-background').removeAttr('style');
			opacity = 0;
			hOpacity = 1;
			headerTop = 20;
		//	jQuery('.parallax-background').css('opacity', opacity);
			//jQuery('.parallax').css('opacity', hOpacity);
		}
		
		
		if(thisTop <= (startParallax - 200)){
			   headerTop = headerTop - 20;
			   //jQuery('.parallax').css('top', headerTop);
			   //hOpacity = hOpacity - .1;
			  // jQuery('.parallax').css('opacity', hOpacity);
		}
		
		
		
    });
});*/