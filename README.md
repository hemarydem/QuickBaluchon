# QuickBaluchon
Projet annuel esgi deuxième année

Branche de l'executable serveur

POUR MAC
gcc *.c -o main.app $(sdl2-config --cflags --libs) -lSDL2_image -lmysqlclient

POUR LINUX
gcc *.c -o main.exe $(sdl2-config --cflags --libs) -lSDL2_image -lmysqlclient