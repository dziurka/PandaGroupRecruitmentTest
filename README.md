# PandaGroupRecruitmentTest
Recruitment Test for Panda Group 

## Description
It is a simple application with user registration and functionality of notes.

The application is written in pure php (without any framework) compliant with PSR-4, PSR-7, PSR-11, and PSR-15 standards.

The libraries which I used: php-di, FastRoute, Relay, Zend Diactoros, and Narrowspark's HTTP Emitter.

## How to run
 
 ### Dependencies
    composer install
 ### Database
    mysql -u root -p database < database.sql
Configure database connection in `src/Repository/DB.php`
 ### Server
    php -S localhost:8080 -t public/
  
