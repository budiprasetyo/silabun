<?php
/*
 * pejabat.php
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




class Pejabat extends Admin_Controller
{

	/**
	 * Constructor of class Pejabat.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_pejabat');
	}

	public function index()
	{
		// fetch all pejabats
		$this->data['pejabats'] = $this->m_pejabat->get_join();
		// path to page folder view
		$this->data['subview'] = 'admin/pejabat/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}

	public function edit($id = NULL)
	{
		
		$back_link = $this->uri->segment(2);
		// check existing roles or create one
		if ($id) {
			$this->data['id']			= $id;
			$this->data['back_link'] 	= $back_link;
			count($this->data['pejabats']) || $this->data['errors'][] = 'pengaturan pejabat tidak ditemukan';
			$this->data['dropdown'] 	= $this->m_pejabat;
		}
		else {
			$this->data['id']			= null;
			$this->data['pejabats'] 	= $this->m_pejabat->get_new();
			$this->data['back_link'] 	= $back_link;
			$this->data['dropdown'] 	= $this->m_pejabat;
		}

		$id == NULL || $this->data['pejabats'] = $this->m_pejabat->get_join($id, TRUE);
		
		// rules section
		$rules = $this->m_pejabat->rules;
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() === TRUE ) {
			
			// get id_ref_pejabat post
			$id_ref_jabatan 	= $this->input->post('id_ref_jabatan');
			
			// populate fields
			$data = array(
							'id_ref_jabatan'=> $id_ref_jabatan,
							'id_ref_satker'	=> $this->data['id_ref_satker'],
							'nm_pejabat'	=> $this->input->post('nm_pejabat')
			);
			
			// save data
			$this->m_pejabat->save($data, $id);
			// redirect to users pejabat
			redirect('admin/pejabat');
			
		}
		
		// path to pejabat folder view
		$this->data['subview'] = 'admin/pejabat/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
		
	}
	
	public function delete($id)
	{
		$this->m_pejabat->delete($id);
		redirect('admin/pejabat');
	}
}
