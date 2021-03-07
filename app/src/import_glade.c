/*
import_glade.c

create the windows from the file glade in ui/glade/home.glade
connet the signals for the navigation between the windows

last modif: 30 nov 2020
*/

#include <gtk/gtk.h>
#include "../inc/import_glade.h"
#include <glib.h>
#include <glib/gprintf.h>
#include <stdio.h>
#include <string.h>
#include "../inc/curlprocess.h"

//defines
#define GLADE_FILE "ui/glade/ui.glade"

const char *entry_mail;
const char *entry_password;
const char *entry_filename;


static void getEntryMail( GtkWidget *widget, GtkWidget *entry ) {
  
  entry_mail = gtk_entry_get_text(GTK_ENTRY (entry));
}

static void getEntryPassword( GtkWidget *widget, GtkWidget *entry ) {
  entry_password = gtk_entry_get_text(GTK_ENTRY (entry));
}

static void getEntryFileName( GtkWidget *widget, GtkWidget *entry ) {
  entry_filename = gtk_entry_get_text(GTK_ENTRY (entry));
}


/*

Open Window_home
*/
void open_home_window(char *idWindow){
  GtkWidget       *mailid;
  GtkWidget       *pwdid;

  GtkBuilder *builder = newWindow(GLADE_FILE, idWindow);

  mailid = GTK_WIDGET(gtk_builder_get_object(builder, "input_mail"));
  gtk_builder_connect_signals(builder, NULL);
  g_signal_connect(mailid, "changed", G_CALLBACK(getEntryMail), mailid);

  pwdid = GTK_WIDGET(gtk_builder_get_object(builder, "input_password"));
  gtk_builder_connect_signals(builder, NULL);
  g_signal_connect(pwdid, "changed", G_CALLBACK(getEntryPassword), pwdid);

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
  GtkWidget *filename;
  //GtkWidget *btnCreate;
  
  GtkWidget       *window;
  //GtkWidget *nwindow;
  //GtkBuilder *newBuilder;
  char *ID; 
  char *Pwd;
  
  ID = malloc(sizeof(char) * 255);
  Pwd = malloc(sizeof(char) * 255);
  strcpy(ID,entry_mail);
  strcpy(Pwd,entry_password);
  int i = curlFunction(ID,Pwd);
  if(i){
    gtk_widget_destroy( GTK_WIDGET(gtk_builder_get_object(builder, "window_connexion")) );
    g_object_unref(G_OBJECT(builder));
    builder = gtk_builder_new();
    gtk_builder_add_from_file (builder,"ui/glade/ui.glade", NULL);
    window = GTK_WIDGET(gtk_builder_get_object(builder, "menu_window"));
    gtk_builder_connect_signals(builder, NULL);
    g_signal_connect(G_OBJECT(window), "delete-event", G_CALLBACK(gtk_main_quit), NULL);

    filename = GTK_WIDGET(gtk_builder_get_object(builder, "Filename"));
    gtk_builder_connect_signals(builder, NULL);
    g_signal_connect(filename, "changed", G_CALLBACK(getEntryFileName), filename);

    GtkWidget *create = GTK_WIDGET(gtk_builder_get_object(builder, "create"));
    gtk_builder_connect_signals(builder, NULL);
    g_signal_connect(create, "clicked", G_CALLBACK(CheckAndCreateCSV), GTK_WIDGET(window));

    GtkWidget *send = GTK_WIDGET(gtk_builder_get_object(builder, "button-envoyer"));
    gtk_builder_connect_signals(builder, NULL);
    g_signal_connect(send, "clicked", G_CALLBACK(sendCSV), GTK_WIDGET(window));

    gtk_widget_show(window);

  }else {
    open_home_window("window_connexion");
  }
}

void CheckAndCreateCSV(GtkWidget *widget,GtkWidget *window){
  strcat((char *)entry_filename,".csv");
  FILE * f = fopen(entry_filename, "w");
  fprintf(f,"%s", "nom,prénom,adresse,codePostale,recipientMail,poid,taille");
  fclose(f);
}

void sendCSV(GtkWidget *widget,GtkWidget *window){
  int returnfunction;
  strcat((char*)entry_filename,".csv");
  returnfunction = sendcsv((char *)entry_filename);
}




//#############
