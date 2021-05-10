<?php

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'weatherforecast2021');

// define('DB_SERVER', 'localhost');
// define('DB_USER', 'pharadornl_weatherforecast');
// define('DB_PASS', 'dM%IADb82WVB');
// define('DB_NAME', 'pharadornl_weatherforecast');

class DB_con {

    function __construct() {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbcon = $conn;

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL : " . mysqli_connect_error();
        }
    }

    /* Now data */
    public function insert($update, $region, $content, $first_province, $second_province, $third_province, $fouth_province) {
        $region_add = (int)$region;
        $result = mysqli_query($this->dbcon, "INSERT INTO forecast_daily(id, pubDate, region, description, province_1, province_2, province_3, province_4) 
                                                VALUES(NULL, '$update', $region_add, '$content', '$first_province', '$second_province', '$third_province', '$fouth_province')");
        return $result;
    }

    public function DateThai($strDate){
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strHour= date("H",strtotime($strDate));
        $strMinute= date("i",strtotime($strDate));
        $strSeconds= date("s",strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
    }

    public function fetchdata() {
        $result = mysqli_query($this->dbcon, "SELECT * FROM forecast_daily ORDER BY id DESC");
        return $result;
    }

    public function fetch_api(){
        $data = [];
        $query = "SELECT * FROM forecast_daily ORDER BY id DESC";
        if ($sql = $this->dbcon->query($query)) {
            while ($row = mysqli_fetch_array($sql)) {
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

                $data[] = $json_array;
            }
        }
        return $data;
    }

    public function date_range($start_date, $end_date){
        $data = [];
        if (isset($start_date) && isset($end_date)) {
            $query = "SELECT * FROM forecast_daily WHERE pubDate > '$start_date' AND pubDate < '$end_date' ORDER BY id DESC";
            if ($sql = $this->dbcon->query($query)) {
                while ($row = mysqli_fetch_array($sql)) {
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

                    $data[] = $json_array;
                }
            }
        }
        return $data;
    }

}
?>