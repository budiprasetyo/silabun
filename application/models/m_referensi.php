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
	
	public function get_kanwil($id_ref_satker)
	{
		$query = $this->db->select('ref_satker.id_ref_satker')
							->select('ref_satker.kd_satker')
							->select('ref_kanwil.id_ref_kanwil')
							->select('ref_kanwil.kd_kanwil')
							->select('ref_kanwil.nm_kanwil')
							->from('ref_satker')
							->join('ref_kanwil', 'ref_satker.kd_satker = ref_kanwil.kd_satker_kanwil')
							->where('ref_satker.id_ref_satker', $id_ref_satker)
							->get();
							
		if($query->num_rows() > 0)
		{
			return $query->row();
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
	public function get_kementerian($table_name = NULL, $field_name = NULL)
	{
		
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
}