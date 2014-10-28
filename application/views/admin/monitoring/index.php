            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5><?php echo $table_title; ?></h5>
                  </header>
                  
                  <div id="collapse4" class="body">
					  
					  <form class="form-horizontal" method="post" action="">
					  
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-2">Tahun</label>
						<div class="col-lg-3">
						  <input type="text" id="text1" placeholder="Tahun" class="form-control" name="year" maxlength="4" value="<?php echo $year; ?>"/>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-2">Bulan</label>
						<div class="col-lg-3">
						  <input type="text" id="text1" placeholder="Bulan" class="form-control" name="month" maxlength="2" autofocus="autofocus" />
						</div>
					  </div><!-- /.form-group -->
					  
					   <?php if ($this->data['id_entities'] === '2') { ?>
					   <div class="form-group">
						<label for="text4" class="control-label col-lg-2">Jenis Monitoring</label>
						<div class="col-lg-4">
							<select data-placeholder="Pilih Jenis Monitoring" id="mark" name="jenis_monitoring" class="form-control">
								<option value="">Pilih Jenis Monitoring</option>
								<option value="monitoring_per_kementerian">Monitoring Per Kementerian</option>
								<option value="monitoring_per_satker">Monitoring Per Satker</option>
							</select>
						</div>
					  </div><!-- /.form-group -->
					  <?php } ?>
					  
					  <div class="form-group">
						<div class="col-lg-2 controls">
							<?php 
								$attributes = 'class = "btn btn-primary btn-grad"';
								echo form_submit('submit', 'Tampilkan', $attributes);
							?>
						</div>
					  </div><!--/.form-group -->
					  
					  </form>
					  <hr />
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-6 bg-primary dker">Bulan <?php echo get_month_name($month); ?>&nbsp;&nbsp;</label>
						<label for="text2" class="control-label col-lg-6">Tahun <?php echo $year; ?></label>
					  </div>
					  <br />
					  <hr />
					  <!-- KPPN -->
					  <?php if ($this->data['id_entities'] === '1') { ?>
					  <div class="box">
						<header><h5>Status Pengiriman</h5></header>
						<div class="body">
							<ul>
								<?php 
									if ( $transaksi === 'pengeluaran') 
									{
										
										foreach ($count_satkers_k as $count_satker) 
										{
											if( $count_satker->tahun == NULL
												&& $count_satker->bulan == NULL )
											{
								?>
												<li>Jumlah Satker Yang <span class="text-danger">Belum</span> Mengirimkan LPJ Bendahara <span class="label label-danger">K</span> <span class="badge"><?php echo $count_satker->jml_lpj; ?></span></li>
								<?php
											} else {
								?>
												<li>Jumlah Satker Yang <span class="text-success">Sudah</span> Mengirimkan LPJ Bendahara <span class="label label-danger">K</span> <span class="badge"><?php echo $count_satker->jml_lpj; ?></span></li>
								<?php
											}
										}
									}
									
									if ( $transaksi === 'penerimaan') 
									{
										foreach ($count_satkers_p as $count_satker) 
										{
											if( $count_satker->tahun == NULL
												&& $count_satker->bulan == NULL )
											{
								?>
												<li>Jumlah Satker Yang <span class="text-danger">Belum</span> Mengirimkan LPJ Bendahara <span class="label label-info">P</span> <span class="badge"><?php echo $count_satker->jml_lpj; ?></span></li>
								<?php
											} else {
								?>
												<li>Jumlah Satker Yang <span class="text-success">Sudah</span> Mengirimkan LPJ Bendahara <span class="label label-info">P</span> <span class="badge"><?php echo $count_satker->jml_lpj; ?></span></li>
								<?php
											}
										}
									}
								?>
							</ul>
							
						</div>
					  </div><!--/box-->
					  <?php 
						}
						else if ($this->data['id_entities'] === '2') 
						{
					  ?>
					  
							<div class="text-center">
							  <ul class="stats_box">
								<li>
								<?php 
									if ( $transaksi === 'pengeluaran') 
									{
								?>
								  <div class="sparkline piechart pie_week">
									
									<?php 
											$total_monitor_satkers_k = 0;
											foreach ($monitor_satkers_k as $count_satker) 
											{
												// get total LPJ pengeluaran
												$total_monitor_satkers_k += $count_satker->jml_lpj;
												
												if( $count_satker->tahun === NULL
												&& $count_satker->bulan === NULL )
												{
													echo $count_satker->jml_lpj . ',';
												}
												else
												{
													echo $count_satker->jml_lpj;
												}
											}
									?>
									
								  </div>
								  <div class="stat_text">
									<strong><?php echo $total_monitor_satkers_k; ?></strong> Pengiriman  LPJ Pengeluaran
<!--
									<span class="percent down"> <i class="fa fa-caret-down"></i> -16%</span> 
-->
								  </div>
								<?php } 
								 
									if ( $transaksi === 'penerimaan') 
									{
								?>
								  <div class="piechart sparkline bar_week">
									
									<?php 
											$total_monitor_satkers_p = 0;
											foreach ($monitor_satkers_p as $count_satker) 
											{
												// get total LPJ penerimaan
												$total_monitor_satkers_p += $count_satker->jml_lpj;
												
												if( $count_satker->tahun === NULL
												&& $count_satker->bulan === NULL )
												{
													echo $count_satker->jml_lpj . ',';
												}
												else
												{
													echo $count_satker->jml_lpj;
												}
											}
									?>
									
								  </div>
								  <div class="stat_text">
									<strong><?php echo $total_monitor_satkers_p; ?></strong> Pengiriman  LPJ Penerimaan
<!--
									<span class="percent down"> <i class="fa fa-caret-down"></i> -16%</span> 
-->
								  </div>
								<?php } ?>
								
								</li>
							  </ul>
							</div><!--/text-center-->
           
						
					  <div class="box">
						<header><h5>Status Pengiriman</h5></header>
						<div class="body">
							<ul>
								<?php 
									if ( $transaksi === 'pengeluaran') 
									{
										
										foreach ($monitor_satkers_k as $count_satker) 
										{
											if( $count_satker->tahun == NULL
												&& $count_satker->bulan == NULL )
											{
								?>
												<li>Jumlah Satker Yang <span class="text-danger">Belum</span> Mengirimkan LPJ Bendahara <span class="label label-danger">K</span> <span class="badge"><?php echo $count_satker->jml_lpj; ?></span></li>
								<?php
											} else {
								?>
												<li>Jumlah Satker Yang <span class="text-success">Sudah</span> Mengirimkan LPJ Bendahara <span class="label label-danger">K</span> <span class="badge"><?php echo $count_satker->jml_lpj; ?></span></li>
								<?php
											}
										}
									}
									
									if ( $transaksi === 'penerimaan') 
									{
										foreach ($monitor_satkers_p as $count_satker) 
										{
											if( $count_satker->tahun == NULL
												&& $count_satker->bulan == NULL )
											{
								?>
												<li>Jumlah Satker Yang <span class="text-danger">Belum</span> Mengirimkan LPJ Bendahara <span class="label label-info">P</span> <span class="badge"><?php echo $count_satker->jml_lpj; ?></span></li>
								<?php
											} else {
								?>
												<li>Jumlah Satker Yang <span class="text-success">Sudah</span> Mengirimkan LPJ Bendahara <span class="label label-info">P</span> <span class="badge"><?php echo $count_satker->jml_lpj; ?></span></li>
								<?php
											}
										}
									}
								?>
							</ul>
							
						</div>
					  </div><!--/box-->
					  <?php
						}
					  ?>
					  
					  Keterangan:
						<ul>
							<li class="text-warning"><span class="label label-info">P</span> : Data LPJ Penerimaan</li>
							<li class="text-warning"><span class="label label-danger">K</span> : Data LPJ Pengeluaran</li>
						</ul>
					  <hr />
					  <div class="form-group">
							<label for="text3" class="control-label col-lg-12 bg-green">Satker Yang Sudah Mengirimkan LPJ Bendahara <?php echo ucfirst($transaksi); ?></label>
					  </div>
					  <br />
					  <hr />
					  <!-- table -->
                    <table class="table table-bordered table-condensed table-hover table-striped display">
						<thead style="font-size:11px;">
							<tr>
							<?php if ($this->data['id_entities'] === '1') { ?>
								<th>No.
								<i class="fa sort"></i></th>
								<th>Kode Satker
								<i class="fa sort"></i></th>
								<th style="width: 80%;overflow:hidden;display: inline-block;white-space: nowrap;">Nama Satker
								<i class="fa sort"></i></th>
							<?php 
								} 
								else if ($this->data['id_entities'] === '2')
								{
									if ( $jenis_monitoring === 'monitoring_per_kementerian' ) 
									{
							?>
										<th>No.
										<i class="fa sort"></i></th>
										<th>Kode dan Nama KPPN
										<i class="fa sort"></i></th>
										<th>Kode dan Nama Kementerian
										<i class="fa sort"></i></th>
										<th>Data Sudah Diterima 
										<i class="fa sort"></i></th>
							<?php 
									}
									else if ( $jenis_monitoring === 'monitoring_per_satker' ) 
									{
							?>
										<th>No.
										<i class="fa sort"></i></th>
										<th>Kode dan Nama KPPN
										<i class="fa sort"></i></th>
										<th>Kode dan Nama Kementerian
										<i class="fa sort"></i></th>
										<th>Kode dan Nama Satker 
										<i class="fa sort"></i></th>
							<?php
									}
								} 
								else if ($this->data['id_entities'] === '3')
								{
							?>
									<th>No.
									<i class="fa sort"></i></th>
									<th>Kanwil
									<i class="fa sort"></i></th>
									<th>KPPN
									<i class="fa sort"></i></th>
									<th>Kode Kementerian
									<i class="fa sort"></i></th>
									<th>Data Diterima 
									<i class="fa sort"></i></th>
							<?php } ?>
							</tr>
						</thead>
						<tbody style="font-size:11px;">
							<?php
								if ($this->data['id_entities'] === '1') {
									if ($transaksi === 'pengeluaran') 
									{
										// transaksi pengeluaran sents
										if (count($monitor_satker_pengeluaran_sents)) 
											{
												$i = 0;
												foreach ($monitor_satker_pengeluaran_sents as $monitor_satker_sent) 
												{
							?>
													<tr>
													  <td><?php echo ++$i; ?></td>
													  <td><?php echo $monitor_satker_sent->kd_satker; ?></td>
													  <td style="width: 80%;overflow:hidden;display: inline-block;white-space: nowrap;"><?php echo $monitor_satker_sent->nm_satker; ?></td>
													</tr>
							
							<?php
												}
											}
										}
										
										// transaksi penerimaan sents
										if ($transaksi === 'penerimaan') 
										{
											if (count($monitor_satker_penerimaan_sents)) 
											{
												$i = 0;
												foreach ($monitor_satker_penerimaan_sents as $monitor_satker_sent) 
												{
							?>
													<tr>
													  <td><?php echo ++$i; ?></td>
													  <td><?php echo $monitor_satker_sent->kd_satker; ?></td>
													  <td style="width: 80%;overflow:hidden;display: inline-block;white-space: nowrap;"><?php echo $monitor_satker_sent->nm_satker; ?></td>
													</tr>
							
							<?php
													
												}
											}
											
										}
									} 
									else if ($this->data['id_entities'] === '2')
									{
										// pengeluaran sents
										if ($transaksi === 'pengeluaran'
											&& $jenis_monitoring === 'monitoring_per_kementerian') 
										{
											
											if (count($monitor_kppns_pengeluaran_sents)) 
											{
												$i = 0;
												foreach ($monitor_kppns_pengeluaran_sents as $monitor_kppn_sent) 
												{
							?>
												<tr>
												  <td><?php echo ++$i; ?></td>
												  <td><?php echo $monitor_kppn_sent->kd_kppn . ' - ' . $monitor_kppn_sent->nm_kppn; ?></td>
												  <td><?php echo $monitor_kppn_sent->kd_kementerian . ' - ' . $monitor_kppn_sent->nm_kementerian; ?></td>
												  <td><?php echo $monitor_kppn_sent->jml_lpj_kementerian; ?></td>
												</tr>
							<?php
												}
											}
										}
										else if ($transaksi === 'pengeluaran'
											&& $jenis_monitoring === 'monitoring_per_satker') 
										{
											
											
											if (count($monitor_satkers_pengeluaran_sents)) 
											{
												$i = 0;
												foreach ($monitor_satkers_pengeluaran_sents as $monitor_satker_sent) 
												{
							?>
												<tr>
												  <td><?php echo ++$i; ?></td>
												  <td><?php echo $monitor_satker_sent->kd_kppn . ' - ' . $monitor_satker_sent->nm_kppn; ?></td>
												  <td style="white-space:normal;"><?php echo $monitor_satker_sent->kd_kementerian . ' - ' . $monitor_satker_sent->nm_kementerian; ?></td>
												  <td style="white-space:normal;"><?php echo $monitor_satker_sent->kd_satker . ' - ' . $monitor_satker_sent->nm_satker; ?></td>
												</tr>
							<?php
												}
											}
											
											
										}
										
										// penerimaan sents
										if ($transaksi === 'penerimaan'
											&& $jenis_monitoring === 'monitoring_per_kementerian') 
										{
											if (count($monitor_kppns_penerimaan_sents)) 
											{
												$i = 0;
												foreach ($monitor_kppns_penerimaan_sents as $monitor_kppn_sent) 
												{
							?>
												<tr>
												  <td><?php echo ++$i; ?></td>
												  <td><?php echo $monitor_kppn_sent->kd_kppn . ' - ' . $monitor_kppn_sent->nm_kppn; ?></td>
												  <td><?php echo $monitor_kppn_sent->kd_kementerian . ' - ' . $monitor_kppn_sent->nm_kementerian; ?></td>
												  <td><?php echo $monitor_kppn_sent->jml_lpj_kementerian; ?></td>
												</tr>
							<?php
												
												}
											}
										}
										else if ($transaksi === 'penerimaan'
											&& $jenis_monitoring === 'monitoring_per_satker') 
										{
											if (count($monitor_satkers_penerimaan_sents)) 
											{
												$i = 0;
												foreach ($monitor_satkers_penerimaan_sents as $monitor_satker_sent) 
												{
							?>
												<tr>
												  <td><?php echo ++$i; ?></td>
												  <td><?php echo $monitor_satker_sent->kd_kppn . ' - ' . $monitor_satker_sent->nm_kppn; ?></td>
												  <td style="white-space:normal;"><?php echo $monitor_satker_sent->kd_kementerian . ' - ' . $monitor_satker_sent->nm_kementerian; ?></td>
												  <td style="white-space:normal;"><?php echo $monitor_satker_sent->kd_satker . ' - ' . $monitor_satker_sent->nm_satker; ?></td>
												</tr>
							<?php
												
												}
											}
										}
									} 
									else if ($this->data['id_entities'] === '3')
									{
										if (count($monitor_kanwils_sents)) 
										{
											$i = 0;
											foreach ($monitor_kanwils_sents as $monitor_kanwil_sent) 
											{
							?>
											<tr>
												<td><?php echo ++$i; ?></td>
												<td>
													<?php echo $monitor_kanwil_sent->kd_kanwil . ' - ' . $monitor_kanwil_sent->nm_kanwil; ?>
												</td>
												<td>
													<?php echo $monitor_kanwil_sent->kd_kppn . ' - ' . $monitor_kanwil_sent->nm_kppn; ?>
												</td>
												<td><?php echo $monitor_kanwil_sent->kd_kementerian; ?></td>
												<td><?php echo $monitor_kanwil_sent->jml_lpj; ?></td>
											</tr>
						<?php
											}
										}
										else
										{
						?>
										<tr>
											<td colspan="16">Data pada tahun <span class="label label-danger"><?php echo $year; ?></span> bulan <span class="label label-danger"><?php echo $month; ?></span> tidak ada</td>
										</tr>
						<?php
										}
									}
						?>
						</tbody>
					  </table>
					  <br />
					  
					  <!-- satker yang belum -->
					  <hr /> 
					  <div class="form-group">
							<label for="text3" class="control-label col-lg-12 bg-red">Satker Yang Belum Mengirimkan LPJ Bendahara <?php echo ucfirst($transaksi); ?></label>
					  </div>
					  <br />
					  <hr />
					<!-- table -->
                    <table class="table table-bordered table-condensed table-hover table-striped display">
						<thead style="font-size:11px;">
							<tr>
								<?php if ($this->data['id_entities'] === '1') { ?>
									<th>No.
									<i class="fa sort"></i></th>
									<th>Kode Satker
									<i class="fa sort"></i></th>
									<th style="width: 80%;overflow:hidden;display: inline-block;white-space: nowrap;">Nama Satker
									<i class="fa sort"></i></th>
								<?php 
									} 
									else if ($this->data['id_entities'] === '2') 
									{ 
										if ($jenis_monitoring === 'monitoring_per_kementerian') 
										{
								?>
											<th>No.
											<i class="fa sort"></i></th>
											<th>Kode dan Nama KPPN
											<i class="fa sort"></i></th>
											<th>Kode dan Nama Kementerian
											<i class="fa sort"></i></th>
											<th>Data Belum Diterima 
											<i class="fa sort"></i></th>
								<?php 
										}
										else if ($jenis_monitoring === 'monitoring_per_satker') 
										{
								?>
											<th>No.
											<i class="fa sort"></i></th>
											<th>Kode dan Nama KPPN
											<i class="fa sort"></i></th>
											<th>Kode dan Nama Kementerian
											<i class="fa sort"></i></th>
											<th>Kode dan Nama Satker
											<i class="fa sort"></i></th>
								<?php 
											
										}
									} 
									else if ($this->data['id_entities'] === '3')
									{
								?>
									<th>No.
									<i class="fa sort"></i></th>
									<th>Kanwil
									<i class="fa sort"></i></th>
									<th>KPPN
									<i class="fa sort"></i></th>
									<th>Kode Kementerian
									<i class="fa sort"></i></th>
									<th>Data Belum Diterima 
									<i class="fa sort"></i></th>
								<?php } ?>
							</tr>
						</thead>
                      <tbody style="font-size:11px;">
						<?php 
							if ( $this->data['id_entities'] === '1' )
							{
								// transaksi pengeluaran unsents
								if ($transaksi === 'pengeluaran') 
								{
									
									if (count($monitor_satker_pengeluaran_unsents)) 
									{
										$i = 0;
										foreach ($monitor_satker_pengeluaran_unsents as $monitor_satker_unsent) 
										{
						?>
											<tr>
											  <td><?php echo ++$i; ?></td>
											  <td><?php echo $monitor_satker_unsent->kd_satker; ?></td>
											  <td style="width: 80%;overflow:hidden;display: inline-block;white-space: nowrap;"><?php echo $monitor_satker_unsent->nm_satker; ?></td>
											</tr>
						<?php
										}
									}
								}
								
								// transaksi penerimaan unsents
								if ($transaksi === 'penerimaan') 
								{
									
									if (count($monitor_satker_penerimaan_unsents)) 
									{
										$i = 0;
										foreach ($monitor_satker_penerimaan_unsents as $monitor_satker_unsent) 
										{
						?>
											<tr>
											  <td><?php echo ++$i; ?></td>
											  <td><?php echo $monitor_satker_unsent->kd_satker; ?></td>
											  <td style="width: 80%;overflow:hidden;display: inline-block;white-space: nowrap;"><?php echo $monitor_satker_unsent->nm_satker; ?></td>
											</tr>
						<?php
										}
									}
								}
							}
							else if ( $this->data['id_entities'] === '2' )
							{
								// transaksi pengeluaran unsents
								if ($transaksi === 'pengeluaran'
									&& $jenis_monitoring === 'monitoring_per_kementerian') 
								{
									
									if (count($monitor_kppns_pengeluaran_unsents)) 
									{
										$i = 0;
										foreach ($monitor_kppns_pengeluaran_unsents as $monitor_kppn_unsent) 
										{
						?>
											<tr>
											  <td><?php echo ++$i; ?></td>
											  <td><?php echo $monitor_kppn_unsent->kd_kppn . ' - ' . $monitor_kppn_unsent->nm_kppn; ?></td>
											  <td><?php echo $monitor_kppn_unsent->kd_kementerian . ' - ' . $monitor_kppn_unsent->nm_kementerian; ?></td>
											  <td><?php echo $monitor_kppn_unsent->jml_lpj_kementerian; ?></td>
											</tr>
						<?php 
										}
									}
									else
									{
						?>
										<tr>
											<td colspan="16">Data pada tahun <span class="label label-danger"><?php echo $year; ?></span> bulan <span class="label label-danger"><?php echo $month; ?></span> tidak ada</td>
										</tr>
						<?php
									}
								}
								else if ($transaksi === 'pengeluaran'
									&& $jenis_monitoring === 'monitoring_per_satker') 
								{
									
									if (count($monitor_satkers_pengeluaran_unsents)) 
									{
										$i = 0;
										foreach ($monitor_satkers_pengeluaran_unsents as $monitor_satker_unsent) 
										{
						?>
											<tr>
											  <td><?php echo ++$i; ?></td>
											  <td><?php echo $monitor_satker_unsent->kd_kppn . ' - ' . $monitor_satker_unsent->nm_kppn; ?></td>
											  <td style="white-space:normal;"><?php echo $monitor_satker_unsent->kd_kementerian . ' - ' . $monitor_satker_unsent->nm_kementerian; ?></td>
											  <td style="white-space:normal;"><?php echo $monitor_satker_unsent->kd_satker . ' - ' . $monitor_satker_unsent->nm_satker; ?></td>
											</tr>
						<?php 
										}
									}
									else
									{
						?>
										<tr>
											<td colspan="16">Data pada tahun <span class="label label-danger"><?php echo $year; ?></span> bulan <span class="label label-danger"><?php echo $month; ?></span> tidak ada</td>
										</tr>
						<?php
									}
								}
								
								// penerimaan unsents
								if ($transaksi === 'penerimaan'
									&& $jenis_monitoring === 'monitoring_per_kementerian') 
								{
									if (count($monitor_kppns_penerimaan_unsents)) 
									{
										$i = 0;
										foreach ($monitor_kppns_penerimaan_unsents as $monitor_kppn_unsent) 
										{
											
						?>
											<tr>
											  <td><?php echo ++$i; ?></td>
											  <td><?php echo $monitor_kppn_unsent->kd_kppn . ' - ' . $monitor_kppn_unsent->nm_kppn; ?></td>
											  <td><?php echo $monitor_kppn_unsent->kd_kementerian . ' - ' . $monitor_kppn_unsent->nm_kementerian; ?></td>
											  <td><?php echo $monitor_kppn_unsent->jml_lpj_kementerian; ?></td>
											</tr>
						<?php 
										}
									}
									else
									{
						?>
										<tr>
											<td colspan="16">Data pada tahun <span class="label label-danger"><?php echo $year; ?></span> bulan <span class="label label-danger"><?php echo $month; ?></span> tidak ada</td>
										</tr>
						<?php
									}
								}
								else if ($transaksi === 'penerimaan'
									&& $jenis_monitoring === 'monitoring_per_satker') 
								{
									if (count($monitor_satkers_penerimaan_unsents)) 
									{
										$i = 0;
										foreach ($monitor_satkers_penerimaan_unsents as $monitor_satker_unsent) 
										{
											
						?>
											<tr>
											  <td><?php echo ++$i; ?></td>
											  <td><?php echo $monitor_satker_unsent->kd_kppn . ' - ' . $monitor_satker_unsent->nm_kppn; ?></td>
											  <td style="white-space:normal;"><?php echo $monitor_satker_unsent->kd_kementerian . ' - ' . $monitor_satker_unsent->nm_kementerian; ?></td>
											  <td style="white-space:normal;"><?php echo $monitor_satker_unsent->kd_satker . ' - ' . $monitor_satker_unsent->nm_satker; ?></td>
											</tr>
						<?php 
										}
									}
									else
									{
						?>
										<tr>
											<td colspan="16">Data pada tahun <span class="label label-danger"><?php echo $year; ?></span> bulan <span class="label label-danger"><?php echo $month; ?></span> tidak ada</td>
										</tr>
						<?php
									}
								}
								
							}
							else if ( $this->data['id_entities'] === '3' )
							{
								if (count($monitor_kanwils_unsents))
								{
									$i = 0;
									foreach ($monitor_kanwils_unsents as $monitor_kanwil_unsent) 
									{
						?>
							<tr>
								<td><?php echo ++$i; ?></td>
								<td>
									<?php echo $monitor_kanwil_unsent->kd_kanwil . ' - ' . $monitor_kanwil_unsent->nm_kanwil; ?>
								</td>
								<td>
									<?php echo $monitor_kanwil_unsent->kd_kppn . ' - ' . $monitor_kanwil_unsent->nm_kppn; ?>
								</td>
								<td><?php echo $monitor_kanwil_unsent->kd_kementerian; ?></td>
								<td><?php echo $monitor_kanwil_unsent->jml_lpj; ?></td>
							</tr>
						<?php
									}
								}
								else
								{
						?>
									<tr>
										<td colspan="16">Data pada tahun <span class="label label-danger"><?php echo $year; ?></span> bulan <span class="label label-danger"><?php echo $month; ?></span> tidak ada</td>
									</tr>
								<?php
								}
							}
						?>
                      </tbody>
                    </table>
                    
                  </div><!--/sortableTable-->
                </div><!--/box-->
              </div><!--/col-lg-12-->
            </div><!-- /.row -->
            <!--End Datatables-->
