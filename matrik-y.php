<?php
require './includes/config.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

if(!isset($_SESSION['matrik-r'])) {
    header('Location: matrik-r.php');
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

    $req = $dbc->prepare("SELECT * FROM matrik_r WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $matrik_r = $req->fetchAll();

    $req = $dbc->prepare("SELECT * FROM bobot WHERE id_pemilihan = ?");
    $req->bindParam(1, $_SESSION['id']);
    $req->execute();

    $bobot = $req->fetch();
}

$y = array(
    array(),
    array(),
    array(),
    array(),
    array(),
    array()
);

for ($i = 0; $i < count($alternatif); $i++) {
    $y[0][] = round($matrik_r[$i]['c1']*$bobot['c1'], 4);
    $y[1][] = round($matrik_r[$i]['c2']*$bobot['c2'], 4);
    $y[2][] = round($matrik_r[$i]['c3']*$bobot['c3'], 4);
    $y[3][] = round($matrik_r[$i]['c4']*$bobot['c4'], 4);
    $y[4][] = round($matrik_r[$i]['c5']*$bobot['c5'], 4);
    $y[5][] = round($matrik_r[$i]['c6']*$bobot['c6'], 4);
}


$status = "matrik-y";
try {
    $dbc->beginTransaction();

    $dbc->exec("DELETE FROM matrik_y WHERE id_pemilihan = $_SESSION[id]");

    $req = $dbc->prepare("INSERT INTO matrik_y VALUES(:id, :c1, :c2, :c3, :c4, :c5, :c6)");
    $req->bindValue(':id', $_SESSION['id']);

    for ($i = 0; $i<count($alternatif); $i++) {
        $req->bindValue(':c1', $y[0][$i]);
        $req->bindValue(':c2', $y[1][$i]);
        $req->bindValue(':c3', $y[2][$i]);
        $req->bindValue(':c4', $y[3][$i]);
        $req->bindValue(':c5', $y[4][$i]);
        $req->bindValue(':c6', $y[5][$i]);
        $req->execute();
    }

    $req = $dbc->prepare("UPDATE pemilihan SET status = ? WHERE id = ?");
    $req->bindParam(1, $status);
    $req->bindParam(2, $_SESSION['id']);
    $req->execute();

    $dbc->commit();

    $_SESSION['matrik-y'] = true;
    header('Location: nilai-ideal.php');
    exit;
} catch (PDOException $e) {
    $dbc->rollback();
}
