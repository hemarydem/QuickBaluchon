#include "qrInt.h"
void genMapIntegerArray(char * str, int (*ptr)[60]) {
    size_t i, j;
    int size = 60;
    int h = 0;
    int w = 0;
    int border = 4;
    uint8_t qrcode[qrcodegen_BUFFER_LEN_MAX];
    uint8_t tempBuffer[qrcodegen_BUFFER_LEN_MAX];
    bool ok = qrcodegen_encodeText(str, tempBuffer, qrcode, qrcodegen_Ecc_MEDIUM, qrcodegen_VERSION_MIN, qrcodegen_VERSION_MAX, qrcodegen_Mask_AUTO, true);
    if(ok) {
        int size = qrcodegen_getSize(qrcode);
        for (int y = -border; y < size + border; y++) {
            for (int x = -border; x < size + border; x++) {
                if(qrcodegen_getModule(qrcode, x, y)) {
                    *(*( ptr + h) + w )= 1;
                    w++;
                    *(*( ptr + h) + w )= 1;
                    w++;
                } else {
                    *(*( ptr + h) + w );
                    w++;
                    *(*( ptr + h) + w );
                    w++;
                }
            }
            h++;
            w = 0;
        }
    }
}
