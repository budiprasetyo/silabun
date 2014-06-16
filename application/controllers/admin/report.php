<?php
/*
 * report.php
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


class Report extends Admin_Controller
{

	/**
	 * Constructor of class Report.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_report');
	}

	public function index()
	{
		// path to page folder view
		$this->data['subview'] = 'admin/report/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function report_teguran()
	{
		$this->load->library('mpdf');
		$this->mpdf = new mPDF('utf-8', 'A4');
		$this->data['content'] = $this->load->view('admin/report/report_teguran', $this->data, true);
		$css	= file_get_contents('assets/css/report.css');
		$html 	= $this->load->view('admin/components/report_header', $this->data, true);
		$this->mpdf->WriteHTML($css, 1);
		$this->mpdf->WriteHTML($html, 2);
		$this->mpdf->Output();
		//~ $this->data['content'] = $this->load->view('admin/report/report_teguran', $this->data);
		//~ $this->load->view('admin/components/report_header', $this->data);
		//~ $this->load->view('admin/report/report_teguran', $this->data);
		//~ $this->load->view('admin/components/report_footer', $this->data);
	}
}
