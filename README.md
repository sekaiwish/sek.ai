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

## About
Feel free to use pieces of this code within other projects, just don't rehost or copy files verbatim.
