<?php 
	// pengeluaran kanwil or pkn
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
    // penerimaan kanwil or pkn
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
	// pdf rekening bendahara pengeluaran kanwil or pkn
	else if (count($parent_rekening_pengeluaran)
		&& $output === 'PDF')
	{
	?>
		<div class="content-report">
			<div class="title">
				Rekap Rekening Bendahara Pengeluaran<br />
				Bulan <?php echo get_month_name($month) . ' ' . $year; ?>
			</div>
		</div>
		<br />
		<table border="1" class="content-report">
			<thead>
				<tr class="bgcolor">
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
							<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $kementerian; ?></strong></td>
						</tr>
					<?php
						foreach ($results as $detil) 
						{
						?>
							<tr>
								<td></td>
								<td width="22%"><?php echo $detil['kd_satker']; ?> <br /> <?php echo $detil['nm_satker']; ?></td>
								<td width="15%"><?php echo strtoupper($detil['nm_bank']); ?></td>
								<td width="20%"><?php echo strtoupper($detil['nm_rekening']); ?></td>
								<td width="15%"><?php echo strtoupper($detil['no_rekening']); ?></td>
								<td width="15%"><?php echo strtoupper($detil['no_surat']); ?></td>
								<td width="8%"><?php echo strtoupper(date_convert($detil['tgl_surat'])); ?></td>
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
	// pdf rekening bendahara pengeluaran pkn or kanwil
	else if (count($parent_rekening_penerimaan)
		&& $output === 'PDF')
	{
	?>
		<div class="content-report">
			<div class="title">
				Rekap Rekening Bendahara Pengeluaran<br />
				Bulan <?php echo get_month_name($month) . ' ' . $year; ?>
			</div>
		</div>
		<br />
		<table border="1" class="content-report">
			<thead>
				<tr class="bgcolor">
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
						<tr style="font-weight: bold; font-size:11px;">
							<td colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo $kementerian; ?></strong></td>
						</tr>
					<?php
						foreach ($results as $detil) 
						{
						?>
							<tr>
								<td></td>
								<td width="22%"><?php echo $detil['kd_satker']; ?> <br /> <?php echo $detil['nm_satker']; ?></td>
								<td width="15%"><?php echo strtoupper($detil['nm_bank']); ?></td>
								<td width="20%"><?php echo strtoupper($detil['nm_rekening']); ?></td>
								<td width="15%"><?php echo strtoupper($detil['no_rekening']); ?></td>
								<td width="15%"><?php echo strtoupper($detil['no_surat']); ?></td>
								<td width="8%"><?php echo strtoupper(date_convert($detil['tgl_surat'])); ?></td>
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
	// pengeluaran kppn
	else if (count($parent_rekening_kppn_pengeluaran)
		&& $output === 'XLSX')
	{

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
		
	?>
		<h3><?php echo ucwords($subtitle); ?><br />
		<?php echo $nm_entity; ?><br /></h3>
		<h4><?php echo $period; ?></h4>
		<!-- table -->
		<table border="1">
			<thead>
				<tr>
					<th>Kementerian</th>
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
			foreach ( $parent_rekening_kppn_pengeluaran as $rekening_pengeluaran => $results ) 
			{
				
				?>
					<tr>
						<td colspan="7"><?php echo $rekening_pengeluaran; ?></td>
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
			 ?>
			</tbody>
		</table>
	<?php
	}
	// penerimaan kppn
	else if (count($parent_rekening_kppn_penerimaan)
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
					<th>Kementerian</th>
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
			foreach ( $parent_rekening_kppn_penerimaan as $rekening_penerimaan => $results ) 
			{
				
				?>
					<tr>
						<td colspan="7"><?php echo $rekening_penerimaan; ?></td>
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
			 ?>
			</tbody>
		</table>
	<?php
	}
	// pdf rekening bendahara pengeluaran kppn
	else if (count($parent_rekening_kppn_pengeluaran)
		&& $output === 'PDF')
	{
	?>
		<div class="content-report">
			<div class="title">
				Rekap Rekening Bendahara Pengeluaran<br />
				Bulan <?php echo get_month_name($month) . ' ' . $year; ?>
			</div>
		</div>
		<br />
		<table border="1" class="content-report">
			<thead>
				<tr class="bgcolor">
					<th>Kementerian</th>
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
			foreach ( $parent_rekening_kppn_pengeluaran as $rekening_pengeluaran => $results ) 
			{
				
				?>
					<tr>
						<td colspan="7"><strong><?php echo $rekening_pengeluaran; ?></strong></td>
					</tr>
				<?php
					foreach ($results as $detil) 
					{
					?>
						<tr>
							<td></td>
							<td width="22%"><?php echo $detil['kd_satker']; ?> <br /> <?php echo $detil['nm_satker']; ?></td>
							<td width="15%"><?php echo strtoupper($detil['nm_bank']); ?></td>
							<td width="20%"><?php echo strtoupper($detil['nm_rekening']); ?></td>
							<td width="15%"><?php echo strtoupper($detil['no_rekening']); ?></td>
							<td width="15%"><?php echo strtoupper($detil['no_surat']); ?></td>
							<td width="8%"><?php echo strtoupper(date_convert($detil['tgl_surat'])); ?></td>
						</tr>
					<?php
					}
				}
			 ?>
			</tbody>
		</table>
	<?php
	}
	// pdf rekening bendahara penerimaan kppn
	else if (count($parent_rekening_kppn_penerimaan)
		&& $output === 'PDF')
	{
	?>
		<div class="content-report">
			<div class="title">
				Rekap Rekening Bendahara Pengeluaran<br />
				Bulan <?php echo get_month_name($month) . ' ' . $year; ?>
			</div>
		</div>
		<br />
		<table border="1" class="content-report">
			<thead>
				<tr class="bgcolor">
					<th>Kementerian</th>
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
			foreach ( $parent_rekening_kppn_penerimaan as $rekening_penerimaan => $results ) 
			{
				
				?>
					<tr>
						<td colspan="7"><strong><?php echo $rekening_penerimaan; ?></strong></td>
					</tr>
				<?php
					foreach ($results as $detil) 
					{
					?>
						<tr>
							<td></td>
							<td width="22%"><?php echo $detil['kd_satker']; ?> <br /> <?php echo $detil['nm_satker']; ?></td>
							<td width="15%"><?php echo strtoupper($detil['nm_bank']); ?></td>
							<td width="20%"><?php echo strtoupper($detil['nm_rekening']); ?></td>
							<td width="15%"><?php echo strtoupper($detil['no_rekening']); ?></td>
							<td width="15%"><?php echo strtoupper($detil['no_surat']); ?></td>
							<td width="8%"><?php echo strtoupper(date_convert($detil['tgl_surat'])); ?></td>
						</tr>
					<?php
					}
				}
			 ?>
			</tbody>
		</table>
	<?php
	}
 ?>