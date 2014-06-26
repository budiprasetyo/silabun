<?php
/*
 * cms_helper.php
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

function btn_edit($uri) 
{
	return anchor($uri, '<i class="glyphicon glyphicon-edit"></i>', ''); 
}

function btn_delete($uri) 
{
	return anchor($uri, '<i class="glyphicon glyphicon-remove"></i>', array('onclick'=>"return confirm('Apakah Anda ingin menghapus data ini?')")); 
}

function btn_back($uri, $page = NULL) 
{
	return anchor($uri, '<i class="glyphicon glyphicon-chevron-left"></i> Kembali ke ' . $page, ''); 
}

/**
* Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
* @author Joost van Veen
* @version 1.0
*/

if (!function_exists('dump')) {
	function dump ($var, $label = 'Dump', $echo = TRUE)
	{
	// Store dump in variable
	ob_start();
	var_dump($var);
	$output = ob_get_clean();
	// Add formatting
	$output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
	$output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';
	
	// Output
	if ($echo == TRUE) {
		echo $output;
	}
	else {
		return $output;
		}
	}
}
 
 
if (!function_exists('dump_exit')) {
	function dump_exit($var, $label = 'Dump', $echo = TRUE) {
		dump ($var, $label, $echo);
		exit;
	}
}
