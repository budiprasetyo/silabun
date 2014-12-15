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

	public function get_pkn_rekap()
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
							->join('ref_satker', 'ref_satker.id_ref_satker = dsp_report_rekap_lpjk.id_ref_satker', 'left')
							->where('ref_satker.lpj_status_pengeluaran', 1)
							->group_by('dsp_report_rekap_lpjk.tahun')
							->group_by('dsp_report_rekap_lpjk.bulan')
							->group_by('dsp_report_rekap_lpjk.id_ref_kanwil')
							->group_by('dsp_report_rekap_lpjk.kd_kanwil')
							->group_by('dsp_report_rekap_lpjk.nm_kanwil')
							->order_by('dsp_report_rekap_lpjk.tahun')
							->order_by('dsp_report_rekap_lpjk.bulan')
							->order_by('dsp_report_rekap_lpjk.kd_kanwil')
							->get();
							
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
							->join('ref_satker', 'ref_satker.id_ref_satker = dsp_report_rekap_lpjt.id_ref_satker', 'left')
							->where('ref_satker.lpj_status_penerimaan', 1)
							->group_by('dsp_report_rekap_lpjt.tahun')
							->group_by('dsp_report_rekap_lpjt.bulan')
							->group_by('dsp_report_rekap_lpjt.id_ref_kanwil')
							->group_by('dsp_report_rekap_lpjt.kd_kanwil')
							->group_by('dsp_report_rekap_lpjt.nm_kanwil')
							->order_by('dsp_report_rekap_lpjt.tahun')
							->order_by('dsp_report_rekap_lpjt.bulan')
							->order_by('dsp_report_rekap_lpjt.kd_kanwil')
							->get();
		
							
		
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

	public function get_kppn_rekap($id_ref_kppn)
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
							->join('ref_satker', 'ref_satker.id_ref_satker = dsp_report_rekap_lpjk.id_ref_satker', 'left')
							->where('ref_satker.lpj_status_pengeluaran', 1)
							->where('dsp_report_rekap_lpjk.id_ref_kppn', $id_ref_kppn)
							->group_by('dsp_report_rekap_lpjk.tahun')
							->group_by('dsp_report_rekap_lpjk.bulan')
							->get();
							
		$rekap_penerimaan = $this->db->select('dsp_report_rekap_lpjt.tahun')
							->select('dsp_report_rekap_lpjt.bulan')
							->select('count(*) AS jml_lpj')
							->select_sum('dsp_report_rekap_lpjt.kas_tunai')
							->select_sum('dsp_report_rekap_lpjt.kas_bank')
							->select_sum('dsp_report_rekap_lpjt.saldo_awal')
							->select_sum('dsp_report_rekap_lpjt.penerimaan')
							->select_sum('dsp_report_rekap_lpjt.penyetoran')
							->from('dsp_report_rekap_lpjt')
							->join('ref_satker', 'ref_satker.id_ref_satker = dsp_report_rekap_lpjt.id_ref_satker', 'left')
							->where('ref_satker.lpj_status_penerimaan', 1)
							->where('dsp_report_rekap_lpjt.id_ref_kppn', $id_ref_kppn)
							->group_by('dsp_report_rekap_lpjt.tahun')
							->group_by('dsp_report_rekap_lpjt.bulan')
							->get();
		
							
		
			return array(
				'rekap_pengeluaran' => $rekap_pengeluaran,
				'rekap_penerimaan' => $rekap_penerimaan
			);
	}

}
