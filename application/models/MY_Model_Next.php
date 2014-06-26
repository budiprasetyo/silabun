<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * MY_Model_Next.php
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

class MY_Model extends CI_Model {
    
     /**
     * The database table to use.
     * @var string
     */
    public $table_name = '';
    
    /**
     * Primary key field
     * @var string
     */
    public $primary_key = '';
    
    /**
     * The filter that is used on the primary key. Since most primary keys are 
     * autoincrement integers, this defaults to intval. On non-integers, you would 
     * typically use something like xss_clean of htmlentities.
     * @var string
     */
    public $primaryFilter = 'intval'; // htmlentities for string keys
    
    /**
     * Order by fields. Default order for this model.
     * @var string
     */
    public $order_by = '';
    
    function __construct() {
        parent::__construct();
    }
    
     /**
     * Get one record, based on ID, or get all records. You can pass a single 
     * ID, an array of IDs, or no ID (in which case the  method will return 
     * all records)
     * 
     * If you request a single ID the result will be returned as an associative array:
     * array('id' => 1, 'title' => 'Some title')
     * In all other cases the result wil be returned as an array of arrays
     * array(array('id' => 1, 'title' => 'Some title'), array('id' => 2, 'title' => 'Some other title'))
     * 
     * Thanks to Zack Kitzmiller who suggested some improvements.
     * 
     * @param mixed $id An ID or an array of IDs (optional, default = FALSE)
     * @return array
     * @author Joost van Veen
     */
    public function get ($ids = FALSE){
        
        // Set flag - if we passed a single ID we should return a single record
        $single = $ids == FALSE || is_array($ids) ? FALSE : TRUE;
        
        // Limit results to one or more ids
        if ($ids !== FALSE) {
            
            // $ids should always be an array
            is_array($ids) || $ids = array($ids); 
            
            // Sanitize ids
            $filter = $this->primaryFilter;
            $ids = array_map($filter, $ids); 
            
            $this->db->where_in($this->primary_key, $ids);
        }
        
        // Set order by if it was not already set
        count($this->db->ar_orderby) || $this->db->order_by($this->order_by);
        
        // Return results
        $single == FALSE || $this->db->limit(1);
        $method = $single ? 'row_array' : 'result_array';
        return $this->db->get($this->table_name)->$method();
    }
    
    /**
     * Get records by one or more keys.
     * 
     * @param mixed $key can be a string, in which case teh value is in $val. Can also ba a key => value pair array.
     * @param mixed $val The value for a set set $key
     * @param boolean $orwhere
     * @param boolean $single
     * @return void
     * @author Joost van Veen
     */
    public function get_by ($key, $val = FALSE, $orwhere = FALSE, $single = FALSE) {
        
        // Limit results
        if (! is_array($key)) {
            $this->db->where(htmlentities($key), htmlentities($val));
        }
        else {
            $key = array_map('htmlentities', $key); 
            $where_method = $orwhere == TRUE ? 'or_where' : 'where';
            $this->db->$where_method($key);
        }
        
        // Return results
        $single == FALSE || $this->db->limit(1);
        $method = $single ? 'row_array' : 'result_array';
        return $this->db->get($this->table_name)->$method();
    }
    
     /**
     * Get one or more records as a key=>value pair array.
     *
     * @param string $key_field The field that holds the key
     * @param string $value_field The field that holds the value
     * @param mixed $id An ID or an array of IDs (optional, default = FALSE)
     * @uses get
     * @return array
     * @author Joost van Veen
     */
    public function get_key_value ($key_field, $value_field, $ids = FALSE){
        
        // Get records
        $this->db->select($key_field . ', ' . $value_field);
        $result = $this->get($ids);
        
        // Turn results into key=>value pair array.
        $data = array();
        if (count($result) > 0) {
            
            if ($ids != FALSE && !is_array($ids)) {
                $result = array($result);
            }
            
            foreach ($result as $row) {
                $data[$row[$key_field]] = $row[$value_field];
            }
        }
        
        return $data;
    }
    
    /**
     * Return records as an associative array, where the key is the value of the 
     * first key for that record. Typical return array:
     * $return[18] = array(18 => array('id' => 18,'title' => 'Example record')
     * 
     * @param integer $id An ID or an array of IDs (optional, default = 0)
     * @uses get
     * @return array
     * @author Joost van Veen
     */
    public function get_assoc ($ids = FALSE){
        // Get records
        $result = $this->get($ids);
        
        // Turn results into an associative array.
        if ($ids != FALSE && !is_array($ids)) {
            $result = array($result);
        }
        $data = $this->to_assoc($result);
        
        return $data;
    }
    
    /**
     * Turn a multidimensional array into an associative array, where the index 
     * equals the value of the first index. 
     * 
     * Example output:
     * array(0 => array('pag_id' => 23, 'pag_title' => 'foo'))
     * becomes
     * array(23 => array('pag_id' => 23, 'pag_title' => 'foo'))
     * @param $array
     * @return array
     * @author Joost van Veen
     */
    public function to_assoc($result = array()){
        
        $data = array();
        if (count($result) > 0) {
            
            foreach ($result as $row) {
                $tmp = array_values(array_slice($row, 0, 1));
                $data[$tmp[0]] = $row;
            }
        }  

        return $data;
    }
    
    /**
     * Save or update a record.
     * 
     * @param array $data
     * @param mixed $id Optional
     * @return mixed The ID of the saved record
     * @author Joost van Veen
     */
    public function save($data, $id = FALSE) {
        
        if ($id == FALSE) {
            
            // This is an insert
            $this->db->set($data)->insert($this->table_name);
        }
        else {
            
            // This is an update
            $filter = $this->primaryFilter;
            $this->db->set($data)->where($this->primary_key, $filter($id))->update($this->table_name);
        }
        
        // Return the ID
        return $id == FALSE ? $this->db->insert_id() : $id;
    }
    
    /**
     * Delete one or more records by ID
     * @param mixed $ids
     * @return void
     * @author Joost van Veen
     */
    public function delete($ids){
        
        $filter = $this->primaryFilter; 
        $ids = ! is_array($ids) ? array($ids) : $ids;
        
        foreach ($ids as $id) {
            $id = $filter($id);
            if ($id) {
                $this->db->where($this->primary_key, $id)->limit(1)->delete($this->table_name);
            }
        }
    }

    /**
     * Delete one or more records by another key than the ID
     * @param string $key
     * @param mixed $value
     * @return void
     * @author Joost van Veen
     */
    public function delete_by($key, $value){
        
        if (empty($key)) {
            return FALSE;
        }
        
        $this->db->where(htmlentities($key), htmlentities($value))->delete($this->table_name);
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>untitled</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.23.1" />
</head>

<body>
	
</body>

</html>
