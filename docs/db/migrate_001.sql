--
-- migrate table structure
--

CREATE TABLE `dsp_lpj`.`ref_lokasi` (
  `id_ref_lokasi` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `kd_lokasi` varchar(2) NOT NULL,
  `nm_lokasi` varchar(70) NOT NULL,
  PRIMARY KEY (`id_ref_lokasi`),
  UNIQUE KEY `kd_lokasi_UNIQUE` (`kd_lokasi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `dsp_lpj`.`ref_kabkota` (
  `id_ref_kabkota` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_lokasi` TINYINT UNSIGNED NOT NULL,
  `kd_kabkota` VARCHAR(2) NOT NULL,
  `nm_kabkota` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`id_ref_kabkota`),
  INDEX `fk_ref_kabkota_lokasi_idx` (`id_lokasi` ASC),
  CONSTRAINT `fk_ref_kabkota_lokasi`
    FOREIGN KEY (`id_lokasi`)
    REFERENCES `dsp_lpj`.`ref_lokasi` (`id_ref_lokasi`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE);
    
   
CREATE TABLE `dsp_lpj`.`ref_kanwil` (
  `id_ref_kanwil` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `id_ref_lokasi` tinyint(3) unsigned NOT NULL,
  `kd_kanwil` varchar(2) NOT NULL,
  `nm_kanwil` varchar(105) NOT NULL,
  `kd_satker_kanwil` varchar(6) NOT NULL,
  `almt_kanwil` varchar(200) DEFAULT NULL,
  `telp_kanwil` varchar(20) DEFAULT NULL,
  `fax_kanwil` varchar(20) DEFAULT NULL,
  `email_kanwil` varchar(45) DEFAULT NULL,
  `kdpos_kanwil` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id_ref_kanwil`),
  KEY `fk_ref_kanwil_lokasi_idx` (`id_ref_lokasi`),
  CONSTRAINT `fk_ref_kanwil_lokasi` FOREIGN KEY (`id_ref_lokasi`) REFERENCES `ref_lokasi` (`id_ref_lokasi`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    
CREATE TABLE `dsp_lpj`.`ref_kppn` (
  `id_ref_kppn` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_ref_kanwil` TINYINT UNSIGNED NOT NULL,
  `id_ref_kabkota` SMALLINT UNSIGNED NOT NULL,
  `kd_kppn` VARCHAR(3) NOT NULL,
  `nm_kppn` VARCHAR(200) NOT NULL,
  `kd_satker_kppn` VARCHAR(6) NOT NULL,
  `kd_bun_kppn` VARCHAR(6) NOT NULL,
  `tipe_kppn` VARCHAR(1) NOT NULL,
  `almt_kppn` VARCHAR(200) NULL,
  `telp_kppn` VARCHAR(20) NULL,
  `fax_kppn` VARCHAR(20) NULL,
  `email_kppn` VARCHAR(45) NULL,
  `kdpos_kppn` VARCHAR(5) NULL,
  PRIMARY KEY (`id_ref_kppn`),
  INDEX `fk_ref_kppn_kanwil_idx` (`id_ref_kanwil` ASC),
  INDEX `fk_ref_kppn_kabkota_idx` (`id_ref_kabkota` ASC),
  CONSTRAINT `fk_ref_kppn_kanwil`
    FOREIGN KEY (`id_ref_kanwil`)
    REFERENCES `dsp_lpj`.`ref_kanwil` (`id_ref_kanwil`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ref_kppn_kabkota`
    FOREIGN KEY (`id_ref_kabkota`)
    REFERENCES `dsp_lpj`.`ref_kabkota` (`id_ref_kabkota`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE);
    
CREATE TABLE `dsp_lpj`.`ref_kementerian` (
  `id_ref_kementerian` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `kd_kementerian` VARCHAR(3) NOT NULL,
  `nm_kementerian` VARCHAR(175) NOT NULL,
  PRIMARY KEY (`id_ref_kementerian`));
  
CREATE TABLE `dsp_lpj`.`ref_unit` (
  `id_ref_unit` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_ref_kementerian` SMALLINT UNSIGNED NOT NULL,
  `kd_unit` VARCHAR(2) NOT NULL,
  `nm_unit` VARCHAR(70) NOT NULL,
  PRIMARY KEY (`id_ref_unit`),
  INDEX `fk_ref_unit_kementerian_idx` (`id_ref_kementerian` ASC),
  CONSTRAINT `fk_ref_unit_kementerian`
    FOREIGN KEY (`id_ref_kementerian`)
    REFERENCES `dsp_lpj`.`ref_kementerian` (`id_ref_kementerian`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE);
    
CREATE TABLE `dsp_lpj`.`ref_satker` (
  `id_ref_satker` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_ref_unit` TINYINT UNSIGNED NOT NULL,
  `id_ref_kabkota` SMALLINT UNSIGNED NOT NULL,
  `id_ref_kppn` SMALLINT UNSIGNED NOT NULL,
  `kd_satker` VARCHAR(6) NOT NULL,
  `no_karwas` VARCHAR(4) NOT NULL,
  `kd_jns_satker` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `kd_satker_pusda` TINYINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_ref_satker`),
  INDEX `fk_ref_satker_unit_idx` (`id_ref_unit` ASC),
  INDEX `fk_ref_satker_kabkota_idx` (`id_ref_kabkota` ASC),
  INDEX `fk_ref_satker_kppn_idx` (`id_ref_kppn` ASC),
  CONSTRAINT `fk_ref_satker_unit`
    FOREIGN KEY (`id_ref_unit`)
    REFERENCES `dsp_lpj`.`ref_unit` (`id_ref_unit`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ref_satker_kabkota`
    FOREIGN KEY (`id_ref_kabkota`)
    REFERENCES `dsp_lpj`.`ref_kabkota` (`id_ref_kabkota`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ref_satker_kppn`
    FOREIGN KEY (`id_ref_kppn`)
    REFERENCES `dsp_lpj`.`ref_kppn` (`id_ref_kppn`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE);

