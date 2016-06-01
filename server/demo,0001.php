<?php

  /*
  Page for Demo Sensor attached to Raspberry Pi

  Using Bootstrap Dashboard Template
  Modified by: Nathan Catania
  PHP Code by: Nathan Catania
  Team inBin - RMIT Univeristy
  Telstra University Challenge 2016
  */

  $apikey = "AIzaSyA1dIX0t-fcAlQjaivIiO8z2Hai57Lr6cw"; // used for Google APIs

  // Grab DB file
  $data = file('sensordata/demo,0001.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  // Load values
  $deviceid = $data[0];
  $distance = $data[1];
  $publicip = $data[2];
  $latitude = $data[3];
  $longitude = $data[4];
  $fill = $data[5];
  $capacity = $data[6];
  $empty = $data[7];

  //

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

    <title>demo,0001 | My Sensors | inBin</title>

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

    <!-- GOOGLE CHARTS API -->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

          // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawAgeChart);
      google.setOnLoadCallback(drawImpressMonthChart);
      google.setOnLoadCallback(drawFillTimes);
      google.setOnLoadCallback(drawImpressDailyChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawAgeChart() {

      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Age');
      data.addColumn('number', 'Users');
      data.addRows([
        ['<13 Years', 15],
        ['13-18 Years', 50],
        ['19-30 Years', 40],
        ['30-40 Years', 20],
        ['40-50 Years', 20],
        ['50-65 Years', 10],
        ['65+ Years', 10]
      ]);

      // Set chart options
      var options = {'title':'User Age Groups [Demo]',
                     'width':400,
                     'height':300,
                     'chartArea': {'width': '100%', 'height': '80%'}
                   };

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('agechart_div'));
      chart.draw(data, options);
    }

    function drawImpressMonthChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Month');
      data.addColumn('number', "");

      data.addRows([
        [new Date(2015, 08), 0],
        [new Date(2015, 09), 0],
        [new Date(2015, 10), 0],
        [new Date(2015, 11), 0],
        [new Date(2016, 0), 0],
        [new Date(2016, 1), 0],
        [new Date(2016, 2), 5],
        [new Date(2016, 3), 24],
        [new Date(2016, 4), 51]
      ]);

      var options = {
        title: 'Number of inBin App impressions per month',
        legend: 'none',
        width: 400,
        height: 300,
        pointsVisible: true,
        pointSize: 5,
        // Gives each series an axis that matches the vAxes number below.
        series: {
          0: {targetAxisIndex: 0},
        },
        vAxes: {
          // Adds titles to each axis.
          0: {title: 'Number of Impressions'},
        },
        hAxis: {
          ticks: [new Date(2015, 8), new Date(2015, 9), new Date(2015, 10), new Date(2015, 11), new Date(2016, 0), new Date(2016, 1), new Date(2016, 2), new Date(2016, 3),
                  new Date(2016, 4), new Date(2016, 5)
                 ]
        },
        vAxis: {
          viewWindow: {
            max: 170
          }
        }
      };

      var chart = new google.visualization.AreaChart(document.getElementById('mthimpress_div'));
      chart.draw(data, options);

    }

    function drawImpressDailyChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', "Impressions");

      data.addRows([
        [{v: [8, 0, 0], f: '8 am'}, 0],
        [{v: [9, 0, 0], f: '9 am'}, 0],
        [{v: [10, 0, 0], f: '10 am'}, 1],
        [{v: [11, 0, 0], f: '11 am'}, 0],
        [{v: [12, 0, 0], f: '12 pm'}, 2],
        [{v: [13, 0, 0], f: '1 pm'}, 4],
        [{v: [14, 0, 0], f: '2 pm'}, 4],
        [{v: [15, 0, 0], f: '3 pm'}, 2],
        [{v: [16, 0, 0], f: '4 pm'}, 2],
        [{v: [17, 0, 0], f: '5 pm'}, 10],
        [{v: [18, 0, 0], f: '6 pm'}, 1],
        [{v: [19, 0, 0], f: '7 pm'}, 0],
        [{v: [20, 0, 0], f: '8 pm'}, 4],
        [{v: [21, 0, 0], f: '9 pm'}, 3],
      ]);

      var options = {
        title: 'Avg App Impressions per hour [this week]',
        legend: 'none',
        width: 400,
        height: 300,
        pointsVisible: true,
        pointSize: 5,
        // Gives each series an axis that matches the vAxes number below.
        series: {
          0: {targetAxisIndex: 0},
        },
        vAxes: {
          // Adds titles to each axis.
          0: {title: 'Number of Impressions'},
        },
        hAxis: {
          title: 'Time of Day',
          format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [21, 30, 0]
          }
        },
        vAxis: {
          viewWindow: {
            max: 15
          }
        }
      };

      var chart = new google.visualization.AreaChart(document.getElementById('dailyimpress_div'));
      chart.draw(data, options);

    }

    function drawFillTimes() {
      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', 'Fill Level');
      data.addColumn({type: 'string', role: 'annotation'});
      data.addColumn({type: 'string', role: 'style' });

      data.addRows([
        [{v: [8, 0, 0], f: '8 am'},   10, '10%', 'green'],
        [{v: [9, 0, 0], f: '9 am'},   14, '14%', 'green'],
        [{v: [10, 0, 0], f:'10 am'},  23, '23%', 'green'],
        [{v: [11, 0, 0], f: '11 am'}, 45, '45%', 'green'],
        [{v: [12, 0, 0], f: '12 pm'}, 74, '74%', 'orange'],
        [{v: [13, 0, 0], f: '1 pm'},  87, '87%', 'red'],
        [{v: [14, 0, 0], f: '2 pm'},  88, '89%', 'red'],
        [{v: [15, 0, 0], f: '3 pm'},  17, '17%', 'green'],
        [{v: [16, 0, 0], f: '4 pm'},  22, '22%', 'green'],
        [{v: [17, 0, 0], f: '5 pm'}, 18, '18%', 'green'],
        [{v: [18, 0, 0], f: '6 pm'}, 15, '15%', 'green'],
        [{v: [19, 0, 0], f: '7 pm'}, 10, '10%', 'green']
      ]);

      var options = {
        title: 'Average Bin Fill Level per hour [Demo]',
        legend: 'none',
        width: 400,
        height: 300,
        annotations: {
          alwaysOutside: false,
          textStyle: {
            fontSize: 10,
            color: '#333',
            auraColor: 'none'
          }
        },
        hAxis: {
          title: 'Time of Day',
          format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [19, 30, 0]
          }
        },
        vAxis: {
          title: 'Avg Fill Level (%)'
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('avgfill_div'));
      chart.draw(data, options);
    }

    </script>
    <!-- END GOOGLE CHARTS API -->

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
            <li><a href="details.php">Sensor Details</a></li>
            <li class="active"><a href="analytics.php">Analytics</a></li>
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
            <li><a href="details.php">Sensor Details</a></li>
            <li class="active"><a href="analytics.php">Analytics<span class="sr-only">(current)</span></a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php echo $deviceid; ?></h1>

          <div class="row">
            <div class="col-sm-4">
              <img src="https://maps.googleapis.com/maps/api/staticmap?size=250x250&scale=2&markers=color:red%7C-37.918961,145.239983" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <span style="text-align:center" class="text-muted"><b>IP Address: </b> <?php echo ($publicip.'<br>'); ?></span>
            </div>
            <div class="col-sm-6">
              <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h4>Online</h4>
                <p>No news is good news! This sensor is functioning normally.</p>
              </div>
              <?php
                if($empty) {
                  echo ('<div class="alert alert-warning alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4>Attention: Fill Level</h4>
                  <p>This bin requires emptying. Currently: ');
                  if($fill > 0.93) {
                      echo "FULL!";
                  }
                  else {
                      echo (round($fill * 100))." %";
                  }
                  echo '</p>';
                  echo ('<p><button type="button" class="btn btn-warning">Assign TOW</button></p></div>');
                }
                else {
                  echo ('<div class="alert alert-info alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4>Fill Level</h4>
                  <p>The fill level of this bin is within acceptable ranges. You will be notified when this changes. Currently: ');
                  if($fill > 0.93) {
                      echo "FULL!";
                  }
                  else {
                      echo (round($fill * 100))." %";
                  }
                  echo '</p></div>';
                }
              ?>
            </div>



          </div>

          <h2 class="sub-header">Analytics</h2>
          <div class="row">
            <div class="col-sm-6">
              <div id="avgfill_div" style="width:400; height:300;"></div>

            </div>
            <div class="col-sm-6">
              <div id="agechart_div" style="width:400; height:300"></div>
            </div>
            <div class="col-sm-6">
              <div id="mthimpress_div" style="width:400; height:300;"></div>
            </div>
            <div class="col-sm-6">
              <div id="dailyimpress_div" style="width:400; height:300;"></div>
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
