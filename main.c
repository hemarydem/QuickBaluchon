//gcc *.c -o logIn.exe -I include -L lib -lmingw32 -lSDL2main -lSDL2
//gcc *.c -o logIn.app $(sdl2-config --cflags --libs) -lsdl2_image -lcurl

#include <gtk/gtk.h>
#include <stdio.h>
#include "curlprocess.h"
#include <glib.h>
#include <glib/gprintf.h>

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////           prototype              /////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

static void getEntryMail( GtkWidget *widget, GtkWidget *entry );
static void getEntryPassword( GtkWidget *widget, GtkWidget *entry );
void connexion_window();
void on_window_main_destroy();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////           variable general              ///////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

const char *entry_mail;
const char *entry_password;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////           FUNCTION main              /////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
static void getEntryMail( GtkWidget *widget, GtkWidget *entry ) {
  
  entry_mail = gtk_entry_get_text(GTK_ENTRY (entry));
}

static void getEntryPassword( GtkWidget *widget, GtkWidget *entry ) {
  entry_password = gtk_entry_get_text(GTK_ENTRY (entry));
}

void GoConnexion(GtkWidget *widget, gpointer data){
  
    char *ID; 
    char *Pwd;

    ID = malloc(sizeof(char) * 255);
    Pwd = malloc(sizeof(char) * 255);
    strcpy(ID,entry_mail);
    strcpy(Pwd,entry_password);
    int i = curlFunction(ID,Pwd);
    if(i){
      g_printf("Hello world!\n");
    }
}

void connexion_window(){
    GtkBuilder      *builder;
    GtkWidget       *window;
    GtkWidget       *mailid;
    GtkWidget       *pwdid;
    GtkWidget       *button;

    builder = gtk_builder_new();
    gtk_builder_add_from_file (builder, "ui.glade", NULL);

    window = GTK_WIDGET(gtk_builder_get_object(builder, "window_connexion"));
    gtk_builder_connect_signals(builder, NULL);

    mailid = GTK_WIDGET(gtk_builder_get_object(builder, "input_mail"));
    gtk_builder_connect_signals(builder, NULL);
    g_signal_connect(mailid, "changed", G_CALLBACK(getEntryMail), mailid);

    pwdid = GTK_WIDGET(gtk_builder_get_object(builder, "input_password"));
    gtk_builder_connect_signals(builder, NULL);
    g_signal_connect(pwdid, "changed", G_CALLBACK(getEntryPassword), pwdid);

    button = GTK_WIDGET(gtk_builder_get_object(builder,"Connexion"));
    gtk_builder_connect_signals(builder,NULL);
    g_signal_connect(G_OBJECT(button),"clicked",G_CALLBACK(GoConnexion),NULL);

    //ORDINATEUR S'IL E PLAI TOI TOUT BEAU ET TOUT GENTIL MAiS LES StRING DANS pwdid et dans mailid
    g_object_unref(builder);
    gtk_widget_show(window);

}

// called when window is closed
void on_window_main_destroy() {
    gtk_main_quit();
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////           CURL DATA               /////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
int main(int argc, char ** argv) {
    gtk_init(&argc, &argv);
    connexion_window();
    gtk_main();
    qrCodePrintPNG(char * str, char * fileName);
    return 0;
}