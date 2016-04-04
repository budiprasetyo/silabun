            <!--Begin Datatables-->
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <header>
                    <div class="icons">
                      <i class="fa fa-table"></i>
                    </div>
                    <h5>Ambil REST API SPM Online</h5>
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
                      
				    <form class="form-horizontal" >					  
					  <div class="form-group">
						<label for="year" class="control-label col-lg-2">Tahun</label>
						<div class="col-lg-3">
						  <input type="text" id="year" placeholder="Tahun" class="form-control" name="year" maxlength="4" value="<?php echo $year; ?>"/>
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<label for="month" class="control-label col-lg-2">Bulan</label>
						<div class="col-lg-3">
						  <input type="text" id="month" placeholder="Bulan" class="form-control" name="month" maxlength="2" autofocus="autofocus" />
						</div>
					  </div><!-- /.form-group -->
                    <div class="form-group">
						
						<div class="col-lg-3">
						  <input type="hidden" id="kdkppn"class="form-control" name="kdkppn" value="<?php echo $kppn->kd_kppn; ?>" />
                        <input type="hidden" id="token_api"class="form-control" name="token_api" value="<?php echo md5($kppn->kd_kppn); ?>" />
                       <input type="hidden" id="url"class="form-control" name="url" value="<?php echo $url; ?>" />
						</div>
					  </div><!-- /.form-group -->
					  
					  <div class="form-group">
						<div class="col-lg-2 controls">
							<?php 
								$attributes = 'class = "btn btn-primary btn-grad", onclick="return data_api()"';
								echo form_submit('submit', 'Tampilkan', $attributes);
							?>
						</div>
					  </div><!--/.form-group -->					  
					</form>
					  <br>
                    <table id="dataTable_wrapper" class="table table-bordered table-condensed table-hover table-striped sortableTable responsive-table">
						<thead>
							<tr>
								<th>kdsatker</th>
								<th>File</th>
                                <th>Jenis</th>
                                <th>Action</th>
								
							</tr>
						</thead>
                        <div id="data-api">                        
                          
                          
                          </div>
                      <tbody id="hasil-data-api">
						
                      </tbody>
                    </table>
                  </div><!--/sortableTable-->
                </div><!--/box-->
              </div><!--/col-lg-12-->
            </div><!-- /.row -->
            <!--End Datatables-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg" >
    <div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
      <div class="panel panel-info">
        <div class="panel-heading">
            LPJ Pengeluaran
        </div>
        <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" role="tab" id="lpj-tab" onclick="show_tab(0)" >LPJ </a></li>
            
            <li><a data-toggle="tab"  role="tab" id="rekening-tab" onclick="show_tab(1)">Rekening</a></li>
                      
          </ul>
            <div class="tab-content">
                <div id="lpj" class="tab-pane fade in active">
                    <table class="table table-condensed">
                <thead class="col-sm-16">
                    <th  class="col-sm-3"><center>FORM LPJ <br>PENGELUARAN</center></th>
                    <th class="col-sm-6"><center>LAPORAN PERTANGGUNGJAWABAN BENDAHARA PENGELUARAN <br><div id="lpjk_bulan"></div></center></th>
                    <th class="col-sm-3"><center>TAHUN ANGGARAN <div id="lpjk_thang1"></div><br></center></th>
                </thead>
            
            <tbody class="col-sm-16" style="font-size:12px">
                <tr>
                    <th colspan="3">
                        <div class="col-sm-3"  align="left">Kementerian Negara Lembaga</div>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-8" id="lpjk_kddept" align="left"></div>
                    </th>
					</tr>
					<tr>
					
                    <th colspan="3" align="left">
                        <div class="col-sm-3"  align="left">Unit Organisasi</div>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-8" id="lpjk_kdunit" align="left"></div>
                    </th>
					</tr>
					<tr>
                    <th colspan="3" align="left">
                        <div class="col-sm-3" align="left">Provinsi/Kab/Kota</div>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-8" id="lpjk_kdkabkota" align="left"></div>
                    </th>
					</tr>
					<tr>
					
                     <th colspan="3" >
                        <div class="col-sm-3"  align="left">Satuan Kerja</div>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-8" id="lpjk_kdsatker"  align="left"></div>
                    </th>
					</tr>
					<tr>
                    <th colspan="3">
                        <div class="col-sm-3"  align="left">Alamat dan Telp</div>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-8" id="lpjk_alamat"  align="left"></div>
                    </th>
					</tr>
					<tr>
                    <th colspan="3">
                        <div class="col-sm-3"  align="left">No Krws & Kewenangan</div>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-8" id="lpjk_karwas"  align="left"></div>
                    </th>
					</tr>
					<tr>
                    <th colspan="3">
                        <div class="col-sm-3"  align="left">Dokumen</div>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-8" id="lpjk_kdjendok"  align="left"></div>
                    </th>
					</tr>
					<tr>
                    <th colspan="3">
                        <div class="col-sm-3"  align="left">Nomor Dokumen</div>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-8" id="lpjk_nodok"  align="left"></div>
                    </th>
					</tr>
					<tr>
                     <th colspan="3">
                        <div class="col-sm-3"  align="left">Tanggal Dokumen</div>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-8" id="lpjk_tgdok"  align="left"></div>
                    </th>
					</tr>
					<tr>
                      <th colspan="3">
                        <div class="col-sm-3"  align="left">Tahun Anggaran</div>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-8" id="lpjk_thang2"  align="left"></div>
                    </th>
					</tr>
					<tr>
                    <th colspan="3">
                        <div class="col-sm-3"  align="left" >KPPN</div>
                        <div class="col-sm-1"> : </div>
                        <div class="col-sm-8" id="lpjk_kdkppn"  align="left" ></div>
                    </th>
					</tr>
					<tr>
                    <th colspan="3">
                        <div class="col-sm-12" id="lpjk_sakhir_bku" align="left">
                           
                        </div>
                    </th>
                </tr>
                <tr>
                    <table class="table table-bordered" style="font-size: 12px">
                        <thead> 
                            <tr>
                               <th class="col-sm-1">
                                NO
                               </th>
                               <th class="col-sm-3">
                                JENIS BUKU PEMBANTU
                               </th>
                                <th class="col-sm-2">
                                SALDO AWAL
                               </th>
                                 <th class="col-sm-2">
                                PENAMBAHAN
                               </th>
                                  <th class="col-sm-2">
                                PENGURANGAN
                               </th>
                                   <th class="col-sm-2">
                                SALDO AKHIR
                               </th>
                            </tr>
                            <tr>
                               <th class="col-sm-1">
                                (1)
                               </th>
                               <th class="col-sm-3">
                              (2)
                               </th>
                                <th class="col-sm-2">
                                (3)
                               </th>
                                 <th class="col-sm-2">
                                (4)
                               </th>
                                  <th class="col-sm-2">
                                (5)
                               </th>
                                   <th class="col-sm-2">
                                (6)
                               </th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr>
                               <th class="col-sm-1">
                                <span style="font-weight: bold">A</span>
                               </th>
                               <th class="col-sm-3" align="left">
                              <span style="font-weight: bold">BP Kas, BPP, dan UM Perjadin</span>
                               </th>
                                <th class="col-sm-2">
                                
                               </th>
                                 <th class="col-sm-2">
                                
                               </th>
                                  <th class="col-sm-2">
                                
                               </th>
                                   <th class="col-sm-2">
                                
                               </th>
                            </tr>
                             <tr>
                               <th class="col-sm-1">                                
                               </th>
                               <th class="col-sm-3" align="left">
                                1. BP Kas (tunai dan bank)
                               </th>
                                <th class="col-sm-2" id="lpjk_sawal_bpkas" align="right">
                                
                               </th>
                                 <th class="col-sm-2" id="lpjk_debet_bpkas" align="right">
                                
                               </th>
                                  <th class="col-sm-2" id="lpjk_kredit_bpkas" align="right">
                                
                               </th>
                                   <th class="col-sm-2" id="lpjk_sakhir_bpkas" align="right">
                                
                               </th>
                            </tr>
                            <tr>
                               <th class="col-sm-1">                                
                               </th>
                               <th class="col-sm-3" align="left">
                                2. BP Uang Muka/Voucher
                               </th>
                                <th class="col-sm-2" id="lpjk_sawal_um" align="right">
                                
                               </th>
                                 <th class="col-sm-2" id="lpjk_debet_um" align="right">
                                
                               </th>
                                  <th class="col-sm-2" id="lpjk_kredit_um" align="right">
                                
                               </th>
                                   <th class="col-sm-2" id="lpjk_sakhir_um" align="right">
                                
                               </th>
                            </tr>
                            <tr>
                               <th class="col-sm-1">                                
                               </th>
                               <th class="col-sm-3" align="left">
                                3. BP BPP (Kas pada BPP)
                               </th>
                                <th class="col-sm-2" id="lpjk_sawal_bpp" align="right">
                                
                               </th>
                                 <th class="col-sm-2" id="lpjk_debet_bpp" align="right">
                                
                               </th>
                                  <th class="col-sm-2" id="lpjk_kredit_bpp" align="right">
                                
                               </th>
                                   <th class="col-sm-2" id="lpjk_sakhir_bpp" align="right">
                                
                               </th>
                            </tr>
                             <tr>
                               <th class="col-sm-1">
                                <span style="font-weight: bold">B</span>
                               </th>
                               <th class="col-sm-3" align="left">
                              <span style="font-weight: bold">BP selain Kas, BPP, dan UM Perjadin</span>
                               </th>
                                <th class="col-sm-2">
                                
                               </th>
                                 <th class="col-sm-2">
                                
                               </th>
                                  <th class="col-sm-2">
                                
                               </th>
                                   <th class="col-sm-2">
                                
                               </th>
                            </tr>
                             <tr>
                               <th class="col-sm-1">                                
                               </th>
                               <th class="col-sm-3" align="left">
                                1. BP UP *)
                               </th>
                                <th class="col-sm-2" id="lpjk_sawal_bpup" align="right">
                                
                               </th>
                                 <th class="col-sm-2" id="lpjk_debet_bpup" align="right">
                                
                               </th>
                                  <th class="col-sm-2" id="lpjk_kredit_bpup" align="right">
                                
                               </th>
                                   <th class="col-sm-2" id="lpjk_sakhir_bpup" align="right">
                                
                               </th>
                            </tr>
                             <tr>
                               <th class="col-sm-1">                                
                               </th>
                               <th class="col-sm-3" align="left">
                                2. BP LS-Bendahara
                               </th>
                                <th class="col-sm-2" id="lpjk_sawal_lsbend" align="right">
                                
                               </th>
                                 <th class="col-sm-2" id="lpjk_debet_lsbend" align="right">
                                
                               </th>
                                  <th class="col-sm-2" id="lpjk_kredit_lsbend" align="right">
                                
                               </th>
                                   <th class="col-sm-2" id="lpjk_sakhir_lsbend" align="right">
                                
                               </th>
                            </tr>
                             <tr>
                               <th class="col-sm-1">                                
                               </th>
                               <th class="col-sm-3" align="left">
                                3. BP Pajak
                               </th>
                                <th class="col-sm-2" id="lpjk_sawal_pajak" align="right">
                                
                               </th>
                                 <th class="col-sm-2" id="lpjk_debet_pajak" align="right">
                                
                               </th>
                                  <th class="col-sm-2" id="lpjk_kredit_pajak" align="right">
                                
                               </th>
                                   <th class="col-sm-2" id="lpjk_sakhir_pajak" align="right">
                                
                               </th>
                            </tr>
                             <tr>
                               <th class="col-sm-1">                                
                               </th>
                               <th class="col-sm-3" align="left">
                                4. BP Lain-lain
                               </th>
                                <th class="col-sm-2" id="lpjk_sawal_lain">
                                
                               </th>
                                 <th class="col-sm-2" id="lpjk_debet_lain">
                                
                               </th>
                                  <th class="col-sm-2" id="lpjk_kredit_lain">
                                
                               </th>
                                   <th class="col-sm-2" id="lpjk_sakhir_lain">
                                
                               </th>
                            </tr>
                             
                        </tbody>
                    </table> <!-- table kedua -->
                </tr>          
                <tr colspan="3" style="font-size: 12px">
                    <th class="col-sm-12" > <div id="lpjk_kuitansi_up" align="left" >A</div>                         
                    </th>
                </tr>
                <tr colspan="3" style="font-size: 12px">
                     <th>
                        <div class="col-sm-12">
                           <span style="font-weight: bold">II. Keadaan kas pada akhir bulan pelaporan</span>
                        </div>
                    </th>
                </tr>
                <tr colspan="3" style="font-size: 12px">
                     <th>
                        <div class="col-sm-6">
                           1. Uang Tunai di brankas
                        </div>
                        <div class="col-sm-1">Rp</div>
                        <div class="col-sm-5" id="lpjk_brankas" ></div>
                    </th>
                </tr>
                 <tr colspan="3" >
                     <th>
                        <div class="col-sm-6" style="font-size:12px">2. Uang di rekening bank (terlampir Daftar Rincian Kas di Rekening)
                          
                        </div>
                        <div class="col-sm-1">Rp</div>
                        <div class="col-sm-5" id="lpjk_rekening_bank" ></div>
                    </th>
                </tr>
                 <tr colspan="3">
                     <th>
                        <div class="col-sm-6">
                          3. Jumlah kas
                        </div>
                        <div class="col-sm-1">Rp</div>
                        <div class="col-sm-5" id="lpjk_jumlah_kas" ></div>
                    </th>
                </tr>
                 <tr colspan="3">
                     <th>
                        <div class="col-sm-12">
                           <span style="font-weight: bold">III. Selisih Kas</span>
                        </div>
                    </th>
                </tr>
                <tr colspan="3">
                     <th>
                        <div class="col-sm-6">
                           1. Saldo Akhir BP Kas (I.A 1 kolom (6))
                        </div>
                        <div class="col-sm-1">Rp</div>
                        <div class="col-sm-5" id="lpjk_sakhir_bpkas1" ></div>
                    </th>
                </tr>
                 <tr colspan="3">
                     <th>
                        <div class="col-sm-6">
                          2. Jumlah Kas (II.3)
                        </div>
                        <div class="col-sm-1">Rp</div>
                        <div class="col-sm-1" id="lpjk_jumlah_kas1" ></div>
                    </th>
                </tr>                 
                 <tr colspan="3">
                     <th>
                        <div class="col-sm-6">
                          3. Selisih Kas
                        </div>
                        <div class="col-sm-1">Rp</div>
                        <div class="col-sm-1" id="lpjk_selisih_kas" ></div>
                    </th>
                </tr>
                <tr colspan="3">
                     <th>
                        <div class="col-sm-12">
                           <span style="font-weight: bold">IV. Hasil Rekonsiliasi Internal dengan UAKPA</span>
                        </div>
                    </th>
                </tr>
                <tr colspan="3">
                     <th>
                        <div class="col-sm-6">
                          1. Saldo UP
                        </div>
                        <div class="col-sm-1">Rp</div>
                        <div class="col-sm-1" id="lpjk_sakhir_bpup1" align="right"></div>
                    </th>
                </tr>
                <tr colspan="3">
                     <th>
                        <div class="col-sm-6">
                          2. Kuitansi UP
                        </div>
                        <div class="col-sm-1">Rp</div>
                        <div class="col-sm-1" id="lpjk_kuitansi_up1" align="right"></div>
                    </th>
                </tr>
                <hr>
                  <tr colspan="3">
                     <th>
                        <div class="col-sm-6">
                          3. Jumlah UP
                        </div>
                        <div class="col-sm-1">Rp</div>
                        <div class="col-sm-1" id="lpjk_jumlah_up" align="right"></div>
                    </th>
                </tr>
                  <tr colspan="3">
                     <th>
                        <div class="col-sm-6">
                          4. Saldo UP menurut UAKPA
                        </div>
                        <div class="col-sm-1">Rp</div>
                        <div class="col-sm-1" id="lpjk_saldo_up_uakpa" align="right"></div>
                    </th>
                </tr>
                  <tr colspan="3">
                     <th>
                        <div class="col-sm-6">
                          5. Selisih Pembukuan UP
                        </div>
                        <div class="col-sm-1">Rp</div>
                        <div class="col-sm-1" id="lpjk_selisih_up" align="right"></div>
                    </th>
                </tr>
                 <tr colspan="3">
                     <th>
                        <div class="col-sm-12">
                           <span style="font-weight: bold">V. Penjelasan selisih kas dan/atau selisih pembukuan (apabila ada):</span>
                        </div>
                    </th>
                </tr>
                    <tr colspan="3">
                     <th>
                        <div class="col-sm-12" >
                           <span  id="lpjk_ket_selisih_kas" >1.</span>
                        </div>
                    </th>
                </tr>
                   <tr colspan="3">
                     <th>
                        <div class="col-sm-12" >
                           <span  id="lpjk_ket_selisih_up">2.</span>
                        </div>
                    </th>
                </tr>
                 <tr colspan="3">
                     <th>
                        <div class="col-sm-6" >
                           <span >Mengetahui</span>
                        </div>
                         <div class="col-sm-6" >
                           <span >...</span>
                        </div>
                    </th>
                </tr>
                  <tr colspan="3">
                     <th>
                        <div class="col-sm-6" >
                           <span >Kuasa Pengguna Anggaran /
PPK atas nama KPA</span>
                        </div>
                         <div class="col-sm-6" >
                           <span >Bendahara Pengeluaran</span>
                        </div>
                    </th>
                </tr>
                <tr  colspan="3">
                     <th>
                        <div class="col-sm-6" >
                           <span >     </span>
                        </div>
                         <div class="col-sm-6" >
                           <span >     </span>
                        </div>
                    </th>
                </tr>
                <tr  colspan="3">
                     <th>
                        <div class="col-sm-6" >
                           <span > &nbsp;    </span>
                        </div>
                         <div class="col-sm-6" >
                           <span >  &nbsp;   </span>
                        </div>
                    </th>
                </tr>
                <tr  colspan="3">
                     <th>
                        <div class="col-sm-6" >
                           <span >   &nbsp;  </span>
                        </div>
                         <div class="col-sm-6" >
                           <span >   &nbsp;  </span>
                        </div>
                    </th>
                </tr>
                <tr colspan="3">
                     <th>
                        <div class="col-sm-6" >
                           <span id="lpjk_nm_kpa"></span>
                        </div>
                         <div class="col-sm-6" >
                           <span id="lpjk_nm_bend"></span>
                        </div>
                    </th>
                </tr>
                <tr colspan="3">
                     <th>
                        <div class="col-sm-6" >
                           <span id="lpjk_nip_kpa"></span>
                        </div>
                         <div class="col-sm-6" >
                           <span id="lpjk_nip_bend"></span>
                        </div>
                    </th>
                </tr>
            </tbody>
			</table>
                     </div>
    <div  id="data-rekening" >
      <table  class="table table-condensed" id="isi-data-rekening">
          <thead>
              <th>
                <div class="col-sm-1">
                  No
                </div>
              </th>
              <th>
                <div class="col-sm-3">
                  Nomor Rekening
                </div>
              </th>
              <th>
                <div class="col-sm-3">
                  Nama Rekening
                </div>
              </th>
              <th>
                <div class="col-sm-4">
                  Nama Bank
                </div>
              </th>
              <th>
                <div class="col-sm-1">
                  Kode Rek
                </div>
              </th>
              <th>
                <div class="col-sm-2">
                  Nomor Surat
                </div>
              </th>
              <th>
                <div class="col-sm-2">
                  Tanggal Surat
                </div>
              </th>
              <th>
                <div class="col-sm-2">
                  saldo
                </div>
              </th>
          
          </thead>
          <tbody>
            <tr>
                <td>
                    <div id= "no_count" class="col-sm-1">
                  
                    </div>
                </td> 
                 <td>
                    <div id= "no_rekening" class="col-sm-3">
                  
                    </div>
                </td> 
                <td>
                    <div id= "nm_rekening" class="col-sm-3">
                  
                    </div>
                </td>
                <td>
                    <div id= "nm_bank" class="col-sm-4">
                  
                    </div>
                </td> 
                 <td>
                    <div id= "kd_rekening" class="col-sm-1">
                  
                    </div>
                </td> 
                 <td>
                    <div id= "no_surat" class="col-sm-2">
                  
                    </div>
                </td> 
                 <td>
                    <div id= "tgl_surat" class="col-sm-2">
                  
                    </div>
                </td> 
                 <td>
                    <div id= "saldo" class="col-sm-2">
                  
                    </div>
                </td> 
            </tr>
          </tbody>
          
        </table>
    </div>
            </div>
        </div> <!-- end of panel body-->
    </div>
    </div>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        
        $("#myModal").hide();
    });
function data_api() {
    var tahun = $( "input[name=year]" ).val();
    var bulan =$( "input[name=month]" ).val();
    var kdkppn=$( "input[name=kdkppn]" ).val();
    var token_api=$( "input[name=token_api]" ).val();
        if ( tahun == "" ){
            alert("Tahun belum diisi");
            $( "input[name=year]" ).focus();
        }
        if (bulan == "") {
            alert("Bulan belum diisi");
            $( "input[name=month]" ).focus();

        }
         if ($( "input[name=url]" ).val() == "") {
                alert("Url SPM Online belum diisi. Silahkan hubungi Administrator");              

            } else {
            var data ={ 
                token : token_api,
                kdkppn : kdkppn,
                bulan : bulan ,
                tahun : tahun 
                    };
            var url=$( "input[name=url]" ).val()+"/api/v1/silabi/data/"+kdkppn+"/"+bulan+"/"+tahun;               
                $("#data-api").empty();
                $("#data-api").append("<h6 style='color:red'> fetching Data dari "+url+".....</h6>");
            $.getJSON(url,data,
                function(data, textStatus, jqXHR)
                {
                var hasil=data;
                $("#data-api").empty();
                $("#hasil-data-api").empty();
                if (hasil.error == false) {
                     var index;
                        for (index = 0; index < hasil.jumlah; ++index) {
                            var y = (hasil.data_lpj[index].type_adk == 1 ? "Pengeluaran" : "Penerimaan");
                            var action="<a onclick='show_lpj("+hasil.data_lpj[index].id+","+hasil.data_lpj[index].type_adk+","+hasil.data_lpj[index].kdkppn+",\""+token_api+"\")' class='btn btn-success' ><span class='glyphicon glyphicon-zoom-in' aria-hidden='true'></span> </a>";
                            $("#hasil-data-api").append("<tr>");
                            $("#hasil-data-api").append("<td>"+hasil.data_lpj[index].kdsatker+"</td>");
                            $("#hasil-data-api").append("<td>"+hasil.data_lpj[index].nmfile+"</td>");
                            $("#hasil-data-api").append("<td>"+y+"</td>");
                            $("#hasil-data-api").append("<td>"+action+"</td>");
                            $("#hasil-data-api").append("<tr>");
                        }
                    
                }
                 
                
             }).fail(function(jqXHR, textStatus, errorThrown) 
                    {
                    $("#data-api").empty();
                      alert(textStatus+" : "+errorThrown);
                    });
                
            }
    return false;
    
    
}
               function pad (str, max) {
          str = str.toString();
          return str.length < max ? pad("0" + str, max) : str;
        }
            function numberWithCommas(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }
            function kosong_lpjk() {
                $("#lpjk_kdsatker").empty();
                            $("#lpjk_kddept").empty();
                            $("#lpjk_kdunit").empty();
                            $("#lpjk_kdkabkota").empty();
                            $("#lpjk_karwas").empty();
                            $("#lpjk_kdjendok").empty();
                            $("#lpjk_nodok").empty();
                            $("#lpjk_tgdok").empty();
                            $("#lpjk_kdkppn").empty();
                            $("#lpjk_thang1").empty();
                            $("#lpjk_thang2").empty();                   
                            $("#lpjk_sakhir_bku").empty();
                            $("#lpjk_sawal_bpkas").empty();
                            $("#lpjk_debet_bpkas").empty();
                            $("#lpjk_kredit_bpkas").empty();
                            $("#lpjk_sakhir_bpkas").empty();
                  $("#lpjk_sakhir_bpkas1").empty();
                $("#lpjk_sawal_um").empty();
                            $("#lpjk_debet_um").empty();
                            $("#lpjk_kredit_um").empty();
                            $("#lpjk_sakhir_um").empty();
                  $("#lpjk_sawal_bpp").empty();
                            $("#lpjk_debet_bpp").empty();
                            $("#lpjk_kredit_bpp").empty();
                            $("#lpjk_sakhir_bpp").empty();
                  $("#lpjk_sawal_bpup").empty();
                            $("#lpjk_debet_bpup").empty();
                            $("#lpjk_kredit_bpup").empty();
                            $("#lpjk_sakhir_bpup").empty();
                $("#lpjk_sakhir_bpup1").empty();
                  $("#lpjk_sawal_lsbend").empty();
                            $("#lpjk_debet_lsbend").empty();
                            $("#lpjk_kredit_lsbend").empty();
                            $("#lpjk_sakhir_lsbend").empty();
                  $("#lpjk_sawal_pajak").empty();
                            $("#lpjk_debet_pajak").empty();
                            $("#lpjk_kredit_pajak").empty();
                            $("#lpjk_sakhir_pajak").empty();
                  $("#lpjk_sawal_lain").empty();
                            $("#lpjk_debet_lain").empty();
                            $("#lpjk_kredit_lain").empty();
                            $("#lpjk_sakhir_lain").empty();
                 $("#lpjk_kuitansi_up").empty();
                 $("#lpjk_kuitansi_up1").empty();
                $("#lpjk_brankas").empty();
                $("#lpjk_rekening_bank").empty();
                $("#lpjk_jumlah_kas").empty();
                $("#lpjk_jumlah_kas1").empty();
                $("#lpjk_selisih_kas").empty();
                $("#lpjk_jumlah_up").empty();
                $("#lpjk_saldo_up_uakpa").empty();
                 $("#lpjk_selisih_up").empty();
                 $("#lpjk_ket_selisih_up").empty();
                 $("#lpjk_ket_selisih_kas").empty();
                    $("#lpjk_nm_kpa").empty();
                $("#lpjk_nm_bend").empty();
                $("#lpjk_nip_bend").empty();
                $("#lpjk_nip_kpa").empty();
                $("#lpjk_bulan").empty();
                // untuk data rekening
                 $("#no_count").empty();
                 $("#no_rekening").empty();
                 $("#nm_rekening").empty();
                 $("#nm_bank").empty();
                 $("#kd_rekening").empty();
                 $("#no_surat").empty();
                 $("#tgl_surat").empty();
                 $("#saldo").empty();

            }
    function show_lpj(id,type_adk,kdkppn,token_api) {
        var data ={ token : token_api,
                    kdkppn : pad(kdkppn,3)};
        var url=$( "input[name=url]" ).val()+"/api/v1/silabi/adk/"+id;
          $.getJSON(url,data,
                function(data, textStatus, jqXHR)
                {
              var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
  "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];
                    var hasil=data;
                    kosong_lpjk();
                    show_tab(0);
                if (hasil.error == false) {
                     $("#lpjk_kdsatker").append(hasil.lpj.kdsatker+" "+hasil.lpj.nmsatker);
                    $("#lpjk_kddept").append(hasil.lpj.kddept+" "+hasil.lpj.nmdept);
                    $("#lpjk_kdunit").append(hasil.lpj.kdunit+" "+hasil.lpj.nmunit);
                    $("#lpjk_kdkabkota").append(hasil.lpj.kdlokasi+"."+hasil.lpj.kdkabkota+" "+hasil.lpj.nmlokasi+". "+hasil.lpj.nmkabkota);
                    $("#lpjk_karwas").append(hasil.lpj.nokarwas+"."+hasil.lpj.kddekon);
                    $("#lpjk_kdjendok").append(hasil.lpj.kdjendok);
                    $("#lpjk_nodok").append(hasil.lpj.nodok);
                    $("#lpjk_tgdok").append(hasil.lpj.tgdok);
                    $("#lpjk_kdkppn").append(hasil.lpj.kdkppn+" ("+hasil.lpj.nmkppn+")");
                    $("#lpjk_thang1").append(hasil.lpj.tahun);
                    $("#lpjk_thang2").append(hasil.lpj.tahun);
                    $("#lpjk_sakhir_bku").append("I. Keadaan Pembukuan bulan pelaporan dengan saldo akhir pada BKU sebesar Rp."+numberWithCommas(hasil.lpj.sakhir_bku)+" dan Nomor Bukti terakhir Nomor:"+hasil.lpj.no_bukti);
                    $("#lpjk_sawal_bpkas").append(numberWithCommas(parseInt(hasil.lpj.sawal_bank) + parseInt(hasil.lpj.sawal_tunai)));
                    $("#lpjk_debet_bpkas").append(numberWithCommas(parseInt(hasil.lpj.debet_bank) + parseInt(hasil.lpj.debet_tunai)));
                    $("#lpjk_kredit_bpkas").append(numberWithCommas(parseInt(hasil.lpj.kredit_bank) + parseInt(hasil.lpj.kredit_tunai)));
                    $("#lpjk_sakhir_bpkas").append(numberWithCommas(parseInt(hasil.lpj.sakhir_bank) + parseInt(hasil.lpj.sakhir_tunai)));
                $("#lpjk_sakhir_bpkas1").append(numberWithCommas(parseInt(hasil.lpj.sakhir_bank) + parseInt(hasil.lpj.sakhir_tunai)));
                $("#lpjk_sawal_um").append(numberWithCommas(parseInt(hasil.lpj.sawal_um) ));
                    $("#lpjk_debet_um").append(numberWithCommas(parseInt(hasil.lpj.debet_um)));
                    $("#lpjk_kredit_um").append(numberWithCommas(parseInt(hasil.lpj.kredit_um) ));
                    $("#lpjk_sakhir_um").append(numberWithCommas(parseInt(hasil.lpj.sakhir_um) ));
                 $("#lpjk_sawal_bpp").append(numberWithCommas(parseInt(hasil.lpj.sawal_bpp) ));
                    $("#lpjk_debet_bpp").append(numberWithCommas(parseInt(hasil.lpj.debet_bpp)));
                    $("#lpjk_kredit_bpp").append(numberWithCommas(parseInt(hasil.lpj.kredit_bpp) ));
                    $("#lpjk_sakhir_bpp").append(numberWithCommas(parseInt(hasil.lpj.sakhir_bpp) ));
                 $("#lpjk_sawal_bpup").append(numberWithCommas(parseInt(hasil.lpj.sawal_up) ));
                    $("#lpjk_debet_bpup").append(numberWithCommas(parseInt(hasil.lpj.debet_up)));
                    $("#lpjk_kredit_bpup").append(numberWithCommas(parseInt(hasil.lpj.kredit_up) ));
                    $("#lpjk_sakhir_bpup").append(numberWithCommas(parseInt(hasil.lpj.sakhir_up) ));
                $("#lpjk_sakhir_bpup1").append(numberWithCommas(parseInt(hasil.lpj.sakhir_up) ));
                 $("#lpjk_sawal_lsbend").append(numberWithCommas(parseInt(hasil.lpj.sawal_lsbend) ));
                    $("#lpjk_debet_lsbend").append(numberWithCommas(parseInt(hasil.lpj.debet_lsbend)));
                    $("#lpjk_kredit_lsbend").append(numberWithCommas(parseInt(hasil.lpj.kredit_lsbend) ));
                    $("#lpjk_sakhir_lsbend").append(numberWithCommas(parseInt(hasil.lpj.sakhir_lsbend) ));
                 $("#lpjk_sawal_pajak").append(numberWithCommas(parseInt(hasil.lpj.sawal_pajak) ));
                    $("#lpjk_debet_pajak").append(numberWithCommas(parseInt(hasil.lpj.debet_pajak)));
                    $("#lpjk_kredit_pajak").append(numberWithCommas(parseInt(hasil.lpj.kredit_pajak) ));
                    $("#lpjk_sakhir_pajak").append(numberWithCommas(parseInt(hasil.lpj.sakhir_pajak) ));
                 $("#lpjk_sawal_lain").append(numberWithCommas(parseInt(hasil.lpj.sawal_lain) ));
                    $("#lpjk_debet_lain").append(numberWithCommas(parseInt(hasil.lpj.debet_lain)));
                    $("#lpjk_kredit_lain").append(numberWithCommas(parseInt(hasil.lpj.kredit_lain) ));
                    $("#lpjk_sakhir_lain").append(numberWithCommas(parseInt(hasil.lpj.sakhir_lain) ));
                $("#lpjk_kuitansi_up").append("jumlah pengurangan pada BP UP sudah termasuk kuitansi UP yang belum di-SPM-GU-kan sebesar Rp "+numberWithCommas(hasil.lpj.kuitansi_up));
                  $("#lpjk_kuitansi_up1").append(numberWithCommas(hasil.lpj.kuitansi_up));
                $("#lpjk_brankas").append(numberWithCommas(hasil.lpj.brankas));
        $("#lpjk_rekening_bank").append(numberWithCommas(hasil.lpj.rekening_bank));
        $("#lpjk_jumlah_kas").append(numberWithCommas(parseInt(hasil.lpj.brankas)+parseInt(hasil.lpj.rekening_bank)));
                $("#lpjk_jumlah_kas1").append(numberWithCommas(parseInt(hasil.lpj.brankas)+parseInt(hasil.lpj.rekening_bank)));
                $("#lpjk_selisih_kas").append(numberWithCommas((parseInt(hasil.lpj.sakhir_bank)+parseInt(hasil.lpj.sakhir_tunai))-(parseInt(hasil.lpj.brankas)+parseInt(hasil.lpj.rekening_bank))));
                $("#lpjk_jumlah_up").append(numberWithCommas(parseInt(hasil.lpj.sakhir_up)+parseInt(hasil.lpj.kuitansi_up)));
                $("#lpjk_saldo_up_uakpa").append(numberWithCommas(hasil.lpj.saldo_up_uakpa));
                $("#lpjk_selisih_up").append(numberWithCommas(parseInt(hasil.lpj.saldo_up_uakpa)-(parseInt(hasil.lpj.sakhir_up)+parseInt(hasil.lpj.kuitansi_up))));
         $("#lpjk_ket_selisih_up").append("2. "+hasil.lpj.ket_selisih_up);
         $("#lpjk_ket_selisih_kas").append("1. "+hasil.lpj.ket_selisih_kas);
                  $("#lpjk_nm_kpa").append(hasil.lpj.nm_kpa);
        $("#lpjk_nm_bend").append(hasil.lpj.nm_bend);
        $("#lpjk_nip_bend").append(hasil.lpj.nip_bend);
        $("#lpjk_nip_kpa").append(hasil.lpj.nip_kpa);
                $("#lpjk_bulan").append('Bulan :'+monthNames[parseInt(hasil.lpj.bulan)-1]);
                    // untuk data rekening
                    if (hasil.jumlah_rekening > 0) {
                        var index;
                        for (index = 0; index < hasil.jumlah_rekening; ++index) {
                                
                            $("#no_count").append(parseInt(index+1));
                            $("#no_rekening").append(hasil.rekening[index].no_rekening);
                            $("#nm_rekening").append(hasil.rekening[index].nm_rekening);
                            $("#nm_bank").append(hasil.rekening[index].nm_bank);
                            $("#kd_rekening").append(hasil.rekening[index].kd_rekening);
                            $("#no_surat").append(hasil.rekening[index].no_surat);
                            $("#tgl_surat").append(hasil.rekening[index].tgl_surat);
                            $("#saldo").append(hasil.rekening[index].saldo);
                            }
                         
                    }
                    
                } // akhir if hasil.error
                   
                    $('#myModal').modal('show');
                
                 
                
             }).fail(function(jqXHR, textStatus, errorThrown) 
                    {
                    $("#data-api").empty();
                      alert(textStatus+" : "+errorThrown);
                    });
        
    }
    function show_tab(id) {
       
        if (id == 1) {
            $("#lpj").hide();
            $("#data-rekening").show();
         
        } else {
            $("#lpj").show();
            $("#data-rekening").hide();
        }
    }

</script>
