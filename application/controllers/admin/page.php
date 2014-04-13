<?php
/*
 * page.php
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



class Page extends Admin_Controller
{

	/**
	 * Constructor of class Page.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_page');
	}

	public function index()
	{	
		// fetch all users
		$this->data['pages'] = $this->m_page->get();
		
		// path to page folder view
		$this->data['subview'] = 'admin/page/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	

	public function edit($id = NULL)
	{
		// check existing users or create one
		if ($id) {
			$this->data['page'] = $this->m_page->get($id);
			count($this->data['page']) || $this->data['errors'][] = 'page could not be found';
		}
		else {
			$this->data['page'] = $this->m_page->get_new();
		}
		
		$id == NULL || $this->data['page'] = $this->m_page->get($id);
		
		// rules section
		$rules = $this->m_page->rules;
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() == TRUE ) {
			// populate fields
			$data = $this->m_page->array_from_post(array('static_page_title','static_page_url','keyword','categories_id','description','author','image','content'));
			$this->m_page->save($data, $id);
			// redirect to users home
			redirect('admin/page');
		}
		// path to user folder view
		$this->data['subview'] = 'admin/page/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function delete($id)
	{
		$this->m_page->delete($id);
		redirect('admin/page');
	}

	public function _unique_url($string)
	{
		// don't validate if url already exists
		// unless it's the url for current user
		
		$id = $this->uri->segment(4);
		$this->db->where('static_page_url', $this->input->post('static_page_url'));
		// if not getting id, choose another id, and be careful of id's name
		!$id || $this->db->where('static_page_id !=' , $id);
		$page = $this->m_page->get();
		
		if (count($page)) 
		{
			$this->form_validation->set_message('_unique_url', '%s should be unique');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
