#include "curlprocess.h"

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////           CURL DATA               /////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

size_t got_data(char * buffer, size_t itemsize, size_t nitems, void * ignorthis) {
    size_t bytes =  itemsize * nitems;
    int linenumber = 1;
    FILE * f = fopen("connect.txt", "wb");
    printf("new chunk (%zu bytes)\n", bytes);
    printf("%d:\t", linenumber);
    for (int i = 0; i < bytes; i++) {
        printf("%c", buffer[i]);
        fprintf(f,"%c",buffer[i]);
        if (buffer[i] == '\n') {
            linenumber++;
            printf("%d:\t", linenumber);
        }
    }
    printf("\n\n");
    fclose(f);
    return bytes;
}

size_t dataToDownload(void *ptr, size_t size, size_t nmemb, FILE *stream) {
    size_t data = fwrite(ptr, size, nmemb, stream);
    return data;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////           CURL DOWNLOAD OBJ.BIN         /////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

CURLcode getKey() {
    CURL *curlObj;
    FILE *fpObj;
    CURLcode resultObj;
    char *urlObj = "http://localhost:81/Projet%20Annuel%202/hellospot/put/obj.bin";
    char *fileObj = "obj.bin";
    char *bufferObj = malloc(sizeof(char) * 9);

    curlObj = curl_easy_init();

    if (curlObj) {
        fpObj = fopen(fileObj, "wb");

        curl_easy_setopt(curlObj, CURLOPT_URL, urlObj);
        curl_easy_setopt(curlObj, CURLOPT_WRITEFUNCTION, dataToDownload);
        curl_easy_setopt(curlObj, CURLOPT_WRITEDATA, fpObj);

        resultObj = curl_easy_perform(curlObj);

        curl_easy_cleanup(curlObj);
        fclose(fpObj);

        fpObj = fopen(fileObj, "rb");

        fread(bufferObj, sizeof(char) * 9, 1, fpObj);
        resultObj = atoi(bufferObj);
        printf("\nresultObj = %d", resultObj);
        printf("\nbufferObj = %s", bufferObj);

        fclose(fpObj);
        remove(fileObj);
        return resultObj;
    } else {
        return 0;
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////       ENCRYPT DATA      ///////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

char * jsonData(CURLcode resultObj, char * strID, char * strPwd) {
    char * jsonObj = malloc(sizeof(char) * 255);
    int validKey = 0;

    validKey = decryptKey(resultObj);

    strID = encryptage(strID, validKey);
    strPwd = encryptage(strPwd, validKey);

    printf("\n encrypt strID = %s", strID);
    printf("\n encrypt strPwd = %s", strPwd);

    strcpy(jsonObj, "{\"id\":\"");
    strcat(jsonObj, strID);
    strcat(jsonObj, "\",\"pwd\":\"");
    strcat(jsonObj, strPwd);
    strcat(jsonObj, "\"}");
    printf("\n jsonObj = %s", jsonObj);
    free(strID);
    free(strPwd);
    return jsonObj;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////      CURL SEND DATA BY JSON    /////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

void sendData (char * jsonObj, CURL * curl) {
    struct curl_slist * headers = NULL;
    headers = curl_slist_append(headers, "Accept: application/json");
    headers = curl_slist_append(headers, "Content-Type: application/json");
    headers = curl_slist_append(headers, "charset: utf-8");
    curl_easy_setopt(curl, CURLOPT_URL, "http://localhost:81/Projet%20Annuel%202/hellospot/put/put.php");
    curl_easy_setopt(curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_easy_setopt(curl, CURLOPT_HTTPHEADER, headers);
    curl_easy_setopt(curl, CURLOPT_POSTFIELDS, jsonObj);
    curl_easy_setopt(curl, CURLOPT_USERAGENT, "libcrp/0.1");
    curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, got_data);
//perform out action
    CURLcode result = curl_easy_perform(curl);
    if (result != CURLE_OK) {
        fprintf(stderr, "download problem: %s\n", curl_easy_strerror(result));
    }


    if (signIn()) {
        printf("Vous etes connecte !\n");
    } else {
        printf("Identifiants ou mots de passe incorrects\n");
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////      CURL VARIABLE    //////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

int curlFunction(char * strID, char * strPwd) {
    CURLcode resultObj;
    CURL *curl;
    char * jsonObj = malloc(sizeof(char) * 255);
    int key = 0;
    int k;
    char input[500];

    curl_global_init(CURL_GLOBAL_ALL);// init lib curl
    curl = curl_easy_init();
    if (curl == NULL) {
    return 128;
    }

    resultObj = getKey();
    jsonObj = jsonData(resultObj, strID, strPwd);
    sendData(jsonObj, curl);

    curl_easy_cleanup(curl);
    curl_global_cleanup();
    return 1;

};