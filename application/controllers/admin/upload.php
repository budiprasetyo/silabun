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
			$this->data['tahun'] = date('Y');
			// get kode kppn
			$kppn = $this->m_upload->get_kppn($this->data['id_ref_satker']);
			
			// fetch all upload
			$this->data['uploads'] = $this->m_upload->get_uploaded($kppn->kd_kppn);
			
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
					
					// Load spark & Load unzip library created by phil sturgeon
					$this->load->spark('unzip/1.0.0');
					$this->load->library('unzip');
					// Extracting to specified folder
					$this->unzip->extract($filepath, $extractpath);
					
					
					foreach (glob($extractpath . '*.*') as $filename) 
					{
						$oldname = $extractpath . basename($filename);
						$newname = $movingpath . basename(substr(strrchr($filename,'\\'),1));
						// array newnames for hidden value
						$this->data['newnames'][] = $movingpath . basename(substr(strrchr($filename,'\\'),1));
						// rename function should be included path
						rename($oldname, $newname);
						// load library from CSVReader by Pierre-Jean Turpeau
						$this->load->library('csvreader');
						$this->data['csvdatas'] = $this->csvreader;
						$this->data['movingpaths'] = $movingpath;
					}
					
					// Delete all footprints
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
					$importrefk = $this->m_upload->import_csv($movingpath . $file, 't_lpjk_refrek');
					
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
				else 
				{
					echo 'lainnya';
				}
				
				// Delete all footprints
				if(file($movingpath . $file))
				{
					unlink($movingpath . $file);
				}
			}
			
		}
		
		// redirect to index page
		$this->output->set_header('refresh:3; url=index');
		
	}
	
	public function delete($id)
	{
		$this->m_page->delete($id);
		redirect('admin/page');
	}
}
