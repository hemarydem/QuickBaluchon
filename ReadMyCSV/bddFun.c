#include "bddFun.h"
#define LEN(arr) ((int) (sizeof (arr) / sizeof (arr)[0]))

int ConnexionToBDD(MYSQL * con) {
    flagWaring(4, "bddFun ConnexionToBDD(MYSQL * con)");//TODO DELETE
    if(mysql_real_connect(con,"127.0.0.1","root","root","qb",8889,NULL,0)){
        printf("You are connected\n");
        return 0;
    } else {
        printf("Error: verify your connection data\n");
        return 1;
    }
}

void insertBDD(FILE *myfilebro, MYSQL * con) {
    char * line = NULL;
    size_t len = 0;
    ssize_t read;
    char * ptr;                          // pointer to move on the string
    char ** array = NULL;                // cahr array contains data to insert in db
    int i = 0;                           
    int lineNb = 0;                      // incre variable
    int lenghtWord = 0;
    /////////////////////////////
    char nf;
    char *id ;//= malloc(sizeof(char)*100);
    int j = 0;
    int count = 0;
    int numberC = 0;

    while((nf=fgetc(myfilebro)) != EOF){
        if(nf != '\n' && count == 0){
            id[i] = nf;
            printf("TEST %s", id);
            count++;
            i++;
        }
        numberC++;
    }
    id[i] = '\0';
    i = 0;




    array = malloc(sizeof(char*) * 8);
    while ((read = getline(&line, &len, myfilebro)) != -1) {
        flagWaring(29,"debut boucle");
        ptr = line; 
        while (i < read) {            
            if (line[i] == ',') {
                line[i] = '\0';
                lenghtWord = strlen(ptr) + 1;                       // le +1 c'est pour compter le '\0'
                array[lineNb] = malloc(sizeof(char) * lenghtWord);  // du coup on malloc juste ce qu'on a besoin ici
                strcpy(array[lineNb],ptr);                          // on copie jusqu'à '\0'
                printf("-> %s\n",array[lineNb]);
                ptr = ptr + lenghtWord;                             // on pass derrière le '\0'
                lenghtWord = 0;
                lineNb ++;                                          // on descend d'une ligne dans le tableau
            }
            i++;
        }
        lenghtWord = strlen(ptr) + 1;                           // pour la dernière parti de la ligne qui n'est
        array[lineNb] = malloc(sizeof(char) * lenghtWord);        // pas prise en compte parce qu'elle se fini par = \0
        strcpy(array[lineNb],ptr);
        printf("-> %s\n",array[lineNb]);
        printf("\n vérification des ce qu'il se trouve dans le tableau\n---------------------\n");
        for (size_t m = 0; m <  8; m++) {
            printf("-> %s\n",array[m]);
        }
        ///INSERT INTO ICI

        //On dÃ©clare un tableau de char pour y stocker la requete
       // char requete[255] = "";
        //On stock la requete dans notre tableau de char
        //sprintf(requete, "INSERT INTO COLIS VALUES('%s', '%s', '%ld')", id, value2);
       // sprintf(requete, "INSERT INTO COLIS(idUser,adresse, codePostale, recipientMail, weight, volume) VALUES ('%s', '%s','%s','%s','%s','%s')",array[0],array[1],array[2],array[3],array[4],array[5],array[6]);
        //On execute la requete
        // mysql_query(con, requete);
        //Fermeture de MySQL
        //mysql_close(con);

        /// GÉNÉRATION QRCODE APRÈS
        for (size_t m = 0; m <  8; m++) {
            free(array[m]);
        }
        i = 0;                           
        lineNb = 0;                      
        lenghtWord = 0;  
    }
    free(array);
    free(line);
}