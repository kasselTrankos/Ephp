	/*
 * Finder.cpp
 *
 *  Created on: 04/05/2012
 *      Author: kassel
 */

#include "Finder.h"
#include <curl/curl.h>

Finder::Finder(string uri)
{
   get(uri);
}
string Finder::html(){return code;}
bool Finder::get(string uri, long timeout)
{


    CURL* curl = curl_easy_init();
    if( curl == NULL )
        return false;

    /*
    El curl creado debe ser configurado antes de lanzarse
    a su ejecucion. Para ello, se utiliza curl_easy_setopt
    */
    curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, &Finder::writeCallback);
    curl_easy_setopt(curl, CURLOPT_WRITEDATA, &code);
    //La url objetivo
    curl_easy_setopt(curl, CURLOPT_URL, uri.c_str());
    curl_easy_perform(curl);
    return true;
}
size_t Finder::writeCallback(char* data, size_t size, size_t nmemb, string *buffer){
    int result = 0;
      if (buffer != NULL) {
        buffer->append(data, size * nmemb);
        result = size * nmemb;
      }
      return result;
}

Finder::~Finder()
{
    //dtor
}

