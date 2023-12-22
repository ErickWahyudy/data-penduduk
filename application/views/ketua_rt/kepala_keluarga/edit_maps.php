<?php $this->load->view('template/header'); ?>

<table class="table table-reposive">
    <form id="edit_map" method="post">
        <input type="hidden" name="id_kk" value="<?= $id_kk ?>" class="form-control" readonly>
        <tr>
            <th class="col-md-3">Nama Kepala Keluarga</th>
            <td>
                <input type="text" name="nama_kk" class="form-control" value="<?= $nama_kk ?>" readonly>
            </td>
        </tr>
        <tr>
            <div id="googleMap" style="width:100%;height:380px;"></div>
            <input type="hidden" id="lat" name="latitude" value="">
            <input type="hidden" id="lng" name="longitude" value="">
        </tr>
        <tr>
            <td></td>
            <th>
                <a href="<?= base_url('ketua_rt/kepala_keluarga/detail/'.$id_kk) ?>" class="btn btn-warning">Batal</a>
                <input type="submit" name="kirim" value="Simpan" class="btn btn-success">
            </th>
        </tr>
    </form>
</table>

<script>
// variabel global marker
var marker;

function taruhMarker(peta, posisiTitik) {

    if (marker) {
        // pindahkan marker
        marker.setPosition(posisiTitik);
    } else {
        // buat marker baru
        marker = new google.maps.Marker({
            position: posisiTitik,
            map: peta,
            icon: '<?= base_url('themes/marker.png') ?>',
        });
    }

    // isi nilai koordinat ke form
    document.getElementById("lat").value = posisiTitik.lat();
    document.getElementById("lng").value = posisiTitik.lng();

}

function initialize() {
    var propertiPeta = {
        center: new google.maps.LatLng(-7.95273788368736, 111.42980425660366),
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

    // even listner ketika peta diklik
    google.maps.event.addListener(peta, 'click', function(event) {
        taruhMarker(this, event.latLng);
    });

}


// event jendela di-load  
google.maps.event.addDomListener(window, 'load', initialize);

//edit map
$(document).on('submit', '#edit_map', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('ketua_rt/kepala_keluarga/api_edit_maps/') ?>" + form_data.get('id_kk'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit_map' + form_data.get('id_kk'));
                swal({
                    title: "Berhasil",
                    text: "Data Berhasil Diubah",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE",
                }).then(function() {
                    location.href = "<?= site_url('ketua_rt/kepala_keluarga/detail/') ?>" + form_data.get('id_kk');
                });
            },
            error: function(data) {
                swal({
                    title: "Gagal",
                    text: "Data Gagal Diubah",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE",
                });
            }
        });
    });
</script>

<?php $this->load->view('template/footer'); ?>