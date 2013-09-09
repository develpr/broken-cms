## Broken CMS Demo


### To install

Clone this git repository and point a virtual host (or whatever you want to do) at the /public/ directory. In other words, the web root of Laravel is always the /public directory (for security, plus it just makes sense).

You'll need to make sure that you have [installed composer](http://getcomposer.org/doc/00-intro.md#installation-nix) also.

Assuming you have `composer` installed, it's just a mtter of going to the root of the laravel install and typing

    composer install
  
Once that is done, the application is "installed" but you will need to setup the database and run the migrations/seeds:


### Database/migrations


First you need to create a database. I used these settings:

    database: brokencms
    username: bieber
    password: fever
    

Assuming that is setup, the last thing to do is actually install and run the migrations, which you do with these two commands:


    php artisan migrate:install
    php artisan migrate:refresh --seed
    
### Doing stuff


You should be able to login to the "CMS" at http://whateverdomainorlocalhostyouhavesetup/500



