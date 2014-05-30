<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * MY_Model.php
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




/**
 * @brief 		MY_Model
 * 
 * @package 
 * @subpackage
 * @license 	GPL
 * @author 		Budi Prasetyo modified from Joost Van Veen
 * 
 */
class MY_Model extends CI_Model
{
	protected $_table_name 		= '';
	protected $_primary_key 	= '';
	protected $_primary_filter 	= 'intval';
	protected $_order_by 		= '';
	public $_rules 				= array();
	protected $_timestamps 		= FALSE;
	
	/**
	 * Constructor of class MY_Model.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	public function array_from_post($fields)
	{
		$data = array();
		foreach ($fields as $field) 
		{
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}

	public function get($id = NULL, $single = FALSE)
	{
		if ($id != NULL)
		{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}
		elseif ($single == TRUE) {
			$method = 'row';
		}
		else {
			$method = 'result';
		}
		
		if (!count($this->db->ar_orderby)) 
		{
			$this->db->order_by($this->_order_by);
		}
		
		return $this->db->get($this->_table_name)->$method();
	}
	
	public function get_by($where, $single = FALSE)
	{
		$this->db->where($where);
		return $this->get(NULL, $single);
	}
	
	public function save($data, $id = NULL)
	{
		// set timestamp 
		if ($this->_timestamps == TRUE) 
		{
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = $now;
			$data['modified'] = $now;
		}
		// insert
		if ( $id === NULL ) {
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		// update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}
		 
		return $id;
	}
	
	public function delete($id)
	{
		$filter = $this->_primary_filter;
		$id		= $filter($id);
		
		if (!$id) 
		{
			return FALSE;
		}
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	}
	
	/**
	 * @brief 		dropdown_get_name
	 * @description	make easier when generating dropdown, whether edit module or insert module
	 * @example		dropdown_get_name('cms_categories', $id, 'categories_id', 'page_type_id', 'page_type', '- choose categories -', 'cms_page_type'); 
	 * @param 		str	$table_name 
	 * @param 		int	$id
	 * @param 		str	$primary_field
	 * @param 		str	$select_name is used for select name and should be same with name field in table reference
	 * @param 		str	$option_empty
	 * @param 		str	$table_reference
	 * @returns 	$dropdown
	 * 
	 * 
	 */
	public function dropdown_get_name($table_name 	= NULL, 
									$id 			= NULL, 
									$primary_field 	= NULL, 
									$field_name 	= NULL,
									$select_name 	= NULL,
									$option_empty 	= NULL,
									$table_reference= NULL)
	{
		$dropdown = "<select class='form-control autotab' name='tabs1_7' tabindex='14' name=".$select_name.">";
		
		
		
		$query_row = $this->db->where($primary_field, $id)
								->get($table_name)->row();
		
		if ($query_row->$field_name == null)
		{
			$dropdown .= "<option value='' selected='selected'>".$option_empty."</option>";
		}
		
		$query_results = $this->db->get($table_reference)->result();
		
		foreach ($query_results as $query_result) 
		{
			if($query_result->$field_name === $query_row->$field_name) 
			{
				$dropdown .= "<option value='".$query_result->$field_name."' selected='selected'>".$query_result->$select_name."</option>";
			}
			else 
			{
				$dropdown .= "<option value='".$query_result->$field_name."'>".$query_result->$select_name."</option>";
			}
			
		}
		
		$dropdown .= "</select>";
		
		echo $dropdown;
	}
}
