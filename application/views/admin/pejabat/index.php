            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>Referensi Pejabat</h5>
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
					  <?php echo anchor('admin/pejabat/edit', '<span class="glyphicon glyphicon-plus-sign"></span> Tambah Referensi Pejabat'); ?>
					  
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
						<thead>
							<tr>
								<th>Nama Pejabat</th>
								<th>NIP Pejabat</th>
								<th>Nama Jabatan</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
                      <tbody>
						<?php 
							if (count($pejabats)) 
							{
								foreach ($pejabats as $pejabat) 
								{
						?>
							<tr>
							  <td><?php echo $pejabat->id_ref_pejabat == NULL ? '' : anchor('admin/pejabat/edit/' . $pejabat->id_ref_pejabat, $pejabat->nm_pejabat); ?></td>
							  <td><?php echo $pejabat->nip_pejabat; ?></td>
							  <td><?php echo $pejabat->nm_jabatan; ?></td>
							  <td><?php echo btn_edit('admin/pejabat/edit/' . $pejabat->id_ref_pejabat); ?></td>
							  <td><?php echo btn_delete('admin/pejabat/delete/' . $pejabat->id_ref_pejabat); ?></td>
							</tr>
						<?php 
								}
							}
							else
							{
						?>
						<tr>
							<td colspan="4">We can not find any pejabat.</td>
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
