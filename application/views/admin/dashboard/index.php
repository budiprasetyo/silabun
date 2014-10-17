 <!--Begin Datatables-->
<div class="row">

  <div class="col-lg-12">
  
	<div class="box">
	  <header>
		  <div class="form-group">
				<label for="text3" class="control-label col-lg-12 bg-red"><h4>Dashboard LPJ Pengeluaran</h4></label>
		  </div>
	  </header>
	</div><!--/box -->
	
	<div class="box">
	  <header>
		<h5>Pengiriman LPJ Pengeluaran</h5>
	  </header>
	  <div class="body" id="trigo" style="height: 250px;"></div>
	</div><!--/box -->
	
	<div class="text-center">
	  <ul class="stats_box">
		<!-- uang persediaan -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped)) 
			{
				foreach ( $grouped as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_uang_persediaan_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_uang_persediaan_chart_perbulan += $chart['uang_persediaan'];
							}
							// data up every month
							echo $jml_uang_persediaan_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_uang_persediaan); ?></strong> BP <br />Uang Persediaan
				<?php 
					if (count($grouped)) 
					{
						foreach ( $grouped as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_uang_persediaan_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_uang_persediaan_chart_perbulan += $chart['uang_persediaan'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_up = $jml_uang_persediaan_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_up = $jml_uang_persediaan_chart_perbulan;
										// calculation for getting percentation
										$percent_up = (($last_up - $before_last_up) / $before_last_up) * 100;
										if ($percent_up > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_up, 2);
				?>
											%
											</span> 
				<?php
										}
										else {
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_up, 2);
				?>
											%
											</span> 
				<?php
										}
										
										
									}
										
									$i++;
								}
							}
						}
					}
				?>
		  </div>
		</li>
		
		<!-- ls bendahara -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped)) 
			{
				foreach ( $grouped as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_ls_bendahara_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_ls_bendahara_chart_perbulan += $chart['ls_bendahara'];
							}
							// data up every month
							echo $jml_ls_bendahara_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_ls_bendahara); ?></strong> BP <br />LS Bendahara
				<?php 
					if (count($grouped)) 
					{
						foreach ( $grouped as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_ls_bendahara_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_ls_bendahara_chart_perbulan += $chart['ls_bendahara'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_ls = $jml_ls_bendahara_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_ls = $jml_ls_bendahara_chart_perbulan;
										// calculation for getting percentation
										$percent_ls = (($last_ls - $before_last_ls) / $before_last_ls) * 100;
										if ($percent_ls > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_ls, 2);
				?>
											%
											</span> 
				<?php
										}
										else {
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_ls, 2);
				?>
											%
											</span> 
				<?php
										}
										
										
									}
										
									$i++;
								}
							}
						}
					}
				?>
		  </div>
		</li>
		
		<!-- pajak -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped)) 
			{
				foreach ( $grouped as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_pajak_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_pajak_chart_perbulan += $chart['pajak'];
							}
							// data up every month
							echo $jml_pajak_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_pajak); ?></strong> BP <br />Pajak
				<?php 
					if (count($grouped)) 
					{
						foreach ( $grouped as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_pajak_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_pajak_chart_perbulan += $chart['pajak'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_pajak = $jml_pajak_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_pajak = $jml_pajak_chart_perbulan;
										// calculation for getting percentation
										$percent_pajak = (($last_pajak - $before_last_pajak) / $before_last_pajak) * 100;
										if ($percent_pajak > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_pajak, 2);
				?>
											%
											</span> 
				<?php
										}
										else {
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_pajak, 2);
				?>
											%
											</span> 
				<?php
										}
										
										
									}
										
									$i++;
								}
							}
						}
					}
				?>
		  </div>
		</li>
		
		<!-- pengeluaran lain -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped)) 
			{
				foreach ( $grouped as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_pengeluaran_lain_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_pengeluaran_lain_chart_perbulan += $chart['pengeluaran_lain'];
							}
							// data up every month
							echo $jml_pengeluaran_lain_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_pengeluaran_lain); ?></strong> BP <br />Lain-Lain
				<?php 
					if (count($grouped)) 
					{
						foreach ( $grouped as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_pengeluaran_lain_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_pengeluaran_lain_chart_perbulan += $chart['pengeluaran_lain'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_pengeluaran_lain = $jml_pengeluaran_lain_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_pengeluaran_lain = $jml_pengeluaran_lain_chart_perbulan;
										// calculation for getting percentation
										$percent_pengeluaran_lain = (($last_pengeluaran_lain - $before_last_pengeluaran_lain) / $before_last_pengeluaran_lain) * 100;
										if ($percent_pengeluaran_lain > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_pengeluaran_lain, 2);
				?>
											%
											</span> 
				<?php
										}
										else {
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_pengeluaran_lain, 2);
				?>
											%
											</span> 
				<?php
										}
										
										
									}
										
									$i++;
								}
							}
						}
					}
				?>
		  </div>
		</li>
		
		
		<!-- saldo -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped)) 
			{
				foreach ( $grouped as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_saldo_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_saldo_chart_perbulan += $chart['saldo'];
							}
							// data up every month
							echo $jml_saldo_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_saldo); ?></strong> Saldo
				<?php 
					if (count($grouped)) 
					{
						foreach ( $grouped as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_saldo_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_saldo_chart_perbulan += $chart['saldo'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_saldo = $jml_saldo_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_saldo = $jml_saldo_chart_perbulan;
										// calculation for getting percentation
										$percent_saldo = (($last_saldo - $before_last_saldo) / $before_last_saldo) * 100;
										if ($percent_saldo > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_saldo, 2);
				?>
											%
											</span> 
				<?php
										}
										else {
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_saldo, 2);
				?>
											%
											</span> 
				<?php
										}
										
										
									}
										
									$i++;
								}
							}
						}
					}
				?>
		  </div>
		</li>
		
		<!-- kuitansi -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped)) 
			{
				foreach ( $grouped as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kuitansi_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kuitansi_chart_perbulan += $chart['kuitansi'];
							}
							// data up every month
							echo $jml_kuitansi_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kuitansi); ?></strong> Kuitansi
				<?php 
					if (count($grouped)) 
					{
						foreach ( $grouped as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kuitansi_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kuitansi_chart_perbulan += $chart['kuitansi'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kuitansi = $jml_kuitansi_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kuitansi = $jml_kuitansi_chart_perbulan;
										// calculation for getting percentation
										$percent_kuitansi = (($last_kuitansi - $before_last_kuitansi) / $before_last_kuitansi) * 100;
										if ($percent_kuitansi > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kuitansi, 2);
				?>
											%
											</span> 
				<?php
										}
										else {
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kuitansi, 2);
				?>
											%
											</span> 
				<?php
										}
										
										
									}
										
									$i++;
								}
							}
						}
					}
				?>
		  </div>
		</li>
		
	  </ul>
	</div><!--/text-center -->
  </div><!--/col-lg-12 -->
  
  
  
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
		  <div class="form-group">
				<label for="text3" class="control-label col-lg-12 bg-green dker"><h4>Dashboard LPJ Penerimaan</h4></label>
		  </div>
	  </header>
	</div><!--/box -->
	
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
