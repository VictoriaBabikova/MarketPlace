This project was created using symfony framework.
-------------------------------------------------

To use it, you need to clone this repository:

- git clone https://github.com/VictoriaBabikova/MarketPlace.git
----------------------------------------------------

---------------------------------------------------

after cloning the repository, you will have a folder with the MarketPlace project. You need to run:

- cd MarketPlace

and execute all the following commands there
---------------------------------------------------

-------------------------------------------------
to install all packages, you need to run:

- composer install 
-------------------------------------------------



-------------------------------------------------
then run

- yarn install

- yarn run dev

this will result in compilation of all dependencies.

-------------------------------------------------



------------------------------------------------

edit your .env file:

DATABASE_URL="mysql://admin:root@127.0.0.1:3306/exm_name?serverVersion=8&charset=utf8mb4"

exm_name in .env file is new name yors db

to work with the database, you need to create a new database, for example in phpMyAdmin or run 

- php bin/console doctrine:database:create

------------------------------------------------

-----------------------------------------------
then make migration to db

php bin/console doctrine:migration:migrate

If after this command you see an error:

--- PHP Fatal error:  Uncaught LogicException: Symfony Runtime is missing. Try running "composer require symfony/runtime". in /var/www/example/MarketPlace/bin/console:8
Stack trace:
#0 {main}
  thrown in /var/www/example/MarketPlace/bin/console on line 8

Fatal error: Uncaught LogicException: Symfony Runtime is missing. Try running "composer require symfony/runtime". in /var/www/example/MarketPlace/bin/console on line 8

LogicException: Symfony Runtime is missing. Try running "composer require symfony/runtime". in /var/www/example/MarketPlace/bin/console on line 8

Call Stack:
    0.0002     397016   1. {main}() /var/www/example/MarketPlace/bin/console:0 ----

just run 

- composer require symfony/runtime

and try again 

- php bin/console doctrine:migration:migrate

----------------------------------------------

------------------------------------------------
to save dummy data in the database

- php bin/console doctrine:fixtures:load

Then you will get an error:

---------------------------------------------------------------------
  In Lorem.php line 95: (in a Faker lib)
                                                                     
  join(): Argument #2 ($array) must be of type ?array, string given 
 
--------------------------------------------------------------------- 

Don't worry, it's easy to fix. Just do it:

 return join($words, ' ') . '.'; ==>  return join(' ', $words) . '.';
 
 return join(static::sentences($nbSentences), ' '); ==> 
 
 return join($text, ''); ==> return join(' ', static::sentences($nbSentences));  
 
 Then try again 
 
- php bin/console doctrine:fixtures:load   

It is all. You can use this aplication                                                            

------------------------------------------------------------------
