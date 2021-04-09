#include <dirent.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <mysql/mysql.h>

#define LEN(arr) ((int) (sizeof (arr) / sizeof (arr)[0]))
//gcc main.c -l mysqlclient

int numberFile;


int number_size(){
    int count = 0;
    struct dirent *dir;
    // opendir() renvoie un pointeur de type DIR. 
    DIR *lenD = opendir("untreatedCsv"); 
    if (lenD)
    {
        while ((dir = readdir(lenD)) != NULL)
        {
            if(strstr(dir->d_name,".csv")){
                count += sizeof(dir->d_name);
                numberFile += 1;
            }
            else {
                continue;
            }
        }
        closedir(lenD);
    }
    return count;
}

char **getCSV(){
    struct dirent *dir;
    //opendir() renvoie un pointeur de type DIR. 
    DIR *d = opendir("untreatedCsv"); 
    int size = number_size();
    int i = 0;
    char **array = malloc(sizeof(char*)* size);
    if (d)
    {
        while ((dir = readdir(d)) != NULL)
        {
            if(strstr(dir->d_name,".csv")){
                array[i] = dir->d_name;
                i++;
            }
        }
        closedir(d);
    }
    free(array);
    return array;
}

FILE *deleteLine(FILE *content,FILE *newFile){
    int count = 1;
    char line[255];
    while(fgets(line, sizeof line, content) != NULL){
        if(count != 2){
            fputs(line,newFile);
        }
        count++;
    }
    return newFile;
}

int ConnexionToBDD(MYSQL con){

    if(mysql_real_connect(&con,"localhost","admin","admin","qb",0,NULL,0)){
        printf("You are connected\n");
        return 0;
    }
    else
    {
        printf("Error: verify your connection data\n");
        return 1;
    }

}

char ** buildCharArray(int numOfLine) {
  char ** array = NULL;
  int i;
  array = malloc(sizeof(char*) * numOfLine);
  if(array != NULL) {
    for (i = 0; i < numOfLine; i++) {
      array[i] = malloc(sizeof(char) * 100);// bloquer le nom des maps a 100 char
    if(array[i] == NULL) {
        int j = 0;
        while (j < i) {
          free(array[i]);
          j++;
        }
        free(array);
        printf("error malloc\n buildArrayMaplist\n");
        return array= NULL;
      }
    }
    printf("\nbuildCharArray ok\n");
    if(array == NULL)printf("array is NULL");
    return array;
  }
  printf("\n error \n  buildArrayMaplist \n");
  return array = NULL;
}


void insertBDD(FILE *myfilebro, MYSQL con){
    char nf,nr;
    char *id = malloc(sizeof(char)*100);
    int i = 0;
    int j = 0;
    int count = 0;
    int numberC = 0;

    while((nf=fgetc(myfilebro)) != EOF){
        if(nf != '\n' && count == 0){
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
    while((nr=fgetc(myfilebro)) != EOF){
        if(nr != ','){
            tabValue[i][j] = nr;
            j++;
        }else{
            i++;
            j = 0;
        }
    }

    //On dÃ©clare un tableau de char pour y stocker la requete
    char requete[255] = "";
    //On stock la requete dans notre tableau de char
    //sprintf(requete, "INSERT INTO COLIS VALUES('%s', '%s', '%ld')", id, value2);
    sprintf(requete, "INSERT INTO COLIS(idUser,adresse, codePostale, recipientMail, weight, volume) VALUES ('%s', '%s','%s','%s','%s','%s')",id,tabValue[2],tabValue[3],tabValue[4],tabValue[5],tabValue[6]);
    //On execute la requete
    mysql_query(&con, requete);
    //Fermeture de MySQL
    //mysql_close(con);
    for (size_t i = 0; i < numberC; i++) {// free de chaque ligne
        free(tabValue[i]); 
    }
    free(tabValue);// free du tableau
}

int readCSV(char **array, int bdd,MYSQL con){
    char c;
    char *filePath = malloc(sizeof(char) * 1000);
    char *newFilePath = malloc(sizeof(char) * 1000);
    for(int i = 0;i < numberFile;i++){
        strcpy(filePath,"untreatedCsv/");
        strcpy(newFilePath,"treatment/");
        strcat(filePath,array[i]);
        strcat(newFilePath,array[i]);
        FILE *file = fopen(filePath, "r" );
        FILE *newfile = fopen(newFilePath,"w+");

        if(file != NULL){
            while((c=fgetc(file))!=EOF){
                deleteLine(file,newfile);
            }
            fclose(file);
            fclose(newfile);
        }
        FILE *newfiletreatment = fopen(newFilePath,"r");
        if(bdd == 0){
            insertBDD(newfiletreatment,con);
            fclose(newfiletreatment);
        }else{
            printf("error\n");
        }
    }
    free(filePath);
    free(newFilePath);
    return 0;
}

int main(){
    MYSQL con;
    mysql_init(&con);
    mysql_options(&con,MYSQL_READ_DEFAULT_GROUP,"option");
    int returnValue = ConnexionToBDD(con);
    char **myCsvArray = getCSV();
    readCSV(myCsvArray,returnValue,con);
    mysql_close(&con);
    return 0;
}
