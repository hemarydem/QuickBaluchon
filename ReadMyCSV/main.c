#include <mysql/mysql.h>
#include "bddFun.h"
#include "folderFun.h"
#include "erro.h"
//#define LEN(arr) ((int) (sizeof (arr) / sizeof (arr)[0]))
//gcc main.c -l mysqlclient
//gcc ReadMyCSV/*.c -o exec.app -l mysqlclient
int main(int argc, char ** argv) {
    MYSQL * con;
    flagWaring(9, "main");//TODO DELETE
    if (mysql_library_init(argc, argv, NULL)) {
        fprintf(stderr, "could not initialize MySQL client library\n");
        exit(1);
    }
    con = mysql_init(con);
    flagWaring(16, "con = mysql_init(con) \n main");//TODO DELETE
    mysql_options(con,MYSQL_READ_DEFAULT_GROUP,"option");
    flagWaring(18, "mysql_options(con,MYSQL_READ_DEFAULT_GROUP,\"option\")\nmain");//TODO DELETE
    int returnValue = ConnexionToBDD(con);
    char **myCsvArray = getCSV();
    flagWaring(21, "char **myCsvArray = getCSV();\nmain");//TODO DELETE
    readCSV(myCsvArray,returnValue,con);
    flagWaring(23, "main");//TODO DELETE
    mysql_close(con);
    flagWaring(25, "main");//TODO DELETE
    return 0;
}