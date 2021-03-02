#include "qrSurface.h"

void qrCodePrintPNG(char * str, char * fileName) { // the main function 
	strcat(fileName,".png"); 
    SDL_Surface * drawingSheet;
    int size = 60;
    int ** array = build2dArray(size);
    array = Array2dSetToZero(array,size);
	array = genMapIntegerArray(str); 
	drawingSheet = SDL_CreateRGBSurfaceWithFormat(0, 600, 600, 32, SDL_PIXELFORMAT_RGBA8888); 
	SDL_Init(SDL_INIT_VIDEO);
	SDL_LockSurface(drawingSheet);
	drawingSheet = paintToWhiteSurface(drawingSheet);
	drawingSheet = paintQrcodeToSurface(drawingSheet, array);
	IMG_SavePNG(drawingSheet,"qrCode.png");
	rename("qrCode.png", fileName);
	SDL_UnlockSurface(drawingSheet);
	SDL_FreeSurface(drawingSheet);
	free(array);
	SDL_Quit();
}

SDL_Surface * paintToWhiteSurface(SDL_Surface * drawingSheet) { // set all surface's pixel in white
	size_t i, j;
	for(i = 0; i < 600; i++) {				
        for(j = 0; j < 600; j++) {
            setPixel(drawingSheet, 0xFF, 0xFF, 0xFF,0xFF, i, j);
		}
    }
	return drawingSheet;
}

SDL_Surface * paintQrcodeToSurface(SDL_Surface * drawingSheet, int ** array) { // use the 2 dimenssion array [60][60]
	int m;                                                                     // it draw a black  square each time an array element is set to one
	int n;
	size_t xIndixePixel = 0;
	size_t yIndixePixel = 0;
	int count = 0;
	for (m = 0; m < 60; m++) {
		for(n = 0; n < 60; n++) {
			if(array[m][n]) {
				for(size_t q = yIndixePixel; q < 10 + yIndixePixel; q ++) {
					for(size_t k = xIndixePixel; k < 10 + xIndixePixel; k ++) {
						setPixel(drawingSheet, 0x0, 0x0, 0x0, 0xFF, k, q);
					}
				}
				xIndixePixel += 10;
				count++;
			} else {
				xIndixePixel += 10;
				count++;
			}
			if(count == 60) {
				yIndixePixel += 10;
				count  = 0;
			}
		}
		xIndixePixel = 0;
	}
	return drawingSheet;
} 