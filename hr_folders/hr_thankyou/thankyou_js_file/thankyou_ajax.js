 // alert("reservation ajax")


function  delete_reservation ( rid , pageAfterDelete ) {
	// alert(" rlid = "+rl_id);
	var bol = confirm("are you sure to delete this reservation ? "); 
	if (bol == true) {
		// alert("reservation succesfully deleted!")
		document.location = 'delete_reservation?id='+rid+'&pageAfterDelete='+pageAfterDelete;
	}else{
		// alert("reservatoin not deleted! ")
	}
} 