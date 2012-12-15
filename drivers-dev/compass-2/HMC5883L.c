#include <stdio.h>
#include <stdlib.h>
#include <fcntl.h>
#include <unistd.h>
#include <string.h>
#include <sys/ioctl.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <linux/i2c-dev.h>

#define HMC5883L_I2C_ADDR 0x1e

void selectDevice(int fd, int addr, char * name) {
	if (ioctl(fd, I2C_SLAVE, addr) < 0) {
		fprintf(stderr, "%s not present\n", name);
		exit(1);
	}
}

void writeToDevice(int fd, int reg, int val) {
	char buf[2];
	buf[0]=reg; buf[1]=val;
	if (write(fd, buf, 2) != 2) {
		fprintf(stderr, "Can't write to HMC5883L\n");
		exit(1);
	}
}

int main(int argc, char **argv) {
	if (argc != 3) {
		fprintf(stdout, "Usage: BINARY TOTAL_RUNS INTAVAL\n");
		exit(1);
	}

	int x, y, z;
	float head;
	int fd;
	int buf[16];
	int totalRuns;
	int nSleep = atoi(argv[2]);

	if ((fd = open("/dev/i2c-0", O_RDWR)) < 0) {
		// Open port for reading and writing
		fprintf(stderr, "Failed to open i2c bus\n");
		exit(1);
	}

	/* initialise HMC5883L */

	selectDevice(fd, HMC5883L_I2C_ADDR, "HMC5883L");

	writeToDevice(fd, 0x3c, 0x70);
	writeToDevice(fd, 0x3c, 0xA0);
	writeToDevice(fd, 0x3c, 0x00);

	usleep(67000); // Hold it
	writeToDevice(fd, 0x3c, 0x03);

	totalRuns = atoi(argv[1]);
	while (totalRuns != 0) {
		/* select HMC5883L */
		selectDevice(fd, HMC5883L_I2C_ADDR, "HMC5883L");
		buf[0] = 0x06;
		if ((write(fd, buf, 1)) != 1) {
			// Send the register to read from
			fprintf(stderr, "Error writing to i2c slave\n");
			exit(1);
		}

		if (read(fd, buf, 6) != 6) {
			//  X, Y, Z readings
			fprintf(stderr, "Unable to read from HMC5883L\n");
			exit(1);
		} else {
			x = buf[0]<<8| buf[1];
			z = buf[2]<<8| buf[3];
			y = buf[4]<<8| buf[5];
			head = atan2 (y,x) * 180 / 3.14159265358979323846;
			
			/*x = buf[0] * 256 + buf[1];
			y = buf[4] * 256 + buf[5];
			head = atan2((double)y,(double)x)*180/3.14+180;*/

			printf("%4.0f\r", head);
			writeToDevice(fd, 0x3c, 0x03);
		}
		usleep(nSleep);
		--totalRuns;
	}

	return 0;
}