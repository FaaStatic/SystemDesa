<?= $this->extend('layout/admin') ?>
<?= $this->section('isi'); ?>
<div class="container py-3">
    <center>
        <h1>Daftar Laporan</h1>
    </center>
    <br><br><br><br><br><br>
    <div class="row">
        <div class="col">
        </div>
        <div class="col-6">
            <table id='tabel-laporan' class="table-responsive">
                <thead>
                    <tr>
                        <th>Pelapor</th>
                        <th>Kategori Laporan</th>
                        <th>tujuan</th>
                        <th>keterangan</th>
                    </tr>
                </thead>
                <tr>
                    <tbody id="konten-laporan">

                    </tbody>
                </tr>
            </table>
        </div>
        <div class="col">
        </div>
    </div>

</div>
<?= $this->endSection(); ?>
<?= $this->section('Script'); ?>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        let lapor = $('#tabel-laporan').DataTable({
            "processing": true,
            "serverSide": true,
            dom: 'Bfrtip',
            buttons: [
                'pdf'
            ],
            ajax: {
                url: '<?= site_url('Admin/listlaporan') ?>',
                dataSrc: 'data'
            },
            columns: [{
                    data: 'pelapor'
                }, {
                    data: 'kategori'
                },
                {
                    data: 'tujuan'
                }, {
                    data: 'keterangan'
                },
            ],
            fixedColumns: true,

        });
    });
</script>
<?= $this->endSection(); ?>