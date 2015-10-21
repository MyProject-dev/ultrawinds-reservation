<?php
  	session_start();
  	require_once ("hr_folders/hr_php_function/connect.php");
	require("hr_folders/hr_php_function/function.php");
	require("hr_folders/hr_php_function/myclass.php");
	$mc = new myclass();
	$hr = new hr();

	// $mc->connect( "smc_hotel_online_reservation" , "root" );  
	// print_r($room);
	// echo "total room ".count($room)."<br>"; 
	/* 
		1.) references : http://www.thelalit.com/the-lalit-new-delhi/rooms-overview
		2.) 
	*/    

?>  
<!DOCTYPE html>
	<head>  
		<?php require ("hr_folders/hr_universal/universal1.php");  ?>
		<link rel="stylesheet" type="text/css" href="hr_folders/guestInit/guestInit.css"> 
		<script type="text/javascript" src="hr_folders/index/index_js/index_jquery.js" ></script>  
 
	</head> 
	<body onload="home_initialize()" >
		<?php require ("hr_folders/hr_menu/menu_php_file/menu.php") ?>

		<div id="hr_wrapper"> 
			<table id="hr_wrapper_table" border="0" cellpadding="0" cellspacing="0"> 
				<tr>  		
					<td id="hr_body_header" >  
						<?php 
							// require ("hr_folders/hr_header/header_php_file/header1.php"); 

						?> 
					</td>
				<tr>
					<!-- <td id="hr_body_banner" > -->
						<?php //require ("hr_folders/hr_banner/banner1.php");  ?> 
					<!-- </td> -->
				<tr>
					<td id="hr_body_content" >  
						<br><br> 
 						<?php  
 							require ("hr_folders/hr_contact/contact_us.php"); 
 						?>
 						
					</td>
				<tr> 
					<td id="hr_body_footer" > 
						<?php require ("hr_folders/hr_footer/footer1.php"); ?> 
					</td>
	 
			</table>
		</div> 
	</body> 
</html>