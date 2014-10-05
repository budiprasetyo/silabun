-- ALL TRIGGERS FOR PENERIMAAN

USE `dsp_lpj`;
DROP TRIGGER IF EXISTS `d_lpjt_insert`;
DELIMITER $$
CREATE  TRIGGER `d_lpjt_insert` 
AFTER INSERT ON `d_lpjt` FOR EACH ROW
BEGIN 

	DECLARE ref_kppn smallint UNSIGNED;
	DECLARE ref_kementerian smallint UNSIGNED;
	DECLARE ref_unit smallint UNSIGNED;
	DECLARE ref_kabkota smallint UNSIGNED;
	DECLARE ref_satker smallint UNSIGNED;
	DECLARE ref_kanwil tinyint UNSIGNED;
	DECLARE fk_status_kirim_penerimaan int UNSIGNED;

	-- get id_ref_kppn
	SELECT DISTINCT id_ref_kppn FROM ref_kppn WHERE kd_kppn = NEW.kdkppn GROUP BY kd_kppn INTO ref_kppn;
	
	-- check whether ref_unit exists or not
	IF(SELECT COUNT(*) 
		FROM ref_unit a
		RIGHT JOIN ref_kementerian b
			ON a.id_ref_kementerian = b.id_ref_kementerian
		WHERE b.kd_kementerian = NEW.kddept
			AND a.kd_unit = NEW.kdunit) = 0 THEN
			
			-- get id_ref_kementerian
			SELECT DISTINCT id_ref_kementerian FROM ref_kementerian WHERE kd_kementerian = NEW.kddept GROUP BY kd_kementerian INTO ref_kementerian;
			-- insert into ref_unit
			INSERT INTO `ref_unit`
			SET id_ref_kementerian 	= ref_kementerian,
				kd_unit				= NEW.kdunit,
				nm_unit				= '';
				
	END IF;

	-- check whether ref_satker exists or not
	IF(SELECT COUNT(*) FROM `ref_satker` WHERE kd_satker = NEW.kdsatker AND no_karwas = NEW.nokarwas) = 0 THEN
		
		-- get id_ref_unit
		SELECT DISTINCT a.id_ref_unit
			FROM ref_unit a
				RIGHT JOIN ref_kementerian b
				ON a.id_ref_kementerian = b.id_ref_kementerian
			WHERE b.kd_kementerian = NEW.kddept
				AND a.kd_unit = NEW.kdunit
			GROUP BY b.kd_kementerian, a.kd_unit
		INTO ref_unit;
		-- get id_ref_kabkota
		SELECT DISTINCT a.id_ref_kabkota
			FROM ref_kabkota a
				RIGHT JOIN ref_lokasi b
				ON a.id_lokasi = b.id_ref_lokasi
			WHERE b.kd_lokasi = SUBSTRING(NEW.kdlokasi,1,2)
				AND a.kd_kabkota = SUBSTRING(NEW.kdlokasi,3,2)
			GROUP BY b.kd_lokasi, a.kd_kabkota
		INTO ref_kabkota;
		-- insert into ref_satker
		INSERT INTO `ref_satker`
		SET id_ref_unit 		= ref_unit, 
			id_ref_kabkota 		= ref_kabkota,
			id_ref_kppn			= ref_kppn,
			kd_satker			= NEW.kdsatker,
			no_karwas			= NEW.nokarwas,
			nm_satker			= '',
			kd_jns_satker		= 0,
			kd_satker_pusda		= 0;
	END IF;
	

	-- get id_ref_satker
	SELECT DISTINCT id_ref_satker FROM ref_satker WHERE kd_satker = NEW.kdsatker GROUP BY kd_satker INTO ref_satker;
	
	-- check if data exists, delete it
	IF(SELECT COUNT(*) FROM `dsp_status_kirim_penerimaan` WHERE id_ref_satker = ref_satker AND tahun = NEW.thang AND bulan = NEW.bulan) != 0 THEN
		DELETE FROM `dsp_status_kirim_penerimaan` WHERE id_ref_satker = ref_satker AND tahun = NEW.thang AND bulan = NEW.bulan;
	END IF;

	-- get id_ref_kanwil
	SELECT DISTINCT id_ref_kanwil FROM ref_kanwil WHERE kd_kanwil = NEW.kdkanwil GROUP BY kd_kanwil INTO ref_kanwil;
		-- insert into dsp_status_kirim_penerimaan
		INSERT INTO `dsp_status_kirim_penerimaan`
		SET id_ref_satker 	= ref_satker,
			id_ref_kppn		= ref_kppn,
			id_ref_kanwil	= ref_kanwil,
			tahun			= NEW.thang,
			bulan			= NEW.bulan,
			timestamp		= now(),
			pos_kirim		= 'P';
		-- get id from dsp_status_kirim_penerimaan with auto_increment - 1
		SELECT SUM(auto_increment - 1) INTO fk_status_kirim_penerimaan
			FROM information_schema.TABLES
			WHERE TABLE_NAME = 'dsp_status_kirim_penerimaan'
			AND table_schema = DATABASE();
		-- insert into dsp_transaksi_penerimaan
		INSERT INTO `dsp_transaksi_penerimaan`
		SET id_status_kirim_penerimaan 	= fk_status_kirim_penerimaan,
			kas_tunai 			= NEW.kastunai,
			kas_bank	 		= NEW.kasbank,
			penerimaan	 		= NEW.b42, -- from b42 field
			penyetoran			= NEW.b43, -- from b43 field
			saldo_awal			= NEW.b41, -- from b41 field	
			saldo_akhir			= NEW.saldoakhir;	
		
	END$$
DELIMITER ;

USE `dsp_lpj`;
DROP TRIGGER IF EXISTS `d_lpjt_delete`;
DELIMITER $$
CREATE TRIGGER `d_lpjt_delete` 
AFTER DELETE ON `d_lpjt` 
FOR EACH ROW
BEGIN
		
		
		DELETE FROM `t_lpjp_refrek`
		WHERE kdsatker 	= OLD.kdsatker AND
			nokarwas 	= OLD.nokarwas AND
			kdkppn 		= OLD.kdkppn;

		
		DELETE FROM `dsp_status_kirim_penerimaan`
		WHERE id_ref_satker = (
					SELECT id_ref_satker 
					FROM ref_satker 
					WHERE kd_satker = OLD.kdsatker
					);

END$$
DELIMITER ;

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


USE `dsp_lpj`;
DROP TRIGGER IF EXISTS `dsp_transaksi_penerimaan_insert`;
DELIMITER $$
CREATE TRIGGER `dsp_transaksi_penerimaan_insert` 
AFTER INSERT ON `dsp_transaksi_penerimaan` 
FOR EACH ROW
	BEGIN
	
	UPDATE dsp_report_rekap_lpjt
	JOIN dsp_transaksi_penerimaan
	ON dsp_report_rekap_lpjt.id_status_kirim_penerimaan = dsp_transaksi_penerimaan.id_status_kirim_penerimaan
	SET dsp_report_rekap_lpjt.kas_tunai 		= dsp_transaksi_penerimaan.kas_tunai,
		dsp_report_rekap_lpjt.kas_bank			= dsp_transaksi_penerimaan.kas_bank,
		dsp_report_rekap_lpjt.penerimaan		= dsp_transaksi_penerimaan.penerimaan,
		dsp_report_rekap_lpjt.penyetoran		= dsp_transaksi_penerimaan.penyetoran,
		dsp_report_rekap_lpjt.saldo_awal		= dsp_transaksi_penerimaan.saldo_awal,
		dsp_report_rekap_lpjt.saldo_akhir		= dsp_transaksi_penerimaan.saldo_akhir
	WHERE dsp_report_rekap_lpjt.id_status_kirim_penerimaan = NEW.id_status_kirim_penerimaan;
	

	END$$
DELIMITER ;
