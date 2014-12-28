USE `dsp_lpj`;
DROP TRIGGER IF EXISTS `d_lpjk_insert`;
DELIMITER $$
CREATE TRIGGER `d_lpjk_insert` 
AFTER INSERT ON `d_lpjk` FOR EACH ROW
BEGIN 

	DECLARE ref_kppn smallint UNSIGNED;
	DECLARE ref_kementerian smallint UNSIGNED;
	DECLARE ref_unit smallint UNSIGNED;
	DECLARE ref_lokasi smallint UNSIGNED;
	DECLARE ref_kabkota smallint UNSIGNED;
	DECLARE ref_satker smallint UNSIGNED;
	DECLARE ref_kanwil tinyint UNSIGNED;
	DECLARE fk_status_kirim_pengeluaran int UNSIGNED;

	
	SELECT DISTINCT id_ref_kppn FROM ref_kppn WHERE kd_kppn = NEW.kdkppn GROUP BY kd_kppn INTO ref_kppn;
	
	-- if kementerian not exist
	IF(SELECT COUNT(*) FROM ref_kementerian WHERE kd_kementerian = NEW.kddept) = 0 THEN
		
		INSERT INTO `ref_kementerian`
		SET kd_kementerian = NEW.kddept,
			nm_kementerian = '';
		
	END IF;
	
	-- if unit not exist
	IF(SELECT COUNT(*) 
		FROM ref_unit a
		RIGHT JOIN ref_kementerian b
			ON a.id_ref_kementerian = b.id_ref_kementerian
		WHERE b.kd_kementerian = NEW.kddept
			AND a.kd_unit = NEW.kdunit) = 0 THEN
			
			
			SELECT DISTINCT id_ref_kementerian FROM ref_kementerian WHERE kd_kementerian = NEW.kddept GROUP BY kd_kementerian INTO ref_kementerian;
			
			INSERT INTO `ref_unit`
			SET id_ref_kementerian 	= ref_kementerian,
				kd_unit				= NEW.kdunit,
				nm_unit				= '';
				
	END IF;
	
	-- if lokasi not exist
	IF(SELECT COUNT(*) FROM `ref_lokasi` WHERE kd_lokasi = SUBSTRING(NEW.kdlokasi,1,2)) = 0 THEN
	
		INSERT INTO `ref_lokasi`
		SET kd_lokasi = SUBSTRING(NEW.kdlokasi,1,2),
			nm_lokasi = '';
			
	END IF;
	

	-- if kabkota not exist
	IF(NOT EXISTS(SELECT kd_kabkota
			FROM ref_kabkota a
				LEFT JOIN ref_lokasi b
				ON a.id_lokasi = b.id_ref_lokasi
			WHERE b.kd_lokasi = SUBSTRING(NEW.kdlokasi,1,2)
				AND a.kd_kabkota = SUBSTRING(NEW.kdlokasi,3,2)
			GROUP BY a.kd_kabkota)) THEN
		
			
			SELECT DISTINCT id_ref_lokasi FROM ref_lokasi WHERE kd_lokasi = SUBSTRING(NEW.kdlokasi,1,2) INTO ref_lokasi;
				

			INSERT INTO `ref_kabkota`
				SET id_lokasi = ref_lokasi,
					kd_kabkota = SUBSTRING(NEW.kdlokasi,3,2),
					nm_kabkota = '';
			
	END IF;
	
	-- if satker not exist
	IF(SELECT COUNT(*) FROM `ref_satker` WHERE kd_satker = NEW.kdsatker AND no_karwas = NEW.nokarwas) = 0 THEN
		
		SELECT DISTINCT a.id_ref_unit
			FROM ref_unit a
				RIGHT JOIN ref_kementerian b
				ON a.id_ref_kementerian = b.id_ref_kementerian
			WHERE b.kd_kementerian = NEW.kddept
				AND a.kd_unit = NEW.kdunit
			GROUP BY b.kd_kementerian, a.kd_unit
		INTO ref_unit;
		
		SELECT DISTINCT a.id_ref_kabkota
			FROM ref_kabkota a
				RIGHT JOIN ref_lokasi b
				ON a.id_lokasi = b.id_ref_lokasi
			WHERE b.kd_lokasi = SUBSTRING(NEW.kdlokasi,1,2)
				AND a.kd_kabkota = SUBSTRING(NEW.kdlokasi,3,2)
			GROUP BY b.kd_lokasi, a.kd_kabkota
		INTO ref_kabkota;
		
		INSERT INTO `ref_satker`
		SET id_ref_unit 			= ref_unit, 
			id_ref_kabkota 			= 1, -- temporary variable
			id_ref_kppn				= ref_kppn,
			kd_satker				= NEW.kdsatker,
			no_karwas				= NEW.nokarwas,
			nm_satker				= '',
			aktif					= 1,
			lpj_status_pengeluaran	= 1,
			lpj_status_penerimaan	= 1;
	END IF;
	
	
	SELECT DISTINCT id_ref_satker FROM ref_satker WHERE kd_satker = NEW.kdsatker GROUP BY kd_satker INTO ref_satker;
	
	
	IF(SELECT COUNT(*) FROM `dsp_status_kirim_pengeluaran` WHERE id_ref_satker = ref_satker AND tahun = NEW.thang AND bulan = NEW.bulan) != 0 THEN
		DELETE FROM `dsp_status_kirim_pengeluaran` WHERE id_ref_satker = ref_satker AND tahun = NEW.thang AND bulan = NEW.bulan;
	END IF;
	
	
	SELECT DISTINCT id_ref_kanwil FROM ref_kanwil WHERE kd_kanwil = NEW.kdkanwil GROUP BY kd_kanwil INTO ref_kanwil;
	
		INSERT INTO `dsp_status_kirim_pengeluaran`
		SET id_ref_satker 	= ref_satker,
			id_ref_kppn		= ref_kppn,
			id_ref_kanwil	= ref_kanwil,
			tahun			= NEW.thang,
			bulan			= NEW.bulan,
			timestamp		= now(),
			pos_kirim		= 'K';
	
		SELECT SUM(auto_increment - 1) INTO fk_status_kirim_pengeluaran
			FROM information_schema.TABLES
			WHERE TABLE_NAME = 'dsp_status_kirim_pengeluaran'
			AND table_schema = DATABASE();
		
		INSERT INTO `dsp_transaksi_pengeluaran`
		SET id_status_kirim_pengeluaran 	= fk_status_kirim_pengeluaran,
			uang_persediaan 	= NEW.bpup,
			ls_bendahara	 	= NEW.bplsbdh,
			pajak	 			= NEW.bppjak,
			pengeluaran_lain	= NEW.bpplain,
			saldo_awal			= NEW.saldoawal,	
			saldo_akhir			= NEW.saldoakhir,	
			saldo				= NEW.saldo,	
			kuitansi			= NEW.kwitansi;	
	
	END$$
DELIMITER ;
