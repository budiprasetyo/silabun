-- C1
ALTER TABLE `dsp_lpj`.`dsp_ba_lpjk` 
ADD COLUMN `tgl_transaksi_akhir` DATE NOT NULL AFTER `user_nip`;
-- C2
ALTER TABLE `dsp_lpj`.`t_lpjkrek` 
ADD COLUMN `tgl_transaksi_akhir` DATE NOT NULL AFTER `saldo`;
-- LPJ Penerimaan
ALTER TABLE `dsp_lpj`.`dsp_ba_lpjp` 
ADD COLUMN `currency` DECIMAL(18,2) NOT NULL DEFAULT '0.00' AFTER `nm_bend`;
-- Rekening Penerimaan
ALTER TABLE `dsp_lpj`.`t_lpjprek` 
ADD COLUMN `alasan_pembukaan_rekening` VARCHAR(200) NOT NULL AFTER `saldo`,
ADD COLUMN `keterangan` VARCHAR(200) NOT NULL AFTER `alasan_pembukaan_rekening`,
ADD COLUMN `tgl_transaksi_akhir` DATE NOT NULL AFTER `keterangan`;

