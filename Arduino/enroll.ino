#include <Adafruit_Fingerprint.h>
SoftwareSerial mySerial(2, 3);
Adafruit_Fingerprint finger = Adafruit_Fingerprint(&mySerial);

uint8_t id, option;
int userId;
void setup()  
{
  Serial.begin(9600);
  while (!Serial);  
  delay(100);
  // set the data rate for the sensor serial port
  finger.begin(57600);
  Serial.println("\n\n\t\t\t\t\t\tMEDICAL INSURANCE BIOMETRIC ENROLLMENT");
  if (finger.verifyPassword()) {
    Serial.println("\t\t\t\t\tREADY TO ENROLL PATIENT FINGERPRINT TO DATABASE");
    Serial.println("\t\t\t\t\t\tSystem Developed by Bella @2020");
    Serial.println("\t\t.....................................................................................................\n\n");
  } else {
    Serial.println("Scanner not found. \nKindly check whether the Scanner is properly connected.");
    while (1) { delay(1); }
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
  Serial.println("Scanner Found. Proceeding to enroll a fingerprint...\n"); 
  Serial.println("STEP 1: Please type in Patients ID above and hit Enter ...\n");
  id = readnumber();
  if (id == 0) {// ID #0 not allowed, try again!
    Serial.println("You cannot enroll patient with ID 0");
     return;
  }
  Serial.print("Thank you. Enrolling Patient ID #");
  Serial.println(id);
  
  while (!  getFingerprintEnroll() );
  
}
  
uint8_t getFingerprintEnroll() {

  int p = -1;
  Serial.print("STEP 2: Please press Patients finger on the scanner..."); //Serial.println(id);
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Fingerprint image has been taken taken...Now converting");
      break;
    case FINGERPRINT_NOFINGER:
      Serial.println("waiting for finger...");
      delay(2000);
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      break;
    default:
      Serial.println("Unknown error");
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(1);
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Fingerprint Image has been converted\n\n");
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
  
  Serial.println("Please remove the finger\n");
  delay(2000);
  p = 0;
  while (p != FINGERPRINT_NOFINGER) {
    p = finger.getImage();
  }
  //Serial.print("Patient ID being enrolled: "); Serial.println(id);
  p = -1;
  Serial.println("STEP 3: Press the same finger again...\n");
  while (p != FINGERPRINT_OK) {
    p = finger.getImage();
    switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Thank you. Fingerprint Image has been taken. Converting...\n");
      break;
    case FINGERPRINT_NOFINGER:
      Serial.println("waiting finger...");
      delay(2000);
      break;
    case FINGERPRINT_PACKETRECIEVEERR:
      Serial.println("Communication error");
      break;
    case FINGERPRINT_IMAGEFAIL:
      Serial.println("Imaging error");
      break;
    default:
      Serial.println("Unknown error");
      break;
    }
  }

  // OK success!

  p = finger.image2Tz(2);
  switch (p) {
    case FINGERPRINT_OK:
      Serial.println("Second fingerprint Image has been converted\n");
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
  Serial.print("Please Wait while we create a fingerprint model for the Patient ID #");  Serial.println(id + " \n\n");

  p = finger.createModel();
  if (p == FINGERPRINT_OK) {
    Serial.println("FingerPrints Matched. Storing...\n");
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_ENROLLMISMATCH) {
    Serial.println("Fingerprints did not match. Please Enroll Again");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }   
  
  //Serial.print("Patient ID: "); Serial.println(id);
  p = finger.storeModel(id);
  
  if (p == FINGERPRINT_OK) {
    Serial.println("DONE: Patient fingerprint registered and Stored. Press the Complete Registration button on your WebPage to finalize the process\n\n");
    Serial.println("Close down arduino to save on memory");
    delay(15000000000);
  } else if (p == FINGERPRINT_PACKETRECIEVEERR) {
    Serial.println("Communication error");
    return p;
  } else if (p == FINGERPRINT_BADLOCATION) {
    Serial.println("Could not store in that location");
    return p;
  } else if (p == FINGERPRINT_FLASHERR) {
    Serial.println("Error writing to flash");
    return p;
  } else {
    Serial.println("Unknown error");
    return p;
  }   

  
}