#include "qrInt.h"
int ** genMapIntegerArray(char * str) {  // return the matrice 
    size_t i, j;                         // its an array of 0 and 1
    int size = 60;                       // the programme will use this array to draw th qrcode
    int ** array = build2dArray(size);
    array = Array2dSetToZero(array,size);
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
                    array[h][w] = 1;
                    w++;
                    array[h][w] = 1;
                    w++;
                } else {
                    array[h][w] = 0;
                    w++;
                    array[h][w] = 0;
                    w++;
                }
            }
            h++;
            w = 0;
        }
    }
    return array;
}

int ** build2dArray(int numOfLine) { //return a 2 dimenssion arraymenssion array
  int ** array = NULL;
  int i;
  array = malloc(sizeof(int*) * numOfLine);
  if(array != NULL) {
    for (i = 0; i < numOfLine; i++) {
      array[i] = malloc(sizeof(int) * numOfLine);
      //printf("\ni = %d\n", i);
    if(array[i] == NULL) {
        int j = 0;
        while (j < i) {
          free(array[i]);
          j++;
        }
        free(array);
        printf("error malloc\n buildArrayMaplist\n");
        return array= NULL;
      }
    }
    //printf("\nbuildCharArray ok\n");
    if(array == NULL)printf("array is NULL");
    return array;
  }
  printf("\n error \n  buildArrayMaplist \n");
  return array = NULL;
}

int ** Array2dSetToZero(int ** array, int size) { // init all array's elements to zero // init all array's elements to zero
  for (int i = 0; i < size; i++) 
      for (int j = 0; j < size; j++)
          array[i][j] = 0;
  return array;
}