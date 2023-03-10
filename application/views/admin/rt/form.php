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
                <th>No RT</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $rt): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $rt['no_rt'] ?></td>
                <td><?= $rt['nama_rt'] ?></td>
                <td><?= $rt['alamat'] ?></td>
                <td>
                    <?= $rt['no_hp'] ?> &nbsp;
                    <a href="https://api.whatsapp.com/send?phone=<?= $rt['no_hp'] ?>" target="_blank" class="btn btn-success btn-xs"><i
                            class="fa fa-whatsapp"></i></a>
                </td>
                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit<?= $rt['id_rt'] ?>"><i class="fa fa-edit"></i>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal tambah data RT-->
    <div class="modal fade" id="modalTambahRT" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form action="<?= base_url('admin/ketua_rt/add') ?>" method="post"
                            enctype="multipart/form-data">
                            <tr>
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_rt" class="form-control"
                                        placeholder="Nama Ketua RT" required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>No RT</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_rt" class="form-control"
                                        placeholder="No RT" required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="alamat" class="form-control" placeholder="Alamat" required=""></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_hp" class="form-control"
                                        placeholder="No HP" required="" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Password" autocomplete="off">
                                </td>
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

    <!-- Modal edit data rt-->
    <?php foreach($data->result_array() as $rt): ?>
    <div class="modal fade" id="edit<?= $rt['id_rt'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form action="<?= base_url('admin/ketua_rt/edit/'.$rt['id_rt']) ?>" method="post"
                            enctype="multipart/form-data">
                            <tr>
                                <th>Nama Ketua RT</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_rt" value="<?= $rt['nama_rt'] ?>"
                                        class="form-control" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>No RT</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_rt" value="<?= $rt['no_rt'] ?>"
                                        class="form-control" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="alamat" class="form-control" required=""><?= $rt['alamat'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_hp" value="<?= $rt['no_hp'] ?>"
                                        class="form-control" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="password" name="password" class="form-control" value="<?= $rt['password'] ?>"
                                        placeholder="Password" autocomplete="off">
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
                                    &nbsp;&nbsp;
                                    <a href="<?= base_url('admin/ketua_rt/hapus/'.$rt['id_rt']) ?>"
                                        class="btn btn-danger" onclick="return confirm('Yakin Hapus Data Ini ?')"><i
                                            class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal -->


<?php $this->load->view('template/footer'); ?>
