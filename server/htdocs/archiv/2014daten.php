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
    $dbName = "archiv";
    //establishing the connection to the db.
    $conn = new mysqli($servername, $username, $password, $dbName);
    //checking if there were any error during the last connection attempt
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    //the SQL query to be executed
    $query = "SELECT * FROM vic2014";
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
        $jsonArrayItem['t7'] = $row['T7'];
        $jsonArrayItem['t14'] = $row['T14'];
        $jsonArrayItem['t21'] = $row['T21'];
        $jsonArrayItem['tm'] = $row['Tmittel'];
        $jsonArrayItem['luftdrua'] = $row['Luftdrucka'];
        $jsonArrayItem['luftdrub'] = $row['Luftdruckb'];
        $jsonArrayItem['wettera']=$row['Wetterzustanda'];
        $jsonArrayItem['wetterb']=$row['Wetterzustandb'];
        //append the above created object into the main array.
        array_push($jsonArray, $jsonArrayItem);
      }
    }
    //Closing the connection to DB
    $conn->close();
    //set the response content type as JSON
    $jsonStr=json_encode($jsonArray);

?>

   
      <script id="datas">
      var  jsonData= JSON.parse('<?=$jsonStr; ?>') ;
      //sessionStorage.setItem("jsonDataa",JSON.stringify(jsonData));
      let delayed;
//var  jsonData= JSON.parse(sessionStorage.getItem("jsonDataa"));
console.log(jsonData);
var jsx=[];
var jsyt=[];
var jsyts=[];
var jsytv=[];
var jsyte=[];
var jsyn=[];
var jsypa=[];
var jsypb=[];
var wettera=[];
var wetterb=[];
var a=0;
var b=0;
var c=0;
var d=0;
var e=0;
var f=0;
var g=0;
var h=0;




console.log(a);
for (let i=0; i<jsonData.length;i++){
    //var alla= jsonData[i]['label'];
    //var allarm=jsonData[i]['tempe'];
    //var allarmx=jsonData[i]['nied'];
    var allarmp=jsonData[i]['luftdru'];
    var allawa=jsonData[i]['wettera'];
    var allawb=jsonData[i]['wetterb'];
    if (allawa == "Bedeckt" ) {
        a=a+1;
    } else if (allawa== "Schneefall") {
        b=b+1;
    } else if (allawa== "Regen") {
        c=c+1;
    } else if (allawa== "Stark bewölkt") {
        d=d+1;
    } else if (allawa== "Wolken") {
        e=e+1;
    } else if (allawa== "wechselhaft") {
        f=f+1;
    } else if (allawa== "Sonne sichtbar") {
        g=g+1;
    } else {
        h=h+1;
    };
    if (allawb == "Wolken" ) {
        a=a+1;
    } else if (allawb== "wechsekhaft") {
        b=b+1;
    } else if (allawb== "Sonne sichtbar") {
        c=c+1;

    } else {
        h=h+1;
    };
    if (jsonData[i]['luftdrua']=="HOCH") {
     var bastel=1;
    } else {
     var bastel=0;
    };
    jsx.push(jsonData[i]['label']);
    jsyt.push(jsonData[i]['tm']);
    jsyts.push(jsonData[i]['t7']);
    jsytv.push(jsonData[i]['t14']);
    jsyte.push(jsonData[i]['t21']);
    jsypa.push(bastel);
    wettera.push(allawa);
    wetterb.push(allawb);
};

var wetter=[e,f,g];
var wettern=[a,b,c];
console.log(a);
console.log(wetter);
//Maximale Temperatur
var numberArray = jsyt.map(Number);

let index = numberArray.indexOf( Math.max(...numberArray));


document.getElementById("maxT").innerHTML = Math.max(...numberArray);
document.getElementById("maxTd").innerHTML = "°C  am " +moment(jsx[index]).format('DD.MM.YYYY');
//Minimale Temperatur
let indexm = numberArray.indexOf( Math.min(...numberArray));
document.getElementById("minT").innerHTML = Math.min(...numberArray);
document.getElementById("minTd").innerHTML = "°C  am " +moment(jsx[indexm]).format('DD.MM.YYYY');
//Mittlere Temperatur
const average = (array) => array.reduce((a, b) => a + b) / array.length;
document.getElementById("mimT").innerHTML = average(numberArray);

var xValues = jsx;
var yValuest = jsyt;
var yValuesn = jsyts;
var yValuesp = jsypa;
new Chart("myChart", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      label: 'Mittlere Temperatur',
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(191, 97, 106, 1)",
      Color: "rgba(236, 239, 244, 1)",
      borderColor : "rgba(191, 97, 106, 1)",
      data:jsyt
    },
    {
      label: 'Temperatur 7:00 Uhr UTC',
      fill: false,
      lineTension: 0,
      backgroundColor: "rgba(136, 192, 208, 1)",
      Color: "rgba(136, 192, 208, 1)",
      borderColor : "rgba(136, 192, 208, 1)",
      data:jsyts
    },
    {
      label: 'Temperatur 14:00 Uhr UTC',
      fill: false,
      lineTension: 0,
      backgroundColor: "#D08770",
      Color: "#D08770",
      borderColor : "#D08770",
      data:jsytv
    },
    {
      label: 'Temperatur 21:00 Uhr UTC',
      fill: false,
      lineTension: 0,
      backgroundColor: "#A3BE8C",
      Color: "#A3BE8C",
      borderColor : "#A3BE8C",
      data:jsyte
    }
  ]
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
data = {
    datasets: [{
        data: wetter,
        backgroundColor: [
          "#D08770",
          "#EBCB8B",
          "#A3BE8C"

        ],
        borderColor: [
            "#D08770",
          "#EBCB8B",
          "#A3BE8C"
        ],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Wolken',
        'Wechselhaft',
        'Sonne sichtbar'

    ],
   
};
datan = {
    datasets: [{
        data: wettern,
        backgroundColor: [
          "#D08770",
          "#EBCB8B",
          "#A3BE8C"

        ],
        borderColor: [
            "#D08770",
          "#EBCB8B",
          "#A3BE8C"
        ],
    }],

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Wolken',
        'Wechselhaft',
        'Sonne sichtbar'

    ],
   
};
// Append '4d' to the colors (alpha channel), except for the hovered index
function handleHover(evt, item, legend) {
  legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
    colors[index] = index === item.index || color.length === 9 ? color : color + '4D';
  });
  legend.chart.update();
}
// Removes the alpha channel from background colors
function handleLeave(evt, item, legend) {
  legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
    colors[index] = color.length === 9 ? color.slice(0, -2) : color;
  });
  legend.chart.update();
}
new Chart("myDoughnutChart", {
    type: 'doughnut',
    data: data,
    options:  {
      legend:{
        display:false
      },
      plugins: {
      legend: {
        onHover: handleHover,
        onLeave: handleLeave
      }
    }
    }
});
new Chart("myDoughnutChartn", {
    type: 'doughnut',
    data: datan,
    options:  {
      legend:{
        display:false
      },
      plugins: {
      legend: {
        onHover: handleHover,
        onLeave: handleLeave
      }
    }
    }
});
</script>