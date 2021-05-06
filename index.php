<?php include_once('obj/fn.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[ Welcome ] WeatherForecast2021</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Prompt', sans-serif;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Topic -->
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 font-weight-bold" align="center">ระบบแสดงผลการพยากรณ์อากาศประจำวัน ระดับภูมิภาค</h1>
                <hr>
                <?php
                $xml = simplexml_load_file("https://www.tmd.go.th/xml/region_daily_forecast.obj?RegionID=0");
                $pubDate = explode(" ", $xml->channel->item->pubDate);
                $update = date("Y-m-d H:i:s",strtotime($pubDate[1] . $pubDate[2] . $pubDate[3] . $pubDate[4]));

                $updateuser = new DB_con();
                $sql = $updateuser->DateThai($update);
                echo "<h6 align='right'>ข้อมูลล่าสุด: " . $sql . "</h6>";
                ?>
            </div>
        </div>
        <!-- content#1 -->
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
            <div class="col">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">ภาคเหนือ</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">ภาคตะวันออกเฉียงเหนือ</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">ภาคกลาง</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- content#2 -->
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
            <div class="col">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">ภาคตะวันออก</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">ภาคใต้(ฝั่งตะวันออก)</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">ภาคใต้(ฝั่งตะวันตก)</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
            <div class="col">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">กรุงเทพมหานครและปริมณฑล</h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>