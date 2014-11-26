
	<div class="row">
		<div class="col-lg-12">
			<div class="box dark">
				
				<header>
					<div class="icons">
						<i class="glyphicon glyphicon-print"></i>
					</div><!--/icons-->
					<h5>Pencetakan Rekapitulasi LPJ <?php echo $title; ?></h5>
					
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
					<hr />
					<form class="form-horizontal" method="post" action="">
					  
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-5">Tahun</label>
						<div class="col-lg-2">
						  <input type="text" id="text1" placeholder="Tahun" class="form-control" name="year" maxlength="4" value="<?php echo $year; ?>"/>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-5">Bulan</label>
						<div class="col-lg-2">
						  <input type="text" id="text1" placeholder="Bulan" class="form-control" name="month" maxlength="2" autofocus="autofocus" />
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
									$submit_pdf = array(
										'name'		=> 'submit',
										'value'		=> 'PDF',
										'class'		=> 'btn btn-danger btn-grad',
										//~ 'onClick'	=> "this.form.target='_blank';return true;"
									);
									echo form_submit($submit_pdf);
								?>
							</div><!--/.col-lg-12 -->
						</div><!--/.btn-group -->
					  </div><!--/.text-center -->
					  
					  </form>
					  
					  <?php 
							if (count($rekap_satker)
								&& $id_entities === '1')
							{
							?>
							  <hr />
							  <h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
							  <?php echo $nm_entity; ?><br /></h4>
							  <h5 class="text-center"><?php echo $period; ?></h5>
							  <br />
							  <div class="table-responsive">
							  <!-- table -->
							  <table class="table table-bordered table-condensed">
								<thead style="font-size:11px;">
									<tr class="bg-light lter">
										<th colspan="2">Kode</th>
										<th rowspan="2">Uraian Satker</th>
										<th colspan="5">Saldo Kas Menurut Buku Pembantu (BP)</th>
										<th colspan="3">Uang Persediaan</th>
									</tr>
									<tr class="bg-light lter">
										
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
											<tr style="font-weight: bold; font-size:11px;">
												<td class="bg-light dk" colspan="11"><?php echo $kementerian; ?></td>
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
													<tr style="font-size:11px;">
														<td></td>
														<td><?php echo $satker['kd_satker']; ?></td>
														<td style='white-space:normal;'><?php echo $satker['nm_satker']; ?></td>
														<td align="right"><?php echo amount_format($satker['uang_persediaan']); ?></td>
														<td align="right"><?php echo amount_format($satker['ls_bendahara']); ?></td>
														<td align="right"><?php echo amount_format($satker['pajak']); ?></td>
														<td align="right"><?php echo amount_format($satker['pengeluaran_lain']); ?></td>
														<td align="right" style="font-weight:bold;"><?php echo amount_format($sum_saldo_kas_bp); ?></td>
														<td align="right"><?php echo amount_format($satker['saldo']); ?></td>
														<td align="right"><?php echo amount_format($satker['kuitansi']); ?></td>
														<td align="right" style="font-weight:bold;"><?php echo amount_format($sum_saldo_up); ?></td>
													</tr>
												<?php
											}
										}
										$sum_total_saldo_kas_bp = $sum_uang_persediaan + $sum_ls_bendahara + $sum_pajak + $sum_pengeluaran_lain;
										$sum_total_saldo_up = $sum_saldo + $sum_kuitansi;
										
										?>
										<tr style="font-size:11px;font-weight:bold;" class="bg-light dk">
											<td colspan="3" style="white-space:normal;">JUMLAH TOTAL <?php echo strtoupper($nm_entity); ?></td>
											<td align="right"><?php echo amount_format($sum_uang_persediaan); ?></td>
											<td align="right"><?php echo amount_format($sum_ls_bendahara); ?></td>
											<td align="right"><?php echo amount_format($sum_pajak); ?></td>
											<td align="right"><?php echo amount_format($sum_pengeluaran_lain); ?></td>
											<td align="right"><?php echo amount_format($sum_total_saldo_kas_bp); ?></td>
											<td align="right"><?php echo amount_format($sum_saldo); ?></td>
											<td align="right"><?php echo amount_format($sum_kuitansi); ?></td>
											<td align="right"><?php echo amount_format($sum_total_saldo_up); ?></td>
										</tr>
								</tbody>
							  </table>
							<?php
							}
							else if (count($rekap_satker_penerimaan)
									&& $id_entities === '1')
							{
								
							?>
							  <hr />
							  <h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
							  <?php echo $nm_entity; ?><br /></h4>
							  <h5 class="text-center"><?php echo $period; ?></h5>
							  <br />
							  <div class="table-responsive">
							  <!-- table -->
							  <table class="table table-bordered table-condensed">
								<thead style="font-size:11px;">
									<tr class="bg-light lter">
										<th colspan="2">Kode</th>
										<th rowspan="2">Uraian Satker</th>
										<th colspan="3">Saldo Kas</th>
										<th colspan="4">Saldo Penerimaan dan Penyetoran</th>
									</tr>
									<tr class="bg-light lter">
										
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
											<tr style="font-weight: bold; font-size:11px;">
												<td class="bg-light dk" colspan="10"><?php echo $kementerian; ?></td>
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
										
										<tr style="font-size:11px;font-weight:bold;" class="bg-light dk">
											<td colspan="3" style="white-space:normal;">JUMLAH TOTAL <?php echo strtoupper($nm_entity); ?></td>
											<td align="right"><?php echo amount_format($sum_kas_tunai); ?></td>
											<td align="right"><?php echo amount_format($sum_kas_bank); ?></td>
											<td align="right"><?php echo amount_format($sum_total_saldo_kas_penerimaan); ?></td>
											<td align="right"><?php echo amount_format($sum_saldo_awal); ?></td>
											<td align="right"><?php echo amount_format($sum_penerimaan); ?></td>
											<td align="right"><?php echo amount_format($sum_penyetoran); ?></td>
											<td align="right"><?php echo amount_format($sum_total_saldo_penerimaan_setor); ?></td>
										</tr>
								</tbody>
							  </table>
							  
							<?php
							}
							// Rekap Kanwil Pengeluaran
							else if ( count($rekap_lpjs)
									&& $id_entities === '2')
							{
							?>
								<hr />
								<h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
								<?php echo $nm_entity; ?><br /></h4>
								<h5 class="text-center"><?php echo $period; ?></h5>
								<br />
								<div class="table-responsive">
								<!-- table -->
								<table class="table table-bordered table-condensed table-striped">
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
									<tbody style="font-size:11px;">
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
												<td style="white-space:normal;"><?php echo ucwords(strtolower($rekap_lpj->nm_kementerian)); ?></td>
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
										<tr style="font-weight:bold;">
											<td colspan="2" align="center">Jumlah</td>
											<td align="center"><?php echo amount_format($sum_total_jml_lpj); ?></td>
											<td align="right"><?php echo amount_format($sum_total_uang_persediaan); ?></td>
											<td align="right"><?php echo amount_format($sum_total_ls_bendahara); ?></td>
											<td align="right"><?php echo amount_format($sum_total_pajak); ?></td>
											<td align="right"><?php echo amount_format($sum_total_pengeluaran_lain); ?></td>
											<td align="right"><?php echo amount_format($sum_total_saldo_kas_bp); ?></td>
											<td align="right"><?php echo amount_format($sum_total_saldo); ?></td>
											<td align="right"><?php echo amount_format($sum_total_kuitansi); ?></td>
											<td align="right"><?php echo amount_format($sum_total_saldo_up); ?></td>
										</tr>
									</tbody>
								</table>
							<?php
							}
							// Rekap Kanwil Penerimaan
							else if ( count($rekap_penerimaan_lpjs)
									&& $id_entities === '2')
							{
							?>
								<hr />
								<h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
								<?php echo $nm_entity; ?><br /></h4>
								<h5 class="text-center"><?php echo $period; ?></h5>
								<br />
								<div class="table-responsive">
								<!-- table -->
								<table class="table table-bordered table-condensed table-striped">
									<thead style="font-size:11px;">
										<tr class="bg-light lter">
											<th rowspan="2">B.A.</th>
											<th rowspan="2">Kementerian/<br />Lembaga</th>
											<th rowspan="2">Jml.<br />LPJ</th>
											<th colspan="3">Saldo Kas</th>
											<th colspan="4">Saldo Penerimaan dan Penyetoran</th>
										</tr>
										<tr class="bg-light lter">
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
									<tbody style="font-size:11px;">
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
												<td style="white-space:normal;"><?php echo ucwords(strtolower($rekap_lpj->nm_kementerian)); ?></td>
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
										<tr style="font-weight:bold;">
											<td colspan="2" align="center">Jumlah</td>
											<td align="center"><?php echo amount_format($sum_total_jml_lpj); ?></td>
											<td align="right"><?php echo amount_format($sum_total_kas_tunai); ?></td>
											<td align="right"><?php echo amount_format($sum_total_kas_bank); ?></td>
											<td align="right"><?php echo amount_format($sum_total_saldo_kas); ?></td>
											<td align="right"><?php echo amount_format($sum_total_saldo_awal); ?></td>
											<td align="right"><?php echo amount_format($sum_total_penerimaan); ?></td>
											<td align="right"><?php echo amount_format($sum_total_penyetoran); ?></td>
											<td align="right"><?php echo amount_format($sum_total_saldo_penerimaan_setor); ?></td>
										</tr>
									</tbody>
								</table>
							<?php
							}
					   ?>
						</div><!--/table-responsive-->
				  </div><!--/div-1-->
				
			</div><!--/box-dark-->
		</div><!--/col-lg-6-->
	</div><!--/row-->
