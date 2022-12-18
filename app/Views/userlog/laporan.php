<?= $this->extend('layout/userdashboard') ?>

<?= $this->section("isi") ?>
<div class="container py-3">
    <div class="text-center">
        <h1>Layanan Laporan</h1>
    </div>
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
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
                            <label>Kategori Laporan</label>
                            <select name="kategori_laporan" class="form-control">
                                <option value="" selected disabled>Masukan Kategori Laporan</option>
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
        <div class="col"></div>

    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section("Script") ?>
<script>
    $(document).ready(function() {
        addlapor();


        function addlapor() {
            $('#form-surat').on('submit', function(e) {
                e.preventDefault();
                let data = new FormData(this);
                $.ajax({
                    url: '<?= site_url("User/laporaninput") ?>',
                    type: 'POST',
                    data: data,
                    success: function(ss) {
                        if (ss == 'true') {
                            swal('Berhasil!', 'Laporan Berhasil di Kirim', 'success');
                            $('#form-surat')[0].reset();
                        } else {
                            swal('Gagal!', 'Laporan gagal di Kirim', 'warning');
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
        }


    });
</script>
<?= $this->endSection() ?>