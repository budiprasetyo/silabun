	        <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>Generate User</h5>
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
					<!-- form open --> 
					  <!-- form submit -->
						<?php echo form_open(); ?>
							<input type="submit" name="submit" value="Generate" class="btn btn-danger btn-grad" />
					  <!--/form submit -->
					  <hr />
						
					  <!-- form dropdown -->
					  <select name="id_entities" class="form-control">
						  <option value="" selected>-- Pilih Entitas --</option>
					  <?php 
						foreach($entities as $entity)
						{
					  ?>
							<option value="<?php echo $entity->id_entities; ?>"><?php echo strtoupper($entity->entity_desc); ?></option>
					  <?php
						}
					  ?>
					  </select>
					  <!--/form dropdown -->
					  <hr />
					  
				<div class="table-responsive">
				<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
					<thead>
						<tr>
							<th>Pilih</th>
							<th>Kode Satker</th>
							<th>Entitas</th>
							<th>Username</th>
							<th>Password</th>
							<th style="width: 66%;overflow:hidden;display: inline-block;white-space: nowrap;">Nama Satker</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							if (count($users)) 
							{
								$i = 0;
								foreach ($users as $user) 
								{
									++$i;
									
						?>
								<tr>
									<?php echo form_hidden($i . '[id_ref_satker]', $user->id_ref_satker); ?>
									<?php echo form_hidden($i . '[kd_satker]', $user->kd_satker); ?>
									<td>
										<?php 
											echo form_checkbox($i . '[status]', TRUE); 
										?>
									</td>
									<td><?php echo anchor('admin/user/edit/' . $user->id_ref_satker, $user->kd_satker ); ?></td>
									<td class="bg-bg-red"><?php echo $user->id_entities ? $user->id_entities : '<span class="label label-warning">UNDEFINED</span>'; ?></td>
									<td><?php echo $user->username ? $user->username : '<span class="label label-warning">UNDEFINED</span>'; ?></td>
									<td><?php echo $user->password ? $user->password : '<span class="label label-warning">UNDEFINED</span>'; ?></td>
									<td style="width: 95%;overflow:hidden;display: inline-block;white-space: nowrap;"><?php echo strtoupper($user->nm_satker); ?></td>
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
                <?php 
					
					$jml_data = $i; 
					echo form_hidden('jml_data', $jml_data);
					echo form_close(); 
				
				?>
                  </div><!--/sortableTable-->
                  </div><!--/responsiveTable-->
                </div><!--/box-->
              </div><!--/col-lg-12-->
            </div><!-- /.row -->
            <!--End Datatables-->
