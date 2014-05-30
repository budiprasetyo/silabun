<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * company.php
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

class Company extends Frontend_Controller {

	/**
	 * Constructor of class Company
	 *
	 * @return void
	 */
	public function __construct()
	{
		// constructor
		parent::__construct();
		// load m_company model
		$this->load->model('m_company');
	}
	
	/**
	 * Index Page for this controller.
	 * For safety reason I redirect index page to home page
	 * So, I don't use index page ;-) 
	 * 
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		redirect('company/home/', 'refresh');
	}
	
	
	/**
	 * @brief home page
	 * 	accessed for first time
	 * @access	public
	 * @returns none
	 * 
	 * 
	 */
	public function home()
	{
		$pages = $this->m_company->get();
		
		$this->data['header'] = 'admin/components/top_home';
		$this->data['main_content'] = 'company/home';
		$this->data['footer'] = 'admin/components/bottom';
		$this->load->view('admin/template/_layout_main', $this->data);
	}
	
	public function about()
	{
		$this->data['header'] = 'admin/components/top_mod';
		$this->data['main_content'] = 'company/about';
		$this->data['footer'] = 'admin/components/bottom';
		$this->load->view('admin/template/_layout_main', $this->data);
	}
	
	public function products()
	{
		$this->data['header'] = 'admin/components/top_mod';
		$this->data['main_content'] = 'company/products';
		$this->data['footer'] = 'admin/components/bottom';
		$this->load->view('admin/template/_layout_main', $this->data);
	}
	
	public function services()
	{
		$this->data['header'] = 'admin/components/top_mod';
		$this->data['main_content'] = 'company/services';
		$this->data['footer'] = 'admin/components/bottom';
		$this->load->view('admin/template/_layout_main', $this->data);
	}
	
	public function save()
	{
		// data that you want to insert or change
		$data = array(
		'static_page_title' => '',
		'static_page_url' 	=> '',
		'keyword' 			=> 'fakta, sejarah',
		'categories_id' 	=> '4',
		'description' 		=> 'sejarah singkat tentang murvien di halaman beranda',
		'date' 				=> 'CURRENT_TIMESTAMP',
		'author' 			=> 'admin',
		'image' 			=> '',
		'content' 			=> "Didirikan pada pertengahan 2013, PT Murvien Global memiliki visi untuk menjadi perusahaan yang bekerja dengan tulus untuk mencapai kesuksesan bersama.
PT Murvien global bergerak dalam bidang perdagangan komoditas, aksesoris ponsel importir dan aksesoris wanita, dan digital kreatif."
		);
		
		// if second parameter is filled, it means you will do updating.
		// second parameter shows id that you want to change
		$id = $this->m_company->save($data);
		
		var_dump($id);
	}
	
	public function delete()
	{
		$this->m_company->delete(5);
	}
}

/* End of file company.php */
/* Location: ./application/controllers/company.php */
