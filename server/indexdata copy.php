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
    $query = "SELECT * FROM temperature where Date(datum)=CURDATE() and sender_id='da:bf:c0:14:1a:10'";
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
    $query = "SELECT * FROM temperature where sender_id='26:62:ab:0a:fb:ed'";
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
    $jsonStrVi=json_encode($jsonArray);
    $jsonStrong=json_encode($jsonArrayITem['label']);
 
?>
<script>
var jsonData= JSON.parse('<?=$jsonStr; ?>');
var jsonDatavi= JSON.parse('<?=$jsonStrVi; ?>');
var jsx=[];
var jsxvi=[];
var jsy=[];
var jsyvi=[];
var jsxx=[];
var jsxxvi=[];
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
var xValues = jsx;
var yValueshu = jsxx;
var yValues = jsy;
for (let i=0; i<jsonDatavi.length;i++){
    var allavi= jsonDatavi[i]['label'];
    console.log(typeof allavi);
    //alla= new Date(alla).toLocaleDateString("de-DE",bru);
    var allarmvi=jsonDatavi[i]['tempe'];
    var allarmxvi=jsonDatavi[i]['humid']*1000;
    console.log(typeof allavi)
    jsxvi.push(allavi);
    jsxxvi.push(allarmxvi);
    jsyvi.push(allarmvi);
};
var xValuesvi = jsxvi;
var yValueshuvi = jsxxvi;
var yValuesvi = jsyvi;
console.log(Object.keys(jsonData["0"]));
var datafirst={
  label:"Alex",
  data: yValues,
  lineTension: 0,
  fill:false,
  backgroundColor: "rgba(191, 97, 106, 1)",
  Color: "rgba(236, 239, 244, 1)",
  borderColor : "rgba(191, 97, 106, 1)",
};
var dataSecond={
  label:"Viktor",
  data: yValuesvi,
  lineTension: 0,
  fill:false
};
var datenalla ={
  labels:xValuesvi,
  datasets:[datafirst,dataSecond]
};
new Chart("myChart", {
  type: "line",
  data: datenalla,
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
new Chart("myCharthumid", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(136, 192, 208, 1)",
      borderColor: "rgba(136, 192, 208, 1)",
      data: yValueshu,yValueshuvi
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