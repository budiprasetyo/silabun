 <!--Begin Datatables-->
<div class="row">
  <div class="col-lg-12">
	<div class="box">
	<?php if($id_entities === '3') { ?>
	  <header>
		<div class="icons">
		  <i class="fa fa-table"></i>
		</div>
		<h5>Rekapitulasi LPJ Bendahara Pengeluaran</h5>
	  </header>
      <div id="collapse4" class="body">
		
		<?php if (count($grouped)) { ?>
			<table class="table table-bordered table-condensed table-hover" style="font-size:10px;">
				<thead>
					<tr>
						<th rowspan="2">Tahun</th>
						<th rowspan="2">Kanwil</th>
						<th rowspan="2">Jml<br />LPJ</th>
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
					foreach ( $grouped as $tahun => $groups ) 
					{
						if($tahun !== '')
						{
				?>
					<tr style="font-weight: bold;">
						<td colspan="11"><?php echo $tahun; ?></td>
					</tr>
				<?php 
							foreach ($groups as $bulan => $results) 
							{
				?>
							<tr class="bg-light" style="font-weight: bold;">
								<td></td>
								<td colspan="10"><?php echo strtoupper(get_month_name($bulan)); ?></td>
							</tr>
				<?php
								$jml_lpj_perbulan = 0;
								$jml_uang_persediaan_perbulan = 0;
								$jml_ls_bendahara_perbulan = 0;
								$jml_pajak_perbulan = 0;
								$jml_pengeluaran_lain_perbulan = 0;
								$jml_saldo_perbulan = 0;
								$jml_kuitansi_perbulan = 0;
								
								foreach ($results as $kanwil) 
								{
									$saldo_kas = $kanwil['uang_persediaan'] +$kanwil['ls_bendahara'] +$kanwil['pajak'] +$kanwil['pengeluaran_lain'];
									$uang_persediaan = $kanwil['saldo'] + $kanwil['kuitansi'];
									
									$jml_lpj_perbulan 				+= $kanwil['jml_lpj'];
									$jml_uang_persediaan_perbulan 	+= $kanwil['uang_persediaan'];
									$jml_ls_bendahara_perbulan 		+= $kanwil['ls_bendahara'];
									$jml_pajak_perbulan 			+= $kanwil['pajak'];
									$jml_pengeluaran_lain_perbulan 	+= $kanwil['pengeluaran_lain'];
									$jml_saldo_perbulan 			+= $kanwil['saldo'];
									$jml_kuitansi_perbulan 			+= $kanwil['kuitansi'];
									
									$jml_saldo_kas_perbulan 		= $jml_uang_persediaan_perbulan + $jml_ls_bendahara_perbulan + $jml_pajak_perbulan + $jml_pengeluaran_lain_perbulan;
									$jml_saldo_up_perbulan			= $jml_saldo_perbulan + $jml_kuitansi_perbulan;
									
				?>
								<tr>
									<td></td>
									<td style="white-space:normal;"><?php echo '(' . $kanwil['kd_kanwil'] . ') ' . $kanwil['nm_kanwil']; ?></td>
									<td align="right"><?php echo amount_format($kanwil['jml_lpj']); ?></td>
									<td align="right"><?php echo amount_format($kanwil['uang_persediaan']); ?></td>
									<td align="right"><?php echo amount_format($kanwil['ls_bendahara']); ?></td>
									<td align="right"><?php echo amount_format($kanwil['pajak']); ?></td>
									<td align="right"><?php echo amount_format($kanwil['pengeluaran_lain']); ?></td>
									<td align="right" class="bg-light dk"><?php echo amount_format($saldo_kas); ?></td>
									<td align="right"><?php echo amount_format($kanwil['saldo']); ?></td>
									<td align="right"><?php echo amount_format($kanwil['kuitansi']); ?></td>
									<td align="right" class="bg-light dk"><?php echo amount_format($uang_persediaan); ?></td>
								</tr>
				<?php
								}
				?>
								<tr style="font-weight: bold; font-style: italic;">
									<td></td>
									<td><?php echo 'JUMLAH BULAN ' . strtoupper(get_month_name($bulan)); ?></td>
									<td align="right"><?php echo amount_format($jml_lpj_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_uang_persediaan_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_ls_bendahara_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_pajak_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_pengeluaran_lain_perbulan); ?></td>
									<td class="bg-light dk" align="right"><?php echo amount_format($jml_saldo_kas_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_saldo_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kuitansi_perbulan); ?></td>
									<td class="bg-light dk" align="right"><?php echo amount_format($jml_saldo_up_perbulan); ?></td>
								</tr>
				<?php
							}
						}
					}
				?>
					<tr  class="bg-light" style="font-weight: bold;">
						<td colspan="2" align="center">JUMLAH TOTAL</td>
						<td align="right"><?php echo amount_format($jml_lpj); ?></td>
						<td align="right"><?php echo amount_format($jml_uang_persediaan); ?></td>
						<td align="right"><?php echo amount_format($jml_ls_bendahara); ?></td>
						<td align="right"><?php echo amount_format($jml_pajak); ?></td>
						<td align="right"><?php echo amount_format($jml_pengeluaran_lain); ?></td>
						<td align="right"><?php echo amount_format($jml_saldo_kas); ?></td>
						<td align="right"><?php echo amount_format($jml_saldo); ?></td>
						<td align="right"><?php echo amount_format($jml_kuitansi); ?></td>
						<td align="right"><?php echo amount_format($jml_saldo_up); ?></td>
					</tr>
				<?php
				?>
				</tbody>
			</table>
		<?php } ?>
		
	  </div><!--/collapse4-->
	  <?php } ?>
	</div><!--/box-->
  </div><!--/col-lg-12-->
</div><!-- /.row -->
<!--End Datatables-->
