<!DOCTYPE html>
<!--
Summary Page for sensors:
  * Links to all sensors (the ones that have data for demo purposes)
  * Global graphs/data for the Reward System & inBin app.

Using Bootstrap Dashboard Template
Modified by: Nathan Catania
Team inBin - RMIT Univeristy
Telstra University Challenge 2016
-->

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Nathan Catania">
    <link rel="icon" href="">

    <title>Analytics | My Dashboard | inBin</title>

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

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

          // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawAgeChart);
      google.setOnLoadCallback(drawImpressMonthChart);
      google.setOnLoadCallback(drawRewardChart);
      google.setOnLoadCallback(drawImpressDailyChart);
      google.setOnLoadCallback(drawRewardRedemptions);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawAgeChart() {

      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Age');
      data.addColumn('number', 'Users');
      data.addRows([
        ['<13 Years', 80],
        ['13-18 Years', 156],
        ['19-30 Years', 147],
        ['30-40 Years', 126],
        ['40-50 Years', 91],
        ['50-65 Years', 45],
        ['65+ Years', 27]
      ]);

      // Set chart options
      var options = {'title':'Overall User Age Groups',
                     'width':400,
                     'height':300,
                     'chartArea': {'width': '100%', 'height': '80%'},};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('agechart_div'));
      chart.draw(data, options);
    }

    function drawImpressMonthChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Month');
      data.addColumn('number', "");

      data.addRows([
        [new Date(2015, 08), 1207],
        [new Date(2015, 09), 1210],
        [new Date(2015, 10), 1192],
        [new Date(2015, 11), 1172],
        [new Date(2016, 0), 1142],
        [new Date(2016, 1), 1160],
        [new Date(2016, 2), 1207],
        [new Date(2016, 3), 1218],
        [new Date(2016, 4), 1211]
      ]);

      var options = {
        title: 'Total Number of inBin App impressions per month',
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
            max: 1300
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
        [{v: [8, 0, 0], f: '8 am'}, 58],
        [{v: [9, 0, 0], f: '9 am'}, 54],
        [{v: [10, 0, 0], f: '10 am'}, 57],
        [{v: [11, 0, 0], f: '11 am'}, 62],
        [{v: [12, 0, 0], f: '12 pm'}, 63],
        [{v: [13, 0, 0], f: '1 pm'}, 65],
        [{v: [14, 0, 0], f: '2 pm'}, 64],
        [{v: [15, 0, 0], f: '3 pm'}, 66],
        [{v: [16, 0, 0], f: '4 pm'}, 67],
        [{v: [17, 0, 0], f: '5 pm'}, 68],
        [{v: [18, 0, 0], f: '6 pm'}, 66],
        [{v: [19, 0, 0], f: '7 pm'}, 60],
        [{v: [20, 0, 0], f: '8 pm'}, 55],
        [{v: [21, 0, 0], f: '9 pm'}, 53],
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
            max: 75
          }
        }
      };

      var chart = new google.visualization.AreaChart(document.getElementById('dailyimpress_div'));
      chart.draw(data, options);

    }

    function drawRewardChart() {

      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Age');
      data.addColumn('number', 'Users');
      data.addRows([
        ['Artslet Wi-Fi', 130],
        ['Eleven Eleven', 156],
        ['McBurgers', 246]
      ]);

      // Set chart options
      var options = {'title':'Reward Popularity',
                     'width':400,
                     'height':300,
                     'chartArea': {'width': '100%', 'height': '80%'},};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('rewardchart_div'));
      chart.draw(data, options);
    }

    function drawRewardRedemptions() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Reward');
      data.addColumn('number', 'Number of Redemptions');
      data.addColumn({type: 'string', role: 'style' });

      data.addRows([
        ['Artslet Wi-Fi',   130, 'blue'],
        ['Eleven Eleven',   156, 'green'],
        ['McBurgers',  246, 'red']
      ]);

      var options = {
        title: 'Number of Redemptions per Reward',
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
          title: 'Reward',
        },
        vAxis: {
          title: 'Number of Redemptions'
        }
      };

      var chart = new google.visualization.ColumnChart(document.getElementById('rewardredemptions_div'));
      chart.draw(data, options);
    }

    </script>

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
          <h2 class="sub-header">Analytics - All Sensors</h2>
          <div class="row">
            <div class="col-sm-4">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Demo Sensors</h3>
                </div>
                <div class="panel-body">
                  <ul>
                    <li><a href="demo,0001.php">demo,0001</a></li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">M31 Sensors</h3>
                </div>
                <div class="panel-body">
                  <ul>
                    <li><a href="hume,0001.html">hume,0001</a></li>
                    <li><a href="hume,0002.html">hume,0002</a></li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">Beach Sensors</h3>
                </div>
                <div class="panel-body">
                  <ul>
                    <li><a href="beach,0001.html">beach,0001</a></li>
                    <li><a href="beach,0002.html">beach,0002</a></li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-sm-4">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h3 class="panel-title">MEL-CBD Sensors</h3>
                </div>
                <div class="panel-body">
                  <ul>
                    <li><a href="cbd,0001.html">cbd,0001</a></li>
                    <li><a href="cbd,0002.html">cbd,0002</a></li>
                  </ul>
                </div>
              </div>
            </div>


          </div>

          <h2 class="sub-header">Analytics - Global Rewards</h2>
          <div class="row">
            <div class="col-sm-6">
              <div id="rewardredemptions_div" style="width:400; height:300;"></div>
            </div>
            <div class="col-sm-6">
              <div id="rewardchart_div" style="width:400; height:300;"></div>
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
