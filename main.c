#include <SDL.h>
#include "curlprocess.h"
#include "qrcodeprocess.h"
#include <gtk/gtk.h>


//gcc *.c -o logIn.exe -I include -L lib -lmingw32 -lSDL2main -lSDL2
//gcc *.c -o logIn.app $(sdl2-config --cflags --libs) -lsdl2_image -lcurl


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

int main(int argc, char ** argv) {

    GtkBuilder      *builder;
    GtkWidget       *window;

    gtk_init(&argc, &argv);

    builder = gtk_builder_new();
    gtk_builder_add_from_file (builder, "ui.glade", NULL);

    window = GTK_WIDGET(gtk_builder_get_object(builder, "window_connexion"));
    gtk_builder_connect_signals(builder, NULL);

    g_object_unref(builder);

    //gtk_widget_show(window);
    gtk_widget_show(GTK_WIDGET(window));
    //gtk_widget_destroy(window);
    gtk_main();


    //curlFunction();
    //qrcodeFunction();

    return 0;
}

// called when window is closed
void on_window_main_destroy()
{
    gtk_main_quit();
}