#Mintos.com Quality of Life application

##Motivation
**Problem:**
Mintos.com does not provide API and their session policy is very short. If you want to quickly check latest earnings 
and account balance, you have to open browser, go to their website, log in and only then you will be able to see info 
you are interested in.

**Solution:**
I have developed nodejs cron task that scrapes data from mintos.com dashboard every 15 minutes and saves it in laravel 
app via POST request. Vue.js PWA app then uses laravel as data source and it can be installed on mobile phone like 
native app. Sessions persist much longer, so you are able to just click icon on your phone screen and quickly see how 
your portfolio is doing.