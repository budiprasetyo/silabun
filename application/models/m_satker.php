<?php
/*
 * m_satker.php
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




class M_satker extends MY_Model
{
	public $_table_name 		= 'ref_satker';
	public $_primary_key 		= 'id_ref_satker';
	protected $_primary_filter 	= 'intval';
	protected $_order_by 		= 'id_ref_satker';
	public $_created_at			= 'created_at';
	public $_updated_at			= 'updated_at';
	public $_timestamps			= FALSE;
	public $rules				= array(
					'id_ref_unit'	=> array(
						'field'	=> 'id_ref_unit',
						'label'	=> 'Eselon I',
						'rules'	=> 'trim|required|nature|max_length[5]|xss_clean'
					),
					'id_ref_kabkota'	=> array(
						'field'	=> 'id_ref_kabkota',
						'label'	=> 'Kabupaten/Kota',
						'rules'	=> 'trim|required|nature|max_length[5]|xss_clean'
					),
					'id_ref_kppn'	=> array(
						'field'	=> 'id_ref_kppn',
						'label'	=> 'KPPN',
						'rules'	=> 'trim|nature|max_length[5]|xss_clean'
					),
					'kd_satker'	=> array(
						'field'	=> 'kd_satker',
						'label'	=> 'Kode Satker',
						'rules'	=> 'trim|required|max_length[6]|callback__unique_satker|xss_clean'
					),
					'no_karwas'	=> array(
						'field'	=> 'no_karwas',
						'label'	=> 'Karwas',
						'rules'	=> 'trim|required|max_length[4]|xss_clean'
					),
					'nm_satker'	=> array(
						'field'	=> 'nm_satker',
						'label'	=> 'Satuan Kerja',
						'rules'	=> 'trim|required|max_length[200]|xss_clean'
					),
					'aktif'	=> array(
						'field'	=> 'aktif',
						'label'	=> 'Satker Aktif',
						'rules'	=> 'trim|xss_clean|max_length[3]'
					),
					'lpj_status_pengeluaran'	=> array(
						'field'	=> 'lpj_status_pengeluaran',
						'label'	=> 'Status LPJ Pengeluaran',
						'rules'	=> 'trim|xss_clean|max_length[3]'
					),
					'lpj_status_penerimaan'	=> array(
						'field'	=> 'lpj_status_penerimaan',
						'label'	=> 'Status LPJ Penerimaan',
						'rules'	=> 'trim|xss_clean|max_length[3]'
					)
	);
	

	public function get_join($single = FALSE, $tahun, $bulan)
	{
		$query = $this->db->select('ref_kementerian.id_ref_kementerian')
							->select('ref_kementerian.kd_kementerian')
							->select('ref_unit.id_ref_unit')
							->select('ref_unit.kd_unit')
							->select('ref_lokasi.id_ref_lokasi')
							->select('ref_lokasi.kd_lokasi')
							->select('ref_kabkota.id_ref_kabkota')
							->select('ref_kabkota.kd_kabkota')
							->select('ref_satker.id_ref_satker')
							->select('ref_satker.kd_satker')
							->select('ref_satker.nm_satker')
							->select('ref_satker.no_karwas')
							->select('ref_history_satker.aktif')
							->select('ref_history_satker.lpj_status_pengeluaran')
							->select('ref_history_satker.lpj_status_penerimaan')
							->from('ref_satker')
							->join('ref_history_satker', 'ref_satker.id_ref_satker = ref_history_satker.id_ref_satker', 'left')
							->join('ref_unit', 'ref_satker.id_ref_unit = ref_unit.id_ref_unit', 'left')
							->join('ref_kementerian', 'ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian', 'left')
							->join('ref_kabkota', 'ref_satker.id_ref_kabkota = ref_kabkota.id_ref_kabkota', 'left')
							->join('ref_lokasi', 'ref_kabkota.id_lokasi = ref_lokasi.id_ref_lokasi', 'left')
							->join('ref_kppn', 'ref_kppn.id_ref_kppn = ref_satker.id_ref_kppn', 'left')
							->where('ref_kppn.id_ref_satker', $this->data['id_ref_satker'])
							->where('ref_history_satker.tahun', $tahun)
							->where('ref_history_satker.bulan', $bulan)
							->group_by('ref_kementerian.kd_kementerian')
							->group_by('ref_unit.kd_unit')
							->group_by('ref_lokasi.kd_lokasi')
							->group_by('ref_kabkota.kd_kabkota')
							->group_by('ref_satker.kd_satker')
							->group_by('ref_satker.no_karwas')
							->order_by('ref_kementerian.kd_kementerian')
							->order_by('ref_unit.kd_unit')
							->order_by('ref_lokasi.kd_lokasi')
							->order_by('ref_kabkota.kd_kabkota')
							->order_by('ref_satker.kd_satker')
							->get();
		// Return results
        $single == FALSE || $this->db->limit(1);
        $method = $single ? 'row' : 'result';
        // if it exists or not
        if ( $query->num_rows() > 0 )
		{
			return $query->$method();
		}
		else
		{
			return FALSE;
		}
							
	}
	
	public function get_kementerian_satker($id_ref_satker)
	{
		$query = $this->db->select('ref_unit.id_ref_kementerian')
							->from('ref_satker')
							->join('ref_unit', 'ref_unit.id_ref_unit = ref_satker.id_ref_unit', 'left')
							->where('ref_satker.id_ref_satker', $id_ref_satker)
							->group_by('ref_unit.id_ref_kementerian')
							->get();
							
		if ($query->num_rows() > 0) 
		{
			return $query->row();
			$query->free_result();
		}
		else
		{
			return FALSE;
		}
	}
	
	
	public function get_provinsi_satker($id_ref_satker)
	{
		$query = $this->db->select('ref_kabkota.id_lokasi')
							->from('ref_satker')
							->join('ref_kabkota', 'ref_kabkota.id_ref_kabkota = ref_satker.id_ref_kabkota', 'left')
							->where('ref_satker.id_ref_satker', $id_ref_satker)
							->group_by('ref_kabkota.id_lokasi')
							->get();
							
		if ($query->num_rows() > 0) 
		{
			return $query->row();
			$query->free_result();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function update_status_satker($year, $month, $id, $aktif = FALSE, $lpj_status_pengeluaran = FALSE, $lpj_status_penerimaan = FALSE)
	{
		// get aktif status, this query is used in updating lpj_status too
		$query_aktif = $this->db->select('aktif')
								->from('ref_history_satker')
								->where('tahun', $year)
								->where('bulan', $month)
								->where('id_ref_satker', $id)
								->group_by('aktif')
								->get();
		
		if ($query_aktif->num_rows() > 0) 
		{
			$result_aktif = $query_aktif->row();
		}
		
		// update aktif field
		if ($aktif == TRUE) 
		{
			// if non aktif, update aktif to 1 (aktif).  When aktif = 0, lpj_status should be 0 too
			if ($result_aktif->aktif === "0") 
			{
				$data = array(
					'aktif' => 1
				);
			}
			else
			{
				$data = array(
					'aktif' 					=> 0,
					'lpj_status_pengeluaran' 	=> 0,
					'lpj_status_penerimaan' 	=> 0,
				);
			}
			
			$this->db->where('id_ref_satker', $id)
						->where('tahun', $year)
						->where('bulan', $month)
						->update('ref_history_satker', $data);
		}
		
		// update lpj_status field
		if ($lpj_status_pengeluaran == TRUE) 
		{
			// get lpj_status status
			$query_lpj_status = $this->db->select('lpj_status_pengeluaran')
									->from('ref_history_satker')
									->where('tahun', $year)
									->where('bulan', $month)
									->where('id_ref_satker', $id)
									->group_by('lpj_status_pengeluaran')
									->get();
			
			if ($query_lpj_status->num_rows() > 0) 
			{
				$result_lpj_status = $query_lpj_status->row();
			}
			
			// if non aktif, update lpj_status to 1 (aktif)
			if ($result_lpj_status->lpj_status_pengeluaran === "0") 
			{
				$data = array(
					'lpj_status_pengeluaran' => 1
				);
			}
			else
			{
				$data = array(
					'lpj_status_pengeluaran' => 0
				);
			}
			
			if ($result_aktif->aktif !== "0")
			{
				$this->db->where('id_ref_satker', $id)
						->where('tahun', $year)
						->where('bulan', $month)
						->update('ref_history_satker', $data);
			}
		}
		
		// update lpj_status field
		if ($lpj_status_penerimaan == TRUE) 
		{
			// get lpj_status status
			$query_lpj_status = $this->db->select('lpj_status_penerimaan')
									->from('ref_history_satker')
									->where('tahun', $year)
									->where('bulan', $month)
									->where('id_ref_satker', $id)
									->group_by('lpj_status_penerimaan')
									->get();
			
			if ($query_lpj_status->num_rows() > 0) 
			{
				$result_lpj_status = $query_lpj_status->row();
			}
			
			// if non aktif, update lpj_status to 1 (aktif)
			if ($result_lpj_status->lpj_status_penerimaan === "0") 
			{
				$data = array(
					'lpj_status_penerimaan' => 1
				);
			}
			else
			{
				$data = array(
					'lpj_status_penerimaan' => 0
				);
			}
			
			if ($result_aktif->aktif !== "0")
			{
				$this->db->where('id_ref_satker', $id)
						->where('tahun', $year)
						->where('bulan', $month)
						->update('ref_history_satker', $data);
			}
		}
		
	}
	
	// define must be paired with rules
	public function get_new()
	{
		// define and instantiate
		$satker = new stdClass();
		
		$satker->id_ref_unit				= '';
		$satker->id_ref_kabkota				= '';
		$satker->id_ref_kppn				= '';
		$satker->kd_satker					= '';
		$satker->no_karwas					= '';
		$satker->nm_satker					= '';
		$satker->aktif						= '';
		$satker->lpj_status_pengeluaran		= '';
		$satker->lpj_status_penerimaan		= '';
		return $satker;
	}

}
