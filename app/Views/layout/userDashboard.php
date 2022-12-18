<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/css/custom2.css">
    <link rel="stylesheet" type="text/css" href="/css/datatables.min.css">
    <link rel="icon" href="/assets/favicon-user.ico">
    <title><?= $titel ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg warna2">
        <div class="navbar-brand">
            <img src="/assets/logouser.png" width="70px" class="img-fluid">
            <a href='<?= site_url("User/userdashboard") ?>'>Sipeduk</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
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
    </nav>
    <div class="wrapper">
        <aside class=" py-3  text-center">
            <div class="row">
                <div class="col">
                    <div class="tatagbr">
                        <?php
                        if ($foto_diri == "null") {
                            echo "<img src='" . $foto_google . "' width=200px class='img-fluid img-thumbnail'>";
                        } else {
                            echo "<img src='data:image;base64," . $foto_diri . "' width=200px class='img-fluid img-thumbnail'>";
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="row py-2">
                <div class="col">
                    <h2><?= $nama ?></h2>
                </div>
            </div>
            <div class="row py-1">
                <div class="col">
                    <h5><?php
                        echo $nik;
                        ?></h5>
                </div>
            </div>
            <div class="row py-1">
                <div class="col-3">
                </div>
                <div class="col-6">
                    <a href="<?= site_url('User/logout') ?>"><img id="stand" src="/assets/standby.png" width="30px" aria-label="logout"></a>
                </div>
                <div class="col-3">


                </div>
            </div>
        </aside>

        <?= $this->renderSection('isi') ?>
    </div>
    <script src="/js/jquery-3.5.1.min.js"> </script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script type="text/javascript" src="/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="/js/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            let count = 0;
            suratNotif();

            $('#gear').mouseenter(function() {
                $(this).toggleClass('active');
            });

            $('#gear').mouseleave(function() {
                $(this).toggleClass('active');
            });


            $('#stand').mouseenter(function() {
                $(this).toggleClass('active');
            });

            $('#stand').mouseleave(function() {
                $(this).toggleClass('active');
            });
            $('#navbarDropdownMenuLink').mouseenter(function() {
                $(this).toggleClass('active');
            });

            $('#navbarDropdownMenuLink').mouseleave(function() {
                $(this).toggleClass('active');
            });



            function suratNotif() {
                $.ajax({
                    url: '<?= site_url('User/status') ?>',
                    type: 'GET',
                    dataType: "JSON",
                    async: false,
                    success: function(data) {
                        console.log(data);

                        for (let i = 0; i < data.data.length; i++) {
                            count += 1;

                            $('.badge').html(count);
                            if (data.data[i].status === "0") {

                                let htmlku = '<div id="content-pesan"><span id="exitnotif" class="text-right"><button class="btn btn-danger btn-sm rounded-circle">X</button></span><div class="row"><div class="col-4"><h5> Status:</h5> </div><span id="statuspesan">Pending!</span><div class="col-4"></div></div><div class="row"><div class="col-4"><h5>Kategori:</h5></div><span id="kat">' + data.data[i].kategori + '</span><div class="col-4"></div></div></div>';
                                $('.dropdown-menu').append(htmlku);

                            } else if (data.data[i].status === "1") {
                                let htmlku = '<div id="content-pesan"><span id="exitnotif" class="text-right"><button class="btn btn-danger btn-sm rounded-circle">X</button></span><div class="row"><div class="col-4"><h5> Status:</h5> </div><span id="statuspesan">Diterima!</span><div class="col-4"></div></div><div class="row"><div class="col-4"><h5>Kategori:</h5></div><span id="kat">' + data.data[i].kategori + '</span><div class="col-4"></div></div></div>';
                                $('.dropdown-menu').append(htmlku);

                            } else {
                                let htmlku = '<div id="content-pesan"><span id="exitnotif" class="text-right"><button class="btn btn-danger btn-sm rounded-circle">X</button></span><div class="row"><div class="col-4"><h5> Status:</h5> </div><span id="statuspesan">Ditolak!</span><div class="col-4"></div></div><div class="row"><div class="col-4"><h5>Kategori:</h5></div><span id="kat">' + data.data[i].kategori + '</span><div class="col-4"></div></div></div>';
                                $('.dropdown-menu').append(htmlku);
                            }
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
    </script>
    <?= $this->renderSection('Script') ?>
</body>


</html>