#include "date.h"

char * getMonth(int month) {
    char * m = NULL;
    m = malloc(sizeof(char) * 3);
    switch (month){
    case 1:
        strcpy(m,"01");
        break;
    case 2:
        strcpy(m,"02");
        break;
    case 3:
        strcpy(m,"03");
        break;
    case 4:
        strcpy(m,"04");
        break;
    case 5:
        strcpy(m,"05");
        break;
    case 6:
        strcpy(m,"06");
        break;
    case 7:
        strcpy(m,"07");
        break;
    case 8:
        strcpy(m,"08");
        break;
    case 9:
        strcpy(m,"09");
        break;
    case 10:
        strcpy(m,"10");
        break;
    case 11:
        strcpy(m,"11");
        break;
    case 12:
        strcpy(m,"12");
        break;

    }
    return m;
}

char *myDate() 
{
    printf("je suis dans my date\n");
    time_t timestamp; 
    struct tm * t; 
    printf("le mois c carré\n");
    timestamp = time(NULL); 
    t = gmtime(&timestamp);
    printf("time nul");
    char *month = getMonth(t->tm_mon); 
    char *date = malloc(sizeof(char)*10);
    printf("date déclaration\n");
    /* Affiche la date et l'heure courante (format francais) */ 
    sprintf(date,"%02u%s%04u", t->tm_mday, month, 1900 + t->tm_year);
    printf("sprintf\n"); 
    printf("%s",date);
    return date;
}