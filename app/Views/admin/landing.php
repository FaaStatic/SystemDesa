<?= $this->extend('layout/admin'); ?>
<?= $this->section('isi'); ?>
<div class="container">
    <div class="row mx-auto  py-5">

        <div class="col-sm-3 my-2 mx-4">
            <div class="card bg-primary py-2 mx-2">
                <div class="citizen">
                    <center>
                        <h4>Penduduk Terdaftar</h4>
                    </center>
                    <center>
                        <h3><?= $jumlah; ?></h3>
                    </center>
                </div>


            </div>
        </div>
        <div class="col-sm-3 my-2 mx-4">
            <div class="card bg-secondary py-2 mx-2">
                <div class="news">
                    <center>
                        <h4>Berita TerPost</h4>
                    </center>
                    <center>
                        <h3><?= $jumlah2; ?></h3>
                    </center>
                </div>

            </div>
        </div>
        <div class="col-sm-3 my-2 mx-4">
            <div class="card bg-warning py-2 mx-2">
                <div class="letter">
                    <center>
                        <h4>Jumlah Surat</h4>
                    </center>
                    <center>
                        <h3><?= $jumlah3; ?></h3>
                    </center>

                </div>
            </div>
        </div>

        <div class="col-sm-3 my-2 mx-4">
            <div class="card bg-success py-2 mx-2">
                <div class="report">
                    <center>
                        <h4>Jumlah Laporan Masuk</h4>
                    </center>
                    <center>
                        <h3><?= $jumlah4; ?></h3>
                    </center>
                </div>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('Script'); ?>

<?= $this->endSection(); ?>