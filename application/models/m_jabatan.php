<?php
/*
 * m_jabatan.php
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




class M_jabatan extends MY_Model
{

	protected $_table_name 		= 'ref_jabatan';
	protected $_primary_key 	= 'id_ref_jabatan';
	protected $_order_by 		= 'id_ref_jabatan';
	public $rules				= array(
					'nm_jabatan'	=> array(
						'field'	=> 'nm_jabatan',
						'label'	=> 'Nama Jabatan',
						'rules'	=> 'trim|required|max_length[255]|xss_clean'
					),
					'is_boss'	=> array(
						'field'	=> 'is_boss',
						'label'	=> 'Apakah Pejabat',
						'rules'	=> 'trim|required|max_length[1]|xss_clean'
					)
	);
	
	// define must be paired with rules
	public function get_new()
	{
		// define and instantiate
		$jabatans = new stdClass();
		
		$jabatans->id_ref_jabatan	= '';
		$jabatans->id_entities		= '';
		$jabatans->nm_jabatan		= '';
		return $jabatans;
	}

}
