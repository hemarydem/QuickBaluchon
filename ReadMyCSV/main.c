#include <dirent.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <mysql/mysql.h>

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

int ConnexionToBDD(MYSQL *con){

    if(mysql_real_connect(con,"localhost","admin","admin","qb",0,NULL,0)){
        printf("you are connected\n");
        return 0;
    }
    else
    {
        printf("Une erreur s'est produite lors de la connexion a la BDD!\n");
        fprintf(stderr, "%s\n", mysql_error(con));
        return 1;
    }

}

void insertBDD(char *str){
    printf("coucou\n");
    //printf("%s\n",str);
    //On déclare un tableau de char pour y stocker la requete
    //char requete[150] = "";
    //On stock la requete dans notre tableau de char
    //sprintf(requete, "INSERT INTO  VALUES('', '%s', '%ld')", value, value2);
    //On execute la requete
    //mysql_query(&mysql, requete);
    //Fermeture de MySQL
    //mysql_close(con);
}

int readCSV(char **array, int bdd){
    char c,nf;
    char *filePath = malloc(sizeof(char) * 13);
    char *newFilePath = malloc(sizeof(char) * 13);
    for(int i = 0;i < numberFile;i++){
        int j = 0;
        strcpy(filePath,"untreatedCsv/");
        strcpy(newFilePath,"treatment/");
        strcat(filePath,array[i]);
        strcat(newFilePath,array[i]);
        char *value = malloc(sizeof(char) * 1000);
        FILE *file = fopen(filePath, "r" );
        FILE *newfile = fopen(newFilePath,"w+");

        if(file != NULL){
            while((c=fgetc(file))!=EOF){
                deleteLine(file,newfile);
            }
            fclose(file);
            fclose(newfile);
        }
        FILE *newfiletreatment = newfiletreatment = fopen(newFilePath,"r");
        while((nf=fgetc(newfiletreatment))!=EOF){
            if(nf != ','){  
                value[j] = nf;
                j++;
            }
            else{
                value[j] = ' ';
                j++;
            }
        }
        value[j] = '\0';
        if(bdd == 0){
            insertBDD(value);
        }else{
            printf("error\n");
        }
        free(value);
    }
    return 0;
}

int main(){
    MYSQL *con = mysql_init(NULL);
    int returnValue = ConnexionToBDD(con);
    char **myCsvArray = getCSV();
    readCSV(myCsvArray,returnValue);
    mysql_close(con);
    return 0;
}