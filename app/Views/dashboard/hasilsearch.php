<?= $this->extend('layout/dashboard') ?>

<?= $this->section('style') ?>
<style>
    #artikel {
        margin-bottom: 5px;
        margin-left: 2%;

    }

    .keterangan {
        overflow: hidden;
        height: 50px;
    }

    .pageran {
        margin-left: 50%;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>

<?php foreach ($data as $value) : ?>
    <div class="row">
        <div class="col">

            <div class="card" id="artikel" style="min-width: 125vh; height:200px; ">
                <div class="card-body">

                    <center>
                        <h4 class="card-title"><?= $value->judul_berita ?></h4><br>
                    </center>
                    <img src="data:image;base64,<?= base64_encode($value->gambar_berita) ?>" width="100px" height="100px" class="img-fluid img-thumbnail" style="float: left; margin-right:5px; border-radius:5px;">
                    <div class="keterangan">
                        <p class="card-text" style="margin: 5px;"><?= $value->thumbnail ?></p>

                    </div>
                    <a href="<?= site_url('Client/artikel/' . $value->slug_berita . '') ?>" style="margin-left: 5px;">Selengkapnya..</a>

                </div>
            </div>

        </div>
    </div>

<?php endforeach; ?>


<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<script>
    $(document).ready(function() {
        $('#corouselid').css('display', 'none');
    });
</script>
<?= $this->endSection() ?>