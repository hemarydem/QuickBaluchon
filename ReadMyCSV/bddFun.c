#include "bddFun.h"

int ConnexionToBDD(MYSQL * con) {
    flagWaring(74);//TODO DELETE
    if(mysql_real_connect(con,"localhost","root","root","qb",0,NULL,0)){
        printf("You are connected\n");
        return 0;
    } else {
        printf("Error: verify your connection data\n");
        return 1;
    }
}

void insertBDD(FILE *myfilebro, MYSQL * con) {
    flagWaring(112);//TODO DELETE
    char nf,nr;
    char *id = malloc(sizeof(char)*100);
    int i = 0;
    int j = 0;
    int count = 0;
    int numberC = 0;

    while((nf=fgetc(myfilebro)) != EOF) {
        if(nf != '\n' && count == 0) {
            id[i] = nf;
            count++;
            i++;
        }
        numberC++;
    }
    id[i] = '\0';
    i = 0;
    char **tabValue = buildCharArray(numberC);
    int posCursor = strlen(id)+1;
    /////////////////////////////////
    fseek(myfilebro, posCursor, SEEK_SET );
    while((nr=fgetc(myfilebro)) != EOF) {
        if(nr != ',') {
            tabValue[i][j] = nr;
            j++;
        } else {
            i++;
            j = 0;
        }
    }
}