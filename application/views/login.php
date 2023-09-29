<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="keywords" content="wifi kassandra my id, kassandra my id, kassandra wifi, kassandra, kassandra hd production, KASSANDRA, KASSANDRA HD PRODUCTION">
  <meta name="description" content="Pendataan penduduk dan keluarga guna mempermudah dalam proses pelayanan administrasi dengan menggunakan teknologi informasi">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 4.5.2 -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Favicon -->
  <link href="<?= base_url('themes/kassandra-wifi') ?>/img/favicon.ico" rel="icon">

  <!-- sweetalert -->
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
  <style>
  .bottom-left {
    position: fixed;
    bottom: 20px;
    left: 20px;
    color: #ffffff;
    font-family: 'Segoe UI', sans-serif;
    font-size: 36px; /* Sesuaikan ukuran sesuai kebutuhan Anda */
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
  }

  .clock {
    font-weight: bold;
  }

  .date {
    font-weight: normal;
    font-size: 24px; /* Sesuaikan ukuran sesuai kebutuhan Anda */
  }
  </style>
</head>
<body style="background: url('<?= base_url('themes/admin/dist/img/windows11.jpg') ?>') no-repeat center center fixed; background-size: cover;">
<div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                    <img src="<?= base_url('themes/admin') ?>/dist/img/penduduk-01.png" width="100%" />
                        <h5 class="card-title">
                          <b>
                          Web Aplikasi Data Penduduk
                          </b>
                        </h5>
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan') ?>
                        <form action="" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                <input type="text" class="form-control" name="email" placeholder="Nama / Email / No HP" required="">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                  </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required="">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                  </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                            <div class="form-group mt-2">
                                <a href="<?= base_url('reset_password') ?>">Lupa password?</a> <br>
                                Cari data penduduk? <a href="<?= base_url('cari_penduduk') ?>">klik disini</a>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                      <p>
                        <strong>Copyright &copy; <?php echo date('Y'); ?>
                        <a href="https://bit.ly/kassandrahdproduction" target="_blank">Kassandra Production</a>.</strong> All rights reserved.
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Menambah jam dan tanggal di pojok kiri bawah seperti Windows 11 -->
    <div class="bottom-left">
        <div id="clock" class="clock"></div>
        <div id="date" class="date"></div>
    </div>
    <script>
    //jam dan tanggal
    function updateTime() {
    const now = new Date();
    const clockElement = document.getElementById("clock");
    const dateElement = document.getElementById("date");

    const options = { weekday: "long", year: "numeric", month: "long", day: "numeric" };
    const formattedDate = now.toLocaleDateString("id-ID", options);
    const timeString = now.toLocaleTimeString("id-ID", { hour: "2-digit", minute: "2-digit" });

    clockElement.textContent = timeString;
    dateElement.textContent = formattedDate;
    }

    // Memanggil updateTime setiap detik
    setInterval(updateTime, 1000);

    // Memanggil updateTime untuk pertama kali
    updateTime();
    </script>

    <!-- Tautan ke file JavaScript Bootstrap 4 (jika diperlukan) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>