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
		set_time_limit(0);
		
		if($is_kppn == FALSE)
		{
			// conditional for pkn else for kanwil
			if($id_ref_satker == NULL)
			{
				$where = " ";
				$group = " ";
			}
			else
			{
				$where = " id_ref_kanwil = ".$id_ref_satker." AND ";
				$group = " kd_kanwil, ";
			}
			
			$query_kanwil_pkn = $this->db->query("SELECT kd_kementerian, nm_kementerian, count(*) AS jml_lpj, 
									sum(uang_persediaan) AS uang_persediaan,
									sum(ls_bendahara) AS ls_bendahara,
									sum(pajak) AS pajak,
									sum(pengeluaran_lain) AS pengeluaran_lain,
									sum(saldo) AS saldo,
									sum(kuitansi) AS kuitansi
								FROM 
									dsp_report_rekap_lpjk
								WHERE " .$where. "tahun = '".$year."'
								AND bulan = '".$month."'
								GROUP BY " . $group . " kd_kementerian
								ORDER BY " . $group . " kd_kementerian");
			
			if($query_kanwil_pkn->num_rows() > 0)
			{
				return $query_kanwil_pkn->result();
				$query_kanwil_pkn->free_result();
			}
		}
		else if ($is_kppn == TRUE)
		{
			// query for kppn
			$query_kppn = $this->db->query("SELECT kd_kementerian, nm_kementerian, kd_satker, nm_satker, count(*) AS jml_lpj, 
					sum(uang_persediaan) AS uang_persediaan,
					sum(ls_bendahara) AS ls_bendahara,
					sum(pajak) AS pajak,
					sum(pengeluaran_lain) AS pengeluaran_lain,
					sum(saldo) AS saldo,
					sum(kuitansi) AS kuitansi
				FROM 
					dsp_report_rekap_lpjk
				WHERE id_ref_kppn = ".$id_ref_satker."
				AND tahun = '".$year."'
				AND bulan = '".$month."'
				GROUP BY kd_kementerian, kd_satker
				ORDER BY kd_kementerian, kd_satker");
				
			if($query_kppn->num_rows() > 0)
			{
				return $query_kppn;
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
				$where = " id_ref_kanwil = ".$id_ref_satker." AND ";
				$select = " id_ref_kanwil, ";
				$group_by = " GROUP BY id_ref_kanwil ";
			}
			
			$query = $this->db->query("SELECT " . $select . " count(*) AS jml_lpj, 
				sum(uang_persediaan) AS uang_persediaan,
				sum(ls_bendahara) AS ls_bendahara,
				sum(pajak) AS pajak,
				sum(pengeluaran_lain) AS pengeluaran_lain,
				sum(saldo) AS saldo,
				sum(kuitansi) AS kuitansi
			FROM 
				dsp_report_rekap_lpjk
			WHERE " .$where. " tahun = '".$year."'
			AND bulan = '".$month."'
			".$group_by."");
			
			if($query->num_rows() > 0)
			{
				return $query->row();
				$query->free_result();
			}
		}
		else if ($is_kppn == TRUE)
		{
			$query = $this->db->query("SELECT id_ref_kppn, 
				sum(uang_persediaan) AS uang_persediaan,
				sum(ls_bendahara) AS ls_bendahara,
				sum(pajak) AS pajak,
				sum(pengeluaran_lain) AS pengeluaran_lain,
				sum(saldo) AS saldo,
				sum(kuitansi) AS kuitansi
			FROM 
				dsp_report_rekap_lpjk
			WHERE id_ref_kppn = ".$id_ref_satker."
				AND tahun = '".$year."'
				AND bulan = '".$month."'
			GROUP BY id_ref_kppn");
			
			if($query->num_rows() > 0)
			{
				return $query->row();
				$query->free_result();
			}
		}
	}
	
	public function rekap_lpj_penerimaan($id_ref_satker = NULL, $year, $month, $is_kppn = FALSE)
	{
		set_time_limit(0);
		
		if($is_kppn == FALSE)
		{
			// conditional for pkn else for kanwil
			if($id_ref_satker == NULL)
			{
				$where = " ";
				$group = " ";
			}
			else
			{
				$where = " id_ref_kanwil = ".$id_ref_satker." AND ";
				$group = " kd_kanwil, ";
			}
			
			
			$query_kanwil_pkn = $this->db->query("SELECT kd_kementerian, nm_kementerian, count(*) AS jml_lpj, 
									sum(kas_tunai) AS kas_tunai,
									sum(kas_bank) AS kas_bank,
									sum(penerimaan) AS penerimaan,
									sum(penyetoran) AS penyetoran,
									sum(saldo_awal) AS saldo_awal,
									sum(saldo_akhir) AS saldo_akhir
								FROM 
									dsp_report_rekap_lpjt
								WHERE " .$where. "tahun = '".$year."'
								AND bulan = '".$month."'
								GROUP BY " . $group . " kd_kementerian
								ORDER BY " . $group . " kd_kementerian");
			
			if($query_kanwil_pkn->num_rows() > 0)
			{
				return $query_kanwil_pkn->result();
				$query_kanwil_pkn->free_result();
			}
		}
		else if ($is_kppn == TRUE)
		{
			// query for kppn
			$query_kppn = $this->db->query("SELECT kd_kementerian, nm_kementerian, kd_satker, nm_satker, count(*) AS jml_lpj, 
					sum(kas_tunai) AS kas_tunai,
					sum(kas_bank) AS kas_bank,
					sum(penerimaan) AS penerimaan,
					sum(penyetoran) AS penyetoran,
					sum(saldo_awal) AS saldo_awal,
					sum(saldo_akhir) AS saldo_akhir
				FROM 
					dsp_report_rekap_lpjt
				WHERE id_ref_kppn = ".$id_ref_satker."
				AND tahun = '".$year."'
				AND bulan = '".$month."'
				GROUP BY kd_kementerian, kd_satker
				ORDER BY kd_kementerian, kd_satker");
				
			if($query_kppn->num_rows() > 0)
			{
				return $query_kppn->result();
				$query_kppn->free_result();
			}
		}
		
	}
	
	public function total_sum_lpj_penerimaan($id_ref_satker = NULL, $year, $month, $is_kppn = FALSE)
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
				$where = " id_ref_kanwil = ".$id_ref_satker." AND ";
				$select = " id_ref_kanwil, ";
				$group_by = " GROUP BY id_ref_kanwil ";
			}
			
			$query = $this->db->query("SELECT " . $select . " count(*) AS jml_lpj, 
				sum(kas_tunai) AS kas_tunai,
				sum(kas_bank) AS kas_bank,
				sum(penerimaan) AS penerimaan,
				sum(penyetoran) AS penyetoran,
				sum(saldo_awal) AS saldo_awal,
				sum(saldo_akhir) AS saldo_akhir
			FROM 
				dsp_report_rekap_lpjt
			WHERE " .$where. " tahun = '".$year."'
			AND bulan = '".$month."'
			".$group_by."");
			
			if($query->num_rows() > 0)
			{
				return $query->row();
				$query->free_result();
			}
		}
		else if ($is_kppn == TRUE)
		{
			$query = $this->db->query("SELECT id_ref_kppn, 
				sum(kas_tunai) AS kas_tunai,
				sum(kas_bank) AS kas_bank,
				sum(penerimaan) AS penerimaan,
				sum(penyetoran) AS penyetoran,
				sum(saldo_awal) AS saldo_awal,
				sum(saldo_akhir) AS saldo_akhir
			FROM 
				dsp_report_rekap_lpjt
			WHERE id_ref_kppn = ".$id_ref_satker."
				AND tahun = '".$year."'
				AND bulan = '".$month."'
			GROUP BY id_ref_kppn");
			
			if($query->num_rows() > 0)
			{
				return $query->row();
				$query->free_result();
			}
		}
	}
	
	public function detil_lpj_pengeluaran($id_ref_kanwil, $year, $month)
	{
		// query for kppn
		$query_kanwil = $this->db->query("SELECT kd_kppn, nm_kppn, kd_kementerian, nm_kementerian, kd_satker, nm_satker, count(*) AS jml_lpj, 
				sum(uang_persediaan) AS uang_persediaan,
				sum(ls_bendahara) AS ls_bendahara,
				sum(pajak) AS pajak,
				sum(pengeluaran_lain) AS pengeluaran_lain,
				sum(saldo) AS saldo,
				sum(kuitansi) AS kuitansi
			FROM 
				dsp_report_rekap_lpjk
			WHERE id_ref_kanwil = ".$id_ref_kanwil."
			AND tahun = '".$year."'
			AND bulan = '".$month."'
			GROUP BY kd_kementerian, kd_satker
			ORDER BY kd_kementerian, kd_satker");
			
		if($query_kanwil->num_rows() > 0)
		{
			return $query_kanwil;
			$query_kanwil->free_result();
		}
	}
	
	public function detil_lpj_penerimaan($id_ref_kanwil, $year, $month)
	{
		// query for kppn
		$query_kanwil = $this->db->query("SELECT kd_kppn, nm_kppn, kd_kementerian, nm_kementerian, kd_satker, nm_satker, count(*) AS jml_lpj, 
				sum(kas_tunai) AS kas_tunai,
				sum(kas_bank) AS kas_bank,
				sum(penerimaan) AS penerimaan,
				sum(penyetoran) AS penyetoran,
				sum(saldo_awal) AS saldo_awal,
				sum(saldo_akhir) AS saldo_akhir
			FROM 
				dsp_report_rekap_lpjt
			WHERE id_ref_kanwil = ".$id_ref_kanwil."
			AND tahun = '".$year."'
			AND bulan = '".$month."'
			GROUP BY kd_kementerian, kd_satker
			ORDER BY kd_kementerian, kd_satker");
			
		if($query_kanwil->num_rows() > 0)
		{
			return $query_kanwil;
			$query_kanwil->free_result();
		}
	}
}
