#include <stdio.h>
#include <stdlib.h>
#include <fcntl.h>
#include <unistd.h>
#include <string.h>
#include <sys/ioctl.h>
#include <sys/types.h>
#include <sys/stat.h>
#include <linux/i2c-dev.h>
#include <math.h>

int address = 0x3C>> 1;
int regb=0x01;
int regbdata=0x40;
int moderegadr=0x02;
int dataregadr1=0x03;
int dataregadr2=0x04;
int dataregadr3=0x05;
int dataregadr4=0x06;
int dataregadr5=0x07;
int dataregadr6=0x08;
int statusregadr=0x09;
int idenrega=0xA;
int idenregb=0xB;
int idenregc=0xC;
int instruct=0x00;
int readingdata[20];
int reading;
int a;
int fd;
char buf[2];

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
		fprintf(stderr, "Can't write to Compass\n");
		exit(1);
	}
}

void loop(int fd) {
	int i,x,y,z;
	double angle;

	usleep(100000);
	/*writeToDevice(fd, moderegadr, instruct);
	usleep(1000000);
	writeToDevice(fd, regb, regbdata);
	usleep(1000000);
	writeToDevice(fd, regb, regbdata);
	usleep(1000000);*/
	buf[0] = moderegadr;
	if(	write(fd, buf, 1) != 1 ) {
		fprintf(stderr, "Can't write to Compass4\n");
	}
	usleep(100000);
	buf[0] = instruct;
	if( write(fd, buf, 1) != 1) {
		fprintf(stderr, "Can't write to Compass3\n");
	}
	usleep(100000);
	buf[0] = regb;
	if(	write(fd, buf, 1) != 1) {
		fprintf(stderr, "Can't write to Compass2\n");
	}
	usleep(100000);
	buf[0] = regbdata;
	if( write(fd, buf, 1) != 1) {
		fprintf(stderr, "Can't write to Compass1\n");
	}
	//write(fd, moderegadr, 1);

	buf[0] = dataregadr1;
	write(fd, buf, 1);
	read(fd, readingdata, 6);
	printf("%9.0f\r\n", readingdata[0]);

	x = readingdata[0] * 256 + readingdata[1];
	y = readingdata[4] * 256 + readingdata[5];
	angle = atan2((double)y,(double)x)*180/3.14+180;
	//angle = ((double)y,(double)x)*180/3.14+180;
	/*if(0<angle&&angle<180)
	{
	angle=angle;
	}
	else
	{
	angle=360-angle;
	}*/
	printf("%9.0f\r\n", angle);
}

int main (int argc, char **argv) {
	if ((fd = open("/dev/i2c-0", O_RDWR)) < 0) {
		// Open port for reading and writing
		fprintf(stderr, "Failed to open i2c bus\n");
		exit(1);
	}
	selectDevice(fd, address, "Compass");
	while (1) {
		loop(fd);
	}
}