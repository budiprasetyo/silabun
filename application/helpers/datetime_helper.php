<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * datetime_helper.php
 * 
 * Copyright 2013 budi prasetyo a.k.a. metamorph <metamorph@Cyber-Station>
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

// ------------------------------------------------------------------------

/**
 * Datetime Helpers
 *
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Budi Prasetyo
 */

// ------------------------------------------------------------------------


/**
 * Convert to MySQL Style or common style
 *
 *
 * @access	public
 * @param	string
 * @param	integer
 * @return	integer
 */
if ( ! function_exists('date_convert'))
{
		
		function date_convert($date){
			if(strstr($date,"/") || strstr($date,".")){
				$date = preg_split("/[\/]|[.]+/",$date);
				$date = $date[2] . "-" . $date[1] . "-" . $date[0];
				return $date;
			}
			elseif(strstr($date,"-")){
				$date = preg_split("/[-]+/",$date);
				$date = $date[2] . "-" . $date[1] . "-" . $date[0];
				return $date;
			}	
		}
		
		function date_convert_string($date) 
		{
			if(strstr($date,"/") || strstr($date,".")){
				$date = preg_split("/[\/]|[.]+/",$date);
				$month = (int) $date[1];
				$date = $date[2] . "-" . JDMonthName($month, CAL_MONTH_GREGORIAN_LONG) . "-" . $date[0];
				return $date;
			}
			elseif(strstr($date,"-")){
				$date = preg_split("/[-]+/",$date);
				$month = (int) $date[1];
				$date = $date[2] . "-" . JDMonthName($month, CAL_MONTH_GREGORIAN_LONG) . "-" . $date[0];
				return $date;
			}
		}
		
		function get_month_name($month){
			$month = intval($month);
			switch ($month) {
				case 1: return 'Januari'; break;
				case 2: return 'Februari'; break;
				case 3: return 'Maret'; break;
				case 4: return 'April'; break;
				case 5: return 'Mei'; break;
				case 6: return 'Juni'; break;
				case 7: return 'Juli'; break;
				case 8: return 'Agustus'; break;
				case 9: return 'September'; break;
				case 10: return 'Oktober'; break;
				case 11: return 'November'; break;
				case 12: return 'Desember'; break;
				default:
					break;
			}
			
			return '';
			
		}
		
}

/* End of file datetime_helper.php */
/* Location: ./application/helpers/datetime_helper.php */
