CREATE TABLE `dsp_lpj`.`ref_history_satker` (
  `id_ref_history_satker` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_ref_satker` SMALLINT(5) UNSIGNED NOT NULL,
  `tahun` VARCHAR(4) NOT NULL,
  `bulan` VARCHAR(2) NOT NULL,
  `aktif` TINYINT(1) UNSIGNED NOT NULL,
  `lpj_status_pengeluaran` TINYINT(1) UNSIGNED NOT NULL,
  `lpj_status_penerimaan` TINYINT(1) UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ref_history_satker`));

ALTER TABLE `dsp_lpj`.`ref_history_satker` 
ADD INDEX `fk_ref_history_satker_ref_satker_idx` (`id_ref_satker` ASC);
ALTER TABLE `dsp_lpj`.`ref_history_satker` 
ADD CONSTRAINT `fk_ref_history_satker_ref_satker`
  FOREIGN KEY (`id_ref_satker`)
  REFERENCES `dsp_lpj`.`ref_satker` (`id_ref_satker`)
  ON DELETE NO ACTION
  ON UPDATE CASCADE;
