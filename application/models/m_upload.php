<?php


/*
 * m_upload.php
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


class M_upload extends MY_Model
{

	protected $_table_name 		= 'status_kirim_row';
	protected $_primary_key 	= 'id_status_kirim_row';
	protected $_order_by 		= 'id_status_kirim_row';
	public $rules				= array(
					'upload'	=> array(
						'field'	=> 'upload_lpj',
						'label'	=> 'Upload Data',
						'rules'	=> 'trim|required|max_length[11]'
					)
	);
	
	// define must be paired with rules
	public function get_new()
	{
		// define and instantiate
		$upload = new stdClass();
		
		$upload->upload_lpj		= '';
		return $upload;
	}
	
	public function get_uploaded($kd_kppn)
	{
		$query = $this->db->select('t_satker.kddept')
						  ->select('t_satker.kdunit')
						  ->select('t_satker.kdsatker')
						  ->select('t_satker.nokarwas')
						  ->select('status_kirim_row.id_status_kirim_row')
						  ->select('status_kirim_row.tahun')
						  ->select('status_kirim_row.bulan')
						  ->select('status_kirim_row.timestamp')
						  ->select('status_kirim_row.pos_kirim')
						  ->from('t_satker')
						  ->join('status_kirim_row', 't_satker.kdsatker = status_kirim_row.kd_satker', 'left')
						  ->where('t_satker.kdkppn', $kd_kppn)
						  ->get();
		
		if ($query->num_rows() > 0) 
		{
			return $query;
			$query->free_result();
		}
	}
	
	public function import_csv($path, $tables)
	{
		$query = $this->db->query("LOAD DATA INFILE ? INTO TABLE ".$tables." FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n'", array($path));
		
		return $query;
	}
}
