<?= $this->extend('layout/admin'); ?>
<?= $this->section('isi'); ?>
<div class="container mt-3 py-5">

    <center>
        <h1>List Surat</h1>
    </center>
    <br><br>
    <center>
        <h3>Butuh Persetujuan</h3>
    </center>
    <div class="d-table-row">
        <div class="d-table-cell">
            <table class=" table-responsive display nowrap" id='tabel-notif' width="1055px">

                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Tujuan</th>
                        <th>Aksi Persetujuan</th>
                        <th>Cetak</th>
                    </tr>
                </thead>

                <tbody id='konten'>
                </tbody>
            </table>
        </div>
    </div>
    <br><br><br><br>
    <center>
        <h3>Diterima</h3>
    </center>
    <div class="d-table-row">
        <div class="d-table-cell">
            <table class="table-responsive " id='tabel-terima' width="1055px">

                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Tujuan</th>
                        <th>Status</th>
                        <th>upload</th>
                    </tr>
                </thead>


                <tbody id='konten-terima'>
                </tbody>
            </table>
        </div>
    </div>
    <br><br><br><br>
    <center>
        <h3>Ditolak</h3>
    </center>
    <div class="d-table-row">
        <div class="d-table-cell">
            <table class="table-responsive " id='tabel-tolak'>

                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Tujuan</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id='konten-tolak'>
                </tbody>
            </table>
        </div>
    </div>


</div>

<div class="modal" id="modalUpload">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Upload File</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form id="form-data" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="idupload" value="">
                        <label>Upload file</label>
                        <input type="file" name="uploadsurat" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-md btn-success" value="upload">
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
            </div>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('Script'); ?>
<script>
    $(document).ready(function() {


        let notif = $('#tabel-notif').DataTable({
            "scrollX": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url: '<?= site_url('Admin/listsurat') ?>',
                dataSrc: 'data',

            },
            columns: [{
                    data: 'nik'
                }, {
                    data: 'nama'
                },
                {
                    data: 'kategori'
                }, {
                    data: 'keterangan'
                }, {
                    data: 'tujuan'
                },
                {
                    data: 'aksi'
                }, {
                    data: 'cetak'
                },
            ],
            fixedColumns: true,

        });
        let terima = $('#tabel-terima').DataTable({
            "scrollX": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url: '<?= site_url('Admin/listsuratterima') ?>',
                dataSrc: 'data'
            },
            columns: [{
                    data: 'nik'
                }, {
                    data: 'nama'
                },
                {
                    data: 'kategori'
                }, {
                    data: 'keterangan'
                }, {
                    data: 'tujuan'
                },
                {
                    data: 'status_surat'
                }, {
                    data: 'upload'
                },
            ],
            fixedColumns: true,

        });

        let tolak = $('#tabel-tolak').DataTable({
            "scrollX": true,
            "processing": true,
            "serverSide": true,
            ajax: {
                url: '<?= site_url('Admin/listsurattolak') ?>',
                dataSrc: 'data'
            },
            columns: [{
                    data: 'nik'
                }, {
                    data: 'nama'
                },
                {
                    data: 'kategori'
                }, {
                    data: 'keterangan'
                }, {
                    data: 'tujuan'
                },
                {
                    data: 'status'
                },
            ],
            fixedColumns: true,

        });



        $('#konten').on('click', '#setuju', function() {
            let id = $(this).data('id');
            $.ajax({
                url: '<?= site_url('Admin/suratditerima/') ?>' + id,
                type: 'POST',
                async: true,
                dataType: 'json',
                success: function(e) {
                    notif.ajax.reload();
                    terima.ajax.reload();
                },
                error: function(e) {
                    console.log(e);
                    swal('Gagal!', 'err' + e, 'warning');
                }
            });
        });


        $('#konten').on('click', '#tolakan', function() {
            let id = $(this).data('id');
            $.ajax({
                url: '<?= site_url('Admin/suratditolak/') ?>' + id,
                type: 'POST',
                async: true,
                dataType: 'json',
                success: function(e) {
                    notif.ajax.reload();
                    tolak.ajax.reload();
                },
                error: function(e) {
                    console.log(e);
                    swal('Gagal!', 'err' + e, 'warning');
                }
            });
        });
        $('#konten-terima').on('click', '#uploadfile', function() {
            let id = $(this).data('id');
            $.ajax({
                url: '<?= site_url('Admin/cekupload') ?>' + id,
                type: 'get',
                dataType: 'JSON',
                success: function(data) {
                    if (data === 'true') {
                        $('#modalUpload').modal('show');
                        $('[name=idupload]').val(id);
                    } else {
                        swal('Anda Telah Upload', '', 'warning');
                    }
                },
            });

        });


        $('#form-data').on('submit', function(e) {
            e.preventDefault();
            let formdata = new FormData(this);
            $.ajax({
                url: '<?= site_url('Admin/uploddata') ?>',
                type: 'post',
                data: formdata,
                success: function(data) {
                    if (data === 'true') {
                        swal("SUKSES!", "", "success");
                    }
                },
                error: function(e) {
                    console.log(e);
                },
                cache: false,
                contentType: false,
                processData: false
            });
        });







    });
</script>
<?= $this->endSection(); ?>