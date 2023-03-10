<?php $this->load->view('template/header'); ?>

<?php
 if($this->session->userdata('level') == "Administrator" ){

  $kode_tahun = date('Y');
 ?>
<div class="container"><?= $this->session->flashdata('pesan'); ?></div>

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $count_rt;?></h3>

              <p>Data RT</p>
            </div>
            <div class="icon">
              <i class="fa fa-send"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $count_kk;?></h3>

              <p>Data Kepala Keluarga</p>
            </div>
            <div class="icon">
             <i class="fa fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $count_kk_laki;?> </h3>
              <p>Data Anggota KK Laki-laki</p>
            </div>
            <div class="icon">
             <i class="fa fa-male"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $count_kk_perempuan;?> </h3>
              <p>Data Anggota KK Perempuan</p>
            </div>
            <div class="icon">
             <i class="fa fa-female"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?= $count_anggota;?> </h3>

              <p>Data Jumlah KK Laki-laki Dan Perempuan</p>
            </div>
            <div class="icon">
             <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>




<?php 
} 

?>

<?php $this->load->view('template/footer'); ?>