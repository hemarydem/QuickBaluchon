#include "../inc/crypt.h"

char * encryptage(char * str, int key) {
    int i, j, x, y;
    char test[185] = {"fRSTU#$%&mnLMq[\\]^{45tuva9rbcYZ1de78s()*+,./:;wxyzABCDghijklQEFPNOopGVWX23\"HIJK<=>@0-_!?'|}~fRSTU#$%&mnLMq[\\]^{45tuva9rbcYZ1de78s()*+,./:;wxyzABCDghijklQEFPNOopGVWX23\"HIJK<=>@0-_!?'|}~\0"};

    //fRSTU#$%&mnLMq[\\]^{45tuva9rbcYZ1de78s()*+,./:;wxyzABCDghijklQEFPNOopGVWX23\"HIJK<=>@0-_!?'|}~
    //abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123457890-_!?'\"#$%&()*+,./:;<=>@[\\]^{|}~
    //

    for(i = 0; (i < 255 && str[i] != '\0'); i++){
        for(j = 0; j < 91; j++){
            if(str[i] == test[j]){
                if(key > 90){
                    key = key - 89;
                }
                printf("\nkey = %d", key);
                y = j + key;
                str[i] = test[y];
                break;
            }else{
                continue;
            }
        }
    }
    printf("\nencrypt str: %s\n", str);
    return str;
}

char * decryptage(char * str, int key) {
    int i, j, x, y;
    char test[185] = {"fRSTU#$%&mnLMq[\\]^{45tuva9rbcYZ1de78s()*+,./:;wxyzABCDghijklQEFPNOopGVWX23\"HIJK<=>@0-_!?'|}~fRSTU#$%&mnLMq[\\]^{45tuva9rbcYZ1de78s()*+,./:;wxyzABCDghijklQEFPNOopGVWX23\"HIJK<=>@0-_!?'|}~\0"};

    for(i = 0; (i < 255 && str[i] != '\0'); i++){
        for(j = 92; j < 185; j++){
            if(str[i] == test[j]){
                if(key > 90){
                    key = key - 89;
                }
                printf("\nkey = %d", key);
                y = j - key;
                str[i] = test[y];
                break;
            }else{
                continue;
            }
        }
    }
    printf("\ndecrypted str: %s\n", str);
    return str;
}

int decryptKey(int key) {
    int result;
    result = log10(key)+1;
    if (result == 9) {
        result = (sqrt(key))/100;
        printf("\nkey decrypt : %d\n", result);
        return result;
    }else{
        printf("error, key format wrong");
        return 0;
    }
}
