//gcc *.c -o logIn.exe -I include -L lib -lmingw32 -lSDL2main -lSDL2
//gcc *.c -o logIn.app $(sdl2-config --cflags --libs) -lsdl2_image -lcurl

#include <gtk/gtk.h>
#include <stdio.h>
#include "curlprocess.h"

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

const gchar *entry_mail;
const gchar *entry_password;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////           FUNCTION maine               /////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
static void getEntryMail( GtkWidget *widget, GtkWidget *entry ) {
  entry_mail = gtk_entry_get_text (GTK_ENTRY (entry));
  printf ("Entry contents: %s\n", entry_mail);
}

static void getEntryPassword( GtkWidget *widget, GtkWidget *entry ) {
  entry_password = gtk_entry_get_text (GTK_ENTRY (entry));
  printf ("Entry contents: %s\n", entry_mail);
}

void connexion_window(){
    GtkBuilder      *builder;
    GtkWidget       *window;
    GtkWidget       *mailid;
    GtkWidget       *pwdid;

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

    int i = curlFunction((char *)entry_mail, (char *)entry_password);
    printf("\n i = %d", i);

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

    //qrCodePrintPNG(char * str, char * fileName);

    return 0;
}