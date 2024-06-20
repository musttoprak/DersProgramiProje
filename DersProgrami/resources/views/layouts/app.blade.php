<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet"
          href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('tema/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
          href="{{ asset('tema/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('tema/AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet"
          href="{{ asset('tema/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('tema/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('tema/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('tema/AdminLTE-3.2.0/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('tema/AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- sweetalert2 -->
    <script src="{{ asset('tema/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('tema/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<!-- Navbar -->


<div class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Anasayfa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <!-- Nav items based on user role -->
                @if(session()->has('kullanici_yetkiId') && session('kullanici_yetkiId') == 1)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            Admin Menü
                        </a>
                        <div class="dropdown-menu" aria-labelledby="adminDropdown">
                            <a class="dropdown-item" href="/admin/kullanicilar">Kullanıcılar</a>
                            <a class="dropdown-item" href="/admin/birimler">Birimler</a>
                            <a class="dropdown-item" href="/admin/bolumler">Bölümler</a>
                            <a class="dropdown-item" href="/admin/dersler">Dersler</a>
                            <a class="dropdown-item" href="/admin/siniflar">Sınıflar</a>
                        </div>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="/home/dersProgramiOlustur">Ders Programı Oluşturma</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Ders Programı Görüntüleme</a>
                </li>
            </ul>
            <!-- User information and logout -->
            <ul class="navbar-nav ml-auto">
                @if(session()->has('kullanici_ad_soyad'))
                    <li class="nav-item">
                        <span class="navbar-text mr-3">Hoş geldiniz, {{ session('kullanici_ad_soyad') }}</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout">
                            <i class="fas fa-sign-out-alt"></i> Çıkış Yap
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @yield('content')
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
    <strong>Copyright &copy; 2024-</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('tema/AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('tema/AdminLTE-3.2.0/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('tema/AdminLTE-3.2.0/dist/js/pages/dashboard2.js') }}"></script>

<!-- DataTables  & Plugins -->
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- select2 -->
<script src="{{ asset('tema/AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js') }}"></script>


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
