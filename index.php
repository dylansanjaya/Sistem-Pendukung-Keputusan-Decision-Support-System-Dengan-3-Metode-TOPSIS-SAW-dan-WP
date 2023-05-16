<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
?>

<?php
include './includes/header.php';
?>

<div class="page-header text-center">
        <h2>SPK Penerimaan Karyawan dengan metode TOPSIS, SAW dan WP</h2>
</div>

<?php
include './includes/criteriatable.php';
?>

<p class="text-right"><a href="informasi-pemilihan.php" class="btn btn-primary home">Mulai</a></p>

<?php
include './includes/footer.php';
?>
