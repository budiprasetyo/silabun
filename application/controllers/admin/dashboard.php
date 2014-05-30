<?php
/*
 * dashboard.php
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

include_once "user.php";

class Dashboard extends Admin_Controller
{

	/**
	 * Constructor of class Dashboard.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		//~ $this->load->view('admin/template/_layout_admin', $this->data);
		redirect('admin/dashboard/home', 'refresh');
	}
	

	public function home()
	{	
		$this->data['users'] = $this->m_user->get();
		$this->data['subview'] = 'admin/dashboard/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function logout()
	{
		$user = new user();	
		$user->logout();
	}

}
