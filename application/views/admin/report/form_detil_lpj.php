
	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				
				<header>
					<div class="icons">
						<i class="glyphicon glyphicon-print"></i>
					</div><!--/icons-->
					<h5>Pencetakan Detil LPJ <?php echo $title; ?></h5>
					
					<!-- .toolbar -->
					<div class="toolbar">
						<nav style="padding: 8px;">
							<a href="javascript:;" class="btn btn-default btn-xs collapse-box">
							  <i class="fa fa-minus"></i>
							</a> 
							<a href="javascript:;" class="btn btn-default btn-xs full-box">
							  <i class="fa fa-expand"></i>
							</a> 
							<a href="javascript:;" class="btn btn-danger btn-xs close-box">
							  <i class="fa fa-times"></i>
							</a> 
						</nav>
					</div><!--/.toolbar-->
				</header>
				
				<div id="collapse4"  class="body">
					<?php if (validation_errors()) { ?>
						<div id="login-alert" class="alert alert-danger col-sm-12">
						<?php echo validation_errors(); ?>
						</div>
					<?php } ?>
					
					<form class="form-horizontal" method="post" action="" >
					  
					  <?php if($id_entities === '3'){ ?>
					  <div class="form-group">
						<label for="text4" class="control-label col-lg-5">Kanwil</label>
						<div class="col-lg-4">
							
							<select data-placeholder="Pilih Kanwil" id="mark" name="id_ref_kanwil" class="form-control chzn-select">
								<option value="">Pilih Kanwil</option>
								<?php 
									foreach ($dropdown_kanwil as $kanwil) 
									{
										?>
										<option value="<?php echo $kanwil->id_ref_kanwil?>">( <?php echo $kanwil->kd_kanwil?> ) <?php echo $kanwil->nm_kanwil; ?></option>
										<?php
									}
								?>
							</select>
							
						</div>
					  </div><!-- /.form-group -->
					  <?php } ?>
					  
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-5">Tahun</label>
						<div class="col-lg-2">
						  <input type="text" id="text1" placeholder="Tahun" class="form-control" name="year" maxlength="4" value="<?php echo $year; ?>"/>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-5">Bulan</label>
						<div class="col-lg-2">
						  <input type="text" id="text1" placeholder="Bulan contoh: 01" class="form-control" name="month" maxlength="2" autofocus="autofocus" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
					   <label class="control-label col-lg-5">Pos</label>
						<div class="col-lg-4">
						  <div class="checkbox">
							<label>
							  <input class="uniform" type="radio" name="post" value="penerimaan" >Penerimaan
							</label>
							<label>
							  <input class="uniform" type="radio" name="post" value="pengeluaran">Pengeluaran
							</label>
						  </div><!-- /.checkbox -->
						</div><!-- /col-lg-8 -->
					  </div><!-- /.form-group-->
					  
					  <div class="text-center">
						  <div class="btn-group">
							<div class="col-lg-12 controls">
								<?php 
									$attributes = 'class = "btn btn-primary btn-grad"';
									echo form_submit('submit', 'Tampilkan', $attributes);
								?>
								<?php 
									$attributes = 'class = "btn btn-success btn-grad"';
									echo form_submit('submit', 'XLSX', $attributes);
								?>
								<?php 
									$attributes = 'class = "btn btn-danger btn-grad"';
									echo form_submit('submit', 'PDF', $attributes);
								?>
							</div>
						  </div><!--/.btn-group -->
					  </div><!--/text-center -->
					  
					  </form>
					  
					  <?php if (count($detil_kanwil)){ ?>
					  
					  <hr />
					  <h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
					  <?php echo $nm_entity; ?><br /></h4>
					  <h5 class="text-center"><?php echo $period; ?></h5>
					  <div class="table-responsive">
					  <!-- table -->
					  <table class="table table-bordered table-condensed">
						<thead style="font-size:11px;">
							<tr class="bg-green dker">
								<th rowspan="2">KPPN<br />
												Kementerian</th>
								<th rowspan="2">Satker</th>
								<th colspan="5">Saldo Kas Menurut Buku Pembantu (BP)</th>
								<th colspan="3">Uang Persediaan</th>
							</tr>
							<tr class="bg-green dker">
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
								<tr style="font-weight: bold; font-size:11px;">
									<td class="bg-green lter" colspan="10">KPPN <?php echo $kppn; ?></td>
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
								<tr style="font-weight: bold; font-size:11px;">
									<td class="bg-green" colspan="10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $kementerian; ?></td>
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
										<tr style="font-size:11px;white-space:normal;">
											<td></td>
											<td><?php echo $detil['kd_satker'] . ' ' . $detil['nm_satker']; ?></td>
											<td align="right"><?php echo amount_format($detil['uang_persediaan']); ?></td>
											<td align="right"><?php echo amount_format($detil['ls_bendahara']); ?></td>
											<td align="right"><?php echo amount_format($detil['pajak']); ?></td>
											<td align="right"><?php echo amount_format($detil['pengeluaran_lain']); ?></td>
											<td align="right" class="bg-blue dk"><?php echo amount_format($saldo_bp_pengeluaran); ?></td>
											<td align="right"><?php echo amount_format($detil['saldo']); ?></td>
											<td align="right"><?php echo amount_format($detil['kuitansi']); ?></td>
											<td align="right" class="bg-blue dker"><?php echo amount_format($saldo_up_pengeluaran); ?></td>
										</tr>
						<?php
									}
						?>
								<tr style="font-weight: bold; font-style: italic; font-size:11px;" class="bg-brick lter">
									<td colspan="2" style="white-space:normal;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JUMLAH <?php echo $kementerian; ?></td>
									<td align="right"><?php echo amount_format($saldo_uang_persediaan_pengeluaran); ?></td>
									<td align="right"><?php echo amount_format($saldo_ls_bendahara_pengeluaran); ?></td>
									<td align="right"><?php echo amount_format($saldo_pajak_pengeluaran); ?></td>
									<td align="right"><?php echo amount_format($saldo_pengeluaran_lain_pengeluaran); ?></td>
									<td align="right"><?php echo amount_format($saldo_bp_kementerian_pengeluaran); ?></td>
									<td align="right"><?php echo amount_format($saldo_saldo_pengeluaran); ?></td>
									<td align="right"><?php echo amount_format($saldo_kuitansi_pengeluaran); ?></td>
									<td align="right"><?php echo amount_format($saldo_up_kementerian_pengeluaran); ?></td>
								</tr>
						<?php
								}
						?>
							<tr style="font-size:11px;font-weight:bold;" class="bg-brick dker">
								<td colspan="2" style="white-space:normal;">JUMLAH TOTAL KPPN <?php echo $kppn; ?></td>
								<td align="right"><?php echo amount_format($saldo_total_uang_persediaan_pengeluaran); ?></td>
								<td align="right"><?php echo amount_format($saldo_total_ls_bendahara_pengeluaran); ?></td>
								<td align="right"><?php echo amount_format($saldo_total_pajak_pengeluaran); ?></td>
								<td align="right"><?php echo amount_format($saldo_total_pengeluaran_lain_pengeluaran); ?></td>
								<td align="right"><?php echo amount_format($sum_saldo_total_bp_pengeluaran); ?></td>
								<td align="right"><?php echo amount_format($saldo_total_saldo_pengeluaran); ?></td>
								<td align="right"><?php echo amount_format($saldo_total_kuitansi_pengeluaran); ?></td>
								<td align="right"><?php echo amount_format($sum_saldo_total_up_pengeluaran); ?></td>
							</tr>
						<?php
							} 
						?>
						</tbody>
					  </table>
					  <?php 
						} 
						// kanwil penerimaan
						else if(count($detil_kanwil_penerimaan))
						{
					  ?>
						  <hr />
						  <h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
						  <?php echo $nm_entity; ?><br /></h4>
						  <h5 class="text-center"><?php echo $period; ?></h5>
						  <!-- table -->
						  <table class="table table-bordered table-condensed">
							<thead style="font-size:11px;">
								<tr class="bg-green dker">
									<th rowspan="2">KPPN<br />
													Kementerian</th>
									<th rowspan="2">Satker</th>
									<th colspan="3">Saldo Kas</th>
									<th colspan="4">Saldo Penerimaan dan Penyetoran</th>
								</tr>
								<tr class="bg-green dker">
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
									<tr style="font-weight: bold; font-size:11px;">
										<td class="bg-green dk" colspan="10"><?php echo $kppn; ?></td>
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
									<tr style="font-weight: bold; font-size:11px;">
										<td class="bg-green lt" colspan="10">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $kementerian; ?></td>
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
											<tr style="font-size:11px;white-space:normal;">
												<td></td>
												<td><?php echo $detil['kd_satker'] . ' ' . $detil['nm_satker']; ?></td>
												<td align="right"><?php echo amount_format($detil['kas_tunai']); ?></td>
												<td align="right"><?php echo amount_format($detil['kas_bank']); ?></td>
												<td align="right" class="bg-blue dk"><?php echo amount_format($saldo_kas_penerimaan); ?></td>
												<td align="right"><?php echo amount_format($detil['saldo_awal']); ?></td>
												<td align="right"><?php echo amount_format($detil['penerimaan']); ?></td>
												<td align="right"><?php echo amount_format($detil['penyetoran']); ?></td>
												<td align="right" class="bg-blue dker"><?php echo amount_format($saldo_penerimaan_penyetoran_penerimaan); ?></td>
											</tr>
							<?php
										}
							?>
									<tr style="font-weight: bold; font-style: italic; font-size:11px;" class="bg-brick lter">
										<td colspan="2" style="white-space:normal;">&nbsp;&nbsp;&nbsp;&nbsp;JUMLAH <?php echo $kementerian; ?></td>
										<td align="right"><?php echo amount_format($saldo_kas_tunai_penerimaan); ?></td>
										<td align="right"><?php echo amount_format($saldo_kas_bank_penerimaan); ?></td>
										<td align="right"><?php echo amount_format($saldo_kas_kementerian_penerimaan); ?></td>
										<td align="right"><?php echo amount_format($saldo_saldo_awal_penerimaan); ?></td>
										<td align="right"><?php echo amount_format($saldo_penerimaan_penerimaan); ?></td>
										<td align="right"><?php echo amount_format($saldo_penyetoran_penerimaan); ?></td>
										<td align="right"><?php echo amount_format($saldo_penerimaan_kementerian_penerimaan); ?></td>
									</tr>
							<?php
									}
							?>
								<tr style="font-size:11px;font-weight:bold;" class="bg-brick dker">
									<td colspan="2" style="white-space:normal;">&nbsp;&nbsp;&nbsp;&nbsp;JUMLAH TOTAL KPPN <?php echo $kppn; ?></td>
									<td align="right"><?php echo amount_format($saldo_total_kas_tunai_penerimaan); ?></td>
									<td align="right"><?php echo amount_format($saldo_total_kas_bank_penerimaan); ?></td>
									<td align="right"><?php echo amount_format($sum_saldo_total_saldo_kas_penerimaan); ?></td>
									<td align="right"><?php echo amount_format($saldo_total_saldo_awal_penerimaan); ?></td>
									<td align="right"><?php echo amount_format($saldo_total_penerimaan_penerimaan); ?></td>
									<td align="right"><?php echo amount_format($saldo_total_penyetoran_penerimaan); ?></td>
									<td align="right"><?php echo amount_format($sum_saldo_total_penerimaan_penerimaan); ?></td>
								</tr>
							<?php
								} 
							?>
							</tbody>
						  </table>
					  <?php 
						}
					  ?>
					</div><!--/responsive-table-->
				  </div><!--/collapse4-->
			</div><!--/box-dark-->
		</div><!--/col-lg-6-->
	</div><!--/row-->
