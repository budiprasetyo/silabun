<?php
/*
 * user.php
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


class User extends Admin_Controller
{

	/**
	 * Constructor of class User.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function login()
	{
		// taken from some properties in m_user model
		$dashboard = 'admin/dashboard/home';
		// rules section
		$rules = $this->m_user->rules;
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() == TRUE ) {
			
			if($this->m_user->login() == TRUE)
			{
				redirect($dashboard);
			}
			else
			{
				$this->session->set_flashdata('error', 'Kombinasi antara username dan password Anda tidak sesuai');
			}
		}
		$this->data['subview'] = 'admin/user/login';
		$this->load->view('admin/template/_layout_modal', $this->data);
	}
	
	public function logout()
	{
		$this->m_user->logout();
		redirect('admin/user/login', 'refresh');
	}
	
	public function home()
	{	
		$this->data['users'] = $this->m_user->get();
		// path to user folder view
		$this->data['subview'] = 'admin/user/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function edit($id = NULL)
	{
		$id == NULL || $this->data['users'] = $this->m_user->get($id);
		// path to user folder view
		$this->data['subview'] = 'admin/user/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function delete($id)
	{
		
	}

	
}
