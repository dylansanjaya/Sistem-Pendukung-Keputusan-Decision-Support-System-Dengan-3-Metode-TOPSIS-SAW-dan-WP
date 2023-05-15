<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['ranking'])) {
    header('Location: ranking.php');
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

    $req = $dbc->prepare("SELECT * FROM bobot WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $bobot = $req->fetch();
}

$q = array(
    array(),
    array(),
    array(),
    array(),
    array(),
    array()
);

// Variabel total bobot kriteria
$t = $bobot['c1']+$bobot['c2']+$bobot['c3']+$bobot['c4']+$bobot['c5']+$bobot['c6'];

for ($i = 0; $i < count($alternatif); $i++) {
    $q[0][] = round($bobot['c1']/$t, 4);
    $q[1][] = round($bobot['c2']/$t, 4);
    $q[2][] = round($bobot['c3']/$t, 4);
    $q[3][] = round($bobot['c4']/$t, 4);
    $q[4][] = round($bobot['c5']/$t, 4);
    $q[5][] = round($bobot['c6']/$t, 4);
}

$status = "normalisasi-w";
try {
    $dbc->beginTransaction();

    $dbc->exec("DELETE FROM bobot_normal WHERE id_pemilihan = $_SESSION[id]");

    $req = $dbc->prepare("INSERT INTO bobot_normal VALUES(:id, :c1, :c2, :c3, :c4, :c5, :c6)");
    $req->bindValue(':id', $_SESSION['id']);

    for ($i = 0; $i<count($alternatif); $i++) {
        $req->bindValue(':c1', $q[0][$i]);
        $req->bindValue(':c2', $q[1][$i]);
        $req->bindValue(':c3', $q[2][$i]);
        $req->bindValue(':c4', $q[3][$i]);
        $req->bindValue(':c5', $q[4][$i]);
        $req->bindValue(':c6', $q[5][$i]);
        $req->execute();
    }

    $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
    $req->bindParam(1, $status);
    $req->bindParam(2, $_SESSION['id']);
    $req->execute();

    $dbc->commit();

    $_SESSION['normalisasi-w'] = true;
    header('Location: matrik-r-saw.php');
    exit;
} catch (PDOException $e) {
    $dbc->rollback();
}
?>

