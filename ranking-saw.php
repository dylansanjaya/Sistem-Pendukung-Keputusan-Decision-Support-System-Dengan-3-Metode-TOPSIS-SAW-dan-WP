<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['matrik-v-saw'])) {
    header('Location: matrik-v-saw.php');
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

    $req = $dbc->prepare("SELECT * FROM matrik_v_saw WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $mvs = $req->fetchAll();
}

$vrs = array();

foreach ($mvs as $mvsKategori){
    $vrs[] = round(($mvsKategori['c1']+$mvsKategori['c2']+$mvsKategori['c3']+$mvsKategori['c4']+$mvsKategori['c5']+$mvsKategori['c6']), 4);
}

$status = "ranking-saw";
try {
    $dbc->beginTransaction();

    $dbc->exec("DELETE FROM ranking_saw WHERE id_pemilihan = $_SESSION[id]");

    $req = $dbc->prepare("INSERT INTO ranking_saw VALUES(:id, :vrs)");
    $req->bindValue(':id', $_SESSION['id']);

    for ($i = 0; $i < count($alternatif); $i++) {
        $req->bindValue(':vrs', $vrs[$i]);
        $req->execute();
    }

    $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
    $req->bindParam(1, $status);
    $req->bindParam(2, $_SESSION['id']);
    $req->execute();

    $dbc->commit();

    $_SESSION['ranking-saw'] = true;
    header('Location: hasil.php');
    exit;
} catch (PDOException $e) {
    $dbc->rollback();
}