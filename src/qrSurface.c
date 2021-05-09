#include "qrSurface.h"

void qrCodePrintPNG(char * str, char * fileName) {
	strcat(fileName,".png");
	printf("%s", fileName);
    SDL_Surface * drawingSheet;
    //int size = 60;
    int array[60][60] = {0};
	int (*ptr)[60] = array;
	Uint32 * pixels;
	genMapIntegerArray(str,ptr);
	SDL_Init(SDL_INIT_VIDEO|SDL_INIT_TIMER);
	drawingSheet = SDL_CreateRGBSurfaceWithFormat(0, 600, 600, 32, SDL_PIXELFORMAT_RGBA32); 
	SDL_LockSurface(drawingSheet);
	drawingSheet = paintToWhiteSurface(drawingSheet);
	drawingSheet = paintQrcodeToSurface(drawingSheet, ptr);
	IMG_SavePNG(drawingSheet,"qrCode.png");
	rename("qrCode.png", fileName);
	SDL_UnlockSurface(drawingSheet);
	SDL_FreeSurface(drawingSheet);
	//free(array);
	SDL_Quit();
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

SDL_Surface * paintQrcodeToSurface(SDL_Surface * drawingSheet, int (*ptr)[60]) {
	int m;
	int n;
	size_t xIndixePixel = 0;
	size_t yIndixePixel = 0;
	int count = 0;
	for (m = 0; m < 60; m++) {
		for(n = 0; n < 60; n++) {
			if(ptr[m][n]) {
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
