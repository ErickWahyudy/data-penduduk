<?php $this->load->view('template/header'); ?>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahPelanggan"><i class="fa fa-plus"></i>
    Tambah</a>
<a href="https://docs.google.com/spreadsheets/d/1y0-1HHY3ZVqvulj2Hgg42wN-VkUeCjygwx6EJvDQBFM/edit#gid=778747165"
    title="Tambah Data" class="btn btn-success" target="blank">
    <i class="glyphicon glyphicon"></i> DATA GOOGLESHEET</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>No HP</th>
                <th>Paket</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $pelanggan): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $pelanggan['nama'] ?></td>
                <!-- <td><?php if($pelanggan['jk'] == "L"){ echo "Laki-Laki";}else{ echo "Perempuan";} ?></td> -->
                <td><?= $pelanggan['no_hp'] ?></td>
                <!-- <td><img src="<?= base_url('template/data/'.$pelanggan['foto']) ?>" class="img-responsive" style="width: 100px;height: 100xp"></td> -->
                <td><?= $pelanggan['paket'] ?></td>
                <td><?= $pelanggan['status_plg'] ?></td>
                <td>
                    <a href="" class="btn btn-info" data-toggle="modal"
                        data-target="#detail<?= $pelanggan['id_pelanggan'] ?>"><i class="fa fa-eye"></i></a>
                    <a href="<?= base_url('admin/pelanggan/edit/'.$pelanggan['id_pelanggan']) ?>"
                        class="btn btn-warning"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- tabel modal -->
    <?php foreach($data->result_array() as $pelanggan): ?>
    <!-- membuat menu detail data dengan modal -->
    <div class="modal fade" id="detail<?= $pelanggan['id_pelanggan'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Detail <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>ID Pelanggan</td>
                            <td><?= $pelanggan['id_pelanggan'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td><?= $pelanggan['nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?= $pelanggan['alamat'] ?></td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td><?= $pelanggan['no_hp'] ?></td>
                        </tr>
                        <tr>
                            <td>Tgl Daftar</td>
                            <td><?= tgl_indo($pelanggan['terdaftar_mulai']) ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?= $pelanggan['email'] ?></td>
                        </tr>
                        <tr>
                            <td>Paket</td>
                            <td><?= $pelanggan['paket'] ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?= $pelanggan['status_plg'] ?></td>
                        </tr>
                        <tr>
                            <td>Kirim WA</td>
                            <td><a href="https://api.whatsapp.com/send?phone=<?= $pelanggan['no_hp'] ?>&text=
								Berikut kami sampaikan data akun anda yang digunakan di system aplikasi KassandraWiFi%0A
								Nama : <?= $pelanggan['nama'] ?> %0A
								Alamat : <?= $pelanggan['alamat'] ?> %0A
								No HP : <?= $pelanggan['no_hp'] ?> %0A
								Email Login : <?= $pelanggan['email'] ?> %0A%0A
								Jika ada perubahan data silakan lakukan perubahan data melalui link berikut %0A
								https://wifi.kassandra.my.id/login %0A%0A
								_Pesan ini dikirim oleh system aplikasi KassandraWifi._%0A
								-wifi@kassandra.my.id-"
								 target=" _blank" title="Pesan WhatsApp" class="btn btn-success">
									<i class="fa fa-whatsapp"></i> WA</i>
								</a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal detail -->
    <?php endforeach; ?>

    <!-- Modal tambah data pelanggan-->
    <div class="modal fade" id="modalTambahPelanggan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">

                        <form action="<?= base_url('admin/pelanggan/add') ?>" method="post"
                            enctype="multipart/form-data">
                            <tr>
                                <th>Nama</th>
                                <td>
                                    <input type="text" name="nama" class="form-control" placeholder="Nama lengkap"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>
                                    <input type="text" name="alamat" class="form-control" placeholder="Alamat lengkap"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                                <td>
                                    <input type="text" name="no_hp" class="form-control"
                                        placeholder="Penulisan nomor 6281123xxxxxx" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Tgl Daftar</th>
                                <td>
                                    <input type="date" name="terdaftar_mulai" class="form-control" value="<?= date('Y-m-d') ?>"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Paket Data</th>
                                <td>
                                    <select name="id_paket" class="form-control" required="">
                                        <option value="">--Pilih Paket--</option>
                                        <!-- mengambil data dari tb_paket -->
                                        <?php 
                                          $paket = $this->db->get('tb_paket')->result_array();
                                          foreach($paket as $pkt): ?>
                                        <option value="<?= $pkt['id_paket'] ?>">
                                            <?= ucfirst($pkt['id_paket']) ?> |
                                            <?= ucfirst($pkt['paket']) ?> |
                                            <?= ucfirst($pkt['tarif']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>
                                    <input type="email" name="email" class="form-control" placeholder="Email yang aktif"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Password</th>
                                <td>
                                    <input type="password" name="password" value="" class="form-control"
                                        placeholder="bebas yang penting mudah diingat" placeholder="Masukkan passwordmu"
                                        required="">
                                </td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <button class="btn btn-warning" data-dismiss="modal">Kembali</button> &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Submit" class="btn btn-success">
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal tambah data pelanggan -->


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

