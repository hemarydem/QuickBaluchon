#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <unistd.h>



char * sendCsv(char * filePath, char * file){

    char * cmd = malloc(sizeof(char) * 255);
    char * endCmd = " --ftp-create-dirs";
    strcpy(cmd, "curl -k \"sftp://152.228.163.174:59349/csvProcessed/\" --user \"debiansftp:J9Sr0-Vy\" -T ");
    strcat(cmd, filePath);
    strcat(cmd, file);
    strcat(cmd, endCmd);
    printf("\n%s\n", cmd);
    system(cmd);
    return cmd;


}


int main()
{
    char * filePath = malloc(sizeof(char) * (255));
    char * file = malloc(sizeof(char) * (255));
    char * file2 = malloc(sizeof(char) * (255));
    strcpy(file, "\\");
    printf("file to upload : ");
    scanf("%s", file2);
    strcat(file, file2);
    filePath = getcwd(filePath, 255);
    sendCsv(filePath, file);

    return 0;
}