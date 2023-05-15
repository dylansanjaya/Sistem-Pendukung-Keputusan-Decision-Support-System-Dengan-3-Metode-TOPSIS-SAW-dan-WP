<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['jarak-solusi-ideal'])) {
    header('Location: jarak-solusi-ideal.php');
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

    $req = $dbc->prepare("SELECT * FROM jarak_solusi_ideal WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $d = $req->fetchAll();
}

$v = array();

foreach ($d as $dNilai) {
    $v[] = round($dNilai['negatif']/($dNilai['negatif']+$dNilai['positif']), 4);
}

$status = "ranking";
try {
    $dbc->beginTransaction();

    $dbc->exec("DELETE FROM ranking WHERE id_pemilihan = $_SESSION[id]");

    $req = $dbc->prepare("INSERT INTO ranking VALUES(:id, :v)");
    $req->bindValue(':id', $_SESSION['id']);

    for ($i = 0; $i < count($alternatif); $i++) {
        $req->bindValue(':v', $v[$i]);
        $req->execute();
    }

    $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
    $req->bindParam(1, $status);
    $req->bindParam(2, $_SESSION['id']);
    $req->execute();

    $dbc->commit();

    $_SESSION['ranking'] = true;
    header('Location: hasil.php');
    exit;
} catch (PDOException $e) {
    $dbc->rollback();
}
