<?php 

		/**
		*  thursday dec 26 , 2013 12 am 
		*/ 
		class indexbody extends indexbodyextend {  
			public function retrieve_available_rooms_by_popup_search( $from , $to ) { 
				$dateservedroom = array();
 
				$time = $this->time( 'yesterday' );
				// echo " yesterday is $time <br>";
			 	$reservations = $this->get_uptodate_reservations( $time ); 
			 	// echo " from $from - to $to <br><br>"; 
				// print_r($reservations);
 
			 	$room_not_available = array();
			 	$c=0;
			 	$counter=0;
				for ($i=0; $i < count($reservations) ; $i++) { 
					$c++;
					// echo "$c .)"; 
					// echo "check in date ".$reservations[$i]['Check_in_date'].'<br>';
					// echo "check out date ".$reservations[$i]['Check_out_date'].'<br>';  

					$reserved_check_in_date  = $reservations[$i]['Check_in_date'];
					$reserved_check_out_date =  $reservations[$i]['Check_out_date']; 
					$reservation_id 		 =  $reservations[$i]['Reservation_id']; 
 
					// echo " reservation id $reservation_id <br>"; 

					$reservation_line = selectV1(
						'*', 
						"reservation_line", 
						array(
							"Reservation_id"=>$reservation_id 
						)
					);  
					// print_r($reservation_line); 


					// echo "total reservation lines ".count($reservation_line);

					for ($j=0; $j < count($reservation_line)  ; $j++) { 
					 
						$Room_id =  $reservation_line[$j]['Room_id']; 
						$search_check_in_date    = $from;
						$search_check_out_date   = $to;


	 					// echo " reservation line room id $Room_id <br>";
                        /*
						$a = $search_check_in_date; 
						$b = $search_check_out_date;  
						$c = $reserved_check_in_date; 
						$d = $reserved_check_out_date;   

						if( (($a >= $c ) and ( $a < $d ))  or (($b > $c ) and ( $b <= $d ))       )   {
							// echo " room number $Room_id already reserved search inside time reservation ";
							$room_not_available[$counter] = $Room_id;   	
						}else if ( (($c >= $a ) and ( $c < $b )) or (($d > $a ) and ( $d <= $b ))  )   { 
							// echo " room number $Room_id already reserved outside search reservation ";
							$room_not_available[$counter] = $Room_id;  
						} else {
							// echo " room is available for the the search time";
						}   
						$counter++;     
                        */
					}  
				}  
				// echo " already reserved rooms on the searched dates <br>";
				// print_r($room_not_available);

				if ( !empty($room_not_available)) {
					// echo "room not available <br>"; 
					// print_r($room_not_available);
				}else{
					// echo " all room is available <br>";
				} 
				/* 
				if ($from >= "2014-01-15" and $from <= "2014-01-16" ) {
					echo " room already reserved <br>";
				}else{
					echo " room is not already reserved <br>";
				}
				*/ 
				// $reservations_len = count($reservations);
				// $c=0;
				// for ($i=0; $i < $reservations_len ; $i++) { 
				// 	$c++;
				// 	$dateservedroom[$i] = $reservations[$i]["Room_id"];
				// }   
				return $room_not_available; 
			}
			public function retrieve_all_rooms( $type=null) {

				$r = array();
				$room = selectV1(
					'*',
					"room", 
					"", 
					"order by Room_id desc" 
				);  
				// selectV1($select='*', $tableName=null, $where=null,$orderby=null,$limit=null,$search=null) 


				if ( !empty($type) ) {
					$room_len = count($room); 
				    for ($i=0; $i < $room_len ; $i++) {
				    	$r[$i] = $room[$i][$type];
				    }
					return $r;	
				}else{ 
					return $room; 
				} 
			}
			public function retrieve_single_room( $Room_id ) {
				$r = array();
				$room = selectV1(
					'*',
					"room",
					array( "Room_id"=>$Room_id ) 
				);  
				return $room;
			}
			public function change_index_to_counting_numbers( $ra ) {
				$i=0;
				$ra1 = array();
			    foreach ($ra as $key => $value ) { 
			    	// echo "$key => $value <br>"; 
			    	$ra1[$i] = $value;
			    	$i++; 
			    }
			    return $ra1;
			} 
		} 
		class  indexbodyextend {  
			public function time( $get ) {
				if ( $get=='yesterday' ) {
					 $time = date("Y-m-d", time() - 86400);
				}else if( $get=='today' ){
					$time = date("Y-m-d");
				}else if( $get=='tomorrow' ) {
					$time = date("Y-m-d", time() + 86400);
				}
				return $time;
			}
			public function get_uptodate_reservations( $time ) {  
				$uptodateReservation = array();
				$tablename = 'reservation';
				$rowname = 'Check_in_date'; 

				// $Q = "SELECT * FROM reservation_line WHERE  Check_in_date > '$time' ";  
				

					// echo "<br><br><br>";
				// get above date
				 
					// echo " check in date searched $time <br>";
					$Q = "SELECT * FROM  reservation WHERE Check_in_date  > '$time' and status != 2 "; 
					$q = mysql_query($Q);   
					$c=0; 
					while ( $r = mysql_fetch_array($q) ) { 
						foreach ($r as $key => $value) {
							 // echo "$key => $value <br>";
							 $uptodateReservation[$c][$key] = $value;
						}
						$c++;
					} 
					// return $uptodateReservation; 
					// print_r($uptodateReservation);
				// get room from above date reservation 
					/* 
				for ($i=0; $i < count($uptodateReservation) ; $i++) { 
					$reservation_id = $uptodateReservation[$i]['Reservation_id'];
					$Check_in_date = $uptodateReservation[$i]['Check_in_date'];
					 echo "reservation id = $reservation_id  check in date $Check_in_date <br>";
				}
				*/





				return $uptodateReservation;

				// $Q = "SELECT * FROM $tablename WHERE  $rowname > '$time' "; 
				// $q = mysql_query($Q);   
				// $c=0; 
				// while ( $r = mysql_fetch_array($q) ) { 
				// 	foreach ($r as $key => $value) {
				// 		 // echo "$key => $value <br>";
				// 		 $uptodateReservation[$c][$key] = $value;
				// 	}
				// 	$c++;
				// } 
				// return $uptodateReservation;










			} 
		}   
		$ib = new indexbody();  
		if ( !empty($_GET['search'] )) {
			#field search
			$indexhome_action = "field search";
			$search = $_GET['search'];
			$room = selectV1(
				'*',
				"room",
				null,
				null,
				null,
				array(
					"rowName"=>"Room_name",
					"keySearch"=>$search
				)
			);  
			$troom = count($room);  
			// echo "via seach ";
		}else if ( isset($_POST['popup-search']) ){  

			$from  = $mc->convert_textdateformat_to_dbdateformat ( $_POST['from'] );  
			$today = $ib->time( 'today' );  
			// echo "<br><Br><Br><br><br><br><br><br> from $from today $today <br>"; 

			if ( !empty($_POST['from']) and !empty($_POST['to']) ) { 

				if ( $from < $today ) { 
					$errorMessage =  "<h2>
						<center> <span style='color:red' > <h3> Check in and  check out dates <br>    must be up to date<br> <a href='home' style='color:red' >  Please Try Again </a> </h3> </span> </center>
					</h2>";
					$troom = 0;   
				} else if ( $_POST['from'] != $_POST['to'] ) {

					#popup seach
					$indexhome_action = "popup search"; 
					$troom = 0;     
					$errorMessage = '';

					$_SESSION['tadults']   = $_POST['tadults'];
					$_SESSION['tchildren'] = $_POST['tchildren']; 

					// echo " 
					// 	<br><br><br><br><br> 
					// 	adults = $_SESSION[tadults] 
					// 	children = $_SESSION[tchildren] 
					// ";  


					// if ( ) {
						 
					// } else 





					if ( $_POST['from'] != $_POST['to']) { 
						$from  = $mc->convert_textdateformat_to_dbdateformat ( $_POST['from'] ); 
				 		$to    = $mc->convert_textdateformat_to_dbdateformat ( $_POST['to'] );   
				 		$_SESSION['from'] = $from;
						$_SESSION['to']   = $to;    
						$_SESSION['from1'] = $from;
						$_SESSION['to1']   = $to;    

					 	$rr    = $ib->retrieve_available_rooms_by_popup_search( $from , $to );  
					    $room  = $ib->retrieve_all_rooms( "Room_id" );   
					    $rooms_available = array_diff($room, $rr); // remove existing reserved rooms in the current covered search date.
					    $ra = $ib->change_index_to_counting_numbers( $rooms_available );  
					    $troom = count($ra);   
					 	//    echo "<br><br><br><br><br>";
					 	//    echo "  
						//   from  $_SESSION[from1] to $_SESSION[to1] <br>
						// "; 




					}else{
						$errorMessage =  "<h2>
						<center> <span style='color:red' > <h3> Searched Date Is Invalid. <br> <a href='home' style='color:red' >  Please Try Again </a> </h3> </span> </center>
						</h2>";
					}  
					$_SESSION['tnight']  = $hr->get_total_night( $from , $to );  
				}else{
					$troom = 0;	
				}
			}else{ 
				$troom = 0;
			}
			
		}else{ 
			#home initialized 
			$indexhome_action = "home initialize";
			// echo " initialize";   
			$search=null; 
			$room = $ib->retrieve_all_rooms( null ); 
			$troom = count($room); 
			// $troom = 0; 
		}    

		 

		// echo "<br><br><br><br> total night = ".$_SESSION['tnight'];

		 // ;


	



	?>    
	<br><br>   
	<!-- this is the search!  -->
	<?php 
		if ( !empty($from )  and !empty($to) )   { 
			echo " 
				<div style='border:1px solid none; padding:20px; background-color: #ccc; width:970px; color:#000; font-family:arial' > 	  ";
					$from1 = $hr->date_format( $from );
					$to1 = $hr->date_format( $to ); 
					$tdays = $hr->get_total_night( $from , $to );  
					$reservation_coverage = " 
						<b> Check-in Date:</b> $to1 <br> 
						<b> Check-out Date:</b> $from1 <br>
						<b> Total Day/s: </b> $tdays Day/s 
					";    
					//echo " $reservation_coverage";
				echo "  
			</div>
			"; 
		} 
	?>
	<form action="reservation" method="POST" >
		<table id='hr_body_content-table' border="0" cellpadding="0" cellspacing="0" >  
			<?php  

           // echo $troom;
				if ( $troom > 0) {
					$rnum = 0;  
					unset($_SESSION['roomNumberSelected']); 
					$_SESSION['roomNumberSelected']='';
					for ($i=0; $i < count($ra) ; $i++) {


						if ( $indexhome_action == "popup search" ) {
							// echo " popup search ";
						 	$Room_id = $ra[$i];
						 	// echo " room idssss = $Room_id <br><br><br><br> ";
						 	$room    =  $ib->retrieve_single_room( $Room_id );  
						 	$rnum = $room[0]['Room_id'];
							$room_desc = $room[0]['room_desc'];
                            $Room_name = $room[0]['Room_name'];
                            $Room_qty  = $room[0]['qty'];
							$room_title = " This is the delux room !  ";
						}else{ 
							$rnum = $room[$i]['Room_id'];
							$room_desc = $room[$i]['room_desc'];
							$Room_name = $room[$i]['Room_name'];
                            $Room_qty  = $room[0]['qty'];
                            $room_title = " This is the delux room !  ";
						}


                        $available_room = selectV1( 'count(Room_id) as available_room  ', 'reservation_line', array('Room_id'=>$rnum) );
                        $Room_qty_availble = $available_room[0]['available_room'];
                        $qty1 =  $Room_qty - $Room_qty_availble;

                      //  echo "$qty1 =  $Room_qty - $Room_qty_availble; <br>";
                        $b = $hr->is_function_hall( $Room_name  , "FUNCTION HALL" );

						if ($b) {
							// echo " this is function hall<br>";
						}else{ 
							// echo " this is not function hall<br> ";
						}











						?>
						<tr>  
							<td>  
								<div id="line_separator">  </div>
								<ul> 
									<li id='body-room'>    
										<div id="room_img"> 
											<!-- <a href="reservation.php?rnum=<?php echo "$rnum"; ?>&#header-logo-nav"> -->
												<img   src="hr_folders/hr_images/room/<?php echo "$rnum"; ?>.jpg">
											<!-- </a>  -->
										</div>  
									</li>
									<li id='body-desc' > 
										<span id="room_title" > <?php echo $Room_name ; ?>  </span>
										<br><br>
										<div>
											<span id="room_desc" > <?php echo $room_desc ; ?> </span> 
										</div>
										<div>
											<input type='button' value="view details" style=" padding:8px; font-weight:bold;"     onclick="view_room_details_poup( '<?php echo $rnum; ?>' )">  
										</div>
										<?php







                                        if ( ( !empty($_POST['from']) and !empty($_POST['to']) )    ) {
										 		
									 		if (  $hr->is_function_hall( $Room_name , "function hall" )  ) {  ?>
												
												<!-- <div> 
													<input type="checkbox" name="roomNumber[]" value='<?php echo $rnum; ?>' >
													<span style='font-size:13px;' >
														Check to select this room
													</span>
												</div> --> 



													<a href="reservation?func=1">
														<input type="button" value="book now" id="booknow_submit" style="padding:9px; margin-left: 2px;  background-color:#415e9b;border:none;font-size:12px;font-weight:bold;border-radius:2px;color:#fff;width:92px;cursor:pointer" /> 
													</a>



												<?php 
											}else if (  $qty1  > 0) { ?>


												<div> 
													<input type="checkbox" name="roomNumber[]" value='<?php echo $rnum; ?>' >
													<span style='font-size:13px;' >
														Check to select this room
													</span>
												</div>

												<?php 
											}
										}  

										?>
									</li>   
								</ul>  
							</td>
						<tr><?php  
					} 
				}else if ( !empty($errorMessage) ) {
					echo " $errorMessage";
					$style = 'height:290px';
				}else if ( !empty($from) and !empty( $to )) { 
					echo "<center> <br><br> <span style='color:red' > <h2>No Room available for<br> for $from  to $to <br><a href='home' style='color:red'>  Please Try Again .</a>  </h2> </span> </center>";
					$style = 'height:290px'; 
				}else{
					echo "<center> <br><br> <span style='color:red' > <h2>No Room Are available <br> <a href='home' style='color:red' >  Please Try Again </a> </h2> </span> </center>";
					$style = 'height:290px'; 
				} 
			?> 
			<td style="padding-right:20px; "> 
				<div style="<?php echo $style ?>"  >  
					 <?php  if ( (!empty($_POST['from']) and !empty($_POST['to']) and $troom > 0 )  )  {  ?>
				 		<input type="submit" value="Next" id="booknow_submit" style="padding:20px; margin-left:20px;background-color:#415e9b;border:none;font-size:20px;font-weight:bold;border-radius:5px;color:#fff;width:98%;cursor:pointer" /> 
				 	<?php }  ?>
				</div> 
			</td>
		</table> 
	</form>