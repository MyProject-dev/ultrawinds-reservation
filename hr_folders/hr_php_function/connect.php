<?php 
	date_default_timezone_set('America/Los_Angeles');   
    error_reporting(0);
    $dbName = "ultrawinds";
    $con = mysql_connect("localhost","root","") or die(mysql_error()); //laptop
    if ( $con  )  {
        // echo " connected to localhost <br>";
    }
    else {
        // echo " not connected to localhost <br>";
    }


	$dbConn = mysql_select_db($dbName) or die("No Connection.. "); //fs
 	if ( $dbConn ) {
 		// echo "connected to $dbName <br> ";
 	}
 	else {
 		// echo "not connected to $dbName <br> ";
 	}

?>



<?php


















