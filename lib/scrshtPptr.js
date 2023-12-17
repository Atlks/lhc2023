



//npm i puppeteer

//node scrsht914.js


async function saveScr(url, pathSaveImg) {
    const puppeteer = require('puppeteer');
    const browser = await puppeteer.launch();
    const page = await browser.newPage();

    await page.goto(url, {waitUntil: 'networkidle2'});

    const screenshot = await page.screenshot({path: pathSaveImg});
    console.log(`Screenshot taken: ${screenshot}`);
    await browser.close();
}

(async () => {

    let url = 'http://www.cg9292.net/';
    let pathSaveImg = 'scrsht916.png';
    await saveScr(url, pathSaveImg);
})();