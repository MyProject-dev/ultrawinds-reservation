 

function view_room_details_poup( id ) { 
	// alert("done id = "+id)

	$("#room-detail").css({"display":"block"});    
	if (window.XMLHttpRequest)  {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) { 
			document.getElementById('room-details-container-display').innerHTML = xmlhttp.responseText; 
		    // alert("proccessed ")
		}
	}
	xmlhttp.open('GET','hr_folders/index/index_php_file/room_details.php?rid='+id,true);
	xmlhttp.send(); 
} 
function close_room_detail(){
	$("#room-detail").css({"display":"none"}); 	 
}

 