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
		
		// if pkn
		if($this->data['id_entities'] === '3')
		{
			// get kanwil rekap
			$kanwils = $this->m_dashboard->get_kanwil_rekap();
			
			
			$this->data['jml_lpj'] = 0;
			$this->data['jml_uang_persediaan'] = 0;
			$this->data['jml_ls_bendahara'] = 0;
			$this->data['jml_pajak'] = 0;
			$this->data['jml_pengeluaran_lain'] = 0;
			$this->data['jml_saldo'] = 0;
			$this->data['jml_kuitansi'] = 0;
			$grouped = array();
			
			foreach ( $kanwils->result_array() as $kanwil ) 
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
