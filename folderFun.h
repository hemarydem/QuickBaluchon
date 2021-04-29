#ifndef folderFun_h
#define folderFun_h
#include <stdio.h>
#include <stdlib.h>
#include <dirent.h>
#include <string.h>
#include <mysql/mysql.h>
#include "bddFun.h"
#include "erro.h"
char ** buildCharArray(int numOfLine);
int number_size();
char **getCSV();
FILE *deleteLine(FILE *content,FILE *newFile);
int readCSV(char **array, int bdd,MYSQL * con);
#endif