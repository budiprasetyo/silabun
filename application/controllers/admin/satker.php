<?php
/*
 * satker.php
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




class Satker extends Admin_Controller
{

	/**
	 * Constructor of class Satker.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_satker');
	}

	public function index()
	{
		// fetch all pejabats
		$this->data['satkers'] = $this->m_satker->get_join();
		// path to page folder view
		$this->data['subview'] = 'admin/satker/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function edit($id = NULL)
	{
		
		$back_link = $this->uri->segment(2);
		// check existing satkers or create one
		if ($id) {
			$this->data['id']			= $id;
			$this->data['back_link'] 	= $back_link;
			$this->data['satker'] 		= $this->m_satker->get($id);
			count($this->data['satker']) || $this->data['errors'][] = 'satker tidak ditemukan';
			$this->data['kementerian'] = $this->m_satker->get_kementerian_satker($id);
			$this->data['lokasi'] = $this->m_satker->get_provinsi_satker($id);
		}
		else {
			$this->data['id']			= null;
			$this->data['satker'] 		= $this->m_satker->get_new();
			$this->data['back_link'] 	= $back_link;
		}
		
		// load referensi model
		$this->load->model('m_referensi');
		// get data for dropdown 
		$this->data['get_kementerians'] = $this->m_referensi->get_kementerian();
		$this->data['get_kementerian_units'] = $this->m_referensi->get_kementerian_unit();
		$this->data['get_provinsis'] = $this->m_referensi->get_provinsi();
		$this->data['get_provinsi_kabkotas'] = $this->m_referensi->get_provinsi_kabkota();
		
		// rules section
		$rules = $this->m_satker->rules;
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() === TRUE ) {
			// get id_ref_kppn
			$ref_kppn = $this->m_referensi->get_kppn($this->data['id_ref_satker']);
			// convert checkbox, note: if satker aktif is off, lpj_status should be off too
			if($this->input->post('aktif') == 'on')
			{
				$aktif 	= 1;
				$this->input->post('lpj_status') == 'on' ? $lpj_status 	= 1 : $lpj_status = 0;
			}
			else
			{
				$aktif = 0;
				$lpj_status = 0;
			}
			
			// populate fields
			$data = $this->m_satker->array_from_post(array('id_ref_unit','id_ref_kabkota','kd_satker','no_karwas','nm_satker'));
			$data['id_ref_kppn'] 	= $ref_kppn->id_ref_kppn;
			$data['aktif'] 			= $aktif;
			$data['lpj_status'] 	= $lpj_status;
			
			
			// save data
			$this->m_satker->save($data, $id);
			// redirect to satker
			redirect('admin/satker');
			
			
		}
		
		// path to satker folder view
		$this->data['subview'] = 'admin/satker/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
		
	}
	
	public function status_satker($id, $aktif = FALSE, $lpj_status = FALSE)
	{
		$aktif = $this->uri->segment(5);
		$lpj_status = $this->uri->segment(6);
		
		
		if ($aktif === 'TRUE') 
		{
			// change data in aktif field
			$this->m_satker->update_status_satker($id, TRUE);
		}
		
		if ($lpj_status === 'TRUE') 
		{
			// change data in lpj_status field
			$this->m_satker->update_status_satker($id, FALSE, TRUE);
		}
		
		// redirect to satker
		redirect('admin/satker');
	}
	
	public function _unique_satker($string)
	{
		// don't validate if satker already exists
		// unless it's the satker for current user
		
		$id = $this->uri->segment(4);
		$this->db->where('kd_satker', $this->input->post('kd_satker'));
		// if not getting id, choose another id, and be careful of id's name
		!$id || $this->db->where('id_ref_satker !=' , $id);
		$satker = $this->m_satker->get();
		
		if (count($satker)) 
		{
			$this->form_validation->set_message('_unique_satker', ' %s harus unique, kode satker ini sudah ada');
			// bring back to default
			return FALSE;
		}
		else
		{
			// bring back to default
			return TRUE;
		}
	}
}
