<?= $this->extend('layout/userDashboard') ?>

<?= $this->section("isi") ?>
<div class="container py-3">
    <div class="text-center">
        <br>
        <h1>Layanan Surat</h1>
    </div>
    <br>
    <div class="row">
        <div class="col">
        </div>
        <div class="col-6">
            <table id="listsurat" class="table-responsive">
                <tr>
                    <thead class="thead-light">
                        <th>Jenis Surat</th>
                        <th>Tujuan</th>
                        <th>keterangan</th>
                        <th>Download</th>
                    </thead>
                </tr>
                <tr>
                    <tbody id="content-tabel">

                    </tbody>
                </tr>
            </table>


        </div>
        <div class="col">
        </div>

    </div>
    <br><br>
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modal-surat">Buat Surat</button>
        </div>
        <div class="col"></div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-surat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-surat">Buat Surat</h5>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col">
                            <form method="post" action="" id="form-surat">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">Nama</label>
                                            <input type="text" class="form-control" name="nama" value="<?= $nama ?>" readonly>

                                        </div>
                                        <div class="col">
                                            <label for="">NIK</label>
                                            <input type="text" class="form-control" name="nik" value="<?= $nik ?>" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label>Kategori Surat</label>
                                            <select name="kategori" class="form-control">
                                                <option value="" selected disabled>Masukan Kategori surat</option>
                                                <?php foreach ($kategori as $item) : ?>
                                                    <option value="<?= $item->kategori; ?>"><?= $item->kategori; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <Label>Keterangan</Label>
                                            <textarea class="form-control" name="keterangan" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <Label>Tujuan</Label>
                                            <input type="text" class="form-control" name="tujuan">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input class="btn btn-success btn-md" type="submit" value="kirim">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close-modal" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section("Script") ?>
<script>
    $(document).ready(function() {


        let tabel = $("#listsurat").DataTable({
            ajax: {
                url: '<?= site_url('User/suratready') ?>',
                dataSrc: 'data'
            },
            columns: [{
                    data: 'kategori'

                }, {
                    data: 'tujuan'
                }, {
                    data: 'keterangan'
                },
                {
                    data: 'download'
                }
            ]
        });
        $('#close-modal').click(function() {
            $('#form-surat')[0].reset();
            $('#modal-surat').modal('hide');
        });

        $('#form-surat').on('submit', function(e) {
            e.preventDefault();
            let data = new FormData(this);
            $.ajax({
                url: '<?= site_url("User/suratinput") ?>',
                type: 'POST',
                data: data,
                success: function(ss) {
                    if (ss == 'true') {
                        swal('Berhasil!', 'Surat Berhasil di Kirim', 'success');
                        $('#form-surat')[0].reset();
                    } else {
                        swal('Gagal!', 'Surat gagal di Kirim', 'warning');
                    }
                },
                error: function(e) {
                    console.log(e);
                    swal('Gagal!', 'err ' + e, 'warning');
                },
                processData: false,
                cache: false,
                contentType: false,
            });

        });

    });
</script>
<?= $this->endSection() ?>