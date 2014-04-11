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
		$this->data['meta_title'] = "PT. Murvien Global - Trading of commodities, mobile phone accessories importers and women's accessories, and  digital creative";
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('m_user');
		
		// login check
		$exception_uris = array(
				'admin/user/login',
				'admin/user/logout'
		);
		
		if(in_array(uri_string(), $exception_uris) == FALSE)
		{
			if ($this->m_user->loggedin() == FALSE) 
			{
				redirect('admin/user/login');
			}
		}
	}

}
