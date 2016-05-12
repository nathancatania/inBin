<?php
  // Nathan Catania
  // 11/05/2016

  // Test retreiving data from sensor file

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

  $data = file('sensordata/melCBD,-37.809379,144.963595.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

  $deviceid = $data[0];
  $distance = $data[1];
  $publicip = $data[2];
  $latitude = $data[3];
  $longitude = $data[4];

  echo "<h1><b>Sensor Data</h1></b><br>";
  echo "<b>Device ID: </b><br>".$deviceid."<br><br>";
  echo "<b>Distance Measurement: </b><br>".$distance." mm<br><br>";
  echo "<b>Public IP Address: </b><br>".$publicip."<br><br>";
  echo "<b>Location Co-ordinates: </b><br>".$latitude.", ".$longitude."<br><br>";

  $str = "https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=300x200&scale=2&markers=color:green%7C".$latitude.",".$longitude."&key=".$apikey;
  echo "<img src='".$str."'>"
?>
