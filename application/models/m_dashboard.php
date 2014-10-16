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

	public function get_kanwil_rekap()
	{
		$query = $this->db->select('dsp_report_rekap_lpjk.tahun')
							->select('dsp_report_rekap_lpjk.bulan')
							->select('ref_kppn.id_ref_kanwil')
							->select('ref_kanwil.kd_kanwil')
							->select('ref_kanwil.nm_kanwil')
							->select('count(*) AS jml_lpj')
							->select_sum('dsp_report_rekap_lpjk.uang_persediaan')
							->select_sum('dsp_report_rekap_lpjk.ls_bendahara')
							->select_sum('dsp_report_rekap_lpjk.pajak')
							->select_sum('dsp_report_rekap_lpjk.pengeluaran_lain')
							->select_sum('dsp_report_rekap_lpjk.saldo')
							->select_sum('dsp_report_rekap_lpjk.kuitansi')
							->from('ref_kppn')
							->join('dsp_report_rekap_lpjk', 'dsp_report_rekap_lpjk.id_ref_kppn = ref_kppn.id_ref_kppn', 'left')
							->join('ref_kanwil', 'ref_kanwil.id_ref_kanwil = ref_kppn.id_ref_kanwil', 'left')
							->join('ref_satker', 'ref_satker.id_ref_satker = dsp_report_rekap_lpjk.id_ref_satker', 'left')
							->group_by('dsp_report_rekap_lpjk.tahun')
							->group_by('dsp_report_rekap_lpjk.bulan')
							->group_by('ref_kppn.id_ref_kanwil')
							->group_by('ref_kanwil.kd_kanwil')
							->group_by('ref_kanwil.nm_kanwil')
							->get();
							
		if ($query->num_rows > 0) 
		{
			return $query;
			$query->free_result();
		}
	}

}
