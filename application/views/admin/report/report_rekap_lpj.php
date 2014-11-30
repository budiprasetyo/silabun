<?php 

	// Rekap LPJ Pengeluaran KPPN XLSX
	if (count($rekap_satker)
		&& $output === 'XLSX')
	{
	
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
		
?>
		<h3 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
		<?php echo $nm_entity; ?><br /></h3>
		<h4 class="text-center"><?php echo $period; ?></h4>
		<br />
		<table border="1">
			<thead>
				<tr>
					<th colspan="2">Kode</th>
					<th rowspan="2">Uraian Satker</th>
					<th colspan="5">Saldo Kas Menurut Buku Pembantu (BP)</th>
					<th colspan="3">Uang Persediaan</th>
				</tr>
				<tr>
					
					<th>B.A.</th>
					<th>Satker</th>
					
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
					foreach ($rekap_satker as $kementerian => $groups) 
					{
					?>
						<tr>
							<td colspan="11"><?php echo $kementerian; ?></td>
						</tr>
					<?php
						
						foreach ($groups as $satker) 
						{
							// sum total
							$sum_uang_persediaan 	+= $satker['uang_persediaan'];
							$sum_ls_bendahara 		+= $satker['ls_bendahara'];
							$sum_pajak 				+= $satker['pajak'];
							$sum_pengeluaran_lain 	+= $satker['pengeluaran_lain'];
							$sum_saldo 				+= $satker['saldo'];
							$sum_kuitansi 			+= $satker['kuitansi'];
							
							$sum_saldo_kas_bp = $satker['uang_persediaan'] + $satker['ls_bendahara'] + $satker['pajak'] + $satker['pengeluaran_lain'];
							$sum_saldo_up = $satker['saldo'] + $satker['kuitansi'];
							?>
								<tr>
									<td></td>
									<td>=text(<?php echo $satker['kd_satker']; ?>,"000000")</td>
									<td><?php echo $satker['nm_satker']; ?></td>
									<td><?php echo $satker['uang_persediaan']; ?></td>
									<td><?php echo $satker['ls_bendahara']; ?></td>
									<td><?php echo $satker['pajak']; ?></td>
									<td><?php echo $satker['pengeluaran_lain']; ?></td>
									<td><?php echo $sum_saldo_kas_bp; ?></td>
									<td><?php echo $satker['saldo']; ?></td>
									<td><?php echo $satker['kuitansi']; ?></td>
									<td><?php echo $sum_saldo_up; ?></td>
								</tr>
							<?php
						}
					}
					$sum_total_saldo_kas_bp = $sum_uang_persediaan + $sum_ls_bendahara + $sum_pajak + $sum_pengeluaran_lain;
					$sum_total_saldo_up = $sum_saldo + $sum_kuitansi;
					
					?>
					<tr style="font-weight:bold;">
						<td colspan="3">JUMLAH TOTAL <?php echo strtoupper($nm_entity); ?></td>
						<td><?php echo $sum_uang_persediaan; ?></td>
						<td><?php echo $sum_ls_bendahara; ?></td>
						<td><?php echo $sum_pajak; ?></td>
						<td><?php echo $sum_pengeluaran_lain; ?></td>
						<td><?php echo $sum_total_saldo_kas_bp; ?></td>
						<td><?php echo $sum_saldo; ?></td>
						<td><?php echo $sum_kuitansi; ?></td>
						<td><?php echo $sum_total_saldo_up; ?></td>
					</tr>
			</tbody>
		</table>
<?php 
	}
	// Rekap LPJ Penerimaan KPPN XLSX
	else if (count($rekap_satker_penerimaan)
		&& $output === 'XLSX')
	{
	
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');

?>
		<h3 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
		<?php echo $nm_entity; ?><br /></h3>
		<h4><?php echo $period; ?></h4>
		<br />
		
		<table border="1">
			<thead>
				<tr>
					<th colspan="2">Kode</th>
					<th rowspan="2">Uraian Satker</th>
					<th colspan="3">Saldo Kas</th>
					<th colspan="4">Saldo Penerimaan dan Penyetoran</th>
				</tr>
				<tr>
					
					<th>B.A.</th>
					<th>Satker</th>
					
					<th>
						Kas Tunai
					</th>
					<th>
						Kas Bank
					</th>
					<th>
						Jumlah
					</th>
					<th>
						Saldo Awal
					</th>
					<th>Penerimaan</th>
					<th>Penyetoran</th>
					<th>Saldo</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($rekap_satker_penerimaan as $kementerian => $groups) 
					{
					?>
						<tr>
							<td colspan="10"><?php echo $kementerian; ?></td>
						</tr>
						
					<?php
						foreach ($groups as $satker) 
						{
							// sum total
							$sum_kas_tunai 	+= $satker['kas_tunai'];
							$sum_kas_bank 	+= $satker['kas_bank'];
							$sum_saldo_awal	+= $satker['saldo_awal'];
							$sum_penerimaan += $satker['penerimaan'];
							$sum_penyetoran	+= $satker['penyetoran'];
							
							$sum_saldo_kas_penerimaan = $satker['kas_tunai'] + $satker['kas_bank'];
							$sum_saldo_penerimaan_setor = $satker['saldo_awal'] + $satker['penerimaan'] - $satker['penyetoran'];
							
							?>
								
								<tr>
									<td></td>
									<td>=text(<?php echo $satker['kd_satker']; ?>,"000000")</td>
									<td><?php echo $satker['nm_satker']; ?></td>
									<td><?php echo $satker['kas_tunai']; ?></td>
									<td><?php echo $satker['kas_bank']; ?></td>
									<td><?php echo $sum_saldo_kas_penerimaan; ?></td>
									<td><?php echo $satker['saldo_awal']; ?></td>
									<td><?php echo $satker['penerimaan']; ?></td>
									<td><?php echo $satker['penyetoran']; ?></td>
									<td><?php echo $sum_saldo_penerimaan_setor; ?></td>
								</tr>
								
							<?php
						
						}
					}
					
					$sum_total_saldo_kas_penerimaan = $sum_kas_tunai + $sum_kas_bank;
					$sum_total_saldo_penerimaan_setor = $sum_saldo_awal + $sum_penerimaan - $sum_penyetoran;
					
					?>
					
					<tr>
						<td colspan="3">JUMLAH TOTAL <?php echo strtoupper($nm_entity); ?></td>
						<td><?php echo $sum_kas_tunai; ?></td>
						<td><?php echo $sum_kas_bank; ?></td>
						<td><?php echo $sum_total_saldo_kas_penerimaan; ?></td>
						<td><?php echo $sum_saldo_awal; ?></td>
						<td><?php echo $sum_penerimaan; ?></td>
						<td><?php echo $sum_penyetoran; ?></td>
						<td><?php echo $sum_total_saldo_penerimaan_setor; ?></td>
					</tr>
			</tbody>
		  </table>
<?php
	}
	// Rekap LPJ Pengeluaran KPPN PDF
	else if (count($rekap_satker)
		&& $output === 'PDF')
	{
		
?>
		<div class="content-report">
			<div class="title">
				Rekapitulasi LPJ Bendahara Pengeluaran<br />
				Bulan <?php echo get_month_name($month) . ' ' . $year; ?>
			</div>
		</div>
		<br />
		<table border="1" class="content-report">
			<thead>
				<tr class="bgcolor">
					<th colspan="2">Kode</th>
					<th rowspan="2" width="20%">Uraian Satker</th>
					<th colspan="5">Saldo Kas Menurut Buku Pembantu (BP)</th>
					<th colspan="3">Uang Persediaan</th>
				</tr>
				<tr class="bgcolor">
					
					<th width="2%">B.A.</th>
					<th width="3%">Satker</th>
					
					<th width="9%">
						BP Uang<br />
						Persediaan
					</th>
					<th width="9%">
						BP<br />
						LS Bendahara
					</th>
					<th width="9%">
						BP<br />
						Pajak
					</th>
					<th width="9%">
						BP<br />
						Lain-Lain
					</th>
					<th width="10%">Jumlah</th>
					<th width="9%">Saldo</th>
					<th width="9%">Kuitansi</th>
					<th width="9%">Jumlah</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($rekap_satker as $kementerian => $groups) 
					{
					?>
						<tr>
							<td colspan="3" style="font-weight:bold;"><?php echo $kementerian; ?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					<?php
						
						foreach ($groups as $satker) 
						{
							// sum total
							$sum_uang_persediaan 	+= $satker['uang_persediaan'];
							$sum_ls_bendahara 		+= $satker['ls_bendahara'];
							$sum_pajak 				+= $satker['pajak'];
							$sum_pengeluaran_lain 	+= $satker['pengeluaran_lain'];
							$sum_saldo 				+= $satker['saldo'];
							$sum_kuitansi 			+= $satker['kuitansi'];
							
							$sum_saldo_kas_bp = $satker['uang_persediaan'] + $satker['ls_bendahara'] + $satker['pajak'] + $satker['pengeluaran_lain'];
							$sum_saldo_up = $satker['saldo'] + $satker['kuitansi'];
							?>
								<tr>
									<td></td>
									<td><?php echo $satker['kd_satker']; ?></td>
									<td><?php echo $satker['nm_satker']; ?></td>
									<td align="right"><?php echo amount_format($satker['uang_persediaan']); ?></td>
									<td align="right"><?php echo amount_format($satker['ls_bendahara']); ?></td>
									<td align="right"><?php echo amount_format($satker['pajak']); ?></td>
									<td align="right"><?php echo amount_format($satker['pengeluaran_lain']); ?></td>
									<td align="right"><?php echo amount_format($sum_saldo_kas_bp); ?></td>
									<td align="right"><?php echo amount_format($satker['saldo']); ?></td>
									<td align="right"><?php echo amount_format($satker['kuitansi']); ?></td>
									<td align="right"><?php echo amount_format($sum_saldo_up); ?></td>
								</tr>
							<?php
						}
					}
					$sum_total_saldo_kas_bp = $sum_uang_persediaan + $sum_ls_bendahara + $sum_pajak + $sum_pengeluaran_lain;
					$sum_total_saldo_up = $sum_saldo + $sum_kuitansi;
					
					?>
					<tr class="bgcolor">
						<th colspan="3">JUMLAH</th>
						<th align="right"><?php echo amount_format($sum_uang_persediaan); ?></th>
						<th align="right"><?php echo amount_format($sum_ls_bendahara); ?></th>
						<th align="right"><?php echo amount_format($sum_pajak); ?></th>
						<th align="right"><?php echo amount_format($sum_pengeluaran_lain); ?></th>
						<th align="right"><?php echo amount_format($sum_total_saldo_kas_bp); ?></th>
						<th align="right"><?php echo amount_format($sum_saldo); ?></th>
						<th align="right"><?php echo amount_format($sum_kuitansi); ?></th>
						<th align="right"><?php echo amount_format($sum_total_saldo_up); ?></th>
					</tr>
			</tbody>
		</table>
		
		<div id="footer">
			<div id="report">
				<?php echo $pejabat->nm_jabatan; ?>
				<div id="name">
					<?php echo $pejabat->nm_pejabat; ?><br />
					NIP <?php echo $pejabat->nip_pejabat; ?>
				</div> 
			</div>
			
		</div>
<?php
	}
	// Rekap LPJ Penerimaan KPPN PDF
	else if (count($rekap_satker_penerimaan)
		&& $output === 'PDF')
	{
?>
		<div class="content-report">
		<div class="title">
			Rekapitulasi LPJ Bendahara Penerimaan<br />
			Bulan <?php echo get_month_name($month) . ' ' . $year; ?>
		</div>
		</div>
		<br />
		<table border="1" class="content-report">
			<thead>
				<tr class="bgcolor">
					<th colspan="2">Kode</th>
					<th rowspan="2" width="20%">Uraian Satker</th>
					<th colspan="3">Saldo Kas</th>
					<th colspan="4">Saldo Penerimaan dan Penyetoran</th>
				</tr>
				<tr class="bgcolor">
					
					<th width="2%">B.A.</th>
					<th width="3%">Satker</th>
					
					<th width="10%">
						Kas Tunai
					</th>
					<th width="10%">
						Kas Bank
					</th>
					<th width="10%">Jumlah</th>
					<th width="10%">Saldo Awal</th>
					<th width="10%">Penerimaan</th>
					<th width="10%">Penyetoran</th>
					<th width="10%">Saldo</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				foreach ($rekap_satker_penerimaan as $kementerian => $groups) 
				{
				?>
					<tr>
						<td colspan="3" style="font-weight:bold;"><?php echo $kementerian; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
					
				<?php
					foreach ($groups as $satker) 
					{
						// sum total
						$sum_kas_tunai 	+= $satker['kas_tunai'];
						$sum_kas_bank 	+= $satker['kas_bank'];
						$sum_saldo_awal	+= $satker['saldo_awal'];
						$sum_penerimaan += $satker['penerimaan'];
						$sum_penyetoran	+= $satker['penyetoran'];
						
						$sum_saldo_kas_penerimaan = $satker['kas_tunai'] + $satker['kas_bank'];
						$sum_saldo_penerimaan_setor = $satker['saldo_awal'] + $satker['penerimaan'] - $satker['penyetoran'];
						
						?>
							
							<tr style="font-size:11px;">
								<td></td>
								<td><?php echo $satker['kd_satker']; ?></td>
								<td style='white-space:normal;'><?php echo $satker['nm_satker']; ?></td>
								<td align="right"><?php echo amount_format($satker['kas_tunai']); ?></td>
								<td align="right"><?php echo amount_format($satker['kas_bank']); ?></td>
								<td align="right" style="font-weight:bold;"><?php echo amount_format($sum_saldo_kas_penerimaan); ?></td>
								<td align="right"><?php echo amount_format($satker['saldo_awal']); ?></td>
								<td align="right"><?php echo amount_format($satker['penerimaan']); ?></td>
								<td align="right"><?php echo amount_format($satker['penyetoran']); ?></td>
								<td align="right" style="font-weight:bold;"><?php echo amount_format($sum_saldo_penerimaan_setor); ?></td>
							</tr>
							
						<?php
					
					}
				}
				
				$sum_total_saldo_kas_penerimaan = $sum_kas_tunai + $sum_kas_bank;
				$sum_total_saldo_penerimaan_setor = $sum_saldo_awal + $sum_penerimaan - $sum_penyetoran;
				
				?>
				
				<tr class="bgcolor">
					<th colspan="3" style="white-space:normal;">JUMLAH</th>
					<th align="right"><?php echo amount_format($sum_kas_tunai); ?></th>
					<th align="right"><?php echo amount_format($sum_kas_bank); ?></th>
					<th align="right"><?php echo amount_format($sum_total_saldo_kas_penerimaan); ?></th>
					<th align="right"><?php echo amount_format($sum_saldo_awal); ?></th>
					<th align="right"><?php echo amount_format($sum_penerimaan); ?></th>
					<th align="right"><?php echo amount_format($sum_penyetoran); ?></th>
					<th align="right"><?php echo amount_format($sum_total_saldo_penerimaan_setor); ?></th>
				</tr>
		</tbody>
	  </table>
	  
		<div id="footer">
			<div id="report">
				<?php echo $pejabat->nm_jabatan; ?>
				<div id="name">
					<?php echo $pejabat->nm_pejabat; ?><br />
					NIP <?php echo $pejabat->nip_pejabat; ?>
				</div> 
			</div>
			
		</div>
<?php
	}
	// xls rekap pengeluaran kanwil & pkn
	else if (count($rekap_lpjs)
		&& $output === 'XLSX')
	{
	
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
		
		?>
		<h3 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
		<?php if($id_entities === '2') { echo $nm_entity; } ?><br /></h3>
		<h4><?php echo $period; ?></h4>
		<br />
		<table border="1">
			<thead style="font-size:11px;">
				<tr class="bg-light lter">
					<th rowspan="2">B.A.</th>
					<th rowspan="2">Kementerian/<br />Lembaga</th>
					<th rowspan="2">Jml.<br />LPJ</th>
					<th colspan="5">Saldo Kas Menurut Buku Pembantu</th>
					<th colspan="3">Uang Persediaan</th>
				</tr>
				<tr class="bg-light lter">
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
				foreach ($rekap_lpjs as $rekap_lpj) 
				{
					// total sum
					$sum_total_jml_lpj += $rekap_lpj->jml_lpj;
					$sum_total_uang_persediaan += $rekap_lpj->uang_persediaan;
					$sum_total_ls_bendahara += $rekap_lpj->ls_bendahara;
					$sum_total_pajak += $rekap_lpj->pajak;
					$sum_total_pengeluaran_lain += $rekap_lpj->pengeluaran_lain;
					$sum_total_saldo += $rekap_lpj->saldo;
					$sum_total_kuitansi += $rekap_lpj->kuitansi;
					
					$sum_total_saldo_kas_bp = $sum_total_uang_persediaan + $sum_total_ls_bendahara + $sum_total_pajak + $sum_total_pengeluaran_lain;
					$sum_total_saldo_up = $sum_total_saldo + $sum_total_kuitansi;
					
					$saldo_kas = $rekap_lpj->uang_persediaan + $rekap_lpj->ls_bendahara + $rekap_lpj->pajak + $rekap_lpj->pengeluaran_lain;
					$saldo_penerimaan = $rekap_lpj->saldo + $rekap_lpj->kuitansi;
			?>
				<tr>
					<td><?php echo $rekap_lpj->kd_kementerian; ?></td>
					<td><?php echo ucwords(strtolower($rekap_lpj->nm_kementerian)); ?></td>
					<td><?php echo $rekap_lpj->jml_lpj; ?></td>
					<td><?php echo $rekap_lpj->uang_persediaan; ?></td>
					<td><?php echo $rekap_lpj->ls_bendahara; ?></td>
					<td><?php echo $rekap_lpj->pajak; ?></td>
					<td><?php echo $rekap_lpj->pengeluaran_lain; ?></td>
					<td><?php echo $saldo_kas; ?></td>
					<td><?php echo $rekap_lpj->saldo; ?></td>
					<td><?php echo $rekap_lpj->kuitansi; ?></td>
					<td><?php echo $saldo_penerimaan; ?></td>
				</tr>
			<?php
				}
			?>
			<tr>
				<td colspan="2">Jumlah</td>
				<td><?php echo $sum_total_jml_lpj; ?></td>
				<td><?php echo $sum_total_uang_persediaan; ?></td>
				<td><?php echo $sum_total_ls_bendahara; ?></td>
				<td><?php echo $sum_total_pajak; ?></td>
				<td><?php echo $sum_total_pengeluaran_lain; ?></td>
				<td><?php echo $sum_total_saldo_kas_bp; ?></td>
				<td><?php echo $sum_total_saldo; ?></td>
				<td><?php echo $sum_total_kuitansi; ?></td>
				<td><?php echo $sum_total_saldo_up; ?></td>
			</tr>
		</tbody>
		</table>
		<?php
	}
	// xls rekap penerimaan kanwil
	else if ( count($rekap_penerimaan_lpjs)
		&& $output === 'XLSX')
	{
	
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
		
	?>
		<h3 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
		<?php if($id_entities === '2') { echo $nm_entity; } ?><br /></h3>
		<h4><?php echo $period; ?></h4>
		<br />
		<!-- table -->
		<table border="1">
			<thead>
				<tr>
					<th rowspan="2">B.A.</th>
					<th rowspan="2">Kementerian/<br />Lembaga</th>
					<th rowspan="2">Jml.<br />LPJ</th>
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
					<th>Penyetoran ke Kas Negara</th>
					<th>Saldo</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($rekap_penerimaan_lpjs as $rekap_lpj) 
					{
						// total sum
						$sum_total_jml_lpj += $rekap_lpj->jml_lpj;
						$sum_total_kas_tunai += $rekap_lpj->kas_tunai;
						$sum_total_kas_bank += $rekap_lpj->kas_bank;
						$sum_total_saldo_awal += $rekap_lpj->saldo_awal;
						$sum_total_penerimaan += $rekap_lpj->penerimaan;
						$sum_total_penyetoran += $rekap_lpj->penyetoran;
						
						$sum_total_saldo_kas = $sum_total_kas_tunai + $sum_total_kas_bank;
						$sum_total_saldo_penerimaan_setor = $sum_total_saldo_awal + $sum_total_penerimaan - $sum_total_penyetoran;
						
						$saldo_kas = $rekap_lpj->kas_tunai + $rekap_lpj->kas_bank;
						$saldo_penerimaan_setor = $rekap_lpj->saldo_awal + $rekap_lpj->penerimaan - $rekap_lpj->penyetoran;
				?>
					<tr>
						<td><?php echo $rekap_lpj->kd_kementerian; ?></td>
						<td><?php echo ucwords(strtolower($rekap_lpj->nm_kementerian)); ?></td>
						<td><?php echo $rekap_lpj->jml_lpj; ?></td>
						<td><?php echo $rekap_lpj->kas_tunai; ?></td>
						<td><?php echo $rekap_lpj->kas_bank; ?></td>
						<td><?php echo $saldo_kas; ?></td>
						<td><?php echo $rekap_lpj->saldo_awal; ?></td>
						<td><?php echo $rekap_lpj->penerimaan; ?></td>
						<td><?php echo $rekap_lpj->penyetoran; ?></td>
						<td><?php echo $saldo_penerimaan_setor; ?></td>
					</tr>
				<?php
					}
				?>
				<tr>
					<td colspan="2">Jumlah</td>
					<td><?php echo $sum_total_jml_lpj; ?></td>
					<td><?php echo $sum_total_kas_tunai; ?></td>
					<td><?php echo $sum_total_kas_bank; ?></td>
					<td><?php echo $sum_total_saldo_kas; ?></td>
					<td><?php echo $sum_total_saldo_awal; ?></td>
					<td><?php echo $sum_total_penerimaan; ?></td>
					<td><?php echo $sum_total_penyetoran; ?></td>
					<td><?php echo $sum_total_saldo_penerimaan_setor; ?></td>
				</tr>
			</tbody>
		</table>
	<?php
	}
	// pdf rekap LPJ Pengeluaran kanwil
	else if (count($rekap_lpjs)
		&& $output === 'PDF')
	{
		
	?>
		<div class="content-report">
			<div class="title">
				<?php echo ucwords($subtitle); ?><br />
				<?php echo $period; ?>
			</div>
		</div>
		<br />
			<table border="1" class="content-report">
			<thead>
				<tr class="bgcolor">
					<th rowspan="2">B.A.</th>
					<th rowspan="2" width="30%">Kementerian/<br />Lembaga</th>
					<th rowspan="2">Jml.<br />LPJ</th>
					<th colspan="5">Saldo Kas Menurut Buku Pembantu</th>
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
				foreach ($rekap_lpjs as $rekap_lpj) 
				{
					// total sum
					$sum_total_jml_lpj += $rekap_lpj->jml_lpj;
					$sum_total_uang_persediaan += $rekap_lpj->uang_persediaan;
					$sum_total_ls_bendahara += $rekap_lpj->ls_bendahara;
					$sum_total_pajak += $rekap_lpj->pajak;
					$sum_total_pengeluaran_lain += $rekap_lpj->pengeluaran_lain;
					$sum_total_saldo += $rekap_lpj->saldo;
					$sum_total_kuitansi += $rekap_lpj->kuitansi;
					
					$sum_total_saldo_kas_bp = $sum_total_uang_persediaan + $sum_total_ls_bendahara + $sum_total_pajak + $sum_total_pengeluaran_lain;
					$sum_total_saldo_up = $sum_total_saldo + $sum_total_kuitansi;
					
					$saldo_kas = $rekap_lpj->uang_persediaan + $rekap_lpj->ls_bendahara + $rekap_lpj->pajak + $rekap_lpj->pengeluaran_lain;
					$saldo_penerimaan = $rekap_lpj->saldo + $rekap_lpj->kuitansi;
			?>
				<tr>
					<td align="center"><?php echo $rekap_lpj->kd_kementerian; ?></td>
					<td><?php echo ucwords(strtolower($rekap_lpj->nm_kementerian)); ?></td>
					<td align="center"><?php echo amount_format($rekap_lpj->jml_lpj); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->uang_persediaan); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->ls_bendahara); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->pajak); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->pengeluaran_lain); ?></td>
					<td align="right"><?php echo amount_format($saldo_kas); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->saldo); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->kuitansi); ?></td>
					<td align="right"><?php echo amount_format($saldo_penerimaan); ?></td>
				</tr>
			<?php
				}
			?>
				<tr class="bgcolor">
					<th colspan="2">Jumlah</td>
					<th	><?php echo amount_format($sum_total_jml_lpj); ?></th>
					<th><?php echo amount_format($sum_total_uang_persediaan); ?></th>
					<th><?php echo amount_format($sum_total_ls_bendahara); ?></th>
					<th><?php echo amount_format($sum_total_pajak); ?></th>
					<th><?php echo amount_format($sum_total_pengeluaran_lain); ?></th>
					<th><?php echo amount_format($sum_total_saldo_kas_bp); ?></th>
					<th><?php echo amount_format($sum_total_saldo); ?></th>
					<th><?php echo amount_format($sum_total_kuitansi); ?></th>
					<th><?php echo amount_format($sum_total_saldo_up); ?></th>
				</tr>
			</tbody>
			</table>
			
			<div id="footer">
				<div id="report">
					<?php echo $pejabat->nm_jabatan; ?>
					<div id="name">
						<?php echo $pejabat->nm_pejabat; ?><br />
						NIP <?php echo $pejabat->nip_pejabat; ?>
					</div> 
				</div>
				
			</div>
			<?php
	}
	// pdf rekap LPJ Penerimaan kanwil
	else if (count($rekap_penerimaan_lpjs)
		&& $output === 'PDF')
	{
		
		?>
		<div class="content-report">
			<div class="title">
				<?php echo ucwords($subtitle); ?><br />
				<?php echo $period; ?>
			</div>
		</div>
		<br />
		<!-- table -->
		<table border="1" class="content-report">
			<thead>
				<tr class="bgcolor">
					<th rowspan="2">B.A.</th>
					<th rowspan="2" width="30%">Kementerian/<br />Lembaga</th>
					<th rowspan="2">Jml.<br />LPJ</th>
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
					<th width="9%">Penyetoran ke Kas Negara</th>
					<th width="9%">Saldo</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($rekap_penerimaan_lpjs as $rekap_lpj) 
					{
						// total sum
						$sum_total_jml_lpj += $rekap_lpj->jml_lpj;
						$sum_total_kas_tunai += $rekap_lpj->kas_tunai;
						$sum_total_kas_bank += $rekap_lpj->kas_bank;
						$sum_total_saldo_awal += $rekap_lpj->saldo_awal;
						$sum_total_penerimaan += $rekap_lpj->penerimaan;
						$sum_total_penyetoran += $rekap_lpj->penyetoran;
						
						$sum_total_saldo_kas = $sum_total_kas_tunai + $sum_total_kas_bank;
						$sum_total_saldo_penerimaan_setor = $sum_total_saldo_awal + $sum_total_penerimaan - $sum_total_penyetoran;
						
						$saldo_kas = $rekap_lpj->kas_tunai + $rekap_lpj->kas_bank;
						$saldo_penerimaan_setor = $rekap_lpj->saldo_awal + $rekap_lpj->penerimaan - $rekap_lpj->penyetoran;
				?>
					<tr>
						<td align="center"><?php echo $rekap_lpj->kd_kementerian; ?></td>
						<td><?php echo ucwords(strtolower($rekap_lpj->nm_kementerian)); ?></td>
						<td align="center"><?php echo amount_format($rekap_lpj->jml_lpj); ?></td>
						<td align="right"><?php echo amount_format($rekap_lpj->kas_tunai); ?></td>
						<td align="right"><?php echo amount_format($rekap_lpj->kas_bank); ?></td>
						<td align="right"><?php echo amount_format($saldo_kas); ?></td>
						<td align="right"><?php echo amount_format($rekap_lpj->saldo_awal); ?></td>
						<td align="right"><?php echo amount_format($rekap_lpj->penerimaan); ?></td>
						<td align="right"><?php echo amount_format($rekap_lpj->penyetoran); ?></td>
						<td align="right"><?php echo amount_format($saldo_penerimaan_setor); ?></td>
					</tr>
				<?php
					}
				?>
				<tr class="bgcolor">
					<th colspan="2">Jumlah</td>
					<th align="center"><?php echo amount_format($sum_total_jml_lpj); ?></th>
					<th align="right"><?php echo amount_format($sum_total_kas_tunai); ?></th>
					<th align="right"><?php echo amount_format($sum_total_kas_bank); ?></th>
					<th align="right"><?php echo amount_format($sum_total_saldo_kas); ?></th>
					<th align="right"><?php echo amount_format($sum_total_saldo_awal); ?></th>
					<th align="right"><?php echo amount_format($sum_total_penerimaan); ?></th>
					<th align="right"><?php echo amount_format($sum_total_penyetoran); ?></th>
					<th align="right"><?php echo amount_format($sum_total_saldo_penerimaan_setor); ?></td>
				</tr>
			</tbody>
		</table>
		
		<div id="footer">
			<div id="report">
				<?php echo $pejabat->nm_jabatan; ?>
				<div id="name">
					<?php echo $pejabat->nm_pejabat; ?><br />
					NIP <?php echo $pejabat->nip_pejabat; ?>
				</div> 
			</div>
			
		</div>
	<?php
	}
	?>
