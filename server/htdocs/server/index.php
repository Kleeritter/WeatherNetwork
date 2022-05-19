<!DOCTYPE html>
<html lang="de">
   <head >
      <title>Kleefelder Wetternetz</title>
      <link rel="icon" type="image/x-icon" href="/tausch/favicon.ico">
      <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
      <link rel="stylesheet" href="style.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/2.0.0-alpha0/date_fns.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
      <h3 >Temperatur </h3>
      <canvas id="indext" style="width:400"></canvas>
      <h3 >Luftdruck  </h3>
      <canvas id="indexp" style="width:400"></canvas>
      <h3 style="text-align:center;"> Karte des Messnetzes</h2>
      <iframe title=" Messnetz" aria-label="Karte" id="datawrapper-chart-5l9DS" src="https://datawrapper.dwcdn.net/5l9DS/2/" scrolling="no" frameborder="0" style="width: 0; min-width: 100% !important; border: none;" height="595"></iframe><script type="text/javascript">!function(){"use strict";window.addEventListener("message",(function(e){if(void 0!==e.data["datawrapper-height"]){var t=document.querySelectorAll("iframe");for(var a in e.data["datawrapper-height"])for(var r=0;r<t.length;r++){if(t[r].contentWindow===e.source)t[r].style.height=e.data["datawrapper-height"][a]+"px"}}}))}();
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
    include('indexdata.php');
  ?>

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

