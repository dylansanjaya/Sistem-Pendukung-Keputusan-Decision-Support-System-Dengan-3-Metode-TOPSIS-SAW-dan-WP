<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include './includes/header.php';
?>

<div class="page-header">
        <h1>SPK Penerimaan Karyawan dengan metode TOPSIS, SAW dan WP</h1>
</div>

<?php
include './includes/criteriatable.php';
?>

<p class="text-right"><a href="informasi-pemilihan.php" class="btn btn-primary">Mulai</a></p>

<?php
include './includes/footer.php';
?>
