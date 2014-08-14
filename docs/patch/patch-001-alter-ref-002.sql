DELETE FROM `ref_satker`;

ALTER TABLE `ref_satker` AUTO_INCREMENT=1;

ALTER TABLE `ref_kementerian` ADD INDEX `idx_kd_kementerian` (`kd_kementerian`);

ALTER TABLE `ref_kppn` ADD COLUMN `id_ref_satker` smallint(5) unsigned NOT NULL,
  ADD INDEX `fk_ref_kppn_satker_idx` (`id_ref_satker`),
  ADD INDEX `idx_kd_kppn` (`kd_kppn`);

ALTER TABLE `ref_satker` MODIFY COLUMN `kd_satker_pusda` tinyint(3) unsigned NOT NULL DEFAULT '0';

--
-- Table structure for table `user_default`
--

DROP TABLE IF EXISTS `user_default`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_default` (
  `id_user_default` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_users` smallint(5) unsigned NOT NULL,
  `password` char(8) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_user_default`),
  KEY `fk_user_default_users_idx` (`id_users`),
  CONSTRAINT `fk_user_default_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
