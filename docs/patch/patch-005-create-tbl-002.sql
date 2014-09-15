CREATE TABLE IF NOT EXISTS `dsp_transaksi_penerimaan` (
  `id_transaksi_penerimaan` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_status_kirim_penerimaan` int(10) unsigned NOT NULL,
  `kas_tunai` bigint(20) unsigned NOT NULL,
  `kas_bank` bigint(20) unsigned NOT NULL,
  `penerimaan` bigint(20) unsigned NOT NULL,
  `penyetoran` bigint(20) unsigned NOT NULL,
  `saldo_awal` bigint(20) unsigned NOT NULL,
  `saldo_akhir` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id_transaksi_penerimaan`),
  KEY `fk_dsp_transaksi_penerimaan_status_kirim_idx` (`id_status_kirim_penerimaan`),
  CONSTRAINT `fk_dsp_transaksi_penerimaan_status_kirim` FOREIGN KEY (`id_status_kirim_penerimaan`) REFERENCES `dsp_status_kirim_penerimaan` (`id_status_kirim_penerimaan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
