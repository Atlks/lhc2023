
//npm i puppeteer

//node scrsht914.js



const puppeteer = require('puppeteer');
(async () => {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    await page.goto('http://www.cg9292.net/', {waitUntil: 'networkidle2'});
    let path = 'scrsht916.png';
    const screenshot = await page.screenshot({path: path});
    console.log(`Screenshot taken: ${screenshot}`);
    await browser.close();
})();