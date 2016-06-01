<?php
  // Nathan Catania
  // 11/05/2016

  // Test retreiving data from sensor file
  // Not actually used in Live Site
  // Only used for testing POST data

  // Google Maps Static API Key
  $apikey = "AIzaSyA1dIX0t-fcAlQjaivIiO8z2Hai57Lr6cw";

  /*
  5 elements total in file
  File order is:
    x[0] == device ID
    x[1] == distance measurement
    x[2] == Public IP Address of sensor
    x[3] == latitude co-ordinate of sensor (hardcoded on sensor)
    x[4] == longitude co-ordinate of sensor (hardcoded on sensor)
  */

  $data = file('sensordata/demo,0001.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  $deviceid = $data[0];
  $distance = $data[1];
  $publicip = $data[2];
  $latitude = $data[3];
  $longitude = $data[4];
  $fill = $data[5];
  $capacity = $data[6];
  $empty = $data[7];


  // Output data
  echo "<h1><b>Sensor Data</h1></b><br>";
  echo "<b>Device ID: </b><br>".$deviceid."<br><br>";
  echo "<b>Distance Measurement: </b><br>".$distance." mm<br><br>";
  echo "<b>Bin Capacity: </b><br>".$capacity." mm<br><br>";
  echo "<b>Fill Level: </b><br>";
  if($fill > 0.93) {
    echo "FULL<br><br>";
  }
  else {
    echo (round($fill * 100))." %<br><br>";
  }

  echo "<b>Empty variable: </b><br>".$empty."<br><br>";
  echo "<b>Requires Emptying? </b><br>";
  if($empty) {
    echo "YES<br><br>";
  }
  else {
    echo "No<br><br>";
  }

  echo "<b>Public IP Address: </b><br>".$publicip."<br><br>";
  echo "<b>Location Co-ordinates: </b><br>".$latitude.", ".$longitude."<br><br>";

  $str = "https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=200x200&scale=2&markers=color:red%7C".$latitude.",".$longitude."&key=".$apikey;
  echo "<img src='".$str."'>"
?>
