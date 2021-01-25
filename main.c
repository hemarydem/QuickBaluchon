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
#include <SDL.h>
#include "myQrCodeFunction.h"
#define WINDOW_WIDTH (600)
#define WINDOW_HEIGHT (600)
int main(int argc, char  ** argv) {
	//////////////////////////////
	//			SDL_Variable	//
	//////////////////////////////
	SDL_Window * win = NULL;
    SDL_Renderer * renderer = NULL;
	SDL_Texture * texture = NULL;
	int array [60][60]= {{0}};
	int h = 0;
	int w = 0;
	SDL_Rect rect[60][60];

	for(int i = 0; i < 60; i ++) {
		for(int j = 0; j < 60; j ++) {
			rect[i][j].h  = 10;
			rect[i][j].w  = 10;
			rect[i][j].x  = 0;
			rect[i][j].y  = 0;
		}
    }
	SDL_Rect dst = {0, 0, 0, 0};
	SDL_Color blanc = {255, 255, 255, 255};
    SDL_Color noir = {0, 0, 0, 0};
	int count = 0;
	int finish  = 0;
	int border = 4;
	int xPosition = 0;
	int yPosition = 0;
	int calcu = 1;
	//////////////////////////////
	//			init SDL		//
	//////////////////////////////
	SDL_Init(SDL_INIT_VIDEO); // TODO error function
	win  = SDL_CreateWindow("QRcode generator",SDL_WINDOWPOS_CENTERED,SDL_WINDOWPOS_CENTERED,WINDOW_WIDTH, WINDOW_HEIGHT,0);//TODO error function
	renderer = SDL_CreateRenderer(win, -1,SDL_RENDERER_ACCELERATED);
	texture = SDL_CreateTexture(renderer, SDL_PIXELFORMAT_RGBA8888,SDL_TEXTUREACCESS_TARGET, 500, 500);
	//////////////////////////////
	//	generate qr code		//
	//////////////////////////////
	uint8_t qrcode[qrcodegen_BUFFER_LEN_MAX];
	uint8_t tempBuffer[qrcodegen_BUFFER_LEN_MAX];
	bool ok = qrcodegen_encodeText(
		"314159265358979323846264338327950288419716939937510", 
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
						calcu++;
						array[h][w] = 1;
						w++;
						array[h][w] = 1;
						w++;
						/*for(int i = 0; i < 2; i++) {
							rect[count].x = xPosition;
							rect[count].y = yPosition;
							SDL_SetRenderDrawColor(renderer, noir.r, noir.g, noir.b, SDL_ALPHA_OPAQUE);
							SDL_RenderFillRect(renderer,&rect[count]);
							count ++;
							xPosition += 20;
							printf("%d\n", xPosition);
							printf("#");
						}*/
					} else {
						printf("  ");
						calcu++;
						array[h][w] = 0;
						w++;
						array[h][w] = 0;
						w++;
						//xPosition += 40;
					}
				}
				printf("\n");
				h++;
				w = 0;
				//yPosition += 20;
				//xPosition = 0;
			}
			printf("ok");
		}
		printf("ok");

		SDL_RenderClear(renderer);						// NOTE ne faite pas attention
        SDL_Event event;								// au switch et a la boucle elle
        while (SDL_PollEvent(&event)) {					// est là car je suis obligé de l'integrer
            if(event.type == SDL_QUIT) {				// dans mon code sur mac
                finish = 1;								// sinon la fenêtre ne souvre pas
            }											// un pb exclusif a mac
            switch (event.type) {						// a terme ce bout de code sera retirer
                case SDL_KEYDOWN:
                    switch (event.key.keysym.sym) {
                    }
                break;
            }
		}
		SDL_SetRenderTarget(renderer, texture);
		SDL_RenderClear(renderer);
		for(int i = 0; i < 57; i ++) {
			for(int j = 0; j < 57; j ++) {
				if(array[i][j]) {
					rect[i][j].x = xPosition;
					rect[i][j].y = yPosition;
					SDL_SetRenderDrawColor(renderer, 0, 0, 0, SDL_ALPHA_OPAQUE);//noir
    				SDL_RenderFillRect(renderer, &rect[i][j]);
					xPosition += 10;
				} else {
					rect[i][j].x = xPosition;
					rect[i][j].y = yPosition;
					SDL_SetRenderDrawColor(renderer, 255, 255, 255, SDL_ALPHA_OPAQUE);//noir
    				SDL_RenderFillRect(renderer, &rect[i][j]);
					xPosition += 10;
				}
			}
			xPosition = 0;
			yPosition +=10 ;
			printf("\n");
		}
		SDL_SetRenderDrawColor(renderer, blanc.r, blanc.g, blanc.b, blanc.a);
		SDL_SetRenderTarget(renderer, NULL);
    	SDL_QueryTexture(texture, NULL, NULL, &dst.w, &dst.h);
    	SDL_RenderCopy(renderer, texture, NULL, &dst);
        SDL_RenderPresent(renderer);
	
	printf("\n");
	for(int i = 0; i < 60; i ++) {
		for(int j = 0; j < 60; j ++) {
			printf("%d ", array[i][j]);
		}
		printf("\n");
    }
	//doVarietyDemo();
	SDL_DestroyRenderer(renderer);
    SDL_DestroyWindow(win);
	SDL_Quit();
	return EXIT_SUCCESS;
}
