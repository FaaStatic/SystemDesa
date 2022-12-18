<?= $this->extend('layout/admin'); ?>
<?= $this->section('isi'); ?>
<div class="container px-md-3 py-md-3">


    <!-- isi tab !-->
    <br>
    <center>
        <h1>List Penduduk</h1>
    </center>
    <br>
    <button type="button" class="btn btn-success rounded-circle btn-md" id="btntambahpenduduk">+</button>
    <br>
    <br><br>
    <div class="modal  fade" id="modalface" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Penduduk</h5>


                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="form-tambah" method="POST" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for='nik'>NIK</label><input type="text" size="50" id='nik' name="nik" class="form-control" placeholder="Masukan NIK" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for='nokk'>NO KK</label><input type="text" size="50" name="nokk" class="form-control" id="nokk" placeholder="Masukan Nomor Kartu Keluarga" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for='nama'>Nama</label><input type="text" size="50" id="nama" name="nama" class="form-control" placeholder="Masukan Nama" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for='tempat_lahir'>Tempat Lahir</label><input type="text" size="50" name="tempat_lahir" id="tempat_lahir" class="form-control" placeholder="Tempat Lahir" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for='tgl_lahir'>Tanggal Lahir</label><input type="date" id="tgl_lahir" size="50" name="tgl_lahir" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="jenis">Jenis Kelamin</label>
                                        <select class="form-control" name="jenis" id="jenis" required>
                                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <select class="form-control" name="agama" id="agama" required>
                                            <option value="" disabled selected>Pilih Agama</option>
                                            <option value='Islam'>Islam</option>
                                            <option value='Protestan'>Protestan</option>
                                            <option value='Katolik'>Katolik</option>
                                            <option value='Hindu'>Hindu</option>
                                            <option value='Budha'>Budha</option>
                                            <option value='Konghuchu'>Konghuchu</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <textarea class="form-control" name='alamat' id="alamat" rows="5" placeholder="Alamat Domisili" required></textarea>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="kelurahan">Kelurahan</label>
                                        <input type='text' class="form-control" name='kelurahan' id="kelurahan" placeholder="Kelurahan" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kecamatan">Kecamatan</label>
                                        <input type='text' class="form-control" name='kecamatan' id="kecamatan" placeholder="Kecamatan" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kab">Kabupaten</label>
                                        <input type='text' class="form-control" name='kab' id="kab" placeholder="Kabupaten" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="prov">Provinsi</label>
                                        <input type='text' class="form-control" name='prov' id="prov" placeholder="Provinsi" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pekerjaan">pekerjaan</label>
                                        <select class="form-control" name='pekerjaan' id="pekerjaan" required>
                                            <option value="" disabled selected>Pilih Perkejaan</option>
                                            <option value="PNS">PNS</option>
                                            <option value="TNI/POLRI">TNI/POLRI</option>
                                            <option value="Buruh">Buruh</option>
                                            <option value="Wiraswasta">Wiraswasta</option>
                                            <option value="Programmer">Programmer</option>
                                            <option value="Guru">Guru</option>
                                            <option value="Petani">Petani</option>
                                            <option value="Peternak">Peternak</option>
                                            <option value="Pengusaha">Pengusaha</option>
                                            <option value="Pedagang">Pedagang</option>
                                            <option value="Pelajar">Pelajar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="kewarganegaraan">Kewarganegaraan</label>
                                        <select class="form-control" name='kewarganegaraan' id="kewarganegaraan" required>
                                            <option value="" disabled selected>Pilih Kewarganegaraan</option>
                                            <option value="WNI">WNI</option>
                                            <option value="WNA">WNA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name='status' required>
                                            <option value="" disabled selected>Status Anda</option>
                                            <option value="belum menikah">Belum Menikah</option>
                                            <option value="menikah">Menikah</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="pendidikan">Pendidikan</label>
                                        <select class="form-control" id="pendidikan" name='pendidikan' required>
                                            <option value="" disabled selected>Pendidikan Terakhir</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                            <option value="Tidak Sekolah">Tidak Sekolah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="">Foto Diri</label>
                                    <input type="file" class="custom-file-input" name="foto_diri" id="foto_diri" required>
                                </div>

                                <div class="col">
                                    <label for=""></label>
                                    <img id="prevgambar" src="" class="img-fluid img-thumbnail" style="width:50%;">
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input id="btntambahpend" class="btn btn-primary btn-sm" type="submit" value="submit">
                                    </div>
                                </div>
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

    <table id="tabelpenduduk" class="table-responsive table-stripped">
        <thead class="thead-light">
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Pekerjaan</th>
                <th>Status</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id="content-tabel" style="font-weight:normal !important;">
        </tbody>
    </table>

</div>

<?= $this->endSection(); ?>
<?= $this->section('Script') ?>
<script>
    $(document).ready(function() {



        $('#foto_diri').bind('change', function() {
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
                default:
                    break;
            }

            if (status) {
                if (file_size > 65536) {
                    swal('Gagal!', 'Size terlalu besar jangan Lebih dari 64Kb', "warning");
                    $('#foto_diri').val('');
                } else {
                    readURL(this);
                }
            } else {
                swal('Gagal!', 'Format dan File tidak sesuai coba upload File Jpeg/jpg dengan ukuran 64kb', 'warning');
                $('#foto_diri').val('');
            }
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#prevgambar').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        };


        let tabel = $('#tabelpenduduk').DataTable({
            "processing": true,
            "serverSide": true,
            ajax: {
                url: '<?= site_url('Admin/getpenduduk') ?>',
                dataSrc: 'data'
            },
            columns: [{
                    data: 'nik'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'tempat_lahir'
                },
                {
                    data: 'tgl_lahir'
                },
                {
                    data: 'jenis'
                },
                {
                    data: 'pekerjaan'
                },
                {
                    data: 'status'
                },
                {
                    data: 'foto',
                    "render": function(data) {
                        return '<img src="data:image;base64,' + data + '" style="height:50px;width:50px;"/>';
                    }
                },
                {
                    data: 'aksi'
                },
            ]
        });
        let metode;
        $('#btntambahpenduduk').on('click', function() {
            metode = 'tambah';
            $('#modalface').modal('show');
        });

        $('#btnclose').on('click', function() {
            $('#form-tambah')[0].reset();
            $('[name="nik"]').removeAttr('readonly');
            $('[name="nokk"]').removeAttr('readonly');
            $('#modalface').modal('hide');
            $('#prevgambar').attr('src', '');
            $('#btntambahpend').val('tambah');
        });

        $('#content-tabel').on('click', '#btn-update', function() {
            $('.modal-title').text('Ubah Penduduk');
            metode = 'update';
            $('#form-tambah')[0].reset();

            $.ajax({
                url: "<?= site_url('Admin/editpenduduk/') ?>" + $(this).data('id'),
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    console.log(data);
                    $('[name="nik"]').attr('readonly', true);
                    $('[name="nokk"]').attr('readonly', true);
                    $('[name="foto_diri"]').removeAttr('required');
                    $('[name="nik"]').val(data.nik);
                    $('[name="nokk"]').val(data.nokk);
                    $('[name="nama"]').val(data.nama);
                    $('[name="tempat_lahir"]').val(data.tempat_lahir);
                    $('[name="tgl_lahir"]').val(data.tgl_lahir);
                    $('[name="jenis"]').val(data.jenis);
                    $('[name="agama"]').val(data.agama);
                    $('[name="alamat"]').val(data.alamat);
                    $('[name="kelurahan"]').val(data.kelurahan);
                    $('[name="kecamatan"]').val(data.kecamatan);
                    $('[name="kab"]').val(data.kab);
                    $('[name="prov"]').val(data.prov);
                    $('[name="pekerjaan"]').val(data.pekerjaan);
                    $('[name="kewarganegaraan"]').val(data.kewarganegaraan);
                    $('[name="status"]').val(data.status);
                    $('[name="pendidikan"]').val(data.pendidikan);
                    $('#prevgambar').attr('src', 'data:image;base64,' + data.foto_diri + '');
                    $('#modalface').modal('show');
                    $('#btntambahpend').val('update');


                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal('ERROR', jqXHR, 'warning')
                }
            });

        });



        $('#form-tambah').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            let url;
            if (metode == 'tambah') {
                url = '<?= site_url('Admin/tambahpenduduk') ?>';
            } else {
                url = '<?= site_url('Admin/updatependuduk') ?>';
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    if (response == 'true') {
                        if (metode == 'tambah') {
                            swal("Berhasil!", 'Data Berhasil Di tambah', "success");
                            tabel.ajax.reload();
                        } else {
                            swal("Berhasil!", 'Data Berhasil Di Ubah', "success");
                            tabel.ajax.reload();
                        }
                    }
                    $('#modalface').modal('hide');

                    $('#form-tambah')[0].reset();
                },
                error: function(data) {
                    swal("Gagal!", 'data Gagal Di tambah', "warning");
                    console.log(e);
                },
                cache: false,
                contentType: false,
                processData: false
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
                            url: '<?= site_url('Admin/hapuspenduduk/') ?>' + dataku,
                            type: 'POST',
                            async: true,
                            dataType: 'json',
                            success: function(e) {
                                if (e == 'true') {
                                    swal('Berhasil!', 'Data Berhasil Di Hapus!', 'success');
                                }
                            },
                            error: function(e) {
                                console.log(e);
                                swal('Gagal!', 'Data Gagal Di Hapus! err' + e, 'warning');
                            }
                        });
                        tabel.ajax.reload();
                    } else {
                        swal("Data Batal Di Hapus!");
                    }
                });


        });

        setInterval(function() {
            tabel.ajax.reload(null, false); // user paging is not reset on reload
        }, 30000);




    });
</script>
<?= $this->endSection(); ?>