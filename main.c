#include <stdio.h>
#include <stdlib.h>
#include <curl/curl.h>
size_t got_data(char * buffer, size_t itemsize, size_t nitems, void * ignorthis) {
    size_t bytes =  itemsize * nitems;
    int linenumber = 1;
    printf("new chunk (%zu bytes)\n", bytes);
    printf("%d:\t", linenumber);
    for (int i = 0; i < bytes; i++) {
        printf("%c", buffer[i]);
        if (buffer[i] == '\n') {
            linenumber++;
            printf("%d:\t", linenumber);
        }
    }
    printf("\n\n");
    return bytes;
}

int main(int argc, char ** argv) {
    CURL *curl;
    curl_global_init(CURL_GLOBAL_ALL);
    curl = curl_easy_init();
    if (curl == NULL) {
        return 128;
    }
    char* jsonObj = "{ \"name\" : \"alexandre\" , \"age\" : \"23\" }";
    struct curl_slist *headers = NULL;
    headers = curl_slist_append(headers, "Accept: application/json");
    headers = curl_slist_append(headers, "Content-Type: application/json");
    headers = curl_slist_append(headers, "charset: utf-8");
    curl_easy_setopt(curl, CURLOPT_URL, "http://localhost:8888/put/put.php");
    curl_easy_setopt(curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_easy_setopt(curl, CURLOPT_HTTPHEADER, headers);
    curl_easy_setopt(curl, CURLOPT_POSTFIELDS, jsonObj);
    curl_easy_setopt(curl, CURLOPT_USERAGENT, "libcrp/0.1");
    //curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, got_data);
    // perform out action
    CURLcode result = curl_easy_perform(curl);
    if(result != CURLE_OK) {
        fprintf(stderr, "download problem: %s\n", curl_easy_strerror(result));
    }
    curl_easy_cleanup(curl);
    curl_global_cleanup();
    return EXIT_SUCCESS;
}