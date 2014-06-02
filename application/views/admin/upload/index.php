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
					  
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
						<thead>
							<tr>
								<th>No.</th>
								<th>Satker</th>
								<th>Jan</th>
								<th>Feb</th>
								<th>Mar</th>
								<th>Apr</th>
								<th>Mei</th>
								<th>Jun</th>
								<th>Jul</th>
								<th>Ags</th>
								<th>Sep</th>
								<th>Okt</th>
								<th>Nov</th>
								<th>Des</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
                      <tbody>
						<?php 
							if (count($upload)) 
							{
								foreach ($upload as $upload) 
								{
						?>
							<tr>
							  <td><?php echo anchor('admin/upload/edit/' . $upload->upload_id, $upload->upload); ?></td>
							  <td><?php echo $upload->description; ?></td>
							  <td><?php echo $upload->page_type_id; ?></td>
							  <td><?php echo $upload->language_id; ?></td>
							  <td><?php echo $upload->status_code; ?></td>
							  <td><?php echo btn_edit('admin/upload/edit/' . $upload->upload_id); ?></td>
							  <td><?php echo btn_delete('admin/upload/edit/' . $upload->upload_id); ?></td>
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
