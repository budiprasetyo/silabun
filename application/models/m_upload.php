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

	protected $_table_name 		= 'd_lpjk';
	protected $_primary_key 	= 'lpjk_id';
	protected $_order_by 		= 'lpjk_id';
	public $rules				= array(
					'categories'	=> array(
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
	
	public function import_csv($path, $tables)
	{
		$query = $this->db->query("LOAD DATA INFILE ? INTO TABLE ".$tables." FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n'", array($path));
		
		return $query;
	}
}
