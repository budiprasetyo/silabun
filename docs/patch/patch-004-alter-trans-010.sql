ALTER TABLE `dsp_lpj`.`dsp_report_rekap_lpjt` 
CHANGE COLUMN `kas_tunai` `kas_tunai` DECIMAL(18,2) NOT NULL DEFAULT '0.00' ,
CHANGE COLUMN `kas_bank` `kas_bank` DECIMAL(18,2) NOT NULL DEFAULT '0.00' ,
CHANGE COLUMN `penerimaan` `penerimaan` DECIMAL(18,2) NOT NULL DEFAULT '0.00' ,
CHANGE COLUMN `penyetoran` `penyetoran` DECIMAL(18,2) NOT NULL DEFAULT '0.00' ,
CHANGE COLUMN `saldo_awal` `saldo_awal` DECIMAL(18,2) NOT NULL DEFAULT '0.00' ,
CHANGE COLUMN `saldo_akhir` `saldo_akhir` DECIMAL(18,2) NOT NULL DEFAULT '0.00' ;
