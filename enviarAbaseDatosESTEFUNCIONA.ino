#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include "Gsender.h"

#pragma region Globals
//-------------------VARIABLES GLOBALES--------------------------
#define TRIGGER 5
#define ECHO    4
//#define TRIGGER3 2
#define ECHO1 0
#define TRIGGER2 16  //D0
#define TRIGGER3 15   //D8
#define ECHO3    13   //D7

// NodeMCU Pin D1 > TRIGGER | Pin D2 > ECHO
//             D4 > TRIGGER3 | Pin D3 > ECHO1

int contconexion = 0;
uint8_t connection_state = 0;                    // Determina el estado de la conexion
uint16_t reconnect_interval = 10000;  
String TramaMensajeGmail = "";
const char *ssid = "Moto G (5) 2928";
const char *password = "37500685";
#pragma endregion Globals
unsigned long previousMillis = 0;

char host[48];
//String strhost = "127.0.0.1";    //xampp
String strhost = "192.168.43.43";     //uniserver volver a esto para que funcione
String strurl = "/contenedor/enviardatos.php";  //uniserver volver a esto para que funcione
//String strurl = "/enviardatos.php"; //xampp
String chipid = "";
String estado = "";

//-------Función para Enviar Datos a la Base de Datos SQL--------
void EnviarMensajeGMAIL (void)
{   
    if(!connection_state)  // if not connected to WIFI
     Awaits();          // constantly trying to connect

    Gsender *gsender = Gsender::Instance();    // Getting pointer to class instance
    
    String subject = "MENSAJE - ESTADO SENSOR";

    TramaMensajeGmail += "<html>"; 
    TramaMensajeGmail += "<body>"; 

    TramaMensajeGmail += "<h1>ALERTA SENSOR ACTIVADO</h1>"; 
    TramaMensajeGmail += "<br>";
    
    TramaMensajeGmail += "<p>"; 
    TramaMensajeGmail += "<b>El contacto magnetico ha sido abierto</b>."; 
    TramaMensajeGmail += "<br>";
    TramaMensajeGmail += "<b>se requiere de atención inmediata</b>.";
     
    TramaMensajeGmail += "</p>"; 
    TramaMensajeGmail += "</body>"; 
    TramaMensajeGmail += "</html>";
    
    if(gsender->Subject(subject)->Send("mattg1593@gmail.com", TramaMensajeGmail)) {
       
      delay(1000);
      Serial.println("MENSAJE ENVIADO EXITOSAMENTE");
           
    } else {
        
        //digitalWrite(LedVerificacion, LOW);
        Serial.print("ERROR AL ENVIAR EL MENSAJE: ");
       Serial.println(gsender->getError());
    }
}
void Awaits()
{
    uint32_t ts = millis();
    while(!connection_state)
    {
        delay(50);
        if(millis() > (ts + reconnect_interval) && !connection_state){
           connection_state = WiFi.status();
            ts = millis();
        }
    }
}
 
String enviardatos(String datos) {
  String linea = "error";
  WiFiClient client;
  strhost.toCharArray(host, 49);
  if (!client.connect(host, 80)) {
    Serial.println("Fallo de conexion");
    return linea;
  }

  client.print(String("POST ") + strurl + " HTTP/1.1" + "\r\n" + 
               "Host: " + strhost + "\r\n" +
               "Accept: */*" + "*\r\n" +
               "Content-Length: " + datos.length() + "\r\n" +
               "Content-Type: application/x-www-form-urlencoded" + "\r\n" +
               "\r\n" + datos);           
  delay(5000);             
  
  Serial.print("Enviando datos a SQL...");
  
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println("Cliente fuera de tiempo!");
      client.stop();
      return linea;
    }
  }
  // Lee todas las lineas que recibe del servidro y las imprime por la terminal serial
  while(client.available()){
    linea = client.readStringUntil('\r');
  }  
  Serial.println(linea);
  return linea;
}


//-------------------------------------------------------------------------

void setup() {

  // Inicia Serial
  Serial.begin(9600);
  Serial.println("");

  Serial.print("chipId: "); 
  chipid = String(ESP.getChipId());
  Serial.println(chipid); 

  // Conexión WIFI
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED and contconexion <50) { //Cuenta hasta 50 si no se puede conectar lo cancela
    ++contconexion;
    delay(500);
    Serial.print(".");
  }
  if (contconexion <50) {
      //para usar con ip fija
      IPAddress ip(192,168,10,50); 
      IPAddress gateway(192,168,43,1); 
      IPAddress subnet(255,255,255,0); 
      WiFi.config(ip, gateway, subnet); 
      
      Serial.println("");
      Serial.println("WiFi conectado");
      Serial.println(WiFi.localIP());
  }
  else { 
      Serial.println("");
      Serial.println("Error de conexion");
  }
  //Sensor Distancia
  delay(5000);
  Serial.begin (9600);
  pinMode(TRIGGER, OUTPUT);
  pinMode(ECHO, INPUT);
  pinMode(BUILTIN_LED, OUTPUT);
  connection_state = WiFi.status();
}


//--------------------------LOOP--------------------------------
void loop() {

  unsigned long currentMillis = millis();

  if (currentMillis - previousMillis >= 10000) { //envia la distancia cada 10 segundos
    previousMillis = currentMillis;

  long duration;
  digitalWrite(TRIGGER, LOW);  
  delayMicroseconds(2); 
  
  digitalWrite(TRIGGER, HIGH);
  delayMicroseconds(10); 
  
  digitalWrite(TRIGGER, LOW);
  duration = pulseIn(ECHO, HIGH);
  float distance = (duration/2) / 29.1;
Serial.println(distance);

  long duration2;
  digitalWrite(TRIGGER2, LOW);  
  delayMicroseconds(2); 
  
  digitalWrite(TRIGGER2, HIGH);
  delayMicroseconds(10); 
  
  digitalWrite(TRIGGER2, LOW);
  duration2 = pulseIn(ECHO1, HIGH);
  float distance2 = (duration2/2) / 29.1;
Serial.println(distance2);
  //float distance3 = (distance+distance2)/2;

  /*long duration3;
  digitalWrite(TRIGGER3, LOW);  
  delayMicroseconds(2); 
  
  digitalWrite(TRIGGER3, HIGH);
  delayMicroseconds(10); 
  
  digitalWrite(TRIGGER3, LOW);
  duration3 = pulseIn(ECHO3, HIGH);
  float distance3 = (duration3/2) / 29.1;
Serial.println(distance3);*/
  float distance4 = (distance+distance2)/2;

  Serial.println("Distancia medida en centimetros:");
  Serial.println(distance4);

  if(0<=distance4 && distance4<=20)
{
  Serial.print("Estado: "); 
  //estado = String(3);
  estado ="LLENO";
  Serial.println(estado); 
//EnviarMensajeGMAIL();
}
else
{
  if(20<distance4 && distance4<=60)
  {
     Serial.print("Estado: "); 
  //estado = String(2);
  estado ="MEDIO LLENO";
  Serial.println(estado); 
  }
  else
  {
    if(60<distance4 && distance4<=100)
    {
     Serial.print("Estado: "); 
   //estado = String(1);
  estado ="VACIO";
  Serial.println(estado); 
    } 
    else
    {
    Serial.print("Estado: "); 
  //estado = String(1);
  estado = "VACIO";
  Serial.println(estado);  
    }
  }
  
}
  
    //int analog = analogRead(17);
    //float temp = analog*0.322265625;
    //Serial.println(temp);
  enviardatos("chipid=" + chipid + "&distancia=" + String(distance4, 2) + "&estado=" + estado) ;
  }
}
