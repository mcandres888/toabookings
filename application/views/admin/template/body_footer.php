<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="<?=base_url()?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="<?=base_url()?>plugins/jQueryUI/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=base_url()?>bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>dist/js/app.min.js"></script>

<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
<!-- Slimscroll -->
<script src="<?=base_url()?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>dist/js/app.min.js"></script>

<script src="<?=base_url()?>plugins/timepicker/bootstrap-timepicker.min.js"></script>

<!--
<script src="<?=base_url()?>dist/js/pages/dashboard.js"></script>
<script src="<?=base_url()?>dist/js/demo.js"></script>
-->

<?php if (isset($subData['data_url'] )) { ?>

<script>
    $.widget.bridge('uibutton', $.ui.button);
$(document).ready(function() {
   $('#tableData')
    .addClass( 'nowrap' )
    .DataTable( {
      "pageLength": 10,
      "paging": true,
      "autoWidth": true,
      "info": true,
      "processing": true,
      "serverSide": true,
      "ordering": false,
      "ajax": "<?=$subData['data_url']?>"
    } );
} );


</script>



<?php } ?>


<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
