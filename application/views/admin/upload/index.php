            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>Monitoring Upload Data LPJ Bendahara</h5>
                    <div class="toolbar">
                      <div class="btn-group">
                        <a href="#sortableTable" data-toggle="collapse" class="btn btn-default btn-sm minimize-box">
                          <i class="fa fa-angle-up"></i>
                        </a> 
                        <a class="btn btn-danger btn-sm close-box">
                          <i class="fa fa-times"></i>
                        </a> 
                      </div><!--/btn-group-->
                    </div><!--/toolbar-->
                  </header>
                  <div id="sortableTable" class="body collapse in dataTables_wrapper form-inline">
					  <!-- add upload -->
					  <?php echo anchor('admin/upload/edit', '<span class="glyphicon glyphicon-plus-sign"></span> Upload Data'); ?>
					  
					<hr />	  
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
							<label for="text1" class="control-label col-lg-12">
								Keterangan:<br />
								<ul>
									<li>Jumlah LPJ Bendahara <span class="label label-danger">K</span> yang diterima <?php echo $data_sent_k->jml_lpj ? $data_sent_k->jml_lpj : 0; ?> satker</li>
									<li>Jumlah LPJ Bendahara <span class="label label-danger">K</span> yang belum diterima <?php echo $data_unsent_k->jml_lpj ? $data_unsent_k->jml_lpj : 0; ?> satker</li>
									<li>Jumlah LPJ Bendahara <span class="label label-info">P</span> yang diterima <?php echo $data_sent_p->jml_lpj ? $data_sent_p->jml_lpj : 0; ?> satker</li>
									<li>Jumlah LPJ Bendahara <span class="label label-info">P</span> yang belum diterima <?php echo $data_unsent_p->jml_lpj ? $data_unsent_p->jml_lpj : 0; ?> satker</li>
									<li><span class="label label-info">P</span> : Data LPJ Penerimaan</li>
									<li><span class="label label-danger">K</span> : Data LPJ Pengeluaran</li>
								</ul>
							</label>
					</div>
					<hr />

					<?php 
						// show all validation result
						if (count($validate_pengeluaran))
						{
							$komponen_pengeluaran = $validate_pengeluaran->row();
							$hasil_perhitungan_tunai = $komponen_pengeluaran->saldo_awal_tunai + $komponen_pengeluaran->debet_tunai - $komponen_pengeluaran->kredit_tunai;$hasil_perhitungan_bank = $komponen_pengeluaran->saldo_awal_bank + $komponen_pengeluaran->debet_bank - $komponen_pengeluaran->kredit_bank;$hasil_perhitungan_um = $komponen_pengeluaran->saldo_awal_um + $komponen_pengeluaran->debet_um - $komponen_pengeluaran->kredit_um;$hasil_perhitungan_bpp = $komponen_pengeluaran->saldo_awal_bpp + $komponen_pengeluaran->debet_bpp - $komponen_pengeluaran->kredit_bpp;$hasil_perhitungan_up = $komponen_pengeluaran->saldo_awal_up + $komponen_pengeluaran->debet_up - $komponen_pengeluaran->kredit_up;$hasil_perhitungan_lsbend = $komponen_pengeluaran->saldo_awal_lsbend + $komponen_pengeluaran->debet_lsbend - $komponen_pengeluaran->kredit_lsbend;$hasil_perhitungan_pajak = $komponen_pengeluaran->saldo_awal_pajak + $komponen_pengeluaran->debet_pajak - $komponen_pengeluaran->kredit_pajak;$hasil_perhitungan_lain = $komponen_pengeluaran->saldo_awal_lain + $komponen_pengeluaran->debet_lain - $komponen_pengeluaran->kredit_lain;
					?>
					
							<h5 class="text-center" style="font-weight:bold;">HASIL VALIDASI ADK PENGELUARAN<br /></h5>
							<h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($komponen_pengeluaran->nm_satker); ?><br /></h4>
							<h5 class="text-center"><?php echo get_month_name($komponen_pengeluaran->bulan) . ' ' . $komponen_pengeluaran->tahun; ?></h5><br />
							<table class="table table-bordered table-condensed table-hovered table-striped">
								<thead>
									<tr>
										<th>Jenis Buku<br />(1)</th>
										<th>Saldo Awal<br />(2)</th>
										<th>Debet<br />(3)</th>
										<th>Kredit<br />(4)</th>
										<th>Hasil<br />(5) = (2)+(3)-(4)</th>
										<th>Saldo Akhir<br />(6)</th>
										<th>Keterangan<br />(7) = (5) ? (6)</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>Tunai</th>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_tunai); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_tunai); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_tunai); ?></td>
										<td align="right" class="bg-blue dker"><?php echo amount_format($hasil_perhitungan_tunai); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_tunai); ?></td>
										<td>
											<?php 
												if($hasil_perhitungan_tunai == $komponen_pengeluaran->saldo_akhir_tunai){
											?>
													<span class="label label-success">Hasil Benar</span>
											<?php
												} else {
											?>
													<span class="label label-danger">Hasil Salah</span>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<th>Bank</th>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_bank); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_bank); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_bank); ?></td>
										<td align="right" class="bg-blue dker"><?php echo amount_format($hasil_perhitungan_bank); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_bank); ?></td>
										<td>
											<?php 
												if($hasil_perhitungan_bank == $komponen_pengeluaran->saldo_akhir_bank){
											?>
													<span class="label label-success">Hasil Benar</span>
											<?php
												} else {
											?>
													<span class="label label-danger">Hasil Salah</span>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<th>Uang Muka</th>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_um); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_um); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_um); ?></td>
										<td align="right" class="bg-blue dker"><?php echo amount_format($hasil_perhitungan_um); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_um); ?></td>
										<td>
											<?php 
												if($hasil_perhitungan_um == $komponen_pengeluaran->saldo_akhir_um){
											?>
													<span class="label label-success">Hasil Benar</span>
											<?php
												} else {
											?>
													<span class="label label-danger">Hasil Salah</span>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<th>Bendahara Pembantu Pengeluaran</th>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_bpp); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_bpp); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_bpp); ?></td>
										<td align="right" class="bg-blue dker"><?php echo amount_format($hasil_perhitungan_bpp); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_bpp); ?></td>
										<td>
											<?php 
												if($hasil_perhitungan_bpp == $komponen_pengeluaran->saldo_akhir_bpp){
											?>
													<span class="label label-success">Hasil Benar</span>
											<?php
												} else {
											?>
													<span class="label label-danger">Hasil Salah</span>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<th>LS Bendahara</th>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_lsbend); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_lsbend); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_lsbend); ?></td>
										<td align="right" class="bg-blue dker"><?php echo amount_format($hasil_perhitungan_lsbend); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_lsbend); ?></td>
										<td>
											<?php 
												if($hasil_perhitungan_lsbend == $komponen_pengeluaran->saldo_akhir_lsbend){
											?>
													<span class="label label-success">Hasil Benar</span>
											<?php
												} else {
											?>
													<span class="label label-danger">Hasil Salah</span>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<th>Uang Persediaan</th>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_up); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_up); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_up); ?></td>
										<td align="right" class="bg-blue dker"><?php echo amount_format($hasil_perhitungan_up); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_up); ?></td>
										<td>
											<?php 
												if($hasil_perhitungan_up == $komponen_pengeluaran->saldo_akhir_up){
											?>
													<span class="label label-success">Hasil Benar</span>
											<?php
												} else {
											?>
													<span class="label label-danger">Hasil Salah</span>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<th>Pajak</th>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_pajak); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_pajak); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_pajak); ?></td>
										<td align="right" class="bg-blue dker"><?php echo amount_format($hasil_perhitungan_pajak); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_pajak); ?></td>
										<td>
											<?php 
												if($hasil_perhitungan_pajak == $komponen_pengeluaran->saldo_akhir_pajak){
											?>
													<span class="label label-success">Hasil Benar</span>
											<?php
												} else {
											?>
													<span class="label label-danger">Hasil Salah</span>
											<?php } ?>
										</td>
									</tr>
									<tr>
										<th>Pengeluaran Lain</th>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_lain); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_lain); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_lain); ?></td>
										<td align="right" class="bg-blue dker"><?php echo amount_format($hasil_perhitungan_lain); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_lain); ?></td>
										<td>
											<?php 
												if($hasil_perhitungan_lain == $komponen_pengeluaran->saldo_akhir_lain){
											?>
													<span class="label label-success">Hasil Benar</span>
											<?php
												} else {
											?>
													<span class="label label-danger">Hasil Salah</span>
											<?php } ?>
										</td>
									</tr>
								</tbody>
							</table>
					<?php
						}
						// validate penerimaan
						else if (count($validate_penerimaan))
						{
							$header_penerimaan = $validate_penerimaan->row();
							$komponen_penerimaans = $validate_penerimaan->result();
					?>
							<h5 class="text-center" style="font-weight:bold;">HASIL VALIDASI ADK PENERIMAAN<br /></h5>
							<h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($header_penerimaan->nm_satker); ?><br /></h4>
							<h5 class="text-center"><?php echo get_month_name($header_penerimaan->bulan) . ' ' . $header_penerimaan->tahun; ?></h5><br />
							<table class="table table-bordered table-condensed table-hovered table-striped">
								<thead>
									<tr>
										<th>Kode & Jenis Buku<br />(1)</th>
										<th>Saldo Awal<br />(2)</th>
										<th>Debet<br />(3)</th>
										<th>Kredit<br />(4)</th>
										<th>Hasil<br />(5) = (2)+(3)-(4)</th>
										<th>Saldo Akhir<br />(6)</th>
										<th>Keterangan<br />(7) = (5) ? (6)</th>
									</tr>
								</thead>
								<tbody>
					<?php 
									foreach ($komponen_penerimaans as $komponen_penerimaan) 
									{
										$hasil_perhitungan_akhir = $komponen_penerimaan->saldo_awal + $komponen_penerimaan->debet - $komponen_penerimaan->kredit; 
					?>
										<tr>
											<td><?php echo '(' . $komponen_penerimaan->kd_buku . ') ' . $komponen_penerimaan->nm_buku; ?></td>
											<td align="right"><?php echo amount_format($komponen_penerimaan->saldo_awal); ?></td>
											<td align="right"><?php echo amount_format($komponen_penerimaan->debet); ?></td>
											<td align="right"><?php echo amount_format($komponen_penerimaan->kredit); ?></td>
											<td align="right"><?php echo amount_format($hasil_perhitungan_akhir); ?></td>
											<td align="right"><?php echo amount_format($komponen_penerimaan->saldo_akhir); ?></td>
											<td>
												<?php 
													if($hasil_perhitungan_akhir == $komponen_penerimaan->saldo_akhir){
												?>
														<span class="label label-success">Hasil Benar</span>
												<?php
													} else {
												?>
														<span class="label label-danger">Hasil Salah</span>
												<?php } ?>
											</td>
										</tr>
					<?php
									}
					?>
								</tbody>
							</table>
					<?php
						}
						
					?>
					
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hovered table-striped sortableTable">
						<thead>
							<tr>
								<th>No.
								<i class="fa sort"></i></th>
								<th>Tindakan
								<i class="fa sort"></i></th>
								<th>Satker
								<i class="fa sort"></i></th>
								<th>Tahun
								<i class="fa sort"></i></th>
								<th>Bulan
								<i class="fa sort"></i></th>
								<th>Timestamp Pengiriman
								<i class="fa sort"></i></th>
								<th>Pos Data
								<i class="fa sort"></i></th>
							</tr>
						</thead>
                      <tbody>
						<?php 
							$i = 0;
							
							if (count($pengeluaran_kirims))
							{
								foreach ($pengeluaran_kirims->result() as $pengeluaran_kirim) 
								{
						?>
									<tr>
										<td><?php echo ++$i; ?></td>
										<td><?php echo btn_mod_danger('admin/upload/index/K/' . $pengeluaran_kirim->kd_satker . '/' . $pengeluaran_kirim->tahun . '/' . $pengeluaran_kirim->bulan, 'HASIL VALIDASI'); ?></td>
										<td><?php echo $pengeluaran_kirim->kd_satker; ?></td>
										<td><?php echo $pengeluaran_kirim->tahun; ?></td>
										<td><?php echo $pengeluaran_kirim->bulan; ?></td>
										<td><span class="label label-success"><?php echo $pengeluaran_kirim->updated_at; ?></span></td>
										<td><span class="label label-danger"><?php echo 'K'; ?></span></td>
									</tr>
						<?php
								}
							}
							else if (count($pengeluaran_uploads)) 
							{
								foreach ($pengeluaran_uploads->result() as $upload) 
								{
						?>
							<tr>
							  <td><?php echo ++$i; ?></td>
							  <td><?php echo $upload->kd_satker; ?></td>
							  <td><?php echo $upload->tahun; ?></td>
							  <td><?php echo $upload->bulan; ?></td>
							  <td><span class="label label-success"><?php echo $upload->timestamp; ?></span></td>
							  <td><span class="label label-danger"><?php echo $upload->pos_kirim; ?></span></td>
							</tr>
						<?php 
								}
							}
							else
							{
						?>
						<tr>
							<td colspan="16">Data LPJ Pengeluaran pada tahun <span class="label label-danger"><?php echo $year; ?></span> bulan <span class="label label-danger"><?php echo $month; ?></span> tidak ada</td>
						</tr>
						<?php
							}
						?>
                      </tbody>
                    </table>
                    
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hovered table-striped sortableTable">
						<thead>
							<tr>
								<th>No.
								<i class="fa sort"></i></th>
								<th>Tindakan
								<i class="fa sort"></i></th>
								<th>Satker
								<i class="fa sort"></i></th>
								<th>Tahun
								<i class="fa sort"></i></th>
								<th>Bulan
								<i class="fa sort"></i></th>
								<th>Timestamp Pengiriman
								<i class="fa sort"></i></th>
								<th>Pos Data
								<i class="fa sort"></i></th>
							</tr>
						</thead>
                      <tbody>
						<?php 
							$i = 0;
							
							if (count($penerimaan_kirims))
							{
								foreach ($penerimaan_kirims->result() as $penerimaan_kirim) 
								{
						?>
									<tr>
										<td><?php echo ++$i; ?></td>
										<td><?php echo btn_mod_danger('admin/upload/index/P/' . $penerimaan_kirim->kd_satker . '/' . $penerimaan_kirim->tahun . '/' . $penerimaan_kirim->bulan, 'HASIL VALIDASI'); ?></td>
										<td><?php echo $penerimaan_kirim->kd_satker; ?></td>
										<td><?php echo $penerimaan_kirim->tahun; ?></td>
										<td><?php echo $penerimaan_kirim->bulan; ?></td>
										<td><span class="label label-success"><?php echo $penerimaan_kirim->updated_at; ?></span></td>
										<td><span class="label label-info"><?php echo 'P'; ?></span></td>
									</tr>
						<?php
								}
							}
							else if (count($penerimaan_uploads)) 
							{
								
								foreach ($penerimaan_uploads->result() as $upload) 
								{
						?>
							<tr>
							  <td><?php echo ++$i; ?></td>
							  <td><?php echo $upload->kd_satker; ?></td>
							  <td><?php echo $upload->tahun; ?></td>
							  <td><?php echo $upload->bulan; ?></td>
							  <td><span class="label label-success"><?php echo $upload->timestamp; ?></span></td>
							  <td><span class="label label-info"><?php echo $upload->pos_kirim; ?></span></td>
							</tr>
						<?php 
								}
							}
							else
							{
						?>
						<tr>
							<td colspan="16">Data LPJ Penerimaan pada tahun <span class="label label-danger"><?php echo $year; ?></span> bulan <span class="label label-danger"><?php echo $month; ?></span> tidak ada</td>
						</tr>
						<?php
							}
						?>
                      </tbody>
                    </table>
                    
                  </div><!--/sortableTable-->
                </div><!--/box-->
              </div><!--/col-lg-12-->
            </div><!-- /.row -->
            <!--End Datatables-->
