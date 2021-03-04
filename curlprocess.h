#ifndef curlprocess_h
#define curlprocess_h
#include <stdio.h>
#include <stdlib.h>
#include "crypt.h"
#include "signInF.h"
#include <stddef.h>
#include <string.h>
#include <stdint.h>
#include <stdbool.h>
#include <curl/curl.h>
#include <gtk/gtk.h>
int curlFunction();
size_t got_data(char * buffer, size_t itemsize, size_t nitems, void * ignorthis);
size_t dataToDownload(void *ptr, size_t size, size_t nmemb, FILE *stream);
CURLcode getKey();
char * jsonData(CURLcode resultObj, char * strID, char * strPwd);
int sendData (char * jsonObj, CURL * curl);
int curlFunction(char *strIDb, char *strPwdb);
#endif
