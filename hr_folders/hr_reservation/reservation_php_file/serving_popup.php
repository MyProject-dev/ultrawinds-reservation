
	<div id="popup-select-serving-menu" > 
		
		<?php if ( $_GET['order'] == 1 ) { ?>
			<!-- order 1 -->
			<form action="reservation?func=1" method="POST" >
				<br>
				<center>
				 	<div>
						Select your menu ( buffet )
					</div>
				</center>
				<div id="c" > 
					<center>
						<br>  
							<table  border="0" cellpadding="1" cellspacing="0"  > 
								<tr>
									<?php 
 
										$buffet = $hr->get_buffet_menus ( 1 );  
										// print_r($buffet);
										$c=0; 
										for ($i=0; $i < count($buffet) ; $i++) { 
											$maid = $buffet[$i]['maid'];
											$ma_name = $buffet[$i]['ma_name'];
											$ma_desc = $buffet[$i]['ma_desc']; 
										$c++;     
											echo "
												<td>
													<table border='0' cellspacing='5' cellpadding='0' > 
														<tr>
															<td> <img src='hr_folders/hr_images/functionhall/menus/$maid.jpg '  style='width:200px; height:200px;' >  </td> <tr>
															<td>  <input type='radio' value='$maid' name='buffet' ><b> $ma_name </b> <br> $ma_desc   </td>  
													</table> 
												</td> 
												";
												
										if ( $c%4==0 ) {
											echo "<tr>";
										}
										else{}  
									} ?>
							</table>
							<h1> SNACKS </h1> 
							<table  border="0" cellpadding="1" cellspacing="0" width="200px;"  > 
								<tr>
									<?php 
										$platein = $hr->get_plateIn_menus ( 3 ); 
										$c=0;   
										for ($i=0; $i < count($platein) ; $i++) { 
											$maid = $platein[$i]['maid'];
											$ma_name = $platein[$i]['ma_name'];
											$ma_desc = $platein[$i]['ma_desc']; 
										 	$c++;
											echo "
												<td>
													<table border='0' cellspacing='5' cellpadding='0' > 
														<tr>
															<td> <img src='hr_folders/hr_images/functionhall/menus/$maid.jpg '  style='width:200px; height:200px;' >  </td> <tr>
															<td>  <input type='radio' value='$maid' name='snaks[]' ><b> $ma_name </b> <br> $ma_desc   </td>  
													</table> 
												</td> 
												"; 
										if ( $c%4==0 ) {
											echo "<tr>";
										} 
									} ?>
							</table> 
						
						<br><br>
					</center> 
					<input type="submit" value="ORDER" name="order" style="margin-left:80px; padding:10px; color:#fff; background-color: #415e9b; cursor:pointer" />
					<br>
				</div>
			</form>
		<?php } else if (  $_GET['order'] == 2 ) {  ?> 

			<!-- order 2  -->
			<form action="reservation?func=1" method="POST" >
				<br>
				<center>
				 	<div>
						Select your menu ( plate in )
					</div>
				</center>
				<div id="c" > 
					<center>
						<br>  


							<table  border="0" cellpadding="1" cellspacing="0"  > 
								<tr>
									<?php 
										$platein = $hr->get_plateIn_menus ( 2 ); 
										$c=0;   
										for ($i=0; $i < count($platein) ; $i++) { 
											$maid = $platein[$i]['maid'];
											$ma_name = $platein[$i]['ma_name'];
											$ma_desc = $platein[$i]['ma_desc']; 
										 	$c++;
											echo "
												<td>
													<table border='0' cellspacing='5' cellpadding='0' > 
														<tr>
															<td> <img src='hr_folders/hr_images/functionhall/menus/$maid.jpg '  style='width:200px; height:200px;' >  </td> <tr>
															<td>  <input type='radio' value='$maid' name='platein' ><b> $ma_name </b> <br> $ma_desc   </td>  
													</table> 
												</td> 
												"; 
										if ( $c%4==0 ) {
											echo "<tr>";
										} 
									} ?>
							</table> 


							<h1> SNACKS </h1> 
							<table  border="0" cellpadding="1" cellspacing="0" width="200px;"  > 
								<tr>
									<?php 
										$platein = $hr->get_plateIn_menus ( 3 ); 
										$c=0;   
										for ($i=0; $i < count($platein) ; $i++) { 
											$maid = $platein[$i]['maid'];
											$ma_name = $platein[$i]['ma_name'];
											$ma_desc = $platein[$i]['ma_desc']; 
										 	$c++;
											echo "
												<td>
													<table border='0' cellspacing='5' cellpadding='0' > 
														<tr>
															<td> <img src='hr_folders/hr_images/functionhall/menus/$maid.jpg '  style='width:200px; height:200px;' >  </td> <tr>
															<td>  <input type='radio' value='$maid' name='snaks[]' ><b> $ma_name </b> <br> $ma_desc   </td>  
													</table> 
												</td> 
												"; 
										if ( $c%4==0 ) {
											echo "<tr>";
										} 
									} ?>
							</table> 




						<br> 
					</center>  
					<input type="submit" value="ORDER" name="order" style="margin-left:80px; padding:10px; color:#fff; background-color: #415e9b;cursor:pointer" />
					<br>
				</div>
			</form>
		<?php } ?> 
	</div>  
	


<style type="text/css">  	
	 #c { 
	 	 overflow:auto; 
	 	 height:500px; 
	 }
	#popup-select-serving-menu {  
		/*overflow: auto;*/
		margin-top: -21px;
		/*border: 1px solid #000; */
		position: fixed; 
		width: 1010px; 
		height: 100%;
		background-color: #fff;
		display: block; 
	}	  
</style>








