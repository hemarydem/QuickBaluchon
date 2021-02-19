include "key.h"
/*
size_t dataToDownload(void *ptr, size_t size, size_t nmemb, FILE *stream) {
    size_t data = fwrite(ptr, size, nmemb, stream);
    return data;
}

int callKey(int a) {

    CURL * curl2;
    FILE * fp2;
    CURLcode result2;
    char * url2 = "http://localhost:81/Projet%20Annuel%202/hellospot/put/jsonObj.json";
    char * file2 = "jsonObj.json";

    curl2 = curl_easy_init();

        if (curl2) {
            fp2 = fopen(file2,"wb");

            curl_easy_setopt(curl2, CURLOPT_URL, url2);
            curl_easy_setopt(curl2, CURLOPT_WRITEFUNCTION, dataToDownload);
            curl_easy_setopt(curl2, CURLOPT_WRITEDATA, fp2);

            res2 = curl_easy_perform(curl2);

            curl_easy_cleanup(curl2);

            fclose(fp2);
        }

    return 0;
}

/*
int callKey()
{
    char * jsonObj = malloc(sizeof(char) * 255);

    //{"jsonObj":"1"}

    strcpy(jsonObj, "{\"jsonObj\":\"1\"}");

    headers = curl_slist_append(headers, "Accept: application/json");
    headers = curl_slist_append(headers, "Content-Type: application/json");
    headers = curl_slist_append(headers, "charset: utf-8");
    curl_easy_setopt(curl, CURLOPT_URL, "http://localhost/put/keyprocess.php");
    curl_easy_setopt(curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_easy_setopt(curl, CURLOPT_HTTPHEADER, headers);
    curl_easy_setopt(curl, CURLOPT_POSTFIELDS, jsonObj);
    curl_easy_setopt(curl, CURLOPT_USERAGENT, "libcrp/0.1");
    curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, getKey);
    //perform out action
    CURLcode result = curl_easy_perform(curl);

    printf("key crypted : %d", result);
}
*/
