    var jsx=[];
    var jsy=[];
    var jsxx=[];
    var jshum=[];
    var zahlo=[];
    var werto=[];
    var bums=[];
    var z=50;
    var a=7.5;
    var b=237.3;
    console.log(jsonData);
    
    for (let i=0; i<jsonData.length;i++){
        var alla= jsonData[i]['label'];
         var allarm=jsonData[i]['tempe'];
         var allarh=jsonData[i]['pressure'];
         var allarmx=jsonData[i]['humid'];
         var deltap= jsonData[i]['humid']*(Math.exp((9.81*z)/(287.058*(+jsonData[i]['tempe'] +0.00325*z)))-1);
         var allarmxx= (allarmx +deltap)/1000000;
         var sdd=6.1078 * 10^((a*+jsonData[i]['tempe'])/(b+ +jsonData[i]['tempe']));
         var dd= +allarh/100 * sdd;
         var v=Math.log10((dd/6.1078));
         var dew= b*v/(a-v);
         jsx.push(alla);
         bums.push(allarmx);
         jsy.push(allarm);
         jshum.push(dew);
         zahlo.push(i);
         jsxx.push(allarmxx);
    };
    console.log(bums);
    console.log(jsy);
    werto=jsxx.slice(-180);
    let last = jsy[jsy.length - 1];
    var xValues = jsx;
    var yValueshu = jsxx;
    var yValues = jsy;
    var tendenzindi= jsxx[jsxx.length -180]
    //Maximale Temperatur
    var numberArray = jsy.map(Number);
    
    let index = numberArray.indexOf( Math.max(...numberArray));
    
    function linearRegression(y,x){
      var lr = {};
      var n = y.length;
      var sum_x = 0;
      var sum_y = 0;
      var sum_xy = 0;
      var sum_xx = 0;
      var sum_yy = 0;
    
      for (var i = 0; i < y.length; i++) {
    
          sum_x += x[i];
          sum_y += y[i];
          sum_xy += (x[i]*y[i]);
          sum_xx += (x[i]*x[i]);
          sum_yy += (y[i]*y[i]);
      } 
    
      lr['slope'] = (n * sum_xy - sum_x * sum_y) / (n*sum_xx - sum_x * sum_x);
      lr['intercept'] = (sum_y - lr.slope * sum_x)/n;
      lr['r2'] = Math.pow((n*sum_xy - sum_x*sum_y)/Math.sqrt((n*sum_xx-sum_x*sum_x)*(n*sum_yy-sum_y*sum_y)),2);
    
      return lr;
    }
    console.log(last);
    document.getElementById("maxTi").innerHTML = Math.max(...numberArray);
    document.getElementById("maxTdi").innerHTML = "°C  um " +moment(jsx[index]).format('hh:mm');
    //Minimale Temperatur
    let indexm = numberArray.indexOf( Math.min(...numberArray));
    document.getElementById("minTi").innerHTML = Math.min(...numberArray);
    document.getElementById("minTdi").innerHTML = "°C  um " +moment(jsx[indexm]).format('hh:mm');
    //Mittlere Temperatur
    const average = (array) => array.reduce((a, b) => a + b) / array.length;
    document.getElementById("mimTi").innerHTML = Math.round(average(numberArray));
    //Max Luftdruck
    var par = jsxx.map(Number);
    let indexp = par.indexOf( Math.max(...par));
    document.getElementById("maxPi").innerHTML = Math.max(...par).toFixed(2);
    document.getElementById("maxPdi").innerHTML = " hPa um "+ moment(jsx[indexp]).format('hh:mm');
    //min Luftdruck
    let indexpm = numberArray.indexOf( Math.min(...numberArray));
    document.getElementById("minPi").innerHTML = Math.min(...par).toFixed(2);
    document.getElementById("minPdi").innerHTML =" hPa um "+ moment(jsx[indexpm]).format('hh:mm');
    //mittlere Luftdruck
    document.getElementById("mimPi").innerHTML =Math.round(average(par));
    
    //Luftdrucktendenz
    document.getElementById("tendenzpi").innerHTML = 180*linearRegression(werto,zahlo)['slope'].toFixed(3);
    console.log(linearRegression(werto,zahlo));
    window.indext=new Chart("vollt", {
      type: "line",
      data:{ 
      labels: xValues,
        datasets: [{
          label: 'Temperatur',
          //yAxisID:'A',
          fill: false,
          lineTension: 0,
          backgroundColor: "rgba(191, 97, 106, 1)",
          Color: "rgba(236, 239, 244, 1)",
          borderColor : "rgba(191, 97, 106, 1)",
          data: jsy,
        },
        {
          label: 'Taupunkt',
          //yAxisID:'B',
          fill: false,
          backgroundColor: "#88c0d0",
          Color: "#88c0d0",
          borderColor : "#88c0d0",
          data: jshum,
        }]
    },
      options: {
        maintainAspectRatio: true,
        plugins: {
          legend:{
            display: true
          },
          title: {
              display: false,
              text: 'Temperatur'
          }
      },
    
        legend: {display: true},
        scales:{
            xAxes:{
                type:'time',
                time: {
                    displayFormats: {
                            minute: 'HH:mm '
                        },
                    round: 'minute'
                },
                grid:{
                    display:true,
                    color:"rgba(76, 86, 106, 1)"
                }
            }, 
              yAxes:{
              type: 'linear',
              position: "left"
            }}
      }
    });
    window.indexp=new Chart("vollp", {
      type: "line",
      data: {
        labels: xValues,
        datasets: [{
          fill: false,
          lineTension: 0,
          backgroundColor: "#b48ead",
          borderColor: "#b48ead",
          data: yValueshu
        }]
      },
      options: {
        maintainAspectRatio: true,
        plugins: {
          legend:{
            display: false
          },
          title: {
              display: true,
              text: 'Luftdruck'
          }
      },
        legend: {display: false},
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
                text:'hPa'
              },
              grid:{
                    color:"rgba(76, 86, 106, 1)"
                }
            }
        }
      }
    });
    var yValues = jshum;
    window.indexh=new Chart("vollh", {
      type: "line",
      data:{ 
      labels: xValues,
        datasets: [{
          fill: false,
          lineTension: 0,
          backgroundColor: "#88c0d0",
          Color: "#88c0d0",
          borderColor : "#88c0d0",
          data: yValues
        }]
    },
      options: {
        maintainAspectRatio: true,
        plugins: {
          legend:{
            display: false
          },
          title: {
              display: true,
              text: 'Feuchte'
          }
      },
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
                text:'%'
              },
              grid:{
                    color:"rgba(76, 86, 106, 1)"
                }
            }
        }
      }
    });
    //$(".aufklapper").fadeIn();
    $(".aufklapper").show('slide', {direction: 'left'}, 200);
