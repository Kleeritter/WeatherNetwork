
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <NTPClient.h>
#include <WiFiUdp.h>

#include <Adafruit_BMP280.h>
#include <ArduinoHttpClient.h>
#include <WiFiManager.h>          //https://github.com/tzapu/WiFiManager WiFi Configuration Magic
#include <Arduino.h>
#include <Adafruit_Sensor.h>
#include <DHT.h>
#include <Wire.h>
#include <Adafruit_Sensor.h>

#include <ArduinoJson.h>
#include <b64.h>

//Pinbelegung
#define DHTPIN 12    // Digital pin connected to the DHT sensor
#define PIN_TRIGGER 14
#define PIN_ECHO    13
//DHT SETUP
#define DHTTYPE DHT22 
DHT dht(DHTPIN, DHTTYPE);
// current temperature & humidity, updated in loop()
// HCSR04 Setup
const int SENSOR_MAX_RANGE = 300; // in cm
unsigned long duration;
unsigned int distance;

//BMP Setup
#define BMP_SCK  (13)
#define BMP_MISO (12)
#define BMP_MOSI (11)
#define BMP_CS   (10)

Adafruit_BMP280 bmp; // I2C

//Server
const String  RASPBERRY_PI_URL = "http://kleeritter.duckdns.org:8001/esp8266_trigger";
String SERVER_PASSWORD = "nordwestwetter";
const String sender_id="verden";
int deepsleepdauer;
//NTP 
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP,"europe.pool.ntp.org",3600,10000);

//HTTPClient http;
void setup() {
  // put your setup code here, to run once:
WiFiManager wifiManager;
//first parameter is name of access point, second is the password
wifiManager.autoConnect("Wetterlurch", "heiligerfred");
  Serial.begin(9600); //Serielle Verbindung starten
   dht.begin(); //DHT22 Sensor starten
   //HCSR04
   pinMode(PIN_TRIGGER, OUTPUT);
   pinMode(PIN_ECHO, INPUT);
  if (!bmp.begin()) {
    Serial.println(F("Could not find a valid BMP280 sensor, check wiring or "
                      "try a different address!"));
    while (1) delay(10);
  }
    /* Default settings from datasheet. */
  bmp.setSampling(Adafruit_BMP280::MODE_FORCED,     /* Operating Mode. */
                  Adafruit_BMP280::SAMPLING_X2,     /* Temp. oversampling */
                  Adafruit_BMP280::SAMPLING_X16,    /* Pressure oversampling */
                  Adafruit_BMP280::FILTER_X16,      /* Filtering. */
                  Adafruit_BMP280::STANDBY_MS_500); /* Standby time. */
   // Initialize a NTPClient to get time
  timeClient.begin();
  // Set offset time in seconds to adjust for your timezone, for example:
  // GMT +1 = 3600
  // GMT +8 = 28800
  // GMT -1 = -3600
  // GMT 0 = 0
  timeClient.setTimeOffset(0); 
  }


void loop() {
    // put your main code here, to run repeatedly:
    timeClient.update();
int currentMinute = timeClient.getMinutes();
//int currentMinute = 0;
  Serial.print("Minutes: ");
  Serial.println(currentMinute); 

switch(currentMinute){
  case 0:
//if(currentMinute ==0){
 //BMP
   // must call this to wake sensor up and get new measurement data
  // it blocks until measurement is complete
  //float bmppress=0;
  if (bmp.takeForcedMeasurement()) {
    // can now print out the new measurements
    Serial.print(F("Temperature = "));
    Serial.print(bmp.readTemperature());
    Serial.println(" *C");

    Serial.print(F("Pressure = "));
    Serial.print(bmp.readPressure());
    Serial.println(" Pa");

    Serial.print(F("Approx altitude = "));
    Serial.print(bmp.readAltitude(1013.25)); /* Adjusted to local forecast! */
    Serial.println(" m");
    float bmptemp= bmp.readTemperature();
    float bmppress= bmp.readPressure();
    Serial.println(bmppress);


  float Luftfeuchtigkeit = dht.readHumidity(); //die Luftfeuchtigkeit auslesen und unter „Luftfeutchtigkeit“ speichern
  
  float Temperatur = dht.readTemperature();//die Temperatur auslesen und unter „Temperatur“ speichern
  
  Serial.print("Luftfeuchtigkeit: "); //Im seriellen Monitor den Text und 
  Serial.print(Luftfeuchtigkeit); //die Dazugehörigen Werte anzeigen
  Serial.println(" %");
  Serial.print("Temperatur: ");
  Serial.print(Temperatur);
  Serial.println(" Grad Celsius");
  
  //HCSR04
    digitalWrite(PIN_TRIGGER, LOW);
  delayMicroseconds(2);

  digitalWrite(PIN_TRIGGER, HIGH);
  delayMicroseconds(10);

  duration = pulseIn(PIN_ECHO, HIGH);
  distance = duration/58;

  if (distance > SENSOR_MAX_RANGE || distance <= 0){
    Serial.println("Out of sensor range!");
  } else {
    Serial.println("Distance to object: " + String(distance) + " cm");
  }
  


  //data t={sender_id,SERVER_PASSWORD,Temperatur,bmppress,Luftfeuchtigkeit};
  //Serial.print(t.humus);
  Serial.println(bmppress);
  //Server 
  WiFiClient client;
  HTTPClient http;
  StaticJsonDocument <200> data;
  data["password"] = SERVER_PASSWORD;
  data["sender_id"] = sender_id;
  data["humidity"]   = Luftfeuchtigkeit;
  data["temperature"]   = bmptemp;
  data["pressure"]   = bmppress;
  data["windu"]   = distance;
  data["windv"]   = 0;
  //String::reserve();
  String datasend;
  serializeJsonPretty(data,datasend);
  Serial.print(datasend);
  http.begin(RASPBERRY_PI_URL);
  http.addHeader("Content-Type", "application/json");
  //http.POST("{\"password\":\"\",\"sensor\":\"BME280\",\"value1\":\"24.25\",\"value2\":\"49.54\",\"value3\":\"1005.14\"}");
  http.POST(datasend);
  Serial.print(http.getString());
  http.end();
  Serial.println("I'm awake, but I'm going into deep sleep mode for 50 minutes");
  ESP.deepSleep(50* 60e6); 

    
  } else {
    Serial.println("Forced measurement failed!");
    
  }
break;  
case 1 ... 29 :
     deepsleepdauer= 30* 60e6;
     Serial.println("I'm awake, but I'm going into deep sleep mode for  minutes");
     Serial.println(deepsleepdauer);
     ESP.deepSleep(deepsleepdauer); 
    
 break; 
case 30 ... 39 :
     deepsleepdauer= 20* 60e6;
     Serial.println("I'm awake, but I'm going into deep sleep mode for  minutes");
     Serial.println(deepsleepdauer);
     ESP.deepSleep(deepsleepdauer); 
break;    


    

case 40 ... 49 :
     deepsleepdauer= 10* 60e6;
     Serial.println("I'm awake, but I'm going into deep sleep mode for  minutes");
     Serial.println(deepsleepdauer);
     ESP.deepSleep(deepsleepdauer); 
    
break; 
case 50 ... 54 :
     deepsleepdauer = 5* 60e6;
     Serial.println("I'm awake, but I'm going into deep sleep mode for  minutes");
     Serial.println(deepsleepdauer);
     ESP.deepSleep(deepsleepdauer); 
break;    
case 55 ... 58 :
     deepsleepdauer = 1* 60e6;
     Serial.println("I'm awake, but I'm going into deep sleep mode for  minutes");
     Serial.println(deepsleepdauer);
     ESP.deepSleep(deepsleepdauer); 
  break;
  case 59 :
     deepsleepdauer = 0.5* 60e6;
     Serial.println("I'm awake, but I'm going into deep sleep mode for  minutes");
     Serial.println(deepsleepdauer);
     ESP.deepSleep(deepsleepdauer); 
  break;
}
}
