/*
  main.c
_________________
Théo OMNES
Yanis TAGRI
_________________
last change:
30 nov 2020

Compile:
gcc `pkg-config --cflags gtk+-3.0` -o exe/quickbaluchon src/main.c `pkg-config --libs gtk+-3.0`

*/


#include <gtk/gtk.h>
#include "import_glade.c"

//################################################################
int main(int argc, char **argv){

  //GTK
  gtk_init(&argc, &argv);
  open_home_window("window_connexion");
  gtk_main();
}
//################################################################



//
