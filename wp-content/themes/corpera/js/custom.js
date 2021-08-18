jQuery(document).ready(function() {
	
	// 01 - FIX HEADER ON SCROLL FUNCTION
	jQuery(window).on('scroll', function(){
    	if (jQuery(window).scrollTop() >= 150) {
	       	jQuery('.sticky-header').addClass('is-sticky animated fadeInDown');
	    }
	    else {
	       	jQuery('.sticky-header').removeClass('is-sticky animated fadeInDown');
	    }
	});

  	var owl = jQuery('#banner-slider');
  	owl.owlCarousel({

	    margin: 10,
	    nav: true,
	    center: true,
	    loop: true,
	    video:true,
	    nav: true,
	    autoplay: true,
    	navText: ["<i class='fa fa-long-arrow-left'></i>", "<i class='fa fa-long-arrow-right'></i>"],
	    responsive: {
	      	0: {
	        	items: 1
	      	},
	      	600: {
	        	items: 1
	      	},
	      	1000: {
	        	items: 1
	      	}
    	}
  	});
	

	
});


