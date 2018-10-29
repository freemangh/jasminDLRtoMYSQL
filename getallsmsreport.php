<?php

session_start();

//$auth = "adduserip_Z2FzZDd3cWVqc2Q3d2VqZA==";

//$auth_received = get_header('Authorization');
//if ($auth != $auth_received) {
//    die('Authorization error in receive_cdr_records. auth_received = '.$auth_received);
//}



$jsonData = file_get_contents("php://input");

echo $jsonData;

$servername = "localhost";
$username = "db_user";
$password = "db_pass";
$dbname = "db_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 echo getAllData();


function getAllData(){
    global $conn;

    $q = " SELECT * FROM  smsreport.report ";
    $q .= "     ORDER BY timestamp ASC ";


    //Execute the query and put data into a result
    $result = $conn->query($q);

    //Copy result into a associative array
    $jsondata = json_encode($result->fetch_all(MYSQLI_ASSOC));

    mysqli_free_result($result);

    $conn->close();

    return $jsondata;
}
