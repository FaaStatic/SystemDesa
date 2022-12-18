<?= $this->extend('layout/dashboard') ?>
<?= $this->section('style') ?>
<style>
    .kotak {
        min-height: 100vh;
        width: 100%;
        padding: 30px;
        margin: 10px;
        box-shadow: 2px 2px 20px 2px black;

    }

    .content {
        font-size: 20px;
        font-family: 'impact';
    }

    .create {
        margin-top: 100px;
        margin-left: 75%;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('isi') ?>

<div class="kotak">
    <center>
        <h1><?= $list->judul_berita ?></h1>
    </center>
    <br><br><br>
    <img src="data:image;base64,<?= base64_encode($list->gambar_berita) ?>" width="500px" height="250px" class="img-fluid rounded mx-auto d-block" style="margin-left:50%; border-radius:5px;">
    <br>
    <p class="content">
        <?= $list->isi_berita ?>
    </p>
    <div class="create">
        <p>Dibuat pada : <?= $list->create_berita ?></p>

    </div>


</div>

<?= $this->endSection() ?>

<?= $this->section('Script') ?>
<script>
    $(document).ready(function() {
        $('#corouselid').css('display', 'none');
    });
</script>

<?= $this->endSection() ?>