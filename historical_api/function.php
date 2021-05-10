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

    public function insert($update, $region, $content, $first_province, $second_province, $third_province, $fouth_province) {
        $region_add = (int)$region;
        $result = mysqli_query($this->dbcon, "INSERT INTO forecast_daily(id, pubDate, region, description, province_1, province_2, province_3, province_4) 
                                                VALUES(NULL, '$update', $region_add, '$content', '$first_province', '$second_province', '$third_province', '$fouth_province')");
        //return $result;
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

}


?>