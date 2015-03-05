ALTER TABLE `dsp_lpj`.`t_lpjkrek` 
ADD COLUMN `id_ref_kanwil` TINYINT(3) UNSIGNED NULL AFTER `id_lpjkrek`;
ALTER TABLE `dsp_lpj`.`t_lpjprek` 
ADD COLUMN `id_ref_kanwil` TINYINT(3) UNSIGNED NULL AFTER `id_lpjprek`;
