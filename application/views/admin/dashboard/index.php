 <!--Begin Datatables-->
<div class="row">
  
  <!-- Pengeluaran -->
  <div class="col-lg-12">
  
	<div class="box">

	<?php 
	//-- if kppn --//
	if ($id_entities === '1') 
	{
	?>
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
	  <div class="body">
		<div id="bar" style="height: 250px; padding: 0px; position: relative;">
			<div id="placeholder" style="width:600px;height:300px;"></div>
		</div>
		<br />
		<br />
		
	  </div><!--/body-->
	</div><!--/box -->
	
	<div class="text-center">
	  <ul class="stats_box">
		<!-- uang persediaan -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_kppn)) 
			{
				foreach ( $grouped_kppn as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_satker_uang_persediaan_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_satker_uang_persediaan_chart_perbulan += $chart['uang_persediaan'];
							}
							// data up every month
							echo $jml_satker_uang_persediaan_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_satker_uang_persediaan); ?></strong> BP <br />Uang Persediaan
				<?php 
					if (count($grouped_kppn)) 
					{
						foreach ( $grouped_kppn as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_satker_uang_persediaan_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_satker_uang_persediaan_chart_perbulan += $chart['uang_persediaan'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_satker_up = $jml_satker_uang_persediaan_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_satker_up = $jml_satker_uang_persediaan_chart_perbulan;
										// calculation for getting percentation
										$percent_satker_up = (($last_satker_up - $before_last_satker_up) / $before_last_satker_up) * 100;
										if ($percent_satker_up > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_satker_up, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_up < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_satker_up, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_up === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_satker_up, 2);
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
			if (count($grouped_kppn)) 
			{
				foreach ( $grouped_kppn as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_satker_ls_bendahara_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_satker_ls_bendahara_chart_perbulan += $chart['ls_bendahara'];
							}
							// data up every month
							echo $jml_satker_ls_bendahara_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_satker_ls_bendahara); ?></strong> BP <br />LS Bendahara
				<?php 
					if (count($grouped_kppn)) 
					{
						foreach ( $grouped_kppn as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_satker_ls_bendahara_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_satker_ls_bendahara_chart_perbulan += $chart['ls_bendahara'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_satker_ls = $jml_satker_ls_bendahara_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_satker_ls = $jml_satker_ls_bendahara_chart_perbulan;
										// calculation for getting percentation
										$percent_satker_ls = (($last_satker_ls - $before_last_satker_ls) / $before_last_satker_ls) * 100;
										if ($percent_satker_ls > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_satker_ls, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_ls < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_satker_ls, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_ls === 0) 
										{
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_satker_ls, 2);
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
			if (count($grouped_kppn)) 
			{
				foreach ( $grouped_kppn as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_satker_pajak_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_satker_pajak_chart_perbulan += $chart['pajak'];
							}
							// data up every month
							echo $jml_satker_pajak_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_satker_pajak); ?></strong> BP <br />Pajak
				<?php 
					if (count($grouped_kppn)) 
					{
						foreach ( $grouped_kppn as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_satker_pajak_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_satker_pajak_chart_perbulan += $chart['pajak'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_satker_pajak = $jml_satker_pajak_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_satker_pajak = $jml_satker_pajak_chart_perbulan;
										// calculation for getting percentation
										$percent_satker_pajak = (($last_satker_pajak - $before_last_satker_pajak) / $before_last_satker_pajak) * 100;
										if ($percent_satker_pajak > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_satker_pajak, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_pajak < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_satker_pajak, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_pajak === 0) 
										{
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_satker_pajak, 2);
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
			if (count($grouped_kppn)) 
			{
				foreach ( $grouped_kppn as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_satker_pengeluaran_lain_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_satker_pengeluaran_lain_chart_perbulan += $chart['pengeluaran_lain'];
							}
							// data up every month
							echo $jml_satker_pengeluaran_lain_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_satker_pengeluaran_lain); ?></strong> BP <br />Lain-Lain
				<?php 
					if (count($grouped_kppn)) 
					{
						foreach ( $grouped_kppn as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_satker_pengeluaran_lain_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_satker_pengeluaran_lain_chart_perbulan += $chart['pengeluaran_lain'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_satker_pengeluaran_lain = $jml_satker_pengeluaran_lain_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_satker_pengeluaran_lain = $jml_satker_pengeluaran_lain_chart_perbulan;
										// calculation for getting percentation
										$percent_satker_pengeluaran_lain = (($last_satker_pengeluaran_lain - $before_last_satker_pengeluaran_lain) / $before_last_satker_pengeluaran_lain) * 100;
										if ($percent_satker_pengeluaran_lain > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_satker_pengeluaran_lain, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_pengeluaran_lain < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_satker_pengeluaran_lain, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_pengeluaran_lain === 0) 
										{
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_satker_pengeluaran_lain, 2);
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
			if (count($grouped_kppn)) 
			{
				foreach ( $grouped_kppn as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_satker_saldo_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_satker_saldo_chart_perbulan += $chart['saldo'];
							}
							// data up every month
							echo $jml_satker_saldo_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_satker_saldo); ?></strong> Saldo
				<?php 
					if (count($grouped_kppn)) 
					{
						foreach ( $grouped_kppn as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_satker_saldo_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_satker_saldo_chart_perbulan += $chart['saldo'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_satker_saldo = $jml_satker_saldo_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_satker_saldo = $jml_satker_saldo_chart_perbulan;
										// calculation for getting percentation
										$percent_satker_saldo = (($last_satker_saldo - $before_last_satker_saldo) / $before_last_satker_saldo) * 100;
										if ($percent_satker_saldo > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_satker_saldo, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_saldo < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_satker_saldo, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_saldo === 0) 
										{
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_satker_saldo, 2);
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
			if (count($grouped_kppn)) 
			{
				foreach ( $grouped_kppn as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_satker_kuitansi_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_satker_kuitansi_chart_perbulan += $chart['kuitansi'];
							}
							// data up every month
							echo $jml_satker_kuitansi_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_satker_kuitansi); ?></strong> Kuitansi
				<?php 
					if (count($grouped_kppn)) 
					{
						foreach ( $grouped_kppn as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_satker_kuitansi_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_satker_kuitansi_chart_perbulan += $chart['kuitansi'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_satker_kuitansi = $jml_satker_kuitansi_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_satker_kuitansi = $jml_satker_kuitansi_chart_perbulan;
										// calculation for getting percentation
										$percent_satker_kuitansi = (($last_satker_kuitansi - $before_last_satker_kuitansi) / $before_last_satker_kuitansi) * 100;
										if ($percent_satker_kuitansi > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_satker_kuitansi, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_kuitansi < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_satker_kuitansi, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_kuitansi === 0) 
										{
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_satker_kuitansi, 2);
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
	</div>
	
	<div class="box">
	  <header>
		<div class="icons">
		  <i class="fa fa-table"></i>
		</div>
		<h5>Rekapitulasi LPJ Bendahara Pengeluaran</h5>
	  </header>
      <div id="collapse4" class="body">
		
		<?php if (count($grouped_kppn)) { ?>
			<table class="table table-bordered table-condensed table-hover" style="font-size:10px;">
				<thead>
					<tr>
						<th rowspan="2">Tahun</th>
						<th rowspan="2">Bulan</th>
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
					foreach ( $grouped_kppn as $tahun => $groups ) 
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
								$jml_satker_lpj_perbulan = 0;
								$jml_satker_uang_persediaan_perbulan = 0;
								$jml_satker_ls_bendahara_perbulan = 0;
								$jml_satker_pajak_perbulan = 0;
								$jml_satker_pengeluaran_lain_perbulan = 0;
								$jml_satker_saldo_perbulan = 0;
								$jml_satker_kuitansi_perbulan = 0;
								
								foreach ($results as $satker) 
								{
									$satker_saldo_kas = $satker['uang_persediaan'] + $satker['ls_bendahara'] +$satker['pajak'] + $satker['pengeluaran_lain'];
									$satker_uang_persediaan = $satker['saldo'] + $satker['kuitansi'];
									
									$jml_satker_lpj_perbulan 				+= $satker['jml_lpj'];
									$jml_satker_uang_persediaan_perbulan 	+= $satker['uang_persediaan'];
									$jml_satker_ls_bendahara_perbulan 		+= $satker['ls_bendahara'];
									$jml_satker_pajak_perbulan 			+= $satker['pajak'];
									$jml_satker_pengeluaran_lain_perbulan 	+= $satker['pengeluaran_lain'];
									$jml_satker_saldo_perbulan 			+= $satker['saldo'];
									$jml_satker_kuitansi_perbulan 			+= $satker['kuitansi'];
									
									$jml_satker_saldo_kas_perbulan 		= $jml_satker_uang_persediaan_perbulan + $jml_satker_ls_bendahara_perbulan + $jml_satker_pajak_perbulan + $jml_satker_pengeluaran_lain_perbulan;
									$jml_satker_saldo_up_perbulan			= $jml_satker_saldo_perbulan + $jml_satker_kuitansi_perbulan;
									
				
								}
				?>
								<tr style="font-weight: bold; font-style: italic;">
									<td></td>
									<td><?php echo 'JUMLAH BULAN ' . strtoupper(get_month_name($bulan)); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_lpj_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_uang_persediaan_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_ls_bendahara_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_pajak_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_pengeluaran_lain_perbulan); ?></td>
									<td class="bg-light dk" align="right"><?php echo amount_format($jml_satker_saldo_kas_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_saldo_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_kuitansi_perbulan); ?></td>
									<td class="bg-light dk" align="right"><?php echo amount_format($jml_satker_saldo_up_perbulan); ?></td>
								</tr>
				<?php
							}
						}
					}
				?>
					<tr  class="bg-light" style="font-weight: bold;">
						<td colspan="2" align="center">JUMLAH TOTAL</td>
						<td align="right"><?php echo amount_format($jml_satker_lpj); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_uang_persediaan); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_ls_bendahara); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_pajak); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_pengeluaran_lain); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_saldo_kas); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_saldo); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_kuitansi); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_saldo_up); ?></td>
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
	
	<div class="text-center">
	  <ul class="stats_box">
		
		<!-- kas tunai -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_satker_penerimaan)) 
			{
				foreach ( $grouped_satker_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_satker_kas_tunai_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_satker_kas_tunai_chart_perbulan += $chart['kas_tunai'];
							}
							// data up every month
							echo $jml_satker_kas_tunai_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_satker_kas_tunai); ?></strong> Saldo <br />Kas Tunai
				<?php 
					if (count($grouped_satker_penerimaan)) 
					{
						foreach ( $grouped_satker_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_satker_kas_tunai_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_satker_kas_tunai_chart_perbulan += $chart['kas_tunai'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_satker_kas_tunai = $jml_satker_kas_tunai_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_satker_kas_tunai = $jml_satker_kas_tunai_chart_perbulan;
										// calculation for getting percentation
										$percent_satker_kas_tunai = (($last_satker_kas_tunai - $before_last_satker_kas_tunai) / $before_last_satker_kas_tunai) * 100;
										if ($percent_satker_kas_tunai > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_satker_kas_tunai, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_kas_tunai < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_satker_kas_tunai, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_kas_tunai === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_satker_kas_tunai, 2);
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
		
		
		<!-- kas bank -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_satker_penerimaan)) 
			{
				foreach ( $grouped_satker_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_satker_kas_bank_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_satker_kas_bank_chart_perbulan += $chart['kas_bank'];
							}
							// data up every month
							echo $jml_satker_kas_bank_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_satker_kas_bank); ?></strong> Saldo <br />Kas Bank
				<?php 
					if (count($grouped_satker_penerimaan)) 
					{
						foreach ( $grouped_satker_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_satker_kas_bank_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_satker_kas_bank_chart_perbulan += $chart['kas_bank'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_satker_kas_bank = $jml_satker_kas_bank_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_satker_kas_bank = $jml_satker_kas_bank_chart_perbulan;
										// calculation for getting percentation
										$percent_satker_kas_bank = (($last_satker_kas_bank - $before_last_satker_kas_bank) / $before_last_satker_kas_bank) * 100;
										if ($percent_satker_kas_bank > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_satker_kas_bank, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_kas_bank < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_satker_kas_bank, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_kas_bank === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_satker_kas_bank, 2);
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
		
		<!-- saldo awal -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_satker_penerimaan)) 
			{
				foreach ( $grouped_satker_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_satker_saldo_awal_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_satker_saldo_awal_chart_perbulan += $chart['saldo_awal'];
							}
							// data up every month
							echo $jml_satker_saldo_awal_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_satker_saldo_awal); ?></strong> Saldo Awal<br />Penerimaan
				<?php 
					if (count($grouped_satker_penerimaan)) 
					{
						foreach ( $grouped_satker_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_satker_saldo_awal_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_satker_saldo_awal_chart_perbulan += $chart['saldo_awal'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_satker_saldo_awal = $jml_satker_saldo_awal_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_satker_saldo_awal = $jml_satker_saldo_awal_chart_perbulan;
										// calculation for getting percentation
										$percent_satker_saldo_awal = (($last_satker_saldo_awal - $before_last_satker_saldo_awal) / $before_last_satker_saldo_awal) * 100;
										if ($percent_satker_saldo_awal > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_satker_saldo_awal, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_saldo_awal < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_satker_saldo_awal, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_saldo_awal === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_satker_saldo_awal, 2);
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
		
		
		<!-- penerimaan -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_satker_penerimaan)) 
			{
				foreach ( $grouped_satker_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_satker_penerimaan_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_satker_penerimaan_chart_perbulan += $chart['penerimaan'];
							}
							// data up every month
							echo $jml_satker_penerimaan_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_satker_penerimaan); ?></strong> Penerimaan
				<?php 
					if (count($grouped_satker_penerimaan)) 
					{
						foreach ( $grouped_satker_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_satker_penerimaan_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_satker_penerimaan_chart_perbulan += $chart['penerimaan'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_satker_penerimaan = $jml_satker_penerimaan_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_satker_penerimaan = $jml_satker_penerimaan_chart_perbulan;
										// calculation for getting percentation
										$percent_satker_penerimaan = (($last_satker_penerimaan - $before_last_satker_penerimaan) / $before_last_satker_penerimaan) * 100;
										if ($percent_satker_penerimaan > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_satker_penerimaan, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_penerimaan < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_satker_penerimaan, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_penerimaan === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_satker_penerimaan, 2);
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
		
		
		<!-- penyetoran -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_satker_penerimaan)) 
			{
				foreach ( $grouped_satker_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_satker_penyetoran_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_satker_penyetoran_chart_perbulan += $chart['penyetoran'];
							}
							// data up every month
							echo $jml_satker_penyetoran_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_satker_penyetoran); ?></strong> Penyetoran
				<?php 
					if (count($grouped_satker_penerimaan)) 
					{
						foreach ( $grouped_satker_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_satker_penyetoran_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_satker_penyetoran_chart_perbulan += $chart['penyetoran'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_satker_penyetoran = $jml_satker_penyetoran_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_satker_penyetoran = $jml_satker_penyetoran_chart_perbulan;
										// calculation for getting percentation
										$percent_satker_penyetoran = (($last_satker_penyetoran - $before_last_satker_penyetoran) / $before_last_satker_penyetoran) * 100;
										if ($percent_satker_penyetoran > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_satker_penyetoran, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_penyetoran < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_satker_penyetoran, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_satker_penyetoran === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_satker_penyetoran, 2);
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
  


	<div class="box">
	  <header>
		<div class="icons">
		  <i class="fa fa-table"></i>
		</div>
		<h5>Rekapitulasi LPJ Bendahara Penerimaan</h5>
	  </header>
      <div id="collapse4" class="body">
		
		<?php if (count($grouped_satker_penerimaan)) { ?>
			<table class="table table-bordered table-condensed table-hover" style="font-size:11px;">
				<thead>
					<tr>
						<th rowspan="2">Tahun</th>
						<th rowspan="2">Bulan</th>
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
					foreach ( $grouped_satker_penerimaan as $tahun => $groups ) 
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
								$jml_satker_lpj_penerimaan_perbulan = 0;
								$jml_satker_kas_tunai_perbulan = 0;
								$jml_satker_kas_bank_perbulan = 0;
								$jml_satker_saldo_awal_perbulan = 0;
								$jml_satker_penerimaan_perbulan = 0;
								$jml_satker_penyetoran_perbulan = 0;
								
								foreach ($results as $satker_penerimaan) 
								{
									$satker_saldo_kas_penerimaan = $satker_penerimaan['kas_tunai'] + $satker_penerimaan['kas_bank'];
									$satker_saldo_penerimaaan_penyetoran = $satker_penerimaan['saldo_awal']+$satker_penerimaan['penerimaan']-$satker_penerimaan['penyetoran'];
									
									$jml_satker_lpj_penerimaan_perbulan 	+= $satker_penerimaan['jml_lpj'];
									$jml_satker_kas_tunai_perbulan		 	+= $satker_penerimaan['kas_tunai'];
									$jml_satker_kas_bank_perbulan	 		+= $satker_penerimaan['kas_bank'];
									$jml_satker_saldo_awal_perbulan		+= $satker_penerimaan['saldo_awal'];
									$jml_satker_penerimaan_perbulan 		+= $satker_penerimaan['penerimaan'];
									$jml_satker_penyetoran_perbulan 		+= $satker_penerimaan['penyetoran'];
									
									$jml_satker_saldo_kas_penerimaan_perbulan 		= $jml_satker_kas_tunai_perbulan + $jml_satker_kas_bank_perbulan;
									$jml_satker_saldo_penyetoran_penerimaan_perbulan	= $jml_satker_saldo_awal_perbulan + $jml_satker_penerimaan_perbulan - $jml_satker_penyetoran_perbulan;
									
								}
				?>
								<tr style="font-weight: bold; font-style: italic;">
									<td></td>
									<td><?php echo 'JUMLAH BULAN ' . strtoupper(get_month_name($bulan)); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_lpj_penerimaan_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_kas_tunai_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_kas_bank_perbulan); ?></td>
									<td class="bg-light dk" align="right"><?php echo amount_format($jml_satker_saldo_kas_penerimaan_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_saldo_awal_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_penerimaan_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_satker_penyetoran_perbulan); ?></td>
									<td class="bg-light dk" align="right"><?php echo amount_format($jml_satker_saldo_penyetoran_penerimaan_perbulan); ?></td>
								</tr>
				<?php
							}
						}
					}
				?>
					<tr  class="bg-light" style="font-weight: bold;">
						<td colspan="2" align="center">JUMLAH TOTAL</td>
						<td align="right"><?php echo amount_format($jml_satker_lpj_penerimaan); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_kas_tunai); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_kas_bank); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_saldo_kas_penerimaan); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_saldo_awal); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_penerimaan); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_penyetoran); ?></td>
						<td align="right"><?php echo amount_format($jml_satker_saldo_penyetoran_penerimaan); ?></td>
					</tr>
				<?php
				?>
				</tbody>
			</table>
		<?php } ?>
		
	  </div><!--/collapse4-->

	
	<?php
	}
	
	//-- if kanwil --//
	else if($id_entities === '2') { 
	?>
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
	  <div class="body" id="trigo" style="height: 470px;">
			
		<div id="bar" style="padding: 0px; position: relative;">
			<div id="placeholder" style="width:900px;height:400px;"></div>
		</div>
			
	  </div>
	</div><!--/box -->
	
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-pengeluaran-up" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-pengeluaran-ls-bendahara" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
	</div><!--/row -->
	
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-pengeluaran-pajak" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-pengeluaran-lain" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
	</div><!--/row -->
	
	
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-pengeluaran-saldo" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-pengeluaran-kuitansi" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
	
	</div><!--/row -->
	
	
	<div class="text-center">
	  <ul class="stats_box">
		<!-- uang persediaan -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_kanwil)) 
			{
				foreach ( $grouped_kanwil as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_satker_uang_persediaan_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kppn_uang_persediaan_chart_perbulan += $chart['uang_persediaan'];
							}
							// data up every month
							echo $jml_kppn_uang_persediaan_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kppn_uang_persediaan); ?></strong> BP <br />Uang Persediaan
				<?php 
					if (count($grouped_kanwil)) 
					{
						foreach ( $grouped_kanwil as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kppn_uang_persediaan_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kppn_uang_persediaan_chart_perbulan += $chart['uang_persediaan'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kppn_up = $jml_kppn_uang_persediaan_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kppn_up = $jml_kppn_uang_persediaan_chart_perbulan;
										// calculation for getting percentation
										$percent_kppn_up = (($last_kppn_up - $before_last_kppn_up) / $before_last_kppn_up) * 100;
										if ($percent_kppn_up > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kppn_up, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_up < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kppn_up, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_up === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kppn_up, 2);
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
			if (count($grouped_kanwil)) 
			{
				foreach ( $grouped_kanwil as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kppn_ls_bendahara_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kppn_ls_bendahara_chart_perbulan += $chart['ls_bendahara'];
							}
							// data up every month
							echo $jml_kppn_ls_bendahara_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kppn_ls_bendahara); ?></strong> BP <br />LS Bendahara
				<?php 
					if (count($grouped_kanwil)) 
					{
						foreach ( $grouped_kanwil as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kppn_ls_bendahara_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kppn_ls_bendahara_chart_perbulan += $chart['ls_bendahara'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kppn_ls = $jml_kppn_ls_bendahara_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kppn_ls = $jml_kppn_ls_bendahara_chart_perbulan;
										// calculation for getting percentation
										$percent_kppn_ls = (($last_kppn_ls - $before_last_kppn_ls) / $before_last_kppn_ls) * 100;
										if ($percent_kppn_ls > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kppn_ls, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_ls < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kppn_ls, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_ls === 0) 
										{
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kppn_ls, 2);
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
			if (count($grouped_kanwil)) 
			{
				foreach ( $grouped_kanwil as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kppn_pajak_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kppn_pajak_chart_perbulan += $chart['pajak'];
							}
							// data up every month
							echo $jml_kppn_pajak_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kppn_pajak); ?></strong> BP <br />Pajak
				<?php 
					if (count($grouped_kanwil)) 
					{
						foreach ( $grouped_kanwil as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kppn_pajak_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kppn_pajak_chart_perbulan += $chart['pajak'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kppn_pajak = $jml_kppn_pajak_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kppn_pajak = $jml_kppn_pajak_chart_perbulan;
										// calculation for getting percentation
										$percent_kppn_pajak = (($last_kppn_pajak - $before_last_kppn_pajak) / $before_last_kppn_pajak) * 100;
										if ($percent_kppn_pajak > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kppn_pajak, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_pajak < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kppn_pajak, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_pajak === 0) 
										{
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kppn_pajak, 2);
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
			if (count($grouped_kanwil)) 
			{
				foreach ( $grouped_kanwil as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kppn_pengeluaran_lain_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kppn_pengeluaran_lain_chart_perbulan += $chart['pengeluaran_lain'];
							}
							// data up every month
							echo $jml_kppn_pengeluaran_lain_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kppn_pengeluaran_lain); ?></strong> BP <br />Lain-Lain
				<?php 
					if (count($grouped_kanwil)) 
					{
						foreach ( $grouped_kanwil as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kppn_pengeluaran_lain_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kppn_pengeluaran_lain_chart_perbulan += $chart['pengeluaran_lain'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kppn_pengeluaran_lain = $jml_kppn_pengeluaran_lain_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kppn_pengeluaran_lain = $jml_kppn_pengeluaran_lain_chart_perbulan;
										// calculation for getting percentation
										$percent_kppn_pengeluaran_lain = (($last_kppn_pengeluaran_lain - $before_last_kppn_pengeluaran_lain) / $before_last_kppn_pengeluaran_lain) * 100;
										if ($percent_kppn_pengeluaran_lain > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kppn_pengeluaran_lain, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_pengeluaran_lain < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kppn_pengeluaran_lain, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_pengeluaran_lain === 0) 
										{
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kppn_pengeluaran_lain, 2);
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
			if (count($grouped_kanwil)) 
			{
				foreach ( $grouped_kanwil as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kppn_saldo_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kppn_saldo_chart_perbulan += $chart['saldo'];
							}
							// data up every month
							echo $jml_kppn_saldo_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kppn_saldo); ?></strong> Saldo
				<?php 
					if (count($grouped_kanwil)) 
					{
						foreach ( $grouped_kanwil as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kppn_saldo_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kppn_saldo_chart_perbulan += $chart['saldo'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kppn_saldo = $jml_kppn_saldo_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kppn_saldo = $jml_kppn_saldo_chart_perbulan;
										// calculation for getting percentation
										$percent_kppn_saldo = (($last_kppn_saldo - $before_last_kppn_saldo) / $before_last_kppn_saldo) * 100;
										if ($percent_kppn_saldo > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kppn_saldo, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_saldo < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kppn_saldo, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_saldo === 0) 
										{
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kppn_saldo, 2);
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
			if (count($grouped_kanwil)) 
			{
				foreach ( $grouped_kanwil as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kppn_kuitansi_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kppn_kuitansi_chart_perbulan += $chart['kuitansi'];
							}
							// data up every month
							echo $jml_kppn_kuitansi_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kppn_kuitansi); ?></strong> Kuitansi
				<?php 
					if (count($grouped_kanwil)) 
					{
						foreach ( $grouped_kanwil as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kppn_kuitansi_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kppn_kuitansi_chart_perbulan += $chart['kuitansi'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kppn_kuitansi = $jml_kppn_kuitansi_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kppn_kuitansi = $jml_kppn_kuitansi_chart_perbulan;
										// calculation for getting percentation
										$percent_kppn_kuitansi = (($last_kppn_kuitansi - $before_last_kppn_kuitansi) / $before_last_kppn_kuitansi) * 100;
										if ($percent_kppn_kuitansi > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kppn_kuitansi, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_kuitansi < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kppn_kuitansi, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_kuitansi === 0) 
										{
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kppn_kuitansi, 2);
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
	
	
	<div class="box">
	  <header>
		<div class="icons">
		  <i class="fa fa-table"></i>
		</div>
		<h5>Rekapitulasi LPJ Bendahara Pengeluaran</h5>
	  </header>
      <div id="collapse4" class="body">
		
		<?php if (count($grouped_kanwil)) { ?>
			<table class="table table-bordered table-condensed table-hover" style="font-size:10px;">
				<thead>
					<tr>
						<th rowspan="2">Tahun</th>
						<th rowspan="2">KPPN</th>
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
					foreach ( $grouped_kanwil as $tahun => $groups ) 
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
								$jml_kppn_lpj_perbulan = 0;
								$jml_kppn_uang_persediaan_perbulan = 0;
								$jml_kppn_ls_bendahara_perbulan = 0;
								$jml_kppn_pajak_perbulan = 0;
								$jml_kppn_pengeluaran_lain_perbulan = 0;
								$jml_kppn_saldo_perbulan = 0;
								$jml_kppn_kuitansi_perbulan = 0;
								
								foreach ($results as $kppn) 
								{
									$kppn_saldo_kas = $kppn['uang_persediaan'] + $kppn['ls_bendahara'] +$kppn['pajak'] + $kppn['pengeluaran_lain'];
									$kppn_uang_persediaan = $kppn['saldo'] + $kppn['kuitansi'];
									
									$jml_kppn_lpj_perbulan 				+= $kppn['jml_lpj'];
									$jml_kppn_uang_persediaan_perbulan 	+= $kppn['uang_persediaan'];
									$jml_kppn_ls_bendahara_perbulan 		+= $kppn['ls_bendahara'];
									$jml_kppn_pajak_perbulan 			+= $kppn['pajak'];
									$jml_kppn_pengeluaran_lain_perbulan 	+= $kppn['pengeluaran_lain'];
									$jml_kppn_saldo_perbulan 			+= $kppn['saldo'];
									$jml_kppn_kuitansi_perbulan 			+= $kppn['kuitansi'];
									
									$jml_kppn_saldo_kas_perbulan 		= $jml_kppn_uang_persediaan_perbulan + $jml_kppn_ls_bendahara_perbulan + $jml_kppn_pajak_perbulan + $jml_kppn_pengeluaran_lain_perbulan;
									$jml_kppn_saldo_up_perbulan			= $jml_kppn_saldo_perbulan + $jml_kppn_kuitansi_perbulan;
									
				?>
								<tr>
									<td></td>
									<td style="white-space:normal;"><?php echo '(' . $kppn['kd_kppn'] . ') ' . $kppn['nm_kppn']; ?></td>
									<td align="right"><?php echo amount_format($kppn['jml_lpj']); ?></td>
									<td align="right"><?php echo amount_format($kppn['uang_persediaan']); ?></td>
									<td align="right"><?php echo amount_format($kppn['ls_bendahara']); ?></td>
									<td align="right"><?php echo amount_format($kppn['pajak']); ?></td>
									<td align="right"><?php echo amount_format($kppn['pengeluaran_lain']); ?></td>
									<td align="right" class="bg-light dk"><?php echo amount_format($kppn_saldo_kas); ?></td>
									<td align="right"><?php echo amount_format($kppn['saldo']); ?></td>
									<td align="right"><?php echo amount_format($kppn['kuitansi']); ?></td>
									<td align="right" class="bg-light dk"><?php echo amount_format($kppn_uang_persediaan); ?></td>
								</tr>
				<?php
								}
				?>
								<tr style="font-weight: bold; font-style: italic;">
									<td></td>
									<td><?php echo 'JUMLAH BULAN ' . strtoupper(get_month_name($bulan)); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_lpj_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_uang_persediaan_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_ls_bendahara_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_pajak_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_pengeluaran_lain_perbulan); ?></td>
									<td class="bg-light dk" align="right"><?php echo amount_format($jml_kppn_saldo_kas_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_saldo_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_kuitansi_perbulan); ?></td>
									<td class="bg-light dk" align="right"><?php echo amount_format($jml_kppn_saldo_up_perbulan); ?></td>
								</tr>
				<?php
							}
						}
					}
				?>
					<tr  class="bg-light" style="font-weight: bold;">
						<td colspan="2" align="center">JUMLAH TOTAL</td>
						<td align="right"><?php echo amount_format($jml_kppn_lpj); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_uang_persediaan); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_ls_bendahara); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_pajak); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_pengeluaran_lain); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_saldo_kas); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_saldo); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_kuitansi); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_saldo_up); ?></td>
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
		<h5>Pengiriman LPJ Penerimaan</h5>
	  </header>
	  <div class="body" id="trigo" style="height: 470px;">
			
		<div id="bar" style="padding: 0px; position: relative;">
			<div id="placeholder-penerimaan" style="width:900px;height:400px;"></div>
		</div>
			
	  </div>
	</div><!--/box -->
	
	
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-penerimaan-kas-tunai" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-penerimaan-kas-bank" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
	</div><!--/row -->
	
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-penerimaan-saldo-awal" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-penerimaan-penerimaan" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
	</div><!--/row -->
	
	
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-penerimaan-penyetoran" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
	</div><!--/row-->
	
	
	<div class="text-center">
	  <ul class="stats_box">
		
		<!-- kas tunai -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_kppn_penerimaan)) 
			{
				foreach ( $grouped_kppn_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kppn_kas_tunai_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kppn_kas_tunai_chart_perbulan += $chart['kas_tunai'];
							}
							// data up every month
							echo $jml_kppn_kas_tunai_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kppn_kas_tunai); ?></strong> Saldo <br />Kas Tunai
				<?php 
					if (count($grouped_kppn_penerimaan)) 
					{
						foreach ( $grouped_kppn_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kppn_kas_tunai_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kppn_kas_tunai_chart_perbulan += $chart['kas_tunai'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kppn_kas_tunai = $jml_kppn_kas_tunai_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kppn_kas_tunai = $jml_kppn_kas_tunai_chart_perbulan;
										// calculation for getting percentation
										$percent_kppn_kas_tunai = (($last_kppn_kas_tunai - $before_last_kppn_kas_tunai) / $before_last_kppn_kas_tunai) * 100;
										if ($percent_kppn_kas_tunai > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kppn_kas_tunai, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_kas_tunai < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kppn_kas_tunai, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_kas_tunai === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kppn_kas_tunai, 2);
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
		
		
		<!-- kas bank -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_kppn_penerimaan)) 
			{
				foreach ( $grouped_kppn_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kppn_kas_bank_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kppn_kas_bank_chart_perbulan += $chart['kas_bank'];
							}
							// data up every month
							echo $jml_kppn_kas_bank_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kppn_kas_bank); ?></strong> Saldo <br />Kas Bank
				<?php 
					if (count($grouped_kppn_penerimaan)) 
					{
						foreach ( $grouped_kppn_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kppn_kas_bank_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kppn_kas_bank_chart_perbulan += $chart['kas_bank'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kppn_kas_bank = $jml_kppn_kas_bank_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kppn_kas_bank = $jml_kppn_kas_bank_chart_perbulan;
										// calculation for getting percentation
										$percent_kppn_kas_bank = (($last_kppn_kas_bank - $before_last_kppn_kas_bank) / $before_last_kppn_kas_bank) * 100;
										if ($percent_kppn_kas_bank > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kppn_kas_bank, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_kas_bank < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kppn_kas_bank, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_kas_bank === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kppn_kas_bank, 2);
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
		
		<!-- saldo awal -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_kppn_penerimaan)) 
			{
				foreach ( $grouped_kppn_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kppn_saldo_awal_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kppn_saldo_awal_chart_perbulan += $chart['saldo_awal'];
							}
							// data up every month
							echo $jml_kppn_saldo_awal_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kppn_saldo_awal); ?></strong> Saldo Awal<br />Penerimaan
				<?php 
					if (count($grouped_kppn_penerimaan)) 
					{
						foreach ( $grouped_kppn_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kppn_saldo_awal_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kppn_saldo_awal_chart_perbulan += $chart['saldo_awal'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kppn_saldo_awal = $jml_kppn_saldo_awal_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kppn_saldo_awal = $jml_kppn_saldo_awal_chart_perbulan;
										// calculation for getting percentation
										$percent_kppn_saldo_awal = (($last_kppn_saldo_awal - $before_last_kppn_saldo_awal) / $before_last_kppn_saldo_awal) * 100;
										if ($percent_kppn_saldo_awal > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kppn_saldo_awal, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_saldo_awal < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kppn_saldo_awal, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_saldo_awal === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kppn_saldo_awal, 2);
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
		
		
		<!-- penerimaan -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_kppn_penerimaan)) 
			{
				foreach ( $grouped_kppn_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kppn_penerimaan_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kppn_penerimaan_chart_perbulan += $chart['penerimaan'];
							}
							// data up every month
							echo $jml_kppn_penerimaan_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kppn_penerimaan); ?></strong> Penerimaan
				<?php 
					if (count($grouped_kppn_penerimaan)) 
					{
						foreach ( $grouped_kppn_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kppn_penerimaan_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kppn_penerimaan_chart_perbulan += $chart['penerimaan'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kppn_penerimaan = $jml_kppn_penerimaan_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kppn_penerimaan = $jml_kppn_penerimaan_chart_perbulan;
										// calculation for getting percentation
										$percent_kppn_penerimaan = (($last_kppn_penerimaan - $before_last_kppn_penerimaan) / $before_last_kppn_penerimaan) * 100;
										if ($percent_kppn_penerimaan > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kppn_penerimaan, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_penerimaan < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kppn_penerimaan, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_penerimaan === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kppn_penerimaan, 2);
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
		
		
		<!-- penyetoran -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_kppn_penerimaan)) 
			{
				foreach ( $grouped_kppn_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kppn_penyetoran_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kppn_penyetoran_chart_perbulan += $chart['penyetoran'];
							}
							// data up every month
							echo $jml_kppn_penyetoran_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kppn_penyetoran); ?></strong> Penyetoran
				<?php 
					if (count($grouped_kppn_penerimaan)) 
					{
						foreach ( $grouped_kppn_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kppn_penyetoran_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kppn_penyetoran_chart_perbulan += $chart['penyetoran'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kppn_penyetoran = $jml_kppn_penyetoran_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kppn_penyetoran = $jml_kppn_penyetoran_chart_perbulan;
										// calculation for getting percentation
										$percent_kppn_penyetoran = (($last_kppn_penyetoran - $before_last_kppn_penyetoran) / $before_last_kppn_penyetoran) * 100;
										if ($percent_kppn_penyetoran > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kppn_penyetoran, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_penyetoran < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kppn_penyetoran, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kppn_penyetoran === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kppn_penyetoran, 2);
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

	<div class="box">
	  <header>
		<div class="icons">
		  <i class="fa fa-table"></i>
		</div>
		<h5>Rekapitulasi LPJ Bendahara Penerimaan</h5>
	  </header>
      <div id="collapse4" class="body">
		
		<?php if (count($grouped_kppn_penerimaan)) { ?>
			<table class="table table-bordered table-condensed table-hover" style="font-size:11px;">
				<thead>
					<tr>
						<th rowspan="2">Tahun</th>
						<th rowspan="2">KPPN</th>
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
					foreach ( $grouped_kppn_penerimaan as $tahun => $groups ) 
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
								$jml_kppn_lpj_penerimaan_perbulan = 0;
								$jml_kppn_kas_tunai_perbulan = 0;
								$jml_kppn_kas_bank_perbulan = 0;
								$jml_kppn_saldo_awal_perbulan = 0;
								$jml_kppn_penerimaan_perbulan = 0;
								$jml_kppn_penyetoran_perbulan = 0;
								
								foreach ($results as $kppn_penerimaan) 
								{
									$kppn_saldo_kas_penerimaan = $kppn_penerimaan['kas_tunai'] + $kppn_penerimaan['kas_bank'];
									$kppn_saldo_penerimaaan_penyetoran = $kppn_penerimaan['saldo_awal']+$kppn_penerimaan['penerimaan']-$kppn_penerimaan['penyetoran'];
									
									$jml_kppn_lpj_penerimaan_perbulan 	+= $kppn_penerimaan['jml_lpj'];
									$jml_kppn_kas_tunai_perbulan		 	+= $kppn_penerimaan['kas_tunai'];
									$jml_kppn_kas_bank_perbulan	 		+= $kppn_penerimaan['kas_bank'];
									$jml_kppn_saldo_awal_perbulan		+= $kppn_penerimaan['saldo_awal'];
									$jml_kppn_penerimaan_perbulan 		+= $kppn_penerimaan['penerimaan'];
									$jml_kppn_penyetoran_perbulan 		+= $kppn_penerimaan['penyetoran'];
									
									$jml_kppn_saldo_kas_penerimaan_perbulan 		= $jml_kppn_kas_tunai_perbulan + $jml_kppn_kas_bank_perbulan;
									$jml_kppn_saldo_penyetoran_penerimaan_perbulan	= $jml_kppn_saldo_awal_perbulan + $jml_kppn_penerimaan_perbulan - $jml_kppn_penyetoran_perbulan;
									
				?>
								<tr>
									<td></td>
									<td style="white-space:normal;"><?php echo '(' . $kppn_penerimaan['kd_kppn'] . ') ' . $kppn_penerimaan['nm_kppn']; ?></td>
									<td align="right"><?php echo amount_format($kppn_penerimaan['jml_lpj']); ?></td>
									<td align="right"><?php echo amount_format($kppn_penerimaan['kas_tunai']); ?></td>
									<td align="right"><?php echo amount_format($kppn_penerimaan['kas_bank']); ?></td>
									<td align="right" class="bg-light dk"><?php echo amount_format($kppn_saldo_kas_penerimaan); ?></td>
									<td align="right"><?php echo amount_format($kppn_penerimaan['saldo_awal']); ?></td>
									<td align="right"><?php echo amount_format($kppn_penerimaan['penerimaan']); ?></td>
									<td align="right"><?php echo amount_format($kppn_penerimaan['penyetoran']); ?></td>
									<td align="right" class="bg-light dk"><?php echo amount_format($kppn_saldo_penerimaaan_penyetoran); ?></td>
								</tr>
				<?php
								}
				?>
								<tr style="font-weight: bold; font-style: italic;">
									<td></td>
									<td><?php echo 'JUMLAH BULAN ' . strtoupper(get_month_name($bulan)); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_lpj_penerimaan_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_kas_tunai_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_kas_bank_perbulan); ?></td>
									<td class="bg-light dk" align="right"><?php echo amount_format($jml_kppn_saldo_kas_penerimaan_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_saldo_awal_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_penerimaan_perbulan); ?></td>
									<td align="right"><?php echo amount_format($jml_kppn_penyetoran_perbulan); ?></td>
									<td class="bg-light dk" align="right"><?php echo amount_format($jml_kppn_saldo_penyetoran_penerimaan_perbulan); ?></td>
								</tr>
				<?php
							}
						}
					}
				?>
					<tr  class="bg-light" style="font-weight: bold;">
						<td colspan="2" align="center">JUMLAH TOTAL</td>
						<td align="right"><?php echo amount_format($jml_kppn_lpj_penerimaan); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_kas_tunai); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_kas_bank); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_saldo_kas_penerimaan); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_saldo_awal); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_penerimaan); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_penyetoran); ?></td>
						<td align="right"><?php echo amount_format($jml_kppn_saldo_penyetoran_penerimaan); ?></td>
					</tr>
				<?php
				?>
				</tbody>
			</table>
		<?php } ?>
		
	  </div><!--/collapse4-->
	  
	  <?php } 
	  
	  //-- if pkn --//
	   
	  else if($id_entities === '3') { ?>
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
	  <div class="body" id="trigo" style="height: 470px;">
			
		<div id="bar" style="padding: 0px; position: relative;">
			<div id="placeholder" style="width:900px;height:400px;"></div>
		</div>
			
	  </div>
	</div><!--/box -->
	
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-pengeluaran-up" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-pengeluaran-ls-bendahara" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
	</div><!--/row -->
	
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-pengeluaran-pajak" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-pengeluaran-lain" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
	</div><!--/row -->
	
	
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-pengeluaran-saldo" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-pengeluaran-kuitansi" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
	
	</div><!--/row -->
		
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
										else if ($percent_up < 0){
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
										else if ($percent_up === 0) 
										{
				?>
											<span class="percent"> 
											<br />
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
										else if ($percent_ls < 0){
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
										else if ($percent_ls === 0) 
										{
				?>
											<span class="percent"> 
											<br />
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
										else if ($percent_pajak < 0){
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
										else if ($percent_pajak === 0) 
										{
				?>
											<span class="percent"> 
											<br /> 
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
										else if ($percent_pengeluaran_lain < 0){
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
										else if ($percent_pengeluaran_lain === 0) 
										{
				?>
											<span class="percent"> 
											<br />
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
										else if ($percent_saldo < 0){
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
										else if ($percent_saldo === 0) 
										{
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
										else if ($percent_kuitansi < 0){
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
										else if ($percent_kuitansi === 0) 
										{
				?>
											<span class="percent"> 
											<br />
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
	
	
	<div class="box">
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
		<h5>Pengiriman LPJ Penerimaan</h5>
	  </header>
	  <div class="body" id="trigo" style="height: 470px;">
			
		<div id="bar" style="padding: 0px; position: relative;">
			<div id="placeholder-penerimaan" style="width:900px;height:400px;"></div>
		</div>
			
	  </div>
	</div><!--/box -->
	
	
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-penerimaan-kas-tunai" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-penerimaan-kas-bank" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
	</div><!--/row -->
	
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-penerimaan-saldo-awal" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-penerimaan-penerimaan" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
	</div><!--/row -->
	
	
	<div class="row">
		
		<div class="col-lg-6">
			<div class="box">
				
				<div class="body" id="trigo">
					<div id="bar" style="padding: 0px; position: relative;">
						<div id="placeholder-penerimaan-penyetoran" style="width:450px;height:200px;"></div>
					</div>
				</div>
				
			</div><!--/box -->
		</div><!--/col-lg-6 -->
		
	</div>
	
	<div class="text-center">
	  <ul class="stats_box">
		
		<!-- kas tunai -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_penerimaan)) 
			{
				foreach ( $grouped_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kas_tunai_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kas_tunai_chart_perbulan += $chart['kas_tunai'];
							}
							// data up every month
							echo $jml_kas_tunai_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kas_tunai); ?></strong> Saldo <br />Kas Tunai
				<?php 
					if (count($grouped_penerimaan)) 
					{
						foreach ( $grouped_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kas_tunai_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kas_tunai_chart_perbulan += $chart['kas_tunai'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kas_tunai = $jml_kas_tunai_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kas_tunai = $jml_kas_tunai_chart_perbulan;
										// calculation for getting percentation
										$percent_kas_tunai = (($last_kas_tunai - $before_last_kas_tunai) / $before_last_kas_tunai) * 100;
										if ($percent_kas_tunai > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kas_tunai, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kas_tunai < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kas_tunai, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kas_tunai === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kas_tunai, 2);
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
		
		
		<!-- kas bank -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_penerimaan)) 
			{
				foreach ( $grouped_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_kas_bank_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_kas_bank_chart_perbulan += $chart['kas_bank'];
							}
							// data up every month
							echo $jml_kas_bank_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_kas_bank); ?></strong> Saldo <br />Kas Bank
				<?php 
					if (count($grouped_penerimaan)) 
					{
						foreach ( $grouped_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_kas_bank_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_kas_bank_chart_perbulan += $chart['kas_bank'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_kas_bank = $jml_kas_bank_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_kas_bank = $jml_kas_bank_chart_perbulan;
										// calculation for getting percentation
										$percent_kas_bank = (($last_kas_bank - $before_last_kas_bank) / $before_last_kas_bank) * 100;
										if ($percent_kas_bank > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_kas_bank, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kas_bank < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_kas_bank, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_kas_bank === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_kas_bank, 2);
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
		
		<!-- saldo awal -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_penerimaan)) 
			{
				foreach ( $grouped_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_saldo_awal_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_saldo_awal_chart_perbulan += $chart['saldo_awal'];
							}
							// data up every month
							echo $jml_saldo_awal_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_saldo_awal); ?></strong> Saldo Awal<br />Penerimaan
				<?php 
					if (count($grouped_penerimaan)) 
					{
						foreach ( $grouped_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_saldo_awal_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_saldo_awal_chart_perbulan += $chart['saldo_awal'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_saldo_awal = $jml_saldo_awal_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_saldo_awal = $jml_saldo_awal_chart_perbulan;
										// calculation for getting percentation
										$percent_saldo_awal = (($last_saldo_awal - $before_last_saldo_awal) / $before_last_saldo_awal) * 100;
										if ($percent_saldo_awal > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_saldo_awal, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_saldo_awal < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_saldo_awal, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_saldo_awal === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_saldo_awal, 2);
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
		
		
		<!-- penerimaan -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_penerimaan)) 
			{
				foreach ( $grouped_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_penerimaan_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_penerimaan_chart_perbulan += $chart['penerimaan'];
							}
							// data up every month
							echo $jml_penerimaan_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_penerimaan); ?></strong> Penerimaan
				<?php 
					if (count($grouped_penerimaan)) 
					{
						foreach ( $grouped_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_penerimaan_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_penerimaan_chart_perbulan += $chart['penerimaan'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_penerimaan = $jml_penerimaan_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_penerimaan = $jml_penerimaan_chart_perbulan;
										// calculation for getting percentation
										$percent_penerimaan = (($last_penerimaan - $before_last_penerimaan) / $before_last_penerimaan) * 100;
										if ($percent_penerimaan > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_penerimaan, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_penerimaan < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_penerimaan, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_penerimaan === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_penerimaan, 2);
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
		
		
		<!-- penyetoran -->
		<li>
			<div class="inlinesparkline sparkline bar_week">
			<?php 
			if (count($grouped_penerimaan)) 
			{
				foreach ( $grouped_penerimaan as $tahun => $groups ) 
				{
					if($tahun !== '')
					{
						foreach ($groups as $bulan => $results) 
						{
							
							$jml_penyetoran_chart_perbulan = 0;
							foreach ($results as $chart) 
							{
								$jml_penyetoran_chart_perbulan += $chart['penyetoran'];
							}
							// data up every month
							echo $jml_penyetoran_chart_perbulan . ', ';
						}
					}
				}
			}
			?>
			</div>
		  <div class="stat_text">
			<strong>Rp <?php echo amount_format($jml_penyetoran); ?></strong> Penyetoran
				<?php 
					if (count($grouped_penerimaan)) 
					{
						foreach ( $grouped_penerimaan as $tahun => $groups ) 
						{
							if($tahun !== '')
							{
								
								$i = 0;
								$len = count($groups);
								foreach ($groups as $bulan => $results) 
								{
									$jml_penyetoran_chart_perbulan = 0;
									foreach ($results as $chart) 
									{
										$jml_penyetoran_chart_perbulan += $chart['penyetoran'];
									}
									
									// get last data in array and last data -1
									if ($i === $len - 2) 
									{
										$before_last_penyetoran = $jml_penyetoran_chart_perbulan;
									}
									else if ($i === $len - 1) 
									{
										$last_penyetoran = $jml_penyetoran_chart_perbulan;
										// calculation for getting percentation
										$percent_penyetoran = (($last_penyetoran - $before_last_penyetoran) / $before_last_penyetoran) * 100;
										if ($percent_penyetoran > 0) {
				?>
											<span class="percent up"> 
											<br />
											<i class="fa fa-caret-up"></i> 
				<?php
											echo round($percent_penyetoran, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_penyetoran < 0){
				?>
											<span class="percent down"> 
											<br />
											<i class="fa fa-caret-down"></i> 
				<?php
												echo round($percent_penyetoran, 2);
				?>
											%
											</span> 
				<?php
										}
										else if ($percent_penyetoran === 0){
				?>
											<span class="percent"> 
											<br />
				<?php
												echo round($percent_penyetoran, 2);
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
