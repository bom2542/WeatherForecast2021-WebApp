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
        if($row['region'] == 1){
            $json_array['region'] = "เหนือ";
        }else if($row['region'] == 2){
            $json_array['region'] = "ตะวันออกเฉียงเหนือ";
        }else if($row['region'] == 3){
            $json_array['region'] = "กลาง";
        }else if($row['region'] == 4){
            $json_array['region'] = "ตะวันออก";
        }else if($row['region'] == 5){
            $json_array['region'] = "ใต้(ฝั่งตะวันออก)";
        }else if($row['region'] == 6){
            $json_array['region'] = "ใต้(ฝั่งตะวันตก)";
        }else if($row['region'] == 7){
            $json_array['region'] = "กรุงเทพและปริมณฑล";
        }
        $json_array['description']=$row['description'];
        $json_array['province_1']=$row['province_1'];
        if($row['province_1'] == "  "){
            $json_array['province_1'] = "ไม่มีข้อมูล";
        }
        $json_array['province_2']=$row['province_2'];
        if($row['province_2'] == "  "){
            $json_array['province_2'] = "ไม่มีข้อมูล";
        }
        $json_array['province_3']=$row['province_3'];
        if($row['province_3'] == "  "){
            $json_array['province_3'] = "ไม่มีข้อมูล";
        }
        $json_array['province_4']=$row['province_4'];
        if($row['province_4'] == "  "){
            $json_array['province_4'] = "ไม่มีข้อมูล";
        }

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