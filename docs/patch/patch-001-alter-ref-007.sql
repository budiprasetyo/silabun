ALTER TABLE `dsp_lpj`.`ref_satker` 
CHANGE COLUMN `lpj_status` `lpj_status_pengeluaran` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' ;
ALTER TABLE `dsp_lpj`.`ref_satker` 
ADD COLUMN `lpj_status_penerimaan` TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 AFTER `lpj_status_pengeluaran`;
