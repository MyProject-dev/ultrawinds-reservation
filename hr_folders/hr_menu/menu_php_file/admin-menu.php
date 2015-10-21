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
 		<table id="menu_table1" border="0" cellpadding="0" cellspacing="0"  > 
		 	<tr>  

		 		<?php   
		 		if ( !empty($_SESSION['pid1']) ) { ?> 
			 		<td> <a title="view room"            href="?a=adminviewrooms#hr_body_content"> view rooms    </a> </td>
			 		<td> <a title="view amenities"            href="?a=adminviewamenities#hr_body_content"> view amenities </a> </td>
			 		<td> <a title="add room"            href="?a=adminuploadroom1#hr_body_content"> add room      </a> </td>
			 		<td> <a title="add amenities"  href="?a=adminuploadamenities1#hr_body_content"> add amenities </a> </td>
			 		<td> <a title="reservation"                      href="admin#hr_body_content"> reservations  </a> </td>
			 		<td> <a title="logout"                                    href="admin-logout"> logout        </a> </td><tr> 
			 		<td><a href=""> log: <b><?php echo $_SESSION['p_name']; ?></b> </a></td>  

			 		<td> <a title="add amenities"   href="?a=additem#hr_body_content"> add Item </a> </td>
			 		<td> <a href="generateReports" target="_blank" > print reports</a> </td>

			 		 

		 		<?php }else{  ?>
		 		<!-- 	<td> <a title=" forgot password"            href="#"> forgot password </a> </td>
		 			<td> <a title="change password  "           href="#"> change password </a> </td> -->
		 			<td> <a href="admin?a=admincreatepersonel"> create new personel account  </a> </td>
					<td> <a href=" admin#header-logo-nav"> login </a> </td> 
		 		<?php } ?>
	 	</table>   
	  		<form method="get" action="admin">
	 			<input  id="menu-search" name='members' type="text" placeholder="search member reservation" onkeyup ="search_typed( 'admin' );" name="search" autocomplete="off" >
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