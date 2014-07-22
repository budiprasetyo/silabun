RENAME TABLE `dsp_lpj`.`r_jabatan` TO `dsp_lpj`.`ref_jabatan`;
ALTER TABLE `dsp_lpj`.`ref_jabatan` 
CHANGE COLUMN `satker_id` `id_ref_satker` SMALLINT UNSIGNED NOT NULL ;
ALTER TABLE `dsp_lpj`.`ref_jabatan` 
CHANGE COLUMN `id` `id_ref_jabatan` SMALLINT UNSIGNED NOT NULL ;
ALTER TABLE `dsp_lpj`.`ref_jabatan` 
ADD INDEX `fk_ref_jabatan_satker_idx` (`id_ref_satker` ASC);
ALTER TABLE `dsp_lpj`.`ref_jabatan` 
ADD CONSTRAINT `fk_ref_jabatan_satker`
  FOREIGN KEY (`id_ref_satker`)
  REFERENCES `dsp_lpj`.`ref_satker` (`id_ref_satker`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;

CREATE TABLE `dsp_lpj`.`ref_pejabat` (
  `id_ref_pejabat` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_ref_jabatan` SMALLINT UNSIGNED NOT NULL,
  `nm_pejabat` VARCHAR(120) NOT NULL,
  PRIMARY KEY (`id_ref_pejabat`),
  INDEX `fk_ref_pejabat_jabatan_idx` (`id_ref_jabatan` ASC),
  CONSTRAINT `fk_ref_pejabat_jabatan`
    FOREIGN KEY (`id_ref_jabatan`)
    REFERENCES `dsp_lpj`.`ref_jabatan` (`id_ref_jabatan`)
    ON DELETE CASCADE
    ON UPDATE CASCADE);
ALTER TABLE `dsp_lpj`.`ref_jabatan` 
CHANGE COLUMN `id_ref_jabatan` `id_ref_jabatan` SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT ;

ALTER TABLE `dsp_lpj`.`ref_jabatan` 
CHANGE COLUMN `nama_jabatan` `nm_jabatan` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ;

