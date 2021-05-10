<?php include_once('historical_api/function.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tag -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[ Welcome ] WeatherForecast2021</title>
    <!-- Boostrap v5 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <!-- Google font prompt -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <!-- Datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- icon title file -->
    <link rel = "icon" href = "img/icon.png" type = "image/x-icon">
    <!-- css internal -->
    <link rel="stylesheet" href="style.css">
    <!-- css inline -->
    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Prompt', sans-serif;
        }

        p {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            text-overflow: ellipsis;
        }

        .loader {
            position: fixed;
            z-index: 99;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader > img {
            width: 100px;
        }

        .loader.hidden {
            animation: fadeOut 1s;
            animation-fill-mode: forwards;
        }

        @keyframes fadeOut {
            100% {
                opacity: 0;
                visibility: hidden;
            }
        }

        .thumb {
            height: 100px;
            border: 1px solid black;
            margin: 10px;
        }

        #topBtn{
            position: fixed;
            bottom: 40px;
            right: 40px;
            font-size: 22px;
            width: 50px;
            height: 50px;
            background: #D21F3C;
            color: white;
            border: none;
            cursor: pointer;
            display: none;
        }
    </style>
</head>
<body id="body-pd">

    <div class="loader">
        <img src="img/loader.gif" />
    </div>

    <div class="container">
        <!-- Topic -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5 font-weight-bold" align="center">แสดงผลการพยากรณ์อากาศประจำวัน ระดับภูมิภาค(ล่าสุด)</h2>
                <hr>
                <?php
                $xml = simplexml_load_file("https://www.tmd.go.th/xml/region_daily_forecast.php?RegionID=0");
                $pubDate = explode(" ", $xml->channel->item->pubDate);
                $update = date("Y-m-d H:i:s",strtotime($pubDate[1] . $pubDate[2] . $pubDate[3] . $pubDate[4]));

                $updateuser = new DB_con();
                $sql = $updateuser->DateThai($update);
                echo "<h6 align='right'>ข้อมูลล่าสุด: " . $sql . "</h6>";
                ?>
            </div>
        </div>

        <!-- card row 1 -->
        <div class="row row-cols-1 row-cols-lg-3 g-4 mt-1">
            <!-- bangkok daily forecast card-->
            <div class="col">
                <?php
                $xml = simplexml_load_file("https://www.tmd.go.th/xml/region_daily_forecast.php?RegionID=7");
                $description = explode("<br />", $xml->channel->item->description);
                $doc = new DOMDocument();
                $doc->loadHTML($xml->channel->item->description);
                $xml = simplexml_import_dom($doc);
                $images = $xml->xpath('//img');
                ?>
                <div class="card" data-toggle="modal" data-target="#bangkok">
                    <img src="img/16.jpg" class="card-img-top" alt="กรุงเทพมหานครและปริมณฑล">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">
                            <?php
                            foreach ($images as $img)
                            {
                                echo "<img src='" . $imgforecast = $img['src'] . "'/>";
                            }
                            ?> กรุงเทพมหานครและปริมณฑล</h5>
                        <p class="card-text" style="text-indent: 2.5em;">
                            <?php
                            $content = preg_replace("/<img[^>]+\>/i", "", $description[1]);
                            echo $content;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Modal bangkok daily forecast -->
            <div class="modal fade" id="bangkok" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">พยากรณ์อากาศประจำวัน <?php echo $sql?> ภูมิภาค: กรุงเทพมหานครและปริมณฑล</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 36px; color: red; font-weight: bold;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div align="center">
                                <img src="img/16.jpg" class="img-fluid" width="50%"  alt="กรุงเทพมหานครและปริมณฑล">
                            </div>
                            <div style="text-indent: 2.5em;" class="mt-4 mb-1">
                                <?php
                                echo "<div class='mb-1'>" . $content . "</div><br/>";
                                echo $description[2];
                                echo "<div style='text-indent: 2.5em;'>" . $description[3] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[4] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[5] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[6] . "</div>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- north daily forecast card-->
            <div class="col">
                <?php
                $xml = simplexml_load_file("https://www.tmd.go.th/xml/region_daily_forecast.php?RegionID=1");
                $description = explode("<br />", $xml->channel->item->description);
                $doc = new DOMDocument();
                $doc->loadHTML($xml->channel->item->description);
                $xml = simplexml_import_dom($doc);
                $images = $xml->xpath('//img');
                ?>
                <div class="card" data-toggle="modal" data-target="#north">
                    <img src="img/10.jpg" class="card-img-top" alt="ภาคเหนือ">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">
                            <?php
                            foreach ($images as $img)
                            {
                                echo "<img src='" . $imgforecast = $img['src'] . "'/>";
                            }
                            ?> ภาคเหนือ</h5>
                        <p class="card-text" style="text-indent: 2.5em;">
                            <?php
                            $content = preg_replace("/<img[^>]+\>/i", "", $description[1]);
                            echo $content;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Modal north daily forecast -->
            <div class="modal fade" id="north" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">พยากรณ์อากาศประจำวัน <?php echo $sql?> ภูมิภาค: เหนือ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 36px; color: red; font-weight: bold;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div align="center">
                                <img src="img/10.jpg" class="img-fluid" width="50%"  alt="ภาคเหนือ">
                            </div>
                            <div style="text-indent: 2.5em;" class="mt-4 mb-1">
                                <?php
                                echo "<div class='mb-1'>" . $content . "</div><br/>";
                                echo $description[2];
                                echo "<div style='text-indent: 2.5em;'>" . $description[3] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[4] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[5] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[6] . "</div>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- north east daily forecast card-->
            <div class="col">
                <?php
                $xml = simplexml_load_file("https://www.tmd.go.th/xml/region_daily_forecast.php?RegionID=2");
                $description = explode("<br />", $xml->channel->item->description);
                $doc = new DOMDocument();
                $doc->loadHTML($xml->channel->item->description);
                $xml = simplexml_import_dom($doc);
                $images = $xml->xpath('//img');
                ?>
                <div class="card" data-toggle="modal" data-target="#northeast">
                    <img src="img/11.jpg" class="card-img-top" alt="ภาคตะวันออกเฉียงเหนือ">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">
                            <?php
                            foreach ($images as $img)
                            {
                                echo "<img src='" . $imgforecast = $img['src'] . "'/>";
                            }
                            ?> ภาคตะวันออกเฉียงเหนือ</h5>
                        <p class="card-text" style="text-indent: 2.5em;">
                            <?php
                            $content = preg_replace("/<img[^>]+\>/i", "", $description[1]);
                            echo $content;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Modal north east daily forecast -->
            <div class="modal fade" id="northeast" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">พยากรณ์อากาศประจำวัน <?php echo $sql?> ภูมิภาค: ตะวันออกเฉียงเหนือ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 36px; color: red; font-weight: bold;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div align="center">
                                <img src="img/11.jpg" class="img-fluid" width="50%"  alt="ภาคตะวันออกเฉียงเหนือ">
                            </div>
                            <div style="text-indent: 2.5em;" class="mt-4 mb-1">
                                <?php
                                echo "<div class='mb-1'>" . $content . "</div><br/>";
                                echo $description[2];
                                echo "<div style='text-indent: 2.5em;'>" . $description[3] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[4] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[5] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[6] . "</div>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card row 2 -->
        <div class="row row-cols-1 row-cols-lg-3 g-4 mt-2">
            <!-- center daily forecast card-->
            <div class="col">
                <?php
                $xml = simplexml_load_file("https://www.tmd.go.th/xml/region_daily_forecast.php?RegionID=3");
                $description = explode("<br />", $xml->channel->item->description);
                $doc = new DOMDocument();
                $doc->loadHTML($xml->channel->item->description);
                $xml = simplexml_import_dom($doc);
                $images = $xml->xpath('//img');
                ?>
                <div class="card" data-toggle="modal" data-target="#center">
                    <img src="img/12.jpg" class="card-img-top" alt="ภาคกลาง">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">
                            <?php
                            foreach ($images as $img)
                            {
                                echo "<img src='" . $imgforecast = $img['src'] . "'/>";
                            }
                            ?> ภาคกลาง</h5>
                        <p class="card-text" style="text-indent: 2.5em;">
                            <?php
                            $content = preg_replace("/<img[^>]+\>/i", "", $description[1]);
                            echo $content;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Modal center daily forecast -->
            <div class="modal fade" id="center" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">พยากรณ์อากาศประจำวัน <?php echo $sql?> ภูมิภาค: กลาง</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 36px; color: red; font-weight: bold;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div align="center">
                                <img src="img/12.jpg" class="img-fluid" width="50%"  alt="ภาคกลาง">
                            </div>
                            <div style="text-indent: 2.5em;" class="mt-4 mb-1">
                                <?php
                                echo "<div class='mb-1'>" . $content . "</div><br/>";
                                echo $description[2];
                                echo "<div style='text-indent: 2.5em;'>" . $description[3] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[4] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[5] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[6] . "</div>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- east daily forecast card-->
            <div class="col">
                <?php
                $xml = simplexml_load_file("https://www.tmd.go.th/xml/region_daily_forecast.php?RegionID=4");
                $description = explode("<br />", $xml->channel->item->description);
                $doc = new DOMDocument();
                $doc->loadHTML($xml->channel->item->description);
                $xml = simplexml_import_dom($doc);
                $images = $xml->xpath('//img');
                ?>
                <div class="card" data-toggle="modal" data-target="#east">
                    <img src="img/13.jpg" class="card-img-top" alt="ภาคตะวันออก">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">
                            <?php
                            foreach ($images as $img)
                            {
                                echo "<img src='" . $imgforecast = $img['src'] . "'/>";
                            }
                            ?> ภาคตะวันออก</h5>
                        <p class="card-text" style="text-indent: 2.5em;">
                            <?php
                            $content = preg_replace("/<img[^>]+\>/i", "", $description[1]);
                            echo $content;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Modal east daily forecast -->
            <div class="modal fade" id="east" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">พยากรณ์อากาศประจำวัน <?php echo $sql?> ภูมิภาค: ตะวันออก</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 36px; color: red; font-weight: bold;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div align="center">
                                <img src="img/13.jpg" class="img-fluid" width="50%"  alt="ภาคตะวันออก">
                            </div>
                            <div style="text-indent: 2.5em;" class="mt-4 mb-1">
                                <?php
                                echo "<div class='mb-1'>" . $content . "</div><br/>";
                                echo $description[2];
                                echo "<div style='text-indent: 2.5em;'>" . $description[3] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[4] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[5] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[6] . "</div>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- south(thai gulf) daily forecast card-->
            <div class="col">
                <?php
                $xml = simplexml_load_file("https://www.tmd.go.th/xml/region_daily_forecast.php?RegionID=5");
                $description = explode("<br />", $xml->channel->item->description);
                $doc = new DOMDocument();
                $doc->loadHTML($xml->channel->item->description);
                $xml = simplexml_import_dom($doc);
                $images = $xml->xpath('//img');
                ?>
                <div class="card" data-toggle="modal" data-target="#souththai">
                    <img src="img/14.jpg" class="card-img-top" alt="ภาคใต้(ฝั่งตะวันออก)">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">
                            <?php
                            foreach ($images as $img)
                            {
                                echo "<img src='" . $imgforecast = $img['src'] . "'/>";
                            }
                            ?> ภาคใต้(ฝั่งตะวันออก)</h5>
                        <p class="card-text" style="text-indent: 2.5em;">
                            <?php
                            $content = preg_replace("/<img[^>]+\>/i", "", $description[1]);
                            echo $content;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Modal south thai gulf daily forecast -->
            <div class="modal fade" id="souththai" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">พยากรณ์อากาศประจำวัน <?php echo $sql?> ภูมิภาค: ใต้(ฝั่งตะวันออก)</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 36px; color: red; font-weight: bold;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div align="center">
                                <img src="img/14.jpg" class="img-fluid" width="50%"  alt="ภาคใต้(ฝั่งตะวันออก)">
                            </div>
                            <div style="text-indent: 2.5em;" class="mt-4 mb-1">
                                <?php
                                echo "<div class='mb-1'>" . $content . "</div><br/>";
                                echo $description[2];
                                echo "<div style='text-indent: 2.5em;'>" . $description[3] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[4] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[5] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[6] . "</div>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card row 3 -->
        <div class="row row-cols-1 row-cols-lg-3 g-4 mt-2">
            <!-- south(andaman gulf) daily forecast card-->
            <div class="col">
                <?php
                $xml = simplexml_load_file("https://www.tmd.go.th/xml/region_daily_forecast.php?RegionID=6");
                $description = explode("<br />", $xml->channel->item->description);
                $doc = new DOMDocument();
                $doc->loadHTML($xml->channel->item->description);
                $xml = simplexml_import_dom($doc);
                $images = $xml->xpath('//img');
                ?>
                <div class="card" data-toggle="modal" data-target="#southandaman">
                    <img src="img/15.jpg" class="card-img-top" alt="ภาคใต้(ฝั่งตะวันตก)">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">
                            <?php
                            foreach ($images as $img)
                            {
                                echo "<img src='" . $imgforecast = $img['src'] . "'/>";
                            }
                            ?> ภาคใต้(ฝั่งตะวันตก)</h5>
                        <p class="card-text" style="text-indent: 2.5em;">
                            <?php
                            $content = preg_replace("/<img[^>]+\>/i", "", $description[1]);
                            echo $content;
                            ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Modal south andaman gulf daily forecast -->
            <div class="modal fade" id="southandaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">พยากรณ์อากาศประจำวัน <?php echo $sql?> ภูมิภาค: ใต้(ฝั่งตะวันตก)</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="font-size: 36px; color: red; font-weight: bold;">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" >
                            <div align="center">
                                <img src="img/15.jpg" class="img-fluid" width="50%"  alt="ภาคใต้(ฝั่งตะวันตก)">
                            </div>
                            <div style="text-indent: 2.5em;" class="mt-4 mb-1">
                                <?php
                                echo "<div class='mb-1'>" . $content . "</div><br/>";
                                echo $description[2];
                                echo "<div style='text-indent: 2.5em;'>" . $description[3] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[4] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[5] . "</div>";
                                echo "<div style='text-indent: 2.5em;'>" . $description[6] . "</div>";
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historical weather daily forecast -->
        <div class="row mt-3" align="center">
            <div class="col-md-12 mb-3">
<!--                <h4 class="text-center font-weight-bold">ข้อมูลพยากรณ์อากาศประจำวัน(ย้อนหลัง) ระดับภูมิภาค</h4>-->
                <h2 class="mt-5 font-weight-bold" align="center">แสดงผลการพยากรณ์อากาศประจำวัน ระดับภูมิภาค(ย้อนหลัง)</h2>
                <hr>
            </div>
<!--            <div class="col-md-6">-->
<!--                <div class="input-group mb-3">-->
<!--                    <div class="input-group-prepend">-->
<!--                        <span class="input-group-text bg-info text-white" id="basic-addon1" style="height: 38px;"><i class="fas fa-calendar-alt"></i></span>-->
<!--                    </div>-->
<!--                        <input type="text" class="form-control" id="start_date" placeholder="วันเริ่มต้น" readonly>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-md-6">-->
<!--                <div class="input-group mb-3">-->
<!--                    <div class="input-group-prepend">-->
<!--                        <span class="input-group-text bg-info text-white" id="basic-addon1" style="height: 38px;"><i class="fas fa-calendar-alt"></i></span>-->
<!--                    </div>-->
<!--                        <input type="text" class="form-control" id="end_date" placeholder="วันสิ้นสุด" readonly>-->
<!--                </div>-->
<!--            </div>-->
        </div>
<!--        <div class="row mt-2" align="left">-->
<!--            <div>-->
<!--                <button id="filter" class="btn btn-outline-info btn-sm"><i class="fas fa-filter"></i> กรองข้อมูล</button>-->
<!--                <button id="reset" class="btn btn-outline-warning btn-sm"><i class="fas fa-trash"></i> ล้างการกรอง</button>-->
<!--            </div>-->
<!--        </div>-->

        <div class="row mt-3 mb-5" align="center">
            <div class="table-responsive">
                <table class="table table-borderless display nowrap" id="records" style="width:100%">
                    <thead>
                    <tr>
                        <th>ที่</th>
                        <th>ว/ด/ป. เวลา : </th>
                        <th>ภูมิภาค : </th>
                        <th>พยากรณ์ระดับจังหวัดที่ 1 : </th>
                        <th>พยากรณ์ระดับจังหวัดที่ 2 : </th>
                        <th>พยากรณ์ระดับจังหวัดที่ 3 : </th>
                        <th>พยากรณ์ระดับจังหวัดที่ 4 : </th>
                        <th>ผลการพยากรณ์ประจำวัน(ระดับภูมิภาค) : </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="row mt-5 mb-3">
            <!-- footer -->
            <div class="col-md-12" align="center">
                © 2021 All rights reserved | Dev by <a style="text-decoration: none;" href="https://www.facebook.com/PharadornB/">Pharadorn Boonruam</a>
            </div>
        </div>
    </div>

    <button id="topBtn"><i class="fas fa-arrow-up"></i></button>

    <!-- jQuery first -->
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <!-- Boostrap js v5 -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
    <!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Datatables -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>
    <!-- Moment js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <!-- Use datepicker from jquery -->
    <script>
        window.addEventListener("load", function () {
            const loader = document.querySelector(".loader");
            loader.className += " hidden"; // class "loader hidden"
        });

        $(document).ready(function(){
            $(window).scroll(function(){
                if($(this).scrollTop() > 40){
                    $('#topBtn').fadeIn();
                } else{
                    $('#topBtn').fadeOut();
                }
            });

            $("#topBtn").click(function(){
                $('html ,body').animate({scrollTop : 0},800);
            });
        });

        $(function() {
            $("#start_date").datepicker({
                "dateFormat": "dd/mm/yy"
                // "timepicker" : "false" ,
                // "lang" : "th",  // แสดงภาษาไทย
                // "yearOffset" : "543",  // ใช้ปี พ.ศ. บวก 543 เพิ่มเข้าไปในปี ค.ศ
                // "inline" : "true"
            });
            $("#end_date").datepicker({
                "dateFormat": "dd/mm/yy"
            });
        });
    </script>

    <!-- fetch data from api using ajax-->
    <script>
        function fetch(start_date, end_date) {
            $.ajax({
                url: "forecast.php",
                type: "POST",
                data: {
                    start_date: start_date,
                    end_date: end_date
                },
                dataType: "json",
                success: function(forecast) {
                    var i = "1";
                    $('#records').DataTable({
                        "pageLength": 7,
                        //"lengthMenu": [[10, 25, 50], [10, 25, 50]]
                        "data": forecast,
                        "dom":  "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
                                "<'row'<'col-sm-12'tr>>" +
                                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                        "buttons": [
                            'copy', 'excel'
                        ],
                        // responsive
                        "responsive": true,
                        "columns": [{
                            "width": "2%",
                            "data": "id",
                            "render": function(data, type, row, meta) {
                                return i++;
                                }
                            }, {
                                "width": "5%",
                                "data": "pubDate",
                                "render": function(data, type, row, meta) {
                                    return moment(row.pubDate).format('DD-MM-YYYY h:mm A');
                                }
                            }, {
                                "data": "region",
                                "width": "15%"
                            }, {
                                "data" : "province_1",
                                "width": "10%"
                            }, {
                                "data" : "province_2",
                                "width": "10%"
                            }, {
                                "data" : "province_3",
                                "width": "10%"
                            }, {
                                "data" : "province_4",
                                "width": "10%"
                            }, {
                                "data" : "description",
                            }
                        ]
                    });
                }
            });
        }
        fetch();

        // Filter
        $(document).on("click", "#filter", function(e) {
            e.preventDefault();
            var start_date = $("#start_date").val();
            var end_date = $("#end_date").val();
            if (start_date == "" || end_date == "") {
                alert("โปรดเลือกทั้ง 2 ข้างในการกรองช้อมูล");
            } else {
                $('#records').DataTable().destroy();
                fetch(start_date, end_date);
            }
        });

        // Reset
        $(document).on("click", "#reset", function(e) {
            e.preventDefault();

            $("#start_date").val(''); // empty value
            $("#end_date").val('');

            $('#records').DataTable().destroy();
            fetch();
        });

    </script>

</body>
</html>