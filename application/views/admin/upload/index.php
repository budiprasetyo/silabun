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
						  <input type="text" id="text1" placeholder="Tahun" class="form-control" name="tahun" maxlength="4" value="<?php echo $tahun; ?>"/>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="text1" class="control-label col-lg-2">Bulan</label>
						<div class="col-lg-3">
						  <input type="text" id="text1" placeholder="Bulan" class="form-control" name="bulan" maxlength="2" autofocus="autofocus" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<div class="col-lg-2 controls">
							<?php 
								$attributes = 'class = "btn btn-primary"';
								echo form_submit('submit', 'Tampilkan', $attributes);
							?>
						</div>
					  </div><!--/.form-group -->
					  
					  </form>
					  <hr />
					  
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
						<thead>
							<tr>
								<th>No.</th>
								<th>Satker</th>
								<th>Tahun</th>
								<th>Bulan</th>
								<th>Timestamp Pengiriman</th>
								<th>Pos Data</th>
							</tr>
						</thead>
                      <tbody>
						<?php 
							if (count($uploads)) 
							{
								$i = 0;
								foreach ($uploads->result() as $upload) 
								{
						?>
							<tr>
							  <td><?php echo ++$i; ?></td>
							  <td><?php echo $upload->kdsatker; ?></td>
							  <td><?php echo $upload->tahun; ?></td>
							  <td><?php echo $upload->bulan; ?></td>
							  <td><?php echo $upload->timestamp; ?></td>
							  <td><?php echo $upload->pos_kirim; ?></td>
							</tr>
						<?php 
								}
							}
							else
							{
						?>
						<tr>
							<td colspan="16">We can not find any upload.</td>
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
