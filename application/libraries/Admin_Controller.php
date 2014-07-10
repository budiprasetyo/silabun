<?php
/*
 * Admin_Controller.php
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


class Admin_Controller extends MY_Controller
{

	/**
	 * Constructor of class Admin_Controller.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->data['meta_title'] = "Direktorat Sistem Perbendaharaan";
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('m_user');
		
		// login check
		$exception_uris = array(
				'admin/user/login',
				'admin/user/logout'
		);
		
		// user logged in
		$this->data['id_users'] 		= $this->session->userdata('id_users');
		$this->data['id_ref_satker'] 	= $this->session->userdata('id_ref_satker');
		$this->data['id_entities'] 		= $this->session->userdata('id_entities');
		$this->data['username'] 		= $this->session->userdata('username');
		$this->data['display_name'] 	= $this->session->userdata('display_name');
		
		if(in_array(uri_string(), $exception_uris) == FALSE)
		{
			if ($this->m_user->loggedin() == FALSE) 
			{
				redirect('admin/user/login');
			}
		}
		
		//CKEditor section
		// load ckeditor helper
		/*
		$this->load->helper('ckeditor');
 
 
		//Ckeditor's configuration
		$this->data['ckeditor'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'assets/js/ckeditor',
 
			//Optionnal values
			'config' => array(
				'toolbar' 	=> 	"Full", 	//Using the Full toolbar
				'width' 	=> 	"650px",	//Setting a custom width
				'height' 	=> 	'100px',	//Setting a custom height
 
			),
 
			//Replacing styles from the "Styles tool"
			'styles' => array(
 
				//Creating a new style named "style 1"
				'style 1' => array (
					'name' 		=> 	'Blue Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 	=> 	'Blue',
						'font-weight' 	=> 	'bold'
					)
				),
 
				//Creating a new style named "style 2"
				'style 2' => array (
					'name' 	=> 	'Red Title',
					'element' 	=> 	'h2',
					'styles' => array(
						'color' 		=> 	'Red',
						'font-weight' 		=> 	'bold',
						'text-decoration'	=> 	'underline'
					)
				)				
			)
		);
		*/
		
	}

}
