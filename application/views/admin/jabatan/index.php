            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>Referensi Jabatan</h5>
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
					  <!-- add jabatan -->
					  <?php echo anchor('admin/jabatan/edit', '<span class="glyphicon glyphicon-plus-sign"></span> Tambah Referensi Jabatan'); ?>
					  
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
						<thead>
							<tr>
								<th>Nama Jabatan</th>
								<th>Apakah Pejabat</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
                      <tbody>
						<?php 
							if (count($jabatans)) 
							{
								foreach ($jabatans as $jabatan) 
								{
						?>
							<tr>
							  <td><?php echo anchor('admin/jabatan/edit/' . $jabatan->id_ref_jabatan, $jabatan->nm_jabatan); ?></td>
							  <td><?php echo $jabatan->is_boss == 1 ? 'Ya' : 'Tidak'; ?></td>
							  <td><?php echo btn_edit('admin/jabatan/edit/' . $jabatan->id_ref_jabatan); ?></td>
							  <td><?php echo btn_delete('admin/jabatan/delete/' . $jabatan->id_ref_jabatan); ?></td>
							</tr>
						<?php 
								}
							}
							else
							{
						?>
						<tr>
							<td colspan="4">We can not find any jabatan.</td>
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
