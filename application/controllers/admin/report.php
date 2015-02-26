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
	
	// used =====>
	public function rekap_lpj($post)
	{
		// load helper
		$this->load->helper('datetime');
		$this->load->helper('amountformat');
		// load m_referensi model
		$this->load->model('m_referensi');
		// load m_referensi
		$this->data['pejabat'] = $this->m_referensi->get_pejabat($this->data['id_ref_satker']);
		// get year
		$this->data['year'] = $this->input->post('year') == TRUE ? $this->input->post('year') : date('Y');
		// get month
		$this->data['month'] = $this->input->post('month') == TRUE ? $this->input->post('month') : date('m');

		// rules section
		$rules = $this->m_report->rules_rekap_lpj;
		$this->form_validation->set_rules($rules);
		
		if ( ($this->data['id_entities'] === '1')
			&& $this->form_validation->run() == TRUE ) 
		{
		
			// get id_ref_kppn
			$kppn = $this->m_referensi->get_kppn($this->data['id_ref_satker']);
			//~ // year
			//~ $this->data['year'] = $this->input->post('year');
			//~ // month
			//~ $this->data['month'] = $this->input->post('month');
			// post
			$this->data['post'] = $this->input->post('post');
			
			// subtitle
			$this->data['subtitle'] = 'Daftar LPJ ' . $this->data['post'] . ' Bendahara ' . $this->data['post'];
			
			// nama entity
			$this->data['nm_entity'] = 'KPPN ' . ucwords(strtolower($kppn->nm_kppn));
			
			// period
			$this->data['period'] = 'Bulan ' . get_month_name($this->data['month']) . ' ' . $this->data['year'];
			
			// filename
			$this->data['filename'] = $this->data['year'] . $this->data['month'] . '_' . $kppn->id_ref_kppn . '_' . $this->data['post'];
			
			// pengeluaran
			if ($this->input->post('post') === 'pengeluaran')
			{
			
				// fetch rekap
				$rekap_lpjs = $this->m_report->rekap_lpj_pengeluaran($kppn->id_ref_kppn, $this->data['year'], $this->data['month'], TRUE);
				
				// if rekap_lpjs is false
				if ( $rekap_lpjs == FALSE )
				{
					$this->session->set_flashdata('message', 'Data bulan ini tidak ada');
					$this->session->set_flashdata('method', 'rekap_lpj');
					redirect('admin/report/message');
				}
				
				// parent array
				$rekap_satker = array();

				foreach ($rekap_lpjs->result_array() as $rekap_lpj) 
				{
					if ( !isset($rekap_satker[$rekap_lpj['kd_kementerian'] . ' ' . $rekap_lpj['nm_kementerian']]) )
					{
						$rekap_satker[$rekap_lpj['kd_kementerian'] . ' ' . $rekap_lpj['nm_kementerian']] = array();
					}
					
					$rekap_satker[$rekap_lpj['kd_kementerian'] . ' ' . $rekap_lpj['nm_kementerian']][] = $rekap_lpj;
					
				}
				
				$this->data['rekap_satker'] = $rekap_satker;
			}
			// penerimaan
			else if ($this->input->post('post') === 'penerimaan')
			{
				// fetch rekap
				$rekap_penerimaan_lpjs = $this->m_report->rekap_lpj_penerimaan($kppn->id_ref_kppn, $this->data['year'], $this->data['month'], TRUE);
				
				// if rekap_lpjs is false
				if ( $rekap_penerimaan_lpjs == FALSE )
				{
					$this->session->set_flashdata('message', 'Data bulan ini tidak ada');
					$this->session->set_flashdata('method', 'rekap_lpj');
					redirect('admin/report/message');
				}
				
				// parent array
				$rekap_satker_penerimaan = array();
				
				foreach ($rekap_penerimaan_lpjs->result_array() as $rekap_penerimaan_lpj) 
				{

					if ( !isset($rekap_satker_penerimaan[$rekap_penerimaan_lpj['kd_kementerian'] . ' ' . $rekap_penerimaan_lpj['nm_kementerian']]) ) 
					{
						$rekap_satker_penerimaan[$rekap_penerimaan_lpj['kd_kementerian'] . ' ' . $rekap_penerimaan_lpj['nm_kementerian']] = array();
					}
					
					$rekap_satker_penerimaan[$rekap_penerimaan_lpj['kd_kementerian'] . ' ' . $rekap_penerimaan_lpj['nm_kementerian']][] = $rekap_penerimaan_lpj;
					
				}
				
				$this->data['rekap_satker_penerimaan'] = $rekap_satker_penerimaan;
			}
			
		}
		// if kanwil
		else if ( ($this->data['id_entities'] === '2' OR $this->data['id_entities'] === '3')
				&& $this->form_validation->run() == TRUE )
		{
			// pengeluaran
			if ($this->input->post('post') === 'pengeluaran')
			{
				
				// get id_ref_kanwil
				$kanwil = $this->m_referensi->get_kanwil($this->data['id_ref_satker']);
				//~ // year
				//~ $this->data['year'] = $this->input->post('year');
				//~ // month
				//~ $this->data['month'] = $this->input->post('month');
				// post
				$this->data['post'] = $this->input->post('post');
				
				// period
				$this->data['period'] = 'Bulan ' . get_month_name($this->data['month']) . ' ' . $this->data['year'];
				
				// filename
				$this->data['filename'] = $this->data['year'] . $this->data['month'] . '_' . $kanwil->id_ref_kanwil . '_' . $this->data['post'];
				
				// if kanwil
				if ($this->data['id_entities'] === '2')
				{
					// subtitle
					$this->data['subtitle'] = 'Rekapitulasi LPJ Bendahara ' . $this->data['post'];
				
					// nama entity
					$this->data['nm_entity'] = 'Kanwil ' . ucwords(strtolower($kanwil->nm_kanwil));
					
					// fetch rekap
					$this->data['rekap_lpjs'] = $this->m_report->rekap_lpj_pengeluaran($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], FALSE);
					
					// if rekap_lpjs is false
					if ( $this->data['rekap_lpjs'] === NULL )
					{
						$this->session->set_flashdata('message', 'Data bulan ini tidak ada');
						$this->session->set_flashdata('method', 'rekap_lpj');
						redirect('admin/report/message');
					}
				}
				// if pkn
				else if ($this->data['id_entities'] === '3')
				{
					// subtitle
					$this->data['subtitle'] = 'Rekapitulasi LPJ Bendahara ' . $this->data['post'] . '<br />' . 'Per Bagian Anggaran Tingkat Nasional';
				
					// fetch rekap
					$this->data['rekap_lpjs'] = $this->m_report->rekap_lpj_pengeluaran(NULL, $this->data['year'], $this->data['month'], FALSE);
				}
				
				
				
			}
			else if ($this->input->post('post') === 'penerimaan')
			{
				
				// get id_ref_kanwil
				$kanwil = $this->m_referensi->get_kanwil($this->data['id_ref_satker']);
				//~ // year
				//~ $this->data['year'] = $this->input->post('year');
				//~ // month
				//~ $this->data['month'] = $this->input->post('month');
				// post
				$this->data['post'] = $this->input->post('post');
				
				// period
				$this->data['period'] = 'Bulan ' . get_month_name($this->data['month']) . ' ' . $this->data['year'];
				
				// filename
				$this->data['filename'] = $this->data['year'] . $this->data['month'] . '_' . $kanwil->id_ref_kanwil . '_' . $this->data['post'];
				
				// if kanwil
				if ($this->data['id_entities'] === '2')
				{
					// subtitle
					$this->data['subtitle'] = 'Rekapitulasi LPJ Bendahara ' . $this->data['post'];
				
					// nama entity
					$this->data['nm_entity'] = 'Kanwil ' . ucwords(strtolower($kanwil->nm_kanwil));
					
					// fetch rekap
					$this->data['rekap_penerimaan_lpjs'] = $this->m_report->rekap_lpj_penerimaan($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], FALSE);
					
					// if rekap_penerimaan_lpjs is false
					if ( $this->data['rekap_penerimaan_lpjs'] === NULL )
					{
						$this->session->set_flashdata('message', 'Data bulan ini tidak ada');
						$this->session->set_flashdata('method', 'rekap_lpj');
						redirect('admin/report/message');
					}
				}
				// if pkn
				else if ($this->data['id_entities'] === '3')
				{
					// subtitle
					$this->data['subtitle'] = 'Rekapitulasi LPJ Bendahara ' . $this->data['post'] . '<br />' . 'Per Bagian Anggaran Tingkat Nasional';
					
					// fetch rekap
					$this->data['rekap_penerimaan_lpjs'] = $this->m_report->rekap_lpj_penerimaan(NULL, $this->data['year'], $this->data['month'], FALSE);
				}
				
			}
			
		}
		
		// action
		// preview
		if ($this->input->post('submit') === 'Tampilkan'
			OR 	$this->input->post() == FALSE)
		{
			// path to page folder view
			$this->data['subview'] = 'admin/report/form_rekap_lpj';
			$this->load->view('admin/template/_layout_admin', $this->data);
		}
		// XLSX
		else if ($this->input->post('submit') === 'XLSX')
		{
			$this->data['output'] = $this->input->post('submit');
			$this->load->view('admin/report/report_rekap_lpj', $this->data);
		}
		// PDF
		else if ($this->input->post('submit') === 'PDF')
		{
			$this->data['output'] = $this->input->post('submit');
			// load m_referensi
			$this->data['pejabat'] = $this->m_referensi->get_pejabat($this->data['id_ref_satker']);
			// send data to view
			$this->data['content'] = $this->load->view('admin/report/report_rekap_lpj', $this->data, TRUE);
			
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
			$html 	= $this->load->view('admin/components/report_header_laporan', $this->data, TRUE);
			$this->mpdf->WriteHTML($css, 1);
			$this->mpdf->WriteHTML($html, 2);
			$this->mpdf->Output($this->data['filename'] . '.pdf','D');
		}
		
	}
	
	
	// used ====>
	public function detil_lpj()
	{
		$post = $this->input->post('post');
		
		// load helper
		$this->load->helper('datetime');
		$this->load->helper('amountformat');
		// get year
		$this->data['year'] = $this->input->post('year') == TRUE ? $this->input->post('year') : date('Y');
		// get month
		$this->data['month'] = $this->input->post('month') == TRUE ? $this->input->post('month') : date('m');
		// load m_referensi model
		$this->load->model('m_referensi');
		
		// get kanwil referensi
		if ($this->data['id_entities'] === '2') 
		{
			// get id_ref_kanwil
			$kanwil = $this->m_referensi->get_kanwil($this->data['id_ref_satker']);
		}
		else if ($this->data['id_entities'] === '3') 
		{
			// dropdown kanwil
			$this->data['dropdown_kanwil'] = $this->m_referensi->get_kanwil(FALSE, FALSE, 'kd_kanwil');
		}
		
		$id_ref_kanwil = $kanwil->id_ref_kanwil ? $id_ref_kanwil = $kanwil->id_ref_kanwil : $id_ref_kanwil = $this->input->post('id_ref_kanwil');
		// load m_referensi
		$this->data['pejabat'] = $this->m_referensi->get_pejabat($this->data['id_ref_satker']);
		
		// rules section
		$rules = $this->m_report->rules_rekap_lpj;
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() == TRUE ) 
		{
		
			// if kanwil or pkn pengeluaran
			if ( ($this->data['id_entities'] === '2' OR $this->data['id_entities'] === '3')
				&& $this->input->post('post') === 'pengeluaran')
			{
				// subtitle
				$this->data['subtitle'] = 'LPJ ' . $post . ' Per Satuan Kerja Tingkat Wilayah';
				// nama entity
				$this->data['nm_entity'] = 'Kanwil DJPBN ' . ucwords(strtolower($kanwil->nm_kanwil));
				// period
				$this->data['period'] = 'Bulan ' . get_month_name($this->input->post('month')) . ' ' . $this->input->post('year');
				// filename
				$this->data['filename'] = $this->data['year'] . $this->data['month'] . '_' . $id_ref_kanwil . '_' . $post;
				
				// fetch rekap
				$detil_lpjs = $this->m_report->detil_lpj_pengeluaran($id_ref_kanwil, $this->data['year'], $this->data['month']);
				
				// if detil lpjs is not exists
				if ( $detil_lpjs == FALSE )
				{
					$this->session->set_flashdata('message', 'Data bulan ini tidak ada');
					$this->session->set_flashdata('method', 'detil_lpj');
					redirect('admin/report/message');
				}
				
				// parent array
				$detil_kanwil = array();

				foreach ($detil_lpjs->result_array() as $detil_lpj) 
				{

					if ( !isset($detil_kanwil[$detil_lpj['kd_kppn'] . ' ' . $detil_lpj['nm_kppn']]) ) 
					{
						$detil_kanwil[$detil_lpj['kd_kppn'] . ' ' . $detil_lpj['nm_kppn']] = array();
					}
					
					$detil_kanwil[$detil_lpj['kd_kppn'] . ' ' . $detil_lpj['nm_kppn']][$detil_lpj['kd_kementerian'] . ' &nbsp;' . $detil_lpj['nm_kementerian']][] = $detil_lpj;
					
				}
				
				$this->data['detil_kanwil'] = $detil_kanwil;
				
			}
			// if kanwil or pkn penerimaan
			else if ( ($this->data['id_entities'] === '2' OR $this->data['id_entities'] === '3')
				&& $this->input->post('post') === 'penerimaan') 
			{
				// subtitle
				$this->data['subtitle'] = 'LPJ ' . $post . ' Per Satuan Kerja Tingkat Wilayah';
				// nama entity
				$this->data['nm_entity'] = 'Kanwil DJPBN ' . ucwords(strtolower($kanwil->nm_kanwil));
				// period
				$this->data['period'] = 'Bulan ' . get_month_name($this->input->post('month')) . ' ' . $this->input->post('year');
				// filename
				$this->data['filename'] = $this->data['year'] . $this->data['month'] . '_' . $id_ref_kanwil . '_' . $post;
				
				// fetch rekap
				$detil_lpjs = $this->m_report->detil_lpj_penerimaan($id_ref_kanwil, $this->data['year'], $this->data['month']);

				// if detil lpjs is not exists
				if ( $detil_lpjs == FALSE )
				{
					$this->session->set_flashdata('message', 'Data bulan ini tidak ada');
					$this->session->set_flashdata('method', 'detil_lpj');
					redirect('admin/report/message');
				}
				
				// parent array
				$detil_kanwil_penerimaan = array();

				foreach ($detil_lpjs->result_array() as $detil_lpj) 
				{
					if ( !isset($detil_kanwil_penerimaan[$detil_lpj['kd_kppn'] . ' ' . $detil_lpj['nm_kppn']]) ) 
					{
						$detil_kanwil_penerimaan[$detil_lpj['kd_kppn'] . ' ' . $detil_lpj['nm_kppn']] = array();
					}
					
					$detil_kanwil_penerimaan[$detil_lpj['kd_kppn'] . ' ' . $detil_lpj['nm_kppn']][$detil_lpj['kd_kementerian'] . ' &nbsp;' . $detil_lpj['nm_kementerian']][] = $detil_lpj;
				}
				
				$this->data['detil_kanwil_penerimaan'] = $detil_kanwil_penerimaan;
				
			}
		}
		
		// Tampilkan
		if ($this->input->post('submit') === 'Tampilkan'
			OR 	$this->input->post() == FALSE)
		{
			// path to page folder view
			$this->data['subview'] = 'admin/report/form_detil_lpj';
			$this->load->view('admin/template/_layout_admin', $this->data);
		}
		// XLSX
		else if ($this->input->post('submit') === 'XLSX')
		{
			$this->data['output'] = $this->input->post('submit');
			$this->load->view('admin/report/report_detil_lpj', $this->data);
		}
		// PDF
		else if ($this->input->post('submit') === 'PDF')
		{
			
			$this->data['output'] = $this->input->post('submit');
			// load m_referensi
			$this->data['pejabat'] = $this->m_referensi->get_pejabat($this->data['id_ref_satker']);
			// send data to view
			$this->data['content'] = $this->load->view('admin/report/report_detil_lpj', $this->data, TRUE);
			
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
			$html 	= $this->load->view('admin/components/report_header_laporan', $this->data, TRUE);
			$this->mpdf->WriteHTML($css, 1);
			$this->mpdf->WriteHTML($html, 2);
			$this->mpdf->Output($this->data['filename'] . '.pdf','D');
		}
	}
	
	public function rekening_bendahara()
	{

		// load helper
		$this->load->helper('datetime');
		
		// load m_referensi model
		$this->load->model('m_referensi');
		// get year
		$this->data['year'] = $this->input->post('year') == TRUE ? $this->input->post('year') : date('Y');
		// get month
		$this->data['month'] = $this->input->post('month') == TRUE ? $this->input->post('month') : date('m');

		// rules section
		$rules = $this->m_report->rules_rekap_lpj;
		$this->form_validation->set_rules($rules);
		
		// if kanwil or pkn
		if ( ($this->data['id_entities'] === '2' OR $this->data['id_entities'] === '3')
				&& $this->form_validation->run() == TRUE )
		{
			// get id_ref_kanwil
			$kanwil = $this->m_referensi->get_kanwil($this->data['id_ref_satker']);
			//~ // year
			//~ $this->data['year'] = $this->input->post('year');
			//~ // month
			//~ $this->data['month'] = $this->input->post('month');
			// post
			$this->data['post'] = $this->input->post('post');
			
			// period
			$this->data['period'] = 'Bulan ' . get_month_name($this->data['month']) . ' ' . $this->data['year'];
			
			// pengeluaran
			if ( $this->input->post('post') === 'pengeluaran' ) {
				
					// filename
					$this->data['filename'] = $this->data['year'] . $this->data['month'] . '_' . $kanwil->id_ref_kanwil . '_' . '_rekening_' . $this->data['post'];
				
					// subtitle
					$this->data['subtitle'] = 'Rekening Bendahara ' . ucfirst($this->data['post']);
					
					// fetch rekening pengeluaran
					$rekening_pengeluarans = $this->m_report->rekening_bendahara_pengeluaran($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], $is_kppn = FALSE);
					
					// if rekening_pengeluarans is null
					if ( $rekening_pengeluarans === NULL )
					{
						$this->session->set_flashdata('message', 'Data rekening bulan ini tidak mengalami perubahan dari bulan-bulan sebelumnya');
						$this->session->set_flashdata('method', 'rekening_bendahara');
						redirect('admin/report/message');
					}
					
					$parent_rekening_pengeluaran = array();
					
					foreach ($rekening_pengeluarans->result_array() as $rekening_pengeluaran) 
					{
						if ( !isset($parent_rekening_pengeluaran[$rekening_pengeluaran['kd_kppn'] . ' KPPN ' . $rekening_pengeluaran['nm_kppn']]) )
						{
							$parent_rekening_pengeluaran[$rekening_pengeluaran['kd_kppn'] . ' KPPN ' . $rekening_pengeluaran['nm_kppn']] = array();
						}
						
						$parent_rekening_pengeluaran[$rekening_pengeluaran['kd_kppn'] . ' KPPN ' . $rekening_pengeluaran['nm_kppn']]['('.$rekening_pengeluaran['kd_kementerian'] . ') KEMENTERIAN ' . $rekening_pengeluaran['nm_kementerian']][] = $rekening_pengeluaran;
						
					}
					
					$this->data['parent_rekening_pengeluaran'] = $parent_rekening_pengeluaran;
				
				
			}
			elseif ( $this->input->post('post') === 'penerimaan' ) {
				
				// filename
				$this->data['filename'] = $this->data['year'] . $this->data['month'] . '_' . $kanwil->id_ref_kanwil . '_' . '_rekening_' . $this->data['post'];
					
					// subtitle
					$this->data['subtitle'] = 'Rekening Bendahara ' . ucfirst($this->data['post']);
					
					// fetch rekening pengeluaran
					$rekening_penerimaans = $this->m_report->rekening_bendahara_penerimaan($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month'], $is_kppn = FALSE);
					
					// if rekening_penerimaans is null
					if ( $rekening_penerimaans === NULL )
					{
						$this->session->set_flashdata('message', 'Data rekening bulan ini tidak mengalami perubahan dari bulan-bulan sebelumnya');
						$this->session->set_flashdata('method', 'rekening_bendahara');
						redirect('admin/report/message');
					}
					
					$parent_rekening_penerimaan = array();
					
					foreach ($rekening_penerimaans->result_array() as $rekening_penerimaan) 
					{
						if ( !isset($parent_rekening_penerimaan[$rekening_penerimaan['kd_kppn'] . ' KPPN ' . $rekening_penerimaan['nm_kppn']]) )
						{
							$parent_rekening_penerimaan[$rekening_penerimaan['kd_kppn'] . ' KPPN ' . $rekening_penerimaan['nm_kppn']] = array();
						}
						
						$parent_rekening_penerimaan[$rekening_penerimaan['kd_kppn'] . ' KPPN ' . $rekening_penerimaan['nm_kppn']]['('.$rekening_penerimaan['kd_kementerian'] . ') KEMENTERIAN ' . $rekening_penerimaan['nm_kementerian']][] = $rekening_penerimaan;
						
					}
					
					$this->data['parent_rekening_penerimaan'] = $parent_rekening_penerimaan;
					
			}
			
		}
		// if kppn 
		else if ( $this->data['id_entities'] === '1'
				&& $this->form_validation->run() == TRUE )
		{
			// get id_ref_kppn
			$kppn = $this->m_referensi->get_kppn($this->data['id_ref_satker']);
			//~ // year
			//~ $this->data['year'] = $this->input->post('year');
			//~ // month
			//~ $this->data['month'] = $this->input->post('month');
			// post
			$this->data['post'] = $this->input->post('post');
			
			// period
			$this->data['period'] = 'Bulan ' . get_month_name($this->data['month']) . ' ' . $this->data['year'];
			
			// pengeluaran
			if ( $this->input->post('post') === 'pengeluaran' ) {
				
				// filename
				$this->data['filename'] = $this->data['year'] . $this->data['month'] . '_' . $kppn->id_ref_kppn . '_' . '_rekening_' . $this->data['post'];
			
				// subtitle
				$this->data['subtitle'] = 'Rekening Bendahara ' . ucfirst($this->data['post']);
				
				// fetch rekening pengeluaran
				$rekening_kppn_pengeluarans = $this->m_report->rekening_bendahara_pengeluaran($kppn->id_ref_kppn, $this->data['year'], $this->data['month'], $is_kppn = TRUE);
				
				// if rekening_kppn_pengeluarans is null
				if ( $rekening_kppn_pengeluarans === NULL )
				{
					$this->session->set_flashdata('message', 'Data rekening bulan ini tidak mengalami perubahan dari bulan-bulan sebelumnya');
					$this->session->set_flashdata('method', 'rekening_bendahara');
					redirect('admin/report/message');
				}
				
				$parent_rekening_kppn_pengeluaran = array();
				
				foreach ( $rekening_kppn_pengeluarans->result_array() as $rekening_kppn_pengeluaran ) 
				{
					if ( !isset($parent_rekening_kppn_pengeluaran[$rekening_kppn_pengeluaran['kd_kementerian'] . ' KEMENTERIAN ' . $rekening_kppn_pengeluaran['nm_kementerian']][$rekening_kppn_pengeluaran['kd_unit'] . ' ' . $rekening_kppn_pengeluaran['nm_unit']]) )
					{
						$parent_rekening_kppn_pengeluaran[$rekening_kppn_pengeluaran['kd_kementerian'] . ' KEMENTERIAN ' . $rekening_kppn_pengeluaran['nm_kementerian']][$rekening_kppn_pengeluaran['kd_unit'] . ' ' . $rekening_kppn_pengeluaran['nm_unit']] = array();
					}
					
					$parent_rekening_kppn_pengeluaran[$rekening_kppn_pengeluaran['kd_kementerian'] . ' KEMENTERIAN ' . $rekening_kppn_pengeluaran['nm_kementerian']][$rekening_kppn_pengeluaran['kd_unit'] . ' ' . $rekening_kppn_pengeluaran['nm_unit']][] = $rekening_kppn_pengeluaran;
					
				}
				
				$this->data['parent_rekening_kppn_pengeluaran'] = $parent_rekening_kppn_pengeluaran;
				
			}
			// penerimaan
			else if ( $this->input->post('post') === 'penerimaan' ) {
				
				// filename
				$this->data['filename'] = $this->data['year'] . $this->data['month'] . '_' . $kppn->id_ref_kppn . '_' . '_rekening_' . $this->data['post'];
			
				// subtitle
				$this->data['subtitle'] = 'Rekening Bendahara ' . ucfirst($this->data['post']);
				
				// fetch rekening pengeluaran
				$rekening_kppn_penerimaans = $this->m_report->rekening_bendahara_penerimaan($kppn->id_ref_kppn, $this->data['year'], $this->data['month'], $is_kppn = TRUE);
				
				// if rekening_kppn_pengeluarans is null
				if ( $rekening_kppn_penerimaans === NULL )
				{
					$this->session->set_flashdata('message', 'Data rekening bulan ini tidak mengalami perubahan dari bulan-bulan sebelumnya');
					$this->session->set_flashdata('method', 'rekening_bendahara');
					redirect('admin/report/message');
				}
				
				$parent_rekening_kppn_penerimaan = array();
				
				foreach ( $rekening_kppn_penerimaans->result_array() as $rekening_kppn_penerimaan ) 
				{
					if ( !isset($parent_rekening_kppn_penerimaan[$rekening_kppn_penerimaan['kd_kementerian'] . ' KEMENTERIAN ' . $rekening_kppn_penerimaan['nm_kementerian']][$rekening_kppn_penerimaan['kd_unit'] . ' ' . $rekening_kppn_penerimaan['nm_unit']]) )
					{
						$parent_rekening_kppn_penerimaan[$rekening_kppn_penerimaan['kd_kementerian'] . ' KEMENTERIAN ' . $rekening_kppn_penerimaan['nm_kementerian']][$rekening_kppn_penerimaan['kd_unit'] . ' ' . $rekening_kppn_penerimaan['nm_unit']] = array();
					}
					
					$parent_rekening_kppn_penerimaan[$rekening_kppn_penerimaan['kd_kementerian'] . ' KEMENTERIAN ' . $rekening_kppn_penerimaan['nm_kementerian']][$rekening_kppn_penerimaan['kd_unit'] . ' ' . $rekening_kppn_penerimaan['nm_unit']][] = $rekening_kppn_penerimaan;
					
				}
				
				$this->data['parent_rekening_kppn_penerimaan'] = $parent_rekening_kppn_penerimaan;
				
			}
				
		}
		
		// Tampilkan
		if ($this->input->post('submit') === 'Tampilkan'
			OR 	$this->input->post() == FALSE)
		{
			// path to page folder view
			$this->data['subview'] = 'admin/report/form_rekening_bendahara';
			$this->load->view('admin/template/_layout_admin', $this->data);
		}
		// XLSX
		else if ($this->input->post('submit') === 'XLSX')
		{
			$this->data['output'] = $this->input->post('submit');
			$this->load->view('admin/report/report_rekening_bendahara', $this->data);
		}
		// PDF
		else if ($this->input->post('submit') === 'PDF')
		{
			$this->data['output'] = $this->input->post('submit');
			// load m_referensi
			$this->data['pejabat'] = $this->m_referensi->get_pejabat($this->data['id_ref_satker']);
			// send data to view
			$this->data['content'] = $this->load->view('admin/report/report_rekening_bendahara', $this->data, TRUE);
			
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
			$html 	= $this->load->view('admin/components/report_header_laporan', $this->data, TRUE);
			$this->mpdf->WriteHTML($css, 1);
			$this->mpdf->WriteHTML($html, 2);
			$this->mpdf->Output($this->data['filename'] . '.pdf','D');
		}
		
	}
	
	public function report_detil_lpj_pengeluaran()
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
		// get id_ref_kanwil
		$kanwil = $this->m_referensi->get_kanwil($this->data['id_ref_satker']);
		// load m_referensi
		$this->data['pejabat'] = $this->m_referensi->get_pejabat($this->data['id_ref_satker']);
		
		// if kanwil
		if ($this->data['id_entities'] === '2')
		{
			$this->data['subtitle'] = 'Per Satuan Kerja Tingkat Wilayah';
			// nama entity
			$this->data['nm_entity'] = 'kanwil djpbn ' . $kanwil->nm_kanwil;
			
			// fetch rekap
			$detil_lpjs = $this->m_report->detil_lpj_pengeluaran($kanwil->id_ref_kanwil, $this->data['year'], $this->data['month']);

			// parent array
			$detil_kanwil = array();

			foreach ($detil_lpjs->result_array() as $detil_lpj) 
			{
				if ( !isset($detil_kanwil[$detil_lpj['kd_kementerian']]) ) 
				{
					$detil_kanwil[$detil_lpj['kd_kementerian']] = array();
				}
				
				$detil_kanwil[$detil_lpj['kd_kementerian']][$detil_lpj['kd_satker']][] = $detil_lpj;
			}
			
			$this->data['detil_kanwil'] = $detil_kanwil;
			
			// path to page folder view
			$this->data['subview'] = 'admin/report/form_detil_lpj';
			$this->load->view('admin/template/_layout_admin', $this->data);
			
		}
	}
	
	
	public function message()
	{
		$this->data['message_title'] = 'Informasi Data';
		
		$message = $this->session->flashdata('message');
		
		$this->data['message'] = $message;
		
		// load view message
		$this->load->view('admin/components/message', $this->data);
		// get flash variable
		$method = $this->session->flashdata('method');
		
		// redirect to index page
		$this->output->set_header('refresh:2; url=' . $method);
	}
}
