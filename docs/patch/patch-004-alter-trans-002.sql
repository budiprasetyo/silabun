ALTER TABLE `dsp_lpj`.`t_lpjp_refrek` 
CHANGE COLUMN `id` `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
ADD COLUMN `id_dsp` SMALLINT UNSIGNED NOT NULL AFTER `id`;
ALTER TABLE `dsp_lpj`.`t_lpjk_refrek` 
CHANGE COLUMN `id` `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
ADD COLUMN `id_dsp` SMALLINT UNSIGNED NOT NULL AFTER `id`;