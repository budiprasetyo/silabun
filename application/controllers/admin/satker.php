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
		$this->load->helper('datetime');
		// get year
		if ( $this->input->post('year') == TRUE ) {
			$this->data['year'] = $this->input->post('year');
		}
		elseif ( $this->session->flashdata('year') == TRUE ) {
			$this->data['year'] = $this->session->flashdata('year');
		}
		// from back_link
		elseif ( $this->uri->segment(4) == TRUE ){
			$this->data['year'] = $this->uri->segment(4);
		}
		else {
			$this->data['year'] = date('Y');
		}
		
		// get month
		if ( $this->input->post('month') == TRUE ) {
			$this->data['month'] = $this->input->post('month');
		}
		elseif ( $this->session->flashdata('month') == TRUE ) {
			$this->data['month'] = $this->session->flashdata('month');
		}
		// from back_link
		elseif ( $this->uri->segment(5) == TRUE ){
			$this->data['month'] = $this->uri->segment(5);
		}
		else {
			// calculation month if january
			$this->data['month'] = ( date('m', strtotime('-1 month')) ?: 12 );
		}
		
		// fetch all satkers
		$this->data['satkers'] = $this->m_satker->get_join(FALSE, $this->data['year'], $this->data['month']);
		// path to page folder view
		$this->data['subview'] = 'admin/satker/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function edit($id = null)
	{
		$back_link = $this->uri->segment(2);
		// id
		$id		= $this->uri->segment(6) == TRUE ? $this->uri->segment(6) : null;
		// foreign key
		$foreign_key 		= $this->uri->segment(7) == TRUE ? $this->uri->segment(7) : null;
		// year
		$this->data['year']	= $this->uri->segment(4);
		// month
		$this->data['month']	= $this->uri->segment(5);
		
		// check existing satkers or create one
		if ($id) {
			$this->data['id']			= $id;
			$this->data['back_link'] 	= $back_link;
			$this->data['satker'] 		= $this->m_satker->get_join(TRUE, $this->data['year'], $this->data['month'], $id);
			count($this->data['satker']) || $this->data['errors'][] = 'satker tidak ditemukan';
			$this->data['kementerian'] 	= $this->m_satker->get_kementerian_satker($id);
			$this->data['lokasi'] 		= $this->m_satker->get_provinsi_satker($id);
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
				$this->input->post('lpj_status_pengeluaran') == 'on' ? $lpj_status_pengeluaran 	= 1 : $lpj_status_pengeluaran = 0;
				$this->input->post('lpj_status_penerimaan') == 'on' ? $lpj_status_penerimaan 	= 1 : $lpj_status_penerimaan = 0;
			}
			else
			{
				$aktif = 0;
				$lpj_status_pengeluaran = 0;
				$lpj_status_penerimaan = 0;
			}
			// populate fields
			$data = $this->m_satker->array_from_post(array('id_ref_unit','id_ref_kabkota','kd_satker','no_karwas','nm_satker'));
			$data['id_ref_kppn'] 				= $ref_kppn->id_ref_kppn;
			
			// save data to ref_satker
			$id_satker = $this->m_satker->save($data, $id);
			
			$this->m_satker->_table_name = 'ref_history_satker';
			$this->m_satker->_primary_key = 'id_ref_satker';
			$this->m_satker->_foreign_key = 'id_ref_history_satker'; // actually this is the primary key
			$this->m_satker->_timestamps = TRUE;
			
			$id_foreign_history_satker['id_ref_satker']			= $id_satker;
			$ref_history_satker['aktif'] 						= $aktif;
			$ref_history_satker['lpj_status_pengeluaran'] 		= $lpj_status_pengeluaran;
			$ref_history_satker['lpj_status_penerimaan'] 		= $lpj_status_penerimaan;
			$ref_history_satker['tahun']						= $this->data['year'];
			$ref_history_satker['bulan']						= $this->data['month'];
			
			// save data to ref_history_satker
			$this->m_satker->save($ref_history_satker, $id_foreign_history_satker['id_ref_satker'], $foreign_key);
			//~ $this->m_satker->save($ref_history_satker, $id);
			
			// redirect to satker
			redirect('admin/satker');
			
		}
		
		
		// path to satker folder view
		$this->data['subview'] = 'admin/satker/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
		
	}
	
	public function status_satker($year, $month, $id, $aktif = FALSE, $lpj_status_pengeluaran = FALSE, $lpj_status_penerimaan = FALSE)
	{
		$year = $this->uri->segment(4);
		$month = $this->uri->segment(5);
		$aktif = $this->uri->segment(7);
		$lpj_status_pengeluaran = $this->uri->segment(8);
		$lpj_status_penerimaan = $this->uri->segment(9);
		
		if ($aktif === 'TRUE') 
		{
			// change data in aktif field
			$this->m_satker->update_status_satker($year, $month, $id, TRUE);
		}
		
		if ($lpj_status_pengeluaran === 'TRUE') 
		{
			// change data in lpj_status field
			$this->m_satker->update_status_satker($year, $month, $id, FALSE, TRUE);
		}
		
		if ($lpj_status_penerimaan === 'TRUE') 
		{
			// change data in lpj_status field
			$this->m_satker->update_status_satker($year, $month, $id, FALSE, FALSE, TRUE);
		}
		
		$this->session->set_flashdata('year', $year);
		$this->session->set_flashdata('month', $month);
		
		// redirect to satker
		redirect('admin/satker');
	}
	
	public function _unique_satker($string)
	{
		// don't validate if satker already exists
		// unless it's the satker for current user
		
		$id = $this->uri->segment(6);
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
