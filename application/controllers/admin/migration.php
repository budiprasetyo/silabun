<?php
/*
 * migration.php
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



class Migration extends Admin_Controller
{

	/**
	 * Constructor of class Migration.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();	
		// only run this through terminal
		if($this->input->is_cli_request() == FALSE)
		{
			show_404();
		}
		
		$this->load->library('migration');
		$this->load->dbforge();
	}
	
	public function index()
	{
		echo 'hello';
	}
	
	public function latest()
	{
		$this->migration->latest();
	}
	/*
	public function index($version)
	{
		$this->load->library('migration');
		if ( ! $this->migration->version($version) )
		{
			show_error($this->migration->error_string());
		}
		else
		{
			echo "Migration worked!";
		}
	}
	*/
}
