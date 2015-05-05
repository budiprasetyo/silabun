<?php
/*
 * report_kppn_monitoring.php
 * 
 * Copyright 2015 metamorph <metamorph@code-machine>
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
 
// pengeluaran section
// xls report
if ( count($monitor_satker_pengeluaran_sents)
	 && $output === 'XLS')
{
	header('Content-type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename='.$filename.'.xls');
	
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="Windows-1252" />
	</head>
	<body>
		<?php 
			
			if ( $this->data['id_entities'] === '1'
				 && $transaksi === 'pengeluaran' )
			{
		?>
				<h4><?php echo $table_title; ?></h4>
				<h4><?php echo get_month_name($month) . ' ' . $year; ?></h4>
				<table border="1">
					<thead>
						<tr>
							<th>No.</th>
							<th>Kode Satker</th>
							<th>Nama Satker</th>
							<th>Tanggal Pengiriman Data</th>
						</tr>
					</thead>
					<tbody style="font-size:11px;">
		<?php
							$i = 0;
							foreach ( $monitor_satker_pengeluaran_sents as $monitor_pengeluaran_sents ) 
							{
		?>
								<tr>
									<td><?php echo ++$i; ?></td>
									<td>=text(<?php echo $monitor_pengeluaran_sents->kd_satker; ?>,"000000")</td>
									<td><?php echo $monitor_pengeluaran_sents->nm_satker; ?></td>
									<td><?php echo $monitor_pengeluaran_sents->created_at; ?></td>
								</tr>
		<?php
							}
			}
		?>
					</tbody>
				</table>
	</body>
	</html>
	<?php
}
else if ( count($monitor_satker_penerimaan_sents)
		  &&  $output === 'XLS' )
{
	header('Content-type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename='.$filename.'.xls');
	
	?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="Windows-1252" />
	</head>
	<body>
		<?php 
			
			if ( $this->data['id_entities'] === '1'
				 && $transaksi === 'penerimaan' )
			{
		?>
				<h4><?php echo $table_title; ?></h4>
				<h4><?php echo get_month_name($month) . ' ' . $year; ?></h4>
				<table border="1">
					<thead>
						<tr>
							<th>No.</th>
							<th>Kode Satker</th>
							<th>Nama Satker</th>
							<th>Tanggal Pengiriman Data</th>
						</tr>
					</thead>
					<tbody style="font-size:11px;">
		<?php
							$i = 0;
							foreach ( $monitor_satker_penerimaan_sents as $monitor_penerimaan_sents ) 
							{
		?>
								<tr>
									<td><?php echo ++$i; ?></td>
									<td>=text(<?php echo $monitor_penerimaan_sents->kd_satker; ?>,"000000")</td>
									<td><?php echo $monitor_penerimaan_sents->nm_satker; ?></td>
									<td><?php echo $monitor_penerimaan_sents->created_at; ?></td>
								</tr>
		<?php
							}
			}
		?>
					</tbody>
				</table>
	</body>
	</html>
	<?php
}



?>
