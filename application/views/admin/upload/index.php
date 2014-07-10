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
					  
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hovered table-striped sortableTable">
						<thead>
							<tr>
								<th>No.
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
							if (count($uploads)) 
							{
								$i = 0;
								foreach ($uploads->result() as $upload) 
								{
									$upload->pos_kirim === 'K' ? $label_status = "label label-danger" : $label_status = "label label-info";
						?>
							<tr>
							  <td><?php echo ++$i; ?></td>
							  <td><?php echo $upload->kd_satker; ?></td>
							  <td><?php echo $upload->tahun; ?></td>
							  <td><?php echo $upload->bulan; ?></td>
							  <td><span class="label label-success"><?php echo $upload->timestamp; ?></span></td>
							  <td><span class="<?php echo $label_status; ?>"><?php echo $upload->pos_kirim; ?></span></td>
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
						?>
                      </tbody>
                    </table>
                  </div><!--/sortableTable-->
                </div><!--/box-->
                  <div class="form-group">
						<label for="text1" class="control-label col-lg-12">
							Keterangan:<br />
							<ul>
								<li>Jumlah LPJ Bendahara <span class="label label-danger">K</span> yang diterima <?php echo $data_sent_k->jml_lpj ? $data_sent_k->jml_lpj : 0; ?> satker</li>
								<li>Jumlah LPJ Bendahara <span class="label label-danger">K</span> yang belum diterima <?php echo $data_unsent_k->jml_lpj ? $data_unsent_k->jml_lpj : 0; ?> satker</li>
								<li>Jumlah LPJ Bendahara <span class="label label-info">P</span> yang diterima <?php echo $data_sent_p->jml_lpj ? $data_sent_p->jml_lpj : 0; ?> satker</li>
								<li><span class="label label-info">P</span> : Data LPJ Penerimaan</li>
								<li><span class="label label-danger">K</span> : Data LPJ Pengeluaran</li>
							</ul>
						</label>
				  </div>
              </div><!--/col-lg-12-->
            </div><!-- /.row -->
            <!--End Datatables-->
