<?php  
	#set for function hall. :D 
	$function_hall_id = 11; 

	$_SESSION['roomNumberSelected'] = ( !empty( $_POST['roomNumber'] ) ) ? $_POST['roomNumber']  : $_SESSION['roomNumberSelected'];  
	$roomNumber = $_SESSION['roomNumberSelected']; 

	$order = (!empty($_GET['order'])) ? true : false ; 
	if ($order) {  
		if ( !empty($_GET['func']) ){ 
			require("serving_popup.php");
			exit;
		}
	}
	else{  

		unset( $_SESSION['ffood_ordered'] ); 

		$platein =  ( !empty($_POST['platein']) ) ? $_POST['platein'] : false ;    
		$buffet =  ( !empty($_POST['buffet']) ) ? $_POST['buffet'] : false ; 

		$snaks =   ( !empty($_POST['snaks']) ) ? $_POST['snaks'] : false ; 

		$plateinRadio = ( !empty($platein)) ? "checked" : false ;
		$buffetRadio = ( !empty($buffet)) ? "checked" : false ; 

		// echo " buffet $buffet  <br> "; 
		
		$ordered  = (!empty($platein)) ? 1 : 2 ;   
		$_SESSION['snaks'] = $snaks; 

		if ( !empty($platein) ) {  

			if ( !empty($snaks) ) {
				array_push($snaks, $platein ); 
			}
			else{
				$snaks = array(0=>$platein);
			}  

			$_SESSION['ffood_ordered'] = $snaks;   
		}
		else if ( !empty($platein) ) {  
			if ( !empty($snaks) ) {
				array_push($snaks, $buffet);
			}
			else{
				$snaks = array(0=>$buffet);
			} 
			$_SESSION['ffood_ordered'] = $snaks;  
		}
		else{
			// echo " initialized";
		}  
	}    
 	
 	// echo " food ordered <br> ".print_r($_SESSION['ffood_ordered'])."<br>"; 

	if ( !empty($_GET['func']) ) { 

		// echo " you reserved a function hall.."; 

			$roomNumber = array('0'=>intval($function_hall_id)); 
			$_SESSION['roomNumberSelected'] = array('0'=>intval($function_hall_id));  

		$troom = count($roomNumber);  
		if ( !empty($_SESSION['gid']) ) { 				
			echo "<form action='thankyou#header-logo-nav'  method='POST'  onsubmit='return confirm_reservation ( \" \", \"1\" )' >";
			// echo "function hall";
		}else{  
			echo "<form action='guestinfo#header-logo-nav' method='POST' onsubmit='return confirm_reservation ( \" \", \"1\" )'  >";	
			// echo "function hall";
		}     
	} 
	else if ( ( empty( $_SESSION['from'] ) and empty( $_SESSION['to'] ) ) or ( empty($_SESSION['roomNumberSelected']) and empty($_GET['func']) ) ) {  
			echo "<script>alert( 'please select a room first')</script>";
			$mc->go("home"); 	 
	}
	else if ( !empty($_SESSION['gid']) ) { 

		$troom = count($roomNumber);  
		echo "<form action='thankyou#header-logo-nav'  method='POST'  onsubmit='return confirm_reservation ( \"  $troom \", \"2\" )' >";
		// echo " rooms";
	}
	else{  
		$troom = count($roomNumber); 
		echo "<form action='guestinfo#header-logo-nav' method='POST' onsubmit='return confirm_reservation ( \"  $troom \", \"2\" )'  >";	
		// echo " rooms";
	}   


	$from = ( !empty($_SESSION['from'])) ?  $_SESSION['from'] : "" ;
	$to = ( !empty($_SESSION['to'])) ?  $_SESSION['to'] : "" ;   
	$tnight = $_SESSION['tnight'];	 
	$_SESSION['room_total_payable'] = 0; 

	for ($i=0; $i < count($roomNumber) ; $i++) { 
		$rid = $roomNumber[$i]; 
		$roomSubtotal = $hr->get_room_subtotal( $rid , $tnight );  
		$_SESSION['room_total_payable']+=$roomSubtotal;  
	}

	// echo "<br><br><br><br> before date $from to $to <br> "; 
	$from = $hr->date_format( $from  ) ;
	$to = $hr->date_format( $to  ) ;   
	// echo " after date convert $from to $to <br> "; 


?>

















































<center>
	<div style="border:1px solid #000; width:97%; border: 5px solid #415e9b; background-color:#fff; padding-bottom:20px; font-size:13px;" > 
		 
		<div  style='font-size:30px;float:left;padding-left:50px;padding-top:20px;' > Reservation Summary </div> 
		 
		<table border="0" cellpadding=5 cellspacing="0" width="90%" > 
			<tr>
				<td width="120" > Total room reserved: </td> <td>  <?php echo count($roomNumber); ?> </td>
			<tr>
				<td> Check-in Date: </td> <td> <?php  echo $from; ?></td>
			<tr>
				<td> Check-out Date: </td> <td> <?php echo $to;  ?></td>
			<tr>
				<?php if ( empty($_GET['func']) ) { ?>
				<td> Total Price: </td> <td> <?php echo $_SESSION['room_total_payable'] ?> php </td>
				<?php } ?>
			<tr>
				<td> Total night:  </td> <td> <?php echo $tnight; ?></td> 
			<tr> 
				<td> ETA:  </td>	
				<td>  
					<select  id="reservation-room-eta" name="estemated_time_arrival" style="border:none"  >
						<option value="14:00">02:00 PM</option>  
						<option value="15:00">03:00 PM</option>  
						<option value="16:00">04:00 PM</option>  
						<option value="17:00">05:00 PM</option>  
						<option value="18:00">06:00 PM</option>  
						<option value="19:00">07:00 PM</option>  
						<option value="20:00">08:00 PM</option>  
						<option value="21:00">09:00 PM</option>  
						<option value="22:00">10:00 PM</option>  
						<option value="23:00">11:00 PM</option>  
						<option value="12:00">12:00 AM</option>
						<option value="1:00">01:00 AM</option>
						<option value="2:00">02:00 AM</option>
						<option value="3:00">03:00 AM</option>
						<option value="4:00">04:00 AM</option> 
						<option value="5:00">05:00 AM</option> 
						<option value="6:00">06:00 AM</option> 
						<option value="7:00">07:00 AM</option> 
						<option value="8:00">08:00 AM</option> 
						<option value="9:00">09:00 AM</option>  
						<option value="10:00">10:00 AM</option>  
						<option value="11:00">11:00 AM</option>  
						<option value="12:00">12:00 PM</option>  
						<option value="13:00">01:00 PM</option>   
					</select>
				</td>   
			<tr>
			<td></td>
			<td> 
				<div>
					<input id='reservation-submit' type='submit' value='NEXT'  style="padding:20px; background-color:#415e9b;border:none;font-size:20px;font-weight:bold;border-radius:5px;color:#fff;cursor:pointer" /> 
				</div>
			</td>
		</table>
	</div>
	<br><br><br>
</center>  
<?php   
	  
	$K=0;
	for ($i=0; $i < count($roomNumber)  ; $i++) {  

		$K++;
		$rid = $roomNumber[$i];
		$_SESSION['rid'] = $rid; 
		$s = ( !empty($_GET['adminview']) ) ? "display:none" : "" ; 
	    $rnumber = selectV1( '*', 'room', array('Room_id'=>$rid) ); 
	    $Room_number = $rnumber[0]['Room_number']; 
	    $Room_price = $rnumber[0]['Room_price']; 

	    $Room_max_adult =  10; //$rnumber[0]['Room_max_adult']; 
	    $Room_max_child =  10; //$rnumber[0]['Room_max_child'];  

	    $Room_max_people = $rnumber[0]['Room_max_people']; 

	   	$_SESSION['Room_number'] = $Room_number; 
	    $Room_type      = $rnumber[0]['Room_name'];
	    $Room_amenities = $hr->get_all_room_amenities( $rid ); 
		$b = $hr->is_function_hall( $Room_type  , "FUNCTION HALL" );   





	    ?> 
		<center> 
			<div id="reservation-body-container" > 
				<table id="reservation-body-table" border="0" cellpadding="0" cellspacing="0"   >
					<tr>
						<td  id="reservation-body-table-contentheader" > 
							<!-- <hr> -->
							<table border="0" cellpadding="0" cellspacing="0" style="width:100%; " >
								<td width="466" style="padding-left:19px;  "  > <b>  <?php echo "$K . )  $Room_type"; ?> </b> </td>
								<td style="padding-left:24px;" > <b> FILL UP BELLOW </b> </td>
							</table>
						</td>
					<tr>
						<td style="reservation-top-content" > 
					 		<ul id="hr_body_content-ul" > 
						 		<li id="reservation-body-left" >   
						 				<img id="room-img<?php echo "$rid"; ?>" src="hr_folders/hr_images/room/<?php echo "$rid"; ?>.jpg" style='width:400px;'  >   
						 		</li> 
						 		<li id="reservation-body-right" >     
						 			<?php if (!$b) {
						 				 ?>
						 			<table border="0" cellpadding="5" cellspacing="0" width="70%" style="<?php echo "$s"; ?>; font-size:12px; display:" > 
						 				<tr>  
						 					<td width="100"  > 
						 						Room No.:
						 					</td>
						 					<td   > 
						 						<span> 
						 							<?php  echo "$Room_number";  ?>
						 						</span>
						 						<!-- <input type="text" placeholder="Room number 200"          id="reservation-room-number"        name="reservation_room_number"  value="<?php echo "$Room_number"; ?>"   /> -->
						 					</td>
						 				<tr>  
						 					<?php  
						 						$subtotal = $hr->get_room_subtotal( $rid , $tnight ); 
 

						 						echo " 
							 						<td> Room Price: </td> <td>  $Room_price php </td> <tr>  
							 						<td> Subtotal: </td> <td> $subtotal php   </td> <tr>   
							 					";  
  
						 					?>  
						 					<td style="border-bottom:1px solid #000; display:none " >  
						 						From:
						 					</td>
						 					<td style="border-bottom:1px solid #000; display:none" > 
						 						<span> 
						 							<?php  echo "$from";  ?>
						 						</span>
						 						<!-- <input type="text" placeholder="check in date: 12/12/2014" id="reservation-room-checkindate"  name="reservation_room_checkindate" value="<?php echo $from; ?>"  />  -->
						 					</td>
						 				<tr>  
						 					<td style="border-bottom:1px solid #000; display:none"> 
						 						To: 
						 					</td>
						 					<td style="border-bottom:1px solid #000; display:none " > 
						 						<span> 
						 							<?php  echo "$to";  ?>
						 						</span>
						 						<!-- <input type="text" placeholder="check out date: 12/12/2014" id="reservation-room-checkoutdate" name="reservation_room_checkoutdate" value="<?php echo $to; ?>"  />  -->
						 					</td> 
						 					<tr>

												<td style="padding-left:10px;" >  
													Adults
												</td>   
												<td style="padding-left:10px;"  > 
													<select style="padding:10px;" name="Tadults<?php echo $rid; ?>" >
													<?php 
														for ($j=1; $j <= $Room_max_adult ; $j++) { 
															echo "<option> $j </option>";
														} 
													?>
													</select>  
												</td>   
											<tr>  
												<td style="padding-left:10px;" >  
													Children
												</td>  	
												<td style="padding-left:10px;"  >  
													<select style="padding:10px;" name="Tchildren<?php echo $rid; ?>" >
													<?php 
														for ($j=0; $j <= $Room_max_child ; $j++) { 
															echo "<option> $j </option>";
														} 
													?>
													</select>  
												</td>    
						 					</td>
 	
						 					</td>
						 				<tr>  
						 					<td>  
						 						<input id='reservation-submit' type='submit' value='submit' style="display:none"  />   
						 					</td> 
						 			</table>
						 			<?php } else { ?>    
						 				<div style="border:1px solid none; width:400px; height:250px; background-color: none;; padding-top:20px; font-size:12px;" >     
						 					<table border="0" cellpadding="0" cellspacing="0" style="padding-left:5px;" > 
						 						<tr> 
						 							<td style="width:120px;padding:10px 10px 10px 0px"> 
						 								Buffet (Php 250.00) / head
						 							</td>
						 							<td style="width:200px;" >
						 								<input type="radio" name="food_serving_type"  id="buffet"  value="250" onclick="document.location='reservation?func=1&order=1'" <?php echo "$buffetRadio"; ?>   >
						 							</td>
						 						<tr>
						 							<td> 
						 								Plate In (Php 350.00) / head 
						 							</td> 
						 							<td>
						 								<input type="radio" name="food_serving_type"  id="platein"  value="350" onclick="document.location='reservation?func=1&order=2'"  <?php echo "$plateinRadio "; ?> >   
						 							</td>
						 						<tr>
							 						<td>  
														Adults 
													</td>   
													<td > 
														<select style="padding:10px;" name="Tadults<?php echo $rid; ?>" >
														<?php 
															for ($j=20; $j <= $Room_max_adult ; $j++) { 
																echo "<option> $j </option>";
															} 
														?>
														</select>  
													</td>
												</tr>
												<tr>
												<td></td>
												<td><p class="note">Note: Maximum of 5 children only.</p></td>
												</tr>	   
												<tr>  
													<td >  
														Children: 
													</td>  	
													<td  >  
														<select style="padding:10px;" name="Tchildren<?php echo $rid; ?>" >
														<?php 
															for ($j=0; $j <= $Room_max_child ; $j++) { 
																echo "<option> $j </option>";
															} 
														?>
														</select>  
													</td>    
						 					</table>    
						 					<!-- 
						 						Room_max_adult
												Room_max_child
												Room_max_people --> 

						 				</div>
						 			<?php } ?>  
						 		</li> 	
						 	</ul>
					 	</td>
				 	<tr> 
				 		<td  id="reservation-body-table-footerheader" >  
							<table border="0" cellpadding="0" cellspacing="0" style="width:100%; " >
<!--								<td width="466" style="padding-left:19px;"  > <b> ROOM VIEWS </b> </td>-->
<!--								<td style="padding-left:24px;" > <b> AMENITIES </b> </td>-->
							</table>
						</td>
				 	<tr>
				 		<td id="reservation-bottom-content" style="display:none;border:1px solid none; height:auto; padding-bottom:50px;" >
						 	<ul id="hr_body_content-ul" > 
						 		<li id="reservation-body-left-footer" >  
						 			<table> 
						 			 	<tr> 
						 			 		<?php  
						 			 			$rv = $hr->get_room_views( $rid );
						 			 			$c=0;

						 			 				echo " 
						 			 			 		<td>  
									 			 			<img src='$hr->pfolder_room/$rid.jpg' onclick='new_room_view(\"$rid\", \"$rid\" ,\"default\")' > 
									 			 		</td>  
								 			 		";
							 			 	
						 			 			for ($j=0; $j < count($rv) ; $j++) {  
						 			 				$c++;

						 			 					$rdid = $rv[$j]['rdid'];  
								 			 		echo "  
									 			 		<td>  
									 			 			<img src='$hr->pfolder_room_views/$rdid.jpg' onclick='new_room_view(\"$rdid\", \"$rid\" ,\"room-views\")' > 
									 			 		</td>  
								 			 		";
								 			 		if ( $c==5 ) {
								 			 			echo "<tr>";
								 			 		}
							 			 		}
						 			 		?> 
						 			</table> 
						 		</li>
						 		<li id="reservation-body-right-footer">  
						 			<table border='0' cellpadding='0' cellspacing='0'  > 
						 			 	<tr>  
						 			 		<?php  
						 			 			$c=0;
						 			 			for ($j=0; $j < count($Room_amenities) ; $j++) { 

						 			 				$amid = $Room_amenities[$j]['Amenities_id'];

						 			 				$am_info = $hr->get_amenities( $amid );

						 			 				// print_r($am_info);



						 			 					// echo " name = ".$am_info[0]['Amenities_description']."<br>";
						 			 					// echo " name = ".$am_info[0]['Amenities_name']."<br>";

						 			 					$am_desc = $am_info[0]['Amenities_description'];
						 			 					$am_name = $am_info[0]['Amenities_name'];

						 			 				if ( file_exists("$hr->pfolder_amenities/$amid.jpg")  ) {
							 			 				$c++; 
						 			 					echo "  
										 			 		<td>
										 			 			  
											 			 		<img src='$hr->pfolder_amenities/$amid.jpg' onclick='new_room_view(\"$amid\", \"$rid\" ,\"amenities\")' title='$am_name'  /> 	
											 			 					 
										 			 		</td>  
										 			 		

									 			 		"; 
						 			 				} 
								 			 		if ( $c%6==0 ) {
								 			 			echo "<tr>";
								 			 		}
							 			 		}
						 			 		?> 
						 			</table> 
								</li>
							</ul>
						</td>
				</table>
			</div>
		</center><?php 
	} 
?>
	<!-- <div>
		<input id='reservation-submit' type='submit' value='submit'  /> 
	</div> -->
</form> 




 