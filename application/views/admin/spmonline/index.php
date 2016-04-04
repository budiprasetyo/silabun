            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>Referensi SPM Online</h5>
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
					  
                      
					  <?php  $add=count($spmonline) > 0 ? '' :  anchor('admin/spmonline/edit', '<span class="glyphicon glyphicon-plus-sign"></span> Tambah URL SPM ONLINE'); 
                      echo $add;
                      ?>
					  
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
						<thead>
							<tr>
								<th>id</th>
								<th>Url</th>
                                <th>Action</th>
								
							</tr>
						</thead>
                      <tbody>
						<?php 
							if (count($spmonline)) 
							{
								foreach ($spmonline as $data) 
								{
						?>
							<tr>
							  <td><?php echo anchor('admin/spmonline/edit/' . $data->id, $data->id); ?></td>
							  
							  <td><?php echo  $data->url; ?></td>
                                <td><?php echo btn_edit('admin/spmonline/edit/' . $data->id, $data->id); ?>
                                    <?php echo btn_delete('admin/spmonline/delete/' . $data->id, $data->id); ?>
                                </td>
							
							</tr>
						<?php 
								}
							}
							else
							{
						?>
						<tr>
							<td colspan="4">Data Kosong.</td>
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
