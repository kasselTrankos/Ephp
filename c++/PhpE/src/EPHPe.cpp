//============================================================================
// Name        : EPHPe.cpp
// Author      : Alvaro Touzon
// Version     :
// Copyright   : Your copyright notice
// Description : Hello World in C++, Ansi-style
//============================================================================

#include <iostream>
#include "ats/com/Finder.h"
#include "ats/com/ParsePhp.h"

using namespace std;

int main() {
	cout << "!!!Hello World!!!" << endl; // prints !!!Hello World!!!
	cout << "Hello world!" << endl;
	    Finder u("http://vtr.com/velocidad/test.php");
	    ///home/ephp.home/Ephp/fences/Tagger
	    ParsePhp e("/home/ephp.home/Ephp/fences/Tagger/tags");
	   /// ParsePhp p("/home/ephp.home");
	    //cout << u.html() << endl;
	return 0;
}
