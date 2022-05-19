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
     <h1 style="text-align:center;"> Archiv</h1>
      <img src = "/tausch/frog.jpg"
      alt = "Monty der Kater" style="width:600px;height:600px;"/>
      <p><cite>Monty der schnucckelige Kater</cite> 2021.</p> 
      </div>
      <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="anfrage.php">Messdaten</a></li>
      <li><a class="active" href="archiv.php">Archiv</a></li>
      <li><a href="impressum.php">Impressum</a></li>
      </ul>

      <h2 style="text-align:center;"> Messdaten</h2>
      <p style="text-allign:center;"> Hier kann das Jahr verändert werden.
    </p>
    <?php 
$vic =2017;

?>
  <form action="archiv.php"  method="get">

  <input type="number" id ="vic" name="vic" min="2017" max="2099" step="1" value="2017" />
  <input type="submit" value="Submit">
</form> 
     

<div class="container">
  <div class="Temperaturgraf">  <h3>  Temperatur </h3><canvas id="myChart"></canvas> </div>
  <div class="Luftdruckgraf"><h3> mittlerer Luftdruck  </h3><canvas id="myChartpressure"></canvas></div>
  <div class="Niederschlaggraf"> <h3>Tages Niederschlagssumme  </h3>
      <canvas id="myCharthumid"></canvas></div>
  <div class="MaxT"> <div class="Werte"><p>  </p><p class="Count"  style="color:#bf616a"id="maxT"></p>
  <p id="maxTd"></p>
</div> </div>
  <div class="MinT"><p class="Count" id="minT" style="color:#5e81ac"></p>
    <p id="minTd"></p></div>
  <div class="MaxP"><p class="Count" id="maxP" style="color:#bf616a"></p>   <p id="maxPd"></p>  </div>
  <div class="MinP"><p class="Count" id="minP" style="color:#5e81ac"></p>  <p id="minPd"></p></div>
  <div class="MaxSonne">7</div>
  <div class="GesammtNieder"><p > Summe</p><p class= "Count" id="nins"></p><p > mm </p></div>
  <div class="MittelT"><p > X̅</p> <p class="Count" id ="mimT"></p><p > °C </p></div>
  <div class="MittelP"><p > X̅ </p><p class="Count" id="mimP"></p><p > hPa </p></div>
  <div class="Witterungsverhalten"><p > Witterung</p> <canvas id="myDoughnutChart"></canvas></div>
</div>
   <?php 
$vic =$_GET["vic"];
if (is_null($vic)) {
  $vic=2017;
} else {
  echo "Have a good night!";
};
include('archivdaten.php')
?>
   </body>
</html>


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