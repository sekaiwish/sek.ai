# ![世界](https://gitlab.com/wishu/sek.ai/-/raw/master/sekai.ico) [sekai](https://sek.ai/)

## Requirements
- nginx
- PHP
- MySQL/MariaDB

## Installation
This will not cover installing nor setting up nginx, PHP or MariaDB.

(phpMyAdmin is recommended for ease. Just login and import the file.)

Interface with your database software and run the script at [DATABASE.sql](./DATABASE.sql), this will create the database and table(s) required.

Set up nginx by adjusting your existing nginx.conf file based on [nginx.conf.example](./nginx.conf.example), alternatively, this configuration file will work standalone as a barebones server assuming an Arch Linux installation.

Finally, create a file under [/php/](./php/) called `php.sql`, here you will enter the details for PHP to be able to login to your database. The file should look like this, containing a PDO object and a MySQLi object named `db` and `dbi` respectively;
```
<?php
$db = new PDO(
	"mysql:host=localhost;dbname=sekai",
	"root",
	"password"
);
$dbi = new mysqli(
	"localhost",
	"root",
	"password",
	"sekai"
);
```
Similar setup must be done under the /iku/ folder, though that is based on pomf and configuration is the same as the original project.

## About
Feel free to use pieces of this code within other projects, just don't rehost or copy files verbatim.
