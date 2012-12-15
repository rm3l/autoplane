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
#define CTRL_REG5 0x24

int Addr = 0x1e;	// I2C address of gyro
int x, y, z;

void selectDevice(int fd, int addr, char * name) {
	fprintf(stdout, "Selecting device\r\n");
	if (ioctl(fd, I2C_SLAVE, addr) < 0) {
		fprintf(stderr, "%s not present\n", name);
		exit(1);
	}
}

void writeI2C(int fd, int reg, int val) {
	char buf[2];
	buf[0] = reg; buf[1] = val;
	int a = write(fd, buf, 2);
	
	fprintf(stdout, "Writing Data: %d %d\n", buf[0], buf[1]);
	
	if (a != 2) {
		fprintf(stderr, "Can't write to L2G4222D\n");
		//exit(1);
	}
}

void getGyroValues(int fd) {
	char MSB, LSB;

	MSB = readI2C(fd, 0x29);
	LSB = readI2C(fd, 0x28);
	x = ((MSB << 8) | LSB);

	MSB = readI2C(fd, 0x2B);
	LSB = readI2C(fd, 0x2A);
	y = ((MSB << 8) | LSB);

	MSB = readI2C(fd, 0x2D);
	LSB = readI2C(fd, 0x2C);
	z = ((MSB << 8) | LSB);

	fprintf(stdout, "\rX: %6.0x Y: %4.0f Z: %4.0f", x, y, z);
}

int readI2C (int fd, int regAddr) {
	char buf[1];
	buf[0] = regAddr;
	if(write(fd, buf, 1) != 1) {
		fprintf(stdout, "Failed\n");
	}
    read(fd, buf, 1);
	//fprintf(stdout, "\nReading 1 byte: %d", buf[0]);
	return buf[0];
}

int main(int argc, char **argv){
	int fd;
	if ((fd = open("/dev/i2c-0", O_RDWR)) < 0) {
		// Open port for reading and writing
		fprintf(stderr, "Failed to open i2c bus\n");
		exit(1);
	}

	selectDevice(fd, Addr, "L3G");

	writeI2C(fd, CTRL_REG1, 0x1F);	// Turn on all axes, disable power down
	usleep(1260000);		// Wait to synchronize
	writeI2C(fd, CTRL_REG2, 0b00000000);
	writeI2C(fd, CTRL_REG3, 0x08);	// Enable control ready signal
	writeI2C(fd, CTRL_REG4, 0b00110000);	// Set scale (500 deg/sec)
	writeI2C(fd, CTRL_REG5, 0b00000000);

	while (1) {
		getGyroValues(fd);	// Get new values
		usleep(1260000);		// Wait to synchronize
	}

	exit(0);
}