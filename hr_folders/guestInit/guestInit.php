
 
 <script type="text/javascript">
    $(function() {
        $( "#from" ).datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1, 
            onClose: function( selectedDate ) {
                $( "#to" ).datepicker( "option", "minDate", selectedDate );
            }
         
        });
        $( "#to" ).datepicker({ 
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                $( "#from" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
    }); 
    $(document).ready(function ( ) {  
    })  
    </script>  
<form action="searchroom#header-logo-nav" method="POST" id="search-form"  >
	<div id="initContainer" >  
			<div id="search-reservation-c" >  
	 			<table border="0" cellpadding="0" cellspacing="0" >
	 				<tr> 
	 					<td> 
	 						<table border="0" cellpadding="0" cellspacing="0" > 
								<tr>
									<td>  
										Check-In-Date
									</td>   
									<td>  
										Check-Out-Date
									</td>  
								<tr>
									<td>  
										<input type="text" style=" padding:5px;" id="from" name="from"  autocomplete='off' />
									</td>   
									<td>  
										<input type="text" style=" padding:5px;" id="to" name="to"  autocomplete='off' />
									</td>   
							</table>  
	 					</td>
	 				<tr>
	 					<td> 
	 						<center>
		 						<table border="0" cellpadding="0" cellspacing="0" style="display:none" > 
									<tr > 
										<td style="padding-left:10px;" >  
											Adults
										</td>   
										<td style="padding-left:10px;" >  
											Children
										</td>   
									<tr> 
										<td style="padding-left:10px;"  > 
											<select style="padding:10px;" name="tadults" >
											<?php 
												for ($i=1; $i < 10 ; $i++) { 
													echo "<option> $i </option>";
												} 
											?>
											</select>  
										</td>   
										<td style="padding-left:10px;"  >  
											<select style="padding:10px;" name="tchildren" >
											<?php 
												for ($i=0; $i < 10 ; $i++) { 
													echo "<option> $i </option>";
												} 
											?>
											</select>  
										</td>    
								</table>
							</center>  
	 					</td>
	 				<tr>
	 					<td style="padding-top:10px"> 
	 						<input type='submit' name="popup-search" style="float:right; border:none; padding:20px;cursor:pointer" value="search room" />
	 					</td>
	 			</table> 
			</div> 
			<img src="hr_folders/hr_images/banner/1.jpg" width="100%;" /> 
	</div>
</form>