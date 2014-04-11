<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * news.php
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

class News extends Admin_Controller {

	/**
	 * Constructor of class Company
	 *
	 * @return void
	 */
	public function __construct()
	{
		// constructor
		parent::__construct();
	}
	
	/**
	 * Index Page for this controller.
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
		redirect('news/all_news/', 'refresh');
	}
	
	
	/**
	 * @brief home page
	 * 	accessed for first time
	 * @access	public
	 * @returns none
	 * 
	 * 
	 */
	public function all_news()
	{
		$this->data['header'] = 'admin/components/top_non_mod';
		$this->data['main_content'] = 'news/news';
		$this->data['footer'] = 'admin/components/bottom';
		$this->load->view('admin/template/_layout_main', $this->data);
	}
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */
