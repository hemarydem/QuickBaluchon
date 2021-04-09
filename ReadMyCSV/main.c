#include <mysql/mysql.h>
#include "bddFun.h"
#include "folderFun.h"
#include "erro.h"
//#define LEN(arr) ((int) (sizeof (arr) / sizeof (arr)[0]))
//gcc main.c -l mysqlclient
int main(int argc, char ** argv) {
    MYSQL * con;
    flagWaring(9, "main");//TODO DELETE
    if (mysql_library_init(argc, argv, NULL)) {
        fprintf(stderr, "could not initialize MySQL client library\n");
        exit(1);
    }
    con = mysql_init(con);
    flagWaring(11, "con = mysql_init(con) \n main");//TODO DELETE
    mysql_options(con,MYSQL_READ_DEFAULT_GROUP,"option");
    flagWaring(13, "mysql_options(con,MYSQL_READ_DEFAULT_GROUP,\"option\")\nmain");//TODO DELETE
    int returnValue = ConnexionToBDD(con);
    char **myCsvArray = getCSV();
    flagWaring(15, "char **myCsvArray = getCSV();\nmain");//TODO DELETE
    readCSV(myCsvArray,returnValue,con);
    flagWaring(17, "main");//TODO DELETE
    mysql_close(con);
    flagWaring(19, "main");//TODO DELETE
    return 0;
}