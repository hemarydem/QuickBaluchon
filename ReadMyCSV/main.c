#include <mysql/mysql.h>
#include "bddFun.h"
#include "folderFun.h"
#include "erro.h"
//#define LEN(arr) ((int) (sizeof (arr) / sizeof (arr)[0]))
//gcc main.c -l mysqlclient
int main(int argc, char ** argv) {
    MYSQL * con;
    flagWaring(9);//TODO DELETE
    con = mysql_init(con);
    flagWaring(11);//TODO DELETE
    mysql_options(con,MYSQL_READ_DEFAULT_GROUP,"option");
    flagWaring(13);//TODO DELETE
    int returnValue = ConnexionToBDD(con);
    char **myCsvArray = getCSV();
    flagWaring(15);//TODO DELETE
    readCSV(myCsvArray,returnValue,con);
    flagWaring(17);//TODO DELETE
    mysql_close(con);
    flagWaring(19);//TODO DELETE
    return 0;
}