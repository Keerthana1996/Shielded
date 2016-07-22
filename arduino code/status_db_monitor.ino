#include <SPI.h>
#include <Ethernet.h>


//variables for heart and gsr parameters
int count=0,x=0,avg=0;
int status=0;
double a=0, b=0, d=0, c=0, sdnn=0, b1=0,c1=0, d1=0, rmssd=0;
int t1 =0;
int t2 =0;
int arr[150];
const int GSR=A2;
int threshold=0;
int sensorValue;

//ethernet related 
byte mac[] = { 0x98, 0x4F, 0xEE, 0x01, 0x89, 0xD0 };
IPAddress server(144,76,145,166); 
IPAddress ip(172, 16, 29, 200);

EthernetClient client;


void setup() {
Serial.begin(9600);     // initialize serial communication at 9600 bits per second
while (!Serial) {
  }
system("ifup eth0");
delay(1000);

pinMode(3, INPUT);
long sum=0;
  
  for(int i=0;i<500;i++)
  {
  sensorValue=analogRead(GSR);
  sum += sensorValue;
  delay(5);
  }
  threshold = sum/500;
   Serial.print("threshold =");
   Serial.println(threshold);

  if (Ethernet.begin(mac) == 0) {
    Serial.print("Ethernet.begin(mac)=");
    Serial.println(Ethernet.begin(mac));
    Serial.println("Failed to configure Ethernet using DHCP");
    Ethernet.begin(mac, ip);
  }  
  
  delay(1000);
  
}
void loop()            // the loop routine runs over and over again forever:
{
 for(int i=0; i<150; i++)
 {
  arr[i]=0;
  }
  
t1 = (millis());
//Serial.println(t1);
for(int i=0;i<120;i++)
{
if(digitalRead(3)==1)
{
t2 = millis();
//Serial.println(t2);
a=(t2-t1);
arr[count]=a;
x=x+a;
t1=t2;
count++;
}
delay(500);
}
avg=x/(count-1);
Serial.println();
Serial.println("heatbeat rate=");
Serial.println(count);
Serial.println("Average");
Serial.println(avg);
for(int i=1; i<count-1; i++)
{
//Serial.println("Array:");
  //Serial.println(arr[i]);
  b=arr[i]-avg;
  //Serial.println(b);
  d = d + (b*b);
  b1 = arr[i+1]-arr[i];
  d1 = d1 + (b1*b1);
  }
  c = d/(count-1);
  c1 = d1/(count-2);
  sdnn = sqrt(c);
  rmssd = sqrt(c1);
  Serial.println("SDNN=");
  Serial.println(sdnn);
  Serial.println("RMSSD");
  Serial.println(rmssd);
  int temp;
  sensorValue=analogRead(GSR);
  Serial.print("sensorValue=");
  Serial.println(sensorValue);
  temp = threshold - sensorValue;
  if(abs(temp)>300)
  {
    sensorValue=analogRead(GSR);
    temp = threshold - sensorValue;
    if(abs(temp)>300 && avg<550 && sdnn<150 && rmssd<300)
     {
    status=1;  
    Serial.println("Person in Distress!");
    delay(1000);
     }
     else
    {
      status=0;
    Serial.println("No change");
    }
 }
 else
 {
    Serial.println("No change");
    status=0;
  }

int ret;
  if (ret = client.connect(server, 80)) {
    Serial.println("connected");
  }
   else {
    Serial.println("connection failed");
    Serial.println(ret);
  }

  if(client.connected()){
    client.print("GET /status.php?status=");
    client.print(status);
    client.print(",");
    client.print(count);
    client.print(",");
    client.print(sensorValue);
    client.println(" HTTP/1.1");
    client.println("Host: shielded.coolpage.biz");
    client.println("Connection: close");
    client.println();
    Serial.println(status);
    delay(60000);
    }
    
  // if the server's disconnected, stop the client:
  if (!client.connected()) {
    Serial.println();
    Serial.println("disconnecting.");
    client.stop();
  }
  client.stop();

status=0;
count=0;
t1=0;
t2=0;
avg=0;
x=0;
a=0;
b=0;
d=0;
c=0;
sdnn=0;
b1=0;
d1=0;
c1=0;
rmssd=0;
delay(3000);      // delay in between reads for stability
}








