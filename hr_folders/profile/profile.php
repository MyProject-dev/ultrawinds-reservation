<?php  
	if (empty($_SESSION['gid'])) {
		$mc->go("home"); 
	}

 	$gid = $_SESSION['gid'];

	$guest = $hr->get_guest_info( $gid ); 






	$guestinfoerror 		= '';  
	$Guest_email 			=  $guest[0]['Guest_email'];  

	$fullname 				=  $guest[0]['fullname']; 

	$firstname 				=  $guest[0]['firstname']; 
	$lastname 				=  $guest[0]['lastname']; 
	$middlename 			=  $guest[0]['middlename'];  

	
	$Guest_address 			=  $guest[0]['Guest_address']; 
	$Guest_contact_number 	=  $guest[0]['Guest_contact_number']; 
	$Company_Group	 		=  $guest[0]['Company_Group'];    

 


	if ( isset($_POST['Update']) ) {  

		$p_acc = selectV1( '*','guest' , array('Guest_email'=>$Guest_email) );  

		$Guest_email 			= $_POST['Guest_email'];
		$fullname 				= $_POST['fullname'];
		$firstname 				= $_POST['firstname'];
		$lastname 				= $_POST['lastname'];
		$middlename 			= $_POST['middlename'];
		$Guest_address  		= $_POST['Guest_address'];
		$Guest_contact_number   = $_POST['Guest_contact_number'];
		$Company_Group 			= $_POST['Company_Group'];    
		updateArray(
		 	'guest', 
		 	array('Guest_email','fullname','firstname','lastname','middlename','Guest_address','Guest_contact_number','Company_Group'),
		 	array( $Guest_email,$fullname,$firstname,$lastname,$middlename,$Guest_address,$Guest_contact_number,$Company_Group),
		 	'Guest_id',
		 	$gid
		);    
	} 
 
?>
	<form action="guestprofile" method="POST" > 
	 	<center>
			<table border="0" cellspacing="0" cellpadding="0"  id="guestInfoSignUp" > 
				<tr> 
				 	<td id="guestform-header"    > 
				 		 <table border="0" cellspacing="0" cellpadding="0"   >
				 		 	<tr> 
				 		 		<td> <span1>SIGN UP </span1> </td>
				 		 	<tr>
				 		 		<td> <span2>Fill Up Guest Info to complete reservation    </span2></td>
				 		 </table>
				 	</td>
				<tr>
				 	<td id="guestform-body"  style="background-color:#fff; padding-left:20px;padding-right:20px;"  >  
				 		
				 			<?php 
				 				if ( !empty( $guestinfoerror ) ) {  
						 			echo "  
							 			<div style='font-size:12px; border:1px solid red; background-color:#f2d5d6;margin-top:10px; padding:5px; width:99%; text-align:left; color:#eb353e' >
								 				$guestinfoerror 
							 			</div>
						 			";
					 			}
					 		?>  	 			 
					 		<table border="0" cellspacing="0" cellpadding="0"  > 
					 			<tr> 
					 				<td>  
					 					<table border="0" cellspacing="0" cellpadding="0" style="padding:0; margin-left:-10px; width:745px " > 
					 						<tr> 	
					 							<td> 
					 								<input type='text'  placeholder='First Name' name="firstname"    value="<?php echo $firstname; ?>" /> 
					 							</td> 
					 							<td> 
					 								<input type='text'  placeholder='Last Name'  name="lastname"     value="<?php echo $lastname; ?>" /> 
					 							</td>
					 							<td> 
					 								<input type='text'  placeholder='Middle Name'  name="middlename"     value="<?php echo $middlename; ?>" /> 
					 							</td>
					 					</table> 
					 				</td> 
					 			<tr>
					 				<td> 
					 				 	<input type='text' placeholder='E-mail'      name="Guest_email"  value="<?php echo $Guest_email; ?>"  />
					 				</td> 
						 		<tr>
					 				<td> 
					 					<input type='text' placeholder='Address'    name="Guest_address" value="<?php echo $Guest_address; ?>"  /> 
					 				
					 				</td> 
					 			<tr>
					 				<td> 
					 				 	<input type='text' placeholder='Company group ( OPTIONAL )' name="Company_Group" value="<?php echo $Company_Group; ?>"   />
					 				</td>
					 			<tr>
					 				<td>
					 				 	<input type='text' placeholder='Contact number'  name="Guest_contact_number" value="<?php echo $Guest_contact_number; ?>"  />
					 				</td>
					 			<tr>
					 				<td>
					 				 	<!-- <input type='SUBMIT'  value="Update" name="signupreservation"  /> -->
					 	
					 					 
					 				 	</span>
					 				</td>
					 		</table> 

				 	</td>
			</table>
		</center> 
	</form>