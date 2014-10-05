ALTER TABLE `dsp_lpj`.`ref_satker` 
CHANGE COLUMN `kd_jns_satker` `aktif` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' ,
CHANGE COLUMN `kd_satker_pusda` `lpj_status` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1' ;
