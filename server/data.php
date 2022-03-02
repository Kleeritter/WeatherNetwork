<script src="https://cdnjs.cloudflare.com/ajax/libs/date-fns/2.0.0-alpha0/date_fns.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js">
      </script>
      <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
     

     

      <?php
    $datum =$_GET["datum"];
    echo $datum;
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
    $maxt= max($jsonStr['tempe']);
    echo $maxt;
    echo $jsonArray;
 
?>
      <script>
      var  jsonData= JSON.parse('<?=$jsonStr; ?>') ;
      //sessionStorage.setItem("jsonDataa",JSON.stringify(jsonData));
      let delayed;
//var  jsonData= JSON.parse(sessionStorage.getItem("jsonDataa"));
console.log(jsonData);
var jsx=[];
var jsyt=[];
var jsyn=[];
var jsyp=[];
for (let i=0; i<jsonData.length;i++){
    var alla= jsonData[i]['label'];
    var allarm=jsonData[i]['tempe'];
    var allarmx=jsonData[i]['nied'];
    var allarmp=jsonData[i]['luftdru'];
    jsx.push(alla);
    jsyt.push(allarm);
    jsyn.push(allarmx);
    jsyp.push(allarmp);
};
console.log(jsx);
var xValues = jsx;
var yValuest = jsyt;
var yValuesn = jsyn;
var yValuesp = jsyp;
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
      data: yValuest
    }]
  },
  options: {
    animation:{
      onComplete: () => {
        delayed =true;
      },
      delay: (context) => {
        let delay =0;
        if (context.type =="data" && context.mode === "default" && !delayed){
          delay= context.dataIndex * 10 + context.datasetIndex *10;
        }
        return delay;
      },
    },
    hoverRadius:7,
    legend: {display: true},
    scales:{
        xAxes:{
            type:'time',
            time:{
              unit:'month'
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
      data: yValuesn
    }]
  },
  options: {
    animation:{
      onComplete: () => {
        delayed =true;
      },
      delay: (context) => {
        let delay =0;
        if (context.type =="data" && context.mode === "default" && !delayed){
          delay= context.dataIndex * 10 + context.datasetIndex *10;
        }
        return delay;
      },
    },
    hoverRadius:7,
    legend: {display: false},
    scales:{
        xAxes:{
            type:'time',
            time: {
                unit: 'month'
                    },
            grid:{
                display:true,
                color:"rgba(76, 86, 106, 1)"
            }
        },
        yAxes:{
          title:{
            display:true,
            text:'Niederschlagssumme in mm'
          },
          grid:{
                color:"rgba(76, 86, 106, 1)"
            }
        }
    }
  }
});
new Chart("myChartpressure", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: false,
      lineTension: 0,
      backgroundColor: "#b48ead",
      borderColor: "#b48ead",
      data: yValuesp
    }]
  },
  options: {
    animation:{
      onComplete: () => {
        delayed =true;
      },
      delay: (context) => {
        let delay =0;
        if (context.type =="data" && context.mode === "default" && !delayed){
          delay= context.dataIndex * 10 + context.datasetIndex *10;
        }
        return delay;
      },
    },
    hoverRadius:7,
    legend: {display: false},
    scales:{
        xAxes:{
            type:'time',
            time: {
                unit: 'month'
                    },
            grid:{
                display:true,
                color:"rgba(76, 86, 106, 1)"
            }
        },
        yAxes:{
          title:{
            display:true,
            text:'mittlere Luftdruck in hPa'
          },
          grid:{
                color:"rgba(76, 86, 106, 1)"
            }
        }
    }
  }
});
</script>