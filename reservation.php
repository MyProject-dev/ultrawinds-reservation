<?php 
   	session_start();
  	require_once ("hr_folders/hr_php_function/connect.php");
	require("hr_folders/hr_php_function/function.php");
	require("hr_folders/hr_php_function/myclass.php");
	$mc = new myclass();
	$hr = new hr(); 
?> 
<!DOCTYPE html> 
	<head> 
		 <?php require ("hr_folders/hr_universal/universal1.php");  ?> 
		<link rel="stylesheet" type="text/css" href="hr_folders/hr_reservation/reservation_style/reservation_style.css"> 
		<script type="text/javascript" src="hr_folders/hr_reservation/reservation_js/reservation_ajax.js" ></script>
		<script type="text/javascript" src="hr_folders/hr_reservation/reservation_js/reservation_jquery.js" ></script>  
	</head> 
	<body>
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
						<?php  //require ("hr_folders/hr_banner/banner1.php");  ?> 
					<!-- </td> -->
				<tr>
					<td id="hr_body_content"    >
						<br><br><br><br>
 						<?php 
 							require ("hr_folders/hr_reservation/reservation_php_file/reservation_body.php");
 						?>
					</td>
                <tr>
                    <td id="hr_body_content"    >
                        <br><br><br><br>

                    </td>
				<tr> 
					<td id="hr_body_footer" > 
						<?php require ("hr_folders/hr_footer/footer1.php"); ?> 
					</td>
			</table>
		</div> 
	</body> 
</html>

