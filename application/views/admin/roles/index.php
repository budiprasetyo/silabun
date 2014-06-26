            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>Wewenang</h5>
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
					  <!-- add category -->
					  <?php echo anchor('admin/roles/edit', '<span class="glyphicon glyphicon-plus-sign"></span> Tambahkan Pengaturan Wewenang'); ?>
				
					  
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
						<thead>
							<tr>
								<th>Nama Entitas</th>
								<th>Deskripsi Wewenang</th>
								<th>Ubah</th>
								<th>Hapus</th>
							</tr>
						</thead>
                      <tbody>
						<?php 
							if (count($roles)) 
							{
								foreach ($roles as $role) 
								{
						?>
							<tr>
<!--
							  <td><?php // echo anchor('admin/categories/edit/' . $role->id_role, $role->categories); ?></td>
-->
							  <td>
								  <?php echo $role->entity_desc; ?>
							  </td>
							  <td><?php echo $role->roles_desc; ?></td>
							  <td><?php echo btn_edit('admin/roles/edit/' . $role->id_roles); ?></td>
							  <td><?php echo btn_delete('admin/roles/delete/' . $role->id_roles); ?></td>
							</tr>
						<?php 
								}
							}
							else
							{
						?>
						<tr>
							<td colspan="4">Kami tidak dapat menemukan pengaturan wewenang.</td>
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
