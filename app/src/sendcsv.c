#include "../inc/sendcsv.h"


int sendcsv (char *filename)
{
    printf("filename: %s\n",filename);
    CURL *curl;
    struct curl_slist *headers = NULL;

    char * delim = ",";
    char *lineBreak = NULL;

    char line[255];
    char * jsonObj = malloc(sizeof(char) * (255));

    /*char filename[] = "testa.csv";*/
    FILE *file = fopen ( filename, "r" );

    if(file != NULL)
    {

        while(fgets(line, sizeof line, file) != NULL)
        {
            strcpy(jsonObj, "{\"nom\":\"");
            lineBreak = strchr(line, '\n');
            if (lineBreak != NULL)
            {
                *lineBreak = '\0';
            }
            strcat(jsonObj, strtok(line, delim));
            strcat(jsonObj, "\",\"prenom\":\"");
            strcat(jsonObj, strtok(NULL, delim));
            strcat(jsonObj, "\",\"adresse\":\"");
            strcat(jsonObj, strtok(NULL, delim));
            strcat(jsonObj, "\",\"codePostal\":\"");
            strcat(jsonObj, strtok(NULL, delim));
            strcat(jsonObj, "\",\"email\":\"");
            strcat(jsonObj, strtok(NULL, delim));
            strcat(jsonObj, "\",\"poids\":\"");
            strcat(jsonObj, strtok(NULL, delim));
            strcat(jsonObj, "\",\"taille\":\"");
            strcat(jsonObj, strtok(NULL, delim));
            strcat(jsonObj, "\"}");

            printf("\n jsonObj = %s", jsonObj);
            /*
            headers = curl_slist_append(headers, "Accept: application/json");
            headers = curl_slist_append(headers, "Content-Type: application/json");
            headers = curl_slist_append(headers, "charset: utf-8");
            curl_easy_setopt(curl, CURLOPT_URL, "http://localhost:81/Projet%20Annuel%202/hellospot/colisupload.php");
            curl_easy_setopt(curl, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_easy_setopt(curl, CURLOPT_HTTPHEADER, headers);
            curl_easy_setopt(curl, CURLOPT_POSTFIELDS, jsonObj);
            curl_easy_setopt(curl, CURLOPT_USERAGENT, "libcrp/0.1");
            curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, got_data);

            CURLcode result = curl_easy_perform(curl);
            if(result != CURLE_OK) {
                fprintf(stderr, "download problem: %s\n", curl_easy_strerror(result));
            }

            if(signIn()) {
                printf("Colis enregistré !\n");
            }else{
                printf("Erreur dans l'enregsitrement du colis\n");
            }*/
        }
        fclose (file);
    }
    else
    {
        printf("Erreur avec le fichier");
        return 2;
    }
    return 0;
}