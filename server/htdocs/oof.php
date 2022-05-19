<!DOCTYPE html>
<html lang="de">
   <head >
      <title>Kleefelder Wetternetz</title>
      <link rel="icon" type="image/x-icon" href="/tausch/favicon.ico">
   </head>
   <body style="background-color:powderblue;">
      <h1 style="text-align:center;"> Kleefelder Wetternetzt</h1>
      <img src = "/tausch/frog.jpg"
      alt = "Monty der Kater" style="width:600px;height:600px;"/>
      <p><cite>Monty der schnucckelige Kater</cite> 2021.</p> 
      <h2 style="text-align:center;"> Ursprung</h2>
      <p style="text-align:center;"> Das Kleefelder Wetternetzt ist ein Zusammenschluss einiger
          Studierender der Meteorologie, welche die meteorologischen Parameter 
          an den eigenen Standorten genauer untersuchen wollen.</p>
      <h2 style="text-align:center;"> Messdaten</h2>
      <h3 style="text-align:center;"> Karte des Messnetzes</h2>
         <iframe title=" Messnetz" aria-label="Karte" id="datawrapper-chart-5l9DS" src="https://datawrapper.dwcdn.net/5l9DS/1/" scrolling="no" frameborder="0" style="width: 0; min-width: 100% !important; border: none;" height="595"></iframe><script type="text/javascript">!function(){"use strict";window.addEventListener("message",(function(e){if(void 0!==e.data["datawrapper-height"]){var t=document.querySelectorAll("iframe");for(var a in e.data["datawrapper-height"])for(var r=0;r<t.length;r++){if(t[r].contentWindow===e.source)t[r].style.height=e.data["datawrapper-height"][a]+"px"}}}))}();
         </script>
      <h2 style="text-align:center;"> Archiv</h2>
  
      <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
      </script>
      <script
      src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.js">
      </script>

<canvas id="myChart" style="width:400"></canvas>
<canvas id="myCharthumid" style="width:400"></canvas>
<?php
    //address of the server where db is installed
    $servername = "kleeritter.duckdns.org";
    //username to connect to the db
    //the default value is root
    $username = "root";
    //password to connect to the db
    //this is the value you would have specified during installation of WAMP stack
    $password = "lizuteras11";
    //name of the db under which the table is created
    $dbName = "weather_station";
    //establishing the connection to the db.
    $conn = new mysqli($servername, $username, $password, $dbName);
    //checking if there were any error during the last connection attempt
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    //the SQL query to be executed
    $query = "SELECT * FROM temperature";
    //storing the result of the executed query
    $result = $conn->query($query);
    //initialize the array to store the processed data
    $jsonArray = array();
    //check if there is any data returned by the SQL Query
    if ($result->num_rows > 0) {
      //Converting the results into an associative array
      while($row = $result->fetch_assoc()) {
        $jsonArrayItem = array();
        $jsonArrayItem['label'] = $row['datum'];
        $jsonArrayItem['tempe'] = $row['temp'];
        $jsonArrayItem['humid'] = $row['humidity'];
        //append the above created object into the main array.
        //array_push($jsonArray, $jsonArrayItem);
      }
    }
    //Closing the connection to DB
    $conn->close();
    //set the response content type as JSON
    $jsonStrong=json_encode($jsonArrayItem]);
 
?>

<script>
var jsonDatara= JSON.parse('<?=$jsonStrong; ?>');
console.log(jsonDatara);
 <script>
</html>

