<?php
/*
 * jabatan.php
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


class Jabatan extends Admin_Controller
{

	/**
	 * Constructor of class jabatan.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_jabatan');
	}

	public function index()
	{
		// fetch all jabatans, with id_entities filter
		$this->data['jabatans'] = $this->m_jabatan->get_by('id_entities', $this->data['id_entities'], FALSE, FALSE, 'ref_jabatan');
		// path to page folder view
		$this->data['subview'] = 'admin/jabatan/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}

	public function edit($id = NULL)
	{
		$back_link = $this->uri->segment(2);
		// check existing jabatans or create one
		if ($id) {
			$this->data['id']			= $id;
			$this->data['jabatans'] 	= $this->m_jabatan->get($id);
			$this->data['back_link'] 	= $back_link;
			count($this->data['jabatans']) || $this->data['errors'][] = 'jabatan tidak dapat ditemukan';
		}
		else {
			$this->data['id']			= null;
			$this->data['jabatans'] 	= $this->m_jabatan->get_new();
			$this->data['back_link'] 	= $back_link;
		}
		
		$id == NULL || $this->data['jabatans'] = $this->m_jabatan->get($id);
		
		// rules section
		$rules = $this->m_jabatan->rules;
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() == TRUE ) {
			// populate fields
			$data = $this->m_jabatan->array_from_post(array('nm_jabatan','is_boss'));
			// id_entities
			$data['id_entities'] = $this->data['id_entities'];
			// save data
			$this->m_jabatan->save($data, $id);
			// redirect to users jabatans
			redirect('admin/jabatan');
		}
		// path to jabatans folder view
		$this->data['subview'] = 'admin/jabatan/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
		
	}
	
	public function delete($id)
	{
		$this->m_jabatan->delete($id);
		redirect('admin/jabatan');
	}
}
