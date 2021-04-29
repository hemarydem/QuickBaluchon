#include "folderFun.h"
#include "date.h"

int numberFile;

char ** buildCharArray(int numOfLine) {
    char ** array = NULL;
    int i;
    array = malloc(sizeof(char*) * numOfLine);
    if(array != NULL) {
        for (i = 0; i < numOfLine; i++) {
            array[i] = malloc(sizeof(char) * 1000);// bloquer le nom des maps a 100 char
            if(array[i] == NULL) {
                int j = 0;
                while (j < i) {
                    free(array[i]);
                    j++;
                }
                free(array);
                printf("error malloc\n buildArrayMaplist\n");
                return array = NULL;
            }
        }
        if(array == NULL)
            printf("array is NULL");
        return array;
    }
    printf("\n error \n  buildArrayMaplist \n");
    return array = NULL;
}

int number_size() {
    int count = 0;
    struct dirent *dir;
    // opendir() renvoie un pointeur de type DIR. 
    DIR *lenD = opendir("untreatedCsv"); 
    if (lenD) {
        while ((dir = readdir(lenD)) != NULL) {
            if(strstr(dir->d_name,".csv")) {
                //count += sizeof(dir->d_name);
                numberFile += 1;
            } else {
                continue;
            }
        }
        closedir(lenD);
    }
    return numberFile;
}

char **getCSV() {
    struct dirent *dir;
    //opendir() renvoie un pointeur de type DIR. 
    DIR *d = opendir("untreatedCsv"); 
    int size = number_size();
    int i = 0;
    char **array = malloc(sizeof(char*)* size + 1);
    if (d) {
        while ((dir = readdir(d)) != NULL) { 
            if(strstr(dir->d_name,".csv")) {
                array[i] = malloc(sizeof(char) * (strlen(dir->d_name)+1));
                strcpy(array[i],dir->d_name);
                i++;
            }
        }
        array[i] = malloc(sizeof(char) * 4);
        strcpy(array[size],"FIN");
        closedir(d);
    }
    return array;
}

FILE *deleteLine(FILE *content,FILE *newFile) {
    int count = 1;
    char line[255];
    while(fgets(line, sizeof line, content) != NULL) {
        if(count != 2) {
            fputs(line,newFile);
        }
        count++;
    }
    return newFile;
}

int readCSV(char **array, int bdd,MYSQL * con) {
    char c;
    char nf;
    char *filePath = malloc(sizeof(char) * 1000);
    char *newFilePath = malloc(sizeof(char) * 1000);
    char *FilePathProcessed = malloc(sizeof(char) * 1000);
    flagWaring(91,"ligne");
    for(int i = 0;i < numberFile;i++) {
        strcpy(filePath,"untreatedCsv/");
        strcpy(newFilePath,"treatment/");
        strcpy(FilePathProcessed,"processedCSV/");
        strcat(filePath,array[i]);
        strcat(newFilePath,array[i]);
        FILE *file = fopen(filePath, "r" );
        FILE *newfile = fopen(newFilePath,"w+");
        flagWaring(100 + i,"ligne");
        if(file != NULL) {
            while((c=fgetc(file))!=EOF) {
                deleteLine(file,newfile);
            }
            fclose(file);
            fclose(newfile);
        }
        flagWaring(108,"ligne");
        FILE *newfiletreatment = fopen(newFilePath,"r");
        if(bdd == 0){
            flagWaring(110,"ligne");
            insertBDD(newfiletreatment,con);
            flagWaring(113,"ligne");
            fclose(newfiletreatment);
        } else {
            printf("error\n");
        }
        //rename(newFilePath,FilePathProcessed);
        //remove(filePath);
        //remove(newFilePath);
    }
    flagWaring(119,"ligne");
    free(filePath);
    free(newFilePath);
    return 0;
}