<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    <link rel="icon" href="/assets/favicon-adminlogin.ico">

    <style>
        @keyframes fade {
            from {
                opacity: 0
            }

            to {
                opacity: 1
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

        body {
            background-image: url('/assets/bglog.jpg');
            background-size: cover;
        }

        .formlog {
            margin-top: 5%;
            min-width: 200px;
            min-height: 100px;
            height: 400px;
            width: 500px;
            display: block;
            position: relative;
            background-color: #dae1e7;
            opacity: 0.9;
            border-radius: 20px;
            padding: 20px;
        }

        .faded {
            animation: fade 0.9s ease-in-out;
        }

        .zoom {
            animation: zoomout 0.8s ease-in-out;
        }

        .formlog:hover {

            box-shadow: #888888 20px 20px 50px 15px;
            transition: box-shadow 0.5s ease-in-out;
        }
    </style>
    <title><?= $titel ?></title>
</head>

<body>
    <div class="container-fluid py-md-5 ">
        <div class="formlog py-md-5 d-block mx-auto  zoom">
            <h2 class="text-md-center">Admin Login</h2>
            <br>
            <?= form_open('Admin/cekAdmin') ?>
            <div class=form-group>
                <input type="text" class="form-control" id="email" placeholder="Enter Username" length="30" name="user">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" length="30" name="pass">
            </div>

            <input type="submit" class="btn btn-success" value="Login">

            <?= form_close() ?>
            <br>
            <?php
            $session = session();
            if (session()->getFlashdata("notif")) {
                echo '<div class="alert alert-danger" id="warning">
            ' . session()->getFlashdata("notif") . '</div>';
                $session->destroy();
            } else {
                $session->destroy();
            }
            ?>
        </div>
    </div>






    <script src="/js/jquery-3.5.1.slim.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/popper.js"></script>
    <script type="text/javascript" src="/js/sweetalert.min.js"></script>
    <script>
        let warning = document.querySelector('body');
        let item = document.querySelector('#warning')
        warning.addEventListener('click', function() {
            item.style.display = "none";
        });
    </script>
</body>

</html>