<?php
#header('Access-Control-Allow-Origin: *');
#file_put_contents("log.txt","...");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
        header('Access-Control-Allow-Headers: token, Content-Type');
        header('Access-Control-Max-Age: 1728000');
        header('Content-Length: 0');
        header('Content-Type: text/plain');
        die();
    }

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    $ret = [
        'result' => 'OK',
    ];
    print json_encode($ret);

#$postdata = $_POST['data']; 
#$test = $_REQUEST['user'];
#file_put_contents("log.txt",$postdata);
$postdata = file_get_contents('php://input');
#$data = json_decode($postdata);  
$dataArr = explode(",",$postdata);
#file_put_contents("log.txt",$postdata);
file_put_contents("log.txt",$dataArr[0]." ".$dataArr[1]." ".$dataArr[2]." ".$dataArr[3]." ".$dataArr[4]." ".$dataArr[5]);
$titleArr = explode(":"$dataArr[1]);
$title = $titleArr[1];
$startArr = explode(":"$dataArr[3]);
$start = $startArr[1];
$endArr = explode(":"$dataArr[4]);
$end = $endArr[1];
$des = $dataArr[5];


?>