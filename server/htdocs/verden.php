<!DOCTYPE html>
<html lang="de">
   <head>
   <meta charset="utf-8">
      <title> Nordwestmessnetz, Wetter von Studierenden </title>
      <meta name="Description" CONTENT="Ein freiwilliges Wettermessnetz von Studierenden aus Hannover. Hyperlokale Wetterdaten aus der Region Hannover.">
      <meta http-equiv="pragma" content="no-cache">
      <meta name="google-site-verification" content="G2FfY-3Bwk2N1tb6hU6Yp-hWgJlepllzPKD59j0zdCY" />
      <meta name="viewport" content="width=device-width, initial-scale=1"/>
      <link rel="icon" type="image/x-icon" href="/tausch/favicon.ico">
      <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
      <link rel="stylesheet" href="style.css?v=<?= filemtime('style.css') ?>">
      <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
    </head>
       <body>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/2.0.0-alpha0/date_fns.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     <!-- <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
      -->
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=" crossorigin="anonymous"></script>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
 

   <div class="header">
     <h1 style="text-align:center;"> Messtation Verden </h1>

      </div>
     <div class="navbar" id="navbar">
  <a href="/index.php">Home</a>
  <a href="anfrage.php">Messdaten</a>
  <div class="dropdown">
    <button class="dropbtn" id="buton">Archiv 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" id="alla">
      <a href="archiv/2014.php">2014</a>
      <a href="archiv/2015.php">2015 </a>
      <a href="archiv.php">2017 </a>
    </div>
  </div> 
  <a href="impressum.php">Impressum</a>
</div>


     <h2 style="text-align:center;"> Messdaten</h2>
     
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
    $query = "SELECT * FROM temperature where  sender_id='verden'";
    //storing the result of the executed query
    $result = $conn->query($query);
    //initialize the array to store the processed data
    $jsonArray = array();
    //check if there is any data returned by the SQL Query
    if ($result->num_rows > 0) {
      //Converting the results into an associative array
      while($row = $result->fetch_assoc()) {
        $jsonArrayItem = array();
        $jsonArrayItem['sender_id'] = $row['sender_id'];
        $jsonArrayItem['label'] = $row['datum'];
        $jsonArrayItem['tempe'] = $row['temp'];
        $jsonArrayItem['humid'] = $row['humidity'];
        $jsonArrayItem['pressure'] = $row['pressure'];
        $jsonArrayItem['windu'] = $row['windu'];
        //append the above created object into the main array.
        array_push($jsonArray, $jsonArrayItem);
      }
    }
    //Closing the connection to DB
    $conn->close();
    //set the response content type as JSON
    $jsonStr=json_encode($jsonArray);
    $jsonStrong=json_encode($jsonArrayITem['label']);
 
?>
<script>
var jsonData= JSON.parse('<?=$jsonStr; ?>');

</script>



      <div class="vollt">
       <canvas id="vollt"></canvas> 
     </div>
     
      <div class="vollp">
      <canvas id="vollp" ></canvas>
      </div>

 <div class="MaxTf"><p class="Count"  style="color:#bf616a"id="maxTi"></p>
  <p class="Datum" id="maxTdi"></p></div>
  <div class="MinTf"><p class="Count" id="minTi" style="color:#5e81ac"></p>
 <p class="Datum" id="minTdi"></p></div>
  <div class="MittelTf"><p class="Count" id ="mimTi"></p><p class="Datum"> °C </p></div>
  <div class="MittelPf"><p class="Count" id="mimPi"></p><p class="Datum" > hPa </p></div>
  <div class="MinPf"><p class="Count" id="minPi" style="color:#5e81ac"></p>  <p class="Datum" id="minPdi"></p></div>
  <div class="MaxPf"><p class="Count" id="maxPi" style="color:#bf616a"></p>   <p class="Datum" id="maxPdi"></p></div>
  <div class="tendenzp"><p class="Count"  style="color:#bf616a"id="tendenzpi"></p> <p class="Datum" > hPa </p>
</div> 

<script src="voll.js?version=<?php echo rand() ; ?>"></script>


      <h3 style="text-align:center;"> Karte des Messnetzes</h2>



  
 

  
      <div id="map"></div> 


<script>
 var map = L.map('map').setView([52.79640, 9.44711], 7);
 const attribution = 
 '&copy; <a href="https://www.openstreetmap.org/copyright"> OpenStreetMap </a> contributors';
const tileUrl= 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
//const tileUrl='https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png';
const tiles = L.tileLayer(tileUrl,{attribution});
tiles.addTo(map);
var kilianmarker = L.marker([52.91666672618983, 9.265516100627243]).addTo(map);
</script>

<h2 style="text-align:center;"> Livestream</h2>
<video id="myplayer" class="video-js vjs-fluid" poster="/path-to-poster.jpg" controls preload="auto">
<source src="http://www.domain.com/live_manifest.m3u8" type="application/x-mpegURL">
</video>

<script>
var player = videojs('myplayer'); 
player.nuevo();
</script>     

   </body>

</html>

