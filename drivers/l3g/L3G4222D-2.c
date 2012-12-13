#include <stdio.h>
#include <stdlib.h>
#include <fcntl.h>
#include <unistd.h>
#include <string.h>
#include <sys/ioctl.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <linux/i2c-dev.h>

#define CTRL_REG1 0x20
#define CTRL_REG2 0x21
#define CTRL_REG3 0x22
#define CTRL_REG4 0x23

int Addr = 105;                 // I2C address of gyro
int x, y, z, fd;

void selectDevice(int fd, int addr, char * name) {
	if (ioctl(fd, I2C_SLAVE, addr) < 0) {
		fprintf(stderr, "%s not present\n", name);
		exit(1);
	}
}

void writeI2C(int fd, int reg, int val) {
	char buf[2];
	buf[0] = reg; buf[1] = val;

	if (write(fd, buf, 2) != 2) {
		fprintf(stderr, "Can't write to ADXL345\n");
		//exit(1);
	}
}

void loop(){
	getGyroValues();              // Get new values
	// In following Dividing by 114 reduces noise
	//Serial.print("X:");  Serial.print(y / 114);  
	//Serial.print("  Y:"); Serial.print(x / 114);
	//Serial.print("  Z:"); Serial.println(z / 114);
	printf("%8.0f", (x / 114));
	usleep(150501);                   // Short delay between reads
}

void getGyroValues() {
  char MSB, LSB;

  MSB = readI2C(0x29);
  LSB = readI2C(0x28);
  x = ((MSB << 8) | LSB);

  MSB = readI2C(0x2B);
  LSB = readI2C(0x2A);
  y = ((MSB << 8) | LSB);

  MSB = readI2C(0x2D);
  LSB = readI2C(0x2C);
  z = ((MSB << 8) | LSB);
}

int readI2C (int regAddr) {
	char buf[1];
    read(fd, buf, 1);
	return buf[0];
}

void main(int argc, char **argv){
	if ((fd = open("/dev/i2c-0", O_RDWR)) < 0) {
		// Open port for reading and writing
		fprintf(stderr, "Failed to open i2c bus\n");
		exit(1);
	}

	selectDevice(fd, Addr, "L3G");
	fprintf(stderr, "Can't write to ADXL3452\n");
	writeI2C(fd, CTRL_REG1, 0x1F);    // Turn on all axes, disable power down
	fprintf(stderr, "Can't write to ADXL3453\n");
	writeI2C(fd, CTRL_REG3, 0x08);    // Enable control ready signal
	fprintf(stderr, "Can't write to ADXL3454\n");
	writeI2C(fd, CTRL_REG4, 0x80);    // Set scale (500 deg/sec)
	fprintf(stderr, "Can't write to ADXL3455\n");
	getGyroValues();              // Get new values
	usleep(100000);                   // Wait to synchronize 
}