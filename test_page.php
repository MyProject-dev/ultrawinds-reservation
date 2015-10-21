<?php 
  	session_start();
  	require_once ("hr_folders/hr_php_function/connect.php");
	require("hr_folders/hr_php_function/function.php");
	require("hr_folders/hr_php_function/myclass.php");
	$mc = new myclass();
	$hr = new hr();


?>






<?php 







 






    function date_difference( ) {
		$date1 = "2014-01-01";
		$date2 = "2014-02-01";






		$diff = abs(strtotime($date2) - strtotime($date1));
		// echo " total days $diff ";
		$years = floor($diff / (365*60*60*24));
		$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
		$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

		printf("%d years, %d months, %d days\n", $years, $months, $days);


		
		$num = cal_days_in_month(CAL_GREGORIAN, 02, 2014); // 31
		echo "There was $num days in August 2003";






		 
	}








	function get_latest_reservation( ) {


		// function
		$rl =  selectV1( '*','reservation_line', '' ,'order by Reservation_line_id desc' ); 
		// print_r($rl); 

		for ($i=0; $i < count($rl) ; $i++) {   

			$Reservation_id = $rl[$i]['Reservation_id'];
			$Room_id = $rl[$i]['Room_id'];

	 		$reservation =  selectV1( 
				'*',
				'reservation',
				array( 'Reservation_id' => $Reservation_id ) 
			);  
	 		$Guest_id = $reservation[0]['Guest_id']; 
			$guesInfo =  selectV1( 
				'*',
				'guest',
				array('Guest_id'=>$Guest_id)
			);   
			$room_info =  selectV1( 
				'*',
				'room',
				array('Room_id'=>$Room_id)
			);  


			// echo " Reservation_id =  $Reservation_id <br>";
			// echo " Guest_id =  $Guest_id <br>";  
			// print_r($guesInfo); 
			$r[$i] = array(
				'reservation_line_info' => $rl , 
				'guest_info' => $guesInfo,
				'reservation_info' => $reservation,
				'room_info'=> $room_info
			);  
		}  

		// main

		for ($i=0; $i < count($r) ; $i++) { 
	
			echo "<BR> GUEST INFO <BR>";
			print_r($r[$i]['guest_info']);
			$guest_info = $r[$i]['guest_info'];
		 	
		 	echo "<br><br><br>";
		 	echo "<BR> RESERVATION INNFO  <BR>";
			print_r($r[$i]['reservation_info']);
			$reservation_info = $r[$i]['reservation_info'];
			
			echo "<br><br><br>";
			echo "<BR> RESERVATION LINE INNFO  <BR>";
			print_r($r[$i]['reservation_line_info']);
			$reservation_line_info = $r[$i]['reservation_line_info']; 
			
			echo "<br><br><br>";
			echo "<BR> ROOM INFO  <BR>";
			print_r($r[$i]['room_info']);
			$room_info = $r[$i]['room_info']; 


						 
			$Reservation_line_id  = $reservation_line_info[$i]['Reservation_line_id'];
			$Reservation_id       = $reservation_line_info[$i]['Reservation_id'];
			$Room_id              = $reservation_line_info[$i]['Room_id'];  
			$ETA                  = $reservation_line_info[$i]['ETA'];  
			$Check_in_date        = $reservation_line_info[$i]['Check_in_date'];  
			$Check_out_date       = $reservation_line_info[$i]['Check_out_date'];  
			$rl_datebooked        = $reservation_line_info[$i]['rl_datebooked'];  

			for ($j=0; $j < count($guest_info); $j++) { 
				$Guest_email          = $guest_info[$j]['Guest_email'];
				$Guest_password       = $guest_info[$j]['Guest_password'];
				$Guest_name           = $guest_info[$j]['Guest_name'];
				$Guest_address        = $guest_info[$j]['Guest_address'];
				$Guest_contact_number = $guest_info[$j]['Guest_contact_number'];
				$Company_Group        = $guest_info[$j]['Company_Group'];
				$Guest_joindate       = $guest_info[$j]['Guest_joindate'];
			} 
			for ($j=0; $j < count($reservation_info); $j++) { 
				$Reservation_id  	  = $reservation_info[$j]['Reservation_id'];
				$Guest_id        	  = $reservation_info[$j]['Guest_id'];
				$Reservation_date 	  = $reservation_info[$j]['Reservation_date'];  
			} 

			 
			for ($j=0; $j < count($room_info); $j++) { 
				$Room_id 			  = $room_info[$j]['Room_id'];
				$Room_number          = $room_info[$j]['Room_number'];
				$room_desc            = $room_info[$j]['room_desc'];  
				$Room_type            = $room_info[$j]['Room_type'];  
			}  




			echo " 
			<h6> Guest Information </h6> 
			Guest_email = $Guest_email <br>
			Guest_password = $Guest_password <br>
			Guest_name = $Guest_name <br>
			Guest_address = $Guest_address <br>
			Guest_contact_number = $Guest_contact_number <br>
			Company_Group = $Company_Group <br>
			Guest_joindate = $Guest_joindate <br>

			<h6> reservation line information </h6>  

			Reservation_id = $Reservation_id <br>
			Room_id = $Room_id <br>
			ETA = $ETA <br>
			Check_in_date = $Check_in_date <br>
			Check_out_date = $Check_out_date <br>
			<h6> reservation info </h6>
			reserved date : $Reservation_date <br>

			<h6> room </h6>
			room number : $Room_number <br>

			";		 

			echo " <hr>";
		}  
	}























	function insert_time( ) {
		$hr = new hr( );

// Full texts	
// Reservation_line_id
// Reservation_id
// Room_id
// ETA
// Check_in_date
// Check_out_date


$eta = "06:00";

$time12 = $hr->convert_hoursformat_24_to_12( $eta );
echo " time 12 hours $time12";
		// insert( 
		//   	'reservation_line' ,
		//   	array( 'ETA' ) ,
		//   	array( '10:0:00' ) ,
		//   	'Reservation_id'
		// );	 


	}
	
	

	function comparedate( ) {
		 // echo " compare dates";
	$check_in_date  = "2013-12-25";
	$check_out_date = "2013-12-26";


		if ( $check_in_date > $check_out_date ) {
			echo " check in date is first than check out date";
		}else{ 
			echo "na bali and check in may na ulahi";
		}
	}

?>




<?php 
	function division( ) {
		 ?>


		 
		 <div> 



		 </div>



		 <script type="text/javascript"></script>
		 <style type="text/css"></style>

		 <?php 
	}

?>

	






<?php 

?>








 

<?php 
	 
		function ladingpage_popUp( ) { 
?>


<?php } ?> 








