

//scrool(-50*50)

global['scrool']=scrool
function scrool(pos) {




    require(__dirname + "/../lib/exec212.js")

    let python = __dirname+"/../Python312/python.exe"
// # abt 50just one line
    //  let pos = -50 * 50

    let args = [
        __dirname+"/../libbot/mouseScrool.py",
        pos

    ]


    try {
        let message = execFileX(python, args);


    } catch (e) {
        console.log(e.message)

    }
}

// scrool()
// function  scrool()
// {
//     require(__dirname + "/../lib/exec212.js")
//
//     let python = "C:\\Users\\attil\\AppData\\Local\\Programs\\Python\\Python312\\python.exe"
//
//    let pos=-50*10
//
//     let args = [
//         "mouseScrool.py",
//         pos
//
//     ]
//
//
//     try {
//         let message = execFileX(python, args);
//
//
//
//     } catch (e) {
//           console.log(e.message)
//
//     }
// }