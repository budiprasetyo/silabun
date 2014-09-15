CREATE TABLE IF NOT EXISTS `dsp_status_kirim_penerimaan` (
  `id_status_kirim_penerimaan` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_ref_satker` smallint(5) unsigned NOT NULL,
  `id_ref_kppn` smallint(5) unsigned NOT NULL,
  `id_ref_kanwil` tinyint(3) unsigned NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pos_kirim` varchar(1) NOT NULL,
  PRIMARY KEY (`id_status_kirim_penerimaan`),
  KEY `fk_status_kirim_rec_ref_satker_idx` (`id_ref_satker`),
  KEY `fk_status_kirim_rec_ref_kppn_idx` (`id_ref_kppn`),
  KEY `fk_dsp_status_kirim_penerimaan_ref_kanwil_idx` (`id_ref_kanwil`),
  CONSTRAINT `fk_dsp_status_kirim_penerimaan_ref_kanwil` FOREIGN KEY (`id_ref_kanwil`) REFERENCES `ref_kanwil` (`id_ref_kanwil`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_status_kirim_penerimaan_ref_kppn` FOREIGN KEY (`id_ref_kppn`) REFERENCES `ref_kppn` (`id_ref_kppn`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_status_kirim_penerimaan_ref_satker` FOREIGN KEY (`id_ref_satker`) REFERENCES `ref_satker` (`id_ref_satker`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
