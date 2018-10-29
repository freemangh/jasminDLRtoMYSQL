<?php
//file_put_contents('dlr.txt', file_get_contents('php://input'));

$dlrdata = json_encode($_POST);
//$dlrdata = $_POST;
//$dlrdata = $HTTP_RAW_POST_DATA;

$file_handle = fopen('dlr.txt', 'a');
fwrite($file_handle, $dlrdata . "\r\n");
fclose($file_handle);

?>

