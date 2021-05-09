<?php

include_once('function.php');
$api_fetch = new DB_con();
$sql = $api_fetch->fetchdata();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

$json_data = array();

if (mysqli_num_rows($sql)) {

    while($row = mysqli_fetch_array($sql)) {
        $json_array['id']=$row['id'];
        $json_array['pubDate']=$row['pubDate'];
        $json_array['region']=$row['region'];
        $json_array['description']=$row['description'];
        $json_array['province_1']=$row['province_1'];
        $json_array['province_2']=$row['province_2'];
        $json_array['province_3']=$row['province_3'];
        $json_array['province_4']=$row['province_4'];

        $json_data['forecast'][] = $json_array;
    }
    header('Content-Type: application/json');
    echo json_encode($json_data, JSON_PRETTY_PRINT);
} else {
    header('Content-Type: application/json');
    $json_data['forecast'] = [];
    echo json_encode($json_data, JSON_PRETTY_PRINT);
}

?>