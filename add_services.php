<?php
/**
 * Created by PhpStorm.
 * User: Joyii
 * Date: 10/11/2015
 * Time: 1:59 AM
 */


require('hr_folders/hr_php_function/connect.php');
require('hr_folders/hr_php_function/function.php');


print_r($_REQUEST['other_services']);
echo "reservation id" . $_REQUEST['reservation_id'];


    for($i=0; $i<count($_REQUEST['other_services']); $i++) {
//        insert(
//            'other_services_details',
//            array('id', 'reservation_id' ),
//            array($_REQUEST['other_services'][$i], $_REQUEST['reservation_id']),
//            'id'
//        );

        $id = $_REQUEST['other_services'][$i];
        $rid  = $_REQUEST['reservation_id'];

        if(mysql_query("INSERT INTO  other_services_details (other_services_id, reservation_id) value($id, $rid) ")) {
            echo "insert <Br>";
        } else{
            echo "failed<br>";
        }
    }

//
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "smc_reservation";
//
//// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
//// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
//
//$sql = "INSERT INTO MyGuests (firstname, lastname, email)
//VALUES ('John', 'Doe', 'john@example.com')";
//
//if ($conn->query($sql) === TRUE) {
//    echo "New record created successfully";
//} else {
//    echo "Error: " . $sql . "<br>" . $conn->error;
//}
//
//$conn->close();



header('location:thankyou#header-logo-nav');