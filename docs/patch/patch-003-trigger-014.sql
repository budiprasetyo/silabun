USE `dsp_lpj`;
DROP TRIGGER IF EXISTS `t_lpjp_refrek_insert`;
DELIMITER $$
CREATE TRIGGER `t_lpjp_refrek_insert` 
AFTER INSERT ON `t_lpjp_refrek` FOR EACH ROW
BEGIN 

	DECLARE ref_kppn smallint UNSIGNED;
	DECLARE ref_kanwil tinyint UNSIGNED;
	DECLARE ref_nm_kppn varchar(200);
	DECLARE ref_kd_kanwil varchar(2);
	DECLARE ref_nm_kanwil varchar(105);
	DECLARE ref_satker smallint UNSIGNED;
	DECLARE ref_no_karwas varchar(4);
	DECLARE ref_nm_satker varchar(200);
	DECLARE ref_unit smallint UNSIGNED;
	DECLARE ref_kementerian smallint UNSIGNED;
	DECLARE ref_kd_kementerian varchar(3);
	DECLARE ref_nm_kementerian varchar(175);
	DECLARE id_rekap_lpjt int UNSIGNED;
	DECLARE tahun_lpjt varchar(4);
	DECLARE bulan_lpjt varchar(2);

	-- get ref_kppn
	SELECT DISTINCT id_ref_kppn, id_ref_kanwil, nm_kppn FROM ref_kppn WHERE kd_kppn = NEW.kdkppn GROUP BY kd_kppn INTO ref_kppn, ref_kanwil, ref_nm_kppn;
	
	-- get ref_kanwil
	SELECT DISTINCT kd_kanwil, nm_kanwil FROM ref_kanwil WHERE id_ref_kanwil = ref_kanwil GROUP BY kd_kanwil INTO ref_kd_kanwil, ref_nm_kanwil;
	
	-- get ref_satker
	SELECT DISTINCT id_ref_satker, nm_satker, no_karwas, id_ref_unit FROM ref_satker WHERE kd_satker = NEW.kdsatker GROUP BY id_ref_satker INTO ref_satker, ref_nm_satker, ref_no_karwas, ref_unit;
	
	-- get ref_unit
	SELECT DISTINCT id_ref_kementerian FROM ref_unit WHERE id_ref_unit = ref_unit GROUP BY id_ref_kementerian INTO ref_kementerian;
	
	-- get ref_kementerian
	SELECT DISTINCT kd_kementerian, nm_kementerian FROM ref_kementerian WHERE id_ref_kementerian = ref_kementerian GROUP BY kd_kementerian INTO ref_kd_kementerian, ref_nm_kementerian;
	
	-- get bulan tahun
	SELECT DISTINCT id_report_rekap_lpjt, tahun, bulan FROM dsp_report_rekap_lpjt WHERE kd_kppn = NEW.kdkppn GROUP BY id_report_rekap_lpjt, tahun, bulan ORDER BY id_report_rekap_lpjt DESC LIMIT 1 INTO id_rekap_lpjt, tahun_lpjt, bulan_lpjt;
	
	
	INSERT INTO `dsp_report_rekening_lpjt`
	SET id_lpjt_refrek		= NEW.id,
		id_ref_kanwil		= ref_kanwil,
		id_ref_kppn 		= ref_kppn,
		id_ref_kementerian 	= ref_kementerian,
		id_ref_satker		= ref_satker,
		kd_kanwil			= ref_kd_kanwil,
		nm_kanwil			= ref_nm_kanwil,
		kd_kppn				= NEW.kdkppn,	
		nm_kppn				= ref_nm_kppn,	
		kd_kementerian		= ref_kd_kementerian,	
		nm_kementerian		= ref_nm_kementerian,	
		kd_satker			= NEW.kdsatker,	
		no_karwas			= ref_no_karwas,	
		nm_satker			= ref_nm_satker,	
		tahun				= tahun_lpjt,	
		bulan				= bulan_lpjt,	
		no_rekening			= NEW.norek,
		nm_rekening			= NEW.nmrek,
		nm_bank				= NEW.nmbank,
		no_surat			= NEW.nosrt,
		tgl_surat			= NEW.tgsrt,
		saldo_rekening		= NEW.saldo,
		kd_bpp				= NEW.kdbpp;	
		
	
	END$$
DELIMITER ;
