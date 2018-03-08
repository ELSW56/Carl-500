	$(document).ready(function(){
		$('.action').children().css({opacity: 0.3});
		$('.action').hover( function(){
					$('.action').children().css({opacity: 0.3});
			$(this).children().css({opacity: 1});
		});
	
	   	$(window).hover( function(e){
			if(!$(e.target).hasClass('child')){
				$('.action').children().css({opacity: 0.3});
	   	    }
		});
	});	