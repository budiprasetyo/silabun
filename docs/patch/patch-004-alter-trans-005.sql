ALTER TABLE `dsp_lpj`.`dsp_report_rekap_lpjt` 
DROP FOREIGN KEY `fk_dsp_report_rekap_lpjt_status_kirim`;
ALTER TABLE `dsp_lpj`.`dsp_report_rekap_lpjt` 
DROP INDEX `fk_dsp_report_rekap_lpjt_status_kirim` ;

ALTER TABLE `dsp_lpj`.`dsp_report_rekap_lpjt` 
ADD COLUMN `id_ba_lpj` INT(11) UNSIGNED NULL AFTER `id_status_kirim_penerimaan`;

ALTER TABLE `dsp_lpj`.`dsp_report_rekap_lpjt` 
ADD COLUMN `id_ref_unit` SMALLINT(5) UNSIGNED NULL AFTER `id_ref_kementerian`,
ADD COLUMN `kd_unit` VARCHAR(2) NULL AFTER `nm_kementerian`,
ADD COLUMN `nm_unit` VARCHAR(70) NULL AFTER `kd_unit`,
ADD COLUMN `kd_buku` VARCHAR(2) AFTER `bulan`;
