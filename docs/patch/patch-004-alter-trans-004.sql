ALTER TABLE `dsp_lpj`.`t_lpjk_refrek` 
DROP COLUMN `id`,
DROP PRIMARY KEY,
ADD PRIMARY KEY (`kdsatker`),
DROP INDEX `idx_lpjk_refrek` ,
DROP INDEX `norek` ;

ALTER TABLE `dsp_lpj`.`dsp_report_rekening_lpjk` 
DROP FOREIGN KEY `fk_dsp_report_rekening_lpjk_lpjk_refrek`;
ALTER TABLE `dsp_lpj`.`dsp_report_rekening_lpjk` 
DROP COLUMN `id_lpjk_refrek`,
DROP INDEX `fk_dsp_report_rekening_lpjk_lpjk_refrek_idx` ;
