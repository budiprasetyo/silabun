<?php
/*
 * amountformat_helper.php
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

?>
<?php
if ( ! function_exists('amount_format'))
{
  function amount_format($number)
  {
    return number_format($number,0, ',', '.');
  }
}

if( ! function_exists('replace_dot_in_numeric'))
{
  function replace_dot_in_numeric($number)
  {
	  return str_replace(".", "", $number);
  }
}

if ( ! function_exists('decimal_format') )
{
	function decimal_format($number, $decimal)
	{
		return number_format($number, $decimal, ',', '.');
	}
}

?>

