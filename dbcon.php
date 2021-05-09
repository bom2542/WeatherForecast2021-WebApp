<?php

//define('DB_SERVER', 'localhost');
//define('DB_USER', 'root');
//define('DB_PASS', '');
//define('DB_NAME', 'weatherforecast2021');

//define('DB_SERVER', 'localhost');
//define('DB_USER', 'pharadornl_weatherforecast');
//define('DB_PASS', 'dM%IADb82WVB');
//define('DB_NAME', 'pharadornl_weatherforecast');

$conn = new mysqli('localhost','root','','weatherforecast2021');
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
?>