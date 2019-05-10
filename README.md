# Mintos.com Quality of Life application

## Motivation
**Problem:**
Mintos.com does not provide API and their session policy is very short. If you want to quickly check latest earnings 
and account balance, you have to open browser, go to their website, log in and only then you will be able to see info 
you are interested in.

**Solution:**
I have developed nodejs cron task that scrapes data from mintos.com dashboard every 15 minutes and saves it in laravel 
app via POST request. Vue.js PWA app then uses laravel as data source and it can be installed on mobile phone like 
native app. Sessions persist much longer, so you are able to just click icon on your phone screen and quickly see how 
your portfolio is doing.

## Installation
The whole application is dockerized and uses traefik as reverse proxy and ssl terminator

Copy `.env.sample` to `.env` in root directory and fill all variables with values such as your mintos.com login, 
database passwords, and default laravel configuration.

Initialize app with 
```bash
docker-compose pull
docker-compose up -d
```
Entrypoint scripts will handle composer installation and other dependencies.

After starting containers go into php container to create user
```bash
docker-compose exec php bash
```
and within container call mintos:create-user command
```bash
php artisan mintos:create-user
```

This will give you api token for `USER_API_TOKEN` environment variable used for scraper to communicate with laravel. 
Update .env file with token and restart docker containers with
```bash
docker-compose down
docker-compose up -d
```