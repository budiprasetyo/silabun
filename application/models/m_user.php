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
							'label' => 'username/email', 
							'rules' => 'trim|required|xss_clean'
						),
						'password' => array( 
							'field' => 'password', 
							'label' => 'password', 
							'rules' => 'trim|required'
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
	
	public function hash($string)
	{
		return hash('sha512', $string . config_item('encryption_key'));
	}
}
