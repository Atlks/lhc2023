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

let line = rdmBetLine();


console.log(line)



    function Random(min, max) {
        return Math.round(Math.random() * (max - min)) + min;
    }