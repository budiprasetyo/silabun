<?php
/*
 * upload.php
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


class Upload extends Admin_Controller
{

	/**
	 * Constructor of class Upload.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_upload');
	}

	public function index()
	{
		// if entity is kppn
		if($this->data['id_entities'] === '1')
		{
			// get id_ref_kppn
			$this->load->model('m_referensi');
			$kppn = $this->m_referensi->get_kppn($this->data['id_ref_satker']);
			
			// get year
			$this->data['year'] = $this->input->post('year') == TRUE ? $this->input->post('year') : date('Y');
			// get month
			$this->data['month'] = $this->input->post('month') == TRUE ? $this->input->post('month') : date('m');
			
			var_dump($kppn->kd_kppn);
			
			// fetch all upload
			 $data_uploads = $this->m_upload->get_uploaded($kppn->id_ref_kppn, $this->data['year'], $this->data['month']);
			 $this->data['pengeluaran_uploads'] = $data_uploads['query_pengeluaran'];
			 $this->data['penerimaan_uploads'] = $data_uploads['query_penerimaan'];
			
			// get sent and unsent pos kirim = K
			$status_data_k = $this->m_upload->get_status_sent_satker($kppn->id_ref_kppn, $this->data['year'], $this->data['month']);
			$this->data['data_sent_k'] = $status_data_k['query_pengeluaran_sent'];
			$this->data['data_unsent_k'] = $status_data_k['query_pengeluaran_unsent'];
			
			// get sent and unsent pos kirim = P
			$status_data_p = $this->m_upload->get_status_sent_satker($kppn->id_ref_kppn, $this->data['year'], $this->data['month']);
			$this->data['data_sent_p'] = $status_data_p['query_penerimaan_sent'];
			$this->data['data_unsent_p'] = $status_data_p['query_penerimaan_unsent'];
			
			// path to page folder view
			$this->data['subview'] = 'admin/upload/index';
			$this->load->view('admin/template/_layout_admin', $this->data);
		}
		
	}
	
	public function edit($id = NULL)
	{
		
		$back_link = $this->uri->segment(2);
		// check existing upload or create one
		if ($id) {
			$this->data['id']			= $id;
			$this->data['upload'] 		= $this->m_upload->get($id);
			$this->data['back_link'] 	= $back_link;
			count($this->data['upload']) || $this->data['errors'][] = 'upload could not be found';
			$this->data['dropdown'] 	= $this->m_upload;
		}
		else {
			$this->data['id']			= null;
			$this->data['upload'] 		= $this->m_upload->get_new();
			$this->data['back_link'] 	= $back_link;
			$this->data['dropdown'] 	= $this->m_upload;
			$this->data['message']		= 'nothing to see here';
		}
		
		$id == NULL || $this->data['upload'] = $this->m_upload->get($id);
		
		// rules section
		$rules = $this->m_upload->rules;
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() == TRUE ) {
			// populate fields
			$data = $this->m_upload->array_from_post(array('upload'));
			// save data
			$this->m_upload->save($data, $id);
			// redirect to upload
			redirect('admin/upload');
		}
		// path to upload folder view
		$this->data['subview'] = 'admin/upload/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
		
	}
	
	/**
	 * Sent 
	 * @brief		extract all compressed ADK to certain folder and final destination
	 * 				extracted files is in /tmp folder
	 * @returns 	extracted file
	 * 
	 * 
	 */
	public function sent()
	{
		if($this->input->post('submit') === 'Upload');
		{
				
			$file_types	= '*';
			// Upload section
			$config['upload_path'] 		= './public/data_lpj';
			$config['max_size'] 		= '0';
			$config['max_width'] 		= '0';
			$config['max_height'] 		= '0';

			// Load the upload library
			$this->load->library('upload',$config);
			// initialize
			$this->upload->initialize($config);
			// set file types
			$this->upload->set_allowed_types($file_types);
			
			// Handle the file upload from the name of input type is 'upload_lpj'
			if( ! $this->upload->do_upload('upload_lpj') )
			{
				$this->upload->display_errors('<p>', '</p>');
			}
			else
			{
				
				// extension length should be 3, then this validation should be added with kode kppn as extension
				// after user management modul is finished
				if(strlen(substr(strrchr($_FILES['upload_lpj']['name'],'.'),1)) === 3)
				{
					$adk_filename = $_FILES['upload_lpj']['name'];
					 
					// Specified upload path and name
					$filepath = $config['upload_path'] . '/' . $adk_filename;
					// Specified compressed path and name
					$compressedpath = dirname(dirname(dirname(dirname(__FILE__)))) . '/public/data_lpj/';
					// Specified extracting path and name
					$extractpath = dirname(dirname(dirname(dirname(__FILE__)))) . '/public/extract_lpj/';
					// Specified moving extracted file path
					$movingpath = realpath() . sys_get_temp_dir() . '/';
					
					// Upload the file
					$data = $this->upload->data();
					
					// load library from CSVReader by Pierre-Jean Turpeau
					$this->load->library('csvreader');
					$this->data['csvdatas'] = $this->csvreader;
					
					// If ADK from silabi penerimaan
					if(substr($data['file_name'], 0, 4) === 'LPJP'){
						
						$pass_zip = "indahlaminatingrum";
						// execute unzip and move to tmp folder
						exec("unzip -P indahlaminatingrum "  . $compressedpath . $data['file_name'] . " -d /tmp");
						
						foreach (glob($movingpath . '*.TXT') as $filename) 
						{
							// array newnames for hidden value
							$this->data['newnames'][] = $movingpath . basename($filename);
							$this->data['movingpaths'] = $movingpath;

							if (substr($filename,0,9) === '/tmp/temp') 
							{
								if (substr($filename,0,14) === '/tmp/temp\LPJP')
								{
									$this->data['message_title'] = 'Informasi Load & Insert Data';
									$this->data['message'] = 'Format ADK LPJ Penerimaan Anda Salah';
									$this->load->view('admin/components/message', $this->data);
								}
								else if (substr($filename,0,18) === '/tmp/temp\T_BALPJP')
								{
									
									$this->data['message_title'] = 'Informasi Load & Insert Data';
									$this->data['message'] = 'Format ADK Rekening Anda Salah';
									$this->load->view('admin/components/message', $this->data);
									
								}
								
								// delete extracted file with unsupported format
								unlink(substr($filename,0,9));
								
								// redirect to index page
								$this->output->set_header('refresh:2; url=index');
							}	
						}
					}
					// If ADK from silabi pengeluaran
					else if (substr($data['file_name'], -3, 3) === 'lpj')
					{
						$pass_zip = "d77f2eda617514497171d42a2c588295";
						// execute unzip and move to tmp folder
						exec("unzip -P " . $pass_zip . " " . $compressedpath . $data['file_name'] . " -d /tmp");
						
						foreach (glob($movingpath . '*.LPJ') as $filename) 
						{
							// array newnames for hidden value
							$this->data['newnames'][] = $movingpath . basename($filename);
							$this->data['movingpaths'] = $movingpath;
							
							if (substr($filename,0,9) === '/tmp/temp') 
							{
								if (substr($filename,0,14) === '/tmp/temp\LPJP')
								{
									$this->data['message_title'] = 'Informasi Load & Insert Data';
									$this->data['message'] = 'Format ADK LPJ Penerimaan Anda Salah';
									$this->load->view('admin/components/message', $this->data);
								}
								else if (substr($filename,0,18) === '/tmp/temp\T_BALPJP')
								{
									
									$this->data['message_title'] = 'Informasi Load & Insert Data';
									$this->data['message'] = 'Format ADK Rekening Anda Salah';
									$this->load->view('admin/components/message', $this->data);
									
								}
								
								// delete extracted file with unsupported format
								unlink(substr($filename,0,9));
								
								// redirect to index page
								$this->output->set_header('refresh:2; url=index');
							}	
						}
						
					}
					// If ADK from silabun desktop
					else if (substr($data['file_name'], 0, 1) === 'T'
						OR substr($data['file_name'], 0, 1) === 'K'){
							
						// Load spark & Load unzip library created by phil sturgeon
						$this->load->spark('unzip/1.0.0');
						$this->load->library('unzip');
						// Extracting to specified folder
						$this->unzip->extract($filepath, $extractpath);
							
						foreach (glob($extractpath . '*.*') as $filename) 
						{
							$oldname = $extractpath . basename($filename);
							$newname = $movingpath . basename($filename);
							//~ $newname = $movingpath . basename(substr(strrchr($filename,'\\'),1)); -- old setting before tamp1 was removed
						
							// array newnames for hidden value
							$this->data['newnames'][] = $movingpath . basename($filename);

							// rename function should be included path
							rename($oldname, $newname);
							$this->data['movingpaths'] = $movingpath;
							
							if (substr($newname,0,9) === '/tmp/temp') 
							{
								if (substr($newname,0,11) === '/tmp/temp\K')
								{
									$this->data['message_title'] = 'Informasi Load & Insert Data';
									$this->data['message'] = 'Format ADK LPJ Pengeluaran Anda Salah';
									$this->load->view('admin/components/message', $this->data);
								
								}
								else if (substr($newname,0,11) === '/tmp/temp\T')
								{
									$this->data['message_title'] = 'Informasi Load & Insert Data';
									$this->data['message'] = 'Format ADK LPJ Penerimaan Anda Salah';
									$this->load->view('admin/components/message', $this->data);
								}
								else if (substr($newname,0,11) === '/tmp/temp\R')
								{
									
									$this->data['message_title'] = 'Informasi Load & Insert Data';
									$this->data['message'] = 'Format ADK Rekening Anda Salah';
									$this->load->view('admin/components/message', $this->data);
									
								}
								
								// delete extracted file with unsupported format
								unlink($extractpath . '*.*');
								
								// redirect to index page
								$this->output->set_header('refresh:2; url=index');
							}	
						}
						
					}
					
					
					// Delete all footprints from public/data_lpj
					if(file($compressedpath . $adk_filename))
					{
						unlink($compressedpath . $adk_filename);
					}
					
				}
				
			}
		}
		// path to upload folder view
		$this->data['subview'] = 'admin/upload/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function approve()
	{
		$data = $this->input->post();
				
		$filetemps = $data['filetemps'];
		
		foreach ($filetemps as $filetemp) 
		{
			foreach ($filetemp as $filename) 
			{
				
				// Specified moving extracted file path
				$movingpath = realpath() . sys_get_temp_dir() . '/';
				// Get only filenames, used for unlink file from tmp :)
				$file = substr(strrchr($filename,'/'),1);
				
				
				// Define type of file, K for pengeluaran and P for penerimaan
				// LPJ Pengeluaran
				if (substr($file,0,1) === 'K') 
				{
					$importlpjk = $this->m_upload->import_csv($movingpath . $file, 'd_lpjk');
					if($importlpjk) 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data pengeluaran LPJ berhasil';
						$this->load->view('admin/components/message', $this->data);
					}
					else 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data pengeluaran LPJ gagal';
						$this->load->view('admin/components/message', $this->data);
					}
				}
				else if (substr($file,0,5) === 'REF_K') 
				{
					$importrefk = $this->m_upload->import_csv_rekening($movingpath . $file, 't_lpjk_refrek');
					
					if($importrefk) 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data referensi bank berhasil';
						$this->load->view('admin/components/message', $this->data);
					}
					else 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data referensi bank gagal';
						$this->load->view('admin/components/message', $this->data);
					}
				}
				else if (substr($file,-3,3) === 'LPJ'
						&& substr($file,0,2) === 'C1')
				{
					$importlpjk = $this->m_upload->import_csv_lpjk($movingpath . $file, 'dsp_ba_lpjk');
					
					if($importlpjk) 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data LPJ Pengeluaran berhasil';
						$this->load->view('admin/components/message', $this->data);
					}
					else 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data LPJ Pengeluaran gagal';
						$this->load->view('admin/components/message', $this->data);
					}
				}
				else if (substr($file,-3,3) === 'LPJ'
						&& substr($file,0,2) === 'C2')
				{
					
					$importreklpjk = $this->m_upload->import_csv_rekening_lpjk($movingpath . $file, 't_lpjkrek');
					
					if($importreklpjk) 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data Rekening LPJ Pengeluaran berhasil';
						$this->load->view('admin/components/message', $this->data);
					}
					else 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data Rekening LPJ Pengeluaran gagal';
						$this->load->view('admin/components/message', $this->data);
					}
					
				}
				
				// LPJ Penerimaan
				if (substr($file,0,1) === 'T'
					&& substr($file,0,8) !== 'T_BALPJP')
				{
					$importlpjt = $this->m_upload->import_csv($movingpath . $file, 'd_lpjt');
					
					if($importlpjt) 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data pengeluaran LPJ berhasil';
						$this->load->view('admin/components/message', $this->data);
					}
					else 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data pengeluaran LPJ gagal';
						$this->load->view('admin/components/message', $this->data);
					}
					
				}
				else if (substr($file,0,5) === 'REF_T')
				{
					$importreft = $this->m_upload->import_csv_rekening($movingpath . $file, 't_lpjp_refrek');
				
					if($importreft) 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data referensi bank berhasil';
						$this->load->view('admin/components/message', $this->data);
					}
					else 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data referensi bank gagal';
						$this->load->view('admin/components/message', $this->data);
					}
					
				}
				else if (substr($file,0,4) === 'LPJP')
				{
					$importlpjp = $this->m_upload->import_csv_lpjp($movingpath . $file, 'dsp_ba_lpjp');
					
					if($importlpjp) 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data LPJ Penerimaan berhasil';
						$this->load->view('admin/components/message', $this->data);
					}
					else 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data LPJ Penerimaan gagal';
						$this->load->view('admin/components/message', $this->data);
					}
				}
				else if (substr($file,0,8) === 'T_BALPJP')
				{
					$importreklpjp = $this->m_upload->import_csv_rekening_lpjp($movingpath . $file, 't_lpjprek');
					
					if($importreklpjp) 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data Rekening LPJ Penerimaan berhasil';
						$this->load->view('admin/components/message', $this->data);
					}
					else 
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = 'load dan insert data Rekening LPJ Penerimaan gagal';
						$this->load->view('admin/components/message', $this->data);
					}
				}
				
				
				// Delete all footprints
				if(file($movingpath . $file))
				{
					unlink($movingpath . $file);
					// delete extracted file with unsupported format
					unlink($extractpath . '*');
				}
				
			}
			
		}
		
		// redirect to index page
		$this->output->set_header('refresh:2; url=index');
		
	}
	
	
	
}
