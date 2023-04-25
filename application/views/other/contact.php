<?php $this->load->view('other/header') ?>

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown mb-3">Contact</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
                <h1 class="display-6 mb-4">If You Have Any Query, Please Feel Free Contact Us</h1>
            </div>
            <div class="row g-0 justify-content-center">
                <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.5s">
                    <p class="text-center mb-4">The contact form is currently inactive. Get a functional and working
                        contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code
                        and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                    <form action="javascript:chat();" method="post">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="name@example.com" autocomplete="off" required>
                                    <label for="nama">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="No HP / WA" value="62" autocomplete="off" required>
                                    <label for="no_hp">Nomor HP / WA</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                                    <label for="alamat">Alamat</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea type="text" style="height: 100pt;" class="form-control" id="pesan" name="pesan" placeholder="Tuliskan pesan kamu" required></textarea>
                                    <label for="lapor">Tuliskan Pesan Kamu</label>
                                </div>
                            </div>    
                            <div class="col-12 text-center">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Kirim pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
    <div id="confirm" class="modal fade" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-sm">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-body text-center">
                <p></p>
              <p style="font-size: 16px">Pesan Anda berhasil terkirim, silahkan klik OK untuk melanjutkan.</p>
              <p style="font-size: 14px"><a href="login"><button class="btn btn-success beli">OK</button></a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url('themes/kassandra-wifi') ?>/js/bootstrapiklan.min.js"></script>
  <script src="<?= base_url('themes/kassandra-wifi') ?>/js/chat.js"></script>
  <script src="<?= base_url('themes/kassandra-wifi') ?>/js/jqueryiklan.min.js"></script>


     <!-- Google Map Start -->
     <div class="container-xxl pt-5 px-0 wow fadeIn" data-wow-delay="0.1s">
        <iframe class="w-100 mb-n2" style="height: 450px;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d252881.1514391924!2d111.52941495!3d-7.9712315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e790b859cfee851%3A0x3027a76e352bea0!2sKabupaten%20Ponorogo%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1669501949328!5m2!1sid!2sid"
            frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <!-- Google Map End -->

<?php $this->load->view('other/footer') ?>