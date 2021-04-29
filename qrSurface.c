#include "qrSurface.h"

void qrCodePrintPNG(char * str, char * fileName) {
	
	strcat(fileName,".png");
    SDL_Surface * drawingSheet;
    int size = 60;
    int ** array = build2dArray(size);
	Uint32 * pixels;
    array = Array2dSetToZero(array,size);
	array = genMapIntegerArray(str); 
	printf("ligne 17 de qrsurface: fonction  genMap good\n");
	//
	drawingSheet = SDL_CreateRGBSurfaceWithFormat(0, 600, 600, 32, SDL_PIXELFORMAT_RGBA32); 
	printf("ligne 13 de qrsurface: SDL CREATE RGB\n");
	SDL_LockSurface(drawingSheet);
	printf("ligne 19 de qrsurface: locksurface\n");
	drawingSheet = paintToWhiteSurface(drawingSheet);
	drawingSheet = paintQrcodeToSurface(drawingSheet, array);
	IMG_SavePNG(drawingSheet,"qrCode.png");
	rename("qrCode.png", fileName);
	SDL_UnlockSurface(drawingSheet);
	SDL_FreeSurface(drawingSheet);
	free(array);
}

SDL_Surface * paintToWhiteSurface(SDL_Surface * drawingSheet) {
	size_t i, j;
	for(i = 0; i < 600; i++) {								// all the surface is in 
        for(j = 0; j < 600; j++) {							//white
            setPixel(drawingSheet, 0xFF, 0xFF, 0xFF,0xFF, i, j);
		}
    }
	return drawingSheet;
}

SDL_Surface * paintQrcodeToSurface(SDL_Surface * drawingSheet, int ** array) {
	int m;
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