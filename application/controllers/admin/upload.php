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
		// Specified compressed path and name
		$compressedpath = dirname(dirname(dirname(dirname(__FILE__)))) . '/public/data_lpj/';
	}

	public function index()
	{
		// load helper
		$this->load->helper('amountformat');
		$this->load->helper('datetime');
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

			// show the result of validation
			if ($this->uri->segment(5) !== FALSE
				&& $this->uri->segment(4) === 'K')
			{
				$kd_satker 	= $this->uri->segment(5);
				$year 		= $this->uri->segment(6);
				$month 		= $this->uri->segment(7);

				// fetch validate adk
				$data_adk = $this->m_upload->validate_adk($kppn->kd_kppn, $kd_satker, $year, $month);
				$this->data['validate_pengeluaran']						= $data_adk['validate_pengeluaran'];
				$this->data['validate_pengeluaran_1m']					= $data_adk['validate_pengeluaran_1m'];
				// fetch validate rekening
				$this->data['validate_rekening_pengeluaran_silabun']	= $data_adk['validate_rekening_pengeluaran_silabun'];
				$this->data['validate_rekening_pengeluaran_sekretariat']= $data_adk['validate_rekening_pengeluaran_sekretariat'];

			}
			else if ($this->uri->segment(5) !== FALSE
				&& $this->uri->segment(4) === 'P')
			{
				$kd_satker 	= $this->uri->segment(5);
				$year 		= $this->uri->segment(6);
				$month 		= $this->uri->segment(7);

				// fetch validate adk
				$data_adk 		 = $this->m_upload->validate_adk($kppn->kd_kppn, $kd_satker, $year, $month, null);
				$this->data['validate_penerimaan']	= $data_adk['validate_penerimaan'];
				// fetch validate rekening
				$this->data['validate_rekening_penerimaan_silabun']	= $data_adk['validate_rekening_penerimaan_silabun'];
				$this->data['validate_rekening_penerimaan_sekretariat']= $data_adk['validate_rekening_penerimaan_sekretariat'];

				// where kd_buku = 02 (BP Kas)
				$data_adk_02 = $this->m_upload->validate_adk($kppn->kd_kppn, $kd_satker, $year, $month, '02');
				$this->data['validate_penerimaan_02']	= $data_adk_02['validate_penerimaan'];

				// where kd_buku = 01 (BKU)
				$data_adk_01 = $this->m_upload->validate_adk($kppn->kd_kppn, $kd_satker, $year, $month, '01');
				$this->data['validate_penerimaan_01']	= $data_adk_01['validate_penerimaan'];

				// penerimaan 1 month ago
				$this->data['validate_penerimaan_1m'] = $data_adk['validate_penerimaan_1m'];

			}

			// fetch all upload
			 $data_uploads = $this->m_upload->get_uploaded($kppn->id_ref_kppn, $this->data['year'], $this->data['month']);
			 $this->data['pengeluaran_uploads'] = $data_uploads['query_pengeluaran'];
			 $this->data['penerimaan_uploads'] 	= $data_uploads['query_penerimaan'];
			 $this->data['pengeluaran_kirims']	= $data_uploads['query_kirim_pengeluaran'];
			 $this->data['penerimaan_kirims']	= $data_uploads['query_kirim_penerimaan'];


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

			$file_types	= 'ZIP|lpj|txt';
			// Upload section
			$config = array (
				'allowed_types'	=> '*',
				'upload_path'	=> './public/data_lpj'
			);
			//~ $config['allowed_types']	= "ZIP|lpj";
			//~ $config['upload_path'] 		= './public/data_lpj';
			//~ $config['max_size'] 		= '0';
			//~ $config['max_width'] 		= '0';
			//~ $config['max_height'] 		= '0';

			// Load the upload library
			$this->load->library('upload',$config);
			// initialize
			$this->upload->initialize($config);
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
					if(substr($data['file_name'], 0, 4) === 'LPJP'
						&& $data['file_ext'] === '.ZIP'){

						// Delete file that contains bugs
						exec("rm -r /tmp/temp");
						exec("rm -r /tmp/tmp");
						exec("rm -r /tmp/APLIKASISAS2015");
						exec("rm -r /tmp/LPJ.LPJ");
						exec("rm -r /tmp/REK_LPJ.LPJ");
						exec("rm -r /tmp/*.DBF");
						// Delete file
						exec("rm /tmp/LPJP*");
						exec("rm /tmp/T_BALPJP_REK.TXT");
						exec("rm /tmp/php*");
						// Delete file in data_lpj
						$adk_lpjs = glob($compressedpath . '*');
						foreach ($adk_lpjs as $adk_lpj)
						{
							if($data['file_name'] !== basename($adk_lpj))
							{
								unlink($adk_lpj);
							}
						}

						$pass_zip = "indahlaminatingrum";
						// execute unzip and move to tmp folder
						exec("unzip -P " . $pass_zip . " " . $compressedpath . $data['file_name'] . " -d /tmp");

						foreach (glob($movingpath . '*.TXT') as $filename)
						{
							// array newnames for hidden value
							$this->data['penerimaan_newnames'][] = $movingpath . basename($filename);
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
					else if ($data['file_ext'] === '.lpj')
					{

						// Delete file that contains bugs
						exec("rm -r /tmp/temp");
						exec("rm -r /tmp/tmp");
						exec("rm -r /tmp/APLIKASISAS2015");
						exec("rm -r /tmp/LPJ.LPJ");
						exec("rm -r /tmp/REK_LPJ.LPJ");
						exec("rm -r /tmp/*.DBF");
						// Delete file
						exec("rm /tmp/C1.*");
						exec("rm /tmp/C2.*");
						exec("rm /tmp/T_BALPJP_REK.TXT");
						exec("rm /tmp/php*");
						// Delete file in data_lpj
						$adk_lpjs = glob($compressedpath . '*');
						foreach ($adk_lpjs as $adk_lpj)
						{
							if($data['file_name'] !== basename($adk_lpj))
							{
								unlink($adk_lpj);
							}
						}

						$pass_zip = "d77f2eda617514497171d42a2c588295";
						// execute unzip and move to tmp folder
						$test = exec("unzip -P " . $pass_zip . " " . $compressedpath . $data['file_name'] . " -d /tmp");

						if(is_dir('/tmp/temp'))
						{
							$this->data['message_title'] = 'Informasi Load & Insert Data';
							$this->data['message'] = 'Format ADK LPJ Pengeluaran Anda tidak sesuai persyaratan karena terbentuk folder temp. Mohon satker membentuk ulang ADK Silabi dan ditujukan langsung flashdisk atau media lain.';
							$this->load->view('admin/components/message', $this->data);
							// redirect to index page
							$this->output->set_header('refresh:3; url=index');
						}
						else if (is_dir('/tmp/APLIKASISAS2015'))
						{
							$this->data['message_title'] = 'Informasi Load & Insert Data';
							$this->data['message'] = 'Format ADK LPJ Pengeluaran Anda tidak sesuai persyaratan karena terbentuk folder APLIKASISAS2015/temp. Mohon satker membentuk ulang ADK Silabi dan ditujukan langsung flashdisk atau media lain.';
							$this->load->view('admin/components/message', $this->data);
							// redirect to index page
							$this->output->set_header('refresh:3; url=index');
						}
						else if (file('/tmp/LPJ.LPJ')
								|| file('/tmp/REK_LPJ.LPJ'))
						{
							$this->data['message_title'] = 'Informasi Load & Insert Data';
							$this->data['message'] = 'Format ADK LPJ Pengeluaran Anda tidak sesuai persyaratan karena terbentuk dari aplikasi yang belum ter-update';
							$this->load->view('admin/components/message', $this->data);
							// redirect to index page
							$this->output->set_header('refresh:3; url=index');
						}
						else if (file('/tmp/*.DBF'))
						{
							$this->data['message_title'] = 'Informasi Load & Insert Data';
							$this->data['message'] = 'Format ADK LPJ Pengeluaran Anda tidak sesuai persyaratan karena terbentuk dari aplikasi yang belum ter-update dan masih berformat DBF';
							$this->load->view('admin/components/message', $this->data);
							// redirect to index page
							$this->output->set_header('refresh:3; url=index');
						}


						foreach (glob($movingpath . '*.LPJ') as $filename)
						{

							// array newnames for hidden value
							$this->data['pengeluaran_newnames'][] = $movingpath . basename($filename);
							$this->data['movingpaths'] = $movingpath;

							/*
							if (substr($filename,0,9) === '/tmp/temp')
							{
								if (substr($filename,0,9) === '/tmp/temp')
								{
									$this->data['message_title'] = 'Informasi Load & Insert Data';
									$this->data['message'] = 'Format ADK LPJ Penerimaan Anda tidak sesuai persyaratan karena terbentuk folder temp';
									$this->load->view('admin/components/message', $this->data);
								}
								else if (substr($filename,0,9) === '/tmp/temp')
								{

									$this->data['message_title'] = 'Informasi Load & Insert Data';
									$this->data['message'] = 'Format ADK Rekening Anda tidak sesuai persyaratan karena terbentuk folder temp';
									$this->load->view('admin/components/message', $this->data);

								}

								// delete extracted file with unsupported format
								unlink(substr($filename,0,9));

								// redirect to index page
								$this->output->set_header('refresh:2; url=index');
							}
							*/
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
					// If ADK from SAKTI
					else if((substr($data['file_name'], 0, 7) === 'silabun' || substr($data['file_name'], 0, 8) === 'rekening')
						&& $data['file_ext'] === '.txt' ){

						exec("rm -r " . $movingpath . "*.txt");
						exec("rm -r " . $movingpath . "silabun.*");
						exec("rm -r " . $movingpath . "rekening.*");

						move_uploaded_file($_FILES['upload_lpj']['tmp_name'], $movingpath . $adk_filename);

						foreach (glob($movingpath . '*.txt') as $filename)
						{
							//var_dump($filename);
							// array newnames for hidden value
							$this->data['sakti_lpj_newnames'][] = $movingpath . basename($filename);
							$this->data['movingpaths'] = $movingpath;
						}

					}
					

					// prohibited format
					else if ($data['file_ext'] !== 'lpj'
							&& $data['file_ext'] !== 'ZIP')
					{
						$this->data['message_title'] = 'Informasi Load & Insert Data';
						$this->data['message'] = "Format ADK LPJ Anda tidak diijinkan";
						$this->load->view('admin/components/message', $this->data);

						// redirect to index page
						$this->output->set_header('refresh:2; url=index');
					}

					// Delete all footprints from public/data_lpj
					if(file($compressedpath . $adk_filename))
					{
						unlink($compressedpath . $adk_filename);
					}

					// Delete file that contains bugs
					exec("rm -r /tmp/temp");
					exec("rm -r /tmp/tmp");
					exec("rm -r /tmp/APLIKASISAS2015");
					exec("rm -r /tmp/LPJ.LPJ");
					exec("rm -r /tmp/REK_LPJ.LPJ");

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

		$penerimaan_filetemps = $data['penerimaan_filetemps'];
		$pengeluaran_filetemps = $data['pengeluaran_filetemps'];
		$sakti_lpj_filetemps = $data['sakti_lpj_filetemps'];

		foreach ($pengeluaran_filetemps as $filetemp)
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
					//~ $importlpjk = $this->m_upload->import_csv($movingpath . $file, 'd_lpjk');

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
					//~ $importrefk = $this->m_upload->import_csv_rekening($movingpath . $file, 't_lpjk_refrek');

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
				else if (substr($file,-3,3) === 'LPJ'
						&& substr($file,0,2) === 'C3')
				{
					// do nothing
				}
				else if (substr($file,-3,3) === 'LPJ'
						&& substr($file,0,2) === 'C4')
				{
					// do nothing
				}


				// Delete all footprints
				if(file($movingpath . $file))
				{
					// php command to clean up all unnecessary file and folder
					unlink($movingpath . $file);
					//~ unlink($movingpath . 'T_BALPJP*');
					//~ unlink($movingpath . 'LPJP*');
					//~ unlink($movingpath . 'C1*');
					//~ unlink($movingpath . 'C2*');
					unlink($movingpath . 'temp');
					unlink($movingpath . 'APLIKASISAS2015');
					unlink($movingpath . 'LPJ.LPJ');
					unlink($movingpath . 'REK_LPJ.LPJ');
					unlink($movingpath . '*.DBF');
					// delete extracted file with unsupported format
					unlink($extractpath . '*');
					unlink($compressedpath . '*');
					// unix command
					//~ exec("rm /tmp/T_BALPJP*");
					//~ exec("rm /tmp/LPJP*");
					//~ exec("rm /tmp/C1*");
					//~ exec("rm /tmp/C2*");
					exec("rm -r /tmp/temp");
					exec("rm -r /tmp/tmp");
					exec("rm -r /tmp/APLIKASISAS2015");
				}

			}

		}

		// LPJ Penerimaan
		foreach ($penerimaan_filetemps as $filetemp)
		{
			foreach ($filetemp as $filename)
			{

				// Specified moving extracted file path
				$movingpath = realpath() . sys_get_temp_dir() . '/';
				// Get only filenames, used for unlink file from tmp :)
				$file = substr(strrchr($filename,'/'),1);

				// LPJ Penerimaan
				if (substr($file,0,1) === 'T'
					&& substr($file,0,8) !== 'T_BALPJP')
				{
					//~ $importlpjt = $this->m_upload->import_csv($movingpath . $file, 'd_lpjt');

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
					//~ $importreft = $this->m_upload->import_csv_rekening($movingpath . $file, 't_lpjp_refrek');

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
					// php command to clean up all unnecessary file and folder
					unlink($movingpath . $file);
					//~ unlink($movingpath . 'T_BALPJP*');
					//~ unlink($movingpath . 'LPJP*');
					//~ unlink($movingpath . 'C1*');
					//~ unlink($movingpath . 'C2*');
					unlink($movingpath . 'temp');
					unlink($movingpath . 'APLIKASISAS2015');
					unlink($movingpath . 'LPJ.LPJ');
					unlink($movingpath . 'REK_LPJ.LPJ');
					unlink($movingpath . '*.DBF');
					// delete extracted file with unsupported format
					unlink($extractpath . '*');
					unlink($compressedpath . '*');
					// unix command
					//~ exec("rm /tmp/T_BALPJP*");
					//~ exec("rm /tmp/LPJP*");
					//~ exec("rm /tmp/C1*");
					//~ exec("rm /tmp/C2*");
					exec("rm -r /tmp/temp");
					exec("rm -r /tmp/APLIKASISAS2015");
				}

			}
		}

		foreach ($sakti_lpj_filetemps as $filetemps) {

			foreach ($filetemps as $file) {
				// Specified moving extracted file path
				$movingpath = realpath() . sys_get_temp_dir();
				// Get only filenames, used for unlink file from tmp :)
				$files = substr(strrchr($file,'/'),1);
				unlink($movingpath . '*.txt');
				
				 if (substr($files,0,7) === 'silabun' ){
					 $importlpjk_sakti = $this->m_upload->import_csv_sakti($movingpath .'/'. $files, 'dsp_ba_lpjk');
				} else {
					$importlpjk_sakti = $this->m_upload->import_csv_sakti_rekening($movingpath .'/'. $files, 't_lpjkrek');
				}
				if($importlpjk_sakti)
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
		}
		
		// redirect to index page
		$this->output->set_header('refresh:2; url=index');

	}

	protected function remove_tmp($unlink_file = TRUE, $rm_file = TRUE)
	{

	}

}
