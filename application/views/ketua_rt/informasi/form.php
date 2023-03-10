<?php $this->load->view('template/header'); ?>

<?= $this->session->flashdata('pesan') ?>

<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Informasi</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $informasi): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $informasi['informasi'] ?></td>
                <td>
                    <a href="<?= base_url('template/file_informasi/'.$informasi['berkas']) ?>"
                        target="_blank"><?= $informasi['berkas'] ?></a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

<?php $this->load->view('template/footer'); ?>
<?php $this->load->view('template/akses'); ?>