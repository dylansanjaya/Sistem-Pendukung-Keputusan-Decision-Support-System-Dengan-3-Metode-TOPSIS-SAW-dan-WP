<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['normalisasi-w-wp'])) {
    header('Location: normalisasi-w-wp.php');
    exit;
} else {
    $req = $dbc->prepare("SELECT * FROM pemilihan WHERE id = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $pemilihan = $req->fetch();

    $req = $dbc->prepare("SELECT * FROM alternatif WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $alternatif = $req->fetchAll();

    $req = $dbc->prepare("SELECT * FROM nilai WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $nilaiAlternatif = $req->fetchAll();

    $req = $dbc->prepare("SELECT * FROM bobot_normal_w WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $bobotnormal = $req->fetchAll();
}

$swp = array();
$b = array();

foreach ($bobotnormal as $row) {
    $b[0] = $row['c1'];
    $b[1] = $row['c2'];
    $b[2] = $row['c3'];
    $b[3] = $row['c4'];
    $b[4] = $row['c5'];
    $b[5] = $row['c6'];
}

foreach ($nilaiAlternatif as $nilaiAlternatifWP) {
    $product = 1;

    for ($i = 0; $i < count($b); $i++) {
        $product *= pow($nilaiAlternatifWP["c".($i+1)], $b[$i]);
    }

    $swp[] = $product;
}

$status = "normalisasi-s-wp";
try {
    $dbc->beginTransaction();

    $dbc->exec("DELETE FROM s_normal_wp WHERE id_pemilihan = $_SESSION[id]");

    $req = $dbc->prepare("INSERT INTO s_normal_wp VALUES(:id, :swp)");
    $req->bindValue(':id', $_SESSION['id']);

    for ($i = 0; $i < count($alternatif); $i++) {
        $req->bindValue(':swp', $swp[$i]);
        $req->execute();
    }

    $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
    $req->bindParam(1, $status);
    $req->bindParam(2, $_SESSION['id']);
    $req->execute();

    $dbc->commit();

    $_SESSION['normalisasi-s-wp'] = true;
    header('Location: nilai-v-wp.php');
    exit;
} catch (PDOException $e) {
    $dbc->rollback();
}






