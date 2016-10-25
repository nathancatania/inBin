<?php

  /*
  Overview Page for all sensors

  Using Bootstrap Dashboard Template
  Modified by: Nathan Catania
  PHP Code by: Nathan Catania
  Team inBin - RMIT Univeristy
  Telstra University Challenge 2016
  */

  $apikey = "AIzaSyBXp9xKv8mrfKhmgs5ThelK7rscvIKQL0c"; // Used for Google APIs

  // Load data from db
  $data = file('sensordata/demo,0001.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  // Store values for access
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

    <title>Overview | My Dashboard | inBin</title>

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
            <li class="active"><a href="overview.php">Overview</a></li>
            <li><a href="details.php">Sensor Details</a></li>
            <li><a href="analytics.php">Analytics</a></li>
            <li><a href="index.html">Logout ></a></li>
            <li><a href="#">Help</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="overview.php">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="details.php">Sensor Details</a></li>
            <li><a href="#">Analytics</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Welcome Demo User!</h1>
          <ul><li style="color:red">There are sensors that require your attention.</li></ul><br>

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

          <h2 class="sub-header">Notifications</h2>
          <div class="row">
            <div class="col-sm-6">

              <?php
                if($empty) {
                  echo ('<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4>Demo Sensor</h4>
                  <p>There is <b>1</b> bin that requires emptying.</p>
                  <p><button type="button" class="btn btn-warning">Assign TOW</button></p></div>');
                }
              ?>
              <div class="alert alert-warning alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4>M31 [Hume Highway]</h4>
                <p>There are <b>2</b> bins that require emptying.</p>
                <p><button type="button" class="btn btn-warning">Assign TOW</button></p>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4>CBD</h4>
                <p>There are <b>3</b> sensors offline!</p>
                <p>There are <b>5</b> bins that require emptying.</p>
                <p><button type="button" class="btn btn-danger">Raise maintenance SR</button> <button type="button" class="btn btn-danger">Assign TOW</button></p>
              </div>
            </div>



          </div>



        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
