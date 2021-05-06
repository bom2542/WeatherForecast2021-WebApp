<?php

define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'weatherforecast2021');

class DB_con {

    function __construct() {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbcon = $conn;

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL : " . mysqli_connect_error();
        }
    }

    public function insert($firstname, $lastname, $email, $phonenumber,	$address) {
        $result = mysqli_query($this->dbcon, "INSERT INTO tblusers(firstname, lastname, email, phonenumber, address) VALUES('$firstname', '$lastname', '$email', '$phonenumber', '$address')");
        return $result;
    }

    public function fetchdata() {
        $result = mysqli_query($this->dbcon, "SELECT * FROM tblusers");
        return $result;
    }

    public function fetchonerecord($userid) {
        $result = mysqli_query($this->dbcon, "SELECT * FROM tblusers WHERE id = '$userid'");
        return $result;
    }

    public function update($firstname, $lastname, $email, $phonenumber,	$address, $userid) {
        $result = mysqli_query($this->dbcon, "UPDATE tblusers SET 
                firstname = '$firstname',
                lastname = '$lastname',
                email = '$email',
                phonenumber = '$phonenumber',
                address = '$address'
                WHERE id = '$userid'
            ");
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

}


?>