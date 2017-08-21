$(function(){
  $('.fullscreen').css({ width: $(window).innerWidth() + 'px', height: $(window).innerHeight() + 'px' });
  $('.autoheight').css({ height: $(window).innerHeight() + 'px' });

  $(window).resize(function(){
	$('.fullscreen').css({ width: $(window).innerWidth() + 'px', height: $(window).innerHeight() + 'px' });
  	$('.autoheight').css({ height: $(window).innerHeight() + 'px' });
  });
});

$(window).load(function() {
	  $('.flexslider').flexslider({
		animation: "slide"
	  });
});



    			
$(document).ready(function() {
    $("#galleryList").owlCarousel({
		items : 4,
		itemsDesktop : [1199,4],
		itemsDesktopSmall : [980,3],
		itemsTablet: [768,2],
		itemsTabletSmall: false,
		itemsMobile : [479,1],
		margin: 210,
 
	    // Navigation
	    navigation : true,
	    navigationText : ["",""],
	    rewindNav : true,
	    scrollPerPage : false,
	 
	    //Pagination
	    pagination : false,
	    paginationNumbers: false,
    });
	$('#menu').slicknav({
		label: '',
		duration: 1000,
		easingOpen: "easeOutBounce", //available with jQuery UI
		prependTo:'#navbarmobile'
	});
	$('.showPopup').magnificPopup({
	  type: 'inline',

	  fixedContentPos: false,
	  fixedBgPos: true,

	  overflowY: 'auto',

	  closeBtnInside: true,
	  preloader: false,
	  
	  midClick: true,
	  removalDelay: 300,
	  mainClass: 'my-mfp-zoom-in'
	});
 	$(".btnClosePopup").click(function() { 
    	$.magnificPopup.close();
    });
	$('#tabs').responsiveTabs({
		rotate: false,
		startCollapsed: 'accordion',
		collapsible: 'accordion',
		setHash: false,
	});
});