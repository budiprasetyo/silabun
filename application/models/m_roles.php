<?php
/*
 * m_roles.php
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



class M_roles extends MY_Model
{

	protected $_table_name 		= 'roles';
	protected $_primary_key 	= 'id_roles';
	protected $_primary_filter 	= 'intval';
	protected $_order_by 		= 'id_roles';
	public $rules				= array(
					'id_entities'	=> array(
						'field'	=> 'id_entities',
						'label'	=> 'Entitas',
						'rules'	=> 'trim|required|max_length[45]|xss_clean'
					),
					'roles_desc'	=> array(
						'field'	=> 'roles_desc',
						'label'	=> 'Deskripsi Wewenang',
						'rules'	=> 'trim|required|xss_clean|max_length[200]'
					)
	);
	
	
	public function get ($ids = FALSE, $table_name, $order_by){
        
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
        
        ! $order_by || $this->_order_by;
        // Set order by if it was not already set
        count($this->db->ar_orderby) || $this->db->order_by($order_by);
        
        ! $table_name || $this->_table_name;
        // Return results
        $single == FALSE || $this->db->limit(1);
        $method = $single ? 'row' : 'result';
        return $this->db->get($table_name)->$method();
    }
    
    public function get_by ($key, $val = FALSE, $orwhere = FALSE, $single = FALSE, $table_name) {
        
        // Limit results
        if (! is_array($key)) {
            $this->db->where(htmlentities($key), htmlentities($val));
        }
        else {
            $key = array_map('htmlentities', $key); 
            $where_method = $orwhere == TRUE ? 'or_where' : 'where';
            $this->db->$where_method($key);
        }
        
        ! $table_name || $this->_table_name;
        // Return results
        $single == FALSE || $this->db->limit(1);
        $method = $single ? 'row' : 'result';
        return $this->db->get($table_name)->$method();
    }
    
    public function get_join($ids = NULL, $single = FALSE)
	{
		
		$query = $this->db->select('entities.id_entities')
							->select('entities.entity_desc')
							->select('roles.id_roles')
							->select('roles.roles_desc')
							->from('roles')
							->join('entities', 'roles.id_entities = entities.id_entities', 'left');
							
		if($ids){
			$query = $this->db->where('id_roles', $ids);
		} 
		
		$query = $this->db->order_by('entities.id_entities')
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
		$roles = new stdClass();
		
		$roles->id_entities	= '';
		$roles->roles_desc	= '';
		return $roles;
	}
}
