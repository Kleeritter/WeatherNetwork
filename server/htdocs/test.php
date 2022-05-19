<!DOCTYPE html>
<html lang="de">
   <head >
      <title>Kleefelder Wetternetz, Wetter unabhänig, studentisch, schön </title>
      <meta name="Description" CONTENT="Ein freiwilliges Wettermessnetz von Studierenden aus Hannover. Sehen sie wie schön Wettervoerhesagen sein können.">
      <meta http-equiv="pragma" content="no-cache" />
      <link rel="icon" type="image/x-icon" href="/tausch/favicon.ico">
      <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
      <link rel="stylesheet" href="style.css?v=<?= filemtime('style.css') ?>">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/2.0.0-alpha0/date_fns.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" integrity="sha256-6XMVI0zB8cRzfZjqKcD01PBsAy3FlDASrlC8SxCpInY=" crossorigin="anonymous"></script>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   </head>
   <body >
   <div class="header">
     <h1 style="text-align:center;"> Kleefelder Wetternetz</h1>

      </div>
      <ul>
      <li><a class="active" href="index.php">Home</a></li>
      <li><a href="anfrage.php">Messdaten</a></li>
      <li><a href="archiv.php">Archiv</a></li>
      <li><a href="impressum.php">Impressum</a></li>
     </li>
     </ul>
      <h2 style="text-align:center;"> Ursprung</h2>
      <p style="text-align:center;"> Das Kleefelder Wetternetzt ist ein Zusammenschluss einiger
          Studierender der Meteorologie aus Hannover, welche die meteorologischen Parameter 
          an den eigenen Standorten genauer untersuchen wollen. Die dazu benötigten Messgeräte und Infrastruktunren wurden eigenständig erbaut und integriert. Dadurch agieren wir unabhängig und können lokal unsere Vision von Wetter darstellen.</p>
          <p style="text-align:center;"> Kleefeld ist dabei Sitz unserer Zentrale von der aus wir die anderen Messstationen verwalten können.
          Bei Intresse an dem Projekt gerne <a href="impressum.php">kontaktieren</a>. Unsere Ideen basieren auf Elementen von  <a href="https://www.windy.com/">Windy</a> und <a href="https://kachelmannwetter.com/de">KachelmannWetter</a>
          </p>
     <h2 style="text-align:center;"> Messdaten</h2>
      <p style="text-allign:center;"> Hier kann das Datum verändert werden.
    </p>
      <form action="anfrage.php" method="get">
      <label for="datum">Datum:</label>
      <input type="date" id="datum" name="datum"> 
      <input type="submit">
      </form>
      <form action="Zeitraum.php" method="get">
      <label for="datum">Zeitraum:</label>
      <input type="date" id="zeit1" name="zeit1"> 
      <input type="date" id="zeit2" name="zeit2"> 
      <input type="submit">
      </form>
     
       <!-- Chart div container -->


  
<div class="alles">
  <div id="map"></div> 
    <div class="aufklapper">  
   <h3> Aktuelle Messdaten </h3>
      <div class="tauf">
       <canvas id="indext"></canvas> 
     </div>
     
      <div class="pauf">
      <canvas id="indexp" ></canvas>
      </div>
      
      <div class="hauf">
      <canvas id="indexh" ></canvas>
      </div>
    </div>
</div>
      <h3 style="text-align:center;"> Karte des Messnetzes</h2>

<script>
$(document).ready(function(){
  $("77").click(function(){
    $("#aufklapper").fadeIn();
  });
});
</script>

  
<div class="alla">
  <div class="MaxTf"><p class="Count"  style="color:#bf616a"id="maxTi"></p>
  <p id="maxTdi"></p></div>
  <div class="MinTf"><p class="Count" id="minTi" style="color:#5e81ac"></p>
    <p id="minTdi"></p></div>
  <div class="MittelTf"><p > X̅</p> <p class="Count" id ="mimTi"></p><p > °C </p></div>
  <div class="MittelPf"><p > X̅ </p><p class="Count" id="mimPi"></p><p > hPa </p></div>
  <div class="MinPf"><p class="Count" id="minPi" style="color:#5e81ac"></p>  <p id="minPdi"></p></div>
  <div class="MaxPf"><p class="Count" id="maxPi" style="color:#bf616a"></p>   <p id="maxPdi"></p></div>
</div>
 
   <?php
    include('testdata.php');
  ?>
  


<script src="balla.js?version=<?php echo rand() ; ?>"></script>
<script>
 var map = L.map('map').setView([52.79640, 9.44711], 7);
 const attribution = 
 '&copy; <a href="https://www.openstreetmap.org/copyright"> OpenStreetMap </a> contributors';
//const tileUrl= 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
const tileUrl='https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png';
const tiles = L.tileLayer(tileUrl,{attribution});
tiles.addTo(map);
var marker = L.marker([52.3755359, 9.7881984]).on('click',balla(null,'da:bf:c0:14:1a:10',jsonData)).addTo(map);
var vimarker = L.marker([52.1526118, 8.9698211]).on('click',balla(null,'26:62:ab:0a:fb:ed',jsonData)).addTo(map); //on('click', onClick).
var leomarker =L.marker([52.34334888515247, 9.545614293617046]).addTo(map);
var kilianmarker = L.marker([52.91666672618983, 9.265516100627243]).addTo(map);

 </script>
   <script> var abso= JSON.parse('<?=$jsonStr; ?>');</script>

   </body>
<script>
$('.Count').each(function () {
  var $this = $(this);
  jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
    duration: 3000,
    easing: 'swing',
    step: function () {
      $this.text(this.Counter.toFixed(2));
    }
  });
});
</script>
</html>

