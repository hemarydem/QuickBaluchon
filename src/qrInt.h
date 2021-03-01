#ifndef qrInt_h
#define qrInt_h
#include <stdbool.h>
#include <stdio.h>
#include <stdlib.h>
#include <stdint.h>
#include "qrcodegen.h"
int ** genMapIntegerArray(char * str);
int ** build2dArray(int numOfLine);
int ** Array2dSetToZero(int ** array, int size);
#endif