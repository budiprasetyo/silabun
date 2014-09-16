	<div class="content-report">
		<div class="title">
			Rekapitulasi LPJ Bendahara Penerimaan<br />
			Bulan <?php echo get_month_name($month) . ' ' . $year; ?>
		</div>
	</div>
	<br />
	<table border="1" class="content-report">
		<thead>
			<tr>
				<th rowspan="2" width="2%" class="report">No.</th>
				<th colspan="2">Kode</th>
				<th rowspan="2" width="20%">Uraian Satker</th>
				<th colspan="3">Saldo Kas</th>
				<th colspan="4">Saldo Penerimaan dan Penyetoran</th>
			</tr>
			<tr>
				
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
				$i = 0;
				foreach ($rekap_lpjs as $rekap_lpj) 
				{
					$saldo_kas = $rekap_lpj->kas_tunai + $rekap_lpj->kas_bank;
					$saldo_penerimaan = $rekap_lpj->saldo_awal + $rekap_lpj->penerimaan - $rekap_lpj->penyetoran;
			?>
				<tr>
					<td align="center" height="20px"><?php echo ++$i; ?></td>
					<td align="center"><?php echo $rekap_lpj->kd_kementerian; ?></td>
					<td><?php echo $rekap_lpj->kd_satker; ?></td>
					<td align="left"><?php echo ucwords(strtolower($rekap_lpj->nm_satker)); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->kas_tunai); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->kas_bank); ?></td>
					<td align="right"><?php echo amount_format($saldo_kas); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->saldo_awal); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->penerimaan); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->penyetoran); ?></td>
					<td align="right"><?php echo amount_format($saldo_penerimaan); ?></td>
				</tr>
			<?php
				}
				
					$saldo_kas = $total_rekap_lpj->kas_tunai + $total_rekap_lpj->kas_bank;
					$saldo_penerimaan = $total_rekap_lpj->saldo_awal + $total_rekap_lpj->penerimaan - $total_rekap_lpj->penyetoran;
			?>
			<tr>
				<th colspan="4">Jumlah</th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->kas_tunai); ?></th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->kas_bank); ?></th>
				<th align="right"><?php echo amount_format($saldo_kas); ?></th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->saldo_awal); ?></th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->penerimaan); ?></th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->penyetoran); ?></th>
				<th align="right"><?php echo amount_format($saldo_penerimaan); ?></th>
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
</body>
</html>
