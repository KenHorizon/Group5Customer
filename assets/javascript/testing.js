var dictstring = JSON.stringify(dict);

var fs = require('fs');

fs.writeFile("things.json", dictstring);

var dict = {"one" : [15, 4.5],
        "two" : [34, 3.3],
        "three" : [67, 5.0],
        "four" : [32, 4.1]};