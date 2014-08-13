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
		// get entity
		$this->data['dropdown'] 	= $this->m_user;
		
		// if register/signup user
		if ( $this->input->post('register') === 'user' ) 
		{
			// rules section
			$rules = $this->m_user->rules_signup;
			$this->form_validation->set_rules($rules);
			
			if ( $this->form_validation->run() == TRUE )
			{
				$now = date('Y-m-d H:i:s');
				
				// populate fields
				$user = $this->m_user->array_from_post(array('username','password_hash','email','display_name'));
				// specific action for password hash
				$user['password_hash'] = $this->m_user->hash($user['password_hash']);
				$user['last_ip'] = $this->session->userdata['ip_address'];
				$user['created_on'] = $now;
				// save user data
				$id = $this->m_user->save($user);
				
				$this->load->model('m_referensi');
				$entity = $this->m_user->array_from_post(array('nip', 'id_entities'));
				$entity['id_users'] = $id;
				$entity['created_at'] = $now;
				$entity['id_ref_satker'] = $this->m_referensi->get_ref_satker($this->input->post('kd_satker'))->id_ref_satker;
				// instantiate m_user
				$this->m_user->initialize('user_entity', 'id_user_entity');
				// save user entity
				$this->m_user->save($entity);
				
			}
		} 
		else 
		{
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
		$this->data['users'] = $this->m_user->get_join('user_entity.id_ref_satker', $this->data['id_ref_satker'], FALSE);
		// path to user folder view
		$this->data['subview'] = 'admin/user/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function edit($id = NULL)
	{
		$this->data['back_link'] = $this->uri->segment(2);
		// check existing users or create one
		if ($id) {
			// when using get_join, remember you should use array_shift in edit method ;-)
			$this->data['user'] = array_shift($this->m_user->get_join( array( 'users.id_users' => $id, 'user_entity.id_ref_satker' => $this->data['id_ref_satker'] ), TRUE ));
			var_dump($this->data['user']);
			count($this->data['user']) || $this->data['errors'][] = 'user could not be found';
			$this->data['dropdown'] 	= $this->m_user;
		}
		else {
			$this->data['user'] = $this->m_user->get_new();
			$this->data['dropdown'] 	= $this->m_user;
		}
		
		$id == NULL || $this->data['users'] = $this->m_user->get($id);
		
		// rules section
		$rules = $this->m_user->rules_admin;
		// additional rules
		$id || $rules['password_hash']['rules'] .= '|required';
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() == TRUE ) {
			//~ var_dump($id);
			
			$now = date('Y-m-d H:i:s');
			// populate fields to save to users table
			$user = $this->m_user->array_from_post(array('username','password_hash','email','display_name'));
			// specific action for password hash
			$user['password_hash'] = $this->m_user->hash($user['password_hash']);
			$user['last_ip'] = $this->session->userdata['ip_address'];
			$user['created_on'] = $now;
			// save user data
			$id_users = $this->m_user->save($user, $id);
			
			// populate fields to save to user_entity table
			$entity = $this->m_user->array_from_post(array('nip'));
			$entity['id_users'] = $id_users ? $id_users : NULL;
			// get id_user_entity
			$user_entity = $this->m_user->get_id_user_entity($entity['id_users']);
			$entity['id_user_entity'] = $user_entity->id_user_entity;
			$entity['created_at'] = $now;
			$entity['id_ref_satker'] = $this->data['id_ref_satker'];
			$entity['id_entities'] = $this->data['id_entities'];
			// instantiate m_user
			$this->m_user->initialize('user_entity', 'id_user_entity');
			// save user entity
			$this->m_user->save($entity, $entity['id_user_entity']);
			
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
	
	public function _unique_nip($string)
	{
		// don't validate if email already exists
		// unless it's the email for current user
		
		$id = $this->uri->segment(4);
		$this->m_user->_order_by = 'id_user_entity';
		$this->m_user->_table_name = 'user_entity';
		$this->db->where('nip', $this->input->post('nip'));
		// if not getting id, choose another id, and be careful of id's name
		!$id || $this->db->where('id_users !=' , $id);
		$user_entity = $this->m_user->get();
		
		if (count($user_entity)) 
		{
			$this->form_validation->set_message('_unique_nip', '%s should be unique');
			// bring back to default
			$this->m_user->_order_by = 'id_users';
			$this->m_user->_table_name = 'users';
			return FALSE;
		}
		else
		{
			// bring back to default
			$this->m_user->_order_by = 'id_users';
			$this->m_user->_table_name = 'users';
			return TRUE;
		}
	}
	
	public function generate_user()
	{
		// load generator_helper
		$this->load->helper('generator');
		// execute generate user
		if($this->input->post('submit') === 'Generate')
		{
			$generate = $this->input->post();
			if($generate)
			{
				$this->m_user->generate_user($generate);
			}
		}
		
		// load m_referensi
		$this->load->model('m_referensi');
		// fetch all entities for dropdown
		$this->data['entities'] = $this->m_referensi->get_all_entities();
		
		// fetch all users
		$this->data['users'] = $this->m_user->get_join(NULL, FALSE, FALSE);
		// path to user folder view
		$this->data['subview'] = 'admin/user/signup';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
}
