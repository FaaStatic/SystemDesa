<?= $this->extend('layout/admin'); ?>
<?= $this->section('isi') ?>
<div class="container px-md-3 py-md-3">
    <br><br>
    <center>
        <h1 class="h1">List Berita</h1>
    </center>
    <br><br>
    <button id="tambahberita" type="button" class="btn btn-primary btn-md rounded-circle">+</button>
    <div class="modal fade" id="modalface" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Berita</h5>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="form-tambah" method="POST" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Slug Berita</label>
                                        <input type="text" name="slug_berita" class="form-control" required>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Judul Berita</label>
                                        <input type="text" name="judul_berita" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Thumbnail</label>
                                        <input type="text" name="thumbnail" class="form-control" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Content Berita</label>
                                        <textarea class="form-control" name="isi_berita" id="contentku"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <Label for="">Gambar </Label>
                                        <input type="file" name="gambar_berita" id="gambar_berita" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="">Preview</label>
                                    <img id="showgambar" src="" class="img-fluid img-thumbnail" style="width:50%;">
                                </div>
                            </div>
                            <div class="row">
                                <center><input type="submit" id='btntambahberita' class="btn btn-primary btn-md" value="tambah"></center>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnclose" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <br><br>
    <table id="tabelberita" width="1055px" class="table-responsive table-stripped">
        <thead class="thead-light">
            <tr>
                <th>Judul</th>
                <th>Content</th>
                <th>Thumbnail</th>
                <th>Gambar</th>
                <th>Slug</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="content-tabel" style="font-weight:normal !important;">
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
<?= $this->section('Script') ?>
<script src="/js/ckeditor/ckeditor.js"></script>
<script>
    $(document).ready(function() {


        CKEDITOR.replace('contentku');

        $('#gambar_berita').bind('change', function() {
            let status = false;
            let file_size = this.files[0].size;
            let name_file = this.files[0].name;
            let ekstensi = name_file.substr((name_file.lastIndexOf('.') + 1));
            switch (ekstensi) {
                case 'jpg':
                    status = true;
                    break;
                case 'jpeg':
                    status = true;
                    break;
                case 'png':
                    status = true;
                    break;
                default:
                    break;
            }

            if (status) {
                if (file_size > 4194304) {
                    swal('Gagal!', 'Size terlalu besar jangan Lebih dari 4Mb', "warning");
                    $('#gambar_berita').val('');
                } else {
                    readURL(this);
                }
            } else {
                swal('Gagal!', 'Format dan File tidak sesuai coba upload File Jpeg/jpg dengan ukuran 4Mb', 'warning');
                $('#gambar_berita').val('');
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showgambar').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        };

        let tabel = $('#tabelberita').DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: '<?= site_url('Admin/getberita') ?>',
                dataSrc: 'data'
            },
            columns: [{
                    data: 'judul_berita'
                },
                {
                    data: 'isi_berita'
                },
                {
                    data: 'thumbnail'
                },
                {
                    data: 'gambar_berita',
                    "render": function(data) {
                        return '<img src="data:image;base64,' + data + '" style="height:50px;width:50px;"/>';
                    }
                },
                {
                    data: 'slug_berita'
                },
                {
                    data: 'create_berita'
                },
                {
                    data: 'aksi'
                },
            ],
            "columnDefs": [{
                "width": "100px",
                "targets": "_all"
            }, ],
            fixedColumns: true,
        });
        let metod;
        $('#tambahberita').on('click', function() {
            metod = 'tambah';
            $('#modalface').modal('show');
        });

        $('#btnclose').on('click', function() {
            $('#form-tambah')[0].reset();
            $('[name="slug_berita"]').removeAttr('readonly');
            $('#modalface').modal('hide');
            $('#showgambar').attr('src', '');
            $('#btntambahberita').val('tambah');
            CKEDITOR.instances.contentku.setData('');
        });

        $('#form-tambah').on('submit', function(e) {
            e.preventDefault();
            let formdata = new FormData(this);
            let url;
            formdata.append('isi_berita', CKEDITOR.instances['contentku'].getData());
            if (metod == 'tambah') {
                url = '<?= site_url('Admin/tambahberita'); ?>';
            } else {
                url = '<?= site_url('Admin/updateberita'); ?>';
            }
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                success: function(respon) {
                    if (respon == 'true') {
                        if (metod == 'tambah') {
                            swal('Berhasil!', 'Data Berhasil Di tambah!', 'success');
                            tabel.ajax.reload();
                            $('#form-tambah')[0].reset();
                            CKEDITOR.instances.contentku.setData('');
                            $('#showgambar').attr('src', '');
                        } else {
                            swal('Berhasil!', 'Data Berhasil Di update!', 'success');
                            tabel.ajax.reload();
                        }
                    }

                    $('#modalface').modal('hide');

                },
                error: function(e) {
                    swal('Gagal!', 'Terjadi eror ' + e, 'warning');
                },
                cache: false,
                contentType: false,
                processData: false

            });
        });

        $('#content-tabel').on('click', '#btn-update', function() {
            metod = 'update';
            $('modal-title').text("Ubah Berita");
            $('')
            $('#form-tambah')[0].reset();
            let kode = $(this).data('id');
            $.ajax({
                url: '<?= site_url('Admin/editberita/') ?>' + kode,
                method: 'GET',
                dataType: 'JSON',
                success: function(e) {
                    console.log(e);
                    $('[name="slug_berita"]').attr('readonly', true);
                    $('[name="judul_berita"]').val(e.judul_berita);
                    $('[name="slug_berita"]').val(e.slug_berita);
                    $("#showgambar").attr('src', 'data:image;base64,' + e.gambar_berita + '');
                    $('[name="isi_berita"]').val(e.isi_berita);
                    CKEDITOR.instances.contentku.setData(e.isi_berita);
                    $('#modalface').modal('show');
                    $('#btntambahberita').val('update');
                },
                error: function(err) {
                    console.log(err);
                },
            });
        });


        $('#content-tabel').on('click', '#btn-hapus', function() {
            let dataku = $(this).data('id');

            swal({
                    title: "Anda Yakin?",
                    text: "Menghapus Data Akan Menghilangkan Data Tersebut!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: '<?= site_url('Admin/hapusberita/') ?>' + dataku,
                            type: 'POST',
                            async: true,
                            dataType: 'json',
                            success: function(e) {
                                if (e == 'true') {
                                    swal('Berhasil!', 'Data Berhasil Di Hapus!', 'success');
                                }
                            },
                            error: function(e) {
                                swal('Gagal!', 'Data Gagal Di Hapus! err' + e, 'warning');
                            }
                        });
                        tabel.ajax.reload();
                    } else {
                        swal("Data Batal Di Hapus!");
                    }
                });




        });




    });
</script>
<?= $this->endSection() ?>