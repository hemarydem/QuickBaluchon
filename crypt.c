#include "crypt.h"

char * encryptage(char * str, int key)
{
    int i;
    for (i = 0; (i < 255 && str[i] != '\0'); i++) {
        str[i] = str[i] + key;
    }
    printf("\nencrypt str: %s\n", str);
    return str;
}

char * decryptage(char * str, int key)
{
    int i;
    for(i = 0; (i < 255 && str[i] != '\0'); i++){
        str[i] = str[i] - key;
    }
    printf("\ndecrypted str: %s\n", str);
    return str;
}

int decryptKey(int key)
{
    int result;

    result = log10(key)+1;

    if (result == 9){
        result = (sqrt(key))/100;
        printf("\nkey decrypt : %d\n", result);
        return result;
    }else{
        printf("error, key format wrong");
        return 0;
    }
}
