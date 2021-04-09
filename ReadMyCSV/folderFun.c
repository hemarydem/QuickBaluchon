#include "folderFun.h"
int numberFile;

char ** buildCharArray(int numOfLine) {
    flagWaring(5, "folderFun buildCharArray");//TODO DELETE
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
        printf("\nbuildCharArray ok\n");
        if(array == NULL)
            printf("array is NULL");
        return array;
    }
    printf("\n error \n  buildArrayMaplist \n");
    return array = NULL;
}

int number_size() {
    flagWaring(33, "number_size()\nfolderFun");//TODO DELETE
    int count = 0;
    struct dirent *dir;
    // opendir() renvoie un pointeur de type DIR. 
    DIR *lenD = opendir("untreatedCsv"); 
    if (lenD) {
        while ((dir = readdir(lenD)) != NULL) {
            if(strstr(dir->d_name,".csv")) {
                count += sizeof(dir->d_name);
                numberFile += 1;
            } else {
                continue;
            }
        }
        closedir(lenD);
    }
    return count;
}

char **getCSV() {
    flagWaring(39, "folderFun **getCSV()");//TODO DELETE
    struct dirent *dir;
    //opendir() renvoie un pointeur de type DIR. 
    DIR *d = opendir("untreatedCsv"); 
    int size = number_size();
    int i = 0;
    char **array = malloc(sizeof(char*)* size);
    if (d) {
        while ((dir = readdir(d)) != NULL) {
            if(strstr(dir->d_name,".csv")) {
                array[i] = dir->d_name;
                i++;
            }
        }
        closedir(d);
    }
    free(array);
    return array;
}

FILE *deleteLine(FILE *content,FILE *newFile) {
    flagWaring(74, "deleteLine(FILE *content,FILE *newFile)\nfolderFun");//TODO DELETE
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
    flagWaring(87, "readCSV(char **array, int bdd,MYSQL * con)\nfolderFun");//TODO DELETE
    char c;
    char *filePath = malloc(sizeof(char) * 1000);
    char *newFilePath = malloc(sizeof(char) * 1000);
    for(int i = 0;i < numberFile;i++) {
        strcpy(filePath,"untreatedCsv/");
        strcpy(newFilePath,"treatment/");
        strcat(filePath,array[i]);
        strcat(newFilePath,array[i]);
        printf("\nfilePath----------------->%s|||||||||||||||||||||||\n",filePath);
        printf("\nnewFilePath----------------->%s|||||||||||||||||||||||\n",newFilePath);
        FILE *file = fopen(filePath, "r" );
        FILE *newfile = fopen(newFilePath,"w+");

        if(file != NULL) {
            while((c=fgetc(file))!=EOF) {
                deleteLine(file,newfile);
            }
            fclose(file);
            fclose(newfile);
        }
        FILE *newfiletreatment = fopen(newFilePath,"r");
        if(bdd == 0){
            insertBDD(newfiletreatment,con);
            fclose(newfiletreatment);
        } else {
            printf("error\n");
        }
    }
    free(filePath);
    free(newFilePath);
    return 0;
}