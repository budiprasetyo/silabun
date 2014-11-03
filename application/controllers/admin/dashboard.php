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
		
		// if kppn
		if ($this->data['id_entities'] === '1') 
		{
			// load m_referensi model
			$this->load->model('m_referensi');
			// get id_ref_kanwil
			$kppn = $this->m_referensi->get_kppn($this->data['id_ref_satker']);
			// get kppn rekap
			$satkers = $this->m_dashboard->get_kppn_rekap($kppn->id_ref_kppn);
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
