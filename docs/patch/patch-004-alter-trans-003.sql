ALTER TABLE `dsp_lpj`.`dsp_status_kirim_pengeluaran` 
ADD INDEX `idx_tahun_bulan_pengeluaran` (`tahun` ASC, `bulan` ASC);
ALTER TABLE `dsp_lpj`.`dsp_status_kirim_penerimaan` 
ADD INDEX `idx_tahun_bulan_penerimaan` (`tahun` ASC, `bulan` ASC);
