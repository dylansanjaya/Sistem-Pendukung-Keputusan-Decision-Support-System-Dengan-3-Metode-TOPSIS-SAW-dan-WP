<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
    <?php
    if (isset($page_title)) {
        echo $page_title;
    } else {
        echo 'SPK Penerimaan Karyawan';
    }
    ?>
    </title>
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="./css/styles.css" type="text/css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-default" style="background-color: #fff5; backdrop-filter: blur(7px); box-shadow: 0 .15rem .2rem #0005;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Sistem Pendukung Keputusan 3 Metode</a>
            </div>

            <div class="nav navbar-nav navbar-right" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                <?php
                $pages = array(
                    'Home' => 'index.php',
                    );

                if (isset($_SESSION['admin'])) {
                    $pages['Laporan'] = 'laporan.php';
                }

                $this_page = basename($_SERVER['PHP_SELF']);

                foreach ($pages as $key => $value) {
                    echo '<li';
                    if ($this_page == $value) {
                        echo ' class="active"';
                    }
                    echo '><a href="'.$value.'">'.$key.'</a></li>';
                }
                ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <?php
                if (isset($_SESSION['admin'])) {
                    echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>';
                }
                ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="table container">
