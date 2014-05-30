<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.0.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo base_url(); ?>vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>vendor/components/modernizr/modernizr.js"></script>
<script src="<?php echo base_url(); ?>assets/js/main.min.js"></script>
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
<script src="<?php echo base_url(); ?>assets/lib/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/switch/js/bootstrap-switch.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/autosize/jquery.autosize.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/lib/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/datatables/3/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/jquery.tablesorter/jquery.tablesorter.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<!-- cleditor -->
<script src="<?php echo base_url(); ?>assets/lib/bootstrap3-wysihtml5-bower/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/cleditor/jquery.cleditor.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/pagedown-bootstrap/js/jquery.pagedown-bootstrap.combined.min.js"></script>
<script src="<?php echo base_url(); ?>assets/lib/epiceditor/js/epiceditor.min.js"></script>
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
	formWysiwyg();
  });
</script>
<script>
	$(function() {
		var extensions = {
			"sFilter": "dataTables_filter custom_filter_class",
			"sLength": "dataTables_length custom_length_class"
		}
		// Used when bJQueryUI is false
		$.extend($.fn.dataTableExt.oStdClasses, extensions);
		// Used when bJQueryUI is true
		$.extend($.fn.dataTableExt.oJUIClasses, extensions);
		$('#dataTable_wrapper').dataTable();
	});
</script>
<script>
  $(function() {
	metisTable();
	metisSortable();
  });
</script>
<script>
  $(function() {
	formGeneral();
  });
</script>
    
</body>

</html>
