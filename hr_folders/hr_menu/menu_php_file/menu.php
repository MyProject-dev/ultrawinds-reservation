<!-- 
	created: Dec 01 , 2013 / Sunday 10:28 pm
	requirements: js plugin
	author : Jesus Erwin Suarez
 --> 
 <!-- key codes:  http://www.cambiaresearch.com/articles/15/javascript-char-codes-key-codes  --> 

 <link rel="stylesheet" type="text/css" href="hr_folders/hr_menu/menu_style_file/menu_style1.css">
 <script type="text/javascript" src="hr_folders/hr_menu/menu_js_file/menu_ajax.js" ></script>
 <script type="text/javascript" src="hr_folders/hr_menu/menu_js_file/menu_jquery.js" ></script>  
 <div id="menu_container"> 
 	<div id="menu_content">   
 		<table id="menu_table1" border="0" cellpadding="0" cellspacing="0" > 
		 	<tr>   
		 		 
		 		<?php   
		 		if ( !empty($_SESSION['gid']) ) {   ?>  
		 				<td><a href="home">Book now</a></td>
			 			<td> <a href="home"  > welcome  <b style='text-decoration:none' > <?php echo  $hr->get_guest_name( $_SESSION['gid'] ) ?> </b> </a> </td>
				 		<td> <a href="thankyou"> my reservation </a> </td>
				 		<td><a href="guestprofile">Account</a></td> 
				 		<td> <a href="logout?type=guest"> logout </a> </td> 
		 		<?php }else{  ?> 
		 				<td> <a href="home"  >book now</a> </td>
		 				<td><a href="guestinfo#hr_body_header">login</a></td>
		 				<td style="padding-left:20px"  > <span style='color:#fff'>/</span> </td>
		 				<td  > <a href="guestinfo#gestinfodivider">Sign up</a></td> 
		 		<?php } ?>  

		 		
	 	</table>  
	 	<form method="get" action="searchroom">
	 		<input  id="menu-search" type="text" placeholder="search rooms" onkeyup ="search_typed('user');" name="search" autocomplete="off" >
	 	</form>
	 	<div  id="menu-search-result-dropdown" >    
	 	</div>  
	 	<div id="menu-search-container-loading" >  
	 		<center>
	 			<img id='menu-search-container-loading-img' src="hr_folders/hr_images/loading 2.gif"  >
	 		</center>
 		</div>
 	</div>  
 </div>  