#include <stdio.h>
#include <stdlib.h>
#include <math.h>
#include <string.h>
char * decryptage(char * str, int key);
int decryptKey(int key);

char * decryptage(char * str, int key)
{
    int i, j, x, y;
    char test[185] = {"fRSTU#$%&mnLMq[\\]^{45tuva9rbcYZ1de78s()*+,./:;wxyzABCDghijklQEFPNOopGVWX23\"HIJK<=>@0-_!?'|}~fRSTU#$%&mnLMq[\\]^{45tuva9rbcYZ1de78s()*+,./:;wxyzABCDghijklQEFPNOopGVWX23\"HIJK<=>@0-_!?'|}~\0"};

    for(i = 0; (i < 255 && str[i] != '\0'); i++){
        for(j = 92; j < 185; j++){
            if(str[i] == test[j]){
                if(key > 90){
                 key = key - 89;
                }
                y = j - key;
                str[i] = test[y];
                break;
            }else{
                continue;
            }
        }
      }
    return str;
}

int decryptKey(int key) {
    int result;
    result = log10(key)+1;

    if (result == 9){
        result = (sqrt(key))/100;
        return result;
    }else{
        return 0;
    }
}

int main(int argc, char ** argv) {

    int kagi = 0;
    char * id;
    char * pwd;
    id = malloc(sizeof(char) * 255);
    pwd = malloc(sizeof(char) * 255);
    id = argv[1];
    pwd = argv[2];

    char * obj =  malloc(sizeof(char) * 511);
    FILE * f = fopen("obj.bin", "rb");
    fscanf(f,"%s", obj);
    fclose(f);
    kagi = atoi(obj);
    kagi = decryptKey(kagi);
    id = decryptage(id, kagi);
    pwd = decryptage(pwd, kagi);

    printf("\n%s\n%s", id, pwd);
    return 0;
}
