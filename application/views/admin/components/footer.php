<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url(); ?>assets/lib/jquery/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>assets/lib/bootstrap/js/bootstrap.js"></script>
<!--
<script src="<?php echo base_url(); ?>assets/js/main.min.js"></script>
-->
<script src="<?php echo base_url(); ?>assets/js/style-switcher.min.js"></script>
<!-- Screenfull -->
<script src="<?php echo base_url(); ?>assets/lib/screenfull/screenfull.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/jquery.uniform/jquery.uniform.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/inputlimiter/jquery.inputlimiter.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/chosen/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/tagsinput/jquery.tagsinput.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/validVal/js/jquery.validVal.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/moment/moment.min.js"></script>

<!-- dashboard -->
<script src="<?php echo base_url(); ?>assets/lib/jquery.sparkline/jquery.sparkline.min.js"></script>

<script type="text/javascript">
    $(function() {
        /** This code runs when everything has been loaded on the page */
        /* Inline sparklines take their values from the contents of the tag */
        $('.inlinesparkline').sparkline('html', {width: '50px', height: '40px', highlightLineColor: '#f22'}); 
		
        /* Sparklines can also take their values from the first argument 
        passed to the sparkline() function */
        var myvalues = [10,8,5,7,4,4,1];
        $('.dynamicsparkline').sparkline(myvalues);

        /* The second argument gives options such as chart type */
        $('.dynamicbar').sparkline('html', {type: 'bar', negBarColor: 'red', height: '40px'} );
        
        /* The second argument gives options such as chart type */
        $('.piechart').sparkline('html', {type: 'pie', sliceColors: ['#dc3912','#3366cc','#ff9900','#109618','#66aa00','#dd4477','#0099c6','#990099 '], height: '40px'} );

        /* Use 'html' instead of an array of values to pass options 
        to a sparkline with data in the tag */
        $('.inlinebar').sparkline('html', {type: 'bar', barColor: 'red'} );
    });
</script>
<!-- Flot -->
<script src="<?php echo base_url(); ?>assets/lib/flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/flot/jquery.flot.selection.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/flot/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/flot/jquery.flot.time.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/flot/jquery.flot.valuelabels.js"></script>
<script>
$(function () {
	
	<?php 
		// satker wajib LPJ Pengeluaran
		// remove quote in json
		$data1 = json_encode($dataset_wajib_pengeluaran);
		$data1 = str_replace('"','',$data1);
		 
		// jumlah LPJ Pengeluaran
		// remove quote in json
		$data2 = json_encode($dataset_pengeluaran);
		$data2 = str_replace('"','',$data2);
		
		// satker wajib LPJ Penerimaan
		// remove quote in json
		$data3 = json_encode($dataset_wajib_penerimaan);
		$data3 = str_replace('"','',$data3);
		
		// jumlah LPJ Penerimaan
		// remove quote in json
		$data4 = json_encode($dataset_penerimaan);
		$data4 = str_replace('"','',$data4);
		
		// jumlah LPJ Pengeluaran UP
		$data5 = json_encode($dataset_pengeluaran_up);
		$data5 = str_replace('"','',$data5);
		// jumlah LPJ Pengeluaran LS Bendahara
		$data6 = json_encode($dataset_pengeluaran_ls_bendahara);
		$data6 = str_replace('"','',$data6);
		// jumlah LPJ Pengeluaran Pajak
		$data7 = json_encode($dataset_pengeluaran_pajak);
		$data7 = str_replace('"','',$data7);
		// jumlah LPJ Pengeluaran Lain
		$data8 = json_encode($dataset_pengeluaran_lain);
		$data8 = str_replace('"','',$data8);
		// jumlah LPJ Saldo
		$data9 = json_encode($dataset_pengeluaran_saldo);
		$data9 = str_replace('"','',$data9);
		// jumlah LPJ Kuitansi
		$data10 = json_encode($dataset_pengeluaran_kuitansi);
		$data10 = str_replace('"','',$data10);
		// jumlah LPJ Kas Tunai
		$data11 = json_encode($dataset_penerimaan_kas_tunai);
		$data11 = str_replace('"','',$data11);
		// jumlah LPJ Kas Bank
		$data12 = json_encode($dataset_penerimaan_kas_bank);
		$data12 = str_replace('"','',$data12);
		// jumlah LPJ Saldo Awal Penerimaan
		$data13 = json_encode($dataset_penerimaan_saldo_awal);
		$data13 = str_replace('"','',$data13);
		// jumlah LPJ Penerimaan
		$data14 = json_encode($dataset_penerimaan_penerimaan);
		$data14 = str_replace('"','',$data14);
		// jumlah LPJ Penyetoran
		$data15 = json_encode($dataset_penerimaan_penyetoran);
		$data15 = str_replace('"','',$data15);
		
	?>
	// LPJ penerimaan and pengeluaran
	var data1 = <?php echo $data1; ?>;
	var data2 = <?php echo $data2; ?>;
	var data3 = <?php echo $data3; ?>;
	var data4 = <?php echo $data4; ?>;
	// LPJ pengeluaran UP
	var data5 = <?php echo $data5; ?>;
	// LPJ pengeluaran LS Bendahara
	var data6 = <?php echo $data6; ?>;
	// LPJ pengeluaran Pajak
	var data7 = <?php echo $data7; ?>;
	// LPJ pengeluaran lain
	var data8 = <?php echo $data8; ?>;
	// LPJ saldo
	var data9 = <?php echo $data9; ?>;
	// LPJ kuitansi
	var data10 = <?php echo $data10; ?>;
	// LPJ kas tunai
	var data11 = <?php echo $data11; ?>;
	// LPJ kas bank
	var data12 = <?php echo $data12; ?>;
	// LPJ saldo awal
	var data13 = <?php echo $data13; ?>;
	// LPJ penerimaan
	var data14 = <?php echo $data14; ?>;
	// LPJ penerimaan
	var data15 = <?php echo $data15; ?>;
	
	var options = {
		xaxis: { 
			mode: "time",
			timeformat: "%b %Y",
			tickSize: [1, "month"],
			axisLabel: "Bulan",
			axisLabelPadding: 10,
			axisLabelUseCanvas: true
		},
		yaxis: {
			position: "left",
			axisLabel: "Jumlah LPJ",
			axisLabelUseCanvas: true,
			tickFormatter: function numberWithCommas(x) {
                                      return x.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
            }
		},
		grid: {
			hoverable: true
		},
		legend: { position: "nw", backgroundOpacity: 0 }
	};
	
	var dataset_pengeluaran = [
		{
			label: "Jumlah LPJ Pengeluaran",
			data: data2,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "10pt 'Trebuchet MS'",
                  fontcolor: 'orange',
               }
		},
		{
			label: "Jumlah Wajib LPJ Pengeluaran",
			data: data1,
			points: { symbol: "circle", fillColor: "#0062FF", show: true },
			lines: { show: true },
			valueLabels: {
				show: true,
				align: 'start',
				valign: 'below',
				font: "8pt 'Trebuchet MS'",
				fontcolor: 'blue',
				xoffset: 15
			}
		},
	];
	
	// plot pengeluaran
	$.plot($("#placeholder"), dataset_pengeluaran, options);
	
	var dataset_penerimaan = [
		{
			label: "Jumlah LPJ Penerimaan",
			data: data4,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "10pt 'Trebuchet MS'",
                  fontcolor: 'orange',
               }
		},
		{
			label: "Jumlah Wajib LPJ Penerimaan",
			data: data3,
			points: { symbol: "circle", fillColor: "#0062FF", show: true },
			lines: { show: true },
			valueLabels: {
				show: true,
				align: 'start',
				valign: 'below',
				font: "8pt 'Trebuchet MS'",
				fontcolor: 'blue',
				xoffset: 15
			}
		}
	];
	
	// plot penerimaan
	$.plot($("#placeholder-penerimaan"), dataset_penerimaan, options);
	
	// jumlah pengeluaran UP
	var dataset_pengeluaran_up = [
		{
			label: "Uang Persediaan",
			data: data5,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "7pt 'Trebuchet MS'",
                  fontcolor: "#800080",
               },
            color: "#800080"
		}
	];
	
	// plot pengeluaran
	$.plot($("#placeholder-pengeluaran-up"), dataset_pengeluaran_up, options);
	
	// jumlah pengeluaran LS Bendahara
	var dataset_pengeluaran_ls_bendahara = [
		{
			label: "LS Bendahara",
			data: data6,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "7pt 'Trebuchet MS'",
                  fontcolor: "#159915",
               },
            color: "#159915"
		}
	];
	
	// plot LS pengeluaran
	$.plot($("#placeholder-pengeluaran-ls-bendahara"), dataset_pengeluaran_ls_bendahara, options);
	
	// jumlah pengeluaran Pajak
	var dataset_pengeluaran_pajak = [
		{
			label: "Pajak",
			data: data7,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "7pt 'Trebuchet MS'",
                  fontcolor: "#0000FF",
               },
            color: "#0000FF"
		}
	];
	
	// plot pajak
	$.plot($("#placeholder-pengeluaran-pajak"), dataset_pengeluaran_pajak, options);
	
	// jumlah pengeluaran lain
	var dataset_pengeluaran_lain = [
		{
			label: "Pengeluaran Lain",
			data: data8,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "7pt 'Trebuchet MS'",
                  fontcolor: "#FF6300",
               },
            color: "#FF6300"
		}
	];
	
	// plot pengeluaran lain
	$.plot($("#placeholder-pengeluaran-lain"), dataset_pengeluaran_lain, options);
	
	// jumlah pengeluaran saldo
	var dataset_pengeluaran_saldo = [
		{
			label: "Saldo",
			data: data9,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "7pt 'Trebuchet MS'",
                  fontcolor: "#FF007D",
               },
            color: "#FF007D"
		}
	];
	
	// plot pengeluaran saldo
	$.plot($("#placeholder-pengeluaran-saldo"), dataset_pengeluaran_saldo, options);
	
	// jumlah pengeluaran kuitansi
	var dataset_pengeluaran_kuitansi = [
		{
			label: "Kuitansi",
			data: data10,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "7pt 'Trebuchet MS'",
                  fontcolor: "#C16F0C",
               },
            color: "#C16F0C"
		}
	];
	
	// plot pengeluaran kuitansi
	$.plot($("#placeholder-pengeluaran-kuitansi"), dataset_pengeluaran_kuitansi, options);
	
	// jumlah penerimaan kas tunai
	var dataset_penerimaan_kas_tunai = [
		{
			label: "Kas Tunai",
			data: data11,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "7pt 'Trebuchet MS'",
                  fontcolor: "#049204",
               },
            color: "#049204"
		}
	];
	
	// plot penerimaan kas tunai
	$.plot($("#placeholder-penerimaan-kas-tunai"), dataset_penerimaan_kas_tunai, options);
	
	// jumlah penerimaan kas bank
	var dataset_penerimaan_kas_bank = [
		{
			label: "Kas Bank",
			data: data12,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "7pt 'Trebuchet MS'",
                  fontcolor: "#003E7A",
               },
            color: "#003E7A"
		}
	];
	
	// plot penerimaan kas bank
	$.plot($("#placeholder-penerimaan-kas-bank"), dataset_penerimaan_kas_bank, options);
	
	// jumlah penerimaan saldo awal
	var dataset_penerimaan_saldo_awal = [
		{
			label: "Saldo Awal Penerimaan",
			data: data13,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "7pt 'Trebuchet MS'",
                  fontcolor: "#7A0025",
               },
            color: "#7A0025"
		}
	];
	
	// plot penerimaan saldo awal
	$.plot($("#placeholder-penerimaan-saldo-awal"), dataset_penerimaan_saldo_awal, options);
	
	// jumlah penerimaan penerimaan
	var dataset_penerimaan_penerimaan = [
		{
			label: "Penerimaan",
			data: data14,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "7pt 'Trebuchet MS'",
                  fontcolor: "#7A2F00",
               },
            color: "#7A2F00"
		}
	];
	
	// plot penerimaan penerimaan
	$.plot($("#placeholder-penerimaan-penerimaan"), dataset_penerimaan_penerimaan, options);
	
	// jumlah penerimaan penyetoran
	var dataset_penerimaan_penyetoran = [
		{
			label: "Penyetoran",
			data: data15,
			bars: {
					show: true,
					align: "center",
					barWidth: 12 * 24 * 60 * 60 * 1000,
					lineWidth: 1
				},
			valueLabels: {
                  show: true,
                  labelFormatter: function(v)
                  {
                     return (+v).toFixed(1);
                  },
                  valign: 'top',
                  align: 'center',
                  font: "7pt 'Trebuchet MS'",
                  fontcolor: "#C85009",
               },
            color: "#C85009"
		}
	];
	
	// plot penerimaan penerimaan
	$.plot($("#placeholder-penerimaan-penyetoran"), dataset_penerimaan_penyetoran, options);
	
	
	function gd(year, month, day){
		return new Date(year, month - 1).getTime();
	}
	
	function thousandSeparator(number){
		return number.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g,".");
	}
	
	var previousPoint = null, previousLabel = null;
	
	$.fn.UseTooltip = function(){
		$(this).bind("plothover", function(event, pos, item){
			if(item){
				if( (previousLabel != item.series.label) || (previousPoint != item.dataIndex) ){
					previousPoint = item.dataIndex;
					previousLabel = item.series.label;
					$("#tooltip").remove();
					
					console.log(item.datapoint);
					
					var x = item.datapoint[0];
					var y = item.datapoint[1];
					
					var color = item.series.color;
					var date = "Jan " + new Date(x).getDate();
					
					console.log(item);
					
					var unit = "";
					
					if(item.series.label == "Jumlah Wajib LPJ Pengeluaran"){
						unit = "LPJ Wajib";
					} else if (item.series.label == "Jumlah LPJ Pengeluaran"){
						unit = "LPJ Satker";
					}
					
					showTooltip(item.pageX, item.pageY, color, 
								"<strong>" + item.series.label + "</strong><br />" + date +
								" : <strong>" + y + "</strong>" + unit + "");
				}
			} else {
				$("#tooltip").remove();
				previousPoint = null;
			}
		});
	};
	
	function showTooltip(x, y, color, contents){
		$('<div id="tooltip">' + contents + '</div>').css({
			position: 'absolute',
			display: 'none',
			top: y - 40,
			left: x - 120,
			border: '2px solid ' + color,
			padding: '3px',
			'font-size': '9px',
			'border-radius': '5px',
			'background-color': '#fff',
			'font-family': 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
			opacity: 0.9
		}).appendTo("body").fadeIn(200);
	}
	
});
</script>
<script src="<?php echo base_url(); ?>assets/lib/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/switch/js/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/autosize/jquery.autosize.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/lib/datatables/jquery.dataTables.js"></script>
	<script>
		$(function(){
			$('table.display').dataTable();
			$('table.sortfield').dataTable({
                "bJQueryUI": true,
				"aaSorting": [[0,'desc']]
			});
		});
	</script>
<script src="<?php echo base_url(); ?>assets/lib/datatables/3/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/jquery.tablesorter/jquery.tablesorter.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<!-- Metis core scripts -->
<script src="<?php echo base_url(); ?>assets/js/core.min.js"></script>
<!-- Metis demo scripts -->
<script src="<?php echo base_url(); ?>assets/js/app.min.js"></script>
    <script>
		$(function() {
			Metis.formGeneral();
		});
      
		$(function(){
			Metis.MetisChart();
		});
	</script>
<!-- cleditor -->
<script src="<?php echo base_url(); ?>assets/lib/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/pagedown-bootstrap/js/jquery.pagedown-bootstrap.combined.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/epiceditor/js/epiceditor.min.js"></script>
<!-- upload -->
<script src="<?php echo base_url(); ?>assets/lib/plupload/plupload.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/plupload/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/jquery.gritter/js/jquery.gritter.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/jquery.uniform/jquery.uniform.min.js"></script>
<!-- chained-master -->
<script src="<?php echo base_url(); ?>assets/lib/chained-master/jquery.chained.min.js"></script>
<script type="text/javascript">
	$(function(){
		$("#series").chained("#mark");
		$("#child").chained("#parent");
	});
</script>
<script>
      $('.list-inline li > a').click(function() {
        var activeForm = $(this).attr('href') + ' > form';
        //console.log(activeForm);
        $(activeForm).addClass('magictime swap');
        //set timer to 1 seconds, after that, unload the magic animation
        setTimeout(function() {
          $(activeForm).removeClass('magictime swap');
        }, 1000);
      });
</script>
<script>
  $(function() {
	Metis.MetisTable();
	Metis.metisSortable();
  });
</script>
<script>
  $(function() {
	formWysiwyg();
  });
</script>
<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
</script>

</body>

</html>
