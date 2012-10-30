/*
 * Finder.h
 *
 *  Created on: 04/05/2012
 *      Author: kassel
 */

#ifndef FINDER_H_
#define FINDER_H_

#include <iostream>
#include <string>
using namespace std;

class Finder {
	public:
        Finder(string uri);
        string html();
        virtual ~Finder();
    protected:
    private:
        string code;
        static size_t writeCallback(char* data, size_t size, size_t nmemb, string *buffer);
        bool get(string uri, long timeout = 0);
};

#endif /* FINDER_H_ */
