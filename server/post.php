<?php
  // Nathan Catania
  // 11/05/2016

  // This script is run when data is sent via POST from the RPi sensor


  // Use to strip HTML from input & prevent XSS Attack
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  // Check to see if Data has been received at all
  // if no data, output info to debug file. Else, save data.
  if(empty($_POST)) {
    $file = 'debug/debug.txt';
    file_put_contents($file, 'POST data NOT received!');
  }
  else {

    // PROCESSING SENSOR data
    $distance = test_input($_POST["distance"]);
    $publicip = test_input($_POST["publicip"]);
    $latitude = test_input($_POST["latitude"]);
    $longitude = test_input($_POST["longitude"]);
    $keyRX = $_POST["key"];
    // *** WARNING! deviceID is PRIMARY KEY FOR DB AND MUST BE UNIQUE! ***
    $deviceid = test_input($_POST["deviceID"]);

    // DEBUG STUFF
    $file = 'debug/debug.txt';
    $str = "WE GOT POST!\n$distance\n$publicip\n$deviceid";
    file_put_contents($file, $str);

    // *** WARNING! POST data should ONLY be kept if keyRX matches below key ***
    $key = "xNdp9LbK9PSUTYRFDWk2Jr"; // prevents unauthorised POST to server

    if ($key === $keyRX) {

      $str = "\nKey check PASSED!";
      file_put_contents($file, $str, FILE_APPEND);

      $filename = "sensordata/$deviceid.txt";

      // verifies if file can be opened
      if ($fh = fopen($filename, "w")) {
  	      fwrite($fh, "$deviceid\n");
          fwrite($fh, "$distance\n");
          fwrite($fh, "$publicip\n");
          fwrite($fh, "$latitude\n");
          fwrite($fh, "$longitude\n");
          fclose($fh);
      }
      else {
        // failed to open file
        $str = "Issue writing data to $deviceid.txt file";
        file_put_contents($file, $str, FILE_APPEND);
      }

    } // end if
    else {
      // do nothing
      // data is discarded
      $str = "\nKey mismatch. Data is being discarded...";
      file_put_contents($file, $str, FILE_APPEND);
    }
  } // end POST check ELSE
?>
