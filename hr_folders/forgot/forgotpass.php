<?php 
	  
			 

	


		if ( isset( $_POST['submit'])) { 

			$to = $_POST['forgotpass']; 
			$pass = $hr->get_one_guest_password_by_email( $to );

			if ( !empty($pass) ) { 
				
				// echo "<br><br><br><br><br> pass $pass ";
				$subject = "SMC HOTEL RESERVATION - FORGOT PASSWORD";
			
			    $from = "smciligan.edu@gmail.com";  
				$headers  = "From: $from\r\n"; 
			    $headers .= "Content-type: text/html\r\n"; 
			    $body = " Your password is : $pass ";
	   			$sent = mail($to, $subject, $body, $headers); 

	   			if ($sent) {
	   				 echo " <script> 
	   				 	alert('password successfully sent to $to');
	   				 </script> ";
	   			}else{
	   				echo " <script> 
	   				 	alert('password failled sent to $to');
	   				 </script> ";
	   			}
	   		}else{
	   				echo " <script> 
	   				 	alert('email did not exist ');
	   				 </script> ";
	   		}
   		}







?>





<form action="forgotpass" method="POST" >  
<br><br><br><br><br><br><br><br>
	<center>
	<div>  </div>
	<table border='0' cellpadding='5' cellspacing='0' style="font-size:20px; font-family:arial" > 
		<tr>
			<td> Your Email: </td>
			<td><input type='text' value='' placeholder='Your Email' name='forgotpass' style="padding:10px;" /> </td>
			<td><input type='submit' value='send email' name='submit'  style="padding:10px;" /> </td>
	</table>

	</center>
<br><br><br><br><br><br><br><br><br> 
</tr>
</form>

 