#ifndef bddFun_h
#define bddFun_h
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <mysql/mysql.h>
#include "erro.h"
#include "folderFun.h"
int ConnexionToBDD(MYSQL * con);
void insertBDD(FILE *myfilebro, MYSQL * con);
#endif