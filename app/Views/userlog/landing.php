<?= $this->extend('layout/userDashboard') ?>

<?= $this->section("isi") ?>
<div class="container">
    <div class="text-center py-2">
        <h1>Selamat Datang Sistem Informasi Penduduk</h1>
    </div>
    <div class="pesan-pengguna" role="alert">
        <p>Sistem Informasi Penduduk melayani Permintaan Surat dan Menerima Laporan dari penduduk,di sistem ini penduduk dapat merequest Pemerintahan desa berdasarkan kategori yang di jelaskan,dan memberi notifikasi bahwa surat di terima,di sistem ini penduduk juga dapat melaporkan mengenai keadaan lingkungan desa berdasarkan kategori yang disediakan dan laporan tersebut akan menjadi pertimbangan untuk kemajuan desa selanjutnya dan bilaman laporan megandung hal kriminal maka akan hal tersebut akan segera di tindak lanjut oleh pemerintahan desa.terima kasih telah membaca ini,silhakan nikmati layanan sederhana kami! mohon gunakan sebijak mungkin! </p>
    </div>

    <div class="row py-4">
        <div class="col align-content-start ">
            <a href="<?= site_url('User/layanansurat') ?>">
                <div class="mintasurat text-center">
                    <h1>Layanan Surat</h1>
                </div>
            </a>
        </div>
        <div class="col  align-content-start ">
            <a href="<?= site_url('User/layananlaporan') ?>">
                <div class="lapor text-center">
                    <h1>Layanan Laporan</h1>
                </div>
            </a>
        </div>
        <div class="col  align-content-start ">
            <a href="<?= site_url('User/cetakbio') ?>">
                <div class="cetak text-center">
                    <h1>Cetak Biodata</h1>
                </div>
            </a>
        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section("Script") ?>

<?= $this->endSection() ?>