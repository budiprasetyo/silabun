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
	
	public function get_count_data_satker($id_ref_kppn, $year, $month, $pos_kirim)
	{
		$query = $this->db->query("SELECT a.tahun, a.bulan, a.pos_kirim, count(*) as jml_lpj
					FROM ref_satker
					LEFT JOIN ( SELECT tahun, bulan, pos_kirim, id_ref_satker
								FROM
								dsp_status_kirim_pengeluaran 
								WHERE tahun = '".$year."'
								AND bulan = '".$month."'
								AND pos_kirim = '".$pos_kirim."'
					) a
					ON ref_satker.id_ref_satker = a.id_ref_satker 
					WHERE ref_satker.id_ref_kppn = ".$id_ref_kppn." 
					GROUP BY a.tahun, a.bulan, a.pos_kirim
					ORDER BY a.tahun, a.bulan, a.pos_kirim");
					
		if($query->num_rows() > 0)
		{
			return $query->result();
			$query->free_result();
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
	
	public function get_list_satker_status($id_ref_kppn, $year, $month, $pos_kirim, $status = FALSE)
	{
		if($status == FALSE)
		{
			$status_kirim = ' NOT ';
		} else {
			$status_kirim = '';
		}
		
		$query = $this->db->query("SELECT ref_satker.id_ref_satker, ref_satker.kd_satker, ref_satker.nm_satker, count(*) as jml_lpj
					FROM ref_satker
					WHERE ref_satker.id_ref_kppn = ".$id_ref_kppn."
					AND ref_satker.id_ref_satker ".$status_kirim." IN ( SELECT
														dsp_status_kirim_pengeluaran.id_ref_satker
														FROM dsp_status_kirim_pengeluaran
														WHERE tahun = '".$year."'
																	AND bulan = '".$month."'
																	AND pos_kirim = '".$pos_kirim."'
														)
					GROUP BY ref_satker.id_ref_satker, ref_satker.kd_satker, ref_satker.nm_satker");
		if($query->num_rows() > 0)
		{
			return $query->result();
			$query->free_result();
		}
	}
}
