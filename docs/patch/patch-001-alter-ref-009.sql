ALTER TABLE `dsp_lpj`.`ref_satker` 
ADD INDEX `idx_lpj_status_pengeluaran` (`lpj_status_pengeluaran` ASC),
ADD INDEX `idx_lpj_status_penerimaan` (`lpj_status_penerimaan` ASC);
