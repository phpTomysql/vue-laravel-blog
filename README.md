<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>


<p align="center"><a href="https://vuejs.org" target="_blank" rel="noopener noreferrer"><img width="100" src="https://vuejs.org/images/logo.png" alt="Vue logo"></a></p>

<p align="center">
  <a href="https://circleci.com/gh/vuejs/vue/tree/dev"><img src="https://img.shields.io/circleci/project/github/vuejs/vue/dev.svg?sanitize=true" alt="Build Status"></a>
  <a href="https://codecov.io/github/vuejs/vue?branch=dev"><img src="https://img.shields.io/codecov/c/github/vuejs/vue/dev.svg?sanitize=true" alt="Coverage Status"></a>
  <a href="https://npmcharts.com/compare/vue?minimal=true"><img src="https://img.shields.io/npm/dm/vue.svg?sanitize=true" alt="Downloads"></a>
  <a href="https://www.npmjs.com/package/vue"><img src="https://img.shields.io/npm/v/vue.svg?sanitize=true" alt="Version"></a>
  <a href="https://www.npmjs.com/package/vue"><img src="https://img.shields.io/npm/l/vue.svg?sanitize=true" alt="License"></a>
  <a href="https://chat.vuejs.org/"><img src="https://img.shields.io/badge/chat-on%20discord-7289da.svg?sanitize=true" alt="Chat"></a>
  <br>
  <a href="https://app.saucelabs.com/builds/50f8372d79f743a3b25fb6ca4851ca4c"><img src="https://app.saucelabs.com/buildstatus/vuejs" alt="Build Status"></a>
</p>



## Vue Blog

Vue Blog is a startup blog single page application with common features like sign up ,sign in ,posts & comments.
It's built in vue cli & laravel as backend.Database is MySql for data storage.

## Front End Setup

Let's start with front end vue first so for that we have to install node modules dependencies those we are using inside our application so first we have to run 

```
npm install
```

### Compiles and hot-reloads for development

Once all modules installed we can start the vue client server

```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Lints and fixes files
```
npm run lint
```

## Backend End Setup

We have server directory which will be serve as backend server and use laravel.Go inside server directory

```
cd server
```

Then edit the .env file according to your database settings & run composer install for install the laravel modules

```
composer install
```

Once composer install completed we will have to setup application related configuration setting.We are using passport for token based authentication for single page.

```
php artisan passport:install
```

Now we will have to run migration to setup database tables

```
php artisan migrate
```

That's it now everything is done time to run the laravel server so let's do it

```
php artisan serve
```
I m working on the other features like clap on post & admin panel to control the post etc.

## Hope you guys will learn from it.