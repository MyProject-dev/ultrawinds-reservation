<?php  
  	session_start();
  	require_once ("hr_folders/hr_php_function/connect.php");
	require("hr_folders/hr_php_function/function.php");
	require("hr_folders/hr_php_function/myclass.php");
	$mc = new myclass();
	$hr = new hr(); 

	$manag_down  = false;
	$totalDescount  = 0; 
	$tpercentage = 100;
	$defaultpercentage = 100;
	$DownPayment = 0 ; 




	$pid = intval($_SESSION['pid1']);
	$rid = $retVal = ( !empty($_GET['rid'])  ) ? intval($_GET['rid']) : 0 ; 
	$personnel_name = $retVal = ( !empty( $_SESSION['p_name'])) ?  $_SESSION['p_name'] : '' ;  
	$reservation = selectV1( '*','reservation', array('Reservation_id'=>$rid) );  
 	$change = 0; 
	$tpayable 		= $reservation[0]['TotalPayable'];   
	$Reservation_id 		= $reservation[0]['Reservation_id'];  
	$tnightreserved =  $hr->get_total_night(  $reservation[0]['Check_in_date'] , $reservation[0]['Check_out_date'] );
	$downpayment    = $reservation[0]['DownPayment'];   
	$Guest_id 				= $reservation[0]['Guest_id']; 
	$In_date_time 				= $reservation[0]['In_date_time'];  



	$Check_in_date 	= $hr->date_format( $reservation[0]['Check_in_date'] );
	$Check_out_date = $hr->date_format( $reservation[0]['Check_out_date'] );
	
  


	$balance = $tpayable - $downpayment; 
	$tchange = $retVal = ($downpayment > $tpayable ) ? $downpayment - $tpayable  : 0 ; 
	$reservation_line = $hr->get_one_reservation_line_info( $rid ); 
	$c=0;  
	$reservation_line_room_name='';  
	for ($i=0; $i < count($reservation_line) ; $i++) {   
		$c++;
		$reservation_line_room_name .= $hr->get_room_name( $reservation_line[$i]['Room_id'] ) ; 

		if ( $c < count($reservation_line) ) {
			$reservation_line_room_name .=' , '; 
		} 
	}   
	$reservation_wakeup_date = ' March , 20 2014';
	$reservation_wakeup_time = ' 5:40 PM';   
 	$today = $hr->date_format( date("Y-m-d") );     
 	if ( isset($_POST['additional_payment'] )) {   
 		$aditional_nanme = $_POST['aditional_nanme'];
 		$aditional_desc = $_POST['aditional_desc'];
 		$aditional_price = $_POST['aditional_price'];  
		insert(
 		 	'invoice', 
 		 	 array('name','reservation_id','description','price'), 
 		 	array( $aditional_nanme , $rid , $aditional_desc , $aditional_price),  
 		 	'inv_id'
 		); 
 	}else{ 
 	} 
 	$invoice_details = selectV1( '*','invoice', array('reservation_id'=>$Reservation_id) );   
 	// add price invoice. 
 	$newBalance = 0;
 	$newTotalpayable = $tpayable;
 	

 	if ( isset( $_POST['paid_now']) ) {   
 		$Tpayable = $_POST['Tpayable'];
 		$Tdownpaid = $_POST['Tdownpaid'];
 		$Money = $_POST['Money']; 
		if ( $Money >= $Tpayable ) { 		
			$change = $Money - $Tpayable;
	 		$hr->save_invoice_payment( $rid , $Tpayable , $Money , $change );
	 		$hr->update_reservation_status( intval($rid) , 3 ); 
	 		$manag_add_ang_additional_payable = true; 
		}else{
			echo "<script> alert('please enter the full payment of the reservation') </script>";
			$manag_add_ang_additional_payable = false; 
		} 
   	}







 	$invoice_info  = $hr->get_invoice_info( $rid ); 


 	$accomodation_id = $hr->get_accomodation_by_reservation_id( $rid );

 	if ( !empty( $accomodation_id ))  {
 		
		$accomodation_line = $hr->get_accomodation( $accomodation_id );  
 	}
 	
 	// print_r($invoice_info);

 	$newBalance = $newTotalpayable - $downpayment;  
 	if ( isset($_POST['checkout_print']) ) {
 		$manag_add_ang_additional_payable = true;	 
 	}else if ( isset( $_POST['go_dashboard']) ) {
 		echo " <script> document.location='admin?bookingNumber=$rid&search_by_booking_number=GO#view' </script>";

 	}else if ( !empty($invoice_info)  )  { 


   		




   			$total=0;
   		 	$Money =0;
   			$change = $invoice_info[0]['Money_change'];
   			$Money += $downpayment ;
   			$Money += $invoice_info[0]['Money'];
   			$newBalance = 0;  

   		 	if ( !empty($accomodation_line )) {
   		 		for ($i=0; $i < count($accomodation_line) ; $i++) {  
	   				$subtotal  = $accomodation_line[$i]['subtotal'];  
				 	// $total+=$subtotal;  
				}   
				
				$newTotalpayable+=$total; 



   		 	}   

   		 	// echo " money $Money"; 
   		 	if ( $Money > $downpayment  ) {
   		 		$manag_add_ang_additional_payable = true;  
   		 	}else{
   		 		$manag_add_ang_additional_payable = false; 
   		 	}





 





















			// echo " already paid"; 
    }else if ( $downpayment >= $newTotalpayable ){ 
    	$newBalance = 0;
    	$change =   $newTotalpayable  - $downpayment  ;
		$change = $change * (-1);

    	$manag_add_ang_additional_payable = true; 
    	$Money = $downpayment ;
 
    	$hr->save_invoice_payment( $rid , $newTotalpayable , $Money , $change );
    	$hr->update_reservation_status( intval($rid) , 2 ); 
   	}else{ 
   		 	// echo " not yet paid ";
		  
 			$manag_add_ang_additional_payable = false;	 
 			$total = 0;
 			$Money = $downpayment ; 

 			if ( !empty( $accomodation_id))  {
				for ($i=0; $i < count($accomodation_line) ; $i++) {  
					$subtotal  = $accomodation_line[$i]['subtotal'];  
				 	// $total+=$subtotal;  
				}    
				$newTotalpayable+=$total;
				$newBalance = $newTotalpayable - $downpayment; 
			}
   	}




// if discount found chage the payable
 	$discount = 0;
 	$invoice = selectV1( '*','invoice', array('reservation_id'=>$rid) );  
 	$discount = $invoice[0]['discount'];  

 	if ( !empty($discount) ) { 	 
	 	$d1 = $discount * 0.01; 
		$totalDescount = $tpayable*$d1; 
	 	// echo " discount $discount d1 = $d1 discount = $totalDescount <br>";  
	 	$tpercentage = 100 - $discount;  
	 	$tpayable -= $totalDescount;  
	 	$fiftyPercent = $tpayable * 0.5;  
	 	$balance = $tpayable - $downpayment;  
 	}



































 	 	
	 	$guestInfo = $hr-> get_guest_info( $Guest_id );

	 	$fullname = $guestInfo[0]['fullname'];



// $newTotalpayable;
// $downpayment;
// $newBalance;
// $Money
// $change






	echo "   
		<br><br> 
		<table border='0' cellspacing='0' cellpadding='10' style='width:1000px;border:1px solid none;margin: auto;' >
			<tr>
				<td style='border-bottom:1px solid #000;' > 
					<table border='0' cellspacing='0' cellpadding='0' style='width:100%' > 
						<tr>
							<td style='width:40%;'> 
								<center> 
								 	<img src='hr_folders/hr_images/logo/logo3.png' style='height:100px;width:100px' />
								</center>
							</td> 
							<td>  
								<div style='text-align:center;border:1px solid #none;width:50%;'>
								 	<span style='font-size:30px; font-weight:bold' >
										 St. Michael's COllege
									</span> 
									<br>
									 <span style='font-size:15px; font-weight:bold; '  >
										Quezon Ave. Iligan  City
									</span>
									<br>
									<span style='font-size:15px; font-weight:bold; '  >
										Telephone Number: 222-3831
									</span> 
								</div>
							</td> 
					</table> 
					<table border='0' cellspacing='0' cellpadding='0' style='width:100%' > 
						<tr> 
							<td> 
								 Payment
							</td> 
							<td style='text-align:right'> 
								OR No. N0000$Reservation_id
							</td> 
					</table>  
				</td> 
			<tr>
				<td style='border-bottom:1px solid #000;'  >  
					<table border='0' cellspacing='0' cellpadding='0' style='width:100%;'  >   
						<tr>
							<td width='180px;' > 
								Full Name: 
							</td> 
							<td>
								$fullname 
							</td> 
							<td style='text-align:right'>
								Date: $today
							</td>  

					</table>  
				</td> 
			<tr>
				<td style='border-bottom:1px solid #000;'  >  
					<table border='0' cellspacing='0' cellpadding='0' style='width:100%'  >  
						<tr>
							<td width='180px;' >  </td>   
							<td> ";   
								$c=0;
								for ($i=0; $i < count($reservation_line) ; $i++) {  

									$c++;
									$roomName  = $hr->get_room_name( $reservation_line[$i]['Room_id'] ) ;   
									$Reservation_id = $reservation_line[$i]['Reservation_id'] ; 
									$subtotal 		= $reservation_line[$i]['subtotal'];
									$Tadults 		= $reservation_line[$i]['Tadults'];
									$Tchildren 		= $reservation_line[$i]['Tchildren'];  
									$serving_price  = $reservation_line[$i]['serving_price'];   

 									$Room_price  = $hr->get_room_price( $reservation_line[$i]['Room_id'] ) ;
 									$totalPerson = $Tadults+$Tchildren; 

									$b = $hr->is_function_hall( $roomName , "FUNCTION HALL" );  
									if ($b) {   

										$ctime = date("H:i:s"); 
										// $ctime = '20:00:00';  
										$serving_name = $hr->get_function_hall_servings_name( $serving_price , 250 );   
										$food_serving = $hr->get_menu_selected( $rid );   

										// echo "  additional_Functionhall_payable = $fap "; 
									}else{
										// echo " not function hall in date time $In_date_time <br>";
									} 

									echo "  
									<table border='0' width='100%' > 
										<tr>	
											<td>  <b> $roomName </b>   </td> 
										<tr>
											<td> $Tadults adult/s </td> <tr>
											<td> $Tchildren child/s </td> <tr>
											<td> $tnightreserved night/s  </td>  <tr> 
											<td> $Check_in_date check in date  </td>  <tr> 
											<td> $Check_out_date check out date  </td>  <tr>  
											";  
											if ($b)	{ 
												echo "  
													<td> Food Served $serving_name ( PHP ".number_format($serving_price)." per head  ) x $totalPerson <div style='float:right'> PHP ".number_format($subtotal)." </div> </td> <tr>"; 
														$c=0;
														for ($j=0; $j < count($food_serving) ; $j++) { 
															$c++;
															$maid = $food_serving[$j]['maid']; 
															$food_info = $hr->get_menu_info( $maid  ); 

															$price = $food_info[0]['price'];
															$ma_name = $food_info[0]['ma_name'];
															$ma_desc = $food_info[0]['ma_desc'];     

															if ( !empty($price)) {
																$snakTotalPayable = $hr->get_snak_tota_payable( $price , $totalPerson );
																echo "  
																	<td>  
																	 	$ma_name x $totalPerson 
																	 	<div style='float:right'> PHP ".number_format($snakTotalPayable)." </div>
																	</td>   <tr>
																"; 
															}else{
																echo "  
																	<td>  
																	 	$ma_name 
																	</td>   <tr>
																"; 
															} 
														} 
													echo "  
													<td> reservation inclusive for 4 hours </td>  <tr> 
												";  
											}else{
												echo "<td>  ".number_format($Room_price)." / night x $tnightreserved  <div style='float:right'> PHP ".number_format($subtotal)." </div> </td>  <tr> ";	
											}  

									echo "  
									</table>  
									";   
									// echo "  
									// <table border='0' width='100%' > 
									// 	<tr>	
									// 		<td>   $roomName <div style='float:right'> PHP ".number_format($subtotal)." </div>  </td> 
									// 	<tr>
									// 		<td> $Tadults adults </td> <tr>
									// 		<td> $Tchildren child </td> <tr>
									// 		<td> $tnightreserved nights </td>  
											 
									// </table>  
									// ";  
								}    

							echo "  
							</td> 
							<tr> 
							"; 
						 	if ( !empty( $accomodation_id))  {
						 		echo " <td> </td> <td> <b> ACCOMODATION: </b> </td> <tr><td></td> ";
								$total = 0;
								for ($i=0; $i < count($accomodation_line) ; $i++) {  

								 	$accommodation_line_id  = $accomodation_line[$i]['accommodation_line_id'];
								 	$item_id        		= $accomodation_line[$i]['item_id'];
								 	$item_quantity  		= $accomodation_line[$i]['item_quantity'];
								 	$acc_subtotal           = $accomodation_line[$i]['subtotal']; 
								 	$item_name 				= $hr->get_item_name( $item_id );
								 	$item_desc 				= $hr->get_item_desc( $item_id );
								 	$item_price			    = $hr->get_item_price( $item_id );  
								 	echo "   
										<td> $item_quantity $item_name  php $item_price <div style='float:right' > PHP ".number_format($acc_subtotal)."  </div> </td> <tr>
										<td> </td> 
								 	";  
								 	$newTotalpayable+=$acc_subtotal;
								}     
							} 
							$newBalance = $newTotalpayable - $Money; 
						echo "  
					</table> 
				</td> 
			<tr>
				<td> 
					 <table  border='0' cellspacing='0' cellpadding='0' style='width:auto;float:right;text-align:right'  > 
					 	<tr>";  
					 		$newBalance -= $totalDescount;   
				 			if (  $discount > 0 ) {
					 			echo "   
					 				<td> Total Amount of Discount ( $discount% ) : PHP ".number_format($totalDescount)."     </td> <tr> 
					 		 	"; 	 
					 		} 
				 			echo "  
				 			<td> Total Amount of Reservation ( $tpercentage% ) : PHP ".number_format($tpayable)."     </td> <tr>"; 
				 		 	// echo " <td> Total Amount of Reservation ( 100% ) : PHP ".number_format($newTotalpayable)."   </td> <tr>
				 		 	// "; 
 							echo "  
					 		<td> Total Paid : PHP ".number_format($downpayment)."    </td> <tr>  ";

					 		if ( $newBalance > 0 ) {
					 			echo " 
						 			<td> Total Balance   : PHP ".number_format($newBalance)."   <br><br> </td> <tr>  
						 		";
					 		}
					 		else {
					 			echo " <td> <br>  </td> <tr>";
						 		}
					 		echo "  
					 		<td> Total Money    : PHP ".number_format($Money)." </td> <tr>   
					 		<td> Total Change    : PHP ".number_format($change)." </td> <tr>   
					 		<td> <br><br><br>  Processed by: <br>  <u> $personnel_name   </u></td>  
					</table>   
				</td> 
			"; 
			if ( $manag_add_ang_additional_payable == false ) { 
				echo "  
					<form action='checkout?rid=$rid' method='POST' > 
						<tr>
							<td  style='border-top:1px solid #000;'  > 
								 <table  border='0' cellspacing='0' cellpadding='2' style='width:100%;float:right;text-align:left;float:left'  > 
								 	<tr> 
										<td> 
								 			<table  border='0' cellspacing='0' cellpadding='2' style='width:auto;float:right;text-align:left' > 
									    		<td> </td> <td> Pay Now</td>  <tr>
										 		<td> Money </td> <td> <input type='text' value='' name='Money' />  </td> <tr>  

										 		<td style='display:none' > Tpayable </td> <td style='display:none' > <input type='text' value='$newBalance' name='Tpayable' />  </td> <tr>  
										 		<td style='display:none' > Tdownpaid </td> <td style='display:none' > <input type='text' value='$downpayment' name='Tdownpaid' />  </td> <tr>  

										 		<td> </td> <td> <input type='submit' value='save' name='paid_now' /><input type='submit' value='print' name='checkout_print' />  <input type='submit' value='back' name='go_dashboard' /></td> 
											</table>
										</td>  
								</table>  
							</td>    
					</form>  
				";	  
			}else{
				echo "  
					<script type='text/javascript'>  
					var b = confirm('do you want to print reciet ?'); 
					if ( b ) {
						 window.print();
					}else{
						document.location='admin?bookingNumber=$rid&search_by_booking_number=GO#view';
					} 
					</script> 
				";
			} 
		echo " 
		</table> 
		<br><br>  
	";   
?>
















