/*
import_glade.c
// ->pikachu<---------\(^^)/-------\(^^)/-----(-_-)---(o_o)---
create the windows from the file glade in ui/glade/home.glade
connet the signals for the navigation between the windows

last modif: 30 nov 2020
*/

#include <gtk/gtk.h>
#include "../inc/import_glade.h"

//defines
#define GLADE_FILE "ui/glade/ui.glade"


/*
function: homekamaji
Open Window_home
*/
void open_home_window(char *idWindow){

  GtkBuilder *builder = newWindow(GLADE_FILE, idWindow);

  click_button(builder, "Connexion", &open_menu_window);

}

/*
click_button
*/
void click_button(GtkBuilder *builder, char *idButton, void (*pf)){
  GtkWidget *button;
  button = GTK_WIDGET(gtk_builder_get_object(builder, idButton));
  g_signal_connect (button,"clicked",G_CALLBACK(pf),builder);
}

/*
close_and_open_window
*/
GtkBuilder *close_and_open_window(GtkBuilder *builder, char *idOldWindow, char *idNewWindow){
  gtk_widget_destroy( GTK_WIDGET(gtk_builder_get_object(builder, idOldWindow)) );
   g_object_unref(G_OBJECT(builder));
  return newWindow(GLADE_FILE, idNewWindow);
}

/*
newWindow
*/
GtkBuilder *newWindow(char* file, char* idWindow){
  GtkBuilder      *builder;
  GtkWidget       *window;

  builder = gtk_builder_new();
  gtk_builder_add_from_file (builder,file, NULL);
  window = GTK_WIDGET(gtk_builder_get_object(builder, idWindow));
  gtk_builder_connect_signals(builder, NULL);
  g_signal_connect(G_OBJECT(window), "delete-event", G_CALLBACK(gtk_main_quit), NULL);

  gtk_widget_show(window);
  return builder;
}


//##### NAVIGATION ####################################################


void open_menu_window(GtkWidget *widget,gpointer builder){
  
  close_and_open_window(builder,"window_connexion","window_menu");
}



//#############
