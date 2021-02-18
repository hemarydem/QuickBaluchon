//
// Created by hamed on 17/02/2021.
//

#include "signInF.h"

int signIn() {
    char * letter = NULL;
    long int serverAnswer;
    FILE * f = fopen("./connect.txt", "r+");
    fscanf(f,"%s", letter);
    serverAnswer = atoi(letter);
    printf("%d", serverAnswer);
    fclose(f);
    remove ("./connect.txt");
    if(serverAnswer) return 1;
    return 0;
}