USE `dsp_lpj`;
DROP TRIGGER IF EXISTS `d_lpjt_delete`;
DELIMITER $$
CREATE TRIGGER `d_lpjt_delete` 
AFTER DELETE ON `d_lpjt` 
FOR EACH ROW
BEGIN
		
		-- delete t_lpjp_refrek
		DELETE FROM `t_lpjp_refrek`
		WHERE kdsatker 	= OLD.kdsatker AND
			nokarwas 	= OLD.nokarwas AND
			kdkppn 		= OLD.kdkppn;

		-- delete dsp_status_kirim_penerimaan
		DELETE FROM `dsp_status_kirim_penerimaan`
		WHERE id_ref_satker = (
					SELECT id_ref_satker 
					FROM ref_satker 
					WHERE kd_satker = OLD.kdsatker
					);

END$$
DELIMITER ;
