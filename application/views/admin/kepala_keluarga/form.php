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
                <td>RT <?= $kk['no_rt'] ?> / <?= $kk['alamat'] ?></td>
                <td>
                    <?= $kk['no_hp'] ?>
                    <a href="https://api.whatsapp.com/send?phone=62<?= $kk['no_hp'] ?>/&text=Assalamualaikum%20Sdr/i%20<?= $kk['nama_kk'] ?>%20kami%20dari%20ketua%20RT%20<?= $kk['no_rt'] ?>%20<?= $kk['alamat'] ?>%20mohon%20bantuannya%20untuk%20melakukan%20pembaruan%20data%20KK%20anda%20di%20sistem%20pendataan%20RT%20<?= $kk['no_rt'] ?>%20<?= $kk['alamat'] ?>,%20terima%20kasih%20atas%20perhatiannya.%0Auntuk%20pembaruan%20data%20KK%20anda%20silahkan%20klik%20link%20berikut%20<?= base_url('penduduk/kepala_keluarga/detail/'.$kk['uuid']) ?>"
                        class="btn btn-success" target="_blank"><i class="fa fa-whatsapp"></i></a>
                </td>
                <td>
                    <a href="<?= base_url('admin/kepala_keluarga/detail/'.$kk['id_kk']) ?>" title="Detail Data KK"
                        class="btn btn-info"><i class="fa fa-eye"></i></a>
                    <a href="<?= base_url('admin/kepala_keluarga/generate_token/'.$kk['id_kk']) ?>"
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
                <div class="modal-header bg-green">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form action="<?= base_url('admin/kepala_keluarga/add') ?>" method="post"
                            enctype="multipart/form-data">
                            <tr>
                                <th>No KK</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_kk" class="form-control" required placeholder="No KK" pattern="[0-9]+" maxlength="16" minlength="16" title="No KK harus 16 digit">
                                </td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                            </tr>
                            <tr>
                                <td><input type="number" name="nik_ktp" class="form-control" required placeholder="NIK" pattern="[0-9]+" maxlength="16" minlength="16" title="NIK harus 16 digit"></td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td><input type="text" name="nama_kk" class="form-control" required placeholder="Nama Lengkap" pattern="[A-Za-z ]+" title="Nama harus berupa huruf"></td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                            </tr>
                            <tr>
                                <td><input type="date" name="tgl_lahir" class="form-control" value="<?= date('Y-m-d') ?>" required></td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td><input type="number" name="no_hp" class="form-control" required placeholder="No HP" pattern="[0-9]+"></td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                            </tr>
                            <tr>
                                <td><textarea name="alamat" class="form-control" required placeholder="Alamat"></textarea></td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Agama</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="agama" class="form-control" required>
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Konghucu">Konghucu</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Pendidikan</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="pendidikan" class="form-control" required>
                                        <option value="">-- Pilih Pendidikan --</option>
                                        <option value="Tidak Sekolah">Tidak Sekolah</option>
                                        <option value="SD">SD</option>
                                        <option value="SMP">SMP</option>
                                        <option value="SMA">SMA</option>
                                        <option value="D1">D1</option>
                                        <option value="D2">D2</option>
                                        <option value="D3">D3</option>
                                        <option value="D4">D4</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="pekerjaan" class="form-control" required>
                                        <option value="">-- Pilih Pekerjaan --</option>
                                        <option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
                                        <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                                        <option value="Mengurus Rumah Tangga">Mengurus Rumah Tangga</option>
                                        <option value="Pensiunan">Pensiunan</option>
                                        <option value="Pegawai Negeri Sipil">Pegawai Negeri Sipil</option>
                                        <option value="Tentara Nasional Indonesia">Tentara Nasional Indonesia</option>
                                        <option value="Kepolisian RI">Kepolisian RI</option>
                                        <option value="Perdagangan">Perdagangan</option>
                                        <option value="Petani/Pekebun">Petani/Pekebun</option>
                                        <option value="Peternak">Peternak</option>
                                        <option value="Nelayan/Perikanan">Nelayan/Perikanan</option>
                                        <option value="Industri">Industri</option>
                                        <option value="Konstruksi">Konstruksi</option>
                                        <option value="Transportasi">Transportasi</option>
                                        <option value="Karyawan Swasta">Karyawan Swasta</option>
                                        <option value="Karyawan BUMN">Karyawan BUMN</option>
                                        <option value="Karyawan BUMD">Karyawan BUMD</option>
                                        <option value="Karyawan Honorer">Karyawan Honorer</option>
                                        <option value="Buruh Harian Lepas">Buruh Harian Lepas</option>
                                        <option value="Buruh Tani/Perkebunan">Buruh Tani/Perkebunan</option>
                                        <option value="Buruh Nelayan/Perikanan">Buruh Nelayan/Perikanan</option>
                                        <option value="Buruh Peternakan">Buruh Peternakan</option>
                                        <option value="Pembantu Rumah Tangga">Pembantu Rumah Tangga</option>
                                        <option value="Tukang Cukur">Tukang Cukur</option>
                                        <option value="Tukang Listrik">Tukang Listrik</option>
                                        <option value="Tukang Batu">Tukang Batu</option>
                                        <option value="Tukang Kayu">Tukang Kayu</option>
                                        <option value="Tukang Sol Sepatu">Tukang Sol Sepatu</option>
                                        <option value="Tukang Las/Pandai Besi">Tukang Las/Pandai Besi</option>
                                        <option value="Tukang Jahit">Tukang Jahit</option>
                                        <option value="Tukang Gigi">Tukang Gigi</option>
                                        <option value="Penata Rambut">Penata Rambut</option>
                                        <option value="Penata Rias">Penata Rias</option>
                                        <option value="Penata Busana">Penata Busana</option>
                                        <option value="Mekanik">Mekanik</option>
                                        <option value="Seniman">Seniman</option>
                                        <option value="Tabib">Tabib</option>
                                        <option value="Paraji">Paraji</option>
                                        <option value="Perancang Busana">Perancang Busana</option>
                                        <option value="Penterjemah">Penterjemah</option>
                                        <option value="Imam Masjid">Imam Masjid</option>
                                        <option value="Pendeta">Pendeta</option>
                                        <option value="Pastur">Pastur</option>
                                        <option value="Wartawan">Wartawan</option>
                                        <option value="Ustadz/Mubaligh">Ustadz/Mubaligh</option>
                                        <option value="Juru Masak">Juru Masak</option>
                                        <option value="Promotor Acara">Promotor Acara</option>
                                        <option value="Anggota DPR-RI">Anggota DPR-RI</option>
                                        <option value="Anggota DPD">Anggota DPD</option>
                                        <option value="Anggota BPK">Anggota BPK</option>
                                        <option value="Presiden">Presiden</option>
                                        <option value="Wakil Presiden">Wakil Presiden</option>
                                        <option value="Anggota Mahkamah Konstitusi">Anggota Mahkamah Konstitusi</option>
                                        <option value="Anggota Kabinet/Kementerian">Anggota Kabinet/Kementerian</option>
                                        <option value="Duta Besar">Duta Besar</option>
                                        <option value="Gubernur">Gubernur</option>
                                        <option value="Wakil Gubernur">Wakil Gubernur</option>
                                        <option value="Bupati">Bupati</option>
                                        <option value="Wakil Bupati">Wakil Bupati</option>
                                        <option value="Walikota">Walikota</option>
                                        <option value="Wakil Walikota">Wakil Walikota</option>
                                        <option value="Anggota DPRD Propinsi">Anggota DPRD Propinsi</option>
                                        <option value="Anggota DPRD Kabupaten/Kota">Anggota DPRD Kabupaten/Kota</option>
                                        <option value="Dosen">Dosen</option>
                                        <option value="Guru">Guru</option>
                                        <option value="Pilot">Pilot</option>
                                        <option value="Pengacara">Pengacara</option>
                                        <option value="Notaris">Notaris</option>
                                        <option value="Arsitek">Arsitek</option>
                                        <option value="Akuntan">Akuntan</option>
                                        <option value="Konsultan">Konsultan</option>
                                        <option value="Dokter">Dokter</option>
                                        <option value="Bidan">Bidan</option>
                                        <option value="Perawat">Perawat</option>
                                        <option value="Apoteker">Apoteker</option>
                                        <option value="Psikiater/Psikolog">Psikiater/Psikolog</option>
                                        <option value="Penyiar Televisi">Penyiar Televisi</option>
                                        <option value="Penyiar Radio">Penyiar Radio</option>
                                        <option value="Pelaut">Pelaut</option>
                                        <option value="Peneliti">Peneliti</option>
                                        <option value="Sopir">Sopir</option>
                                        <option value="Pialang">Pialang</option>
                                        <option value="Paranormal">Paranormal</option>
                                        <option value="Pedagang">Pedagang</option>
                                        <option value="Perangkat Desa">Perangkat Desa</option>
                                        <option value="Kepala Desa">Kepala Desa</option>
                                        <option value="Biarawati">Biarawati</option>
                                        <option value="Wiraswasta">Wiraswasta</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </td>
                            </tr>
                           <tr>
                                <td>Password</td>
                           </tr>
                            <tr>
                                  <td><input type="password" name="password" class="form-control" required></td>
                            </tr>
                            <tr>
                                <td>Ketua RT</td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="id_rt" class="form-control" required>
                                        <option value="">--Pilih Ketua RT--</option>
                                        <?php 
                                          $rt = $this->db->get('tb_rt')->result_array();
                                          foreach($rt as $pkt): ?>
                                        <option value="<?= $pkt['id_rt'] ?>"> RT
                                            <?= ucfirst($pkt['no_rt']) ?> |
                                            <?= ucfirst($pkt['nama_rt']) ?> |
                                            <?= ucfirst($pkt['alamat']) ?>
                                        </option>
                                        <?php endforeach; ?>

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

<?php $this->load->view('template/footer'); ?>
