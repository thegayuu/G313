<?php

$filetxt = 'log.json';

// check if all form data are submited, else output error message

if(isset($_POST['batch']) && isset($_POST['lat']) && isset($_POST['lon'])) {
  // if form fields are empty, outputs message, else, gets their data
  if(empty($_POST['batch']) || empty($_POST['lat']) || empty($_POST['lon'])) {
    echo include('failure.html');
  }
  else {
    // gets and adds form data into an array
    $formdata = $json[$last] = array(
      
      'lat'=> $_POST['lat'],
      'lon'=> $_POST['lon'],
      'batch'=> $_POST['batch'],

    );

    // path and name of the file
    $filetxt = 'log.json';

    $arr_data = array();        // to store all form data

    // check if the file exists
    if(file_exists($filetxt)) {
      // gets json-data from file
      $jsondata = file_get_contents($filetxt);

      // converts json string into array
      $arr_data = json_decode($jsondata, true);
    }

    // appends the array with new form data
    $arr_data[] = $formdata;

    // encodes the array into a string in JSON format (JSON_PRETTY_PRINT - uses whitespace in json-string, for human readable)
    $jsondata = json_encode($arr_data, JSON_PRETTY_PRINT);

    // saves the json string in "formdata.txt" (in "dirdata" folder)
    // outputs error message if data cannot be saved
    if(file_put_contents('log.json', $jsondata)) include('success.html');
    else include('failure.html');
  }
}
else include('failure.html');
?>
