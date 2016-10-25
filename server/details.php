<?php

  /*
  Detailed List of all sensors
  demo,0001 is Raspberry Pi

  Using Bootstrap Dashboard Template
  Modified by: Nathan Catania
  PHP Code by: Nathan Catania
  Team inBin - RMIT Univeristy
  Telstra University Challenge 2016
  */

  $apikey = "AIzaSyBXp9xKv8mrfKhmgs5ThelK7rscvIKQL0c";

  $data = file('sensordata/EnGenius,0001.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  $deviceid = $data[0];
  $distance = $data[1];
  $publicip = $data[2];
  $latitude = $data[3];
  $longitude = $data[4];
  $fill = $data[5];
  $capacity = $data[6];
  $empty = $data[7];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Nathan Catania">
    <link rel="icon" href="">

    <title>Sensor Details | My Dashboard | inBin</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <style type="text/css">
      .navbar-brand {
        padding: 0px; /* firefox bug fix */
      }
      .navbar-brand>img {
        height: 100%;
        padding: 10px; /* firefox bug fix */
        width: auto;
      }

      .navbar-brand>img {
        max-height: 100%;
        height: 100%;
        width: auto;
        margin: 0 auto;


        /* probably not needed anymore, but doesn't hurt */
        -o-object-fit: contain;
        object-fit: contain;
      }
    </style>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.html"><img src="images/navlogo_dark.png" alt="inBin"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="overview.php">Overview</a></li>
            <li class="active"><a href="details.php">Sensor Details</a></li>
            <li><a href="analytics.php">Analytics</a></li>
            <li><a href="dashboard.html">Return to Dashboard</a></li>
            <li><a href="#">Help</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="overview.php">Overview</a></li>
            <li class="active"><a href="details.php">Sensor Details<span class="sr-only">(current)</span></a></li>
            <li><a href="analytics.php">Analytics</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Sensor Details</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="https://maps.googleapis.com/maps/api/staticmap?size=200x200&scale=2&markers=size:mid%7Ccolor:red%7C-37.809014,144.963751&key=AIzaSyBXp9xKv8mrfKhmgs5ThelK7rscvIKQL0c" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Live Demo</h4>
              <span class="text-muted">1 Online. 0 Offline.</span>
              <?php
                if($empty) {
                  echo '<h4><span class="label label-warning">Status: Attention!</span></h4>';
                }
                else {
                  echo '<h4><span class="label label-success">Status: OK</span></h4>';
                }
              ?>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="https://maps.googleapis.com/maps/api/staticmap?size=200x200&scale=2&markers=size:mid%7Ccolor:red%7C-36.943727,145.211364%7C-36.873829,145.280640%7C-36.804403,145.467603&key=AIzaSyBXp9xKv8mrfKhmgs5ThelK7rscvIKQL0c" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>M31 Sensors</h4>
              <span class="text-muted">3 Online. 0 Offline.</span>
              <h4><span class="label label-warning">Status: Attention!</span></h4>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="https://maps.googleapis.com/maps/api/staticmap?size=200x200&scale=2&markers=size:mid%7Ccolor:red%7C-38.417307,144.822263%7C-38.414844,144.817757&key=AIzaSyBXp9xKv8mrfKhmgs5ThelK7rscvIKQL0c" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Beach Sensors</h4>
              <span class="text-muted">2 Online. 0 Offline.</span>
              <h4><span class="label label-success">Status: OK</span></h4>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="https://maps.googleapis.com/maps/api/staticmap?size=200x200&scale=2&markers=size:mid%7Ccolor:red%7C-37.809379,144.963595%7C-37.817699,144.967273%7C-37.811410,144.964774%7C-37.809709,144.963955%7C-37.810421,144.961562%7C-37.809929,144.969780%7C-37.813404,144.965724%7C-37.814591,144.966046%7C-37.815354,144.966572%7C-37.813303,144.962860%7C-37.817788,144.967925%7C&key=AIzaSyBXp9xKv8mrfKhmgs5ThelK7rscvIKQL0c" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>CBD Sensors</h4>
              <span class="text-muted">8 Online. 3 Offline.</span>
              <h4><span class="label label-danger">Status: Alert!</span></h4>
            </div>
          </div>

          <h2 class="sub-header">List: All Sensors</h2>
          <p><form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search for sensor...">
          </form></p>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Device ID#</th>
                  <th>Status</th>
                  <th>Fill Level</th>
                  <th>Requires Emptying?</th>
                  <th>IP Address</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><?php echo ('<a href=demo,0001.php>'.$deviceid.'</a>'); ?></td>
                  <td style="color:green">Online</td>
                  <td>
                    <?php if($fill > 0.93) {
                            echo "FULL";
                          }
                          else {
                            echo (round($fill * 100))." %";
                          }
                    ?>
                  </td>
                  <td>
                    <?php if($empty) {
                          echo "YES";
                        }
                        else {
                          echo "No";
                        }
                    ?>
                  </td>
                  <td><?php echo $publicip; ?></td>
                </tr>
                <tr>
                  <td><a href="hume,0001.html">hume,0001</a></td>
                  <td style="color:green">Online</td>
                  <td>78 %</td>
                  <td>YES</td>
                  <td>127.0.0.1</td>
                </tr>
                <tr>
                  <td><a href="hume,0002.html">hume,0002</a></td>
                  <td style="color:green">Online</td>
                  <td>FULL</td>
                  <td>YES</td>
                  <td>127.0.0.2</td>
                </tr>
                <tr>
                  <td>hume,0003</td>
                  <td style="color:green">Online</td>
                  <td>52 %</td>
                  <td>No</td>
                  <td>127.0.0.3</td>
                </tr>
                <tr>
                  <td><a href="beach,0001.html">beach,0001</a></td>
                  <td style="color:green">Online</td>
                  <td>44 %</td>
                  <td>No</td>
                  <td>127.0.2.1</td>
                </tr>
                <tr>
                  <td><a href="beach,0002.html">beach,0002</a></td>
                  <td style="color:green">Online</td>
                  <td>52 %</td>
                  <td>No</td>
                  <td>127.0.2.2</td>
                </tr>
                <tr>
                  <td><a href="cbd,0001.html">cbd,0001</a></td>
                  <td style="color:green">Online</td>
                  <td>27 %</td>
                  <td>No</td>
                  <td>127.0.1.1</td>
                </tr>
                <tr>
                  <td><a href="cbd,0002.html">cbd,0002</a></td>
                  <td style="color:red">Offline</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>cbd,0003</td>
                  <td style="color:green">Online</td>
                  <td>71 %</td>
                  <td>Yes</td>
                  <td>127.0.1.3</td>
                </tr>
                <tr>
                  <td>cbd,0004</td>
                  <td style="color:red">Offline</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>cbd,0005</td>
                  <td style="color:red">Offline</td>
                  <td>-</td>
                  <td>-</td>
                  <td>-</td>
                </tr>
                <tr>
                  <td>cbd,0006</td>
                  <td style="color:green">Online</td>
                  <td>FULL</td>
                  <td>Yes</td>
                  <td>127.0.1.6</td>
                </tr>
                <tr>
                  <td>cbd,0007</td>
                  <td style="color:green">Online</td>
                  <td>1 %</td>
                  <td>No</td>
                  <td>127.0.1.7</td>
                </tr>
                <tr>
                  <td>cbd,0008</td>
                  <td style="color:green">Online</td>
                  <td>17 %</td>
                  <td>No</td>
                  <td>127.0.1.8</td>
                </tr>
                <tr>
                  <td>cbd,0009</td>
                  <td style="color:green">Online</td>
                  <td>FULL</td>
                  <td>Yes</td>
                  <td>127.0.1.9</td>
                </tr>
                <tr>
                  <td>cbd,0010</td>
                  <td style="color:green">Online</td>
                  <td>86 %</td>
                  <td>Yes</td>
                  <td>127.0.1.10</td>
                </tr>
                <tr>
                  <td>cbd,0011</td>
                  <td style="color:green">Online</td>
                  <td>67 %</td>
                  <td>Yes</td>
                  <td>127.0.1.11</td>
                </tr>
                <tr>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
