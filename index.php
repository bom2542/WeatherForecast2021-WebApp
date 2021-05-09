<?php include_once('function.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[ Welcome ] WeatherForecast2021</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="style.css">
    <style>
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
    </style>
</head>
<body>

    <div class="container">

        <!-- Topic -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5 font-weight-bold" align="center">แสดงผลการพยากรณ์อากาศประจำวัน ระดับภูมิภาค</h2>
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
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-1">
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
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
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

        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
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
            <div class="col-md-12 mt-2">
                <h4 class="mt-5 font-weight-bold">แสดงผลการพยากรณ์อากาศประจำวัน ระดับภูมิภาค(ย้อนหลัง)</h4>
                <hr/>
            </div>
            <div class="col-md-2 mt-3" align="left">
                <h6 class="font-weight-bold">เลือกช่วงของข้อมูล : </h6>
            </div>
            <div class="col-md-4 mt-2" align="center">
                <input type="text" name="From" id="From" class="form-control" placeholder="วันเริ่มต้น"/>
            </div>
            <div class="col-md-4 mt-2" align="center">
                <input type="text" name="to" id="to" class="form-control" placeholder="วันสิ้นสุด"/>
            </div>
            <div class="col-md-2 mt-2"align="center">
                <input type="button" name="range" id="range" value="กรองข้อมูล" class="btn btn-success"/>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row mt-2 mb-5" align="center">
            <?php
            include_once("dbcon.php");
            $query = "SELECT * FROM orders ORDER BY id desc";
            $sql = mysqli_query($conn, $query);
            ?>
            <div id="purchase_order">
                <table class="table table-bordered">
                    <tr>
                        <th width="100">ID</th>
                        <th>Customer Name</th>
                        <th>Purchased Item</th>
                        <th>Purchased Date</th>
                        <th width="100">Price</th>
                    </tr>
                    <?php while($row= mysqli_fetch_array($sql)) { ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["customer_name"]; ?></td>
                            <td><?php echo $row["purchased_items"]; ?></td>
                            <td><?php echo $row["purchased_date"]; ?></td>
                            <td>$ <?php echo $row["price"]; ?></td>
                        </tr>
                    <?php } ?>
                </table>
        </div>

        <div class="row mt-5 mb-3">
            <!-- footer -->
            <div class="col-md-12" align="center">
                © 2021 All rights reserved | Dev by <a style="text-decoration: none;" href="https://www.facebook.com/PharadornB/">Pharadorn Boonruam</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.map"></script>
    <script>
        $(document).ready(function(){
            $.datepicker.setDefaults({
                dateFormat: 'yy-mm-dd'
            });
            $(function(){
                $("#From").datepicker();
                $("#to").datepicker();
            });

            $('#range').click(function(){
                var From = $('#From').val();
                var to = $('#to').val();
                if(From != '' && to != '')
                {
                    $.ajax({
                        url:"forecast.php",
                        method:"POST",
                        data:{From:From, to:to},
                        success:function(data)
                        {
                            $('#purchase_order').html(data);
                            $('#purchase_order').append(data.htmlresponse);
                        }
                    });
                }
                else
                {
                    alert("Please Select the Date");
                }
            });
        });
    </script>
</body>
</html>