ALTER TABLE ref_kppn MODIFY COLUMN id_ref_satker smallint(5) unsigned not null default 0 after id_ref_kanwil;

UPDATE ref_kppn
SET id_ref_satker = (
	SELECT DISTINCT id_ref_satker	
		FROM ref_satker
		WHERE ref_satker.kd_satker = ref_kppn.kd_satker_kppn
		GROUP BY 1
);

ALTER TABLE `dsp_lpj`.`ref_kppn` 
ADD CONSTRAINT `fk_ref_kppn_satker`
  FOREIGN KEY (`id_ref_satker`)
  REFERENCES `dsp_lpj`.`ref_satker` (`id_ref_satker`)
  ON DELETE CASCADE
  ON UPDATE CASCADE;
