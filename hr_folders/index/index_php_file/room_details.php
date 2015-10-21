<?php 
	session_start();
  	require("../../../hr_folders/hr_php_function/connect.php");
	require("../../../hr_folders/hr_php_function/function.php");
	require("../../../hr_folders/hr_php_function/myclass.php");
 
	$mc = new myclass();
	$hr = new hr(); 




 



?>

	<table id="reservation-form-main-table" border="0" cellpadding="0" cellspacing="0"  width="100%" >
	<tr> 
		<td> 
		</td>
	    <td> 
			<center>
		        <table border="1" cellspacing="0" cellpadding="5"  style=" font-size:15px; width:100%"  > 
		            <tr> 
		            	<td style="display:none" > 
		            	<?php  
							$rid = $_GET['rid']; 
							echo " view room details ";
                            $room = selectV1( '*', 'room', array('Room_id'=>$rid) );
                            $available_room = selectV1( 'count(Room_id) as available_room  ', 'reservation_line', array('Room_id'=>$rid) );
                            $Room_number = $room[0]['Room_number'];
						    $Room_amenities = $room[0]['Room_amenities']; 
						    $Room_name      = $room[0]['Room_name'];
						    $room_desc      = $room[0]['room_desc'];
						    $Room_amenities = $room[0]['Room_amenities']; 
						    $Room_price     = $room[0]['Room_price'];
						    $tavailable     = $room[0]['tavailable'];
                            $Room_qty       = $room[0]['qty'];
                            $Room_qty_availble = $available_room[0]['available_room'];
						    $_SESSION['Room_number'] = $Room_number; 
						    $ramids = $hr->room_amenities_convert_array( $Room_amenities );  
						    echo " room info <br> ";
						    // print_r($room);
						    echo " amenities details <br> ";
						    // print_r($room);


                            $qty1 =  $Room_qty - $Room_qty_availble;

		            	?>
		            	</td>
                    <tr>
                        <td width="100" > qty :  </td><td> <?php echo  $qty1; ?> </td>
                    <tr>
                    <tr>
                        <td width="100" > room number :  </td><td> <?php echo $Room_number; ?> </td>
                    <tr>
		                <td> room type: </td><td> <?php echo $Room_name; ?> </td>
		            <tr>
		                <td>  room desc: </td><td> <?php echo  $room_desc; ?> </td>

		                <?php if ( $Room_number != 1 )  { ?>
		            	<tr>
		                	<td>room price per night:  </td><td> <?php echo $Room_price; ?> php </td>
		                <?php } ?>
		            
		        </table> 
		    </center>
	    </td>
	</table> 
