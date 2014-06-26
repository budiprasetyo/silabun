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
	
	public function index()
	{
		redirect('admin/user/home', 'refresh');
	}
	
	public function login()
	{
		// taken from some properties in m_user model
		$dashboard = 'admin/dashboard/home';
		// rules section
		$rules = $this->m_user->rules;
		$this->form_validation->set_rules($rules);
		
		// process form
		if ( $this->form_validation->run() == TRUE ) {
			
			if($this->m_user->login() == TRUE)
			{
				redirect($dashboard);
			}
			else
			{
				$this->session->set_flashdata('error', 'Combination of username or password may be wrong');
			}
		}
		
		// load login view
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
		// fetch all users
		$this->data['users'] = $this->m_user->get();
		// path to user folder view
		$this->data['subview'] = 'admin/user/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function edit($id = NULL)
	{
		// check existing users or create one
		if ($id) {
			$this->data['user'] = $this->m_user->get($id);
			count($this->data['user']) || $this->data['errors'][] = 'user could not be found';
		}
		else {
			$this->data['user'] = $this->m_user->get_new();
		}
		
		$id == NULL || $this->data['users'] = $this->m_user->get($id);
		
		// rules section
		$rules = $this->m_user->rules_admin;
		// additional rules
		$id || $rules['password_hash']['rules'] .= '|required';
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() == TRUE ) {
			// populate fields
			$data = $this->m_user->array_from_post(array('username','password_hash','email'));
			// specific action for password hash
			$data['password_hash'] = $this->m_user->hash($data['password_hash']);
			$this->m_user->save($data, $id);
			// redirect to users home
			redirect('admin/user/home');
		}
		// path to user folder view
		$this->data['subview'] = 'admin/user/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function delete($id)
	{
		$this->m_user->delete($id);
		redirect('admin/user/home');
	}

	public function _unique_email($string)
	{
		// don't validate if email already exists
		// unless it's the email for current user
		
		$id = $this->uri->segment(4);
		$this->db->where('email', $this->input->post('email'));
		// if not getting id, choose another id, and be careful of id's name
		!$id || $this->db->where('id_users !=' , $id);
		$user = $this->m_user->get();
		
		if (count($user)) 
		{
			$this->form_validation->set_message('_unique_email', '%s should be unique');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
