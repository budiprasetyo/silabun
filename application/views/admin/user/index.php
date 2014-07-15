	        <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>Registrasi User</h5>
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
					  <?php echo anchor('admin/user/edit', '<span class="glyphicon glyphicon-plus-sign"></span> Tambahkan User'); ?>
	
				<div class="table-responsive">
				<table id="dataTable_wrapper" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
					<thead>
						<tr>
							<th>Username</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if (count($users)) 
							{
								foreach ($users as $user) 
								{
								
						?>
						<tr>
							<td><?php echo anchor('admin/user/edit/' . $user->id_users, $user->username ); ?></td>
							<td><?php echo btn_edit('admin/user/edit/' . $user->id_users); ?></td>
							<td><?php echo btn_delete('admin/user/delete/' . $user->id_users); ?></td>
						</tr>
						<?php 
								}
							}
							else
							{
						?>
						<tr>
							<td colspan="3">Kami tidak dapat menemukan user tersebut.</td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
                  </div><!--/sortableTable-->
                  </div><!--/responsiveTable-->
                </div><!--/box-->
              </div><!--/col-lg-12-->
            </div><!-- /.row -->
            <!--End Datatables-->
