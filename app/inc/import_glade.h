/*
import_glade.h

last modif: 30 nov 2020
*/
#ifndef import_glade_h
#define import_glade_h
#include "curlprocess.h"

void open_home_window(char *idWindow);

void click_button(GtkBuilder *builder, char *idButton,void (*pf));
GtkBuilder *close_and_open_window(GtkBuilder *builder, char *idOldWindow, char *idNewWindow);
GtkBuilder *newWindow(char* file, char* idWindow);

//NAVIGATION
void open_menu_window(GtkWidget *widget,gpointer builder);
void CheckAndCreateCSV(GtkWidget *widget,GtkWidget *window);
void sendCSV(GtkWidget *widget,GtkWidget *window);

void on_window_main_destroy();
void on_window_new_booking_destroy();
#endif




//
