ALTER TABLE `dsp_lpj`.`t_lpjprek` 
DROP INDEX `unique_lpjprek` ,
ADD UNIQUE INDEX `unique_lpjprek` (`kd_satker` ASC, `tahun` ASC, `bulan` ASC, `no_rekening` ASC);

ALTER TABLE `dsp_lpj`.`t_lpjkrek` 
DROP INDEX `unique_lpjkrek` ,
ADD UNIQUE INDEX `unique_lpjkrek` (`kd_satker` ASC, `no_rekening` ASC, `tahun` ASC, `bulan` ASC);
