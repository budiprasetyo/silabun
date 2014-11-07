<?php
/*
 * m_referensi.php
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




class M_referensi extends MY_Model
{

	public function get_kppn($id_ref_satker)
	{
		$query = $this->db->select('ref_satker.id_ref_satker')
							->select('ref_satker.kd_satker')
							->select('ref_kppn.id_ref_kppn')
							->select('ref_kppn.kd_kppn')
							->select('ref_kppn.nm_kppn')
							->from('ref_satker')
							->join('ref_kppn', 'ref_satker.kd_satker = ref_kppn.kd_satker_kppn')
							->where('ref_satker.id_ref_satker', $id_ref_satker)
							->get();
							
		if($query->num_rows() > 0)
		{
			return $query->row();
			$query->free_result();
		}
	}
	
	public function get_kanwil($id_ref_satker = FALSE, $row = TRUE, $order_by = NULL)
	{
		// row or result
		$row == TRUE ? $row = 'row' : $row = 'result';
		
		$this->db->select('ref_satker.id_ref_satker')
							->select('ref_satker.kd_satker')
							->select('ref_kanwil.id_ref_kanwil')
							->select('ref_kanwil.kd_kanwil')
							->select('ref_kanwil.nm_kanwil')
							->from('ref_satker')
							->join('ref_kanwil', 'ref_satker.kd_satker = ref_kanwil.kd_satker_kanwil');
							
		// where with null conditional
		if($id_ref_satker != FALSE)
		{
			$this->db->where('ref_satker.id_ref_satker', $id_ref_satker);
		}
		// order by
		if($order_by !== NULL)
		{
			$this->db->order_by($order_by);
		}
		
		$query = $this->db->get();
							
		if($query->num_rows() > 0)
		{
			return $query->$row();
			$query->free_result();
		}
	}
	
	/**
	 * @brief	get_kementerian
	 * 			require id_ref_satker for join on id_ref_satker
	 * @param 	$table_name string
	 * @param 	$field_name string
	 * @returns object
	 * 
	 * 
	 */
	
	public function get_kementerian()
	{
		$query = $this->db->select('id_ref_kementerian')
							->select('kd_kementerian')
							->select('nm_kementerian')
							->from('ref_kementerian')
							->order_by('kd_kementerian')
							->get();
							
		if ($query->num_rows > 0) 
		{
			return $query->result();
			$query->free_result();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_kementerian_unit()
	{
		$query = $this->db->select('ref_kementerian.id_ref_kementerian')
							->select('ref_kementerian.kd_kementerian')
							->select('ref_kementerian.nm_kementerian')
							->select('ref_unit.id_ref_unit')
							->select('ref_unit.kd_unit')
							->select('ref_unit.nm_unit')
							->from('ref_kementerian')
							->join('ref_unit', 'ref_unit.id_ref_kementerian = ref_kementerian.id_ref_kementerian', 'left')
							->group_by('ref_kementerian.id_ref_kementerian')
							->group_by('ref_unit.id_ref_unit')
							->order_by('ref_kementerian.kd_kementerian')
							->get();
												
		if ($query->num_rows > 0) 
		{
			return $query->result();
			$query->free_result();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_provinsi()
	{
		$query = $this->db->select('id_ref_lokasi')
							->select('kd_lokasi')
							->select('nm_lokasi')
							->from('ref_lokasi')
							->order_by('kd_lokasi')
							->get();
							
		if ($query->num_rows > 0) 
		{
			return $query->result();
			$query->free_result();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_provinsi_kabkota()
	{
		$query = $this->db->select('ref_lokasi.id_ref_lokasi')
							->select('ref_lokasi.kd_lokasi')
							->select('ref_lokasi.nm_lokasi')
							->select('ref_kabkota.id_ref_kabkota')
							->select('ref_kabkota.id_lokasi')
							->select('ref_kabkota.kd_kabkota')
							->select('ref_kabkota.nm_kabkota')
							->from('ref_lokasi')
							->join('ref_kabkota', 'ref_kabkota.id_lokasi = ref_lokasi.id_ref_lokasi', 'left')
							->group_by('id_ref_lokasi')
							->group_by('id_ref_kabkota')
							->order_by('ref_kabkota.kd_kabkota')
							->get();
							
		if ($query->num_rows > 0) 
		{
			return $query->result();
			$query->free_result();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_id_name_satker($kd_satker, $id_ref_kppn)
	{
		$query = $this->db->select('ref_satker.id_ref_satker')
							->select('ref_satker.kd_satker')
							->select('ref_satker.nm_satker')
							->select('ref_satker.id_ref_kppn')
							->select('ref_kppn.kd_kppn')
							->select('ref_kppn.nm_kppn')
							->select('ref_kppn.almt_kppn')
							->select('ref_kppn.telp_kppn')
							->select('ref_kppn.fax_kppn')
							->select('ref_kppn.email_kppn')
							->select('ref_kanwil.nm_kanwil')
							->from('ref_satker')
							->join('ref_kppn', 'ref_satker.id_ref_kppn = ref_kppn.id_ref_kppn', 'left')
							->join('ref_kanwil', 'ref_kppn.id_ref_kanwil = ref_kanwil.id_ref_kanwil', 'left')
							->where('ref_satker.kd_satker', $kd_satker)
							->where('ref_satker.id_ref_kppn', $id_ref_kppn)
							->get();
							
		if($query->num_rows > 0)
		{
			return $query->row();
			$query->free_result();
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_ref_satker($kd_satker)
	{
		$query = $this->db->select('id_ref_satker')
							->select('kd_satker')
							->select('nm_satker')
							->from('ref_satker')
							->where('kd_satker', $kd_satker)
							->get();
							
		if($query->num_rows() > 0)
		{
			return $query->row();
			$query->free_result();
		}
	}
	
	public function get_all_entities()
	{
		$query = $this->db->select('id_entities')
							->select('entity_desc')
							->select('parent_entity')
							->order_by('id_entities')
							->get('entities');
							
		if($query->num_rows() > 0)
		{
			return $query->result();
			$query->free_result();
		}
	}
	
	public function get_pejabat($id_ref_satker)
	{
		$query = $this->db->select('ref_jabatan.nm_jabatan')
							->select('ref_pejabat.nm_pejabat')
							->select('ref_pejabat.nip_pejabat')
							->from('ref_pejabat')
							->join('ref_jabatan', 'ref_jabatan.id_ref_jabatan = ref_pejabat.id_ref_jabatan', 'left')
							->where('id_ref_satker', $id_ref_satker)
							->group_by('ref_jabatan.nm_jabatan')
							->group_by('ref_pejabat.nm_pejabat')
							->get();
		if($query->num_rows() > 0)
		{
			return $query->row();
			$query->free_result();
		}
	}
	
	public function get_kanwil_dropdown()
	{
		$kanwil_dropdown = array();
		$query = $this->db->select('id_ref_kanwil')
							->select('kd_kanwil')
							->select('nm_kanwil')
							->select('kd_satker_kanwil')
							->from('ref_kanwil')
							->order_by('kd_kanwil')
							->get();
							
		if ($query->num_rows() > 0) 
		{
			$kanwil_dropdown[] = '-- Pilih Kanwil --';

			foreach ($query->result_array() as $row) 
			{
				$kanwil_dropdown[$row['id_ref_kanwil']] = $row['nm_kanwil'];
			}
			return $kanwil_dropdown;
		}
	}
}
