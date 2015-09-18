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
							// validate rekening
							$rekening_pengeluaran_silabun 		= $validate_rekening_pengeluaran_silabun->row();
							$rekening_pengeluaran_sekretariat 	= $validate_rekening_pengeluaran_sekretariat->row();
							// validate lpj
							$komponen_pengeluaran = $validate_pengeluaran->row();
							$hasil_perhitungan_tunai = $komponen_pengeluaran->saldo_awal_tunai + $komponen_pengeluaran->debet_tunai - $komponen_pengeluaran->kredit_tunai;$hasil_perhitungan_bank = $komponen_pengeluaran->saldo_awal_bank + $komponen_pengeluaran->debet_bank - $komponen_pengeluaran->kredit_bank;$hasil_perhitungan_um = $komponen_pengeluaran->saldo_awal_um + $komponen_pengeluaran->debet_um - $komponen_pengeluaran->kredit_um;$hasil_perhitungan_bpp = $komponen_pengeluaran->saldo_awal_bpp + $komponen_pengeluaran->debet_bpp - $komponen_pengeluaran->kredit_bpp;$hasil_perhitungan_up = $komponen_pengeluaran->saldo_awal_up + $komponen_pengeluaran->debet_up - $komponen_pengeluaran->kredit_up;$hasil_perhitungan_lsbend = $komponen_pengeluaran->saldo_awal_lsbend + $komponen_pengeluaran->debet_lsbend - $komponen_pengeluaran->kredit_lsbend;$hasil_perhitungan_pajak = $komponen_pengeluaran->saldo_awal_pajak + $komponen_pengeluaran->debet_pajak - $komponen_pengeluaran->kredit_pajak;$hasil_perhitungan_lain = $komponen_pengeluaran->saldo_awal_lain + $komponen_pengeluaran->debet_lain - $komponen_pengeluaran->kredit_lain;
							$validasi_saldo_akhir_bku_1 = $komponen_pengeluaran->saldo_akhir_up + $komponen_pengeluaran->saldo_akhir_lsbend + $komponen_pengeluaran->saldo_akhir_pajak + $komponen_pengeluaran->saldo_akhir_lain;
							$validasi_saldo_akhir_bku_2 = $komponen_pengeluaran->saldo_akhir_tunai + $komponen_pengeluaran->saldo_akhir_bank + $komponen_pengeluaran->saldo_akhir_um + $komponen_pengeluaran->saldo_akhir_bpp;
							// 1 month ago
							$komponen_pengeluaran_1m = $validate_pengeluaran_1m->row();
					?>
					
							<h5 class="text-center" style="font-weight:bold;">HASIL VALIDASI ADK PENGELUARAN</h5>
							<h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($komponen_pengeluaran->nm_satker); ?> ( <?php echo $komponen_pengeluaran->kd_satker; ?> )</h4>
							<h5 class="text-center"><?php echo get_month_name($komponen_pengeluaran->bulan) . ' ' . $komponen_pengeluaran->tahun; ?></h5><br />
							
							<h5 class="text-center" style="font-weight:bold;">REKONSILIASI REKENING</h5>
							*) Apabila ada perbedaan antara data di SILABUN dan PBN Open maka baris akan berwarna merah<br />
							<table class="table table-bordered table-condensed table-hovered table-striped">
								<thead>
									<tr>
										<th></th>
										<th>SILABUN</th>
										<th>PBN OPEN</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>No.Surat</th>
										<?php if( strtoupper(trim($rekening_pengeluaran_silabun->no_srt)) != strtoupper(trim($rekening_pengeluaran_sekretariat->izinnum)) ) $cls_diff_nosrt = 'class="bg-red lter"'; ?>
										<td <?php echo $cls_diff_nosrt; ?>><?php echo strtoupper($rekening_pengeluaran_silabun->no_srt); ?></td>
										<td <?php echo $cls_diff_nosrt; ?>><?php echo strtoupper($rekening_pengeluaran_sekretariat->izinnum); ?></td>
									</tr>
									<tr>
										<th>Tgl.Surat</th>
										<?php if( $rekening_pengeluaran_silabun->tgl_srt != $rekening_pengeluaran_sekretariat->izindate ) $cls_diff_tgsrt = 'class="bg-red dker"'; ?>
										<td <?php echo $cls_diff_tgsrt; ?>><?php echo date_convert($rekening_pengeluaran_silabun->tgl_srt); ?></td>
										<td <?php echo $cls_diff_tgsrt; ?>><?php echo date_convert($rekening_pengeluaran_sekretariat->izindate); ?></td>
									</tr>
									<tr>
										<th>Kode & Ref.Bank<br /><small><em>(PBN Open)</em></small></th>
										<?php if( strtoupper(trim($rekening_pengeluaran_silabun->nm_bank)) != strtoupper(trim($rekening_pengeluaran_sekretariat->bankcab)) ) $cls_diff_nmbank = 'class="bg-red lter"'; ?>
										<td></td>
										<td style="white-space:pre-wrap;word-wrap:break-word;word-break:break-all;"><?php echo '(' . strtoupper($rekening_pengeluaran_sekretariat->idbank) . ') ' . strtoupper($rekening_pengeluaran_sekretariat->nama); ?></td>
									</tr>
									<tr>
										<th>Nama Bank</th>
										<td <?php echo $cls_diff_nmbank; ?> style="white-space:pre-wrap;word-wrap:break-word;word-break:break-all;"><?php echo strtoupper($rekening_pengeluaran_silabun->nm_bank); ?></td>
										<td <?php echo $cls_diff_nmbank; ?> style="white-space:pre-wrap;word-wrap:break-word;word-break:break-all;"><?php echo strtoupper($rekening_pengeluaran_sekretariat->bankcab); ?></td>
									</tr>
									<tr>
										<th>No.Rekening</th>
										<?php 
											$no_rekening = preg_replace("/[^0-9]/", "", $rekening_pengeluaran_silabun->no_rekening);
											$rek_num	 = preg_replace("/[^0-9]/", "", $rekening_pengeluaran_sekretariat->reknum);
											if( $no_rekening !== $rek_num ) $cls_diff_norek = 'class="bg-red dker"'; 
										?>
										<td <?php echo $cls_diff_norek; ?>><?php echo $rekening_pengeluaran_silabun->no_rekening; ?><br /><small>Tanpa spesial karakter: <em><?php echo $no_rekening; ?></em></small></td>
										<td <?php echo $cls_diff_norek; ?>><?php echo $rekening_pengeluaran_sekretariat->reknum; ?><br /><small>Tanpa spesial karakter: <em><?php echo $rek_num; ?></em></small></td>
									</tr>
									<tr>
										<th>Nama.Rekening</th>
										<?php if( strtoupper(trim($rekening_pengeluaran_silabun->nm_rekening)) != strtoupper(trim($rekening_pengeluaran_sekretariat->reknama)) ) $cls_diff_nmrek = 'class="bg-red lter"'; ?>
										<td <?php echo $cls_diff_nmrek; ?>><?php echo strtoupper($rekening_pengeluaran_silabun->nm_rekening); ?></td>
										<td <?php echo $cls_diff_nmrek; ?>><?php echo strtoupper($rekening_pengeluaran_sekretariat->reknama); ?></td>
									</tr>
								</tbody>
							</table>
							
							<hr />
							<br />
							
							<h5 class="text-center" style="font-weight:bold;">VALIDASI LAPORAN PERTANGGUNGJAWABAN</h5><br />
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
								</table>
								
								<!-- validation with saldo akhir 1 month ago -->
								<table class="table table-bordered table-condensed table-hovered table-striped">
								<thead>
									<tr>
										<th>Jenis Buku<br />(1)</th>
										<th>Saldo Akhir<br />Bulan <?php echo get_month_name($komponen_pengeluaran_1m->bulan) . ' ' . $komponen_pengeluaran_1m->tahun; ?><br />(2)</th>
										<th>Saldo Awal<br />Bulan <?php echo get_month_name($komponen_pengeluaran->bulan) . ' ' . $komponen_pengeluaran->tahun; ?><br />(3)</th>
										<th>Keterangan<br />(4) = (2) ? (3)</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>Tunai</th>
										<td align="right" class="bg-blue dker"><?php echo amount_format($komponen_pengeluaran_1m->saldo_akhir_tunai); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_awal_tunai); ?></td>
										<td>
											<?php 
												if ( $komponen_pengeluaran_1m->saldo_akhir_tunai === $komponen_pengeluaran->saldo_awal_tunai ) {
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
										<td align="right" class="bg-blue dker"><?php echo amount_format($komponen_pengeluaran_1m->saldo_akhir_bank); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_awal_bank); ?></td>
										<td>
											<?php 
												if ( $komponen_pengeluaran_1m->saldo_akhir_bank === $komponen_pengeluaran->saldo_awal_bank ) {
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
										<th>Buku Kas Umum</th>
										<td align="right" class="bg-blue dker"><?php echo amount_format($komponen_pengeluaran_1m->saldo_akhir_bku); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_awal_bku); ?></td>
										<td>
											<?php 
												if ( $komponen_pengeluaran_1m->saldo_akhir_bku === $komponen_pengeluaran->saldo_awal_bku ) {
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
										<td align="right" class="bg-blue dker"><?php echo amount_format($komponen_pengeluaran_1m->saldo_akhir_um); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_awal_um); ?></td>
										<td>
											<?php 
												if ( $komponen_pengeluaran_1m->saldo_akhir_um === $komponen_pengeluaran->saldo_awal_um ) {
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
										<th>Bendahara Pengeluaran Pembantu</th>
										<td align="right" class="bg-blue dker"><?php echo amount_format($komponen_pengeluaran_1m->saldo_akhir_bpp); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_awal_bpp); ?></td>
										<td>
											<?php 
												if ( $komponen_pengeluaran_1m->saldo_akhir_bpp === $komponen_pengeluaran->saldo_awal_bpp ) {
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
										<td align="right" class="bg-blue dker"><?php echo amount_format($komponen_pengeluaran_1m->saldo_akhir_up); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_awal_up); ?></td>
										<td>
											<?php 
												if ( $komponen_pengeluaran_1m->saldo_akhir_up === $komponen_pengeluaran->saldo_awal_up ) {
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
										<td align="right" class="bg-blue dker"><?php echo amount_format($komponen_pengeluaran_1m->saldo_akhir_lsbend); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_awal_lsbend); ?></td>
										<td>
											<?php 
												if ( $komponen_pengeluaran_1m->saldo_akhir_lsbend === $komponen_pengeluaran->saldo_awal_lsbend ) {
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
										<td align="right" class="bg-blue dker"><?php echo amount_format($komponen_pengeluaran_1m->saldo_akhir_pajak); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_awal_pajak); ?></td>
										<td>
											<?php 
												if ( $komponen_pengeluaran_1m->saldo_akhir_pajak === $komponen_pengeluaran->saldo_awal_pajak ) {
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
										<td align="right" class="bg-blue dker"><?php echo amount_format($komponen_pengeluaran_1m->saldo_akhir_lain); ?></td>
										<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_awal_lain); ?></td>
										<td>
											<?php 
												if ( $komponen_pengeluaran_1m->saldo_akhir_lain === $komponen_pengeluaran->saldo_awal_lain ) {
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
								
								<table class="table table-bordered table-condensed table-hovered table-striped">
									<tr>
										<td colspan="4" style="white-space:normal;"><strong>1. Validasi Saldo Akhir BKU</strong><br />
											Saldo Akhir BKU = Saldo Akhir UP + Saldo Akhir LS Bendahara + Saldo Akhir Pajak + Saldo Akhir Pengeluaran Lain *)</td>
										<th>*) Hasil Penjumlahan</th>
										<th>Saldo Akhir BKU</th>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<th width="15%" style="white-space:normal;">Saldo Akhir UP</td>
										<th width="15%" style="white-space:normal;">Saldo Akhir LS Bendahara</td>
										<th width="15%" style="white-space:normal;">Saldo Akhir Pajak</td>
										<th width="15%" style="white-space:normal;">Saldo Akhir Pengeluaran Lain</td>
										<td rowspan="2" align="right" class="bg-blue dker"><?php echo amount_format($validasi_saldo_akhir_bku_1); ?></td>
										<td rowspan="2" align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_bku); ?></td>
										<td rowspan="2">
											<?php 
												if($validasi_saldo_akhir_bku_1 == $komponen_pengeluaran->saldo_akhir_bku){
											?>
													<span class="label label-success">Hasil Benar</span>
											<?php
												} else {
											?>
													<span class="label label-danger">Hasil Salah</span>
											<?php } ?></td>
									</tr>
									<tr>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_up); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_lsbend); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_pajak); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_lain); ?></td>
									</tr>
									<tr>
										<td colspan="4" style="white-space:normal;"><strong>2. Validasi Saldo Akhir BKU</strong><br />
										Saldo Akhir BKU = Saldo Akhir Tunai + Saldo Akhir Bank + Saldo Akhir Uang Muka + Saldo Akhir BPP *)</td>
										<th>*) Hasil Penjumlahan</th>
										<th>Saldo Akhir BKU</th>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<th width="15%" style="white-space:normal;">Saldo Akhir Tunai</td>
										<th width="15%" style="white-space:normal;">Saldo Akhir Bank</td>
										<th width="15%" style="white-space:normal;">Saldo Akhir Uang Muka</td>
										<th width="15%" style="white-space:normal;">Saldo Akhir BPP</td>
										<td rowspan="2" align="right" class="bg-blue dker"><?php echo amount_format($validasi_saldo_akhir_bku_2); ?></td>
										<td rowspan="2" align="right" class="bg-orange lter"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_bku); ?></td>
										<td rowspan="2">
											<?php 
												if($validasi_saldo_akhir_bku_2 == $komponen_pengeluaran->saldo_akhir_bku){
											?>
													<span class="label label-success">Hasil Benar</span>
											<?php
												} else {
											?>
													<span class="label label-danger">Hasil Salah</span>
											<?php } ?></td>
									</tr>
									<tr>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_tunai); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_bank); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_um); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_bpp); ?></td>
									</tr>
								</tbody>
							</table>
							<hr />
							<?php 
								// BP Kas (Tunai & Bank)
								$saldo_awal_bp_kas 	= $komponen_pengeluaran->saldo_awal_tunai + $komponen_pengeluaran->saldo_awal_bank;
								$debet_bp_kas 		= $komponen_pengeluaran->debet_tunai + $komponen_pengeluaran->debet_bank;
								$kredit_bp_kas 		= $komponen_pengeluaran->kredit_tunai + $komponen_pengeluaran->kredit_bank;
								$saldo_akhir_bp_kas	= $komponen_pengeluaran->saldo_akhir_tunai + $komponen_pengeluaran->saldo_akhir_bank;
								// Jumlah kas
								$jumlah_kas			= $komponen_pengeluaran->brankas + $komponen_pengeluaran->rekening_bank;
								// Selisih kas
								$selisih_kas		= $saldo_akhir_bp_kas - $jumlah_kas;
								// Jumlah UP
								$jumlah_up			= $komponen_pengeluaran->saldo_akhir_up + $komponen_pengeluaran->kuitansi_up;
								// Selisih pembukuan UP
								$selisih_pembukuan_up	= $jumlah_up - $komponen_pengeluaran->saldo_up_uakpa;
								// BP Kas, BPP, dan Uang Muka (Voucher)
								$saldo_awal_kas_bpp_um	= $saldo_awal_bp_kas + $komponen_pengeluaran->saldo_awal_um + $komponen_pengeluaran->saldo_awal_bpp;
								$debet_kas_bpp_um	= $debet_bp_kas + $komponen_pengeluaran->debet_um + $komponen_pengeluaran->debet_bpp;
								$kredit_kas_bpp_um	= $kredit_bp_kas + $komponen_pengeluaran->kredit_um + $komponen_pengeluaran->kredit_bpp;
								$saldo_akhir_kas_bpp_um	= $saldo_akhir_bp_kas + $komponen_pengeluaran->saldo_akhir_um + $komponen_pengeluaran->saldo_akhir_bpp;
								// BP selain Kas, BPP, dan Uang Muka (Voucher)
								$saldo_awal_non_kas_bpp_um	= $komponen_pengeluaran->saldo_awal_up + $komponen_pengeluaran->saldo_awal_lsbend + $komponen_pengeluaran->saldo_awal_pajak + $komponen_pengeluaran->saldo_awal_lain; 
								$debet_non_kas_bpp_um	= $komponen_pengeluaran->debet_up + $komponen_pengeluaran->debet_lsbend + $komponen_pengeluaran->debet_pajak + $komponen_pengeluaran->debet_lain; 
								$kredit_non_kas_bpp_um	= $komponen_pengeluaran->kredit_up + $komponen_pengeluaran->kredit_lsbend + $komponen_pengeluaran->kredit_pajak + $komponen_pengeluaran->kredit_lain; 
								$saldo_akhir_non_kas_bpp_um	= $komponen_pengeluaran->saldo_akhir_up + $komponen_pengeluaran->saldo_akhir_lsbend + $komponen_pengeluaran->saldo_akhir_pajak + $komponen_pengeluaran->saldo_akhir_lain; 
							?>
							<h5 class="text-center" style="font-weight:bold;">LAPORAN PERTANGGUNGJAWABAN BENDAHARA PENGELUARAN</h5><br />
							Keadaan pembukuan bulan pelaporan dengan <span class="text-primary">saldo akhir pada BKU</span> sebesar Rp <?php echo amount_format($komponen_pengeluaran->saldo_akhir_bku); ?> dan Nomor Bukti terakhir Nomor <?php echo $komponen_pengeluaran->no_bukti; ?>
							<?php 
								if ((float) $komponen_pengeluaran->saldo_akhir_bku !== $saldo_akhir_kas_bpp_um)
								{
							?>
									<span class="text-danger" style="white-space: normal;"><strong>(Saldo akhir BKU harus sama dengan saldo akhir BP Kas, BPP, dan Uang Muka (Voucher))</strong></span>
									<span class="label label-danger">Hasil Salah</span>
							<?php
								}
								
							?>
							<br />
							<table class="table table-bordered table-condensed table-hovered table-striped">
								<thead>
									<tr style="font-weight:bold;">
										<td align="center">No</td>
										<td align="center">Jenis Buku Pembantu</td>
										<td align="center">Saldo Awal</td>
										<td align="center">Penambahan</td>
										<td align="center">Pengurangan</td>
										<td align="center">Saldo Akhir</td>
									</tr>
									<tr>
										<td align="center">(1)</td>
										<td align="center">(2)</td>
										<td align="center">(3)</td>
										<td align="center">(4)</td>
										<td align="center">(5)</td>
										<td align="center">(6)</td>
									</tr>
								</thead>
								<tbody>
									<tr style="font-weight:bold;">
										<td align="center">A</td>
										<td>BP Kas, BPP, dan Uang Muka (Voucher)</td>
										<td align="right"><?php echo amount_format($saldo_awal_kas_bpp_um); ?></td>
										<td align="right"><?php echo amount_format($debet_kas_bpp_um); ?></td>
										<td align="right"><?php echo amount_format($kredit_kas_bpp_um); ?></td>
										<td align="right"><?php echo amount_format($saldo_akhir_kas_bpp_um); ?></td>
									</tr>
									<tr>
										<td></td>
										<td>1. BP Kas (Tunai dan Bank)</td>
										<td align="right"><?php echo amount_format($saldo_awal_bp_kas); ?></td>
										<td align="right"><?php echo amount_format($debet_bp_kas); ?></td>
										<td align="right"><?php echo amount_format($kredit_bp_kas); ?></td>
										<td align="right"><?php echo amount_format($saldo_akhir_bp_kas); ?></td>
									</tr>
									<tr>
										<td></td>
										<td>2. BP Uang Muka (Voucher)</td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_um); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_um); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_um); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_um); ?></td>
									</tr>
									<tr>
										<td></td>
										<td>3. BP BPP (Kas pada BPP)</td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_bpp); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_bpp); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_bpp); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_bpp); ?></td>
									</tr>
									<tr style="font-weight:bold;">
										<td align="center">B</td>
										<td>BP selain Kas, BPP, dan Uang Muka (Voucher)</td>
										<td align="right"><?php echo amount_format($saldo_awal_non_kas_bpp_um); ?></td>
										<td align="right"><?php echo amount_format($debet_non_kas_bpp_um); ?></td>
										<td align="right"><?php echo amount_format($kredit_non_kas_bpp_um); ?></td>
										<td align="right"><?php echo amount_format($saldo_akhir_non_kas_bpp_um); ?></td>
									</tr>
									<tr>
										<td></td>
										<td>1. BP UP *)</td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_up); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_up); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_up); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_up); ?></td>
									</tr>
									<tr>
										<td></td>
										<td>2. BP LS-Bendahara</td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_lsbend); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_lsbend); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_lsbend); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_lsbend); ?></td>
									</tr>
									<tr>
										<td></td>
										<td>3. BP Pajak</td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_pajak); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_pajak); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_pajak); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_pajak); ?></td>
									</tr>
									<tr>
										<td></td>
										<td>4. BP Lain</td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_awal_lain); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->debet_lain); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->kredit_lain); ?></td>
										<td align="right"><?php echo amount_format($komponen_pengeluaran->saldo_akhir_lain); ?></td>
									</tr>
								</tbody>
							</table>
							*) jumlah pengurangan sudah termasuk kuitansi UP yang belum di-SPMGU-kan sebesar Rp <?php echo amount_format($komponen_pengeluaran->kuitansi_up); ?><br /><br />
							<strong>Keadaan kas pada akhir bulan pelaporan</strong>
							<div class="row">
								<div class="col-md-6">
									1. Uang tunai di brankas
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_pengeluaran->brankas); ?>
									</div>
								</div>
							</div>
							<?php 
								$sisa_up_brankas = $komponen_pengeluaran->brankas - $komponen_pengeluaran->saldo_akhir_lsbend;
								
								if ($sisa_up_brankas > 50000000)
								{
							?>
								<div class="row">
									<div class="col-md-8">
										<span class="text-danger" style="white-space:normal;"><strong>Uang tunai melebihi Rp 50.000.000,00, mohon dikonfirmasi ke Bendahara Pengeluaran Satker.  Uang UP dalam brankas Rp <?php echo amount_format($sisa_up_brankas); ?></strong></span>
<!--
										<span class="text-danger" style="white-space:normal;"><strong>Uang tunai di brankas tidak boleh melebihi Rp 50.000.000,00 (PER-3/PB/2014 Bab III Pasal 7 (1)).  Uang UP dalam brankas Rp <?php echo amount_format($sisa_up_brankas); ?></strong></span>
-->
									</div>
								</div>
							<?php
								}
								
							?>
							<div class="row">
								<div class="col-md-6">
									2. Uang rekening di bank (terlampir Daftar Rincian Kas di Rekening)
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_pengeluaran->rekening_bank); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<hr />
								</div>
								<div class="col-md-1">(+)</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									3. Jumlah kas
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($jumlah_kas); ?>
									</div>
								</div>
							</div>
							<br />
							<strong>Selisih kas</strong>
							<div class="row">
								<div class="col-md-6">
									1. Saldo akhir BP Kas
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($saldo_akhir_bp_kas); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									2. Jumlah kas
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($jumlah_kas); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<hr />
								</div>
								<div class="col-md-1">(-)</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									3. Selisih kas
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($selisih_kas); ?>
									</div>
								</div>
							</div>
							<br />
							<strong>Hasil rekonsiliasi internal dengan UAKPA</strong>
							<div class="row">
								<div class="col-md-6">
									1. Saldo UP
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_pengeluaran->saldo_akhir_up); ?>
									</div>
								</div>
								<div class="col-md-6">
									2. Kuitansi UP
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_pengeluaran->kuitansi_up); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<hr />
								</div>
								<div class="col-md-1">(+)</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									3. Jumlah UP
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($jumlah_up); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									4. Saldo UP menurut UAKPA
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_pengeluaran->saldo_up_uakpa); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<hr />
								</div>
								<div class="col-md-1">(-)</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									5. Selisih pembukuan UP
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($selisih_pembukuan_up); ?>
									</div>
								</div>
							</div>
							<br />
							<strong>Penjelasan selisih kas dan/atau selisih pembukuan:</strong><br />
							1. <?php echo $komponen_pengeluaran->ket_selisih_kas; ?><br />
							2. <?php echo $komponen_pengeluaran->ket_selisih_up; ?>
							
							<br />
							<hr />
					<?php
						}
						// validate penerimaan
						else if (count($validate_penerimaan))
						{
							// validate rekening
							$rekening_penerimaan_silabun 		= $validate_rekening_penerimaan_silabun->row();
							$rekening_penerimaan_sekretariat 	= $validate_rekening_penerimaan_sekretariat->row();
							// validate lpj
							$header_penerimaan = $validate_penerimaan->row();
							$komponen_penerimaan_02 = $validate_penerimaan_02->row();
							$komponen_penerimaan_01 = $validate_penerimaan_01->row();
							$komponen_penerimaans = $validate_penerimaan->result();
							$komponen_penerimaan_arrays = $validate_penerimaan->result_array();
							$komponen_penerimaan_array_1ms = $validate_penerimaan_1m->result_array();
							
							// calculation LPJ Penerimaan
							$jumlah_kas_penerimaan = $komponen_penerimaan_02->brankas + $komponen_penerimaan_02->kas_bank;
							$selisih_kas_penerimaan = $komponen_penerimaan_02->saldo_akhir - $jumlah_kas_penerimaan;
							$jumlah_penerimaan_negara = $komponen_penerimaan_01->hak_saldo_awal + $komponen_penerimaan_01->hak_terima;
							$saldo_akhir_penerimaan = $jumlah_penerimaan_negara - $komponen_penerimaan_01->hak_setor;
							$selisih_uakpa = $komponen_penerimaan_02->setor - $komponen_penerimaan_02->uakpa;
					?>
							<h5 class="text-center" style="font-weight:bold;">HASIL VALIDASI ADK PENERIMAAN<br /></h5>
							<h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($header_penerimaan->nm_satker) . ' (' . $header_penerimaan->kd_satker . ')'; ?><br /></h4>
							<h5 class="text-center"><?php echo get_month_name($header_penerimaan->bulan) . ' ' . $header_penerimaan->tahun; ?></h5><br />
							
							
							<h5 class="text-center" style="font-weight:bold;">REKONSILIASI REKENING</h5>
							*) Apabila ada perbedaan antara data di SILABUN dan PBN Open maka baris akan berwarna merah<br />
							<table class="table table-bordered table-condensed table-hovered table-striped">
								<thead>
									<tr>
										<th></th>
										<th>SILABUN</th>
										<th>PBN OPEN</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>No.Surat</th>
										<?php if( strtoupper(trim($rekening_penerimaan_silabun->no_srt)) != strtoupper(trim($rekening_penerimaan_sekretariat->izinnum)) ) $cls_diff_nosrt = 'class="bg-red lter"'; ?>
										<td <?php echo $cls_diff_nosrt; ?>><?php echo strtoupper($rekening_penerimaan_silabun->no_srt); ?></td>
										<td <?php echo $cls_diff_nosrt; ?>><?php echo strtoupper($rekening_penerimaan_sekretariat->izinnum); ?></td>
									</tr>
									<tr>
										<th>Tgl.Surat</th>
										<?php if( $rekening_penerimaan_silabun->tgl_srt != $rekening_penerimaan_sekretariat->izindate ) $cls_diff_tgsrt = 'class="bg-red dker"'; ?>
										<td <?php echo $cls_diff_tgsrt; ?>><?php echo date_convert($rekening_penerimaan_silabun->tgl_srt); ?></td>
										<td <?php echo $cls_diff_tgsrt; ?>><?php echo date_convert($rekening_penerimaan_sekretariat->izindate); ?></td>
									</tr>
									<tr>
										<th>Kode & Ref.Bank<br /><small><em>(PBN Open)</em></small></th>
										<?php if( strtoupper(trim($rekening_penerimaan_silabun->nm_bank)) != strtoupper(trim($rekening_penerimaan_sekretariat->bankcab)) ) $cls_diff_nmbank = 'class="bg-red lter"'; ?>
										<td></td>
										<td style="white-space:pre-wrap;word-wrap:break-word;word-break:break-all;"><?php echo '(' . $rekening_penerimaan_sekretariat->idbank . ') ' . strtoupper($rekening_penerimaan_sekretariat->nama); ?></td>
									</tr>
									<tr>
										<th>Nama Bank</th>
										<td <?php echo $cls_diff_nmbank; ?> style="white-space:pre-wrap;word-wrap:break-word;word-break:break-all;"><?php echo strtoupper($rekening_penerimaan_silabun->nm_bank); ?></td>
										<td <?php echo $cls_diff_nmbank; ?> style="white-space:pre-wrap;word-wrap:break-word;word-break:break-all;"><?php echo strtoupper($rekening_penerimaan_sekretariat->bankcab); ?></td>
									</tr>
									<tr>
										<th>No.Rekening</th>
										<?php 
											$no_rekening = preg_replace("/[^0-9]/", "", $rekening_penerimaan_silabun->no_rekening);
											$rek_num	 = preg_replace("/[^0-9]/", "", $rekening_penerimaan_sekretariat->reknum);
											if( $no_rekening !== $rek_num ) $cls_diff_norek = 'class="bg-red dker"'; 
										?>
										<td <?php echo $cls_diff_norek; ?>><?php echo $rekening_penerimaan_silabun->no_rekening; ?><br /><small>Tanpa spesial karakter: <em><?php echo $no_rekening; ?></em></small></td>
										<td <?php echo $cls_diff_norek; ?>><?php echo $rekening_penerimaan_sekretariat->reknum; ?><br /><small>Tanpa spesial karakter: <em><?php echo $rek_num; ?></em></small></td>
									</tr>
									<tr>
										<th>Nama.Rekening</th>
										<?php if( strtoupper(trim($rekening_penerimaan_silabun->nm_rekening)) != strtoupper(trim($rekening_penerimaan_sekretariat->reknama)) ) $cls_diff_nmrek = 'class="bg-red lter"'; ?>
										<td <?php echo $cls_diff_nmrek; ?>><?php echo strtoupper($rekening_penerimaan_silabun->nm_rekening); ?></td>
										<td <?php echo $cls_diff_nmrek; ?>><?php echo strtoupper($rekening_penerimaan_sekretariat->reknama); ?></td>
									</tr>
								</tbody>
							</table>
							
							<hr />
							<br />
							
							<h5 class="text-center" style="font-weight:bold;">VALIDASI LAPORAN PERTANGGUNGJAWABAN</h5><br />
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
										if ($komponen_penerimaan->kd_buku !== '02'
											&& $komponen_penerimaan->kd_buku !== '01')
										{
											// calculation for LPJ penerimaan
											$saldo_awal_bp	+= $komponen_penerimaan->saldo_awal;
											$debet_bp		+= $komponen_penerimaan->debet;
											$kredit_bp		+= $komponen_penerimaan->kredit;
											$saldo_akhir_bp	+= $komponen_penerimaan->saldo_akhir;
										}
										
					?>
										<tr>
											<td><?php echo '(' . $komponen_penerimaan->kd_buku . ') ' . $komponen_penerimaan->nm_buku; ?></td>
											<td align="right"><?php echo amount_format($komponen_penerimaan->saldo_awal); ?></td>
											<td align="right"><?php echo amount_format($komponen_penerimaan->debet); ?></td>
											<td align="right"><?php echo amount_format($komponen_penerimaan->kredit); ?></td>
											<td align="right" class="bg-blue dker"><?php echo amount_format($hasil_perhitungan_akhir); ?></td>
											<td align="right" class="bg-orange lter"><?php echo amount_format($komponen_penerimaan->saldo_akhir); ?></td>
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
							
							<table class="table table-bordered table-condensed table-hovered table-striped">
								<thead>
									<tr>
										<th>Kode & Jenis Buku<br />(1)</th>
										<th>Saldo Akhir<br />Bulan Sebelumnya<br />(2)</th>
										<th>Saldo Awal<br />Bulan Ini<br />(3)</th>
										<th>Keterangan<br />(4) = (2) ? (3)</th>
									</tr>
								</thead>
								<tbody>
					<?php
						
									// use array outside
									$penerimaan_array_1m = array();
									
									foreach ( $komponen_penerimaan_array_1ms as $komponen_penerimaan_array_1m ) 
									{
										$penerimaan_array_1m[] = $komponen_penerimaan_array_1m;
									}
									
									$j = 0;
									foreach ( $komponen_penerimaan_arrays as $komponen_penerimaan_array => $key_penerimaan_array) 
									{
										
										if ( $penerimaan_array_1m[$j]['kd_buku'] == $key_penerimaan_array['kd_buku'] )
										{
					?>
											<tr>
												<td>(<?php echo $key_penerimaan_array['kd_buku'] ?>) <?php echo ucfirst($key_penerimaan_array['nm_buku']); ?></td>
												<td align="right" class="bg-blue dker"><?php echo amount_format($penerimaan_array_1m[$j]['saldo_akhir']); ?></td>
												<td align="right" class="bg-orange lter"><?php echo amount_format($key_penerimaan_array['saldo_awal']); ?></td>
												<td>
												<?php 
													if( $penerimaan_array_1m[$j]['saldo_akhir'] === $key_penerimaan_array['saldo_awal'] ){
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
										
										$j++;
									}
									
					?>
								</tbody>
							</table>
							
							<hr />
							
							<h5 class="text-center" style="font-weight:bold;">LAPORAN PERTANGGUNGJAWABAN BENDAHARA PENERIMAAN</h5><br />
							Keadaan pembukuan bulan pelaporan dengan <span class="text-primary">saldo akhir pada BKU</span> sebesar Rp <?php echo amount_format($komponen_penerimaan_02->saldo_akhir); ?> dan Nomor Bukti terakhir Nomor <?php echo $header_penerimaan->no_bukti; ?>
							<br />
							<table class="table table-bordered table-condensed table-hovered table-striped">
								<thead>
									<tr style="font-weight:bold;">
										<td align="center">No</td>
										<td align="center">Jenis Buku Pembantu</td>
										<td align="center">Saldo Awal</td>
										<td align="center">Penambahan</td>
										<td align="center">Pengurangan</td>
										<td align="center">Saldo Akhir</td>
									</tr>
									<tr>
										<td align="center">(1)</td>
										<td align="center">(2)</td>
										<td align="center">(3)</td>
										<td align="center">(4)</td>
										<td align="center">(5)</td>
										<td align="center">(6)</td>
									</tr>
								</thead>
								<tbody>
									<tr style="font-weight:bold;">
										<td align="center">A</td>
										<td>BP Kas</td>
										<td align="right"><?php echo amount_format($komponen_penerimaan_02->saldo_awal); ?></td>
										<td align="right"><?php echo amount_format($komponen_penerimaan_02->debet); ?></td>
										<td align="right"><?php echo amount_format($komponen_penerimaan_02->kredit); ?></td>
										<td align="right"><?php echo amount_format($komponen_penerimaan_02->saldo_akhir); ?></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>BP Kas (Tunai dan Bank)</td>
										<td align="right"><?php echo amount_format($komponen_penerimaan_02->saldo_awal); ?></td>
										<td align="right"><?php echo amount_format($komponen_penerimaan_02->debet); ?></td>
										<td align="right"><?php echo amount_format($komponen_penerimaan_02->kredit); ?></td>
										<td align="right"><?php echo amount_format($komponen_penerimaan_02->saldo_akhir); ?></td>
									</tr>
									<tr style="font-weight:bold;">
										<td align="center">B</td>
										<td>Buku Pembantu</td>
										<td align="right"><?php echo amount_format($saldo_awal_bp); ?></td>
										<td align="right"><?php echo amount_format($debet_bp); ?></td>
										<td align="right"><?php echo amount_format($kredit_bp); ?></td>
										<td align="right"><?php echo amount_format($saldo_akhir_bp); ?></td>
									</tr>
							<?php 
								$i = 0;
								foreach ($komponen_penerimaans as $komponen_penerimaan) 
								{
									if($komponen_penerimaan->kd_buku !== '02'
										&& $komponen_penerimaan->kd_buku !== '01'){
							?>
									<tr>
										<td>&nbsp;</td>
										<td><?php echo ++$i . '. ' . $komponen_penerimaan->nm_buku; ?></td>
										<td align="right"><?php echo amount_format($komponen_penerimaan->saldo_awal); ?></td>
										<td align="right"><?php echo amount_format($komponen_penerimaan->debet); ?></td>
										<td align="right"><?php echo amount_format($komponen_penerimaan->kredit); ?></td>
										<td align="right"><?php echo amount_format($komponen_penerimaan->saldo_akhir); ?></td>
									</tr>
							<?php
									}
								}
							?>
								</tbody>
							</table>
							<strong>Keadaan kas pada akhir bulan pelaporan</strong><br />
							<div class="row">
								<div class="col-md-6">
									1. Uang Tunai di Brankas
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_penerimaan_02->brankas); ?>
									</div>
								</div>
							</div>
							
							<?php 
								/*
								if ($komponen_penerimaan_02->brankas > 50000000)
								{
							?>
								<div class="row">
									<div class="col-md-8">
										<span class="text-danger" style="white-space:normal;"><strong>Uang tunai di brankas tidak boleh melebihi Rp 50.000.000,00 (PER-3/PB/2014 Bab III Pasal 7 (1))</strong></span>
									</div>
								</div>
							<?php
								}
								*/
							?>
							<div class="row">
								<div class="col-md-6">
									2. Uang di Rekening Bank (terlampir Daftar Rincian Kas di Rekening)
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_penerimaan_02->kas_bank); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<hr />
								</div>
								<div class="col-md-1">(+)</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									3. Jumlah Kas
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($jumlah_kas_penerimaan); ?>
									</div>
								</div>
							</div>
							<br />
							<strong>Selisih Kas</strong><br />
							<div class="row">
								<div class="col-md-6">
									1. Saldo Akhir BP Kas
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_penerimaan_02->saldo_akhir); ?>
									</div>
								</div>
								<div class="col-md-6">
									2. Jumlah Kas
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($jumlah_kas_penerimaan);  ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<hr />
								</div>
								<div class="col-md-1">(-)</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									3. Selisih Kas
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($selisih_kas_penerimaan); ?>
									</div>
								</div>
							</div>
							<br />
							<strong>Saldo Uang yang Sudah Menjadi Hak Negara</strong><br />
							<div class="row">
								<div class="col-md-6">
									1. Saldo Awal
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_penerimaan_01->hak_saldo_awal); ?>
									</div>
								</div>
								<div class="col-md-6">
									2. Penerimaan yang Sudah Menjadi Hak Negara Bulan Ini
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_penerimaan_01->hak_terima); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<hr />
								</div>
								<div class="col-md-1">(+)</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									3. Jumlah Penerimaan Negara
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($jumlah_penerimaan_negara); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									4. Setoran Atas Penerimaan yang Sudah Menjadi Hak Negara Bulan Ini
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_penerimaan_01->hak_setor); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<hr />
								</div>
								<div class="col-md-1">(-)</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									5. Saldo Akhir
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($saldo_akhir_penerimaan); ?>
									</div>
								</div>
							</div>
							<br />
							<strong>Hasil Rekonsiliasi Internal Dengan UAKPA</strong><br />
							<div class="row">
								<div class="col-md-6">
									1. Penyetoran Menurut Pembukuan Bendahara
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_penerimaan_02->setor); ?>
									</div>
								</div>
								<div class="col-md-6">
									2. Penyetoran Menurut UAKPA (Sesuai Bukti Setor)
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($komponen_penerimaan_02->uakpa); ?>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-9">
									<hr />
								</div>
								<div class="col-md-1">(-)</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									3. Selisih
								</div>
								<div class="col-md-1">Rp</div>
								<div class="col-md-1 col-md-offset-1">
									<div class="pull-right">
										<?php echo amount_format($selisih_uakpa); ?>
									</div>
								</div>
							</div>
							<br />
							<strong>Penjelasan selisih kas dan/atau selisih pembukuan:</strong><br />
							1. <?php echo $komponen_penerimaan_02->ket_selisih_kas; ?><br />
							2. <?php echo $komponen_penerimaan_01->ket_selisih_uakpa; ?>
							
							<br />
							<hr />
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
