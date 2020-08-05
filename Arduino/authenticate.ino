#include <Adafruit_Fingerprint.h>
SoftwareSerial mySerial(2, 3);
uint8_t id;
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);
void setup()
{
  Serial.begin(9600);
  while (!Serial);  // For Yun/Leo/Micro/Zero/...
  delay(100);
  // set the data rate for the sensor serial port
  finger.begin(57600);
 Serial.println("\n\n\t\t\t\t\t\tMEDICAL INSURANCE BIOMETRIC ENROLLMENT");

  if (finger.verifyPassword()) {
     Serial.println("\t\t\t\t\tREADY TO ENROLL PATIENT FINGERPRINT TO DATABASE");
    Serial.println("\t\t\t\t\t\tSystem Developed by Bella @2020");
    Serial.println("\t\t.....................................................................................................\n\n");
  }
  else {
     Serial.println("Scanner not found. \nKindly check whether the Scanner is properly connected.");
    while (1) { delay(1); }
  }

  finger.getTemplateCount();

    if (finger.templateCount == 0) {
    Serial.print("Sensor doesn't contain any fingerprint data. Please run the 'enroll' example.");
  }
  else {
    Serial.println("Enter the Patient ID to Authenticate: ");
  id = readnumber();
    Serial.print("Thank you. Authenticating Patient ID #"); Serial.print(id);Serial.print("...\n\n");
      //Serial.print("Sensor contains "); Serial.print(finger.templateCount); Serial.println(" templates");
  }
}

uint8_t readnumber(void) {
  uint8_t num = 0;

  while (num == 0) {
    while (! Serial.available());
    num = Serial.parseInt();
  }
  return num;
}

void loop()                     // run over and over again
{
  getFingerprintID();
  delay(50);            //don't ned to run this at full speed.
}

uint8_t getFingerprintID() {
  uint8_t p = finger.getImage();
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image taken\n");
      delay(100);
      break;
    case FINGERPRINT_NOFINGER:
      Serial.println("Place your finger in the scanner...");
      delay(5000);
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      delay(6000);
      return p;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      delay(6000);
      return p;
    default:
      Serial.println("Unknown error");
      delay(6000);
      return p;
  }

  // OK success!

  p = finger.image2Tz();
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Image converted\n");
      delay(100);
      break;
    case FINGERPRINT_IMAGEMESS:
      Serial.println("Image too messy");
      return p;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      return p;
    case FINGERPRINT_FEATUREFAIL:
      Serial.println("Could not find fingerprint features");
      return p;
    case FINGERPRINT_INVALIDIMAGE:
      Serial.println("Could not find fingerprint features");
      return p;
    default:
      Serial.println("Unknown error");
      return p;
  }

  // OK converted!
  p = finger.fingerFastSearch();
  if (p == FINGERPRINT_OK) {

    //Serial.println("Found a print match!");
     if (finger.fingerID != id){
      Serial.print("The fingerprint is NOT a Match for Patient ID: "); Serial.println(id);
      Serial.print("Authentication failed.\n\nRemove the finger and place it again\n");
      delay(1000);
      return -1;
    }
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_NOTFOUND) {
    Serial.println("Fingerprint does not exist. Authentication failed.");
     Serial.println("Register patient and try again.\n\n");
     Serial.print("Kindly shut down Arduino to save resources...");
     delay(15000000);
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }

  Serial.print("..............................................Patient with ID #"); Serial.print(finger.fingerID); Serial.println(" Authenticated..............................................");
   Serial.print("............................................Biometric Confirmation Confidence: "); Serial.print(finger.confidence);Serial.println("............................................\n\n");
  Serial.print("...................................Press Complete Payment to verify payment"); Serial.println("......................................\n\n");
  Serial.print("Kindly shut down Arduino to save resources...");
  delay(15000000);
  return finger.fingerID;
}

// returns -1 if failed, otherwise returns ID #
int getFingerprintIDez() {
  uint8_t p = finger.getImage();
  if (p != FINGERPRINT_OK)
  //Serial.println("Fingerprint Not Okay");
  return -1;

  p = finger.image2Tz();
  if (p != FINGERPRINT_OK)
  //Serial.println("Fingerpring Not Okay");
  return -1;

  p = finger.fingerFastSearch();
  if (p != FINGERPRINT_OK)  return -1;

  if (finger.fingerID != id){
      Serial.print("Finger NOT a Match. Authentication failed.\n\nRemove the finger and place it again\n");
      return -1;
    } else
  // found a match!
  Serial.print("..............................................Patient with ID #"); Serial.print(finger.fingerID); Serial.println(" Authenticated..............................................");
  Serial.print("..............................................Biometric Confirmation Confidence: "); Serial.print(finger.confidence);Serial.println("..............................................\n\n");
  //delay(15000000);
  return finger.fingerID;
}