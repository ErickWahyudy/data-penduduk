<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="keywords" content="wifi kassandra my id, kassandra my id, kassandra wifi, kassandra, kassandra hd production, KASSANDRA, KASSANDRA HD PRODUCTION">
  <meta name="description" content="Layanan hotspot wifi unlimited 24 jam non stop tanpa lemot kecuali saat wifi down">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url('themes/admin/') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('themes/admin/') ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('themes/admin/') ?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('themes/admin/') ?>/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('themes/admin/') ?>/plugins/iCheck/square/blue.css">
  <!-- Favicon -->
  <link href="<?= base_url('themes/admin') ?>/favicon.ico" rel="icon">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- <div class="content">
  <div class="col-md-12">
 <img src="<?= base_url('themes/logo.png') ?>" class="img-responsive">
</div>
</div> -->

<!-- sweetalert -->
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

<body class="hold-transition" background="<?= base_url('themes/admin') ?>/dist/img/bgmember.jpg" style="background-size: cover; background-attachment: fixed;">
<div class="login-box">
   
<?= $this->session->flashdata('pesan') ?>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<center>
				<img src="<?= base_url('themes/admin') ?>/dist/img/penduduk-01.png" width="100%" />
				<h4>
					<b>
						Web Aplikasi Data Penduduk
					</b>
				</h4>
				
			</center>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="email" placeholder="Email / No KK / No HP" required="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password" required="">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="box-footer">
						<button type="submit" class="btn btn-primary btn-block" name="login" title="Masuk Sistem">
							<b>LOGIN</b>
						</button>
          <div class="checkbox icheck">
            <label>
              lupa password? <a href="<?= base_url('reset_password') ?>">klik disini</a>
            </label>
          </div>
        		<center>
							<strong>Copyright &copy; <?php echo date('Y'); ?>
							<a href="https://bit.ly/kassandrahdproduction" target="blank">Kassandra Production</a>.</strong> All rights reserved.
						</center>
					</div>
      </div>
    </form>
   <!--  <a href="#">I forgot my password</a><br> -->
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= base_url('themes/admin/') ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('themes/admin/') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url('themes/admin/') ?>/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
