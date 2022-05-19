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
     <h1 style="text-align:center;"> Nordwestmessnetz </h1>

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
     
     
       <!-- Chart div container -->


  
<div class="alles">
  <div id="map"></div> 
    <div class="aufklapper">  
    <button class="close" onclick="myFunction()">X</button>
   <p id="Ortsname"></p>
      <div class="tauf">
       <canvas id="indext"></canvas> 
     </div>
     
      <div class="pauf">
      <canvas id="indexp" ></canvas>
      </div>
      <div class="alla">
  <div class="MaxTf"><p class="Count"  style="color:#bf616a"id="maxTi"></p>
  <p class="Datum" id="maxTdi"></p></div>
  <div class="MinTf"><p class="Count" id="minTi" style="color:#5e81ac"></p>
    <p class="Datum" id="minTdi"></p></div>
  <div class="MittelTf"><p class="Count" id ="mimTi"></p><p class="Datum"> °C </p></div>
  <div class="MittelPf"><p class="Count" id="mimPi"></p><p class="Datum" > hPa </p></div>
  <div class="MinPf"><p class="Count" id="minPi" style="color:#5e81ac"></p>  <p class="Datum" id="minPdi"></p></div>
  <div class="MaxPf"><p class="Count" id="maxPi" style="color:#bf616a"></p>   <p class="Datum" id="maxPdi"></p></div>
  <div class="tendenzp"><p class="Count"  style="color:#bf616a"id="tendenzpi"></p> <p class="Datum" > hPa </p>
  <div class="link"><a id="lonk" href="#" >Vollständige Messwerte</a></div>
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

  
 
   <?php
    include('indexdata.php');
  ?>
  


<script src="alla.js?version=<?php echo rand() ; ?>"></script>
<script src="verden.js?version=<?php echo rand() ; ?>"></script>
<script>
 var map = L.map('map').setView([52.79640, 9.44711], 7);
 const attribution = 
 '&copy; <a href="https://www.openstreetmap.org/copyright"> OpenStreetMap </a> contributors';
const tileUrl= 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
//const tileUrl='https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png';
const tiles = L.tileLayer(tileUrl,{attribution});
tiles.addTo(map);
var marker = L.marker([52.3755359, 9.7881984]).addTo(map);
var vimarker = L.marker([52.1526118, 8.9698211]).on('click',alla).addTo(map); //on('click', onClick).
var leomarker =L.marker([52.34334888515247, 9.545614293617046]).addTo(map);
var kilianmarker = L.marker([52.91666672618983, 9.265516100627243]).on('click',verden).addTo(map);
</script>

      <h2 style="text-align:center;"> Ursprung</h2>
      <p style="text-align:center;"> Das Nordwestmessnetz ist ein Zusammenschluss einiger
          Studierender der Meteorologie aus Hannover, welche die meteorologischen Parameter 
          an den eigenen Standorten genauer untersuchen wollen. Die dazu benötigten Messgeräte und Infrastruktunren wurden eigenständig erbaut und integriert. Dadurch agieren wir unabhängig und können lokal unsere Vision von Wetter darstellen.</p>
          <p style="text-align:center;"> Kleefeld ist dabei Sitz unserer Zentrale von der aus wir die anderen Messstationen verwalten können.Ein Messnetz für den Nordwesten Deutschlands, verwaltet von studierenden haben wir gewählt, um den Bezug zu unseren Wetterdaten in den jeweiligen Heimaten zu bewahren.  Messdaten für Wetter und Klima Beobachtungen sollten den Menschen dienen und für alle frei verfügbar sein. Daher haben wir dieses Messnetzt als Open Source Projekt entwickelt. Der Quellcode für die Software, sowie die Bauanleitung als auch die 3D Druckdateien haben wir auf GitHub veröffentlich: <a href="­https://github.com/Kleeritter/WeatherNetwork">WeatherNetwork</a>.
          Bei Intresse an dem Projekt gerne <a href="impressum.php">kontaktieren</a>. Unsere Ideen basieren auf Elementen von  <a href="https://www.windy.com/">Windy</a> und <a href="https://kachelmannwetter.com/de">KachelmannWetter</a>
          </p>
    <h2 style="text-align:center;"> FAQ</h2>
<h3 style="text-align:center;">Warum ein Messnetz? </h3>
   <p style="text-allign:center;">Wir wollten ein eigenes unabhängiges Messnetzt in Form eines Citizen Science Projektes realisieren. Da uns Messsensorik im Studium fasziniert hat und wir ein Interesse an Mikroelektronik haben kam eins zum anderen. </p>
<h3 style="text-align:center;">Wie kann ich teilnehmen? </h3>
<p style="text-allign:center;"> Wir freuen uns über dein Interesse. Um an unserem Projekt teilzunehmen und eine eigene Wetterstation zu betreiben, benötigst du lediglich eine Möglichkeit Messdaten aufzunehmen. Auf unserem GitHub Profil haben wir alle weiteren Infos untergebracht. Wir freuen uns über dein Interesse. Um an unserem Projekt teilzunehmen und eine eigene Wetterstation zu betreiben, benötigst du lediglich eine Möglichkeit Messdaten aufzunehmen. Auf unserem GitHub Profil haben wir alle weiteren Infos untergebracht. </p>
<h3 style="text-align:center;"> Wieviele Messstationen habt ihr?</h3>
<p style="text-allign:center;"> Bisher sind es vier, aber es sind noch viele Mehr in Planung. Neben Verden, Hannover, Langholzhausen und Göxe sind noch einige im Raum Hameln geplant.</p>
<h3 style="text-align:center;"> Wer seid ihr? </h3>
<p style="text-allign:center;"> Ambitionierte Studierende der Meteorologie aus Hannover. Die Leitung übernehmen Alexander Steding und Viktor Lau. Wir freuen uns jedoch über jede Mithilfe, die wir erhalten.</p>
<h3 style="text-align:center;"> Was plant ihr mit den Messdaten?</h3>
<p style="text-allign:center;">Das Sammeln von Daten ist nur der Anfang. In Zukunft wollen wir unter anderem ein eigenes Vorhersagesystem entwickeln und so eigene Wettervorhersagen erstellen. Alle Daten werden dabei öffentlich zur Verfügung gestellt. </p>
     
     
<h2 style="text-align:center;"> Livestream</h2>
<video id="myplayer" class="video-js vjs-fluid" poster="/path-to-poster.jpg" controls preload="auto">
<source src="http://www.domain.com/live_manifest.m3u8" type="application/x-mpegURL">
</video>

<script>
var player = videojs('myplayer'); 
player.nuevo();
</script>     
     <script>
function myFunction() {
  $(".aufklapper").hide('slide', {direction: 'left'}, 200);

  if(window.indext != null){
    window.indext.destroy();
}
if(window.indexp != null){
    window.indexp.destroy();
}
if(window.indexh != null){
    window.indexh.destroy();
}
}
</script>
   </body>

</html>

