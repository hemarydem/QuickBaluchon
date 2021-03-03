#include "qrcodeprocess.h"

int qrcodeFunction() {
    SDL_Surface *drawingSheet;
    Uint32 * pixels;
    size_t i, j;
    int array[60][60] = {{0}};
    int h = 0;
    int w = 0;
    int m;
    int n;
    int count = 0;

    int border = 4; // qrcode value



    size_t xIndixePixel = 0;
    size_t yIndixePixel = 0;
    drawingSheet = SDL_CreateRGBSurfaceWithFormat(0, 600, 600, 32, SDL_PIXELFORMAT_RGBA8888);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////            INIT LIBRARIES       /////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    SDL_Init(SDL_INIT_VIDEO); // TO DO error function




//////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////     GENERATE QRCODE        //////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

    uint8_t qrcode[qrcodegen_BUFFER_LEN_MAX];
    uint8_t tempBuffer[qrcodegen_BUFFER_LEN_MAX];
    bool ok = qrcodegen_encodeText(
            "https://www.google.com/", // here string to convert in qrcode
            tempBuffer,
            qrcode,
            qrcodegen_Ecc_MEDIUM,
            qrcodegen_VERSION_MIN,
            qrcodegen_VERSION_MAX,
            qrcodegen_Mask_AUTO,
            true
    );
    if (ok) {
        int size = qrcodegen_getSize(qrcode);
        for (int y = -border; y < size + border; y++) {
            for (int x = -border; x < size + border; x++) {
                if (qrcodegen_getModule(qrcode, x, y)) {
                    printf("##");
                    array[h][w] = 1;
                    w++;
                    array[h][w] = 1;
                    w++;
                } else {
                    printf("  ");
                    array[h][w] = 0;
                    w++;
                    array[h][w] = 0;
                    w++;
                }
            }
            printf("\n");
            h++;
            w = 0;
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

    SDL_LockSurface(drawingSheet);
    pixels = drawingSheet->pixels;
    for (i = 0; i < 600; i++) {                              // all the surface is in
        for (j = 0; j < 600; j++) {                          //white
            setPixel(drawingSheet, 0xFF, 0xFF, 0xFF, 0xFF, i, j);
        }
    }
    for (m = 0; m < 60; m++) {
        for (n = 0; n < 60; n++) {
            if (array[m][n]) {
                for (size_t q = yIndixePixel; q < 10 + yIndixePixel; q++) {
                    for (size_t k = xIndixePixel; k < 10 + xIndixePixel; k++) {
                        setPixel(drawingSheet, 0x0, 0x0, 0x0, 0xFF, k, q);
                    }
                }
                xIndixePixel += 10;
                count++;
            } else {
                xIndixePixel += 10;
                count++;
            }
            if (count == 60) {
                yIndixePixel += 10;
                count = 0;
            }
        }
        xIndixePixel = 0;
    }
    IMG_SavePNG(drawingSheet, "bob.png");
    SDL_UnlockSurface(drawingSheet);
    SDL_FreeSurface(drawingSheet);
    SDL_Quit();


    return EXIT_SUCCESS;
}