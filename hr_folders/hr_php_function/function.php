<?php

	# Date: Jan, 25, 2009
	# Created by: Jesus Erwin Suarez 
	# version 1.0.0

	#mysql

	function connect($db,$host,$user,$pass) {

		$con=mysql_connect($host,$user,$pass) or die(mysql_error());;
		if ($con) {
			// echo "connected<br>";
		} else { 
			// echo " not connected<br>";
		}
		mysql_select_db($db)or die (mysql_error()); 
	}
	function select($tableName,$tablen,$where=null,$orderby=null,$limit=null) {
		$key=0;
		$res=array();

		if (!empty($orderby) and !empty($limit)) { 
			// echo "order by and limit is not empty $orderby and $limit[0] = $limit[1] <br>";
			
			if (!empty($where[3])) {
				echo "2 where and int";
			  	$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] = $where[1] and $where[2] = $where[3] $orderby limit $limit[0] ,$limit[1] "); #int 
			}
			else if(is_string($where[1]) ){
				$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] = '$where[1]' $orderby limit $limit[0] ,$limit[1] "); #string
			}else { 
				$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] = $where[1]  $orderby limit $limit[0] ,$limit[1] "); #int
			}





		}else if(empty($where) and !empty($orderby) ){ 
			$Q=@mysql_query("SELECT * FROM $tableName $orderby");
		}else {

			// echo "order by and limit is empty $orderby and $limit<br>";
			if (!empty($where)) {
				if(is_string($where[1]) ){
					$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] = '$where[1]' ");
				}else { 
					$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] = $where[1] ");
				}
			}else{
				$Q=@mysql_query("SELECT * FROM $tableName");
			}
		}
		if (!empty($Q)) {		
			while ($db=mysql_fetch_array($Q)) { 
				for ($i=0; $i < $tablen; $i++) { 
					$res[$key][$i]=$db[$i];
				}
				$key++;
			}
			if (!empty($res)) {
				return $res;	
			}else{
				return 0;
			} 
		}else { 

			// echo "query is empty at line 56 function file";
		}
	}
	function select_w_2($tableName,$tablen,$where,$oparators){
		$key=0;
		$res=array();
			if (is_string($where[1]) and is_string($where[3]) ) {
				$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] = '$where[1]' $oparators $where[2] = '$where[3]' ");
			}
			else if( is_int($where[1]) and is_int($where[3]) ) { 
				$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] = $where[1] $oparators $where[2] = $where[3] ");
			}else if ( is_int($where[1]) and is_string($where[3]) ){ 
				$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] = $where[1] $oparators $where[2] = '$where[3]' ");
			}
			if(!empty($Q)){ 
				while ($db=mysql_fetch_array($Q)) { 
					for ($i=0; $i < $tablen; $i++) { 
						$res[$key][$i]=$db[$i];
					}
					$key++;
				}
				if (!empty($res)) {
					return $res;	
				}else{
					return 0;
				}
			} 
		}
			
	function select1_wop($tableName,$tablen,$where,$oparators,$orderby=null){
		$key=0;
		$res=array();
			if (is_string($where[1]) and !empty($orderby))  {
				$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] $oparators '$where[1]' $orderby  ");
			}
			else if (is_int($where[1]) and !empty($orderby))  {
				$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] $oparators '$where[1]' $orderby  ");
			}
			else if (is_string($where[1]) and empty($orderby))  {
				$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] $oparators '$where[1]'") ;
			}			
			else if(is_int($where[1]) ) { 
				$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] $oparators  $where[1] ");
			}
			//if(!empty($Q)){ 
			if (!empty($Q)) {
				while ($db=mysql_fetch_array($Q)) { 
					for ($i=0; $i < $tablen; $i++) { 
						$res[$key][$i]=$db[$i];
					}
					$key++;
				}
				if (!empty($res)) {
					return $res;	
				}else{
					return 0;
				}
			}
			else { 
				echo "query is empty at line 166 function";
			} 
		}
	function select2_wop($tableName,$tablen,$where,$oparators3,$orderby=null){
		$key=0;
		$res=array();
			if (is_int($where[1]) and is_string($where[3]) ) {
				// echo "int and string";
				// print_r($oparators3);
				$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] $oparators3[0]  $where[1]   $oparators3[1] $where[2] $oparators3[2] '$where[3]' ");
			}
			else if(is_string($where[1]) and is_string($where[3])) { 
				$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] $oparators3[0]  '$where[1]' $oparators3[1] $where[2] $oparators3[2] '$where[3]' ");
			}			
			else if(is_int($where[1]) and is_int($where[3])) { 
				$Q=@mysql_query("SELECT * FROM $tableName WHERE $where[0] $oparators3[0]   $where[1]  $oparators3[1] $where[2] $oparators3[2]  $where[3] ");
			}
			if(!empty($Q)){ 
				while ($db=mysql_fetch_array($Q)) { 
					for ($i=0; $i < $tablen; $i++) { 
						$res[$key][$i]=$db[$i];
					}
					$key++;
				}
				if (!empty($res)) {
					return $res;	
				}else{
					return 0;
				}
			} 
		}
 








 	function delete($table_name,$where) {

 		if (count($where) == 4) {
			if (is_string($where[1]) and is_string($where[3]) ) {
	 			$q=@mysql_query("DELETE FROM $table_name WHERE $where[0] = '$where[1]' and $where[2] = '$where[3]' " );
	 		} 
	 		else {
	 			$q=@mysql_query("DELETE FROM $table_name WHERE $where[0] = $where[1] and $where[2] = $where[3] " );
	 		} 			 
 		}
 		else { 
	 		if (is_string($where[1])) {
	 			$q=@mysql_query("DELETE FROM $table_name WHERE $where[0] = '$where[1]' " );
	 		} else if (is_int($where[1])) {
	 			$q=@mysql_query("DELETE FROM $table_name WHERE $where[0] = $where[1]   " );
	 		}
 		}
 		if ($q) {
 			return true;
 		}
 		else { 
 			return false;
 		}
 	}

	function delete_w_2($table_name,$where_array,$oparators) {
		if (is_string($where_array[3])) {
			$q=@mysql_query("DELETE FROM $table_name WHERE $where_array[0] = $where_array[1] $oparators $where_array[2] = '$where_array[3]' " );
		}else if( is_int($where_array[1]) and is_int($where_array[3])  ){
 			$q=@mysql_query("DELETE FROM $table_name WHERE $where_array[0] = $where_array[1] $oparators $where_array[2] = $where_array[3] " );
 		}

 		if ($q) {
 		 	return true;
 		}else{
 		 	return false;
 		}
 	}
 	function updateArray($tableName,$rowNameArray,$valuesArray,$rowNameCompare,$rowValCompare) {
 		for ($i=0; $i <count($rowNameArray) ; $i++) {  

 			$value=$valuesArray[$i];
 			$rowName=$rowNameArray[$i]; 	

 			// echo " $i .) rowname = $rowName and value = $value Where  $rowNameCompare = $rowValCompare <br>";
 			if (is_string($value)) {
 				$res=mysql_query("UPDATE $tableName SET $rowName = '$value' WHERE $rowNameCompare = $rowValCompare");
 			}else{ 
 				$res=mysql_query("UPDATE $tableName SET $rowName = $value WHERE $rowNameCompare = $rowValCompare");
 			}
 			
 			if ($res) {
 				// echo "successfully updated";
 				// return true;
 			}else{ 
 				// echo "failled to update";
 				// return false;
 			}
 		}
 	}
 	function updateArray_w_2($tableName,$rowNameArray,$valuesArray,$whereArray) {
 		for ($i=0; $i <count($rowNameArray) ; $i++) { 
 			$value=$valuesArray[$i];
 			$rowName=$rowNameArray[$i]; 			
 			$res=mysql_query("UPDATE $tableName SET $rowName = '$value' WHERE $whereArray[0] = $whereArray[1] and $whereArray[2] = $whereArray[3]");
 			if ($res) {
 				// echo "successfully updated";
 			}else{ 
 				// echo "failled to update";
 			}
 		}
 	}
 	function update1($tableName,$rowname,$valuename,$whereArray=null){
 		if (is_string($valuename) and is_string($whereArray[1]) ) {
 			$res=mysql_query("UPDATE $tableName SET $rowname = '$valuename' WHERE $whereArray[0] = '$whereArray[1]'");
 			// echo "string string";
 		}else if(is_string($valuename) and !is_string($whereArray[1])){
 			$res=mysql_query("UPDATE $tableName SET $rowname = '$valuename' WHERE $whereArray[0] = $whereArray[1]");
 			// echo "string int";
 		}else{ 
 			$res=mysql_query("UPDATE $tableName SET $rowname = $valuename WHERE $whereArray[0] = $whereArray[1]");
 			// echo "int int";
 		}
 		
 		if ($res) {
 			return true; 
 		}else{ 
 			return false;
 		} 	
 	}
	function insert($table_name,$row_name_array,$values_array,$row_id_name=null)
	{
		for ($i=0; $i < count($row_name_array) ; $i++) { 
			if ($i<1) {
				// echo "row$i = ".$row_name_array[$i]." values$i = ".$values_array[$i]."<br>";
				$b0=mysql_query("INSERT INTO  $table_name ($row_name_array[$i]) value('$values_array[$i]') ");
				$last_id = mysql_insert_id(); 
			}else{
				// echo "row$i = ".$row_name_array[$i]." values$i = ".$values_array[$i]."<br>";
				$b1=mysql_query("UPDATE $table_name SET $row_name_array[$i] = '$values_array[$i]' WHERE $row_id_name = $last_id");
				
			}			
		}
		$_SESSION["last_inserted_id"] = $last_id;




		if (!empty($b0) && !empty($b1)  ) {
			return true;
		}else{
			return false;
		}
	}
	function table_len($table,$row,$where){  
		$res=mysql_query("SELECT count($row) FROM $table WHERE  where[0] = where[1] ");
		$tblen=mysql_fetch_array($res);
		return $tblen[0];
	}
 	function searchOne($tableName,$tablen,$keySearch,$rowName,$limit) {
		$key=0;
		$res=array();

		// $q = "SELECT * FROM $tableName WHERE LIKE '%$keySearch%' ";
		// if (!empty($limit)) {
		// 	$q .=	
		// }


		if (!empty($keySearch)) {
			$Q=mysql_query("SELECT * FROM $tableName WHERE $rowName  LIKE '%$keySearch%' LIMIT $limit");
			while ($db=mysql_fetch_array($Q)) { 
				for ($i=0; $i < $tablen; $i++) { 
					$res[$key][$i]=$db[$i];
				}
				$key++;
			}
		}
		return $res;	 		
	}
	function get_ads_last_id($tablename,$orderby) {
		$last_id=select($tablename,1,null,$orderby);
		// print_r($last_id);
		return $last_id[0][0]; 
	}
	function get_first_id($tablename,$rowname) {
		$last_id=select($tablename,1,null,"order by $rowname desc");
		// print_r($last_id);
		return $last_id[0][0]; 
	}
	function get_last_id($tablename,$rowname) {
		$first_id=select($tablename,1,null,"order by $rowname asc");
		// print_r($first_id);
		return $first_id[0][0]; 
	}	
	function get_my_username($mno){
		
		$username=select("fs_member_accounts",5,array('mno',$mno));
		 return $username[0][3];
	}
 
 
?>



<?php 

	function select_spec1($tableName,$select,$tablen=null,$whereArray) {
		$key=0;
		if(is_string($whereArray[1]) ){
			$Q=@mysql_query("SELECT $select FROM $tableName WHERE $whereArray[0] = '$whereArray[1]' ");
		}else { 
			$Q=@mysql_query("SELECT $select FROM $tableName WHERE $whereArray[0] = $whereArray[1] ");
		}
		// print_r(array_keys($Q));
		while ($db=mysql_fetch_array($Q)) { 
			for ($i=0; $i < $tablen; $i++) { 
				$res[$key][$i]=$db[$i];
			}
			$key++;
		}
		return $res;
	}

?>



<?php 
	#images
	function img_view_info($path){

		$flen=strlen($path);
		$images = glob("$path/*.*");
		foreach($images as $image => $key){
			$klen=strlen($key);
			$key1=substr($key,$flen+1,$klen);
			$i++;	
			echo "This is it! $key<br>";
			if ($key1!='Thumbs.db') {
				echo "$i. )<img height='50px' src='$key' /><a href='delete.php?delete = $key1' >delete</a><hr>";
			}
		}
	}

	function img_select($path,$name){

		$flen=strlen($path);
		$images = glob("$path/*.*");
		foreach($images as $image => $key){
			$klen=strlen($key);
			$key1=substr($key,$flen+1,$klen);
			$i++;	
			// echo "This is it! $key<br>";
			if ($key1!='Thumbs.db') {
				if ($name==$key1) {
					echo "<a style='color:red'>$name==$key1</a>";
					return true;
				}
			}
		}
	}
	function img_remove_ext($filename){
		return substr($filename,0, strpos($filename,'.'));
	}
	function img_get_file_ext($filename){
		for ($i=0; $i < strlen($filename) ; $i++) { 
			if($filename[$i] == '.'){
				$file_extention=substr($filename,$i+1,strlen($filename));
				$file_extention=strtolower($file_extention);
			}
		}
		return $file_extention;
	}
	function img_get_file_name($filename){
		for ($i=0; $i < strlen($filename) ; $i++) { 
			if($filename[$i] == '.'){
				$file_name=substr($filename,0,$i);
				$file_name=strtolower($file_name);
			}
		}
		return $file_name;
	}

	function img_delete(){}
	
	function img_rename(){}
	function img_extention(){}

	function move_img_to_folder($path,$imge_name){


		if ((($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/pjpeg")
		  	|| ($_FILES["file"]["type"] == "image/png"))&& ($_FILES["file"]["size"] < 1048600)){
		 
		  	if ($_FILES["file"]["error"] > 0){
		   		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		 	}
		 	// else if(file_exists("$path".$_FILES["file"]["name"])) {
		  //       // echo $_FILES["file"]["name"] . " already exists. ";
		  //    	echo "<script type='text/javascript'> alert('Ads exist.'); </script> ";
		  //       return false;
		  //   }
		    else{
		    	//echo "extention = ".$_FILES["file"]["type"];
		    	#combine extention and img name.
		    	$imge_name=$imge_name. substr($_FILES["file"]["type"], strpos($_FILES["file"]["type"], '/'),strlen($_FILES["file"]["type"]) );
		       	$imge_name=str_replace('/', '.', $imge_name);
		        // echo "image name = $imge_name<br>";

		        move_uploaded_file($_FILES["file"]["tmp_name"],"$path".$imge_name);
		        // echo "Stored in: " . "$path" . $_FILES["file"]["name"];
		        echo "<script type='text/javascript'> alert('Ads has been uploaded.'); </script> ";
		        // unlink($_FILES["file"]["name"]);
		        return true;
		    }
		}else{
			// echo "Invalid file";
			echo "<script type='text/javascript'> alert('Invalid File.'); </script> ";

			// alert("invalid file sorry");
		}
	}

?>







<?php 
	#html
	
	function form($tr,$action,$method,$name,$type_array,$name_array,$total,$send_array,$value_array=NULL,$class_array=NULL,$id_array=NULL){
		$pass=false;

		echo "
		<div class='form' id='form'>
			<table border='0' class='form_table'>
				<form action='$action' method='$method'>"; 
					for ($i=0; $i <$total ; $i++) { 
						# type password
						for ($j=0; $j < count($type_array[1])-1 ; $j++) { 
							if ($type_array[1][$j] == $i) {
								echo "<td><p>".$name[$i]."</p></td>$tr<td><input type='".$type_array[1][count($type_array[1])-1]."' name='".$name_array[$i]."' value='".$value_array[$i]."' class='".$class_array[$i]."' id='".$id_array[$i]."' ></td></tr>";
								$pass=true;
							}
						}
						#type text
						if (!$pass) {
							echo "<td><p>".$name[$i]."</p></td>$tr<td><input type='$type_array[0]' name='".$name_array[$i]."' value='".$value_array[$i]."' class='".$class_array[$i]."' id='".$id_array[$i]."' ><td></tr>";
						}
						$pass=false;
					}
					echo "<td></td>$tr<td><input type='$send_array[0]' value='$send_array[1]' name='$send_array[1]' class='$send_array[2]' id='$send_array[3]' /></td><tr>";
					echo "
				</form>
			</table>
		</div>
		";
	}
?>



<?php

	#
	# important
	#

	function get_file_extention($filename,$allowed_eXts_array){
		$c=0;
		for ($i=0; $i < strlen($filename) ; $i++) { 
			if($filename[$i] == '.'){
				$file_extention=substr($filename,$i+1,strlen($filename));
				$file_extention=strtolower($file_extention);
			}
		}
		echo "$file_extention";
		for ($i=0; $i < count($allowed_eXts_array); $i++) { 
			if ($allowed_eXts_array[$i] == $file_extention){
				return true;
			} 
		}
	}
	// function getname($plno){ 
								 
	// 	$activity_posted_info=select_w_2('activity',6,array('action','Posted','_table_id',$plno),'and');
	// 	// print_r($activity_posted_info);
	// 	// return $fullname;
	// 	$fs_members_info =select('fs_members',5,array('mno',$activity_posted_info[0][1]));
	// 	// print_r($fs_members_info);
	// 	return $fs_members_info[0][3].' '.$fs_members_info[0][1];
											
	// }




	function set_define($key,$value){
		$d=define($key,$value);
		return $d;
	}?>


<?php 
	#common

	function getname($plno){ 
								 
		$activity_posted_info=select_w_2('activity',6,array('action','Posted','_table_id',$plno),'and');
		// print_r($activity_posted_info);
		// return $fullname;
		$fs_members_info =select('fs_members',5,array('mno',$activity_posted_info[0][1]));
		// print_r($fs_members_info);
		return $fs_members_info[0][3].' '.$fs_members_info[0][1];
											
	}
	function cif($db,$array,$key){  # cif = check info exist
		$exist_count=0;
		for ($i=0; $i < count($db) ; $i++) { 

			for ($j=0; $j < 4; $j++) { 
			
				if ($db[$i][$j+2] == $array[$j] ) { 
					$exist_count++;
				}
			}
		}
		return $exist_count;
	}

	function temp_reg_insert($reg_info_array){

	 	$mi_first_name = $_POST[$reg_info_array[0]] ;
	 	$mi_last_name = $_POST[$reg_info_array[1]] ;
	 	$mi_username = $_POST[$reg_info_array[2]] ;
	 	$mi_password = $_POST[$reg_info_array[4]] ;
	 	$mi_email = $_POST[$reg_info_array[6]] ;
		$bool = mysql_query("INSERT INTO member_info(mi_username,mi_password,mi_email,mi_first_name,mi_last_name) VALUES ('$mi_username','$mi_password','$mi_email','$mi_first_name','$mi_last_name') ") or mysql_error();
		return $bool;
	}
	function temp_get_user_id($username,$password){ 
	}

	function logout($session_name){
		unset($_SESSION[$session_name]);
	}
?>

<?php 
	#important stuff

	function count_total_like($total_like) {
		if (empty($total_like)) { 						
			echo "0";
		}else{
			echo count($total_like);													
		}	
	}
	function like_dislike(){
		if (!empty($_SESSION['mno'])) {
			if (empty($_GET['unlike'])) {
				
				if (!select_w_2('posted_looks_comments_like_dislike',1,array('plcno',$_GET['comment_id'],'mno',$_SESSION['mno']),'and') ) { 
					insert('posted_looks_comments_like_dislike',array('plcno','mno'),array($_GET['comment_id'],$_SESSION['mno']),'plcldno');						
					$total_like=select('posted_looks_comments_like_dislike',3,array('plcno',$_GET['comment_id']));
					count_total_like($total_like);
					// echo "Sucesfully like the comment ";
				}else{
					$total_like=select('posted_looks_comments_like_dislike',3,array('plcno',$_GET['comment_id']));
					count_total_like($total_like);
				}
			}else{
				delete_w_2('posted_looks_comments_like_dislike',array('plcno',$_GET['unlike'],'mno',$_SESSION['mno']),'and');
				 // echo "Sucesfully unlike the comment";
				$total_like=select('posted_looks_comments_like_dislike',3,array('plcno',$_GET['unlike']));
				count_total_like($total_like);
			}
		}
	}
	?>

<?php 	
	function report_spam(){
		//report once only

		// if(!select_w_2('cm_spam_report',4,array('cmsr_mno_reporter',$_SESSION['mno'],'cmsr_plcno',$_GET['id']))) {
			insert('cm_spam_report',array('cmsr_mno_reporter','cmsr_plcno','cmsr_date'),array($_SESSION['mno'],$_GET['id'],date("Y-m-d")),'cmsr_id');
			sent_mail();
		// }
	}
	function sent_mail() { 
		$comment=select('posted_looks_comments',5,array('plcno',$_GET['id']));
		// print_r($comment);
		$name=select('fs_members',4,array('mno',$_SESSION['mno']));
		$email=select('fs_member_accounts',4,array('mno',$_SESSION['mno']));
		$headers='From:'.$email[0][2];
		$_POST['message'] = $name[0][3]." ".$name[0][1]." report this comment \" ".$comment[0][4]."\" as a spam  to this post look  http://fashionsponge.com/fs/lookdetails.php?id=$_SESSION[plno]";
		$_POST['subject'] = 'spam reports';
		$stat= mail('gcook@smartmarketer.net',$_POST['subject'],$_POST['message'],$headers);
		// gcook@smartmarketer.net
	}
?>



 
<?php 
	#javascript

	function jumps($path){
			echo "<script type='text/javascript'>document.location='$path';</script>";
	}
?>
 

<?php 
	 
	# Date: june 7 2013 9:04 am
	# Created by: Jesus Erwin Suarez 
	# version 1.1.0
	function selectV1($select='*', $tableName=null, $where=null,$orderby=null,$limit=null,$search=null) 
	{ 
		$c=0;
		$res = array( );
		if (!empty($select)) {
			$Q = "SELECT $select  FROM " ;
		}
		if (!empty($tableName)) {
			$Q.=" $tableName  ";
		}
		if (!empty($where)) {
			$Q.="WHERE "; 
			foreach ($where as $key => $value) {
				if ($key == 'operand1' || $key == 'operand2' || $key == 'operand3' || $key == 'operand4' || $key == 'operand5' || $key == 'operand6'  ) {
					$Q.="$value ";	
				} else {   
					if (is_integer($value)) {
					$Q.="$key = $value ";				
					}else { 
						$Q.="$key = '$value' ";				
					}
				}
			}
		} 
		if (!empty($search)) {
		  	$rowName = $search['rowName'];
			$keySearch = $search['keySearch'];
			$Q.=" WHERE $rowName  LIKE '%$keySearch%' ";
		}
		if (!empty($orderby)) {
			$Q.="$orderby ";
		}
		if (!empty($limit)) {
			$Q.="$limit ";
		}

		$r = @mysql_query($Q);
		if (!empty($r)) {
			while ($db=mysql_fetch_array($r)) {
		 		
				$res[$c] = $db;
				$c++;
			}
			return $res;
		}else { 
			return 0;
		}
	} 
?>
<?php 

	function select_one_result($select='*',$tableName=null, $where=null,$orderby=null,$limit=null) { 
		$c=0;
		if (!empty($select)) {
			$Q = "SELECT $select  FROM " ;
		}
		if (!empty($tableName)) {
			$Q.=" $tableName  ";
		}
		if (!empty($where)) {
			$Q.="WHERE ";
			foreach ($where as $key => $value) {
				if ($key == 'operand1' || $key == 'operand2' || $key == 'operand3' || $key == 'operand4' || $key == 'operand5' || $key == 'operand6'  ) {
					$Q.="$value ";	
				} else {   
					if (is_integer($value)) {
					$Q.="$key = $value ";				
					}else { 
						$Q.="$key = '$value' ";				
					}
				}
			}
		}
		if (!empty($orderby)) {
			$Q.="$orderby ";
		}
		if (!empty($limit)) {
			$Q.="$limit ";
		}
		$r = @mysql_query($Q);
 	
 		if (!empty($r)) {
			while ($db = mysql_fetch_array($r)) {

				foreach ($db as $key => $value ) {
					// echo "$key => $value <br>";  	
					$res[$key] = $value;
				}
			}
		}
		if (!empty($res)) {
			return $res;
		}
		else { 
			return 0;
		}
	}
?>