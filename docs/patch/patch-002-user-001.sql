CREATE TABLE `user_default` (
  `id_user_default` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` smallint(5) unsigned NOT NULL,
  `password` char(8) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_user_default`),
  KEY `fk_user_default_users_idx` (`id_users`),
  CONSTRAINT `fk_user_default_users` FOREIGN KEY (`id_users`) 
	REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
