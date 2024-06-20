        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024-<?=FONK->tarihsaat('Y')?></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?=TEMA?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?=TEMA?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?=TEMA?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=TEMA?>dist/js/adminlte.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?=TEMA?>dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?=TEMA?>dist/js/pages/dashboard2.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?=TEMA?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=TEMA?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=TEMA?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=TEMA?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=TEMA?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=TEMA?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=TEMA?>plugins/jszip/jszip.min.js"></script>
<script src="<?=TEMA?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=TEMA?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=TEMA?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=TEMA?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=TEMA?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- select2 -->
<script src="<?=TEMA?>plugins/select2/js/select2.full.min.js"></script>

<script>
  $(function () {
    $('#myTable').DataTable({
      "responsive": true,
    });
    $('.select2').select2();
  });
  //https://datatables.net/manual/installation
</script>
</body>
</html>