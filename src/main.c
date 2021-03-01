/*
AUTHORS:
	-Yanis Tagri
	-Leo Perochon
	-Remy Hamed

PURPOSE : generate a QRCODE from a char *

DATE: 28/02/2021

*/
#include <stdio.h>
#include <stdlib.h>
#include "qrSurface.h"
#include "string.h"
int main(int argc, char  ** argv) {
    char * str;
    char * title;
    str = malloc (sizeof(char) * 50);
    title = malloc (sizeof(char) * 50);
    strcpy(str, "https://www.google.com/");
    strcpy(title, "linkGoogle");

    qrCodePrintPNG(str, title);
    
	free(str);
    free(title);
	return 0;
}