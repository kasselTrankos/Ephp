/*
 * ParsePhp.cpp
 *
 *  Created on: 04/05/2012
 *      Author: kassel
 */

#include "ParsePhp.h"
#include <istream>
#include <iostream>
#include <fstream>
#include <cstdlib>
#include <stdio.h>
#include <dirent.h>
#include <sstream>
#include <sys/types.h>
#include <string.h>
#include <sqlite3.h>
#include <boost/regex.hpp>

ParsePhp::ParsePhp(string f) {
	DIR *pDir;
	ifstream fileOpen;
	struct dirent *entry;
	string str;
	string num;
	ifstream inn;
	if(pDir=opendir(f.c_str())){
		cout << "ERRR "<<endl;
		while(entry = readdir(pDir)){
			if( strcmp(entry->d_name, ".") != 0 && strcmp(entry->d_name, "..") != 0 ){

				str = f+'/'+entry->d_name;
				cout << str  << "\n" << endl;;

				inn.open(str.c_str());
				boost::smatch match;
				boost::regex rx("tag\=\"(.+)\"" ,boost::regex_constants::icase|boost::regex_constants::perl);
				while(getline(inn, num)){
					if(boost::regex_search(num, match, rx , boost::regex_constants::format_perl)){
						printf("found");
						for(size_t i = 1; i < match.size(); ++i)
						      {
						         std::cout << match[i] << std::endl;
						      }
						cout << match[1]<<endl;
					}else{
						printf("not doun");
					}

					cout << num << endl;

				}
				inn.close();
			}

		}
		closedir(pDir);
	}else{
		cout << " GIVE AN ERROR "<< f <<endl;
	}
}

ParsePhp::~ParsePhp() {
	// TODO Auto-generated destructor stub
}

