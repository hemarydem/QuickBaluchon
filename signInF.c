//
// Created by hamed on 17/02/2021.
//

#include "signInF.h"

int signIn() {
    char * letter = malloc(sizeof(char) * 1);
    long int serverAnswer;
    FILE * f = fopen("connect.txt", "r+");
    fread(letter,sizeof(char) * 1,1,f);
    serverAnswer = atoi(letter);
    //printf("%s", letter);
    //printf("%d", serverAnswer);
    fclose(f);
    remove ("connect.txt");
    if(serverAnswer) return 1;
    return 0;
}