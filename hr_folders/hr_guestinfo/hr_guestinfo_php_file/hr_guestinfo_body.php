<?php   

		if ( !empty($_POST['estemated_time_arrival']) ) {
			$_SESSION["eta"]  = $_POST['estemated_time_arrival'];   
			$roomNumber = $_SESSION['roomNumberSelected'];  
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
		}else{  
		}






















 

 

		// echo "<br><br><br><br>".$_SESSION["eta"]; 
 
	 	$guestinfoerror = '';  
		$Guest_email = '';
		$Guest_password = '';
		$Guest_Confirm_password='';
		$firstname='';
		$lastname='';
		$middlename=''; 
		$fullname='';
		$Guest_address = ''; 
		$Guest_contact_number = ''; 
		$Company_Group = '';    

 	 	if ( isset($_POST['guestLogin']) ) {
 	 		$guestInfo  = $hr->checkogin( $_POST['email'] , $_POST['password'] , 'guest' ); 
 	 		if ( !empty($guestInfo )) {  
 	 		 	$_SESSION['Guest_id'] 		      = $guestInfo[0]['Guest_id'];  
 	 		 	$_SESSION['gid'] 				  = $guestInfo[0]['Guest_id']; 
 	 		 	$_SESSION['Guest_email']   		  = $guestInfo[0]['Guest_email'];  
 	 		 	$_SESSION['Guest_password']	      = $guestInfo[0]['Guest_password'];   
				$_SESSION['Guest_address']        = $guestInfo[0]['Guest_address'];  
				$_SESSION['Guest_contact_number'] = $guestInfo[0]['Guest_contact_number'];   
				$_SESSION['Company_Group']  	  = $guestInfo[0]['Company_Group'];  
				$_SESSION['Guest_joindate']       = $guestInfo[0]['Guest_joindate'];    
				$mc->go("thankyou#header-logo-nav");  
 	 		}else{ 
 	 		 	$error =  "invalid email or password <br> if don't have an account yet please click <a href='guestinfo#gestinfodivider' >  here </a> ";
 	 		 	$Guest_email =  str_replace(' ','', $_POST['email']);   
 	 		}  
 	 	} else if ( isset( $_POST['signupreservation'] ) ) {   
   			$_SESSION['firstname']	             = (!empty($_POST['firstname']))  		        ? $_POST['firstname'] 	           :'';
		 	$_SESSION['lastname']                = (!empty($_POST['lastname'])) 		 	    ? $_POST['lastname']               :''; 	
		 	$_SESSION['middlename']     	     = (!empty($_POST['middlename'])) 		        ? $_POST['middlename']     	       :'';    
			$_SESSION['Guest_email']	         = (!empty($_POST['Guest_email']))  		    ? $_POST['Guest_email'] 	  	       :'';  
			$_SESSION['Guest_address'] 		     = (!empty($_POST['Guest_address'])) 		    ? $_POST['Guest_address'] 	       :''; 
			$_SESSION['Guest_contact_number']    = (!empty($_POST['Guest_contact_number']))     ? $_POST['Guest_contact_number']   :''; 
			$_SESSION['Company_Group']	         = (!empty($_POST['Company_Group'])) 		    ? $_POST['Company_Group']  	       :'';   
			$_SESSION['Guest_password'] 		 = (!empty($_POST['Guest_password'])) 		    ? $_POST['Guest_password'] 	 	   :''; 
			$_SESSION['Guest_Confirm_password']  = (!empty($_POST['Guest_Confirm_password']))   ? $_POST['Guest_Confirm_password'] :'';  
 			$fullname = $_SESSION['firstname'].' '.$_SESSION['middlename'].' '.$_SESSION['lastname'];  

			# detect errors in the guest info fields.
				$guestinfoerror = ( !empty($_SESSION['Guest_email']) )    		? '' : '( * ) email Required <br>' ;  

				$guestinfoerror.= ( !empty($_SESSION['firstname']) ) 			? '' : '( * ) first name Required <br>' ;
				$guestinfoerror.= ( !empty($_SESSION['lastname']) ) 			? '' : '( * ) last name Required <br>' ;
				$guestinfoerror.= ( !empty($_SESSION['middlename']) ) 			? '' : '( * ) middle name Required <br>'; 

				$guestinfoerror.= ( !empty($_SESSION['Guest_address']) ) 		? '' : '( * ) address Required <br>' ;
				$guestinfoerror.= ( !empty($_SESSION['Guest_contact_number']) ) ? '' : '( * ) contact number Required <br>' ;			



				if (filter_var($_SESSION['Guest_email'], FILTER_VALIDATE_EMAIL)) {   
					$p_acc = selectV1( '*','guest' , array('Guest_email'=>$_SESSION['Guest_email']) );  
					$guestinfoerror.= ( empty($p_acc)) ? '' : '( * ) email Exist <br>' ; 
				}else{  
					$guestinfoerror.= "( * ) email is not valid <br>"; 
				}  
				if (strlen($_SESSION['Guest_password']) < 5 ) {
					$guestinfoerror.= "( * ) password must be minimum of 5 chracter  <br>"; 	
				}else if( $_SESSION['Guest_password'] != $_SESSION['Guest_Confirm_password'] )  {
					$guestinfoerror.= "( * ) password miss match<br>"; 
				} 
 				
			  	$fullname_exist = selectV1( '*','guest' , array( 'fullname'=>$fullname ) );   
			  	$guestinfoerror.= ( empty($fullname_exist)) ? '' : '( * ) full name exist try to change you first name. <br>' ; 
			    

			$firstname = $_SESSION['firstname'];
		 	$lastname = $_SESSION['lastname'] ;
		 	$middlename = $_SESSION['middlename'];
			$Guest_email = $_SESSION['Guest_email']; 
			$Guest_address = $_SESSION['Guest_address'];
			$Guest_contact_number = $_SESSION['Guest_contact_number'];
			$Company_Group = $_SESSION['Company_Group'];
			$Guest_password = $_SESSION['Guest_password'];
			$Guest_Confirm_password = $_SESSION['Guest_Confirm_password'];  
			
		    # insert guest info
			if ( empty($guestinfoerror)) {	 

				if ( empty($_SESSION['gid']) ) {  
					insert( 
					  	'guest',
					  	array('Guest_email','Guest_password', 'fullname' , 'firstname' , 'lastname' , 'middlename' ,'Guest_address','Guest_contact_number','Company_Group','Guest_joindate') ,
					  	array( $Guest_email, $Guest_password  , $fullname , $firstname , $lastname  , $middlename  , $Guest_address ,$Guest_contact_number ,$Company_Group ,date("Y-m-d")) ,
					   	'Guest_id'
					);  
				}      


				$gids =selectV1( 'Guest_id','guest',null , 'order by Guest_id desc' );  

				$gids =  intval($gids[0]['Guest_id']);
				// echo " id = $gids <br>";
				$guestInfo = $hr->get_one_guest_info( $gids ); 
				// print_r($guestInfo);
				$_SESSION['gid'] =   $gids;
				$_SESSION['Guest_id'] 		      = $guestInfo[0]['Guest_id'];  
 	 		 	$_SESSION['gid'] 				  = $guestInfo[0]['Guest_id']; 
 	 		 	$_SESSION['Guest_email']   		  = $guestInfo[0]['Guest_email'];  
 	 		 	$_SESSION['Guest_password']	      = $guestInfo[0]['Guest_password'];   
				$_SESSION['Guest_address']        = $guestInfo[0]['Guest_address'];  
				$_SESSION['Guest_contact_number'] = $guestInfo[0]['Guest_contact_number'];   
				$_SESSION['Company_Group']  	  = $guestInfo[0]['Company_Group'];  
				$_SESSION['Guest_joindate']       = $guestInfo[0]['Guest_joindate'];  
 
			 	$mc->go("thankyou#header-logo-nav");  

			}
 	 	} ?>
 		<center>
			<table border="0" cellspacing="0" cellpadding="0"   > 
				<tr> 
				 	<td id="guestform-header"    > 
				 		 <table border="0" cellspacing="0" cellpadding="0"   > 
				 		 	<tr> 
				 		 		<td> <span1> LOG IN </span1> </td>
				 		 	<tr>
				 		 		<td> <span2> to complete reservation  </span2></td>
				 		 </table>
				 	</td>
				<tr>
				 	<td id="guestform-body"  style="background-color:#fff;   padding-left:20px;padding-right:20px;  "  >  
				 		<form action="guestinfo#header-logo-nav" method="POST" >

			 		 		<?php   
				 				if ( !empty( $error ) ) { 
						 			echo "  
							 			<div style='font-size:12px; border:1px solid red; background-color:#f2d5d6;margin-top:10px; padding:5px; width:99%; text-align:left; color:#eb353e' >
								 				$error 
							 			</div>
						 			";
					 			}
					 	 
			 		 		?>
					 		<table border="0" cellspacing="0" cellpadding="0"  > 
					 	 
					 			<tr>
					 				<td width="430" > 
					 				 	<input type='text'  placeholder='e-mail' name="email"   value="<?php echo $Guest_email; ?>"  style="width:90%;" /> 
					 				</td>
					 			<tr> 
					 				<td> 
					 					<input type='password' placeholder='password'  name="password"  value="<?php echo $Guest_password; ?>"    />
					 				</td>
					 			<tr>
					 				<td>
					 				 	<input type='SUBMIT'  value="LOGIN" name="guestLogin" />
					 	</form> 	 
					 				 	<span style='color:#000' >
						 						or
						 				 	<a href="guestinfo#gestinfodivider" style='text-decoration:none;color:#415e9b' > 
						 				 		sign up 
						 				 	</a>
						 				 	/
						 				 	<a href="forgotpass" style='text-decoration:none;color:#415e9b' > 
						 				 		forgot password
						 				 	</a>


					 				 	</span> 
					 				</td>
					 		</table> 
				 	</td>
			</table>
		</center> 
		<br><br><br><br><br><br><br><br>
		<div id="gestinfodivider" > 
		<br><br><br>
		</div>
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
				 		<form action="guestinfo#gestinfodivider" method="POST" > 
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
						 				<input type='password' placeholder='Password'    name="Guest_password" value="<?php echo $Guest_password; ?>"  /> 
						 			</td>
						 		<tr>
						 			<td> 
						 				<input type='password' placeholder='Confirm Password'    name="Guest_Confirm_password" value="<?php echo $Guest_Confirm_password; ?>"  /> 
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
					 				 	<input type='SUBMIT'  value="sign up" name="signupreservation"  />
					 	</form>
					 					<span style='color:#000' >
						 						or
						 				 	<a href="guestinfo#hr_body_header" style='text-decoration:none;color:#415e9b' > 
						 				 		login
						 				 	</a>
					 				 	</span>
					 				</td>
					 		</table> 
				 	</td>
			</table>
		</center> 
		<br><br><br><br><br><br><br><br> 
	 
	 


 


















