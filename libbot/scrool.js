

scrool()
function  scrool()
{
    require(__dirname + "/../lib/exec212.js")

    let python = "C:\\Users\\attil\\AppData\\Local\\Programs\\Python\\Python312\\python.exe"

   let pos=-50*10

    let args = [
        "mouseScrool.py",
        pos

    ]


    try {
        let message = execFileX(python, args);



    } catch (e) {
          console.log(e.message)

    }
}