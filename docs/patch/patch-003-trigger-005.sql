USE `dsp_lpj`;
DROP TRIGGER IF EXISTS `dsp_status_kirim_penerimaan_insert`;
DELIMITER $$
CREATE TRIGGER `dsp_status_kirim_penerimaan_insert` 
AFTER INSERT ON `dsp_status_kirim_penerimaan` 
FOR EACH ROW
BEGIN
	DECLARE kode_kanwil varchar(2);
	DECLARE nama_kanwil varchar(105);
	DECLARE kode_kppn varchar(3);
	DECLARE nama_kppn varchar(200);
	DECLARE id_referensi_kementerian smallint UNSIGNED;
	DECLARE kode_kementerian varchar(3);
	DECLARE nama_kementerian varchar(175);
	DECLARE kode_satker varchar(6);
	DECLARE nomor_karwas varchar(4);
	DECLARE nama_satker varchar(200);

	-- get kanwil
	SELECT DISTINCT kd_kanwil, nm_kanwil
		FROM ref_kanwil
		WHERE id_ref_kanwil = NEW.id_ref_kanwil
		GROUP BY kd_kanwil, nm_kanwil
	INTO kode_kanwil, nama_kanwil;

	-- get kppn
	SELECT DISTINCT kd_kppn, nm_kppn
		FROM ref_kppn
		WHERE id_ref_kppn = NEW.id_ref_kppn
		GROUP BY kd_kppn, nm_kppn
	INTO kode_kppn, nama_kppn;

	-- get kementerian
	SELECT DISTINCT a.id_ref_kementerian, a.kd_kementerian, a.nm_kementerian
		FROM ref_kementerian a
		LEFT JOIN ref_unit b
		ON a.id_ref_kementerian = b.id_ref_kementerian
		LEFT JOIN ref_satker c
		ON b.id_ref_unit = c.id_ref_unit
		WHERE c.id_ref_satker = NEW.id_ref_satker
		GROUP BY a.id_ref_kementerian, a.kd_kementerian, a.nm_kementerian
	INTO id_referensi_kementerian, kode_kementerian, nama_kementerian;

	-- get satker
	SELECT DISTINCT kd_satker, no_karwas, nm_satker
		FROM ref_satker
		WHERE id_ref_satker = NEW.id_ref_satker
		GROUP BY kd_satker, no_karwas, nm_satker
	INTO kode_satker, nomor_karwas, nama_satker;

	
	-- insert into report rekap lpjt
	INSERT INTO  `dsp_report_rekap_lpjt`
	SET id_status_kirim_penerimaan = NEW.id_status_kirim_penerimaan,
		id_ref_kanwil				= NEW.id_ref_kanwil,
		id_ref_kppn					= NEW.id_ref_kppn,
		id_ref_kementerian			= id_referensi_kementerian,
		id_ref_satker				= NEW.id_ref_satker,
		kd_kanwil					= kode_kanwil,
		nm_kanwil					= nama_kanwil,
		kd_kppn						= kode_kppn,
		nm_kppn						= nama_kppn,
		kd_kementerian				= kode_kementerian,
		nm_kementerian				= nama_kementerian,
		kd_satker					= kode_satker,
		no_karwas					= nomor_karwas,
		nm_satker					= nama_satker,
		tahun						= NEW.tahun,
		bulan						= NEW.bulan;

END$$
DELIMITER ;
