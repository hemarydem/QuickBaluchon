//gcc src/main.c -o bin/uPikachu.exe -I include -L lib -lmingw32 -lSDL2main -lSDL2
/* 
* QR Code generator demo (C)
* 
* Run this command-line program with no arguments. The program
* computes a demonstration QR Codes and print it to the console.
* 
* Copyright (c) Project Nayuki. (MIT License)
* https://www.nayuki.io/page/qr-code-generator-library
* 
* Permission is hereby granted, free of charge, to any person obtaining a copy of
* this software and associated documentation files (the "Software"), to deal in
* the Software without restriction, including without limitation the rights to
* use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
* the Software, and to permit persons to whom the Software is furnished to do so,
* subject to the following conditions:
* - The above copyright notice and this permission notice shall be included in
*   all copies or substantial portions of the Software.
* - The Software is provided "as is", without warranty of any kind, express or
*   implied, including but not limited to the warranties of merchantability,
*   fitness for a particular purpose and noninfringement. In no event shall the
*   authors or copyright holders be liable for any claim, damages or other
*   liability, whether in an action of contract, tort or otherwise, arising from,
*   out of or in connection with the Software or the use or other dealings in the
*   Software.
*/
#include <stdbool.h>
#include <stddef.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "qrcodegen.h"
//#include "SDL.h"
#include <SDL.h>
#include "myQrCodeFunction.h"
#include <SDL_image.h>
#include <string.h>
#include <stdint.h>
//#include "pngfuncs.h"
#include "pixel.h"
#define WINDOW_WIDTH (600)
#define WINDOW_HEIGHT (600)

int main(int argc, char  ** argv) {
//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////			SDL_Variable	//////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
	SDL_Window * win = NULL;
	SDL_Renderer * renderer = NULL;
	SDL_Surface * drawingSheet;
	Uint32 *pixels;
	size_t i, j;
	int array [60][60]= {{0}};
	int h = 0;
	int w = 0;
	int m;
	int n;
	int count = 0;
	int gotoline = 0;
	size_t xIndixePixel = 0;
	size_t yIndixePixel = 0;
	drawingSheet = SDL_CreateRGBSurfaceWithFormat(0, 600, 600, 32, SDL_PIXELFORMAT_RGBA8888); 
	int border = 4;
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	/////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////			init SDL		//////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	SDL_Init(SDL_INIT_VIDEO); // TODO error function
	win  = SDL_CreateWindow("QRcode generator",SDL_WINDOWPOS_CENTERED,SDL_WINDOWPOS_CENTERED,WINDOW_WIDTH, WINDOW_HEIGHT,0);//TODO error function
	renderer = SDL_CreateRenderer(win, -1,SDL_RENDERER_ACCELERATED);
	
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	
	//////////////////////////////////////////////////////////////////////////////////////////
	////////////////////////////////	generate qr code		//////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	uint8_t qrcode[qrcodegen_BUFFER_LEN_MAX];
	uint8_t tempBuffer[qrcodegen_BUFFER_LEN_MAX];
	bool ok = qrcodegen_encodeText(
	"https://www.google.com/", 
	tempBuffer, 
	qrcode,
	qrcodegen_Ecc_MEDIUM, 
	qrcodegen_VERSION_MIN, 
	qrcodegen_VERSION_MAX, 
	qrcodegen_Mask_AUTO,
	true
	);
	if(ok) {
		int size = qrcodegen_getSize(qrcode);
		for (int y = -border; y < size + border; y++) {
			for (int x = -border; x < size + border; x++) {
				if(qrcodegen_getModule(qrcode, x, y)) {
					printf("##");
					array[h][w] = 1;
					w++;
					array[h][w] = 1;
					w++;
					gotoline++;
				} else {
					printf("  ");
					array[h][w] = 0;
					w++;
					array[h][w] = 0;
					w++;
					gotoline++;
				}
			}
			//printf("gotoline = %d\n", gotoline);
			printf("\n");
			h++;
			w = 0;
		}
	}
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////	
	
	SDL_LockSurface(drawingSheet);
	pixels = drawingSheet->pixels;
	for(i = 0; i < 600; i++) {								// all the surface is in 
        for(j = 0; j < 600; j++) {							//white
            setPixel(drawingSheet, 0xFF, 0xFF, 0xFF,0xFF, i, j);
		}
    }
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
	
	//png_save_surface("testimage.png", sreenShot);
	//SDL_SaveBMP(sreenShot,"BBB.bmp");
	IMG_SavePNG(drawingSheet, "tr.png");
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////	check array		//////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
	for(i = 0; i < 60; i ++) {
		for(j = 0; j < 60; j ++) {
			printf("%d ", array[i][j]);
		}
		printf("\n");
	}
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
	SDL_UnlockSurface(drawingSheet);
	SDL_FreeSurface(drawingSheet);
	SDL_DestroyRenderer(renderer);
	SDL_DestroyWindow(win);
	SDL_Quit();
	return EXIT_SUCCESS;
}
