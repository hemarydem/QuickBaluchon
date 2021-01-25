#ifndef myQrCodeFunction_h
#define myQrCodeFunction_h
#include <stdbool.h>
#include <stddef.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "qrcodegen.h"
#include <SDL.h>
void doVarietyDemo(void);
static void printQr(const uint8_t qrcode[]);
void printRect(SDL_Rect * renctangle, int r, int g, int b, int * xCoordo, int * yCoordo, SDL_Renderer * renderer);
void printQrSDL(const uint8_t qrcode[],SDL_Rect * renctangle, SDL_Renderer * renderer);
// The main application program.
#endif