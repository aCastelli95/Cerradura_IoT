/*
 * NodeMCU/ESP8266 act as AP (Access Point) and simplest Web Server
 * to control GPIO (on-board LED)
 * Connect to AP "arduino-er", password = "password"
 * Open browser, visit 192.168.4.1
 */
#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <Servo.h>


const char *ssid = "arduino-er";
const char *password = "password";
int stateLED = LOW;
int angulo;
Servo servo1;

ESP8266WebServer server(80);

void handleRoot() {
    response();
}

void handleLedOn() {
  stateLED = LOW;
  digitalWrite(LED_BUILTIN, stateLED);
   for(angulo  = 45; angulo  >=0; angulo  -=1 )    //decrementa angulo 1 grado
            {
                 servo1.write( angulo );
                 delay(25);
                 Serial.println("ON1");
            }
  Serial.println("ON");
  response();
}

void handleLedOff() {
  stateLED = HIGH;
  digitalWrite(LED_BUILTIN, stateLED);
   for(angulo  = 0; angulo  <= 45; angulo  += 1)   //incrementa angulo 1 grado
            {
                 servo1.write(angulo);
                 delay(25);
                 Serial.println("OFF1");
            }
  Serial.println("OFF");
  response();
}

const String HtmlHtml = "<html><head>"
    "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\" /></head>";
const String HtmlHtmlClose = "</html>";
const String HtmlTitle = "<h1>Arduino-er: ESP8266 AP WebServer exercise</h1><br/>\n";
const String HtmlLedStateLow = "<big>LED is now <b>ON</b></big><br/>\n";
const String HtmlLedStateHigh = "<big>LED is now <b>OFF</b></big><br/>\n";
const String HtmlButtons = 
    "<a href=\"LEDOn\"><button style=\"display: block; width: 100%;\">ON</button></a><br/>"
    "<a href=\"LEDOff\"><button style=\"display: block; width: 100%;\">OFF</button></a><br/>";

void response(){
  String htmlRes = HtmlHtml + HtmlTitle;
  if(stateLED == LOW){
    htmlRes += HtmlLedStateLow;
  }else{
    htmlRes += HtmlLedStateHigh;
  }

  htmlRes += HtmlButtons;
  htmlRes += HtmlHtmlClose;

  server.send(200, "text/html", htmlRes);
}

void setup() {
    delay(1000);
    Serial.begin(115200);
    Serial.println();

    WiFi.softAP(ssid, password);

    IPAddress apip = WiFi.softAPIP();
    Serial.print("visit: \n");
    Serial.println(apip);
    server.on("/", handleRoot);
    server.on("/LEDOn", handleLedOn);
    server.on("/LEDOff", handleLedOff);
    server.begin();
    Serial.println("HTTP server beginned");
    pinMode(LED_BUILTIN, OUTPUT);
    digitalWrite(LED_BUILTIN, stateLED);

    // Control del motor Servo
     servo1.attach(D2);
     
}

void loop() {
    server.handleClient();
}
