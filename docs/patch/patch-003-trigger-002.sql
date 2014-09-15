USE `dsp_lpj`;
DROP TRIGGER IF EXISTS `d_lpjk_insert`;
DELIMITER $$
CREATE TRIGGER `d_lpjk_insert` 
AFTER INSERT ON `d_lpjk` FOR EACH ROW
BEGIN 

	DECLARE ref_kppn smallint UNSIGNED;
	DECLARE ref_kementerian smallint UNSIGNED;
	DECLARE ref_unit smallint UNSIGNED;
	DECLARE ref_kabkota smallint UNSIGNED;
	DECLARE ref_satker smallint UNSIGNED;
	DECLARE ref_kanwil tinyint UNSIGNED;
	DECLARE fk_status_kirim_penerimaan int UNSIGNED;

	-- get id_ref_kppn
	SELECT id_ref_kppn FROM ref_kppn WHERE kd_kppn = NEW.kdkppn INTO ref_kppn;
	
	-- check whether ref_unit exists or not
	IF(SELECT COUNT(*) 
		FROM ref_unit a
		RIGHT JOIN ref_kementerian b
			ON a.id_ref_kementerian = b.id_ref_kementerian
		WHERE b.kd_kementerian = NEW.kddept
			AND a.kd_unit = NEW.kdunit) = 0 THEN
			
			-- get id_ref_kementerian
			SELECT id_ref_kementerian FROM ref_kementerian WHERE kd_kementerian = NEW.kddept INTO ref_kementerian;
			-- insert into ref_unit
			INSERT INTO `ref_unit`
			SET id_ref_kementerian 	= ref_kementerian,
				kd_unit				= NEW.kdunit,
				nm_unit				= '';
				
	END IF;

	-- check whether ref_satker exists or not
	IF(SELECT COUNT(*) FROM `ref_satker` WHERE kd_satker = NEW.kdsatker AND no_karwas = NEW.nokarwas) = 0 THEN
		
		-- get id_ref_unit
		SELECT a.id_ref_unit
			FROM ref_unit a
				RIGHT JOIN ref_kementerian b
				ON a.id_ref_kementerian = b.id_ref_kementerian
			WHERE b.kd_kementerian = NEW.kddept
				AND a.kd_unit = NEW.kdunit
		INTO ref_unit;
		-- get id_ref_kabkota
		SELECT a.id_ref_kabkota
			FROM ref_kabkota a
				RIGHT JOIN ref_lokasi b
				ON a.id_lokasi = b.id_ref_lokasi
			WHERE b.kd_lokasi = SUBSTRING(NEW.kdlokasi,1,2)
				AND a.kd_kabkota = SUBSTRING(NEW.kdlokasi,3,2)
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
	SELECT id_ref_satker FROM ref_satker WHERE kd_satker = NEW.kdsatker INTO ref_satker;
	
	-- check if data exists, delete it
	IF(SELECT COUNT(*) FROM `dsp_status_kirim_penerimaan` WHERE id_ref_satker = ref_satker AND tahun = NEW.thang AND bulan = NEW.bulan) != 0 THEN
		DELETE FROM `dsp_status_kirim_penerimaan` WHERE id_ref_satker = ref_satker AND tahun = NEW.thang AND bulan = NEW.bulan;
	END IF;

	-- get id_ref_kanwil
	SELECT id_ref_kanwil FROM ref_kanwil WHERE kd_kanwil = NEW.kdkanwil INTO ref_kanwil;
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
			kas_tunai 		= NEW.kastunai,
			kas_bank	 	= NEW.kasbank,
			penerimaan		= NEW.terima,
			penyetoran		= NEW.setor,
			saldo_awal		= NEW.saldoawal,	
			saldo_akhir		= NEW.saldoakhir;	
		
	END$$
DELIMITER ;
