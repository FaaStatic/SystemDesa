<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="icon" href="/assets/favicon-login.ico">
    <title>
        <?= $titel ?>
    </title>
    <style>
        @keyframes fade {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes zoomout {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }


        #Form {
            width: 400px;
            min-height: 50vh;
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            padding: 2px;
            margin-right: -50%;
            transform: translate(-50%, -50%);
            background-color: #eeeeee;
            animation: zoomout 1000ms ease-in-out;
            transition: all 1ms ease-in-out;
        }


        #loggbr {
            margin: 0;
            left: 50%;
        }


        #Form:hover {
            box-shadow: 5px 5px 50px 5px #e0dede;
            transition: all 500ms ease-in-out;
        }

        body {
            background-image: url('/assets/bglogu.jpg');
            background-size: cover;
            animation: fade 0.1s ease-in-out;
            transition: all 0.1s ease-in-out;
        }

        #facebook {
            cursor: pointer;
        }

        #facebook:hover {
            box-shadow: 2px 2px 10px 2px gray;
        }

        #google:hover {
            box-shadow: 2px 2px 10px 2px gray;
        }

        #google {
            cursor: pointer;

        }

        .home {
            margin-right: 0;
            margin-bottom: 0;
            margin-top: 20px;
            margin-left: 20px;
            animation: fade 1ms ease-in-out;
            transition: all 1ms ease-in-out;
        }
    </style>
</head>

<body>
    <div class="home">
        <a href="<?= site_url('client/index') ?>" class="btn btn-warning btn-md">Kembali</a>
    </div>
    <div class="container py-5 mx-auto ">


        <div class="d-flex p-2">
            <div class="align-self-center">
                <div class="card py-3 px-3 " id="Form">
                    <center><img src="/assets/userlog.png" id="loggbr" class="img-fluid " width="100px"></center>
                    <center>
                        <h1>Penduduk Login</h1>
                    </center><br>
                    <div class="formlogin">

                        <form id="cek-form" method="POST" action="">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Masukan NIK" name='nik' required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="password" class="form-control" placeholder="Masukan Password" name='pass' required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="submit" class="btn btn-success btn-md" value="login">
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    <center>
                        <h6>Atau Signin Dengan</h6>
                    </center>
                    <center><?= $login_button ?></center>
                    <br>
                    <center>
                        <h6>Register Dengan NIK terdaftar</h6>
                    </center>
                    <center>
                        <button class="btn btn-primary btn-md" id="login" data-toggle="modal" data-target="#modalregis">Register</button>
                    </center>
                </div>
            </div>
        </div>
        <?php
        if (session()->get('fail') != null) {
            echo '<div id="failed" class="alert alert-danger" role="alert">' . session()->get('fail') . '</div>';
        }

        ?>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalregis" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Regsitrasi Penduduk</h3>
                </div>
                <div class="modal-body">
                    <div class="row-md">
                        <div class="col-ms">
                            <form id="user-tambah" method="post" action="">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="">NIK</label>
                                            <select name="nik" class="form-control" id="nik">
                                                <option value="" disabled selected>Pilih NIK Penduduk</option>
                                                <?php foreach ($list as $item) : ?>
                                                    <option value="<?= $item->id ?>"><?= $item->nik ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Password</label>
                                            <input type="text" name='pass' class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">e-mail</label>
                                            <input type="email" name='email' placeholder="silahkan isi Email Anda" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" class="btn btn-md btn-success" value="Tambah">
                                    </div>
                                    <div class="col-6">

                                    </div>
                                    <div class="col">

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closebtnmodal" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script type="text/javascript" src="/js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            let fail = document.querySelector('#failed');
            flashcek();

            function flashcek() {
                if (fail === null) {} else {
                    $(body).on('click', function() {
                        flash.style.display = "none";
                    });
                }
            }

            $('#closebtnmodal').on('click', function() {
                $("#modalregis").modal('hide');
                $("#user-tambah")[0].reset();
            });


            $('#cek-form').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: '<?= site_url('User/authentifikasi') ?>',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        if (response == 'true') {
                            swal('Login Sukses!', '', 'success');
                            window.location.href = "<?= site_url('User/userdashboard') ?>";
                        } else {
                            swal('Login Gagal!', '', 'warning');
                        }
                    },
                    error: function(data) {
                        swal("Gagal!", data, "warning");
                        console.log(e);
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });


            $('#user-tambah').on('submit', function(e) {
                e.preventDefault();
                let dataku = new FormData(this);
                $.ajax({
                    url: '<?= site_url("User/tambahlog") ?>',
                    type: 'POST',
                    data: dataku,
                    success: function(data) {
                        $("#modalregis").modal('hide');
                        $("#user-tambah")[0].reset();
                        switch (data) {
                            case "true":
                                swal("Berhasil!", "Yeay!", "success");
                                break;
                            default:
                                swal("Gagal!", "Gagal ditambah mungkin sudah ada", "warning");
                                break;
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        swal("eror!", "", "warning");
                        $("#modalregis").modal('hide');
                        $("#user-tambah")[0].reset();
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        });
    </script>
</body>

</html>