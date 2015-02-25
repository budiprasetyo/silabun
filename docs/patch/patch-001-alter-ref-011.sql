ALTER TABLE `dsp_lpj`.`t_lpjkrek` 
ADD COLUMN `id_ref_unit` SMALLINT(5) UNSIGNED NULL AFTER `id_ref_kementerian`,
ADD COLUMN `kd_unit` VARCHAR(2) NULL AFTER `nm_kementerian`,
ADD COLUMN `nm_unit` VARCHAR(70) NULL AFTER `kd_unit`;

ALTER TABLE `dsp_lpj`.`t_lpjprek` 
ADD COLUMN `id_ref_unit` SMALLINT(5) UNSIGNED NULL AFTER `id_ref_kementerian`,
ADD COLUMN `kd_unit` VARCHAR(2) NULL AFTER `nm_kementerian`,
ADD COLUMN `nm_unit` VARCHAR(70) NULL AFTER `kd_unit`;
