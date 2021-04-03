#include <dirent.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>

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
        if(count != 1){
            fputs(line,newFile);
        }
        count++;
    }
    return newFile;
}

int readCSV(char **array){
    char c,nf;
    int j = 0;
    char *filePath = malloc(sizeof(char) * 13);
    char *newFilePath = malloc(sizeof(char) * 13);

    for(int i = 0;i < numberFile;i++){
        char *value = malloc(sizeof(char) * 1000);
        strcpy(filePath,"untreatedCsv/");
        strcpy(newFilePath,"treatment/");
        strcat(filePath,array[i]);
        strcat(newFilePath,array[i]);
        //printf("mon dossier contient: %s\n", newFilePath);
        FILE *file = fopen(filePath, "r" );
        FILE *newfile = fopen(newFilePath,"w+");

        if(file != NULL){
            while((c=fgetc(file))!=EOF){
                deleteLine(file,newfile);
            }
            fclose(file);
        }
        while((nf=fgetc(newfile))!=EOF){
            if(nf != ','){
                value[j] = nf;
                //printf("%c",nf);
                j++;
            }
            else{
                value[j] = ' ';
                j++;
            }
        }
        printf("%s\n", value);
        free(value);
    }
    return 0;
}

int main(){
    char **myCsvArray = getCSV();
    readCSV(myCsvArray);
    return 0;
}