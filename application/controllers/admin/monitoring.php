<?php
/*
 * monitoring.php
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




class Monitoring extends Admin_Controller
{

	/**
	 * Constructor of class Monitoring.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_monitoring');
	}

	public function monitor_data_terkirim()
	{	
		// load helper
		$this->load->helper('datetime');
		// get year
		$this->data['year'] = $this->input->post('year') == TRUE ? $this->input->post('year') : date('Y');
		// get month
		$this->data['month'] = $this->input->post('month') == TRUE ? $this->input->post('month') : date('m');
		
		// if entity is kppn
		if($this->data['id_entities'] === '1')
		{
			// table title
			$this->data['table_title'] = 'Monitoring Pengiriman Data LPJ Bendahara oleh Satker';
			
			// load m_referensi model
			$this->load->model('m_referensi');
			// get id_ref_kanwil
			$kppn = $this->m_referensi->get_kppn($this->data['id_ref_satker']);
			
			// send to view fetch sent and unsent satker count
			$this->data['count_satkers_k'] = $this->m_monitoring->get_count_data_satker($kppn->id_ref_kppn,$this->data['year'],$this->data['month'], 'K');
			$this->data['count_satkers_p'] = $this->m_monitoring->get_count_data_satker($kppn->id_ref_kppn,$this->data['year'],$this->data['month'], 'P');
			
			// send to view fetch unsent satker 
			$this->data['monitor_satker_unsents'] = $this->m_monitoring->get_list_satker_status($kppn->id_ref_kppn,$this->data['year'],$this->data['month'], 'K', FALSE);
			// send to view fetch sent satker 
			$this->data['monitor_satker_sents'] = $this->m_monitoring->get_list_satker_status($kppn->id_ref_kppn,$this->data['year'],$this->data['month'], 'K', TRUE);
			
			// path to page folder view
			$this->data['subview'] = 'admin/monitoring/index';
			$this->load->view('admin/template/_layout_admin', $this->data);
		}
		else if($this->data['id_entities'] === '2')
		{
			// table title
			$this->data['table_title'] = 'Monitoring Pengiriman Data LPJ Bendahara oleh Satker Per KPPN';
			// load m_referensi model
			$this->load->model('m_referensi');
			// get id_ref_kanwil
			$kanwil = $this->m_referensi->get_kanwil($this->data['id_ref_satker']);
			// send to view fetch kppn 
			//~ $this->data['monitor_kppns'] = $this->m_monitoring->get_count_data_kppn($kanwil->id_ref_kanwil,$this->data['year'],$this->data['month']);
			// send to view fetch unsent satker 
			$this->data['monitor_kppns_unsents'] = $this->m_monitoring->get_list_satker_status_kanwil($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], 'K', FALSE);
			// send to view fetch sent satker
			$this->data['monitor_kppns_sents'] = $this->m_monitoring->get_list_satker_status_kanwil($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], 'K', TRUE);
			// path to page folder view
			$this->data['subview'] = 'admin/monitoring/index';
			$this->load->view('admin/template/_layout_admin', $this->data);
		}
		// if entity is pkn
		else if($this->data['id_entities'] === '3')
		{
			// table title
			$this->data['table_title'] = 'Monitoring Pengiriman Data LPJ Bendahara oleh Satker Per Kanwil';
			// send to view fetch kanwil and kementerian
			$this->data['monitor_kanwils'] = $this->m_monitoring->get_count_data_kanwil($this->data['year'],$this->data['month']);
			// path to page folder view
			$this->data['subview'] = 'admin/monitoring/index';
			$this->load->view('admin/template/_layout_admin', $this->data);
		}
	}
}
