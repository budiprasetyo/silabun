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
	protected $_table_name 		= 'cms_users';
	protected $_primary_key 	= 'users_id';
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
						'role_id' => array( 
							'field' => 'role_id', 
							'label' => 'role', 
							'rules' => 'trim|required|is_natural|max_length[5]|xss_clean'
						),
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
		$user = $this->get_by(array(
							'username' => $this->input->post('username'),
							'password_hash' => $this->hash($this->input->post('password'))
							), TRUE);
		if (count($user)) 
		{
			// login user
			$data = array(
					'users_id' 		=> $user->users_id,
					'role_id' 		=> $user->role_id,
					'email' 		=> $user->email,
					'username' 		=> $user->username,
					'password_hash' => $user->password_hash,
					'display_name' 	=> $user->display_name,
					'loggedin'		=> TRUE,
					);
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
	
	public function get_new()
	{
		$user = new stdClass();
		
		$user->role_id	= '';
		$user->role_id	= '';
		$user->role_id	= '';
		$user->role_id	= '';
		$user->role_id	= '';
		$user->role_id	= '';
		$user->role_id	= '';
		$user->role_id	= '';
		
	}
	
	public function hash($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}
}
