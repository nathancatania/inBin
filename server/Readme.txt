Put these files in the /var/www/html folder of an Apache server. PHP must be installed.

post.php:
  Captures data sent by client-side script.
  Data is: device ID, sensor measurment, public IP address, location, authentication key
  
  Checks authentication key against hardcoded one. If they don't match, the data is discarded.
  This prevents people messing with our sensor data by posting garbage data. Not accepted without key.
  
  Currently saves data to .txt file on server. Each variable is on a new line.
  
  Need to change this to MySQLi database.
  .txt file was used as initial quick/dirty method to get prototype running.
  SQL database is better but not priority right now for project.
  
  Note: In order to save data, two folders need to be created with permission for Apache Read/Write access:
  /debug and /sensordata
  
  post.php saves debug information to /debug/debug.txt and sensor data recieved via POST to /sensordata/<deviceID>.txt
  
verify.php
  Basic file that retrieves data saved when POST was processed.
  Also uses location data saved with Google Maps Static API to display sensor location.
  Basis for Dashboard that displays this information.
