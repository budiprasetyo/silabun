<?php
/*
 * m_page.php
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




class M_page extends MY_Model
{
	protected $_table_name 		= 'cms_static_page';
	protected $_primary_key 	= 'static_page_id';
	protected $_order_by 		= 'static_page_id';
	public $rules 				= array(
						'static_page_title' => array( 
							'field' => 'static_page_title', 
							'label' => 'Static Page Title', 
							'rules' => 'trim|max_length[100]|xss_clean'
						),
						'static_page_url' => array( 
							'field' => 'static_page_url', 
							'label' => 'Static Page URL', 
							'rules' => 'trim|required|max_length[100]|url_title|callback__unique_url|xss_clean'
						),
						'keyword' => array( 
							'field' => 'keyword', 
							'label' => 'keyword', 
							'rules' => 'trim|required|max_length[100]|xss_clean'
						),
						'categories_id' => array( 
							'field' => 'categories_id', 
							'label' => 'categories', 
							'rules' => 'trim|required|is_natural|max_length[3]|xss_clean'
						),
						'description' => array( 
							'field' => 'description', 
							'label' => 'description', 
							'rules' => 'trim|required'
						),
						'date' => array( 
							'field' => 'date', 
							'label' => 'date', 
							'rules' => 'trim|xss_clean'
						),
						'author' => array( 
							'field' => 'author', 
							'label' => 'author', 
							'rules' => 'trim|max_length[120]|xss_clean'
						),
						'image' => array( 
							'field' => 'image', 
							'label' => 'image', 
							'rules' => 'trim|max_length[100]|xss_clean'
						),
						'content' => array( 
							'field' => 'content', 
							'label' => 'content', 
							'rules' => 'trim|required'
						)
	);
	
	// define must be paired with rules
	public function get_new()
	{
		// define and instantiate
		$page = new stdClass();
		
		$page->static_page_title= '';
		$page->static_page_url	= '';
		$page->keyword			= '';
		$page->categories_id	= '';
		$page->description		= '';
		$page->date				= '';
		$page->author			= '';
		$page->image			= '';
		$page->content			= '';
		return $page;
	}

}
