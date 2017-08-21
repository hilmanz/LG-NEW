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


$( ".prodimg" ).click(function() {
	$(".dragprodimg").remove();
	var imgsrc = $(this).attr( "src" );
  	$(".cropImgWrapper").append($('<img id="dragprodimg" />').addClass('dragprodimg').attr('src',imgsrc));
  	//drag product
	(function($) {
	    $.fn.drags = function(opt) {

	        opt = $.extend({handle:"",cursor:"move"}, opt);

	        if(opt.handle === "") {
	            var $el = this;
	        } else {
	            var $el = this.find(opt.handle);
	        }

	        return $el.css('cursor', opt.cursor).on("mousedown", function(e) {
	            if(opt.handle === "") {
	                var $drag = $(this).addClass('draggable');
	            } else {
	                var $drag = $(this).addClass('active-handle').parent().addClass('draggable');
	            }
	            var z_idx = $drag.css('z-index'),
	                drg_h = $drag.outerHeight(),
	                drg_w = $drag.outerWidth(),
	                pos_y = $drag.offset().top + drg_h - e.pageY,
	                pos_x = $drag.offset().left + drg_w - e.pageX;
	            $drag.css('z-index', 1000).parents().on("mousemove", function(e) {
	                $('.draggable').offset({
	                    top:e.pageY + pos_y - drg_h,
	                    left:e.pageX + pos_x - drg_w
	                }).on("mouseup", function() {
	                    $(this).removeClass('draggable').css('z-index', z_idx);
	                });
	            });
	            e.preventDefault(); // disable selection
	        }).on("mouseup", function() {
	            if(opt.handle === "") {
	                $(this).removeClass('draggable');
	            } else {
	                $(this).removeClass('active-handle').parent().removeClass('draggable');
	            }
	        });

	    }
	})(jQuery);
	$('.dragprodimg').drags();
});


var croppicContaineroutputOptions = {
		uploadUrl:'img_save_to_file.php',
		//cropUrl:'img_crop_to_file.php', 
		//outputUrlId:'cropOutput',
		//modal:false,
		onAfterImgUpload: 	function(){ 
			$("#btnSave").addClass("show");
		 },
		onReset:	function(){ 
			$("#btnSave").removeClass("show");
		 },
		 onAfterImgCrop:	function(){
			$("#btnSave").removeClass("show");
		 },
		loaderHtml:'<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> '
}
var cropContaineroutput = new Croppic('cropContaineroutput', croppicContaineroutputOptions);

$(function() { 
    $("#btnSave").click(function() { 
    	$(this).removeClass("show");
		$("#btnCancel").addClass("show");
        html2canvas($(".cropImgWrapper"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
                document.body.appendChild(canvas);
                $("#img-out").append(canvas);
				var dataURL = canvas.toDataURL();
				$("#img-out canvas").src = dataURL;
				$.ajax({
					type: "POST",
					url: "http://localhost/LG-GIT/HTML/upload.php",
					data: { 
					   imgBase64: dataURL
					}
				}).done(function(response) {
					console.log('saved: ' + response); 
					$("#cropvalue").val(response);
				});
            }
        });
    });
}); 
$(function() { 
    $("#btnCancel").click(function() { 
    	$("#img-out canvas").remove();
    	$(this).removeClass("show");
		$("#btnSave").addClass("show");
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