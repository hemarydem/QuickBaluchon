#include <mysql/mysql.h>
#include <string.h>
#include "bddFun.h"
#include "folderFun.h"
#include "erro.h"
#define LEN(arr) ((int) (sizeof (arr) / sizeof (arr)[0][0]))
//gcc main.c -l mysqlclient
//gcc ReadMyCSV/*.c -o exec.app -l mysqlclient

int main(int argc, char ** argv) {
    MYSQL * con;
    int i = 0;
    if (mysql_library_init(argc, argv, NULL)) {
        fprintf(stderr, "could not initialize MySQL client library\n");
        exit(1);
    }
    SDL_Init(SDL_INIT_VIDEO);
    con = mysql_init(con);
    mysql_options(con,MYSQL_READ_DEFAULT_GROUP,"option");
    int returnValue = ConnexionToBDD(con);
    char **myCsvArray = getCSV();
    while(strcmp(myCsvArray[i],"FIN") != 0){
        i++;
    }
    free(myCsvArray[i]);
    i--;
    readCSV(myCsvArray,returnValue,con);
    flagWaring(19,"ligne");
    for (int m = 0; m <  i; m++) {
        free(myCsvArray[m]);
    }
    SDL_Quit();
    mysql_close(con);
    free(myCsvArray);
    return 0;
}