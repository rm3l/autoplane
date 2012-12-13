#include <stdio.h>
#include <stdlib.h>
#include <fcntl.h>
#include <unistd.h>
#include <string.h>
#include <sys/ioctl.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <linux/i2c-dev.h>

#define BMP085_I2C_ADDR 0x77

unsigned int range;
int count, b;
short x, y, z;
float xa, ya, za;
int fd;
unsigned char buf[16];
int totalRuns;

int ac1;
int ac2;
int ac3;
unsigned int ac4;
unsigned int ac5;
unsigned int ac6;
int b1;
int b2;
long b5;
int mb;
int mc;
int md;
short temperature;
long pressure;

void selectDevice(int fd, int addr, char * name) {
	if (ioctl(fd, I2C_SLAVE, addr) < 0) {
		fprintf(stderr, "%s not present\n", name);
		exit(1);
	}
}

void writeToDevice(int fd, int reg, int val) {
	char buf[2];
	buf[0] = reg; buf[1] = val;
	if (write(fd, buf, 2) != 2) {
		fprintf(stderr, "Can't write to ADXL345\n");
		exit(1);
	}
}

int readInt(int bu, int fd) {
	unsigned char buf[2];
	buf[0] = bu;
	write(fd, buf, 1);
	read(fd, buf, 2);
	//printf("Before: %c");
	//printf("After: %i\n", ((int)buf[0])<<8 | (int)buf[1]);
	return ((int)buf[0])<<8 | (int)buf[1];
}

// Read the uncompensated temperature value
unsigned int bmp085ReadUT() {
	unsigned int ut;
	char buf[1];

	buf[0] = 0xF4;
	if ((write(fd, buf, 1)) != 1) {
		fprintf(stderr, "Error writing to i2c slave\n");
	}
	buf[0] = 0x2E;
	if ((write(fd, buf, 1)) != 1) {
		fprintf(stderr, "Error writing to i2c slave\n");
	}

	// Wait at least 4.5ms
	//sleep(6);

	// Read two bytes from registers 0xF6 and 0xF7
	ut = readInt(0xF6, fd);
	return ut;
}

short bmp085GetTemperature(unsigned int ut) {
	long x1, x2;

	x1 = (((long)ut - (long)ac6)*(long)ac5) >> 15;
	x2 = ((long)mc << 11)/(x1 + md);
	b5 = x1 + x2;

	return ((b5 + 8)>>4);
}

int main(int argc, char **argv) {
	if (argc != 3) {
		fprintf(stdout, "Usage: BINARY TOTAL_RUNS INTAVAL\n");
		exit(1);
	}

	if ((fd = open("/dev/i2c-0", O_RDWR)) < 0) {
		// Open port for reading and writing
		fprintf(stderr, "Failed to open i2c bus\n");
		exit(1);
	}

	/* initialise ADXL345 */
	selectDevice(fd, BMP085_I2C_ADDR, "ADXL345");
	ac1 = readInt(0xAA, fd);
	ac2 = readInt(0xAC, fd);
	ac3 = readInt(0xAE, fd);
	ac4 = readInt(0xB0, fd);
	ac5 = readInt(0xB2, fd);
	ac6 = readInt(0xB4, fd);
	b1	= readInt(0xB6, fd);
	b2	= readInt(0xB8, fd);
	mb	= readInt(0xBA, fd);
	mc	= readInt(0xBC, fd);
	md	= readInt(0xBE, fd);

	totalRuns = atoi(argv[1]);
	while (totalRuns != 0) {
		/* select ADXL345 */
		selectDevice(fd, BMP085_I2C_ADDR, "BMP085");
		fprintf(stderr, "Before\n");
		//fprintf(stderr, bmp085ReadUT());
		printf("%4.0f\r\n", bmp085GetTemperature(bmp085ReadUT()));
		fprintf(stderr, "After\n");

		usleep(atoi(argv[2]));
		--totalRuns;
	}
   return 0;
}