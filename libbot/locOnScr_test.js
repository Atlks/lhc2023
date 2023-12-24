setInterval(() => {

    main()
}, 1000*999)
  main()


function main() {
    const {exec, execSync} = require('child_process');

    python = "C:\\Users\\attil\\AppData\\Local\\Programs\\Python\\Python312\\python.exe"
 // python="python"

   //jpg =C:/0prj/lhc2023/startPic.jpg
    prm="img=C:/0prj/lhc2023/startPic.jpg&confidence=0.95&region=0,0,900,1111&grayscale=true";
    const prmstr_encode = escapeshellarg(prm);
    cmd = `${python} locateOnScreen.py ${prmstr_encode}`
    console.log(cmd)


    //escapeshellarg
    // cmd=`${python} t.py`
    try{
          $rzt = execSync(cmd, {  cwd: process.cwd()  })

            let message = $rzt.toString();
            message = message.trim()

            console.log(message)

            if (message.includes("Box(left="))
                console.log("!!!!!!!! rzt true")
    }catch (e){
        console.log(e.message)
    }

}




function qryStr2obj(prm) {
    // prmOBJ=  new URLSearchParams(prm).get("grayscale") not work
    var querystring = require('querystring');

    var prmOBJ = querystring.parse(prm);
    return prmOBJ;
}



function escapeshellarg(prm) {
return  '"'+prm+'"';
   // return encodeURIComponent(prm)
}

function escapeshellarg342() {
    var prmOBJ = qryStr2obj(prm);
  let   prmstr = JSON.stringify(prmOBJ)
    return encodeURIComponent(prmstr)
}