ALTER TABLE `dsp_lpj`.`t_lpjkrek` 
ADD COLUMN `id_ref_kppn` SMALLINT(5) UNSIGNED NULL AFTER `id_lpjkrek`,
ADD COLUMN `id_ref_kementerian` SMALLINT(5) UNSIGNED NULL AFTER `id_ref_kppn`,
ADD COLUMN `id_ref_satker` SMALLINT(5) UNSIGNED NULL AFTER `id_ref_kementerian`,
ADD COLUMN `nm_satker` VARCHAR(200) NULL AFTER `kd_satker`,
ADD COLUMN `kd_kppn` VARCHAR(3) NULL AFTER `id_ref_satker`,
ADD COLUMN `nm_kppn` VARCHAR(200) NULL AFTER `kd_kppn`,
ADD COLUMN `kd_kementerian` VARCHAR(3) NULL AFTER `nm_kppn`,
ADD COLUMN `nm_kementerian` VARCHAR(175) NULL AFTER `kd_kementerian`;

ALTER TABLE `dsp_lpj`.`t_lpjprek` 
ADD COLUMN `id_ref_kppn` SMALLINT(5) UNSIGNED NULL AFTER `id_lpjprek`,
ADD COLUMN `id_ref_kementerian` SMALLINT(5) UNSIGNED NULL AFTER `id_ref_kppn`,
ADD COLUMN `id_ref_satker` SMALLINT(5) UNSIGNED NULL AFTER `id_ref_kementerian`,
ADD COLUMN `nm_satker` VARCHAR(200) NULL AFTER `kd_satker`,
ADD COLUMN `kd_kppn` VARCHAR(3) NULL AFTER `id_ref_satker`,
ADD COLUMN `nm_kppn` VARCHAR(200) NULL AFTER `kd_kppn`,
ADD COLUMN `kd_kementerian` VARCHAR(3) NULL AFTER `nm_kppn`,
ADD COLUMN `nm_kementerian` VARCHAR(175) NULL AFTER `kd_kementerian`;
