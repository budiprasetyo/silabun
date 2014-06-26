<?php
/*
 * m_user.php
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


class M_user extends MY_Model
{
	protected $_table_name 		= 'users';
	protected $_primary_key 	= 'id_users';
	protected $_order_by 		= 'username';
	public $rules 				= array(
						'username' => array( 
							'field' => 'username', 
							'label' => 'username', 
							'rules' => 'trim|required|max_length[30]|xss_clean'
						),
						'password' => array( 
							'field' => 'password', 
							'label' => 'password', 
							'rules' => 'trim|required|max_length[128]'
						)
	);
	public $rules_admin			= array(
						'email' => array( 
							'field' => 'email', 
							'label' => 'email', 
							'rules' => 'trim|required|valid_email|callback__unique_email|max_length[120]|xss_clean'
						),
						'username' => array( 
							'field' => 'username', 
							'label' => 'username', 
							'rules' => 'trim|required|max_length[30]|xss_clean'
						),
						'password_hash' => array( 
							'field' => 'password_hash', 
							'label' => 'password', 
							'rules' => 'trim|matches[password_conf]|max_length[128]'
						),
						'password_conf' => array( 
							'field' => 'password_conf', 
							'label' => 'password confirmation', 
							'rules' => 'trim|matches[password_hash]|max_length[128]'
						),
						'last_login' => array( 
							'field' => 'last_login', 
							'label' => 'last login', 
							'rules' => 'trim|xss_clean'
						),
						'last_ip' => array( 
							'field' => 'last_ip', 
							'label' => 'last IP', 
							'rules' => 'trim|max_length[40]|xss_clean'
						),
						'created_on' => array( 
							'field' => 'created_on', 
							'label' => 'created on', 
							'rules' => 'trim|xss_clean'
						),
						'deleted' => array( 
							'field' => 'deleted', 
							'label' => 'deleted', 
							'rules' => 'trim|max_length[1]|is_natural'
						),
						'reset_by' => array( 
							'field' => 'reset_by', 
							'label' => 'reset by', 
							'rules' => 'trim|max_length[10]|xss_clean'
						),
						'banned' => array( 
							'field' => 'banned', 
							'label' => 'banned', 
							'rules' => 'trim|max_length[1]|xss_clean'
						),
						'ban_message' => array( 
							'field' => 'ban_message', 
							'label' => 'ban message', 
							'rules' => 'trim|max_length[255]|xss_clean'
						),
						'display_name' => array( 
							'field' => 'display_name', 
							'label' => 'display name', 
							'rules' => 'trim|max_length[255]|xss_clean'
						),
						'display_name_changed' => array( 
							'field' => 'display_name_changed', 
							'label' => 'display name changed', 
							'rules' => 'trim|max_length[10]|xss_clean'
						),
						'timezone' => array( 
							'field' => 'timezone', 
							'label' => 'timezone', 
							'rules' => 'trim|max_length[4]|xss_clean'
						),
						'language' => array( 
							'field' => 'language', 
							'label' => 'language', 
							'rules' => 'trim|max_length[20]|xss_clean'
						),
						'active' => array( 
							'field' => 'active', 
							'label' => 'active', 
							'rules' => 'trim|is_natural|max_length[1]|xss_clean'
						),
						'activate_hash' => array( 
							'field' => 'activate_hash', 
							'label' => 'activate hash', 
							'rules' => 'trim|max_length[40]|xss_clean'
						),
						'password_iterations' => array( 
							'field' => 'password_iterations', 
							'label' => 'password iterations', 
							'rules' => 'trim|integer|max_length[4]|xss_clean'
						),
						'force_password_reset' => array( 
							'field' => 'force_password_reset', 
							'label' => 'force password reset', 
							'rules' => 'trim|is_natural|max_length[1]|xss_clean'
						)
	);
	
	/**
	 * Constructor of class M_user.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{
		// get data from cms_users table
		$user = $this->get_join(array(
							'username' => $this->input->post('username'),
							'password_hash' => $this->hash($this->input->post('password'))
							), TRUE);
		
		if (count($user)) 
		{
			// remove [0] array
			$user = array_shift($user);
			
			// login user
			$data = array(
					'id_users' 		=> $user->id_users,
					'username' 		=> $user->username,
					'display_name' 	=> $user->display_name,
					'id_ref_satker' => $user->id_ref_satker,
					'id_entities'	=> $user->id_entities,
					'loggedin'		=> TRUE,
					);
			var_dump($data);
			$this->session->set_userdata($data);
			return TRUE;
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
	}
	
	public function loggedin()
	{
		return (bool) $this->session->userdata('loggedin');
	}
	
	public function get_join($key, $val = FALSE, $single = FALSE)
	{
		$query = $this->db->select('users.id_users')
							->select('users.username')
							->select('users.display_name')
							->select('user_entity.id_ref_satker')
							->select('user_entity.id_entities')
							->from('users')
							->join('user_entity', 'users.id_users = user_entity.id_users', 'left');
							
		// Limit results with conditional where
        if (! is_array($key)) {
			
            $query = $this->db->where(htmlentities($key), htmlentities($val));
            
        }
        else {
            $key = array_map('htmlentities', $key); 
            $where_method = $orwhere == TRUE ? 'or_where' : 'where';
            
            $query = $this->db->$where_method($key);
        }
		
		$query = $this->db->get();
		
		// Return results
        $single == FALSE || $this->db->limit(1);
        $method = $single ? 'row' : 'result';
		return $query->$method();
	}
	
	public function get_new()
	{
		$user = new stdClass();
		
		$user->username			= '';
		$user->password_hash	= '';
		$user->password_conf	= '';
		$user->email			= '';
		return $user;
	}
	
	public function hash($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}
}
