<?php 
	// pengeluaran
	if (count($parent_rekening_pengeluaran)
		&& $output === 'XLSX')
	{

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
		
	?>
		<h3><?php echo ucwords($subtitle); ?><br />
		<?php echo $nm_entity; ?><br /></h3>
		<h4><?php echo $period; ?></h4>
		<table border="1">
			<thead>
				<tr>
					<th>KPPN<br />
							Kementerian</th>
					<th>Satker</th>
					<th>Nama Bank</th>
					<th>Nama Rekening</th>
					<th>No. Rekening</th>
					<th>No. Surat</th>
					<th>Tgl. Surat</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ( $parent_rekening_pengeluaran as $rekening_pengeluaran => $groups ) 
				{
			?>
					<tr>
						<td colspan="7"><strong>KPPN <?php echo $rekening_pengeluaran; ?></strong></td>
					</tr>
			<?php
					foreach ( $groups as $kementerian => $results ) 
					{
					?>
						<tr>
							<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $kementerian; ?></td>
						</tr>
					<?php
						foreach ($results as $detil) 
						{
						?>
							<tr>
								<td></td>
								<td><?php echo $detil['kd_satker']; ?> <br /> <?php echo $detil['nm_satker']; ?></td>
								<td><?php echo strtoupper($detil['nm_bank']); ?></td>
								<td><?php echo strtoupper($detil['nm_rekening']); ?></td>
								<td><?php echo strtoupper($detil['no_rekening']); ?></td>
								<td><?php echo strtoupper($detil['no_surat']); ?></td>
								<td><?php echo strtoupper(date_convert($detil['tgl_surat'])); ?></td>
							</tr>
						<?php
						}
					}
				}
			 ?>
			</tbody>
		</table>
	<?php
	}
    // penerimaan
    else if (count($parent_rekening_penerimaan)
		&& $output === 'XLSX')
	{

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
		
	?>
		<h3><?php echo ucwords($subtitle); ?><br />
		<?php echo $nm_entity; ?><br /></h3>
		<h4><?php echo $period; ?></h4>
		<table border="1">
			<thead>
				<tr>
					<th>KPPN<br />
							Kementerian</th>
					<th>Satker</th>
					<th>Nama Bank</th>
					<th>Nama Rekening</th>
					<th>No. Rekening</th>
					<th>No. Surat</th>
					<th>Tgl. Surat</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			foreach ( $parent_rekening_penerimaan as $rekening_penerimaan => $groups ) 
			{
			?>
					<tr>
						<td colspan="7"><strong>KPPN <?php echo $rekening_penerimaan; ?></strong></td>
					</tr>
			<?php
					foreach ( $groups as $kementerian => $results ) 
					{
					?>
						<tr>
							<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $kementerian; ?></td>
						</tr>
					<?php
						foreach ($results as $detil) 
						{
						?>
							<tr>
								<td></td>
								<td><?php echo $detil['kd_satker']; ?> <br /> <?php echo $detil['nm_satker']; ?></td>
								<td><?php echo strtoupper($detil['nm_bank']); ?></td>
								<td><?php echo strtoupper($detil['nm_rekening']); ?></td>
								<td><?php echo strtoupper($detil['no_rekening']); ?></td>
								<td><?php echo strtoupper($detil['no_surat']); ?></td>
								<td><?php echo strtoupper(date_convert($detil['tgl_surat'])); ?></td>
							</tr>
						<?php
						}
					}
				}
			 ?>
			</tbody>
		</table>
							
	<?php
	}
 ?>
