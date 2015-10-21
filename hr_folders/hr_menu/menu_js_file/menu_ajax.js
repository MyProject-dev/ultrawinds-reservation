 // alert("sadas"); 


search = new Object();
search.counter_add = 0; 
search.result_id = "";
search.search_word = "";
 

function search_typed( type  ) {
	// alert(type);
	search.total_res = $("#total_room").text();  

	// search.total_res = parseInt(search.total_res);
	// alert(search.total_res);
	// kailangan ma detect kong pila ka li sa ul nga result sa search.
	search.updownkey = false;  
	if(event.keyCode == 40) { // down key
		// event.preventDefault()
	 	// alert("keydown");  
	 	if ( search.counter_add < search.total_res ) { // if there is still to move down result
	 		search.counter_minus = search.counter_add;
		 	search.counter_add++;
		 	search.updownkey = true; 
		 	// alert("add < total res")
	 	} else {  // if no more to move down result back to beggining result.
	 		// alert("add > total res") 
		 	search.counter_add=1;
		 	search.counter_minus = search.total_res;
		 	search.updownkey = true; 
	 		// alert(" minus "+search.counter_minus+" add = "+search.counter_add); 
	 	} 
	 	// alert(" minus "+search.counter_minus+" add = "+search.counter_add); 
	}else if (event.keyCode == 38) {  // up key  
		if ( search.counter_add > 1  ) { // if there is still to move up result
			search.counter_minus = search.counter_add; 
			search.counter_add--; 
			search.updownkey = true;
			// alert(" minus "+search.counter_minus+" add = "+search.counter_add); 
		} else { // if no more to move up result back to end result
			search.counter_add = search.total_res;
		 	search.counter_minus = 1;
		 	search.updownkey = true;  
		}
	}else if ( event.keyCode == 13 ) { 
		// alert("enter pressed and search is starting now!");
	} 
	else{
		// key pressed 
		$('#menu-search-result-dropdown').text("");
		search.typed = document.getElementById('menu-search').value;	 
		if ( search.typed == '' ) {
			// no text entered in text field
		}else{
			search.counter_add = 0;
			// alert("key pressed "+search.typed); 
			// alert(search.typed);
			if (type == 'admin') {
				// alert("find users ");
				ajax_send_data("menu-search-result-dropdown","hr_folders/hr_menu/menu_php_file/retrieve-data.php?menu_search="+search.typed+"&page=admin","menu-search-container-loading") 
			}else if ( type=='user'){
				// alert("find rooms");
				ajax_send_data("menu-search-result-dropdown","hr_folders/hr_menu/menu_php_file/retrieve-data.php?menu_search="+search.typed+"&page=user","menu-search-container-loading") 	
			} 
		} 
	} 
	if ( search.updownkey == true) { 
		$("#menu-search").val($("#menu-search-result-id-"+search.counter_add).text())
		$("#menu-search-result-id-"+search.counter_minus).css({"background-color":"#fff"});
		$("#menu-search-result-id-"+search.counter_add).css({"background-color":"#eb6830"}); 
	}  
}
function  search_result_mouseover( rid ) { 
	
	search.total_res = $("#total_room").text();   
	search.result_id_number = rid;  
	for (var i = 1; i <= search.total_res; i++) {
		// alert(" name white "+$("#menu-search-result-id-"+search.result_id_number).text());
		$("#menu-search-result-id-"+i).css({"background-color":"#fff"});	 
	};
	$("#menu-search").val($("#menu-search-result-id-"+search.result_id_number).text()) 
	$("#menu-search-result-id-"+search.result_id_number).css({"background-color":"#eb6830"});  
	// alert("mouse hover search result id"+search.result_id_number);  
}
function search_send( path ) {
	// search.search_word = sw; 
	// alert(search.search_word);
	Go(path);
}

