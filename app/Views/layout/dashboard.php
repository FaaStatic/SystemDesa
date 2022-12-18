<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="icon" href="/assets/favicon-desa.ico">
    <title><?= $titel; ?></title>
    <?= $this->renderSection('style'); ?>
    <style>
        .a-widget-card {
            padding: 5%;
            border: 1px solid #eaeaea;
            background: none;
            border-radius: 5px
        }

        .a-widget-card h2 {
            color: #000
        }

        .a-widget-card p {
            color: #000
        }

        .a-widget-info {
            color: #000;
            text-align: center
        }

        .a-widget-card span {
            font-weight: bold
        }

        .a-widget-card .data {
            font-size: 20px
        }

        #header {
            max-height: 100vh;
            margin-bottom: 150px;
        }

        #corouselid {
            min-height: 50vh;
            margin-bottom: 10px;
            padding: 30px;
            margin-top: 50px;

        }

        #isi {
            min-height: 100vh;
            margin-bottom: 10px;
        }

        #utama {
            padding: 20px;
        }

        #widget {
            padding: 10px;

        }

        .nav-item a {
            font-size: 20px;
        }

        #footer {
            min-height: 30vh;
            ;
            padding: 10px;
        }

        body {
            margin: 0;
            box-sizing: border-box;

        }



        .carousel-caption p {

            color: black;
            font-size: 40px;
            background-color: whitesmoke;
            box-shadow: 2px 2px 10px 2px gray;
            border-radius: 10px;
        }

        .livetext {
            width: 100%;
            height: 80px;
            background-color: black;
        }

        .livetext marquee p {
            font-size: 50px;
            color: white;
        }

        .card {
            margin-top: 10px;
            margin-bottom: 10px;

        }

        #gpr-kominfo-widget-container {
            min-height: 300px;
        }

        .nav-item a {
            color: gray;
        }
    </style>
</head>

<body>


    <div class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top" id="header">
        <div class="row" id="logo">
            <div class="col">
                <div class="row">
                    <div class="col-10">
                        <div class="container-fluid">

                            <a href="<?= site_url('Client/index') ?>" class="navbar-brand">
                                <img src="/assets/lambang.png" width="50px" class="img-fluid" style="float: left; margin-left:20px; margin-top:10px; margin-right:15px;
                    margin-bottom:10px;">
                                <h3 style=" text-decoration: none; color:white; margin-left:5px;
                    margin-top:10px;">Desa Hulusobo</h3>
                                <h6>Kabupaten Purworejo</h6>

                            </a>
                        </div>
                    </div>

                    <div class="col">
                        <div style="margin-top: 20px;"><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button></div>
                    </div>
                </div>
                <div class="row">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <div class="col-10 .col-sm-6 .col-md-8 ">

                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Profil Desa
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="<?= site_url('Client/artikel/sejarah-desa') ?>">Sejarah Desa</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= site_url('Client/artikel/profil-wilayah') ?>">Wilayah Desa</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= site_url('Client/artikel/visi-misi') ?>">Visi - Misi Desa</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Pemerintahan Desa
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="<?= site_url('Client/artikel/pemerintahan-desa') ?>">Pemerintahan desa</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= site_url('Client/artikel/badan-permusyawaratan') ?>">BPD</a>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        LemMas
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="<?= site_url('Client/artikel/lpm') ?>">LPM</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= site_url('Client/artikel/pkk') ?>">PKK</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?= site_url('Client/artikel/karang-taruna') ?>">Karang Taruna</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('user/index') ?>" class="nav-link">Login SIPEDUK</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6 .col-md-4">

                            <ul class="navbar-nav mr-1">
                                <li class="nav-item">
                                    <form class="form-inline my-2 my-lg-0" id="cari" action="<?= site_url('Client/search') ?>" method="post">
                                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="cari">
                                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cari</button>
                                    </form>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <br><br>
    <div class="row" id="corouselid">
        <div class="col py-6">
            <div class="container ">

                <center>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-80" src="/assets/hulusobo.jpg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Selamat Datang Di Website Desa Hulusobo</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-80" src="/assets/hulusobo2.jpg" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Acara Tari Di Desa Hulusobo</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/assets/hulusobo3.jpg" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Cegah COVID-19</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/assets/hulusobo4.jpg" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Acara Tradisional Desa Hulusobo</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/assets/hulusobo5.jpg" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block">
                                    <p>Musdes Desa Hulusobo</p>
                                </div>
                            </div>
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    </div>

                </center>
            </div>
        </div>
    </div>

    <div class="livetext">
        <marquee>
            <p>Selamat Datang Di Website Desa Hulusobo</p>
        </marquee>
    </div>

    <div class="row" id="isi">
        <div class="col-8 " id="utama">
            <div class="container" style="
            align-items: center; padding:10px;">
                <?= $this->renderSection('isi'); ?>
            </div>
        </div>
        <div class="col-4" id="widget">
            <div class="container" style="
            align-items: center;padding:10px;">
                <div class="card bg-light" style="width: 450px; height:780px;">
                    <div class="card-body ">

                        <div class="a-widget-card">
                            <div class="a-widget-info">
                                <h2>KASUS COVID-19 INDONESIA</h2>
                            </div>
                            <p>
                                Terkonfirmasi:<br />
                                <span class="data" id="positif"></span>
                            </p>
                            <p>
                                Sembuh:<br />
                                <span class="data" id="sembuh"></span>
                            </p>
                            <p>
                                Meninggal:<br />
                                <span class="data" id="meninggal"></span>
                            </p>
                            <div class="a-widget-info">
                                Sumber Data: <u>kawalcorona.com</u><br />
                                Update Terakhir: <span id="date"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-light" style="width: 450px; height:450px;">
                    <div class="card-body ">
                        <h2 class="card-title">Peta Desa</h2>
                        <div class="card-body">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21990.82456125987!2d110.06654784345376!3d-7.746956711282584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7aeef262f565ab%3A0x5027a76e3555fb0!2sHulosobo%2C%20Kaligesing%2C%20Kabupaten%20Purworejo%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1592987148076!5m2!1sid!2sid" width="390px" height="300px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>

                    </div>
                </div>

                <div class="card bg-light" style="width: 450px; height:200px;">
                    <div class="card-body ">
                        <h2 class="card-title">Pengaduan Masyarakat</h2>
                        <div class="card-body">
                            <a href="#"><img src="/assets/WAicon.png" alt="" width="50px" height="50px" class="img-fluid"></a>
                        </div>

                    </div>
                </div>

                <?= $this->renderSection('aside'); ?>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark">
        <div id="footer">
            <div class="row ">
                <div class="col-7">
                    <div class="container">
                        <table>
                            <tr>
                                <td><a href="#" class="btn btn-lg btn-warning" style="box-shadow: 2px 2px 2px2px black;">UP</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-4 mr-2 ">
                    <div class="container py-3">
                        <center>
                            <table>
                                <tr>
                                    <td>
                                        <h3 style="color:white;">&copy;SuhailiFaruq2020</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                        <h4 style="color:white;">Sistem Desa Hulusobo</h4>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 style="color:white; float:left; margin-right:5px;">Contact :</h5> <a href="#"><img src="/assets/instagramicon.png" alt="" width="50px" height="50px" class="img-fluid" style="margin-right:5px; float:left;">
                                            <a href="#"><img src="/assets/WAicon.png" alt="" width="50px" height="50px" class="img-fluid" style=" margin-right:5px; float:left;"></a>
                                    </td>




                                </tr>
                            </table>
                        </center>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="/js/jquery-3.5.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script type="text/javascript" src="/js/datatables.min.js"></script>
    <script type="text/javascript" src="/js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 2000
            });

            var date = new Date();
            var arraybulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            var detik = date.getSeconds();
            var menit = date.getMinutes();
            var jam = date.getHours();
            var hari = date.getDay();
            var tanggal = date.getDate();
            var bulan = date.getMonth();
            var tahun = date.getFullYear();
            $("#date").html(tanggal + " " + arraybulan[bulan] + " " + tahun + " (" + jam + ":" + ((menit < 10) ? "0" : "") + menit + ":" + ((detik < 10) ? "0" : "") + detik + ")");
            $.ajax({
                url: "https://api.kawalcorona.com/indonesia/",
                success: function(data) {
                    $("#positif").html(data[0].positif);
                    $("#sembuh").html(data[0].sembuh);
                    $("#meninggal").html(data[0].meninggal);
                }
            });


        });
    </script>


    <?= $this->renderSection('Script'); ?>
</body>

</html>