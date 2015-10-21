$(document).ready(function( ) { 
	search_reservation();
	footer_links(); 
	function search_reservation ( ) {
		var a = $("#hr_wrapper_table").height(); 
		$("#reservation-form-wrrapper").css({ "height":"3000px" })
		$("#form-popUp-close").click(function ( ) {  
            $("#search-form").fadeOut("slow"); 
        })  
	}  
	function footer_links ( ) {	 
		// alert("popup jquery");
		// var  windowHeight = $(window).height() ; 
		// windowHeight = windowHeight-64;
			// alert( windowHeight); 
		// $("#click-to-view-form-table").css({"margin-top":windowHeight+"px"}) 
		$("#click-to-view-form-table").click(function( ) { 
	        // alert("well done general! "); 
	        $("#search-form").fadeIn("normal");
	    });
	}
}) 