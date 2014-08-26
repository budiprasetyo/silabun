	<div class="content-report">
		<div class="title">
			Rekapitulasi LPJ Bendahara Pengeluaran<br />
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
				<th colspan="5">Saldo Kas Menurut Buku Pembantu (BP)</th>
				<th colspan="3">Uang Persediaan</th>
			</tr>
			<tr>
				
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
				$i = 0;
				foreach ($rekap_lpjs as $rekap_lpj) 
				{
			?>
				<tr>
					<td align="center" height="20px"><?php echo ++$i; ?></td>
					<td align="center"><?php echo $rekap_lpj->kd_kementerian; ?></td>
					<td><?php echo $rekap_lpj->kd_satker; ?></td>
					<td align="left"><?php echo ucwords(strtolower($rekap_lpj->nm_satker)); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->uang_persediaan); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->ls_bendahara); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->pajak); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->pengeluaran_lain); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->saldo_kas); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->saldo); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->kuitansi); ?></td>
					<td align="right"><?php echo amount_format($rekap_lpj->saldo_penerimaan); ?></td>
				</tr>
			<?php
				}
			?>
			<tr>
				<th colspan="4">Jumlah</th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->uang_persediaan); ?></th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->ls_bendahara); ?></th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->pajak); ?></th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->pengeluaran_lain); ?></th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->saldo_kas); ?></th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->saldo); ?></th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->kuitansi); ?></th>
				<th align="right"><?php echo amount_format($total_rekap_lpj->saldo_penerimaan); ?></th>
			</tr>
		</tbody>
	</table>
	
	<div id="footer">
		<div id="report">
			<?php echo $pejabat->nm_jabatan; ?>
			<div id="name">
				<?php echo $pejabat->nm_pejabat; ?><br />
				NIP
			</div> 
		</div>
		
	</div>
</body>
</html>
