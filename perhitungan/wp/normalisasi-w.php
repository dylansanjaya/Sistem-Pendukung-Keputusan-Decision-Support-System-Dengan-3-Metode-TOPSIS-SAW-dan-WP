<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

include '.Three-Method-SPK/includes/header.php';
?>

<!-- ini code -->

<?php
include '.Three-Method-SPK/includes/footer.php';
?>
