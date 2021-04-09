#include "pixel.h"

void setPixel(SDL_Surface *surface, Uint8 r, Uint8 g, Uint8 b, Uint8 a, size_t x, size_t y) {
    Uint32 *pixels = surface->pixels; /* Nos pixels sont sur 32 bits */
    Uint32 couleur = SDL_MapRGBA(surface->format, r, g, b, a);
    pixels[y * surface->w + x] = couleur;
}
