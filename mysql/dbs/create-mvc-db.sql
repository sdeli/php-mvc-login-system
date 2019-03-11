drop database if exists mvc;
create database mvc;
use mvc;

set @@explicit_defaults_for_timestamp = 1;

CREATE TABLE `users` (
  `user_id` mediumint auto_increment,
  `name` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `password_hash`char(255) NOT NULL,
  `is_activated` tinyint not null,
  `activation_token_hash` char(64),
  `user_created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  primary key (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

CREATE TABLE `temporary_passwords` (
  `user_id` mediumint not null,
  `tmp_password_hash` char(255) NOT NULL,
  `tmp_password_expiry` TIMESTAMP NOT NULL,
  foreign key (`user_id`) references `users` (`user_id`) 
  on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `remember_login_tokens` (
 `token_owner_id` mediumint  not null,
 `remember_token_hash` char(255) unique not null,
 `remember_token_expiry` TIMESTAMP NOT NULL,
  foreign key (`token_owner_id`) 
  references `users` (`user_id`)
  on update cascade 
  on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` char(255) NOT NULL,
  `body` text NOT NULL,
  `author` char(255) NOT NULL,
  `is_published` tinyint(1) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;