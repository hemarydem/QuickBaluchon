#include "myQrCodeFunction.h"
/*---- Demo suite ----*/
// Creates a variety of QR Codes that exercise different features of the library, and prints each one to the console.
 void doVarietyDemo(void) {
	 // Numeric mode encoding (3.33 bits per digit)
		uint8_t qrcode[qrcodegen_BUFFER_LEN_MAX];
		uint8_t tempBuffer[qrcodegen_BUFFER_LEN_MAX];
		bool ok = qrcodegen_encodeText("314159265358979323846264338327950288419716939937510", tempBuffer, qrcode,
			qrcodegen_Ecc_MEDIUM, qrcodegen_VERSION_MIN, qrcodegen_VERSION_MAX, qrcodegen_Mask_AUTO, true);
		if (ok)
			printQr(qrcode);
}
/*---- Utilities ----*/
// Prints the given QR Code to the console.
static void printQr(const uint8_t qrcode[]) {
	int size = qrcodegen_getSize(qrcode);
	int border = 4;
	for (int y = -border; y < size + border; y++) {
		for (int x = -border; x < size + border; x++) {
			fputs((qrcodegen_getModule(qrcode, x, y) ? "##" : "  "), stdout);
		}
		fputs("\n", stdout);
	}
	fputs("\n", stdout);
}

void printQrSDL(const uint8_t qrcode[], SDL_Rect * renctangle, SDL_Renderer * renderer) {
	int size = qrcodegen_getSize(qrcode);
	int border = 4;
	int xPosition = 0;
	int yPosition = 0;
	printf("\nNello\n");
	for (int y = -border; y < size + border; y++) {
		for (int x = -border; x < size + border; x++) {
			if(qrcodegen_getModule(qrcode, x, y)) {
				printf("##");
				
				printRect(renctangle, 0, 0, 0,&xPosition,&yPosition, renderer);
			} else {
				printf("  ");
				printRect(renctangle, 255, 255, 255,&xPosition,&yPosition, renderer);
				
			}
			/*if(qrcodegen_getModule(qrcode, x, y)) {
				printRect(renctangle, 255, 255, 255,&xPosition,&yPosition, renderer);
			} else {
				printRect(renctangle, 0, 0, 0,&xPosition,&yPosition, renderer);
			}*/
		}
		printf("\n");
		yPosition += 10;
		xPosition = 0;
	}
	yPosition += 10;
}

void printRect(SDL_Rect * renctangle, int r, int g, int b, int * xCoordo, int * yCoordo,  SDL_Renderer * renderer) {
	renctangle->x = *xCoordo;
	renctangle->y = *yCoordo;
	for(int i = 0; i < 2; i++) {
		SDL_SetRenderDrawColor(renderer, r, g, b, SDL_ALPHA_OPAQUE);
		SDL_RenderFillRect(renderer,renctangle);
		renctangle->x += 10;
	}
}