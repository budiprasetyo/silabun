ALTER TABLE t_lpjk_refrek ENGINE = InnoDB;
ALTER TABLE t_lpjp_refrek ENGINE = InnoDB;

CREATE TABLE `dsp_report_rekening_lpjk` (
  `id_report_rekening_lpjk` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_lpjk_refrek` int(10) unsigned NOT NULL,
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
  `no_rekening` varchar(45) NOT NULL,
  `nm_rekening` varchar(100) NOT NULL,
  `nm_bank` varchar(100) NOT NULL,
  `no_surat` varchar(75) NOT NULL,
  `tgl_surat` date NOT NULL,
  `saldo_rekening` bigint(20) unsigned NOT NULL,
  `kd_bpp` varchar(3) NOT NULL,
  PRIMARY KEY (`id_report_rekening_lpjk`),
  KEY `idx_tahun_bulan` (`tahun`,`bulan`),
  KEY `fk_dsp_report_rekening_lpjk_kanwil` (`id_ref_kanwil`),
  KEY `fk_dsp_report_rekening_lpjk_kementerian` (`id_ref_kementerian`),
  KEY `fk_dsp_report_rekening_lpjk_kppn` (`id_ref_kppn`),
  KEY `fk_dsp_report_rekening_lpjk_satker` (`id_ref_satker`),
  KEY `fk_dsp_report_rekening_lpjk_lpjk_refrek_idx` (`id_lpjk_refrek`),
  CONSTRAINT `fk_dsp_report_rekening_lpjk_kanwil` FOREIGN KEY (`id_ref_kanwil`) REFERENCES `ref_kanwil` (`id_ref_kanwil`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dsp_report_rekening_lpjk_kementerian` FOREIGN KEY (`id_ref_kementerian`) REFERENCES `ref_kementerian` (`id_ref_kementerian`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dsp_report_rekening_lpjk_kppn` FOREIGN KEY (`id_ref_kppn`) REFERENCES `ref_kppn` (`id_ref_kppn`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dsp_report_rekening_lpjk_lpjk_refrek` FOREIGN KEY (`id_lpjk_refrek`) REFERENCES `t_lpjk_refrek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dsp_report_rekening_lpjk_satker` FOREIGN KEY (`id_ref_satker`) REFERENCES `ref_satker` (`id_ref_satker`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `dsp_report_rekening_lpjt` (
  `id_report_rekening_lpjt` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_lpjt_refrek` int(10) unsigned NOT NULL,
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
  `no_rekening` varchar(45) NOT NULL,
  `nm_rekening` varchar(100) NOT NULL,
  `nm_bank` varchar(100) NOT NULL,
  `no_surat` varchar(75) NOT NULL,
  `tgl_surat` date NOT NULL,
  `saldo_rekening` bigint(20) unsigned NOT NULL,
  `kd_bpp` varchar(3) NOT NULL,
  PRIMARY KEY (`id_report_rekening_lpjt`),
  KEY `idx_tahun_bulan` (`tahun`,`bulan`),
  KEY `fk_dsp_report_rekening_lpjt_kanwil` (`id_ref_kanwil`),
  KEY `fk_dsp_report_rekening_lpjt_kementerian` (`id_ref_kementerian`),
  KEY `fk_dsp_report_rekening_lpjt_kppn` (`id_ref_kppn`),
  KEY `fk_dsp_report_rekening_lpjt_satker_idx` (`id_ref_satker`),
  KEY `fk_dsp_report_rekening_lpjt_lpjp_refrek_idx` (`id_lpjt_refrek`),
  CONSTRAINT `fk_dsp_report_rekening_lpjt_kanwil` FOREIGN KEY (`id_ref_kanwil`) REFERENCES `ref_kanwil` (`id_ref_kanwil`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dsp_report_rekening_lpjt_kementerian` FOREIGN KEY (`id_ref_kementerian`) REFERENCES `ref_kementerian` (`id_ref_kementerian`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dsp_report_rekening_lpjt_kppn` FOREIGN KEY (`id_ref_kppn`) REFERENCES `ref_kppn` (`id_ref_kppn`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dsp_report_rekening_lpjt_lpjp_refrek` FOREIGN KEY (`id_lpjt_refrek`) REFERENCES `t_lpjp_refrek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_dsp_report_rekening_lpjt_satker` FOREIGN KEY (`id_ref_satker`) REFERENCES `ref_satker` (`id_ref_satker`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
