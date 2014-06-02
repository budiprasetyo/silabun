<?php
/*
 * m_categories.php
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



class M_categories extends MY_Model
{

	protected $_table_name 		= 'cms_categories';
	protected $_primary_key 	= 'categories_id';
	protected $_order_by 		= 'categories_id';
	public $rules				= array(
					'categories'	=> array(
						'field'	=> 'categories',
						'label'	=> 'categories',
						'rules'	=> 'trim|required|max_length[120]|xss_clean'
					),
					'description'	=> array(
						'field'	=> 'description',
						'label'	=> 'description',
						'rules'	=> 'trim|xss_clean'
					),
					'page_type_id'	=> array(
						'field'	=> 'page_type_id',
						'label'	=> 'Page Type',
						'rules'	=> 'trim|required|is_natural|max_length[3]|xss_clean'
					),
					'language_id'	=> array(
						'field'	=> 'language_id',
						'label'	=> 'Language',
						'rules'	=> 'trim|required|is_natural|max_length[3]|xss_clean'
					),
					'status_code'	=> array(
						'field'	=> 'status_code',
						'label'	=> 'status_code',
						'rules'	=> 'trim|required|is_natural|max_length[1]|xss_clean'
					)
	);
	
	// define must be paired with rules
	public function get_new()
	{
		// define and instantiate
		$categories = new stdClass();
		
		$categories->categories		= '';
		$categories->description	= '';
		$categories->page_type_id	= '';
		$categories->language_id	= '';
		$categories->status_code	= '';
		return $categories;
	}
}
