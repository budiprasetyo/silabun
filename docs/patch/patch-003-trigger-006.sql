USE `dsp_lpj`;
DROP TRIGGER IF EXISTS `dsp_transaksi_penerimaan_insert`;
DELIMITER $$
CREATE TRIGGER `dsp_transaksi_penerimaan_insert` 
AFTER INSERT ON `dsp_transaksi_penerimaan` 
FOR EACH ROW
	BEGIN
	
	UPDATE dsp_report_rekap_lpjt
	JOIN dsp_transaksi_penerimaan
	ON dsp_report_rekap_lpjt.id_status_kirim_penerimaan = dsp_transaksi_penerimaan.id_status_kirim_penerimaan
	SET dsp_report_rekap_lpjt.kas_tunai 		= dsp_transaksi_penerimaan.kas_tunai,
		dsp_report_rekap_lpjt.kas_bank			= dsp_transaksi_penerimaan.kas_bank,
		dsp_report_rekap_lpjt.penerimaan		= dsp_transaksi_penerimaan.penerimaan,
		dsp_report_rekap_lpjt.penyetoran		= dsp_transaksi_penerimaan.penyetoran,
		dsp_report_rekap_lpjt.saldo_awal		= dsp_transaksi_penerimaan.saldo_awal,
		dsp_report_rekap_lpjt.saldo_akhir		= dsp_transaksi_penerimaan.saldo_akhir
	WHERE dsp_report_rekap_lpjt.id_status_kirim_penerimaan = NEW.id_status_kirim_penerimaan;
	

	END$$

DELIMITER ;
