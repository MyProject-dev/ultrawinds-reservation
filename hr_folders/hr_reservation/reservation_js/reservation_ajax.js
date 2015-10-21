// alert("reservation ajax")



	function new_room_view ( rdid , rid , type ) {  
		// alert(rid) 
		if ( type == 'default') {
			// alert("default"); 
			$("#room-img"+rid).attr("src","hr_folders/hr_images/room/"+rdid+".jpg"); 
		}else if ( type == 'amenities' ){
			// alert("amenities");
			$("#room-img"+rid).attr("src","hr_folders/hr_images/amenities/"+rdid+".jpg"); 	
		}else if ( type == 'room-views' ){ 
			// alert("room views");
			$("#room-img"+rid).attr("src","hr_folders/hr_images/room_views/"+rdid+".jpg"); 	
		} 
	}  
 	function confirm_reservation ( troom , type ) { 
 		// alert(type)
 		if ( type==1 ) { 
 			type = 'function hall';



	 		var buffet = document.getElementById("buffet").checked; 
			var  platein = document.getElementById("platein").checked; 
	 		 
 			if (platein == true || buffet == true) { 
 		 	
				 var a = confirm(" are you sure you want to book this?");

			 	if ( a ) {
			 		return true; 
			 	}else{
			 		return false;	 
				} 		 
	 		} else{
	 			alert("please select food to be served iether buffet or platein");
	 			return false;
	 		} 



 		}else{
 			type = 'room/s'; 
 			var a = confirm(" are you sure you want to book this?");

		 	if ( a ) {
		 		return true; 
		 	}else{
		 		return false;	 
			} 	
 		} 
 
		 	
 		 
		// return false;
	}
