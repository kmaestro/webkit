<?php

require __DIR__ . '/vendor/autoload.php';

$webkit_ffi = FFI::cdef(
    '
    typedef char   gchar;
typedef struct _WebKitWebView WebKitWebView;



WebKitWebView *webkit_web_view_new(void);
void webkit_web_view_load_uri(WebKitWebView *web_view, const gchar *uri);
    ',
    'libwebkit2gtk-4.0.so'
);

$gtk = \Gtk3\Gtk::getInstance();
$gtk->init();
$window = new \Gtk3\Gtk\Window();
$window->setTitle('WebKit');
$window->setSize(600, 600);

$webview = $webkit_ffi->webkit_web_view_new();

$gtk->gtk_container_add($gtk->cast("GtkContainer *", $window->widget), $gtk->cast("GtkWidget *", $webview));

$webkit_ffi->webkit_web_view_load_uri($webview, "http://twitter.com");

$window->showAll();
$gtk->main();