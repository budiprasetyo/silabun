ALTER TABLE `dsp_lpj`.`ref_jabatan` 
DROP FOREIGN KEY `fk_ref_jabatan_satker`;
ALTER TABLE `dsp_lpj`.`ref_jabatan` 
CHANGE COLUMN `id_ref_satker` `id_entities` TINYINT UNSIGNED NOT NULL ;
ALTER TABLE `dsp_lpj`.`ref_jabatan` 
ADD CONSTRAINT `fk_ref_jabatan_entities`
  FOREIGN KEY (`id_entities`)
  REFERENCES `dsp_lpj`.`entities` (`id_entities`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
ALTER TABLE `ref_pejabat` ADD COLUMN `id_ref_satker` SMALLINT UNSIGNED NOT NULL AFTER `id_ref_jabatan`;
ALTER TABLE `dsp_lpj`.`ref_pejabat` 
ADD INDEX `fk_ref_pejabat_satker_idx` (`id_ref_satker` ASC);
ALTER TABLE `dsp_lpj`.`ref_pejabat` 
ADD CONSTRAINT `fk_ref_pejabat_satker`
  FOREIGN KEY (`id_ref_satker`)
  REFERENCES `dsp_lpj`.`ref_satker` (`id_ref_satker`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
ALTER TABLE ref_jabatan MODIFY COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE ref_jabatan MODIFY COLUMN updated_at TIMESTAMP;
