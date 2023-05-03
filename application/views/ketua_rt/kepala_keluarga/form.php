<?php $this->load->view('template/header'); ?>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahRT"><i class="fa fa-plus"></i>
    Tambah</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>

<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Kepala Keluarga</th>
                <th>No KK</th>
                <th>RT / Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $kk): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $kk['nama_kk'] ?></td>
                <td><?= $kk['no_kk'] ?></td>
                <td>RT <?= $kk['no_rt'] ?> / <?= $kk['alamat'] ?></td>
                <td>
                    <?= $kk['no_hp'] ?>
                    <?php if($kk['uuid'] == null): ?>
                    <?php else: ?>
                    <a href="https://api.whatsapp.com/send?phone=62<?= $kk['no_hp'] ?>/&text=Assalamualaikum%20Sdr/i%20<?= $kk['nama_kk'] ?>%20kami%20dari%20ketua%20RT%20<?= $kk['no_rt'] ?>%20<?= $kk['alamat'] ?>%20mohon%20bantuannya%20untuk%20melakukan%20pembaruan%20data%20KK%20anda%20di%20sistem%20pendataan%20RT%20<?= $kk['no_rt'] ?>%20<?= $kk['alamat'] ?>,%20terima%20kasih%20atas%20perhatiannya.%0Auntuk%20pembaruan%20data%20KK%20anda%20silahkan%20klik%20link%20berikut%20<?= base_url('penduduk/kepala_keluarga/detail/'.$kk['uuid']) ?>"
                        class="btn btn-success" target="_blank"><i class="fa fa-whatsapp"></i></a>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url('ketua_rt/kepala_keluarga/detail/'.$kk['id_kk']) ?>"
                        class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="<?= base_url('ketua_rt/kepala_keluarga/generate_token/'.$kk['id_kk']) ?>"
                        class="btn btn-warning" title="Refresh Token"><i class="fa fa-refresh"></i></a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>
</div>

    <!-- Modal tambah data KK-->
    <div class="modal fade" id="modalTambahRT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg_green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                    <p style="color: red;">Yang bertanda * wajib diisi</p>
                        <form action="<?= base_url('ketua_rt/kepala_keluarga/add') ?>" method="post"
                            enctype="multipart/form-data">
                            <tr>
                                <th>No KK *</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_kk" class="form-control" required placeholder="No KK" pattern="[0-9]+">
                                </td>
                            </tr>
                            <tr>
                                <th>Nama *</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="nama_kk" class="form-control" required placeholder="Nama" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td><input type="number" name="no_hp" class="form-control" placeholder="No HP" pattern="[0-9]+" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <th>Alamat *</th>
                            </tr>
                            <tr>
                                <td><input name="alamat" class="form-control" required placeholder="Alamat"></td>
                            </tr>
                           <tr>
                                <th>Password *</th>
                           </tr>
                            <tr>
                                  <td><input type="password" name="password" class="form-control" required placeholder="Password" autocomplete="off"></td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Submit" class="btn btn-success">
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/akses'); ?>
