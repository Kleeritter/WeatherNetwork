local SSID = "FRITZ!Box Gastzugang"
local SSID_PASSWORD = "sascha_oksana"
local SIGNAL_MODE = wifi.PHYMODE_N
local bruze
local maintime
SDA_PIN = 4 -- sda pin, GPIO2
SCL_PIN = 3 -- scl pin, GPIO0

INTERVAL = 300 -- seconds
RASPBERRY_PI_URL = "http://kleeritter.duckdns.org:8001/esp8266_trigger"
SERVER_PASSWORD = "tutorials-raspberrypi.de"
 
 
function wait_for_wifi_conn ( )
   bruze=tmr.create()
   bruze:alarm(1000, tmr.ALARM_AUTO, function ( )
 
      if wifi.sta.getip ( ) == nil then
         print ("Waiting for Wifi connection")
      else
         bruze:unregister()
         print ("ESP8266 mode is: " .. wifi.getmode ( ))
         print ("The module MAC address is: " .. wifi.ap.getmac ( ))
         print ("Config done, IP is " .. wifi.sta.getip ( ))
      end
   end)
end
 
function transmit_msg(data)
    -- send http request to Raspberry Pi
    ok, json = pcall(sjson.encode, data)
    if ok then        
        http.post(RASPBERRY_PI_URL,
            'Content-Type: application/json\r\n',
            json,
            function(code, data)
                if (code < 0) then
                    print("HTTP request failed")
                --else
                --    print(code, data)
                end
        end)
    else
        return false
    end
end
 
function readDHTValues()
    status, temp, humi, temp_dec, humi_dec = dht.read(DHT_PIN)
    if status == dht.OK then
    
        return {temperature= temp, humidity= humi}  
         
    else
        return false
    end
end

function readbmp()
     local sda, scl = 4, 3
     i2c.setup(0, sda, scl, i2c.SLOW)
     bmp085.setup()
     local t = bmp085.temperature()
     local p = bmp085.pressure()
     print(t)
     print(p)
     return{temperature= t/10, humidity= p/100000} 
end
function main()
        maintime=tmr.create()
        maintime:alarm(60000, tmr.ALARM_AUTO, function ( ) 
        data = readbmp()
        if data ~= false then
            data["sender_id"] = wifi.ap.getmac()
            data["password"] = SERVER_PASSWORD
        
            transmit_msg(data)
           
        end
    end)
end
 
-- Configure the ESP as a station (client)
wifi.setmode(wifi.STATION)
wifi.setphymode(wifi.PHYMODE_N)
--wifi.sta.config(SSID, SSID_PASSWORD)
station_cfg={}
station_cfg.ssid="FRITZ!Box Gastzugang"
station_cfg.pwd="sascha_oksana"
station_cfg.save=true
wifi.sta.config (station_cfg)
wifi.sta.autoconnect (1)
 
-- Hang out until we get a wifi connection before the httpd server is started.
wait_for_wifi_conn ( )
 
main()


