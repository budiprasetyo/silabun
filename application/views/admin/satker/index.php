            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>Referensi Satuan Kerja</h5>
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
					<!-- add satker -->
					<?php echo anchor('admin/satker/edit', '<span class="glyphicon glyphicon-plus-sign"></span> Tambah Referensi Satker'); ?><br />
                    <span class="label label-danger">Apabila Satker non aktif maka otomatis status LPJ menjadi tidak wajib</span><br /><br />
                    <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
						<thead>
							<tr style="font-size:11px;">
								<th>No</th>
								<th>Edit</th>
								<th>Tindakan</th>
								<th>B.A.</th>
								<th>Es.I</th>
								<th>Prov.<br />Kab/Kota</th>
								<th>Kd.Satker</th>
								<th>Nama Satker</th>
							</tr>
						</thead>
                      <tbody>
						<?php 
							if (count($satkers)) 
							{
								$i = 1;
								foreach ($satkers as $satker) 
								{
						?>
							<tr style="font-size:11px;">
							  <td><?php echo $i++; ?></td>
							  <td style="font-size:13px;text-align: center;"><?php echo btn_edit('admin/satker/edit/' . $satker->id_ref_satker); ?></td>
							  <td>
								  <div class="btn-group">
									<?php 
										switch ($satker->lpj_status_pengeluaran) {
											case '0':
												$lpj_pengeluaran = btn_mod_warning('admin/satker/status_satker/' . $satker->id_ref_satker . '/FALSE/TRUE', 'NON LPJ PENGELUARAN');
											break;
											case '1':
												$lpj_pengeluaran = btn_mod_metis2('admin/satker/status_satker/' . $satker->id_ref_satker . '/FALSE/TRUE', 'LPJ PENGELUARAN');
											break;
										}

										switch ($satker->lpj_status_penerimaan) {
											case '0':
												$lpj_penerimaan = btn_mod_warning('admin/satker/status_satker/' . $satker->id_ref_satker . '/FALSE/FALSE/TRUE', 'NON LPJ PENERIMAAN');
											break;
											case '1':
												$lpj_penerimaan = btn_mod_primary('admin/satker/status_satker/' . $satker->id_ref_satker . '/FALSE/FALSE/TRUE', 'LPJ PENERIMAAN');
											break;
										}
										
										switch ($satker->aktif) {
											case '0':
												$aktif = btn_mod_danger('admin/satker/status_satker/' . $satker->id_ref_satker . '/TRUE', 'NON AKTIF');
											break;
											case '1':
												$aktif = btn_mod_metis4('admin/satker/status_satker/' . $satker->id_ref_satker . '/TRUE', 'AKTIF');
											break;
										}
										
									?>
									<?php echo $aktif; ?><br />
									<?php echo $lpj_pengeluaran; ?><br />
									<?php echo $lpj_penerimaan; ?>
								  </div>
							  </td>
							  <td><?php echo $satker->kd_kementerian; ?>
							  <td><?php echo $satker->kd_unit; ?></td>
							  <td><?php echo $satker->kd_lokasi.'.'.$satker->kd_kabkota; ?></td>
							  <td class="text-success"><b><?php echo $satker->kd_satker; ?></b></td>
							  <td class="text-info" style="white-space:normal;"><b><?php echo $satker->nm_satker; ?></b></td>
							</tr>
						<?php 
								}
							}
							else
							{
						?>
						<tr>
							<td colspan="4">We can not find any satker.</td>
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
