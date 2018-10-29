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

echo safePushJsonToDb($jsonData);


function safePushJsonToDb($jsondata){
    global $conn;


    $v = json_decode($jsondata);
    if( isset($v->message_status) && (!empty($v->message_status))  ) {
        $message_status = (isset($v->message_status) && !empty($v->message_status)) ? $v->message_status:'';
        $id = (isset($v->id) && !empty($v->id)) ? $v->id:'';
        $level = (isset($v->level) && !empty($v->level)) ? $v->level:'';
        $donedate = (isset($v->donedate) && !empty($v->donedate)) ? $v->donedate:'';
        $sub = (isset($v->sub) && !empty($v->sub)) ? $v->sub:'';
        $err = (isset($v->err) && !empty($v->err))  ? $v->err:'';
        $text = (isset($v->text) && !empty($v->text)) ? $v->text:'';
        $id_smsc = (isset($v->id_smsc) && !empty($v->id_smsc)) ? $v->id_smsc:'';
        $dlvrd = (isset($v->dlvrd) && !empty($v->dlvrd)) ? $v->dlvrd:'';
        $subdate = (isset($v->subdate) && !empty($v->subdate)) ? $v->subdate:'';
        $jsondata = (isset($jsondata) && !empty($jsondata)) ? $jsondata:'';

        $q = "INSERT INTO smsreport.report (";
        $q .= "     timestamp ";
        $q .= "    ,message_status ";
        $q .= "    ,id ";
        $q .= "    ,level ";
        $q .= "    ,donedate ";
        $q .= "    ,sub ";
        $q .= "    ,err ";
        $q .= "    ,text ";
        $q .= "    ,id_smsc ";
        $q .= "    ,dlvrd ";
        $q .= "    ,subdate ";
        $q .= "    ,jsondata )";
        $q .= " VALUES ( ";
        $q .= " '" . date("Y-m-d H):i):s") . "',";
        $q .= " ?,";    // message_status
        $q .= " ?,";    // id
        $q .= " ?,";    // level
        $q .= " ?,";    // donedate
        $q .= " ?,";    // sub
        $q .= " ?,";    // err
        $q .= " ?,";    // text
        $q .= " ?,";    // id_smsc
        $q .= " ?,";    // dlvrd
        $q .= " ?,";    // subdate
        $q .= " ? )";   // jsondata


        $stmt = $conn->prepare($q);
        $stmt->bind_param("sssssssssss", $message_status, $id, $level, $donedate, $sub, $err, $text, $id_smsc, $dlvrd, $subdate, $jsondata);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return "OKay";
    }


}
