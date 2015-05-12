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
			
			$query_pengeluaran_kppn = $this->db->query("SELECT tahun, bulan, count(*) as jml_lpj
										FROM dsp_report_rekap_lpjk
										WHERE tahun = '{$year}'
										AND bulan = '{$month}'
										AND id_ref_kppn = {$id_ref_kppn}");
			
			$query_penerimaan_kppn = $this->db->query("SELECT tahun, bulan, count(*) as jml_lpj
										FROM dsp_report_rekap_lpjt
										WHERE tahun = '{$year}'
										AND bulan = '{$month}'
										AND id_ref_kppn = {$id_ref_kppn}");
						
			
				return array(
					'query_pengeluaran'	=> $query_pengeluaran_kppn->result(),
					'query_penerimaan'	=> $query_penerimaan_kppn->result(),
				);
		}
		
		// Kanwil
		if ($id_ref_kanwil !== NULL) 
		{
			$query_pengeluaran_kanwil = $this->db->query("SELECT tahun, bulan, count(*) as jml_lpj
										FROM dsp_report_rekap_lpjk
										WHERE tahun = '{$year}'
										AND bulan = '{$month}'
										AND id_ref_kanwil = {$id_ref_kanwil}");
			/*
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
			*/
			
			$query_penerimaan_kanwil = $this->db->query("SELECT tahun, bulan, count(*) as jml_lpj
										FROM dsp_report_rekap_lpjt
										WHERE tahun = '{$year}'
										AND bulan = '{$month}'
										AND id_ref_kanwil = {$id_ref_kanwil}");
			/*
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
			*/
			
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
	
	public function get_list_satker_status($id_ref_kppn, $year, $month, $status = FALSE, $report = FALSE)
	{
		// sent if status == true ($status_kirim = 'not')
		if($status == FALSE)
		{
			$status_kirim = '';
		} 
		else 
		{
			$status_kirim = ' NOT ';
		}
		
		// report or not report
		if ( $report == FALSE )
		{
			// pengeluaran
			$fields_pengeluaran = '';
			$join_pengeluaran = '';
			// penerimaan
			$fields_penerimaan = '';
			$join_penerimaan = '';
			
		}
		else if ( $report == TRUE )
		{
			// pengeluaran
			$fields_pengeluaran = ' dsp_ba_lpjk.created_at, dsp_ba_lpjk.updated_at,  ';
			$join_pengeluaran = ' LEFT JOIN dsp_ba_lpjk ON dsp_ba_lpjk.id_ba_lpjk = dsp_report_rekap_lpjk.id_ba_lpj ';
			// penerimaan
			$fields_penerimaan = ' dsp_ba_lpjp.created_at, dsp_ba_lpjp.updated_at,  ';
			$join_penerimaan = ' LEFT JOIN dsp_ba_lpjp ON dsp_ba_lpjp.id_ba_lpjp = dsp_report_rekap_lpjt.id_ba_lpj ';
		}
		
		
		$query_pengeluaran = $this->db->query("SELECT ref_history_satker.id_ref_satker,
								ref_satker.kd_satker, ref_satker.nm_satker, {$fields_pengeluaran}
								count(*) as jml_lpj
								FROM ref_history_satker
								LEFT JOIN ref_satker
								ON ref_history_satker.id_ref_satker = ref_satker.id_ref_satker
								LEFT JOIN dsp_report_rekap_lpjk
								ON ref_history_satker.id_ref_satker = dsp_report_rekap_lpjk.id_ref_satker
								AND ref_history_satker.tahun = dsp_report_rekap_lpjk.tahun
								AND ref_history_satker.bulan = dsp_report_rekap_lpjk.bulan {$join_pengeluaran}
								WHERE dsp_report_rekap_lpjk.id_ref_satker is {$status_kirim} null
								AND ref_satker.id_ref_kppn = {$id_ref_kppn}
								AND ref_history_satker.tahun = '{$year}'
								AND ref_history_satker.bulan = '{$month}'
								AND ref_history_satker.aktif != 0
								GROUP BY 2");
		
		$query_penerimaan = $this->db->query("SELECT ref_history_satker.id_ref_satker,
								ref_satker.kd_satker, ref_satker.nm_satker, {$fields_penerimaan}
								count(*) as jml_lpj
								FROM ref_history_satker
								LEFT JOIN ref_satker
								ON ref_history_satker.id_ref_satker = ref_satker.id_ref_satker
								LEFT JOIN dsp_report_rekap_lpjt
								ON ref_history_satker.id_ref_satker = dsp_report_rekap_lpjt.id_ref_satker
								AND ref_history_satker.tahun = dsp_report_rekap_lpjt.tahun
								AND ref_history_satker.bulan = dsp_report_rekap_lpjt.bulan {$join_penerimaan}
								WHERE dsp_report_rekap_lpjt.id_ref_satker is {$status_kirim} null
								AND ref_satker.id_ref_kppn = {$id_ref_kppn}
								AND ref_history_satker.tahun = '{$year}'
								AND ref_history_satker.bulan = '{$month}'
								AND ref_history_satker.aktif != 0
								GROUP BY 2");
		
			return array(
				'query_pengeluaran'	=> $query_pengeluaran->result(),
				'query_penerimaan'	=> $query_penerimaan->result()
			);
		
	}
	
	// edit here
	public function get_list_satker_status_kanwil($id_ref_kanwil, $year, $month,  $status = FALSE, $monitor_satker = FALSE, $export_xls = FALSE)
	{
		// status == FALSE means unsent
		if($status == FALSE)
		{
			$status_kirim 	= '';
			$join_kppn 		= ' LEFT JOIN ref_kppn 
									ON ref_satker.id_ref_kppn = ref_kppn.id_ref_kppn
								LEFT JOIN ref_unit
									ON ref_satker.id_ref_unit = ref_unit.id_ref_unit
								LEFT JOIN ref_kementerian
									ON ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian ';
			// monitoring at kementerian level
			$ref_kementerian = ' ref_kppn.kd_kppn, ref_kppn.nm_kppn, ref_kementerian.kd_kementerian, 
								ref_kementerian.nm_kementerian, ';
			$ref_kementerian_penerimaan = ' ref_kppn.kd_kppn, ref_kppn.nm_kppn, ref_kementerian.kd_kementerian, 
								ref_kementerian.nm_kementerian, ';
			$ref_kanwil 	= ' ref_kppn.id_ref_kanwil ';
			$ref_kanwil_penerimaan 	= ' ref_kppn.id_ref_kanwil ';
			// monitoring at satker level
			$ref_satker_pengeluaran = ' ref_kppn.kd_kppn, ref_kppn.nm_kppn, 
								ref_kementerian.kd_kementerian, ref_kementerian.nm_kementerian, 
								ref_satker.kd_satker, ref_satker.nm_satker ';
			$ref_satker_penerimaan = ' ref_kppn.kd_kppn, ref_kppn.nm_kppn, 
								ref_kementerian.kd_kementerian, ref_kementerian.nm_kementerian, 
								ref_satker.kd_satker, ref_satker.nm_satker ';
			
		} else {
			
			$status_kirim 	= ' NOT ';
			$join_kppn 		= '';
			// monitoring at kementerian level
			$ref_kementerian = ' dsp_report_rekap_lpjk.kd_kppn, dsp_report_rekap_lpjk.nm_kppn, 
								dsp_report_rekap_lpjk.kd_kementerian, dsp_report_rekap_lpjk.nm_kementerian, ';
			$ref_kementerian_penerimaan = ' dsp_report_rekap_lpjt.kd_kppn, dsp_report_rekap_lpjt.nm_kppn, 
								dsp_report_rekap_lpjt.kd_kementerian, dsp_report_rekap_lpjt.nm_kementerian, ';
			$ref_kanwil 	= ' dsp_report_rekap_lpjk.id_ref_kanwil ';
			$ref_kanwil_penerimaan 	= ' dsp_report_rekap_lpjt.id_ref_kanwil ';
			// monitoring at satker level
			$ref_satker_pengeluaran = ' dsp_report_rekap_lpjk.kd_kppn, dsp_report_rekap_lpjk.nm_kppn, 
								dsp_report_rekap_lpjk.kd_kementerian, dsp_report_rekap_lpjk.nm_kementerian, 
								dsp_report_rekap_lpjk.kd_satker, dsp_report_rekap_lpjk.nm_satker ';
			$ref_satker_penerimaan = ' dsp_report_rekap_lpjt.kd_kppn, dsp_report_rekap_lpjt.nm_kppn, 
								dsp_report_rekap_lpjt.kd_kementerian, dsp_report_rekap_lpjt.nm_kementerian, 
								dsp_report_rekap_lpjt.kd_satker, dsp_report_rekap_lpjt.nm_satker' ;
		}
		
		// if monitoring until satker level
		if ($monitor_satker == FALSE) 
		{
			$query_pengeluaran_kementerian = $this->db->query("SELECT  
								{$ref_kementerian}
								count(*) as jml_lpj_kementerian
								FROM ref_history_satker
								LEFT JOIN ref_satker
								ON ref_history_satker.id_ref_satker = ref_satker.id_ref_satker
								LEFT JOIN dsp_report_rekap_lpjk
								ON ref_history_satker.id_ref_satker = dsp_report_rekap_lpjk.id_ref_satker
								AND ref_history_satker.tahun = dsp_report_rekap_lpjk.tahun
								AND ref_history_satker.bulan = dsp_report_rekap_lpjk.bulan
								{$join_kppn}
								WHERE dsp_report_rekap_lpjk.id_ref_satker is {$status_kirim} null
								AND {$ref_kanwil} = {$id_ref_kanwil}
								AND ref_history_satker.tahun = '{$year}'
								AND ref_history_satker.bulan = '{$month}'
								GROUP BY 1,3
								ORDER BY 1,3");
	
			
			$query_penerimaan_kementerian = $this->db->query("SELECT  
								{$ref_kementerian_penerimaan}
								count(*) as jml_lpj_kementerian
								FROM ref_history_satker
								LEFT JOIN ref_satker
								ON ref_history_satker.id_ref_satker = ref_satker.id_ref_satker
								LEFT JOIN dsp_report_rekap_lpjt
								ON ref_history_satker.id_ref_satker = dsp_report_rekap_lpjt.id_ref_satker
								AND ref_history_satker.tahun = dsp_report_rekap_lpjt.tahun
								AND ref_history_satker.bulan = dsp_report_rekap_lpjt.bulan
								{$join_kppn}
								WHERE dsp_report_rekap_lpjt.id_ref_satker is {$status_kirim} null
								AND {$ref_kanwil_penerimaan} = {$id_ref_kanwil}
								AND ref_history_satker.tahun = '{$year}'
								AND ref_history_satker.bulan = '{$month}'
								GROUP BY 1,3
								ORDER BY 1,3");
			
			
			return array(
				'query_pengeluaran'	=> $query_pengeluaran_kementerian->result(),
				'query_penerimaan'	=> $query_penerimaan_kementerian->result(),
			);
		} 
		else
		{
			$query_pengeluaran_satker = $this->db->query("SELECT  
								{$ref_satker_pengeluaran}
								FROM ref_history_satker
								LEFT JOIN ref_satker
								ON ref_history_satker.id_ref_satker = ref_satker.id_ref_satker
								LEFT JOIN dsp_report_rekap_lpjk
								ON ref_history_satker.id_ref_satker = dsp_report_rekap_lpjk.id_ref_satker
								AND ref_history_satker.tahun = dsp_report_rekap_lpjk.tahun
								AND ref_history_satker.bulan = dsp_report_rekap_lpjk.bulan
								{$join_kppn}
								WHERE dsp_report_rekap_lpjk.id_ref_satker is {$status_kirim} null
								AND {$ref_kanwil} = {$id_ref_kanwil}
								AND ref_history_satker.tahun = '{$year}'
								AND ref_history_satker.bulan = '{$month}'
								GROUP BY 1,3,5
								ORDER BY 1,3,5");
		
				
			$query_penerimaan_satker = $this->db->query("SELECT  
								{$ref_satker_penerimaan}
								FROM ref_history_satker
								LEFT JOIN ref_satker
								ON ref_history_satker.id_ref_satker = ref_satker.id_ref_satker
								LEFT JOIN dsp_report_rekap_lpjt
								ON ref_history_satker.id_ref_satker = dsp_report_rekap_lpjt.id_ref_satker
								AND ref_history_satker.tahun = dsp_report_rekap_lpjt.tahun
								AND ref_history_satker.bulan = dsp_report_rekap_lpjt.bulan
								{$join_kppn}
								WHERE dsp_report_rekap_lpjt.id_ref_satker is {$status_kirim} null
								AND {$ref_kanwil_penerimaan} = {$id_ref_kanwil}
								AND ref_history_satker.tahun = '{$year}'
								AND ref_history_satker.bulan = '{$month}'
								GROUP BY 1,3,5
								ORDER BY 1,3,5");
				
			
			return array(
				'query_pengeluaran_satker'	=> $query_pengeluaran_satker->result(),
				'query_penerimaan_satker'	=> $query_penerimaan_satker->result(),
			);
		}
	}
	
	/*
	public function get_list_satker_status_pkn($id_ref_kanwil, $year, $month, $status = FALSE)
	{
		if($status == FALSE)
		{
			$status_kirim = '';
		} else {
			$status_kirim = ' NOT ';
		}
		
			$query_pengeluaran = $this->db->query("SELECT  
								{$ref_kementerian}
								count(*) as jml_lpj_kementerian
								FROM ref_history_satker
								LEFT JOIN ref_satker
								ON ref_history_satker.id_ref_satker = ref_satker.id_ref_satker
								LEFT JOIN dsp_report_rekap_lpjk
								ON ref_history_satker.id_ref_satker = dsp_report_rekap_lpjk.id_ref_satker
								AND ref_history_satker.tahun = dsp_report_rekap_lpjk.tahun
								AND ref_history_satker.bulan = dsp_report_rekap_lpjk.bulan
								{$join_kppn}
								WHERE dsp_report_rekap_lpjk.id_ref_satker is {$status_kirim} null
								AND {$ref_kanwil} = {$id_ref_kanwil}
								AND ref_history_satker.tahun = '{$year}'
								AND ref_history_satker.bulan = '{$month}'
								GROUP BY 1,3
								ORDER BY 1,3");
		
			
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
	
		
		
			return array(
				'query_pengeluaran_kanwil'	=> $query_pengeluaran->result(),
				'query_penerimaan_kanwil'	=> $query_penerimaan->result(),
			);
		
	}
	*/
}
