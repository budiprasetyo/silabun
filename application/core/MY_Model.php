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
}
