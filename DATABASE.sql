CREATE DATABASE sekai;
USE sekai;

CREATE TABLE users (
  id int(10) unsigned NOT NULL auto_increment,
  rank int(1) default '0',
  username varchar(16) NOT NULL,
  password char(60) NOT NULL,
  email varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;
