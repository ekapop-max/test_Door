#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

#define pinON 5 //D1-GPIO5

const char* ssid = "ssid";
const char* password = "password";


void setup() {
  Serial.begin(115200);
  pinMode(pinOn, OUTPUT);
  
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
        delay(1000);
  Serial.print(",");
  }
}
 void loop() {
  Serial.println();
  HTTPClient http;
  http.begin("https://door1234.herokuapp.com/data.json", "08:3B:71:72:02:43:6E:CA:ED:42:86:93:BA:7E:DF:81:C4:BC:62:30");
  int httpCode = http.GET();
  if (httpCode == 200) 
  {
    String content = http.getString();
    Serial.println(content);

  int ValueOn = -1;
  int ValueOff = -1;
  int ValueError = -1;
  
  ValueError = content.indexOf("error");
  ValueOn = content.indexOf("เปิด");
  ValueOff = content.indexOf("ปิด");

  if (ValueError > 0) {
  delay(9000);
  }
  else 
  {
    Serial.print("");
    
     if (ValueOn and ValueOff == -1) 
    {
      Serial.print("\nAwaiting Command\n");     
    }
         if (ValueOn != -1)
          {
            digitalWrite(pinOn, HIGH); 
            Serial.println("\n On\n");
              
           }

         if (ValueOff != -1) 
          {
            digitalWrite(pinOn, LOW);   
            Serial.print("\n Off\n");
            
          }


          } 
  }
  else {
    Serial.println("Fail. error code " + String(httpCode));
  }
    delay(1000);
  }
