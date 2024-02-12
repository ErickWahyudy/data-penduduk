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
  <!-- jQuery 3 -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 
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
                        <?= $this->session->flashdata('pesan') ?>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url('operator/role/masuk') ?>" method="post">
                            <div class="form-group">
                                <div class="input-group">
                                    <select name="id_rt" class="form-control" required>
                                        <option value="">--Pilih Ketua RT--</option>
                                        <?php foreach($data as $rt): ?>
                                        <option value="<?= $rt['id_rt'] ?>"> RT
                                            <?= ucfirst($rt['no_rt']) ?> |
                                            <?= ucfirst($rt['nama_rt']) ?> |
                                            <?= ucfirst($rt['alamat']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                   <br>
                                   <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                                    
                                </div>
                            </div>                            
                        </form>
                    </div>
                  </div>
                    <div class="text-center">
                        <a href="javascript:void(0)" onclick="keluar()" class="btn btn-warning btn-md"><i class="fa fa-sign-out"></i>Keluar</a>
                    </div><br>
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
    <script>
    //ajax keluar dari halaman admin
    function keluar() {
        swal({
            title: "Keluar Dari Halaman <?php echo $this->session->userdata('level'); ?> ?",
            text: "Anda Akan Keluar Dari Halaman <?php echo $this->session->userdata('level'); ?> ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3CB371",
            confirmButtonText: "Ya, Keluar!",
            cancelButtonText: "Tidak, Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
        }).then(function(result) {
            if (result.value) { // Only delete the data if the user clicked on the confirm button
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('keluar') ?>",
                    dataType: "json",
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Anda Telah Keluar Dari Halaman <?php echo $this->session->userdata('level'); ?>",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "Anda Gagal Keluar Dari Halaman <?php echo $this->session->userdata('level'); ?>",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                });
            } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                swal("Batal Keluar", "Anda Batal Keluar Dari Halaman <?php echo $this->session->userdata('level'); ?>", "error");
            }
        });
    }
    </script>
</body>
</html>