<?php
/*
 * M_report.php
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




class M_report extends MY_Model
{
	public $rules				= array(
					'no_surat_teguran'	=> array(
						'field'	=> 'no_surat_teguran',
						'label'	=> 'Nomor Surat Teguran',
						'rules'	=> 'trim|required|max_length[75]'
					),
					'jml_lampiran'	=> array(
						'field'	=> 'jml_lampiran',
						'label'	=> 'Jumlah Lampiran',
						'rules'	=> 'trim|required|max_length[3]|is_natural|xss_clean'
					),
					'kd_satker'	=> array(
						'field'	=> 'kd_satker',
						'label'	=> 'Kode Satker',
						'rules'	=> 'trim|required|max_length[6]|xss_clean'
					),
					'tgl_lpj'	=> array(
						'field'	=> 'tgl_lpj',
						'label'	=> 'Tanggal LPJ Bendahara',
						'rules'	=> 'trim|required|max_length[10]'
					),
					'no_lpj'	=> array(
						'field'	=> 'no_lpj',
						'label'	=> 'Nomor LPJ Bendahara',
						'rules'	=> 'trim|required|max_length[75]'
					),
					'tgl_verifikasi'	=> array(
						'field'	=> 'tgl_verifikasi',
						'label'	=> 'Tanggal Verifikasi Dokumen',
						'rules'	=> 'trim|required|max_length[10]'
					),
					'no_verifikasi'	=> array(
						'field'	=> 'no_verifikasi',
						'label'	=> 'Nomor Verifikasi Dokumen',
						'rules'	=> 'trim|required|max_length[75]'
					),
					'nm_pejabat'	=> array(
						'field'	=> 'nm_pejabat',
						'label'	=> 'Nama Pejabat Penanda Tangan Surat Teguran',
						'rules'	=> 'trim|required|max_length[75]'
					),
					'nip_pejabat'	=> array(
						'field'	=> 'nip_pejabat',
						'label'	=> 'NIP Pejabat Penanda Tangan Surat Teguran',
						'rules'	=> 'trim|required|max_length[18]'
					)
	);
	
	/**
	 * @brief rekap_lpj_pengeluaran
	 * @param $id_ref_satker give limitation only it's own kppn or kanwil or pkn
	 * @param $year 
	 * @param $month 
	 * @param $is_kppn 
	 * @returns 
	 * 
	 * 
	 */
	public function rekap_lpj_pengeluaran($id_ref_satker = NULL, $year, $month, $is_kppn = FALSE)
	{
		if($is_kppn == FALSE)
		{
			// conditional for pkn else for kanwil
			if($id_ref_satker == NULL)
			{
				$where = "";
			}
			else
			{
				$where = " ref_kppn.id_ref_kanwil = ".$id_ref_satker." AND ";
			}
			
			$query_kanwil_pkn = $this->db->query("SELECT b.kd_kementerian, b.nm_kementerian, count(*) AS jml_lpj, 
									sum(dsp_transaksi_pengeluaran.uang_persediaan) AS uang_persediaan,
									sum(dsp_transaksi_pengeluaran.ls_bendahara) AS ls_bendahara,
									sum(dsp_transaksi_pengeluaran.pajak) AS pajak,
									sum(dsp_transaksi_pengeluaran.pengeluaran_lain) AS pengeluaran_lain,
									sum(
										dsp_transaksi_pengeluaran.uang_persediaan +
										dsp_transaksi_pengeluaran.ls_bendahara +
										dsp_transaksi_pengeluaran.pajak +
										dsp_transaksi_pengeluaran.pengeluaran_lain
										) AS saldo_kas,
									sum(dsp_transaksi_pengeluaran.saldo) AS saldo,
									sum(dsp_transaksi_pengeluaran.kuitansi) AS kuitansi,
									sum(
										dsp_transaksi_pengeluaran.saldo +
										dsp_transaksi_pengeluaran.kuitansi
										) AS saldo_penerimaan
								FROM 
									dsp_status_kirim_pengeluaran
								LEFT JOIN ref_kanwil a 
									ON a.id_ref_kanwil = dsp_status_kirim_pengeluaran.id_ref_kanwil
								LEFT JOIN ref_kppn
									ON dsp_status_kirim_pengeluaran.id_ref_kppn = ref_kppn.id_ref_kppn
								LEFT JOIN (
									SELECT ref_kementerian.kd_kementerian, ref_kementerian.nm_kementerian, ref_satker.id_ref_satker, ref_satker.kd_satker, ref_satker.nm_satker
										FROM ref_satker
										LEFT JOIN ref_unit
										ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
											LEFT JOIN ref_kementerian
											ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
								) b ON b.id_ref_satker = dsp_status_kirim_pengeluaran.id_ref_satker
								LEFT JOIN dsp_transaksi_pengeluaran
									ON dsp_status_kirim_pengeluaran.id_status_kirim_pengeluaran = dsp_transaksi_pengeluaran.id_status_kirim_pengeluaran
								WHERE " .$where. "dsp_status_kirim_pengeluaran.tahun = '".$year."'
								AND dsp_status_kirim_pengeluaran.bulan = '".$month."'
								GROUP BY a.kd_kanwil, b.kd_kementerian
								ORDER BY a.kd_kanwil, b.kd_kementerian");
			
			if($query_kanwil_pkn->num_rows() > 0)
			{
				return $query_kanwil_pkn->result();
				$query_kanwil_pkn->free_result();
			}
		}
		else if ($is_kppn == TRUE)
		{
			// query for kppn
			$query_kppn = $this->db->query("SELECT b.kd_kementerian, b.nm_kementerian, b.kd_satker, b.nm_satker, count(*) AS jml_lpj, 
					sum(dsp_transaksi_pengeluaran.uang_persediaan) AS uang_persediaan,
					sum(dsp_transaksi_pengeluaran.ls_bendahara) AS ls_bendahara,
					sum(dsp_transaksi_pengeluaran.pajak) AS pajak,
					sum(dsp_transaksi_pengeluaran.pengeluaran_lain) AS pengeluaran_lain,
					sum(
						dsp_transaksi_pengeluaran.uang_persediaan +
						dsp_transaksi_pengeluaran.ls_bendahara +
						dsp_transaksi_pengeluaran.pajak +
						dsp_transaksi_pengeluaran.pengeluaran_lain
						) AS saldo_kas,
					sum(dsp_transaksi_pengeluaran.saldo) AS saldo,
					sum(dsp_transaksi_pengeluaran.kuitansi) AS kuitansi,
					sum(
						dsp_transaksi_pengeluaran.saldo +
						dsp_transaksi_pengeluaran.kuitansi
						) AS saldo_penerimaan
				FROM 
					dsp_status_kirim_pengeluaran
				LEFT JOIN ref_kppn
					ON dsp_status_kirim_pengeluaran.id_ref_kppn = ref_kppn.id_ref_kppn
				LEFT JOIN (
					SELECT ref_kementerian.kd_kementerian, ref_kementerian.nm_kementerian, ref_satker.id_ref_satker, ref_satker.kd_satker, ref_satker.nm_satker
						FROM ref_satker
						LEFT JOIN ref_unit
						ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
							LEFT JOIN ref_kementerian
							ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
				) b ON b.id_ref_satker = dsp_status_kirim_pengeluaran.id_ref_satker
				LEFT JOIN dsp_transaksi_pengeluaran
					ON dsp_status_kirim_pengeluaran.id_status_kirim_pengeluaran = dsp_transaksi_pengeluaran.id_status_kirim_pengeluaran
				WHERE dsp_status_kirim_pengeluaran.id_ref_kppn = ".$id_ref_satker."
				AND dsp_status_kirim_pengeluaran.tahun = '".$year."'
				AND dsp_status_kirim_pengeluaran.bulan = '".$month."'
				GROUP BY b.kd_kementerian, b.kd_satker
				ORDER BY b.kd_kementerian, b.kd_satker");
				
			if($query_kppn->num_rows() > 0)
			{
				return $query_kppn->result();
				$query_kppn->free_result();
			}
		}
		
		
	}
	
	public function total_sum_lpj_pengeluaran($id_ref_satker = NULL, $year, $month, $is_kppn = FALSE)
	{
		if($is_kppn == FALSE)
		{
			// conditional for pkn else for kanwil
			if($id_ref_satker == NULL)
			{
				$where = "";
				$select = "";
				$group_by = "";
			}
			else
			{
				$where = " ref_kppn.id_ref_kanwil = ".$id_ref_satker." AND ";
				$select = " dsp_status_kirim_pengeluaran.id_ref_kanwil, ";
				$group_by = " GROUP BY dsp_status_kirim_pengeluaran.id_ref_kanwil ";
			}
			
			$query = $this->db->query("SELECT " . $select . " count(*) AS jml_lpj, 
				sum(dsp_transaksi_pengeluaran.uang_persediaan) AS uang_persediaan,
				sum(dsp_transaksi_pengeluaran.ls_bendahara) AS ls_bendahara,
				sum(dsp_transaksi_pengeluaran.pajak) AS pajak,
				sum(dsp_transaksi_pengeluaran.pengeluaran_lain) AS pengeluaran_lain,
				sum(
					dsp_transaksi_pengeluaran.uang_persediaan +
					dsp_transaksi_pengeluaran.ls_bendahara +
					dsp_transaksi_pengeluaran.pajak +
					dsp_transaksi_pengeluaran.pengeluaran_lain
					) AS saldo_kas,
				sum(dsp_transaksi_pengeluaran.saldo) AS saldo,
				sum(dsp_transaksi_pengeluaran.kuitansi) AS kuitansi,
				sum(
					dsp_transaksi_pengeluaran.saldo +
					dsp_transaksi_pengeluaran.kuitansi
					) AS saldo_penerimaan
			FROM 
				dsp_status_kirim_pengeluaran
			LEFT JOIN ref_kanwil a 
				ON a.id_ref_kanwil = dsp_status_kirim_pengeluaran.id_ref_kanwil
			LEFT JOIN ref_kppn
				ON dsp_status_kirim_pengeluaran.id_ref_kppn = ref_kppn.id_ref_kppn
			LEFT JOIN (
				SELECT ref_kementerian.kd_kementerian, ref_kementerian.nm_kementerian, ref_satker.id_ref_satker, ref_satker.kd_satker, ref_satker.nm_satker
					FROM ref_satker
					LEFT JOIN ref_unit
					ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
						LEFT JOIN ref_kementerian
						ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
			) b ON b.id_ref_satker = dsp_status_kirim_pengeluaran.id_ref_satker
			LEFT JOIN dsp_transaksi_pengeluaran
				ON dsp_status_kirim_pengeluaran.id_status_kirim_pengeluaran = dsp_transaksi_pengeluaran.id_status_kirim_pengeluaran
			WHERE " .$where. "dsp_status_kirim_pengeluaran.tahun = '".$year."'
			AND dsp_status_kirim_pengeluaran.bulan = '".$month."'
			".$group_by."");
			
			if($query->num_rows() > 0)
			{
				return $query->row();
				$query->free_result();
			}
		}
		else if ($is_kppn == TRUE)
		{
			$query = $this->db->query("SELECT ref_kppn.id_ref_kppn, 
				sum(dsp_transaksi_pengeluaran.uang_persediaan) AS uang_persediaan,
				sum(dsp_transaksi_pengeluaran.ls_bendahara) AS ls_bendahara,
				sum(dsp_transaksi_pengeluaran.pajak) AS pajak,
				sum(dsp_transaksi_pengeluaran.pengeluaran_lain) AS pengeluaran_lain,
				sum(
					dsp_transaksi_pengeluaran.uang_persediaan +
					dsp_transaksi_pengeluaran.ls_bendahara +
					dsp_transaksi_pengeluaran.pajak +
					dsp_transaksi_pengeluaran.pengeluaran_lain
					) AS saldo_kas,
				sum(dsp_transaksi_pengeluaran.saldo) AS saldo,
				sum(dsp_transaksi_pengeluaran.kuitansi) AS kuitansi,
				sum(
					dsp_transaksi_pengeluaran.saldo +
					dsp_transaksi_pengeluaran.kuitansi
					) AS saldo_penerimaan
			FROM 
				dsp_status_kirim_pengeluaran
			LEFT JOIN ref_kppn
				ON dsp_status_kirim_pengeluaran.id_ref_kppn = ref_kppn.id_ref_kppn
			LEFT JOIN (
				SELECT ref_kementerian.kd_kementerian, ref_kementerian.nm_kementerian, ref_satker.id_ref_satker, ref_satker.kd_satker, ref_satker.nm_satker
					FROM ref_satker
					LEFT JOIN ref_unit
					ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
						LEFT JOIN ref_kementerian
						ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
			) b ON b.id_ref_satker = dsp_status_kirim_pengeluaran.id_ref_satker
			LEFT JOIN dsp_transaksi_pengeluaran
				ON dsp_status_kirim_pengeluaran.id_status_kirim_pengeluaran = dsp_transaksi_pengeluaran.id_status_kirim_pengeluaran
			WHERE dsp_status_kirim_pengeluaran.id_ref_kppn = ".$id_ref_satker."
				AND dsp_status_kirim_pengeluaran.tahun = '".$year."'
				AND dsp_status_kirim_pengeluaran.bulan = '".$month."'
			GROUP BY ref_kppn.id_ref_kppn");
			
			if($query->num_rows() > 0)
			{
				return $query->row();
				$query->free_result();
			}
		}
	}

}
