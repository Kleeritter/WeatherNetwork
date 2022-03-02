<?php
    $datum =$_GET["datum"];
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
    $query = "SELECT * FROM temperature where Date(datum)='$datum'";
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
var jsx=[];
var jsy=[];
var jsxx=[];
const bru={
    day:"numeric",
    hour: "numeric",
    minute: "numeric"
};
for (let i=0; i<jsonData.length;i++){
    var alla= jsonData[i]['label'];
    console.log(typeof alla);
    //alla= new Date(alla).toLocaleDateString("de-DE",bru);
    var allarm=jsonData[i]['tempe'];
    var allarmx=jsonData[i]['humid']*1000;
    console.log(typeof alla)
    jsx.push(alla);
    jsxx.push(allarmx);
    jsy.push(allarm);
};
console.log(jsx);
//Maximale Temperatur
var numberArray = jsy.map(Number);

let index = numberArray.indexOf( Math.max(...numberArray));


document.getElementById("maxT").innerHTML = Math.max(...numberArray);
document.getElementById("maxTd").innerHTML = "°C  um " +moment(jsx[index]).format('HH:mm');
//Minimale Temperatur
let indexm = numberArray.indexOf( Math.min(...numberArray));
document.getElementById("minT").innerHTML = Math.min(...numberArray);
document.getElementById("minTd").innerHTML = "°C  um " +moment(jsx[indexm]).format('HH:mm');

//Mittlere Temperatur
const average = (array) => array.reduce((a, b) => a + b) / array.length;
document.getElementById("mimT").innerHTML = average(numberArray);
//Max Luftdruck
var par = jsxx.map(Number);
let indexp = par.indexOf( Math.max(...par));
document.getElementById("maxP").innerHTML = Math.max(...par);
document.getElementById("maxPd").innerHTML = " hPa um "+ moment(jsx[indexp]).format('HH:mm');
//min Luftdruck
let indexpm = numberArray.indexOf( Math.min(...numberArray));
document.getElementById("minP").innerHTML = Math.min(...par);
document.getElementById("minPd").innerHTML =" hPa um "+ moment(jsx[indexpm]).format('HH:mm');
//mittlere Luftdruck
document.getElementById("mimP").innerHTML =Math.round(average(par));

var xValues = jsx;

var yValues = jsy;
console.log(Object.keys(jsonData["0"]));
new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(191, 97, 106, 1)",
      Color: "rgba(236, 239, 244, 1)",
      borderColor : "rgba(191, 97, 106, 1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: true},
    scales:{
        xAxes:{
            type:'time',
            time: {
                displayFormats: {
                        minute: 'hh:mm '
                    }
            },
            grid:{
                display:true,
                color:"rgba(76, 86, 106, 1)"
            }
        },
        yAxes:{
          title:{
            display:true,
            text:'Temperatur in °C'
          },
          grid:{
                color:"rgba(76, 86, 106, 1)"
            }
        }
    }
  }
});
var yValues = jsxx;
new Chart("myCharthumid", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(136, 192, 208, 1)",
      borderColor: "rgba(136, 192, 208, 1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales:{
        xAxes:{
            type:'time',
            time: {
                displayFormats: {
                        minute: 'hh:mm '
                    }
            },
            grid:{
                display:true,
                color:"rgba(76, 86, 106, 1)"
            }
        },
        yAxes:{
          title:{
            display:true,
            text:'Luftdruck in hPa'
          },
          grid:{
                color:"rgba(76, 86, 106, 1)"
            }
        }
    }
  }
});
</script>