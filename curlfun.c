//
// Created by Harpi on 18/02/2021.
//

#include "curlfun.h"

/*size_t got_data(char * buffer, size_t itemsize, size_t nitems, void * ignorthis) {
    size_t bytes =  itemsize * nitems;
    int linenumber = 1;
    FILE * f = fopen("connect.txt", "wb");
    printf("new chunk (%zu bytes)\n", bytes);
    printf("%d:\t", linenumber);
    for (int i = 0; i < bytes; i++) {
        printf("%c", buffer[i]);
        fprintf(f,"%c",buffer[i]);
        if (buffer[i] == '\n') {
            linenumber++;
            printf("%d:\t", linenumber);
        }
    }
    printf("\n\n");
    fclose(f);
    return bytes;
}

/*size_t getKey(char * buffer, size_t itemsize, size_t nitems, void * ignorthis) {
    size_t bytes =  itemsize * nitems;
    int linenumber = 1;
    FILE * f = fopen("key.txt", "wb");
    printf("new chunk (%zu bytes)\n", bytes);
    printf("%d:\t", linenumber);
    for (int i = 0; i < bytes; i++) {
        printf("%c", buffer[i]);
        fprintf(f,"%c",buffer[i]);
        if (buffer[i] == '\n') {
            linenumber++;
            printf("%d:\t", linenumber);
        }
    }
    printf("\n\n");
    fclose(f);
    return bytes;
}
 */