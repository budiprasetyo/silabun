<?php
/*
 * m_monitoring.php
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




class M_monitoring extends MY_Model
{

	protected $_table_name 		= 'dsp_status_kirim_pengeluaran';
	protected $_primary_key 	= 'id_status_kirim';
	protected $_order_by 		= 'id_status_kirim';
	public $rules				= array(
					'upload'	=> array(
						'field'	=> 'upload_lpj',
						'label'	=> 'Upload Data',
						'rules'	=> 'trim|required|max_length[11]'
					)
	);
	
	/**
	 * @brief Count satker in LPJ Penerimaan or Pengeluaran. 
	 * 			When in KPPN group by tahun and bulan
	 * @param $id_ref_kppn 		int
	 * @param $id_ref_kanwil	int
	 * @param $year 			string
	 * @param $month 			string
	 * @returns 				array
	 * 
	 * 
	 */
	 
	public function get_count_data_satker($id_ref_kppn = NULL, $id_ref_kanwil = NULL, $year, $month)
	{
		// KPPN
		if ($id_ref_kppn !== NULL) 
		{
			
			$query_pengeluaran_kppn = $this->db->query("SELECT a.tahun, a.bulan, a.pos_kirim, count(*) as jml_lpj
						FROM ref_satker
						LEFT JOIN ( SELECT tahun, bulan, pos_kirim, id_ref_satker
									FROM
									dsp_status_kirim_pengeluaran 
									WHERE tahun = '".$year."'
									AND bulan = '".$month."'
									AND pos_kirim = 'K'
						) a
						ON ref_satker.id_ref_satker = a.id_ref_satker 
						WHERE ref_satker.id_ref_kppn = ".$id_ref_kppn." 
						AND ref_satker.lpj_status_pengeluaran = 1
						GROUP BY a.tahun, a.bulan, a.pos_kirim
						ORDER BY a.tahun, a.bulan, a.pos_kirim");
						
			$query_penerimaan_kppn = $this->db->query("SELECT a.tahun, a.bulan, a.pos_kirim, count(*) as jml_lpj
						FROM ref_satker
						LEFT JOIN ( SELECT tahun, bulan, pos_kirim, id_ref_satker
									FROM
									dsp_status_kirim_penerimaan
									WHERE tahun = '".$year."'
									AND bulan = '".$month."'
									AND pos_kirim = 'P'
						) a
						ON ref_satker.id_ref_satker = a.id_ref_satker 
						WHERE ref_satker.id_ref_kppn = ".$id_ref_kppn." 
						AND ref_satker.lpj_status_penerimaan = 1
						GROUP BY a.tahun, a.bulan, a.pos_kirim
						ORDER BY a.tahun, a.bulan, a.pos_kirim");
						
			
				return array(
					'query_pengeluaran'	=> $query_pengeluaran_kppn->result(),
					'query_penerimaan'	=> $query_penerimaan_kppn->result(),
				);
		}
		
		// Kanwil
		if ($id_ref_kanwil !== NULL) 
		{
			
			$query_pengeluaran_kanwil = $this->db->query("SELECT a.tahun, a.bulan, a.pos_kirim, count(*) as jml_lpj
					FROM ref_satker
					LEFT JOIN ( SELECT tahun, bulan, pos_kirim, id_ref_satker
								FROM
								dsp_status_kirim_pengeluaran 
									WHERE tahun = '".$year."'
									AND bulan = '".$month."'
									AND pos_kirim = 'K'
					) a
					ON ref_satker.id_ref_satker = a.id_ref_satker 
					LEFT JOIN ref_kppn
					ON ref_kppn.id_ref_kppn = ref_satker.id_ref_kppn
					WHERE ref_kppn.id_ref_kanwil = ".$id_ref_kanwil."
					AND ref_satker.lpj_status_pengeluaran = 1
					GROUP BY a.tahun, a.bulan, a.pos_kirim
					ORDER BY a.tahun, a.bulan, a.pos_kirim");
						
			$query_penerimaan_kanwil = $this->db->query("SELECT a.tahun, a.bulan, a.pos_kirim, count(*) as jml_lpj
					FROM ref_satker
					LEFT JOIN ( SELECT tahun, bulan, pos_kirim, id_ref_satker
								FROM
								dsp_status_kirim_penerimaan
									WHERE tahun = '".$year."'
									AND bulan = '".$month."'
									AND pos_kirim = 'P'
					) a
					ON ref_satker.id_ref_satker = a.id_ref_satker 
					LEFT JOIN ref_kppn
					ON ref_kppn.id_ref_kppn = ref_satker.id_ref_kppn
					WHERE ref_kppn.id_ref_kanwil = ".$id_ref_kanwil."
					AND ref_satker.lpj_status_penerimaan = 1
					GROUP BY a.tahun, a.bulan, a.pos_kirim
					ORDER BY a.tahun, a.bulan, a.pos_kirim");
						
			
				return array(
					'query_pengeluaran'	=> $query_pengeluaran_kanwil->result(),
					'query_penerimaan'	=> $query_penerimaan_kanwil->result(),
				);
		}
	}
	
	public function get_count_data_kppn($id_ref_kanwil, $year, $month)
	{
		
		$query = $this->db->query("SELECT dsp_status_kirim_pengeluaran.id_ref_kppn, 
									ref_kppn.kd_kppn,
									ref_kppn.nm_kppn,
									b.kd_kementerian,
									count(*) AS jml_satker
									FROM dsp_status_kirim_pengeluaran
									LEFT JOIN ref_kppn
										ON dsp_status_kirim_pengeluaran.id_ref_kppn = ref_kppn.id_ref_kppn
									LEFT JOIN (
												SELECT ref_kementerian.kd_kementerian, ref_satker.id_ref_satker
													FROM ref_satker
													LEFT JOIN ref_unit
													ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
														LEFT JOIN ref_kementerian
														ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
											) b ON b.id_ref_satker = dsp_status_kirim_pengeluaran.id_ref_satker
									WHERE ref_kppn.id_ref_kanwil = ".$id_ref_kanwil."
									AND dsp_status_kirim_pengeluaran.tahun = '".$year."'
									AND dsp_status_kirim_pengeluaran.bulan = '".$month."'
									GROUP BY dsp_status_kirim_pengeluaran.id_ref_kppn,ref_kppn.kd_kppn,ref_kppn.nm_kppn,
									b.kd_kementerian");
		if($query->num_rows() > 0)
		{
			return $query->result();
			$query->free_result();
		}
	}
	
	public function get_count_data_kanwil($year, $month)
	{
		$query = $this->db->query("SELECT a.kd_kanwil, a.nm_kanwil, b.kd_kementerian, count(*) AS jml_data
									FROM 
										dsp_status_kirim_pengeluaran
											LEFT JOIN ref_kanwil a 
												ON a.id_ref_kanwil = dsp_status_kirim_pengeluaran.id_ref_kanwil
											LEFT JOIN (
												SELECT ref_kementerian.kd_kementerian, ref_satker.id_ref_satker
													FROM ref_satker
													LEFT JOIN ref_unit
													ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
														LEFT JOIN ref_kementerian
														ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
											) b ON b.id_ref_satker = dsp_status_kirim_pengeluaran.id_ref_satker
									WHERE dsp_status_kirim_pengeluaran.tahun = '".$year."'
									AND dsp_status_kirim_pengeluaran.bulan = '".$month."'
									GROUP BY a.kd_kanwil, a.nm_kanwil, b.kd_kementerian
									ORDER BY a.kd_kanwil, b.kd_kementerian");
		if($query->num_rows() > 0)
		{
			return $query->result();
			$query->free_result();
		}
	}
	
	public function get_status_sent_kppn($id_ref_kanwil, $year, $month, $pos_kirim)
	{
		$query_sent = $this->db->query("SELECT dsp_status_kirim_pengeluaran.tahun,
					dsp_status_kirim_pengeluaran.bulan,
					dsp_status_kirim_pengeluaran.pos_kirim,
					count(*) AS jml_satker
					FROM dsp_status_kirim_pengeluaran
					RIGHT JOIN ref_kppn
						ON dsp_status_kirim_pengeluaran.id_ref_kppn = ref_kppn.id_ref_kppn
					LEFT JOIN (
								SELECT ref_kementerian.kd_kementerian, ref_satker.id_ref_satker
									FROM ref_satker
									LEFT JOIN ref_unit
									ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
										LEFT JOIN ref_kementerian
										ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
							) b ON b.id_ref_satker = dsp_status_kirim_pengeluaran.id_ref_satker
					WHERE ref_kppn.id_ref_kanwil = ".$id_ref_kanwil."
					AND dsp_status_kirim_pengeluaran.tahun is null
					AND dsp_status_kirim_pengeluaran.bulan is null
					AND dsp_status_kirim_pengeluaran.pos_kirim is null
					GROUP BY dsp_status_kirim_pengeluaran.tahun,
					dsp_status_kirim_pengeluaran.bulan,
					dsp_status_kirim_pengeluaran.pos_kirim");
	}
	
	public function get_list_satker_status($id_ref_kppn, $year, $month, $status = FALSE)
	{
		if($status == FALSE)
		{
			$status_kirim = ' NOT ';
		} else {
			$status_kirim = '';
		}
		
		$query_pengeluaran = $this->db->query("SELECT ref_satker.id_ref_satker, ref_satker.kd_satker, ref_satker.nm_satker, count(*) as jml_lpj
					FROM ref_satker
					WHERE ref_satker.id_ref_kppn = ".$id_ref_kppn."
					AND ref_satker.lpj_status_pengeluaran = 1
					AND ref_satker.id_ref_satker ".$status_kirim." IN ( SELECT
														dsp_status_kirim_pengeluaran.id_ref_satker
														FROM dsp_status_kirim_pengeluaran
														WHERE tahun = '".$year."'
																	AND bulan = '".$month."'
																	AND pos_kirim = 'K'
														)
					GROUP BY ref_satker.id_ref_satker, ref_satker.kd_satker, ref_satker.nm_satker");
					
		$query_penerimaan = $this->db->query("SELECT ref_satker.id_ref_satker, ref_satker.kd_satker, ref_satker.nm_satker, count(*) as jml_lpj
					FROM ref_satker
					WHERE ref_satker.id_ref_kppn = ".$id_ref_kppn."
					AND ref_satker.lpj_status_penerimaan = 1
					AND ref_satker.id_ref_satker ".$status_kirim." IN ( SELECT
														dsp_status_kirim_penerimaan.id_ref_satker
														FROM dsp_status_kirim_penerimaan
														WHERE tahun = '".$year."'
																	AND bulan = '".$month."'
																	AND pos_kirim = 'P'
														)
					GROUP BY ref_satker.id_ref_satker, ref_satker.kd_satker, ref_satker.nm_satker");
		
			return array(
				'query_pengeluaran'	=> $query_pengeluaran->result(),
				'query_penerimaan'	=> $query_penerimaan->result()
			);
		
	}
	
	public function get_list_satker_status_kanwil($id_ref_kanwil, $year, $month,  $status = FALSE, $monitor_satker = FALSE)
	{
		if($status == FALSE)
		{
			$status_kirim = ' NOT ';
		} else {
			$status_kirim = '';
		}
		
		if ($monitor_satker == FALSE) 
		{
			$query_pengeluaran_kementerian = $this->db->query("SELECT ref_kppn.kd_kppn, ref_kppn.nm_kppn, ref_kementerian.kd_kementerian, ref_kementerian.nm_kementerian, count(*) as jml_lpj_kementerian
				FROM ref_satker
					LEFT JOIN ref_unit
					ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
						LEFT JOIN ref_kementerian
						ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
							LEFT JOIN ref_kppn
							ON ref_satker.id_ref_kppn = ref_kppn.id_ref_kppn
								LEFT JOIN ref_kanwil
								ON ref_kppn.id_ref_kanwil = ref_kanwil.id_ref_kanwil
				WHERE ref_kanwil.id_ref_kanwil = ".$id_ref_kanwil."
				AND ref_satker.lpj_status_pengeluaran = 1
				AND ref_satker.id_ref_satker ".$status_kirim." IN ( 
													SELECT
													dsp_status_kirim_pengeluaran.id_ref_satker
													FROM dsp_status_kirim_pengeluaran
													WHERE tahun = '".$year."'
																AND bulan = '".$month."'
																AND pos_kirim = 'K'
													GROUP BY dsp_status_kirim_pengeluaran.id_ref_satker
												)
				GROUP BY ref_kppn.kd_kppn, ref_kementerian.kd_kementerian
				ORDER BY ref_kppn.kd_kppn, ref_kementerian.kd_kementerian");
				
			$query_penerimaan_kementerian = $this->db->query("SELECT ref_kppn.kd_kppn, ref_kppn.nm_kppn, ref_kementerian.kd_kementerian, ref_kementerian.nm_kementerian, count(*) as jml_lpj_kementerian
				FROM ref_satker
					LEFT JOIN ref_unit
					ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
						LEFT JOIN ref_kementerian
						ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
							LEFT JOIN ref_kppn
							ON ref_satker.id_ref_kppn = ref_kppn.id_ref_kppn
								LEFT JOIN ref_kanwil
								ON ref_kppn.id_ref_kanwil = ref_kanwil.id_ref_kanwil
				WHERE ref_kanwil.id_ref_kanwil = ".$id_ref_kanwil."
				AND ref_satker.lpj_status_penerimaan = 1
				AND ref_satker.id_ref_satker ".$status_kirim." IN ( 
													SELECT
													dsp_status_kirim_penerimaan.id_ref_satker
													FROM dsp_status_kirim_penerimaan
													WHERE tahun = '".$year."'
																AND bulan = '".$month."'
																AND pos_kirim = 'P'
													GROUP BY dsp_status_kirim_penerimaan.id_ref_satker
												)
				GROUP BY ref_kppn.kd_kppn, ref_kementerian.kd_kementerian
				ORDER BY ref_kppn.kd_kppn, ref_kementerian.kd_kementerian");
				
			
			return array(
				'query_pengeluaran'	=> $query_pengeluaran_kementerian->result(),
				'query_penerimaan'	=> $query_penerimaan_kementerian->result(),
			);
		} 
		else
		{
			$query_pengeluaran_satker = $this->db->query("SELECT ref_kppn.kd_kppn, ref_kppn.nm_kppn, ref_kementerian.kd_kementerian, ref_kementerian.nm_kementerian, 
			ref_satker.kd_satker, ref_satker.nm_satker
				FROM ref_satker
					LEFT JOIN ref_unit
					ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
						LEFT JOIN ref_kementerian
						ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
							LEFT JOIN ref_kppn
							ON ref_satker.id_ref_kppn = ref_kppn.id_ref_kppn
								LEFT JOIN ref_kanwil
								ON ref_kppn.id_ref_kanwil = ref_kanwil.id_ref_kanwil
				WHERE ref_kanwil.id_ref_kanwil = ".$id_ref_kanwil."
				AND ref_satker.lpj_status_pengeluaran = 1
				AND ref_satker.id_ref_satker ".$status_kirim." IN ( 
													SELECT
													dsp_status_kirim_pengeluaran.id_ref_satker
													FROM dsp_status_kirim_pengeluaran
													WHERE tahun = '".$year."'
																AND bulan = '".$month."'
																AND pos_kirim = 'K'
													GROUP BY dsp_status_kirim_pengeluaran.id_ref_satker
												)
				GROUP BY ref_kppn.kd_kppn, ref_kementerian.kd_kementerian, ref_satker.kd_satker, ref_satker.nm_satker
				ORDER BY ref_kppn.kd_kppn, ref_kementerian.kd_kementerian, ref_satker.kd_satker, ref_satker.nm_satker");
				
			$query_penerimaan_satker = $this->db->query("SELECT ref_kppn.kd_kppn, ref_kppn.nm_kppn, ref_kementerian.kd_kementerian, ref_kementerian.nm_kementerian, 
			ref_satker.kd_satker, ref_satker.nm_satker
				FROM ref_satker
					LEFT JOIN ref_unit
					ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
						LEFT JOIN ref_kementerian
						ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
							LEFT JOIN ref_kppn
							ON ref_satker.id_ref_kppn = ref_kppn.id_ref_kppn
								LEFT JOIN ref_kanwil
								ON ref_kppn.id_ref_kanwil = ref_kanwil.id_ref_kanwil
				WHERE ref_kanwil.id_ref_kanwil = ".$id_ref_kanwil."
				AND ref_satker.lpj_status_penerimaan = 1
				AND ref_satker.id_ref_satker ".$status_kirim." IN ( 
													SELECT
													dsp_status_kirim_penerimaan.id_ref_satker
													FROM dsp_status_kirim_penerimaan
													WHERE tahun = '".$year."'
																AND bulan = '".$month."'
																AND pos_kirim = 'P'
													GROUP BY dsp_status_kirim_penerimaan.id_ref_satker
												)
				GROUP BY ref_kppn.kd_kppn, ref_kementerian.kd_kementerian, ref_satker.kd_satker, ref_satker.nm_satker
				ORDER BY ref_kppn.kd_kppn, ref_kementerian.kd_kementerian, ref_satker.kd_satker, ref_satker.nm_satker");
				
			
			return array(
				'query_pengeluaran_satker'	=> $query_pengeluaran_satker->result(),
				'query_penerimaan_satker'	=> $query_penerimaan_satker->result(),
			);
		}
	}
	
	public function get_list_satker_status_pkn($year, $month, $pos_kirim, $status = FALSE)
	{
		if($status == FALSE)
		{
			$status_kirim = ' NOT ';
		} else {
			$status_kirim = '';
		}
		
		if ($pos_kirim === 'K')
		{
			
			$query = $this->db->query("SELECT ref_kanwil.kd_kanwil, ref_kanwil.nm_kanwil, ref_kppn.kd_kppn, ref_kppn.nm_kppn, ref_kementerian.kd_kementerian, count(*) as jml_lpj
				FROM ref_satker
					LEFT JOIN ref_unit
					ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
						LEFT JOIN ref_kementerian
						ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
							LEFT JOIN ref_kppn
							ON ref_satker.id_ref_kppn = ref_kppn.id_ref_kppn
								LEFT JOIN ref_kanwil
								ON ref_kppn.id_ref_kanwil = ref_kanwil.id_ref_kanwil
				WHERE ref_satker.id_ref_satker ".$status_kirim." IN ( 
													SELECT
													dsp_status_kirim_pengeluaran.id_ref_satker
													FROM dsp_status_kirim_pengeluaran
													WHERE tahun = '".$year."'
																AND bulan = '".$month."'
																AND pos_kirim = '".$pos_kirim."'
												)
				GROUP BY ref_kanwil.kd_kanwil, ref_kppn.kd_kppn, ref_kementerian.kd_kementerian
				ORDER BY ref_kanwil.kd_kanwil, ref_kppn.kd_kppn, ref_kementerian.kd_kementerian");
	
		}
		else if ($pos_kirim === 'P')
		{
			
			$query = $this->db->query("SELECT ref_kanwil.kd_kanwil, ref_kanwil.nm_kanwil, ref_kppn.kd_kppn, ref_kppn.nm_kppn, ref_kementerian.kd_kementerian, count(*) as jml_lpj
				FROM ref_satker
					LEFT JOIN ref_unit
					ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
						LEFT JOIN ref_kementerian
						ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian
							LEFT JOIN ref_kppn
							ON ref_satker.id_ref_kppn = ref_kppn.id_ref_kppn
								LEFT JOIN ref_kanwil
								ON ref_kppn.id_ref_kanwil = ref_kanwil.id_ref_kanwil
				WHERE ref_satker.id_ref_satker ".$status_kirim." IN ( 
													SELECT
													dsp_status_kirim_penerimaan.id_ref_satker
													FROM dsp_status_kirim_penerimaan
													WHERE tahun = '".$year."'
																AND bulan = '".$month."'
																AND pos_kirim = '".$pos_kirim."'
												)
				GROUP BY ref_kanwil.kd_kanwil, ref_kppn.kd_kppn, ref_kementerian.kd_kementerian
				ORDER BY ref_kanwil.kd_kanwil, ref_kppn.kd_kppn, ref_kementerian.kd_kementerian");
	
		}
		
		return $query->result();
		
	}
}
