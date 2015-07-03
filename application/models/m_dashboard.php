<?php
/*
 * m_dashboard.php
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



class M_dashboard extends MY_Model
{

	public function get_pkn_rekap($tahun = null)
	{
		$rekap_pengeluaran = $this->db->select('dsp_report_rekap_lpjk.tahun')
							->select('dsp_report_rekap_lpjk.bulan')
							->select('dsp_report_rekap_lpjk.id_ref_kanwil')
							->select('dsp_report_rekap_lpjk.kd_kanwil')
							->select('dsp_report_rekap_lpjk.nm_kanwil')
							->select('count(*) AS jml_lpj')
							->select_sum('dsp_report_rekap_lpjk.uang_persediaan')
							->select_sum('dsp_report_rekap_lpjk.ls_bendahara')
							->select_sum('dsp_report_rekap_lpjk.pajak')
							->select_sum('dsp_report_rekap_lpjk.pengeluaran_lain')
							->select_sum('dsp_report_rekap_lpjk.saldo')
							->select_sum('dsp_report_rekap_lpjk.kuitansi')
							->from('dsp_report_rekap_lpjk')
							->join('ref_history_satker', 'ref_history_satker.id_ref_satker = dsp_report_rekap_lpjk.id_ref_satker AND ref_history_satker.tahun = dsp_report_rekap_lpjk.tahun AND ref_history_satker.bulan = dsp_report_rekap_lpjk.bulan', 'left')
							->where('ref_history_satker.lpj_status_pengeluaran', 1)
							->group_by('dsp_report_rekap_lpjk.tahun')
							->group_by('dsp_report_rekap_lpjk.bulan')
							->group_by('dsp_report_rekap_lpjk.id_ref_kanwil')
							->group_by('dsp_report_rekap_lpjk.kd_kanwil')
							->group_by('dsp_report_rekap_lpjk.nm_kanwil')
							->order_by('dsp_report_rekap_lpjk.tahun')
							->order_by('dsp_report_rekap_lpjk.bulan')
							->order_by('dsp_report_rekap_lpjk.kd_kanwil');
		
		if ( $tahun !== null ) {
			$rekap_pengeluaran = $this->db->where('dsp_report_rekap_lpjk.tahun', $tahun);
		}
		
		$rekap_pengeluaran = $this->db->get();
							
		$rekap_penerimaan = $this->db->select('dsp_report_rekap_lpjt.tahun')
							->select('dsp_report_rekap_lpjt.bulan')
							->select('dsp_report_rekap_lpjt.id_ref_kanwil')
							->select('dsp_report_rekap_lpjt.kd_kanwil')
							->select('dsp_report_rekap_lpjt.nm_kanwil')
							->select('count(*) AS jml_lpj')
							->select_sum('dsp_report_rekap_lpjt.kas_tunai')
							->select_sum('dsp_report_rekap_lpjt.kas_bank')
							->select_sum('dsp_report_rekap_lpjt.saldo_awal')
							->select_sum('dsp_report_rekap_lpjt.penerimaan')
							->select_sum('dsp_report_rekap_lpjt.penyetoran')
							->from('dsp_report_rekap_lpjt')
							->join('ref_history_satker', 'ref_history_satker.id_ref_satker = dsp_report_rekap_lpjt.id_ref_satker AND ref_history_satker.tahun = dsp_report_rekap_lpjt.tahun AND ref_history_satker.bulan = dsp_report_rekap_lpjt.bulan', 'left')
							->where('ref_history_satker.lpj_status_penerimaan', 1)
							->group_by('dsp_report_rekap_lpjt.tahun')
							->group_by('dsp_report_rekap_lpjt.bulan')
							->group_by('dsp_report_rekap_lpjt.id_ref_kanwil')
							->group_by('dsp_report_rekap_lpjt.kd_kanwil')
							->group_by('dsp_report_rekap_lpjt.nm_kanwil')
							->order_by('dsp_report_rekap_lpjt.tahun')
							->order_by('dsp_report_rekap_lpjt.bulan')
							->order_by('dsp_report_rekap_lpjt.kd_kanwil');
		
		if ( $tahun !== null ) {
			$rekap_penerimaan = $this->db->where('dsp_report_rekap_lpjt.tahun', $tahun);
		}
		
		$rekap_penerimaan = $this->db->get();
		
							
		
			return array(
				'rekap_pengeluaran' => $rekap_pengeluaran,
				'rekap_penerimaan' => $rekap_penerimaan
			);
	}

	public function get_kanwil_rekap($id_ref_kanwil)
	{
		$rekap_pengeluaran = $this->db->select('dsp_report_rekap_lpjk.tahun')
							->select('dsp_report_rekap_lpjk.bulan')
							->select('dsp_report_rekap_lpjk.id_ref_kanwil')
							->select('dsp_report_rekap_lpjk.kd_kanwil')
							->select('dsp_report_rekap_lpjk.nm_kanwil')
							->select('dsp_report_rekap_lpjk.kd_kppn')
							->select('dsp_report_rekap_lpjk.nm_kppn')
							->select('count(*) AS jml_lpj')
							->select_sum('dsp_report_rekap_lpjk.uang_persediaan')
							->select_sum('dsp_report_rekap_lpjk.ls_bendahara')
							->select_sum('dsp_report_rekap_lpjk.pajak')
							->select_sum('dsp_report_rekap_lpjk.pengeluaran_lain')
							->select_sum('dsp_report_rekap_lpjk.saldo')
							->select_sum('dsp_report_rekap_lpjk.kuitansi')
							->from('dsp_report_rekap_lpjk')
							->join('ref_satker', 'ref_satker.id_ref_satker = dsp_report_rekap_lpjk.id_ref_satker', 'left')
							->where('ref_satker.lpj_status_pengeluaran', 1)
							->where('dsp_report_rekap_lpjk.id_ref_kanwil', $id_ref_kanwil)
							->where('dsp_report_rekap_lpjk.bulan <=', '12')
							->group_by('dsp_report_rekap_lpjk.tahun')
							->group_by('dsp_report_rekap_lpjk.bulan')
							->group_by('dsp_report_rekap_lpjk.id_ref_kanwil')
							->group_by('dsp_report_rekap_lpjk.kd_kanwil')
							->group_by('dsp_report_rekap_lpjk.nm_kanwil')
							->group_by('dsp_report_rekap_lpjk.kd_kppn')
							->group_by('dsp_report_rekap_lpjk.nm_kppn')
							->get();
							
		$rekap_penerimaan = $this->db->select('dsp_report_rekap_lpjt.tahun')
							->select('dsp_report_rekap_lpjt.bulan')
							->select('dsp_report_rekap_lpjt.id_ref_kanwil')
							->select('dsp_report_rekap_lpjt.kd_kanwil')
							->select('dsp_report_rekap_lpjt.nm_kanwil')
							->select('dsp_report_rekap_lpjt.kd_kppn')
							->select('dsp_report_rekap_lpjt.nm_kppn')
							->select('count(*) AS jml_lpj')
							->select_sum('dsp_report_rekap_lpjt.kas_tunai')
							->select_sum('dsp_report_rekap_lpjt.kas_bank')
							->select_sum('dsp_report_rekap_lpjt.saldo_awal')
							->select_sum('dsp_report_rekap_lpjt.penerimaan')
							->select_sum('dsp_report_rekap_lpjt.penyetoran')
							->from('dsp_report_rekap_lpjt')
							->join('ref_satker', 'ref_satker.id_ref_satker = dsp_report_rekap_lpjt.id_ref_satker', 'left')
							->where('ref_satker.lpj_status_penerimaan', 1)
							->where('dsp_report_rekap_lpjt.id_ref_kanwil', $id_ref_kanwil)
							->group_by('dsp_report_rekap_lpjt.tahun')
							->group_by('dsp_report_rekap_lpjt.bulan')
							->group_by('dsp_report_rekap_lpjt.id_ref_kanwil')
							->group_by('dsp_report_rekap_lpjt.kd_kanwil')
							->group_by('dsp_report_rekap_lpjt.nm_kanwil')
							->group_by('dsp_report_rekap_lpjt.kd_kppn')
							->group_by('dsp_report_rekap_lpjt.nm_kppn')
							->get();
		
							
		
			return array(
				'rekap_pengeluaran' => $rekap_pengeluaran,
				'rekap_penerimaan' => $rekap_penerimaan
			);
	}

	public function get_kppn_rekap($id_ref_kppn, $tahun = null)
	{
		
		$rekap_pengeluaran = $this->db->select('dsp_report_rekap_lpjk.tahun')
							->select('dsp_report_rekap_lpjk.bulan')
							->select('count(*) AS jml_lpj')
							->select_sum('dsp_report_rekap_lpjk.uang_persediaan')
							->select_sum('dsp_report_rekap_lpjk.ls_bendahara')
							->select_sum('dsp_report_rekap_lpjk.pajak')
							->select_sum('dsp_report_rekap_lpjk.pengeluaran_lain')
							->select_sum('dsp_report_rekap_lpjk.saldo')
							->select_sum('dsp_report_rekap_lpjk.kuitansi')
							->from('dsp_report_rekap_lpjk')
							->join('ref_history_satker', 'dsp_report_rekap_lpjk.id_ref_satker = ref_history_satker.id_ref_satker AND dsp_report_rekap_lpjk.tahun = ref_history_satker.tahun AND dsp_report_rekap_lpjk.bulan = ref_history_satker.bulan', 'left')
							->where('ref_history_satker.lpj_status_pengeluaran', 1)
							->where('dsp_report_rekap_lpjk.id_ref_kppn', $id_ref_kppn)
							->group_by('dsp_report_rekap_lpjk.tahun')
							->group_by('dsp_report_rekap_lpjk.bulan');
		
		if ( $tahun !== null ) {
			$rekap_pengeluaran = $this->db->where('dsp_report_rekap_lpjk.tahun', $tahun);
		}
		
		$rekap_pengeluaran = $this->db->get();
							
		$rekap_penerimaan = $this->db->select('dsp_report_rekap_lpjt.tahun')
							->select('dsp_report_rekap_lpjt.bulan')
							->select('count(*) AS jml_lpj')
							->select_sum('dsp_report_rekap_lpjt.kas_tunai')
							->select_sum('dsp_report_rekap_lpjt.kas_bank')
							->select_sum('dsp_report_rekap_lpjt.saldo_awal')
							->select_sum('dsp_report_rekap_lpjt.penerimaan')
							->select_sum('dsp_report_rekap_lpjt.penyetoran')
							->from('dsp_report_rekap_lpjt')
							->join('ref_history_satker', 'dsp_report_rekap_lpjt.id_ref_satker = ref_history_satker.id_ref_satker AND dsp_report_rekap_lpjt.tahun = ref_history_satker.tahun AND dsp_report_rekap_lpjt.bulan = ref_history_satker.bulan', 'left')
							->where('ref_history_satker.lpj_status_penerimaan', 1)
							->where('dsp_report_rekap_lpjt.id_ref_kppn', $id_ref_kppn)
							->group_by('dsp_report_rekap_lpjt.tahun')
							->group_by('dsp_report_rekap_lpjt.bulan');
		
		if ( $tahun !== null ) {
			$rekap_penerimaan = $this->db->where('dsp_report_rekap_lpjt.tahun', $tahun);
		}
		
		$rekap_penerimaan = $this->db->get();
		
							
		
			return array(
				'rekap_pengeluaran' => $rekap_pengeluaran,
				'rekap_penerimaan' => $rekap_penerimaan
			);
	}
	
	public function bar_chart($tahun = null, $id_ref_kanwil = null)
	{
		// PKN & Kanwil
		// jumlah wajib LPJ dan kiriman LPJ pengeluaran
		// PENGELUARAN
		$jumlah_wajib_lpj_pengeluaran = $this->db->select('ref_history_satker.tahun')
										->select('ref_history_satker.bulan')
										->select('ref_history_satker.lpj_status_pengeluaran')
										->select('count(*) as wajib_lpj_pengeluaran')
										->from('ref_history_satker')
										->where('ref_history_satker.lpj_status_pengeluaran', 1)
										->group_by('ref_history_satker.tahun')
										->group_by('ref_history_satker.bulan');
		if ( $id_ref_kanwil !== null )
		{
			$jumlah_wajib_lpj_pengeluaran = $this->db->join('ref_satker', 'ref_satker.id_ref_satker = ref_history_satker.id_ref_satker', 'left')
											->join('ref_kppn', 'ref_satker.id_ref_kppn = ref_kppn.id_ref_kppn', 'left')
											->where('ref_kppn.id_ref_kanwil', $id_ref_kanwil);
		}
		
			
		if ( $tahun !== null ) {
			$jumlah_wajib_lpj_pengeluaran = $this->db->where('ref_history_satker.tahun', $tahun);
		}
		
		$jumlah_wajib_lpj_pengeluaran = $this->db->get();
		
		// jumlah lpj pengeluaran
		$jumlah_lpj_pengeluaran = $this->db->distinct()
								->select('dsp_report_rekap_lpjk.tahun')
								->select('dsp_report_rekap_lpjk.bulan')
								->select('count(*) as jml_lpj_pengeluaran')
								->from('dsp_report_rekap_lpjk')
								->join('ref_history_satker', 'dsp_report_rekap_lpjk.id_ref_satker = ref_history_satker.id_ref_satker AND dsp_report_rekap_lpjk.tahun = ref_history_satker.tahun AND dsp_report_rekap_lpjk.bulan = ref_history_satker.bulan', 'left')
								->where('ref_history_satker.lpj_status_pengeluaran', 1)
								->where('dsp_report_rekap_lpjk.bulan <=', '12')
								->group_by('dsp_report_rekap_lpjk.tahun')
								->group_by('dsp_report_rekap_lpjk.bulan');
								
		if ( $id_ref_kanwil !== null )
		{
			$jumlah_lpj_pengeluaran = $this->db->where('dsp_report_rekap_lpjk.id_ref_kanwil', $id_ref_kanwil);
		}
		
		if ( $tahun !== null ) {
			$jumlah_lpj_pengeluaran = $this->db->where('dsp_report_rekap_lpjk.tahun', $tahun);
		}
		
		$jumlah_lpj_pengeluaran = $this->db->get();
								
		// PENERIMAAN
		$jumlah_wajib_lpj_penerimaan = $this->db->select('ref_history_satker.tahun')
										->select('ref_history_satker.bulan')
										->select('ref_history_satker.lpj_status_penerimaan')
										->select('count(*) as wajib_lpj_penerimaan')
										->from('ref_history_satker')
										->where('ref_history_satker.lpj_status_penerimaan', 1)
										->group_by('ref_history_satker.tahun')
										->group_by('ref_history_satker.bulan');
		
		if ( $id_ref_kanwil !== null )
		{
			$jumlah_wajib_lpj_penerimaan = $this->db->join('ref_satker', 'ref_satker.id_ref_satker = ref_history_satker.id_ref_satker', 'left')
											->join('ref_kppn', 'ref_satker.id_ref_kppn = ref_kppn.id_ref_kppn', 'left')
											->where('ref_kppn.id_ref_kanwil', $id_ref_kanwil);
		}
		
		if ( $tahun !== null ) {
			$jumlah_wajib_lpj_penerimaan = $this->db->where('ref_history_satker.tahun', $tahun);
		}
		
		$jumlah_wajib_lpj_penerimaan = $this->db->get();
										
		$jumlah_lpj_penerimaan = $this->db->distinct()
								->select('dsp_report_rekap_lpjt.tahun')
								->select('dsp_report_rekap_lpjt.bulan')
								->select('count(*) as jml_lpj_penerimaan')
								->from('dsp_report_rekap_lpjt')
								->join('ref_history_satker', 'dsp_report_rekap_lpjt.id_ref_satker = ref_history_satker.id_ref_satker AND dsp_report_rekap_lpjt.tahun = ref_history_satker.tahun AND dsp_report_rekap_lpjt.bulan = ref_history_satker.bulan', 'left')
								->where('ref_history_satker.lpj_status_penerimaan', 1)
								->where('dsp_report_rekap_lpjt.bulan <=', '12')
								->group_by('dsp_report_rekap_lpjt.tahun')
								->group_by('dsp_report_rekap_lpjt.bulan');
								
		if ( $id_ref_kanwil !== null )
		{
			$jumlah_lpj_penerimaan = $this->db->where('dsp_report_rekap_lpjt.id_ref_kanwil', $id_ref_kanwil);
		}
		
		if ( $tahun !== null ) {
			$jumlah_lpj_penerimaan = $this->db->where('dsp_report_rekap_lpjt.tahun', $tahun);
		}
		
		$jumlah_lpj_penerimaan = $this->db->get();
								
		// PENGELUARAN
		// jumlah LPJ UP
		$jumlah_bp_pengeluaran = $this->db->distinct()
								->select('dsp_report_rekap_lpjk.tahun')
								->select('dsp_report_rekap_lpjk.bulan')
								->select_sum('dsp_report_rekap_lpjk.uang_persediaan')
								->select_sum('dsp_report_rekap_lpjk.ls_bendahara')
								->select_sum('dsp_report_rekap_lpjk.pajak')
								->select_sum('dsp_report_rekap_lpjk.pengeluaran_lain')
								->select_sum('dsp_report_rekap_lpjk.saldo')
								->select_sum('dsp_report_rekap_lpjk.kuitansi')
								->from('dsp_report_rekap_lpjk')
								->join('ref_history_satker', 'dsp_report_rekap_lpjk.id_ref_satker = ref_history_satker.id_ref_satker AND dsp_report_rekap_lpjk.tahun = ref_history_satker.tahun AND dsp_report_rekap_lpjk.bulan = ref_history_satker.bulan', 'left')
								->where('ref_history_satker.lpj_status_pengeluaran', 1)
								->where('dsp_report_rekap_lpjk.tahun', $this->data['year'])
								->where('dsp_report_rekap_lpjk.bulan <=', '12')
								->group_by('dsp_report_rekap_lpjk.tahun')
								->group_by('dsp_report_rekap_lpjk.bulan')
								->get();
		/*
		// jumlah LPJ LS Bendahara
		$jumlah_pengeluaran_ls_bendahara = $this->db->distinct()
								->select('dsp_report_rekap_lpjk.tahun')
								->select('dsp_report_rekap_lpjk.bulan')
								->select_sum('dsp_report_rekap_lpjk.ls_bendahara')
								->from('dsp_report_rekap_lpjk')
								->join('ref_history_satker', 'dsp_report_rekap_lpjk.id_ref_satker = ref_history_satker.id_ref_satker AND dsp_report_rekap_lpjk.tahun = ref_history_satker.tahun AND dsp_report_rekap_lpjk.bulan = ref_history_satker.bulan', 'left')
								->where('ref_history_satker.lpj_status_pengeluaran', 1)
								->where('dsp_report_rekap_lpjk.tahun', $this->data['year'])
								->where('dsp_report_rekap_lpjk.bulan <=', '12')
								->group_by('dsp_report_rekap_lpjk.tahun')
								->group_by('dsp_report_rekap_lpjk.bulan')
								->get();
								
		// jumlah LPJ pajak
		$jumlah_pengeluaran_pajak = $this->db->distinct()
								->select('dsp_report_rekap_lpjk.tahun')
								->select('dsp_report_rekap_lpjk.bulan')
								->select_sum('dsp_report_rekap_lpjk.pajak')
								->from('dsp_report_rekap_lpjk')
								->join('ref_history_satker', 'dsp_report_rekap_lpjk.id_ref_satker = ref_history_satker.id_ref_satker AND dsp_report_rekap_lpjk.tahun = ref_history_satker.tahun AND dsp_report_rekap_lpjk.bulan = ref_history_satker.bulan', 'left')
								->where('ref_history_satker.lpj_status_pengeluaran', 1)
								->where('dsp_report_rekap_lpjk.tahun', $this->data['year'])
								->where('dsp_report_rekap_lpjk.bulan <=', '12')
								->group_by('dsp_report_rekap_lpjk.tahun')
								->group_by('dsp_report_rekap_lpjk.bulan')
								->get();
								
		// jumlah LPJ pengeluaran lain
		$jumlah_pengeluaran_lain = $this->db->distinct()
								->select('dsp_report_rekap_lpjk.tahun')
								->select('dsp_report_rekap_lpjk.bulan')
								->select_sum('dsp_report_rekap_lpjk.pengeluaran_lain')
								->from('dsp_report_rekap_lpjk')
								->join('ref_history_satker', 'dsp_report_rekap_lpjk.id_ref_satker = ref_history_satker.id_ref_satker AND dsp_report_rekap_lpjk.tahun = ref_history_satker.tahun AND dsp_report_rekap_lpjk.bulan = ref_history_satker.bulan', 'left')
								->where('ref_history_satker.lpj_status_pengeluaran', 1)
								->where('dsp_report_rekap_lpjk.tahun', $this->data['year'])
								->where('dsp_report_rekap_lpjk.bulan <=', '12')
								->group_by('dsp_report_rekap_lpjk.tahun')
								->group_by('dsp_report_rekap_lpjk.bulan')
								->get();
								
		// jumlah LPJ saldo
		$jumlah_pengeluaran_saldo = $this->db->distinct()
								->select('dsp_report_rekap_lpjk.tahun')
								->select('dsp_report_rekap_lpjk.bulan')
								->select_sum('dsp_report_rekap_lpjk.saldo')
								->from('dsp_report_rekap_lpjk')
								->join('ref_history_satker', 'dsp_report_rekap_lpjk.id_ref_satker = ref_history_satker.id_ref_satker AND dsp_report_rekap_lpjk.tahun = ref_history_satker.tahun AND dsp_report_rekap_lpjk.bulan = ref_history_satker.bulan', 'left')
								->where('ref_history_satker.lpj_status_pengeluaran', 1)
								->where('dsp_report_rekap_lpjk.tahun', $this->data['year'])
								->where('dsp_report_rekap_lpjk.bulan <=', '12')
								->group_by('dsp_report_rekap_lpjk.tahun')
								->group_by('dsp_report_rekap_lpjk.bulan')
								->get();
								
		// jumlah LPJ kuitansi
		$jumlah_pengeluaran_kuitansi = $this->db->distinct()
								->select('dsp_report_rekap_lpjk.tahun')
								->select('dsp_report_rekap_lpjk.bulan')
								->select_sum('dsp_report_rekap_lpjk.kuitansi')
								->from('dsp_report_rekap_lpjk')
								->join('ref_history_satker', 'dsp_report_rekap_lpjk.id_ref_satker = ref_history_satker.id_ref_satker AND dsp_report_rekap_lpjk.tahun = ref_history_satker.tahun AND dsp_report_rekap_lpjk.bulan = ref_history_satker.bulan', 'left')
								->where('ref_history_satker.lpj_status_pengeluaran', 1)
								->where('dsp_report_rekap_lpjk.tahun', $this->data['year'])
								->where('dsp_report_rekap_lpjk.bulan <=', '12')
								->group_by('dsp_report_rekap_lpjk.tahun')
								->group_by('dsp_report_rekap_lpjk.bulan')
								->get();
		*/
		// PENERIMAAN
		// jumlah LPJ penerimaan
		$jumlah_bp_penerimaan = $this->db->distinct()
								->select('dsp_report_rekap_lpjt.tahun')
								->select('dsp_report_rekap_lpjt.bulan')
								->select_sum('dsp_report_rekap_lpjt.kas_tunai')
								->select_sum('dsp_report_rekap_lpjt.kas_bank')
								->select_sum('dsp_report_rekap_lpjt.penerimaan')
								->select_sum('dsp_report_rekap_lpjt.penyetoran')
								->select_sum('dsp_report_rekap_lpjt.saldo_awal')
								->from('dsp_report_rekap_lpjt')
								->join('ref_history_satker', 'dsp_report_rekap_lpjt.id_ref_satker = ref_history_satker.id_ref_satker AND dsp_report_rekap_lpjt.tahun = ref_history_satker.tahun AND dsp_report_rekap_lpjt.bulan = ref_history_satker.bulan', 'left')
								->where('ref_history_satker.lpj_status_penerimaan', 1)
								->where('dsp_report_rekap_lpjt.tahun', $this->data['year'])
								->where('dsp_report_rekap_lpjt.bulan <=', '12')
								->group_by('dsp_report_rekap_lpjt.tahun')
								->group_by('dsp_report_rekap_lpjt.bulan')
								->get();
		
		return array (
			// jumlah wajib LPJ dan kiriman LPJ
			'jumlah_lpj_pengeluaran' 		=> $jumlah_lpj_pengeluaran,
			'jumlah_wajib_lpj_pengeluaran' 	=> $jumlah_wajib_lpj_pengeluaran,
			'jumlah_lpj_penerimaan'			=> $jumlah_lpj_penerimaan,
			'jumlah_wajib_lpj_penerimaan' 	=> $jumlah_wajib_lpj_penerimaan,
			// PENGELUARAN
			// jumlah LPJ UP
			'jumlah_bp_pengeluaran'			=> $jumlah_bp_pengeluaran,
			
			// existing
			// jumlah LS Bendahara
			/*
			'jumlah_pengeluaran_ls_bendahara'	=> $jumlah_pengeluaran_ls_bendahara,
			// jumlah pajak
			'jumlah_pengeluaran_pajak'		=> $jumlah_pengeluaran_pajak,
			// jumlah pengeluaran lain
			'jumlah_pengeluaran_lain'		=> $jumlah_pengeluaran_lain,
			// jumlah saldo
			'jumlah_pengeluaran_saldo'		=> $jumlah_pengeluaran_saldo,
			// jumlah kuitansi
			'jumlah_pengeluaran_kuitansi'	=> $jumlah_pengeluaran_kuitansi,
			*/
			// PENERIMAAN
			'jumlah_bp_penerimaan'	=> $jumlah_bp_penerimaan,
		);
	}

}
