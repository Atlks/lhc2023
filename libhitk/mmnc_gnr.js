require("./enc")
require("./mmnc")

basewd="fff"  // f
offst=1;
slt=""
let i=10;
// for(let i=1;i<10;i++)
// {
//     console.log("\r\n\r\n\r\n---------------\r\n")
//     const s=basewd+i+slt;
//     console.log(s)
//     const hx=md5(s)
//     console.log(hx)
//     const mmnc= geneMmncCrpt(hx)
//     console.log(mmnc)
//
//     var {readFileSync,writeFileSync,appendFileSync} = require("fs");
//     writeFileSync("xx.log","111");
// }

setInterval(()=>{

   if(i>40)
       process.exit(0);
    console.log("\r\n\r\n\r\n---------------\r\n")
    const s=basewd+i+slt;
    console.log(s)
    const hx=md5(s)
    console.log(hx)
    const mmnc= geneMmncCrpt(hx)
    console.log(mmnc)

    i++
},500)

// setTimeout(()=>{
//
//
//
//
// },5000);


// console.log(mmnc)