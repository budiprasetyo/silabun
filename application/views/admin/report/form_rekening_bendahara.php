	<div class="row">
		<div class="col-lg-12">
			<div class="box">
				
				<header>
					<div class="icons">
						<i class="glyphicon glyphicon-print"></i>
					</div><!--/icons-->
					<h5>Pencetakan Rekening Bendahara <?php echo $title; ?></h5>
					
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
						if (count($parent_rekening_pengeluaran)
							&& ($id_entities === '2'
							OR $id_entities === '3')
							) 
						{
					  ?>
							<hr />
							<h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
							<?php echo $nm_entity; ?></h4>
							<h5 class="text-center"><?php echo $period; ?></h5>
							<br />
							<div class="table-responsive">
								
							  <!-- table -->
							  <table class="table table-bordered table-condensed">
								<thead style="font-size:11px;">
									<tr class="bg-green dker">
										<th>KPPN<br />
												Kementerian</th>
										<th>Satker</th>
										<th>Nama Bank</th>
										<th>Nama Rekening</th>
										<th>No. Rekening</th>
										<th>No. Surat</th>
										<th>Tgl. Surat</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									foreach ( $parent_rekening_pengeluaran as $rekening_pengeluaran => $groups ) 
									{
								?>
										<tr style="font-weight: bold; font-size:11px;">
											<td class="bg-green lter" colspan="7"><?php echo $rekening_pengeluaran; ?></td>
										</tr>
								<?php
										foreach ( $groups as $kementerian => $results ) 
										{
										?>
											<tr style="font-weight: bold; font-size:11px;">
												<td class="bg-green" colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $kementerian; ?></td>
											</tr>
										<?php
											foreach ($results as $detil) 
											{
											?>
												<tr style="font-size:10px;white-space:normal;height:50px;">
													<td></td>
													<td width="22%"><?php echo $detil['kd_satker']; ?> <br /> <?php echo $detil['nm_satker']; ?></td>
													<td width="15%"><?php echo strtoupper($detil['nm_bank']); ?></td>
													<td width="20%"><?php echo strtoupper($detil['nm_rekening']); ?></td>
													<td width="15%"><?php echo strtoupper($detil['no_rekening']); ?></td>
													<td width="15%"><?php echo strtoupper($detil['no_srt']); ?></td>
													<td width="8%"><?php echo strtoupper(date_convert($detil['tgl_srt'])); ?></td>
												</tr>
											<?php
											}
										}
									}
								 ?>
								</tbody>
							  </table>
							
					  <?php
						}
						elseif (count($parent_rekening_penerimaan)
							&& ($id_entities === '2'
							OR $id_entities === '3')
							) 
						{
						?>
							<hr />
							<h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
							<?php echo $nm_entity; ?></h4>
							<h5 class="text-center"><?php echo $period; ?></h5>
							<br />
							<div class="table-responsive">
								
							  <!-- table -->
							  <table class="table table-bordered table-condensed">
								<thead style="font-size:11px;">
									<tr class="bg-green dker">
										<th>KPPN<br />
												Kementerian</th>
										<th>Satker</th>
										<th>Nama Bank</th>
										<th>Nama Rekening</th>
										<th>No. Rekening</th>
										<th>No. Surat</th>
										<th>Tgl. Surat</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								foreach ( $parent_rekening_penerimaan as $rekening_penerimaan => $groups ) 
								{
								?>
										<tr style="font-weight: bold; font-size:11px;">
											<td class="bg-green lter" colspan="7"><?php echo $rekening_penerimaan; ?></td>
										</tr>
								<?php
										foreach ( $groups as $kementerian => $results ) 
										{
										?>
											<tr style="font-weight: bold; font-size:11px;">
												<td class="bg-green" colspan="7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $kementerian; ?></td>
											</tr>
										<?php
											foreach ($results as $detil) 
											{
											?>
												<tr style="font-size:10px;white-space:normal;height:50px;">
													<td></td>
													<td width="22%"><?php echo $detil['kd_satker']; ?> <br /> <?php echo $detil['nm_satker']; ?></td>
													<td width="15%"><?php echo strtoupper($detil['nm_bank']); ?></td>
													<td width="20%"><?php echo strtoupper($detil['nm_rekening']); ?></td>
													<td width="15%"><?php echo strtoupper($detil['no_rekening']); ?></td>
													<td width="15%"><?php echo strtoupper($detil['no_srt']); ?></td>
													<td width="8%"><?php echo strtoupper(date_convert($detil['tgl_srt'])); ?></td>
												</tr>
											<?php
											}
										}
									}
								 ?>
								</tbody>
							</table>
							
					  <?php
						}
						else if ( count($parent_rekening_kppn_pengeluaran)
								&& $id_entities === '1' )
						{
						?>
							<hr />
							<h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
							<?php echo $nm_entity; ?></h4>
							<h5 class="text-center"><?php echo $period; ?></h5>
							<br />
							<div class="table-responsive">
								<!-- table -->
								<table class="table table-bordered table-condensed">
									<thead style="font-size:11px;">
										<tr class="bg-green dker">
											<th rowspan="2" class="text-center">B.A.</th>
											<th rowspan="2" class="text-center">Es.I</th>
											<th rowspan="2" class="text-center">Satker</th>
											<th rowspan="2" class="text-center">No. Rekening</th>
											<th rowspan="2" class="text-center">Nama Rekening</th>
											<th rowspan="2" class="text-center">Kode Rekening</th>
											<th rowspan="2" class="text-center">Nama Bank</th>
											<th colspan="2" class="text-center">Surat Ijin</th>
										</tr>
										<tr class="bg-green dker">
											<th class="text-center">No. Surat</th>
											<th class="text-center">Tgl. Surat</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									foreach ( $parent_rekening_kppn_pengeluaran as $rekening_pengeluaran => $results ) 
									{
										
									?>
										<tr style="font-weight: bold; font-size:11px;">
											<td class="bg-green" colspan="9"><?php echo $rekening_pengeluaran; ?></td>
										</tr>
										<?php
										foreach ($results as $rows => $detils) 
										{
										?>
											<tr style="font-weight: bold; font-size:11px;">
												<td class="bg-orange dker" >Es.I</td>
												<td class="bg-green lter" colspan="8"><?php echo $rows; ?></td>
											</tr>
										<?php
											foreach ($detils as $detil) 
											{
											?>
												<tr style="font-size:10px;white-space:normal;height:50px;">
													<td></td>
													<td></td>
													<td width="22%"><?php echo $detil['kd_satker']; ?> <br /> <?php echo $detil['nm_satker']; ?></td>
													<td width="10%"><?php echo strtoupper($detil['no_rekening']); ?></td>
													<td width="20%"><?php echo strtoupper($detil['nm_rekening']); ?></td>
													<td width="2%"><?php echo strtoupper($detil['kd_rekening']); ?></td>
													<td width="20%"><?php echo strtoupper($detil['nm_bank']); ?></td>
													<td width="13%"><?php echo strtoupper($detil['no_srt']); ?></td>
													<td width="8%"><?php echo strtoupper(date_convert($detil['tgl_srt'])); ?></td>
												</tr>
											<?php
											}
										}
									}
									?>
									</tbody>
								</table>
							
						<?php
						}
						else if ( count($parent_rekening_kppn_penerimaan)
								&& $id_entities === '1' )
						{
						?>
							<hr />
							<h4 class="text-center" style="font-weight:bold;"><?php echo ucwords($subtitle); ?><br />
							<?php echo $nm_entity; ?></h4>
							<h5 class="text-center"><?php echo $period; ?></h5>
							<br />
							<div class="table-responsive">
								<!-- table -->
								<table class="table table-bordered table-condensed">
									<thead style="font-size:11px;">
										<tr class="bg-green dker">
											<th rowspan="2" class="text-center">B.A.</th>
											<th rowspan="2" class="text-center">Es.I</th>
											<th rowspan="2" class="text-center">Satker</th>
											<th rowspan="2" class="text-center">No. Rekening</th>
											<th rowspan="2" class="text-center">Nama Rekening</th>
											<th rowspan="2" class="text-center">Kode Rekening</th>
											<th rowspan="2" class="text-center">Nama Bank</th>
											<th colspan="2" class="text-center">Surat Ijin</th>
										</tr>
										<tr class="bg-green dker">
											<th class="text-center">Nomor</th>
											<th class="text-center">Tanggal</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									foreach ( $parent_rekening_kppn_penerimaan as $rekening_penerimaan => $results ) 
									{
										
									?>
										<tr style="font-weight: bold; font-size:11px;">
											<td class="bg-green" colspan="9"><?php echo $rekening_penerimaan; ?></td>
										</tr>
									<?php
										foreach ($results as $rows => $detils) 
										{
									?>
											<tr style="font-weight: bold; font-size:11px;">
												<td class="bg-orange dker">Es.I</td>
												<td class="bg-green lter" colspan="8"><?php echo $rows; ?></td>
											</tr>
									<?php
											foreach ($detils as $detil) 
											{
									?>
												<tr style="font-size:10px;white-space:normal;height:50px;">
													<td class="bg-light"></td>
													<td class="bg-light"></td>
													<td width="22%"><?php echo $detil['kd_satker']; ?> <br /> <?php echo $detil['nm_satker']; ?></td>
													<td width="10%"><?php echo strtoupper($detil['no_rekening']); ?></td>
													<td width="20%"><?php echo strtoupper($detil['nm_rekening']); ?></td>
													<td width="2%"><?php echo strtoupper($detil['kd_rekening']); ?></td>
													<td width="20%"><?php echo strtoupper($detil['nm_bank']); ?></td>
													<td width="13%"><?php echo strtoupper($detil['no_srt']); ?></td>
													<td width="8%"><?php echo strtoupper(date_convert($detil['tgl_srt'])); ?></td>
												</tr>
											<?php
											}
										}
									}
									?>
									</tbody>
								</table>
						<?php
						}
					  ?>
					  
							</div><!--/table-responsive-->
							
				</div><!--/collapse-->
				
			</div><!--/ box -->
		</div><!--/ col-lg-12 -->
	</div><!--/ row -->
