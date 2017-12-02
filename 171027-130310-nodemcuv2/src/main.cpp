#include <Arduino.h>
#include <puertos.h>
#include <ESP8266WiFi.h>  
//Incluye la librería ESP8266WiFi

char ssid[] = "NodeMCU-ESP8266";    //Definimos la SSDI de nuestro servidor WiFi -nombre de red- 
char password[] = "12345678";       //Definimos la contraseña de nuestro servidor 
WiFiServer server(3000);            //Definimos el puerto de comunicaciones
String peticion;

void setup() {
  // Definicion del servidor nodeMCU
  server.begin();        
  WiFi.mode(WIFI_AP);
  WiFi.softAP(ssid, password);      
  //si falla la conexion, imprimir mac y red      
  
  // definicion en PULL-UP de sensores (siempre es 1 hasta que suceda evento)
  pinMode(FIN_CARERA,INPUT_PULLUP);
  pinMode(SENSOR_M, INPUT_PULLUP);
  pinMode(OCTOCOPLADOR, INPUT_PULLUP);
  pinMode(MOTOR_DERECHA,OUTPUT);
  pinMode(MOTOR_IZQUIERDA,OUTPUT);

  //Mandamos los/el motor a bajo para que no gire en ningun sentido
  digitalWrite(MOTOR_IZQUIERDA,HIGH);
  digitalWrite(MOTOR_DERECHA,LOW);
      //Esperamos a que la cerradura llegue abrir la primera vez
  while(digitalRead(FIN_CARERA) == 1){
    delay(100);
  }

  digitalWrite(MOTOR_IZQUIERDA,LOW);
  digitalWrite(MOTOR_DERECHA,LOW);

  // digitalWrite(MOTOR_IZQUIERDA,LOW);
  // Definicion de puerto Serie
  Serial.begin(115200);

}
  /*
  Realizamos la conexion con el socket
  si es "abrir", abrir cerradura sin verificar nada
  si es "Cerrar"
      verificamos el sensor magnetico
      corremos la cerradura hasta el fin de carrera -(recordar el delay de 100)
      apagamos todos los sensores nuevamente
  si es "consulta"
      Armar un string con las siguientes caracteristicas:
      OCTOCOPLADOR|FIN_CARRERA|SENSOR_M
  
  cerrar conexion 
  */

void loop() {
 // Comprueba si el cliente ha conectado
 WiFiClient client = server.available();  
 if (!client) {
   return;
 } 
 // Espera hasta que el cliente envía alguna petición
 Serial.println("Nuevo cliente");
 while(!client.available()){
   delay(1);
 }

 peticion = client.readStringUntil('r');
 Serial.println(peticion);
 client.flush();

// si un switch es un conjunto de if, hace if si no te lo acrodas

 if(peticion.indexOf("ab")!= -1){
      Serial.println("Se abrio la puerta");
      digitalWrite(MOTOR_IZQUIERDA,LOW);
      digitalWrite(MOTOR_DERECHA,HIGH);
      //Esperamos a que la cerradura llegue abrir la primera vez
      while(!digitalRead(OCTOCOPLADOR) == 1){
        delay(50);
      }
      digitalWrite(MOTOR_IZQUIERDA,LOW);
      digitalWrite(MOTOR_DERECHA,LOW);

      client.println("Recibido");
      client.flush();
 }
 
 if(peticion.indexOf("ce")!= -1){
      Serial.println("Se cerro la puerta");
      //Mandamos los/el motor a bajo para que no gire en ningun sentido
      digitalWrite(MOTOR_IZQUIERDA,HIGH);
      digitalWrite(MOTOR_DERECHA,LOW);
      //Esperamos a que la cerradura llegue abrir la primera vez
      while(digitalRead(FIN_CARERA) == 1){
        delay(100);
      }
      digitalWrite(MOTOR_IZQUIERDA,LOW);
      digitalWrite(MOTOR_DERECHA,LOW);
      
      client.println("Recibido");
      client.flush();
  }
 //
 if(peticion.indexOf("es") != -1){
   //mandamos la trama a trasmitir
   //OCTOCOPLADOR|FIN_CARRERA|SENSOR_M
    client.println("1|1|1");
    client.flush();

 } 
 
 Serial.println("Esperando conexion de cliente......");

}