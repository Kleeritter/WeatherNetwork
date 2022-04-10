
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>


#include <ArduinoHttpClient.h>
#include <WiFiManager.h>          //https://github.com/tzapu/WiFiManager WiFi Configuration Magic
#include <Arduino.h>
#include <Adafruit_Sensor.h>
#include <DHT.h>
#include <Wire.h>
#include <Adafruit_Sensor.h>
#include <Adafruit_BMP085.h>
#include <ArduinoJson.h>
#include <b64.h>

//Pinbelegung
#define DHTPIN 12    // Digital pin connected to the DHT sensor
#define PIN_TRIGGER 14
#define PIN_ECHO    16
//DHT SETUP
#define DHTTYPE DHT22 
DHT dht(DHTPIN, DHTTYPE);
// current temperature & humidity, updated in loop()
// HCSR04 Setup
const int SENSOR_MAX_RANGE = 300; // in cm
unsigned long duration;
unsigned int distance;

//BMP Setup
Adafruit_BMP085 bmp;

//Server
const String  RASPBERRY_PI_URL = "http://kleeritter.duckdns.org:8001/esp8266_trigger";
String SERVER_PASSWORD = "tutorials-raspberrypi.de";
const String sender_id="26:62:ab:0a:fb:ed";


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
 if (!bmp.begin()) 
  {
    Serial.println("Could not find BMP180 or BMP085 sensor at 0x77");
    while (1) {}
  }
  }
void loop() {
  // put your main code here, to run repeatedly:
 delay(60000);//Alle 60 Sekunden messen
 
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
  
//BMP
  Serial.print("Temperature = ");
  float bmptemp= bmp.readTemperature();
  float bmppress= bmp.readPressure();
  Serial.print(bmp.readTemperature());
  Serial.println(" Celsius");
 
  Serial.print("Pressure = ");
  Serial.print(bmp.readPressure());
  Serial.println(" Pascal");

  delay(1000);
  //data t={sender_id,SERVER_PASSWORD,Temperatur,bmppress,Luftfeuchtigkeit};
  //Serial.print(t.humus);

  //Server 
  WiFiClient client;
  HTTPClient http;
  StaticJsonDocument <200> data;
  data["password"] = SERVER_PASSWORD;
  data["sender_id"] = sender_id;
  data["humus"]   = Luftfeuchtigkeit;
  data["temperature"]   = Temperatur;
  data["humidity"]   = bmppress;
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
  
}
