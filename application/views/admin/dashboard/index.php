 <!--Begin Datatables-->
<div class="row">
  <div class="col-lg-12">
  <!-- Pengeluaran -->
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
	</div><!--/box-->
	<!--/Pengeluaran -->
  
	<!-- Penerimaan -->
	<div class="box">
	  <header>
		<div class="icons">
		  <i class="fa fa-table"></i>
		</div>
		<h5>Rekapitulasi LPJ Bendahara Penerimaan</h5>
	  </header>
      <div id="collapse4" class="body">
		
		<?php if (count($grouped_penerimaan)) { ?>
			<table class="table table-bordered table-condensed table-hover" style="font-size:11px;">
				<thead>
					<tr>
						<th rowspan="2">Tahun</th>
						<th rowspan="2">Kanwil</th>
						<th rowspan="2">Jml<br />LPJ</th>
						<th colspan="3">Saldo Kas</th>
						<th colspan="4">Saldo Penerimaan dan Penyetoran</th>
					</tr>
					<tr>
						<th>Kas Tunai</th>
						<th>Kas Bank</th>
						<th>Jumlah</th>
						<th>Saldo Awal</th>
						<th>Penerimaan</th>
						<th>Penyetoran</th>
						<th>Saldo</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					foreach ( $grouped_penerimaan as $tahun => $groups ) 
					{
						if($tahun !== '')
						{
				?>
					<tr style="font-weight: bold;">
						<td colspan="10"><?php echo $tahun; ?></td>
					</tr>
				<?php 
							foreach ($groups as $bulan => $results) 
							{
				?>
							<tr class="bg-light" style="font-weight: bold;">
								<td></td>
								<td colspan="9"><?php echo strtoupper(get_month_name($bulan)); ?></td>
							</tr>
				<?php
								$jml_lpj_penerimaan_perbulan = 0;
								$jml_kas_tunai_perbulan = 0;
								$jml_kas_bank_perbulan = 0;
								$jml_saldo_awal_perbulan = 0;
								$jml_penerimaan_perbulan = 0;
								$jml_penyetoran_perbulan = 0;
								
								foreach ($results as $kanwil_penerimaan) 
								{
									$saldo_kas_penerimaan = $kanwil_penerimaan['kas_tunai'] + $kanwil_penerimaan['kas_bank'];
									$saldo_penerimaaan_penyetoran = $kanwil_penerimaan['saldo_awal']+$kanwil_penerimaan['penerimaan']-$kanwil_penerimaan['penyetoran'];
									
									$jml_lpj_penerimaan_perbulan 	+= $kanwil_penerimaan['jml_lpj'];
									$jml_kas_tunai_perbulan		 	+= $kanwil_penerimaan['kas_tunai'];
									$jml_kas_bank_perbulan	 		+= $kanwil_penerimaan['kas_bank'];
									$jml_saldo_awal_perbulan		+= $kanwil_penerimaan['saldo_awal'];
									$jml_penerimaan_perbulan 		+= $kanwil_penerimaan['penerimaan'];
									$jml_penyetoran_perbulan 		+= $kanwil_penerimaan['penyetoran'];
									
									$jml_saldo_kas_penerimaan_perbulan 		= $jml_kas_tunai_perbulan + $jml_kas_bank_perbulan;
									$jml_saldo_penyetoran_penerimaan_perbulan	= $jml_saldo_awal_perbulan + $jml_penerimaan_perbulan - $jml_penyetoran_perbulan;
									
				?>
								<tr>
									<td></td>
									<td style="white-space:normal;"><?php echo '(' . $kanwil_penerimaan['kd_kanwil'] . ') ' . $kanwil_penerimaan['nm_kanwil']; ?></td>
									<td align="right"><?php echo amount_format($kanwil_penerimaan['jml_lpj']); ?></td>
									<td align="right"><?php echo amount_format($kanwil_penerimaan['kas_tunai']); ?></td>
									<td align="right"><?php echo amount_format($kanwil_penerimaan['kas_bank']); ?></td>
									<td align="right" class="bg-light dk"><?php echo amount_format($saldo_kas_penerimaan); ?></td>
									<td align="right"><?php echo amount_format($kanwil_penerimaan['saldo_awal']); ?></td>
									<td align="right"><?php echo amount_format($kanwil_penerimaan['penerimaan']); ?></td>
									<td align="right"><?php echo amount_format($kanwil_penerimaan['penyetoran']); ?></td>
									<td align="right" class="bg-light dk"><?php echo amount_format($saldo_penerimaaan_penyetoran); ?></td>
								</tr>
				<?php
								}
				?>
								<tr style="font-weight: bold; font-style: italic;">
									<td></td>
									<td><?php echo 'JUMLAH BULAN ' . strtoupper(get_month_name($bulan)); ?></td>
									<td align="right"><?php echo amount_format($jml_lpj_penerimaan_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kas_tunai_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kas_bank_perbulan); ?></td>
									<td class="bg-light dk" align="right"><?php echo amount_format($jml_saldo_kas_penerimaan_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_saldo_awal_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_penerimaan_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_penyetoran_perbulan); ?></td>
									<td class="bg-light dk" align="right"><?php echo amount_format($jml_saldo_penyetoran_penerimaan_perbulan); ?></td>
								</tr>
				<?php
							}
						}
					}
				?>
					<tr  class="bg-light" style="font-weight: bold;">
						<td colspan="2" align="center">JUMLAH TOTAL</td>
						<td align="right"><?php echo amount_format($jml_lpj_penerimaan); ?></td>
						<td align="right"><?php echo amount_format($jml_kas_tunai); ?></td>
						<td align="right"><?php echo amount_format($jml_kas_bank); ?></td>
						<td align="right"><?php echo amount_format($jml_saldo_kas_penerimaan); ?></td>
						<td align="right"><?php echo amount_format($jml_saldo_awal); ?></td>
						<td align="right"><?php echo amount_format($jml_penerimaan); ?></td>
						<td align="right"><?php echo amount_format($jml_penyetoran); ?></td>
						<td align="right"><?php echo amount_format($jml_saldo_penyetoran_penerimaan); ?></td>
					</tr>
				<?php
				?>
				</tbody>
			</table>
		<?php } ?>
		
	  </div><!--/collapse4-->
	  <?php } ?>
	</div><!--/box-->
	<!--/Penerimaan -->
  </div><!--/col-lg-12-->
</div><!-- /.row -->
<!--End Datatables-->
