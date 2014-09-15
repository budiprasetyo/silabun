INSERT INTO `dsp_report_rekap_lpjk`(
		id_status_kirim_pengeluaran,
		id_ref_kanwil,
		id_ref_kppn,
		id_ref_kementerian,
		id_ref_satker,
		kd_kanwil,
		nm_kanwil,
		kd_kppn,
		nm_kppn,
		kd_kementerian,
		nm_kementerian,
		kd_satker,
		no_karwas,
		nm_satker,
		tahun,
		bulan,
		uang_persediaan,
		ls_bendahara,
		pajak,
		pengeluaran_lain,
		saldo_awal,
		saldo_akhir,
		saldo,
		kuitansi
)
SELECT DISTINCT a.id_status_kirim_pengeluaran,
		a.id_ref_kanwil,
		a.id_ref_kppn,
		c.id_ref_kementerian,
		a.id_ref_satker,
		d.kd_kanwil,
		d.nm_kanwil,
		e.kd_kppn,
		e.nm_kppn,
		c.kd_kementerian,
		c.nm_kementerian,
		f.kd_satker,
		f.no_karwas,
		f.nm_satker,
		a.tahun,
		a.bulan,
		b.uang_persediaan,
		b.ls_bendahara,
		b.pajak,
		b.pengeluaran_lain,
		b.saldo_awal,
		b.saldo_akhir,
		b.saldo,
		b.kuitansi
	FROM dsp_status_kirim_pengeluaran a
		LEFT JOIN dsp_transaksi_pengeluaran b
		ON a.id_status_kirim_pengeluaran = b.id_status_kirim_pengeluaran
		LEFT JOIN (
			SELECT DISTINCT g.id_ref_kementerian, g.kd_kementerian, g.nm_kementerian, i.id_ref_satker
				FROM ref_kementerian g
				LEFT JOIN ref_unit h
				ON g.id_ref_kementerian = h.id_ref_kementerian
				LEFT JOIN ref_satker i
				ON h.id_ref_unit = i.id_ref_unit
			GROUP BY g.id_ref_kementerian, g.kd_kementerian, g.nm_kementerian, i.id_ref_satker
		) c
		ON a.id_ref_satker = c.id_ref_satker
		LEFT JOIN ref_kanwil d
		ON a.id_ref_kanwil = d.id_ref_kanwil
		LEFT JOIN ref_kppn e
		ON a.id_ref_kppn = e.id_ref_kppn
		LEFT JOIN ref_satker f
		ON a.id_ref_satker = f.id_ref_satker;
		
		
