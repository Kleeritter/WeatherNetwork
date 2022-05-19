<!DOCTYPE html>
<html lang="de">
   <head >
      <title>Kleefelder Wetternetz</title>
      <link rel="icon" type="image/x-icon" href="/tausch/favicon.ico">
      <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
      <link rel="stylesheet" href="/style.css?v=<?= filemtime('/style.css') ?>">
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
      <div class="navbar" id="navbar">
  <a href="/index.php">Home</a>
  <a href="anfrage.php">Messdaten</a>
  <div class="dropdown">
    <button class="dropbtn" id="buton">Archiv 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content" id="alla">
      <a href="2014.php">2014</a>
      <a href="2015.php">2015 </a>
      <a href="/archiv.php">2017 </a>
    </div>
  </div> 
  <a href="impressum.php">Impressum</a>
</div>


<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sub = document.getElementById("buton");
var subs = document.getElementById("alla");
var sticky = navbar.offsetTop;
var substicky= sub.offsetTop
var subssticky= subs.offsetTop
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
    //sub.classList.add("sticky")
    subs.classList.add("stickysus")
  } else {
    navbar.classList.remove("sticky")
    //sub.classList.remove("sticky")
    subs.classList.remove("stickysus");
  }
}
</script>

      <h2 style="text-align:center;"> Messdaten</h2>
      <p style="text-allign:center;"> Hier sind die Messwerte für das Jahr 2015 für die Messstation in Langholzhausen.
    </p>
    <?php 
$vic =2017;

?>

<div class="Temperaturgraf">  <h3>  Temperatur </h3><canvas id="myChart"></canvas> </div>
<div class="Luftdruckgraf"><h3> mittlerer Luftdruck  </h3><canvas id="myChartpressure"></canvas></div>   


<h2 style="text-align:center;"> Rekorde</h2>
<div class="MaxT"> <div class="Werte"><p>  </p><p class="Count"  style="color:#bf616a"id="maxT"></p>
  <p id="maxTd"></p> 
</div> </div>
  <div class="MinT"><p class="Count" id="minT" style="color:#5e81ac"></p>
    <p id="minTd"></p></div>
    <div class="MittelT"><p > X̅</p> <p class="Count" id ="mimT"></p><p > °C </p></div>

    <h2 style="text-align:center;"> Witterungsverhalten</h2>
  
<div class="Witterungsverhalten"><p > Vormittags</p> <canvas id="myDoughnutChart"></canvas></div>
  
<div class="Witterungsverhalten"><p > Nachmittags</p> <canvas id="myDoughnutChartn"></canvas></div>
<?php 
include('2014daten.php')
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