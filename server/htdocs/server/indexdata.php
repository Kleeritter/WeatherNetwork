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
    $query = "SELECT * FROM temperature where Date(datum)=CURDATE() and sender_id='26:62:ab:0a:fb:ed'";
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

for (let i=0; i<jsonData.length;i++){
    var alla= jsonData[i]['label'];
    var allarm=jsonData[i]['tempe'];
    var allarmx=jsonData[i]['humid']*1000;
    jsx.push(alla);
    jsxx.push(allarmx);
    jsy.push(allarm);
};

var xValues = jsx;
var yValueshu = jsxx;
var yValues = jsy;
//Maximale Temperatur
var numberArray = jsy.map(Number);

let index = numberArray.indexOf( Math.max(...numberArray));


document.getElementById("maxTi").innerHTML = Math.max(...numberArray);
document.getElementById("maxTdi").innerHTML = "°C  am " +moment(jsx[index]).format('DD.MM.YYYY');
//Minimale Temperatur
let indexm = numberArray.indexOf( Math.min(...numberArray));
document.getElementById("minTi").innerHTML = Math.min(...numberArray);
document.getElementById("minTdi").innerHTML = "°C  am " +moment(jsx[indexm]).format('DD.MM.YYYY');
//Mittlere Temperatur
const average = (array) => array.reduce((a, b) => a + b) / array.length;
document.getElementById("mimTi").innerHTML = average(numberArray);
//Max Luftdruck
var par = jsxx.map(Number);
let indexp = par.indexOf( Math.max(...par));
document.getElementById("maxPi").innerHTML = Math.max(...par);
document.getElementById("maxPdi").innerHTML = " hPa am "+ moment(jsx[indexp]).format('DD.MM.YYYY');
//min Luftdruck
let indexpm = numberArray.indexOf( Math.min(...numberArray));
document.getElementById("minPi").innerHTML = Math.min(...par);
document.getElementById("minPdi").innerHTML =" hPa am "+ moment(jsx[indexpm]).format('DD.MM.YYYY');
//mittlere Luftdruck
document.getElementById("mimPi").innerHTML =Math.round(average(par));
new Chart("indext", {
  type: "line",
  data:{ 
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
                    },
                round: 'minute'
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
new Chart("indexp", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(136, 192, 208, 1)",
      borderColor: "rgba(136, 192, 208, 1)",
      data: yValueshu
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