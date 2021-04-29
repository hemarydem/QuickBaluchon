#include "bddFun.h"
#define LEN(arr) ((int) (sizeof (arr) / sizeof (arr)[0]))

int ConnexionToBDD(MYSQL * con) {
    if(mysql_real_connect(con,"127.0.01","root","root","qb",8889,NULL,0)){
        return 0;
    } else {
        finish_with_error(con);
        return 1;
    }
}

void finish_with_error(MYSQL *con) {
  fprintf(stderr, "%s\n", mysql_error(con));
  //mysql_close(con);
  ///exit(1);
}

char *getID(FILE *myfile){
    char * line = NULL;
    size_t len = 0;
    ssize_t size = getline(&line, &len, myfile);
    char *id = malloc(sizeof(char)*(size+1));
    int i = 0;
    char nf;
    line[size+1] = '\0';
    strcpy(id,line);
    return id;
}

int getIdRecipient(MYSQL * con, char *str){
    MYSQL_RES *result = NULL;
    MYSQL_ROW row;
    int i = 0;
    int idmail = 0;
    char * requete = malloc(sizeof(char) * strlen(str) + 1);
    flagWaring(00000,"XXXXXXXtestXXXXXX");
    sprintf(requete, "SELECT id FROM RECIPIENT WHERE mail='%s'",str);
    printf("requete = %s\n", requete);
     flagWaring(00000,"XXXXXXXtestXXXXXX");
    mysql_query(con, requete);
    result = mysql_use_result(con);
    
    if(result != NULL) {
        printf("erro -> fail to find data\n");
    } else {
        row = mysql_fetch_row(result);
        idmail = atoi(row[i]);
        //mysql_free_result(result);
    }
    //free(requete);
    return idmail;
}

char * suppChar(char * str, char charMustBeSupp) {
    int indexLetter;
    int strLenght = strlen(str) + 1;
    char * sentencefirstPart = NULL;
    char * sentenceSecondPart = NULL;
    char * ptr1stPart = str;
    char * ptr2ndPart = NULL;
    if(str == NULL || strLenght <= 0)
        return str;
    sentencefirstPart = malloc( sizeof(char) * strLenght);
    sentenceSecondPart = malloc( sizeof(char) * strLenght);         // exemple if we want delete 'e' char in  abcdef
    if( sentencefirstPart != NULL && sentenceSecondPart != NULL ) {
            for (indexLetter = 0; indexLetter < strLenght; indexLetter++) { // loop will stop on index of 'e' and substitue it  
            if(str[indexLetter] == charMustBeSupp) {                    // by an '\0'
                str[indexLetter] = '\0';
                strcpy(sentencefirstPart,ptr1stPart);                    //sentencefirstPart -> abcd
                ptr2ndPart = &str[indexLetter + 1];
                strcpy(sentenceSecondPart,ptr2ndPart);                   //sentenceSecondPart -> f
                strcpy(str,strcat(sentencefirstPart,sentenceSecondPart));//str -> sentencefirstPart + sentenceSecondPart 
                indexLetter --;                                          //         abcd                    f
            } 
        }
        free(sentencefirstPart);
        free(sentenceSecondPart);
        return str;
    }
    return str;
}

int getDepot(MYSQL * con, char *str){
    MYSQL_RES *resultDepot = NULL;
    MYSQL_ROW row;
    int i = 0;
    int iddepot = 0;
    char * requete = malloc(sizeof(char) * strlen(str) + 1);
    str = suppChar(str,'\n');
    sprintf(requete, "SELECT id FROM DEPOT WHERE name='%s'",str);
    mysql_query(con, requete);
    resultDepot = mysql_use_result(con);
    if(resultDepot!= NULL) {
        row = mysql_fetch_row(resultDepot);
        iddepot = atoi(row[i]);
        mysql_free_result(resultDepot);
    }
    printf("là");
    free(requete);
    return iddepot;
}

int getidcostExpress(MYSQL * con, char *str){
    MYSQL_RES *result = NULL;
    MYSQL_ROW row;
    int i = 0;
    int weight = 0;
    int id = 0;
    float weightArray[10] ={0.0, 0.6, 1.0, 2.0, 3.0, 5.0, 7.0, 10.0, 15.0, 30.0};
    char * requete = malloc(sizeof(char) * strlen(str) + 1);
    str = suppChar(str,'\n');
    weight = atoi(str);
    for (int indexWeightArray = 0; indexWeightArray < 8; indexWeightArray++) {
        if(weight > weightArray[indexWeightArray] && weight <=  weightArray[indexWeightArray + 1]){
            sprintf(requete,  "SELECT expressCost FROM CUSTOMERRATE WHERE wheight=%d",weight);
            mysql_query(con, requete);
            result = mysql_use_result(con);
            if(result != NULL){
                row = mysql_fetch_row(result);
                id = atoi(row[i]);
                mysql_free_result(result);
            }
            free(requete);
            break;
        }
    }
    return id;   
}

int getidcost(MYSQL * con, char *str){
    MYSQL_RES *result = NULL;
    MYSQL_ROW row;
    int i = 0;
    int weight = 0;
    int id = 0;
    float weightArray[10] ={0.0, 0.6, 1.0, 2.0, 3.0, 5.0, 7.0, 10.0, 15.0, 30.0};
    char * requete = malloc(sizeof(char) * strlen(str) + 1);
    str = suppChar(str,'\n');
    weight = atoi(str);
    for (int indexWeightArray = 0; indexWeightArray < 8; indexWeightArray++) {
        if(weight > weightArray[indexWeightArray] && weight <=  weightArray[indexWeightArray + 1]){
            sprintf(requete, "SELECT cost FROM CUSTOMERRATE WHERE wheight=%d",weight);
            mysql_query(con, requete);
            result = mysql_use_result(con);
            if(result != NULL){
                row = mysql_fetch_row(result);
                id = atoi(row[i]);
                mysql_free_result(result);
            }
            free(requete);
            break;
        }
    }
    return id;    
}

char *translateDateFormat(char *str){
    char * day = NULL;
    char * month = NULL;
    char * year = NULL;
    char ** arrData = malloc(sizeof(char*) * 3);
    char * ptr = NULL;
    int indexArrData = 0;
    int i;
    day = malloc(sizeof(char) *3);
    month = malloc(sizeof(char) * 3);
    year = malloc(sizeof(char) * 3);
    arrData[0] = day;
    arrData[1] = month;
    arrData[2] = year;
    int size = strlen(str);
    ptr = str;
    for (i = 0; i < size; i++) {
        if(str[i] == '/') {
            str[i] = '\0';
            strcpy(arrData[indexArrData],ptr);
            ptr = ptr + 3;
            indexArrData++;
        }
    }
    strcpy(arrData[indexArrData],ptr);
    ptr = ptr + i + 1;
    indexArrData++;
    strcpy(str,strcat(strcat(arrData[2],"/"),strcat(strcat(arrData[1],"/"),arrData[0])));
    return str;
}

void insertBDD(FILE *myfilebro, MYSQL * con) {
    char * line = NULL;
    char * requete = NULL;
    size_t len = 0;
    ssize_t read;
    char * ptr;                          // pointer to move on the string
    char ** array = NULL;                // cahr array contains data to insert in db
    int i = 0; 
    int idmail = 0;
    int idDepot = 0;                         
    int lineNb = 0;                    // incre variable
    int mode;
    int idNormal;
    int idExpress;
    int sendingStatus = 0;
    int lenghtWord = 0;

    char * strqr;
    char * titleqr;

    flagWaring(321,"ligne");                 
    array = malloc(sizeof(char*) * 11);
    if(array != NULL){
        fseek(myfilebro,0,SEEK_SET);
        char *id = getID(myfilebro);
        array[lineNb] = malloc(sizeof(char) * (strlen(id)+1));
        strcpy(array[lineNb],id);
        lineNb++;
        while ((read = getline(&line, &len, myfilebro)) != -1) {
            ptr = line; 
            while (i < read) {            
                if (line[i] == ',') {
                    line[i] = '\0';
                    lenghtWord = strlen(ptr) + 1;                       // le +1 c'est pour compter le '\0'
                    array[lineNb] = malloc(sizeof(char) * lenghtWord);  // du coup on malloc juste ce qu'on a besoin ici
                    strcpy(array[lineNb],ptr);                          // on copie jusqu'à '\0'
                    ptr = ptr + lenghtWord;                             // on pass derrière le '\0'
                    lenghtWord = 0;
                    lineNb ++;                                          // on descend d'une ligne dans le tableau
                }
                i++;
            }
            flagWaring(322,"ligne");  
            lenghtWord = strlen(ptr) + 1;  
            flagWaring(323,"ligne");                           // pour la dernière parti de la ligne qui n'est
            array[lineNb] = malloc(sizeof(char) * lenghtWord);        // pas prise en compte parce qu'elle se fini par = \0
            strcpy(array[lineNb],ptr);
            flagWaring(348,"ligne");


            printf("array [lineNb] = %s\nlineNb = %d\n", array[lineNb], lineNb);
            printf("array [5] = %s", array[5]);


            idmail = getIdRecipient(con,array[5]);




            flagWaring(350,"ligne");
            idDepot = getDepot(con,array[10]);
            int idDelivery = 0;
            flagWaring(353,"ligne");  
            if(array[8][0] == 'E'){
                mode = 1;
                idNormal = 0;
                idExpress = getidcostExpress(con,array[6]);
            }else{
                mode = 0;
                idNormal = getidcost(con,array[6]);
                idExpress = -1;
            }
            flagWaring(358,"ligne");  
            int idUser = atoi(array[0]);
            int weight = atoi(array[6]);
            int volume = atoi(array[7]);
            array[9] = translateDateFormat(array[9]);
            //QRCODE ZONE IMPLEMENTATION
            
            strqr = malloc (sizeof(char) * 50);
            titleqr = malloc (sizeof(char) * 50);
            strcpy(strqr, "https://www.google.com/");
            strcpy(titleqr, "linkGoogle");
            flagWaring(361,"Avant execution\n");
            qrCodePrintPNG(strqr,titleqr);
            
            //////////////////////////////
            sprintf(requete, "INSERT INTO COLIS (idUser,adresse, codePostale, recipientMail, weight, volume,sendingStatut,mode,date,idRecipient,idDelivery,idDepot,idCost,idExpressCost) VALUES (%d,'%s','%s','%s',%d,%d,%d,%d,'%s',%d,%d,%d,%d,%d)",idUser,array[3],array[4],array[5],weight,volume,sendingStatus,mode,array[9],idmail,idDelivery,idDepot,idNormal,idExpress);
            mysql_query(con, requete);
            for (size_t m = 1; m <  9; m++) {
                free(array[m]);
            }
            i = 0;                          
            lineNb = 1;                      
            lenghtWord = 0;  
        }
        free(strqr);
        free(titleqr);

        free(array);
        free(line);
    }
}