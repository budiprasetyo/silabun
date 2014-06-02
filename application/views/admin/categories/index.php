            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>Dynamic Table</h5>
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
					  <?php echo anchor('admin/categories/edit', '<span class="glyphicon glyphicon-plus-sign"></span> Add Category'); ?>
					  
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
						<thead>
							<tr>
								<th>Category</th>
								<th>Description</th>
								<th>Page Type</th>
								<th>Language</th>
								<th>Active</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
                      <tbody>
						<?php 
							if (count($categories)) 
							{
								foreach ($categories as $category) 
								{
						?>
							<tr>
							  <td><?php echo anchor('admin/categories/edit/' . $category->categories_id, $category->categories); ?></td>
							  <td><?php echo $category->description; ?></td>
							  <td><?php echo $category->page_type_id; ?></td>
							  <td><?php echo $category->language_id; ?></td>
							  <td><?php echo $category->status_code; ?></td>
							  <td><?php echo btn_edit('admin/categories/edit/' . $category->categories_id); ?></td>
							  <td><?php echo btn_delete('admin/categories/edit/' . $category->categories_id); ?></td>
							</tr>
						<?php 
								}
							}
							else
							{
						?>
						<tr>
							<td colspan="3">We can not find any category.</td>
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
