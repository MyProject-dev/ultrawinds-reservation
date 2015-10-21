<?php 	
	#set eta 
		// $hr->set_eta( );

	
	if (empty($_SESSION['gid'])) {
		// $mc->go("home"); 
	}
	 

	if ( !empty($_POST['estemated_time_arrival']) ) {
		  $_SESSION["eta"]  = 	$_POST['estemated_time_arrival'];    
	}   
	$eta = $retVal = ( !empty($_SESSION["eta"])) ? $_SESSION["eta"] : '0' ;



































	#from reservation
		$room_number  				      =   (!empty($_SESSION['Room_number']))  ? $_SESSION['Room_number']  : 0 ;   
	#transfer to session the total child and adults
		$roomNumber = ( !empty($_SESSION['roomNumberSelected']) ) ? $_SESSION['roomNumberSelected'] : 0  ;
		if ( !empty($_POST['estemated_time_arrival']) ) {
	 		for ($i=0; $i < count($roomNumber) ; $i++) { 
	 			$Room_id  = $roomNumber[$i];  
			   	$_SESSION["Tadults$Room_id"]   =  $_POST["Tadults$Room_id"];
		       	$_SESSION["Tchildren$Room_id"] =  $_POST["Tchildren$Room_id"]; 
		       	// echo " total child for room $Room_id = total child  = ".$_POST["Tchildren$Room_id"].' total adults '.$_POST["Tadults$Room_id"]."<br>";  
		       	$b = $hr->is_function_hall_id_number( $Room_id , 11 );  
		       	if ($b) {
		       		$_SESSION['food_serving_type'] = 	$_POST['food_serving_type'];
		       		// echo " with function hall ";
		       	}else{
		       		// echo " no function hall";
		       	}   
	 		} 
 		} 

	#from guest info
		// $eta            				  = (!empty($_SESSION['estenated_time_arrival'])           ) ? $_SESSION['estenated_time_arrival']        : "" ; 
		$rid 							  = (!empty($_SESSION['rid'] )                             ) ? $_SESSION['rid'] : "" ; 			
	# from guest info
		$email 		   = $_SESSION['Guest_email'];
		$password      = $_SESSION['Guest_password']; 
		$address       = $_SESSION['Guest_address'];
		$contactnumber = $_SESSION['Guest_contact_number']; 
		$companygroup  = $_SESSION['Company_Group'];   
		$latest_guid   = $_SESSION['gid'];   
	# change format of the time to insert the database.  
		$time12 = $hr->convert_hoursformat_24_to_12( "$eta" );     
 	#check if reservation already inserted.  
		
	  	$sortAs = (!empty($_GET['sorting'])) ? $_GET['sorting'] : "LATEST RESERVATION"; 
	 	$sortNow = $hr->set_sorting_reservation_query( $sortAs );  































 ?> 
<br><br><br> 
<span id='view' > </span> 
<center>
	<table id="thankyou-body-table" border="0" cellpadding="0" cellspacing="0"  > 
		<tr>  
			<td id="thankyou-body-table-header" style="display:none" >
				<form action="thankyou#view"  method="GET" >
					<select name="sorting" style="font-size:11px"  > 
						<option>LATEST RESERVATION</option>
						<option>OLDEST RESERVATION</option>
						<option>NEAREST CHECK IN DATE</option>
						<option>FAREST CHECK IN DATE DATE</option> 
					</select>
					<input type="submit" value="SORT" style="font-size:11px" >
					<span><b> Sort by</b>  <?php  echo " [ $sortAs ] "; ?></span>
				</form> 
			</td> 
		<tr>   
			<td id="thankyou-body-table-body" > 
				<ul> 
					<table border="0" cellspacing="0" cellpadding="0"> 
						<?php    

			    			// $from  					          =   (!empty($_SESSION['from1']))         ? $_SESSION['from1']         : 0 ; 
						    // $to 					   	      =   (!empty($_SESSION['to']))           ? $_SESSION['to']           : 0 ;   
						    // $eta 							  =   $eta;     
                			// echo " inside class check in date $from and check out date  $to eta  $eta";  
							

							if (  !empty($eta) ) {
								$hr->insert_reservation_and_reservation_line( $_SESSION['from1']  , $_SESSION['to1'] , $eta );  	 
							  
							}else{
								// echo "eta is empty";
							} 

							// $eta = $_SESSION["eta$rid"];
							// $time12 = $hr->convert_hoursformat_24_to_12( "$eta" );    
							// $roomInfo = selectV1( '*','', array('Room_id'=>$rid ) );  



							// delete expire reservation
						    $reservation = $hr->get_reservation( $latest_guid , $sortNow ); 
							for ($i=0; $i < count($reservation) ;  $i++) {    
								$rid 		   	    = $reservation[$i]['Reservation_id'];  
								$Reservation_date 	= $reservation[$i]['Reservation_date'];   
								$status 	        = $reservation[$i]['status'];   
					 			$hr->delete_expired_reservation( $rid , intval($status) , $Reservation_date , date('Y-m-d') ); 
					 		} 

					 		 $reservation = $hr->get_reservation( $latest_guid , $sortNow );
 

							for ($i=0; $i < count($reservation) ;  $i++) {   

								$rid 			= $reservation[$i]['Reservation_id']; 
								$pid  			= $reservation[$i]['pid']; 

								$Check_in_date  = $hr->date_format( $reservation[$i]['Check_in_date']);  
								$Check_out_date = $hr->date_format( $reservation[$i]['Check_out_date']);  
								$TotalPayable   = $reservation[$i]['TotalPayable']; 
								$DownPayment 	= $reservation[$i]['DownPayment'];   
								$bookingNumber 	= $rid;   
								$reservation_status = $hr->get_reservaion_status( $rid );   
								$food_serving = $hr->get_menu_selected( $rid ); 





								$Balance = $TotalPayable - $DownPayment; 
								$rETA			= $hr->convert_hoursformat_24_to_12($reservation[$i]['rETA']);   



								// if ( $hr->is_checked_out( $rid )  ) {
								// 	$status = "<span style='color:#00FFFF' >checked out</span>";
								// }else{
								// 	$status         = ( !empty($DownPayment) ) ?"<span style='color:yellow' > Confirmed </span> ":" <span style='color:#b6bcb5' > Please pay 50% or above of this reservation to confirm</span>";	
								// } 


								
								$status 		  = $reservation[$i]['status'];  
					 			if ($status == 0 ) { 
					 				$status = "<span style='color:#f49d9d' > pending </span>";
								}else if ($status == 1 ) {  
									$status = "<span style='color:#6de359' > Confirmed</span>";
								}else if ($status == 2 ) {  
									$status = "<span style='color:#eaf127' > Stay</span>";
								}else if ($status == 3 ) {  
									$status = "<span style='color:#00FFFF' > Checked Out</span>";
								}













								$tnight = $hr->get_total_night( $Check_in_date , $Check_out_date );  
								if (  $pid > 0 ) {
									$p_info = $hr->get_personel_info( $pid );  
										$p_email = $p_info[0]['p_email'];
										$p_name  = $p_info[0]['p_name'];    	
								}else{
									$p_name = "<span style='color:#fff;font-weight:bold'>pending</span>";
								}  
								
								// get total reservation accomodation 

								$taccomodation = $hr->get_my_total_accomodation( $rid );
								$Balance += $taccomodation;	
								$TotalPayable+=$taccomodation;


                        $total_services_payable  = 0;
                        $response123 = selectV1('*', 'other_services_details', array('reservation_id' => $rid));
                        for($l123=0; $l123<count($response123); $l123++) {
                            $reservation1 = selectV1('*', 'other_services', array('id' => $response123[$l123]['other_services_id']));
                            $select_amenities .= 'Name: ' . $reservation1[0]['name'] . ' Price ' . $reservation1[0]['price'] . '<br>';

                            $total_services_payable += $reservation1[0]['price'];

                        }

                        $TotalPayable += $total_services_payable;
                        $DownPayment = $TotalPayable/2;
                        echo "
									<td style='background-color:#415e9b;color:#fff; font-size:12px; width:100%; padding:10px' >  
										<table border='0' cellpadding='0' cellspacing='0' width='100%' >
											<td width='40%' > 
												<table border='0'cellpadding='0' cellspacing='0' >
													<tr> 
														<td style='width:150px' > Check in Date: </td><td>  $Check_in_date  </td> <tr>
														<td> Check out Date: </td><td>  $Check_out_date  </td> <tr>
														<td> Estimated Time Arrival: </td><td>  $rETA  </td>  <tr>  
													 	<td> Total Night</td>  <td>$tnight</td>     <tr> 
													 	<td> Total Payable : </td><td>  $TotalPayable  PHP </td> <tr>
													 	<td> DownPayment : </td><td>  $DownPayment  PHP </td> <tr>
												</table>
											<td> 
											<td> 
												<table border='0' cellspacing='0' cellpadding='0' > 
													<tr> 
														<td> Balance : </td><td>  $Balance  PHP + $total_services_payable PHP </td> <tr>
														<td> Booking Number : </td><td>  $bookingNumber  </td> <tr> ";


														if ( $reservation_status == 0 )  {
															echo "
																<td>";
//                        echo " <p style='background-color: #f00; color: #fff; font-size: 11px; font-weight: 10;'>Note: Reservation will automatically be cancelled after 3 days<br>  (from the day of reservation processed) if no down/full payment recieved.</p>";

																	echo " <input type='button' value='cancel reservation' style='background-color:red; padding:2px' onclick='delete_reservation ( \"$rid\", \"thankyou\" )'  >.
																</td>
															";
														}
														echo "   
												</table>
											</td>
										</table>
									<td>  
								</td> <tr>"; 
								$reservation_line = $hr->get_reservation_line_by_rerservation_id( $rid , null );



								for ($j=0; $j < count($reservation_line) ; $j++) {  

									$rlid 			= $reservation_line[$j]['Reservation_line_id']; 
									$Reservation_id = $reservation_line[$j]['Reservation_id'] ;
									$rid 			= $reservation_line[$j]['Room_id'];
									$subtotal 		= $reservation_line[$j]['subtotal'];
									$Tadults 		= $reservation_line[$j]['Tadults'];
									$Tchildren 		= $reservation_line[$j]['Tchildren']; 
									$Tchildren 		= $reservation_line[$j]['Tchildren'];  
									$serving_price  = $reservation_line[$j]['serving_price']; 
									
									$eta = $hr->convert_hoursformat_24_to_12( "$eta" );    
									$roomInfo = $hr->get_room_info( $rid );   
										$Room_number 		= $roomInfo[0]['Room_number'];
										$room_desc 			= $roomInfo[0]['room_desc'];
										$Room_name 			= $roomInfo[0]['Room_name'];
										$Room_price 		= $roomInfo[0]['Room_price']; 
										$Room_dateuploaded 	= $roomInfo[0]['Room_dateuploaded'];



									?>
									<td style="border-bottom:1px solid #000;" > 
										<li style="width:210px" >  
											<img  src="hr_folders/hr_images/room/<?php echo $rid; ?>.jpg" style='width:200px' >   
										</li>
										<li style="width:670px"  > 
										<?php  
											echo " 
												<table border='0' cellpadding='0' cellspacing='0' style='font-size:12px;' > 
													<tr> 
														<td width='100px' >Room Name </td><td>    $Room_name   </td>
													<tr>
														<td>Room Desc </td><td> $room_desc </td>
													<tr> 
													";


													if ( empty($serving_price) ) {
														echo "   
															<td>Room Price </td><td>  $Room_price  php </td>
														<tr>
														";
													}  
  

													echo "  
														<td>Room Sub total </td><td>  $subtotal  php </td>
													<tr> 
														<td>Total Adults </td><td>  $Tadults   </td>
													<tr> 
														<td>Total CHildren </td><td>  $Tchildren  </td>
													<tr> "; 

													if ( !empty($serving_price) ) {
														if ( $serving_price == 250 ) { 
															$serving = 'Buffete ( P 250.00 )';
														} else { 
															$serving = 'Plate In ( P 350.00 )';
														} 
														echo "   
															<td>Food Serving </td><td>  $serving  </td>
														<tr> "; 	 
														echo " <td> </td> <td>  
																<table border='0' cellspacing='0' cellpadding='0' > 
																	<tr> " ;

																	$c=0;
																	for ($j=0; $j < count($food_serving) ; $j++) { 
																		$c++;
																		$maid = $food_serving[$j]['maid']; 
																		$food_info = $hr->get_menu_info( $maid  ); 

																		$ma_name = $food_info[0]['ma_name'];
																		$ma_desc = $food_info[0]['ma_desc'];


																		echo " 
																			<td> 
																				<table> 
																					<tr> 
																						<td> 
																							<img src='hr_folders/hr_images/functionhall/menus/$maid.jpg '  style='width:100px; height:100px;' >  
																						</td> 
																					<tr>
																						<td> 
																							<b> $ma_name </b> <br>

																						 	$ma_desc
																						</td> 
																				</table>
																				
																			</td> 
																		";
																		if ( $c%4==0 ) {
																			echo "<tr>";
																		}

																	} 
																echo "  
																</table> 

														</td> ";
													}
													echo "   	 
												</table>
											";

//                                        echo "rid = $Reservation_id <br>";
//                        echo "<pre>";

                                        $select_amenities  = '';
                                        $response123 = selectV1('*', 'other_services_details', array('reservation_id' => $Reservation_id));

//                                        print_r(  $response123);

                                        for($l123=0; $l123<count($response123); $l123++) {
                                            $reservation1 = selectV1('*', 'other_services', array('id' => $response123[$l123]['other_services_id']));
                                            $select_amenities .= 'Name: ' . $reservation1[0]['name'] . ' Price ' . $reservation1[0]['price'] . '<br>';
                                        }


                                        ?>



                                            <H3> Other amenities selected </H3>

                                            <?php echo $select_amenities; ?>

                                                <H3> Select Amenities </H3>
                                                <form  action="add_services.php"  method="POST" >
                                                    <ul>
                                                        <li> <input type="hidden"     name="reservation_id"   value="<?php echo $Reservation_id; ?>" > </li>
                                                        <li> <input type="checkbox" name="other_services[]" value="1" > Projector 1,499<br>  </li>
                                                        <li> <input type="checkbox" name="other_services[]" value="2" > Karaoke 449<br>  </li>
                                                        <li> <input type="checkbox" name="other_services[]" value="3" > Horse Back Riding 200<br>  </li>
                                                        <li> <input type="checkbox" name="other_services[]" value="4" > Day Cottages 499<br>  </li>
                                                        <li> <input type="checkbox" name="other_services[]" value="5" > Shuttle Service Roundtrip 899<br>  </li>
                                                        <li> <input type="checkbox" name="other_services[]" value="6" > Shuttle Drop Only 499<br>  </li>
                                                        <li> <input type="checkbox" name="other_services[]" value="7" > Toyota Super Grandia Van Round Trip 1,499<br>  </li>
                                                        <li> <input type="submit"   value="add" /> </li>
                                                    </ul>
                                                </form>
										</li>
									</td>
									<tr><?php 
								}
							}
						?>  
					</table>
				</ul> 
			</td>
		<tr>  
			<td id="thankyou-body-table-footer" >  
			</td>
	</table>
</center>
 

	
