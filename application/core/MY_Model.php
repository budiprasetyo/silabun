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
	/**
	* The database table to use.
	* @var string
	*/
	protected $_table_name 		= '';
	
	/**
	* Primary key field
	* @var string
	*/
	protected $_primary_key 	= '';
	
	/**
	* The filter that is used on the primary key. Since most primary keys are
	* autoincrement integers, this defaults to intval. On non-integers, you would
	* typically use something like xss_clean of htmlentities.
	* @var string
	*/
	protected $_primary_filter 	= 'intval'; // htmlentities for string
	
	/**
	* Order by fields. Default order for this model.
	* @var string
	*/
	protected $_order_by 		= '';
	

	public $_rules 				= array();
	
	/**
	 * Timestamp variable when records created or updated
	 * @var string
	 */
	protected $_created_at		= '';
	protected $_updated_at		= '';
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
	
	/*
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
	*/
	
	public function get ($ids = FALSE, $order_by = FALSE){
        
        // Set flag - if we passed a single ID we should return a single record
        $single = $ids == FALSE || is_array($ids) ? FALSE : TRUE;
        
        // Limit results to one or more ids
        if ($ids !== FALSE) {
            
            // $ids should always be an array
            is_array($ids) || $ids = array($ids); 
            
            // Sanitize ids
            $filter = $this->_primary_filter;
            $ids = array_map($filter, $ids); 
            
            $this->db->where_in($this->_primary_key, $ids);
        }
        
        $this->_order_by;
        // Set order by if it was not already set
        count($this->db->ar_orderby) || $this->db->order_by($this->_order_by);
        
        $this->_table_name;
        // Return results
        $single == FALSE || $this->db->limit(1);
        $method = $single ? 'row' : 'result';
        return $this->db->get($this->_table_name)->$method();
    }
    
    public function get_by ($key, $val = FALSE, $orwhere = FALSE, $single = FALSE, $table_name = FALSE) {
        
        // Limit results with conditional where
        if (! is_array($key)) {
            $this->db->where(htmlentities($key), htmlentities($val));
        }
        else {
            $key = array_map('htmlentities', $key); 
            $where_method = $orwhere == TRUE ? 'or_where' : 'where';
            $this->db->$where_method($key);
        }
        
        // Get data with method row or result
        //~ $this->_table_name || $table_name == TRUE;
        $table = $table_name == TRUE ? $table_name : $this->_table_name;
        // Return results
        $single == FALSE || $this->db->limit(1);
        $method = $single ? 'row' : 'result';
        return $this->db->get($table)->$method();
    }
	
	
	public function save($data, $id = NULL)
	{
		// set timestamp 
		if ($this->_timestamps == TRUE) 
		{
			$now = date('Y-m-d H:i:s');
			$id || $data[$this->_created_at] = $now;
			$data[$this->_updated_at] = $now;
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
	 * @example		dropdown_get_name('ref_pejabat', $id, 'id_ref_pejabat', 'id_ref_jabatan', 'nm_jabatan', '- pilih jabatan -', 'ref_jabatan');
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
		$dropdown = "<select class='form-control autotab' tabindex='14' name=".$field_name.">";
		
		
		
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
	
	public function get_another($id = NULL, $single = FALSE)
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
}
