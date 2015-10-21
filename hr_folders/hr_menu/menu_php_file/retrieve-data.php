<?php   
	require_once ("../../hr_php_function/connect.php");
	require("../../hr_php_function/function.php");
	require("../../hr_php_function/myclass.php");
	$mc = new myclass(); 
	$keyTyped = $_GET["menu_search"];   
	 $page = $_GET['page']; 


	if ( $page == 'user' ) { 
		$room = selectV1(
			'*',
			"room",
			null,
			null,
			null,
			array(
				"rowName"=>"Room_name",
				"keySearch"=>$keyTyped
			)
		);    
		$troom = count($room);    
		echo "<ul>";   
				$c=0;  
				for ($i=0; $i < $troom ; $i++) {  
					$c++; 
					$msr = $room[$i]["Room_name"]; 
					 echo "<li  id='menu-search-result-id-$c' title='$msr' onmouseover='search_result_mouseover(\"$c\")' onclick='search_send(\"searchroom?search=$msr\")'  ><a  href='#''>$msr</a></li> ";
				} 
		echo "</ul>";  
		echo "<span id='total_room' style='display:none'>".count($room)."</span>";
	}else{
		// selectV1($select='*', $tableName=null, $where=null,$orderby=null,$limit=null,$search=null) 
	 	$guest = selectV1(
			'*',
			"guest",
			null,
			null,
			"limit 6",
			array(
				"rowName"=>"fullname",
				"keySearch"=>$keyTyped
			)
		);   
		$tguest = count($guest);   
		echo "<ul>";   
				$c=0;  
				for ($i=0; $i < $tguest ; $i++) {  
					$c++; 
					$mname = $guest[$i]["fullname"]; 
					$gid = $guest[$i]["Guest_id"]; 
					echo "<li  id='menu-search-result-id-$c' title='$mname' onmouseover='search_result_mouseover(\"$c\")' onclick='search_send(\"admin?members=$mname\")'  ><a  href='admin?gid=$gid'>$mname</a></li> ";
				} 
		echo "</ul>";  
		echo "<span id='total_room' style='display:none'>".count($guest)."</span>";
	}

?>

  