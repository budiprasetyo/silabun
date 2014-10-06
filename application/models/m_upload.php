<?php


/*
 * m_upload.php
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


class M_upload extends MY_Model
{

	protected $_table_name 		= 'dsp_status_kirim_pengeluaran';
	protected $_primary_key 	= 'id_status_kirim_pengeluaran';
	protected $_order_by 		= 'id_status_kirim_pengeluaran';
	public $rules				= array(
					'upload'	=> array(
						'field'	=> 'upload_lpj',
						'label'	=> 'Upload Data',
						'rules'	=> 'trim|required|max_length[11]'
					)
	);
	
	// define must be paired with rules
	public function get_new()
	{
		// define and instantiate
		$upload = new stdClass();
		
		$upload->upload_lpj		= '';
		return $upload;
	}
	
	
	public function get_uploaded($id_ref_kppn, $year, $month)
	{
		$query_pengeluaran = $this->db->select('ref_satker.id_ref_unit')
						  ->select('ref_satker.kd_satker')
						  ->select('ref_satker.no_karwas')
						  ->select('dsp_status_kirim_pengeluaran.id_status_kirim_pengeluaran')
						  ->select('dsp_status_kirim_pengeluaran.tahun')
						  ->select('dsp_status_kirim_pengeluaran.bulan')
						  ->select('dsp_status_kirim_pengeluaran.timestamp')
						  ->select('dsp_status_kirim_pengeluaran.pos_kirim')
						  ->from('ref_satker')
						  ->join('dsp_status_kirim_pengeluaran', 'ref_satker.id_ref_satker = dsp_status_kirim_pengeluaran.id_ref_satker', 'left')
						  ->where('ref_satker.id_ref_kppn', $id_ref_kppn)
						  ->where('dsp_status_kirim_pengeluaran.tahun', $year)
						  ->where('dsp_status_kirim_pengeluaran.bulan', $month)
						  ->where('ref_satker.lpj_status', 1)
						  ->order_by('dsp_status_kirim_pengeluaran.id_ref_satker')
						  ->order_by('dsp_status_kirim_pengeluaran.pos_kirim')
						  ->get();
	
		$query_penerimaan = $this->db->select('ref_satker.id_ref_unit')
						  ->select('ref_satker.kd_satker')
						  ->select('ref_satker.no_karwas')
						  ->select('dsp_status_kirim_penerimaan.id_status_kirim_penerimaan')
						  ->select('dsp_status_kirim_penerimaan.tahun')
						  ->select('dsp_status_kirim_penerimaan.bulan')
						  ->select('dsp_status_kirim_penerimaan.timestamp')
						  ->select('dsp_status_kirim_penerimaan.pos_kirim')
						  ->from('ref_satker')
						  ->join('dsp_status_kirim_penerimaan', 'ref_satker.id_ref_satker = dsp_status_kirim_penerimaan.id_ref_satker', 'left')
						  ->where('ref_satker.id_ref_kppn', $id_ref_kppn)
						  ->where('dsp_status_kirim_penerimaan.tahun', $year)
						  ->where('dsp_status_kirim_penerimaan.bulan', $month)
						  ->where('ref_satker.lpj_status', 1)
						  ->order_by('dsp_status_kirim_penerimaan.id_ref_satker')
						  ->order_by('dsp_status_kirim_penerimaan.pos_kirim')
						  ->get();
		
		return array(
			'query_pengeluaran'	=> $query_pengeluaran,
			'query_penerimaan'	=> $query_penerimaan
		);
		
		$query_pengeluaran->free_result();
		
	}
	
	public function import_csv($path, $tables)
	{
		
		$query = $this->db->query("LOAD DATA INFILE ? REPLACE INTO TABLE ".$tables." FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\n'", array($path));
		
		return $query;
	}
	
	public function import_csv_rekening($path, $tables)
	{
		
		
		$query = $this->db->query("LOAD DATA INFILE ? REPLACE INTO TABLE ".$tables." FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\\r\\n' 
		(id_dsp, kdsatker, nokarwas, kdrek, norek, nmrek, nmbank, nosrt, @tglsrt, saldo, kdbpp, kdkppn)
		SET tgsrt = STR_TO_DATE(@tglsrt, '%d-%m-%Y')", array($path));
		
		return $query;
	}
	
	public function get_status_sent_satker($id_ref_kppn, $year, $month)
	{
		$query_pengeluaran_unsent = $this->db->query("SELECT `dsp_status_kirim_pengeluaran`.`tahun`,
					`dsp_status_kirim_pengeluaran`.`bulan`,`dsp_status_kirim_pengeluaran`.`pos_kirim`,
					 count(*) as jml_lpj
				FROM `ref_satker`
				LEFT JOIN `dsp_status_kirim_pengeluaran` 
				ON `ref_satker`.`id_ref_satker` = `dsp_status_kirim_pengeluaran`.`id_ref_satker` 
				WHERE `ref_satker`.`id_ref_kppn` = ".$id_ref_kppn."
				AND `dsp_status_kirim_pengeluaran`.`tahun` is null
				AND `dsp_status_kirim_pengeluaran`.`bulan` is null
				AND `dsp_status_kirim_pengeluaran`.`pos_kirim` is null
				AND `ref_satker`.`lpj_status` = 1
				GROUP BY  `dsp_status_kirim_pengeluaran`.`tahun`,
					`dsp_status_kirim_pengeluaran`.`bulan`");
					
		$query_pengeluaran_sent = $this->db->query("SELECT `dsp_status_kirim_pengeluaran`.`tahun`,
					`dsp_status_kirim_pengeluaran`.`bulan`, count(*) as jml_lpj
				FROM `ref_satker`
				LEFT JOIN `dsp_status_kirim_pengeluaran` 
				ON `ref_satker`.`id_ref_satker` = `dsp_status_kirim_pengeluaran`.`id_ref_satker` 
				WHERE `ref_satker`.`id_ref_kppn` = ".$id_ref_kppn."
				AND `dsp_status_kirim_pengeluaran`.`tahun` = '".$year."'
				AND `dsp_status_kirim_pengeluaran`.`bulan` = '".$month."'
				AND `dsp_status_kirim_pengeluaran`.`pos_kirim` = 'K'
				AND `ref_satker`.`lpj_status` = 1
				GROUP BY  `dsp_status_kirim_pengeluaran`.`tahun`,
					`dsp_status_kirim_pengeluaran`.`bulan`");
		
		$query_pengeluaran_unsent->num_rows > 0 ? $query_pengeluaran_unsent_row = $query_pengeluaran_unsent->row() : $query_pengeluaran_unsent_row = 0;
		$query_pengeluaran_sent->num_rows > 0 ? $query_pengeluaran_sent_row = $query_pengeluaran_sent->row() : $query_pengeluaran_sent_row = 0;
		
		$query_penerimaan_unsent = $this->db->query("SELECT `dsp_status_kirim_penerimaan`.`tahun`,
					`dsp_status_kirim_penerimaan`.`bulan`,`dsp_status_kirim_penerimaan`.`pos_kirim`,
					 count(*) as jml_lpj
				FROM `ref_satker`
				LEFT JOIN `dsp_status_kirim_penerimaan` 
				ON `ref_satker`.`id_ref_satker` = `dsp_status_kirim_penerimaan`.`id_ref_satker` 
				WHERE `ref_satker`.`id_ref_kppn` = ".$id_ref_kppn."
				AND `dsp_status_kirim_penerimaan`.`tahun` is null
				AND `dsp_status_kirim_penerimaan`.`bulan` is null
				AND `dsp_status_kirim_penerimaan`.`pos_kirim` is null
				AND `ref_satker`.`lpj_status` = 1
				GROUP BY  `dsp_status_kirim_penerimaan`.`tahun`,
					`dsp_status_kirim_penerimaan`.`bulan`");
					
		$query_penerimaan_sent = $this->db->query("SELECT `dsp_status_kirim_penerimaan`.`tahun`,
					`dsp_status_kirim_penerimaan`.`bulan`, count(*) as jml_lpj
				FROM `ref_satker`
				LEFT JOIN `dsp_status_kirim_penerimaan` 
				ON `ref_satker`.`id_ref_satker` = `dsp_status_kirim_penerimaan`.`id_ref_satker` 
				WHERE `ref_satker`.`id_ref_kppn` = ".$id_ref_kppn."
				AND `dsp_status_kirim_penerimaan`.`tahun` = '".$year."'
				AND `dsp_status_kirim_penerimaan`.`bulan` = '".$month."'
				AND `dsp_status_kirim_penerimaan`.`pos_kirim` = 'P'
				AND `ref_satker`.`lpj_status` = 1
				GROUP BY  `dsp_status_kirim_penerimaan`.`tahun`,
					`dsp_status_kirim_penerimaan`.`bulan`");
					
		$query_penerimaan_unsent->num_rows > 0 ? $query_penerimaan_unsent_row = $query_penerimaan_unsent->row() : $query_penerimaan_unsent_row = 0;
		$query_penerimaan_sent->num_rows > 0 ? $query_penerimaan_sent_row = $query_penerimaan_sent->row() : $query_penerimaan_sent_row = 0;
		
		return array(
			'query_pengeluaran_unsent' => $query_pengeluaran_unsent_row,
			'query_pengeluaran_sent' => $query_pengeluaran_sent_row,
			'query_penerimaan_unsent' => $query_penerimaan_unsent_row,
			'query_penerimaan_sent' => $query_penerimaan_sent_row,
		);
		
	}
}
