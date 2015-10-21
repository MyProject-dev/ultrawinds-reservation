<?php 
	session_start();
	 




	if ( $_GET['type']=='guest' )   {
		 unset($_SESSION['gid']);
		 header("location:home"); 
	}else{
		 header("location:admin");
	}  

?>