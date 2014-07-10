	<div class="content-report">
		<div class="title">
			Rekapitulasi LPJ Bendahara Pengeluaran<br />
			<?php echo $subtitle; ?>
			<br />
			Bulan <?php echo get_month_name($month) . ' ' . $year; ?>
		</div>
	</div>
	<br />
	<table border="1" class="content-report">
		<thead>
			<tr>
				<th rowspan="2" width="2%" class="report">No.</th>
				<th rowspan="2" width="3%">B.A.</th>
				<th rowspan="2" width="14%">Kementerian/<br />Lembaga</th>
				<th rowspan="2" width="2%">Jml.<br />LPJ</th>
				<th colspan="5">Saldo Kas Menurut Buku Pembantu</th>
				<th colspan="3">Uang Persediaan</th>
			</tr>
			<tr>
				<th width="10%">
					BP Uang<br />
					Persediaan
				</th>
				<th width="10%">
					BP<br />
					LS Bendahara
				</th>
				<th width="10%">
					BP<br />
					Pajak
				</th>
				<th width="10%">
					BP<br />
					Lain-Lain
				</th>
				<th width="11%">Jumlah</th>
				<th width="9%">Saldo</th>
				<th width="9%">Kuitansi</th>
				<th width="10%">Jumlah</th>
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
					<td><?php echo ucwords(strtolower($rekap_lpj->nm_kementerian)); ?></td>
					<td align="center"><?php echo amount_format($rekap_lpj->jml_lpj); ?></td>
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
				<th colspan="3">Jumlah</th>
				<th align="center"><?php echo amount_format($total_rekap_lpj->jml_lpj); ?></th>
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
			Kepala Kantor,
			<div id="name">
				Joko Widodo<br />
				NIP
			</div> 
		</div>
		
	</div>
</body>
</html>
