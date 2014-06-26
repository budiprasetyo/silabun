<?php
/*
 * roles.php
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


class Roles extends Admin_Controller
{

	/**
	 * Constructor of class roles.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_roles');
	}

	public function index()
	{
		// fetch all roles
		$this->data['roles'] = $this->m_roles->get_join();
		// path to page folder view
		$this->data['subview'] = 'admin/roles/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function edit($id = NULL)
	{
		
		$back_link = $this->uri->segment(2);
		// check existing roles or create one
		if ($id) {
			$this->data['id']			= $id;
			$this->data['back_link'] 	= $back_link;
			count($this->data['roles']) || $this->data['errors'][] = 'pengaturan wewenang tidak ditemukan';
			$this->data['dropdown'] 	= $this->m_roles;
		}
		else {
			$this->data['id']			= null;
			$this->data['roles'] 		= $this->m_roles->get_new();
			$this->data['back_link'] 	= $back_link;
			$this->data['dropdown'] 	= $this->m_roles;
		}

		$id == NULL || $this->data['roles'] = $this->m_roles->get_join($id, TRUE);
		
		// rules section
		$rules = $this->m_roles->rules;
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() === TRUE ) {
			
			// get kd_satker post
			$id_entities 	= $this->input->post('id_entities');
			// get id of satker
			//~ $entities = $this->m_roles->get_by('kd_satker', $kd_satker, FALSE, TRUE, 'ref_satker');
			//~ $id_ref_satker = $ref_satker->id_ref_satker;
			
			// populate fields
			$data = array(
							'id_entities'	=> $id_entities,
							'roles_desc'	=> $this->input->post('roles_desc')
			);
			
			// save data
			$this->m_roles->save($data, $id);
			// redirect to users roles
			redirect('admin/roles');
			
		}
		
		// path to roles folder view
		$this->data['subview'] = 'admin/roles/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
		
	}
	
	public function delete($id)
	{
		$this->m_roles->delete($id);
		redirect('admin/roles');
	}
	
	// not used
	public function _satker_exists($kdsatker)
	{
		
		$this->db->where('kd_satker', $this->input->post('kd_satker'));
		$satker = $this->m_roles->get(FALSE, 'ref_satker', 'id_ref_satker');
		
		
		if (count($satker)) 
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('_satker_exists', 'Kode satker %s tidak ditemukan');
			return FALSE;
		}
		
	}
}
