/*
  main.c



Compile:
gcc `pkg-config --cflags gtk+-3.0` -o exe/main src/main.c `pkg-config --libs gtk+-3.0`

*/


#include <gtk/gtk.h>
#include "../inc/import_glade.h"


// called on closing window
void on_window_main_destroy(){
  gtk_main_quit();
}

//################################################################
int main(int argc, char **argv){


  //GTK
  gtk_init(&argc, &argv);
  open_home_window("window_connexion");
  gtk_main();
}
//################################################################



//
