# AKADEMISKA HUS - Web Development Assignment

<img src="https://media.giphy.com/media/5xtDarqCp0eomZaFJW8/giphy.gif" alt="AKADEMISKA HUS" width="100%">

## Assignment:
Design a website or application for Akademiska Hus.

## About the project
This project was built using Laravel and Vue.js together with Bootstrap 4.

- Progressive web app
- Fully responsive design - works on all devices
- All png:s optimised with ImageAlpha and ImageOptim
- All svg:s optimised with SVGOMG
- All php files fixed (php-cs-fixer) with the @PSR2 rule
- Passed StyleCI Analysis
[![StyleCI](https://github.styleci.io/repos/133127895/shield?branch=master)](https://github.styleci.io/repos/133127895)
- Tested in Chrome and Firefox

## Installation:
- Download or clone this repository
- Copy the `.env.example` to  `.env` and add your database credentials
- Run `npm install`
- Run `composer install`
- `php artisan key:generate`
- `php artisan serve`
- `php artisan migrate`
- Create a new user in your database with [`php artisan tinker`](https://laravel-news.com/laravel-tinker)
- ```php
    App\User::create(['name' => ‘YourName’, 'email' => ‘your@email.com’, 'password' => bcrypt(‘YourPassword’)]);
    ```
- You are ready to go!

## Creators:
- _Linus van der Putten (Digital Designer)_
- _William Buller (Digital Designer)_
- _Maximilian Heijbel Realm(Digital Designer)_
- _Albert Norberg (Web Developer)_
---
_YRGO, GÖTEBORG 2018_
