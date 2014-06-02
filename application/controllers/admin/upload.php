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
		// fetch all upload
		//~ $this->data['upload'] = $this->m_upload->get();
		
		// path to page folder view
		$this->data['subview'] = 'admin/upload/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function edit($id = NULL)
	{
		
		$back_link = $this->uri->segment(2);
		// check existing upload or create one
		if ($id) {
			$this->data['id']			= $id;
			$this->data['upload'] 	= $this->m_upload->get($id);
			$this->data['back_link'] 	= $back_link;
			count($this->data['upload']) || $this->data['errors'][] = 'upload could not be found';
			$this->data['dropdown'] 	= $this->m_upload;
		}
		else {
			$this->data['id']			= null;
			$this->data['upload'] 		= $this->m_upload->get_new();
			$this->data['back_link'] 	= $back_link;
			$this->data['dropdown'] 	= $this->m_upload;
		}
		
		$id == NULL || $this->data['upload'] = $this->m_upload->get($id);
		
		// rules section
		$rules = $this->m_upload->rules;
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() == TRUE ) {
			// populate fields
			$data = $this->m_upload->array_from_post(array('upload','description','page_type_id','language_id','status_code'));
			// save data
			$this->m_upload->save($data, $id);
			// redirect to upload
			redirect('admin/upload');
		}
		// path to upload folder view
		$this->data['subview'] = 'admin/upload/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
		
	}
	
	public function delete($id)
	{
		$this->m_page->delete($id);
		redirect('admin/page');
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
					// Specified upload path and name
					$filepath = $config['upload_path'] . '/' . $_FILES['upload_lpj']['name'];
					// Specified extracting path and name
					$extractpath = dirname(dirname(dirname(dirname(__FILE__)))) . '/public/extract_lpj/';
					
					// Upload the file
					$data = $this->upload->data();
					
					// Load spark & Load unzip library created by phil sturgeon
					$this->load->spark('unzip/1.0.0');
					$this->load->library('unzip');
					// Extracting to specified folder
					$this->unzip->extract($filepath, $extractpath);
					
					$this->data['extractpaths'] = $extractpath;
					//~ foreach (glob($extractpath . '*.*') as $filename) 
					//~ {
						//~ 
						//~ $this->data['lines'] = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
						
						//~ foreach ($lines as $line_num => $line) {
							//~ echo "Line #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
						//~ }
						
						//~ readfile($filename) . '<br />';
						
						//~ $oldname = basename($filename);
						//~ $newname = basename(substr(strrchr($filename,'\\'),1));
						//~ rename($oldname, $newname);
					//~ }
					
					// Delete all footprints, consider to use this or not
					unlink($filepath);
				}
			}

		}
		// path to upload folder view
		$this->data['subview'] = 'admin/upload/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
}
