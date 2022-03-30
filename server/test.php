<!DOCTYPE html>
<html lang="de">
   <head >
      <title>Kleefelder Wetternetz</title>
      <link rel="icon" type="image/x-icon" href="/tausch/favicon.ico">
      <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
      <link rel="stylesheet" href="style.css">
   </head>
   <body >
   <div class="header">
     <h1 style="text-align:center;"> Kleefelder Wetternetzt</h1>
      <img src = "/tausch/frog.jpg"
      alt = "Monty der Kater" style="width:600px;height:600px;"/>
      <p><cite>Monty der schnucckelige Kater</cite> 2021.</p> 
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
          Studierender der Meteorologie, welche die meteorologischen Parameter 
          an den eigenen Standorten genauer untersuchen wollen.</p>
      <h2 style="text-align:center;"> Messdaten</h2>
      <p style="text-allign:center;"> Hier kann das Datum verändert werden.
    </p>
      <form action="#" method="get">
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
      <h3 >Temperatur </h3>
   <div class="container">
  <div class="Temperaturgraf"><canvas id="myCharthumid"></canvas></div>
  <div class="Luftdruckgraf"><canvas id="myChart"></canvas></div>
  <div class="Niederschlaggraf">2</div>
  <div class="MaxT">3</div>
  <div class="MinT">4</div>
  <div class="MaxP">5</div>
  <div class="MinP">6</div>
  <div class="MaxSonne">7</div>
  <div class="GesammtNieder">8</div>
  <div class="MittelT">9</div>
  <div class="MittelP">10</div>
  <div class="Witterungsverhalten">11</div>
</div>


      <h3 >Luftdruck  </h3>
      <h3 style="text-align:center;"> Karte des Messnetzes</h2>
         <iframe title=" Messnetz" aria-label="Karte" id="datawrapper-chart-5l9DS" src="https://datawrapper.dwcdn.net/5l9DS/1/" scrolling="no" frameborder="0" style="width: 0; min-width: 100% !important; border: none;" height="700"></iframe><script type="text/javascript">!function(){"use strict";window.addEventListener("message",(function(e){if(void 0!==e.data["datawrapper-height"]){var t=document.querySelectorAll("iframe");for(var a in e.data["datawrapper-height"])for(var r=0;r<t.length;r++){if(t[r].contentWindow===e.source)t[r].style.height=e.data["datawrapper-height"][a]+"px"}}}))}();
      <h2 style="text-align:center;"> Archiv</h2>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/2.0.0-alpha0/date_fns.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js">
      </script>
      <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

<?php 
$datum =$_GET["datum"];
include('data.php')
?>
   </body>
</html>

