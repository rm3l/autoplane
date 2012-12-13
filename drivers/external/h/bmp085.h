#ifndef _BMP085_H
#define _BMP085_H

#include <linux/regmap.h>

#define BMP085_NAME             "bmp085"

extern struct regmap_config bmp085_regmap_config;

int bmp085_probe(struct device *dev, struct regmap *regmap);
int bmp085_remove(struct device *dev);
int bmp085_detect(struct device *dev);

#endif