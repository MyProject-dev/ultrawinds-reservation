<?php 
 	session_start();
  	require("hr_folders/hr_php_function/connect.php");
	require("hr_folders/hr_php_function/function.php");
	require("hr_folders/hr_php_function/myclass.php");  
	$hr = new hr();   
	$pageAfterDelete = $_GET['pageAfterDelete'];
	$id = $_GET['id'];  
			$hr->delete_reservation( $id );
			$hr->delete_reservation_line( $id );
		 
	 


?>

<script type="text/javascript">
	document.location="<?php echo $pageAfterDelete; ?>";
</script>
 