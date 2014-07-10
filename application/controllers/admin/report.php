<?php
/*
 * report.php
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


class Report extends Admin_Controller
{

	/**
	 * Constructor of class Report.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_report');
	}

		
	public function form_report_teguran()
	{
		// attributes is empty
		$this->data['attributes'] = '';
		// path to page folder view
		$this->data['subview'] = 'admin/report/form_report_teguran';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function edit_report_teguran()
	{
		// rules section
		$rules = $this->m_report->rules;
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() == TRUE ) {
			// load datetime helper
			$this->load->helper('datetime');
			// date now
			$this->data['now'] = date('d M Y');
			// populate fields should be same with validation rules
			$data = $this->m_report->array_from_post(array('no_surat_teguran','jml_lampiran','kd_satker','tgl_lpj','no_lpj','tgl_verifikasi','no_verifikasi','nm_pejabat','nip_pejabat'));
			// data surat
			$this->data['data_surat'] = $data;
			
			// load m_referensi to get id_ref_satker
			$this->load->model('m_referensi');
			// get id_ref_kppn
			$kppn = $this->m_referensi->get_kppn($this->data['id_ref_satker']);
			// get nm_satker
			$this->data['satker'] = $this->m_referensi->get_id_name_satker($data['kd_satker'], $kppn->id_ref_kppn);
			
			// send to view to generate in pdf
			$this->load->library('mpdf');
			$this->mpdf = new mPDF('utf-8', 'A4');
			$this->data['content'] = $this->load->view('admin/report/report_teguran', $this->data, true);
			$css	= file_get_contents('assets/css/report.css');
			$html 	= $this->load->view('admin/components/report_header_surat', $this->data, true);
			$this->mpdf->WriteHTML($css, 1);
			$this->mpdf->WriteHTML($html, 2);
			$this->mpdf->Output();
		}
		else
		{
			// path to page folder view
			$this->data['subview'] = 'admin/report/form_report_teguran';
			$this->load->view('admin/template/_layout_admin', $this->data);
		}
	}
	
	public function rekap_lpj_pengeluaran()
	{
		$this->data['year'] = date('Y');
		// if entity is kppn or kanwil or pkn
		if($this->data['id_entities'] === '1'
			OR $this->data['id_entities'] === '2'
			OR $this->data['id_entities'] === '3'
		)
		{
			$this->data['action'] = 'report_rekap_lpj_pengeluaran';
			// path to page folder view
			$this->data['subview'] = 'admin/report/form_rekap_lpj_pengeluaran';
			$this->load->view('admin/template/_layout_admin', $this->data);
		}
	}
	
	public function report_rekap_lpj_pengeluaran()
	{
		// load helper
		$this->load->helper('datetime');
		$this->load->helper('amountformat');
		// get year
		$this->data['year'] = $this->input->post('year') == TRUE ? $this->input->post('year') : date('Y');
		// get month
		$this->data['month'] = $this->input->post('month') == TRUE ? $this->input->post('month') : date('m');
		// load m_referensi model
		$this->load->model('m_referensi');
		// get id_ref_kppn
		$kppn = $this->m_referensi->get_kppn($this->data['id_ref_satker']);
		// get id_ref_kanwil
		$kanwil = $this->m_referensi->get_kanwil($this->data['id_ref_satker']);
		
		// if kppn
		if ($this->data['id_entities'] === '1')
		{
			// nama entity
			$this->data['nm_entity'] = $kppn->nm_kppn;
			// fetch rekap
			$this->data['rekap_lpjs'] = $this->m_report->rekap_lpj_pengeluaran($kppn->id_ref_kppn, $this->data['year'], $this->data['month'], TRUE);
			// get total sum
			$this->data['total_rekap_lpj'] = $this->m_report->total_sum_lpj_pengeluaran($kppn->id_ref_kppn, $this->data['year'], $this->data['month'], TRUE);
			// send data to view
			$this->data['content'] = $this->load->view('admin/report/report_rekap_lpj_pengeluaran_kppn', $this->data, TRUE);
		}
		// if kanwil
		else if ($this->data['id_entities'] === '2')
		{
			$this->data['subtitle'] = 'Per Bagian Anggaran Tingkat Wilayah';
			// nama entity
			$this->data['nm_entity'] = 'kanwil djpbn ' . $kanwil->nm_kanwil;
			// fetch rekap
			$this->data['rekap_lpjs'] = $this->m_report->rekap_lpj_pengeluaran($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month']);
			// get total sum
			$this->data['total_rekap_lpj'] = $this->m_report->total_sum_lpj_pengeluaran($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month']);
			// send data to view
			$this->data['content'] = $this->load->view('admin/report/report_rekap_lpj_pengeluaran_kanwil_pkn', $this->data, TRUE);
		}
		// if pkn
		else if ($this->data['id_entities'] === '3')
		{
			$this->data['subtitle'] = 'Per Bagian Anggaran Tingkat Nasional';
			// nama entity
			$this->data['nm_entity'] = 'direktorat pengelolaan kas negara';
			// fetch rekap
			$this->data['rekap_lpjs'] = $this->m_report->rekap_lpj_pengeluaran(NULL, $this->data['year'], $this->data['month']);
			// get total sum
			$this->data['total_rekap_lpj'] = $this->m_report->total_sum_lpj_pengeluaran(NULL, $this->data['year'], $this->data['month']);
			// send data to view
			$this->data['content'] = $this->load->view('admin/report/report_rekap_lpj_pengeluaran_kanwil_pkn', $this->data, TRUE);
		}
		
		// send to report view
		// pdf section
		$this->load->library('mpdf');
		$this->mpdf = new mPDF();
		$this->mpdf->AddPage('L', 	// L - landscape, P - portrait
            '', '', '', '',
            12, 					// margin_left
            12, 					// margin right
            10, 					// margin top
            10, 					// margin bottom
            '', 					// margin header
            ''); 					// margin footer
		$css	= file_get_contents('assets/css/report.css');
		$html 	= $this->load->view('admin/components/report_header_laporan', $this->data, true);
		$this->mpdf->WriteHTML($css, 1);
		$this->mpdf->WriteHTML($html, 2);
		$this->mpdf->Output();
	}
}
