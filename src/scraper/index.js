const puppeteer = require('puppeteer');
const cron = require('node-cron');
const axios = require('axios');

cron.schedule('*/15 * * * *', () => {
    fetch();
});

async function fetch() {
    const browser = await puppeteer.launch({args: ['--no-sandbox', '--disable-setuid-sandbox']});
    const page = await browser.newPage();
    await page.goto(process.env.SCRAPER_MINTOS_LOGIN_URL);

    await page.waitForSelector('input[name=_username]');
    await page.type('input[name=_username]', process.env.SCRAPER_MINTOS_USERNAME);

    await page.waitForSelector('input[name="_password"]');
    await page.type('input[name="_password"]', process.env.SCRAPER_MINTOS_PASSWORD);

    await page.click('.account-login-btn');
    await page.waitForNavigation();

    await page.waitForSelector('#mintos-boxes');

    // scrape data;
    let data = {
        balance: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(1) > div > div.header > div').textContent),
        available_funds: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(1) > div > table > tbody > tr:nth-child(1) > td:nth-child(2)').textContent),
        annual_return: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(2) > div > div.header > div').textContent),
        total_profit: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(2) > div > table > tbody > tr.em > td:nth-child(2)').textContent),
        investments: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(3) > div > div.header > div').textContent),
        investments_current: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(3) > div > ul > li:nth-child(1) > table > tbody > tr:nth-child(1) > td:nth-child(2)').textContent),
        investments_grace_period: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(3) > div > ul > li:nth-child(1) > table > tbody > tr:nth-child(2) > td:nth-child(2)').textContent),
        investments_1_15_late: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(3) > div > ul > li:nth-child(1) > table > tbody > tr:nth-child(3) > td:nth-child(2)').textContent),
        investments_16_30_late: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(3) > div > ul > li:nth-child(1) > table > tbody > tr:nth-child(4) > td:nth-child(2)').textContent),
        investments_31_60_late: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(3) > div > ul > li:nth-child(1) > table > tbody > tr:nth-child(5) > td:nth-child(2)').textContent),
        investments_61_late: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(3) > div > ul > li:nth-child(1) > table > tbody > tr:nth-child(6) > td:nth-child(2)').textContent),
        investments_default: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(3) > div > ul > li:nth-child(1) > table > tbody > tr:nth-child(7) > td:nth-child(2)').textContent),
        investments_bad_debt: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(3) > div > ul > li:nth-child(1) > table > tbody > tr:nth-child(8) > td:nth-child(2)').textContent),
        investments_total: await page.evaluate(() => document.querySelector('#mintos-boxes > li:nth-child(3) > div > ul > li:nth-child(1) > table > tbody > tr.em > td:nth-child(2)').textContent),
    };

    Object.keys(data).forEach((key) => {
        data[key] = sanitize(data[key]);
    });

    axios.post(`http://nginx/api/balances?api_token=${process.env.USER_API_TOKEN}`, data)
        .then(function (response) {
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });

    console.log(data);
    await browser.close();
}

/**
 * sanitize string
 * @param string
 * @returns {string}
 */
function sanitize(string) {
    return string
        .trim()
        .replace('(', '')
        .replace(')', '')
        .replace(" ", '')
        .replace('€', '')
        .replace('%', '')
        .replace(/ /g, '');
}

