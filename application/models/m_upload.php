<?php


/*
 * m_upload.php
 * 
 * Copyright 2014 metamorph <metamorph@code-machine>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */


class M_upload extends MY_Model
{

	protected $_table_name 		= 'dsp_status_kirim_pengeluaran';
	protected $_primary_key 	= 'id_status_kirim_pengeluaran';
	protected $_order_by 		= 'id_status_kirim_pengeluaran';
	public $rules				= array(
					'upload'	=> array(
						'field'	=> 'upload_lpj',
						'label'	=> 'Upload Data',
						'rules'	=> 'trim|required|max_length[11]'
					)
	);
	
	// define must be paired with rules
	public function get_new()
	{
		// define and instantiate
		$upload = new stdClass();
		
		$upload->upload_lpj		= '';
		return $upload;
	}
	
	
	public function get_uploaded($id_ref_kppn, $year, $month)
	{
		$query_pengeluaran = $this->db->select('ref_satker.id_ref_unit')
						  ->select('ref_satker.kd_satker')
						  ->select('ref_satker.no_karwas')
						  ->select('dsp_status_kirim_pengeluaran.id_status_kirim_pengeluaran')
						  ->select('dsp_status_kirim_pengeluaran.tahun')
						  ->select('dsp_status_kirim_pengeluaran.bulan')
						  ->select('dsp_status_kirim_pengeluaran.timestamp')
						  ->select('dsp_status_kirim_pengeluaran.pos_kirim')
						  ->from('ref_satker')
						  ->join('dsp_status_kirim_pengeluaran', 'ref_satker.id_ref_satker = dsp_status_kirim_pengeluaran.id_ref_satker', 'left')
						  ->where('dsp_status_kirim_pengeluaran.id_ref_kppn', $id_ref_kppn)
						  ->where('dsp_status_kirim_pengeluaran.tahun', $year)
						  ->where('dsp_status_kirim_pengeluaran.bulan', $month)
						  ->where('ref_satker.lpj_status_pengeluaran', 1)
						  ->order_by('dsp_status_kirim_pengeluaran.id_ref_satker')
						  ->order_by('dsp_status_kirim_pengeluaran.pos_kirim')
						  ->get();
	
		$query_penerimaan = $this->db->select('ref_satker.id_ref_unit')
						  ->select('ref_satker.kd_satker')
						  ->select('ref_satker.no_karwas')
						  ->select('dsp_status_kirim_penerimaan.id_status_kirim_penerimaan')
						  ->select('dsp_status_kirim_penerimaan.tahun')
						  ->select('dsp_status_kirim_penerimaan.bulan')
						  ->select('dsp_status_kirim_penerimaan.timestamp')
						  ->select('dsp_status_kirim_penerimaan.pos_kirim')
						  ->from('ref_satker')
						  ->join('dsp_status_kirim_penerimaan', 'ref_satker.id_ref_satker = dsp_status_kirim_penerimaan.id_ref_satker', 'left')
						  ->where('dsp_status_kirim_penerimaan.id_ref_kppn', $id_ref_kppn)
						  ->where('dsp_status_kirim_penerimaan.tahun', $year)
						  ->where('dsp_status_kirim_penerimaan.bulan', $month)
						  ->where('ref_satker.lpj_status_penerimaan', 1)
						  ->order_by('dsp_status_kirim_penerimaan.id_ref_satker')
						  ->order_by('dsp_status_kirim_penerimaan.pos_kirim')
						  ->get();
		
		$query_kirim_pengeluaran = $this->db->select('dsp_ba_lpjk.kd_satker')
									->select('dsp_ba_lpjk.tahun')
									->select('dsp_ba_lpjk.bulan')
									->select('dsp_ba_lpjk.updated_at')
									->from('dsp_ba_lpjk')
									->join('ref_kppn', 'dsp_ba_lpjk.kd_kppn = ref_kppn.kd_kppn', 'left')
									->where('ref_kppn.id_ref_kppn', $id_ref_kppn)
									->where('dsp_ba_lpjk.tahun', $year)
									->where('dsp_ba_lpjk.bulan', $month)
									->order_by('dsp_ba_lpjk.updated_at', 'desc')
									->get();
		
		$query_kirim_penerimaan = $this->db->select('dsp_ba_lpjp.kd_satker')
									->select('dsp_ba_lpjp.tahun')
									->select('dsp_ba_lpjp.bulan')
									->select('dsp_ba_lpjp.updated_at')
									->from('dsp_ba_lpjp')
									->join('ref_kppn', 'dsp_ba_lpjp.kd_kppn = ref_kppn.kd_kppn', 'left')
									->where('ref_kppn.id_ref_kppn', $id_ref_kppn)
									->where('dsp_ba_lpjp.tahun', $year)
									->where('dsp_ba_lpjp.bulan', $month)
									->group_by('dsp_ba_lpjp.kd_satker')
									->group_by('dsp_ba_lpjp.tahun')
									->group_by('dsp_ba_lpjp.bulan')
									->order_by('dsp_ba_lpjp.updated_at', 'desc')
									->get();
		
		return array(
			'query_pengeluaran'			=> $query_pengeluaran,
			'query_penerimaan'			=> $query_penerimaan,
			'query_kirim_pengeluaran'	=> $query_kirim_pengeluaran,
			'query_kirim_penerimaan'	=> $query_kirim_penerimaan
		);
		
		$query_pengeluaran->free_result();
		
	}
	
	public function validate_adk($kd_kppn, $kd_satker, $year, $month, $kd_buku = null)
	{
		// another database, kepegawaian's rekening DB
		$rekening_db = $this->load->database('rekening', TRUE);
		
		if ($kd_buku != null)
		{
			$kd_buku_penerimaan = " AND kd_buku = '{$kd_buku}' ";
		}
		else 
		{
			$kd_buku_penerimaan = "";
		}
		
		$validate_pengeluaran = $this->db->query("SELECT 
			a.kd_kppn, a.kd_satker, b.nm_satker, a.tahun, a.bulan, a.no_bukti,
			a.saldo_awal_tunai, a.debet_tunai, a.kredit_tunai, a.saldo_akhir_tunai,
			a.saldo_awal_bank, a.debet_bank, a.kredit_bank, a.saldo_akhir_bank,
			a.saldo_awal_bku, a.debet_bku, a.kredit_bku, a.saldo_akhir_bku,
			a.saldo_awal_um, a.debet_um, a.kredit_um, a.saldo_akhir_um,
			a.saldo_awal_bpp, a.debet_bpp, a.kredit_bpp, a.saldo_akhir_bpp,
			a.saldo_awal_up, a.debet_up, a.kredit_up, a.saldo_akhir_up, a.kuitansi_up,
			a.saldo_awal_lsbend, a.debet_lsbend, a.kredit_lsbend, a.saldo_akhir_lsbend,
			a.saldo_awal_pajak, a.debet_pajak, a.kredit_pajak, a.saldo_akhir_pajak,
			a.saldo_awal_lain, a.debet_lain, a.kredit_lain, a.saldo_akhir_lain,
			a.brankas, a.rekening_bank, a.saldo_up_uakpa, a.ket_selisih_kas, a.ket_selisih_up
				FROM
			dsp_ba_lpjk a
				LEFT JOIN 
			ref_satker b
				ON a.kd_satker = b.kd_satker
				WHERE 
			a.kd_kppn 	= '" .$kd_kppn. "' AND
			a.kd_satker	= '" .$kd_satker. "' AND
			a.tahun		= '" .$year. "' AND
			a.bulan		= '" .$month. "' 
				GROUP BY
			a.kd_kppn, a.kd_satker, a.tahun, a.bulan");
			
		$validate_penerimaan = $this->db->query("SELECT
			a.kd_kppn, a.kd_satker, b.nm_satker, a.tahun, a.bulan, a.kd_buku, a.nm_buku,
			a.saldo_awal, a.debet, a.kredit, a.saldo_akhir,
			a.no_bukti, a.brankas, a.kas_bank, a.hak_saldo_awal, a.hak_terima, a.hak_setor,
			a.setor, a.setor_uakpa, a.uakpa, a.ket_selisih_kas, a.ket_selisih_uakpa
				FROM
			dsp_ba_lpjp a
				LEFT JOIN
			ref_satker b
				ON a.kd_satker = b.kd_satker
				WHERE
			a.kd_kppn 	= {$kd_kppn} AND
			a.kd_satker	= {$kd_satker} AND
			a.tahun		= {$year} AND
			a.bulan		= {$month} {$kd_buku_penerimaan}
				GROUP BY
			a.kd_kppn, a.kd_satker, a.tahun, a.bulan, a.kd_buku, a.nm_buku");

		$int_month = (int) $month - 1;
		$month_before = sprintf("%02s", $int_month);
		
		// get data lpj pengeluaran 1 month before
		$validate_pengeluaran_1m = $this->db->query("SELECT
		kd_kppn, kd_satker, tahun, bulan, 
		saldo_akhir_tunai, saldo_akhir_bank, saldo_akhir_bku, saldo_akhir_um,
		saldo_akhir_bpp, saldo_akhir_up, saldo_akhir_lsbend, saldo_akhir_pajak,
		saldo_akhir_lain
			FROM
		dsp_ba_lpjk
			WHERE
		kd_kppn = {$kd_kppn} AND
		kd_satker = {$kd_satker} AND
		tahun = {$year} AND
		bulan = {$month_before}
				GROUP BY
		kd_kppn, kd_satker, tahun, bulan");
		
		// get data lpj penerimaan 1 month before
		$validate_penerimaan_1m = $this->db->query("SELECT
			a.kd_kppn, a.kd_satker, b.nm_satker, a.tahun, a.bulan, a.kd_buku, a.nm_buku,
			a.saldo_awal, a.debet, a.kredit, a.saldo_akhir,
			a.no_bukti, a.brankas, a.kas_bank, a.hak_saldo_awal, a.hak_terima, a.hak_setor,
			a.setor, a.setor_uakpa, a.uakpa, a.ket_selisih_kas, a.ket_selisih_uakpa
				FROM
			dsp_ba_lpjp a
				LEFT JOIN
			ref_satker b
				ON a.kd_satker = b.kd_satker
				WHERE
			a.kd_kppn 	= {$kd_kppn} AND
			a.kd_satker	= {$kd_satker} AND
			a.tahun		= {$year} AND
			a.bulan		= {$month_before} {$kd_buku_penerimaan}
				GROUP BY
			a.kd_kppn, a.kd_satker, a.tahun, a.bulan, a.kd_buku, a.nm_buku");
			
		// validate rekening
		// DB Silabun Pengeluaran
		$validate_rekening_pengeluaran_silabun = $this->db->query("SELECT kd_rekening, no_srt, tgl_srt, nm_bank, no_rekening, nm_rekening
			FROM 
				t_lpjkrek
			WHERE 
				kd_kppn 	= {$kd_kppn} AND
				kd_satker 	= {$kd_satker} AND
				tahun		= {$year} AND
				bulan		= {$month}
			ORDER BY 
				id_lpjkrek DESC LIMIT 1");
		// DB Sekretarian Rekening Pengeluaran
		$validate_rekening_pengeluaran_sekretariat = $rekening_db->query("SELECT a.type, a.izinnum, a.izindate, a.bankcab, a.reknum, a.reknama, b.idbank, b.nama
			FROM
				pbn_pkn.dt_rekening a
			LEFT JOIN 
				pbn_ref.ref_bank b
			ON
				a.idbank = b.idbank
			WHERE 
				a.kdsatker = {$kd_satker} AND
				a.type = '20' AND 
				a.active = 'y'");
		// DB Silabun Penerimaan
		$validate_rekening_penerimaan_silabun = $this->db->query("SELECT kd_rekening, no_srt, tgl_srt, nm_bank, no_rekening, nm_rekening
			FROM 
				t_lpjprek
			WHERE 
				kd_kppn 	= {$kd_kppn} AND
				kd_satker 	= {$kd_satker} AND
				tahun		= {$year} AND
				bulan		= {$month}
			ORDER BY 
				id_lpjprek DESC LIMIT 1");
		// DB Sekretarian Rekening Penerimaan
		$validate_rekening_penerimaan_sekretariat = $rekening_db->query("SELECT a.type, a.izinnum, a.izindate, a.bankcab, a.reknum, a.reknama, b.idbank, b.nama
			FROM
				pbn_pkn.dt_rekening a
			LEFT JOIN
				pbn_ref.ref_bank b
			ON 
				a.idbank = b.idbank
			WHERE 
				a.kdsatker = {$kd_satker} AND
				a.type = '10' AND 
				a.active = 'y'");
	
			
		return array (
			'validate_pengeluaran'		=> $validate_pengeluaran,
			'validate_penerimaan'		=> $validate_penerimaan,
			'validate_pengeluaran_1m'	=> $validate_pengeluaran_1m,
			'validate_penerimaan_1m'	=> $validate_penerimaan_1m,
			// rekening validation
			'validate_rekening_pengeluaran_silabun'		=> $validate_rekening_pengeluaran_silabun,
			'validate_rekening_pengeluaran_sekretariat'	=> $validate_rekening_pengeluaran_sekretariat,
			'validate_rekening_penerimaan_silabun'		=> $validate_rekening_penerimaan_silabun,
			'validate_rekening_penerimaan_sekretariat'	=> $validate_rekening_penerimaan_sekretariat
		);
	}
	
	public function import_csv($path, $tables)
	{
		
		$query = $this->db->query("LOAD DATA INFILE ? REPLACE INTO TABLE ".$tables." FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n'", array($path));
		
		return $query;
	}
	
	public function import_csv_rekening($path, $tables)
	{
		
		$query = $this->db->query("LOAD DATA INFILE ? REPLACE INTO TABLE ".$tables." FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n' 
		(id_dsp, kdsatker, nokarwas, kdrek, norek, nmrek, nmbank, nosrt, @tglsrt, saldo, kdbpp, kdkppn)
		SET tgsrt = STR_TO_DATE(@tglsrt, '%d-%m-%Y')", array($path));
		
		return $query;
		
	}
	
	public function import_csv_lpjp($path, $tables)
	{
		
		$query = $this->db->query("LOAD DATA INFILE ? REPLACE INTO TABLE ".$tables." FIELDS TERMINATED BY '|' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n'
		(no_ba, @tglba, tipe_ba, bulan, tahun, kd_kementerian, kd_unit, kd_kabkota, kd_lokasi, 
		kd_satker, no_karwas, update_ke, status, kd_kppn, no_rekening, @saldorekening, kd_buku, nm_buku,
		@kastunai, @kasbank, @setor, @belumsetor, @saldoakhirbku, no_bukti, @saldoawal, @debet, @kredit, 
		@saldoakhir, @brankas, @rekeningbank, @haksaldoawal, @hakterima, @haksetor, @setoruakpa, @uakpa, 
		@selisihkas, ket_selisih_kas, ket_selisih_uakpa, @tglakhirba, nip_kpa, nm_kpa, nip_bend, nm_bend,
		currency, @create)
		SET saldo_rekening = REPLACE(@saldorekening, ',', '.'),
			kas_tunai = REPLACE(@kastunai, ',', '.'),
			kas_bank = REPLACE(@kasbank, ',', '.'),
			setor = REPLACE(@setor, ',', '.'),
			belum_setor = REPLACE(@belumsetor, ',', '.'),
			saldo_akhir_bku = REPLACE(@saldoakhirbku, ',', '.'),
			saldo_awal = REPLACE(@saldoawal, ',', '.'),
			debet = REPLACE(@debet, ',', '.'),
			kredit = REPLACE(@kredit, ',', '.'),
			saldo_akhir = REPLACE(@saldoakhir, ',', '.'),
			brankas = REPLACE(@brankas, ',', '.'),
			rekening_bank = REPLACE(@rekeningbank, ',', '.'),
			hak_saldo_awal = REPLACE(@haksaldoawal, ',', '.'),
			hak_terima = REPLACE(@hakterima, ',', '.'),
			hak_setor = REPLACE(@haksetor, ',', '.'),
			setor_uakpa = REPLACE(@setoruakpa, ',', '.'),
			uakpa = REPLACE(@uakpa, ',', '.'),
			selisih_kas = REPLACE(@selisihkas, ',', '.'),
			tgl_ba = STR_TO_DATE(@tglba, '%d-%m-%Y'),
			tgl_akhir_ba = STR_TO_DATE(@tglakhirba, '%d-%m-%Y'),
			created_at = now()", array($path));
		
		return $query;
	}
	
	public function import_csv_rekening_lpjp($path, $tables)
	{
		$query = $this->db->query("LOAD DATA INFILE ? REPLACE INTO TABLE ".$tables." FIELDS TERMINATED BY '|' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n'
		(@kdsatker, no_karwas, no_ba, @tglba, tipe_ba, tahun, bulan, kd_rekening, update_ke, no_rekening,
		nm_rekening, nm_bank, no_srt, @tglsrt, saldo, alasan_pembukaan_rekening, keterangan, @tgltransaksiakhir)
		SET tgl_ba = STR_TO_DATE(@tglba, '%d-%m-%Y'),
			tgl_srt = STR_TO_DATE(@tglsrt, '%d-%m-%Y'),
			tgl_transaksi_akhir = STR_TO_DATE(@tgltransaksiakhir, '%d-%m-%Y'),
			kd_satker = @kdsatker,
			id_ref_satker = (SELECT id_ref_satker FROM ref_satker 
						WHERE kd_satker = @kdsatker),
			nm_satker = (SELECT nm_satker FROM ref_satker 
						WHERE kd_satker = @kdsatker),
			id_ref_kanwil = (SELECT b.id_ref_kanwil 
						FROM ref_satker a
						LEFT JOIN ref_kppn b
						ON a.id_ref_kppn = b.id_ref_kppn
						WHERE a.kd_satker = @kdsatker
						GROUP BY 1),
			id_ref_kppn = (SELECT id_ref_kppn FROM ref_satker
						WHERE kd_satker = @kdsatker),
			kd_kppn = (SELECT a.kd_kppn 
						FROM ref_kppn a
						LEFT JOIN ref_satker b
						ON a.id_ref_kppn = b.id_ref_kppn
						WHERE b.kd_satker = @kdsatker
						GROUP BY 1),
			nm_kppn = (SELECT a.nm_kppn 
						FROM ref_kppn a
						LEFT JOIN ref_satker b
						ON a.id_ref_kppn = b.id_ref_kppn
						WHERE b.kd_satker = @kdsatker
						GROUP BY 1),
			id_ref_unit = (SELECT id_ref_unit
						FROM ref_satker
						WHERE kd_satker = @kdsatker
						GROUP BY 1),
			kd_unit = (SELECT a.kd_unit
						FROM ref_unit a
						LEFT JOIN ref_satker b
						ON a.id_ref_unit = b.id_ref_unit
						WHERE b.kd_satker = @kdsatker
						GROUP BY 1),
			nm_unit = (SELECT a.nm_unit
						FROM ref_unit a
						LEFT JOIN ref_satker b
						ON a.id_ref_unit = b.id_ref_unit
						WHERE b.kd_satker = @kdsatker
						GROUP BY 1),
			id_ref_kementerian = (SELECT a.id_ref_kementerian
						FROM ref_unit a 
						LEFT JOIN ref_satker b
						ON a.id_ref_unit = b.id_ref_unit
						WHERE b.kd_satker = @kdsatker
						GROUP BY 1),
			kd_kementerian = (SELECT a.kd_kementerian
						FROM ref_kementerian a
						LEFT JOIN ref_unit b 
						ON a.id_ref_kementerian = b.id_ref_kementerian
						LEFT JOIN ref_satker c
						ON b.id_ref_unit = c.id_ref_unit
						WHERE c.kd_satker = @kdsatker
						GROUP BY 1),
			nm_kementerian = (SELECT a.nm_kementerian
						FROM ref_kementerian a
						LEFT JOIN ref_unit b 
						ON a.id_ref_kementerian = b.id_ref_kementerian
						LEFT JOIN ref_satker c
						ON b.id_ref_unit = c.id_ref_unit
						WHERE c.kd_satker = @kdsatker
						GROUP BY 1)", array($path));
			
		return $query;
	}
	
	public function import_csv_lpjk($path, $tables)
	{
		
		$query = $this->db->query("LOAD DATA INFILE ? REPLACE INTO TABLE ".$tables." FIELDS TERMINATED BY '\\t' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n'
		(jenis, no_ba, @tgba, kd_kementerian, kd_unit, kd_lokasi, kd_kabkota, kd_satker, kd_bpp,
		no_karwas, kd_dekon, kd_jendok, no_dok, @tgdok, tahun, kd_kppn, no_bukti, no_rekening,
		saldo_awal_tunai, debet_tunai, kredit_tunai, saldo_akhir_tunai, saldo_awal_bank, debet_bank,
		kredit_bank, saldo_akhir_bank, saldo_awal_bku, debet_bku, kredit_bku, saldo_awal_um, debet_um,
		kredit_um, saldo_akhir_um, saldo_awal_bpp, debet_bpp, kredit_bpp, saldo_akhir_bpp, saldo_awal_up,
		debet_up, kredit_up, saldo_akhir_up, saldo_awal_lsbend, debet_lsbend, kredit_lsbend,
		saldo_akhir_lsbend, saldo_awal_pajak, debet_pajak, kredit_pajak, saldo_akhir_pajak, saldo_akhir_bku,
		saldo_awal_lain, debet_lain, kredit_lain, saldo_akhir_lain, saldo_up, kuitansi_up, brankas,
		rekening_bank, saldo_up_uakpa, selisih_up, selisih_kas, ket_selisih_kas, ket_selisih_up, bulan,
		@tglakhirba, nip_kpa, nm_kpa, nip_bend, nm_bend, nip_bend2, nm_bend2, encode, valc, @tglcreate,
		user_nip, @tgltransaksiakhir, @create)
		SET tgl_ba = STR_TO_DATE(@tgba, '%d-%m-%Y'),
			tgl_dok = STR_TO_DATE(@tgdok, '%d-%m-%Y'), 
			tgl_akhir_ba = STR_TO_DATE(@tglakhirba, '%d-%m-%Y'),
			tgl_create = STR_TO_DATE(@tglcreate, '%d-%m-%Y'),
			tgl_transaksi_akhir = STR_TO_DATE(@tgltransaksiakhir, '%d-%m-%Y'),
			created_at = now()", array($path));
		
		return $query;
	}
	
	public function import_csv_rekening_lpjk($path, $tables)
	{
		
		$query = $this->db->query("LOAD DATA INFILE ? REPLACE INTO TABLE ".$tables." FIELDS TERMINATED BY '\\t' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n'
		(@kdsatker, no_karwas, no_ba, @tglba, tipe_ba, tahun, bulan, kd_rekening, update_ke,
		no_rekening, nm_rekening, nm_bank, no_srt, @tglsrt, saldo, @tgltransaksiakhir)
		SET tgl_ba = STR_TO_DATE(@tglba, '%d-%m-%Y'),
			tgl_srt = STR_TO_DATE(@tglsrt, '%d-%m-%Y'),
			tgl_transaksi_akhir = STR_TO_DATE(@tgltransaksiakhir, '%d-%m-%Y'),
			kd_satker = @kdsatker,
			id_ref_satker = (SELECT id_ref_satker FROM ref_satker 
						WHERE kd_satker = @kdsatker),
			nm_satker = (SELECT nm_satker FROM ref_satker 
						WHERE kd_satker = @kdsatker),
			id_ref_kanwil = (SELECT b.id_ref_kanwil 
						FROM ref_satker a
						LEFT JOIN ref_kppn b
						ON a.id_ref_kppn = b.id_ref_kppn
						WHERE a.kd_satker = @kdsatker
						GROUP BY 1),
			id_ref_kppn = (SELECT id_ref_kppn FROM ref_satker
						WHERE kd_satker = @kdsatker),
			kd_kppn = (SELECT a.kd_kppn 
						FROM ref_kppn a
						LEFT JOIN ref_satker b
						ON a.id_ref_kppn = b.id_ref_kppn
						WHERE b.kd_satker = @kdsatker
						GROUP BY 1),
			nm_kppn = (SELECT a.nm_kppn 
						FROM ref_kppn a
						LEFT JOIN ref_satker b
						ON a.id_ref_kppn = b.id_ref_kppn
						WHERE b.kd_satker = @kdsatker
						GROUP BY 1),
			id_ref_unit = (SELECT id_ref_unit
						FROM ref_satker
						WHERE kd_satker = @kdsatker
						GROUP BY 1),
			kd_unit = (SELECT a.kd_unit
						FROM ref_unit a
						LEFT JOIN ref_satker b
						ON a.id_ref_unit = b.id_ref_unit
						WHERE b.kd_satker = @kdsatker
						GROUP BY 1),
			nm_unit = (SELECT a.nm_unit
						FROM ref_unit a
						LEFT JOIN ref_satker b
						ON a.id_ref_unit = b.id_ref_unit
						WHERE b.kd_satker = @kdsatker
						GROUP BY 1),
			id_ref_kementerian = (SELECT a.id_ref_kementerian
						FROM ref_unit a 
						LEFT JOIN ref_satker b
						ON a.id_ref_unit = b.id_ref_unit
						WHERE b.kd_satker = @kdsatker
						GROUP BY 1),
			kd_kementerian = (SELECT a.kd_kementerian
						FROM ref_kementerian a
						LEFT JOIN ref_unit b 
						ON a.id_ref_kementerian = b.id_ref_kementerian
						LEFT JOIN ref_satker c
						ON b.id_ref_unit = c.id_ref_unit
						WHERE c.kd_satker = @kdsatker
						GROUP BY 1),
			nm_kementerian = (SELECT a.nm_kementerian
						FROM ref_kementerian a
						LEFT JOIN ref_unit b 
						ON a.id_ref_kementerian = b.id_ref_kementerian
						LEFT JOIN ref_satker c
						ON b.id_ref_unit = c.id_ref_unit
						WHERE c.kd_satker = @kdsatker
						GROUP BY 1)
						", array($path));
			
		return $query;
	}
	
	public function get_status_sent_satker($id_ref_kppn, $year, $month)
	{
		$query_pengeluaran_unsent = $this->db->query("SELECT `dsp_status_kirim_pengeluaran`.`tahun`,
					`dsp_status_kirim_pengeluaran`.`bulan`,`dsp_status_kirim_pengeluaran`.`pos_kirim`,
					 count(*) as jml_lpj
				FROM `ref_satker`
				LEFT JOIN `dsp_status_kirim_pengeluaran` 
				ON `ref_satker`.`id_ref_satker` = `dsp_status_kirim_pengeluaran`.`id_ref_satker` 
				WHERE `dsp_status_kirim_pengeluaran`.`id_ref_kppn` = ".$id_ref_kppn."
				AND `dsp_status_kirim_pengeluaran`.`tahun` is null
				AND `dsp_status_kirim_pengeluaran`.`bulan` is null
				AND `dsp_status_kirim_pengeluaran`.`pos_kirim` is null
				AND `ref_satker`.`lpj_status_pengeluaran` = 1
				GROUP BY  `dsp_status_kirim_pengeluaran`.`tahun`,
					`dsp_status_kirim_pengeluaran`.`bulan`");
					
		$query_pengeluaran_sent = $this->db->query("SELECT `dsp_status_kirim_pengeluaran`.`tahun`,
					`dsp_status_kirim_pengeluaran`.`bulan`, count(*) as jml_lpj
				FROM `ref_satker`
				LEFT JOIN `dsp_status_kirim_pengeluaran` 
				ON `ref_satker`.`id_ref_satker` = `dsp_status_kirim_pengeluaran`.`id_ref_satker` 
				WHERE `dsp_status_kirim_pengeluaran`.`id_ref_kppn` = ".$id_ref_kppn."
				AND `dsp_status_kirim_pengeluaran`.`tahun` = '".$year."'
				AND `dsp_status_kirim_pengeluaran`.`bulan` = '".$month."'
				AND `dsp_status_kirim_pengeluaran`.`pos_kirim` = 'K'
				AND `ref_satker`.`lpj_status_pengeluaran` = 1
				GROUP BY  `dsp_status_kirim_pengeluaran`.`tahun`,
					`dsp_status_kirim_pengeluaran`.`bulan`");
		
		$query_pengeluaran_unsent->num_rows > 0 ? $query_pengeluaran_unsent_row = $query_pengeluaran_unsent->row() : $query_pengeluaran_unsent_row = 0;
		$query_pengeluaran_sent->num_rows > 0 ? $query_pengeluaran_sent_row = $query_pengeluaran_sent->row() : $query_pengeluaran_sent_row = 0;
		
		$query_penerimaan_unsent = $this->db->query("SELECT `dsp_status_kirim_penerimaan`.`tahun`,
					`dsp_status_kirim_penerimaan`.`bulan`,`dsp_status_kirim_penerimaan`.`pos_kirim`,
					 count(*) as jml_lpj
				FROM `ref_satker`
				LEFT JOIN `dsp_status_kirim_penerimaan` 
				ON `ref_satker`.`id_ref_satker` = `dsp_status_kirim_penerimaan`.`id_ref_satker` 
				WHERE `ref_satker`.`id_ref_kppn` = ".$id_ref_kppn."
				AND `dsp_status_kirim_penerimaan`.`tahun` is null
				AND `dsp_status_kirim_penerimaan`.`bulan` is null
				AND `dsp_status_kirim_penerimaan`.`pos_kirim` is null
				AND `ref_satker`.`lpj_status_penerimaan` = 1
				GROUP BY  `dsp_status_kirim_penerimaan`.`tahun`,
					`dsp_status_kirim_penerimaan`.`bulan`");
					
		$query_penerimaan_sent = $this->db->query("SELECT `dsp_status_kirim_penerimaan`.`tahun`,
					`dsp_status_kirim_penerimaan`.`bulan`, count(*) as jml_lpj
				FROM `ref_satker`
				LEFT JOIN `dsp_status_kirim_penerimaan` 
				ON `ref_satker`.`id_ref_satker` = `dsp_status_kirim_penerimaan`.`id_ref_satker` 
				WHERE `ref_satker`.`id_ref_kppn` = ".$id_ref_kppn."
				AND `dsp_status_kirim_penerimaan`.`tahun` = '".$year."'
				AND `dsp_status_kirim_penerimaan`.`bulan` = '".$month."'
				AND `dsp_status_kirim_penerimaan`.`pos_kirim` = 'P'
				AND `ref_satker`.`lpj_status_penerimaan` = 1
				GROUP BY  `dsp_status_kirim_penerimaan`.`tahun`,
					`dsp_status_kirim_penerimaan`.`bulan`");
					
		$query_penerimaan_unsent->num_rows > 0 ? $query_penerimaan_unsent_row = $query_penerimaan_unsent->row() : $query_penerimaan_unsent_row = 0;
		$query_penerimaan_sent->num_rows > 0 ? $query_penerimaan_sent_row = $query_penerimaan_sent->row() : $query_penerimaan_sent_row = 0;
		
		return array(
			'query_pengeluaran_unsent' => $query_pengeluaran_unsent_row,
			'query_pengeluaran_sent' => $query_pengeluaran_sent_row,
			'query_penerimaan_unsent' => $query_penerimaan_unsent_row,
			'query_penerimaan_sent' => $query_penerimaan_sent_row,
		);
		
	}
}
