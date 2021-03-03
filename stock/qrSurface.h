#ifndef qrSurface_h
#define qrSurface_h
#include "qrInt.h"
#include <SDL.h>
#include <SDL_image.h>
#include <stdint.h>
#include "pixel.h"
#include "string.h"
#include <stdio.h>
void qrCodePrintPNG(char * str, char * fileName);
SDL_Surface * paintToWhiteSurface(SDL_Surface * drawingSheet);
SDL_Surface * paintQrcodeToSurface(SDL_Surface * drawingSheet, int ** array);
#endif