<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['normalisasi-s-wp'])) {
    header('Location: normalisasi-s-wp.php');
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

    $req = $dbc->prepare("SELECT * FROM s_normal_wp WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $swp = $req->fetchAll();
}

$vwp = array();

$totalswp = 0;
foreach ($swp as $swpvalue) {
    $totalswp += $swpvalue['s'];
}

foreach ($swp as $swpvalue) {
    $vwp[] = round(($swpvalue['s'] / $totalswp), 4);
}

$status = "nilai-v-wp";
try{
    $dbc->beginTransaction();

    $dbc->exec("DELETE FROM ranking_wp WHERE id_pemilihan = $_SESSION[id]");

    $req = $dbc->prepare("INSERT INTO ranking_wp VALUES(:id, :s)");
    $req->bindValue(':id', $_SESSION['id']);

    for ($i = 0; $i < count($alternatif); $i++) {
        $req->bindValue(':s', $vwp[$i]);
        $req->execute();
    }

    $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
    $req->bindParam(1, $status);
    $req->bindParam(2, $_SESSION['id']);
    $req->execute();

    $dbc->commit();
    
    $_SESSION['nilai-v-wp'] = true;
    header('Location: hasil.php');
    exit;
} catch (PDOException $e) {
    $dbc->rollback();
}

