/*
import_glade.h

last modif: 30 nov 2020
*/

void open_home_window(char *idWindow);

void click_button(GtkBuilder *builder, char *idButton,void (*pf));
GtkBuilder *close_and_open_window(GtkBuilder *builder, char *idOldWindow, char *idNewWindow);
GtkBuilder *newWindow(char* file, char* idWindow);

//NAVIGATION
void open_menu_window(GtkWidget *widget,gpointer builder);






//
