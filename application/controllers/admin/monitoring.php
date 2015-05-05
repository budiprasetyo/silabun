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
		
		$transaksi = $this->uri->segment(4);
		// load helper
		$this->load->helper('datetime');
		// get year
		$this->data['year'] = $this->input->post('year') == TRUE ? $this->input->post('year') : date('Y');
		// get month
		$this->data['month'] = $this->input->post('month') == TRUE ? $this->input->post('month') : date('m');
		// sent transaksi to view
		$this->data['transaksi'] = $transaksi;
		
		// if entity is kppn
		if($this->data['id_entities'] === '1')
		{
			if ( $transaksi === 'pengeluaran' ) 
			{
				
				// table title
				$this->data['table_title'] = 'Monitoring Pengiriman Data LPJ Pengeluaran Bendahara oleh Satker';
				
				// load m_referensi model
				$this->load->model('m_referensi');
				// get id_ref_kanwil
				$kppn = $this->m_referensi->get_kppn($this->data['id_ref_satker']);
				// file name
				$this->data['filename'] = $this->data['year'] . $this->data['month'] . '_' . $kppn->id_ref_kppn . '_monitoring_' . $transaksi . '_kppn';
				
				// get data
				if (  $this->input->post('submit') === 'Tampilkan'  )
				{
				
					// send to view fetch sent and unsent satker count
					$count_satkers = $this->m_monitoring->get_count_data_satker($kppn->id_ref_kppn, NULL, $this->data['year'],$this->data['month']);
					$this->data['count_satkers_k'] = $count_satkers['query_pengeluaran'];
					$this->data['count_satkers_p'] = $count_satkers['query_penerimaan'];
					
					// send to view fetch unsent satker 
					$monitor_satker_unsents = $this->m_monitoring->get_list_satker_status($kppn->id_ref_kppn,$this->data['year'],$this->data['month'], FALSE);
					$this->data['monitor_satker_pengeluaran_unsents'] = $monitor_satker_unsents['query_pengeluaran'];
					// send to view fetch sent satker 
					$monitor_satker_sents = $this->m_monitoring->get_list_satker_status($kppn->id_ref_kppn,$this->data['year'],$this->data['month'], TRUE);
					$this->data['monitor_satker_pengeluaran_sents'] = $monitor_satker_sents['query_pengeluaran'];
				}
				// report section
				// XLS
				else if ( $this->input->post('submit') === 'XLS' )
				{
					// send to view fetch unsent satker 
					$monitor_satker_unsents = $this->m_monitoring->get_list_satker_status($kppn->id_ref_kppn,$this->data['year'],$this->data['month'], FALSE, TRUE);
					$this->data['monitor_satker_pengeluaran_unsents'] = $monitor_satker_unsents['query_pengeluaran'];
					// send to view fetch sent satker 
					$monitor_satker_sents = $this->m_monitoring->get_list_satker_status($kppn->id_ref_kppn,$this->data['year'],$this->data['month'], TRUE, TRUE);
					$this->data['monitor_satker_pengeluaran_sents'] = $monitor_satker_sents['query_pengeluaran'];
					
				}
				
			}
			else if ( $transaksi === 'penerimaan' ) 
			{
				// table title
				$this->data['table_title'] = 'Monitoring Pengiriman Data LPJ Penerimaan Bendahara oleh Satker';
				
				// load m_referensi model
				$this->load->model('m_referensi');
				// get id_ref_kanwil
				$kppn = $this->m_referensi->get_kppn($this->data['id_ref_satker']);
				// file name
				$this->data['filename'] = $this->data['year'] . $this->data['month'] . '_' . $kppn->id_ref_kppn . '_monitoring_' . $transaksi . '_kppn';
				
				// get data
				if (  $this->input->post('submit') === 'Tampilkan'  )
				{
				
					// send to view fetch sent and unsent satker count
					$count_satkers = $this->m_monitoring->get_count_data_satker($kppn->id_ref_kppn, NULL, $this->data['year'],$this->data['month']);
					$this->data['count_satkers_k'] = $count_satkers['query_pengeluaran'];
					$this->data['count_satkers_p'] = $count_satkers['query_penerimaan'];
					
					// send to view fetch unsent satker 
					$monitor_satker_unsents = $this->m_monitoring->get_list_satker_status($kppn->id_ref_kppn,$this->data['year'],$this->data['month'], FALSE);
					$this->data['monitor_satker_penerimaan_unsents'] = $monitor_satker_unsents['query_penerimaan'];
					// send to view fetch sent satker 
					$monitor_satker_sents = $this->m_monitoring->get_list_satker_status($kppn->id_ref_kppn,$this->data['year'],$this->data['month'], TRUE);
					$this->data['monitor_satker_penerimaan_sents'] = $monitor_satker_sents['query_penerimaan'];
					
				}
				// report section
				// XLS
				else if ( $this->input->post('submit') === 'XLS' )
				{
					// send to view fetch unsent satker 
					$monitor_satker_unsents = $this->m_monitoring->get_list_satker_status($kppn->id_ref_kppn,$this->data['year'],$this->data['month'], FALSE, TRUE);
					$this->data['monitor_satker_penerimaan_unsents'] = $monitor_satker_unsents['query_penerimaan'];
					// send to view fetch sent satker 
					$monitor_satker_sents = $this->m_monitoring->get_list_satker_status($kppn->id_ref_kppn,$this->data['year'],$this->data['month'], TRUE, TRUE);
					$this->data['monitor_satker_penerimaan_sents'] = $monitor_satker_sents['query_penerimaan'];
					
				}
			}
			
			// path to page folder view
			// default button
			if ( $this->input->post('submit') === 'Tampilkan' 
				OR $this->input->post() == FALSE )
			{
				
				$this->data['subview'] = 'admin/monitoring/index';
				$this->load->view('admin/template/_layout_admin', $this->data);
				
			}
			else if ( $this->input->post('submit') === 'XLS' )
			{
				
				$this->data['output'] = $this->input->post('submit');
				$this->load->view('admin/monitoring/report_kppn_monitoring', $this->data);
				
			}
			
		}
		else if($this->data['id_entities'] === '2')
		{
			$this->data['jenis_monitoring'] = $this->input->post('jenis_monitoring');
			
			if ($transaksi === 'pengeluaran') 
			{
				
				// table title
				$this->data['table_title'] = 'Monitoring Pengiriman Data LPJ Bendahara Pengeluaran oleh Satker Per KPPN';
				// load m_referensi model
				$this->load->model('m_referensi');
				// get id_ref_kanwil
				$kanwil = $this->m_referensi->get_kanwil($this->data['id_ref_satker']);
				$count_satker = $this->m_monitoring->get_count_data_satker(NULL, $kanwil->id_ref_kanwil, $this->data['year'], $this->data['month']);
				// count satker lpj sent or not sent
				$this->data['monitor_satkers_k'] = $count_satker['query_pengeluaran'];
				
				// jenis monitoring option
				if ( $this->data['jenis_monitoring'] === 'monitoring_per_kementerian' ) {
					// send to view fetch unsent satker 
					$monitor_kppns_unsents = $this->m_monitoring->get_list_satker_status_kanwil($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], FALSE);
					$this->data['monitor_kppns_pengeluaran_unsents'] = $monitor_kppns_unsents['query_pengeluaran'];
					// send to view fetch sent satker
					$monitor_kppns_sents = $this->m_monitoring->get_list_satker_status_kanwil($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], TRUE);
					$this->data['monitor_kppns_pengeluaran_sents'] = $monitor_kppns_sents['query_pengeluaran'];
				}
				else if ( $this->data['jenis_monitoring'] === 'monitoring_per_satker' ) 
				{
					// send to view fetch unsent satker 
					$monitor_satkers_unsents = $this->m_monitoring->get_list_satker_status_kanwil($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], FALSE, TRUE);
					$this->data['monitor_satkers_pengeluaran_unsents'] = $monitor_satkers_unsents['query_pengeluaran_satker'];
					// send to view fetch sent satker
					$monitor_satkers_sents = $this->m_monitoring->get_list_satker_status_kanwil($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], TRUE, TRUE);
					$this->data['monitor_satkers_pengeluaran_sents'] = $monitor_satkers_sents['query_pengeluaran_satker'];
					
				}
				
			}
			else if ($transaksi === 'penerimaan') 
			{
				
				// table title
				$this->data['table_title'] = 'Monitoring Pengiriman Data LPJ Bendahara Pengeluaran oleh Satker Per KPPN';
				// load m_referensi model
				$this->load->model('m_referensi');
				// get id_ref_kanwil
				$kanwil = $this->m_referensi->get_kanwil($this->data['id_ref_satker']);
				$count_satker = $this->m_monitoring->get_count_data_satker(NULL, $kanwil->id_ref_kanwil, $this->data['year'], $this->data['month']);
				// count satker lpj sent or not sent
				$this->data['monitor_satkers_p'] = $count_satker['query_penerimaan'];
				
				// jenis monitoring option
				if ( $this->data['jenis_monitoring'] === 'monitoring_per_kementerian' ) {
					// send to view fetch unsent satker 
					$monitor_kppns_unsents = $this->m_monitoring->get_list_satker_status_kanwil($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], FALSE);
					$this->data['monitor_kppns_penerimaan_unsents'] = $monitor_kppns_unsents['query_penerimaan'];
					// send to view fetch sent satker
					$monitor_kppns_sents = $this->m_monitoring->get_list_satker_status_kanwil($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], TRUE);
					$this->data['monitor_kppns_penerimaan_sents'] = $monitor_kppns_sents['query_penerimaan'];
				}
				else if ( $this->data['jenis_monitoring'] === 'monitoring_per_satker' ) 
				{
					// send to view fetch unsent satker 
					$monitor_satkers_unsents = $this->m_monitoring->get_list_satker_status_kanwil($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], FALSE, TRUE);
					$this->data['monitor_satkers_penerimaan_unsents'] = $monitor_satkers_unsents['query_penerimaan_satker'];
					// send to view fetch sent satker
					$monitor_satkers_sents = $this->m_monitoring->get_list_satker_status_kanwil($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], TRUE, TRUE);
					$this->data['monitor_satkers_penerimaan_sents'] = $monitor_satkers_sents['query_penerimaan_satker'];
				}
			}
			
			// path to page folder view
			$this->data['subview'] = 'admin/monitoring/index';
			$this->load->view('admin/template/_layout_admin', $this->data);
		}
		// if entity is pkn
		else if($this->data['id_entities'] === '3')
		{
			$this->data['jenis_monitoring'] = $this->input->post('jenis_monitoring');
			
			// get id_ref_kanwil from form monitoring
			// in select option, I make it in array 
			// $ref_kanwil[0] = id_ref_kanwil, $ref_kanwil[1] = kd_kanwil, $ref_kanwil[2] = nm_kanwil
			$ref_kanwil = explode(',', $this->input->post('id_ref_kanwil'));
			$id_ref_kanwil = $ref_kanwil[0] ? $id_ref_kanwil = $ref_kanwil[0] : 0;
			$this->data['kd_kanwil'] = $ref_kanwil[1];
			$this->data['nm_kanwil'] = $ref_kanwil[2];
			
			// load m_referensi model
			$this->load->model('m_referensi');
			// get data for dropdown 
			$this->data['get_kanwils'] = $this->m_referensi->get_kanwil(FALSE, FALSE, 'ref_kanwil.kd_kanwil');
			// get id_ref_kanwil
			$kanwil = $this->m_referensi->get_kanwil($this->data['id_ref_satker']);
			
			if ($transaksi === 'pengeluaran') {
				
				// table title
				$this->data['table_title'] = 'Monitoring Pengiriman Data LPJ Bendahara oleh Satker Per Kanwil';
				
				// if monitoring per kementerian
				if ( $this->data['jenis_monitoring'] === 'monitoring_per_kementerian' ) {
					
					// send to view fetch kanwil and kementerian
					$monitor_kppns_unsents = $this->m_monitoring->get_list_satker_status_kanwil($id_ref_kanwil, $this->data['year'], $this->data['month'], FALSE);
					$this->data['monitor_kanwils_unsents'] = $monitor_kppns_unsents['query_pengeluaran'];
					// send to view fetch sent satker
					$monitor_kppns_sents = $this->m_monitoring->get_list_satker_status_kanwil($id_ref_kanwil, $this->data['year'], $this->data['month'], TRUE);
					$this->data['monitor_kanwils_sents'] = $monitor_kppns_sents['query_pengeluaran'];
				
				}
				// monitoring per satker 
				elseif ( $this->data['jenis_monitoring'] === 'monitoring_per_satker' ) {
					
					// send to view fetch unsent satker 
					$monitor_satkers_unsents = $this->m_monitoring->get_list_satker_status_kanwil($id_ref_kanwil, $this->data['year'], $this->data['month'], FALSE, TRUE);
					$this->data['monitor_satkers_pengeluaran_unsents'] = $monitor_satkers_unsents['query_pengeluaran_satker'];
					// send to view fetch sent satker
					$monitor_satkers_sents = $this->m_monitoring->get_list_satker_status_kanwil($id_ref_kanwil, $this->data['year'], $this->data['month'], TRUE, TRUE);
					$this->data['monitor_satkers_pengeluaran_sents'] = $monitor_satkers_sents['query_pengeluaran_satker'];
					
				}
				
				// path to page folder view
				$this->data['subview'] = 'admin/monitoring/index';
				$this->load->view('admin/template/_layout_admin', $this->data);
				
				
			}
			elseif ($transaksi === 'penerimaan') {
				
				// table title
				$this->data['table_title'] = 'Monitoring Pengiriman Data LPJ Bendahara oleh Satker Per Kanwil';
				
				// if monitoring per kementerian
				if ( $this->data['jenis_monitoring'] === 'monitoring_per_kementerian' ) {
					
					// send to view fetch kanwil and kementerian
					$monitor_kppns_unsents = $this->m_monitoring->get_list_satker_status_kanwil($id_ref_kanwil, $this->data['year'], $this->data['month'], FALSE);
					$this->data['monitor_kanwils_penerimaan_unsents'] = $monitor_kppns_unsents['query_penerimaan'];
					// send to view fetch sent satker
					$monitor_kppns_sents = $this->m_monitoring->get_list_satker_status_kanwil($id_ref_kanwil, $this->data['year'], $this->data['month'], TRUE);
					$this->data['monitor_kanwils_penerimaan_sents'] = $monitor_kppns_sents['query_penerimaan'];
				
				}
				// monitoring per satker 
				elseif ( $this->data['jenis_monitoring'] === 'monitoring_per_satker' ) {
					
					// send to view fetch unsent satker 
					$monitor_satkers_unsents = $this->m_monitoring->get_list_satker_status_kanwil($id_ref_kanwil, $this->data['year'], $this->data['month'], FALSE, TRUE);
					$this->data['monitor_satkers_penerimaan_unsents'] = $monitor_satkers_unsents['query_penerimaan_satker'];
					// send to view fetch sent satker
					$monitor_satkers_sents = $this->m_monitoring->get_list_satker_status_kanwil($id_ref_kanwil, $this->data['year'], $this->data['month'], TRUE, TRUE);
					$this->data['monitor_satkers_penerimaan_sents'] = $monitor_satkers_sents['query_penerimaan_satker'];
					
				}
				
				// path to page folder view
				$this->data['subview'] = 'admin/monitoring/index';
				$this->load->view('admin/template/_layout_admin', $this->data);
				
			}
			
			
		}
	}
}
