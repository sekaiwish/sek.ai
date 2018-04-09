CREATE DATABASE sekai;
USE sekai;

CREATE TABLE users (
  id int(10) unsigned NOT NULL auto_increment,
  rank int(1) default '0',
  username varchar(16) NOT NULL,
  password char(60) NOT NULL,
  threads int(2) default '10',
  email varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE views (
  num int(10) unsigned NOT NULL auto_increment,
  ip varchar(15) default NULL,
  time timestamp default CURRENT_TIMESTAMP,
  PRIMARY KEY (num)
) ENGINE=InnoDB;

CREATE TABLE posts (
  id int(10) unsigned NOT NULL auto_increment,
  thread int(10) unsigned NOT NULL,
  op int(1) default '0',
  ip varchar(15) default NULL,
  name varchar(255) NOT NULL,
  time timestamp default CURRENT_TIMESTAMP,
  body varchar(2000) default NULL,
  filename varchar(255) default NULL,
  filetype varchar(255) default NULL,
  filesize varchar(7) default NULL,
  resolution varchar(15) default NULL,
  sticky int(1) default '0',
  PRIMARY KEY (id)
) ENGINE=InnoDB;
