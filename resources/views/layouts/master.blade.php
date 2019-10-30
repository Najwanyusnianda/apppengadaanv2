<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AppPengadaan</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('vendor/fontawesome/css/all.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/bootstrap-4.3.1/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Open Sans', sans-serif !important;
        }
        .main-sidebar{
            font-size: 0.9rem;
            font-family:Helvetica
         
        }

        .nav-header{
            font-weight: 600;
            color:white;
        }
    </style>
    @yield('addStyle')

    <style>
    </style>
</head>

<body>
    <div class="wrapper">

        <!-- Navbar -->
    @include('layouts._navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
   @include('layouts._sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 198.8px;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">
                                @yield('pageName')
                            </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @yield('breadcrumb')
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                @yield('content')
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright © 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
        <div id="sidebar-overlay"></div>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset('vendor/jquery-3.4.1.min.js')}}"></script>
   <!-- <script src="{{asset('vendor/popper.min.js')}}"></script>-->
    <!-- Bootstrap 4 -->
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="{{asset('vendor/bootstrap-4.3.1/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
<script src="{{asset('vendor/adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('vendor/DataTables/datatables.min.js')}}"></script>
<script src="{{asset('vendor/DataTables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

@yield('addScript')
</body>

</html>
