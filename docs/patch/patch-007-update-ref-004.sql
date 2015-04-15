-- STEP 1
INSERT INTO `ref_history_satker`(
	id_ref_satker,
    tahun,
    bulan,
    aktif,
    lpj_status_pengeluaran,
    lpj_status_penerimaan,
    created_at)
    SELECT DISTINCT
		id_ref_satker,
		'2015',
		'01',
		aktif,
		lpj_status_pengeluaran,
		lpj_status_penerimaan,
        now()
    FROM `ref_satker`;

-- STEP 2 
UPDATE ref_history_satker a
	LEFT JOIN dsp_report_rekap_lpjk b
			ON a.id_ref_satker = b.id_ref_satker
			AND a.tahun = b.tahun
            AND a.bulan = b.bulan
    LEFT JOIN dsp_report_rekap_lpjt c
			ON a.id_ref_satker = c.id_ref_satker
            AND a.tahun = c.tahun
            AND a.bulan = c.bulan
	SET a.aktif = 
		CASE 
			WHEN (b.kd_satker OR c.kd_satker) is null THEN 0
        ELSE 1
		END,
	a.lpj_status_pengeluaran =  IF(b.id_ref_satker, 1, 0),
	a.lpj_status_penerimaan = IF(c.id_ref_satker, 1, 0);
