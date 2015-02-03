alter table `dsp_report_rekap_lpjk`
	add column `id_ba_lpj` int(11) unsigned DEFAULT NULL after `id_status_kirim_pengeluaran`,
	add column `id_ref_unit` smallint(5) unsigned DEFAULT NULL after `id_ref_kementerian`,
	add column `kd_unit` varchar(2) DEFAULT NULL after `nm_kementerian`,
	add column `nm_unit` varchar(70) DEFAULT NULL after `kd_unit`,
    change column `id_status_kirim_pengeluaran` `id_status_kirim_pengeluaran` int(10) unsigned DEFAULT NULL,
    drop index `fk_dsp_report_rekap_lpjk_status_kirim`,
    drop foreign key `fk_dsp_report_rekap_lpjk_status_kirim`;
