<?php
/*
 * m_pejabat.php
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


class M_pejabat extends MY_Model
{

	protected $_table_name 		= 'ref_pejabat';
	protected $_primary_key 	= 'id_ref_pejabat';
	protected $_order_by 		= 'id_ref_pejabat';
	public $rules				= array(
					'nm_pejabat'	=> array(
						'field'	=> 'nm_pejabat',
						'label'	=> 'Nama Pejabat',
						'rules'	=> 'trim|required|max_length[120]|xss_clean'
					),
					'id_ref_jabatan'	=> array(
						'field'	=> 'id_ref_jabatan',
						'label'	=> 'Jabatan',
						'rules'	=> 'trim|max_length[5]|xss_clean'
					)
	);
	
	public function get_join($ids = NULL, $single = FALSE)
	{
		
		$query = $this->db->select('ref_pejabat.id_ref_pejabat')
							->select('ref_jabatan.id_ref_jabatan')
							->select('ref_jabatan.id_entities')
							->select('ref_jabatan.nm_jabatan')
							->select('ref_pejabat.nm_pejabat')
							->from('ref_jabatan')
							->join('ref_pejabat', 'ref_jabatan.id_ref_jabatan = ref_pejabat.id_ref_jabatan', 'right')
							->where('ref_jabatan.id_entities', $this->data['id_entities']);
							
		if($ids){
			$query = $this->db->where('id_ref_pejabat', $ids);
		} 
		
		$query = $this->db->order_by('ref_jabatan.id_ref_jabatan')
							->get();
		// Return results
        $single == FALSE || $this->db->limit(1);
        $method = $single ? 'row' : 'result';
		return $query->$method();
	}
	
	// define must be paired with rules
	public function get_new()
	{
		// define and instantiate
		$pejabats = new stdClass();
		
		$pejabats->id_ref_jabatan	= '';
		$pejabats->nm_pejabat		= '';
		return $pejabats;
	}

}
