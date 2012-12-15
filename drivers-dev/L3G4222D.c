#include <stdio.h>
#include <stdlib.h>
#include <fcntl.h>
#include <unistd.h>
#include <string.h>
#include <sys/ioctl.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <linux/i2c-dev.h>

#define L3G4200D_I2C_ADDR 0x68

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

int main(int argc, char **argv) {
	unsigned int range;
	int count, b;
	short x, y, z;
	float xa, ya, za;
	int fd;
	unsigned char buf[16];
	int fullScale = 2;
	int data[20];
   
   if ((fd = open("/dev/i2c-0", O_RDWR)) < 0) {
		// Open port for reading and writing
		fprintf(stderr, "Failed to open i2c bus\n");
		exit(1);
	}
   
	/* initialise ADXL345 */

	selectDevice(fd, L3G4200D_I2C_ADDR, "ADXL345");

	writeToDevice(fd, 0x20, 0b00001111);
	writeToDevice(fd, 0x21, 0b00000000);
	writeToDevice(fd, 0x22, 0b00001000);
	fullScale &= 0x03;
	writeToDevice(fd, 0x23, fullScale<<4);
	writeToDevice(fd, 0x24, 0b00000000);

	while (1) {
		/* select L3G4222D */
		selectDevice(fd, L3G4200D_I2C_ADDR, "ADXL345");
		int i;
		for(i=0x28;i<0x2E;i++) {
			buf[0] = i;
			if ((write(fd, buf, 1)) != 1) {
				fprintf(stderr, "Error writing to i2c slave\n");
				//exit(1);
			}
			if (read(fd, buf, 6) != 6) {
				data[i]=buf[0];
			}
			fprintf(stderr, data[i]);
		}
		if (read(fd, buf, 6) != 6) {
			//  X, Y, Z accelerations

			fprintf(stderr, "Unable to read from ADXL345\n");
			exit(1);
		} else {
			x = buf[1]<<8| buf[0];
			y = buf[3]<<8| buf[2];
			z = buf[5]<<8| buf[4];
			xa = (90.0 / 256.0) * (float) x;
			ya = (90.0 / 256.0) * (float) y;
			za = (90.0 / 256.0) * (float) z;
			printf("%4.0f %4.0f %4.0f\n", xa, ya, za);
		}
		usleep(100000);
	} 
   return 0;
}