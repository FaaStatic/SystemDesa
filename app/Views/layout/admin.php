<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/custom.css">
    <link rel="stylesheet" type="text/css" href="/css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <link rel="icon" href="/assets/favicon-admin.ico">
    <title><?= $titel ?></title>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light navwarna">
        <a href="javascript:void(0)" id="trigger">
            <span></span>
            <span></span>
            <span></span>
        </a>
        <div class="navbar-brand">
            <img src="/assets/adminlogo.png" class="img img-thumbnail rounded-circle" width="50px" height="50px">
            <a class="font-weight-bolder text-monospace text-decoration-none " href="<?= site_url('Admin/mainPage'); ?>">Admin Desa</a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="ml-auto">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <div class="ml-auto">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="/assets/leter.png" class="img-fluid" width="30px">
                                <span class="badge"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="wrapper">
        <div id="sidebar" class="sidebar py-3">
            <ul class="navbar-nav">
                <li class="navbar-item">
                    <div class=" container border-bottom-0 py-3 text-center">
                        <?php echo '<img src="data:image;base64,' . base64_encode($foto) . '" width="100" height="100" class=" img rounded-circle border " >
    <ul class="list-inline mx-5">'; ?>
                <li class="navbar-item">
                    <h4 class="navbar-brand"><?= $pengguna; ?></h4>
                </li>
                <li class="list-inline-item">
                    <div id="poweron"><a href="<?= site_url('Admin/logout'); ?>"><img src="/assets/standby.png" width="20" height="20"></div></a>

                </li>
                <li class="list-inline-item">


                    <div id="gear"><a href="#"><img src="/assets/setting2.png" width="20" height="20"></div>
                </li>
            </ul>
        </div>
        </li>
        <aside>
            <a href="#submenu1" id="menuutama" data-toggle="collapse" aria-expanded="false" class="warna list-group-item list-group-item-action flex-column align-items-start ">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-dashboard fa-fw mr-3"></span>
                    <span class="menu-collapsed ">Dashboard</span>
                    <span class="submenu-icon ml-auto" id="gbr"><img src="/assets/triangle.png" width="10px"></span>
                </div>
            </a>
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="<?= site_url('Admin/penduduk'); ?>" class="list-group-item list-group-item-action warna text-dark">
                    <span class="menu-collapsed">Data Penduduk</span>
                </a>
                <a href="<?= site_url('Admin/indexBerita') ?>" class="list-group-item list-group-item-action warna text-dark">
                    <span class="menu-collapsed">Berita</span>
                </a>
                <a href="<?= site_url('Admin/indexsurat') ?>" class="list-group-item list-group-item-action warna text-dark">
                    <span class="menu-collapsed">Permohonan Surat</span>
                </a>
                <a href="<?= site_url('Admin/laporanindex') ?>" class="list-group-item list-group-item-action warna text-dark">
                    <span class="menu-collapsed">Laporan</span>
                </a>
            </div>
            <a href="#submenu2" id="menuutama2" data-toggle="collapse" aria-expanded="false" class="warna list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-dashboard fa-fw mr-3"></span>
                    <span class="menu-collapse">About</span>
                    <span class="submenu-icon ml-auto" id="gbr2"><img src="/assets/triangle.png" width="10px"></span>
                </div>
            </a>
            <div id='submenu2' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action warna text-dark">
                    <span class="menu-collapsed">Portofolio</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action warna text-dark">
                    <span class="menu-collapsed">Versi</span>
                </a>
            </div>
        </aside>
    </div>
    <div class="modal fade" id="modal-setting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Setting</h5>
                </div>
                <div class="modal-body">
                    <form id="form-change" action="" method="post">
                        <div class="form-group">
                            <label for="">Masukan Password Baru</label>
                            <input type="password" class="form-control" name="newpass">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-md btn-success" value="update">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="close-setting" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <?= $this->renderSection('isi'); ?>



    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script type="text/javascript" src="/js/datatables.min.js"></script>
    <script type="text/javascript" src="/js/sweetalert.min.js"></script>
    <script src="/js/custom.js"></script>
    <script>
        $(document).ready(function() {
            $('#menuutama').on('click', function() {
                $('#gbr img').toggleClass('active');
            });
            $('#menuutama2').on('click', function() {
                $('#gbr2 img').toggleClass('active');
            });
            let count = 0;
            suratNotif();
            laporNotif();

            $('#navbarDropdownMenuLink').mouseenter(function() {
                $(this).toggleClass('active');
            });

            $('#navbarDropdownMenuLink').mouseleave(function() {
                $(this).toggleClass('active');
            });



            function suratNotif() {
                $.ajax({
                    url: '<?= site_url('Admin/statusnotif') ?>',
                    type: 'GET',
                    dataType: "JSON",
                    async: false,
                    success: function(data) {
                        console.log(data);

                        for (let i = 0; i < data.data.length; i++) {
                            count += 1;

                            $('.badge').html(count);


                            let htmlku = '<div id="content-pesan"><span id="exitnotif" class="text-right"><button class="btn btn-danger btn-sm rounded-circle">X</button></span><div class="row"><div class="col-4"><h5> Pengirim:</h5> </div><span id="statuspesan">' + data.data[i].pengirim + '</span><div class="col-4"></div></div><div class="row"><div class="col-4"><h5>Kategori:</h5></div><span id="kat">' + data.data[i].kategori + '</span><div class="col-4"></div></div></div>';
                            $('.dropdown-menu').append(htmlku);

                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        swal('ERROR', jqXHR, 'warning')
                    },

                });
            }

            function laporNotif() {
                $.ajax({
                    url: '<?= site_url('Admin/statuslapornotif') ?>',
                    type: 'GET',
                    dataType: "JSON",
                    async: false,
                    success: function(data) {
                        console.log(data);

                        for (let i = 0; i < data.data.length; i++) {
                            count += 1;

                            $('.badge').html(count);

                            let htmlku = '<div id="content-pesan"><span id="exitnotif" class="text-right"><button class="btn btn-danger btn-sm rounded-circle">X</button></span><div class="row"><div class="col-4"><h5> Pelapor:</h5> </div><span id="statuspesan">' + data.data[i].pengirim + '</span><div class="col-4"></div></div><div class="row"><div class="col-4"><h5>Kategori:</h5></div><span id="kat">' + data.data[i].kategori_lapor + '</span><div class="col-4"></div></div></div>';
                            $('.dropdown-menu').append(htmlku);


                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        swal('ERROR', jqXHR, 'warning')
                    },

                });
            }

            let button = document.querySelectorAll('#exitnotif');
            let kotak = document.querySelectorAll('#content-pesan');
            let badges = document.querySelector('.badge');

            for (let i = 0; i < button.length; i++) {
                button[i].addEventListener('click', function() {
                    if (count > 0) {
                        count -= 1;
                        badges.innerHTML = count;
                        kotak[i].style.display = "none";
                        if (count === 0) {
                            badges.style.display = "none";
                        }
                    }
                });

            }

        });


        $("#form-change").on("submit", function(e) {
            e.preventDefault();
            let form_data = new FormData(this);
            $.ajax({
                url: "<?= site_url('Admin/updatepassword') ?>",
                type: "POST",
                data: form_data,
                success: function(data) {
                    console.log(data);
                    if (data === "true") {
                        swal("Berhasil!", "Password Berhasil Diganti", "success");
                        $("#modal-setting").modal("hide");
                        $("#form-change")[0].reset();
                    }
                },
                error: function(err) {
                    console.log(err);
                    swal("ERROR!", err, "warning");
                },
                cache: false,
                contentType: false,
                processData: false,
            });
        });
    </script>
    <?= $this->renderSection('Script'); ?>
</body>

</html>