CREATE TABLE IF NOT EXISTS `dsp_report_rekap_lpjt` (
  `id_report_rekap_lpjt` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_status_kirim_penerimaan` int(10) unsigned NOT NULL,
  `id_ref_kanwil` tinyint(3) unsigned NOT NULL,
  `id_ref_kppn` smallint(5) unsigned NOT NULL,
  `id_ref_kementerian` smallint(5) unsigned NOT NULL,
  `id_ref_satker` smallint(5) unsigned NOT NULL,
  `kd_kanwil` varchar(2) NOT NULL,
  `nm_kanwil` varchar(105) NOT NULL,
  `kd_kppn` varchar(3) NOT NULL,
  `nm_kppn` varchar(200) NOT NULL,
  `kd_kementerian` varchar(3) NOT NULL,
  `nm_kementerian` varchar(175) NOT NULL,
  `kd_satker` varchar(6) NOT NULL,
  `no_karwas` varchar(4) NOT NULL,
  `nm_satker` varchar(200) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `kas_tunai` bigint(20) unsigned DEFAULT '0',
  `kas_bank` bigint(20) unsigned DEFAULT '0',
  `penerimaan` bigint(20) unsigned DEFAULT '0',
  `penyetoran` bigint(20) unsigned DEFAULT '0',
  `saldo_awal` bigint(20) unsigned DEFAULT '0',
  `saldo_akhir` bigint(20) unsigned DEFAULT '0',
  PRIMARY KEY (`id_report_rekap_lpjt`),
  KEY `fk_dsp_report_rekap_lpjt_status_kirim` (`id_status_kirim_penerimaan`),
  KEY `fk_dsp_report_rekap_lpjt_kanwil` (`id_ref_kanwil`),
  KEY `fk_dsp_report_rekap_lpjt_kppn` (`id_ref_kppn`),
  KEY `fk_dsp_report_rekap_lpjt_kementerian` (`id_ref_kementerian`),
  KEY `fk_dsp_report_rekap_lpjt_satker` (`id_ref_satker`),
  KEY `idx_tahun_bulan_lpjt` (`tahun`,`bulan`),
  CONSTRAINT `fk_dsp_report_rekap_lpjt_kanwil` FOREIGN KEY (`id_ref_kanwil`) REFERENCES `ref_kanwil` (`id_ref_kanwil`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dsp_report_rekap_lpjt_kementerian` FOREIGN KEY (`id_ref_kementerian`) REFERENCES `ref_kementerian` (`id_ref_kementerian`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dsp_report_rekap_lpjt_kppn` FOREIGN KEY (`id_ref_kppn`) REFERENCES `ref_kppn` (`id_ref_kppn`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dsp_report_rekap_lpjt_satker` FOREIGN KEY (`id_ref_satker`) REFERENCES `ref_satker` (`id_ref_satker`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dsp_report_rekap_lpjt_status_kirim` FOREIGN KEY (`id_status_kirim_penerimaan`) REFERENCES `dsp_status_kirim_penerimaan` (`id_status_kirim_penerimaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
