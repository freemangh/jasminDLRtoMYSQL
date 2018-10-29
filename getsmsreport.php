<?php

session_start();

//$auth = "adduserip_Z2FzZDd3cWVqc2Q3d2VqZA==";

//$auth_received = get_header('Authorization');
//if ($auth != $auth_received) {
//    die('Authorization error in receive_cdr_records. auth_received = '.$auth_received);
//}

$idinc = trim($_GET["idinc"]);

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

if (!is_numeric($idinc)) {
    echo "Error. idinc must be a number.";
    exit();
}
echo getAllDataById($idinc);


function getAllDataById($idinc){
    global $conn;

    $idincnum = is_numeric($idinc) ? $idinc+0 : 0;
    $q = " SELECT * FROM  smsreport.report WHERE idinc > $idincnum ";

    //Execute the query and put data into a result
    $result = $conn->query($q);

    //Copy result into a associative array
    $jsondata = json_encode($result->fetch_all(MYSQLI_ASSOC));

    mysqli_free_result($result);

    $conn->close();

    return $jsondata;
}
