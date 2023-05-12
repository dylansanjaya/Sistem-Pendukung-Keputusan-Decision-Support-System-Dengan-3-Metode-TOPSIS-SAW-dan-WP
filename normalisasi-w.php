<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include './includes/header.php';
?>

<!-- ini code -->

<?php
include './includes/footer.php';
?>
