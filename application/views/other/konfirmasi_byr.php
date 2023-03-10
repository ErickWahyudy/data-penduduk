<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $judul ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="keywords" content="wifi kassandra my id, kassandra my id, kassandra wifi, kassandra, kassandra hd production, KASSANDRA, KASSANDRA HD PRODUCTION">
    <meta name="description" content="Layanan hotspot wifi unlimited 24 jam non stop tanpa lemot kecuali saat wifi down">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet"
        href="<?= base_url('themes/admin') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="<?= base_url('themes/admin') ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet"
        href="<?= base_url('themes/admin') ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <!-- <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css"> -->
    <!-- Daterange picker -->
    <!-- <link rel="stylesheet" href="<?= base_url('themes/admin') ?>/bower_components/bootstrap-daterangepicker/daterangepicker.css"> -->
    <!-- bootstrap wysihtml5 - text editor -->
    <script src="<?= base_url('themes/admin') ?>/bower_components/jquery/jquery-1.11.2.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif] -->

    <!-- sweetalert -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('themes') ?>/favicon.ico" type="image/x-icon">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{
            width: 100% !important;
            height: auto;
        }
        #preview_bayar{
	    display:none;
		}
    </style>
</head>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="../../login"onclick="return(confirm('Anda harus login untuk mengakses fitur-fitur dalam aplikasi KassandraWiFi'))" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <marquee>
                        <b>KASSANDRA WIFI</b>
                    </marquee>
                </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url('themes/admin') ?>/dist/user.png" class="user-image" width="20%" alt="User Image">
                                <span class="hidden-xs"><?= $nama ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?= base_url('themes/admin') ?>/dist/user.png" class="img-circle" width="20%" alt="User Image"> <br>
                                    <p>
                                        <?= $nama ?> <br>
                                        <span class="label label-warning">
                                            <small>
                                                <span>Pelanggan</span>
                                            </small>
                                        </span>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                    <a href="../../login"onclick="return(confirm('Anda harus login untuk mengakses fitur-fitur dalam aplikasi KassandraWiFi'))"
                                            class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                    <a href="../../login" class="btn btn-default btn-flat">Login</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <!-- <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li> -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <br /><br />
                    </div>
                    <img src="<?= base_url('themes/admin') ?>/dist/user.png" class="img-circle" width="20%" alt="User Image">
                    <span class="pull-left info"><?= $nama ?> <br><br>
                        <small class="label label-warning">
                            <span>Pelanggan</span>
                        </small>
                    </span>
                </div>

                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>

                    <li class="">
                        <a href="../../login"onclick="return(confirm('Anda harus login untuk mengakses fitur-fitur dalam aplikasi KassandraWiFi'))">
                            <i class="fa fa-dashboard"></i> <span>Dasboard</span>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-green">Home</small>
                            </span>
                        </a>
                    </li>
                    <li class="header">OLAH DATA</li>
                    <li class="treeview">
                    <li><a href="../../login"onclick="return(confirm('Anda harus login untuk mengakses fitur-fitur dalam aplikasi KassandraWiFi'))"><i class="fa fa-user"></i>Data Profile</a></li>
                    <li><a href="../../login"onclick="return(confirm('Anda harus login untuk mengakses fitur-fitur dalam aplikasi KassandraWiFi'))"><i class="fa fa-dollar"></i>Data Tagihan</a>
                    </li>
                    <li><a href="../../login"onclick="return(confirm('Anda harus login untuk mengakses fitur-fitur dalam aplikasi KassandraWiFi'))"><i class="fa fa-money"></i>Data Tagihan Lain</a></li>
                    </li>

                    <li class="header">OTHER</li>
                    <li><a href="../../login"onclick="return(confirm('Anda harus login untuk mengakses fitur-fitur dalam aplikasi KassandraWiFi'))"><i class="fa fa-info-circle"></i> <span>Informasi</span></a></li>
                    <li class="header">END MAIN NAVIGATION</li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard |
                    <small><?= $judul ?></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li>Dashboard</li>
                    <li class="active"><?= $judul ?></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-success">
                            <div class="box-header with-border">

                            <?= $this->session->flashdata('pesan') ?>
<?php $stt = $status  ?>
 <?php if($stt == 'BL'){ ?>                           
               <b style="font-size: 14pt">Konfirmasi Pembayaran</b>
               </table>
               <table id="" class="table table-striped" border="0" cellspacing="0" style="width: 100%">
               <form action="" method="post" enctype="multipart/form-data">
                             <tr>
                             <th class="col-sm-2">Detail Tagihan</th>
                             <td>
                               :
                             </td>
                             </tr>
               
               
                           <tr>
                             <th class="col-sm-2">ID Pelanggan</th>
                             <td>
                               : <input type="text" name="nama" value="<?= htmlentities($nama) ?>" hidden><?= $nama ?>
                             </td>
                           </tr>
               
               
                           <tr>
                             <th class="col-sm-2">Total Biaya</th>
                             <td>
                               : <?= rupiah($tagihan); ?>
                             </td>
                           </tr>		
                                       
                                       <tr>
                                           <th>Upload Bukti</th>
                                           <td>
                                               
                                                   <input type="file" class="form-control" style="background-color: white;" id="bukti_bayar" name="bukti_bayar" placeholder="bukti_bayar" autocomplete="off" onchange="previewBAYAR()" required>
                                               <img id="preview_bayar" alt="image preview" width="50%" />
                                                   <button type="submit" name="kirim" class="btn btn-primary btn-sm" style="margin-top: 10px">Konfirmasi</button>
                                               </form>
                                       </tr>                           
                           </table>
<?php }elseif($stt == 'LS'){ ?>
    <h2>Anda Sudah Melakukan Pembayaran</h2>
<?php } ?>
               
               <!-- /.box-body -->
                     </div>
               <script>
                   //preview gambar
                   function previewBAYAR() {
                   document.getElementById("preview_bayar").style.display = "block";
                   var oFReader = new FileReader();
                   oFReader.readAsDataURL(document.getElementById("bukti_bayar").files[0]);
                 
                   oFReader.onload = function(oFREvent) {
                   document.getElementById("preview_bayar").src = oFREvent.target.result;
                   };
                   
                 };
               </script>


<!-- footer -->
<?php $this->load->view('template/footer'); ?>

<?php 

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}

//format tanggal indonesia
function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
  
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

?>