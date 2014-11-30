<?php 
	// pengeluaran
	if (count($detil_kanwil)
		&& $output === 'XLSX'){

		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
		
		?>
			
		  <h3><?php echo ucwords($subtitle); ?><br />
		  <?php echo $nm_entity; ?><br /></h3>
		  <h4><?php echo $period; ?></h4>
			<table border="1">
				<thead>
					<tr>
						<th rowspan="2">KPPN</th>
						<th rowspan="2">Kementerian</th>
						<th rowspan="2">Satker</th>
						<th colspan="5">Saldo Kas Menurut Buku Pembantu (BP)</th>
						<th colspan="3">Uang Persediaan</th>
					</tr>
					<tr>
						<th>
							BP Uang<br />
							Persediaan
						</th>
						<th>
							BP<br />
							LS Bendahara
						</th>
						<th>
							BP<br />
							Pajak
						</th>
						<th>
							BP<br />
							Lain-Lain
						</th>
						<th>Jumlah</th>
						<th>Saldo</th>
						<th>Kuitansi</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ( $detil_kanwil as $kppn => $groups ) 
						{
							
						?>
								<tr>
									<td colspan="11"><strong>KPPN <?php echo $kppn; ?></strong></td>
								</tr>
								
						<?php 
								foreach ($groups as $kementerian => $results ) 
								{
									
									// variable for sum of kementerian
									$saldo_uang_persediaan_pengeluaran = 0;
									$saldo_ls_bendahara_pengeluaran = 0;
									$saldo_pajak_pengeluaran = 0;
									$saldo_pengeluaran_lain_pengeluaran = 0;
									
									$saldo_saldo_pengeluaran = 0;
									$saldo_kuitansi_pengeluaran = 0;
									
									
						?>
								<tr>
									<td></td>
									<td colspan="10"><strong><?php echo $kementerian; ?></strong></td>
								</tr>
						<?php
									
									foreach ($results as $detil) 
									{
										// sum of higher level above kementerian (kppn)
										$saldo_total_uang_persediaan_pengeluaran += $detil['uang_persediaan'];
										$saldo_total_ls_bendahara_pengeluaran += $detil['ls_bendahara'];
										$saldo_total_pajak_pengeluaran += $detil['pajak'];
										$saldo_total_pengeluaran_lain_pengeluaran += $detil['pengeluaran_lain'];
										
										$sum_saldo_total_bp_pengeluaran = $saldo_total_uang_persediaan_pengeluaran + $saldo_total_ls_bendahara_pengeluaran + $saldo_total_pajak_pengeluaran + $saldo_total_pengeluaran_lain_pengeluaran;
										
										$saldo_total_saldo_pengeluaran += $detil['saldo'];
										$saldo_total_kuitansi_pengeluaran += $detil['kuitansi'];
										
										$sum_saldo_total_up_pengeluaran = $saldo_total_saldo_pengeluaran + $saldo_total_kuitansi_pengeluaran;
										// end of higher level above kementerian (kppn)
										
										// sum of higher level (kementerian)
										$saldo_uang_persediaan_pengeluaran += $detil['uang_persediaan'];
										$saldo_ls_bendahara_pengeluaran += $detil['ls_bendahara'];
										$saldo_pajak_pengeluaran += $detil['pajak'];
										$saldo_pengeluaran_lain_pengeluaran += $detil['pengeluaran_lain'];
										
										$saldo_bp_kementerian_pengeluaran = $saldo_uang_persediaan_pengeluaran + $saldo_ls_bendahara_pengeluaran + $saldo_pajak_pengeluaran + $saldo_pengeluaran_lain_pengeluaran;
										
										$saldo_saldo_pengeluaran += $detil['saldo'];
										$saldo_kuitansi_pengeluaran += $detil['kuitansi'];
										
										$saldo_up_kementerian_pengeluaran = $saldo_saldo_pengeluaran + $saldo_kuitansi_pengeluaran;
										// end of higher level in kementerian

										// sum of saldo kas menurut bp
										$saldo_bp_pengeluaran = $detil['uang_persediaan'] + $detil['ls_bendahara'] + $detil['pajak'] + $detil['pengeluaran_lain'];
										// sum of saldo up
										$saldo_up_pengeluaran = $detil['saldo'] + $detil['kuitansi'];
						?>
										<tr>
											<td></td>
											<td></td>
											<td><?php echo $detil['kd_satker'] . ' ' . $detil['nm_satker']; ?></td>
											<td align="right"><?php echo $detil['uang_persediaan']; ?></td>
											<td align="right"><?php echo $detil['ls_bendahara']; ?></td>
											<td align="right"><?php echo $detil['pajak']; ?></td>
											<td align="right"><?php echo $detil['pengeluaran_lain']; ?></td>
											<td align="right"><?php echo $saldo_bp_pengeluaran; ?></td>
											<td align="right"><?php echo $detil['saldo']; ?></td>
											<td align="right"><?php echo $detil['kuitansi']; ?></td>
											<td align="right"><?php echo $saldo_up_pengeluaran; ?></td>
										</tr>
						<?php
									}
						?>
								<tr>
									<td></td>
									<td colspan="2"><strong>JUMLAH <?php echo $kementerian; ?></strong></td>
									<td align="right"><strong><?php echo $saldo_uang_persediaan_pengeluaran; ?></strong></td>
									<td align="right"><strong><?php echo $saldo_ls_bendahara_pengeluaran; ?></strong></td>
									<td align="right"><strong><?php echo $saldo_pajak_pengeluaran; ?></strong></td>
									<td align="right"><strong><?php echo $saldo_pengeluaran_lain_pengeluaran; ?></strong></td>
									<td align="right"><strong><?php echo $saldo_bp_kementerian_pengeluaran; ?></strong></td>
									<td align="right"><strong><?php echo $saldo_saldo_pengeluaran; ?></strong></td>
									<td align="right"><strong><?php echo $saldo_kuitansi_pengeluaran; ?></strong></td>
									<td align="right"><strong><?php echo $saldo_up_kementerian_pengeluaran; ?></strong></td>
								</tr>
						<?php
								}
						?>
							<tr>
								<td colspan="3"><strong>JUMLAH TOTAL KPPN <?php echo $kppn; ?></strong></td>
								<td align="right"><strong><?php echo $saldo_total_uang_persediaan_pengeluaran; ?></strong></td>
								<td align="right"><strong><?php echo $saldo_total_ls_bendahara_pengeluaran; ?></strong></td>
								<td align="right"><strong><?php echo $saldo_total_pajak_pengeluaran; ?></strong></td>
								<td align="right"><strong><?php echo $saldo_total_pengeluaran_lain_pengeluaran; ?></strong></td>
								<td align="right"><strong><?php echo $sum_saldo_total_bp_pengeluaran; ?></strong></td>
								<td align="right"><strong><?php echo $saldo_total_saldo_pengeluaran; ?></strong></td>
								<td align="right"><strong><?php echo $saldo_total_kuitansi_pengeluaran; ?></strong></td>
								<td align="right"><strong><?php echo $sum_saldo_total_up_pengeluaran; ?></strong></td>
							</tr>
						<?php
							}
						?>
				</tbody>
			</table>
		<?php
	}
    // penerimaan
    else if (count($detil_kanwil_penerimaan)
		&& $output === 'XLSX')
	{
		
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
		
		?>
		
		  <h3><?php echo ucwords($subtitle); ?><br />
		  <?php echo $nm_entity; ?><br /></h3>
		  <h4 class="text-center"><?php echo $period; ?></h4>
			<table border="1">
				<thead>
					<tr>
						<th rowspan="2">KPPN</th>
						<th rowspan="2">Kementerian</th>
						<th rowspan="2">Satker</th>
						<th colspan="3">Saldo Kas</th>
						<th colspan="4">Saldo Penerimaan dan Penyetoran</th>
					</tr>
					<tr>
						<th>
							Kas Tunai
						</th>
						<th>
							Kas Bank
						</th>
						<th>Jumlah</th>
						<th>Saldo Awal</th>
						<th>Penerimaan</th>
						<th>Penyetoran</th>
						<th>Saldo</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					foreach ( $detil_kanwil_penerimaan as $kppn => $groups ) 
					{
				?>
						<tr>
							<td colspan="10"><strong><?php echo $kppn; ?></strong></td>
						</tr>
						
				<?php 
						foreach ($groups as $kementerian => $results ) 
						{
							
							// variable for sum of kementerian
							$saldo_kas_tunai_penerimaan = 0;
							$saldo_kas_bank_penerimaan = 0;
							
							$saldo_saldo_awal_penerimaan = 0;
							$saldo_penerimaan_penerimaan = 0;
							$saldo_penyetoran_penerimaan = 0;
							
							
				?>
						<tr>
							<td></td>
							<td colspan="9"><strong><?php echo $kementerian; ?></strong></td>
						</tr>
				<?php
							
							foreach ($results as $detil) 
							{
								// sum of higher level above kementerian (kppn)
								$saldo_total_kas_tunai_penerimaan += $detil['kas_tunai'];
								$saldo_total_kas_bank_penerimaan += $detil['kas_bank'];
								
								$sum_saldo_total_saldo_kas_penerimaan = $saldo_total_kas_tunai_penerimaan + $saldo_total_kas_bank_penerimaan;
								
								$saldo_total_saldo_awal_penerimaan += $detil['saldo_awal'];
								$saldo_total_penerimaan_penerimaan += $detil['penerimaan'];
								$saldo_total_penyetoran_penerimaan += $detil['penyetoran'];
								
								$sum_saldo_total_penerimaan_penerimaan = $saldo_total_saldo_awal_penerimaan + $saldo_total_penerimaan_penerimaan - $saldo_total_penyetoran_penerimaan;
								// end of higher level above kementerian (kppn)
								
								// sum of higher level (kementerian)
								$saldo_kas_tunai_penerimaan += $detil['kas_tunai'];
								$saldo_kas_bank_penerimaan += $detil['kas_bank'];
								
								$saldo_kas_kementerian_penerimaan = $saldo_kas_tunai_penerimaan + $saldo_kas_bank_penerimaan;
								
								$saldo_saldo_awal_penerimaan += $detil['saldo_awal'];
								$saldo_penerimaan_penerimaan += $detil['penerimaan'];
								$saldo_penyetoran_penerimaan += $detil['penyetoran'];
								
								$saldo_penerimaan_kementerian_penerimaan = $saldo_saldo_awal_penerimaan + $saldo_penerimaan_penerimaan - $saldo_penyetoran_penerimaan;
								// end of higher level in kementerian

								// sum of saldo kas 
								$saldo_kas_penerimaan = $detil['kas_tunai'] + $detil['kas_bank'];
								// sum of saldo penerimaan dan penyetoran
								$saldo_penerimaan_penyetoran_penerimaan = $detil['saldo_awal'] + $detil['penerimaan'] - $detil['penyetoran'];
				?>
								<tr>
									<td></td>
									<td></td>
									<td><?php echo $detil['kd_satker'] . ' ' . $detil['nm_satker']; ?></td>
									<td align="right"><?php echo $detil['kas_tunai']; ?></td>
									<td align="right"><?php echo $detil['kas_bank']; ?></td>
									<td align="right"><?php echo $saldo_kas_penerimaan; ?></td>
									<td align="right"><?php echo $detil['saldo_awal']; ?></td>
									<td align="right"><?php echo $detil['penerimaan']; ?></td>
									<td align="right"><?php echo $detil['penyetoran']; ?></td>
									<td align="right"><?php echo $saldo_penerimaan_penyetoran_penerimaan; ?></td>
								</tr>
				<?php
							}
				?>
						<tr>
							<td></td>
							<td colspan="2"><strong>JUMLAH <?php echo $kementerian; ?></strong></td>
							<td align="right"><strong><?php echo $saldo_kas_tunai_penerimaan; ?></strong></td>
							<td align="right"><strong><?php echo $saldo_kas_bank_penerimaan; ?></strong></td>
							<td align="right"><strong><?php echo $saldo_kas_kementerian_penerimaan; ?></strong></td>
							<td align="right"><strong><?php echo $saldo_saldo_awal_penerimaan; ?></strong></td>
							<td align="right"><strong><?php echo $saldo_penerimaan_penerimaan; ?></strong></td>
							<td align="right"><strong><?php echo $saldo_penyetoran_penerimaan; ?></strong></td>
							<td align="right"><strong><?php echo $saldo_penerimaan_kementerian_penerimaan; ?></strong></td>
						</tr>
				<?php
						}
				?>
					<tr>
						<td colspan="3"><strong>JUMLAH TOTAL KPPN <?php echo $kppn; ?></strong></td>
						<td align="right"><strong><?php echo $saldo_total_kas_tunai_penerimaan; ?></strong></td>
						<td align="right"><strong><?php echo $saldo_total_kas_bank_penerimaan; ?></strong></td>
						<td align="right"><strong><?php echo $sum_saldo_total_saldo_kas_penerimaan; ?></strong></td>
						<td align="right"><strong><?php echo $saldo_total_saldo_awal_penerimaan; ?></strong></td>
						<td align="right"><strong><?php echo $saldo_total_penerimaan_penerimaan; ?></strong></td>
						<td align="right"><strong><?php echo $saldo_total_penyetoran_penerimaan; ?></strong></td>
						<td align="right"><strong><?php echo $sum_saldo_total_penerimaan_penerimaan; ?></strong></td>
					</tr>
				<?php
					} 
				?>
				</tbody>
			  </table>
		<?php
	}
	// pdf rekap LPJ Detil Pengeluaran Kanwil
	else if (count($detil_kanwil)
		&& $output === 'PDF')
	{
	
	?>
		<div class="content-report">
			<div class="title">
				Detil LPJ Bendahara Pengeluaran<br />
				Per Satker Tingkat Wilayah<br />
				Bulan <?php echo get_month_name($month) . ' ' . $year; ?>
			</div>
		</div>
		<br />
			<table border="1" class="content-report">
				<thead>
					<tr class="bgcolor">
						<th rowspan="2">KPPN</th>
						<th rowspan="2">Kementerian</th>
						<th rowspan="2">Satker</th>
						<th colspan="5">Saldo Kas Menurut Buku Pembantu (BP)</th>
						<th colspan="3">Uang Persediaan</th>
					</tr>
					<tr class="bgcolor">
						<th width="8%">
							BP Uang<br />
							Persediaan
						</th>
						<th width="8%">
							BP<br />
							LS Bendahara
						</th>
						<th width="8%">
							BP<br />
							Pajak
						</th>
						<th width="8%">
							BP<br />
							Lain-Lain
						</th>
						<th width="8%">Jumlah</th>
						<th width="8%">Saldo</th>
						<th width="8%">Kuitansi</th>
						<th width="8%">Jumlah</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ( $detil_kanwil as $kppn => $groups ) 
						{
							
						?>
								<tr>
									<td colspan="11"><strong>KPPN <?php echo $kppn; ?></strong></td>
								</tr>
								
						<?php 
								foreach ($groups as $kementerian => $results ) 
								{
									
									// variable for sum of kementerian
									$saldo_uang_persediaan_pengeluaran = 0;
									$saldo_ls_bendahara_pengeluaran = 0;
									$saldo_pajak_pengeluaran = 0;
									$saldo_pengeluaran_lain_pengeluaran = 0;
									
									$saldo_saldo_pengeluaran = 0;
									$saldo_kuitansi_pengeluaran = 0;
									
									
						?>
								<tr>
									<td></td>
									<td colspan="10"><strong><?php echo $kementerian; ?></strong></td>
								</tr>
						<?php
									
									foreach ($results as $detil) 
									{
										// sum of higher level above kementerian (kppn)
										$saldo_total_uang_persediaan_pengeluaran += $detil['uang_persediaan'];
										$saldo_total_ls_bendahara_pengeluaran += $detil['ls_bendahara'];
										$saldo_total_pajak_pengeluaran += $detil['pajak'];
										$saldo_total_pengeluaran_lain_pengeluaran += $detil['pengeluaran_lain'];
										
										$sum_saldo_total_bp_pengeluaran = $saldo_total_uang_persediaan_pengeluaran + $saldo_total_ls_bendahara_pengeluaran + $saldo_total_pajak_pengeluaran + $saldo_total_pengeluaran_lain_pengeluaran;
										
										$saldo_total_saldo_pengeluaran += $detil['saldo'];
										$saldo_total_kuitansi_pengeluaran += $detil['kuitansi'];
										
										$sum_saldo_total_up_pengeluaran = $saldo_total_saldo_pengeluaran + $saldo_total_kuitansi_pengeluaran;
										// end of higher level above kementerian (kppn)
										
										// sum of higher level (kementerian)
										$saldo_uang_persediaan_pengeluaran += $detil['uang_persediaan'];
										$saldo_ls_bendahara_pengeluaran += $detil['ls_bendahara'];
										$saldo_pajak_pengeluaran += $detil['pajak'];
										$saldo_pengeluaran_lain_pengeluaran += $detil['pengeluaran_lain'];
										
										$saldo_bp_kementerian_pengeluaran = $saldo_uang_persediaan_pengeluaran + $saldo_ls_bendahara_pengeluaran + $saldo_pajak_pengeluaran + $saldo_pengeluaran_lain_pengeluaran;
										
										$saldo_saldo_pengeluaran += $detil['saldo'];
										$saldo_kuitansi_pengeluaran += $detil['kuitansi'];
										
										$saldo_up_kementerian_pengeluaran = $saldo_saldo_pengeluaran + $saldo_kuitansi_pengeluaran;
										// end of higher level in kementerian

										// sum of saldo kas menurut bp
										$saldo_bp_pengeluaran = $detil['uang_persediaan'] + $detil['ls_bendahara'] + $detil['pajak'] + $detil['pengeluaran_lain'];
										// sum of saldo up
										$saldo_up_pengeluaran = $detil['saldo'] + $detil['kuitansi'];
						?>
										<tr>
											<td></td>
											<td></td>
											<td><?php echo $detil['kd_satker'] . ' ' . $detil['nm_satker']; ?></td>
											<td align="right"><?php echo amount_format($detil['uang_persediaan']); ?></td>
											<td align="right"><?php echo amount_format($detil['ls_bendahara']); ?></td>
											<td align="right"><?php echo amount_format($detil['pajak']); ?></td>
											<td align="right"><?php echo amount_format($detil['pengeluaran_lain']); ?></td>
											<td align="right"><?php echo amount_format($saldo_bp_pengeluaran); ?></td>
											<td align="right"><?php echo amount_format($detil['saldo']); ?></td>
											<td align="right"><?php echo amount_format($detil['kuitansi']); ?></td>
											<td align="right"><?php echo amount_format($saldo_up_pengeluaran); ?></td>
										</tr>
						<?php
									}
						?>
								<tr>
									<td></td>
									<td colspan="2"><strong>JUMLAH <?php echo $kementerian; ?></strong></td>
									<td align="right"><strong><?php echo amount_format($saldo_uang_persediaan_pengeluaran); ?></strong></td>
									<td align="right"><strong><?php echo amount_format($saldo_ls_bendahara_pengeluaran); ?></strong></td>
									<td align="right"><strong><?php echo amount_format($saldo_pajak_pengeluaran); ?></strong></td>
									<td align="right"><strong><?php echo amount_format($saldo_pengeluaran_lain_pengeluaran); ?></strong></td>
									<td align="right"><strong><?php echo amount_format($saldo_bp_kementerian_pengeluaran); ?></strong></td>
									<td align="right"><strong><?php echo amount_format($saldo_saldo_pengeluaran); ?></strong></td>
									<td align="right"><strong><?php echo amount_format($saldo_kuitansi_pengeluaran); ?></strong></td>
									<td align="right"><strong><?php echo amount_format($saldo_up_kementerian_pengeluaran); ?></strong></td>
								</tr>
						<?php
								}
						?>
							<tr>
								<td colspan="3"><strong>JUMLAH TOTAL KPPN <?php echo $kppn; ?></strong></td>
								<td align="right"><strong><?php echo amount_format($saldo_total_uang_persediaan_pengeluaran); ?></strong></td>
								<td align="right"><strong><?php echo amount_format($saldo_total_ls_bendahara_pengeluaran); ?></strong></td>
								<td align="right"><strong><?php echo amount_format($saldo_total_pajak_pengeluaran); ?></strong></td>
								<td align="right"><strong><?php echo amount_format($saldo_total_pengeluaran_lain_pengeluaran); ?></strong></td>
								<td align="right"><strong><?php echo amount_format($sum_saldo_total_bp_pengeluaran); ?></strong></td>
								<td align="right"><strong><?php echo amount_format($saldo_total_saldo_pengeluaran); ?></strong></td>
								<td align="right"><strong><?php echo amount_format($saldo_total_kuitansi_pengeluaran); ?></strong></td>
								<td align="right"><strong><?php echo amount_format($sum_saldo_total_up_pengeluaran); ?></strong></td>
							</tr>
						<?php
							}
						?>
				</tbody>
			</table>
		<?php
	}
	// pdf rekap LPJ Detil Penerimaan Kanwil
	else if (count($detil_kanwil_penerimaan)
		&& $output === 'PDF')
	{
	
	?>
		<div class="content-report">
			<div class="title">
				Detil LPJ Bendahara Penerimaan<br />
				Per Satker Tingkat Wilayah<br />
				Bulan <?php echo get_month_name($month) . ' ' . $year; ?>
			</div>
		</div>
		<br />
		<table border="1" class="content-report">
				<thead>
					<tr class="bgcolor">
						<th rowspan="2">KPPN</th>
						<th rowspan="2">Kementerian</th>
						<th rowspan="2">Satker</th>
						<th colspan="3">Saldo Kas</th>
						<th colspan="4">Saldo Penerimaan dan Penyetoran</th>
					</tr>
					<tr class="bgcolor">
						<th width="9%">
							Kas Tunai
						</th>
						<th width="9%">
							Kas Bank
						</th>
						<th width="9%">Jumlah</th>
						<th width="9%">Saldo Awal</th>
						<th width="9%">Penerimaan</th>
						<th width="9%">Penyetoran</th>
						<th width="9%">Saldo</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					foreach ( $detil_kanwil_penerimaan as $kppn => $groups ) 
					{
				?>
						<tr>
							<td colspan="10"><strong><?php echo $kppn; ?></strong></td>
						</tr>
						
				<?php 
						foreach ($groups as $kementerian => $results ) 
						{
							
							// variable for sum of kementerian
							$saldo_kas_tunai_penerimaan = 0;
							$saldo_kas_bank_penerimaan = 0;
							
							$saldo_saldo_awal_penerimaan = 0;
							$saldo_penerimaan_penerimaan = 0;
							$saldo_penyetoran_penerimaan = 0;
							
							
				?>
						<tr>
							<td></td>
							<td colspan="9"><strong><?php echo $kementerian; ?></strong></td>
						</tr>
				<?php
							
							foreach ($results as $detil) 
							{
								// sum of higher level above kementerian (kppn)
								$saldo_total_kas_tunai_penerimaan += $detil['kas_tunai'];
								$saldo_total_kas_bank_penerimaan += $detil['kas_bank'];
								
								$sum_saldo_total_saldo_kas_penerimaan = $saldo_total_kas_tunai_penerimaan + $saldo_total_kas_bank_penerimaan;
								
								$saldo_total_saldo_awal_penerimaan += $detil['saldo_awal'];
								$saldo_total_penerimaan_penerimaan += $detil['penerimaan'];
								$saldo_total_penyetoran_penerimaan += $detil['penyetoran'];
								
								$sum_saldo_total_penerimaan_penerimaan = $saldo_total_saldo_awal_penerimaan + $saldo_total_penerimaan_penerimaan - $saldo_total_penyetoran_penerimaan;
								// end of higher level above kementerian (kppn)
								
								// sum of higher level (kementerian)
								$saldo_kas_tunai_penerimaan += $detil['kas_tunai'];
								$saldo_kas_bank_penerimaan += $detil['kas_bank'];
								
								$saldo_kas_kementerian_penerimaan = $saldo_kas_tunai_penerimaan + $saldo_kas_bank_penerimaan;
								
								$saldo_saldo_awal_penerimaan += $detil['saldo_awal'];
								$saldo_penerimaan_penerimaan += $detil['penerimaan'];
								$saldo_penyetoran_penerimaan += $detil['penyetoran'];
								
								$saldo_penerimaan_kementerian_penerimaan = $saldo_saldo_awal_penerimaan + $saldo_penerimaan_penerimaan - $saldo_penyetoran_penerimaan;
								// end of higher level in kementerian

								// sum of saldo kas 
								$saldo_kas_penerimaan = $detil['kas_tunai'] + $detil['kas_bank'];
								// sum of saldo penerimaan dan penyetoran
								$saldo_penerimaan_penyetoran_penerimaan = $detil['saldo_awal'] + $detil['penerimaan'] - $detil['penyetoran'];
				?>
								<tr>
									<td></td>
									<td></td>
									<td><?php echo $detil['kd_satker'] . ' ' . $detil['nm_satker']; ?></td>
									<td align="right"><?php echo amount_format($detil['kas_tunai']); ?></td>
									<td align="right"><?php echo amount_format($detil['kas_bank']); ?></td>
									<td align="right"><?php echo amount_format($saldo_kas_penerimaan); ?></td>
									<td align="right"><?php echo amount_format($detil['saldo_awal']); ?></td>
									<td align="right"><?php echo amount_format($detil['penerimaan']); ?></td>
									<td align="right"><?php echo amount_format($detil['penyetoran']); ?></td>
									<td align="right"><?php echo amount_format($saldo_penerimaan_penyetoran_penerimaan); ?></td>
								</tr>
				<?php
							}
				?>
						<tr>
							<td></td>
							<td colspan="2"><strong>JUMLAH <?php echo $kementerian; ?></strong></td>
							<td align="right"><strong><?php echo amount_format($saldo_kas_tunai_penerimaan); ?></strong></td>
							<td align="right"><strong><?php echo amount_format($saldo_kas_bank_penerimaan); ?></strong></td>
							<td align="right"><strong><?php echo amount_format($saldo_kas_kementerian_penerimaan); ?></strong></td>
							<td align="right"><strong><?php echo amount_format($saldo_saldo_awal_penerimaan); ?></strong></td>
							<td align="right"><strong><?php echo amount_format($saldo_penerimaan_penerimaan); ?></strong></td>
							<td align="right"><strong><?php echo amount_format($saldo_penyetoran_penerimaan); ?></strong></td>
							<td align="right"><strong><?php echo amount_format($saldo_penerimaan_kementerian_penerimaan); ?></strong></td>
						</tr>
				<?php
						}
				?>
					<tr class="bgcolor">
						<td colspan="3"><strong>JUMLAH TOTAL KPPN <?php echo $kppn; ?></strong></td>
						<td align="right"><strong><?php echo amount_format($saldo_total_kas_tunai_penerimaan); ?></strong></td>
						<td align="right"><strong><?php echo amount_format($saldo_total_kas_bank_penerimaan); ?></strong></td>
						<td align="right"><strong><?php echo amount_format($sum_saldo_total_saldo_kas_penerimaan); ?></strong></td>
						<td align="right"><strong><?php echo amount_format($saldo_total_saldo_awal_penerimaan); ?></strong></td>
						<td align="right"><strong><?php echo amount_format($saldo_total_penerimaan_penerimaan); ?></strong></td>
						<td align="right"><strong><?php echo amount_format($saldo_total_penyetoran_penerimaan); ?></strong></td>
						<td align="right"><strong><?php echo amount_format($sum_saldo_total_penerimaan_penerimaan); ?></strong></td>
					</tr>
				<?php
					} 
				?>
				</tbody>
			  </table>
		<?php
	}
