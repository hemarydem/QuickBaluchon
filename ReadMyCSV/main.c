#include <mysql/mysql.h>
#include "bddFun.h"
#include "folderFun.h"
#include "erro.h"
//#define LEN(arr) ((int) (sizeof (arr) / sizeof (arr)[0]))
//gcc main.c -l mysqlclient
//gcc ReadMyCSV/*.c -o exec.app -l mysqlclient
int main(int argc, char ** argv) {
    MYSQL * con;
    if (mysql_library_init(argc, argv, NULL)) {
        fprintf(stderr, "could not initialize MySQL client library\n");
        exit(1);
    }
    con = mysql_init(con);
    mysql_options(con,MYSQL_READ_DEFAULT_GROUP,"option");
    int returnValue = ConnexionToBDD(con);
    char **myCsvArray = getCSV();
    readCSV(myCsvArray,returnValue,con);
    mysql_close(con);
    return 0;
}