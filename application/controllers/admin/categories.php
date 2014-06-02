<?php
/*
 * categories.php
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




class Categories extends Admin_Controller
{

	/**
	 * Constructor of class Categories.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_categories');
	}

	public function index()
	{
		// fetch all categories
		$this->data['categories'] = $this->m_categories->get();
		
		// path to page folder view
		$this->data['subview'] = 'admin/categories/index';
		$this->load->view('admin/template/_layout_admin', $this->data);
	}
	
	public function edit($id = NULL)
	{
		
		$back_link = $this->uri->segment(2);
		// check existing categories or create one
		if ($id) {
			$this->data['id']			= $id;
			$this->data['categories'] 	= $this->m_categories->get($id);
			$this->data['back_link'] 	= $back_link;
			count($this->data['categories']) || $this->data['errors'][] = 'categories could not be found';
			$this->data['dropdown'] 	= $this->m_categories;
		}
		else {
			$this->data['id']			= null;
			$this->data['categories'] 	= $this->m_categories->get_new();
			$this->data['back_link'] 	= $back_link;
			$this->data['dropdown'] 	= $this->m_categories;
		}
		
		$id == NULL || $this->data['categories'] = $this->m_categories->get($id);
		
		// rules section
		$rules = $this->m_categories->rules;
		$this->form_validation->set_rules($rules);
		
		if ( $this->form_validation->run() == TRUE ) {
			// populate fields
			$data = $this->m_categories->array_from_post(array('categories','description','page_type_id','language_id','status_code'));
			// save data
			$this->m_categories->save($data, $id);
			// redirect to users categories
			redirect('admin/categories');
		}
		// path to categories folder view
		$this->data['subview'] = 'admin/categories/edit';
		$this->load->view('admin/template/_layout_admin', $this->data);
		
	}
	
	public function delete($id)
	{
		$this->m_page->delete($id);
		redirect('admin/page');
	}
}
