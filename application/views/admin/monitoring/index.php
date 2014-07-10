            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5><?php echo $table_title; ?></h5>
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
						<label for="text1" class="control-label col-lg-6 bg-primary dker">Bulan <?php echo get_month_name($month); ?>&nbsp;&nbsp;</label>
						<label for="text2" class="control-label col-lg-6">Tahun <?php echo $year; ?></label>
					  </div>
					  <hr />
					  <?php if ($this->data['id_entities'] === '1') { ?>
					  <div class="box">
						<header><h5>Status Pengiriman</h5></header>
						<div class="body">
							<ul>
								<?php 
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
								?>
							</ul>
							
							Keterangan:
							<ul>
								<li class="text-warning"><span class="label label-info">P</span> : Data LPJ Penerimaan</li>
								<li class="text-warning"><span class="label label-danger">K</span> : Data LPJ Pengeluaran</li>
							</ul>
						</div>
					  </div><!--/box-->
					  <hr />
					  <div class="form-group">
							<label for="text3" class="control-label col-lg-12 bg-success">Satker Yang Sudah Mengirimkan LPJ Bendahara</label>
					  </div>
					  <hr />
					  <!-- table -->
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
						<thead>
							<tr>
								<th>No.
								<i class="fa sort"></i></th>
								<th>Kode Satker
								<i class="fa sort"></i></th>
								<th style="width: 80%;overflow:hidden;display: inline-block;white-space: nowrap;">Nama Satker
								<i class="fa sort"></i></th>
							</tr>
						</thead>
						<tbody>
						<?php
							if (count($monitor_satker_sents)) 
								{
									$i = 0;
									foreach ($monitor_satker_sents as $monitor_satker_sent) 
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
						?>
							<tr>
							</tr>
						</tbody>
					  </table>
					  <!-- satker yang belum -->
					  <div class="form-group">
							<label for="text3" class="control-label col-lg-12 bg-danger">Satker Yang Belum Mengirimkan LPJ Bendahara</label>
					  </div>
					  <hr />
					  <?php } ?>
					<!-- table -->
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
						<thead>
							<tr>
								<?php if ($this->data['id_entities'] === '1') { ?>
								<th>No.
								<i class="fa sort"></i></th>
								<th>Kode Satker
								<i class="fa sort"></i></th>
								<th style="width: 80%;overflow:hidden;display: inline-block;white-space: nowrap;">Nama Satker
								<i class="fa sort"></i></th>
								<?php } else if ($this->data['id_entities'] === '2') { ?>
								<th>No.
								<i class="fa sort"></i></th>
								<th>Kode KPPN
								<i class="fa sort"></i></th>
								<th>Nama KPPN
								<i class="fa sort"></i></th>
								<th>Kode Kementerian
								<i class="fa sort"></i></th>
								<th>Data Diterima 
								<i class="fa sort"></i></th>
								<?php 
									} 
									else if ($this->data['id_entities'] === '3')
									{
								?>
								<th>No.
								<i class="fa sort"></i></th>
								<th>Kanwil
								<i class="fa sort"></i></th>
								<th>Kode Kementerian
								<i class="fa sort"></i></th>
								<th>Data Diterima 
								<i class="fa sort"></i></th>
								<?php } ?>
							</tr>
						</thead>
                      <tbody>
						<?php 
							if ( $this->data['id_entities'] === '1' )
							{
								if (count($monitor_satker_unsents)) 
								{
									$i = 0;
									foreach ($monitor_satker_unsents as $monitor_satker_unsent) 
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
							else if ( $this->data['id_entities'] === '2' )
							{
								
								if (count($monitor_kppns)) 
								{
									$i = 0;
									foreach ($monitor_kppns as $monitor_kppn) 
									{
						?>
							<tr>
							  <td><?php echo ++$i; ?></td>
							  <td><?php echo $monitor_kppn->kd_kppn; ?></td>
							  <td><?php echo $monitor_kppn->nm_kppn; ?></td>
							  <td><?php echo $monitor_kppn->kd_kementerian; ?></td>
							  <td><?php echo $monitor_kppn->jml_satker; ?></td>
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
							else if ( $this->data['id_entities'] === '3' )
							{
								if (count($monitor_kanwils))
								{
									$i = 0;
									foreach ($monitor_kanwils as $monitor_kanwil) 
									{
						?>
							<tr>
								<td><?php echo ++$i; ?></td>
								<td>
									<?php echo $monitor_kanwil->kd_kanwil . ' - ' . $monitor_kanwil->nm_kanwil; ?>
								</td>
								<td><?php echo $monitor_kanwil->kd_kementerian; ?></td>
								<td><?php echo $monitor_kanwil->jml_data; ?></td>
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
