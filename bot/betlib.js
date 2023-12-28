


function getRdmMny4bet() {

    let  mny0_a=[100,1000]


    let  nmy0= mny0_a[Random(0,1)];

    let  mny= Random(1,9)

    let fnlMny=mny*nmy0;
    return  fnlMny
}

function rdmBetLine() {
    const fs = require('fs');


    // read contents of the file
    const data = fs.readFileSync(__dirname + '/../cfgBot/bets.txt', 'UTF-8');

    // split the contents by new line
    const lines = data.split(/\r?\n/);

    rdm = Random(0, lines.length - 1)

    let line = lines[rdm];
    return line;
}

function Random(min, max) {
    return Math.round(Math.random() * (max - min)) + min;
}
