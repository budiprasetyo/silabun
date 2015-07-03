<?php
/*
 * dashboard.php
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

include_once "user.php";

class Dashboard extends Admin_Controller
{

	/**
	 * Constructor of class Dashboard.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		//~ $this->load->view('admin/template/_layout_admin', $this->data);
		redirect('admin/dashboard/home', 'refresh');
	}
	

	public function home()
	{	
		$this->load->model('m_dashboard');
		$this->load->helper('datetime');
		$this->load->helper('amountformat');
		// get year
		$this->data['year'] = $this->input->post('year') == TRUE ? $this->input->post('year') : date('Y');
		// get month
		$this->data['month'] = $this->input->post('month') == TRUE ? $this->input->post('month') : date('m');
		
		// if kppn
		if ($this->data['id_entities'] === '1') 
		{
			// load m_referensi model
			$this->load->model('m_referensi');
			// get id_ref_kanwil
			$kppn = $this->m_referensi->get_kppn($this->data['id_ref_satker']);
			// get kppn rekap
			$satkers = $this->m_dashboard->get_kppn_rekap($kppn->id_ref_kppn, $this->data['year']);
			$rekap_kppn_pengeluarans = $satkers['rekap_pengeluaran'];
			$rekap_kppn_penerimaans = $satkers['rekap_penerimaan'];
			
			// rekap pengeluaran
			$this->data['jml_satker_lpj'] = 0;
			$this->data['jml_satker_uang_persediaan'] = 0;
			$this->data['jml_satker_ls_bendahara'] = 0;
			$this->data['jml_satker_pajak'] = 0;
			$this->data['jml_satker_pengeluaran_lain'] = 0;
			$this->data['jml_satker_saldo'] = 0;
			$this->data['jml_satker_kuitansi'] = 0;
			$grouped_kppn = array();
			
			foreach ( $rekap_kppn_pengeluarans->result_array() as $satker ) 
			{
				if ( !isset($grouped_kppn[$satker['tahun']]) ) 
				{
					$grouped_kppn[$satker['tahun']] = array();
				}
				
				$grouped_kppn[$satker['tahun']][$satker['bulan']][] = $satker;
				$this->data['jml_satker_lpj'] 				+= $satker['jml_lpj'];
				$this->data['jml_satker_uang_persediaan'] 	+= $satker['uang_persediaan'];
				$this->data['jml_satker_ls_bendahara'] 		+= $satker['ls_bendahara'];
				$this->data['jml_satker_pajak'] 			+= $satker['pajak'];
				$this->data['jml_satker_pengeluaran_lain'] 	+= $satker['pengeluaran_lain'];
				$this->data['jml_satker_saldo']	 			+= $satker['saldo'];
				$this->data['jml_satker_kuitansi'] 			+= $satker['kuitansi'];
				
				$this->data['jml_satker_saldo_kas']			= $this->data['jml_satker_uang_persediaan'] + $this->data['jml_satker_ls_bendahara'] + $this->data['jml_satker_pajak'] + $this->data['jml_satker_pengeluaran_lain'];
				$this->data['jml_satker_saldo_up']			= $this->data['jml_satker_saldo'] + $this->data['jml_satker_kuitansi'];
			}
			
			$this->data['grouped_kppn'] = $grouped_kppn;
			// end of rekap pengeluaran
			
			// rekap penerimaan
			$this->data['jml_satker_lpj_penerimaan'] = 0;
			$this->data['jml_satker_kas_tunai'] = 0;
			$this->data['jml_satker_kas_bank'] = 0;
			$this->data['jml_satker_saldo_awal'] = 0;
			$this->data['jml_satker_penerimaan'] = 0;
			$this->data['jml_satker_penyetoran'] = 0;
			$grouped_satker_penerimaan = array();
			
			foreach ( $rekap_kppn_penerimaans->result_array() as $rekap_satker_penerimaan ) 
			{
				if ( !isset($grouped_satker_penerimaan[$rekap_satker_penerimaan['tahun']]) ) 
				{
					$grouped_satker_penerimaan[$rekap_satker_penerimaan['tahun']] = array();
				}
				
				$grouped_satker_penerimaan[$rekap_satker_penerimaan['tahun']][$rekap_satker_penerimaan['bulan']][] = $rekap_satker_penerimaan;
				$this->data['jml_satker_lpj_penerimaan'] 	+= $rekap_satker_penerimaan['jml_lpj'];
				$this->data['jml_satker_kas_tunai'] 		+= $rekap_satker_penerimaan['kas_tunai'];
				$this->data['jml_satker_kas_bank'] 			+= $rekap_satker_penerimaan['kas_bank'];
				$this->data['jml_satker_saldo_awal'] 		+= $rekap_satker_penerimaan['saldo_awal'];
				$this->data['jml_satker_penerimaan'] 		+= $rekap_satker_penerimaan['penerimaan'];
				$this->data['jml_satker_penyetoran'] 		+= $rekap_satker_penerimaan['penyetoran'];
				
				$this->data['jml_satker_saldo_kas_penerimaan'] = $this->data['jml_satker_kas_tunai'] + $this->data['jml_satker_kas_bank']; 
				$this->data['jml_satker_saldo_penyetoran_penerimaan'] = $this->data['jml_satker_saldo_awal'] + $this->data['jml_satker_penerimaan'] - $this->data['jml_satker_penyetoran']; 
			}
			$this->data['grouped_satker_penerimaan'] = $grouped_satker_penerimaan;
			// end of rekap penerimaan
			
		}
		// if kanwil
		else if($this->data['id_entities'] === '2')
		{
			// load m_referensi model
			$this->load->model('m_referensi');
			// get id_ref_kanwil
			$kanwil = $this->m_referensi->get_kanwil($this->data['id_ref_satker']);
			
			// bar chart pengeluaran dan penerimaan
			$jumlah_lpj 				= $this->m_dashboard->bar_chart($this->data['year'], $kanwil->id_ref_kanwil);
			$jml_lpj_pengeluarans 		= $jumlah_lpj['jumlah_lpj_pengeluaran'];
			$jml_wajib_lpj_pengeluarans = $jumlah_lpj['jumlah_wajib_lpj_pengeluaran'];
			$jml_lpj_penerimaans		= $jumlah_lpj['jumlah_lpj_penerimaan'];
			$jml_wajib_lpj_penerimaans 	= $jumlah_lpj['jumlah_wajib_lpj_penerimaan'];
			// PENGELUARAN DETAIL
			$jml_bp_pengeluarans		= $jumlah_lpj['jumlah_bp_pengeluaran'];
			// PENERIMAAN DETAIL
			$jml_bp_penerimaans			= $jumlah_lpj['jumlah_bp_penerimaan'];
			
			// PENGELUARAN
			// pengiriman lpj pengeluaran
			foreach ( $jml_lpj_pengeluarans->result() as $jml_lpj_pengeluaran ) 
			{
				// json format modified here
				$dataset_pengeluaran[] = array( 'gd(' . $jml_lpj_pengeluaran->tahun, $jml_lpj_pengeluaran->bulan . ')', $jml_lpj_pengeluaran->jml_lpj_pengeluaran );
			}
			// send this data to view
			$this->data['dataset_pengeluaran'] = $dataset_pengeluaran;
			
			// wajib lpj pengeluaran
			foreach ( $jml_wajib_lpj_pengeluarans->result() as $jml_wajib_lpj_pengeluaran ) 
			{
				// json format modified here
				$dataset_wajib_pengeluaran[] = array( 'gd(' . $jml_wajib_lpj_pengeluaran->tahun, $jml_wajib_lpj_pengeluaran->bulan . ')', $jml_wajib_lpj_pengeluaran->wajib_lpj_pengeluaran );
			}
			// send this data to view
			$this->data['dataset_wajib_pengeluaran'] = $dataset_wajib_pengeluaran;
			
			// PENERIMAAN
			// pengiriman lpj penerimaan
			foreach ( $jml_lpj_penerimaans->result() as $jml_lpj_penerimaan ) 
			{
				// json format modified here
				$dataset_penerimaan[] = array( 'gd(' . $jml_lpj_penerimaan->tahun, $jml_lpj_penerimaan->bulan . ')', $jml_lpj_penerimaan->jml_lpj_penerimaan );
			}
			// send this data to view
			$this->data['dataset_penerimaan'] = $dataset_penerimaan;
			
			// wajib lpj penerimaan
			foreach ( $jml_wajib_lpj_penerimaans->result() as $jml_wajib_lpj_penerimaan ) 
			{
				// json format modified here
				$dataset_wajib_penerimaan[] = array( 'gd(' . $jml_wajib_lpj_penerimaan->tahun, $jml_wajib_lpj_penerimaan->bulan . ')', $jml_wajib_lpj_penerimaan->wajib_lpj_penerimaan );
			}
			// send this data to view
			$this->data['dataset_wajib_penerimaan'] = $dataset_wajib_penerimaan;
			
			
			// PENGELUARAN DETIL
			// jumlah pengeluaran detil
			foreach ( $jml_bp_pengeluarans->result() as $jml_bp_pengeluaran ) 
			{
				// json format modified here
				$dataset_pengeluaran_up[] = array( 'gd(' . $jml_bp_pengeluaran->tahun, $jml_bp_pengeluaran->bulan . ')', $jml_bp_pengeluaran->uang_persediaan );
				// json format modified here
				$dataset_pengeluaran_ls_bendahara[] = array( 'gd(' . $jml_bp_pengeluaran->tahun, $jml_bp_pengeluaran->bulan . ')', $jml_bp_pengeluaran->ls_bendahara );
				// json format modified here
				$dataset_pengeluaran_pajak[] = array( 'gd(' . $jml_bp_pengeluaran->tahun, $jml_bp_pengeluaran->bulan . ')', $jml_bp_pengeluaran->pajak );
				// json format modified here
				$dataset_pengeluaran_lain[] = array( 'gd(' . $jml_bp_pengeluaran->tahun, $jml_bp_pengeluaran->bulan . ')', $jml_bp_pengeluaran->pengeluaran_lain );
				// json format modified here
				$dataset_pengeluaran_saldo[] = array( 'gd(' . $jml_bp_pengeluaran->tahun, $jml_bp_pengeluaran->bulan . ')', $jml_bp_pengeluaran->saldo );
				// json format modified here
				$dataset_pengeluaran_kuitansi[] = array( 'gd(' . $jml_bp_pengeluaran->tahun, $jml_bp_pengeluaran->bulan . ')', $jml_bp_pengeluaran->kuitansi );
			}
			// send this pengeluaran UP to view
			$this->data['dataset_pengeluaran_up'] 				= $dataset_pengeluaran_up;
			// send this pengeluaran UP to view
			$this->data['dataset_pengeluaran_ls_bendahara'] 	= $dataset_pengeluaran_ls_bendahara;
			// send this pengeluaran UP to view
			$this->data['dataset_pengeluaran_pajak'] 			= $dataset_pengeluaran_pajak;
			// send this pengeluaran lain to view
			$this->data['dataset_pengeluaran_lain'] 			= $dataset_pengeluaran_lain;
			// send this pengeluaran saldo to view
			$this->data['dataset_pengeluaran_saldo'] 			= $dataset_pengeluaran_saldo;
			// send this pengeluaran kuitansi to view
			$this->data['dataset_pengeluaran_kuitansi'] 		= $dataset_pengeluaran_kuitansi;
			
			// PENERIMAAN DETIL
			// jumlah penerimaan detil
			foreach ( $jml_bp_penerimaans->result() as $jml_bp_penerimaan ) 
			{
				// json format modified here
				// kas tunai
				$dataset_penerimaan_kas_tunai[] = array( 'gd(' . $jml_bp_penerimaan->tahun, $jml_bp_penerimaan->bulan . ')', $jml_bp_penerimaan->kas_tunai );
				// kas bank
				$dataset_penerimaan_kas_bank[] = array( 'gd(' . $jml_bp_penerimaan->tahun, $jml_bp_penerimaan->bulan . ')', $jml_bp_penerimaan->kas_bank );
				// saldo awal penerimaan
				$dataset_penerimaan_saldo_awal[] = array( 'gd(' . $jml_bp_penerimaan->tahun, $jml_bp_penerimaan->bulan . ')', $jml_bp_penerimaan->saldo_awal );
				//  penerimaan
				$dataset_penerimaan_penerimaan[] = array( 'gd(' . $jml_bp_penerimaan->tahun, $jml_bp_penerimaan->bulan . ')', $jml_bp_penerimaan->penerimaan );
				//  penyetoran
				$dataset_penerimaan_penyetoran[] = array( 'gd(' . $jml_bp_penerimaan->tahun, $jml_bp_penerimaan->bulan . ')', $jml_bp_penerimaan->penyetoran );
			}
			// send this penerimaan to view
			$this->data['dataset_penerimaan_kas_tunai'] = $dataset_penerimaan_kas_tunai;
			$this->data['dataset_penerimaan_kas_bank'] = $dataset_penerimaan_kas_bank;
			$this->data['dataset_penerimaan_saldo_awal'] = $dataset_penerimaan_saldo_awal;
			$this->data['dataset_penerimaan_penerimaan'] = $dataset_penerimaan_penerimaan;
			$this->data['dataset_penerimaan_penyetoran'] = $dataset_penerimaan_penyetoran;
			
			
			// get kanwil rekap
			$kppns = $this->m_dashboard->get_kanwil_rekap($kanwil->id_ref_kanwil);
			$rekap_kanwil_pengeluarans = $kppns['rekap_pengeluaran'];
			$rekap_kanwil_penerimaans = $kppns['rekap_penerimaan'];
			
			// rekap pengeluaran
			$this->data['jml_kppn_lpj'] = 0;
			$this->data['jml_kppn_uang_persediaan'] = 0;
			$this->data['jml_kppn_ls_bendahara'] = 0;
			$this->data['jml_kppn_pajak'] = 0;
			$this->data['jml_kppn_pengeluaran_lain'] = 0;
			$this->data['jml_kppn_saldo'] = 0;
			$this->data['jml_kppn_kuitansi'] = 0;
			$grouped_kanwil = array();
			
			foreach ( $rekap_kanwil_pengeluarans->result_array() as $kppn ) 
			{
				if ( !isset($grouped_kanwil[$kppn['tahun']]) ) 
				{
					$grouped_kanwil[$kppn['tahun']] = array();
				}
				
				$grouped_kanwil[$kppn['tahun']][$kppn['bulan']][] 	= $kppn;
				$this->data['jml_kppn_lpj'] 				+= $kppn['jml_lpj'];
				$this->data['jml_kppn_uang_persediaan'] 	+= $kppn['uang_persediaan'];
				$this->data['jml_kppn_ls_bendahara'] 		+= $kppn['ls_bendahara'];
				$this->data['jml_kppn_pajak'] 				+= $kppn['pajak'];
				$this->data['jml_kppn_pengeluaran_lain'] 	+= $kppn['pengeluaran_lain'];
				$this->data['jml_kppn_saldo']	 			+= $kppn['saldo'];
				$this->data['jml_kppn_kuitansi'] 			+= $kppn['kuitansi'];
				
				$this->data['jml_kppn_saldo_kas']			= $this->data['jml_kppn_uang_persediaan'] + $this->data['jml_kppn_ls_bendahara'] + $this->data['jml_kppn_pajak'] + $this->data['jml_kppn_pengeluaran_lain'];
				$this->data['jml_kppn_saldo_up']			= $this->data['jml_kppn_saldo'] + $this->data['jml_kppn_kuitansi'];
			}
			
			$this->data['grouped_kanwil'] = $grouped_kanwil;
			// end of rekap pengeluaran
			
			// rekap penerimaan
			$this->data['jml_kppn_lpj_penerimaan'] = 0;
			$this->data['jml_kppn_kas_tunai'] = 0;
			$this->data['jml_kppn_kas_bank'] = 0;
			$this->data['jml_kppn_saldo_awal'] = 0;
			$this->data['jml_kppn_penerimaan'] = 0;
			$this->data['jml_kppn_penyetoran'] = 0;
			$grouped_kppn_penerimaan = array();
			
			foreach ( $rekap_kanwil_penerimaans->result_array() as $rekap_kppn_penerimaan ) 
			{
				if ( !isset($grouped_kppn_penerimaan[$rekap_kppn_penerimaan['tahun']]) ) 
				{
					$grouped_kppn_penerimaan[$rekap_kppn_penerimaan['tahun']] = array();
				}
				
				$grouped_kppn_penerimaan[$rekap_kppn_penerimaan['tahun']][$rekap_kppn_penerimaan['bulan']][] = $rekap_kppn_penerimaan;
				$this->data['jml_kppn_lpj_penerimaan'] 	+= $rekap_kppn_penerimaan['jml_lpj'];
				$this->data['jml_kppn_kas_tunai'] 		+= $rekap_kppn_penerimaan['kas_tunai'];
				$this->data['jml_kppn_kas_bank'] 		+= $rekap_kppn_penerimaan['kas_bank'];
				$this->data['jml_kppn_saldo_awal'] 		+= $rekap_kppn_penerimaan['saldo_awal'];
				$this->data['jml_kppn_penerimaan'] 		+= $rekap_kppn_penerimaan['penerimaan'];
				$this->data['jml_kppn_penyetoran'] 		+= $rekap_kppn_penerimaan['penyetoran'];
				
				$this->data['jml_kppn_saldo_kas_penerimaan'] = $this->data['jml_kppn_kas_tunai'] + $this->data['jml_kppn_kas_bank']; 
				$this->data['jml_kppn_saldo_penyetoran_penerimaan'] = $this->data['jml_kppn_saldo_awal'] + $this->data['jml_kppn_penerimaan'] - $this->data['jml_kppn_penyetoran']; 
			}
			
			$this->data['grouped_kppn_penerimaan'] = $grouped_kppn_penerimaan;
			
			// end of rekap penerimaan
		}
		// if pkn
		else if($this->data['id_entities'] === '3')
		{
			// bar chart pengeluaran dan penerimaan
			$jumlah_lpj 				= $this->m_dashboard->bar_chart($this->data['year']);
			$jml_lpj_pengeluarans 		= $jumlah_lpj['jumlah_lpj_pengeluaran'];
			$jml_wajib_lpj_pengeluarans = $jumlah_lpj['jumlah_wajib_lpj_pengeluaran'];
			$jml_lpj_penerimaans		= $jumlah_lpj['jumlah_lpj_penerimaan'];
			$jml_wajib_lpj_penerimaans 	= $jumlah_lpj['jumlah_wajib_lpj_penerimaan'];
			// PENGELUARAN DETAIL
			$jml_bp_pengeluarans			= $jumlah_lpj['jumlah_bp_pengeluaran'];
			// PENERIMAAN DETAIL
			$jml_bp_penerimaans			= $jumlah_lpj['jumlah_bp_penerimaan'];
			
			// PENGELUARAN
			// pengiriman lpj pengeluaran
			foreach ( $jml_lpj_pengeluarans->result() as $jml_lpj_pengeluaran ) 
			{
				// json format modified here
				$dataset_pengeluaran[] = array( 'gd(' . $jml_lpj_pengeluaran->tahun, $jml_lpj_pengeluaran->bulan . ')', $jml_lpj_pengeluaran->jml_lpj_pengeluaran );
			}
			// send this data to view
			$this->data['dataset_pengeluaran'] = $dataset_pengeluaran;
			
			// wajib lpj pengeluaran
			foreach ( $jml_wajib_lpj_pengeluarans->result() as $jml_wajib_lpj_pengeluaran ) 
			{
				// json format modified here
				$dataset_wajib_pengeluaran[] = array( 'gd(' . $jml_wajib_lpj_pengeluaran->tahun, $jml_wajib_lpj_pengeluaran->bulan . ')', $jml_wajib_lpj_pengeluaran->wajib_lpj_pengeluaran );
			}
			// send this data to view
			$this->data['dataset_wajib_pengeluaran'] = $dataset_wajib_pengeluaran;
			
			// pengiriman lpj penerimaan
			foreach ( $jml_lpj_penerimaans->result() as $jml_lpj_penerimaan ) 
			{
				// json format modified here
				$dataset_penerimaan[] = array( 'gd(' . $jml_lpj_penerimaan->tahun, $jml_lpj_penerimaan->bulan . ')', $jml_lpj_penerimaan->jml_lpj_penerimaan );
			}
			// send this data to view
			$this->data['dataset_penerimaan'] = $dataset_penerimaan;
			
			// wajib lpj penerimaan
			foreach ( $jml_wajib_lpj_penerimaans->result() as $jml_wajib_lpj_penerimaan ) 
			{
				// json format modified here
				$dataset_wajib_penerimaan[] = array( 'gd(' . $jml_wajib_lpj_penerimaan->tahun, $jml_wajib_lpj_penerimaan->bulan . ')', $jml_wajib_lpj_penerimaan->wajib_lpj_penerimaan );
			}
			// send this data to view
			$this->data['dataset_wajib_penerimaan'] = $dataset_wajib_penerimaan;
			
			// PENGELUARAN DETIL
			// jumlah pengeluaran detil
			foreach ( $jml_bp_pengeluarans->result() as $jml_bp_pengeluaran ) 
			{
				// json format modified here
				$dataset_pengeluaran_up[] = array( 'gd(' . $jml_bp_pengeluaran->tahun, $jml_bp_pengeluaran->bulan . ')', $jml_bp_pengeluaran->uang_persediaan );
				// json format modified here
				$dataset_pengeluaran_ls_bendahara[] = array( 'gd(' . $jml_bp_pengeluaran->tahun, $jml_bp_pengeluaran->bulan . ')', $jml_bp_pengeluaran->ls_bendahara );
				// json format modified here
				$dataset_pengeluaran_pajak[] = array( 'gd(' . $jml_bp_pengeluaran->tahun, $jml_bp_pengeluaran->bulan . ')', $jml_bp_pengeluaran->pajak );
				// json format modified here
				$dataset_pengeluaran_lain[] = array( 'gd(' . $jml_bp_pengeluaran->tahun, $jml_bp_pengeluaran->bulan . ')', $jml_bp_pengeluaran->pengeluaran_lain );
				// json format modified here
				$dataset_pengeluaran_saldo[] = array( 'gd(' . $jml_bp_pengeluaran->tahun, $jml_bp_pengeluaran->bulan . ')', $jml_bp_pengeluaran->saldo );
				// json format modified here
				$dataset_pengeluaran_kuitansi[] = array( 'gd(' . $jml_bp_pengeluaran->tahun, $jml_bp_pengeluaran->bulan . ')', $jml_bp_pengeluaran->kuitansi );
			}
			// send this pengeluaran UP to view
			$this->data['dataset_pengeluaran_up'] 				= $dataset_pengeluaran_up;
			// send this pengeluaran UP to view
			$this->data['dataset_pengeluaran_ls_bendahara'] 	= $dataset_pengeluaran_ls_bendahara;
			// send this pengeluaran UP to view
			$this->data['dataset_pengeluaran_pajak'] 			= $dataset_pengeluaran_pajak;
			// send this pengeluaran lain to view
			$this->data['dataset_pengeluaran_lain'] 			= $dataset_pengeluaran_lain;
			// send this pengeluaran saldo to view
			$this->data['dataset_pengeluaran_saldo'] 			= $dataset_pengeluaran_saldo;
			// send this pengeluaran kuitansi to view
			$this->data['dataset_pengeluaran_kuitansi'] 		= $dataset_pengeluaran_kuitansi;
			
			// PENERIMAAN DETIL
			// jumlah penerimaan detil
			foreach ( $jml_bp_penerimaans->result() as $jml_bp_penerimaan ) 
			{
				// json format modified here
				// kas tunai
				$dataset_penerimaan_kas_tunai[] = array( 'gd(' . $jml_bp_penerimaan->tahun, $jml_bp_penerimaan->bulan . ')', $jml_bp_penerimaan->kas_tunai );
				// kas bank
				$dataset_penerimaan_kas_bank[] = array( 'gd(' . $jml_bp_penerimaan->tahun, $jml_bp_penerimaan->bulan . ')', $jml_bp_penerimaan->kas_bank );
				// saldo awal penerimaan
				$dataset_penerimaan_saldo_awal[] = array( 'gd(' . $jml_bp_penerimaan->tahun, $jml_bp_penerimaan->bulan . ')', $jml_bp_penerimaan->saldo_awal );
				//  penerimaan
				$dataset_penerimaan_penerimaan[] = array( 'gd(' . $jml_bp_penerimaan->tahun, $jml_bp_penerimaan->bulan . ')', $jml_bp_penerimaan->penerimaan );
				//  penyetoran
				$dataset_penerimaan_penyetoran[] = array( 'gd(' . $jml_bp_penerimaan->tahun, $jml_bp_penerimaan->bulan . ')', $jml_bp_penerimaan->penyetoran );
			}
			// send this penerimaan to view
			$this->data['dataset_penerimaan_kas_tunai'] = $dataset_penerimaan_kas_tunai;
			$this->data['dataset_penerimaan_kas_bank'] = $dataset_penerimaan_kas_bank;
			$this->data['dataset_penerimaan_saldo_awal'] = $dataset_penerimaan_saldo_awal;
			$this->data['dataset_penerimaan_penerimaan'] = $dataset_penerimaan_penerimaan;
			$this->data['dataset_penerimaan_penyetoran'] = $dataset_penerimaan_penyetoran;
			
			// get kanwil rekap
			$kanwils = $this->m_dashboard->get_pkn_rekap();
			$rekap_pengeluarans = $kanwils['rekap_pengeluaran'];
			$rekap_penerimaans = $kanwils['rekap_penerimaan'];
			
			// rekap pengeluaran
			$this->data['jml_lpj'] = 0;
			$this->data['jml_uang_persediaan'] = 0;
			$this->data['jml_ls_bendahara'] = 0;
			$this->data['jml_pajak'] = 0;
			$this->data['jml_pengeluaran_lain'] = 0;
			$this->data['jml_saldo'] = 0;
			$this->data['jml_kuitansi'] = 0;
			$grouped = array();
			
			foreach ( $rekap_pengeluarans->result_array() as $kanwil ) 
			{
				if ( !isset($grouped[$kanwil['tahun']]) ) 
				{
					$grouped[$kanwil['tahun']] = array();
				}
				
				$grouped[$kanwil['tahun']][$kanwil['bulan']][] = $kanwil;
				$this->data['jml_lpj'] 				+= $kanwil['jml_lpj'];
				$this->data['jml_uang_persediaan'] 	+= $kanwil['uang_persediaan'];
				$this->data['jml_ls_bendahara'] 	+= $kanwil['ls_bendahara'];
				$this->data['jml_pajak'] 			+= $kanwil['pajak'];
				$this->data['jml_pengeluaran_lain'] += $kanwil['pengeluaran_lain'];
				$this->data['jml_saldo']	 		+= $kanwil['saldo'];
				$this->data['jml_kuitansi'] 		+= $kanwil['kuitansi'];
				
				$this->data['jml_saldo_kas']		= $this->data['jml_uang_persediaan'] + $this->data['jml_ls_bendahara'] + $this->data['jml_pajak'] + $this->data['jml_pengeluaran_lain'];$this->data['jml_saldo_up']			= $this->data['jml_saldo'] + $this->data['jml_kuitansi'];
			}
			
			$this->data['grouped'] = $grouped;
			// end of rekap pengeluaran
			
			// rekap penerimaan
			$this->data['jml_lpj_penerimaan'] = 0;
			$this->data['jml_kas_tunai'] = 0;
			$this->data['jml_kas_bank'] = 0;
			$this->data['jml_saldo_awal'] = 0;
			$this->data['jml_penerimaan'] = 0;
			$this->data['jml_penyetoran'] = 0;
			$grouped_penerimaan = array();
			
			foreach ( $rekap_penerimaans->result_array() as $rekap_penerimaan ) 
			{
				if ( !isset($grouped_penerimaan[$rekap_penerimaan['tahun']]) ) 
				{
					$grouped_penerimaan[$rekap_penerimaan['tahun']] = array();
				}
				
				$grouped_penerimaan[$rekap_penerimaan['tahun']][$rekap_penerimaan['bulan']][] = $rekap_penerimaan;
				$this->data['jml_lpj_penerimaan'] += $rekap_penerimaan['jml_lpj'];
				$this->data['jml_kas_tunai'] 	+= $rekap_penerimaan['kas_tunai'];
				$this->data['jml_kas_bank'] 	+= $rekap_penerimaan['kas_bank'];
				$this->data['jml_saldo_awal'] 	+= $rekap_penerimaan['saldo_awal'];
				$this->data['jml_penerimaan'] 	+= $rekap_penerimaan['penerimaan'];
				$this->data['jml_penyetoran'] 	+= $rekap_penerimaan['penyetoran'];
				
				$this->data['jml_saldo_kas_penerimaan'] = $this->data['jml_kas_tunai'] + $this->data['jml_kas_bank']; 
				$this->data['jml_saldo_penyetoran_penerimaan'] = $this->data['jml_saldo_awal'] + $this->data['jml_penerimaan'] - $this->data['jml_penyetoran']; 
			}
			
			$this->data['grouped_penerimaan'] = $grouped_penerimaan;
			// end of rekap penerimaan
		}
		
		$this->data['subview'] = 'admin/dashboard/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function logout()
	{
		$user = new user();	
		$user->logout();
	}

}
