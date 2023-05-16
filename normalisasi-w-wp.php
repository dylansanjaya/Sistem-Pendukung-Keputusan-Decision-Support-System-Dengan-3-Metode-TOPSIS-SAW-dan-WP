<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['ranking-saw'])) {
    header('Location: ranking-saw.php');
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

    $req = $dbc->prepare("SELECT * FROM bobot_normal WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $bobotnormal = $req->fetch();
}

$nw = array(
    array(),
    array(),
    array(),
    array(),
    array(),
    array()
);

//Benefit and Cost
$b = 1;
$c = -1;

for ($i = 0; $i < count($alternatif); $i++) {
    $nw[0][] = round(($bobotnormal['c1']*$b),4);
    $nw[1][] = round(($bobotnormal['c2']*$b),4);
    $nw[2][] = round(($bobotnormal['c3']*$b),4);
    $nw[3][] = round(($bobotnormal['c4']*$c),4);
    $nw[4][] = round(($bobotnormal['c5']*$c),4);
    $nw[5][] = round(($bobotnormal['c6']*$c),4);
}

$status = "normalisasi-w-wp";
try {
    $dbc->beginTransaction();

    $dbc->exec("DELETE FROM bobot_normal_w WHERE id_pemilihan = $_SESSION[id]");

    $req = $dbc->prepare("INSERT INTO bobot_normal_w VALUES(:id, :c1, :c2, :c3, :c4, :c5, :c6)");
    $req->bindValue(':id', $_SESSION['id']);

    for ($i = 0; $i<count($alternatif); $i++) {
        $req->bindValue(':c1', $nw[0][$i]);
        $req->bindValue(':c2', $nw[1][$i]);
        $req->bindValue(':c3', $nw[2][$i]);
        $req->bindValue(':c4', $nw[3][$i]);
        $req->bindValue(':c5', $nw[4][$i]);
        $req->bindValue(':c6', $nw[5][$i]);
        $req->execute();
    }
    
    $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
    $req->bindParam(1, $status);
    $req->bindParam(2, $_SESSION['id']);
    $req->execute();

    $dbc->commit();

    $_SESSION['normalisasi-w-wp'] = true;
    header('Location: normalisasi-s-wp.php');
    exit;
} catch (PDOException $e) {
    $dbc->rollback();
}
?>