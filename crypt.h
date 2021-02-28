#ifndef crypt_h
#include <stdio.h>
#include <stdlib.h>
#include <math.h>
char * encryptage(char * str, int key);
char * decryptage(char * str, int key);
int decryptKey(int key);
#endif
