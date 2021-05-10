<?php

include 'historical_api/function.php';

$model = new DB_con();

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $rows = $model->date_range($start_date, $end_date);
} else {
    $rows = $model->fetch_api();
}

echo json_encode($rows, JSON_PRETTY_PRINT);