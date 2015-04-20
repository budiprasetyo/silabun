CREATE DEFINER=`root`@`localhost` TRIGGER `dsp_lpj`.`dsp_ba_lpjp_AFTER_INSERT` 
AFTER INSERT ON `dsp_ba_lpjp` 
FOR EACH ROW
    BEGIN
    
		DECLARE ref_kppn smallint UNSIGNED;
		DECLARE ref_kementerian smallint UNSIGNED;
		DECLARE ref_unit smallint UNSIGNED;
		DECLARE ref_lokasi smallint UNSIGNED;
		DECLARE ref_kabkota smallint UNSIGNED;
		DECLARE ref_satker smallint UNSIGNED;
		DECLARE ref_kanwil tinyint UNSIGNED;
		DECLARE kode_kanwil varchar(2);
		DECLARE nama_kanwil varchar(105);
		DECLARE kode_kppn varchar(3);
		DECLARE nama_kppn varchar(200);
		DECLARE kode_satker varchar(6);
		DECLARE nomor_karwas varchar(4);
		DECLARE nama_satker varchar(200);
		DECLARE id_kementerian smallint UNSIGNED;
		DECLARE kode_kementerian varchar(3);
		DECLARE nama_kementerian varchar(175);
        DECLARE id_unit smallint UNSIGNED;
        DECLARE kode_unit VARCHAR(2);
        DECLARE nama_unit VARCHAR(70);
    
		-- get kppn data
		SELECT DISTINCT
			id_ref_kppn, kd_kppn, nm_kppn, id_ref_kanwil
		FROM
			ref_kppn
		WHERE
			kd_kppn = NEW.kd_kppn
		GROUP BY id_ref_kppn, kd_kppn, nm_kppn INTO ref_kppn, kode_kppn, nama_kppn, ref_kanwil;
		
        -- get kanwil data
        SELECT DISTINCT 
			kd_kanwil, nm_kanwil
		FROM 
			ref_kanwil
		WHERE 
			id_ref_kanwil = ref_kanwil
		GROUP BY kd_kanwil, nm_kanwil INTO kode_kanwil, nama_kanwil;
        
		-- if kementerian not exist
		IF(SELECT COUNT(*) FROM ref_kementerian WHERE kd_kementerian = NEW.kd_kementerian) = 0 THEN
			
			INSERT INTO `ref_kementerian`
			SET kd_kementerian = NEW.kd_kementerian,
				nm_kementerian = '';
			
		END IF;
        
        -- if unit not exist
		IF(SELECT COUNT(*) 
			FROM ref_unit a
			RIGHT JOIN ref_kementerian b
				ON a.id_ref_kementerian = b.id_ref_kementerian
			WHERE b.kd_kementerian = NEW.kd_kementerian
				AND a.kd_unit = NEW.kd_unit) = 0 THEN
				
				
				SELECT DISTINCT id_ref_kementerian FROM ref_kementerian WHERE kd_kementerian = NEW.kd_kementerian GROUP BY kd_kementerian INTO ref_kementerian;
				
				INSERT INTO `ref_unit`
				SET id_ref_kementerian 	= ref_kementerian,
					kd_unit				= NEW.kd_unit,
					nm_unit				= '';
					
		END IF;
        
		-- if lokasi not exist
		IF(SELECT COUNT(*) FROM `ref_lokasi` WHERE kd_lokasi = SUBSTRING(NEW.kd_lokasi,1,2)) = 0 THEN
		
			INSERT INTO `ref_lokasi`
			SET kd_lokasi = SUBSTRING(NEW.kd_lokasi,1,2),
				nm_lokasi = '';
				
		END IF;
        
        -- if kabkota not exist
		IF(NOT EXISTS(SELECT kd_kabkota
				FROM ref_kabkota a
					LEFT JOIN ref_lokasi b
					ON a.id_lokasi = b.id_ref_lokasi
				WHERE b.kd_lokasi = SUBSTRING(NEW.kd_lokasi,1,2)
					AND a.kd_kabkota = SUBSTRING(NEW.kd_lokasi,3,2)
				GROUP BY a.kd_kabkota)) THEN
        
        SELECT DISTINCT id_ref_lokasi FROM ref_lokasi WHERE kd_lokasi = SUBSTRING(NEW.kd_lokasi,1,2) GROUP BY kd_lokasi INTO ref_lokasi;
        	
		INSERT INTO `ref_kabkota`
			SET id_lokasi = ref_lokasi,
				kd_kabkota = SUBSTRING(NEW.kd_lokasi,3,2),
				nm_kabkota = '';
                
        END IF;
        
        -- if satker not exist
		IF(SELECT COUNT(*) FROM `ref_satker` WHERE kd_satker = NEW.kd_satker) = 0 THEN
	
			SELECT DISTINCT a.id_ref_unit
				FROM ref_unit a
					RIGHT JOIN ref_kementerian b
					ON a.id_ref_kementerian = b.id_ref_kementerian
				WHERE b.kd_kementerian = NEW.kd_kementerian
					AND a.kd_unit = NEW.kd_unit
				GROUP BY b.kd_kementerian, a.kd_unit
			INTO ref_unit;
            
			SELECT DISTINCT a.id_ref_kabkota
				FROM ref_kabkota a
					RIGHT JOIN ref_lokasi b
					ON a.id_lokasi = b.id_ref_lokasi
				WHERE b.kd_lokasi = SUBSTRING(NEW.kd_lokasi,1,2)
					AND a.kd_kabkota = SUBSTRING(NEW.kd_lokasi,3,2)
				GROUP BY b.kd_lokasi, a.kd_kabkota
			INTO ref_kabkota;
            
			INSERT INTO `ref_satker`
			SET id_ref_unit 			= ref_unit, 
				id_ref_kabkota 			= ref_kabkota,
				id_ref_kppn				= ref_kppn,
				kd_satker				= NEW.kd_satker,
				no_karwas				= '0001',
				nm_satker				= '',
				aktif					= 1,
				lpj_status_pengeluaran	= 0,
				lpj_status_penerimaan	= 1;
                
			       
			INSERT INTO `ref_history_satker` (
				id_ref_satker,
                tahun,
                bulan,
                aktif,
                lpj_status_pengeluaran,
                lpj_status_penerimaan,
                created_at )
			SELECT id_ref_satker, NEW.tahun, NEW.bulan, 1, 0, 1, now()
				FROM `ref_satker`
			ORDER BY id_ref_satker DESC
            LIMIT 1;
            
		END IF;
        
        -- check whether id_ref_kppn is different with ADK, if different change id_ref_kppn as ADK
        IF(SELECT COUNT(*) FROM `ref_satker` WHERE kd_satker = NEW.kd_satker AND id_ref_kppn != ref_kppn) > 0 THEN
        
			UPDATE ref_satker
			SET id_ref_kppn = ref_kppn
			WHERE kd_satker = NEW.kd_satker;
            
		END IF;
        
        -- get satker data
        SELECT DISTINCT id_ref_satker, kd_satker, no_karwas, nm_satker
			FROM ref_satker 
			WHERE kd_satker = NEW.kd_satker 
		GROUP BY kd_satker INTO ref_satker, kode_satker, nomor_karwas, nama_satker;
        
        -- get kementerian data
        SELECT DISTINCT id_ref_kementerian, kd_kementerian, nm_kementerian
			FROM ref_kementerian
            WHERE kd_kementerian = NEW.kd_kementerian
		GROUP BY kd_kementerian INTO id_kementerian, kode_kementerian, nama_kementerian;
        
        -- get unit data
        SELECT DISTINCT id_ref_unit, kd_unit, nm_unit
			FROM ref_unit
            WHERE id_ref_kementerian = id_kementerian
                AND kd_unit = NEW.kd_unit
		GROUP BY kd_unit INTO id_unit, kode_unit, nama_unit;
        
        
        IF(NEW.kd_buku = '02' OR NEW.kd_buku = '01') THEN 
        
			INSERT INTO dsp_report_rekap_lpjt
			SET id_ba_lpj			= NEW.id_ba_lpjp,
				id_ref_kanwil 		= ref_kanwil,
				id_ref_kppn			= ref_kppn,
				id_ref_kementerian	= id_kementerian,
				id_ref_unit			= id_unit,
				id_ref_satker		= ref_satker,
				kd_kanwil			= kode_kanwil,
				nm_kanwil			= nama_kanwil,
				kd_kppn				= kode_kppn,
				nm_kppn				= nama_kppn,
				kd_kementerian		= kode_kementerian,
				nm_kementerian		= nama_kementerian,
				kd_unit				= kode_unit,
				nm_unit				= nama_unit,
				kd_satker			= kode_satker,
				no_karwas			= '0001',
				nm_satker			= nama_satker,
				
				tahun				= NEW.tahun,
				bulan				= NEW.bulan,
				kd_buku				= NEW.kd_buku,
				kas_tunai			= NEW.kas_tunai,
				kas_bank			= NEW.kas_bank,
				penerimaan			= 0,
				penyetoran			= 0,
				saldo_awal			= NEW.saldo_awal,
				saldo_akhir			= NEW.saldo_akhir
				;
			
        END IF;
        
        UPDATE dsp_report_rekap_lpjt
        SET penerimaan = (SELECT DISTINCT SUM(debet) as debet
			FROM dsp_ba_lpjp
            WHERE kd_satker = kode_satker AND 
            tahun			= NEW.tahun AND
			bulan			= NEW.bulan AND
            kd_buku			!= '01' AND
            kd_buku			!= '02' AND
            kd_buku			!= '06'),
			penyetoran = (SELECT DISTINCT SUM(kredit) as kredit
			FROM dsp_ba_lpjp
            WHERE kd_satker = kode_satker AND 
            tahun			= NEW.tahun AND
			bulan			= NEW.bulan AND
            kd_buku			!= '01' AND
            kd_buku			!= '02' AND
            kd_buku			!= '06')
		WHERE kd_satker = kode_satker AND 
            tahun			= NEW.tahun AND
			bulan			= NEW.bulan;
            
            
		DELETE FROM dsp_report_rekap_lpjt 
		WHERE kd_buku != '02'
		AND tahun != '2014';
        
    END
